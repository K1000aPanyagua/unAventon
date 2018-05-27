@include('header')
<!--Body -->
    <body class="masthead bg-primary text-white text-center">

<header id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">

        <a href="/"><img class="img-logo" src="{{asset('assets/Logo.jpg')}}"></a>

        <a class="navbar-brand js-scroll-trigger" href="/">Un Aventón</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          <?php
            

            if(!isset($_SESSION['user'])){
          ?>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger portfolio-item" href="#login">Iniciar sesión</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger portfolio-item" href="#register">Registrarse</a>
                </li>
              </ul>
          <?php } 
            else{ 
          ?>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="inicio">Cerrar sesión</a>
                </li>
              </ul>
          <?php  
            }
          ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  
      <div class="row">
        <h1 class="text-uppercase mb-0">Ahorrá y Ayudá </h1>
        <br>  
        <h2 class="font-weight-light mb-0"></h2>
      </div>
      <div class="text-center mt-4">
          <a class="btn btn-xl btn-outline-light" href="#"> 
            Publicar viaje</a>
          
        <div class="container o-header"><h2 class="text-uppercase mb-0"></h2></div>

          <a class="btn btn-xl btn-outline-light" href="#">
            Buscar viaje
          </a>
        </div>
</body>

<!--fin header-->
@include('footer')