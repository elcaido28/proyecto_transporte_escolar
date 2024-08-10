<?php
	include('conexion.php');
  $fecha=date('Y-m-d');
  $mes_act=date('m');
  $cont=$_REQUEST['cont'];
  $idr=$_REQUEST['idr'];
  $idrb=$_REQUEST['idrb'];
  $id_persona=$_POST['pasajero'];
  $total=$_POST['total'];

  $ingreso=mysqli_query($con,"INSERT into pago_liquidacion (fecha,mespago ,total,id_personas,id_ruta) values
('$fecha','$mes_act','$total','$id_persona','$idr')") or die ("error".mysqli_error());



  $consul=mysqli_query($con,"SELECT * from pago_liquidacion order by id_pago_liquidacion DESC ");
  $row2=mysqli_fetch_array($consul);
  $id_pl=$row2['id_pago_liquidacion'];

  for ($i=0; $i <=$cont ; $i++) {
		$idmes='mes'.$i;
    $idpago='pago'.$i;
    $mess=$_POST[$idmes];
    $pagos=$_POST[$idpago];
    $ingreso2=mysqli_query($con,"INSERT into detalle_pago_liquidacion (mes,valor,id_pago_liquidacion) values
  ('$mess','$pagos','$id_pl')") or die ("error".mysqli_error());

  }





mysqli_close($con);
header("Location:ingreso_pagos_socios.php");
?>
