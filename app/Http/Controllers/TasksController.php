<?php

namespace App\Http\Controllers;


use App\Models\Subject;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; //para formatear fechas
use \Illuminate\Database\Eloquent\ModelNotFoundException;

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
                'color' => $color
            ];
        }

        return view('calendar', @compact("tasks", "user"));
    }
    public function create_task(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:255',
            'description' => 'required|string|min:3',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            "end_time" => 'required|date_format:H:i',
        ]);

        $errors = $request->has('errors');

        if (!$errors) {
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
            return back();
        } else {
            toastr('Ha ocurrido un error al registrar la tarea', "error", 'Ooops');
            return back();
        }
    }

    public function drag_drop_task(Request $request, $id)
    {
        //este método permite actualizar la fecha de una tarea (arrastrando en el calendario)

        try {
            $user = User::findOrFail(Auth::id());
            $task = Task::findOrFail($id); //guardamos la tarea para poder devolver el name

            $user->tasks()->updateExistingPivot($id, ['date' => $request->date]);
            //formateamos fecha para mostrar alerta: 
            $date = Carbon::createFromFormat("Y-m-d", $request->date);
            $date = $date->format('d/m');
            return response()->json(['message' => $task->name . ' ha sido cambiada al ' . $date]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => "No se ha encontrado esa tarea"], 404);
        }
    }
}
