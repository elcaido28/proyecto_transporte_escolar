<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];
$anoact=date('Y');
$consulta5=mysqli_query($con,"SELECT * from buses B inner join institucion I on I.id_institucion=B.id_institucion WHERE B.id_buses='$id'");
 $row5=mysqli_fetch_array($consulta5);
if($row5['id_ayudante']!='1'){
  $where_consul=" tipo='Primaria'";
}else{
  if ($row5['descrip']=='Empresa') {
    $where_consul=" tipo='Empresa'";
  }else{
    $where_consul=" tipo='Secundaria'";
  }
}
?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Buses</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_bus.php"><i class="fa fa-bus"></i> Buses </a></li>
      <li class="active"> Asig. Rutas a Bus</li>
    </ol>
  </section>
<style media="screen">
div.dataTables_wrapper {
      margin-bottom: 3em;
  }
</style>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <a href="ingreso_bus.php"><button type="button" class="btn btn-default">Salir</button></a>
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>


      <div class="box-body cont_tabla">


        <center><h2>Rutas asignadas a Placa: <?php echo $row5['placa']; ?></h2></center>

                <table class="tabla" >
                    <thead>
                      <tr>
                      <th>Rutas</th>
                      <th>Descrioción</th>
                      <th>QUITAR</th>
                      </tr>
                      </thead>
                      <tr>
                        <?php

                        $consulta=mysqli_query($con,"SELECT * from rutas_bus RB inner join ruta R on R.id_ruta=RB.id_rutas where RB.id_bus='$id' and ano='$anoact' ");
                         while($row=mysqli_fetch_array($consulta)){
                        ?>

                              <td><?php echo "Ruta #".$row['num_ruta']; ?> </td>
                              <td><?php echo $row['descripcion'] ?> </td>

                              <td> <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_ruta'] ?>"><i class="fa fa-times" id="<?php echo $row['id_ruta'] ?>"></i></button></a></td>
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
                                     document.location.href="eliminar_rutas_asignadas.php?id=<?php echo $id; ?>&id_r="+id_emp;
                                 } else if (
                                   /* Read more about handling dismissals below */
                                   result.dismiss === Swal.DismissReason.cancel
                                 ) {

                                 }
                               })
                     })
                       </script>


                        <?php
                              }
                        ?>
                </table>

               <script charset="utf-8">
               $(document).ready(function() {
            $('table.tabla').DataTable();
        } );

               </script>







        <center><h2>Todas las Rutas</h2></center>
        <table class="tabla" >
            <thead>
              <tr>
              <th>Rutas</th>
              <th>Descripción</th>
              <th>ASIG. Ruta</th>
              </tr>
              </thead>
              <tr>
                <?php
                $id_profe=$_REQUEST['id'];
                $dato_where="";
                $cont=0;
                $consulta3=mysqli_query($con,"SELECT * from rutas_bus WHERE id_bus='$id'");
                 while($row3=mysqli_fetch_array($consulta3)){
                   $cont++;
                   if($cont>1){
                     $dato_where.=" AND ";
                   }
                   $dato_where.="id_ruta!='".$row3['id_rutas']."'";
                 }

                 if($cont>0){
                   $wheref=" where ".$dato_where." AND ".$where_consul;
                 }else{ $wheref=" where ".$where_consul; }
                $consulta=mysqli_query($con,"SELECT * from ruta ".$wheref." and ".$anoact."  ORDER BY num_ruta DESC ");

                 while($row=mysqli_fetch_array($consulta)){
                ?>
                <td><?php echo "Ruta #".$row['num_ruta'] ?> </td>
                <td><?php echo $row['descripcion'] ?> </td>
                <td> <a href="guardar_asig_ruta_bus.php?id_r=<?php echo $row['id_ruta']; ?>&id=<?php echo $id; ?>"><button type="button" title="Asignar" class="modificar" name="button"><i class="fas fa-check"></i></button></a> </td>

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
