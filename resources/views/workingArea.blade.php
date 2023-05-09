@extends('templates.general')

@section('workingArea')
    <h4>Working Area</h4>

    @if (!isset($nextTask))
        <div class="d-flex flex-column justify-content-center align-items-center w-100 working-inactive">
            <h2>Actualmente no tiene tareas programadas</h2>
            <a href="{{ route('calendar') }}" class="text-info">Crear tarea</a>
        </div>
    @else
        <div class="workingContainer">
            <h4>Próxima tarea:</h4>
            <div class="workingStart">
                <div class="cardContainer">
                    <a class="card" href="#">
                        <div class="d-flex w-100 flex-row justify-content-between align-items-center p-3">
                            <p>{{ $nextTask->pivot->start_time }}</p>
                            <div class="cardContent d-flex align-items-center flex-column">
                                <p>Task 1</p>
                                <p>Subject name</p>
                                <p>Date?</p>
                            </div>
                            <p>11:30</p>
                            <div class="corner" href="#">
                                <div class="play">
                                    <i class='bx bx-play'></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            @if (count($orderedTasks) > 0)
                <h4>Próximas tareas:</h4>
                <div class="workingList">
                    @foreach ($orderedTasks as $task)
                        <div class="workingStart">
                            <div class="cardContainer">
                                <a class="card task">
                                    <div class="d-flex mt-4 flex-column w-100">
                                        <p class="align-self-end">
                                            Course name
                                        </p>
                                        <p class="align-self-end">
                                            Subject name
                                        </p>
                                        <p class="align-self-start">Tarea:
                                            {{ $task->name }}</p>
                                        <p class="align-self-start">Descripción:
                                            {{ $task->description }}

                                        <div class="corner" href="#">
                                            <div class="play">
                                                <div class="d-flex align-items-center justify-content-around">
                                                    <p>{{ date('d/m', strtotime($task->pivot->date)) }}</p>
                                                    <p>{{ substr($task->pivot->start_time, 0, 5) }} -
                                                        {{ substr($task->pivot->end_time, 0, 5) }}
                                                    </p>
                                                    <i class='bx bx-play'></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                </div>
            @endif
        </div>
        @if (count($delayedTasks) > 0)
            <h4>Tareas atrasadas:</h4>
            <div class="workingList">
                @foreach ($delayedTasks as $task)
                    <div class="workingStart">
                        <div class="cardContainer">
                            <a class="card task delayed">
                                <div class="d-flex mt-4 flex-column w-100">
                                    <p class="align-self-end">
                                        Course name
                                    </p>
                                    <p class="align-self-end">
                                        Subject name
                                    </p>
                                    <p class="align-self-start">Tarea:
                                        {{ $task->name }}</p>
                                    <p class="align-self-start">Descripción:
                                        {{ $task->description }}

                                    <div class="corner" href="#">
                                        <div class="play">
                                            <div class="d-flex align-items-center justify-content-around">
                                                <p>{{ date('d/m', strtotime($task->pivot->date)) }}</p>
                                                <p>{{ substr($task->pivot->start_time, 0, 5) }} -
                                                    {{ substr($task->pivot->end_time, 0, 5) }}
                                                </p>
                                                <i class='bx bx-play'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                @endforeach
            </div>
        @endif
    @endif

@endsection
