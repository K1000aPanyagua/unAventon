<ul class="navbar-nav left">
  <?php      
    if(!Auth::check()){
    ?>
      <li class="nav-item mx-0 mx-lg-1">
        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/login">Iniciar sesión</a>
      </li>
      <li class="nav-item mx-0 mx-lg-1">
        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/register">Registrarse</a>
      </li>
      
    <?php } 
    else{ 
    ?>
      <li class="nav-item mx-0 mx-lg-1">
        {{Auth::User()->name}}
      </li>
      <li class="nav-item mx-0 mx-lg-1">
        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('user.show', Auth::user()->id)}}">Mi perfil</a> 
      </li>
      @include('menuloggedin')
    <?php  
    }
  ?>
</ul>
