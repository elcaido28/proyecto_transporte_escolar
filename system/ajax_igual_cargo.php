<?php
include('conexion.php');
$salida="";
if(isset($_POST['consulta'])){
  $dtstr=$_POST['consulta'];
	$consulta=mysqli_query($con,"SELECT * from tipo_empleado where descrip='$dtstr' ");
	$nrows=mysqli_num_rows($consulta);

	if ($nrows>0) {
  		$salida="1";
	}else {
  		$salida="0";
	}
}else{
	$salida="";
}
echo $salida;
mysqli_close($con);

 ?>
