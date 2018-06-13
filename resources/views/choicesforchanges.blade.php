

<header class="masthead bg-primary text-white text-left row">
  <div class="containernew">
  	<div class="row">

    <div class="col-sm-4">
      <div class="color-aventon-bk col-account">
      <h1 class="text-uppercase  separator-m col-sm-12">Mis vehículos:</h1>  
        <a class="listitem text-white "  href="{{ action('CarController@create') }}"> 
          <h2> ► Cargar nuevo vehículo</h2>
        </a>
        <a class="listitem text-white "  href="{{ action('CarController@index')}}"> 
          <h2> ► Editar vehículos</h2>
        </a>
      </div>
    </div>
     

      <div class="col-sm-4 ">
        <div class="color-aventon-bk col-account">
         <h1 class="text-uppercase text-left separator-m col-sm-12">Mis Tarjetas:</h1>  
           <a class="listitem text-white" href="{{action('CardController@create')}}"> 
              <h2> ► Cargar nueva tarjeta</h2>
            </a>
            <a class="listitem text-white" href="{{action('CardController@index')}}"> 
              <h2> ► Eliminar tarjeta</h2>
            </a>
          </div>
      </div>
   
    <div class="col-sm-4">   
       <div class="color-aventon-bk col-account">
         <h1 class="text-uppercase text-left separator-m col-sm-12">Mi <br> perfil:</h1> 
            <a class="listitem text-white" href=" {{route('user.edit', Auth::User()->id)}} "> 
              <h2> ► Editar datos personales</h2>
            </a>
            <a class="listitem text-white" href="/editPass"> 
              <h2> ► Cambiar contraseña</h2>
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
