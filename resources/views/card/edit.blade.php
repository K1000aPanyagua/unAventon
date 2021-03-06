

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
                    <form method="POST" action="{{ action('CardController@update', ['id' => $card->id]) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="nroCard" class="col-md-4 col-form-label text-md-right">{{ __('Número de tarjeta') }}*</label>

                            <div class="col-md-6">
                                
                                <input value="" id="nroCard" type="string" class="form-control{{ $errors->has('nroCard') ? ' is-invalid' : '' }}" name="nroCard" value="{{ $card->nroCard }}" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

                                @if ($errors->has('nroCard'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nroCard') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiration" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de vencimiento') }}*</label>

                            <div class="col-md-6">
                                <input value="{{$card->expiration}}" type="date" id="expiration" name="expiration" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">*

                                @if ($errors->has('expiration'))
                                    <span class="invalid-feedback">
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
                     <a class="btn btn-primary rounded-pill" href="{{route('card.destroy', ['id'=> $card->id])}}">
          Eliminar tarjeta
          </a> 
                </div>
            </div>
</div>
</header>


<!--fin header-->
@include('footer')

@include('javascript')
</body>
</html>
