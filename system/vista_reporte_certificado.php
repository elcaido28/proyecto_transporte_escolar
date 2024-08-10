<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Reporte De Clientes</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Reporte De Clientes</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="report/reporte_certificado.php" method="post" target="_blank" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Nuevo Reporte</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Socios"><i class="fa fa-user-tie"></i></span>
                      <select class="form-control input-lg" name="socio" required><option value="">Socios</option>
                        <?php $consulta4=mysqli_query($con,"SELECT * from empleados where id_estado='1' and id_tipo_empleado='4' or id_estado='1' and id_tipo_empleado='7'");
                          while($row4=mysqli_fetch_array($consulta4)){
                          echo "<option ".$sel."value='".$row4['id_empleados']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Presidente"><i class="fa fa-user-tie"></i></span>
                      <select class="form-control input-lg" name="presidente" required><option value="">Presidente</option>
                        <?php $consulta4=mysqli_query($con,"SELECT * from empleados where id_estado='1' and id_tipo_empleado='3'");
                          while($row4=mysqli_fetch_array($consulta4)){
                          echo "<option ".$sel."value='".$row4['id_empleados']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
                    </div>
                  </div>
                  </div>


              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Generar Reporte</button>
                <a href=""><button type="button" class="btn btn-default">Salir</button></a>
              </div>
            </form>
          </div>
        </div>
      </div>



      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL FIN
======================================-->

  <script type="text/javascript">
    function validar_fecha1() {
      var fecha = new Date();
      var dd = fecha.getDate();
      var mm = fecha.getMonth()+1;
      var yyyy = fecha.getFullYear();
      if(dd<10){ dd='0'+dd; }
      if(mm<10){ mm='0'+mm; }
      fecha_actual=yyyy+'-'+mm+'-'+dd;
      var fecha_ini=document.getElementById('fecha1').value;

      if (fecha_ini>fecha_actual) {
        Swal.fire("Fecha Incorrecta");
        document.getElementById('fecha1').value="";

      }
    }

    function validar_fecha2() {

      var fecha_ini=document.getElementById('fecha1').value;
      var fecha_fin=document.getElementById('fecha2').value;

      if (fecha_fin<fecha_ini) {
        Swal.fire("Fecha Incorrecta");
        document.getElementById('fecha2').value="";

      }
    }
  </script>

<?php include 'footer.php'; ?>
