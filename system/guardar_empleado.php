<?php
	include('conexion.php');
	$fecha=date('Y-m-d');
	$cedula=$_POST['cedula'];
 	if ($_FILES["foto"]["name"]!="") {
   		$foto=$_FILES["foto"]["name"];
   		$ruta=$_FILES["foto"]["tmp_name"];
   		$logo="img_usuarios/".$foto;
   		copy($ruta,$logo);
 	}else {
   		$logo="img_usuarios/defoult.png";
	}


	if ($_FILES["docu"]["name"]!="") {
   		$doc=$_FILES["docu"]["name"];
   		$rutad=$_FILES["docu"]["tmp_name"];
   		$docu="doc_socios/".$doc;
   		copy($rutad,$docu);
 	}else {
   		$docu="";
	}

	$nombres=$_POST['nombres'];
	$apellidos=$_POST['apellidos'];
	$telefono=$_POST['telefono'];
	$direccion=$_POST['direccion'];
	$correo=$_POST['correo'];
	$tipo_empleado=$_POST['tipo_empleado'];

	$estado="1";

	$ingreso=mysqli_query($con,"INSERT into empleados (fecha, nombres, apellidos, cedula, telefono,correo,direccion,foto,documento,id_estado, id_tipo_empleado) values
('$fecha','$nombres','$apellidos','$cedula','$telefono','$correo','$direccion','$logo','$docu','$estado','$tipo_empleado')") or die ("error".mysqli_error());


	if ($tipo_empleado=='4' || $tipo_empleado=='7') {
		$consulta=mysqli_query($con,"SELECT * from empleados order by id_empleados DESC ");
		$row=mysqli_fetch_array($consulta);
		$id_e=$row['id_empleados'];

		$ingreso=mysqli_query($con,"INSERT into deuda_socios (deuda_total , id_empleados) values
	('1500.00','$id_e')") or die ("error".mysqli_error());
	}


	mysqli_close($con);
	header("Location:ingreso_empleado.php");
 ?>
