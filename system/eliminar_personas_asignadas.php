<?php
include('conexion.php');
$id=$_REQUEST['id'];
$id_p=$_REQUEST['id_p'];
$anor=$_REQUEST['anor'];

$result=mysqli_query($con, "DELETE FROM rutas_personas WHERE id_personas='$id_p' and id_ruta='$id' ");
header("Location:asignar_personas_ruta.php?id=$id&ano=$anor");
?>
