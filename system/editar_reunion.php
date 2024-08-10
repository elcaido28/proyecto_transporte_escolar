<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT * FROM reunion_socios WHERE id_reunion_socios='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Reunión De Socios</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_cargo.php"><i class="fa fa-list-ul"></i> Administrar Reunión De Socios</a></li>
      <li class="active">Editar Reunión</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">


        <div class="modal-dialog">
          <div class="modal-content">

            <form role="form" action="modificar_reunion.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->

              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Reunión</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body">
                <div class="box-body">

                  <!-- ENTRADA  -->
                <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Tipo De Reunion"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg" name="tipo_reunion" required><option value="">Tipo De Reunion</option>
                        <?php $consulta4=mysqli_query($con,"SELECT * from tipo_reunion");
                          while($row4=mysqli_fetch_array($consulta4)){
                            if($row4['id_tipo_reunion']==$row['id_tipo_reunion']){$sel="selected='selected'";}else{$sel="";}
                          echo "<option ".$sel." value='".$row4['id_tipo_reunion']."'>"; echo $row4['descripr']; echo "</option>"; } ?> </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Numero De Reunión"><i class="fas fa-sort-numeric-up"></i></span>
                      <input type="text" class="form-control input-lg" name="numero" id="numero" value="<?php echo $row['numero']; ?>" placeholder="Numero De Reunión" onkeypress="return solonumeros(event)" maxlength="4" required>
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" title="Ingresar Asunto"><i class="far fa-file-alt"></i></span>
                    <input type="text" class="form-control input-lg" name="asunto" id="asunto" value="<?php echo $row['asuntos']; ?>" placeholder="Ingresar Asunto" required>
                  </div>
                </div>
                <div class="form-group"> </div>
              </div>

                <div class="form-group" >
                  <div class="input-group" title="Subir Documento(Acta de Reunión)">
                    <span class="input-group-addon" ><i class="fas fa-file"></i></span>
                    <input type="file" class="form-control input-lg" name="documento" title="Subir Documento(Acta de Reunión)" >
                  </div>
                </div>
                <div class="form-group" >
                  <div class="input-group" title="Subir Documento(Balance General)">
                    <span class="input-group-addon" ><i class="fas fa-file"></i></span>
                    <input type="file" class="form-control input-lg" name="documento2" title="Subir Documento(Balance General)" >
                  </div>
                </div>


                </div>

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Reunión</button>
                <a href="ingreso_reunion.php"><button type="button" class="btn btn-default" data-dismiss="modal">Salir</button></a>
              </div>
            </form>
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
