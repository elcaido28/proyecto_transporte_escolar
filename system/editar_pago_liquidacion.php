<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$id_liq=$_REQUEST['idliq'];
$idRB=$_REQUEST['idrb'];
$consul=mysqli_query($con,"SELECT * from rutas_bus RB inner join ruta R on R.id_ruta=RB.id_rutas inner join buses B on B.id_buses=RB.id_bus inner join institucion I on I.id_institucion=B.id_institucion inner join empleados E on E.id_empleados=B.conductor where id_rutas_bus='$idRB'");
$row2=mysqli_fetch_array($consul);
$id_R=$row2['id_ruta'];

$consul3=mysqli_query($con,"SELECT * from pago_liquidacion PL inner join personas P on P.id_personas=PL.id_personas where PL.id_pago_liquidacion='$id_liq'");
$row3=mysqli_fetch_array($consul3);
$id_perso=$row3['id_personas'];
?>
<script type="text/javascript">
var contLin =0;
localStorage.setItem("conta_tb",contLin);
function agregar() {
  var tr, td, tabla3,cob;
  contLin+=+1;
  tabla3 = document.getElementById('tabla3');
  tr = tabla3.insertRow(tabla3.rows.length);

  td = tr.insertCell(tr.cells.length);
  cob +="<div class='form-group tb3td'><div class='input-group'><span class='input-group-addon' title='Seleccionar Mes'><i class='fas fa-calendar-alt'></i></span><select name='mes" + contLin + "' id='mes" + contLin + "' class='form-control input-lg' onchange='calculo()' required>";
  cob += "<option value=''>Mes</option><option value='01'>Enero</option><option value='02'>Febrero</option><option value='03'>Marzo</option><option value='04'>Abril</option><option value='05'>Mayo</option><option value='06'>Junio</option>";
  cob += "<option value='07'>Julio</option><option value='08'>Agosto</option><option value='09'>Septiembre</option><option value='10'>Octubre</option><option value='11'>Noviembre</option><option value='12'>Diciembre</option></select></div></div>";
  td.innerHTML = cob;


  td = tr.insertCell(tr.cells.length);
  td.innerHTML = "<div class='form-group'><div class='input-group'><span class='input-group-addon' title='valor a pagar'><i class='fas fa-coins'></i></span><input type='text' class='form-control input-lg conpago' onchange='calculo()' name='pago" + contLin + "' id='pago" + contLin + "' placeholder='Ingresar valor a pagar' maxlength='6' required onkeypress='return solonumeros(event)'></div></div>";

  localStorage.setItem("conta_tb",contLin);
}
function borrarUltima() {
  var tabla3 = document.getElementById('tabla3');
  var ultima = document.all.tabla3.rows.length - 1;
  if(ultima > 1){
    document.all.tabla3.deleteRow(ultima);
    contLin--;
    localStorage.setItem("conta_tb",contLin);
  }
  calculo();

}
</script>
<script>
function calculo() {
  var idrb='<?php echo $idRB; ?>';
  var idr='<?php echo $id_R; ?>';
  var idliq='<?php echo $id_liq; ?>';

	var cont_tabla=localStorage.getItem('conta_tb');
  var totalp=0;
  var data;
 for (var i = 0; i <= cont_tabla; i++) {
  var id_pago='pago'+i;
  var pagot=document.getElementById(id_pago).value;
  if(pagot=="" || pagot==null ){
    pagot=0;
  }
  totalp=totalp+parseFloat(pagot);
}
document.getElementById('total').value=totalp.toFixed(2);
var con=localStorage.getItem('conta_tb');
var url1='modificar_liquidacion.php?cont='+con+'&idliq='+idliq+'&idrb='+idrb;
document.getElementById('formu').action=url1;

}

</script>

<div class="content-wrapper">
  <style>

   @import url('https://fonts.googleapis.com/css?family=Montserrat');
  .cont_cajas_btnMM{
    width: 100%;
    height: auto;
    display: flex;
    justify-content: space-around;
  }
  .cont_cajas_peque2 input{
    height: 30px;
    width: 100px;
    padding: 0;
  }
  #tabla3 tr:nth-child(even){/*iluminar las celdas par*/
    	background:#ffffff;
    }
  #tabla3 tr:hover td{
    	background-color:#ffffff;
    	color: #000;
    }
    #tabla3 th,#tabla3 td{
      color: #000;
      	border: 1px solid #dbd6d6;
        margin: 0;
        padding: 0;
      }
  #tabla3{
    margin-top: 15px;
  	border-collapse: collapse;
  }
  #tabla3 td{
    color: #ffffff;
  }
  .tb3td{
    margin-top: -20px;
  }
  </style>
  <section class="content-header">
    <h1>Administrar Liquidación de Ruta #<?php echo $row2['num_ruta']; ?></h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="asignar_pago_liquidacion.php?id=<?php echo $idRB; ?>"><i class="fa fa-list-ul"></i> Administrar Liquidación</a></li>
      <li class="active">Editar Liquidación</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="modal-dialog" style="border:1px solid rgb(175, 175, 175)">
          <div class="modal-content">
            <form role="form" action="" id="formu" method="post" enctype="multipart/form-data">
              <!--========== CABEZA DEL MODAL =================-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <h4 class="modal-title">Editar Pago Ruta #<?php echo $row2['num_ruta']." - ".$row2['descrip'].": ".$row2['nombre']; ?></h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Institución"><i class="fas fa-university"></i></span>
                      <input type="text" class="form-control input-lg" name="institucion" value="<?php echo $row2['descrip'].": ".$row2['nombre']; ?>" id="institucion" placeholder="Ingresar Institución" readonly required>
                    </div>
                  </div>
                <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Sector"><i class="far fa-map"></i></span>
                      <input type="text" class="form-control input-lg" name="sector" value="<?php echo $row2['sector']; ?>" id="sector" placeholder="Ingresar Sector" readonly required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Conductor"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" name="conductor" value="<?php echo $row2['nombres']." ".$row2['apellidos']; ?>" id="conductor" placeholder="Ingresar Conductor" readonly required>
                    </div>
                  </div>
                </div>


                <div class="conten_cajas">

                 <div class="form-group">
                   <div class="input-group">
                     <span class="input-group-addon" title="Pasajeros"><i class="fa fa-user-tie"></i></span>
                     <select class="form-control input-lg" name="pasajero" id="pasajero" required><option value="">Pasajeros</option>
                       <?php $mesact=date('m'); $consulta4=mysqli_query($con,"SELECT * from personas P inner join rutas_personas RP on RP.id_personas=P.id_personas inner join clientes C on C.id_clientes=P.id_clientes inner join pago_clientes PC on PC.id_clientes=C.id_clientes where RP.id_ruta='$id_R' and PC.mes='$mesact'");
                         while($row4=mysqli_fetch_array($consulta4)){
                         if($row4['id_personas']==$row3['id_personas']){$sel="selected='selected'";}else{$sel="";}
                         echo "<option ".$sel."value='".$row4['id_personas']."'>"; echo $row4['nombre']." ".$row4['apellido']; echo "</option>"; } ?> </select>
                   </div>
                 </div>
                 <div class="form-group">
                   <div class="input-group">
                     <span class="input-group-addon" title="Servicio"><i class="fas fa-location-arrow"></i></span>
                     <input type="mail" class="form-control input-lg" name="servicio" id="servicio" placeholder="Ingresar Servicio" readonly required>
                   </div>
                 </div>
                </div>
                <div class="conten_cajas">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Nº Factura"><i class="fas fa-sort-numeric-up"></i></span>
                      <input type="mail" class="form-control input-lg" name="nfactu" id="nfactu" placeholder="Ingresar Nº Factura" readonly required>
                    </div>
                  </div>
                 <div class="form-group">
                   <div class="input-group">
                     <span class="input-group-addon" title="Valor pagado por Cliente"><i class="fas fa-coins"></i></span>
                     <input type="mail" class="form-control input-lg" name="valor" id="valor" placeholder="Valor pagado por Cliente" readonly required>
                   </div>
                 </div>
                </div>

                <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Descripción Factura"><i class="far fa-file-alt"></i></span>
                      <input type="mail" class="form-control input-lg" name="descripcion" id="descripcion" placeholder="Descripción Factura" readonly required>
                    </div>
                  </div>
                <div class="form-group"></div>
                </div>


                <hr>
                <div class="cont_cajas_btnMM">
                <div class="cont_cajas_peque2">
                  <input type="button" value="Agregar" class="btn btn-default" onclick="agregar()" title="Agregar">
                </div>
                <div class="cont_cajas_peque2">
                  <input type="button" value="Quitar"class="btn btn-default" onclick="borrarUltima()" title="Quitar">
                </div>
                </div>
                <table id="tabla3" class="table">
                <tr>
                    <th><center><i><b>Mes</b></i></center></th>
                    <th><center><i><b>Pago</b></i></center></th>
                </tr>
                <tr>
                  <?php
                  $j=0;
                  $consu9=mysqli_query($con,"SELECT * from detalle_pago_liquidacion  WHERE id_pago_liquidacion='$id_liq' ");
                  while($row9=mysqli_fetch_array($consu9)){
                   ?>
                    <td>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="Seleccionar Mes"><i class="fas fa-calendar-alt"></i></span>
                      <select name="mes<?php echo $j; ?>" id="mes<?php echo $j; ?>" class="form-control input-lg" onchange="calculo()" required>
                        <option  value="">Mes</option>
                        <option <?php if("01"==$row9['mes']){echo 'selected="selected"';} ?> value="01">Enero</option>
                        <option <?php if("02"==$row9['mes']){echo 'selected="selected"';} ?> value="02">Febrero</option>
                        <option <?php if("03"==$row9['mes']){echo 'selected="selected"';} ?> value="03">Marzo</option>
                        <option <?php if("04"==$row9['mes']){echo 'selected="selected"';} ?> value="04">Abril</option>
                        <option <?php if("05"==$row9['mes']){echo 'selected="selected"';} ?> value="05">Mayo</option>
                        <option <?php if("06"==$row9['mes']){echo 'selected="selected"';} ?> value="06">Junio</option>
                        <option <?php if("07"==$row9['mes']){echo 'selected="selected"';} ?> value="07">Julio</option>
                        <option <?php if("08"==$row9['mes']){echo 'selected="selected"';} ?> value="08">Agosto</option>
                        <option <?php if("09"==$row9['mes']){echo 'selected="selected"';} ?> value="09">Septiembre</option>
                        <option <?php if("10"==$row9['mes']){echo 'selected="selected"';} ?> value="10">Octubre</option>
                        <option <?php if("11"==$row9['mes']){echo 'selected="selected"';} ?> value="11">Noviembre</option>
                        <option <?php if("12"==$row9['mes']){echo 'selected="selected"';} ?> value="12">Diciembre</option>
                    </select>
                  </div>
                </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" title="valor a pagar"><i class="fas fa-coins"></i></span>
                          <input type="text" class="form-control input-lg" onchange="calculo()" name="pago<?php echo $j; ?>" id="pago<?php echo $j; ?>" value="<?php echo $row9['valor']; ?>" placeholder="Ingresar valor a pagar" maxlength="6" required onkeypress="return solonumeros(event)">
                        </div>
                      </div>
                    </td>
                </tr>
                <script type="text/javascript">
                  var indic='<?php echo $j; ?>';
                  contLin=parseInt(indic);
                  localStorage.setItem("conta_tb",contLin);
                </script>
              <?php $j++; } ?>

                </table>

                <div class="conten_cajas">
                <div class="form-group"></div>
                <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control input-lg" name="total" id="total" placeholder="Total a Pagar" maxlength="6" required onkeypress="return solonumeros(event)" readonly>
                </div>
                </div>
                </div>


                  <!-- ENTRADA -->

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Liquidación</button>
                <a href="asignar_pago_liquidacion.php?id=<?php echo $idRB; ?>"><button type="button" class="btn btn-default">Salir</button></a>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>


    </div>
  </section>
</div>

<!--=====================================
MODAL FIN
======================================-->
<script>

var id_rutap='<?php echo $id_R; ?>';
 var id_per='<?php echo $id_perso; ?>';

  var dtid1="idp="+id_per+"&idr="+id_rutap;
  buscar_cedula(dtid1);



function buscar_cedula(consulta){
  $.ajax({
    url: 'ajax_dt_pago_cliente.php',
    type: 'POST',
    dataType: 'html',
    data:consulta,
  })
  .done(function(respuesta){

    if(respuesta!=""){
       var dat_cli=respuesta.split('**');
       document.getElementById('servicio').value=dat_cli[0];
       document.getElementById('nfactu').value=dat_cli[1];
       document.getElementById('valor').value=dat_cli[2];
       document.getElementById('descripcion').value=dat_cli[3];
       // var link="guardar_pago_cliente.php?id="+dat_cli[4];
       // document.getElementById('formu').action=link;

    }else{
      document.getElementById('servicio').value="";
      document.getElementById('nfactu').value="";
      document.getElementById('valor').value="";
      document.getElementById('descripcion').value="";
    }

  })
  .fail(function(){
    console.log("error")
  })
}
$(document).on('change','#pasajero', function(e){
  var valr= $(this).val();

  if(valr!=""){
    var dtid="idp="+valr+"&idr="+id_rutap;
    buscar_cedula(dtid);
  }
});


</script>


<?php include 'footer.php'; ?>
<script type="text/javascript">

  calculo();
</script>
