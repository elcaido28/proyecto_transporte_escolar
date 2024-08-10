<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

if (isset($_POST['ano_ruta'])) {
  $anos=$_POST['ano_ruta'];
  $dt_where=" AND ano='".$anos."'";
}else{
  $anos=date('Y');
  $dt_where=" AND ano='".$anos."'";
}
?>
<div class="content-wrapper">
<style media="screen">
  .cont_input_bus{
    width: 150px;
  }
  .box-header form{
    display: flex;
    width: 250px;
    margin-top: 30px;
    margin-left: 20px;
  }
</style>
  <section class="content-header">
    <h1>Administrar Ruta</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Ruta</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Ruta </button>
        <form class="" action="" method="post">
          <div class="cont_input_bus">
            <select class="form-control input-lg"  onchange="tipo_cli(this.value);" name="ano_ruta" required><option value="" >Año de Rutas</option>
              <?php $consulta4=mysqli_query($con,"SELECT DISTINCT ano from ruta order by ano DESC ");
                while($row4=mysqli_fetch_array($consulta4)){
                  if($row4['ano']==$anos){$sel="selected='selected'";}else{$sel="";}
                echo "<option ".$sel." value='".$row4['ano']."'>"; echo $row4['ano']; echo "</option>"; } ?> </select>
          </div>

          <input type="submit" class="btn btn-default" name="" value="Buscar">
        </form>
      </div>


      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>


      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >
        <thead>
         <tr>
           <th>Nº Ruta</th>
           <th>Sector</th>
           <th>Tipo De Ruta</th>
           <th>Descripción</th>
           <th>Asig. Personas</th>
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from ruta where id_estado='1' ".$dt_where." ");
              while($row=mysqli_fetch_array($consulta)){
            ?>

              <td><?php echo "Ruta #".$row['num_ruta']; ?> </td>
              <td><?php echo $row['sector']; ?> </td>
              <td><?php echo $row['tipo']; ?> </td>
              <td><?php echo $row['descripcion']; ?> </td>

              <td><a href="asignar_personas_ruta.php?id=<?php echo $row['id_ruta']."&ano=".$row['ano'] ?>"> <button class="btn btn-success"><i class="far fa-share-square"></i></button></a> </td>
              <td><div class="btn-group">
                <a href="editar_ruta.php?id=<?php echo $row['id_ruta'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_ruta'] ?>"><i class="fa fa-times" id="<?php echo $row['id_ruta'] ?>"></i></button></a>
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
                                 document.location.href="eliminar_ruta.php?id="+id_emp;
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

      <form role="form" action="guardar_ruta.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Ruta</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Nº de ruta"><i class="fas fa-list-ol"></i></span>
                <input type="text" class="form-control input-lg" maxlength="2" id="nruta" name="nruta" autocomplete="off" onkeypress="return solonumeros(event)" placeholder="Ingresar Nº de ruta" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Sector"><i class="far fa-map"></i></span>
                <input type="text" class="form-control input-lg" name="sector" id="sector" autocomplete="off" placeholder="Ingresar Sector" required>
              </div>
            </div>
            </div>
            <!-- ENTRADA  -->
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Tipo De Ruta"><i class="far fa-file-alt"></i></span>
                  <select class="form-control input-lg" name="tipo" id="tipo" required><option value="" >Tipo De Ruta</option>
                    <option>Primaria</option>
                    <option>Secundaria</option>
                    <option>Empresa</option>
                    </select>
                </div>
              </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Descripción"><i class="far fa-file-alt"></i></span>
                <select class="form-control input-lg" name="descrip" id="descrip" required><option value="" >Descripción</option>
                  <option>Normal</option>
                  <option>Extracurricular</option>
                  </select>
              </div>
            </div>

          </div>
             <!-- ENTRADA -->


          </div>

        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Ruta</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL FIN
======================================-->
<script>
$(buscar_ruta());

function buscar_ruta(consulta){
  $.ajax({
    url: 'verifica_ruta.php',
    type: 'POST',
    dataType: 'html',
    data: consulta,
  })
  .done(function(respuesta){
    if(respuesta==''){

    }else{
    if(respuesta>0){

      document.getElementById('nruta').value='';
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
        onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'warning',
        title: 'Ya existe una RUTA con esas especificaciones'
      })
    }else{

    }
    }
    // document.getElementById('cedula').value=respuesta;
  })
  .fail(function(){
    console.log("error")
  })
}
$(document).on('change','#descrip', function(){
  var descrip= document.getElementById('descrip').value;
  var num=document.getElementById('nruta').value;
  var tipo=document.getElementById('tipo').value;
  if(descrip!="" || num!="" || tipo!=""){
    var dat="num="+num+"&tipo="+tipo+"&descrip="+descrip+"";
    buscar_ruta(dat);
  }
});
$(document).on('change','#nruta', function(){
  var descrip= document.getElementById('descrip').value;
  var num=document.getElementById('nruta').value;
  var tipo=document.getElementById('tipo').value;
  if(descrip!="" || num!="" || tipo!=""){
    var dat="num="+num+"&tipo="+tipo+"&descrip="+descrip+"";
    buscar_ruta(dat);
  }
});
$(document).on('change','#tipo', function(){
  var descrip= document.getElementById('descrip').value;
  var num=document.getElementById('nruta').value;
  var tipo=document.getElementById('tipo').value;
  if(descrip!="" || num!="" || tipo!=""){
    var dat="num="+num+"&tipo="+tipo+"&descrip="+descrip+"";
    buscar_ruta(dat);
  }
});
</script>

<?php include 'footer.php'; ?>
