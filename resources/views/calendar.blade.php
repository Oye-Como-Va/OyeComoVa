@extends('templates.general')

@section('calendar')
    <h4 class="text-start">
        Calendario</h4>
    <div id='calendar'></div>
    <div class="modal fade" id="createTask" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Crear tarea</h5>
                    <button type="button" class="btn-close" data-bs-target="#createTask" data-bs-toggle="modal"
                        aria-label="Close">
                    </button>
                </div>
                <form id="formulario" action="{{ route('task.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                    <div class="modal-body row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tarea:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción:</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <div class="mb-3">
                                <label for="course" class="form-label">Curso: </label>
                                <select class="form-select" name="course" id="course"
                                    aria-label="Default select example" onchange="insertCourse()">
                                    <option> - </option>
                                    @if ($user->courses())
                                        {
                                        @foreach ($user->courses as $course)
                                            @if (!$course->isdefault)
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endif
                                        @endforeach
                                        }
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Asignatura: </label>
                                <select class="form-select" name="subject" id="subject"
                                    aria-label="Default select example">
                                    <option> - </option>
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
                                    onchange="checkHour(this)" required min="00:00" max="23:58">
                            </div>
                            <div class="mb-3">
                                <label for="end_time" class="form-label">Hora de fin: </label>
                                <input name="end_time" id="end_time" type="time" class="form-control" required
                                    onchange="checkHour(this)" min="00:00" max="23:59">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-info" type="submit">Crear tarea</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editTask" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Editar tarea</h5>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#editTask"
                        aria-label="Close">
                    </button>
                </div>
                <form id="formEdit" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="nameEdit" class="form-label">Nombre de la tarea:</label>
                                <input type="text" class="form-control" id="nameEdit" name="nameEdit" required>
                            </div>
                            <div class="mb-3">
                                <label for="descriptionEdit" class="form-label">Descripción:</label>
                                <input type="text" class="form-control" id="descriptionEdit" name="descriptionEdit"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="courseEdit" class="form-label">Curso: </label>
                                <select class="form-select" name="courseEdit" id="courseEdit"
                                    aria-label="Default select example" disabled>
                                    <option> - </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subjectEdit" class="form-label">Asignatura: </label>
                                <select class="form-select" name="subjectEdit" id="subjectEdit"
                                    aria-label="Default select example" disabled>
                                    <option> - </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="dateEdit" class="form-label">Fecha: </label>
                                <input name="dateEdit" id="dateEdit" type="date" class="form-control"
                                    readonly="readonly">
                            </div>
                            <div class="mb-3">
                                <label for="start_timeEdit" class="form-label">Hora de inicio: </label>
                                <input name="start_timeEdit" id="start_timeEdit" type="time" class="form-control"
                                    onchange="checkHour(this)" required min="00:00" max="23:58">
                            </div>
                            <div class="mb-3">
                                <label for="end_timeEdit" class="form-label">Hora de fin: </label>
                                <input name="end_timeEdit" id="end_timeEdit" type="time" class="form-control"
                                    required onchange="checkHour(this)" min="00:00" max="23:59">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end align-items-center gap-2">
                            <button class="btn btn-info" type="submit">Editar tarea</button>
                </form>
                <form method="POST" id="formDelete" class="d-flex m-0">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class='bx bxs-trash-alt'></i></button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
<script>
    //Variables que utiliza app.js: 
    let tasks = @json($tasks); //convierto a json las tareas para que las reciba el archivo app.js
    let urlUpdate = "{{ route('task.drag_drop', ['id' => 'taskId']) }}";
    let urlEdit = "{{ route('task.edit', ['id' => 'taskId']) }}";
    let urlSaveChanges = "{{ route('task.saveChanges', ['id' => 'taskId']) }}";
    let urlDelete = "{{ route('task.delete', ['id' => 'taskId']) }}";
    let tokenUpdate = "{{ csrf_token() }}";

    const checkHour = (element) => {
        //Reutilizamos la comprobación para el modal de editar y el de crear
        let startinput;
        let startTime;
        let endTime;
        let date;
        if (element.name.includes('Edit')) {
            startinput = document.getElementById('start_timeEdit');
            endTime = document.getElementById("end_timeEdit");
            date = document.getElementById("dateEdit").value;
        } else {
            startinput = document.getElementById('start_time');
            endTime = document.getElementById("end_time");
            date = document.getElementById("date").value;
        }

        startTime = startinput.value;
        date = new Date(date);

        //Controlamos que si la tarea es para hoy, como mínimo la hora de inicio es la hora actual: 
        let today = new Date(date).setHours(0, 0, 0, 0) === new Date().setHours(0, 0, 0, 0);
        if (today) {
            startinput.setAttribute('min', new Date().getHours() + ':' + new Date().getMinutes())
        }

        //Sumamos un minuto para establecer que hora de inicio y fin sean al menos de un minuto de dif
        let hour = new Date("2023-01-01T" + startTime);
        hour.setMinutes(hour.getMinutes() + 1);
        hour = hour.toTimeString().slice(0, 5);
        endTime.setAttribute("min", hour);
    }


    async function getSubjects(course) {
        try {
            let response = await fetch(`/home/courses/${course}/getSubjects`);
            let data = await response.json();
            return data;
        } catch (error) {
            console.log(error);
            return null;
        }
    }

    function insertCourse() {
        let course = document.getElementById("course").value;
        let subjectInput = document.getElementById('subject');
        subjectInput.options.length = 0; //borramos por si antes ya seleccionó otro curso

        getSubjects(course)
            .then((subjects) => {
                subjects.forEach(subject => {
                    let option = document.createElement("option");
                    option.value = subject.id;
                    option.text = subject.name;
                    subjectInput.appendChild(option);
                })
            })
            .catch((error) => {
                console.log(error);
            });
    }
</script>
