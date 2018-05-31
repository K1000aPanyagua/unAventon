<li class="nav-item mx-0 mx-lg-1">
   <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('user.show', Auth::user()->id)}}">Mi perfil</a> 
</li>
 <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-down"></span></button>
  <ul class="dropdown-menu">
    <li><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/configurationAccount">Configuración de cuenta</a></li>
    <li><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#">Configuración de privacidad   </a></li>
    <li><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/logout">Cerrar sesión</a></li>
  </ul>
</div> 