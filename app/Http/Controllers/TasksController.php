<?php

namespace App\Http\Controllers;


use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{

    public function show_tasks()
    {
        $user = User::findOrFail(Auth::id());
        $tasks = array();
        //genero un array de objetos con las tareas en el formato que requiere fullcalendar: 
        foreach ($user->tasks as $task) {
            $tasks[] = [
                'id' => $task->id,
                'title' => $task->name,
                'start' => $task->pivot->date . 'T' . $task->pivot->start_time,
                'end' => $task->pivot->date . 'T' . $task->pivot->end_time,
            ];
        }
        // return $tasks;
        return view('calendar', @compact("tasks"));
    }
    public function create_task(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:255',
            'description' => 'required|string|min:3',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            "end_time" => 'required|date_format:H:i'
        ]);

        $errors = $request->has('errors');

        if (!$errors) {
            $newTask = new Task;
            $newTask->name = $request->name;
            $newTask->description = $request->description;

            $newTask->save();

            //! Falta controlar las asignaturas 

            $user->tasks()->attach($newTask->id, ['date' => $request->date, 'start_time' =>  $request->start_time, 'end_time' => $request->end_time]);
            $user->save();

            return back()->with('message');
        } else {
            return back()->with($errors);
        }
    }
}
