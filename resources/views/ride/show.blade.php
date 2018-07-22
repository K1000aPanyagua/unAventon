
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
          E-MAIL PILOTO: <a href="{{route('user.show', ['id' => $pilot->id])}}">{{$pilot->email}}</a>
          <br>
          ORIGEN: {{ $ride->origin }}
          <br>
          DESTINO: {{ $ride->destination }}
          <br> 
          DURACION: {{ $ride->duration}}
          <br> 
          MONTO: {{ $ride->amount }}
          <br> 
          HOAR DE SALIDA: {{ $ride->departHour }}
          <br>
          FECHA DE SALIDA: {{ $ride->departDate }}
          <br> 
          TIPO DE VEHICULO: {{ $car->kind }}
          <br> 
          OBSERVACIONES: {{ $ride->remarks }}

          <!-- SI EL USUARIO ES DUEÑO DEL VIAJE -->
          @if ($ride->user_id == Auth::user()->id)
            <a href="{{route('page.showPassengers', ['idRide' => $ride->id])}}">
          Ver pasajeros aceptados</a>

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
            <!-- MUESTRO LAS SOLICITUDES PENDIENTES -->
            @if ($solicitudes == 'No hay postulaciones')
              {{$solicitudes}}
            @else
                Solicitudes pendientes: 
                <!-- MUESTRA LOS PENDIENTES Y ACEPTADOS DEBERIA MOSTRAR SOLO PENDIENTES -->
                @foreach($postulant as $postu)
                  <div class="row" >

                  <a href="">{{$postu->email}} {{$postu->name}} {{$postu->lastname}}</a> <!-- el href lleva a ver el perfil del usuario -->
                  
                  <form action="{{ route('user.declineSolicitude', ['idRide' => $ride->id, 'idPostulant' => $postu->id]) }}" method="POST" >
                  {{ csrf_field() }}
                  {{method_field('GET')}}
                  <input type="submit" class="btn btn-outline-light text-center color-aventon" value="Rechazar"/>
                  </form>

                  <form action="{{ route('user.acceptSolicitude', ['idRide' => $ride->id, 'idPostulant' => $postu->id]) }}" method="POST" >
                  {{ csrf_field() }}
                  {{method_field('GET')}}
                  <input type="submit" class="btn btn-outline-light text-center color-aventon" value="Aceptar"/>
                  </form>
                  </div>
                @endforeach
            @endif

          <!-- SI EL USUARIO NO ES DUEÑO Y SE HA POSTULADO PREVIAMENTE -->
          @elseif (isset($passengerRide))
            @if ($passengerRide->state == 'pendiente')
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
              <div>Ustéd ha sido aceptado como pasajero en este viaje</div>
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
            <!-- SI HA SIDO RECHAZADO -->
            @elseif ($passengerRide->state == 'rechazado')
              <div>Usted ha sido rechazado. :< </div>
            <!-- SI NO SE HA POSTULADO-->
            @elseif ($passengerRide->state == 'eliminado')
              <div>Ustéd ha sido eliminado de este viaje :< </div>
            @endif
          @else
            <form  action="{{route('user.postulate', ['id' => $ride->id])}}">
              <button type="submit">Postular</button>
              {{method_field('GET')}}
            </form>          
          @endif
          <!-- TEXTBOX PARA COMENTAR -->
          <form method="POST" id="formComment" action="{{route('comment.store')}}">
            {{method_field('POST')}}
            {{ csrf_field() }}
            <input type="hidden" name="rideId" value="{{$ride->id}}">
            <input type="textarea" name="content" oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')" required="required">
            <input type="submit" value="Comentar">
          </form>
          <!-- MUESTRO COMENTARIOS SI ES QUE EXISTEN -->
          @if ($comments == 'Aún no hay comentarios')
            {{$comments}}
          @else
            @foreach ($comments as $comment)
              {{$comment->content}}
              @if ($ride->user_id == Auth::user()->id)
                <form method="POST" action="{{route('comment.destroy', ['id' => $comment->id])}}">
                  {{method_field('DELETE')}}
                  {{csrf_field()}}
                  <input type="submit" value="Eliminar comentario">
                </form>
              @endif
              @if ($ride->user_id == Auth::user()->id)
                @if ($comment->answer == null)
                  <form method="POST" action="{{route('comment.answer')}}">
                    {{method_field('POST')}}
                    {{ csrf_field() }}
                    <input type="hidden" name="commentId" value="{{$comment->id}}">
                    <input type="textarea" name="content" oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')" required="required">
                    <input type="submit" value="Responder" >
                  </form>
                @else
                  {{$comment->answer}}
                @endif    
              @endif
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