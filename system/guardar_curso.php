<?php
	include('conexion.php');
    $curso=$_POST['curso'];

		$consulta=mysqli_query($con,"SELECT * from curso where descrip='$curso' ");
		$nrows=mysqli_num_rows($consulta);

		if ($nrows>0) {
				$salida="1";
		}else {
				$salida="0";
				$ingreso=mysqli_query($con,"INSERT into curso (descrip) values
			('$curso')") or die ("error".mysqli_error());

		}




	mysqli_close($con);
	header("Location:ingreso_curso.php?guardo=$salida");
 ?>
