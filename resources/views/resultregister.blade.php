<!DOCTYPE html>
<html lang="es">
<body id="page-top" class="container-fluid">








@if (count($errors)=0)
   
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
    <button type="button" value="Go back!" onclick="history.back()">Atras</button>
@endif


          </body>
          </html>


