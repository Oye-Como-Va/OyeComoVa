

<div class="limiter">

        <div class="container-login100" style="background-image: url({{ URL::asset('fondo.webp') }});">
            <div class="wrap-login100">
                <span class="login100-form-logo">
                    <h1 class="brandH1">Formulario Editar perfil</h1>
                </span>
                <form method="POST" action="{{ route('login') }}">
                    @csrf


                    <span class="login100-form-title p-b-34 p-t-27">
                        Editar
                    </span>

                    <div class="wrap-input100 validate-input">
                        <label for="name">Nombre</label>
                        <input  type="text" class="form-control" name="name">
                    
                    </div>

                    <div class="wrap-input100 validate-input">
                        <label for="surname">Apellidos</label>
                        <input  type="text" class="form-control" name="surname">
                    
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter email">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input">
                        <label for="phone">Telefono</label>
                        <input  type="text" class="form-control" name="phone">
                    
                    </div>
                    
                    
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            {{ __('Login') }}
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>