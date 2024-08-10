<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT * FROM pago_externo   WHERE id_pago_externo='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Pago Viajes Extras</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_pago_externo.php"><i class="fa fa-list-ul"></i> Administrar Pago Viajes Extras</a></li>
      <li class="active">Editar Pago Viajes Extras</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="modificar_pago_externo.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Pago Viajes Extras</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Selecionar Institución"><i class="fas fa-university"></i></span>
                        <select class="form-control input-lg" name="institucion" required><option value="">Selecionar Institución</option>
                          <?php $consulta4=mysqli_query($con,"SELECT * from institucion");
                            while($row4=mysqli_fetch_array($consulta4)){
                              if($row4['id_institucion']==$row['id_institucion']){$sel="selected='selected'";}else{$sel="";}
                            echo "<option ".$sel." value='".$row4['id_institucion']."'>"; echo $row4['nombre']; echo "</option>"; } ?> </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Departamento/Nivel"><i class="fas fa-table"></i></span>
                        <input type="text" class="form-control input-lg" name="departamento" id="departamento" value="<?php echo $row['departamento']; ?>"  placeholder="Ingresar Departamento/Nivel" required>
                      </div>
                    </div>

                  </div>

                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Motivo/Actividad"><i class="far fa-file-alt"></i></span>
                      <input type="text" class="form-control input-lg" name="motivo" value="<?php echo $row['motivo']; ?>" placeholder="Ingresar Motivo/Actividad" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Lugar/Destino"><i class="fas fa-map-marked-alt"></i></span>
                      <input type="text" class="form-control input-lg" name="lugar" value="<?php echo $row['lugar']; ?>"  placeholder="Ingresar Lugar/Destino" required>
                    </div>
                  </div>
                </div>

                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Fecha Salida"><i class="fas fa-calendar-alt"></i></span>
                        <input type="date" class="form-control input-lg" name="fecha_salida" value="<?php echo $row['fecha_s']; ?>" placeholder="Ingresar Fecha Salida" required>
                      </div>
                     </div>
                     <div class="form-group">
                       <div class="input-group">
                         <span class="input-group-addon" title="Ingresar hora Salida"><i class="fas fa-clock"></i></span>
                         <input type="time" class="form-control input-lg" name="hora_salida" value="<?php echo $row['hora_s']; ?>" placeholder="Ingresar Hora Salida" required>
                       </div>
                     </div>
                  </div>

                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Fecha Retorno"><i class="far fa-calendar-alt"></i></span>
                        <input type="date" class="form-control input-lg" name="fecha_retorno" value="<?php echo $row['fecha_r']; ?>"  placeholder="Ingresar Fecha Retorno" required>
                      </div>
                     </div>
                     <div class="form-group">
                       <div class="input-group">
                         <span class="input-group-addon" title="Ingresar hora Retorno"><i class="far fa-clock"></i></span>
                         <input type="time" class="form-control input-lg" name="hora_retorno" value="<?php echo $row['hora_r']; ?>" placeholder="Ingresar Hora Retorno" required>
                       </div>
                     </div>
                  </div>

                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Curso"><i class="fas fa-table"></i></span>
                        <input type="text" class="form-control input-lg" name="curso" value="<?php echo $row['curso']; ?>"  placeholder="Ingresar curso">
                      </div>
                     </div>
                     <div class="form-group">
                       <div class="input-group">
                         <span class="input-group-addon" title="Ingresar Cantidad de Personas"><i class="fas fa-sort-numeric-up"></i></span>
                         <input type="text" class="form-control input-lg" maxlength="3" name="cantidadp" value="<?php echo $row['cantidad']; ?>" placeholder="Cantidad de Personas" required onkeypress="return solonumeros(event)">
                       </div>
                     </div>
                  </div>

                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Valor del Transporte"><i class="fas fa-coins"></i></span>
                        <input type="text" class="form-control input-lg" name="valor" maxlength="6" placeholder="Valor del Transporte" value="<?php echo $row['valor']; ?>" onkeypress="return solonumeros(event)">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Nombre de Responsable"><i class="fas fa-user-tie"></i></span>
                        <input type="text" class="form-control input-lg" name="responsable" id="responsable"  placeholder="Nombre de Responsable" value="<?php echo $row['responsable']; ?>" onkeypress="return sololetras(event)">
                      </div>
                     </div>
                  </div>
                  <!-- ENTRADA -->

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Cargo</button>
                <a href="ingreso_pago_externo.php"><button type="button" class="btn btn-default">Salir</button></a>
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
$(document).on('keyup','#responsable', function(){
    var valr= $('#responsable').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('responsable').value=texto;
    }
});

$(document).on('keyup','#departamento', function(){
    var valr= $('#departamento').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('departamento').value=texto;
    }
});

$(document).on('keyup','#descrip', function(){
    var valr= $('#descrip').val();
    if(valr!=""){
       var texto = MaysPrimera(valr);
       //var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('descrip').value=texto;
    }
});
</script>

<?php include 'footer.php'; ?>
