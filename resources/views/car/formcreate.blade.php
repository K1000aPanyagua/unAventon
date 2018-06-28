<header class="masthead bg-primary text-white text-center row">
  <div class="container text-center">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h1 class=" text-white text-uppercase mb-0">Agregar <div style="height: 0.17em;"></div> vehículo</h1>
        @include('flash_message')
        <br>
        <br> 
        <form method="POST" action="{{ route('car.store') }}">
         {{ csrf_field() }} 
        <div class="form-group row" >
          <label for="license" class="col-md-4 col-form-label text-md-right">{{ __('Patente') }}*</label>

            <div class="col-md-6">
                                
            <input value="{{ old('license') }}" name="license" id="license" type="text" class="form-control{{ $errors->has('license') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('license'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('license') }}</strong>
              </span>
            @endif
            </div>
          </div>
          
          <div class="form-group row" >
          <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}*</label>

            <div class="col-md-6">
                                
            <input value="{{ old('brand') }}" id="brand" type="text" class="form-control{{ $errors->has('brand') ? ' is-invalid' : '' }}" name="brand" required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('brand'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('brand') }}</strong>
              </span>
            @endif
            </div>
          </div>
          <div class="form-group row" >
          <label for="model" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}*</label>

            <div class="col-md-6">
                                
            <input value="{{ old('model') }}" id="model" type="text" class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}" name="model" required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('model'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('model') }}</strong>
              </span>
            @endif
            </div>
          </div>
        

          <div class="form-group row" >
          <label for="model" class="col-md-4 col-form-label text-md-right">{{__('Tipo') }}*</label>
            <select name="kind" required="required">
              <option value="">Seleccionar</option>
              <option value="camioneta" @if (old('kind')== "camioneta") {{ 'selected' }} @endif>Camioneta</option>
              <option value="auto" @if (old('kind')== "auto") {{ 'selected' }} @endif>Auto</option>
              <option value="camion" @if (old('kind')== "camion") {{ 'selected' }} @endif>Camión</option>
            </select>
          </div>
          
          <div class="form-group row" >
          <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}*</label>

            <div class="col-md-6">
                                
            <input value="{{ old('color') }}" id="color" type="text" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" name="color" required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('color'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('color') }}</strong>
              </span>
            @endif
            </div>
          </div>
          
          <div class="form-group row" >
          <label for="numSeats" class="col-md-4 col-form-label text-md-right">{{ __('Numero de asientos') }}*</label>

            <div class="col-md-6">
                                
            <input value="{{ old('numSeats') }}" id="numSeats" type="integer" class="form-control{{ $errors->has('numSeats') ? ' is-invalid' : '' }}" name="numSeats" required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

            @if ($errors->has('numSeats'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('numSeats') }}</strong>
              </span>
            @endif
            </div>
        </div>
          <button type="submit" class="btn btn-primary btn-lg rounded-pill"> Confirmar </button>
        </form>
      </div>
    </div>
  </div>
</header>