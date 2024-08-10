<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT * FROM ruta   WHERE id_ruta='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Ruta</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_ruta.php"><i class="fa fa-list-ul"></i> Administrar Ruta</a></li>
      <li class="active">Editar Ruta</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">


        <div class="modal-dialog">
          <div class="modal-content">

            <form role="form" action="modificar_ruta.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->

              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Ruta</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body">
                <div class="box-body">

                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Nº de ruta"><i class="fas fa-list-ol"></i></span>
                      <input type="text" class="form-control input-lg" maxlength="2" name="nruta" value="<?php echo  $row['num_ruta']; ?>"  onkeypress="return solonumeros(event)" placeholder="Ingresar Nº de ruta" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Sector"><i class="far fa-map"></i></span>
                      <input type="text" class="form-control input-lg" name="sector" value="<?php echo  $row['sector']; ?>"  placeholder="Ingresar Sector" required>
                    </div>
                  </div>
                  </div>
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Tipo De Ruta"><i class="far fa-file-alt"></i></span>
                        <select class="form-control input-lg" name="tipo" required><option value="" >Tipo De Ruta</option>
                          <option <?php if("Primaria"==$row['tipo']){echo 'selected="selected"';} ?>>Primaria</option>
                          <option <?php if("Secundaria"==$row['tipo']){echo 'selected="selected"';} ?>>Secundaria</option>
                          <option <?php if("Empresa"==$row['tipo']){echo 'selected="selected"';} ?>>Empresa</option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Descripción"><i class="far fa-file-alt"></i></span>
                        <select class="form-control input-lg" name="descrip" required><option value="" >Descripción</option>
                          <option <?php if("Normal"==$row['descripcion']){echo 'selected="selected"';} ?>>Normal</option>
                          <option <?php if("Extracurricular"==$row['descripcion']){echo 'selected="selected"';} ?>>Extracurricular</option>
                          </select>
                      </div>
                    </div>

                </div>
                   <!-- ENTRADA -->


                </div>

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Guardar Ruta</button>
                <a href="ingreso_ruta.php"><button type="button" class="btn btn-default" data-dismiss="modal">Salir</button></a>
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>
  </section>
</div>



<?php include 'footer.php'; ?>
