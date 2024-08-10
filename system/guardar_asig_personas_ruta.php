<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $id_p=$_REQUEST['id_p'];
	$anor=$_REQUEST['anor'];
if (isset($_REQUEST['idserv'])) {
		$idserv=$_REQUEST['idserv'];
}else{
		$idserv=$_POST['servicio1'];
}

	$ingreso=mysqli_query($con,"INSERT into rutas_personas (servicio,id_personas, id_ruta) values
('$idserv','$id_p','$id')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:asignar_personas_ruta.php?id=$id&ano=$anor");
 ?>
