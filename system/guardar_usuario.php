<?php
	include('conexion.php');

	$id=$_REQUEST['id'];
	$idte=$_REQUEST['idte'];
	if ($idte=='4' || $idte=='7') {
		$socio='1';
	}else{
		$socio='';
	}
	if ($idte=='6') {
		$socio='3';
	}else{
		$socio='';
	}
	$usuario=$_POST['usuario'];
	$clave=$_POST['clave'];

	$clientes=$_POST['clientes'];
	$solicitudes=$_POST['solicitudes'];
	$buses=$_POST['buses'];
	$rutas=$_POST['rutas'];
	$ayudantes=$_POST['ayudantes'];
	$cuotas=$_POST['cuotas'];
	$liquidaciones=$_POST['liquidaciones'];
	$pagos_clientes=$_POST['pagos_clientes'];
	$juntas=$_POST['juntas'];
	$reportes=$_POST['reportes'];
	$administracion=$_POST['administracion'];

  $consulta2="SELECT * FROM usuario U INNER JOIN empleados E ON U.id_empleados=E.id_empleados WHERE U.id_empleados='$id'";
  $ejec2=mysqli_query($con,$consulta2);
  $nrow2=mysqli_num_rows($ejec2);
  echo $nrow2;
  if ($nrow2>0) {
$modi="UPDATE usuario SET usuario='$usuario',clave='$clave',socios='$socio',m1='$clientes',m2='$solicitudes',m3='$buses',m4='$rutas',m5='$ayudantes',m6='$cuotas'
,m7='$liquidaciones',m8='$pagos_clientes',m9='$juntas',m10='$reportes',m11='$administracion' WHERE id_empleados='$id' ";
echo $modi;
    	$eje=mysqli_query($con,$modi) or die ("error".mysqli_error());
  }else{
	$ingreso=mysqli_query($con,"INSERT into usuario (usuario, clave,socios,m1,m2,m3,m4,m5,m6,m7,m8,m9,m10,m11,id_empleados) values ('$usuario', '$clave', '$socio',
		 '$clientes', '$solicitudes', '$buses', '$rutas', '$ayudantes', '$cuotas', '$liquidaciones', '$pagos_clientes', '$juntas', '$reportes', '$administracion' ,'$id')") or die ("error".mysqli_error());
}


	mysqli_close($con);
	header("Location:ingreso_empleado.php");
 ?>
