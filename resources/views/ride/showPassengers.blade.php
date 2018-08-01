<!DOCTYPE html>
<html lang="es">
@include('head')
<body id="page-top" class="container-fluid">

@include('menu')

<header class="masthead background-w-imagebgprimary text-white row" style="background-image: url('{{ asset('assets/autos.jpg') }}')">
  
  <div class="container">
    <div class="col-12" style="display: flex;">
      @if ($passengers->count() == 0)
        No hay pasajeros aceptados
      @else  
        @foreach ($passengers as $passenger)
        
          <a class="col-7 text-white"  href="{{route('user.show', ['id' => $passenger->id])}}">
            <h2 class="text-uppercase" style="text-decoration: underline;"> {{$passenger->name}} {{$passenger->lastname}}</h2>
          </a>
          @if($ride->done == FALSE)
          <form method="POST" action="{{ route('user.deletePassenger', ['ride' =>   $ride->id, 'passenger' => $passenger->id]) }}">
              {{method_field('GET')}} {{ csrf_field() }}
              <button class="btn btn-primary" type="submit">Eliminar copiloto</button>
            </form>
        @else      
          
          <div class="col-12">
           <form method="POST" action="{{ route('user.qualificatePassenger', ['ride' =>   $ride->id, 'passenger' => $passenger->id]) }}">
            {{ csrf_field() }}
            <h6>Calificar copiloto</h6>
            <button class="btn btn-primary" type="submit" value="bueno">Bueno</button>
            </form>
          </div>
          @endif

        @endforeach
      @endif
    </div>
  </div>

</header>
@include('copyrigtharrow')
@include('javascript')
</body>
</html>