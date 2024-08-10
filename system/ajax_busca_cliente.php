<?php
include('conexion.php');
$salida="";
if(isset($_POST['consulta'])){
  	$id=$_POST['consulta'];
	$consulta=mysqli_query($con,"SELECT *, DF.nombres nombre,DF.direccion direcci from clientes C inner join datos_factura_cliente DF on DF.id_clientes=C.id_clientes where  C.id_clientes='$id'");
	$nrows=mysqli_num_rows($consulta);
	if ($nrows>0) {
    $rows=mysqli_fetch_assoc($consulta);
  		$salida=$rows['nombre']."**".$rows['cedula']."**".$rows['direcci']."**".$rows['descrip']."**".$rows['id_clientes'];
	}else {
  		$salida="";
	}
}else{
	$salida="";
}
echo $salida;
mysqli_close($con);

?>
