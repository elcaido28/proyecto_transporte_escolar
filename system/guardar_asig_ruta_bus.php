<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $id_r=$_REQUEST['id_r'];

	$ingreso=mysqli_query($con,"INSERT into rutas_bus (id_bus, id_rutas) values
('$id','$id_r')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:asignar_rutas.php?id=$id");
 ?>
