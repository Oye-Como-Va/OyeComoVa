@extends('templates.template')

@section('landing')
    <div class="welcome vh-100">
        <div
            class="d-flex justify-content-center align-items-center align-items-lg-start flex-column p-lg-5 gap-lg-3 p-2 gap-4 landing">
            <h1 class="header_title text-white">Oye cómo va</h1>
            <div class="text-center text-lg-start">
                <h4>Organiza tu tiempo, optimiza tu rendimiento.</h4>
                <h4> Y que la próxima vez que te pregunten: <i>Oye cómo va</i> puedas contestar ¡pitumba!</h4>
            </div>
            <a class="login100-form-btn" href={{ route('registro') }}>
                Únete ahora
            </a>
        </div>
        <img class="img-fluid" src="{{ URL::asset('img/landing.png') }}">
    </div>

    <div class="instructions vh-100">
        <div>
            <span>1</span>
            <img src=>
            <p>Planifica tu calendario por horas y tareas</p>
        </div>
        <div>
            <span>2</span>
            <p>Usa el Working Area para iniciar el tiempo
            </p>
        </div>
        <div>
            <span>3</span>
            <p>Comprueba tu rendimiento </p>
        </div>
    </div>

    <div class="invite vh-100">

    </div>
@endsection
