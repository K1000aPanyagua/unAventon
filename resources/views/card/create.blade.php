 

<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')

<header class="masthead bg-primary text-white text-center row">
      <h1 class="text-uppercase  col-sm-12">Cargar tarjeta</h1>
      <p class="separator-l col-sm-12"> * Campo obligatorio</p>
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @include('flash_message')
                    <form method="POST" action="{{ route('card.store') }}">
                        {{ csrf_field() }} 
                        <div class="form-group row">
                            <label for="nroCard" class="col-md-4 col-form-label text-md-right">{{ __('Número de tarjeta') }}*</label>

                            <div class="col-md-6">
                                
                                <input id="numCard" type="text" class="form-control{{ $errors->has('numCard') ? ' is-invalid' : '' }}" name="numCard" value="{{ old('numCard') }}" placeholder="Ingrese los 16 dígitos de su tarjeta..." required="required" autofocus oninvalid="this.setCustomValidity('El campo debe contener los 16 dígitos de la tarjeta')"
                                    oninput="setCustomValidity('')">
                                    <br>
                                @if ($errors->has('numCard'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('numCard') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiration" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de vencimiento') }}*</label>

                            <div class="col-md-6">
                                <input value="{{ old('expiration') }}" type="date" id="expiration" name="expiration" required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">
                                    <br><br>   
                                @if ($errors->has('expiration'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('expiration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
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
