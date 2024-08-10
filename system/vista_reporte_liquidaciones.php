<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Reporte De Liquidaciones</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Liquidaciones</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="report/reporte_liquidaciones.php" method="post" target="_blank" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Nuevo Reporte</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->


                <!-- <div class="conten_cajas">
                  <div class="form-group">
                    <p>Fecha inicio</p>
                    <div class="input-group">
                      <span class="input-group-addon" title="Cargo"><i class="fas fa-calendar-alt"></i></span>
                      <input type="date" class="form-control input-lg" name="fecha1" id="fecha1" onchange="validar_fecha1()" >
                    </div>
                  </div>
                  <div class="form-group">
                    <p>Fecha Fin</p>

                    <div class="input-group">
                      <span class="input-group-addon" title="Cargo"><i class="fas fa-calendar-alt"></i></span>
                      <input type="date" class="form-control input-lg" name="fecha2" id="fecha2" onchange="validar_fecha2()" >
                    </div>
                  </div>
                </div> -->

               <div class="conten_cajas">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" title="Mes"><i class="fas fa-calendar-alt"></i></span>
                    <select class="form-control input-lg" name="mes" required><option value="">Mes</option>
                      <option value="01">Enero</option>
                      <option value="02">Febrero</option>
                      <option value="03">Marzo</option>
                      <option value="04">Abril</option>
                      <option value="05">Mayo</option>
                      <option value="06">Junio</option>
                      <option value="07">Julio</option>
                      <option value="08">Agosto</option>
                      <option value="09">Septiembre</option>
                      <option value="10">Octubre</option>
                      <option value="11">Noviembre</option>
                      <option value="12">Diciembre</option>
                    </select>

                  </div>
                </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="SELECCIONAR RUTA"><i class="fas fa-route"></i></span>
                      <select class="form-control input-lg" id="ruta" onchange="tipo_cli(this.value);" name="ruta" required><option value="" >Seleccionar RUTA</option>
                        <?php $consulta4=mysqli_query($con,"SELECT * from ruta where id_estado='1' order by num_ruta ASC");
                          while($row4=mysqli_fetch_array($consulta4)){
                          echo "<option value='".$row4['id_ruta']."'>"; echo "Ruta #".$row4['num_ruta']." - ".$row4['sector']." - ".$row4['tipo']." - ".$row4['descripcion']." - ".$row4['ano']; echo "</option>"; } ?> </select>
                    </div>
                  </div>
                  <!-- <div class="form-group"></div>-->
                </div>

                <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Chaleco"><i class="fas fa-vest"></i></span>
                      <input type="text" class="form-control input-lg" name="chaleco" placeholder="Chaleco" onkeypress="return solonumeros(event)">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Adelanto"><i class="fas fa-coins"></i></span>
                      <input type="text" class="form-control input-lg" name="adelanto" placeholder="Adelanto " onkeypress="return solonumeros(event)">
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
