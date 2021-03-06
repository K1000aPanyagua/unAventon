
<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')

<header class="masthead bg-primary text-white text-center row">



 
  <div class="container">
    @include('flash_message') 
    

    <h1 class="text-uppercase separator-l col-sm-12">datos del viaje</h1>  
    <div class="row separator-l">

      <div class="col-sm-12 col-md-8 row text-left">
          <h5 class="col-sm-6">PILOTO:</h5> <p class="col-sm-6">{{$pilot->name}} {{$pilot->lastname}}</p>
          <br>
          <h5 class="col-sm-6">ORIGEN:</h5> <p class="col-sm-6">{{ $ride->origin }}</p>
          <br>
          <h5 class="col-sm-6">DESTINO:</h5> <p class="col-sm-6">{{ $ride->destination }}</p>
          <br> 
          <h5 class="col-sm-6">DURACION:</h5> <p class="col-sm-6">{{$ride->durationHour}}:{{ $ride->durationMinute}}</p>
          <br> 
          <h5 class="col-sm-6">MONTO:</h5> <p class="col-sm-6">{{ $ride->amount }}</p>
          <br> 
          <h5 class="col-sm-6">HORA DE SALIDA:</h5> <p class="col-sm-6">{{ $ride->departHour }}</p>
          <br>
          <h5 class="col-sm-6">FECHA DE SALIDA:</h5> <p class="col-sm-6">{{ $ride->departDate->toDateString() }}</p>
          <br> 
          <h5 class="col-sm-6">FECHA/HORA DE LLEGADA:</h5> <p class="col-sm-6">{{ $ride->endDate }}</p>
          <br> 
          <h5 class="col-sm-6">TIPO DE VEHICULO:</h5> <p class="col-sm-6">{{ $car->kind }}</p>
          <br> 
          <h5 class="col-sm-6">OBSERVACIONES:</h5> <p class="col-sm-6">{{ $ride->remarks }}</p>
          <br>
          <h5 class="col-sm-6">ASIENTOS DISPONIBLES:</h5> <p class="col-sm-6">{{$disponible}}</p>
          
      </div>

      <div class="col-sm-12 col-md-4">
          <!-- SI HAY UN USUARIO IDENTIFICADO -->
          @if (Auth::check())
            <ul style="list-style: none">
            <!-- SI EL USUARIO ES DUEÑO DEL VIAJE -->
            @if ($ride->user_id == Auth::user()->id )
             @if($ride->paid == FALSE)
               <a href=""></a>
             @endif
             
              <li><a class=" text-white" style="text-decoration: underline;" href="{{route('page.showPassengers', ['idRide' => $ride->id])}}"> <h5 class="text-uppercase separator-l">Pasajeros aceptados </h5></a></li>
              @if ($ride->done == FALSE)
              <li class="separator" ><a  href="{{ route('ride.edit', $ride->id) }}">Editar</a></li>

              <li class="separator"><form action="{{route('ride.destroy', ['id' => $ride->id])}}" method="POST" onsubmit="return ConfirmDelete()">
                {{method_field('DELETE')}} {{ csrf_field() }}
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
              </form> </li>


            <!-- MUESTRO LAS SOLICITUDES PENDIENTES -->
              @if ($solicitudes == 'No hay postulaciones')
                {{$solicitudes}}
              @elseif ($ride->done == FALSE)
                <h6 class="separator-l">Solicitudes pendientes: </h6> 
                <!-- MUESTRA LOS PENDIENTES Y ACEPTADOS DEBERIA MOSTRAR SOLO PENDIENTES -->
                @foreach($postulant as $postu)
                  <div class="row" >

                   <a class="separator" href="">{{$postu->name}} {{$postu->lastname}} <br> {{$postu->email}}</a> 

                   <!-- el href lleva a ver el perfil del usuario -->
                  
                  <ul style="list-style: none">
                  <li class="separator-s"> <form action="{{ route('user.declineSolicitude', ['idRide' => $ride->id, 'idPostulant' => $postu->id]) }}" method="POST" >
                  {{ csrf_field() }}
                  {{method_field('GET')}}
                  <input type="submit" class="btn btn-outline-light text-center color-aventon" value="Rechazar"/>
                  </form> </li>

                  <li class="separator-s"> <form action="{{ route('user.acceptSolicitude', ['idRide' => $ride->id, 'idPostulant' => $postu->id]) }}" method="POST" >
                  {{ csrf_field() }}
                  {{method_field('GET')}}
                  <input type="submit" class="btn btn-outline-light text-center color-aventon" value="Aceptar"/>
                  </form></li> </ul>
                  </div>
                @endforeach
              @endif
              @endif


            <!-- SI EL USUARIO NO ES DUEÑO Y SE HA POSTULADO PREVIAMENTE -->
            @elseif (isset($passengerRide) and $ride->done == FALSE)

              <!-- SI AUN NO HA SIDO RECHAZADO/ACEPTADO-->
              @if ($passengerRide->state == 'pendiente')
                <li class="separator"><form action="{{ route('user.cancelSolicitude', ['id' => $ride->id]) }}" method="POST" onsubmit="return ConfirmDelete()">
                  {{method_field('DELETE')}} {{ csrf_field() }}
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
                </form></li>
              <!-- SI HA SIDO ACEPTADO -->
              @elseif ($passengerRide->state == 'aceptado')
                <li><h4>Ustéd ha sido aceptado como pasajero en este viaje</h4></li>
                <form action="{{ route('user.cancelSolicitude', ['id' => $ride->id]) }}" method="POST" onsubmit="return ConfirmDelete()">
                  {{method_field('DELETE')}} {{ csrf_field() }}
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
                <li><h4>Usted ha sido rechazado.</h4></li>
              <!-- SI HA SIDO ELIMINADO-->
              @elseif ($passengerRide->state == 'eliminado')
                <li> <h4>Ustéd ha sido eliminado de este viaje :</h4></li>

              @endif

            @elseif ($ride->done == FALSE)
            
              {!!Form::open(['route' => ['user.postulate']])!!}
                {!! Form::submit('Postularme', ['class' => 'btn btn-info']) !!}
                {!! Form::hidden('idRide', $ride->id) !!}
              {!!Form::close()!!}

            </ul>      
            @endif
          @endif
          @if ($ride->done == TRUE)  
            <h2 class="text-uppercase separator-l col-sm-12">Viaje finalizado</h2>
          @endif
        </div>
      </div>

      

     
    </div>
</header>


<div class="row background-w-imageaventon text-white" style="background-image: url('http://localhost:8000/assets/autos.jpg')">
  <h3 class="container text-uppercase text-left separator-l" style="margin-top: 1em"> comentarios </h3>
  <div class="container comentary separator-l"> 
  <!-- MUESTRO COMENTARIOS SI ES QUE EXISTEN SI NO EXISTEN SE MUESTRA "AUN NO HAY COMENTARIOS"-->
    @if ($comments == 'Aún no hay comentarios') 
      <div class="col-sm-12 comentary">
        {{$comments}}
      </div>
    @else
      @foreach ($comments as $comment)
        <div class="comentary row ">
          <div class="col-sm-10 text-left"> <h4> {{$comment->content}} </h4> </div>
          @if (Auth::check())
            @if ($ride->user_id == Auth::user()->id or $comment->user_id == Auth::user()->id)
              <div class="col-sm-2 comentary">
                <button class="navbar-toggler navbar-toggler-right text-uppercase text-white rounded" type="button" data-toggle="collapse" data-target="#{{$comment->id}}" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                   ⋮
                </button>
              </div>
              <div id="{{$comment->id}}" class="text-left collapse">
                @if ($ride->user_id == Auth::user()->id and $ride->done == FALSE)
                  <div class="col-xs-10">
                    @if ($comment->answer == null)
                      <form method="POST" action="{{route('comment.answer')}}">
                      {{method_field('POST')}} {{ csrf_field() }}
                        <input type="hidden" name="commentId" value="{{$comment->id}}">
                        <input type="textarea" name="content" oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')" required="required">
                        <input class="btn btn-primary" type="submit" value="Responder" >
                      </form>
                    @endif                  
                  </div>
                @endif
                <div class="col-xs-2">
                  <form method="POST"  action="{{route('comment.destroy', ['id' => $comment->id])}}">
                    {{method_field('DELETE')}} {{csrf_field()}}
                    <input class="btn btn-primary" type="submit" value="Eliminar comentario">
                  </form>
                </div>
              </div>
            @endif
          @endif
        </div> 
        @if ($comment->answer != null)
          <div class="sangria separator-m">
            {{$comment->answer}}
          </div> 
        @endif
      @endforeach
    @endif  

    @if (Auth::check() and $ride->user_id != Auth::user()->id and $ride->done == FALSE)
      <!-- TEXTBOX PARA COMENTAR -->  
      <div class="col-sm-12 separator text-center" >       
        <form method="POST" id="formComment" action="{{route('comment.store')}}">
          {{method_field('POST')}} {{ csrf_field() }}
          <input type="hidden" name="rideId" value="{{$ride->id}}">
          <input type="textarea" name="content" oninvalid="this.setCustomValidity('Campo  obligatorio')" oninput="setCustomValidity('')" required="required">
          <input class="btn btn-primary" type="submit" value="Comentar">
        </form>
      </div>
    @endif

  </div>

</div>




<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>