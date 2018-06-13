

<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menuregistrarse')

<header class="masthead bg-primary text-white text-center row">
      <h1 class="text-uppercase  col-sm-12">Registrate</h1>

      <p class="separator-l col-sm-12"> * Campo obligatorio</p>
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @include('flash_message')
                    <form method="POST" action="{{ action('Auth\RegisterController@register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}*</label>

                            <div class="col-md-6">
                                
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}*</label>

                            <div class="col-md-6">
                                <input id="lastname" type="string" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}*</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pass" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}*</label>

                            <div class="col-md-6">
                                <input id="pass" type="password" class="form-control{{ $errors->has('pass') ? ' is-invalid' : '' }}" name="pass" required oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

                                @if ($errors->has('pass'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('pass') }}</strong>
                                    </span>
                                @endif
                        </div>
                        </div>

                            <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}*</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required oninput="check2(this)">
                            </div>
                                 <script language='javascript' type='text/javascript'>
                                    function check2(input) {
                                        if (input.value != document.getElementById('pass').value) {
                                            input.setCustomValidity('Las contraseñas deben coincidir.');
                                        } else {
                                            // input is valid -- reset the error message
                                            input.setCustomValidity('');
                                        }
                                    }
                                </script>

                        </div>
                            <label class="col-md-4 col-form-label text-md-right">Género*</label>
                            <select name="gender" required="required">
                                <option value="">Seleccionar</option>
                                <option value="M" @if (old('gender')== "M") {{ 'selected' }} @endif>Masculino</option>
                                <option value="F" @if (old('gender')== "F") {{ 'selected' }} @endif>Femenino</option>
                            </select>

                            <div class="form-group row">
                                <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                                <div class="col-md-6">
                                    <input id="telephone" value="{{ old('telephone') }}" type="string" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" >

                                    @if ($errors->has('telephone'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('telephone') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <label for="birthdate" class="col-md-4 col-form-label text-md-right">Fecha de nacimiento*</label>
                        <input id="birthdate" type="date" value="{{ old('birthdate') }}" name="birthdate" min="1950-01-01" max="2000-01-01" required="required">
                        <br>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
</div>
</header>


<!--fin header-->
@include('footer')
@include('modal')
@include('javascript')
</body>
</html>
