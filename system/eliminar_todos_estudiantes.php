<?php
include('conexion.php');

$result=mysqli_query($con, "UPDATE personas P inner join clientes C on C.id_clientes=P.id_clientes SET P.id_estado='2' WHERE C.id_tipo_cliente='1'");

mysqli_close($con);
header("Location:ingreso_clientes.php");
?>
