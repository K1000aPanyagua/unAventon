<!DOCTYPE html>
<html lang="es">
@include('head')
<body id="page-top" class="container-fluid">

@include('menu')

<header class="masthead background-w-imagebgprimary text-white row" style="background-image: url('{{ asset('assets/autos.jpg') }}')">
      <div class="col-12">
      	<h3 class="m-left"> Buscar por: </h3>
      	<div class="row color-aventon-bk">
      		<div class="col-4 search-form-item">
      			<h5>Destino: </h5> <input type="text" name="destino" value="" size="50" />
      		</div>
      		<div class="col-4 search-form-item">
      			<h5>Origen: </h5><input type="text" name="origen" value="" size="50" />
      		</div>
      		<div class="col-4 search-form-item">
      			<h5>Fecha salida: </h5><input type="date" name="fecha salida" min="1950-01-01" max="2020-01-01">
      	    </div>
      	    <div class="col-4 search-form-item">
      			<h5>Fecha llegada: </h5><input type="date" name="fecha llegada" min="1950-01-01" max="2020-01-01">
      	    </div>
      	    <div class="col-4 search-form-item">
      			<h5>Tipo de vehiculo: </h5>
      			  <select>
      			  	<option value="camioneta">Camioneta</option>
                    <option value="auto">Auto</option>
                    <option value="camion">Camión</option>
                    <option value="sin preferencia">Sin preferencia</option>
      			  </select>
      	    </div>
            <div class="col-4 search-form-item">
            <h5>Asientos disponbibles: </h5><input type="number" name="asientos">
            </div>
      	 </div>
      </div>
  </header>
@include('modal')
@include('copyrigtharrow')
@include('javascript')
</body>
</html>