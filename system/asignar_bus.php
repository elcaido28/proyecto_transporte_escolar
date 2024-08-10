<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];


$consulta="SELECT * FROM revision_vehiculo WHERE id_revision_vehiculo='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);


?>

<div class="content-wrapper">

  <section class="content-header">
    <h1> Buses</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_revision_bus.php"><i class="fas fa-address-book"></i> Revisión Bus</a></li>
      <li class="active">Agregar Buses</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">

            <form role="form" action="guardar_bus.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->

              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Agregar Bus</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body">
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Placa"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" name="placa" value="<?php echo $row['placa']; ?>" placeholder="Ingresar Placa" readonly required>
                    </div>
                  </div>
                  <!-- ENTRADA -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Marca"><i class="fas fa-award"></i></span>
                      <input type="text" class="form-control input-lg" name="marca" id="marca"  placeholder="Ingresar Marca" required>
                    </div>
                  </div>
                </div>
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Modelo"><i class="fab fa-buffer"></i></i></span>
                      <input type="text" class="form-control input-lg" name="modelo" id="modelo" placeholder="Ingresar Modelo" required>
                    </div>
                  </div>
                  <!-- ENTRADA  -->

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Año"><i class="fas fa-calendar-alt"></i></span>
                      <input type="text" class="form-control input-lg" name="ano" maxlength="4" placeholder="Ingresar Año" required>
                    </div>
                  </div>
                  </div>
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Chasis"><i class="fas fa-car-crash"></i></span>
                      <input type="text" class="form-control input-lg" name="chasis" id="chasis" placeholder="Ingresar Chasis" required>
                    </div>
                  </div>
                   <!-- ENTRADA -->

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Motor"><i class="fas fa-memory"></i></span>
                      <input type="text" class="form-control input-lg" name="motor" id="motor" placeholder="Ingresar Motor" required>
                    </div>
                  </div>
                  </div>
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Caducidad Matricula"><i class="fas fa-calendar-alt"></i></span>
                      <input type="date" class="form-control input-lg" name="caduca_matricula" placeholder="Ingresar Caducidad Matricula" required>
                    </div>
                  </div>
                   <!-- ENTRADA -->

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Capacidad"><i class="fas fa-sort-numeric-up"></i></span>
                      <input type="text" class="form-control input-lg" maxlength="3" name="capacidad" placeholder="Ingresar Capacidad" required>
                    </div>
                  </div>
                  </div>
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Descripcion"><i class="fas fa-braille"></i></span>
                      <input type="mail" class="form-control input-lg" name="descrip" placeholder="Ingresar Descripcion" required>
                    </div>
                  </div>
                   <!-- ENTRADA -->
                   <div class="form-group">
                     <div class="input-group">
                       <span class="input-group-addon" title="Dueño Del Vehiculo"><i class="fa fa-user-tie"></i></span>
                       <select class="form-control input-lg" name="dueno" required><option value="">Dueño Del Vehiculo</option>
                         <?php $consulta4=mysqli_query($con,"SELECT * from empleados where id_tipo_empleado='4'");
                           while($row4=mysqli_fetch_array($consulta4)){
                           echo "<option ".$sel."value='".$row4['id_empleados']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
                     </div>
                   </div>
                  </div>

                  <!-- ENTRADA SELECT -->
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Selecionar Conductor"><i class="fa fa-user"></i></span>
                        <select class="form-control input-lg" name="conductor" required><option value="">Selecionar Conductor</option>
                          <?php $consulta4=mysqli_query($con,"SELECT * from empleados where id_tipo_empleado='6'");
                            while($row4=mysqli_fetch_array($consulta4)){
                                if($row4['id_empleados']==$row['id_conductor']){$sel="selected='selected'";}else{$sel="";}
                            echo "<option ".$sel." value='".$row4['id_empleados']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
                      </div>
                    </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Selecionar Ayudante"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg" name="ayudante" required><option value="">Selecionar Ayudante</option>
                        <?php $consulta4=mysqli_query($con,"SELECT * from ayudante where id_estado='1'");
                          while($row4=mysqli_fetch_array($consulta4)){

                          echo "<option value='".$row4['id_ayudante']."'>"; echo $row4['nombres']; echo "</option>"; } ?> </select>
                    </div>
                  </div>
                  </div>
                  <!-- ENTRADA SUBIR FOTO -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Selecionar Institución"><i class="fas fa-university"></i></span>
                      <select class="form-control input-lg" name="institucion" required><option value="">Selecionar Institución</option>
                        <?php $consulta4=mysqli_query($con,"SELECT * from institucion");
                          while($row4=mysqli_fetch_array($consulta4)){
                          echo "<option value='".$row4['id_institucion']."'>"; echo $row4['nombre']; echo "</option>"; } ?> </select>
                    </div>
                  </div>

                </div>

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Guardar Bus</button>
                <a href="ingreso_bus.php"><button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button></a>
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

<script>
    $(document).on('keyup','#marca', function(){
        var valr= $('#marca').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('marca').value=texto;
        }
    });
    $(document).on('keyup','#modelo', function(){
        var valr= $('#modelo').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           //var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           var texto = valr.toUpperCase();  //todo mayuscula
            document.getElementById('modelo').value=texto;
        }
    });
    $(document).on('keyup','#chasis', function(){
        var valr= $('#chasis').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           //var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           var texto = valr.toUpperCase();  //todo mayuscula
            document.getElementById('chasis').value=texto;
        }
    });
    $(document).on('keyup','#motor', function(){
        var valr= $('#motor').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
            var texto = valr.toUpperCase();  //todo mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('motor').value=texto;
        }
    });

</script>

<?php include 'footer.php'; ?>
