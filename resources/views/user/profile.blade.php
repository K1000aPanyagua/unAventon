<header class="masthead bg-primary text-white text-left row">
  <div class="containernew">
  	<div class="row">
   
    <div class="col-sm-8">   
       <div class="color-aventon-bk">
         <h2 class="text-uppercase text-center separator-m col-sm-12">Mi perfil:</h2> 
            
            <p>► Nombre: {{ $user->name }}</p> <br>
            <p>► Apellido:  {{ $user->lastname }}</p> <br>
            <p>► Fecha de nacimiento:  {{ $user->birthdate }}</p> <br>
            <p>► Email:  {{ $user->email }}</p> <br>
            <p>► Teléfono:  {{ $user->telephone }}</p> <br>
            
            <a class="listitem text-white" href=" {{route('ride.myRides', Auth::User()->id)}} "> 
              <h2> ► Mis viajes</h2>
            </a>

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
