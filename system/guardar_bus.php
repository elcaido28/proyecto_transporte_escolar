<?php
	include('conexion.php');
	$fecha=date('Y-m-d');
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

	$estado="1";

	$ingreso=mysqli_query($con,"INSERT into buses (fecha, placa, marca, modelo , ano,chasis ,motor ,caduca_matricula ,capacidad,descripcion ,dueno, conductor,id_estado,id_ayudante,id_institucion ) values
('$fecha','$placa','$marca','$modelo','$ano','$chasis','$motor','$caduca_matricula','$capacidad','$descrip','$dueno','$conductor','$estado','$ayudante','$institucion')") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_bus.php");
 ?>
