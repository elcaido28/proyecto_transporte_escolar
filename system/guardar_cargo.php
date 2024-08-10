<?php
	include('conexion.php');
    $cargo=$_POST['cargo'];

		$consulta=mysqli_query($con,"SELECT * from tipo_empleado where descrip='$cargo' ");
		$nrows=mysqli_num_rows($consulta);

		if ($nrows>0) {
	  		$salida="1";
		}else {
	  		$salida="0";
				$ingreso=mysqli_query($con,"INSERT into tipo_empleado (descrip) values
			('$cargo')") or die ("error".mysqli_error());

		}




	mysqli_close($con);
	header("Location:ingreso_cargo.php?guardo=$salida");
 ?>
