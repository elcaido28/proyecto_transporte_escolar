<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $tiperso=$_REQUEST['tp'];
	$idc=$_REQUEST['idc'];

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
		$servicio='4';
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


	$ingreso=mysqli_query($con,"UPDATE personas SET nombre='$nombres', apellido='$apellidos', telefono='$telefono',direccion='$direciion',id_curso='$curso',paralelo='$paralelo',
    tiempo_servicio='$tiempos',otro_tiempo='$otro_tiempo',id_servicio='$servicio',id_extracurricular='$extracurricular',foto='$logo' where id_personas='$id' ") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:asignar_personas.php?id=$idc");
 ?>
