<?php
	include('conexion.php');

  $fecha=date('Y-m-d');
  $numero=$_POST['numero'];
  $asunto=$_POST['asunto'];
	$tipo_reunion=$_POST['tipo_reunion'];
  if ($_FILES["documento"]["name"]!="") {
      $foto2=$_FILES["documento"]["name"];
      $ruta2=$_FILES["documento"]["tmp_name"];
      $doc2="doc_actas_reunion_socios/".$foto2;
      copy($ruta2,$doc2);
  }else {
      $doc2="";
  }

	if ($_FILES["documento2"]["name"]!="") {
      $foto=$_FILES["documento2"]["name"];
      $ruta=$_FILES["documento2"]["tmp_name"];
      $doc="doc_balance_reunion_socios/".$foto;
      copy($ruta,$doc);
  }else {
      $doc="";
  }

	$ingreso=mysqli_query($con,"INSERT into reunion_socios (fecha,numero,asuntos,id_tipo_reunion,documento,documento2) values
('$fecha','$numero','$asunto','$tipo_reunion','$doc2','$doc')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:ingreso_reunion.php");
 ?>
