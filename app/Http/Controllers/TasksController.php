<?php

namespace App\Http\Controllers;


use App\Models\Subject;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; //para formatear fechas
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TasksController extends Controller
{

    public function show_tasks()
    {
        $user = User::findOrFail(Auth::id());
        $tasks = array();
        //genero un array de objetos con las tareas en el formato que requiere fullcalendar:
        foreach ($user->tasks as $task) {
            $color = "aquamarine";
            if (isset($task->subject_id)) {
                $subject = Subject::findOrFail($task->subject_id);
                $color = $subject->color;
            }
            $tasks[] = [
                'id' => $task->id,
                'title' => $task->name,
                'start' => $task->pivot->date . 'T' . $task->pivot->start_time,
                'end' => $task->pivot->date . 'T' . $task->pivot->end_time,
                'color' => $color,
                'description' => $task->description
            ];
        }

        return view('calendar', @compact("tasks", "user"));
    }
    public function create_task(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail(Auth::id());
            $request->validate([
                'name' => 'required|regex:/^[\pL\s\-]+$/u|min:1|max:255',
                'description' => 'required|string|min:1',
                'date' => 'required|date_format:Y-m-d',
                'start_time' => 'required|date_format:H:i',
                "end_time" => 'required|date_format:H:i',
            ]);

            $newTask = new Task;
            $newTask->name = $request->name;
            $newTask->description = $request->description;
            if ($request->subject !== '-') {
                $newTask->subject_id = $request->subject;
            }
            $newTask->save();

            $user->tasks()->attach($newTask->id, ['date' => $request->date, 'start_time' =>  $request->start_time, 'end_time' => $request->end_time]);
            $user->save();

            //Cambiamos formato fecha para mostrar la alerta
            $date = Carbon::createFromFormat("Y-m-d", $request->date);
            $date = $date->format('d/m');
            toastr($date . " " . $request->start_time . " : " . $request->name, "success", "¡Tarea agregada al calendario!");

            DB::commit();
            return back();

            //!HAY QUE TRADUCIR ESTOS ERRORES !!!!!!
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $errorMessages = '';
            foreach ($errors as $error) {
                $errorMessages .= $error . "<br/>";
            }
            toastr($errorMessages, "error", "Ooops");
            return back();
        }
    }


    public function drag_drop_task(Request $request, $id)
    {
        //este método permite actualizar la fecha de una tarea (arrastrando en el calendario)

        try {
            DB::beginTransaction();
            $user = User::findOrFail(Auth::id());
            $task = Task::findOrFail($id); //guardamos la tarea para poder devolver el name

            $user->tasks()->updateExistingPivot($id, ['date' => $request->date]);
            //formateamos fecha para mostrar alerta:
            $date = Carbon::createFromFormat("Y-m-d", $request->date);
            $date = $date->format('d/m');

            DB::commit();
            return response()->json(['message' => $task->name . ' ha sido cambiada al ' . $date]);
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return response()->json(['message' => "No se ha encontrado esa tarea"], 404);
        }
    }

    public function edit_task($id)
    {
        $taskEdit = Task::findOrFail($id);
        if ($taskEdit->subject_id) {
            $subject = Subject::findOrFail($taskEdit->subject_id);
            $response = array(
                "taskEdit" => $taskEdit,
                "subject" => $subject,
                "course" => $subject->course
            );
            return response()->json($response);
        }

        return response()->json(["taskEdit" => $taskEdit, "subject" => null]);
    }
    public function saveChanges(Request $request, $id)
    {
        try {
            $user = User::findOrFail(Auth::id());
            $taskEdit = Task::findOrFail($id);
            $request->validate([
                'nameEdit' => 'required|regex:/^[\pL\d\s-]+$/u|min:1|max:255',
                'descriptionEdit' => 'required|string|min:1',
                'dateEdit' => 'required|date_format:Y-m-d',
                'start_timeEdit' => 'required|date_format:H:i',
                "end_timeEdit" => 'required|date_format:H:i',
            ]);

            $errors = $request->has('errors');

            $taskEdit->id = $id;
            $taskEdit->name = $request->nameEdit;
            $taskEdit->description = $request->descriptionEdit;

            if (isset($request->subject)) {
                $taskEdit->subject_id = $request->subjectEdit;
            }
            $taskEdit->save();

            $user->tasks()->detach($taskEdit->id);
            $user->tasks()->attach($id, ['date' => $request->dateEdit, 'start_time' =>  $request->start_timeEdit, 'end_time' => $request->end_timeEdit]);
            $user->save();

            //Cambiamos formato fecha para mostrar la alerta
            $date = Carbon::createFromFormat("Y-m-d", $request->dateEdit);
            $date = $date->format('d/m');
            toastr($date . " " . $request->start_timeEdit . " : " . $request->nameEdit, "success", "¡Tarea modificada!");
            DB::commit();
            return back();
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $errorMessages = '';
            foreach ($errors as $error) {
                $errorMessages .= $error . "<br/>";
            }
            toastr($errorMessages, "error", "Ooops");
            return back();
        }
    }

    public function delete_task($id)
    {
        $user = User::findOrFail(Auth::id());
        $taskToDelete = Task::findOrFail($id);
        $name = $taskToDelete->name;

        if (isset($taskToDelete)) {
            $user->tasks()->detach($id);
            $working_area = $user->working_areas();
            $working_area->where('task_id', $id)->delete();
            if ($taskToDelete->delete()) {
                toastr($name . ' borrada correctamente', 'success', '¡Eliminada!');
                return back();
            } else {
                toastr('No se ha podido eliminar la tarea', 'error', 'Ooops');
                return back();
            }
        } else {
            toastr('No se ha encontrado la tarea', 'error', 'Ooops');
            return back();
        }


    }

    public function comprobar_task(){

        $user = User::findOrFail(Auth::id());
        $tasks = $user->tasks;
        //$tasks = DB::table('tasks')
           // ->join('task_user', 'tasks.id', '=', 'task_user.task_id')
           // ->where('task_user.user_id', $user->id)
           // ->orderBy('task_user.date', 'asc')
           // ->get();

        return view('workingAreaActive', @compact('tasks','user'));
        

    }
}
