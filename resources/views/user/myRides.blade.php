

	<div class="row col-sm-12">
   
  <div>
  	<h2>como piloto</h2>
  
    @foreach ($myRides as $myRide)
      <tr>

        <a href="{{route('ride.show', $myRide->id)}}">
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
              <a class="listitem text-white" href=" {{route('user.payRide', Auth::User()->id)}} "             > 
                <h2>Pagar</h2>
              </a>
              <br><br>
            </td>
          </div>
        </a>


      </tr>
    @endforeach

  </div>




<div class="container">
   
  <div>
  	<h2>como copiloto</h2>
  
    @foreach ($rides as $ride)
      <tr>
        <a href="{{route('ride.show', $ride->id)}}">
          <td>
            Origen: {{$ride->origin}}
            Destino: {{$ride->destination}}
            <br><br>
          </td>
        </a>
      </tr>
    @endforeach

  </div>
</div>
</div>
