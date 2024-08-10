<?php
include('conexion.php');
$id=$_REQUEST['id'];
$salida="";
$consulta=mysqli_query($con,"SELECT * from detalle_deuda_socios where id_deuda_socios='$id'  ");
while($row=mysqli_fetch_array($consulta)){
  // date_default_timezone_set('America/Guayaquil');
  // setlocale(LC_TIME, "spanish");
$mesl=$row['mes'];
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");



$salida.="<tr><td> ".$row['fecha']." </td><td> ".$row['razon']." </td><td> ".$meses[$mesl-1]." </td><td>$  ".$row['valor']." </td></tr>";
}
// $salida.="<script charset='utf-8'>$(document).ready(function() { $('#tabla2').DataTable( { dom: 'Bfrtip', buttons: [ 'excel', 'pdf' ] } ); } ); </script>";
 echo $salida;

?>
