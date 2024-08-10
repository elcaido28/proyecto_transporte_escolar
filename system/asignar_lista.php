<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id=$_REQUEST['id'];



?>
<div class="content-wrapper">
<style media="screen">
.checkbox {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 35px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* hide the browser's default checkbox */
.checkbox input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* create custom checkbox */
.check {
  position: absolute;
  top: 0;
  left: 35px;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border: 1px solid #ccc;
}

/* on mouse-over, add border color */
.checkbox:hover input ~ .check {
  border: 2px solid #2489C5;
}

/* add background color when the checkbox is checked */
.checkbox input:checked ~ .check {
  background-color: #2489C5;
  border:none;
}

/* create the checkmark and hide when not checked */
.check:after {
  content: "";
  position: absolute;
  display: none;
}

/* show the checkmark when checked */
.checkbox input:checked ~ .check:after {
  display: block;
}

/* checkmark style */
.checkbox .check:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
  <section class="content-header">
    <h1>Agregar Lista de asistencia</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="ingreso_institucion.php"><i class="fa fa-list-ul"></i> Reunión Socios</a></li>
      <li class="active">Agregar Lista de asistencia</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>
      <div class="box-body cont_tabla">

        <form class="" action="guardar_asistencia_reunion.php?id=<?php echo $id; ?>" method="post">
          <input type="submit" class="btn btn-primary" name="" value="Guardar Lista">
          <a href="ingreso_reunion.php"><button type="button" class="btn btn-default">Salir</button></a>
          <br><br>
          <table class="tabla" id="tabla">
                            <thead>
                              <tr>
                                <th>Nombres Socios</th>
                                <th>Telefono</th>
                                <th>Presente</th>

                              </tr>
                            </thead>
                            <tr>
                            <?php

                                $consulta3=mysqli_query($con,"SELECT * from empleados where id_tipo_empleado='4' or id_tipo_empleado='7' "); //WHERE id_estado='1' and id_tipo_empleado='4' or id_estado='1' and id_tipo_empleado='7'
                                while($row3=mysqli_fetch_array($consulta3)){
                                  $id_emp=$row3['id_empleados'];
                                  $consulta2=mysqli_query($con,"SELECT * from lista_asistencia where id_empleados='$id_emp' and id_reunion_socios='$id' "); //WHERE id_estado='1' and id_tipo_empleado='4' or id_estado='1' and id_tipo_empleado='7'
                                  $nrow2=mysqli_num_rows($consulta2);
                                  if ($nrow2>0) {
                                    $enable="checked";
                                  }else{
                                    $enable="";
                                  }
                            ?>
                              <td><?php echo $row3['nombres']." ".$row3['apellidos']; ?> </td>
                              <td><?php echo $row3['telefono']; ?> </td>
                              <td><label class="checkBoxF checkbox"><input type="checkbox" <?php echo $enable; ?>  class="checkBoxF" name="check_list[]" value="<?php echo $row3['id_empleados']; ?>"> <span class="checkBoxF check"></span>
                              </label> </td>
                            </tr>
                            <?php } ?>
                        </table>

        </form>



                <script type="text/javascript">
                  $(document).ready(function() {
                  $('.checkBoxF').click(function() {
                    var val =[];
                    var mytable=$("#tabla").DataTable({
                      "destroy":true
                     })
                    })
                   });
                </script>

            </div>

          <script>
            $(document).ready( function () {
                $('.tabla').DataTable();
            } );
            </script>



      </div>
    </div>
  </section>
</div>

<?php include 'footer.php'; ?>
