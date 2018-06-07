<header class="masthead bg-primary text-white text-center row">
  <div class="container text-center">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h1 class=" text-white text-uppercase mb-0">Editar <div style="height: 0.17em;"></div> vehículo</h1>
        <br>
        <br>

        <form method="POST" action="{{route('car.update', ['id'=> $car->id])}}">
         {{ csrf_field() }} 
         {{ method_field('PUT') }}
         <div class="form-group row" >
          <h5>Patente: </h5> 
          <input  type="text" name="license" value="{{ $car->license  }}" size="50" />
        </div>
          <br>
          <br>
         <div class="form-group row" >
<h5>Marca: </h5>
          <input type="text" name="brand" value="{{$car->brand}}" size="50" />
        </div>


           <br>
          <br>
         <div class="form-group row" >
<h5>Modelo: </h5>
          <input type="text" name="model" value="{{$car->model}}" size="50" />
        </div>

          <br>
          <br>
                <div class="form-group row" >

          <h5>Año: </h5>
          <input type="text" name="year" value="{{ $car -> year }}" size="50" />
        </div>
          <br>
          <br>
                   <div class="form-group row" >

          <h5>Tipo: </h5>
            <select name="kind">
              <option value="camioneta">Camioneta</option>
              <option value="auto">Auto</option>
              <option value="camion">Camión</option>
            </select>
          </div>
          <br>

          <br>
                   <div class="form-group row" >

          <h5>Lugares disponibles: </h5>
          <input type="text" name="places" value="{{$car->places}}" size="50" />
        </div>
          <br>
          <br>
                   <div class="form-group row" >

          <h5>Color: </h5>
          <input type="text" name="color" value="{{$car->color}}" size="50" />
        </div>
          <br>
          <br>
                   <div class="form-group row" >

          <h5>Cantidad de asientos: </h5>
          <input type="string" name="numSeats" value="{{$car->numSeats}}" size="50" />
          </div>
          <br>
          <br>
                   <div class="form-group row" >

          <button type="submit" class="btn btn-primary btn-lg rounded-pill"> Confirmar </button>
          <a class="btn btn-primary btn-lg rounded-pill" href="{{route('car.destroy', ['id'=> $car->id])}}">
          Eliminar vehiculo
          </a> 
          </div>         
        </form>

      </div>
    </div>
  </div>
</header>