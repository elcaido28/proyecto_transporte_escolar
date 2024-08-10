<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT * FROM pago_socios P inner join deuda_socios D on D.id_deuda_socios=P.id_deuda_socios WHERE P.id_pago_socios='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Pagos De Deudas Sociales</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_pagos_socios.php"><i class="fa fa-list-ul"></i> Pagos De Deudas</a></li>
      <li class="active">Editar Pagos De Deudas</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="modificar_pagos_socios.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Pago</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Dueño Del Vehiculo"><i class="fa fa-user-tie"></i></span>
                      <select class="form-control input-lg" name="socio" required><option value="">Socios</option>
                        <?php $consulta4=mysqli_query($con,"SELECT * from empleados where id_estado='1' and id_tipo_empleado='4' or id_estado='1' and id_tipo_empleado='7'");
                          while($row4=mysqli_fetch_array($consulta4)){
                            if($row4['id_empleados']==$row['id_empleados']){$sel="selected='selected'";}else{$sel="";}
                          echo "<option ".$sel."value='".$row4['id_empleados']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
                    </div>
                  </div>

                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Motivo de Deuda"><i class="far fa-list-alt"></i></span>
                        <select class="form-control input-lg" name="motivo" required><option value="">Motivo de Deuda</option>
                          <option <?php if("Cuota Social"==$row['tipo_pago']){echo 'selected="selected"';} ?>>Cuota Social</option>
                          <option <?php if("Multa"==$row['tipo_pago']){echo 'selected="selected"';} ?>>Multa</option>
                          <option <?php if("Otros"==$row['tipo_pago']){echo 'selected="selected"';} ?>>Otros</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Mes"><i class="fas fa-calendar-alt"></i></span>
                        <select class="form-control input-lg" name="mes" required><option value="">Mes</option>
                          <option <?php if("01"==$row['mes']){echo 'selected="selected"';} ?> value="01">Enero</option>
                          <option <?php if("02"==$row['mes']){echo 'selected="selected"';} ?> value="02">Febrero</option>
                          <option <?php if("03"==$row['mes']){echo 'selected="selected"';} ?> value="03">Marzo</option>
                          <option <?php if("04"==$row['mes']){echo 'selected="selected"';} ?> value="04">Abril</option>
                          <option <?php if("05"==$row['mes']){echo 'selected="selected"';} ?> value="05">Mayo</option>
                          <option <?php if("06"==$row['mes']){echo 'selected="selected"';} ?> value="06">Junio</option>
                          <option <?php if("07"==$row['mes']){echo 'selected="selected"';} ?> value="07">Julio</option>
                          <option <?php if("08"==$row['mes']){echo 'selected="selected"';} ?> value="08">Agosto</option>
                          <option <?php if("09"==$row['mes']){echo 'selected="selected"';} ?> value="09">Septiembre</option>
                          <option <?php if("10"==$row['mes']){echo 'selected="selected"';} ?> value="10">Octubre</option>
                          <option <?php if("11"==$row['mes']){echo 'selected="selected"';} ?> value="11">Noviembre</option>
                          <option <?php if("12"==$row['mes']){echo 'selected="selected"';} ?> value="12">Diciembre</option>
                        </select>

                      </div>
                    </div>

                  </div>
                  <div class="conten_cajas">

                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Valor"><i class="fas fa-coins"></i></span>
                        <input type="text" class="form-control input-lg" name="valor" value="<?php echo $row['pago']; ?>"  placeholder="Ingresar Valor" maxlength="6" onkeypress="return solonumeros(event)" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Descripción"><i class="far fa-file-alt"></i></span>
                        <input type="text" class="form-control input-lg" name="descrip" value="<?php echo $row['descripcion']; ?>"  placeholder="Ingresar Descripción">
                      </div>
                     </div>
                  </div>
                  <!-- ENTRADA -->

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Pago</button>
                <a href="ingreso_pagos_socios.php"><button type="button" class="btn btn-default">Salir</button></a>
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
