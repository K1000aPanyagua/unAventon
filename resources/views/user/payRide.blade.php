<!DOCTYPE html>
<html lang="es">

@include('head')
@include('menu')
<body id="page-top" class="container-fluid">
<!--Body -->
<header class="masthead bg-primary text-white text-left row">
  <div class="col-sm-12 text-center">
  	@include('flash_message')
	<form method="POST" action="{{ route('user.pay', $ride->id, $card->expiration) }}">
	  {{ csrf_field() }} {{ method_field('POST') }}
      
      <div class="form-group separator-s" >
        <label class="col-form-label text-md-right">Seleccionar tarjeta:</label>
        <select name="card" id="card" required="required" class="form-control{{ $errors->has('card') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">	
    	  <option value="">Seleccionar</option>
    	  @foreach ($cards as $card)
          <option  value="{{$card->id}}"> Tarjeta {{ $card->numCard }}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group separator-s" >
        <label class="col-form-label text-md-right">Fecha de vencimiento:</label>   
        <input type="date" name="fecha-vencimiento"><br>
      </div>
      <div class="form-group separator-s" >
        <label class="col-form-label text-md-right">Nombre:</label>   
        <p>(Tal como aparece en la tarjeta)</p>
        <input type="text" name="name"><br>
      </div><div class="form-group separator-s" >
        <label class="col-form-label text-md-right">Codigo de seguridad:</label>   
        <input type="number" name="securitycode"><br>
      </div>



      <br>
	  <button type="submit" class="btn btn-primary">Pagar</button>
	</form>
  </div>
</header>

<!--fin header-->
@include('footer')
@include('javascript')
</body>
</html>