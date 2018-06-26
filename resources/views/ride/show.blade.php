
<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    <h1 class="text-uppercase separator-l col-sm-12">datos del viaje</h1>  
      <div class="row" >
          {{ $ride->origin }} 
          {{ $ride->destination }} 
          {{ $ride->duraton}} 
          {{ $ride->amount }} 
          {{ $ride->remarks }} 
          {{ $ride->departHour }}
          {{ $ride->departDate }} 
          {{$car->kind}}
          
          @if ($comments == 'Aún no hay comentarios')
            {{$comments}}
          @else
            @foreach ($comments as $comment)
              {{$comment->content}}
            @endforeach
          @endif
        
      </div>
       <a class="btn" href="{{ route('ride.edit', $ride->id) }}">Editar</a>
  </div>
</header>

<a class="btn btn-primary" href="/"> 
  Volver al inicio 
</a>




<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>
