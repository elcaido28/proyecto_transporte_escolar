<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];
$consulta="SELECT * FROM clientes   WHERE id_clientes='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
$tiperso=$row['id_tipo_cliente'];
?>
<div class="content-wrapper">
<style media="screen">
  .stnone{
    display: none;
  }
</style>
  <section class="content-header">
    <h1>Administrar Personas</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_clientes.php"><i class="fas fa-user-tie"></i> Clientes</a></li>
      <li class="active">Personas</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button>
        <a href="ingreso_clientes.php"><button type="button" class="btn btn-default">Salir</button></a>
      </div>
      <div class="box-body cont_tabla">

       <?php if($tiperso=='1'){ ?>
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
             <th>Acciones</th>
           </tr>
          </thead>
          <tbody>
            <tr>
              <?php
                $consulta=mysqli_query($con,"SELECT * from personas P inner join curso C on C.id_curso=P.id_curso inner join extracurricular EX on EX.id_extracurricular=P.id_extracurricular  inner join servicio S on S.id_servicio=P.id_servicio WHERE P.id_clientes='$id' and P.id_estado='1' ");
                while($row=mysqli_fetch_array($consulta)){
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
                  <a href="editar_persona.php?id=<?php echo $row['id_personas'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                  <a href="#" class="eliminar" data-idc="<?php echo $row['id_clientes'] ?>"><button class="btn btn-danger" id="<?php echo $row['id_personas'] ?>"><i class="fa fa-times" id="<?php echo $row['id_personas'] ?>"></i></button></a>
                </div></td>
                </tr>

                <script type="text/javascript">
                       $('.eliminar').click(function(e){
                         var id_emp= e.target.id;
                         var id_cli=this.dataset.idc;
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
                                   document.location.href="eliminar_personas.php?id="+id_emp+"&idc="+id_cli;
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
       <?php } if($tiperso=='2'){  ?>
         <table class="tabla" id="tabla" >

          <thead>
           <tr>
             <th>Foto</th>
             <th>Nombres</th>
             <th>Apellido</th>
             <th>Telefono</th>
             <th>Dirección</th>
             <th>Acciones</th>
           </tr>
          </thead>
          <tbody>
            <tr>
              <?php
                $consulta=mysqli_query($con,"SELECT * from personas P inner join curso C on C.id_curso=P.id_curso inner join servicio S on S.id_servicio=P.id_servicio WHERE P.id_clientes='$id' and P.id_estado='1' ");
                while($row=mysqli_fetch_array($consulta)){
              ?>
                <td> <img src=" <?php echo $row['foto']; ?>" alt="" width="60" height="60"> </td>
                <td><?php echo $row['nombre']; ?> </td>
                <td><?php echo $row['apellido']; ?> </td>
                <td><?php echo $row['telefono']; ?> </td>
                <td><?php echo $row['direccion']; ?> </td>

                <td><div class="btn-group">
                  <a href="editar_persona.php?id=<?php echo $row['id_personas'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                  <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_personas'] ?>"><i class="fa fa-times" id="<?php echo $row['id_personas'] ?>"></i></button></a>
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
                                   document.location.href="eliminar_personas.php?id="+id_emp;
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
       <?php } ?>
      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" action="guardar_persona.php?id=<?php echo $id."&tp=".$tiperso; ?>" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Persona</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA  -->
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Nombres"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nombres" id="nombres" autocomplete="off" onkeypress="return soloLetras(event)" placeholder="Ingresar Nombres" required>
                </div>
              </div>
            <!-- ENTRADA -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Apellidos"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="apellidos" id="apellidos" autocomplete="off" onkeypress="return soloLetras(event)" placeholder="Ingresar Apellidos" required>
              </div>
            </div>
          </div>
            <!-- ENTRADA  -->

            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Teléfono"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="telefono"  placeholder="Ingresar Teléfono" data-inputmask="'mask':'0999-999-999'" data-mask >
                </div>
              </div>
              <!-- ENTRADA  -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Direciión"><i class="fa fa-map-marker"></i></span>
                  <input type="text" class="form-control input-lg" name="direccion" id="direccion" autocomplete="off" placeholder="Ingresar Dirección" required>
                </div>
              </div>

            </div>  <!-- ENTRADA -->
            <?php  if($tiperso=='1'){ ?>
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Curso"><i class="fas fa-table"></i></span>
                  <select class="form-control input-lg" name="curso" required><option value="" >Curso</option>
                    <?php $consulta4=mysqli_query($con,"SELECT * from curso where id_curso!='14'");
                      while($row4=mysqli_fetch_array($consulta4)){
                      echo "<option value='".$row4['id_curso']."'>"; echo $row4['descrip']; echo "</option>"; } ?> </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Paralelo"><i class="fas fa-stream"></i></span>
                  <select class="form-control input-lg" name="paralelo" required><option value="" >Paralelo</option>
                    <option>A</option> <option>B</option> <option>C</option> <option>D</option>
                    <option>E</option> <option>F</option> <option>G</option> <option>---</option>
                    </select>
                </div>
              </div>

          </div>
          <!-- ENTRADA  -->
          <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Servicio 10 meses"><i class="fas fa-calendar-alt"></i></span>
                <select class="form-control input-lg" name="tiempos" id="ti_ser" required><option value="" >Servicio 10 meses</option>
                  <option>Si</option> <option>No</option>
                  </select>
              </div>
            </div>
            <div class="form-group" id="tipo_ser1">
              <div class="input-group">
                <span class="input-group-addon" title="Tipo Servicio"><i class="fas fa-location-arrow"></i></span>
                <select class="form-control input-lg" name="servicio1" id="tipo_ser1s" required><option value="" >Tipo Servicio</option>
                  <?php $consulta4=mysqli_query($con,"SELECT * from servicio where id_servicio!='4'");
                    while($row4=mysqli_fetch_array($consulta4)){
                      echo "<option value='".$row4['id_servicio']."'>"; echo $row4['descrips']; echo "</option>"; } ?>  </select>
              </div>
            </div>
            <div class="form-group stnone" id="otro" >
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Otro Tiempo del Servicio"><i class="fas fa-calendar-alt"></i></span>
                <input type="text" class="form-control input-lg" name="otro_tiempo"  id="otrot" placeholder="Otro Tiempo del Servicio" >
              </div>
            </div>

          </div>
          <div class="conten_cajas">

            <div class="form-group stnone" id="tipo_ser2">
              <div class="input-group">
                <span class="input-group-addon" title="Tipo Servicio"><i class="fas fa-location-arrow"></i></span>
                <select class="form-control input-lg" name="servicio2" id="tipo_ser2s"><option value="" >Tipo Servicio</option>
                  <?php $consulta4=mysqli_query($con,"SELECT * from servicio where id_servicio!='4'");
                    while($row4=mysqli_fetch_array($consulta4)){
                      echo "<option value='".$row4['id_servicio']."'>"; echo $row4['descrips']; echo "</option>"; } ?>  </select>
              </div>
            </div>
              <div class="form-group" >
                <div class="input-group">
                  <span class="input-group-addon" title="Extracurricular"><i class="fas fa-location-arrow"></i></span>
                  <select class="form-control input-lg" name="extracurricular" id="tipo_ser1s" required><option value="" >Extracurricular</option>
                    <?php $consulta4=mysqli_query($con,"SELECT * from extracurricular ");
                      while($row4=mysqli_fetch_array($consulta4)){
                        echo "<option value='".$row4['id_extracurricular']."'>"; echo $row4['descrip2']; echo "</option>"; } ?>  </select>
                </div>
              </div>
              <div class="form-group"> </div>

          </div>


            <!-- ENTRADA SUBIR FOTO -->
             <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="foto" accept="image/jpeg">
              <p class="help-block">Peso máximo de la foto 3MB</p>
              <img src="../vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>
          <?php } ?>
          </div>

        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Persona</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL FIN
======================================-->
<script>

    $(document).on('keyup','#nombresc', function(){
        var valr= $('#nombresc').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('nombres').value=texto;
        }
    });
    $(document).on('keyup','#nombres', function(){
        var valr= $('#nombres').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('nombres').value=texto;
        }
    });
    $(document).on('keyup','#apellidos', function(){
        var valr= $('#apellidos').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('apellidos').value=texto;
        }
    });

    $(document).on('keyup','#otrot', function(){
        var valr= $('#otrot').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('otrot').value=texto;
        }
    });
    $(document).on('keyup','#direccion', function(){
        var valr= $('#direccion').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = MaysPrimera(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('direccion').value=texto;
        }
    });

    $(document).on('change','#ti_ser', function(){
        var valr= $('#ti_ser').val();
        if(valr=="Si" || valr==""){
          $('#tipo_ser2').css("display", "none");
          $('#otro').css("display", "none");
          $('#tipo_ser1').css("display", "block");
          document.getElementById('tipo_ser2s').removeAttribute('required');
          document.getElementById('otrot').removeAttribute('required');
          document.getElementById('tipo_ser1s').setAttribute('required', '');
        }else{
          $('#tipo_ser2').css("display", "block");
          $('#tipo_ser1').css("display", "none");
          $('#otro').css("display", "block");
          document.getElementById('tipo_ser2s').setAttribute('required', '');
          document.getElementById('tipo_ser1s').removeAttribute('required');
          document.getElementById('otrot').setAttribute('required', '');
        }
    });

</script>
<?php include 'footer.php'; ?>
