<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $idc=$_REQUEST['idc'];
  $fecha=date('Y-m-d');
  $nfactura=$_POST['nfactura'];
  $valorp=$_POST['valorp'];
  $mes=$_POST['mes'];
  $formap=$_POST['formap'];
  $descrip=$_POST['descrip2'];

  $consulta=mysqli_query($con,"SELECT * from pago_clientes where id_pago_clientes='$id' ");
  $row=mysqli_fetch_array($consulta);
  $valorantes=$row['valor'];
  $fechaantes=$row['fecha'];


	$ingreso=mysqli_query($con,"UPDATE pago_clientes SET  n_factu='$nfactura',valor='$valorp',mes='$mes',descripf='$descrip',forma_pago='$formap' where id_pago_clientes='$id' ") or die ("error".mysqli_error());



$consulta=mysqli_query($con,"SELECT * from deuda_cliente where id_clientes='$idc' ");
$row=mysqli_fetch_array($consulta);
$id_d=$row['id_deuda_cliente'];
$deuda=$row['deuda_totalc'];

$saldo=($deuda+$valorantes)-$valorp;

$saldo2=number_format($saldo, 2, '.', '');
$modificar="UPDATE deuda_cliente SET deuda_totalc ='$saldo2' WHERE id_deuda_cliente='$id_d' ";
$ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());

$valor2="-".$valorp;
	$ingreso=mysqli_query($con,"UPDATE detalle_deuda_cliente SET valor='$valor2', mes='$mes',razon='Mensualidad' where id_deuda_cliente='$id_d' and fecha='$fechaantes' and mes='$mes' and valor<'1'  ") or die ("error".mysqli_error());



	mysqli_close($con);
	header("Location:ingreso_pagos_clientes.php");
 ?>
