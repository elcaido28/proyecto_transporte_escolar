<?php
	include('conexion.php');
		$fecha=date('Y-m-d');
    $institucion=$_POST['institucion'];
    $departamento=$_POST['departamento'];
    $motivo=$_POST['motivo'];
    $lugar=$_POST['lugar'];
    $fecha_salida=$_POST['fecha_salida'];
    $hora_salida=$_POST['hora_salida'];
    $fecha_retorno=$_POST['fecha_retorno'];
    $hora_retorno=$_POST['hora_retorno'];
    $curso=$_POST['curso'];
    $cantidadp=$_POST['cantidadp'];
    $valor=$_POST['valor'];
    $responsable=$_POST['responsable'];

				$ingreso=mysqli_query($con,"INSERT into pago_externo (fecha,departamento,motivo,lugar,fecha_s,hora_s,fecha_r,hora_r,curso,cantidad,valor,responsable,id_institucion) values
			('$fecha','$departamento','$motivo','$lugar','$fecha_salida','$hora_salida','$fecha_retorno','$hora_retorno','$curso','$cantidadp','$valor','$responsable','$institucion')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:ingreso_pago_externo.php");
 ?>
