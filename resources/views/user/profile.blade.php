<header class="masthead bg-primary text-white text-left row">
  <div class="containernew">
  	<div class="row">

      <div class="col-sm-12 col-md-8 row separator-m">     
            <h1 class="text-uppercase text-center separator-m col-sm-12"> Mi perfil:</h1> 
            
            <h3 class="col-6">Nombre:</h3><p class="col-6">{{ $user->name }}</p>
            <h3 class="col-6">Apellido:</h3><p class="col-6">{{ $user->lastname }}</p>
            <h3 class="col-6">Fecha de nacimiento:</h3><p class="col-6">{{ $user->birthdate }}</p> 
            <h3 class="col-6">Email:</h3><p class="col-6">{{ $user->email }}</p> 
            <h3 class="col-6">Teléfono:</h3><p class="col-6">{{ $user->telephone }}</p> 

            <a class="btn btn-primary sangria" href=" {{route('user.edit', Auth::User()->id)}} "> Editar </a>
            <a class="btn btn-primary sangria" href="/editPass"> Cambiar contraseña</a>

            <form action="{{ route('user.destroy', Auth::User()->id) }}" method="POST" onsubmit="return ConfirmDelete()">
                {{method_field('DELETE')}}
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary sangria" value="Desactivar mi cuenta"/>
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

      </div >
      <div class="col-sm-12 col-md-4"> <h1 class="text-uppercase text-center "> mis cali- ficaciones</h1> </div>

    </div>
    
    <div class="background-w-imageaventon text-white mb-0 masthead row" style="background-image: url('{{ asset('assets/autos.jpg') }}')">
      <h1 class="text-uppercase text-center separator-both-xs col-sm-8"> Mis viajes</h1>
        

        @include('user/myRides')


    </div>


  </div>
</header>


