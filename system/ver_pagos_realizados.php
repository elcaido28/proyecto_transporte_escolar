<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_SESSION['ID_usu'];
$consulta2=mysqli_query($con,"SELECT * from deuda_cliente where id_clientes='$id'  ");
$row2=mysqli_fetch_array($consulta2);
?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Detalle de cuenta</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Detalle de cuenta</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h2>deuda total: <b> <?php echo "   $".$row2['deuda_totalc']; ?></b></h2><!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Cargo </button> -->
      </div>



      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>

           <th>Fecha</th>
           <th>Motivo</th>
           <th>Mes</th>
           <th>Valor</th>
         </tr>
        </thead>
        <tbody>

            <?php
            $consulta=mysqli_query($con,"SELECT * from detalle_deuda_cliente DD inner join deuda_cliente D on D.id_deuda_cliente=DD.id_deuda_cliente  where D.id_clientes='$id'  ");
            while($row=mysqli_fetch_array($consulta)){
            $mesl=$row['mes'];
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            $salida="<tr><td> ".$row['fecha']." </td><td> ".$row['razon']." </td><td> ".$meses[$mesl-1]." </td><td>$  ".$row['valor']." </td></tr>";
            echo $salida;
            }
            ?>
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
