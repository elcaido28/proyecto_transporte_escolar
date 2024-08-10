<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Publicaciones Web</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Publicaciones Web</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Publicación </button>
      </div>


      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>


      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>

           <th>Imagen</th>
           <th>Titulo</th>
           <th>Descripción</th>
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from publicaciones ");
              while($row=mysqli_fetch_array($consulta)){
            ?>
              <td> <img src=" <?php echo $row['img']; ?>" alt="" width="60" height="60"> </td>
              <td><?php echo $row['titulo']; ?> </td>
              <td><?php echo $row['descripcion']; ?> </td>

              <td><div class="btn-group">
                <a href="editar_publicaciones.php?id=<?php echo $row['id_publicaciones'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_publicaciones'] ?>"><i class="fa fa-times" id="<?php echo $row['id_publicaciones'] ?>"></i></button></a>
              </div></td>
              </tr>

              <script type="text/javascript">
                     $('.eliminar').click(function(e){
                       var id_emp= e.target.id;
                           const swalWithBootstrapButtons = Swal.mixin({
                             customClass: {
                               confirmButton: 'btn btn-success',
                               cancelButton: 'btn btn-danger'
                             },
                             buttonsStyling: false
                           })
                           swalWithBootstrapButtons.fire({
                             title: 'Esta Seguro?',
                             text: "No podrás revertir esto!",
                             icon: 'warning',
                             showCancelButton: true,
                             confirmButtonText: 'Si, eliminar!',
                             cancelButtonText: 'No, cancelar!',
                             reverseButtons: true
                           }).then((result) => {
                             if (result.value) {
                                 document.location.href="eliminar_publicaciones.php?id="+id_emp;
                             } else if (
                               /* Read more about handling dismissals below */
                               result.dismiss === Swal.DismissReason.cancel
                             ) {

                             }
                           })
                 })
                   </script>
            <?php } ?>
        </tbody>
       </table>

       <script charset="utf-8">
       $(document).ready(function() {
           $('#tabla').DataTable( {
               dom: 'Bfrtip',
               buttons: [
                   'excel', 'pdf'  //'copy', 'csv', 'excel', 'pdf', 'print'
               ]
           } );
       } );

       </script>

      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR RUTA
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" action="guardar_coticias_web.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Publicaciones Web</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA  -->
          <div class="conten_cajas">
            <div class="form-group" >
              <div class="input-group" title="Imagen de la publicación">
                <span class="input-group-addon" ><i class="fas fa-image"></i></span>
                <input type="file" class="form-control input-lg" name="img" title="Imagen de la publicación"  accept="image/jpeg" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Titulo"><i class="fas fa-text-height"></i></span>
                <input type="text" class="form-control input-lg" name="titulo" id="titulo" placeholder="Ingresar Titulo" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon" title="Ingresar Titulo"><i class="far fa-file-alt"></i></span>
              <textarea name="descrip" class="form-control input-lg" rows="8" cols="80" id="descrip" placeholder="Ingresar Descrioción" required></textarea>
            </div>
          </div>


          </div>

        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Publicación</button>
        </div>
      </form>
    </div>
  </div>
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
