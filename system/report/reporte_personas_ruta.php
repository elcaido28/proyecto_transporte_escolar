<?php
include('TD_reportes.php');
include('../conexion.php');
// if (isset($_POST['fecha1']) || isset($_POST['fecha2'])) {
//   if ($_POST['fecha1']!="" && $_POST['fecha2']!="") {
//     $inicio=$_POST['fecha1'];
//     $fin=$_POST['fecha2'];
//     $query=" and E.fecha Between '$inicio' and '$fin' ";
//     // $fechas="Fecha desdes ".$inicio." hasta ".$fin;
//   }else {
//     $query="";
//     $fechas="";
//   }
// }else {
//   $query="";
//   $fechas="";
// }
$query="";
$idr=$_POST['ruta'];

$consulta=mysqli_query($con,"SELECT * FROM ruta R INNER JOIN rutas_personas RP ON RP.id_ruta=R.id_ruta WHERE R.id_estado='1' and RP.id_ruta='$idr' ".$query." ");
$row=mysqli_fetch_array($consulta);
$tiporuta=$row['tipo'];
$consulta2=mysqli_query($con,"SELECT * FROM  rutas_bus RB inner join buses B ON B.id_buses=RB.id_bus inner join empleados E on E.id_empleados=B.conductor WHERE RB.id_rutas='$idr' ");
$row2=mysqli_fetch_array($consulta2);

$consulta3=mysqli_query($con,"SELECT * from rutas_personas RP inner join servicio S on S.id_servicio=RP.servicio INNER JOIN personas P on P.id_personas=RP.id_personas inner join curso CS on CS.id_curso=P.id_curso INNER JOIN clientes C on C.id_clientes=P.id_clientes where RP.id_ruta='$idr' ORDER BY P.nombre ASC");

$pdf=new PDF('P','mm','A4');#(orizontal L o vertical P,medida cm mm, A3-A4)
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$pdf->SetXY(20,17);
$pdf->Cell(170,10,'REPORTE DE PERSONAS POR RUTA',0,1,'C');#(ancho,alto,texto,borde,salto linea,alineacion L C R)
$pdf->SetFont('arial','',10);
// $pdf->Cell(100,10,$fechas ,0,1,'C');

$y=$pdf->GetY();
$pdf->SetY($y+15);
$pdf->SetFont('arial','B',10);
$pdf->Cell(22,5,utf8_decode('Ruta #'.$row['num_ruta']),0,0,'C');
$pdf->Cell(60,5,utf8_decode('Sector: '.$row['sector']),0,1,'C');

$pdf->Cell(3,10,utf8_decode(''),0,0,'C');
$pdf->Cell(100,10,utf8_decode('Conductor: '.$row2['nombres']." ".$row2['apellidos']),0,1,'L');
$pdf->SetFont('arial','B',8);
$pdf->SetFillColor(55, 144, 191);
 $pdf->SetTextColor(255, 255, 255);
 if ($tiporuta!="Empresa") {

 $pdf->Cell(40,10,utf8_decode('Estudiante'),1,0,'C',true);
$pdf->Cell(30,10,utf8_decode('Curso'),1,0,'C',true);
$pdf->Cell(25,10,utf8_decode('Tiempo/Servicio'),1,0,'C',true);
$pdf->Cell(20,10,utf8_decode('Servicio'),1,0,'C',true);
$pdf->Cell(45,10,utf8_decode('Padres'),1,0,'C',true);
$pdf->Cell(30,10,utf8_decode('Telefono'),1,1,'C',true);

$pdf->SetFont('arial','B',8);
 $pdf->SetTextColor(0, 0, 0);
while($row3=mysqli_fetch_array($consulta3)){
if($row3['tiempo_servicio']=='Si'){
  $tps='10 Meses';
}else{
  $tps=$row3['otro_tiempo'];
}
$pdf->Cell(40,10,utf8_decode($row3['nombre']." ".$row3['apellido']),1,0,'C');
$pdf->Cell(30,10,utf8_decode($row3['descrip']." ".$row3['paralelo']),1,0,'C');
$pdf->Cell(25,10,utf8_decode($tps),1,0,'C');
$pdf->Cell(20,10,utf8_decode($row3['descrips']),1,0,'C');
$pdf->Cell(45,10,utf8_decode($row3['nombres']." ".$row3['apellidos']),1,0,'C');
$pdf->Cell(30,10,utf8_decode($row3['telefono3']),1,1,'C');
}
}else{
  $pdf->Cell(35,10,utf8_decode('nombres'),1,0,'C',true);
 $pdf->Cell(35,10,utf8_decode('Apellidos'),1,0,'C',true);
 $pdf->Cell(30,10,utf8_decode('Servicio'),1,0,'C',true);
 $pdf->Cell(50,10,utf8_decode('Empresa'),1,0,'C',true);
 $pdf->Cell(30,10,utf8_decode('Telefono'),1,1,'C',true);

 $pdf->SetFont('arial','B',10);
  $pdf->SetTextColor(0, 0, 0);
 while($row3=mysqli_fetch_array($consulta3)){
 if($row3['tiempo_servicio']=='Si'){
   $tps='10 Meses';
 }else{
   $tps=$row3['otro_tiempo'];
 }
 $pdf->Cell(35,10,utf8_decode($row3['nombre']),1,0,'C');
 $pdf->Cell(35,10,utf8_decode($row3['apellido']),1,0,'C');
 $pdf->Cell(30,10,utf8_decode($row3['descrips']),1,0,'C');
 $pdf->Cell(50,10,utf8_decode($row3['nombres']." ".$row3['apellidos']),1,0,'C');
 $pdf->Cell(30,10,utf8_decode($row3['telefono3']),1,1,'C');
}
}
/*
$pdf->SetFont('arial','B',15);
$pdf->SetXY(10,70);
$pdf->MultiCell(60,5,'hola mundo como estan todo aqui',1,'C',0);
$pdf->MultiCell(100,5,'hola mundo como estan todo aqui',1,'C',0);
*/
$pdf->Output();
 ?>
