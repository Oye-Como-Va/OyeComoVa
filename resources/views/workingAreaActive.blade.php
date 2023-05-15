@extends('templates.general')

@section('workingAreaActive')
    <div class="workingArea d-flex flex-column gap-3 mt-5">
        <div class="row py-4">
            <div class="col-6">
                <h5 class="h5-0 m-0">Tarea: {{ $task->name }} </h5>
                <h5 class="h5-0 m-0">Descripción: {{ $task->description }}</h5>
                <h5 class="h5-0 m-0">Duración: <span id="duration"></span></h5>
            </div>
            @if (isset($task->subjects))
                <div class="text-end col-6 d-flex text-end flex-column">
                    <h5 class="h5-0 m-0">{{ $task->subjects->course->name }}</h5>
                    <h5 class="h5-0 m-0 d-flex flex-row align-self-end align-items-center gap-2"><i class="bx bxs-circle"
                            style="color: {{ $task->subjects->color }}"></i>{{ $task->subjects->name }}</h5>
                </div>
            @endif
        </div>

        <div class="timeControl">
            <div class="d-flex flex-column align-items-center">
                {{-- Hora inicio programada:  --}}
                <span class="p-0 m-0 d-none" id="start_time">{{ substr($task->pivot->start_time, 0, 5) }}</span>
                {{-- Hora real de inicio: --}}
                <p class="p-0 m-0">INICIO</p><span class="p-0 m-0 text-info"
                    id="start_time_real">{{ substr($start_time_real, 0, 5) }}</span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">TRANSCURRIDO</p>
                <span class="p-0 m-0 text-warning" id="transcurrido">
                    <span id="transcurrido_hours"></span>
                    <span>:</span>
                    <span id="transcurrido_minutes"></span>
                </span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">RESTANTE</p>
                <span class="p-0 m-0 text-warning" id="transcurrido">
                    <span id="restante_hours"></span>
                    <span>:</span>
                    <span id="restante_minutes"></span>
                </span>
            </div>
            <div class="d-flex flex-column align-items-center">
                {{-- Hora programada:  --}}
                <span class="p-0 m-0 text-success d-none" id="end_time">{{ substr($task->pivot->end_time, 0, 5) }}</span>
                {{-- Nueva hora calculada según la hora que empezó --}}
                <p class="p-0 m-0 ">FIN</p><span class="p-0 m-0 text-success" id="expected_end"></span>
            </div>
        </div>

        <div class="notesArea">
            <ul id="notes">
                <li>
                    <a href="#" class="add-item justify-content-center align-items-center">
                        <i class='bx bx-plus fw-bold'></i>
                    </a>
                </li>
            </ul>
        </div>
        <form action={{ route('end_task') }} method="POST" class="align-self-end">
            @csrf
            <input type="hidden" value={{ $task->id }} name="task_id" />
            <input type="hidden" value={{ $working_id }} name="working_id" />
            <button type="submit" class="btn btn-danger">TERMINAR</button>
        </form>
    </div>
    @vite(['resources/js/workingArea.js'])
@endsection
<script>
    const working_id = "{{ $working_id }}";
    const urlNote = "{{ route('create_note') }}";
    const token = "{{ csrf_token() }}";
</script>
