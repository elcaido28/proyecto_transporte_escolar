<?php
	include('conexion.php');
  $id=$_REQUEST['id'];
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

				$ingreso=mysqli_query($con,"UPDATE pago_externo SET  departamento='$departamento',motivo='$motivo',lugar='$lugar',fecha_s='$fecha_salida',hora_s='$hora_salida',fecha_r='$fecha_retorno',hora_r='$hora_retorno',
          curso='$curso',cantidad='$cantidadp',valor='$valor',responsable='$responsable',id_institucion='$institucion' where id_pago_externo='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:ingreso_pago_externo.php");
 ?>
