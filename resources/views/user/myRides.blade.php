<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="container">
   
  <div>
  	Viajes como piloto
  
    @foreach ($myRides as $myRide)
      <tr>
        <a href="{{route('ride.show', $myRide->id)}}">
          <td>
            Origen: {{$myRide->origin}}
            Destino: {{$myRide->destination}}
            
            <a class="listitem text-white" href=" {{route('user.payRide', Auth::User()->id)}} "> 
              <h2>Pagar</h2>
            </a>
            
            <br><br>
          </td>
        </a>
      </tr>
    @endforeach

  </div>




<div class="container">
   
  <div>
  	Viajes como copiloto
  
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

</body>
</html>