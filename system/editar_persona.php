<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT *,P.telefono telefo FROM personas P inner join clientes C on C.id_clientes=P.id_clientes WHERE P.id_personas='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
$tiperso=$row['id_tipo_cliente'];
$idc=$row['id_clientes'];
?>

<div class="content-wrapper">
  <style media="screen">
    .stnone{
      display: none;
    }
  </style>
  <section class="content-header">
    <h1>Administrar Personas</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="asignar_personas.php?id=<?php echo $idc; ?>"><i class="fa fa-list-ul"></i> Administrar Personas</a></li>
      <li class="active">Editar Persona</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="modificar_persona.php?id=<?php echo $id."&tp=".$tiperso."&idc=".$idc; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Persona</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Nombres"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" name="nombres" value="<?php echo $row['nombre']; ?>" id="nombres" onkeypress="return soloLetras(event)" placeholder="Ingresar Nombres" required>
                      </div>
                    </div>
                  <!-- ENTRADA -->

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Apellidos"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" name="apellidos" value="<?php echo $row['apellido']; ?>" id="apellidos" onkeypress="return soloLetras(event)" placeholder="Ingresar Apellidos" required>
                    </div>
                  </div>
                </div>
                  <!-- ENTRADA  -->

                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Teléfono"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control input-lg" name="telefono" value="<?php echo $row['telefo']; ?>" placeholder="Ingresar Teléfono" data-inputmask="'mask':'0999-999-999'" data-mask >
                      </div>
                    </div>
                    <!-- ENTRADA  -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Direciión"><i class="fa fa-map-marker"></i></span>
                        <input type="text" class="form-control input-lg" name="direccion" value="<?php echo $row['direccion']; ?>" id="direccion"  placeholder="Ingresar Dirección" required>
                      </div>
                    </div>

                  </div>  <!-- ENTRADA -->
                  <?php  if($tiperso=='1'){ ?>
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Curso"><i class="fas fa-table"></i></span>
                        <select class="form-control input-lg" name="curso" required><option value="" >Curso</option>
                          <?php $consulta4=mysqli_query($con,"SELECT * from curso where id_curso!='14'");
                            while($row4=mysqli_fetch_array($consulta4)){
                            if($row4['id_curso']==$row['id_curso']){$sel="selected='selected'";}else{$sel="";}
                            echo "<option ".$sel." value='".$row4['id_curso']."'>"; echo $row4['descrip']; echo "</option>"; } ?> </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Paralelo"><i class="fas fa-stream"></i></span>
                        <select class="form-control input-lg" name="paralelo" required><option value="" >Paralelo</option>
                          <option <?php if("A"==$row['paralelo']){echo 'selected="selected"';} ?> >A</option>
                          <option <?php if("B"==$row['paralelo']){echo 'selected="selected"';} ?>>B</option>
                          <option <?php if("C"==$row['paralelo']){echo 'selected="selected"';} ?>>C</option>
                          <option <?php if("D"==$row['paralelo']){echo 'selected="selected"';} ?>>D</option>
                          <option <?php if("E"==$row['paralelo']){echo 'selected="selected"';} ?>>E</option>
                          <option <?php if("F"==$row['paralelo']){echo 'selected="selected"';} ?>>F</option>
                          <option <?php if("G"==$row['paralelo']){echo 'selected="selected"';} ?>>G</option>
                          <option <?php if("---"==$row['paralelo']){echo 'selected="selected"';} ?>>---</option>
                          </select>
                      </div>
                    </div>

                </div>
                <!-- ENTRADA  -->
                <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Servicio 10 meses"><i class="fas fa-calendar-alt"></i></span>
                      <select class="form-control input-lg" name="tiempos" id="ti_ser" required><option value="" >Servicio 10 meses</option>
                        <option <?php if("Si"==$row['tiempo_servicio']){echo 'selected="selected"';} ?>>Si</option>
                        <option <?php if("No"==$row['tiempo_servicio']){echo 'selected="selected"';} ?>>No</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group <?php if($row['otro_tiempo']!=""){echo 'stnone';} ?>" id="tipo_ser1">
                    <div class="input-group" >
                      <span class="input-group-addon" title="Tipo Servicio"><i class="fas fa-location-arrow"></i></span>
                      <select class="form-control input-lg" name="servicio1" id="tipo_ser1s" required><option value="" >Tipo Servicio</option>
                        <?php $consulta4=mysqli_query($con,"SELECT * from servicio where id_servicio!='4'");
                          while($row4=mysqli_fetch_array($consulta4)){
                            if($row4['id_servicio']==$row['id_servicio']){$sel="selected='selected'";}else{$sel="";}
                            echo "<option ".$sel." value='".$row4['id_servicio']."'>"; echo $row4['descrips']; echo "</option>"; } ?>  </select>
                    </div>
                  </div>
                  <div class="form-group <?php if($row['otro_tiempo']==""){echo 'stnone';} ?>" id="otro" >
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Otro Tiempo del Servicio"><i class="fas fa-calendar-alt"></i></span>
                      <input type="text" class="form-control input-lg" name="otro_tiempo" value="<?php echo $row['otro_tiempo']; ?>"  id="otrot" placeholder="Otro Tiempo del Servicio" >
                    </div>
                  </div>

                </div>
                <div class="conten_cajas">

                  <div class="form-group <?php if($row['otro_tiempo']==""){echo 'stnone';} ?>" id="tipo_ser2">
                    <div class="input-group">
                      <span class="input-group-addon" title="Tipo Servicio"><i class="fas fa-location-arrow"></i></span>
                      <select class="form-control input-lg" name="servicio2" id="tipo_ser2s"><option value="" >Tipo Servicio</option>
                        <?php $consulta5=mysqli_query($con,"SELECT * from servicio where id_servicio!='4'");
                          while($row5=mysqli_fetch_array($consulta5)){
                            if($row5['id_servicio']==$row['id_servicio']){$sel="selected='selected'";}else{$sel="";}
                            echo "<option ".$sel." value='".$row5['id_servicio']."'>"; echo $row5['descrips']; echo "</option>"; } ?>  </select>
                    </div>
                  </div>
                    <div class="form-group" >
                      <div class="input-group">
                        <span class="input-group-addon" title="Extracurricular"><i class="fas fa-location-arrow"></i></span>
                        <select class="form-control input-lg" name="extracurricular" id="tipo_ser1s" required><option value="" >Extracurricular</option>
                          <?php $consulta6=mysqli_query($con,"SELECT * from extracurricular ");
                            while($row6=mysqli_fetch_array($consulta6)){
                              if($row6['id_extracurricular']==$row['id_extracurricular']){$sel="selected='selected'";}else{$sel="";}
                              echo "<option ".$sel." value='".$row6['id_extracurricular']."'>"; echo $row6['descrip2']; echo "</option>"; } ?>  </select>
                      </div>
                    </div>
                    <div class="form-group"> </div>

                </div>


                  <!-- ENTRADA SUBIR FOTO -->
                   <div class="form-group">
                    <div class="panel">SUBIR FOTO</div>
                    <input type="file" class="nuevaFoto" name="foto" accept="image/jpeg">
                    <p class="help-block">Peso máximo de la foto 3MB</p>
                    <img src="../vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                  </div>
                <?php } ?>
                  <!-- ENTRADA -->

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Persona</button>
                <a href="asignar_personas.php?id=<?php echo $idc; ?>"><button type="button" class="btn btn-default">Salir</button></a>
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
<script>

    $(document).on('keyup','#nombresc', function(){
        var valr= $('#nombresc').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('nombres').value=texto;
        }
    });
    $(document).on('keyup','#nombres', function(){
        var valr= $('#nombres').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('nombres').value=texto;
        }
    });
    $(document).on('keyup','#apellidos', function(){
        var valr= $('#apellidos').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('apellidos').value=texto;
        }
    });

    $(document).on('keyup','#otrot', function(){
        var valr= $('#otrot').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('otrot').value=texto;
        }
    });
    $(document).on('keyup','#direccion', function(){
        var valr= $('#direccion').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = MaysPrimera(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('direccion').value=texto;
        }
    });

    $(document).on('change','#ti_ser', function(){
        var valr= $('#ti_ser').val();
        if(valr=="Si" || valr==""){
          $('#tipo_ser2').css("display", "none");
          $('#otro').css("display", "none");
          $('#tipo_ser1').css("display", "block");
          document.getElementById('tipo_ser2s').removeAttribute('required');
          document.getElementById('otrot').removeAttribute('required');
          document.getElementById('tipo_ser1s').setAttribute('required', '');
        }else{
          $('#tipo_ser2').css("display", "block");
          $('#tipo_ser1').css("display", "none");
          $('#otro').css("display", "block");
          document.getElementById('tipo_ser2s').setAttribute('required', '');
          document.getElementById('tipo_ser1s').removeAttribute('required');
          document.getElementById('otrot').setAttribute('required', '');
        }
    });

</script>

<?php include 'footer.php'; ?>
