<?php
	include('conexion.php');
	$fecha=date('Y-m-d');
	$cedula=$_POST['cedula'];
 	if ($_FILES["foto"]["name"]!="") {
   		$foto=$_FILES["foto"]["name"];
   		$ruta=$_FILES["foto"]["tmp_name"];
   		$logo="img_ayudantes/".$foto;
   		copy($ruta,$logo);
 	}else {
   		$logo="img_usuarios/defoult.png";
	}
  if ($_FILES["documento"]["name"]!="") {
      $foto2=$_FILES["documento"]["name"];
      $ruta2=$_FILES["documento"]["tmp_name"];
      $doc="doc_ayudantes/".$foto2;
      copy($ruta2,$doc);
  }else {
      $doc="";
  }
	$nombres=$_POST['nombres'];
	$telefono=$_POST['telefono'];
  $telefono2=$_POST['telefono2'];
	$direccion=$_POST['domicilio'];
	$civil=$_POST['civil'];

	$estado="1";

	$ingreso=mysqli_query($con,"INSERT into ayudante (fecha,foto, nombres, cedula,estado_civil,domicilio, telefono,telefono2,documento,id_estado) values
('$fecha','$logo','$nombres','$cedula','$civil','$direccion','$telefono','$telefono2','$doc','$estado')") or die ("error".mysqli_error());


	// $ingreso=mysqli_query($con,"INSERT into usuarios (cedula,clave,id_privilegio,id_estado) values ('$cedula','$correo','3','$estado')") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_ayudante.php");
 ?>
