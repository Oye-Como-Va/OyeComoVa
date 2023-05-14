@extends('templates.general')
@section('main')
    <h1>Estadísticas</h1>
    <div class="row mt-5 analyticsTasks">
        @foreach ($workingAreas as $workingArea)
            <div class="col-md-6 col-lg-4 col-sm-12 mb-4">
                <div class="card w-100 boxshadow">
                    <div class="card-body">
                        @if (isset($workingArea->tasks->subjects))
                            <h6 class="text-end">{{ $workingArea->tasks->subjects->course->name }}</h6>
                            <h6 class="d-flex gap-1 align-items-center justify-content-end"><i class="bx bxs-circle"
                                    style="color: {{ $workingArea->tasks->subjects->color }}"></i>
                                {{ $workingArea->tasks->subjects->name }}</h6>
                        @endif
                        <h5 class="card-title pt-3">Tarea: {{ $workingArea->tasks->name }}</h5>
                        <p>Descripción: {{ $workingArea->tasks->description }}</p>
                        <p>Programada: {{ $workingArea->start_time }} - {{ $workingArea->end_time }}</p>
                        <p>Tiempo real: {{ $workingArea->start_time_real }} - {{ $workingArea->end_time_real }}</p>
                        <p>Duración programada: {{ $workingArea->duration }}</p>
                        <p>Duración real: {{ $workingArea->durationReal }}</p>
                        <p>Notas:</p>
                        <div class="px-3 pb-2">
                            @foreach ($workingArea->notes as $note)
                                <div class="d-flex flex-row gap-2 align-items-center"><i class="bx bxs-circle"
                                        style="color: {{ $note->color }}"></i>
                                    {{ $note->note }} ({{ $note->time }})</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
