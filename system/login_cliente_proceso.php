<?php
session_start();
  $nomU = $_POST['usuario'];
  $pas = $_POST['clave'];
  if(empty($nomU) || empty($pas) ){
  	header("Location: login_cliente.php");
  	exit();  }
   include('conexion.php');

  $result= mysqli_query($con,"SELECT * from clientes where identificacion ='$nomU' and clave ='$pas' and id_estado='1'");
   $num_row=mysqli_num_rows($result);
  if($num_row>0){
      $row= mysqli_fetch_assoc($result);
     $_SESSION['ID_usu']=$row['id_clientes'];
     $_SESSION['NU']=$row['nombres']." ".$row['apellidos'];
    $_SESSION['PRIV']="Cliente";
     $_SESSION['FOTO']="img/defoult.png";
    // $_SESSION['estado']=$row4['estado'];

    //$_SESSION['TD']=$row4['todoR'];
    //$_SESSION['S']=$row4['recurso_secre'];
    //$_SESSION['PD']=$row4['recurso_profe_dele'];
    //$_SESSION['SC']=$row4['recurso_secre_conse'];
    header("Location:inicio.php");
  }else{
    header("Location: login_cliente.php");
  }


 ?>
