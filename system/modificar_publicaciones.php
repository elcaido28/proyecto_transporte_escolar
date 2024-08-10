<?php
	include('conexion.php');
$id=$_REQUEST['id'];
 	if ($_FILES["img"]["name"]!="") {
   		$foto=$_FILES["img"]["name"];
   		$ruta=$_FILES["img"]["tmp_name"];
   		$logo="img_web/".$foto;
   		copy($ruta,$logo);
 	}else {
    $result2= mysqli_query($con,"SELECT * from publicaciones where id_publicaciones='$id'");
    $row2= mysqli_fetch_assoc($result2);
    $logo=$row2['img'];
	}
	$titulo=$_POST['titulo'];

	$descrip=$_POST['descrip'];


	$modif=mysqli_query($con,"UPDATE publicaciones SET img='$logo', titulo='$titulo', descripcion='$descrip' where id_publicaciones='$id' ") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_noticias_web.php");
 ?>
