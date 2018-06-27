<!DOCTYPE html>
<html lang="es">

@include('head')


<body id="page-top" class="container-fluid">
<!--Body -->

@include('menu')
<header class="masthead bg-primary text-white text-center row">
      
    <h1 class="text-uppercase  col-sm-12">Cambiar contraseña</h1>
    <p class="separator-l col-sm-12"> * Campo obligatorio</p>
    
    <div class="container text-center">
        <div class="row justify-content-center">
        <div class="col-md-8">
          @include('flash_message')
          <form method="POST" action="{{ action('UserController@updatePassword') }}">
          @csrf
          <div class="form-group row">
            <label for="pass" class="col-md-4 col-form-label text-md-right">Contraseña*
            </label>
            <div class="col-md-6">
              <input id="pass" type="password" class="form-control{{ $errors->has('pass') ? ' is-invalid' : '' }}" name="pass" required oninvalid="this.setCustomValidity('Campo obligatorio')"   oninput="setCustomValidity('')">

              @if ($errors->has('pass'))
                 <span class="invalid-feedback">
                   <strong>{{ $errors->first('pass') }}</strong>
                 </span>
              @endif

            </div>
          </div>
          <div class="form-group row">
            <label for="nuevaContraseña" class="col-md-4 col-form-label text-md-right">Nueva contraseña*</label>

            <div class="col-md-6">
               <input id="nuevaContraseña" type="password" class="form-control{{ $errors->has('nuevaContraseña') ? ' is-invalid' : '' }}" name="nuevaContraseña" required oninvalid="this.setCustomValidity('Campo obligatorio')" oninput="setCustomValidity('')">

               @if ($errors->has('nuevaContraseña'))
                 <span class="invalid-feedback">
                   <strong>{{ $errors->first('nuevaContraseña') }}</strong>
                 </span>
                @endif
            </div>
           </div>
           <div class="form-group row">
             <label for="password-confirmation" class="col-md-4 col-form-label text-md-right">Confirmar contraseña*</label>

             <div class="col-md-6">
              <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" required oninput="check2(this)">
             </div>
             <script language='javascript' type='text/javascript'>
                function check2(input) {
                  if (input.value != document.getElementById('nuevaContraseña').value) {
                     input.setCustomValidity('Las contraseñas deben coincidir.');
                  } else {
                     // input is valid -- reset the error message
                     input.setCustomValidity('');
                  }
                }
               </script>

            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Confirmar
                    </button>
                </div>
            </div>  
        </form>
      </div>
    </div>
   </div>
</header>


<!--fin header-->
@include('footer')
@include('javascript')
</body>
</html>
