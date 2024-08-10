<?php
	include('conexion.php');

  $id=$_REQUEST['id'];
  $placa=$_POST['placa'];
	$marca=$_POST['marca'];
	$modelo=$_POST['modelo'];
	$ano=$_POST['ano'];
	$chasis=$_POST['chasis'];
	$motor=$_POST['motor'];
	$caduca_matricula=$_POST['caduca_matricula'];
  $capacidad=$_POST['capacidad'];
  $descrip=$_POST['descrip'];
  $dueno=$_POST['dueno'];
  $conductor=$_POST['conductor'];
  $ayudante=$_POST['ayudante'];
  $institucion=$_POST['institucion'];

	$ingreso=mysqli_query($con,"UPDATE buses SET  placa='$placa', marca='$marca', modelo='$modelo', ano='$ano',chasis='$chasis',motor='$motor',caduca_matricula='$caduca_matricula'
    ,capacidad='$capacidad',descripcion='$descrip',dueno='$dueno', conductor='$conductor',id_ayudante='$ayudante',id_institucion='$institucion' WHERE id_buses='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:ingreso_bus.php");
 ?>
