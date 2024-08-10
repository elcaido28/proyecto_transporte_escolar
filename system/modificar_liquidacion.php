<?php
	include('conexion.php');
  $idlip=$_REQUEST['idliq'];
  $cont=$_REQUEST['cont'];
  $idrb=$_REQUEST['idrb'];
  $id_persona=$_POST['pasajero'];
  $total=$_POST['total'];


$modificar="UPDATE pago_liquidacion SET total='$total',id_personas='$id_persona' WHERE id_pago_liquidacion='$idlip' ";
$ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());

$result=mysqli_query($con, "DELETE FROM detalle_pago_liquidacion WHERE id_pago_liquidacion='$idlip' ");
for ($i=0; $i <=$cont ; $i++) {
  $idmes='mes'.$i;
  $idpago='pago'.$i;
  $mess=$_POST[$idmes];
  $pagos=$_POST[$idpago];
  $ingreso2=mysqli_query($con,"INSERT into detalle_pago_liquidacion (mes,valor,id_pago_liquidacion) values
('$mess','$pagos','$idlip')") or die ("error".mysqli_error());

}

mysqli_close($con);
header("Location:asignar_pago_liquidacion.php?id=$idrb");
 ?>
