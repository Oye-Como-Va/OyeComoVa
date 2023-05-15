@extends('templates.general')
@section('main')


        <h1>Tus analíticas</h1>

        <div class="row mt-5">
            <div class="col-md-6 col-lg-4 col-sm-12 mb-4">
                <div class="card w-100 boxshadow">
                    <div class="card-body">
                        <h5 class="card-title">Días totales trabajados</h5>
                        <p class="card-text colorCustom">{{ $totalDaysWorked }}</p>
                    </div>

                </div>
            </div>

        <div class="col-md-6 col-lg-4 col-sm-12 mb-4">
            <div class="card w-100 boxshadow">
                <div class="card-body">
                    <h5 class="card-title">Tiempo total programado</h5>
                    <p class="card-text colorCustom">{{ $programedTime }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-sm-12 mb-4">
            <a class="card w-100 boxshadow" href={{ route('analyticsTasks') }}>
                <div class="card-body">
                    <h5 class="card-title">Número de tareas completadas</h5>
                    <p class="card-text colorCustom">{{ $completedTasksCount }}</p>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6 col-sm-12 mb-4">
            <div class="card w-100 boxshadow">
                <div class="card-body">
                    <h5 class="card-title">Número de tareas pendientes</h5>
                    <p class="card-text colorCustom">{{ $pendingTasksCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 mb-4">
            <div class="card w-100 boxshadow">
                <div class="card-body">
                    <h5 class="card-title">Horas totales trabajadas</h5>
                    <p class="card-text colorCustom">{{ $workingTime }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6 col-lg-4 col-sm-12 mb-4">
            <div class="card w-100 boxshadow">
                <div class="card-body">
                    <h5 class="card-title">Número de tareas atrasadas</h5>
                    <p class="card-text colorCustom">{{ $delayedTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-sm-12 mb-4">
            <div class="card w-100 boxshadow">
                <div class="card-body">
                    <h5 class="card-title">Tiempo total de retraso al empezar las actividades</h5>
                    <p class="card-text colorCustom">{{ $startDelayedTime }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-sm-12 mb-4">
            <div class="card w-100 boxshadow">
                <div class="card-body">
                    <h5 class="card-title">Tiempo total de actividades acabadas antes de tiempo</h5>
                    <p class="card-text colorCustom">{{ $endDelayedTime }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
