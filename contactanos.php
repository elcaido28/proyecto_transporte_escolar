

<?php include('menu_publi.php'); ?>
<br><br><br><br><br>
<style media="screen">
  .conte_contacto{
    width: 100%;
    height: 400px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }
  .mapa{
    width: 98%;
    height: 98%;
    margin: 1%;
  }
  .contorno{
    background: rgb(255, 255, 255);
    -webkit-box-shadow: 0px 3px 40px -16px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 3px 40px -16px rgba(0,0,0,0.75);
box-shadow: 0px 3px 40px -16px rgba(0,0,0,0.75);
  }
  .contorno form{
    margin-top: 20px;
  }
  .btn-contac{
    border: 1px solid rgb(244, 244, 244);
    background: rgb(222, 221, 94);
    border-radius: 5px;
    width: 250px;
    height: 40px;

  }
</style>
<div class="conte_contacto">
  <div class="col-lg-6 mt-4 mt-lg-0 contorno">
    <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.770181188323!2d-79.8966191856432!3d-2.2397838983674734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x902d6fb8fbe130f9%3A0xda83f2b625000f41!2sUniversidad%20Agraria%20del%20Ecuador!5e0!3m2!1ses!2sec!4v1600754998475!5m2!1ses!2sec"  frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </div>
  <?php
    if (isset($_POST['name'])) {
      $nombre=$_POST['name'];
      $email=$_POST['email'];
      $asunto=$_POST['subject'];
      $mensaje=$_POST['message'];
      include('system/ENVIAR_CORREOS/envio_correo_pagina.php');
    }

   ?>
  <div class="col-lg-5 mt-4 mt-lg-0 contorno">
    <form action="" method="post" role="form" class="php-email-form">
      <div class="form-row">
        <div class="col-md-5 form-group">
          <input type="text" name="name" class="form-control" id="name" placeholder="Tu Nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
          <div class="validate"></div>
        </div>
        <div class="col-md-5 form-group">
          <input type="email" class="form-control" name="email" id="email" placeholder="Tu Correo" data-rule="email" data-msg="Please enter a valid email" />
          <div class="validate"></div>
        </div>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
        <div class="validate"></div>
      </div>
      <div class="form-group">
        <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Mensaje"></textarea>
        <div class="validate"></div>
      </div>
      <div class="mb-3">
        <!-- <div class="loading">Loading</div>
        <div class="error-message"></div>
        <div class="sent-message">Your message has been sent. Thank you!</div> -->
      </div>
      <div class="text-center"><button type="submit" class="btn-contac">Enviar Mensaje</button></div>
    </form>
  </div>
</div>

<?php include('footer.php'); ?>
