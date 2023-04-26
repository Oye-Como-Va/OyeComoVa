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
                <form id="formulario">
                    <div class="modal-body row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="task" class="form-label">Tarea:</label>
                                <input type="text" class="form-control" id="task">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción:</label>
                                <input type="text" class="form-control" id="description">
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
                                <input name="date" id="date" type="date" class="form-control" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Hora de inicio: </label>
                                <input name="start_time" id="start_time" type="time" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="end_time" class="form-label">Hora de inicio: </label>
                                <input name="end_time" id="end_time" type="time" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-info" type="submit">Crear tarea</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        </form>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let myModal = new bootstrap.Modal(document.getElementById('createTask'), {
                backdrop: 'static'
            });
            console.log(myModal)
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: '80vh',
                locale: 'es',
                headerToolbar: {
                    center: 'title',
                    right: 'dayGridMonth timeGridWeek'
                },
                dateClick: function(info) {
                    document.getElementById('date').value = info.dateStr;
                    myModal.show();
                },
            });
            calendar.render();
        });
    </script>
@endsection
