<?php


require '../FPDF/fpdf.php';

class PDF extends FPDF
{

  function Header()
  {
     include('../conexion.php');
   //  $result= mysqli_query($con,"SELECT * from informacion");
   //  $row= mysqli_fetch_assoc($result);
   $this->image("../img/logo.png",20,10,25);
   $this->SetFont('arial','B',10);
   $this->SetXY(140,6);
   $this->Cell(50,10,'Fecha: Guayaquil, '.date('d-m-Y').'',0,1,'C');
   $this->SetFont('arial','B',14);
   $this->SetXY(80,10);
   $this->Cell(50,10,'Coop. 13 de Agosto',0,1,'C');
  }
  function Footer(){
    $this->SetY(-15);
    $this->SetFont('arial','I',8);
    $this->Cell(0,10,'pagina'.$this->PageNo().'/{nb}',0,0,'C');
  }

}

 ?>
