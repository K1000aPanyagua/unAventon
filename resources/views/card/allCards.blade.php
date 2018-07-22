<!DOCTYPE html>
<html lang="es">

@include('head')

<body id="page-top" class="container-fluid">
<!--Body -->
@include('menu')



<header class="masthead bg-primary text-white text-center row">
  <div class="container">
    @include('flash_message')
    <h1 class="text-uppercase separator-l col-sm-12">Seleccionar tarjeta:</h1>  

    @foreach($cards as $card)
      <div class="row" >

      

           Fecha de vencimiento: {{ $card->expiration }}, Número: {{ $card->numCard }} 


           <form action="{{ route('card.destroy', $card->id) }}" method="POST" onsubmit="return ConfirmDelete()">
                {{method_field('DELETE')}}
                {{ csrf_field() }}
                 <input type="submit" class="btn btn-outline-light text-center color-aventon" value="Eliminar"/>
                <script>
                  function ConfirmDelete(){
                    var x = confirm("¿Está seguro que quiere eliminar la tarjeta?");
                    if (x)
                      return true;
                    else
                      return false;
                  }
                </script>
              </form>

              
      
      </div>
    @endforeach
    <div class="col-lg-4 offset-4">
        <a class="btn btn-xl btn-outline-light text-center color-aventon" href="/configurationAccount">
          Volver
        </a>
    </div>
  </div>
</header>




<!--fin header-->
@include('copyrigtharrow')
@include('javascript')
</body>
</html>
