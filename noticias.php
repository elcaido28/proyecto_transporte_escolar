
<?php include('menu_publi.php'); ?>
    <!-- END nav -->



<br><br><br><br><br>
<section id="about-boxes" class="about-boxes">
  <div class="container" data-aos="fade-up">

    <div class="row">
      <?php
        include('system/conexion.php');
        $consulta=mysqli_query($con,"SELECT * from publicaciones where id_estado='1' ");
        $nrow=mysqli_num_rows($consulta);
        if($nrow>0){
          $consulta2=mysqli_query($con,"SELECT * from publicaciones where id_estado='1' ");
          while($row=mysqli_fetch_array($consulta2)){
      ?>
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
        <div class="card">
          <img src="<?php echo "system/".$row['img']; ?>" class="card-img-top" alt="...">
          <div class="card-icon">
            <i class="ri-brush-4-line"></i>
          </div>
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['titulo']; ?></h5>
            <p class="card-text"><?php echo $row['descripcion']; ?></p>
          </div>
        </div>
      </div>
<?php } } ?>

    </div>

  </div>
</section>
<br><br>


<?php include('footer.php'); ?>
