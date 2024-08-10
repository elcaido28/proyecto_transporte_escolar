<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];


$consulta="SELECT * FROM empleados   WHERE id_empleados='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
$idte=$row['id_tipo_empleado'];
$consulta2="SELECT * FROM usuario U INNER JOIN empleados E ON U.id_empleados=E.id_empleados WHERE U.id_empleados='$id'";
$ejec2=mysqli_query($con,$consulta2);
$row2=mysqli_fetch_array($ejec2);
if ($row2['clave']!='') {
  $claveob=$row2['clave'];
  $usuob=$row2['usuario'];
?>
<script>
 Swal.fire( "El empleado ya tiene un usuario y contraseña asignado" );
 //alert("El empleado ya tiene un usuario y contraseña asignado");
</script>
<?php
}else{
  $usuo=explode(" ",$row['nombres']);
  $usuob=$usuo[0].".".$usuo[1];
  $claveob="";
}
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Usuario</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_empleado.php"><i class="fa fa-list-ul"></i> Administrar Empleados</a></li>
      <li class="active">Administrar Usuario</li>
    </ol>
  </section>
  <style media="screen">
    .amoldarcheck{
      height: 50px;
      margin-bottom: 0px;
      background: #fff;
      border:1px solid #d2d6de;
      padding-top:5px;
    }
  </style>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="guardar_usuario.php?id=<?php echo $id."&idte=".$idte; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Agregar Usuario</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Usuario"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" name="usuario" value="<?php echo  $usuob; ?>" placeholder="Ingresar usuario" required>
                    </div>
                  </div>
                  <!-- ENTRADA -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Contraseña"><i class="fa fa-key"></i></span>
                      <input type="text" class="form-control input-lg" name="clave" value="<?php echo  $claveob; ?>" placeholder="Ingresar contraseña" required>
                    </div>
                  </div>
                </div>
                <?php if($idte!='4' && $idte!='7' && $idte!='6'){ ?>
                <hr>
                <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon" title="Clientes"><i class="fas fa-user-tie"></i></span>
                    <input type="checkbox" name="clientes" id="clientes" class="checked" value="1" <?php if($row2['m1']!=""){ echo 'checked';} ?> >
                    <label class="labelt amoldarcheck" for="clientes" >Clientes</label>
                  </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon" title="Solicitudes De Servicio"><i class="fas fa-paper-plane"></i></span>
                    <input type="checkbox" name="solicitudes" id="solicitudes" class="checked" value="1" <?php if($row2['m2']!=""){ echo 'checked';} ?>>
                    <label class="labelt amoldarcheck" for="solicitudes" >Solicitudes De Servicio</label>
                  </div>
                  </div>
              </div>

              <div class="conten_cajas">
                <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon" title="Buses"><i class="fas fa-shuttle-van"></i></span>
                  <input type="checkbox" name="buses" id="buses" class="checked" value="1" <?php if($row2['m3']!=""){ echo 'checked';} ?>>
                  <label class="labelt amoldarcheck" for="buses" >Buses </label>
                </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon" title="Rutas"><i class="fas fa-map-marked-alt"></i></span>
                  <input type="checkbox" name="rutas" id="rutas" class="checked" value="1" <?php if($row2['m4']!=""){ echo 'checked';} ?>>
                  <label class="labelt amoldarcheck" for="rutas" >Rutas</label>
                </div>
                </div>
            </div>

            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon" title="Ayudantes"><i class="fa fa-user"></i></span>
                <input type="checkbox" name="ayudantes" id="ayudantes" class="checked" value="1" <?php if($row2['m5']!=""){ echo 'checked';} ?>>
                <label class="labelt amoldarcheck" for="ayudantes" >Ayudantes </label>
              </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon" title="Cuotas Sociales"><i class="fas fa-donate"></i></span>
                <input type="checkbox" name="cuotas" id="cuotas" class="checked" value="1" <?php if($row2['m6']!=""){ echo 'checked';} ?>>
                <label class="labelt amoldarcheck" for="cuotas" >Cuotas Sociales</label>
              </div>
              </div>
          </div>

          <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
              <span class="input-group-addon" title="Liquidaciones"><i class="fas fa-hand-holding-usd"></i></span>
              <input type="checkbox" name="liquidaciones" id="liquidaciones" class="checked" value="1" <?php if($row2['m7']!=""){ echo 'checked';} ?>>
              <label class="labelt amoldarcheck" for="liquidaciones" >Liquidaciones </label>
            </div>
            </div>
            <div class="form-group">
              <div class="input-group">
              <span class="input-group-addon" title="Pagos Clientes"><i class="fas fa-money-bill-wave"></i></span>
              <input type="checkbox" name="pagos_clientes" id="pagos_clientes" class="checked" value="1" <?php if($row2['m8']!=""){ echo 'checked';} ?>>
              <label class="labelt amoldarcheck" for="pagos_clientes" >Pagos Clientes </label>
            </div>
            </div>
        </div>

        <div class="conten_cajas">
          <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" title="Juntas"><i class="fas fa-handshake"></i></span>
            <input type="checkbox" name="juntas" id="juntas" class="checked" value="1" <?php if($row2['m9']!=""){ echo 'checked';} ?>>
            <label class="labelt amoldarcheck" for="juntas" >Juntas </label>
          </div>
          </div>
          <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" title="Reportes"><i class="fas fa-folder-open"></i></span>
            <input type="checkbox" name="reportes" id="reportes" class="checked" value="1" <?php if($row2['m10']!=""){ echo 'checked';} ?>>
            <label class="labelt amoldarcheck" for="reportes" >Reportes </label>
          </div>
          </div>
      </div>

      <div class="conten_cajas">
        <div class="form-group">
          <div class="input-group">
          <span class="input-group-addon" title="Administracion"><i class="fa fa-list-ul"></i></span>
          <input type="checkbox" name="administracion" id="administracion" class="checked" value="1" <?php if($row2['m11']!=""){ echo 'checked';} ?>>
          <label class="labelt amoldarcheck" for="administracion" >Administracion </label>
        </div>
        </div>
        <div class="form-group">  </div>
    </div>
<?php } ?>


              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                <a href="ingreso_empleado.php"><button type="button" class="btn btn-default">Salir</button></a>
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


<?php include 'footer.php'; ?>
