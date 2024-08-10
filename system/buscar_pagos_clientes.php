<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Buscar Pagos de Clientes</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Buscar Pagos</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">

      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>


      <div class="box-body cont_tabla">
       <table class="tabla" id="tabla" >

        <thead>
         <tr>

           <th>Fecha</th>
           <th> Nº Factura</th>
           <th>Cliente</th>
           <th>Mes de pago</th>
           <th>Valor</th>
           <th>Forma de Pago</th>
           <th>Descripcion</th>
           <th>Acciones</th>
         </tr>
        </thead>
        <tbody>
          <tr>
            <?php
              $consulta=mysqli_query($con,"SELECT * from pago_clientes P inner join clientes C on C.id_clientes=P.id_clientes ");
              while($row=mysqli_fetch_array($consulta)){
                if ($row['forma_pago']=='1') { $forpag='Efectivo';  }
                if ($row['forma_pago']=='2') { $forpag='Transferencia';  }
                if ($row['forma_pago']=='3') { $forpag='Cheque'; }
                $mesl=$row['mes'];
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            ?>

            <td><?php echo $row['fecha']; ?> </td>
            <td><?php echo $row['n_factu']; ?> </td>
            <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
            <td><?php echo $meses[$mesl-1]; ?> </td>
            <td><?php echo $row['valor']; ?> </td>
            <td><?php echo $forpag; ?> </td>
            <td><?php echo $row['descripf']; ?> </td>


              <td><div class="btn-group">
                <a href="editar_pagos_clientes.php?id=<?php echo $row['id_pago_clientes'] ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                <!-- <a href="#" class="eliminar"><button class="btn btn-danger" id="<?php echo $row['id_pago_clientes'] ?>"><i class="fa fa-times" id="<?php echo $row['id_pago_clientes'] ?>"></i></button></a> -->
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
                                 document.location.href="eliminar_cargo.php?id="+id_emp;
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

<?php include 'footer.php'; ?>
