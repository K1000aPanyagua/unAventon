<ul class="navbar-nav right">
  <?php      
    if(!isset($_SESSION['user'])){
    ?>
      <li class="nav-item mx-0 mx-lg-1">
        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger portfolio-item" href="#login">Iniciar sesión</a>
      </li>
      <li class="nav-item mx-0 mx-lg-1">
        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger portfolio-item" href="#register">Registrarse</a>
      </li>
     @include('menuloggedin')
    <?php } 
    else{ 
    ?>
       
    <?php  
    }
  ?>
</ul>