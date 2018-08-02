<!DOCTYPE html>
<html lang="es">

@include('head')
<body id="page-top" class="container-fluid">
<!--Body -->

@include('menu')

<header class="masthead bg-primary text-white text-center row">
    <div class="container">
    <h2 class="text-uppercase mb-0">Un aventón</h2>
    <hr class="star-light">
    <h2 class="font-weight-light mb-0"> Preguntas frecuentes </h2>
    <br>
    	¿Quiénes somos?<br>
      	Somos un grupo de viajeros frecuentes que pensamos una posible idea para reducir el tráfico, abaratar costos, aprovechar esos asientos libres que nos quedan en el auto y transportar gente. Dividir el gasto, y hacer más ameno el viaje. <br><br>

      	¿Qué necesito para empezar a publicar un viaje? <br>
      	Necesitarás una dirreción de correo electrónico para poder registrarte en el sistema, una tarjeta para realizar los pagos y un vehículo para relalizar los viajes. <br><br>

      	¿Es necesario registrar un auto para utilizar el sistema?<br>
      	No. Podés unirte como copiloto a cualquiera de los viajes sin necesidad de tener un vehiculo. Recordá que si es obligatorio para poder publicar tu propio viaje. <br><br>

      	¿Cuáles son los medios de pago?<br>
      	Los pagos son a través de tarjeta de crédito. Se debe registrar una tarjeta para poder publicar un viaje propio y/o pagar viajes a los que te sumes. El monto a pagar es un 5% del total de la publicación. <br><br>

      	¿Qué pasa si debo rescindir de un viaje?<br>
      	Nosotros manejamos un sistema de calificaciones en donde los usuarios hacen la "ley" dentro de la página. Si publicaste un viaje éste deberá ser abonado. A su vez, si querés eliminarlo y tenés usuarios asociados, tu reputación general será penalizada. Así, los demás usuarios pueden chequearla, y elegir antes de compartir un aventón con vos. La penalización resta 1 punto por cada copilto asociado a tu viaje.<br><br>

      	¿Qué sucede si nadie se une a mi viaje? <br>
      	Deberás abonar tu parte y la de los asientos que ofreciste en la publicación. <br><br>

      	¿Qué pasa si olvido la contraseña de mi cuenta? <br>
      	Podés restablecer la contraseña asociada a tu cuenta seleccionando la opción "Olvidé mi contraseña" en la pantalla de inicio de sesión. Allí solo hace falta seguir los pasos indicando tu dirección de correo y podrás reestablecer tu contraseña. <br><br>

      	¿Cómo puedo desactivar mi cuenta?<br>
      	Puedes desactivar tu cuenta por tiempo indefinido cuando quieras entrando en tu perfil, en la opción "desactivar mi cuenta" ó en la pantalla de configuración de cuenta a la que se accede a través de la pestaña del menú superior. Nadie podrá ver tu perfil hasta que decidas reactivar tu cuenta. <br><br>
    </div> 
   </header>
     
<!--fin header-->
<!-- Footer modificado -->
    <footer class="footer text-center row">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Seguinos en las redes sociales</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/" target="_blank">
                  <i class="fa fa-fw fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.instagram.com/" target="_blank">
                  <i class="fa fa-fw fa-instagram"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://twitter.com/" target="_blank">
                  <i class="fa fa-fw fa-twitter"></i>
                </a>
              </li>
            </ul>
            <br>
            <p class="lead mb-0">La Plata, Buenos Aires, Argentina.</p>
          </div>
          <div class="col-md-6">
            <h4 class="text-uppercase mb-4">Acerca de nosotros</h4>
            <p class="lead mb-0">Un Aventón está destinado a la búsqueda de viajes para reducir tráfico y abaratar costos. ¿Todavía no te uniste? <a href="/register">Registrate</a> y empezá a ahorrar!</p>
          </div>
          
          
        </div>
      </div>
    </footer>

    @include('copyrigtharrow')
@include('javascript')
</body>
</html>