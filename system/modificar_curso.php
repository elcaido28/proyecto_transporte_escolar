<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $curso=$_POST['curso'];


$modificar="UPDATE curso SET descrip='$curso' WHERE id_curso='$id' ";
$ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_curso.php");
 ?>
