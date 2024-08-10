<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Reporte De Socios</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Reporte De Socios</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="report/reporte_socios.php" method="post" target="_blank" enctype="multipart/form-data">
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
                    <p>Fecha inicio</p>
                    <div class="input-group">
                      <span class="input-group-addon" title="Fecha"><i class="fas fa-calendar-alt"></i></span>
                      <input type="date" class="form-control input-lg" name="fecha1" id="fecha1" onchange="validar_fecha1()" >
                    </div>
                  </div>
                  <div class="form-group">
                    <p>Fecha Fin</p>

                    <div class="input-group">
                      <span class="input-group-addon" title="Fecha"><i class="fas fa-calendar-alt"></i></span>
                      <input type="date" class="form-control input-lg" name="fecha2" id="fecha2" onchange="validar_fecha2()" >
                    </div>
                  </div>
                </div>
                  <!-- ENTRADA -->

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
