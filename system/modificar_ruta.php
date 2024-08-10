<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $nruta=$_POST['nruta'];
	$sector=$_POST['sector'];
	$tipo=$_POST['tipo'];
	$descrip=$_POST['descrip'];

	$ingreso=mysqli_query($con,"UPDATE ruta SET num_ruta='$nruta', sector='$sector', tipo='$tipo',descripcion='$descrip' WHERE id_ruta='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:ingreso_ruta.php");
 ?>
