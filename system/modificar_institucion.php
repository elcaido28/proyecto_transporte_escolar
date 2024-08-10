<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $nombre=$_POST['nombre'];
  $descrip=$_POST['descrip'];


$modificar="UPDATE institucion SET nombre='$nombre',descrip='$descrip' WHERE id_institucion='$id' ";
$ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_institucion.php");
 ?>
