<?php
include('conexion.php');
$id=$_REQUEST['id'];


$result=mysqli_query($con, "UPDATE buses SET id_estado='2' WHERE id_buses='$id'");

mysqli_close($con);
header("Location:ingreso_bus.php");
?>
