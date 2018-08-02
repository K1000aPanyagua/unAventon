<!DOCTYPE html>
<html lang="es">
@include('head')
<body id="page-top" class="container-fluid">

@include('menu')

<header class="masthead background-w-imagebgprimary text-white row" style="background-image: url('{{ asset('assets/autos.jpg') }}')">
  
  <div class="container">
    <div class="col-12" style="display: flex;">
      @if ($passengers->count() == 0)
        No hay pasajeros aceptados
      @else  
        @foreach ($passengers as $passenger)
        
          <a class="col-7 text-white"  href="{{route('user.show', ['id' => $passenger->id])}}">
            <h2 class="text-uppercase" style="text-decoration: underline;"> {{$passenger->name}} {{$passenger->lastname}}</h2>
          </a>
          @if($ride->done == FALSE)
          <form method="POST" action="{{ route('user.deletePassenger', ['ride' =>   $ride->id, 'passenger' => $passenger->id]) }}">
              {{method_field('GET')}} {{ csrf_field() }}
              <button class="btn btn-primary" type="submit">Eliminar copiloto</button>
            </form>
        @else      
          
          
           <form method="POST" action="{{ route('user.qualificatePassenger', ['ride' =>   $ride->id, 'passenger' => $passenger->id]) }}">
            {{ csrf_field() }}
            <div class="form-group separator-s" >
            <label for="model"><h5 class="text-uppercase text-center separator-m col-form-label">Calificar copiloto</h5></label>
              <select name="value" class=" separator-l" required="required">
                <option value="">Seleccionar</option>
                <option value="positivo" @if (old('value')== "bueno") {{ 'selected' }} @endif>Bueno</option>
                <option value="regular" @if (old('value')== "regular") {{ 'selected' }} @endif>Neutra</option>
                <option value="negativo" @if (old('value')== "malo") {{ 'selected' }} @endif>Malo</option>
              </select>
            </div>
            <button class="btn btn-primary col-12" type="submit"> Calificar</button>
            </form>


          @endif

        @endforeach
      @endif
    </div>
  </div>

</header>
@include('copyrigtharrow')
@include('javascript')
</body>
</html>