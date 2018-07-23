<!DOCTYPE html>
<html lang="es">

@include('head')


<body id="page-top" class="container-fluid">
<!--Body -->

@include('menu')
<header class="masthead bg-primary text-white text-center row">
      
    <h1 class="text-uppercase  col-sm-12">Resetear <br> contraseña</h1>
    
    <div class="container text-center">
        <div class="row justify-content-center">
        <div class="col-md-8">
          @include('flash_message')

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ action('Auth\ForgotPasswordController@sendResetLinkEmail')  }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Enviar
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
@include('javascript')
</body>
</html>
