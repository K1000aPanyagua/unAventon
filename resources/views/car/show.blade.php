
<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    <h1 class="text-uppercase separator-l col-sm-12">datos del vehiculo</h1>  
    @include('flash_message')
      <div class="col-sm-12" >
           MODELO: {{ $car->model }} <br> 
           PATENTE: {{ $car->license }} <br>
           MARCA: {{ $car->brand}} <br>
           COLOR: {{ $car->color }} <br>
           ASIENTOS: {{ $car->numSeats }} <br>
           TIPO: {{ $car->kind }} <br>
      </div>
      <div class="separator-both-s">
        <a class="btn btn-primary" href="/car"> 
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
          Mis vehiculos   
        </a>
      </div>
  </div>
</header>



<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>
