<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>
<div class="content-wrapper">
<style media="screen">
  .content_btn_lis{
    display: flex;
  }
</style>
  <section class="content-header">
    <h1>Administrar Reunión De Socios</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Reunión De Socios</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Reunión </button>
      </div>



      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>

           <th>Fecha</th>
           <th>Tipo De Reunion</th>
           <th>Asuntos</th>
           <th>Doc. Acta</th>
           <th>Doc. Balance</th>
           <th>Ver Asistencia</th>
           <th>Agg. Asistencia</th>
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from reunion_socios R inner join tipo_reunion TR on TR.id_tipo_reunion=R.id_tipo_reunion ");
              while($row=mysqli_fetch_array($consulta)){
            ?>

              <td><?php echo $row['fecha']; ?> </td>
              <td><?php echo $row['descripr']; ?> </td>
              <td><?php echo $row['asuntos']; ?> </td>
              <td> <a href="<?php echo $row['documento']; ?>" target="_blank"><i class="fas fa-file-download fa-2x"></i></a>  </td>
              <td> <?php if($row['documento2']!=""){ ?><a href="<?php echo $row['documento2']; ?>" target="_blank"><i class="fas fa-file-download fa-2x"></i></a> <?php } ?> </td>
              <td><a href="#" class="list" data-toggle="modal" data-target="#modalAgregarCategoria"  data-id="<?php echo $row['id_reunion_socios'] ?>"> <button class="btn btn-default"><i class="far fa-eye" ></i></button></a> </td>

              <td><a href="asignar_lista.php?id=<?php echo $row['id_reunion_socios'] ?>"> <button class="btn btn-success"><i class="far fa-share-square"></i></button></a> </td>


              <td><div class="btn-group content_btn_lis">
                <a href="editar_reunion.php?id=<?php echo $row['id_reunion_socios'] ?>"> <button class="btn btn-primary" title="Editar Reunión"><i class="fa fa-pencil"></i></button></a>
                <!-- <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_reunion_socios'] ?>"><i class="fa fa-times" id="<?php echo $row['id_reunion_socios'] ?>"></i></button></a> -->
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
                                 document.location.href="eliminar_reunion.php?id="+id_emp;
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

      <form role="form" action="guardar_reunion.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Reunión</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA  -->
          <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Tipo De Reunion"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="tipo_reunion" required><option value="">Tipo De Reunion</option>
                  <?php $consulta4=mysqli_query($con,"SELECT * from tipo_reunion");
                    while($row4=mysqli_fetch_array($consulta4)){
                    echo "<option value='".$row4['id_tipo_reunion']."'>"; echo $row4['descripr']; echo "</option>"; } ?> </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Numero De Reunión"><i class="fas fa-sort-numeric-up"></i></span>
                <input type="text" class="form-control input-lg" name="numero" id="numero" placeholder="Numero De Reunión" autocomplete="off" onkeypress="return solonumeros(event)" maxlength="4" required>
              </div>
            </div>

          </div>
          <div class="conten_cajas">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Asunto"><i class="far fa-file-alt"></i></span>
                <input type="text" class="form-control input-lg" name="asunto" id="asunto" autocomplete="off" placeholder="Ingresar Asunto" required>
              </div>
            </div>
            <div class="form-group"> </div>
          </div>

          <div class="form-group" >
            <div class="input-group" title="Subir Documento(Acta de Reunión)">
              <span class="input-group-addon" ><i class="fas fa-file"></i></span>
              <input type="file" class="form-control input-lg" name="documento" title="Subir Documento(Acta de Reunión)"  required>
            </div>
          </div>
          <div class="form-group" >
            <div class="input-group" title="Subir Documento(Balance General)">
              <span class="input-group-addon" ><i class="fas fa-file"></i></span>
              <input type="file" class="form-control input-lg" name="documento2" title="Subir Documento(Balance General)" >
            </div>
          </div>


          </div>

        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Reunión</button>
        </div>
      </form>
    </div>
  </div>
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








<!--=====================================
MODAL AGREGAR EXTRA
======================================-->
<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#aec5d2; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body" >
            <table class="tabla" id="tabla2" >
             <thead>
              <tr>
                <th>Nombres</th>
                <th>Tipo de Socio</th>
              </tr>
             </thead>
             <tbody id="cont_tabla">

             </tbody>
            </table>
            <script type="text/javascript">
                $(document).ready(function() { $('#tabla2').DataTable( { dom: 'Bfrtip', buttons: [ 'excel', 'pdf' ] } ); } );
            </script>

          </div>
        </div>
    </div>
  </div>
</div>

<!--=====================================
PIE DEL MODAL
======================================-->


<script type="text/javascript">
$(document).ready(function(){

   $('.list').click(function(e) {
  var idr=this.dataset.id;
  var dataString ="id="+idr;

  $.ajax({
    url: "tabla_asistencia.php",
    data: dataString,
    async: false,
    success : function(text)
    {
      $("#cont_tabla").html(text);

    }
  });

  });
});
</script>


<?php include 'footer.php'; ?>
