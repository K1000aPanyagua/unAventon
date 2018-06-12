<?php      
  if(!Auth::check()){
  ?>
  <header class="masthead bg-primary text-white text-center row">
    <div class="container">
    <h2 class="text-uppercase mb-0">Unete a un aventón</h2>
    <hr class="star-light">
    <h2 class="font-weight-light mb-0"> Viajes mas baratos - Viajes acompañado - Viajes mas comodos </h2>
    </div> 
   </header>
<?php } 
    else{ 
    ?>
      <header class="masthead bg-primary text-white text-center row">
         <h2 class="text-uppercase separator-m col-sm-12">  ¡Hola {{Auth::User()->name}}! </h2>
      </header>
      
      <?php  
    }
  ?>