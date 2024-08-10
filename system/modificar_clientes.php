<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
  $idf=$_REQUEST['idf'];

	$cedula=$_POST['cedula'];
	$nombresc=$_POST['nombresc'];
  $nombres=$_POST['nombres'];
	if ($nombresc=="") {
		$nombresc=$nombres;
	}
	$apellidos=$_POST['apellidos'];
	$telefono=$_POST['telefono'];
	$telefono2=$_POST['telefono2'];
	$telefono3=$_POST['telefono3'];
	$direccion=$_POST['direccion'];
	$correo=$_POST['correo'];
	$contrato=$_POST['contrato'];
	$tipo_cliente=$_POST['tipo_cliente'];


	$nombresf=$_POST['nombresf'];
	$cedulaf=$_POST['cedulaf'];
	$direccionf=$_POST['direccionf'];
	$descripf=$_POST['descripf'];


	$ejec=mysqli_query($con,"UPDATE clientes SET nombre_comercial='$nombresc', nombres='$nombres', apellidos='$apellidos', identificacion='$cedula', telefono='$telefono', telefono2='$telefono2'
    , telefono3='$telefono3',correo='$correo',direccion='$direccion',tiempo_contrato='$contrato',id_tipo_cliente='$tipo_cliente' WHERE id_clientes='$id'") or die ("error".mysqli_error());

$ejec2=mysqli_query($con,"UPDATE datos_factura_cliente SET nombres='$nombresf', cedula='$cedulaf', direccion='$direccionf', descrip='$descripf' WHERE id_datos_factura_cliente='$idf' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:ingreso_clientes.php");
 ?>
