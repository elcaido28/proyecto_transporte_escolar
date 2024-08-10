<?php
include('conexion.php');
	$id=$_REQUEST['id'];
  $cedula=$_POST['cedula'];
 	if ($_FILES["foto"]["name"]!="") {
   		$foto=$_FILES["foto"]["name"];
   		$ruta=$_FILES["foto"]["tmp_name"];
   		$logo="img_usuarios/".$foto;
   		copy($ruta,$logo);
 	}else{
    $result2= mysqli_query($con,"SELECT * from empleados where id_empleados='$id'");
    $row2= mysqli_fetch_assoc($result2);
    $logo=$row2['foto'];
	}

	if ($_FILES["docu"]["name"]!="") {
   		$doc=$_FILES["docu"]["name"];
   		$rutad=$_FILES["docu"]["tmp_name"];
   		$docu="doc_socios/".$doc;
   		copy($rutad,$docu);
 	}else {
		$result2= mysqli_query($con,"SELECT * from empleados where id_empleados='$id'");
		$row2= mysqli_fetch_assoc($result2);
		$docu=$row2['documento'];
	}


	$nombres=$_POST['nombres'];
	$apellidos=$_POST['apellidos'];
	$telefono=$_POST['telefono'];
	$direccion=$_POST['direccion'];
	$correo=$_POST['correo'];
	$tipo_empleado=$_POST['tipo_empleado'];





	$modificar="UPDATE empleados SET nombres='$nombres', apellidos='$apellidos', cedula='$cedula', telefono='$telefono',correo='$correo',direccion='$direccion',foto='$logo',documento='$docu', id_tipo_empleado='$tipo_empleado' WHERE id_empleados='$id' ";
	$ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());
	mysqli_close($con);
	header("Location:ingreso_empleado.php");
 ?>
