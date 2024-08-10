<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Empleados</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Empleados</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Empleado </button>
      </div>


      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>
           <th>Foto</th>
           <th>Nombres</th>
           <th>Cedula</th>
           <th>Telefono</th>
           <th>Correo</th>
           <th>Dirección</th>
           <th>Documento</th>
           <th>Cargo</th>
           <th>Asig. Usuario</th>
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from empleados E inner join tipo_empleado TE on TE.id_tipo_empleado=E.id_tipo_empleado WHERE E.id_estado='1' and E.id_empleados!='1' ");
              while($row=mysqli_fetch_array($consulta)){
            ?>
              <td> <img src=" <?php echo $row['foto']; ?>" alt="" width="60" height="60"> </td>
              <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
              <td><?php echo $row['cedula']; ?> </td>
              <td><?php echo $row['telefono']; ?> </td>
              <td><?php echo $row['correo']; ?> </td>
              <td><?php echo $row['direccion']; ?> </td>
              <td><?php if($row['documento']!=""){ ?> <a href="<?php echo $row['documento']; ?>" target="_blank"><i class="fas fa-file-download fa-2x"></i></a> <?php } ?>  </td>
              <td><?php echo $row['descrip']; ?> </td>

              <td><a href="asignar_usuario.php?id=<?php echo $row['id_empleados'] ?>"> <button class="btn btn-success"><i class="far fa-share-square"></i></button></a> </td>

              <td><div class="btn-group">
                <a href="editar_empleado.php?id=<?php echo $row['id_empleados'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_empleados'] ?>"><i class="fa fa-times" id="<?php echo $row['id_empleados'] ?>"></i></button></a>
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
                                 document.location.href="eliminar_empleado.php?id="+id_emp;
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

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" action="guardar_empleado.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Empleado</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA  -->
            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Nombres"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nombres" id="nombres" onkeypress="return soloLetras(event)" autocomplete="off" placeholder="Ingresar Nombres" required>
              </div>
            </div>
            <!-- ENTRADA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Apellidos"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="apellidos" id="apellidos" onkeypress="return soloLetras(event)" autocomplete="off" placeholder="Ingresar Apellidos" required>
              </div>
            </div>
          </div>
            <!-- ENTRADA  -->
            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Cedula"><i class="fas fa-address-card"></i></i></span>
                <input type="text" class="form-control input-lg" maxlength="10" name="cedula" id="cedula" onchange="validarCedula(this.value);" onkeypress="return solonumeros(event)" placeholder="Ingresar Cedula" required>
              </div>
            </div>
            <!-- ENTRADA  -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Teléfono"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" name="telefono"  placeholder="Ingresar Teléfono" data-inputmask="'mask':'9999-999-999'" data-mask required>
              </div>
            </div>
            </div>
            <!-- ENTRADA  -->
            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Correo"><i class="fa fa-envelope"></i></span>
                <input type="mail" class="form-control input-lg" name="correo" placeholder="Ingresar Correo" id="correo" onchange="validarcorreo()" required>
              </div>
            </div>
             <!-- ENTRADA -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Dirección"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" name="direccion" id="direccion" placeholder="Ingresar Dirección" required>
              </div>
            </div>
            </div>

            <!-- ENTRADA SELECT -->
            <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Cargo"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="tipo_empleado" id="tipo_empleado"><option value="">Selecionar Cargo</option>
                  <?php $consulta4=mysqli_query($con,"SELECT * from tipo_empleado");
                    while($row4=mysqli_fetch_array($consulta4)){
                    echo "<option value='".$row4['id_tipo_empleado']."'>"; echo $row4['descrip']; echo "</option>"; } ?> </select>
              </div>
            </div>

            <div class="form-group" id="cont_doc1"></div>
            <div class="form-group" id="cont_doc2" style="display:none;">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Documento"><i class="fas fa-file"></i></span>
                <input type="file" class="form-control input-lg" name="docu"  id="docu" title="Documento">
              </div>
            </div>
          </div>
            <!-- ENTRADA SUBIR FOTO -->
             <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="foto" accept="image/jpeg">
              <p class="help-block">Peso máximo de la foto 3MB</p>
              <img src="../vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>
          </div>

        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Empleado</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL FIN
======================================-->

<script>
$(buscar_cedula());
function buscar_cedula(consulta){
  $.ajax({
    url: 'ajax_cedula_empleado.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: consulta},
  })
  .done(function(respuesta){
    if(respuesta==''){

    }else{
    if(respuesta>0){
      $("#cedula").css({
        "background-color": "rgba(255,87,87,0.5)"
      });
      document.getElementById('cedula').value='';
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'warning',
        title: 'Ya existe un Empleado con la misma cédula'
      })
    }else{
      $("#cedula").css({
        "background-color": "rgba(56,208,49,0.5)"
      });
    }
    }
    // document.getElementById('cedula').value=respuesta;
  })
  .fail(function(){
    console.log("error")
  })
}
$(document).on('blur','#cedula', function(){

  var valr= $(this).val();
  if(valr!=""){
    buscar_cedula(valr);
  }
});
</script>



<script>
    function validarcorreo(){
        var correo = document.getElementById('correo');
        //alert(correo);

        var emailRegex = /^[-\w.%+]{1,64}@(?:[a-zA-z]{1,63}\.){1,125}[a-z]{2,63}$/i;
        if (emailRegex.test(correo.value)) {
          //alert("correo correcto");
        } else {
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
        title: 'Correo no válido'
      })
          document.getElementById('correo').value="";
        }
    }
</script>
<script type="text/javascript">
  function validarCedula(){
    var cedula = document.getElementById('cedula').value;
    array = cedula.split( "" );
    var nuevo = cedula;
    //2 4 5 7 9
    num = array.length;
    if ( num < 10) {
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
        title: 'La cédula no puede tener menos de 10 dígitos'
      })
      document.getElementById('cedula').value="";
    }
    if ( num == 10 )
    {
      if(nuevo=="0000000000" || nuevo=="2222222222" || nuevo=="4444444444" || nuevo=="5555555555" || nuevo=="7777777777" || nuevo=="9999999999" || nuevo=="1800000000" || nuevo=="1212121212" || nuevo=="1313131313" || nuevo=="1414141414" || nuevo=="1515151515" || nuevo=="1616161616" || nuevo=="1717171717" || nuevo=="1818181818" || nuevo=="1919191919"){
        // alert( "La c\xe9dula NO es v\xe1lida!!!" );
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
          title: 'La cédula no es válida'
        })
        document.getElementById('cedula').value="";
        $("#cedula").css({
          "background-color": "rgba(0,0,0,0)"
        });
      }
      else
      {
      total = 0;
      digito = (array[9]*1);
      for( i=0; i < (num-1); i++ )
      {
        mult = 0;
        if ( ( i%2 ) != 0 ) {
          total = total + ( array[i] * 1 );
        }
        else
        {
          mult = array[i] * 2;
          if ( mult > 9 )
            total = total + ( mult - 9 );
          else
            total = total + mult;
        }
      }
      decena = total / 10;
      decena = Math.floor( decena );
      decena = ( decena + 1 ) * 10;
      final = ( decena - total );

      if ( ( final == 10 && digito == 0 ) || ( final == digito ) ) {
        $("#cedula").css({
          "background-color": "rgba(56,208,49,0.5)"
        });
        return true;
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
          title: 'La cédula no es válida'
        })
        document.getElementById('cedula').value="";
        nuevo = '';
        $("#cedula").css({
          "background-color": "rgba(0,0,0,0)"
        });
        return false;
      }
      }
    }//fin del primer if
    else
    {
      return false;
    }
  }
</script>
<script>
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
    $(document).on('keyup','#direccion', function(){
        var valr= $('#direccion').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = MaysPrimera(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('direccion').value=texto;
        }
    });


    $(document).on('change','#tipo_empleado', function(){
        var valr= $('#tipo_empleado').val();
        if(valr!="" && valr=="4" || valr!="" && valr=="7"){

            document.getElementById('cont_doc1').style.display="none";
            document.getElementById('cont_doc2').style.display="block";
        }else {
          document.getElementById('cont_doc1').style.display="block";
          document.getElementById('cont_doc2').style.display="none";
        }
    });

</script>
<?php include 'footer.php'; ?>