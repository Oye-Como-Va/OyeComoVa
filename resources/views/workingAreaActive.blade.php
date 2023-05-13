@extends('templates.general')

@section('workingAreaActive')
    <div class="d-flex flex-row justify-content-between px-4">
        <div>
            <h5 class="h5-0 m-0">{{ $task['name'] }}</h5>
            <h5 class="h5-0 m-0">{{ $task['description'] }}</h5>
        </div>
        <div class="text-end">
            <h5 class="h5-0 m-0">{{ $task['course'] }}</h5>
            <h5 class="h5-0 m-0 d-flex flex-row align-items-center gap-2"><i class="bx bxs-circle"
                    style="color: {{ $taskInfo->subjects->color }}"></i>{{ $task['subject'] }}</h5>
        </div>
    </div>
    <div class="workingArea">
        <div class="timeControl">
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">INICIO</p><span class="p-0 m-0">{{ $task['start_time'] }}</span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">TRANSCURRIDO</p><span class="p-0 m-0 text-warning">00:50:01</span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">RESTANTE</p><span class="p-0 m-0 text-danger">00:10:23</span>
            </div>
            <div class="d-flex flex-column align-items-center">
                <p class="p-0 m-0">FIN</p><span class="p-0 m-0 text-success">{{ $task['end_time'] }}</span>
            </div>
        </div>
    </div>
    <div class="notesArea">
        <div class="note">

        </div>
    </div>
    <form action={{ route('end_task') }} method="POST">
        @csrf
        <input type="hidden" value={{ $task['id'] }} name="task_id" />
        <input type="hidden" value={{ $working_id }} name="working_id" />
        <button type="submit">TERMINAR</button>
    </form>
@endsection
