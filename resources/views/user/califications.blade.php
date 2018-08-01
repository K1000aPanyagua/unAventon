<!DOCTYPE html>
<html lang="es">

@include('head')
@include('flash_message')
<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')

<header class="masthead bg-primary text-white text-left row">
<h2 class="text-uppercase text-center separator-both-xs col-sm-6">como piloto</h2>
  
  @if ($asPilot->count()!= 0)
  @foreach ($asPilot as $pilot)
  <tr>
    <div class="container-passenger row separator-both-s">
      <td>
        <div class="col-md-4 col-sm-12 row">
          <h5 class="col-sm-6">Calificacion: </h5> <p class="col-sm-6 text-left">{{$pilot->value}}</p> 
          @dd($asPilot);
        </div>
      </td>
    </div>
  </tr>
  @endforeach
    @else
    <div class="container-passenger row separator-both-s">
      <div class="col-sm-12 row" style="color: #f17376;">
        <h5> Aun no tiene calificaciones como piloto </h5>
      </div>
    </div>
  @endif
  

  <h2 class="text-uppercase text-center separator-both-xs col-sm-6">como copiloto</h2>

  @if ($asPassenger->count()!= 0)
    @foreach ($asPassenger as $passenger)
      <tr>
        <div class="container-passenger row separator-both-s">
          <td>
            <div class="col-md-4 col-sm-12 row">
              <h5 class="col-sm-6">Calificacion: </h5> <p class="col-sm-6 text-left">{{$passenger->value}}</p> 
            </div>
          </td>
        </div>
    </tr>
    @endforeach
  @else
    <div class="container-passenger row separator-both-s">
      <div class="col-sm-12 row" style="color: #f17376;">
        <h5> Aun no tiene calificaciones como copiloto </h5>
      </div>
    </div>
  @endif
</header>

<!--fin header-->
@include('footer')
@include('javascript')
</body>
</html>