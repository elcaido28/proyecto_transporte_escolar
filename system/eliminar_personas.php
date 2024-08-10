<?php
include('conexion.php');
$id=$_REQUEST['id'];
$idc=$_REQUEST['idc'];

$result=mysqli_query($con, "UPDATE personas SET id_estado='2' WHERE id_personas='$id' "); 

header("Location:asignar_personas.php?id=$idc");
?>
