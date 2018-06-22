<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    <h1 class="text-uppercase separator-l col-sm-12">datos del viaje</h1>  
      <div class="row" >

        <form method="POST" action="{{ route('ride.update', $ride->id) }}">
          {{ csrf_field() }}
          <label for="origin">Origen:</label>
          <input value="{{ $ride->origin }}" type="text" name="origin" id="origin" class="form-control{{ $errors->has('origin') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
          
          @if ($errors->has('origin'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('origin') }}</strong>
              </span>
            @endif

          <br>
          <label for="destination">Destino:</label>
          <input  value="{{ $ride->destination }}" type="text" name="destination" id="destination" class="form-control{{ $errors->has('destination') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
          
          @if ($errors->has('destination'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('destination') }}</strong>
              </span>
            @endif

          <br>
          <label for="amount">Monto:</label>
          <input value="{{ $ride->amount }}" type="number" step="0.1" name="amount" id="amount" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
          
          @if ($errors->has('amount'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('amount') }}</strong>
              </span>
            @endif

          <br>
          <label for="duration">Duración:</label>
          <input value="{{ $ride->duration }}" type="time" name="duration" id="duration" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
          
          @if ($errors->has('duration'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('duration') }}</strong>
              </span>
            @endif

          <br>
          <label for="departDate">Fecha de salida:</label>
          <input value=" {{ $ride->departDate }}" type="date" name="departDate" id="departDate" class="form-control{{ $errors->has('departDate') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
          
          @if ($errors->has('departDate'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('departDate') }}</strong>
              </span>
            @endif

          <br>
          <label for="departHour">Hora de salida:</label>
          <input value="{{ $ride->departHour }}" type="time" name="departHour" id="departHour" class="form-control{{ $errors->has('departHour') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">
          
          @if ($errors->has('departHour'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('departHour') }}</strong>
              </span>
            @endif

          <br>
          
          <label class="col-md-4 col-form-label text-md-right">Vehiculo*</label>
            <select name="car" id="car" required="required" class="form-control{{ $errors->has('car') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">  
              <option value="">Seleccionar</option>
              @foreach ($cars as $i)
                  <option  value="{{$i->id}}" 
                    @if ($i->id == $car->id) 
                      {{'selected'}}   
                    @endif>Marca: {{$i->brand}} Modelo: {{ $i->model}} Asientos: {{$i->numSeats}}</option>
                @endforeach
                
            </select>
            <br>

          <label class="col-md-4 col-form-label text-md-right">Tarjeta*</label>
            <select name="card" id="card" required="required" class="form-control{{ $errors->has('card') ? ' is-invalid' : '' }}"  required="required" autofocus oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')"> 
              <option value="">Seleccionar</option>
              @foreach ($cards as $i)
                  <option  value="{{$i->id}}" @if($i->id == $card->id) {{ 'selected' }} @endif> Tarjeta {{ $i->numCard }}</option>
                @endforeach
                
            </select>
            <br>
          <textarea name="remarks" id="remarks" placeholder="Observaciones...">{{ $ride->remarks }}</textarea>
          
          @if ($errors->has('remarks'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('remarks') }}</strong>
              </span>
            @endif

          <br>
          <button type="submit" class="btn">Guardar cambios</button>

        </form>
     
      </div>
  </div>
</header>

<a class="btn btn-primary" href="/"> 
  Volver al inicio 
</a>




<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>