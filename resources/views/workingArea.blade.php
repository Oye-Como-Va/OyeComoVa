@extends('templates.general')

@section('workingArea')

    @if (!isset($nextTask))
        <div class="d-flex flex-column justify-content-center align-items-center w-100 working-inactive">
            <h2>Actualmente no tiene tareas programadas</h2>
            <a href="{{ route('calendar') }}" class="text-info">Crear tarea</a>
        </div>
    @else
        <div class="workingContainer">
            <div class="workingStart">
                <h4>Próxima tarea: {{ date('d/m', strtotime($nextTask->pivot->date)) }}</h4>
                <div class="cardContainer">
                    <a class="card" href="#"
                        @if (isset($nextTask->subjects)) style = "border: 2px solid {{ $nextTask->subjects->color }}" @endif>
                        <div class="d-flex w-100 flex-row justify-content-between align-items-center p-3">
                            <p> {{ substr($nextTask->pivot->start_time, 0, 5) }} </p>
                            <div class="cardContent d-flex align-items-center flex-column">
                                <p>{{ $nextTask->name }}</p>
                                @if (isset($nextTask->subjects))
                                    <p>{{ $nextTask->subjects->course->name }} / {{ $nextTask->subjects->name }}</p>
                                @endif

                            </div>
                            <p>{{ substr($nextTask->pivot->end_time, 0, 5) }}</p>
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
                                <a class="card task"
                                    @if (isset($task->subjects)) style = "border: 2px solid {{ $task->subjects->color }}" @endif>
                                    <div class="d-flex mt-4 flex-column w-100">
                                        @if (isset($task->subjects))
                                            <p class="align-self-end">
                                                {{ $task->subjects->course->name }}
                                            </p>
                                            <p class="align-self-end">
                                                {{ $task->subjects->name }}
                                            </p>
                                        @endif
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
                </div>
            @else
            @endif
            @if (count($delayedTasks) > 0)
                <h4>Tareas atrasadas:</h4>
                <div class="workingList">
                    @foreach ($delayedTasks as $task)
                        <div class="workingStart">
                            <div class="cardContainer">
                                <a class="card task delayed"
                                    @if (isset($task->subjects)) style = "border: 2px solid {{ $task->subjects->color }}" @endif>
                                    <div class="d-flex mt-4 flex-column w-100">
                                        @if (isset($task->subjects))
                                            <p class="align-self-end">
                                                {{ $task->subjects->course->name }}
                                            </p>
                                            <p class="align-self-end">
                                                {{ $task->subjects->name }}
                                            </p>
                                        @endif
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
                </div>
            @endif
        </div>
    @endif
@endsection
