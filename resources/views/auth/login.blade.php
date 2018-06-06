<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')
@include('flash_message')

<header class="masthead bg-primary text-white text-center row">
      <h1 class="text-uppercase separator-m col-sm-12">Iniciar sesion</h1>
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
          
                    <form method="POST" action="{{ action('Auth\LoginController@postLogin') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-left">{{ __('Email:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" name="email" value="{{ old('email') }} " required autofocus placeholder="e-mail" oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pass" class="col-md-4 col-form-label text-md-left">{{ __('Contraseña:') }}</label>

                            <div class="col-md-6">
                                <input class="form-control{{ $errors->has('pass') ? ' is-invalid' : '' }} form-control-lg" type="password" placeholder="contraseña" name="pass" required oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">
                             
                                @if ($errors->has('pass'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('pass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 separator-top-s">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar sesión') }}
                                </button>                   
                              </a>
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


