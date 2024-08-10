<?php
include('conexion.php');
$id=$_REQUEST['id'];

$consulta3=mysqli_query($con,"SELECT * from lista_asistencia where id_reunion_socios='$id' "); //WHERE id_estado='1' and id_tipo_empleado='4' or id_estado='1' and id_tipo_empleado='7'
$nrow3=mysqli_num_rows($consulta3);
if ($nrow3<1) {

if (isset($_POST['check_list'])) {

  foreach($_POST['check_list'] as $selected){
  $ingreso=mysqli_query($con,"INSERT into lista_asistencia (id_reunion_socios,id_empleados) values ('$id','$selected')") or die ("error".mysqli_error());
  }

  }
// aqui variable,validar que ya tiene registros por interfaz
}else{
  $result=mysqli_query($con, "DELETE FROM lista_asistencia WHERE id_reunion_socios='$id' ");
  if (isset($_POST['check_list'])) {

    foreach($_POST['check_list'] as $selected){
    $ingreso=mysqli_query($con,"INSERT into lista_asistencia (id_reunion_socios,id_empleados) values ('$id','$selected')") or die ("error".mysqli_error());
    }

    }
}
mysqli_close($con);
header("Location:asignar_lista.php?id=$id");

  ?>
