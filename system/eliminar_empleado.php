<?php
include('conexion.php');
$id=$_REQUEST['id'];


$result=mysqli_query($con, "UPDATE empleados SET id_estado='2' WHERE id_empleados='$id'");

mysqli_close($con);
header("Location:ingreso_empleado.php");
?>
