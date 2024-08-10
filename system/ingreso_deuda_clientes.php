<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>
<div class="content-wrapper">
<style media="screen">
  .content_btn_lis{
    display: flex;
  }
</style>
  <section class="content-header">
    <h1>Administrar Deuda de Clientes</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Deuda de Clientes</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" id="agg_cuota_td" > Agregar Deuda Clientes </button> -->
      </div>

      <script type="text/javascript">
             $('#agg_cuota_td').click(function(){
                   const swalWithBootstrapButtons = Swal.mixin({
                     customClass: {
                       confirmButton: 'btn btn-success',
                       cancelButton: 'btn btn-danger'
                     },
                     buttonsStyling: false
                   })
                   swalWithBootstrapButtons.fire({
                     title: 'Esta Seguro De Agregar Cuotas?',
                     text: "Se aplica a todos los socios. No podrás revertir esto!!!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonText: 'Si, Agregar!',
                     cancelButtonText: 'No, cancelar!',
                     reverseButtons: true
                   }).then((result) => {
                     if (result.value) {
                         document.location.href="guardar_deuda_cliente_todos.php";
                     } else if (
                       /* Read more about handling dismissals below */
                       result.dismiss === Swal.DismissReason.cancel
                     ) {

                     }
                   })
         })
           </script>

      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>

           <th>Nombres</th>
           <th>Telefono</th>
           <th>Deuda Total</th>
           <th>Detalle de Deudas</th>
           <th>Agregar Otras Deudas</th>
           <!-- <th>Acciones</th> -->
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from deuda_cliente D inner join clientes C on C.id_clientes=D.id_clientes where C.id_estado='1' ");
              while($row=mysqli_fetch_array($consulta)){
            ?>

              <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
              <td><?php echo $row['telefono3']; ?> </td>
              <td><?php echo "$  ".$row['deuda_totalc']; ?> </td>

              <td><a href="#" class="list" title="Ver Detalle de Deudas" data-toggle="modal" data-target="#modalAgregarCategoria"  data-id="<?php echo $row['id_deuda_cliente'] ?>"> <button class="btn btn-default"><i class="far fa-eye" ></i></button></a> </td>

              <td>
                <a href="#" class="agg_deuda" title="Agregar Otras Deudas" data-toggle="modal" data-target="#modalAgregarUsuario"  data-id="<?php echo $row['id_deuda_cliente'] ?>"> <button class="btn btn-primary"><i class="fas fa-coins"></i></button></a>
            </td>
              <!-- <td><div class="btn-group content_btn_lis">
                <a href="editar_reunion.php?id=<?php echo $row['id_deuda_socios'] ?>"> <button class="btn btn-primary" title="Editar Reunión"><i class="fa fa-pencil"></i></button></a>
              </div></td> -->
              </tr>
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

      <form role="form" action="" id="otras_deudas" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Otras Deudas</h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA  -->
          <div class="conten_cajas">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon" title="Motivo de Deuda"><i class="far fa-list-alt"></i></span>
                <select class="form-control input-lg" name="motivo" required><option value="">Motivo de Deuda</option>
                  <option>Mensualidad</option>
                  <option>Extracurricular</option>
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
            <div class="form-group"> </div>
          </div>


          </div>

        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Otra Deuda</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL FIN
======================================-->
<script type="text/javascript">
$(document).ready(function(){

   $('.agg_deuda').click(function(e) {
  var idr=this.dataset.id;
  var dataString ="guardar_otras_deudas_cliente.php?id="+idr;

  document.getElementById('otras_deudas').action=dataString;
  });
});
</script>



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








<!--=====================================
MODAL AGREGAR EXTRA
======================================-->
<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#aec5d2; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body" >
            <table class="tabla" id="tabla2" >
             <thead>
              <tr>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Mes</th>
                <th>Valor</th>
              </tr>
             </thead>
             <tbody id="cont_tabla">

             </tbody>
            </table>
            <script type="text/javascript">
                $(document).ready(function() { $('#tabla2').DataTable( { dom: 'Bfrtip', buttons: [ 'excel', 'pdf' ] } ); } );
            </script>

          </div>
        </div>
    </div>
  </div>
</div>

<!--=====================================
PIE DEL MODAL
======================================-->


<script type="text/javascript">
$(document).ready(function(){

   $('.list').click(function(e) {
  var idr=this.dataset.id;
  var dataString ="id="+idr;

  $.ajax({
    url: "tabla_detalle_deuda_cliente.php",
    data: dataString,
    async: false,
    success : function(text)
    {
      $("#cont_tabla").html(text);

    }
  });

  });
});
</script>


<?php include 'footer.php'; ?>
