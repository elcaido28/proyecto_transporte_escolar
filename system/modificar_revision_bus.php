<?php
	include('conexion.php');

  $id=$_REQUEST['id'];
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
  $placa=$_POST['placa'];
  $operadora=$_POST['operadora'];

	if($matricula!="" && $funcionamiento!="" && $luces!="" && $plumas!="" && $neumaticos!="" && $llantas!="" && $cinturones!="" && $licencia!=""){
		$estado="3";
	}else{
		$estado="4";
	}

	$ingreso=mysqli_query($con,"UPDATE revision_vehiculo SET botiquin='$botiquin', funcionamiento='$funcionamiento', luces='$luces', extintor='$extintor',plumas='$plumas',gata='$gata' ,llaves='$llaves' ,triangulo='$triangulos', neumaticos='$neumaticos',llanta_emer='$llantas'
    ,cinturones='$cinturones', licencia='$licencia',matricula='$matricula' ,id_buses='$placa',operadora='$operadora',id_estado='$estado' WHERE id_revision_vehiculo='$id' ") or die ("error".mysqli_error());


	mysqli_close($con);
	header("Location:ingreso_revision_bus.php");
 ?>
