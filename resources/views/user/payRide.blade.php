<!DOCTYPE html>
<html>
<head>
	<title>
		Pagar viaje
	</title>
</head>
<body>
	@include('flash_message')
	<form method="POST" action="{{ route('user.pay', $ride) }}">
		{{ csrf_field() }}
		{{ method_field('POST') }}

		<label class="col-md-4 col-form-label text-md-right">Seleccionar tarjeta:</label>
    	<select name="card" id="card" required="required" class="form-control{{ $errors->has('card') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">	
    	<option value="">Seleccionar</option>
    	@foreach ($cards as $card)
        	<option  value="{{$card->id}}"> Tarjeta {{ $card->numCard }}</option>
        @endforeach
        
    </select>

    <br>
	<button type="submit" class="btn btn-primary">Pagar</button>
	</form>

</body>
</html>