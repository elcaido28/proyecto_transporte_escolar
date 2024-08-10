<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Pago Viajes Extras</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Pago Viajes Extras</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Pago Viajes Extras</button>
      </div>


      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>


      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>

           <th>Fecha</th>
           <th>Institución</th>
           <th>Lugar</th>
           <th>Departamento</th>
           <th>Motivo</th>
           <th>Curso</th>
           <th>Responsable</th>
           <th>Fecha Salida</th>
           <th>Fecha Retorno</th>
           <th>cant. Personas</th>
           <th>Valor</th>
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from pago_externo PE inner join institucion I on I.id_institucion=PE.id_institucion ");
              while($row=mysqli_fetch_array($consulta)){

            ?>

              <td><?php echo $row['fecha']; ?> </td>
              <td><?php echo $row['nombre']; ?> </td>
              <td><?php echo $row['lugar']; ?> </td>
              <td><?php echo $row['departamento']; ?> </td>
              <td><?php echo $row['motivo']; ?> </td>
              <td><?php echo $row['curso']; ?> </td>
              <td><?php echo $row['responsable']; ?> </td>
              <td><?php echo $row['fecha_s']." ".$row['hora_s']; ?> </td>
              <td><?php echo $row['fecha_r']." ".$row['hora_r']; ?> </td>
              <td><?php echo $row['cantidad']; ?> </td>
              <td><?php echo $row['valor']; ?> </td>


              <td><div class="btn-group">
                <a href="editar_pago_externo.php?id=<?php echo $row['id_pago_externo'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                <!-- <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_pago_externo'] ?>"><i class="fa fa-times" id="<?php echo $row['id_pago_externo'] ?>"></i></button></a> -->
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
                                 document.location.href="eliminar_pago_externo.php?id="+id_emp;
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
MODAL AGREGAR RUTA
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" action="guardar_pago_externo.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Pago Viajes Extras</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA  -->

            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Selecionar Institución"><i class="fas fa-university"></i></span>
                  <select class="form-control input-lg" name="institucion" required><option value="">Selecionar Institución</option>
                    <?php $consulta4=mysqli_query($con,"SELECT * from institucion");
                      while($row4=mysqli_fetch_array($consulta4)){
                      echo "<option value='".$row4['id_institucion']."'>"; echo $row4['nombre']; echo "</option>"; } ?> </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Departamento/Nivel"><i class="fas fa-table"></i></span>
                  <input type="text" class="form-control input-lg" name="departamento" id="departamento"  placeholder="Ingresar Departamento/Nivel" required>
                </div>
              </div>

            </div>

            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Motivo/Actividad"><i class="far fa-file-alt"></i></span>
                <input type="text" class="form-control input-lg" name="motivo"  placeholder="Ingresar Motivo/Actividad" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Lugar/Destino"><i class="fas fa-map-marked-alt"></i></span>
                <input type="text" class="form-control input-lg" name="lugar"  placeholder="Ingresar Lugar/Destino" required>
              </div>
            </div>
          </div>

            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Fecha Salida"><i class="fas fa-calendar-alt"></i></span>
                  <input type="date" class="form-control input-lg" name="fecha_salida"  placeholder="Ingresar Fecha Salida" required>
                </div>
               </div>
               <div class="form-group">
                 <div class="input-group">
                   <span class="input-group-addon" title="Ingresar hora Salida"><i class="fas fa-clock"></i></span>
                   <input type="time" class="form-control input-lg" name="hora_salida"  placeholder="Ingresar Hora Salida" required>
                 </div>
               </div>
            </div>

            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Fecha Retorno"><i class="far fa-calendar-alt"></i></span>
                  <input type="date" class="form-control input-lg" name="fecha_retorno"  placeholder="Ingresar Fecha Retorno" required>
                </div>
               </div>
               <div class="form-group">
                 <div class="input-group">
                   <span class="input-group-addon" title="Ingresar hora Retorno"><i class="far fa-clock"></i></span>
                   <input type="time" class="form-control input-lg" name="hora_retorno"  placeholder="Ingresar Hora Retorno" required>
                 </div>
               </div>
            </div>

            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Curso"><i class="fas fa-table"></i></span>
                  <input type="text" class="form-control input-lg" name="curso"  placeholder="Ingresar curso">
                </div>
               </div>
               <div class="form-group">
                 <div class="input-group">
                   <span class="input-group-addon" title="Ingresar Cantidad de Personas"><i class="fas fa-sort-numeric-up"></i></span>
                   <input type="text" class="form-control input-lg" maxlength="3" name="cantidadp"  placeholder="Cantidad de Personas" required onkeypress="return solonumeros(event)">
                 </div>
               </div>
            </div>

            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Valor del Transporte"><i class="fas fa-coins"></i></span>
                  <input type="text" class="form-control input-lg" name="valor" maxlength="6" placeholder="Valor del Transporte" onkeypress="return solonumeros(event)">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Nombre de Responsable"><i class="fas fa-user-tie"></i></span>
                  <input type="text" class="form-control input-lg" name="responsable" id="responsable"  placeholder="Nombre de Responsable" onkeypress="return sololetras(event)">
                </div>
               </div>
            </div>




          </div>
        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Institución</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL FIN
======================================-->
<script type="text/javascript">
$(document).on('keyup','#responsable', function(){
    var valr= $('#responsable').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('responsable').value=texto;
    }
});

$(document).on('keyup','#departamento', function(){
    var valr= $('#departamento').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('departamento').value=texto;
    }
});

$(document).on('keyup','#descrip', function(){
    var valr= $('#descrip').val();
    if(valr!=""){
       var texto = MaysPrimera(valr);
       //var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('descrip').value=texto;
    }
});
</script>

<?php include 'footer.php'; ?>
