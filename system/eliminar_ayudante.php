<?php
include('conexion.php');
$id=$_REQUEST['id'];


$result=mysqli_query($con, "UPDATE ayudante SET id_estado='2' WHERE id_ayudante='$id'");

mysqli_close($con);
header("Location:ingreso_ayudante.php");
?>
                                                                                                                                                                           
