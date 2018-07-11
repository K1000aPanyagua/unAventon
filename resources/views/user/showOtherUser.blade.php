<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')


<header class="masthead bg-primary text-white text-left row">
  <div class="containernew">
    <div class="row">
   
    <div class="col-sm-8">   
       <div class="color-aventon-bk">
         <h2 class="text-uppercase text-center separator-m col-sm-12">{{ $user->name }} {{ $user->lastname }}</h2> 
            
            <p>► Nombre: {{ $user->name }}</p> <br>
            <p>► Apellido:  {{ $user->lastname }}</p> <br>
            <p>► Fecha de nacimiento:  {{ $user->birthdate }}</p> <br>
            <p>► Email:  {{ $user->email }}</p> <br>
            <p>► Teléfono:  {{ $user->telephone }}</p> <br>
            
            

            </div>
    </div>

        
  

    </div>
  </div>
</header>


@include('fill')
<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>
