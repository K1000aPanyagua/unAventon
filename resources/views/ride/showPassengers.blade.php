<!DOCTYPE html>
<html lang="es">
@include('head')
<body id="page-top" class="container-fluid">

@include('menu')

<header class="masthead background-w-imagebgprimary text-white row" style="background-image: url('{{ asset('assets/autos.jpg') }}')">
   
  @foreach ($passengers as $passenger)
    <a href="">{{$passenger->name}}, {{$passenger->lastname}}, {{$passenger->email}}</a>
  @endforeach

  </header>
@include('copyrigtharrow')
@include('javascript')
</body>
</html>