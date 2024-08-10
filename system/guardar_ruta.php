<?php
	include('conexion.php');
	session_start();
$ano=date('Y');
  $nruta=$_POST['nruta'];
	$sector=$_POST['sector'];
	$tipo=$_POST['tipo'];
	$descrip=$_POST['descrip'];
	$estado="1";


	$consulta=mysqli_query($con,"SELECT * from ruta where ano='$ano' and num_ruta='$nruta' and tipo='$tipo' and descripcion='$descrip' ");
	$nrow=mysqli_num_rows($consulta);
if ($nrow<1) {
	$ingreso=mysqli_query($con,"INSERT into ruta (ano,num_ruta, sector,tipo,descripcion, id_estado) values
('$ano','$nruta','$sector','$tipo','$descrip','$estado')") or die ("error".mysqli_error());

}else{

}


	mysqli_close($con);
	header("Location:ingreso_ruta.php");
 ?>
