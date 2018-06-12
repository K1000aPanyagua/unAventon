<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    @include('flash_message')
    <h1 class="text-uppercase separator-l col-sm-12">Seleccionar tarjeta:</h1>  

    @foreach($cards as $card)
      <div class="row" >

      	<a class="col-sm-12" href="{{action('cardController@edit', ['id'=> $card->id])}}">

           {{ $card->model }} {{ $card->license }} {{ $card->id }}
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
