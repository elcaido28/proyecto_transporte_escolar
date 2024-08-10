<?php
include('conexion.php');
$salida="";
if(isset($_POST['idp'])){
  	$id=$_POST['idp'];
    $idr=$_POST['idr'];
    // $idrb=$_POST['idrb'];
	$consulta=mysqli_query($con,"SELECT * from personas P inner join clientes C on C.id_clientes=P.id_clientes inner join pago_clientes PC on PC.id_clientes=C.id_clientes where  P.id_personas='$id'");
	$nrows=mysqli_num_rows($consulta);

  $consulta2=mysqli_query($con,"SELECT * from rutas_personas R inner join servicio S on S.id_servicio=R.servicio where  R.id_personas='$id' and R.id_ruta='$idr' ");
  $nrows2=mysqli_num_rows($consulta2);
  if ($nrows2>0) {
    $rows2=mysqli_fetch_assoc($consulta2);
    $salida=$rows2['descrips']."**";
}

	if ($nrows>0) {
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $salida.="<table id='tabla4' class='table'>  <td colspan='5' align='center'><b>Facturas</b></td>";
      while($rows=mysqli_fetch_assoc($consulta)){
        $mesl=$rows['mes'];
  		//$salida.=$rows['n_factu']."**".$rows['valor']."**".$rows['descripf'];
      $salida.="<tr><td>".$rows['n_factu']."</td><td>".$meses[$mesl-1]."</td><td>".$rows['valor']."</td><td>".$rows['descripf']."</td></tr>";
    }
      $salida.="</table>";

	}else {
  		$salida="";
	}
}else{
	$salida="";
}
echo $salida;
mysqli_close($con);

?>
