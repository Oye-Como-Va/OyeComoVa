@extends('templates.general')
@section('main')
    <div class="card" style="width: 18rem;">
        @if (count($course->subjects) > 0)
            <div class="card-body">
                <h5 class="card-title">Asignaturas del curso {{ $course->name }}</h5>
                <p class="card-text">
                    @foreach ($course->subjects as $subject)
                        <p>{{ $subject->name }}</p>
                    @endforeach
                </p>
              ¿Desea añadir <a class="modallink card-link" href="#modallink{{ $course->id }}" data-bs-toggle="modal"
                    data-bs-target="#modallink{{ $course->id }}">
                    una nueva asignatura?
                </a>
                <div class="modal fade" id="modallink{{ $course->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Crear nueva asignatura</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('create_subject') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nombre de la asignatura</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Asígnale un color</label>
                                        <input type="color" class="form-control" id="color" name="color" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Descripción del curso {{ $course->id }}</label>
                                        <textarea class="form-control" id="description" name="description" required></textarea>
                                    </div>

                                    <input id="course_id" name="course_id" value="{{ $course->id }}" hidden>
                                    <div class="form-group">
                                        <label for="qualification">Calificacion</label>
                                        <input type="num" class="form-control" id="qualification" name="qualification"
                                            required>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn bg-custom-dark text-white">Crear</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }} no tiene asignaturas</h5>
                    <a href="#" class="card-link" href="#modallink{{ $course->id }}"
                        data-bs-toggle="modal" data-bs-target="#modallink{{ $course->id }}">
                        ¿Desea crearla?
                    </a>
                    <div class="modal fade" id="modallink{{ $course->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Crear nueva asignatura</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('create_subject') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Nombre de la asignatura</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="color">Asígnale un color</label>
                                            <input type="color" class="form-control" id="color" name="color" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Descripción del curso {{ $course->id }}</label>
                                            <textarea class="form-control" id="description" name="description" required></textarea>
                                        </div>

                                        <input id="course_id" name="course_id" value="{{ $course->id }}" hidden>
                                        <div class="form-group">
                                            <label for="qualification">Calificacion</label>
                                            <input type="num" class="form-control" id="qualification" name="qualification"
                                                required>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn bg-custom-dark text-white">Crear</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
    </div>
    </div>

@endsection
