<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use Carbon\Carbon;
use App\Models\Working_area;

class WorkingAreaController extends Controller
{
    public function comprobar_task()
    {
        $user = User::findOrFail(Auth::id());
        $now = now();
        $orderedTasks = $user->tasks()->where('finished', false)->where('date', '>', $now->toDateString())->orWhere(function ($query) use ($now) {
            $query->where('date', $now->toDateString())
                ->where('start_time', '>', $now->toTimeString());
        })->with('subjects.course')->orderBy('task_user.date', 'asc')->orderBy('task_user.start_time', 'asc')->get();


        $nextTask = $orderedTasks->shift();

        $delayedTasks = $user->tasks()->where('finished', false)
            ->where(function ($query) {
                $query->where('date', '<', now())
                    ->orWhere(function ($query) {
                        $query->where('date', now()->toDateString())
                            ->where(function ($query) {
                                $query->where('start_time', '<', now()->toTimeString())
                                    ->orWhere('start_time', '=', now()->toTimeString());
                            });
                    });
            })
            ->where(function ($query) use ($now) {
                $query->where('date', '<', $now->toDateString())
                    ->orWhere(function ($query) use ($now) {
                        $query->where('date', $now->toDateString())
                            ->where('start_time', '<', $now->toTimeString());
                    });
            })
            ->with('subjects.course')
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        $tasks = [
            "delayedTasks" => $delayedTasks,
            "orderedTasks" => $orderedTasks
        ];

        return view('workingArea', @compact('tasks', 'nextTask', 'user'));
    }

    public function create_working(Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $task = $user->tasks->find($request->id);

        $workingArea = new Working_area;
        $workingArea->date = $task->pivot->date;
        $workingArea->date_real = now()->toDateTimeString();
        $workingArea->start_time = $task->pivot->start_time;
        $workingArea->start_time_real = now()->toTimeString();
        $workingArea->end_time = $task->pivot->end_time;
        $workingArea->user_id = $user->id;
        $workingArea->task_id = $task->id;

        $workingArea->save();

        $working_id = $workingArea->id;
        $start_time_real = $workingArea->start_time_real;

        return view('workingAreaActive', @compact('task', 'working_id', 'start_time_real'));
    }

    public function create_note(Request $request)
    {
        //!CONTROLAR VALIDACIONES: 

        $note = new Note;
        $note->note = $request->note;
        $note->color = $request->color;
        $note->date = now()->toDateString();
        $note->time = now()->toTimeString();
        $note->working_area_id = $request->working_id;

        $note->save();

        return response()->json(['note' => $note->toArray(), "message" => 'nota agregada']);
    }

    public function end_task(Request $request)
    {
        $workingArea = Working_area::findOrFail($request->working_id);
        $workingArea->end_time_real = now()->toTimeString();

        $task = Task::findOrFail($request->task_id);
        $task->finished = true;

        $task->save();
        $workingArea->save();

        return redirect()->route('workingArea');
    }
}
