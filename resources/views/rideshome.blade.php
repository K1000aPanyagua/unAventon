
<div class="row color-aventon-bk rides-home">
   
  <div class="col-sm-12">
  
    @foreach ($rides as $ride)
      <tr>

        <a href="{{route('ride.show', $ride->id)}}">
          <div class="container-ride row separator-both-s">
            <td>
              <div class="col-md-4 col-sm-12 row">
                <h5 class="col-sm-6">Origen: </h5> <p class="col-sm-6 text-left"> {{$ride->origin}} </p> 
              </div>
              <div class="col-md-4 col-sm-12 row">
                <h5  class="col-sm-6">Destino:</h5> <p class="col-sm-6 text-left">{{$ride->destination}}</p>
              </div>
              <div class="col-md-4 col-sm-12 row">
                <h5  class="col-sm-8">Fecha y hora de salida:</h5> <p class="col-sm-4 text-left"> {{$ride->departDate}} {{$ride->departHour}} </p>
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

  

</div>