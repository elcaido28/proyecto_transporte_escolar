<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];
$ano_ruta=$_REQUEST['ano'];
$dt_where=" AND ano='".$ano_ruta."'";

$consulta5=mysqli_query($con,"SELECT * from ruta WHERE id_ruta='$id'");
 $row5=mysqli_fetch_array($consulta5);

 if($row5['tipo']=='Primaria'){
   $where_consul=" C.id_curso <='7'";
 }
 if ($row5['tipo']=='Secundaria') {
     $where_consul=" C.id_curso >'7' and C.id_curso !='14' ";
 }
 if ($row5['tipo']=='Empresa') {
     $where_consul=" C.id_curso='14'";
 }
?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Rutas</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_ruta.php"><i class="fas fa-route"></i> Rutas </a></li>
      <li class="active"> Asig. Personas a Ruta</li>
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
        <a href="ingreso_ruta.php"><button type="button" class="btn btn-default">Salir</button></a>
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>


      <div class="box-body cont_tabla">


        <center><h2>Personas de <?php echo $row5['tipo']; ?> asignadas Ruta: <?php echo "#".$row5['num_ruta']; ?></h2></center>

                <table class="tabla" >
                    <thead>
                      <tr>
                      <th>Foto</th>
                      <th>Cant. Rutas Asig.</th>
                      <th>Nombres</th>
                      <th>Telefono</th>
                      <th>Dirección</th>
<?php if ($row5['tipo']=='Primaria' || $row5['tipo']=='Secundaria') { ?>  <th>Curso</th> <?php } ?>
                      <th>Servicio</th>
                      <th>Extracurricular</th>
                      <th>QUITAR</th>
                      </tr>
                      </thead>
                      <tr>
                        <?php

                        $consulta=mysqli_query($con,"SELECT * from rutas_personas RP inner join personas P on P.id_personas=RP.id_personas inner join servicio SE on SE.id_servicio=P.id_servicio inner join extracurricular EX on EX.id_extracurricular=P.id_extracurricular inner join curso C on C.id_curso=P.id_curso where RP.id_ruta='$id' ");
                         while($row=mysqli_fetch_array($consulta)){
                           $id_per=$row['id_personas'];
                           $consul2=mysqli_query($con,"SELECT * from rutas_personas where id_personas='$id_per' ");
                            $nrow2=mysqli_num_rows($consul2);
                        ?>
                              <td> <img src=" <?php echo $row['foto']; ?>" alt="" width="60" height="60"> </td>
                              <td><?php echo $nrow2; ?> </td>
                              <td><?php echo $row['nombre']." ".$row['apellido']; ?> </td>
                              <td><?php echo $row['telefono']; ?> </td>
                              <td><?php echo $row['direccion']; ?> </td>
<?php if ($row5['tipo']=='Primaria' || $row5['tipo']=='Secundaria') { ?>  <td><?php echo $row['descrip']; ?> </td> <?php } ?>
                              <td><?php echo $row['descrips']; ?> </td>
                              <td><?php echo $row['descrip2']; ?> </td>

                              <td> <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_personas'] ?>"><i class="fa fa-times" id="<?php echo $row['id_personas'] ?>"></i></button></a></td>
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
                                   var anor='<?php echo $ano_ruta; ?>';
                                     document.location.href="eliminar_personas_asignadas.php?id=<?php echo $id; ?>&id_p="+id_emp+"&anor="+anor;
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
              <th>Foto</th>
              <th>Nombres</th>
              <th>Telefono</th>
              <th>Dirección</th>
<?php if ($row5['tipo']=='Primaria' || $row5['tipo']=='Secundaria') { ?>  <th>Curso</th> <?php } ?>
              <th>Servicio</th>
              <th>Extracurricular</th>
              <th>ASIG. PERSONA</th>
              </tr>
              </thead>
              <tr>
                <?php
                $id_profe=$_REQUEST['id'];
                $dato_where="";
                $cont=0;
                $consulta3=mysqli_query($con,"SELECT * from rutas_personas WHERE id_ruta='$id'");
                 while($row3=mysqli_fetch_array($consulta3)){
                   $cont++;
                   if($cont>1){
                     $dato_where.=" AND ";
                   }
                   $dato_where.="P.id_personas!='".$row3['id_personas']."'";
                 }

                 if($cont>0){
                   $wheref=" where ".$dato_where." and ".$where_consul;
                 }else{ $wheref="where ".$where_consul; }
                $consulta=mysqli_query($con,"SELECT * from personas P inner join curso C on C.id_curso=P.id_curso inner join servicio SE on SE.id_servicio=P.id_servicio inner join extracurricular EX on EX.id_extracurricular=P.id_extracurricular ".$wheref."  ORDER BY P.nombre DESC ");

                 while($row=mysqli_fetch_array($consulta)){
                ?>
                <td> <img src=" <?php echo $row['foto']; ?>" alt="" width="60" height="60"> </td>
                <td><?php echo $row['nombre']." ".$row['apellido']; ?> </td>
                <td><?php echo $row['telefono']; ?> </td>
                <td><?php echo $row['direccion']; ?> </td>
<?php if ($row5['tipo']=='Primaria' || $row5['tipo']=='Secundaria') { ?>  <td><?php echo $row['descrip']; ?> </td> <?php } ?>
                <td><?php echo $row['descrips']; ?> </td>
                <td><?php echo $row['descrip2']; ?> </td>

              <?php if ($row5['tipo']=='Empresa') { ?>  <td>   <a href="guardar_asig_personas_ruta.php?id_p=<?php echo $row['id_personas']; ?>&id=<?php echo $id; ?>&idserv=<?php echo '1&anor='.$ano_ruta; ?>"><button type="button" title="Asignar" class="modificar" name="button">
                  <i class="fas fa-check"></i></button></a>  </td><?php } ?>

                <?php if ($row5['tipo']=='Primaria' || $row5['tipo']=='Secundaria') { ?> <td>  <form class="anch_tabl" action="guardar_asig_personas_ruta.php?id_p=<?php echo $row['id_personas']; ?>&id=<?php echo $id.'&anor='.$ano_ruta;; ?>" method="post">
                  <div class="form-group" >
                    <div class="input-group">
                      <span class="input-group-addon" title="Tipo Servicio"><i class="fas fa-location-arrow"></i></span>
                      <select class="form-control input-lg" name="servicio1"  required><option value="" >Tipo Servicio</option>
                        <?php $consulta4=mysqli_query($con,"SELECT * from servicio where id_servicio!='4'");
                          while($row4=mysqli_fetch_array($consulta4)){
                            echo "<option value='".$row4['id_servicio']."'>"; echo $row4['descrips']; echo "</option>"; } ?>  </select>
                    </div>
                  </div>
                  <button type="submit" title="Asignar" class="modificar" name="button"><i class="fas fa-check"></i></button>
                </form> </td><?php } ?>

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
