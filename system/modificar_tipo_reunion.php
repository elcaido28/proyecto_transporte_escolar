<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $tipo=$_POST['tipo'];


$modificar="UPDATE tipo_reunion SET descripr='$tipo' WHERE id_tipo_reunion='$id' ";
$ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_tipo_reunion.php");
 ?>
