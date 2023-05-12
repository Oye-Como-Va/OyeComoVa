@extends('templates.loginTemplate')

@section('landing')
    <div class="welcome">
        <div
            class="d-flex justify-content-center align-items-center align-items-lg-start flex-column p-lg-5 gap-lg-3 p-2 gap-4 landing">
            <h1 class="header_title text-white">Oye cómo va</h1>
            <div class="text-center text-lg-start">
                <h4>Organiza tu tiempo, optimiza tu rendimiento.</h4>
                <h4> Y que la próxima vez que te pregunten: <i>Oye cómo va</i> puedas contestar ¡pitumba!</h4>
            </div>
            <div class="d-flex gap-3">
                <a class="login100-form-btn" href={{ route('registro') }}>
                    Únete ahora
                </a>
                <a class="login100-form-btn login" href={{ route('login') }}>
                    Inicia sesión
                </a>
            </div>
        </div>
        <img class="img-fluid" src="{{ URL::asset('img/landing.png') }}">
    </div>

    <div class="instructions">
        <div>
            <span>1</span>
            <img src="{{ URL::asset('img/planing.png') }}" class="img-fluid">
            <p>Planifica tu calendario por horas y tareas</p>
        </div>
        <div>
            <span>2</span>
            <img src="{{ URL::asset('img/workingArea.png') }}" class="img-fluid">
            <p>Usa el Working Area para iniciar el tiempo
            </p>
        </div>
        <div>
            <span>3</span>
            <img src="{{ URL::asset('img/analytics.png') }}" class="img-fluid">
            <p>Comprueba tu rendimiento </p>
        </div>
    </div>

    <div class="invite  text-center">

        <span class="login100-form-title p-b-34 p-t-27">
            Formulario de contacto
        </span>

        <p>Si tienes duda envianos la consulta</p>

        <form action="{{ route('contacto') }}" method="POST">
            {{ csrf_field() }}

            <div class="wrap-input100 validate-input">
                <label for="name">Nombre</label>
                <input  type="text" name="name" >
             
            </div>

            <div class="wrap-input100 validate-input">
                <label for="msg">Comentario</label>
                <input  type="text" name="msg" >
             
            </div>


          
         
            <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn">
                    Enviar
                </button>

            </div>
        </form>
    </div>


    <footer class="p-3">
        <p class="text-center text-muted p-0 m-0">© 2023 Oye cómo va</p>
    </footer>
@endsection
