<?php
	include('conexion.php');
	$fecha=date('Y-m-d');


	$botiquin=$_POST['botiquin'];
	$funcionamiento=$_POST['funcionamiento'];
	$luces=$_POST['luces'];
	$extintor=$_POST['extintor'];
	$plumas=$_POST['plumas'];
	$gata=$_POST['gata'];
  $llaves=$_POST['llaves'];
  $triangulos=$_POST['triangulos'];
  $neumaticos=$_POST['neumaticos'];
  $llantas=$_POST['llantas'];
  $cinturones=$_POST['cinturones'];
  $llaves=$_POST['llaves'];
  $triangulos=$_POST['triangulos'];
  $neumaticos=$_POST['neumaticos'];
  $llantas=$_POST['llantas'];
  $cinturones=$_POST['cinturones'];
	$licencia=$_POST['licencia'];
  $matricula=$_POST['matricula'];

if($matricula!="" && $funcionamiento!="" && $luces!="" && $plumas!="" && $neumaticos!="" && $llantas!="" && $cinturones!="" && $licencia!=""){
	$estado="3";
}else{
	$estado="4";
}

  $placa=$_POST['placa'];
  $operadora=$_POST['operadora'];



	$ingreso=mysqli_query($con,"INSERT into revision_vehiculo (fecha, botiquin, funcionamiento, luces , extintor,plumas ,gata ,llaves ,triangulo, neumaticos,llanta_emer,cinturones, licencia,matricula,operadora,id_estado,id_buses ) values
('$fecha','$botiquin','$funcionamiento','$luces','$extintor','$plumas','$gata','$llaves','$triangulos','$neumaticos','$llantas','$cinturones','$licencia','$matricula','$operadora','$estado','$placa')") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_revision_bus.php");
 ?>
