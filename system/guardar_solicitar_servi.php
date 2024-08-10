<?php
	include('conexion.php');
  session_start();
  $fecha=date('Y-m-d');
  $id_c=$_SESSION['ID_usu'];
  $id_p=$_REQUEST['id'];

	$ingreso=mysqli_query($con,"INSERT into solicitud_servicio (fecha,id_clientes,id_personas) values
('$fecha','$id_c','$id_p')") or die ("error".mysqli_error());
$_SESSION['msj']='1';

	mysqli_close($con);
	header("Location:ingreso_solicitud_servi.php");

 ?>
