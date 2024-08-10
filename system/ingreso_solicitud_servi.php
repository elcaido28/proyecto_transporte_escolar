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
        <a href="ingreso_estudiantes.php"><button type="button" class="btn btn-default">Salir</button></a>
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Estudiante</button> -->
        <!-- <a href="ingreso_clientes.php"><button type="button" class="btn btn-default">Salir</button></a> -->
      </div>
      <div class="box-body cont_tabla">
         <table class="tabla" id="tabla" >

          <thead>
           <tr>
             <th>Foto</th>
             <th>Nombres</th>
             <th>Apellido</th>
             <th>Telefono</th>
             <th>Dirección</th>
             <th>Curso</th>
             <th>Paralelo</th>
             <th>Tiempo</th>
             <th>Servicio</th>
             <th>Extracurricular</th>
             <th>Solicitar Servicio</th>
           </tr>
          </thead>
          <tbody>
            <tr>
              <?php
                $consulta=mysqli_query($con,"SELECT * from personas P inner join curso C on C.id_curso=P.id_curso inner join extracurricular EX on EX.id_extracurricular=P.id_extracurricular  inner join servicio S on S.id_servicio=P.id_servicio WHERE P.id_clientes='$id' and P.id_estado='2' ");
                while($row=mysqli_fetch_array($consulta)){
                  $idper=$row['id_personas'];
                  $consul=mysqli_query($con,"SELECT * from solicitud_servicio WHERE id_personas='$idper' ");
                  $nrow2=mysqli_num_rows($consul);
                  if ($nrow2<1){

              ?>
                <td> <img src=" <?php echo $row['foto']; ?>" alt="" width="60" height="60"> </td>
                <td><?php echo $row['nombre']; ?> </td>
                <td><?php echo $row['apellido']; ?> </td>
                <td><?php echo $row['telefono']; ?> </td>
                <td><?php echo $row['direccion']; ?> </td>
                <td><?php echo $row['descrip']; ?> </td>
                <td><?php echo $row['paralelo']; ?> </td>
                <td><?php echo $row['tiempo_servicio']." - ".$row['otro_tiempo']; ?> </td>
                <td><?php echo $row['descrips']; ?> </td>
                <td><?php echo $row['descrip2']; ?> </td>

                <td><div class="btn-group">
                  <a href="guardar_solicitar_servi.php?id=<?php echo $row['id_personas'] ?>" title="Solicitar Servicio"> <button class="btn btn-primary"><i class="fas fa-paper-plane"></i></button></a>
                </div></td>
                </tr>

              <?php } } ?>
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
<?php if (isset($_SESSION['msj'])) { if ($_SESSION['msj']=='1') { ?>
<script type="text/javascript">
    Swal.fire(
      'Solicitud enviada!',
      'Su solicitud sera procesada en las proximas 24 horas!',
      'success'
    )
</script>
<?php $_SESSION['msj']='0'; } } ?>
<?php include 'footer.php'; ?>
