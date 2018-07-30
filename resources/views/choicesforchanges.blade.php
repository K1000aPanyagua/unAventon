

<header class="masthead bg-primary text-white text-left row">
  <div class="containernew">
  	<div class="row">
      <div class="col-md-4 col-12">   
        <h1 class="text-uppercase separator-m col-sm-12"> <i class="fa fa-angle-double-down" aria-hidden="true"></i>

Mi perfil</h1> 
          <a class=" text-white " href=" {{route('user.edit', Auth::User()->id)}} "> 
            <p class="sangria">  <i class="fa fa-pencil" aria-hidden="true"></i>Editar datos personales</p>
          </a>
          <a class=" text-white " href="/editPass"> 
            <p class="sangria"> <i class="fa fa-pencil" aria-hidden="true"></i>Cambiar contraseña</p>
          </a>

          <form action="{{ route('user.destroy', Auth::User()->id) }}" method="POST" onsubmit="return ConfirmDelete()">
              {{method_field('DELETE')}} {{ csrf_field() }}
              <input type="submit" class=" sangria btn btn-danger" value="Desactivar mi cuenta"/>
              <script>
                function ConfirmDelete(){
                  var x = confirm("¿Está seguro que quiere desactivar la cuenta?");
                  if (x)
                    return true;
                  else
                    return false;
                }
              </script>
            </form>

    </div>

    <div class="col-md-4 col-12">
      <h1 class="text-uppercase  separator-m col-sm-12"> <i class="fa fa-angle-double-down" aria-hidden="true"></i>

Mis vehículos:</h1>  
        <a class=" text-white "  href="{{ action('CarController@create') }}"> 
          <p class="sangria" > <i class="fa fa-car " aria-hidden="true"></i> Cargar nuevo vehículo</p>
        </a>
        <a class=" text-white "  href="{{ action('CarController@index')}}"> 
          <p class="sangria"> <i class="fa fa-pencil" aria-hidden="true"></i> Editar o eliminar vehículos</p>
        </a>
    </div>

    <div class="col-md-4 col-12">
      <h1 class="text-uppercase  separator-m col-sm-12"> <i class="fa fa-angle-double-down" aria-hidden="true"></i>

Mis Tarjetas:</h1>  
        <a class="text-white "  href="{{ action('CarController@create') }}"> 
          <p class="sangria"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Cargar nueva tarjeta</p>
        </a>
        <a class=" text-white "  href="{{ action('CarController@index')}}"> 
          <p class="sangria"><i class="fa fa-window-close-o" aria-hidden="true"></i>Eliminar tarjeta</p>
        </a>
    </div>
     
    </div>
  </div>
</header>
