<?php
include('conexion.php');
$id=$_REQUEST['id'];
$salida="";
$consulta=mysqli_query($con,"SELECT * from lista_asistencia L inner join empleados E on E.id_empleados=L.id_empleados inner join tipo_empleado T on T.id_tipo_empleado=E.id_tipo_empleado where L.id_reunion_socios='$id'  ");
while($row=mysqli_fetch_array($consulta)){

$salida.="<tr><td> ".$row['nombres']." ".$row['apellidos']." </td><td>".$row['descrip']." </td></tr>";
}
// $salida.="<script charset='utf-8'>$(document).ready(function() { $('#tabla2').DataTable( { dom: 'Bfrtip', buttons: [ 'excel', 'pdf' ] } ); } ); </script>";
 echo $salida;

?>
