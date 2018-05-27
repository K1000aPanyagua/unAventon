@include('header')
<!--Body -->
<body class="masthead bg-primary text-white text-center container-fluid">

<header id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase row" id="mainNav">
      <div class="col-4 col-sm-3">
        <a href="/"><img class="img-logo" src="{{asset('assets/Logo.jpg')}}"></a>
      </div>
      <div class="col-sm-5 col-md-4 disapear-xs" style="text-align: left;">
        <a style="font-size: xx-large;" class="navbar-brand js-scroll-trigger" href="/">Un Aventón</a>
      </div>
      <div class="col-4 col-lg-1">
        <button class="navbar-toggler navbar-toggler-right text-uppercase color-aventon text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <div class=" col-lg-4 collapse navbar-collapse" id="navbarResponsive">
          <?php
            

            if(!isset($_SESSION['user'])){
          ?>
              <ul class="navbar-nav right">
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
              <ul class="navbar-nav right">
                <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="inicio">Cerrar sesión</a>
                </li>
              </ul>
          <?php  
            }
          ?>
          </ul>
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