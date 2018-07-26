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

        <div  class="col-sm-8">
          <h5> Patente: {{$car->license}} Modelo: {{$car->model}} </h5>
        </div>
        <div class="col-sm-4">
          <ul style="list-style: none">
         
          	<li><a class="btn btn-primary separator-s" href="{{action('CarController@edit', ['id'=> $car->id])}}"> Editar </a></li>

            <li><form action="{{ route('car.destroy', ['id' => $car->id]) }}" method="POST" onsubmit="return ConfirmDelete()">

              {{method_field('DELETE')}} {{ csrf_field() }}

              <input type="submit" class="btn btn-primary separator-s text-center" value="Eliminar"/>

              <script>
                function ConfirmDelete(){
                  var x = confirm("¿Está seguro que quiere eliminar el vehiculo?");
                  if (x)
                    return true;
                  else
                    return false;
                  }
              </script>

            </form></li>
          </ul>
        </div>

      </div>

    @endforeach 

  </div>

</header>




<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>
