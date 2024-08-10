<?php
	include('conexion.php');

  $id_s=$_POST['socio'];
  $consulta=mysqli_query($con,"SELECT * from deuda_socios where id_empleados='$id_s' ");
  $row=mysqli_fetch_array($consulta);
  $id_d=$row['id_deuda_socios'];
  $deuda=$row['deuda_total'];

  $fecha=date('Y-m-d');
  $motivo=$_POST['motivo'];
  $mes=$_POST['mes'];
  $valor=$_POST['valor'];
  $descrip=$_POST['descrip'];
  $saldo=$deuda-$valor;

	$ingreso=mysqli_query($con,"INSERT into pago_socios (fecha,tipo_pago,mes,deuda,pago,saldo,descripcion,id_deuda_socios) values
('$fecha','$motivo','$mes','$deuda','$valor','$saldo','$descrip','$id_d')") or die ("error".mysqli_error());


  $saldo2=number_format($saldo, 2, '.', '');
  $modificar="UPDATE deuda_socios SET deuda_total ='$saldo2' WHERE id_deuda_socios='$id_d' ";
  $ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());

	$valor2="-".$valor;
	  $ingreso=mysqli_query($con,"INSERT into detalle_deuda_socios (fecha,valor, mes,razon,id_deuda_socios) values
	('$fecha','$valor2','$mes','$motivo','$id_d')") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_pagos_socios.php");
 ?>
