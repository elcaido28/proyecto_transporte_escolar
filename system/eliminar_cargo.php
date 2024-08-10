<?php
include('conexion.php');
$id=$_REQUEST['id'];

$result=mysqli_query($con, "DELETE FROM tipo_empleado WHERE id_tipo_empleado='$id' ");
header("Location:ingreso_cargo.php");
?>
