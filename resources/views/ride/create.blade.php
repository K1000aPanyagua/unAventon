
<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')
<header class="masthead bg-primary text-white text-center row">
      <h1 class="text-uppercase  col-sm-12">Publicar viaje</h1>

      <p class="separator-l col-sm-12"> * Campo obligatorio</p>
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @include('flash_message')

<form method="POST" action="{{ route('ride.store') }}">
	{{ csrf_field() }}
	<label for="origin">Origen:</label>
	<input type="text" name="origin" id="origin" class="form-control{{ $errors->has('origin') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
	
	@if ($errors->has('origin'))
    	<span class="invalid-feedback">
    		<strong>{{ $errors->first('origin') }}</strong>
    	</span>
    @endif

	<br>
	<label for="destination">Destino:</label>
	<input type="text" name="destination" id="destination" class="form-control{{ $errors->has('destination') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
	
	@if ($errors->has('destination'))
    	<span class="invalid-feedback">
    		<strong>{{ $errors->first('destination') }}</strong>
    	</span>
    @endif

	<br>
	<label for="mount">Monto:</label>
	<input type="number" name="mount" id="mount" class="form-control{{ $errors->has('mount') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
	
	@if ($errors->has('mount'))
    	<span class="invalid-feedback">
    		<strong>{{ $errors->first('mount') }}</strong>
    	</span>
    @endif

	<br>
	<label for="duration">Duración:</label>
	<input type="time" name="duration" id="duration" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
	
	@if ($errors->has('duration'))
    	<span class="invalid-feedback">
    		<strong>{{ $errors->first('duration') }}</strong>
    	</span>
    @endif

	<br>
	<label for="departDate">Fecha de salida:</label>
	<input type="date" name="departDate" id="departDate" class="form-control{{ $errors->has('departDate') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
	
	@if ($errors->has('departDate'))
    	<span class="invalid-feedback">
    		<strong>{{ $errors->first('departDate') }}</strong>
    	</span>
    @endif

	<br>
	<label for="departHour">Hora de salida:</label>
	<input type="time" name="departHour" id="departHour" class="form-control{{ $errors->has('departHour') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
	
	@if ($errors->has('departHour'))
    	<span class="invalid-feedback">
    		<strong>{{ $errors->first('departHour') }}</strong>
    	</span>
    @endif

	<br>
	<label class="col-md-4 col-form-label text-md-right">Tarjeta*</label>
    <select name="idCard" id="idCard" required="required" class="form-control{{ $errors->has('idCard') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">	
    	<option value="">Seleccionar</option>
    	@foreach ($cards as $card)
        	<option  value="{{$card->id}}"> Tarjeta {{ $card->numCard }}</option>
        @endforeach
        
    </select>
    <br>
	<textarea name="remarks" id="remarks" placeholder="Observaciones..."></textarea>
	
	@if ($errors->has('remarks'))
    	<span class="invalid-feedback">
    		<strong>{{ $errors->first('remarks') }}</strong>
    	</span>
    @endif

	<br>
	<button type="submit" class="btn">Publicar</button>

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
