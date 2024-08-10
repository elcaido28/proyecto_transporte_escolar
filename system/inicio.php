<?php
include('cabecera.php');
include('menu.php');

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>



      <small></small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">


    </div>

     <div class="row">

        <div class="col-lg-12">



        </div>

        <div class="col-lg-6">



        </div>

         <div class="col-lg-6">


        </div>

         <div class="col-lg-12">
           <div class="box box-success">

             <div class="box-header">

             <h1>Bienvenid@ <?php echo $_SESSION['NU']; ?></h1>

             </div>

             </div>

         </div>

     </div>

  </section>

</div>
<?php include('footer.php');  ?>
