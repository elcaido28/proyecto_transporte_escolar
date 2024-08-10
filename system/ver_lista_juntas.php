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
    <h1>Ver Reunión De Socios</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Reunión De Socios</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Reunión </button> -->
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

              </tr>

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


<?php include 'footer.php'; ?>
