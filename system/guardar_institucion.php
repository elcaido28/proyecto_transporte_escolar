<?php
	include('conexion.php');
  $nombre=$_POST['nombre'];
  $descrip=$_POST['descrip'];

	$ingreso=mysqli_query($con,"INSERT into institucion (nombre,descrip) values
('$nombre','$descrip')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:ingreso_institucion.php");
 ?>
