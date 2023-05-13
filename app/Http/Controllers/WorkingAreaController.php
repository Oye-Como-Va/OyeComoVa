<?php

namespace App\Http\Controllers;



use App\Models\Task;
use App\Models\Working_area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WorkingAreaController extends Controller
{
    public function comprobar_task()
    {
        $user = User::findOrFail(Auth::id());
        $now = now();
        $orderedTasks = $user->tasks()->where('finished', false)
            ->where(function ($query) use ($now) {
                $query->where('date', '>', $now->toDateString())
                    ->orWhere(function ($query) use ($now) {
                        $query->where('date', $now->toDateString())
                            ->where('start_time', '>', $now->toTimeString());
                    });
            })
            ->with(['subjects' => function ($query) {
                $query->with('course');
            }])
            ->orderBy('task_user.date', 'asc')
            ->orderBy('task_user.start_time', 'asc')
            ->get();

        $nextTask = $orderedTasks->shift();
        $delayedTasks = $user->tasks()->where('date', '<=', now())->with('subjects.course')->orderBy('task_user.date', 'asc')->orderBy('task_user.start_time', 'asc')->get();

        // return $orderedTasks; 
        return view('workingArea', @compact('orderedTasks', 'nextTask', 'delayedTasks', 'user'));
    }

    public function create_working(Request $request)
    {
        //!Comprobar si existe la tarea en los working areas para no duplicar

        $user = User::findOrFail(Auth::id());
        $taskInfo = $user->tasks->find($request->id);

        $workingArea = new Working_area;
        $workingArea->date = $taskInfo->pivot->date;
        $workingArea->date_real = now()->toDateTimeString();
        $workingArea->start_time = $taskInfo->pivot->start_time;
        $workingArea->start_time_real = now()->toTimeString();
        $workingArea->end_time = $taskInfo->pivot->end_time;
        $workingArea->user_id = $user->id;
        $workingArea->task_id = $taskInfo->id;

        $workingArea->save();

        $task = [
            "id" => $taskInfo->id,
            "name" => $taskInfo->name,
            "description" => $taskInfo->description,
            "start_time" => Carbon::createFromFormat('H:i:s', $taskInfo->pivot->start_time)->format('H:i'),
            "end_time" => Carbon::createFromFormat('H:i:s', $taskInfo->pivot->end_time)->format('H:i'),
            "subject" => $taskInfo->subjects->name,
            "course" => $taskInfo->subjects->course->name
        ];

        $working_id = $workingArea->id;

        return view('workingAreaActive', @compact('task', 'taskInfo', 'working_id'));
    }

    public function create_note(Request $request)
    {
    }

    public function end_task(Request $request)
    {
        $workingArea = Working_area::findOrFail($request->working_id);
        $workingArea->end_time_real = now()->toTimeString();

        $task = Task::findOrFail($request->task_id);
        $task->finished = true;

        $task->save();
        $workingArea->save();
    }
}
