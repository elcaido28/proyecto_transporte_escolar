<?php
	include('conexion.php');
	$fecha=date('Y-m-d');
 	if ($_FILES["img"]["name"]!="") {
   		$foto=$_FILES["img"]["name"];
   		$ruta=$_FILES["img"]["tmp_name"];
   		$logo="img_web/".$foto;
   		copy($ruta,$logo);
 	}else {
   		$logo="img_web/prublicacion.jpg";
	}
	$titulo=$_POST['titulo'];

	$descrip=$_POST['descrip'];
	$estado="1";

	$ingreso=mysqli_query($con,"INSERT into publicaciones (fecha, img, titulo, descripcion, id_estado) values
('$fecha','$logo','$titulo','$descrip','$estado')") or die ("error".mysqli_error());


	// $ingreso=mysqli_query($con,"INSERT into usuarios (cedula,clave,id_privilegio,id_estado) values ('$cedula','$correo','3','$estado')") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_noticias_web.php");
 ?>
