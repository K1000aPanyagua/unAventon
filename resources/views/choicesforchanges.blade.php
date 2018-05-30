<header class="masthead bg-primary text-white text-center row">
  <div class="col-sm-12">
  	<div class="col-sm-4">
      <h2 class="text-uppercase text-left separator-l col-sm-12">Mis vehículos:</h2>  
      <div class="col-sm-4 separator-l">  
        <a class="btn btn-outline-light text-center color-aventon" href="{{ action('CarController@create') }}"> 
          Cargar nuevo vehículo
        </a>
      </div>
      <div class="col-sm-4 separator-l">  
        <a class="btn btn-outline-light text-center color-aventon" href="{{ action('CarController@index') }}"> 
          Editar vehículos
        </a>
      </div>
    </div> 
  </div>
</header>
