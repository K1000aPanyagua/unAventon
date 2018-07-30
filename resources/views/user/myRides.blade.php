
<h2 class="text-uppercase text-center separator-both-xs col-sm-6">como piloto</h2>
  
  @if ($myRides->count()!= 0)
  @foreach ($myRides as $myRide)
  <tr>
    <a class="row" href="{{route('ride.show', $myRide->id)}}">
      <div class="container-ride row separator-both-s">
        <td>
          <div class="col-md-4 col-sm-12 row">
            <h5 class="col-sm-6">Origen: </h5> <p class="col-sm-6 text-left">{{$myRide->origin}}</p> 
          </div>
          <div class="col-md-4 col-sm-12 row">
            <h5  class="col-sm-6">Destino:</h5> <p class="col-sm-6 text-left">{{$myRide->destination}}</p>
          </div>
          <div class="col-md-4 col-sm-12 row">
            <h5  class="col-sm-8">Fecha y hora de salida:</h5> <p class="col-sm-4 text-left">{{$myRide->departDate}}  {{$myRide->departHour}}</p>
          </div>
          <div class="col-md-4 col-sm-12 row">
            <h5 class="col-sm-6">Precio:</h5> <p class="col-sm-6 text-left">{{$myRide->amount}}</p>
          </div>
          <div class="offset-md-3 col-md-5 col-sm-12 row">
            <p  class="col-sm-12 text-right">Mas informacion sobre este viaje...</p>
          </div>
          <br><br>
          <a  class="sangria text-uppercase text-center" style="color: #f17376;" href=" {{route('user.payRide', Auth::User()->id)}} "> 
            <h2>Pagar</h2>
          </a>
          <a  class="sangria text-uppercase text-center" style="color: #f17376;" href=" {{route('user.payRide', Auth::User()->id)}} "> 
            <h2>Calificar</h2>
          </a>
          <br><br>
        </td>
      </div>
    </a>
  </tr>
  @endforeach
    @else
    <div class="container-ride row separator-both-s">
      <div class="col-sm-12 row" style="color: #f17376;">
        <h5> Aun no tiene viajes como piloto </h5>
      </div>
    </div>
  @endif
  

  <h2 class="text-uppercase text-center separator-both-xs col-sm-6">como copiloto</h2>

  @if ($rides->count()!= 0)
    @foreach ($rides as $ride)
      <tr>
      <a class="row" href="{{route('ride.show', $ride->id)}}">
        <div class="container-ride row separator-both-s">
          <td>
            <div class="col-md-4 col-sm-12 row">
              <h5 class="col-sm-6">Origen: </h5> <p class="col-sm-6 text-left">{{$ride->origin}}</p> 
            </div>
            <div class="col-md-4 col-sm-12 row">
              <h5  class="col-sm-6">Destino:</h5> <p class="col-sm-6 text-left">  {{$ride->destination}}</p>
            </div>
            <div class="col-md-4 col-sm-12 row">
              <h5  class="col-sm-8">Fecha y hora de salida:</h5> <p class="col-sm-4 text-left">  {{$ride->departDate}}  {{$ride->departHour}}</p>
            </div>
            <div class="col-md-4 col-sm-12 row">
              <h5 class="col-sm-6">Precio:</h5> <p class="col-sm-6 text-left">{{$ride->amount}}</p  >
            </div>
            <div class="offset-md-3 col-md-5 col-sm-12 row">
              <p  class="col-sm-12 text-right">Mas informacion sobre este viaje...</p>
            </div>
            <br><br>
            <a  class="sangria text-uppercase text-center" style="color: #f17376;" href=" {{route('user.payRide', Auth::User()->id)}} "> 
              <h2>Pagar</h2>
            </a>
            <a  class="sangria text-uppercase text-center" style="color: #f17376;" href=" {{route('user.payRide', Auth::User()->id)}} "> 
              <h2>Calificar</h2>
            </a>
            <br><br>
          </td>
        </div>
      </a>
    </tr>
    @endforeach
  @else
    <div class="container-ride row separator-both-s">
      <div class="col-sm-12 row" style="color: #f17376;">
        <h5> Aun no tiene viajes como copiloto </h5>
      </div>
    </div>
  @endif