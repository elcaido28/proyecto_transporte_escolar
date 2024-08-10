<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $cargo=$_POST['cargo'];


$modificar="UPDATE tipo_empleado SET descrip='$cargo' WHERE id_tipo_empleado='$id' ";
$ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_cargo.php");
 ?>
