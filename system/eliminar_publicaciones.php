<?php
include('conexion.php');
$id=$_REQUEST['id'];

$result=mysqli_query($con, "DELETE FROM publicaciones WHERE id_publicaciones='$id' ");
header("Location:ingreso_noticias_web.php");
?>
