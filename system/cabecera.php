<?php session_start(); if(isset($_SESSION['ID_usu'])){ if($_SESSION['ID_usu']!=""){ }else{ header("Location:../index.php"); } }else{ header("Location:../index.php"); } ?>
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
<link rel="stylesheet" href="css/sweetalert2.min.css">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
   <link rel="stylesheet" href="css/jquery.dataTables.min.css">
   <!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">

  <!-- <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
  <link rel="stylesheet" href="../vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../vistas/plugins/iCheck/all.css">
   <!-- Daterange picker -->
  <link rel="stylesheet" href="../vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../vistas/bower_components/morris.js/morris.css">
<script src="https://kit.fontawesome.com/805c37e370.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/estilos.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="../vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="js/jquery.dataTables.min.js"></script>

  <!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" charset="utf-8"></script> -->
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" charset="utf-8"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" charset="utf-8"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" charset="utf-8"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" charset="utf-8"></script>

  <!-- <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script> -->
  <script src="../vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="js/sweetalert2.min.js"></script>
<!--   <script src="../vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
   By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="../vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="../vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="../vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="../vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="../vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="../vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="../vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="../vistas/bower_components/Chart.js/Chart.js"></script>
<!-- VALIDACIONES JS PARA FORMULARIOS -->
  <script src="js/valida_todo.js"></script>


</head>
<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
  <header class="main-header">

 	<!--=====================================
 	LOGOTIPO
 	======================================-->
     <a href="inicio.php" class="logo">
       <!-- mini logo for sidebar mini 50x50 pixels -->
       <span class="logo-mini"><i class="fas fa-bus-alt"></i> </span>
       <!-- logo for regular state and mobile devices -->
       <span class="logo-lg"><b>COOP.</b> 13 De Agosto</span>
     </a>

 	<!--=====================================
 	BARRA DE NAVEGACIÓN
 	======================================-->
 	<nav class="navbar navbar-static-top" role="navigation">

 		<!-- Botón de navegación -->

 	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

         	<span class="sr-only">Toggle navigation</span>

       	</a>

 		<!-- perfil de usuario -->

 		<div class="navbar-custom-menu">

 			<ul class="nav navbar-nav">

 				<li class="dropdown user user-menu">

 					<a href="#" class="dropdown-toggle" data-toggle="dropdown">




 						<img src="<?php echo $_SESSION['FOTO']; ?>" class="user-image">

 						<span class="hidden-xs"><?php echo $_SESSION['NU']; ?></span>

 					</a>

 					<!-- Dropdown-toggle -->

 					<ul class="dropdown-menu">

 						<li class="user-body">

 							<div class="pull-right">

 								<a href="salir.php" class="btn btn-default btn-flat">Salir</a>

 							</div>

 						</li>

 					</ul>

 				</li>

 			</ul>

 		</div>

 	</nav>

  </header>
