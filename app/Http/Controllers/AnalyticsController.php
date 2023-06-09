<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function analytics()
    {
        $user = User::findOrFail(Auth::id());

        // Extraer las tareas atrasadas a una función
        $delayedTasks = count($this->getDelayedTasks($user));

        // Extraer los calculos de tiempo
        $workingTime = $this->calculateWorkingTime($user->working_areas);
        $programedTime = $this->calculateProgramedTime($user->working_areas);
        $startDelayedTime = $this->calculateStartDelayed($user->working_areas);
        $endDelayedTime = $this->calculateEndDelayed($user->working_areas);

        // Extraer el cálculo de tareas completadas y pendientes a una función
        $completedTasksCount = $this->getCompletedTasksCount($user->id, true);
        $pendingTasksCount = $this->getCompletedTasksCount($user->id, false);

        //Extraer los días totales trabajados
        $totalDaysWorked = $this->getDaysCount($user->working_areas);

        // Actualizar la base de datos en una sola consulta
        DB::table('users')->where('id', $user->id)->update([
            'completed_tasks' => $completedTasksCount,
            'pending_tasks' => $pendingTasksCount
        ]);

        // Devolver los resultados
        return view('analytics', @compact("delayedTasks", "workingTime", 'programedTime', 'startDelayedTime', 'endDelayedTime', 'completedTasksCount', 'pendingTasksCount', 'totalDaysWorked'));
    }

    private function getDelayedTasks($user)
    {
        return $user->tasks()->where('date', '<', now())->where('finished', 0)->get();
    }

    private function calculateWorkingTime($workingAreas)
    {
        $totalSeconds = 0;

        foreach ($workingAreas as $work) {
            $startDate = Carbon::parse($work->start_time_real);
            $endDate = Carbon::parse($work->end_time_real);
            $totalSeconds += $endDate->diffInSeconds($startDate);
        }

        return Carbon::createFromTimestamp($totalSeconds)->format('H:i:s');
    }
    private function calculateProgramedTime($workingAreas)
    {
        $totalSeconds = 0;

        foreach ($workingAreas as $work) {
            $startDate = Carbon::parse($work->start_time);
            $endDate = Carbon::parse($work->end_time);
            $totalSeconds += $endDate->diffInSeconds($startDate);
        }

        return Carbon::createFromTimestamp($totalSeconds)->format('H:i:s');
    }
    private function calculateStartDelayed($workingAreas)
    {
        $totalSeconds = 0;

        foreach ($workingAreas as $work) {
            $startDate = Carbon::parse($work->start_time);
            $endDate = Carbon::parse($work->start_time_real);
            $totalSeconds += $endDate->diffInSeconds($startDate);
        }

        return Carbon::createFromTimestamp($totalSeconds)->format('H:i:s');
    }

    private function calculateEndDelayed($workingAreas)
    {
        $totalSeconds = 0;

        foreach ($workingAreas as $work) {
            $startDate = Carbon::parse($work->end_time);
            $endDate = Carbon::parse($work->end_time_real);
            $totalSeconds += $endDate->diffInSeconds($startDate);
        }

        return Carbon::createFromTimestamp($totalSeconds)->format('H:i:s');
    }

    private function getCompletedTasksCount($userId, $isCompleted)
    {
        return DB::table('tasks')
            ->join('task_user', 'tasks.id', '=', 'task_user.task_id')
            ->where('task_user.user_id', $userId)
            ->where('tasks.finished', $isCompleted)
            ->count();
    }
    private function getDaysCount($workingArea)
    {
        return count($workingArea);
    }

    public function getWorkingAreas()
    {
        $user = User::findOrFail(Auth::id());

        //Vamos a añadirle a los workingAreas las duraciones estimadas y reales 
        $workingAreas = $user->working_areas()->whereHas('tasks', function ($query) {
            $query->where('finished', 1);
        })->get();

        foreach ($workingAreas as $workingArea) {
            $end_time_real = Carbon::createFromFormat('H:i:s', $workingArea->end_time_real);
            $start_time_real = Carbon::createFromFormat('H:i:s', $workingArea->start_time_real);
            $end_time = Carbon::createFromFormat('H:i:s', $workingArea->end_time);
            $start_time = Carbon::createFromFormat('H:i:s', $workingArea->start_time);

            $duration_minutes = $end_time->diffInMinutes($start_time);
            $duration_minutes_real = $end_time_real->diffInMinutes($start_time_real);
            if ($duration_minutes >= 60) {
                $duration = sprintf('%dh %02d m', floor($duration_minutes / 60), $duration_minutes % 60);
            } else {
                $duration = sprintf('%d m', $duration_minutes);
            }

            if ($duration_minutes_real >= 60) {
                $durationReal = sprintf('%dh %02d m', floor($duration_minutes_real / 60), $duration_minutes_real % 60);
            } else {
                $durationReal = sprintf('%d m', $duration_minutes_real);
            }

            $workingArea->duration = $duration;
            $workingArea->durationReal = $durationReal;
        }
        return view('analyticsTasks', @compact('workingAreas'));
    }
}
