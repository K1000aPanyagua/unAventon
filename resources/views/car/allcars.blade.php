<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    @include('flash_message')
    <h1 class="text-uppercase separator-l col-sm-12">Seleccionar vehículo:</h1>  

    @foreach($cars as $car)
      <div class="row" >

      	<a class="col-sm-12" href="{{action('CarController@edit', ['id'=> $car->id])}}">

           {{ $car->model }} {{ $car->license }} {{ $car->id }}
        </a>
      </div>
    @endforeach    
  </div>
</header>




<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>
