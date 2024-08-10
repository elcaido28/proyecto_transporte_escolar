<?php


require '../FPDF/fpdf.php';

class PDF extends FPDF
{

  function Header()
  {
     include('../conexion.php');
   //  $result= mysqli_query($con,"SELECT * from informacion");
   //  $row= mysqli_fetch_assoc($result);
   $this->image("../img/logo.png",20,25,25);
   $this->SetFont('arial','B',10);
   // $this->SetXY(140,6);
   // $this->Cell(50,10,'Fecha: Guayaquil, '.date('d-m-Y').'',0,1,'C');
   $this->SetFont('arial','B',10);
   $this->SetXY(80,25);
   $this->Cell(50,5,utf8_decode('COOPERATIVA DE TRANSPORTE ESCOLAR Y PERSONAL'),0,1,'C');
   $this->SetFont('arial','B',16);
   $this->SetX(80);
   $this->Cell(50,7,utf8_decode('"13 DE AGOSTO"'),0,1,'C');
   $this->SetFont('arial','B',6);
   $this->SetX(62);
   $this->Cell(85,4,utf8_decode('FUNDADA EL 13 DE AGOSTO DEL 2002'),'T',1,'C');
   $this->SetX(62);
   $this->Cell(85,4,utf8_decode('RESOLUCIÓN CNTTT. DEL 2 DE MAYO DEL 2004'),0,1,'C');
   $this->SetX(62);
   $this->Cell(85,4,utf8_decode('GUAYAQUIL – ECUADOR'),'B',1,'C');
   $gy=$this->GetY();
   $this->SetXY(62,$gy+15);
   $this->SetFont('arial','I',13);
   $this->Cell(85,4,utf8_decode('CERTIFICADO'),0,1,'C');

  }
  function Footer(){
    $this->SetXY(25,-30);
    $this->Cell(160,10,utf8_decode('Dirección:  Urbanización Las Orquídeas   MZ  75   S   41   ▪ 0994692543 ▪  Guayaquil -  Ecuador'),'T',1,'C');
    $this->SetX(80);
    $this->SetFont('arial','',7);
    $this->Cell(50,5,utf8_decode('coop13deagosto@hotmail.com'),'B',1,'C');
  }

}

 ?>
