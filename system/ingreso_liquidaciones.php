<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Buscar Pagos de Liquidaciones</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Buscar Pagos</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Cargo </button> -->
      </div>


      <div class="box-body cont_tabla">
        <table class="tabla" id="tabla" >
         <thead>
          <tr>
            <th>Nº Ruta</th>
            <th>Sector</th>
            <th>Tipo De Ruta</th>
            <th>Descripción</th>
            <th>Agregar Pago</th>
          </tr>
         </thead>
         <tbody>
           <tr>
             <?php
               $anoact=date('Y');
               $consulta=mysqli_query($con,"SELECT * from ruta R inner join rutas_bus RB on RB.id_rutas=R.id_ruta where R.id_estado='1' and R.ano='".$anoact."' ");
               while($row=mysqli_fetch_array($consulta)){
             ?>

               <td><?php echo "Ruta #".$row['num_ruta']; ?> </td>
               <td><?php echo $row['sector']; ?> </td>
               <td><?php echo $row['tipo']; ?> </td>
               <td><?php echo $row['descripcion']; ?> </td>

               <td><a href="asignar_pago_liquidacion.php?id=<?php echo $row['id_rutas_bus']; ?>"> <button class="btn btn-success"><i class="far fa-share-square"></i></button></a> </td>

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
                                  document.location.href="eliminar_ruta.php?id="+id_emp;
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
