<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $fecha=date('Y-m-d');
  $nfactura=$_POST['nfactura'];
  $valorp=$_POST['valorp'];
  $mes=$_POST['mes'];
  $formap=$_POST['formap'];
  $descrip=$_POST['descrip2'];

	$ingreso=mysqli_query($con,"INSERT into pago_clientes (fecha,n_factu,valor,mes,descripf,forma_pago,id_clientes ) values
('$fecha','$nfactura','$valorp','$mes','$descrip','$formap','$id')") or die ("error".mysqli_error());



$consulta=mysqli_query($con,"SELECT * from deuda_cliente where id_clientes='$id' ");
$row=mysqli_fetch_array($consulta);
$id_d=$row['id_deuda_cliente'];
$deuda=$row['deuda_totalc'];

$saldo=$deuda-$valorp;

$saldo2=number_format($saldo, 2, '.', '');
$modificar="UPDATE deuda_cliente SET deuda_totalc ='$saldo2' WHERE id_deuda_cliente='$id_d' ";
$ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());

$valor2="-".$valorp;
	$ingreso=mysqli_query($con,"INSERT into detalle_deuda_cliente (fecha,valor, mes,razon,id_deuda_cliente) values
('$fecha','$valor2','$mes','Mensualidad','$id_d')") or die ("error".mysqli_error());



	mysqli_close($con);
	header("Location:ingreso_pagos_clientes.php");
 ?>
