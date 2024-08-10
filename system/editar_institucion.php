<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT * FROM institucion   WHERE id_institucion='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Institución</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_institucion.php"><i class="fa fa-list-ul"></i> Administrar Institución</a></li>
      <li class="active">Editar Institución</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="modificar_institucion.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Institución</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->

                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Nombre"><i class="fas fa-university"></i></span>
                        <input type="text" class="form-control input-lg" name="nombre" id="nombre" value="<?php echo  $row['nombre']; ?>" placeholder="Ingresar Nombre" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Tipo De Institución"><i class="far fa-file-alt"></i></span>
                        <select class="form-control input-lg" name="descrip" required><option value="" >Tipo De Institución</option>
                          <option <?php if("Unidad Educativa"==$row['descrip']){echo 'selected="selected"';} ?>>Unidad Educativa</option>
                          <option <?php if("Empresa"==$row['descrip']){echo 'selected="selected"';} ?>>Empresa</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <!-- ENTRADA -->

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Institución</button>
                <a href="ingreso_institucion.php"><button type="button" class="btn btn-default">Salir</button></a>
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
$(document).on('keyup','#nombre', function(){
    var valr= $('#nombre').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('nombre').value=texto;
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
