<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
   
    <h1 class="text-uppercase separator-l col-sm-12">Seleccionar vehículo:</h1>  
     @include('flash_message')
    @foreach($cars as $car)
      <div class="row" >

      	<a href="{{action('CarController@edit', ['id'=> $car->id])}}">

           {{ $car->model }} {{ $car->license }} {{ $car->id }}
        </a>

         <form action="{{ route('car.destroy', ['id' => $car->id]) }}" method="POST" onsubmit="return ConfirmDelete()">
          {{method_field('DELETE')}}
          {{ csrf_field() }}
          <input type="submit" class="btn btn-outline-light text-center color-aventon" value="Eliminar"/>
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
    @endforeach    
  </div>
</header>




<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>
