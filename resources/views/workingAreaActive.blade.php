@extends('templates.general')

@section('workingAreaActive')
    <h4 class = "text-start">Working Area</h4>
    <div class="workingArea">
        <div class="timeControl">
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">INICIO</p><span class="p-0 m-0">10:30</span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">TRANSCURRIDO</p><span class="p-0 m-0 text-warning">00:50:01</span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">RESTANTE</p><span class="p-0 m-0 text-danger">00:10:23</span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">FIN</p><span class="p-0 m-0 text-success">11:30</span>
            </div>
        </div>
        
    </div>
    <div class="card-body text-center">
        @foreach($tasks as $task)
        @if(empty($task))
            <p>No tenemos ninguna tarea creada</p>

        
            
        @else
        <p>{{ $task->name }}</p>
        <p>{{ $task->description }}</p> 
        @endif
        
        
        @endforeach
    </div>
    @endsection
    