<form method="POST" action="{{ route('ride.store') }}">
	{{ csrf_field() }}
	<label for="origin">Origen:</label>
	<input type="text" name="origin" id="origin">
	<br>
	<label for="destination">Destino:</label>
	<input type="text" name="destination" id="destination">
	<br>
	<label for="mount">Monto:</label>
	<input type="number" name="mount" id="mount">
	<br>
	<label for="duration">Duración:</label>
	<input type="time" name="duration" id="duration">
	<br>
	<label for="departDate">Fecha de salida:</label>
	<input type="date" name="departDate" id="departDate">
	<br>
	<label for="departHour">Hora de salida:</label>
	<input type="time" name="departHour" id="departHour">
	<br>
	<label class="col-md-4 col-form-label text-md-right">Tarjeta*</label>
    <select name="idCard" id="idCard" required="required">
    		<option value="">Seleccionar</option>
    	@foreach ($cards as $card)
        	<option  value="{{$card->id}}"> Tarjeta {{ $card->numCard }}</option>
        @endforeach
        
    </select>
    <br>
	<textarea name="remarks" id="remarks" placeholder="Observaciones..."></textarea>
	<br>
	<button type="submit">Publicar viajecito</button>

</form>