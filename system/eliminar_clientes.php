<?php
include('conexion.php');
$id=$_REQUEST['id'];

$result=mysqli_query($con, "UPDATE clientes SET id_estado='2' WHERE id_clientes='$id'");

mysqli_close($con);
header("Location:ingreso_clientes.php");
?>
