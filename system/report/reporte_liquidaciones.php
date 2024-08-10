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
$mes=$_POST['mes'];

if (isset($_POST['chaleco']) && $_POST['chaleco']!="") {
  $chaleco=$_POST['chaleco'];
}else{
  $chaleco=0;
}

if (isset($_POST['adelanto']) && $_POST['adelanto']!="") {
  $adelanto=$_POST['adelanto'];
}else{
  $adelanto=0;
}

$consulta=mysqli_query($con,"SELECT * FROM ruta R INNER JOIN rutas_personas RP ON RP.id_ruta=R.id_ruta WHERE R.id_estado='1' and RP.id_ruta='$idr' ".$query." ");
$row=mysqli_fetch_array($consulta);
$tiporuta=$row['tipo'];
$consulta2=mysqli_query($con,"SELECT * FROM  rutas_bus RB inner join buses B ON B.id_buses=RB.id_bus inner join empleados E on E.id_empleados=B.conductor WHERE RB.id_rutas='$idr' ");
$row2=mysqli_fetch_array($consulta2);

$consulta3=mysqli_query($con,"SELECT * from rutas_personas RP inner join servicio S on S.id_servicio=RP.servicio INNER JOIN personas P on P.id_personas=RP.id_personas inner join curso CS on CS.id_curso=P.id_curso INNER JOIN clientes C on C.id_clientes=P.id_clientes where RP.id_ruta='$idr' ORDER BY P.nombre ASC");
$consulta7=mysqli_query($con,"SELECT * from rutas_personas RP inner join servicio S on S.id_servicio=RP.servicio INNER JOIN personas P on P.id_personas=RP.id_personas inner join curso CS on CS.id_curso=P.id_curso INNER JOIN clientes C on C.id_clientes=P.id_clientes where RP.id_ruta='$idr' ORDER BY P.nombre ASC");

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


 $pdf->Cell(40,10,utf8_decode('Persona'),1,0,'C',true);
$pdf->Cell(20,10,utf8_decode('Servicio'),1,0,'C',true);

$m=0;
$arraymes=[];
while($row7=mysqli_fetch_array($consulta7)){
  $id_per=$row7['id_personas'];
  $consulta8=mysqli_query($con,"SELECT * from pago_liquidacion where id_ruta='$idr' and id_personas='$id_per' and mespago='$mes'");
  $row8=mysqli_fetch_array($consulta8);
  $id_pg_liq=$row8['id_pago_liquidacion'];
  $consulta9=mysqli_query($con,"SELECT * from detalle_pago_liquidacion where id_pago_liquidacion='$id_pg_liq' ");
  while($row9=mysqli_fetch_array($consulta9)){
    $arraymes[$m]=$row9['mes'];
    $m++;
}
}
 $dtmeses=array_unique($arraymes);
 foreach ($dtmeses as $value) {
   $mesl=$value;
   $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   $pdf->Cell(30,10,utf8_decode($meses[$mesl-1]),1,0,'C',true);
 }

$pdf->Cell(30,10,utf8_decode('Todal'),1,1,'C',true);

$pdf->SetFont('arial','B',8);
 $pdf->SetTextColor(0, 0, 0);

 $dtm=count($dtmeses);
$subtotal=0;
while($row3=mysqli_fetch_array($consulta3)){
 $id_per=$row3['id_personas'];
  $consulta4=mysqli_query($con,"SELECT * from pago_liquidacion where id_ruta='$idr' and id_personas='$id_per' and mespago='$mes'");
  if (mysqli_num_rows($consulta4)>0) {



  $row4=mysqli_fetch_array($consulta4);
  $id_pg_liq=$row4['id_pago_liquidacion'];


$pdf->Cell(40,10,utf8_decode($row3['nombre']." ".$row3['apellido']),1,0,'C');
$pdf->Cell(20,10,utf8_decode($row3['descrips']),1,0,'C');
  $n=0;
  $consulta5=mysqli_query($con,"SELECT * from detalle_pago_liquidacion where id_pago_liquidacion='$id_pg_liq' ");
  while($row5=mysqli_fetch_array($consulta5)){
    $pdf->Cell(30,10,utf8_decode($row5['valor']),1,0,'C');
    $n++;
  }
  if ($n<$dtm) {
    $l=$dtm-$m;
    for ($i=0; $i < $l; $i++) {
      $pdf->Cell(30,10,utf8_decode('0.00'),1,0,'C');
    }
  }

$pdf->Cell(30,10,utf8_decode($row4['total']),1,1,'C');
$subtotal+=$row4['total'];
}else{
  $pdf->Cell(40,10,utf8_decode($row3['nombre']." ".$row3['apellido']),1,0,'C');
  $pdf->Cell(20,10,utf8_decode($row3['descrips']),1,0,'C');


    $l=$dtm;
    for ($i=0; $i < $l; $i++) {
      $pdf->Cell(30,10,utf8_decode('0.00'),1,0,'C');

  }
  $pdf->Cell(30,10,utf8_decode('0.00'),1,1,'C');
}

}
$y=$pdf->GetY();
$pdf->SetY($y+2);
$lgc=60+(30*$dtm);
$pdf->Cell($lgc,6,utf8_decode('SUBTOTAL'),1,0,'C');
$pdf->Cell(30,6,utf8_decode($subtotal),1,1,'C');

$retf=$subtotal*0.01;
$pdf->Cell($lgc,6,utf8_decode('RET. A LA FUENTE'),1,0,'C');
$pdf->Cell(30,6,utf8_decode($retf),1,1,'C');

$vtotal=$subtotal-$retf;
$pdf->Cell($lgc,6,utf8_decode('TOTAL'),1,0,'C');
$pdf->Cell(30,6,utf8_decode($vtotal),1,1,'C');

$pdf->Cell($lgc,6,utf8_decode('CHALECO'),1,0,'C');
$pdf->Cell(30,6,utf8_decode($chaleco),1,1,'C');

$pdf->Cell($lgc,6,utf8_decode('ADELANTO'),1,0,'C');
$pdf->Cell(30,6,utf8_decode($adelanto),1,1,'C');
$gastoa=25;
$pdf->Cell($lgc,6,utf8_decode('GASTOS ADMINISTRATIVOS'),1,0,'C');
$pdf->Cell(30,6,utf8_decode($gastoa),1,1,'C');
$netop=$vtotal-($chaleco+$gastoa+$adelanto);
$pdf->Cell($lgc,6,utf8_decode('NETO A RECIBIR'),1,0,'C');
$pdf->Cell(30,6,utf8_decode($netop),1,1,'C');

$y=$pdf->GetY();
$pdf->SetY($y+5);
$pdf->Cell(40,10,utf8_decode('firma Conforme'),0,0,'C');
$pdf->Cell(40,10,utf8_decode(''),'B',1,'C');



/*
$pdf->SetFont('arial','B',15);
$pdf->SetXY(10,70);
$pdf->MultiCell(60,5,'hola mundo como estan todo aqui',1,'C',0);
$pdf->MultiCell(100,5,'hola mundo como estan todo aqui',1,'C',0);
*/
$pdf->Output();
 ?>
