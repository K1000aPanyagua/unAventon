<!DOCTYPE html>
<html lang="es">
@include('head')
<body id="page-top" class="container-fluid">

@include('menu')

<header class="masthead background-w-imagebgprimary text-white row" style="background-image: url('{{ asset('assets/autos.jpg') }}')">
  @if ($passengers->count() == 0)
    No hay pasajeros aceptados
  @else  
    @foreach ($passengers as $passenger)
      <a href="{{route('user.show', ['id' => $passenger->id])}}">{{$passenger->name}} {{$passenger->lastname}} ({{$passenger->email}})</a>

      <form method="POST" action="{{ route('user.deletePassenger', ['ride' =>   $ride->id, 'passenger' => $passenger->id]) }}">
    	 {{method_field('GET')}}
        {{ csrf_field() }}
    	 <button class="btn" type="submit">Eliminar copiloto</button>
    	
      </form>
    @endforeach
  @endif

  </header>
@include('copyrigtharrow')
@include('javascript')
</body>
</html>