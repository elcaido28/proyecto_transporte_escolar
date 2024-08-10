<?php
include('conexion.php');
if(isset($_POST['cedula'])) {
    $cedula=$_POST['cedula'];
    $correo=$_POST['correo'];
    $clave=$_POST['clave'];
    $clave2=$_POST['clave2'];

  $consulta4=mysqli_query($con,"SELECT * from clientes where identificacion='$cedula' and correo='$correo' ");
  $nrows=mysqli_num_rows($consulta4);
  if ($nrows>0) {
    if ($clave==$clave2) {

        $row4=mysqli_fetch_assoc($consulta4);
        $idcli=$row4['id_clientes'];
        $result=mysqli_query($con, "UPDATE clientes SET clave='$clave' WHERE id_clientes='$idcli'");
        $sms='1';
    }else{
      $sms='2';
    }
  }else{
    $sms='3';
  }


}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Recuperar contraseña</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="logo.jpg">

     <!--=====================================
    PLUGINS DE CSS
    ======================================-->
  <link rel="stylesheet" href="css/sweetalert2.min.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../vistas/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../vistas/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../vistas/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="../vistas/dist/css/skins/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

     <!-- DataTables -->
     <link rel="stylesheet" href="css/jquery.dataTables.min.css">
     <!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
  <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
    <link rel="stylesheet" href="../vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../vistas/plugins/iCheck/all.css">
     <!-- Daterange picker -->
    <link rel="stylesheet" href="../vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../vistas/bower_components/morris.js/morris.css">
  <script src="https://kit.fontawesome.com/805c37e370.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/estilos.css">

    <!--=====================================
    PLUGINS DE JAVASCRIPT
    ======================================-->

    <!-- jQuery 3 -->
    <script src="../vistas/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vistas/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../vistas/dist/js/adminlte.min.js"></script>

    <!-- DataTables -->
    <script src="js/jquery.dataTables.min.js"></script>

    <!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" charset="utf-8"></script> -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" charset="utf-8"></script>

    <!-- <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script> -->
    <script src="../vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

    <!-- SweetAlert 2 -->
    <script src="js/sweetalert2.min.js"></script>
  <!--   <script src="../vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
     By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

    <!-- iCheck 1.0.1 -->
    <script src="../vistas/plugins/iCheck/icheck.min.js"></script>

    <!-- InputMask -->
    <script src="../vistas/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- jQuery Number -->
    <script src="../vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

    <!-- daterangepicker http://www.daterangepicker.com/-->
    <script src="../vistas/bower_components/moment/min/moment.min.js"></script>
    <script src="../vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
    <script src="../vistas/bower_components/raphael/raphael.min.js"></script>
    <script src="../vistas/bower_components/morris.js/morris.min.js"></script>

    <!-- ChartJS http://www.chartjs.org/-->
    <script src="../vistas/bower_components/Chart.js/Chart.js"></script>
  <!-- VALIDACIONES JS PARA FORMULARIOS -->
    <script src="js/valida_todo.js"></script>

  </head>
  <body>
    <br><br><br><br><br>


        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Recuperar Contraseña</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->
                <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Identificacion"><i class="fas fa-address-card"></i></span>
                      <input type="text" class="form-control input-lg" maxlength="10" autocomplete="off" onkeypress="return solonumeros(event)" name="cedula" id="cedula" placeholder="Cedula">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Correo"><i class="fa fa-envelope"></i></span>
                      <input type="email" class="form-control input-lg" autocomplete="off" name="correo" id="correo"  placeholder="Correo">
                    </div>
                  </div>
                </div>
                <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Nueva Contraseña"><i class="fas fa-key"></i></span>
                      <input type="text" class="form-control input-lg" autocomplete="off" name="clave" id="clave" placeholder="Nueva Contraseña">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Repita"><i class="fas fa-key"></i></span>
                      <input type="text" class="form-control input-lg" autocomplete="off" name="clave2" id="clave2"  placeholder="Repita Contraseña">
                    </div>
                  </div>
                </div>
                  <!-- ENTRADA -->

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="login_cliente.php"><button type="button" class="btn btn-default">Salir</button></a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        Swal.fire(
            'Debe ingresar Cedula y Correo con los que se registro',
            'Precione "Guardar Cambios" para que el cambio se haga efectivo',
            'warning'
          )
      </script>
      <script>
          function validarcorreo(){
              var correo = document.getElementById('correo');
              //alert(correo);

              var emailRegex = /^[-\w.%+]{1,64}@(?:[a-zA-z]{1,63}\.){1,125}[a-z]{2,63}$/i;
              if (emailRegex.test(correo.value)) {
                //alert("correo correcto");
              } else {
                const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'warning',
              title: 'Correo no válido'
            })
                document.getElementById('correo').value="";
              }
          }
      </script>


<!--=====================================
MODAL FIN
======================================-->
<?php if(isset($sms)) {  if($sms=='1') { ?>

<script type="text/javascript">
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 6000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Cambio Realizado con EXITO'
})
</script>

<?php  } } ?>




<?php if(isset($sms)) {  if($sms=='2') { ?>

<script type="text/javascript">
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'warning',
  title: 'Las contraseñas no son Iguales'
})
</script>

<?php  } } ?>


<?php if(isset($sms)) {  if($sms=='3') { ?>

<script type="text/javascript">
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'warning',
  title: 'Los campos Cedula o Correo son Incorrectos'
})
</script>

<?php  } } ?>
