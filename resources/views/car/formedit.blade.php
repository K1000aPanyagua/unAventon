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
          <label for="license" class="col-md-4 col-form-label text-md-right">{{ __('Patente') }}*</label>

            <div class="col-md-6">
                                
            <input value="{{ $car->license }}" id="license" type="text" class="form-control{{ $errors->has('license') ? ' is-invalid' : '' }}" name="license" value="" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('license'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('license') }}</strong>
              </span>
            @endif
            </div>
          </div>
          <br>
          <br>
          <div class="form-group row" >
          <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}*</label>

            <div class="col-md-6">
                                
            <input id="brand" type="text" class="form-control{{ $errors->has('brand') ? ' is-invalid' : '' }}" name="brand" value="{{ $car->brand }}" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('brand'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('brand') }}</strong>
              </span>
            @endif
            </div>
          <br>
          <br>
          <div class="form-group row" >
          <label for="model" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}*</label>

            <div class="col-md-6">
                                
            <input id="model" type="text" class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}" name="model" value="{{ $car->model }}" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('model'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('model') }}</strong>
              </span>
            @endif
            </div>
          </div>
          <br>
          <br>
          <div class="form-group row" >
          <h5>Tipo: </h5>
            <select name="kind" value="{{ $car->kind }}">
              <option value="">Seleccionar</option>
              <option value="camioneta" @if ($car->kind == "camioneta") {{ 'selected' }} @endif>Camioneta</option>
              <option value="auto" @if ($car->kind == "auto") {{ 'selected' }} @endif>Auto</option>
              <option value="camion" @if ($car->kind == "camion") {{ 'selected' }} @endif>Camión</option>
            </select>
          </div>
          <br>
          <br>
          <div class="form-group row" >
          <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}*</label>

            <div class="col-md-6">
                                
            <input id="color" type="text" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" name="color" value="{{ $car->color }}" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('color'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('color') }}</strong>
              </span>
            @endif
            </div>
          </div>
          <br>
          <br>
          <div class="form-group row" >
          <label for="numSeats" class="col-md-4 col-form-label text-md-right">{{ __('Numero de asientos') }}*</label>

            <div class="col-md-6">
                                
            <input id="numSeats" type="integer" class="form-control{{ $errors->has('numSeats') ? ' is-invalid' : '' }}" name="numSeats" value="{{ $car->numSeats }}" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('numSeats'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('numSeats') }}</strong>
              </span>
            @endif
            </div>
        </div>

          <button type="submit" class="btn btn-primary btn-lg rounded-pill"> Guardar cambios </button>
          
          </div>         
        </form>
      
       <form action="{{ route('car.destroy', ['id' => $car->id]) }}" method="POST" onsubmit="return ConfirmDelete()">
          {{method_field('DELETE')}}
          {{ csrf_field() }}
          <input type="submit" class="btn btn-danger" value="Delete"/>
          <script>
            function ConfirmDelete(){
              var x = confirm("¿Está seguro que quiere eliminar el vehiculo?");
              if (x)
                return true;
              else
                return false;
              }
          </script>
        </form>

      </div>
    </div>
  </div>
</header>