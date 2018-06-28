
<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')
@include('flash_message')


<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    <h1 class="text-uppercase separator-l col-sm-12">datos del viaje</h1>  
      <div class="row" >
          {{ $ride->origin }} 
          {{ $ride->destination }} 
          {{ $ride->duraton}} 
          {{ $ride->amount }} 
          {{ $ride->remarks }} 
          {{ $ride->departHour }}
          {{ $ride->departDate }} 
          {{ $car->kind }}

          @if ($ride->user_id == Auth::user()->id)
            <a class="btn" href="{{ route('ride.edit', $ride->id) }}">Editar</a>

            <form action="{{ route('ride.destroy', $ride->id) }}" method="POST" onsubmit="return ConfirmDelete()">
            {{method_field('DELETE')}}
            {{ csrf_field() }}
            <input type="submit" class="btn btn-danger" value="Eliminar"/>
            <script>
            function ConfirmDelete(){
              var x = confirm("¿Está seguro que quiere eliminar el viaje?");
              if (x)
                return true;
              else
                return false;
              }
            </script>
            </form>
          @elseif ($passengerRide != null)
            @if ($passengerRide->state == 'Pendiente')
              <button>Cancelar solicitud</button>
            @elseif ($passengerRide->state == 'Aceptado')
              <button>Darse de baja del viaje</button> 
            @endif
          @else
            <form method="POST" href="{{action('UserController@postulate',  $ride->id)}}">
              {{method_field('POST')}}
              {{ csrf_field() }}
              <button class="btn-primary" type="submit">Postularse</button>
            </form>
          
          @endif
          
          @if ($comments == 'Aún no hay comentarios')
            {{$comments}}
          @else
            @foreach ($comments as $comment)
              {{$comment->content}}
            @endforeach
          @endif
        
      </div>

  </div>
</header>

<a class="btn btn-primary" href="/"> 
  Volver al inicio 
</a>

<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>