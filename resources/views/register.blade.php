@extends('templates.loginTemplate')
@section('register')
<div class="limiter">

    <div class="container-login100" style="background-image: url({{URL::asset('fondo.jpg')}});">
        <div class="wrap-login100">
            <span class="login100-form-logo">
                <h1 class="brandH1">Oye como va</h1>
            </span>
            <form method="post" action="" class="login100-form validate-form">
                @csrf


                <span class="login100-form-title p-b-34 p-t-27">
                    Log in
                </span>

                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input name="usuario" type="email" class="input100" placeholder="Email">

                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input name="contrasea" type="password" class="input100" placeholder="Contraseña">

                </div>

                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
                @if($errors->any())
                <h4>{{$errors->first()}}</h4>
                @endif
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
