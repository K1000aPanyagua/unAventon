<!DOCTYPE html>
<html lang="en">
  <head >
    <link href="{{asset('assets/freelancer/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="{{asset('assets/freelancer/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- Plugin CSS -->
    <link href="{{asset('assets/freelancer/vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{asset('assets/freelancer/css/freelancer.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/freelancer/css/style.css')}}" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="pato">
    <title>Un Aventón</title>

 </head>

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