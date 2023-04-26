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
                                <select class="form-select" name="subject" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
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
                                    onchange="comprobarHora()" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_time" class="form-label">Hora de fin: </label>
                                <input name="end_time" id="end_time" type="time" class="form-control" required
                                    onchange="comprobarHora()">
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

    const comprobarHora = () => {
        let startTime = document.getElementById("start_time").value;
        let endTime = document.getElementById("end_time");
        let divErrors = document.getElementById('errors');

        //! HAY QUE CONTROLAR QUE SI PONE 23 DE INICIO Y 00 DE FIN SALTA ESTE ERROR :( 
        endTime.setAttribute("min", startTime);

    }
</script>
