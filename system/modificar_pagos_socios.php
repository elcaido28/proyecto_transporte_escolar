<?php
	include('conexion.php');

  $id=$_REQUEST['id'];
  $id_s=$_POST['socio'];
  $fecha=date('Y-m-d');
  $motivo=$_POST['motivo'];
  $mes=$_POST['mes'];
  $valor=$_POST['valor'];
  $descrip=$_POST['descrip'];
  $consulta=mysqli_query($con,"SELECT * from deuda_socios where id_empleados='$id_s' ");
  $row=mysqli_fetch_array($consulta);
  $id_d=$row['id_deuda_socios'];
  $deuda=$row['deuda_total'];


  $consulta1=mysqli_query($con,"SELECT * from pago_socios where id_pago_socios='$id' ");
  $row1=mysqli_fetch_array($consulta1);
  $deutota=$row1['deuda'];
  $mespg=$row1['mes'];
  $tipo_pagopg=$row1['tipo_pago'];
  $saldo=$deutota-$valor;

	$ingreso=mysqli_query($con," UPDATE pago_socios SET  tipo_pago='$motivo',mes='$mes',deuda='$deutota',pago='$valor',saldo='$saldo',descripcion='$descrip' where id_pago_socios='$id' ") or die ("error".mysqli_error());


$deu_saldo=($deuda+$row1['pago'])-$valor;


  $saldo2=number_format($deu_saldo, 2, '.', '');
  $modificar="UPDATE deuda_socios SET deuda_total ='$saldo2' WHERE id_deuda_socios='$id_d' ";
  $ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());

	$valor2="-".$valor;
	  $ingreso=mysqli_query($con,"UPDATE detalle_deuda_socios SET valor='$valor2', mes='$mes',razon='$motivo' where id_deuda_socios='$id_d' and mes='$mespg' and razon='$tipo_pagopg' ") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_pagos_socios.php");
 ?>
