<?php
	include('conexion.php');
  //$id=$_REQUEST['id'];
  $valor=40.00;
	$mes=date('m');
	$razon="Cuota Social";
	$fecha=date('Y-m-d');

  $consulta=mysqli_query($con,"SELECT * from deuda_socios ");
  while($row=mysqli_fetch_array($consulta)){
  $id_s=$row['id_deuda_socios'];
  $deuda_cuotas=$row['deuda_total'];
  $cuota_social=$deuda_cuotas+$valor;
  $cuota_social=number_format($cuota_social, 2, '.', '');

  $modificar="UPDATE deuda_socios SET deuda_total='$cuota_social' WHERE id_deuda_socios='$id_s' ";
  $ejec=mysqli_query($con,$modificar) or die ("error".mysqli_error());

  $ingreso=mysqli_query($con,"INSERT into detalle_deuda_socios (fecha,valor, mes,razon,id_deuda_socios) values
('$fecha','$valor','$mes','$razon','$id_s')") or die ("error".mysqli_error());
}


	mysqli_close($con);
	header("Location:ingreso_deuda_cuota_social.php");
 ?>
