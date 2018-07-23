<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    @include('flash_message')
    <h1 class="text-uppercase separator-l col-sm-12">Resultados de la busqueda:</h1>  
    {{dd($rides)}}
    @foreach($rides as $ride)
      <div class="row" >

          Origen: {{ $ride->origin }} Destino: {{ $ride->destination}} 
          Fecha de salida: {{$ride->departDate}} Hora de salida: {{$ride->departHour}}
          Monto: {{$ride->amount}}

      </div>
    @endforeach
    <div class="col-lg-4 offset-4">
        <a class="btn btn-xl btn-outline-light text-center color-aventon" href="/configurationAccount">
          Volver
        </a>
    </div>
  </div>
</header>




<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>
