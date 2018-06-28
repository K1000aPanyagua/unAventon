

<header class="masthead bg-primary text-white text-left row">
  <div class="containernew">
  	<div class="row">

    <div class="col-sm-4">
      <div class="color-aventon-bk col-account">
      <h2 class="text-uppercase  separator-m col-sm-12">Mis vehículos:</h2>  
        <a class="listitem text-white "  href="{{ action('CarController@create') }}"> 
          <p> ► Cargar nuevo vehículo</p>
        </a>
        <a class="listitem text-white "  href="{{ action('CarController@index')}}"> 
          <p> ► Editar vehículos</p>
        </a>
      </div>
    </div>
     

      <div class="col-sm-4 ">
        <div class="color-aventon-bk col-account">
         <h2 class="text-uppercase text-left separator-m col-sm-12">Mis Tarjetas:</h2>  
           <a class="listitem text-white" href="{{action('CardController@create')}}"> 
              <p> ► Cargar nueva tarjeta</p>
            </a>
            <a class="listitem text-white" href="{{action('CardController@index')}}"> 
              <p> ► Eliminar tarjeta</p>
            </a>
          </div>
      </div>
   
    <div class="col-sm-4">   
       <div class="color-aventon-bk col-account">
         <h2 class="text-uppercase text-left separator-m col-sm-12">Mi perfil:</h2> 
            <a class="listitem text-white" href=" {{route('user.edit', Auth::User()->id)}} "> 
              <p> ► Editar datos personales</p>
            </a>
            <a class="listitem text-white" href="/editPass"> 
              <p> ► Cambiar contraseña</p>
            </a>

              <form action="{{ route('user.destroy', Auth::User()->id) }}" method="POST" onsubmit="return ConfirmDelete()">
                {{method_field('DELETE')}}
                {{ csrf_field() }}
                <input type="submit" class="btn btn-danger" value="Desactivar mi cuenta"/>
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
    </div>

        
  

    </div>
  </div>
</header>
