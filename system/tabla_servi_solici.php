<?php
include('conexion.php');
$id=$_REQUEST['id'];
$salida="";
$consulta=mysqli_query($con,"SELECT * from solicitud_servicio SS inner join personas P on P.id_personas=SS.id_personas inner join curso C on C.id_curso=P.id_curso inner join extracurricular EX on EX.id_extracurricular=P.id_extracurricular  inner join servicio S on S.id_servicio=P.id_servicio WHERE P.id_clientes='$id'  ");
while($row=mysqli_fetch_array($consulta)){

$salida.="<tr><td> ".$row['nombre']." ".$row['apellido']." </td><td>".$row['descrip']." </td><td>".$row['descrips']." </td><td>".$row['descrip2']." </td>";
$salida.=" <td> <a href='eliminar_solicitar_servi.php?id=".$row['id_personas']."' title='Aceptar Solicitud'> <button class='btn btn-primary'><i class='fas fa-paper-plane'></i></button></a> </td></tr>";
}
// $salida.="<script charset='utf-8'>$(document).ready(function() { $('#tabla2').DataTable( { dom: 'Bfrtip', buttons: [ 'excel', 'pdf' ] } ); } ); </script>";
 echo $salida;

?>
