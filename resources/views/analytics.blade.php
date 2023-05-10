@extends('templates.general')
@section('main')
<p>Dias totales trabajados: {{$totalDaysWorked}}</p>
<p>Número de horas programadas: {{$programedTime}} </p>
<p>Número de tareas completadas: {{$completedTasksCount }}</p>
<p>Número de tareas pendientes: {{$pendingTasksCount }}</p>
<p>Número de tareas atrasadas: {{$delayedTasks }}</p>
<p>Horas totales trabajadas: {{$workingTime}}</p>
<p>Tiempo total de retraso al empezar las actividades: {{$startDelayedTime}}</p>
<p>Tiempo total de actividades acabadas antes de tiempo: {{$endDelayedTime}}</p>
@endsection
