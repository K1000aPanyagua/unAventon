<!DOCTYPE html>
<html lang="es">

@include('head')

@include('menu')
@include('flash_message')
<form method="POST" action="{{ action('Auth\RegisterController@register') }}">
    @csrf
<div class="form-group row">
    <label for="pass" class="col-md-4 col-form-label text-md-right">{{ __(' Contraseña') }}*</label>

    <div class="col-md-6">
        <input id="pass" type="password" class="form-control{{ $errors->has('pass') ? ' is-invalid' : '' }}" name="pass" required oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

        @if ($errors->has('pass'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('pass') }}</strong>
            </span>
        @endif
</div>

<div class="form-group row">
    <label for="pass" class="col-md-4 col-form-label text-md-right">{{ __('Nueva contraseña') }}*</label>

    <div class="col-md-6">
        <input id="newPass" type="password" class="form-control{{ $errors->has('pass') ? ' is-invalid' : '' }}" name="pass" required oninvalid="this.setCustomValidity('Campo obligatorio')"
                                    oninput="setCustomValidity('')">

        @if ($errors->has('pass'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('pass') }}</strong>
            </span>
        @endif
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}*</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required oninput="check2(this)">
    </div>
    <script language='javascript' type='text/javascript'>
        function check2(input) {
            if (input.value != document.getElementById('pass').value) {
                input.setCustomValidity('Las contraseñas deben coincidir.');
            } else {
                // input is valid -- reset the error message
                input.setCustomValidity('');
            }
                                    }
    </script>

</div>
</form>

@include('footer')
@include('modal')
@include('javascript')

</html>