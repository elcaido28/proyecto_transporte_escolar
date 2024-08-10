<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_SESSION['ID_usu'];
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
    <h1>Ver Pasajeros</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Ver Pasajeros</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Ruta </button> -->

      </div>


      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >
        <thead>
         <tr>
           <th>Nº Ruta</th>
           <th>Sector</th>
           <th>Tipo De Ruta</th>
           <th>Descripción</th>
           <th>Ver Pasajeros</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from ruta R inner join rutas_bus RB on RB.id_rutas=R.id_ruta inner join buses B on B.id_buses=RB.id_bus where R.id_estado='1' and B.conductor='$id' ");
              while($row=mysqli_fetch_array($consulta)){
            ?>

              <td><?php echo "Ruta #".$row['num_ruta']; ?> </td>
              <td><?php echo $row['sector']; ?> </td>
              <td><?php echo $row['tipo']; ?> </td>
              <td><?php echo $row['descripcion']; ?> </td>

              <td><a href="ver_personas_ruta_cond.php?id=<?php echo $row['id_ruta']."&ano=".$row['ano'] ?>"> <button class="btn btn-success"><i class="far fa-share-square"></i></button></a> </td>

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
