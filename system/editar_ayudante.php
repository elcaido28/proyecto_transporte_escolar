<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT * FROM ayudante   WHERE id_ayudante='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Ayudante</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_ayudante.php"><i class="fa fa-list-ul"></i> Administrar Ayudante</a></li>
      <li class="active">Editar Ayudante</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">


        <div class="modal-dialog">
          <div class="modal-content">

            <form role="form" action="modificar_ayudante.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->

              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Ayudante</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body">
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Nombres"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" name="nombres" value="<?php echo $row['nombres']; ?>" id="nombres" onkeypress="return soloLetras(event)" placeholder="Ingresar nombres" required>
                    </div>
                  </div>
                  <!-- ENTRADA -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Cedula"><i class="fas fa-address-card"></i></i></span>
                      <input type="text" class="form-control input-lg" maxlength="10" name="cedula" value="<?php echo $row['cedula']; ?>" id="cedula" onchange="validarCedula(this.value);" onkeypress="return solonumeros(event)" placeholder="Ingresar Cedula" required>
                    </div>
                  </div>
                </div>
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Teléfono"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control input-lg" name="telefono" value="<?php echo $row['telefono']; ?>"  placeholder="Ingresar teléfono" data-inputmask="'mask':'9999-999-999'" data-mask required>
                      </div>
                    </div>
                  <!-- ENTRADA  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Teléfono 2"><i class="fa fa-phone"></i></span>
                      <input type="text" class="form-control input-lg" name="telefono2" value="<?php echo $row['telefono2']; ?>"  placeholder="Ingresar teléfono 2" data-inputmask="'mask':'9999-999-999'" data-mask required>
                    </div>
                  </div>
                  </div>
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Domicilio"><i class="fa fa-map-marker"></i></span>
                      <input type="text" class="form-control input-lg" value="<?php echo $row['domicilio']; ?>" name="domicilio" placeholder="Ingresar Domicilio" required>
                    </div>
                  </div>
                   <!-- ENTRADA -->
                   <div class="form-group">
                     <div class="input-group">
                       <span class="input-group-addon" title="Estado Civil"><i class="fas fa-comment-alt"></i></span>
                       <select class="form-control input-lg" name="civil" required><option value="" >Estado Civil</option>
                         <option <?php if ($row['estado_civil']=='Soltero/a'){ echo "selected='selected'"; } ?> >Soltero/a</option>
                         <option <?php if ($row['estado_civil']=='Casado/a'){ echo "selected='selected'"; } ?> >Casado/a</option>
                         <option <?php if ($row['estado_civil']=='Divorciado/a'){ echo "selected='selected'"; } ?> >Divorciado/a</option>
                         </select>
                     </div>
                   </div>
                  </div>

                  <!-- ENTRADA SELECT -->

                  <div class="form-group" >
                    <div class="input-group" title="Subir Documento(cedula - papel votacion)">
                      <span class="input-group-addon" ><i class="fas fa-file"></i></span>
                      <input type="file" class="form-control input-lg" name="documento" title="Subir Documento(cedula - papel votacion)" >
                    </div>
                   <!-- ENTRADA -->

                  </div>
                  <!-- ENTRADA SUBIR FOTO -->
                   <div class="form-group">
                    <div class="panel">SUBIR FOTO</div>
                    <input type="file" class="nuevaFoto" name="foto" accept="image/jpeg">
                    <p class="help-block">Peso máximo de la foto 3MB</p>
                    <img src="<?php echo $row['foto']; ?>" class="img-thumbnail previsualizar" width="100px">
                  </div>
                </div>

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Guardar Ayudante</button>
                <a href="ingreso_ayudante.php"><button type="button" class="btn btn-default" data-dismiss="modal">Salir</button></a>
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>
  </section>
</div>



<?php include 'footer.php'; ?>
