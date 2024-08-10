<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT * FROM tipo_empleado   WHERE id_tipo_empleado='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Cargos</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_cargo.php"><i class="fa fa-list-ul"></i> Administrar Cargos</a></li>
      <li class="active">Editar Cargo</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="modificar_cargo.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Cargo</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Cargo"><i class="fas fa-sitemap"></i></span>
                      <input type="text" class="form-control input-lg" name="cargo" id="cargo" value="<?php echo  $row['descrip']; ?>" placeholder="Ingresar Cargo" required>
                    </div>
                  </div>
                  <!-- ENTRADA -->

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Cargo</button>
                <a href="ingreso_cargo.php"><button type="button" class="btn btn-default">Salir</button></a>
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
