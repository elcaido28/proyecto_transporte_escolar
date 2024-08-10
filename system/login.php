<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Coop. 13 de Agosto</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="logo.jpg">
   <!--=====================================
  PLUGINS DE CSS
  ======================================-->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../vistas/dist/css/AdminLTE.css">



</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

<style media="screen">
  .btn_tamn{
    width: 40%;
    height: 35px;
  }
</style>
<div id="back"></div>
<div class="login-box">
  <div class="login-logo">
    <center>
      <img src="logo.png" width="100" height="100" class="img-responsive">
    </center>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Ingresar al sistema</p>

    <form action="login_proceso.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="usuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="clave" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <a href="../index.php"><button type="button" class="btn btn-primary btn-block btn-danger">Regresar</button></a>
        </div>
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
      </div>
    </form>
    <br>
  </div>
</div>


  </body>
</html>
