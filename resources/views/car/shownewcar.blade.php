<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    <h1 class="text-uppercase separator-l col-sm-12">datos del vehiculo</h1>  
      <div class="row" >
           {{ $car->model }} 
           {{ $car->license }} 
           {{ $car->brand}} 
           {{ $car->color }} 
           {{ $car->numSeats }} 
           {{ $car->kind }} 
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
