<?php
	include('conexion.php');
    $tipo=$_POST['tipo'];

		$consulta=mysqli_query($con,"SELECT * from tipo_reunion where descripr='$tipo' ");
		$nrows=mysqli_num_rows($consulta);

		if ($nrows>0) {
	  		$salida="1";
		}else {
	  		$salida="0";
				$ingreso=mysqli_query($con,"INSERT into tipo_reunion (descripr) values
			('$tipo')") or die ("error".mysqli_error());

		}

	mysqli_close($con);
	header("Location:ingreso_tipo_reunion.php?guardo=$salida");
 ?>
