<!DOCTYPE html>
<html lang="es">
@include('head')
<body id="page-top" class="container-fluid">

@include('menu')

<header class="masthead background-w-imagebgprimary text-white row" style="background-image: url('{{ asset('assets/autos.jpg') }}')">
  
  <div class="container">
    <div class="col-12">
      <a class="col-7 text-white"  href="{{route('user.show', ['id' => $pilot->id])}}">
            <h2 class="text-uppercase" style="text-decoration: underline;"> {{$pilot->name}} {{$pilot->lastname}}</h2>
          </a>
    </div>
    <div class="col-12" style="display: flex;">
           
          <form method="POST" action="{{ route('user.qualificatePilot', ['ride_id' => $ride->id, 'pilot_id' => $pilot->id])}}">
            {{ csrf_field() }}
            <div class="form-group separator-s" >
            <label for="model"><h5 class="text-uppercase text-center separator-m col-form-label">Calificar piloto</h5></label>
              <select name="value" class=" separator-l" required="required">
                <option value="">Seleccionar</option>
                <option value="positivo" @if (old('value')== "bueno") {{ 'selected' }} @endif>Bueno</option>
                <option value="regular" @if (old('value')== "regular") {{ 'selected' }} @endif>Neutra</option>
                <option value="negativo" @if (old('value')== "malo") {{ 'selected' }} @endif>Malo</option>
              </select>
              <textarea placeholder="Reseña" name="review" required="required"></textarea>
            </div>
            <button class="btn btn-primary col-12" type="submit"> Calificar</button>
            </form>
    </div>
  </div>

</header>
@include('copyrigtharrow')
@include('javascript')
</body>
</html>