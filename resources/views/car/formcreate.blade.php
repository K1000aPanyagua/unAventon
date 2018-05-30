<div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Agregar vehiculo</h2>
              
              <form method="POST" action="{{ route('car.store') }}">
                <h5>Licencia de conducir: </h5>
                <input type="text" name="license" value="" size="50" />
                <br>
                <br>
                <h5>Marca: </h5>
                <input type="text" name="brand" value="" size="50" />
                <br>
                <br>
                <h5>Modelo: </h5>
                <input type="text" name="model" value="" size="50" />
                <br>
                <br>
                <h5>Año: </h5>
                <input type="text" name="year" value="" size="50" />
                <br>
                <br>
                <h5>Tipo: </h5>
                  <select>
                  	<option value="camioneta">Camioneta</option>
                    <option value="auto">Auto</option>
                    <option value="camion">Camión</option>
                  </select>
                <br>
                <br>
                <h5>Lugares: </h5>
                <input type="text" name="places" value="" size="50" />
                <br>
                <br>
                <h5>Color: </h5>
                <input type="text" name="color" value="" size="50" />
                <br>
                <br>
                <h5>Cantidad de asientos: </h5>
                <input type="string" name="numSeats" value="" size="50" />
                <br>
                <br>
                <button type="submit" class="btn btn-primary btn-lg rounded-pill"> Confirmar </button>
              </form>
           </div>
         </div>
         
       </div>