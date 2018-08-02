<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    <h1 class="text-uppercase separator-l col-sm-12">datos de la tarjeta</h1>  
      <div class="col-12" >            
           Vencimiento: {{ $card->expiration }} <br>
           Numero: {{ $card->numCard }}
      </div>
  </div>
</header>
<div class="bg-primary text-center row">
	<div class="col-12 separator-l">
      <a class="btn btn-primary" href="/card"> 
        Mis tarjetas 
      </a>
    </div>
    @include('fill')
</div>




<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>
