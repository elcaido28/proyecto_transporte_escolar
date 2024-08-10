<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_SESSION['ID_usu'];

?>
<div class="content-wrapper">
<style media="screen">
  .stnone{
    display: none;
  }
</style>
  <section class="content-header">
    <h1>Solicitar Servicio</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Solicitar Servicio</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Estudiante</button> -->
        <!-- <a href="ingreso_clientes.php"><button type="button" class="btn btn-default">Salir</button></a> -->
      </div>
      <div class="box-body cont_tabla">
         <table class="tabla" id="tabla" >

          <thead>
           <tr>
             <th>Fecha</th>
             <th>Nombres clientes</th>
             <th>Telefono</th>
             <th>Aceptar solicitud</th>
           </tr>
          </thead>
          <tbody>
            <tr>
              <?php
                $consulta=mysqli_query($con,"SELECT DISTINCT CL.id_clientes,CL.fecha,CL.nombres,CL.apellidos,CL.telefono  from solicitud_servicio SS inner join clientes CL on CL.id_clientes=SS.id_clientes ");
                while($row=mysqli_fetch_array($consulta)){

              ?>
                <td><?php echo $row['fecha']; ?> </td>
                <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
                <td><?php echo $row['telefono']; ?> </td>

                <td><div class="btn-group">
                  <a href="#" class="list" data-toggle="modal" data-target="#modalAgregarCategoria"  data-id="<?php echo $row['id_clientes'] ?>"> <button class="btn btn-default"><i class="far fa-eye" ></i></button></a>
                  <!-- <a href="eliminar_solicitar_servi.php?id=<?php echo $row['id_clientes'] ?>" title="Aceptar Solicitud"> <button class="btn btn-primary"><i class="fas fa-paper-plane"></i></button></a> -->
                </div></td>
                </tr>

              <?php } ?>
          </tbody>
         </table>

         <script charset="utf-8">
         $(document).ready(function() {
          $('.tabla').DataTable();
         } );

         </script>

      </div>
    </div>
  </section>
</div>



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
                <th>Curso</th>
                <th>Servicios</th>
                <th>Extracurricular</th>
                <th>Aceptar Servicio</th>
              </tr>
             </thead>
             <tbody id="cont_tabla">

             </tbody>
            </table>
            <script type="text/javascript">
                $(document).ready(function() { $('#tabla2').DataTable(); } );
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
    url: "tabla_servi_solici.php",
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



<?php if (isset($_SESSION['msj'])) { if ($_SESSION['msj']=='1') { ?>
<script type="text/javascript">
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Se acepto la solicitud con exito'
})
</script>
<?php $_SESSION['msj']='0'; } } ?>
<?php include 'footer.php'; ?>
