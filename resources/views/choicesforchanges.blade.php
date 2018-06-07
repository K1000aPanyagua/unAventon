

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
           <a class="listitem text-white" href=""> 
              <h2> ► Cargar nueva tarjeta</h2>
            </a>
            <a class="listitem text-white" href=""> 
              <h2> ► Editar tarjetas</h2>
            </a>
          </div>
      </div>
   
    <div class="col-sm-4">   
       <div class="color-aventon-bk col-account">
         <h1 class="text-uppercase text-left separator-m col-sm-12">Mi <br> perfil:</h1> 
            <a class="listitem text-white" href=""> 
              <h2> ► Editar perfil</h2>
            </a>
            <a class="listitem text-white" href=""> 
              <h2> ► Cambiar contraseña</h2>
            </a>
            </div>
    </div>

    </div>
  </div>
</header>
