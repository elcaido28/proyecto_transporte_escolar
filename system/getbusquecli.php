<?php
	include('conexion.php');
	$seudonimo = $_GET['equipo'];
	mysqli_set_charset("utf8");
	$sql = "SELECT * FROM clientes WHERE nombres LIKE '$seudonimo' or apellidos LIKE '$seudonimo'";
	$result = mysqli_query($con,$sql);
	if (mysqli_num_rows($result) > 0) {
		$equipo = mysqli_fetch_object($result);
		$equipo->status = 200;
		echo json_encode($equipo);
	}else{
		$error = array('status' => 400);
		echo json_encode((object)$error);
	}
