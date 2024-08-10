<?php
	include('conexion.php');

$id=$_REQUEST['id'];

  if ($_FILES["documento"]["name"]!="") {
      $foto2=$_FILES["documento"]["name"];
      $ruta2=$_FILES["documento"]["tmp_name"];
      $doc2="doc_actas_reunion_socios/".$foto2;
      copy($ruta2,$doc);
  }else {
    $result2= mysqli_query($con,"SELECT * from reunion_socios where id_reunion_socios='$id'");
    $row2= mysqli_fetch_assoc($result2);
    $doc2=$row2['documento'];

  }

if ($_FILES["documento2"]["name"]!="") {
		$foto=$_FILES["documento2"]["name"];
		$ruta=$_FILES["documento2"]["tmp_name"];
		$doc="doc_balance_reunion_socios/".$foto;
		copy($ruta,$doc);
}else {
	$result= mysqli_query($con,"SELECT * from reunion_socios where id_reunion_socios='$id'");
	$row= mysqli_fetch_assoc($result);
	$doc=$row['documento2'];
}

	$tipo_reunion=$_POST['tipo_reunion'];
	$numero=$_POST['numero'];
	$asunto=$_POST['asunto'];


	$ingreso=mysqli_query($con,"UPDATE reunion_socios SET numero='$numero',asuntos='$asunto',id_tipo_reunion='$tipo_reunion',documento='$doc2',documento2='$doc'  WHERE id_reunion_socios='$id' ") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_reunion.php");
 ?>
