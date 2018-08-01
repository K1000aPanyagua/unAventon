<!DOCTYPE html>
<html lang="es">
@include('head')
<body id="page-top" class="container-fluid">

@include('menu')

<header class="masthead background-w-imagebgprimary text-white row" style="background-image: url('{{ asset('assets/autos.jpg') }}')">
    <form method="GET" action="{{action('RideController@getBy')}}">  
      <div class="col-12">
      	<h3 class="m-left"> Buscar por: </h3>

      	<div class="row color-aventon-bk">
      		<div class="col-4 search-form-item">
      			<h5>Destino: </h5> <input class="form-control" type="text" name="destination" value="" size="50" />
      		</div>
      		<div class="col-4 search-form-item">
      			<h5>Origen: </h5><input class="form-control" type="text" name="origin" value="" size="50" />
      		</div>
      		<div class="col-4 search-form-item">
      			<h5>Fecha salida: </h5><input class="form-control" type="date" name="departDate" min="1950-01-01" max="2020-01-01">
      	    </div>
      	    <div class="col-4 search-form-item">
      			<h5>Fecha llegada: </h5><input class="form-control" type="date" name="endDate" min="1950-01-01" max="2020-01-01">
      	    </div>
      	    <div class="col-4 search-form-item">
      			<h5>Tipo de vehiculo: </h5>
      			  <select name="kind" >
                <option value="">Seleccionar</option>
                <option value="camioneta" @if (old('kind')== "camioneta") {{ 'selected' }} @endif>Camioneta</option>
                <option value="auto" @if (old('kind')== "auto") {{ 'selected' }} @endif>Auto</option>
                <option value="camion" @if (old('kind')== "camion") {{ 'selected' }} @endif>Camión</option>
              </select>
      	    </div>
            <div class="col-4 search-form-item">
            <h5>Asientos disponibles: </h5><input class="form-control" type="number" name="numSeats">
            </div>
            <div class="col-4 search-form-item">
            <h5>Monto: </h5><input class="form-control" type="number" step="0.1" name="amount" min="1950-01-01" max="2020-01-01">
            </div>
      	 </div>

      </div>
      <div class="col-sm-12 separator-both-s text-center">
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </form>
  </header>
@include('copyrigtharrow')
@include('javascript')
</body>
</html>

