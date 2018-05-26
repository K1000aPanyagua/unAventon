<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Un Aventón</title>

    <!-- Bootstrap core CSS -->
    
    <link href="<?php echo base_url('application/views/assets/freelancer/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom fonts for this template -->
    
    <link href="<?php echo base_url('application/views/assets/freelancer/vendor/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    
    <link href="<?php echo base_url('application/views/assets/freelancer/vendor/magnific-popup/magnific-popup.css')?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    
    <link href="<?php echo base_url('application/views/assets/freelancer/css/freelancer.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('application/views/assets/freelancer/css/style.css')?>" rel="stylesheet">
  </head>

  <header id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <img class="img-logo" src="<?php base_url()?> application/views/assets/Logo.jpg">
        <a class="navbar-brand js-scroll-trigger" href="<?php site_url('')?>index.php">Un Aventón</a>
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
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php site_url('form')?>">Cerrar sesión</a>
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
<!--Body -->
    <body class="masthead bg-primary text-white text-center">
      <div class="container">
        
        <h1 class="text-uppercase mb-0">Ahorrá y Ayudá </h1>
        <br>  
        <h2 class="font-weight-light mb-0"></h2>
      </div>
      <div class="text-center mt-4">
          <a class="btn btn-xl btn-outline-light" href="#"> 
            Publicar viaje</a>
          
        <div class="container o-header"><h2 class="text-uppercase mb-0">Ó</h2></div>

          <a class="btn btn-xl btn-outline-light" href="#">
            Buscar viaje
          </a>
        </div>
    </body>
