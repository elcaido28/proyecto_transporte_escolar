<?php
include('conexion.php');
$id=$_REQUEST['id'];
$est=$_REQUEST['est'];

if($est==4){
  $result=mysqli_query($con, "UPDATE revision_vehiculo SET id_estado='3' WHERE id_revision_vehiculo='$id'");
}
if($est==3){
  $result=mysqli_query($con, "UPDATE revision_vehiculo SET id_estado='4' WHERE id_revision_vehiculo='$id'");
}


mysqli_close($con);
header("Location:ingreso_revision_bus.php");
?>
