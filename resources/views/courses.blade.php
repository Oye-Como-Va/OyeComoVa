@extends('templates.general')
@section('main')
    <div class="main">
        <h1>Cursos disponibles: {{ count($courses) }}</h1>
        <div class="row">
            @foreach ($courses as $curso)
                <div class="carta">
                    <div class="imgBx">
                        <div class="icon d-flex flex-column justify-content-center">
                            <p>{{ $curso->name }}</p>
                            <p>{{ $curso->description }}</p>


                            <p><strong>Asignaturas:</strong></p>
                            @if (count($curso->subjects) > 0)
                                @foreach ($curso->subjects as $subject)
                                    <p>{{ $subject->name }}</p>
                                @endforeach
                            @else
                                <p>Este curso no tiene asignaturas. ¿Desea agregarlas?</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="carta">
                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <div class="imgBx d-flex justify-content-center align-items-center text-center">
                    <div class="d-flex justify-content-center align-items-center text-center">

                                <h5>CREAR CURSO</h5>
                        </button>

                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Crear nuevo curso</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('create_course') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Nombre del curso</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Descripción del curso</label>
                                                <textarea class="form-control" id="description" name="description" required></textarea>
                                            </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Crear</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
