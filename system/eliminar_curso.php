<?php
include('conexion.php');
$id=$_REQUEST['id'];

$result=mysqli_query($con, "DELETE FROM curso WHERE id_curso='$id' ");
header("Location:ingreso_curso.php");
?>
