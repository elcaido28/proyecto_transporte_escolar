<?php
include('conexion.php');
$id=$_REQUEST['id'];


$result=mysqli_query($con, "UPDATE ruta SET id_estado='2' WHERE id_ruta='$id'");

mysqli_close($con);
header("Location:ingreso_ruta.php");
?>
