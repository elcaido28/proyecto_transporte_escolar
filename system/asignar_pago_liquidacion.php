<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
$idRB=$_REQUEST['id'];
$consul=mysqli_query($con,"SELECT * from rutas_bus RB inner join ruta R on R.id_ruta=RB.id_rutas inner join buses B on B.id_buses=RB.id_bus inner join institucion I on I.id_institucion=B.id_institucion inner join empleados E on E.id_empleados=B.conductor where id_rutas_bus='$idRB'");
$row2=mysqli_fetch_array($consul);
$id_R=$row2['id_ruta'];
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
var url1='guardar_pago_liquidacion.php?cont='+con+'&idr='+idr+'&idrb='+idrb;
document.getElementById('formu').action=url1;

}

</script>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Liquidación de Ruta #<?php echo $row2['num_ruta']; ?> </h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Liquidación</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Pago de Liquidación </button>
          <a href="ingreso_liquidaciones.php"><button type="button" class="btn btn-default">Salir</button></a>
      </div>


      <div class="box-header with-border">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"> Nueva Persona </button> -->
      </div>


      <div class="box-body cont_tabla">
        <div class="accordion">
          <?php
            $consult1=mysqli_query($con,"SELECT * from pago_liquidacion where id_ruta='$id_R' order by mespago ASC ");
            while($row1=mysqli_fetch_array($consult1)){
              $mesl=$row1['mespago'];
              $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            ?>
          <div class="accordion-item">
            <div class="accordion-item-header">
              <?php echo $meses[$mesl-1]; ?>
            </div>
            <div class="accordion-item-body" style="max-height: 370px;">
              <div class="accordion-item-body-content">






                <table id="tabla" class="display" style="width:100%">
                  <thead>
                   <tr>
                     <th>Ver Más</th>
                     <th>Nombres</th>
                     <th>Telefono</th>
                     <th>Total</th>
                     <th>Acciones</th>
                   </tr>
                  </thead>
                  <?php
                  $arraymes=[];
                  $arraypago=[];
                    $consu7=mysqli_query($con,"SELECT *,C.telefono telefo from rutas_personas RP inner join personas P on P.id_personas=RP.id_personas inner join clientes C on C.id_clientes=P.id_clientes WHERE RP.id_ruta='$id_R' ");
                    while($row7=mysqli_fetch_array($consu7)){
                      $id_per=$row7['id_personas'];
                      $consu8=mysqli_query($con,"SELECT * from pago_liquidacion WHERE id_ruta='$id_R' and id_personas='$id_per'");
                      $nrow8=mysqli_num_rows($consu8);
                      if ($nrow8>0) {
                        $row8=mysqli_fetch_array($consu8);
                        $totalpagado=$row8['total'];
                        $id_liq=$row8['id_pago_liquidacion'];

                        $i=0;
                        $consu9=mysqli_query($con,"SELECT * from detalle_pago_liquidacion WHERE id_pago_liquidacion='$id_liq' ");
                        while($row9=mysqli_fetch_array($consu9)){
                          $arraymes[$i]=$row9['mes'];
                          $arraypago[$i]=$row9['valor'];

                          $i++;
                        }
                      }else{
                        $arraymes=[];
                        $arraypago=[];
                        $totalpagado='0.00';
                        $id_liq="";
                        $arraymes[0]="-";
                        $arraypago[0]="0.00";
                      }

                  ?>
                      <tr>
                        <td class="details-control" data-mes='<?php echo json_encode($arraymes); ?>' data-valor='<?php echo json_encode($arraypago); ?>'  ></td>
                        <td><?php echo $row7['nombre']." ".$row7['apellido']; ?></td>
                        <td><?php echo $row7['telefo']; ?> </td>
                        <td><?php echo $totalpagado; ?> </td>

                        <td><div class="btn-group">
                          <a href="<?php if($totalpagado>0){ ?>editar_pago_liquidacion.php?idliq=<?php echo $id_liq."&idrb=".$idRB; }else{ echo "#"; } ?>"> <button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                        </div></td>
                      </tr>

                    <?php } ?>
                    </table>

                  <script>

                function format (d1,d2) {
                    var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                    var dt_retorno='';
                    var dtm = JSON.parse(d1);
                    var dtv = JSON.parse(d2);

                    dt_retorno += '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">'+
                        '<tr>'+
                            '<td colspan="5" align="center">Detalle del Pago</td>'+
                        '</tr>';

                    for (var i = 0; i < dtm.length; i++) {
                      if (dtm[i]=="-") {
                        var valmes="-";
                      }else{
                        var valmes=meses[parseInt(dtm[i]) -1];
                      }
                        dt_retorno +=  '<tr>'+
                            '<td>MES: </td>'+
                            '<td>'+valmes+'</td>'+
                            '<td>VALOR: </td>'+
                            '<td>'+dtv[i]+'</td>'+
                          '</tr>';
                      }

                  dt_retorno +=  '</table>';
                  return dt_retorno;
                }

                $(document).ready(function() {
                    var table = $('#tabla').DataTable( { } );

                    // Add event listener for opening and closing details
                    $('#tabla tbody').on('click', 'td.details-control', function (e) {
                        var tr = $(this).closest('tr');
                        var row = table.row( tr );
                        var m= this.dataset.mes;
                        ;
                        var v= this.dataset.valor;

                        if ( row.child.isShown() ) {
                            // This row is already open - close it
                            row.child.hide();    //row.child().css({"background": "blue"});
                            tr.removeClass('shown');
                        }else {
                            // Open this row
                            row.child(format(m,v)).show();
                            tr.addClass('shown');
                        }
                    } );
                } );

                  </script>















              </div>

            </div>
          </div>
        <?php } ?>

        </div>


      </div>
    </div>
  </section>
</div>
<script src="https://unpkg.com/web-animations-js@2.3.2/web-animations.min.js"></script>
<script src="https://unpkg.com/muuri@0.8.0/dist/muuri.min.js"></script>

<script type="text/javascript">
const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");
accordionItemHeaders.forEach(accordionItemHeader => {
accordionItemHeader.addEventListener("click", event => {

accordionItemHeader.classList.toggle("active");
const accordionItemBody = accordionItemHeader.nextElementSibling;
if(accordionItemHeader.classList.contains("active")) {
  accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
}
else {
  accordionItemBody.style.maxHeight = 0;
}

});
});
</script>
<style>
td.details-control {
  background-image: url('img/details_open.png');
  background-repeat: no-repeat;
  background-position: center;
  cursor: pointer;
}
tr.shown td.details-control {
  background-image: url('img/details_close.png');
  background-repeat: no-repeat;
  background-position: center;
}
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

#tabla4 tr:nth-child(even){/*iluminar las celdas par*/
  	background:#ffffff;
  }
#tabla4 tr:hover td{
  	background-color:#ffffff;
  	color: #000;
  }
  #tabla4 th,#tabla4 td{
    color: #000;
    	border: 1px solid #dbd6d6;
      margin: 0;
      padding: 0;
    }
#tabla4{
  margin-top: 15px;
	border-collapse: collapse;
}
#tabla4 td{
  color: #000;
}

.tb3td{
  margin-top: -20px;
}
</style>




<!--=====================================
MODAL AGREGAR RUTA
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" action="" id="formu" method="post" enctype="multipart/form-data">
        <!--========== CABEZA DEL MODAL =================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Pago Ruta #<?php echo $row2['num_ruta']."   -   ".$row2['descrip'].": ".$row2['nombre']; ?></h4>
        </div>

        <!--============= CUERPO DEL MODAL ===================-->

        <div class="modal-body">
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
                 <?php $consulta4=mysqli_query($con,"SELECT * from personas P inner join rutas_personas RP on RP.id_personas=P.id_personas where RP.id_ruta='$id_R'");
                   while($row4=mysqli_fetch_array($consulta4)){
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

          <!-- <div class="conten_cajas">
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
        </div> -->
        <div class="form-group" id="tabla_factu"> </div>

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
              <td>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" title="Seleccionar Mes"><i class="fas fa-calendar-alt"></i></span>
                <select name="mes0" id="mes0" class="form-control input-lg" onchange="calculo()" required>
                  <option value="">Mes</option>
                  <option value="01">Enero</option>
                  <option value="02">Febrero</option>
                  <option value="03">Marzo</option>
                  <option value="04">Abril</option>
                  <option value="05">Mayo</option>
                  <option value="06">Junio</option>
                  <option value="07">Julio</option>
                  <option value="08">Agosto</option>
                  <option value="09">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
              </select>
            </div>
          </div>
              </td>
              <td>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" title="valor a pagar"><i class="fas fa-coins"></i></span>
                    <input type="text" class="form-control input-lg" onchange="calculo()" name="pago0" id="pago0" placeholder="Ingresar valor a pagar" maxlength="6" required onkeypress="return solonumeros(event)">
                  </div>
                </div>
              </td>
          </tr>
        </table>

        <div class="conten_cajas">
        <div class="form-group"></div>
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control input-lg" name="total" id="total" placeholder="Total a Pagar" maxlength="6" required onkeypress="return solonumeros(event)" readonly>
          </div>
        </div>
      </div>


          </div>
        </div>
        <!--========== PIE DEL MODAL ==============-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Liquidación</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL FIN
======================================-->

<script type="text/javascript">
$(document).on('keyup','#titulo', function(){
    var valr= $('#titulo').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('titulo').value=texto;
    }
});

$(document).on('keyup','#descrip', function(){
    var valr= $('#descrip').val();
    if(valr!=""){
       var texto = MaysPrimera(valr);
       //var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('descrip').value=texto;
    }
});
</script>

<script>
var id_rutap='<?php echo $id_R; ?>';
// var id_rutaper='<?php echo $idRB; ?>';

$(buscar_cedula());

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
       // document.getElementById('nfactu').value=dat_cli[1];
       // document.getElementById('valor').value=dat_cli[2];
       // document.getElementById('descripcion').value=dat_cli[3];
       // var link="guardar_pago_cliente.php?id="+dat_cli[4];
       // document.getElementById('formu').action=link;
       $('#tabla_factu').html(dat_cli[1]);


    }else{
      document.getElementById('servicio').value="";
      // document.getElementById('nfactu').value="";
      // document.getElementById('valor').value="";
      // document.getElementById('descripcion').value="";
    }


  })
  .fail(function(){
    console.log("error")
  })
}
$(document).on('change','#pasajero', function(e){
  var valr= $(this).val();
  if(valr!=""){
    dtid="idp="+valr+"&idr="+id_rutap;
    buscar_cedula(dtid);
  }
});
</script>

<?php include 'footer.php'; ?>
