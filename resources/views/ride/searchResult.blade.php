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
    
    @if ($rides instanceof Illuminate\Support\Collection)
      <div class="col-sm-12">
  
    @foreach ($rides as $ride)
      <tr>

        <a href="{{route('ride.show', $ride->id)}}">
          <div class="container-ride row separator-both-s">
            <td>
              <div class="col-md-4 col-sm-12 row">
                <h5 class="col-sm-6">Origen: </h5> <p class="col-sm-6 text-left">{{$ride->origin}}</p> 
              </div>
              <div class="col-md-4 col-sm-12 row">
                <h5  class="col-sm-6">Destino:</h5> <p class="col-sm-6 text-left">{{$ride->destination}}</p>
              </div>
              <div class="col-md-4 col-sm-12 row">
                <h5  class="col-sm-8">Fecha y hora de salida:</h5> <p class="col-sm-4 text-left">{{$ride->departDate}}  {{$ride->departHour}}</p>
              </div>
              <div class="col-md-4 col-sm-12 row">
                <h5 class="col-sm-6">Precio:</h5> <p class="col-sm-6 text-left">{{$ride->amount}}</p>
              </div>
              <div class="offset-md-3 col-md-5 col-sm-12 row">
                <p  class="col-sm-12 text-right">Mas informacion sobre este viaje...</p>
              </div>
              <br><br>
            </td>
          </div>
        </a>

      </tr>
    @endforeach

  </div>
    @else
      {{$rides}}
    @endif

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
