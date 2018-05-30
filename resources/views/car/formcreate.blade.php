<header class="masthead bg-primary text-white text-center row">
  <div class="container text-center">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h1 class=" text-white text-uppercase mb-0">Agregar <div style="height: 0.17em;"></div> vehículo</h1>
        <br>
        <br>
        <form method="POST" action="{{ route('car.store') }}">
          <h5>Licencia de conducir: </h5>
          <input type="text" name="license" value="{{old('license')}}" size="50" />
          <br>
          <br>
          <h5>Marca: </h5>
          <input type="text" name="brand" value="{{old('brand')}}" size="50" />
          <br>
          <br>
          <h5>Modelo: </h5>
          <input type="text" name="model" value="{{old('model')}}" size="50" />
          <br>
          <br>
          <h5>Año: </h5>
          <input type="text" name="year" value="{{old('year')}}" size="50" />
          <br>
          <br>
          <h5>Tipo: </h5>
            <select name="kind">
              <option value="camioneta">Camioneta</option>
              <option value="auto">Auto</option>
              <option value="camion">Camión</option>
            </select>
          <br>
          <br>
          <h5>Lugares: </h5>
          <input type="text" name="places" value="{{old('places')}}" size="50" />
          <br>
          <br>
          <h5>Color: </h5>
          <input type="text" name="color" value="{{old('color')}}" size="50" />
          <br>
          <br>
          <h5>Cantidad de asientos: </h5>
          <input type="string" name="numSeats" value="{{old('numSeats')}}" size="50" />
          <br>
          <br>
          <button type="submit" class="btn btn-primary btn-lg rounded-pill"> Confirmar </button>
        </form>
      </div>
    </div>
  </div>
</header>