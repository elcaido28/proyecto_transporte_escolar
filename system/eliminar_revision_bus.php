<?php
include('conexion.php');
$id=$_REQUEST['id'];

$result=mysqli_query($con, "DELETE FROM revision_vehiculo WHERE id_revision_vehiculo='$id' ");
header("Location:ingreso_revision_bus.php");
?>
