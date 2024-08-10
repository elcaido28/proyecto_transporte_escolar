<?php
include('conexion.php');
$id=$_REQUEST['id'];

$result=mysqli_query($con, "DELETE FROM tipo_reunion WHERE id_tipo_reunion='$id' ");
header("Location:ingreso_tipo_reunion.php");
?>
