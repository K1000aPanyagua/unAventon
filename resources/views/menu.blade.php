<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
  <div class="container">
    <a href="/"><img class="img-logo" src="{{asset('assets/Logo.jpg')}}"></a>
    
    <a style="font-size: xx-large; text-align: left;" class=" disapear-xs navbar-brand js-scroll-trigger" href="/">Un Aventón</a>
    
    <button class="navbar-toggler navbar-toggler-right text-uppercase color-aventon text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      @include('menuphp')
    </div>
  </div>
</nav> 