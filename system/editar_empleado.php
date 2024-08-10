<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];


$consulta="SELECT * FROM empleados   WHERE id_empleados='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);


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

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">

            <form role="form" action="modificar_empleado.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->

              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Empleado</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body">
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Nombres"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" name="nombres" value="<?php echo $row['nombres']; ?>" id="nombres" onkeypress="return soloLetras(event)" placeholder="Ingresar nombres" required>
                    </div>
                  </div>
                  <!-- ENTRADA -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Apellidos"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" name="apellidos" value="<?php echo $row['apellidos']; ?>" id="apellidos" onkeypress="return soloLetras(event)" placeholder="Ingresar apellidos" required>
                    </div>
                  </div>
                </div>
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Cedula"><i class="fas fa-address-card"></i></i></span>
                      <input type="text" class="form-control input-lg" maxlength="10" name="cedula" id="cedula" onchange="validarCedula(this.value);" onkeypress="return solonumeros(event)" value="<?php echo $row['cedula']; ?>" placeholder="Ingresar Cedula" required>
                    </div>
                  </div>
                  <!-- ENTRADA  -->

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Teléfono"><i class="fa fa-phone"></i></span>
                      <input type="text" class="form-control input-lg" name="telefono" value="<?php echo $row['telefono']; ?>" placeholder="Ingresar teléfono" data-inputmask="'mask':'9999-999-999'" data-mask required>
                    </div>
                  </div>
                  </div>
                  <!-- ENTRADA  -->
                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Correo"><i class="fa fa-envelope"></i></span>
                      <input type="mail" class="form-control input-lg" name="correo" value="<?php echo $row['correo']; ?>" placeholder="Ingresar correo" required>
                    </div>
                  </div>
                   <!-- ENTRADA -->

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Dirección"><i class="fa fa-map-marker"></i></span>
                      <input type="text" class="form-control input-lg" name="direccion" value="<?php echo $row['direccion']; ?>" id="direccion" placeholder="Ingresar direccion" required>
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
                            if($row4['id_tipo_empleado']==$row['id_tipo_empleado']){$sel="selected='selected'";}else{$sel="";}
                          echo "<option ".$sel." value='".$row4['id_tipo_empleado']."'>"; echo $row4['descrip']; echo "</option>"; } ?> </select>
                    </div>
                  </div>
                  <div class="form-group" id="cont_doc1" style="display:none;"></div>
                  <div class="form-group" id="cont_doc2">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar Documento"><i class="fas fa-file"></i></span>
                      <input type="file" class="form-control input-lg" name="docu"  id="docu" title="Documento">
                    </div>
                  </div>
                </div>
                  <!-- ENTRADA SUBIR FOTO -->
                   <div class="form-group">
                    <div class="panel">SUBIR FOTO</div>
                    <input type="file" class="nuevaFoto" name="foto">
                    <p class="help-block">Peso máximo de la foto 3MB</p>
                    <img src="<?php echo $row['foto']; ?>" class="img-thumbnail previsualizar" width="100px">
                  </div>
                </div>

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Guardar Empleado</button>
                <a href="ingreso_empleado.php"><button type="button" class="btn btn-default" data-dismiss="modal">Salir</button></a>
              </div>
            </form>
          </div>
        </div>
      </div>


    </div>
  </section>
</div>

<!--=====================================
MODAL FIN
======================================-->
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
