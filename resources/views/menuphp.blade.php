<ul class="navbar-nav right">
  <?php      
    if(!Auth::check()){
    ?>
      <li class="nav-item mx-0 mx-lg-1">
        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/login">Iniciar sesión</a>
      </li>
      <li class="nav-item mx-0 mx-lg-1">
        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/register">Registrarse</a>
      </li>
<<<<<<< HEAD
     @include('menuloggedin')
    <?php } 
    else{ 
    ?>
       
=======
      
    <?php } 
    else{ 
    ?>
      @include('menuloggedin')
>>>>>>> 3500a9d6b9fd85a0b4815a619fd4dd60dcb2dbf0
    <?php  
    }
  ?>
</ul>