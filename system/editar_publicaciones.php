<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT * FROM publicaciones   WHERE id_publicaciones='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Publicaciones Web</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_noticias_web.php"><i class="fa fa-list-ul"></i> Administrar Publicaciones Web</a></li>
      <li class="active">Editar Publicaciones Web</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="modificar_publicaciones.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Publicación Web</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                    <div class="form-group" >
                      <div class="input-group" title="Imagen de la publicación">
                        <span class="input-group-addon" ><i class="fas fa-image"></i></span>
                        <input type="file" class="form-control input-lg" name="img" title="Imagen de la publicación"  accept="image/jpeg" >
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Titulo"><i class="fas fa-text-height"></i></span>
                        <input type="text" class="form-control input-lg" name="titulo" id="titulo" value="<?php echo $row['titulo']; ?>" placeholder="Ingresar Titulo" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Titulo"><i class="far fa-file-alt"></i></span>
                      <textarea name="descrip" class="form-control input-lg" rows="8" cols="80" id="descrip" placeholder="Ingresar Descrioción" required><?php echo $row['descripcion']; ?></textarea>
                    </div>
                  </div>

                  <!-- ENTRADA -->

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Publicación Web</button>
                <a href="ingreso_noticias_web.php"><button type="button" class="btn btn-default">Salir</button></a>
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
$(document).on('keyup','#titulo', function(){
    var valr= $('#titulo').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('titulo').value=texto;
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
