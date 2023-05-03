@extends('templates.general')

@section('workingAreaActive')
    <h1 class = "text-center">Working Area</h1>
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

        @if(count($tasks)<0)
            <p>No tenemos ninguna tarea creada</p>
            <a href="{{ route('calendar')}}">Crear tare</a>

            @else

            @foreach($tasks as $task)
            <p>{{$task->name}}</p>
            <p>{{$task->description}}</p>
            <p>{{$task->subject_id}}</p>
            <p>{{$task->pivot->date}}</p>
            <p>{{$task->pivot->start_time}}</p>
            <p>{{$task->pivot->end_time}}</p>
            <a href="" target="_blank" rel="">iniciar</a>
            
            @endforeach
        @endif

    </div>
    @endsection
    