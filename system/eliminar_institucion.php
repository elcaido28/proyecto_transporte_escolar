<?php
include('conexion.php');
$id=$_REQUEST['id'];

$result=mysqli_query($con, "DELETE FROM institucion WHERE id_institucion='$id' ");
header("Location:ingreso_institucion.php");
?>
