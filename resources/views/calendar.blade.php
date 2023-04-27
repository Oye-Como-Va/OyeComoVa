@extends('templates.general')

@section('calendar')

    <h4 class="text-start">Calendario</h4>
    <div id='calendar'></div>
    <div class="modal fade" id="createTask" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Crear tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="formulario" action="{{ route('task.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                    <div class="modal-body row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="task" class="form-label">Tarea:</label>
                                <input type="text" class="form-control" id="task" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción:</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Asignatura: </label>
                                <select class="form-select" name="subject" id="subject"
                                    aria-label="Default select example">
                                    <option> - </option>
                                    @if ($user->courses())
                                        {
                                        @foreach ($user->courses as $course)
                                            @if ($course->isdefault)
                                                @foreach ($course->subjects as $subject)
                                                    <option value="{{ $subject->id }}">{{ $subject->name }}
                                                        ({{ $course->name }})
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        }
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">Fecha: </label>
                                <input name="date" id="date" type="date" class="form-control"
                                    readonly="readonly">
                            </div>
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Hora de inicio: </label>
                                <input name="start_time" id="start_time" type="time" class="form-control"
                                    onchange="checkHour()" required min="00:00" max="23:58">
                            </div>
                            <div class="mb-3">
                                <label for="end_time" class="form-label">Hora de fin: </label>
                                <input name="end_time" id="end_time" type="time" class="form-control" required
                                    onchange="checkHour()" min="00:00" max="23:59">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3" id="errors"></div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-info" type="submit">Crear tarea</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
@endsection
<script>
    let tasks = @json($tasks); //convierto a json las tareas para que las reciba el archivo app.js

    const checkHour = () => {
        let startTime = document.getElementById("start_time").value;
        let endTime = document.getElementById("end_time");
        let divErrors = document.getElementById('errors');

        //Sumamos un minuto para establecer que hora de inicio y fin sean al menos de un minuto de dif
        let hour = new Date("2023-01-01T" + startTime);
        hour.setMinutes(hour.getMinutes() + 1);
        hour = hour.toTimeString().slice(0, 5);

        endTime.setAttribute("min", hour);
    }

    
</script>
