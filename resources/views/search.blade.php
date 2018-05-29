<!DOCTYPE html>
<html lang="es">
@include('head')
<body id="page-top" class="container-fluid">

@include('menu')

<header class="masthead bg-primary text-white row">
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
      			<h5>Fecha salida: </h5><input type="text" name="passconf" value="" size="50" />

<input type="text" name="datetimes" />

<script>
$(function() {
  $('input[name="datetimes"]').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'M/DD hh:mm A'
    }
  });
});
</script>
      		</div>
      		<div class="col-4 search-form-item">
      			<h5>Email: </h5><input type="text" name="email" value="" size="50" />
      		</div>
      	</div>
      </div>
</header>




@include('copyrigtharrow')
@include('javascript')
</body>
</html>