<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

$id=$_SESSION['ID_usu'];

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Rutas Asignadas</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Rutas Asignadas</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Cargo </button> -->
      </div>



      <div class="box-body cont_tabla">
        <table id="tabla" class="tabla" style="width:100%">
          <thead>
           <tr>
             <th>Nº Ruta</th>
             <th>Conductor</th>
             <th>Telefono Conductor</th>
             <th>Estudiante</th>
           </tr>
          </thead>
          <?php
            $consulta=mysqli_query($con,"SELECT R.id_ruta, R.num_ruta,P.nombre,P.apellido FROM personas P inner join rutas_personas RP on RP.id_personas=P.id_personas inner join ruta R on R.id_ruta=RP.id_ruta WHERE P.id_clientes='$id' order by P.nombre ASC ");
            while($row=mysqli_fetch_array($consulta)){
              $id_r=$row['id_ruta'];
              $consult2=mysqli_query($con,"SELECT E.nombres,E.apellidos,E.telefono FROM rutas_bus RB inner join buses B on B.id_buses=RB.id_bus inner join empleados E on E.id_empleados=B.conductor WHERE RB.id_rutas='$id_r'");
              $row2=mysqli_fetch_array($consult2);

          ?>
              <tr>
                <td><?php echo "Ruta #".$row['num_ruta']; ?></td>
                <td><?php echo $row2['nombres']." ".$row2['apellidos']; ?> </td>
                <td><?php echo $row2['telefono']; ?> </td>
                <td><?php echo $row['nombre']." ".$row['apellido'];  ?> </td>


            <?php } ?>
            </table>

            <script>
            $(document).ready(function() {
               $('.tabla').DataTable();
            } );
            </script>


      </div>
    </div>
  </section>
</div>

<?php include 'footer.php'; ?>
