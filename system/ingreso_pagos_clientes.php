<?php
include('cabecera.php');
include('conexion.php');
include('menu.php');
?>
<link rel="stylesheet" href="css/jquery-ui.min.css">
<script src="js/jquery-ui.min.js" charset="utf-8"></script>
<div class="content-wrapper">

  <section class="content-header">
    <h1>Administrar Pagos De Clientes</h1>
    <ol class="breadcrumb">
      <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Pagos De Clientes</li>
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
                <h4 class="modal-title">Ingresar Pago De Cliente</h4>
              </div>

              <!--============= CUERPO DEL MODAL ===================-->

              <div class="modal-body" >
                <div class="box-body">
                  <!-- ENTRADA  -->

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Ingresar nombre de cliente a buscar"><i class="fas fa-search"></i></span>
                      <input type="text" class="form-control input-lg" name="busqueda" id="busqueda" autocomplete="off" placeholder="Ingresar Busqueda &#128270;">
                    </div>
                  </div>

                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Nombres"><i class="fas fa-user-tie"></i></span>
                        <input type="text" class="form-control input-lg" name="nombres" id="nombres"  placeholder="Nombres" required readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Identificación"><i class="fas fa-address-card"></i></span>
                        <input type="text" class="form-control input-lg" name="identificacion" id="identificacion"  placeholder="Identificación" required readonly>
                      </div>
                    </div>

                  </div>
                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Dirección"><i class="fas fa-map-marked-alt"></i></span>
                        <input type="text" class="form-control input-lg" name="direccion" id="direccion"  placeholder="Dirección" required readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Descripción"><i class="far fa-file-alt"></i></span>
                        <input type="text" class="form-control input-lg" name="descrip" id="descrip"  placeholder="Descripción" required readonly>
                      </div>
                    </div>

                  </div>
                  <!-- ENTRADA -->
                  <hr>
                  Datos Factura

                  <div class="conten_cajas">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="numero de factura"><i class="fas fa-sort-numeric-up"></i></span>
                        <input type="text" class="form-control input-lg" name="nfactura" id="nfactura"  placeholder="Numero de factura" autocomplete="off" onkeypress="return solonumeros(event)" required >
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon" title="Valor a Pagar"><i class="fas fa-coins"></i></span>
                        <input type="text" class="form-control input-lg" name="valorp" id="valorp"  placeholder="Ingresar Valor a Pagar" maxlength="6" onkeypress="return solonumeros(event)" required >
                      </div>
                    </div>
                  </div>

                  <div class="conten_cajas">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Mes"><i class="fas fa-calendar-alt"></i></span>
                      <select class="form-control input-lg" name="mes" required><option value="">Mes</option>
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
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon" title="Forma de Pago"><i class="fas fa-comment-dollar"></i></span>
                      <select class="form-control input-lg" name="formap" required><option value="">Forma de Pago</option>
                        <option value="1">Efectivo</option>
                        <option value="2">Cheque</option>
                        <option value="3">Transferencia</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon" title="Descripción"><i class="far fa-file-alt"></i></span>
                    <input type="text" class="form-control input-lg" name="descrip2" id="descrip2"  placeholder="Descripción" required >
                  </div>
                </div>

              </div>
              <!--========== PIE DEL MODAL ==============-->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Pago</button>
                <a href="ingreso_pagos_clientes.php"><button type="button" class="btn btn-default">Cancelar</button></a>
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

<!-- <script type="text/javascript">
$(document).on('keyup','#nombre', function(){
    var valr= $('#nombre').val();
    if(valr!=""){
       // var texto = MaysPrimera(valr.tolowerCase());
       var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
       // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        document.getElementById('nombre').value=texto;
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
</script> -->

<?php include 'footer.php'; ?>





<?php
  $result = mysqli_query($con,"SELECT * FROM clientes where id_estado='1'");
  $array = array();
  if($result){
    while ($row = mysqli_fetch_array($result)) {
      $equipos = utf8_encode($row['id_clientes']."-".$row['nombres']." ".$row['apellidos']);
      $equipo = utf8_decode($equipos);
      array_push($array, $equipo); // equipos
    }
  }
?>
<script type="text/javascript">
  $(document).ready(function () {
    var items = <?= json_encode($array); ?>;

    $("#busqueda").autocomplete({
      source: items,
      select: function (event, item) {
        var params = {
          equipo: item.item.value
        };
        $.get("getbusquecli.php", params, function (response) {
          var json = JSON.parse(response);
          if (json.status == 200){
          }else{

          }
        }); // ajax
        var dtid = params['equipo'].split("-");
        //var url2='report/reporte_vp_cliente.php?id='+dtid[0];
	    // document.getElementById('formix').action=url2;
       document.getElementById('busqueda').setAttribute("data-id", dtid[0]);

      }
    });
  });
</script>
<script>
$(buscar_cedula());

function buscar_cedula(consulta){
  $.ajax({
    url: 'ajax_busca_cliente.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: consulta},
  })
  .done(function(respuesta){
    if(respuesta!=""){
      var dat_cli=respuesta.split('**');
       document.getElementById('nombres').value=dat_cli[0];
       document.getElementById('identificacion').value=dat_cli[1];
       document.getElementById('direccion').value=dat_cli[2];
       document.getElementById('descrip').value=dat_cli[3];
       var link="guardar_pago_cliente.php?id="+dat_cli[4];
       document.getElementById('formu').action=link;

    }
    // document.getElementById('cedula').value=respuesta;
  })
  .fail(function(){
    console.log("error")
  })
}
$(document).on('change','#busqueda', function(e){
  var valr= this.dataset.id;
  if(valr!=""){
    buscar_cedula(valr);
  }
});
</script>
