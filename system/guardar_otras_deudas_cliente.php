<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $valor=$_POST['valor'];
	$mes=$_POST['mes'];
	$razon=$_POST['motivo'];
	$fecha=date('Y-m-d');


  $ingreso=mysqli_query($con,"INSERT into detalle_deuda_cliente (fecha,valor, mes,razon,id_deuda_cliente) values
('$fecha','$valor','$mes','$razon','$id')") or die ("error".mysqli_error());

$consulta=mysqli_query($con,"SELECT * from deuda_cliente  WHERE id_deuda_cliente='$id'");
$row=mysqli_fetch_array($consulta);

  $deuda_cuotas=$row['deuda_totalc'];
  $cuota_social=$deuda_cuotas+$valor;
  $cuota_social=number_format($cuota_social, 2, '.', '');
  $modificar="UPDATE deuda_cliente SET deuda_totalc ='$cuota_social' WHERE id_deuda_cliente='$id' ";
  $ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());




	mysqli_close($con);
	header("Location:ingreso_deuda_clientes.php");
 ?>
