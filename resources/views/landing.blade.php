@extends('templates.template')

@section('landing')
    <div class="d-flex justify-content-center flex-column align-items-center vh-100">
        <h1 class="header_title">Oye cómo va</h1>
        <p>Organiza tu tiempo, optimiza tu rendimiento</p>
        <p>Y que la próxima vez que te pregunten: <i>Oye cómo va</i> puedas contestar Pitumba</p>
    </div>
    <div class="vh-100 bg-info d-flex flex-lg-row flex-column justify-content-around align-items-center gap-5 p-5">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <p>1</p>
            <p>Planifica tu calendario añadiendo tareas</p>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <p>2</p>
            <p>Entra en tu Working Area para poner en marcha tus tareas. Toma notas mientras nosotros registramos tu tiempo
            </p>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <p>4</p>
            <p>Sácale partido a nuestras herramientas: añade cursos, consulta estadísticas </p>
        </div>
    </div>
@endsection
