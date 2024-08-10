<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
?>
<style media="screen">
td.details-control {
  background-image: url('img/details_open.png');
  background-repeat: no-repeat;
  background-position: center;
  cursor: pointer;
}
tr.shown td.details-control {
  background-image: url('img/details_close.png');
  background-repeat: no-repeat;
  background-position: center;
}
</style>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Clientes</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Clientes</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nuevo Cliente </button>
        <button type="button" class="btn btn-danger" id="elim_td_estudia" >Terminar Año Lectivo</button>
      </div>
      <script type="text/javascript">
             $('#elim_td_estudia').click(function(){
                   const swalWithBootstrapButtons = Swal.mixin({
                     customClass: {
                       confirmButton: 'btn btn-success',
                       cancelButton: 'btn btn-danger'
                     },
                     buttonsStyling: false
                   })
                   swalWithBootstrapButtons.fire({
                     title: 'Esta Seguro De Terminar Año Lectivo?',
                     text: "Se Eliminar todos los estudiantes de todos los clientes. No podrás revertir esto!!!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonText: 'Si, Desactivar!',
                     cancelButtonText: 'No, cancelar!',
                     reverseButtons: true
                   }).then((result) => {
                     if (result.value) {
                         document.location.href="eliminar_todos_estudiantes.php";
                     } else if (
                       /* Read more about handling dismissals below */
                       result.dismiss === Swal.DismissReason.cancel
                     ) {

                     }
                   })
         })
           </script>




      <div class="box-body cont_tabla">
        <table id="tabla" class="display" style="width:100%">
          <thead>
           <tr>
             <th>Ver Más</th>
             <th>Nombre</th>
             <th>Apellido</th>
             <th>Identidicacion</th>
             <th>Telefono</th>
             <th>Correo</th>
             <th>Dirección</th>
             <th>Asig. Personas</th>
             <th>Acciones</th>
           </tr>
          </thead>
          <?php
            $consulta=mysqli_query($con,"SELECT *,DF.nombres nombresf,DF.cedula cedulaf,DF.direccion direccionf,DF.descrip descripf from clientes C inner join datos_factura_cliente DF on DF.id_clientes=C.id_clientes WHERE C.id_estado='1' ");
            while($row=mysqli_fetch_array($consulta)){
          ?>
              <tr>
                <td class="details-control" data-nombre="<?php echo $row['nombresf']; ?>" data-cedula="<?php echo $row['cedulaf']; ?>" data-direccion="<?php echo $row['direccionf']; ?>" data-descrip="<?php echo $row['descripf']; ?>" ></td>
                <td><?php echo $row['nombre_comercial']; ?></td>
                <td><?php echo $row['apellidos']; ?> </td>
                <td><?php echo $row['identificacion']; ?> </td>
                <td><?php echo $row['telefono']; ?> </td>
                <td><?php echo $row['correo']; ?> </td>
                <td><?php echo $row['direccion']; ?> </td>

                <td><a href="asignar_personas.php?id=<?php echo $row['id_clientes'] ?>"> <button class="btn btn-success"><i class="far fa-share-square"></i></button></a> </td>

                <td><div class="btn-group">
                  <a href="editar_clientes.php?id=<?php echo $row['id_clientes'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                  <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_clientes'] ?>"><i class="fa fa-times" id="<?php echo $row['id_clientes'] ?>"></i></button></a>
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
                                 document.location.href="eliminar_clientes.php?id="+id_emp;
                             } else if (
                               /* Read more about handling dismissals below */
                               result.dismiss === Swal.DismissReason.cancel
                             ) {

                             }
                           })
                 })
                   </script>

            <?php } ?>
            </table>

          <script>

        function format (d1,d2,d3,d4) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">'+

                '<tr>'+
                    '<td colspan="9" align="center">DATOS DE FACTURACIÓN:</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>NOMBRES: </td>'+
                    '<td>'+d1+'</td>'+
                    '<td>IDENTIFICACIÓN: </td>'+
                    '<td>'+d2+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>DIRECCIÓN: </td>'+
                    '<td>'+d3+'</td>'+
                    '<td>DESCRIPCION: </td>'+
                    '<td>'+d4+'</td>'+
                '</tr>'+
            '</table>';
        }

        $(document).ready(function() {
            var table = $('#tabla').DataTable( { } );

            // Add event listener for opening and closing details
            $('#tabla tbody').on('click', 'td.details-control', function (e) {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var n= this.dataset.nombre;
                var c= this.dataset.cedula;
                var d= this.dataset.direccion;
                var ds= this.dataset.descrip;

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();    //row.child().css({"background": "blue"});
                    tr.removeClass('shown');
                }else {
                    // Open this row
                    row.child(format(n,c,d,ds)).show();
                    tr.addClass('shown');
                }
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

      <form role="form" action="guardar_clientes.php" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Cliente</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA  -->
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Tipo Cliente"><i class="fas fa-user-tag"></i></span>
                  <select class="form-control input-lg" id="tipo_cliente" onchange="tipo_cli(this.value);" name="tipo_cliente" required><option value="" >Tipo Cliente</option>
                    <?php $consulta4=mysqli_query($con,"SELECT * from tipo_cliente");
                      while($row4=mysqli_fetch_array($consulta4)){
                      echo "<option value='".$row4['id_tipo_cliente']."'>"; echo $row4['descrip']; echo "</option>"; } ?> </select>
                </div>
              </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Nombre Comercial"><i class="far fa-building"></i></span>
                <input type="text" class="form-control input-lg" name="nombresc" autocomplete="off" id="nombresc" placeholder="Nombre Comercial" readonly required>
              </div>
            </div>
          </div>
            <!-- ENTRADA  -->
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Nombres"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nombres"  autocomplete="off" id="nombres" onkeypress="return soloLetras(event)" placeholder="Ingresar Nombres" required >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Apellidos"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="apellidos" autocomplete="off" id="apellidos" onkeypress="return soloLetras(event)" placeholder="Ingresar Apellidos" required>
                </div>
              </div>
            </div>
              <!-- ENTRADA  -->
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Ingresar Identidicación"><i class="fas fa-address-card"></i></span>
                  <input type="text" class="form-control input-lg" maxlength="10" autocomplete="off" name="cedula" id="cedula" onchange="validarCedula(this.value);" onkeypress="return solonumeros(event)" placeholder="Ingresar Identificación" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Telefono Convencional"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="telefono"  placeholder="Ingresar convencional 1" data-inputmask="'mask':'9-999-999'" data-mask >
                </div>
              </div>
            </div>

              <!-- ENTRADA  -->
            <div class="conten_cajas">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Telefono Convencional 2"><i class="fa fa-phone"></i></span>
                  <input type="mail" class="form-control input-lg" name="telefono2" placeholder="Ingresar convencional 2" data-inputmask="'mask':'9-999-999'" data-mask>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" title="Telefono Celular "><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" name="telefono3"  placeholder="Ingresar Celular" data-inputmask="'mask':'0999-999-999'" data-mask required>
                </div>
              </div>
            </div>


            <!-- ENTRADA -->
          <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Correo"><i class="fa fa-envelope"></i></span>
                <input type="mail" class="form-control input-lg" name="correo" id="correo" onchange="validarcorreo()" placeholder="Ingresar Correo" required>
              </div>
            </div>
           <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon" title="Ingresar Direccion"><i class="fa fa-map-marker"></i></span>
               <input type="text" class="form-control input-lg" name="direccion" id="direccion" placeholder="Ingresar Direccion" required>
             </div>
           </div>

          </div>
          <div class="conten_cajas" id="cont_contrato">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar Tiempo Del Contrato"><i class="fas fa-calendar-alt"></i></span>
                <input type="text" class="form-control input-lg" name="contrato" placeholder="Ingresar Tiempo Contrato">
              </div>
            </div>
           <div class="form-group">
           </div>

          </div>

          <div class="form-group">
            <input type="checkbox" name="copydato" id="copydato" class="checked" value="">
            <label class="labelt" for="copydato" >Mismos Datos </label>

            <hr>
            Datos Factura
          </div>
          <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Ingresar nombres"><i class="fa fa-user"></i></span>
                <input type="mail" class="form-control input-lg" name="nombresf" id="nombresf" placeholder="Ingresar nombres" required>
              </div>
            </div>
           <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon" title="Ingresar Identificacion"><i class="fas fa-address-card"></i></span>
               <input type="text" class="form-control input-lg" name="cedulaf" id="cedulaf" maxlength="13" onkeypress="return solonumeros(event)" placeholder="Ingresar Identificacion" required>
             </div>
           </div>

          </div>
          <div class="conten_cajas">
           <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon" title="Ingresar Dirección"><i class="fa fa-map-marker"></i></span>
               <input type="text" class="form-control input-lg" name="direccionf" id="direccionf" placeholder="Ingresar Dirección" required>
             </div>
           </div>
           <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon" title="Ingresar Descripción"><i class="far fa-file-alt"></i></span>
               <input type="text" class="form-control input-lg" name="descripf" id="descripf" placeholder="Ingresar Descripción" required>
             </div>
           </div>

          </div>

          </div>

        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Clientes</button>
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
    url: 'ajax_cedula_cliente.php',
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
        title: 'Ya existe un Cliente con la misma cédula'
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
document.getElementById('cont_contrato').style.display="none";
  function tipo_cli(){
    var seleccion = document.getElementById('tipo_cliente').value;
    var caja = document.getElementById('nombresc');

    if (seleccion=='1' ||  seleccion=='') {
      caja.removeAttribute('required');
      caja.setAttribute('readonly','');
      caja.value="";
      document.getElementById('cont_contrato').style.display="none";
    }else{
      caja.removeAttribute('readonly');
      caja.setAttribute('required','');
      document.getElementById('cont_contrato').style.display="block";

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



  function validarCedula2(){
    var cedula = document.getElementById('cedula2').value;
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
      document.getElementById('cedulaf').value="";
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
        document.getElementById('cedulaf').value="";
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
        document.getElementById('cedulaf').value="";
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
    $(document).on('keyup','#nombresc', function(){
        var valr= $('#nombresc').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('nombresc').value=texto;
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
    $(document).on('keyup','#nombresf', function(){
        var valr= $('#nombresf').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('nombresf').value=texto;
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
    $(document).on('keyup','#direccionf', function(){
        var valr= $('#direccionf').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = MaysPrimera(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('direccionf').value=texto;
        }
    });
    $(document).on('keyup','#descripf', function(){
        var valr= $('#descripf').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = MaysPrimera(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('descripf').value=texto;
        }
    });

    $(document).on('click','#copydato', function(){
        var chetru=document.getElementById('copydato').checked;
        if(chetru==true){
            var nombre=document.getElementById('nombres').value;
            var apellido=document.getElementById('apellidos').value;
            var cedula=document.getElementById('cedula').value;
            var direccion=document.getElementById('direccion').value;

            document.getElementById('nombresf').value=nombre+" "+apellido;
            document.getElementById('cedulaf').value=cedula;
            document.getElementById('direccionf').value=direccion;
        }
        if(chetru==false){
          document.getElementById('nombresf').value="";
          document.getElementById('cedulaf').value="";
          document.getElementById('direccionf').value="";
        }
    });
</script>
<?php include 'footer.php'; ?>
