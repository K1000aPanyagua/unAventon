<!-- Footer -->
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
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
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">Acerca de nosotros</h4>
            <p class="lead mb-0">Un Aventón está destinado a la búsqueda de viajes para reducir tráfico y abaratar costos. ¿Todavía no te uniste? <a class="rounded js-scroll-trigger portfolio-item" href="#register">Registrate</a> y empezá a ahorrar!</p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">¿Necesitás ayuda?</h4>
            <p class="lead mb-0">Ingresá a nuestra sección de <a href="">preguntas frecuentes</a> para más información. También podés consultar nuestros <a href="">términos y condiciones</a>.</p>
          </div>
          
        </div>
      </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Un Aventón 2018</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    

    <!--LOGIN MODAL -->
    <div class="portfolio-modal mfp-hide" id="login">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Inicio de Sesión</h2>
              <hr class="star-dark mb-5">
              <?php echo validation_errors(); //Retorno cualquier error ?> 

              <?php echo form_open('form'); ?>
            
                <h5>Email: </h5>
                <input type="text" name="email" value="" size="50" />
                <br>
                <br>
                <h5>Contraseña: </h5>
                <input type="password" name="password" value="" size="50" />

                <br>
                <br>
                <button type="submit" class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss">Iniciar sesión</button>
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
   
    <!--REGISTER MODAL-->
    <div class="portfolio-modal mfp-hide" id="register">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Registrarse</h2>
              <hr class="star-dark mb-5">
              <?php echo validation_errors(); //Retorno cualquier error ?> 

              <?php echo form_open('form'); ?>

                <h5>Nombre de usuario: </h5>
                <input type="text" name="username" value="" size="50" />
                <br>
                <br>
                <h5>Contraseña: </h5>
                <input type="text" name="password" value="" size="50" />
                <br>
                <br>
                <h5>Confirmar contraseña: </h5>
                <input type="text" name="passconf" value="" size="50" />
                <br>
                <br>
                <h5>Email: </h5>
                <input type="text" name="email" value="" size="50" />
                <br>
                <br>
              <h5>Provincia: </h5>
              <select>
                  <option value="Buenos Aires">Bs. As.</option>
                  <option value="Catamarca">Catamarca</option>
                  <option value="Chaco">Chaco</option>
                  <option value="Chubut">Chubut</option>
                  <option value="Cordoba">Cordoba</option>
                  <option value="Corrientes">Corrientes</option>
                  <option value="Entre Rios">Entre Rios</option>
                  <option value="Formosa">Formosa</option>
                  <option value="Jujuy">Jujuy</option>
                  <option value="La Pampa">La Pampa</option>
                  <option value="La Rioja">La Rioja</option>
                  <option value="Mendoza">Mendoza</option>
                  <option value="Misiones">Misiones</option>
                  <option value="Neuquen">Neuquen</option>
                  <option value="Rio Negro">Rio Negro</option>
                  <option value="Salta">Salta</option>
                  <option value="San Juan">San Juan</option>
                  <option value="San Luis">San Luis</option>
                  <option value="Santa Cruz">Santa Cruz</option>
                  <option value="Santa Fe">Santa Fe</option>
                  <option value="Sgo. del Estero">Sgo. del Estero</option>
                  <option value="Tierra del Fuego">Tierra del Fuego</option>
                 <option value="Tucuman">Tucuman</option> 
              </select>
              <br>
              <br>
              <h5>Localidad: </h5>
              <input type="text" name="email" value="" size="50" />
              <br>
              <br>
              <h5>Sexo: </h5>
              <input type="text" name="email" value="" size="50" />
              <br>
              <br>
              <button type="submit" class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss">Registrarse</button>

                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url('application/views/assets/freelancer/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('application/views/assets/freelancer/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url('application/views/assets/freelancer/vendor/jquery-easing/jquery.easing.min.js')?>"></script>
    <script src="<?php echo base_url('application/views/assets/freelancer/vendor/magnific-popup/jquery.magnific-popup.min.js')?>"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?php echo base_url('application/views/assets/freelancer/js/jqBootstrapValidation.js')?>"></script>
    <script src="<?php echo base_url('application/views/assets/freelancer/js/contact_me.js')?>"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url('application/views/assets/freelancer/js/freelancer.min.js')?>"></script>

  </body>

</html>
