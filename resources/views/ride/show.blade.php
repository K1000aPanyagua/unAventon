
<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')


<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    <h1 class="text-uppercase separator-l col-sm-12">datos del viaje</h1> @include('flash_message')  
    
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
            <input type="submit" class="btn btn-danger" value="Delete"/>
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
            @if ($passengerRide->attributes['state'] == 'pendiente')
              <form action="{{ route('user.cancelSolicitude', ['id' => $ride->id]) }}" method="POST" onsubmit="return ConfirmDelete()">
                {{method_field('DELETE')}}
                {{ csrf_field() }}
                <input type="submit" class="btn btn-danger" value="Cancelar solicitud"/>
                <script>
                  function ConfirmDelete(){
                    var x = confirm("¿Está seguro que quiere cancelar la postulación?");
                      if (x)
                        return true;
                      else
                        return false;
                  }
                </script>
              </form>
            @elseif ($passengerRide->state == 'aceptado')
              <form action="{{ route('user.cancelSolicitude', ['id' => $ride->id]) }}" method="POST" onsubmit="return ConfirmDelete()">
                {{method_field('DELETE')}}
                {{ csrf_field() }}
                <input type="submit" class="btn btn-danger" value="Darse de baja del viaje"/>
                <script>
                  function ConfirmDelete(){
                    var x = confirm("¿Está seguro que quiere darse de baja?. Ustéd será penalizado");
                      if (x)
                        return true;
                      else
                        return false;
                  }
                </script>
              </form> 
            @endif
          @else
            <form  action="{{route('user.postulate', ['id' => $ride->id])}}">
              <button type="submit">Postular</button>
              {{method_field('GET')}}
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