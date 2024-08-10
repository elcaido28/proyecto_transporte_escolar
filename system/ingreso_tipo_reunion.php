<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Tipo De Reunión</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Tipo De Reunión</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Tipo De Reunión </button>
      </div>



      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>

           <th>Tipo De Reunión</th>
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from tipo_reunion ");
              while($row=mysqli_fetch_array($consulta)){
            ?>

              <td><?php echo $row['descripr']; ?> </td>

              <td><div class="btn-group">
                <a href="editar_tipo_reunion.php?id=<?php echo $row['id_tipo_reunion'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_tipo_reunion'] ?>"><i class="fa fa-times" id="<?php echo $row['id_tipo_reunion'] ?>"></i></button></a>
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
                                 document.location.href="eliminar_tipo_reunion.php?id="+id_emp;
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

      <form role="form" action="guardar_tipo_reunion.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Tipo de Reunión</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Tipo de Reunión"><i class="fas fa-table"></i></span>
                <input type="text" class="form-control input-lg" id="tipo" name="tipo" autocomplete="off" placeholder="Ingresar Tipo de Reunión" required>
              </div>
            </div>

          </div>

        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Tipo de Reunión</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL FIN
======================================-->

<script>
$(buscar_igual());
function buscar_igual(consulta){
  $.ajax({
    url: 'ajax_igual_reunion.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: consulta},
  })
  .done(function(respuesta){
    if(respuesta==''){

    }else{
    if(respuesta>0){
      $("#curso").css({
        "background-color": "rgba(255,255,255,0.5)"
      });
      document.getElementById('curso').value='';
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'warning',
        title: 'Ya existe un Curso con el mismo nombre'
      })
    }else{
      $("#curso").css({
        "background-color": "rgba(255, 255, 255, 0.5)"
      });
    }
    }
    // document.getElementById('cedula').value=respuesta;
  })
  .fail(function(){
    console.log("error")
  })
}
$(document).on('change','#tipo', function(){

  var valr= $(this).val();
  if(valr!=""){
    buscar_igual(valr);
  }
});
</script>
<script type="text/javascript">
$(document).on('keyup','#tipo', function(){
    var valr= $('#tipo').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('tipo').value=texto;
    }
});

</script>


<?php if(isset($_REQUEST['guardo'])) {  if($_REQUEST['guardo']=='1') { ?>

<script type="text/javascript">
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'warning',
  title: 'Ya existe un Tipo de Reunión con el mismo nombre'
})
</script>

<?php  } } ?>

<?php include 'footer.php'; ?>
