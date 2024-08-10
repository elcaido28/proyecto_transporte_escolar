<?php
include('cabecera_certificado.php');
include('../conexion.php');
$ide=$_POST['socio'];
$idpresi=$_POST['presidente'];
$consulta=mysqli_query($con,"SELECT * from empleados where id_empleados='$ide'");
$row=mysqli_fetch_assoc($consulta);
$newano = date("Y", strtotime($row['fecha']));
$newmes = date("m", strtotime($row['fecha']));
$newdia = date("d", strtotime($row['fecha']));
$mesl=$newmes;
$fech1=date('Y');
$fech2=date('m');
$fech3=date('d');
$mesl2=$fech2;
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mes=$meses[$mesl-1];

$pdf=new PDF('P','mm','A4');#(orizontal L o vertical P,medida cm mm, A3-A4)
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$y=$pdf->GetY();
$pdf->SetXY(25,$y+20);
$pdf->SetFont('arial','',10);
$pdf->MultiCell(160,5,utf8_decode('La actual Presidenta,   de LA COOPERATIVA DE TRANSPORTE ESCOLAR Y PERSONAL "13 DE AGOSTO" , Lcda. Silvia Viera Alvarado,   CERTIFICA, que el  Señor:'),0,'L',0);

$pdf->SetX(80);
$pdf->SetFont('arial','B',12);
$pdf->Cell(50,15,utf8_decode($row['nombres']." ".$row['apellidos']),0,1,'C');
$pdf->SetFont('arial','',10);
$pdf->SetX(25);
$pdf->MultiCell(160,5,utf8_decode(' Portador  de la  C.I. '.$row['cedula'].' ,  presta  servicios  de transporte escolar y personal desde  el '.$newdia.' de '.$mes.'  del '.$newano.', hasta la actualidad. Durante este tiempo ha demostrado puntualidad, cumplimiento y responsabilidad. El trato que mantiene con los clientes es cordial y amable. '),0,'L',0);
$y=$pdf->GetY();
$pdf->SetXY(25,$y+5);
$pdf->MultiCell(160,5,utf8_decode(' Autorizo a la Señor/a '.$row['apellidos'].', para hacer uso del presente certificado conforme a sus intereses. '),0,'L',0);

$y=$pdf->GetY();
$pdf->SetXY(100,$y+25);
$pdf->Cell(50,10,' Guayaquil, '.$fech3.' de '.$meses[$mesl2-1].'  del '.$fech1.'',0,1,'C');

$consulta2=mysqli_query($con,"SELECT * from empleados where id_empleados='$idpresi'");
$row2=mysqli_fetch_assoc($consulta2);
$y=$pdf->GetY();
$pdf->SetXY(80,$y+10);
$pdf->Cell(50,10,utf8_decode($row2['nombres']." ".$row2['apellidos']),0,1,'C');
$pdf->SetX(80);
$pdf->Cell(50,10,utf8_decode($row2['cedula']),0,1,'C');


/*

$pdf->SetFont('arial','B',15);
$pdf->SetXY(10,70);
$pdf->MultiCell(60,5,'hola mundo como estan todo aqui',1,'C',0);
$pdf->MultiCell(100,5,'hola mundo como estan todo aqui',1,'C',0);
*/
$pdf->Output();
 ?>
