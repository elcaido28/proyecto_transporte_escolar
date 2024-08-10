<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];

$consulta="SELECT *,C.nombres nombres,C.direccion direccion,FC.nombres nombresf,FC.cedula cedulaf,FC.direccion direccionf,FC.descrip descripf FROM  clientes C inner join datos_factura_cliente FC on FC.id_clientes=C.id_clientes WHERE C.id_clientes='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
?>

<div class="content-wrapper">
  <style media="screen">
    .stnone{
      display: none;
    }
  </style>
  <section class="content-header">
    <h1>Administrar Clientes</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_clientes.php"><i class="fa fa-list-ul"></i> Administrar Clientes</a></li>
      <li class="active">Editar Cliente</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

          <div class="modal-dialog">
            <div class="modal-content">

              <form role="form" action="modificar_clientes.php?id=<?php echo $id."&idf=".$row['id_datos_factura_cliente']; ?>" method="post" enctype="multipart/form-data">
                <!--========== CABEZA DEL MODAL =================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                  <h4 class="modal-title">Editar Cliente</h4>
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
                              if($row4['id_tipo_cliente']==$row['id_tipo_cliente']){$sel="selected='selected'";}else{$sel="";}
                              echo "<option ".$sel." value='".$row4['id_tipo_cliente']."'>"; echo $row4['descrip']; echo "</option>"; } ?> </select>
                        </div>
                      </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Nombre Comercial"><i class="far fa-building"></i></span>
                        <input type="text" class="form-control input-lg" name="nombresc" value="<?php if($row['id_tipo_cliente']==2){ echo $row['nombre_comercial']; } ?>" id="nombresc" placeholder="Nombre Comercial" readonly required>
                      </div>
                    </div>
                  </div>
                    <!-- ENTRADA  -->
                    <div class="conten_cajas">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="Ingresar Nombres"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control input-lg" name="nombres" value="<?php echo  $row['nombres']; ?>" id="nombres" onkeypress="return soloLetras(event)" placeholder="Ingresar apellidos" required >
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="Ingresar Apellidos"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control input-lg" name="apellidos" value="<?php echo  $row['apellidos']; ?>" id="apellidos" onkeypress="return soloLetras(event)" placeholder="Ingresar nombres" required>
                        </div>
                      </div>
                    </div>
                      <!-- ENTRADA  -->
                    <div class="conten_cajas">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="Ingresar Identidicación"><i class="fas fa-address-card"></i></span>
                          <input type="text" class="form-control input-lg" maxlength="10" name="cedula" value="<?php echo  $row['identificacion']; ?>" id="cedula" onchange="validarCedula(this.value);" onkeypress="return solonumeros(event)" placeholder="Ingresar Identificacion" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="Telefono Convencional"><i class="fa fa-phone"></i></span>
                          <input type="text" class="form-control input-lg" name="telefono" value="<?php echo  $row['telefono']; ?>"  placeholder="Ingresar convencional 1" data-inputmask="'mask':'9-999-999'" data-mask >
                        </div>
                      </div>
                    </div>

                      <!-- ENTRADA  -->
                    <div class="conten_cajas">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="Telefono Convencional 2"><i class="fa fa-phone"></i></span>
                          <input type="mail" class="form-control input-lg" name="telefono2" value="<?php echo  $row['telefono2']; ?>" placeholder="Ingresar convencional 2" data-inputmask="'mask':'9-999-999'" data-mask>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="Telefono Celular "><i class="fa fa-phone"></i></span>
                          <input type="text" class="form-control input-lg" name="telefono3" value="<?php echo  $row['telefono3']; ?>"  placeholder="Ingresar Celular" data-inputmask="'mask':'0999-999-999'" data-mask required>
                        </div>
                      </div>
                    </div>


                    <!-- ENTRADA -->
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Correo"><i class="fa fa-envelope"></i></span>
                        <input type="mail" class="form-control input-lg" name="correo" value="<?php echo  $row['correo']; ?>" placeholder="Ingresar correo" required>
                      </div>
                    </div>
                   <div class="form-group">
                     <div class="input-group">
                       <span class="input-group-addon" title="Ingresar Direccion"><i class="fa fa-map-marker"></i></span>
                       <input type="text" class="form-control input-lg" name="direccion" value="<?php echo  $row['direccion']; ?>" id="direccion" placeholder="Ingresar direccion" required>
                     </div>
                   </div>
                  </div>

                  <div class="conten_cajas <?php if($row['tiempo_contrato']==""){echo 'stnone';} ?>" id="cont_contrato">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar Tiempo Del Contrato"><i class="fas fa-calendar-alt"></i></span>
                        <input type="text" class="form-control input-lg" name="contrato"  value="<?php echo  $row['tiempo_contrato']; ?>" placeholder="Ingresar Tiempo Contrato">
                      </div>
                    </div>
                   <div class="form-group">
                   </div>
                  </div>

                  <div class="form-group">
                    <hr>
                    Datos Factura
                  </div>
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Ingresar nombres"><i class="fa fa-user"></i></span>
                        <input type="mail" class="form-control input-lg" name="nombresf" value="<?php echo  $row['nombresf']; ?>" id="nombresf" placeholder="Ingresar nombres" required>
                      </div>
                    </div>
                   <div class="form-group">
                     <div class="input-group">
                       <span class="input-group-addon" title="Ingresar Identificacion"><i class="fas fa-address-card"></i></span>
                       <input type="text" class="form-control input-lg" name="cedulaf" value="<?php echo  $row['cedulaf']; ?>" id="cedulaf" maxlength="13" onkeypress="return solonumeros(event)" placeholder="Ingresar Identificacion" required>
                     </div>
                   </div>

                  </div>
                  <div class="conten_cajas">
                   <div class="form-group">
                     <div class="input-group">
                       <span class="input-group-addon" title="Ingresar Dirección"><i class="fa fa-map-marker"></i></span>
                       <input type="text" class="form-control input-lg" name="direccionf" value="<?php echo  $row['direccionf']; ?>" id="direccionf" placeholder="Ingresar direccion" required>
                     </div>
                   </div>
                   <div class="form-group">
                     <div class="input-group">
                       <span class="input-group-addon" title="Ingresar Descripción"><i class="far fa-file-alt"></i></span>
                       <input type="text" class="form-control input-lg" name="descripf" value="<?php echo  $row['descripf']; ?>" id="descripf" placeholder="Ingresar descripcion" required>
                     </div>
                   </div>

                  </div>

                  </div>

                </div>
                <!--========== PIE DEL MODAL ==============-->
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                  <a href="ingreso_clientes.php"><button type="button" class="btn btn-default" data-dismiss="modal">Salir</button></a>
                </div>
              </form>
            </div>
          </div>
        <!--=====================================
        MODAL FIN
        ======================================-->
        <script type="text/javascript">
          function tipo_cli(){
            var seleccion = document.getElementById('tipo_cliente').value;
            var caja = document.getElementById('nombresc');

            if (seleccion=='1' ||  seleccion=='') {
              caja.removeAttribute('required');
              caja.setAttribute('readonly','');
              document.getElementById('cont_contrato').style.display="none";
              caja.value="";
            }else{
              caja.removeAttribute('readonly');
              document.getElementById('cont_contrato').style.display="block";
              caja.setAttribute('required','');
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
            var cedula = document.getElementById('cedulaf').value;
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

        </script>





      </div>
    </div>
  </section>
</div>


<?php include 'footer.php'; ?>
