<?php
include('conexion.php');
session_start();
$_SESSION['msj']='1';
$id=$_REQUEST['id'];

$result=mysqli_query($con, "DELETE FROM solicitud_servicio WHERE id_personas='$id' ");
$result2=mysqli_query($con, "UPDATE personas SET id_estado='1' WHERE id_personas='$id' "); 
header("Location:vista_solicitud.php");
?>
