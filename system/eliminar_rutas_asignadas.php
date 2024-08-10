<?php
include('conexion.php');
$id=$_REQUEST['id'];
$id_r=$_REQUEST['id_r'];
$result=mysqli_query($con, "DELETE FROM rutas_bus WHERE id_rutas='$id_r' and id_bus='$id' ");
header("Location:asignar_rutas.php?id=$id");
?>
