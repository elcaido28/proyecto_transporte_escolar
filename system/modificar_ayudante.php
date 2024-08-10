<?php
	include('conexion.php');

$id=$_REQUEST['id'];
	$cedula=$_POST['cedula'];
 	if ($_FILES["foto"]["name"]!="") {
   		$foto=$_FILES["foto"]["name"];
   		$ruta=$_FILES["foto"]["tmp_name"];
   		$logo="img_ayudantes/".$foto;
   		copy($ruta,$logo);
 	}else {
    $result2= mysqli_query($con,"SELECT * from ayudante where id_ayudante='$id'");
    $row2= mysqli_fetch_assoc($result2);
    $logo=$row2['foto'];
	}
  if ($_FILES["documento"]["name"]!="") {
      $foto2=$_FILES["documento"]["name"];
      $ruta2=$_FILES["documento"]["tmp_name"];
      $doc="doc_ayudantes/".$foto2;
      copy($ruta2,$doc);
  }else {
    $result2= mysqli_query($con,"SELECT * from ayudante where id_ayudante='$id'");
    $row2= mysqli_fetch_assoc($result2);
    $doc=$row2['documento'];

  }
	$nombres=$_POST['nombres'];
	$telefono=$_POST['telefono'];
  $telefono2=$_POST['telefono2'];
	$direccion=$_POST['domicilio'];
	$civil=$_POST['civil'];


	$ingreso=mysqli_query($con,"UPDATE ayudante SET foto='$logo', nombres='$nombres', cedula='$cedula',estado_civil='$civil',domicilio='$direccion', telefono='$telefono',telefono2='$telefono2',documento='$doc'  WHERE id_ayudante='$id' ") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_ayudante.php");
 ?>
