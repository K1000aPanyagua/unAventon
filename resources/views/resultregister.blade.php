<!DOCTYPE html>
<html lang="es">
<body id="page-top" class="container-fluid">





SI ERRORES IGUAL A 0 ESTO




@if (count($errors)=0)
   
        
>>>>>>> 37c6c5ff8254db274f94e9219d4b318090cdb913
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Inicio de Sesión</h2>
              <hr class="star-dark mb-5">
                <h5 class="input-text">Email: </h5>
                <input type="text" name="email" value="" size="50" />
                <h5 class="input-text">Contraseña: </h5>
                <input type="password" name="password" value="" size="50" />
                <br>
                <br>
                <button type="submit" class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss">Iniciar sesión</button>
              
            </div>
          </div>
          
        </div>

   
@else

    <ul>
        @foreach ($errors->all() as $error)
        <li class="alert alert-danger">
            {{$error}}
        </li>
      
    </ul>

<div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Registrarse</h2>
              <hr class="star-dark mb-5">

              <form method="POST" action="{{ route('user.store') }}">
              {{ csrf_field() }}
                <h5>Nombre: </h5>
                <input type="text" name="name" value="" size="50" />
                <br>
                <br>
                <h5>Apellido: </h5>
                <input type="text" name="lastname" value="" size="50" />
                <br>
                <br>
                <h5>Fecha de nacimiento: </h5>
                <input type="date" name="birthdate" min="1950-01-01" max="2000-01-01">
                <br>
                <br>
                <h5>Contraseña: </h5>
                <input type="password" name="pass" value="" size="50" />
                <br>
                <br>
                <h5>Confirmar contraseña: </h5>
                <input type="password" name="passconf" value="" size="50" />
                <br>
                <br>
                <h5>Email: </h5>
                <input type="email" name="email" value="" size="50" />
                <br>
                <br>
                <h5>Género: </h5>
                <select name="gender">
                    <option value="femenino">Femenino</option>
                    <option value="masculino">Masculino</option>
                    <option value="no binario">No binario</option>
                </select>
                <br>
                <br>
                <h5>Teléfono: </h5>
                <input type="string" name="telephone" value="" size="50" />
                <br>
                <br>
                <button type="submit" class="btn btn-primary btn-lg rounded-pill" href="/resultregiter">Registrarse</button>
              </form>
                    </div>
                  </div>
</div>

@if ($errors->has('password'))
    <span class="invalid-feedback">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
@endif


             
         



@endif


          </body>
          </html>


