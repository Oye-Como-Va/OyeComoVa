<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkingAreaController extends Controller
{
    public function comprobar_task()
    {
        $user = User::findOrFail(Auth::id());
        $orderedTasks = $user->tasks()->with('subjects.course')->orderBy('task_user.date', 'asc')->orderBy('task_user.start_time', 'asc')->get();

        $nextTask = $orderedTasks->shift();
        $delayedTasks = $user->tasks()->where('date', '<', now())->with('subjects.course')->orderBy('task_user.date', 'asc')->orderBy('task_user.start_time', 'asc')->get();

        return view('workingArea', @compact('orderedTasks', 'nextTask', 'delayedTasks', 'user'));
    }
}
