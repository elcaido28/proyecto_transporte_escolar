<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT * FROM revision_vehiculo  WHERE id_revision_vehiculo='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Revisión De Buses</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_revision_bus.php"><i class="fa fa-list-ul"></i> Administrar Revisión De Buses</a></li>
      <li class="active">Editar Revisión De Buses</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <style media="screen">
          .amoldarcheck{
            height: 50px;
            margin-bottom: 0px;
            background: #fff;
            border:1px solid #d2d6de;
            padding-top:5px;
          }

        </style>

          <div class="modal-dialog">
            <div class="modal-content">

              <form role="form" action="modificar_revision_bus.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <!--========== CABEZA DEL MODAL =================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                  <h4 class="modal-title">Editar Revisión De Bus</h4>
                </div>

                <!--============= CUERPO DEL MODAL ===================-->

                <div class="modal-body">
                  <div class="box-body">
                    <!-- ENTRADA  -->
                    <div class="conten_cajas">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="Placa"><i class="fas fa-calendar-week"></i></span>
                          <select class="form-control input-lg" name="placa" required><option value="">Selecionar Placa</option>
                            <?php $consulta4=mysqli_query($con,"SELECT * from buses where id_estado='1'");
                              while($row4=mysqli_fetch_array($consulta4)){
                              if($row4['id_buses']==$row['id_buses']){$sel="selected='selected'";}else{$sel="";}
                              echo "<option ".$sel." value='".$row4['id_buses']."'>"; echo $row4['placa']; echo "</option>"; } ?> </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="Matricula Actualizada"><i class="fas fa-id-card"></i></span>
                        <input type="checkbox" name="matricula" id="matricula" class="checked"  value="Si" <?php if($row['matricula']!=""){ echo 'checked';} ?> >
                        <label class="labelt amoldarcheck" for="matricula" >Matricula Actualizada </label>
                      </div>
                      </div>
                    </div>

                    <div class="conten_cajas">
                      <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon" title="Botiquín"><i class="fas fa-medkit"></i></span>
                        <input type="checkbox" name="botiquin" id="botiquin" class="checked" value="Si" <?php if($row['botiquin']!=""){ echo 'checked';} ?> >
                        <label class="labelt amoldarcheck" for="botiquin" >Botiquín (7 objetos) </label>
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon" title="A/C En Funcionamiento"><i class="fas fa-fan"></i></span>
                        <input type="checkbox" name="funcionamiento" id="funcionamiento" class="checked" value="Si" <?php if($row['funcionamiento']!=""){ echo 'checked';} ?> >
                        <label class="labelt amoldarcheck" for="funcionamiento" >A/C En Funcionamiento </label>
                      </div>
                      </div>

                  </div>
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                      <span class="input-group-addon" title="Luces (Exterior e interior)"><i class="fas fa-lightbulb"></i></span>
                      <input type="checkbox" name="luces" id="luces" class="checked" value="Si" <?php if($row['luces']!=""){ echo 'checked';} ?> >
                      <label class="labelt amoldarcheck" for="luces" >Luces (Exterior e interior)</label>
                    </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                      <span class="input-group-addon" title="Extintor (10 lbs)"><i class="fas fa-fire-extinguisher"></i></span>
                      <input type="checkbox" name="extintor" id="extintor" class="checked" value="Si" <?php if($row['extintor']!=""){ echo 'checked';} ?> >
                      <label class="labelt amoldarcheck" for="extintor" >Extintor (10 lbs)</label>
                    </div>
                    </div>

                </div>
                <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon" title="Plumas (limpiador parabrisa)"><i class="fas fa-rainbow"></i></span>
                    <input type="checkbox" name="plumas" id="plumas" class="checked" value="Si" <?php if($row['plumas']!=""){ echo 'checked';} ?> >
                    <label class="labelt amoldarcheck" for="plumas" >Plumas (limpiador parabrisa)</label>
                  </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon" title="Gata Hidráulica"><i class="fas fa-tools"></i></span>
                    <input type="checkbox" name="gata" id="gata" class="checked" value="Si" <?php if($row['gata']!=""){ echo 'checked';} ?> >
                    <label class="labelt amoldarcheck" for="gata" >Gata Hidráulica</label>
                  </div>
                  </div>

              </div>
              <div class="conten_cajas">
                <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-tools"></i></span>
                  <input type="checkbox" name="llaves" id="llaves" class="checked" value="Si" <?php if($row['llaves']!=""){ echo 'checked';} ?> >
                  <label class="labelt amoldarcheck" for="llaves" >Llave De Ruedas</label>
                </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon" title="Triángulos"><i class="fas fa-tools"></i></span>
                  <input type="checkbox" name="triangulos" id="triangulos" class="checked" value="Si" <?php if($row['triangulo']!=""){ echo 'checked';} ?> >
                  <label class="labelt amoldarcheck" for="triangulos" >Triángulos</label>
                </div>
                </div>

            </div>
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon" title="Neumáticos Buen Estado"><i class="far fa-circle"></i></span>
                <input type="checkbox" name="neumaticos" id="neumaticos" class="checked" value="Si" <?php if($row['neumaticos']!=""){ echo 'checked';} ?> >
                <label class="labelt amoldarcheck" for="neumaticos" >Neumáticos Buen Estado</label>
              </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon" title="Llantas De Emergencia"><i class="far fa-circle"></i></span>
                <input type="checkbox" name="llantas" id="llantas" class="checked" value="Si" <?php if($row['llanta_emer']!=""){ echo 'checked';} ?> >
                <label class="labelt amoldarcheck" for="llantas" >Llantas De Emergencia</label>
              </div>
              </div>

          </div>
          <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
              <span class="input-group-addon" title="Cinturones De Seguridad"><i class="fas fa-shield-alt"></i></span>
              <input type="checkbox" name="cinturones" id="cinturones" class="checked" value="Si" <?php if($row['cinturones']!=""){ echo 'checked';} ?> >
              <label class="labelt amoldarcheck" for="cinturones" >Cinturones De Seguridad</label>
            </div>
            </div>
            <div class="form-group">
              <div class="input-group">
              <span class="input-group-addon" title="Licencia Profesional"><i class="fas fa-id-card-alt"></i></span>
              <input type="checkbox" name="licencia" id="licencia" class="checked" value="Si" <?php if($row['licencia']!=""){ echo 'checked';} ?> >
              <label class="labelt amoldarcheck" for="licencia" >Licencia Profesional</label>
            </div>
            </div>

        </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" title="Operadora Que Pertenece"><i class="fa fa-user-tie"></i></span>
              <input type="text" class="form-control input-lg" name="operadora" value="<?php echo $row['operadora'] ?>" placeholder="Operadora Que Pertenece" required>
            </div>
          </div>

        </div>
        </div>

              <!--========== PIE DEL MODAL ==============-->
                <div class="modal-footer">

                  <button type="submit" class="btn btn-primary">Guardar Revisión</button>
                  <a href="ingreso_revision_bus.php"><button type="button" class="btn btn-default">Salir</button></a>
                </div>
              </form>
            </div>
          </div>

        <!--=====================================
        MODAL FIN
        ======================================-->

        <script>

            $(document).on('keyup','#placa', function(){
                var valr= $('#placa').val();
                if(valr!=""){
                   // var texto = MaysPrimera(valr.tolowerCase());
                   var texto = valr.toUpperCase(); // todo mayuscula
                   // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
                    document.getElementById('placa').value=texto;
                }
            });

        </script>



      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL FIN
======================================-->
<script type="text/javascript">
$(document).on('keyup','#cargo', function(){
    var valr= $('#cargo').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('cargo').value=texto;
    }
});

</script>

<?php include 'footer.php'; ?>
