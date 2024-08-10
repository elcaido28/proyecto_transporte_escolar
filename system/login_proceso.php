<?php
session_start();
  $nomU = $_POST['usuario'];
  $pas = $_POST['clave'];
  if(empty($nomU) || empty($pas) ){
  	header("Location: login.php");
  	exit();  }
   include('conexion.php');

  $result= mysqli_query($con,"SELECT * from empleados E inner join usuario U on U.id_empleados=E.id_empleados where U.usuario ='$nomU' and U.clave ='$pas' and E.id_estado='1'");
   $num_row=mysqli_num_rows($result);
  if($num_row>0){
      $row= mysqli_fetch_assoc($result);
      $abc=$row['id_empleados'];
    $result2= mysqli_query($con,"SELECT * from empleados E inner join usuario U on U.id_empleados=E.id_empleados where  E.id_empleados='$abc'");
     $row4= mysqli_fetch_assoc($result2);
     $_SESSION['ID_usu']=$row['id_empleados'];
     $_SESSION['NU']=$row4['nombres']." ".$row4['apellidos'];
     $_SESSION['FOTO']=$row4['foto'];

     $_SESSION['socio']=$row4['socios'];

     $_SESSION['m1']=$row4['m1'];
     $_SESSION['m2']=$row4['m2'];
     $_SESSION['m3']=$row4['m3'];
     $_SESSION['m4']=$row4['m4'];
     $_SESSION['m5']=$row4['m5'];
     $_SESSION['m6']=$row4['m6'];
     $_SESSION['m7']=$row4['m7'];
     $_SESSION['m8']=$row4['m8'];
     $_SESSION['m9']=$row4['m9'];
     $_SESSION['m10']=$row4['m10'];
     $_SESSION['m11']=$row4['m11'];

    // $_SESSION['estado']=$row4['estado'];

    //$_SESSION['TD']=$row4['todoR'];
    //$_SESSION['S']=$row4['recurso_secre'];
    //$_SESSION['PD']=$row4['recurso_profe_dele'];
    //$_SESSION['SC']=$row4['recurso_secre_conse'];
    header("Location:inicio.php");
  }else{
    header("Location: login.php");
  }


 ?>
