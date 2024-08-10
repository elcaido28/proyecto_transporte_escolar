<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Buses</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Buses</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Buses </button>
      </div>


      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>
           <th>Dueño</th>
           <th>Conductor</th>
           <th>Placa</th>
           <th>Marca</th>
           <th>Caduca Matricula</th>
           <th>Capacidad</th>
           <th>Ayudante</th>
           <th>Institución</th>
           <th>Asig. Rutas</th>
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT *,E.nombres nom,E.apellidos ape,EP.nombres nomb,EP.apellidos apelli,A.nombres nombr from buses B inner join empleados E on E.id_empleados=B.conductor inner join empleados EP on EP.id_empleados=B.dueno  inner join institucion I on I.id_institucion=B.id_institucion inner join ayudante A on A.id_ayudante=B.id_ayudante WHERE B.id_estado='1' ");
              while($row=mysqli_fetch_array($consulta)){
                $id_b=$row['id_buses'];
                $consulta2=mysqli_query($con,"SELECT * from revision_vehiculo  WHERE id_buses='$id_b' ");
                $row2=mysqli_fetch_array($consulta2);

            ?>

              <td><?php echo $row['nomb']." ".$row['apelli']; ?> </td>
              <td><?php echo $row['nom']." ".$row['ape']; ?> </td>
              <td><?php echo $row['placa']; ?> </td>
              <td><?php echo $row['marca']; ?> </td>
              <td><?php echo $row['caduca_matricula']; ?> </td>
              <td><?php echo $row['capacidad']; ?> </td>
              <td><?php echo $row['nombr']; ?> </td>
              <td><?php echo $row['nombre']; ?> </td>

              <td><a href="<?php if($row2['id_estado']=='3'){ ?>asignar_rutas.php?id=<?php echo $row['id_buses']; }else{ ?>#<?php } ?>"> <button class="btn btn-success"><i class="far fa-share-square"></i></button></a> </td>
              <td><div class="btn-group">
                <a href="editar_bus.php?id=<?php echo $row['id_buses'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_buses'] ?>"><i class="fa fa-times" id="<?php echo $row['id_buses'] ?>"></i></button></a>
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
                                 document.location.href="eliminar_bus.php?id="+id_emp;
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

      <form role="form" action="guardar_bus.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Bus</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Placa"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="placa" id="placa" placeholder="Ingresar Placa" maxlength="7" required autocomplete="off">
              </div>
            </div>
            <!-- ENTRADA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Marca"><i class="fas fa-award"></i></span>
                <input type="text" class="form-control input-lg" name="marca" id="marca"  placeholder="Ingresar Marca" required>
              </div>
            </div>
          </div>
            <!-- ENTRADA  -->
            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Modelo"><i class="fab fa-buffer"></i></i></span>
                <input type="text" class="form-control input-lg" name="modelo" id="modelo" placeholder="Ingresar Modelo" required>
              </div>
            </div>
            <!-- ENTRADA  -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Año"><i class="fas fa-calendar-alt"></i></span>
                <input type="text" class="form-control input-lg" name="ano" maxlength="4" placeholder="Ingresar Año" required>
              </div>
            </div>
            </div>
            <!-- ENTRADA  -->
            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Chasis"><i class="fas fa-car-crash"></i></span>
                <input type="text" class="form-control input-lg" name="chasis" id="chasis" placeholder="Ingresar Chasis" required>
              </div>
            </div>
             <!-- ENTRADA -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Motor"><i class="fas fa-memory"></i></span>
                <input type="text" class="form-control input-lg" name="motor" id="motor" placeholder="Ingresar Motor" required>
              </div>
            </div>
            </div>
            <!-- ENTRADA  -->
            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Caducidad Matricula"><i class="fas fa-calendar-alt"></i></span>
                <input type="date" class="form-control input-lg" name="caduca_matricula" placeholder="Ingresar Caducidad Matricula" required>
              </div>
            </div>
             <!-- ENTRADA -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Capacidad"><i class="fas fa-sort-numeric-up"></i></span>
                <input type="text" class="form-control input-lg" maxlength="3" name="capacidad" placeholder="Ingresar Capacidad" required>
              </div>
            </div>
            </div>
            <!-- ENTRADA  -->
            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Descripcion"><i class="fas fa-braille"></i></span>
                <input type="mail" class="form-control input-lg" name="descrip" placeholder="Ingresar Descripcion" required>
              </div>
            </div>
             <!-- ENTRADA -->
             <div class="form-group">
               <div class="input-group">
                 <span class="input-group-addon" title="Dueño Del Vehiculo"><i class="fa fa-user-tie"></i></span>
                 <select class="form-control input-lg" name="dueno" required><option value="">Dueño Del Vehiculo</option>
                   <?php $consulta4=mysqli_query($con,"SELECT * from empleados where id_estado='1' and id_tipo_empleado='4' or id_estado='1' and id_tipo_empleado='7'");
                     while($row4=mysqli_fetch_array($consulta4)){
                     echo "<option ".$sel."value='".$row4['id_empleados']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
               </div>
             </div>
            </div>

            <!-- ENTRADA SELECT -->
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Selecionar Conductor"><i class="fa fa-user"></i></span>
                  <select class="form-control input-lg" name="conductor" required><option value="">Selecionar Conductor</option>
                    <?php $consulta4=mysqli_query($con,"SELECT * from empleados where id_estado='1' and id_tipo_empleado='6' or id_estado='1' and id_tipo_empleado='7'");
                      while($row4=mysqli_fetch_array($consulta4)){
                          if($row4['id_empleados']==$row['id_conductor']){$sel="selected='selected'";}else{$sel="";}
                      echo "<option ".$sel." value='".$row4['id_empleados']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
                </div>
              </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Selecionar Ayudante"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="ayudante" required><option value="">Selecionar Ayudante</option>
                  <?php $consulta4=mysqli_query($con,"SELECT * from ayudante where id_estado='1'");
                    while($row4=mysqli_fetch_array($consulta4)){

                    echo "<option value='".$row4['id_ayudante']."'>"; echo $row4['nombres']; echo "</option>"; } ?> </select>
              </div>
            </div>
            </div>
            <!-- ENTRADA SUBIR FOTO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Selecionar Institución"><i class="fas fa-university"></i></span>
                <select class="form-control input-lg" name="institucion" required><option value="">Selecionar Institución</option>
                  <?php $consulta4=mysqli_query($con,"SELECT * from institucion");
                    while($row4=mysqli_fetch_array($consulta4)){
                    echo "<option value='".$row4['id_institucion']."'>"; echo $row4['nombre']; echo "</option>"; } ?> </select>
              </div>
            </div>

          </div>
        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Bus</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL FIN
======================================-->
<script>
    $(document).on('change', '#placa', function(){
  var valorPlaca = this.value;
  var digitos = valorPlaca.length;

  // Aqui esta el patron(expresion regular) a buscar en el input
  patronPlaca = /^([A-Z]{3}\d{3,4})$/;

  if( patronPlaca.test(valorPlaca) )
  {

  }
  else
  {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'warning',
        title: 'Placa no válido'
      })
   document.getElementById('placa').value="";
  }
})
</script>
<script>
    $(document).on('keyup','#placa', function(){
        var valr= $('#placa').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = valr.toUpperCase(); // todo mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('placa').value=texto;
        }
    });

</script>
<?php include 'footer.php'; ?>
