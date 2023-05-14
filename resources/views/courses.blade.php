@extends('templates.general')
@section('main')
    <h1>Cursos disponibles: {{ count($courses) }}</h1>
    <div class="row gap-2 align-self-center justify-self-center">
        @foreach ($courses as $curso)
            <div class="carta @if ($curso->isdefault == 1) isdefault @endif col-md-4 col-sm-12">
                <div class="imgBx">
                    <div class="icon d-flex flex-column justify-content-center xd">
                        @if ($curso->isdefault == 1)
                            <div class="card-header h2 py-2 mb-2 bg-custom w-100 text-center rounded">
                                Curso predeterminado
                            </div>
                        @else
                            <div class="card-header h2 py-3 mb-2 bg-custom-dark w-100 text-center rounded">
                                Curso propio
                            </div>
                        @endif
                        <div class="card-body text-center">
                            <p>{{ $curso->name }}</p>
                            <p>{{ $curso->description }}</p>
                            <a href="{{ route('subjects', $curso->id) }}"
                                class="btn @if ($curso->isdefault == 1) bg-custom @else bg-custom-dark @endif">Ver
                                asignaturas</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modallink{{ $curso->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                    <label for="description">Descripción del curso {{ $curso->id }}</label>
                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>

                                <input id="course_id" name="course_id" value="{{ $curso->id }}" hidden>
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
        @endforeach

        <div class="carta col-4">
            <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <div class="imgBx d-flex justify-content-center align-items-center text-center">
                    <div class="d-flex justify-content-center align-items-center text-center">

                        <h5>CREAR CURSO</h5>
            </button>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Crear nuevo curso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('create_course') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nombre del curso</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción del curso</label>
                                    <textarea class="form-control" id="description" name="description" required></textarea>
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
    </div>
    </div>

    </div>
@endsection
