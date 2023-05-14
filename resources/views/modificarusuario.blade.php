

@extends('templates.loginTemplate')
@section('register')
    <div class="limiter">

        <div class="container-login100" style="background-image: url({{ URL::asset('fondo.webp') }});">
            <div class="wrap-login100">
                <span class="login100-form-logo">
                    <h1 class="brandH1">Oye como va</h1>
                </span>
                <form method="POST" action="{{route('user-profile-information.update')}}">

                    @method('PUT')
                    @csrf


                    <span class="login100-form-title p-b-34 p-t-27">
                        Editar usuario
                    </span>
                    
                    <div class="wrap-input100 validate-input">
                        <label for="name">Nombre</label>
                        <input  type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                    
                    </div>

                    <div class="wrap-input100 validate-input">
                        <label for="surname">Apellido</label>
                        <input  type="text" class="form-control" name="surname" id="surname" value="{{$user->surname}}">
                    
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter email">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="wrap-input100 validate-input">
                        <label for="phone">Telefono</label>
                        <input  type="text" class="form-control" name="phone" id="phone" value="{{$user->phone}}">
                    
                    </div>

                    <div class="wrap-input100 validate-input">
                        <label for="img">Imagen: </label>
                        <input type="file" name="img" id="img" class="form-control" autofocus required value="{{$user->profile_image}}">
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Modificar
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
@endsection