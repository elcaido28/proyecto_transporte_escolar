<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
	$tiperso=$_REQUEST['tp'];
	$fecha=date('Y-m-d');
 	if ($_FILES["foto"]["name"]!="") {
   		$foto=$_FILES["foto"]["name"];
   		$ruta=$_FILES["foto"]["tmp_name"];
   		$logo="img_personas/".$foto;
   		copy($ruta,$logo);
 	}else {
   		$logo="img_personas/defoult.png";
	}
	$nombres=$_POST['nombres'];
	$apellidos=$_POST['apellidos'];
	$telefono=$_POST['telefono'];
	$direciion=$_POST['direccion'];
	if($tiperso=='2'){
		$curso="14";
		$paralelo="---";
		$tiempos="";
		$otro_tiempo="";
		$servicio='1';
		$extracurricular='1';
	}else{
	$curso=$_POST['curso'];
	$paralelo=$_POST['paralelo'];
	$tiempos=$_POST['tiempos'];
		$otro_tiempo=$_POST['otro_tiempo'];
		if ($_POST['servicio1']!="") {
	    $servicio=$_POST['servicio1'];
	  }else{
	      $servicio=$_POST['servicio2'];
	  }
		$extracurricular=$_POST['extracurricular'];
}
	$estado="1";

	$ingreso=mysqli_query($con,"INSERT into personas (fecha, nombre, apellido, telefono,direccion,id_curso,paralelo,tiempo_servicio,otro_tiempo,id_servicio,id_extracurricular,foto, id_clientes,id_estado) values
('$fecha','$nombres','$apellidos','$telefono','$direciion','$curso','$paralelo','$tiempos','$otro_tiempo','$servicio','$extracurricular','$logo','$id','$estado')") or die ("error".mysqli_error());


	// $ingreso=mysqli_query($con,"INSERT into usuarios (cedula,clave,id_privilegio,id_estado) values ('$cedula','$correo','3','$estado')") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:asignar_personas.php?id=$id");
 ?>
