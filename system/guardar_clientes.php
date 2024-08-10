<?php
	include('conexion.php');
	$fecha=date('Y-m-d');
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
	$estado="1";

	$nombresf=$_POST['nombresf'];
	$cedulaf=$_POST['cedulaf'];
	$direccionf=$_POST['direccionf'];
	$descripf=$_POST['descripf'];

	// CLAVE ALEATORIA
	$charset = "abcdefghijklmnopqrstuvwxyz*#-!)_(ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$cad = "";
	for($p=0;$p<6;$p++){
		$cad .= substr($charset, rand(0, 62), 1);
	}
	$clave = $cad;
	// FIN CLAVE ALEATORIA
if($tipo_cliente=='1'){
	include('envio_clave_cliente.php');

}

	$ingreso=mysqli_query($con,"INSERT into clientes (fecha, nombre_comercial, nombres, apellidos, identificacion, telefono, telefono2, telefono3,correo,direccion,tiempo_contrato,clave,id_estado,id_tipo_cliente) values
('$fecha','$nombresc','$nombres','$apellidos','$cedula','$telefono','$telefono2','$telefono3','$correo','$direccion','$contrato','$clave','$estado','$tipo_cliente')") or die ("error".mysqli_error());


$consul=mysqli_query($con,"SELECT * from clientes order by id_clientes ASC");
	while($row=mysqli_fetch_array($consul)){
		$id_cli=$row['id_clientes'];
}
$ingreso2=mysqli_query($con,"INSERT into datos_factura_cliente (nombres, cedula, direccion, descrip,id_clientes) values
('$nombresf','$cedulaf','$direccionf','$descripf','$id_cli')") or die ("error".mysqli_error());

$ingreso3=mysqli_query($con,"INSERT into deuda_cliente (deuda_totalc , id_clientes) values
('0.00','$id_cli')") or die ("error".mysqli_error());
	// $ingreso=mysqli_query($con,"INSERT into usuarios (cedula,clave,id_privilegio,id_estado) values ('$cedula','$correo','3','$estado')") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_clientes.php");
 ?>
