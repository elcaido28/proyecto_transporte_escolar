<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Pagos De Deudas Sociales</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Pagos De Deudas Sociales</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Pago</button>
      </div>


      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>


      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>

           <th>Nombres Socio</th>
           <th>Fecha</th>
           <th>Motivo</th>
           <th>Mes</th>
           <th>Deuda</th>
           <th>Pago</th>
           <th>Total Deuda</th>
           <th>Descripción</th>
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from pago_socios P inner join deuda_socios D on D.id_deuda_socios=P.id_deuda_socios inner join empleados E on E.id_empleados=D.id_empleados ");
              while($row=mysqli_fetch_array($consulta)){
                $mesl=$row['mes'];
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            ?>

              <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
              <td><?php echo $row['fecha']; ?> </td>
              <td><?php echo $row['tipo_pago']; ?> </td>
              <td><?php echo $meses[$mesl-1]; ?> </td>
              <td><?php echo $row['deuda']; ?> </td>
              <td><?php echo $row['pago']; ?> </td>
              <td><?php echo $row['saldo']; ?> </td>
              <td><?php echo $row['descripcion']; ?> </td>

              <td><div class="btn-group">
                <a href="editar_pagos_socios.php?id=<?php echo $row['id_pago_socios'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                <!-- <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_pago_socios'] ?>"><i class="fa fa-times" id="<?php echo $row['id_pago_socios'] ?>"></i></button></a> -->
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
                                 document.location.href="eliminar_pagos_socios.php?id="+id_emp;
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

      <form role="form" action="guardar_pagos_socios.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Pago De Deuda Social</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Socios"><i class="fa fa-user-tie"></i></span>
                <select class="form-control input-lg" name="socio" required><option value="">Socios</option>
                  <?php $consulta4=mysqli_query($con,"SELECT * from empleados where id_estado='1' and id_tipo_empleado='4' or id_estado='1' and id_tipo_empleado='7'");
                    while($row4=mysqli_fetch_array($consulta4)){
                    echo "<option ".$sel."value='".$row4['id_empleados']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
              </div>
            </div>

            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Motivo de Deuda"><i class="far fa-list-alt"></i></span>
                  <select class="form-control input-lg" name="motivo" required><option value="">Motivo de Deuda</option>
                    <option>Cuota Social</option>
                    <option>Multa</option>
                    <option>Otros</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Mes"><i class="fas fa-calendar-alt"></i></span>
                  <select class="form-control input-lg" name="mes" required><option value="">Mes</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                  </select>

                </div>
              </div>

            </div>
            <div class="conten_cajas">

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Valor"><i class="fas fa-coins"></i></span>
                  <input type="text" class="form-control input-lg" name="valor"  placeholder="Ingresar Valor" maxlength="6" onkeypress="return solonumeros(event)" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Descripción"><i class="far fa-file-alt"></i></span>
                  <input type="text" class="form-control input-lg" name="descrip"  placeholder="Ingresar Descripción">
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
$(document).on('keyup','#nombre', function(){
    var valr= $('#nombre').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('nombre').value=texto;
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
