<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Revision De Buses</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active"> Revision De Buses</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Revision De Buses </button>
      </div>


      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>

           <th>Placa</th>
           <th>Matricula</th>
           <th>Licencia Pro.</th>
           <th>Cinturones</th>
           <th>Plumas</th>
           <th>Aire Acondicionado</th>
           <th>Luces</th>
           <th>Neumaticos</th>
           <th>llanta Emer.</th>
           <th>Conductor</th>
           <th>Operadora</th>
           <th>Estado</th>
           <!-- <th>Aprobar/Reprobar</th> -->
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT *,V.id_estado estad from revision_vehiculo V inner join estado ET on ET.id_estado=V.id_estado inner join buses B on B.id_buses=V.id_buses inner join empleados E on E.id_empleados=B.conductor WHERE B.id_estado='1' ");
              while($row=mysqli_fetch_array($consulta)){
            ?>
              <td><?php echo $row['placa'] ?> </td>
              <td><?php echo $row['matricula']; ?> </td>
              <td><?php echo $row['licencia']; ?> </td>
              <td><?php echo $row['cinturones']; ?> </td>
              <td><?php echo $row['plumas']; ?> </td>
              <td><?php echo $row['funcionamiento']; ?> </td>
              <td><?php echo $row['luces']; ?> </td>
              <td><?php echo $row['neumaticos']; ?> </td>
              <td><?php echo $row['llanta_emer']; ?> </td>
              <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
              <td><?php echo $row['operadora']; ?> </td>
              <td <?php if ($row['estad']=='3') { echo "style='background:rgb(140, 191, 128);'"; }else{ echo "style='background:rgb(214, 107, 107);'"; } ?> ><?php echo $row['descrip']; ?> </td>

              <!-- <td><a href="modifi_estado_revision.php?id=<?php echo $row['id_revision_vehiculo']."&est=".$row['estad'] ?>"> <button class="btn btn-success"><i class="fas fa-toggle-on"></i></button></a> </td> -->

              <td><div class="btn-group">
                <a href="editar_revision_bus.php?id=<?php echo $row['id_revision_vehiculo'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_revision_vehiculo'] ?>"><i class="fa fa-times" id="<?php echo $row['id_revision_vehiculo'] ?>"></i></button></a>
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
                                 document.location.href="eliminar_revision_bus.php?id="+id_emp;
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
MODAL AGREGAR USUARIO
======================================-->
<style media="screen">
  .amoldarcheck{
    height: 50px;
    margin-bottom: 0px;
    background: #fff;
    border:1px solid #d2d6de;
    padding-top:5px;
  }
</style>

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" action="guardar_revision_bus.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Revisión De Bus</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA  -->
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Placa"><i class="fas fa-calendar-week"></i></span>
                  <select class="form-control input-lg" name="placa" required><option value="">Selecionar Placa</option>
                    <?php $consulta4=mysqli_query($con,"SELECT * from buses where id_estado='1'");
                      while($row4=mysqli_fetch_array($consulta4)){
                      echo "<option value='".$row4['id_buses']."'>"; echo $row4['placa']; echo "</option>"; } ?> </select>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Matricula Actualizada"><i class="fas fa-id-card"></i></span>
                <input type="checkbox" name="matricula" id="matricula" class="checked" value="Si">
                <label class="labelt amoldarcheck" for="matricula" >Matricula Actualizada </label>
              </div>
              </div>
            </div>

            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon" title="Botiquín"><i class="fas fa-medkit"></i></span>
                <input type="checkbox" name="botiquin" id="botiquin" class="checked" value="Si">
                <label class="labelt amoldarcheck" for="botiquin" >Botiquín (7 objetos) </label>
              </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon" title="A/C En Funcionamiento"><i class="fas fa-fan"></i></span>
                <input type="checkbox" name="funcionamiento" id="funcionamiento" class="checked" value="Si" >
                <label class="labelt amoldarcheck" for="funcionamiento" >A/C En Funcionamiento </label>
              </div>
              </div>
          </div>

          <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
              <span class="input-group-addon" title="Luces (Exterior e interior)"><i class="fas fa-lightbulb"></i></span>
              <input type="checkbox" name="luces" id="luces" class="checked" value="Si" >
              <label class="labelt amoldarcheck" for="luces" >Luces (Exterior e interior)</label>
            </div>
            </div>
            <div class="form-group">
              <div class="input-group">
              <span class="input-group-addon" title="Extintor (10 lbs)"><i class="fas fa-fire-extinguisher"></i></span>
              <input type="checkbox" name="extintor" id="extintor" class="checked" value="Si" >
              <label class="labelt amoldarcheck" for="extintor" >Extintor (10 lbs)</label>
            </div>
            </div>

        </div>
        <div class="conten_cajas">
          <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" title="Plumas (limpiador parabrisa)"><i class="fas fa-rainbow"></i></span>
            <input type="checkbox" name="plumas" id="plumas" class="checked" value="Si">
            <label class="labelt amoldarcheck" for="plumas" >Plumas (limpiador parabrisa)</label>
          </div>
          </div>
          <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" title="Gata Hidráulica"><i class="fas fa-tools"></i></span>
            <input type="checkbox" name="gata" id="gata" class="checked" value="Si">
            <label class="labelt amoldarcheck" for="gata" >Gata Hidráulica</label>
          </div>
          </div>

      </div>
      <div class="conten_cajas">
        <div class="form-group">
          <div class="input-group">
          <span class="input-group-addon"><i class="fas fa-tools"></i></span>
          <input type="checkbox" name="llaves" id="llaves" class="checked" value="Si">
          <label class="labelt amoldarcheck" for="llaves" >Llave De Ruedas</label>
        </div>
        </div>
        <div class="form-group">
          <div class="input-group">
          <span class="input-group-addon" title="Triángulos"><i class="fas fa-tools"></i></span>
          <input type="checkbox" name="triangulos" id="triangulos" class="checked" value="Si">
          <label class="labelt amoldarcheck" for="triangulos" >Triángulos</label>
        </div>
        </div>

    </div>
    <div class="conten_cajas">
      <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon" title="Neumáticos Buen Estado"><i class="far fa-circle"></i></span>
        <input type="checkbox" name="neumaticos" id="neumaticos" class="checked" value="Si">
        <label class="labelt amoldarcheck" for="neumaticos" >Neumáticos Buen Estado</label>
      </div>
      </div>
      <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon" title="Llantas De Emergencia"><i class="far fa-circle"></i></span>
        <input type="checkbox" name="llantas" id="llantas" class="checked" value="Si">
        <label class="labelt amoldarcheck" for="llantas" >Llantas De Emergencia</label>
      </div>
      </div>

  </div>
  <div class="conten_cajas">
    <div class="form-group">
      <div class="input-group">
      <span class="input-group-addon" title="Cinturones De Seguridad"><i class="fas fa-shield-alt"></i></span>
      <input type="checkbox" name="cinturones" id="cinturones" class="checked" value="Si">
      <label class="labelt amoldarcheck" for="cinturones" >Cinturones De Seguridad</label>
    </div>
    </div>
    <div class="form-group">
      <div class="input-group">
      <span class="input-group-addon" title="Licencia Profesional"><i class="fas fa-id-card-alt"></i></span>
      <input type="checkbox" name="licencia" id="licencia" class="checked" value="Si">
      <label class="labelt amoldarcheck" for="licencia" >Licencia Profesional</label>
    </div>
    </div>

</div>

  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon" title="Operadora Que Pertenece"><i class="fa fa-user-tie"></i></span>
      <input type="text" class="form-control input-lg" name="operadora" autocomplete="off" placeholder="Operadora Que Pertenece" required>
    </div>
  </div>

</div>
</div>

      <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Revisión</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL FIN
======================================-->


<?php include 'footer.php'; ?>
