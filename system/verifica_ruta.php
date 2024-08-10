<?php
	include('conexion.php');
  if (isset($_POST['num'])) {
    $ano=date('Y');
    $nruta=$_POST['num'];
  	$tipo=$_POST['tipo'];
  	$descrip=$_POST['descrip'];


  	$consulta=mysqli_query($con,"SELECT * from ruta where ano='$ano' and num_ruta='$nruta' and tipo='$tipo' OR ano='$ano' and num_ruta='$nruta' and descripcion='$descrip' OR ano='$ano' and num_ruta='$nruta' and descripcion='$descrip' and tipo='$tipo' ");
  	$nrow=mysqli_num_rows($consulta);
  if ($nrow<1) {
      echo $nrow;
  }else{
      echo $nrow;
  }
}else{ echo ""; }


 ?>
