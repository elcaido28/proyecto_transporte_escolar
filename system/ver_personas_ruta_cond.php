<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];
$consulta2=mysqli_query($con,"SELECT * from ruta where id_ruta='$id' ");
$row2=mysqli_fetch_array($consulta2);
?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Pasajeros</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_ruta.php"><i class="fas fa-route"></i>Ver Pasajeros</a></li>
      <li class="active"> Pasajeros</li>
    </ol>
  </section>
<style media="screen">
div.dataTables_wrapper {
      margin-bottom: 3em;
  }
  .anch_tabl{
    width: 200px;
    display: flex;
  }
  .anch_tabl button{
    margin-left: 10px;
  }
</style>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <a href="ver_lista_personas.php"><button type="button" class="btn btn-default">Salir</button></a>
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>


      <div class="box-body cont_tabla">


        <center><h2>Personas de Ruta: <?php echo "#".$row2['num_ruta']; ?></h2></center>

                <table class="tabla" >
                    <thead>
                      <tr>
                      <th>Foto</th>
                      <th>Nombres</th>
                      <th>Telefono</th>
                      <th>Dirección</th>
                      </tr>
                      </thead>
                      <tr>
                        <?php

                        $consulta=mysqli_query($con,"SELECT * from rutas_personas RP inner join personas P on P.id_personas=RP.id_personas  where RP.id_ruta='$id' ");
                         while($row=mysqli_fetch_array($consulta)){
                           $id_per=$row['id_personas'];

                        ?>
                              <td> <img src=" <?php echo $row['foto']; ?>" alt="" width="60" height="60"> </td>
                              <td><?php echo $row['nombre']." ".$row['apellido']; ?> </td>
                              <td><?php echo $row['telefono']; ?> </td>
                              <td><?php echo $row['direccion']; ?> </td>


                  </tr>

                        <?php
                              }
                        ?>
                </table>

               <script charset="utf-8">
               $(document).ready(function() {
            $('table.tabla').DataTable();
        } );

               </script>



      </div>
    </div>
  </section>
</div>

<?php include 'footer.php'; ?>
