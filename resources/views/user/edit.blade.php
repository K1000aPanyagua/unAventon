 

<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')

<header class="masthead bg-primary text-white text-center row">
      <h1 class="text-uppercase  col-sm-12">Editar mis datos</h1>
      <p class="separator-l col-sm-12"> * Campo obligatorio</p>
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @include('flash_message')

                    <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}*</label>
                            
                            <div class="col-md-6">
                                
                                <input value="{{ $user->name }}" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}*</label>

                            <div class="col-md-6">
                                <input id="lastname" type="string" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $user->lastname }}" required autofocus oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <label class="col-md-4 col-form-label text-md-right">Género</label>
                            <select name="gender" required="required">
                                <option value="">Seleccionar</option>
                                <option value="M" @if ($user->gender == "M") {{ 'selected' }} @endif>Masculino</option>
                                <option value="F" @if ($user->gender == "F") {{ 'selected' }} @endif>Femenino</option>
                            </select>

                            <div class="form-group row">
                                <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="string" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{$user->telephone}}">

                                    @if ($errors->has('telephone'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('telephone') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <label class="col-md-4 col-form-label text-md-right">Fecha de nacimiento*</label>
                        <input value="{{ $user->birthdate }}" type="date" name="birthdate" min="1950-01-01" max="2000-01-01" required="required">

                        <br><br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
</div>
</header>



</body>
<!--fin header-->
@include('footer')
@include('javascript')
</html>
