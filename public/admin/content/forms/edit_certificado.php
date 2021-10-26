<?php 
require_once('../../includes/load.php');
require_once('../../includes/functions/editar_certificados.php');   
$obra_id = $_POST['obra_id'];
$cert_id = $_POST['cert_id'];
$obra = find_by_id('obras','idobras',(int)$_POST['obra_id']); 
$certificadocero = existe_certificado_anticipo($obra_id);
$certificado = info_certificado($cert_id);

$ultimo_certificado = ultimo_certificado_obra_aprobado($obra_id);
$items = listar_obras_items($obra_id); 
$planoficial = listar_planoficial_obras($obra_id); 
$descuentos = listar_descuentoscertificados();
$modificaciones_de_obra =  modificaciones_de_obra($obra['idobras']);
$ampliaciones_de_obra =  ampliaciones_de_obra($obra['idobras']);
$anticipos_acumulados = sumar_anticipo('descuento_anticipo','certificados_obras',$obra_id);
?>
<div class="row justify-content-center" id="nuevo_certificados">
  <div class="col-11">
    <div class="card">

      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
<!--<?php if($obra['anticipo_financiero'] == 1 && empty($certificadocero)){ ?>
          <div class="mr-auto my-auto mr-3">
            <a id="aplica_anticipo" style="color:blue;border-radius:50px;border:1px solid blue;padding:10px;">Anticipo financiero</a>
          </div>    
<?php } ?>-->
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_certificado()" title="Cerrar" data-toggle="tooltip" style="color:red;"><i class="fas fa-times"></i> Cancelar</a>
          </div>
        </div>
      </div>
      <div class="card-body cards-titulo">   
         <center>
            PROVINCIA DE ENTRE RIOS<br>
            MINISTERIO DE PLANEAMIENTO, INFRAESTRUCTURA Y SERVICIOS<br>
            DIRECCIÓN PROVINCIAL DE VIALIDAD<br>
            CERTIFICADO DE OBRA POR CONTRATO
          </center>
    </div>
      <div class="card-body">
        <form method="post" action="certificados" id="form_agregar_certificado">
            <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    EXPEDIENTE Nº: <?php echo $obra['expediente']; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <center>
                    <span id="texto_nro_cert">CERTIFICADO Nº:</span> <input type="text" style="width:40px;border:none;" name="numero_certificado_edit" id="nro_cert" min="0" value="<?php echo $certificado['numero']; ?>" readonly required> <input type="text" name="idcertificado" value="<?php echo $certificado['idcertificados_obras']; ?>" hidden>
<input name="certificado_vencimiento" type="number" id="certificado_vencimiento" value="<?php echo $obra['certificado_vencimiento']; ?>" hidden><span id="respuesta_numero"></span>
                    </center>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row p-10">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <h3><center>
                    DENOMINACION: <?php echo $obra['nombre']; ?>
                    </center></h3>
                  </div>
                </div>
              </div>
            </div>
        </div>
    <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    APROBACION PROYECTO <?php if($obra['aprobacion_res_fecha'] != '0000-00-00' && $obra['aprobacion_res_fecha'] != NULL){ echo format_date($obra['aprobacion_res_fecha']); }else{'';} ?> RES. <?php if(!empty($obra['aprobacion_res_num'])){ echo $obra['aprobacion_res_num']; } else {echo '';} ?>
                  </div>
                </div>
              </div>
            </div>
             <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <center>
                    ADJUDICACION <?php if($obra['adjudicacion_res_fecha'] != '0000-00-00' && $obra['adjudicacion_res_fecha'] != NULL){ echo format_date($obra['adjudicacion_res_fecha']); }else{'';} ?> RES. <?php if(!empty($obra['adjudicacion_res_num'])){ echo $obra['adjudicacion_res_num'];} else{echo '';} ?>
                    </center>
                  </div>
                </div>
              </div>
            </div> 
        </div>
        <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    CONTRATISTA: <?php echo $obra['contratista']; ?>
                  </div>
                </div>
              </div>
            </div> 
                         <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <center>
                    FECHA COMIENZO OBRA: <?php if($obra['fecha_inicio'] != '0000-00-00' && $obra['fecha_inicio'] != NULL){ echo format_date($obra['fecha_inicio']); } else { echo ''; } ?>      
                    </center>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    FECHA DE CONTRATO: <?php if($obra['contrato_fecha'] != '0000-00-00' && $obra['contrato_fecha'] != NULL){ echo format_date($obra['contrato_fecha']);} else { echo ''; } ?>
                  </div>
                </div>
              </div>
            </div> 

        </div>
        <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    IMPORTE DE CONTRATO: <?php echo '$ '.numero($obra['monto_vigente']); /*
                    if(!empty($modificaciones_de_obra)){ foreach ($modificaciones_de_obra as $mod):
                      if(!empty($mod['resolucion_numero'])){
                      echo '<br>'.$mod['numero'].' MODIFICACION DE MONTO: $ '.$mod['monto_final']; 
                    }
                    endforeach ;}*/
                      ?>
                  </div>
                </div>
              </div>
            </div>
              
            </div> 
            <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    PLAZO DE EJECUCION: <?php echo $obra['plazo_vigente'].' '; /*if(!empty($ampliaciones_de_obra)){ foreach($ampliaciones_de_obra as $amp): if(!empty($amp['resolucion_numero'])){ echo '+ '.$amp['plazo']; } endforeach; } */?>
                  </div>
                </div>
              </div>
            </div>
                           <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center" id="plazo_transcurrido_anticipo">
                    <center>
                    PLAZO TRANSCURRIDO: <?php echo $obra['certificado_plazo']; ?>       
                    </center>
                  </div>
                </div>
              </div>
            </div>  
            </div>
            <div class="row p-10">

          
             <div class="col-lg-7 col-md-7 col-sm-12" >
               <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row" id="fecha_medicion_anticipo">
                    FECHA DE MEDICION: <input type="date" style="border:none;" name="fecha_medicion" value="<?php echo $certificado['fecha_medicion']; ?>" readonly >
                  </div>
                </div>
              </div>
            </div>  

              <?php if(empty($obra['certificado_vencimiento'])){ ?>
                <div class="col-lg-5 col-md-5 col-sm-12">
            <center>Falta vencimiento s/pliegos</center>
            </div><?php }else{ ?>  
            <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <center>
                    CORRESPONDE AL MES DE 
                    <select style="width:85px;border:none;" name="month" id="month" readonly>
                    <?php
                    if($certificado['month'] == 1){ echo '<option value="1" selected>Enero</option>'; }
                    if($certificado['month'] == 2){ echo '<option value="2" selected>Febrero</option>'; }
                    if($certificado['month'] == 3){ echo '<option value="3" selected>Marzo</option>'; }
                    if($certificado['month'] == 4){ echo '<option value="4" selected>Abril</option>'; }
                    if($certificado['month'] == 5){ echo '<option value="5" selected>Mayo</option>'; }
                    if($certificado['month'] == 6){ echo '<option value="6" selected>Junio</option>'; }
                    if($certificado['month'] == 7){ echo '<option value="7" selected>Julio</option>'; }
                    if($certificado['month'] == 8){ echo '<option value="8" selected>Agosto</option>'; }
                    if($certificado['month'] == 9){ echo '<option value="9" selected>Septiembre</option>'; }
                    if($certificado['month'] == 10){ echo '<option value="10" selected>Octubre</option>'; }
                    if($certificado['month'] == 11){ echo '<option value="11" selected>Noviembre</option>'; }
                    if($certificado['month'] == 12){ echo '<option value="12" selected>Diciembre</option>'; }
                    ?>
                    </select> DE <input type="number" style="width:55px;border:none;" name="year" id="year" min="0" value="<?php echo $certificado['year']; ?>" readonly> 
                    </center>
                  </div>
                </div>
              </div>
            </div> 
          <?php } ?>
        </div>
           
            <br><br>
    <div class="table-responsive" id="div_tabla_items">
            
            <table class="table table-bordered" id="tabla_items">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th colspan="3"scope="col" style="text-align:center;">CANTIDADES CERTIFICADAS</th>
      <th scope="col" ></th>
      <th scope="col" ></th>
      <th scope="col" ></th>
    </tr>
    <tr>
      <th colspan="2" scope="col">ITEM</th>
      <th rowspan="2" scope="col">DESIGNACION</th>
      <th rowspan="2" scope="col">UNIDAD DE MEDIDA</th>
      <th scope="col">PRESENTE CERTIFICADO</th>
      <th scope="col">TOTAL HASTA CERT. ANTERIOR</th>
      <th scope="col">TOTAL INCLUYENDO PRESENTE CERT.</th>
      <!--<th scope="col">CANT. APROBADAS</th>-->
      <th rowspan="2"scope="col" >PRECIO UNITARIO</th>
      <th rowspan="2"scope="col" >IMPORTE</th>
    </tr>    
  </thead>
  <tbody>
    <?php  
    foreach($items as $item): 

    ?>
    <?php if($item['unidad'] == 'No define'){ ?>
    <tr>
      <td><input value="<?php echo $item['idobras_items']; ?>" type="text" name="idobras_items[]" hidden><?php echo $item['item']; ?></td>
      <td></td>
      <td><?php echo $item['descripcion']; ?></td>
      <td></td>
      <td><input type="number" name="cantidad[]" value="0.000" hidden><input type="text" name="disponibles[]" value="0.000" hidden></td>
      <td><input type="number" name="cantidad_acumulada[]" hidden><input type="number" name="cantidad_aprobada[]" hidden ></td>
      <!--<td></td>-->
      <td><input type="number" hidden name="total_individual_acumulado[]" value="0.000"></td>
      <td></td>      
      <td></td>
    </tr>
  <?php }else{ 


$u_i = ultimo_item_certificado($ultimo_certificado['idcertificados_obras'],$item['idobras_items']);
$certificado_items = info_items_certificado($cert_id,$item['idobras_items']);
    ?>
        <tr id="trindi">
      <td><input value="<?php echo $item['idobras_items']; ?>" type="text" name="idobras_items[]" hidden><?php echo $item['item']; ?></td>
      <td><?php echo $item['sub_item']; ?></td>
      <td><?php echo $item['descripcion']; ?></td>
      <td><?php echo $item['unidad']; ?><input value="<?php echo $item['unidad']; ?>" type="text" name="unidad[]" hidden></td>
      <td><input type="number" value="<?php echo $certificado_items['cantidad']; ?>" onKeyUp="if(this.value><?php echo ($item['cantidad_aprobada']-$certificado_items['cantidad_acumulada'])+$certificado_items['cantidad']; ?>){this.value='<?php echo ($item['cantidad_aprobada']-$certificado_items['cantidad_acumulada'])+$certificado_items['cantidad']; ?>';}else if(this.value<0){this.value='0.000';}" name="cantidad[]" style="width:80px;" min="0.000" id="valor_nuevo_acumulado" max="<?php if(!empty($ultimo_certificado['idcertificados_obras'])){ echo ($item['cantidad_aprobada']-$certificado_items['cantidad_acumulada'])+$certificado_items['cantidad']; } else {echo $item['cantidad_aprobada'];} ?>">
      <input value="<?php if(!empty($ultimo_certificado['idcertificados_obras'])){ echo ($item['cantidad_aprobada']-$u_i['cantidad']); }else{ echo $item['cantidad_aprobada']; } ?>" type="number" name="disponibles[]" hidden></td>
      <td>
        <input type="number" readonly value="<?php echo ($certificado_items['cantidad_acumulada']-$certificado_items['cantidad']); ?>" style="width:70px;border:none" value="<?php if(!empty($u_i)){ echo $u_i['cantidad_acumulada']; }else { echo '0.000'; } ?>" max="<?php echo $item['cantidad_aprobada']; ?>" name="cantidad_acumulada[]">
        <input type="number" readonly name="cantidad_aprobada[]" value="<?php echo $item['cantidad_aprobada']; ?>" hidden ></td>



      <td><input type="number" readonly style="width:70px;border:none" name="total_individual_acumulado[]" max="<?php echo $item['cantidad_aprobada']; ?>" value="0.000"></td>
      <!--<td><input type="number" disabled step="0.001" name="cantidad_aprobada[]" value="<?php echo $item['cantidad_aprobada']; ?>"> </td>-->
      <td><input type="number" readonly name="precio_unitario_items[]" value="<?php echo $item['precio_unitario']; ?>" style="border:none" ></td>      
      <td><input type="number" readonly name="importe[]" class="importe" style="border:none"><input type="number" readonly hidden step="0.001" name="importe_total[]" class="importe_total"></td>
    </tr>   
    <?php  } endforeach; ?>
    <tr>
      <td><b><span stlye="font-weight:600;">TOTAL</span></b></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

      <!--<td></td>-->

      <td></td>
      <td></td>      
      <td><input type="number"  id="sum_total" name="total_importe" style="border:none;" readonly/></td>
    </tr>
  </tbody>
</table>
      </div>
      <div class="row justify-content-center" id="avance_de_obra">

      <div class="col-8">
        <div class="card-body cards-titulo">   
         <center>
            AVANCE DE OBRA
          </center>
    </div>
<br>

    <div class="table-responsive">
    <table class="table" >
<tbody>
<tr>
<td style="border:1px solid #000">MONTO TOTAL APROBADO</td>
<td style="border:1px solid #000" ><input type="number" name="monto_total_aprobado" id="monto_total_aprobado" readonly style="width:80%;border:none;" value="<?php echo $obra['contrato_monto']; ?>"></td>
<td style="border:1px solid #000;width:20%;"><input type="text" value="100" readonly style="width:60%;border:none;"> %</td>
</tr>
<tr>
<td style="border:1px solid #000">OBRA EJECUTADA</td>
<td style="border:1px solid #000"><input type="number" name="obra_ejecutada" id="obra_ejecutada" style="width:80%;border:none;" readonly></td>
<td style="border:1px solid #000;width:20%;"><input type="text" name="porc_obra_ejecutada" id="porc_obra_ejecutada" readonly style="width:60%;border:none;"> %</td>
</tr>
<tr>
<td style="border:1px solid #000">OBRA PREVISTA S/PLAN</td>
<td style="border:1px solid #000"><input type="text" name="obra_prevista" style="width:80%;border:none;" id="monto_planoficial" readonly></td>
<td style="border:1px solid #000;width:20%;"><input type="text" style="width:60%;border:none;" id="avance_planoficial" name="avance_planoficial" readonly> %</td>
</tr>
<tr>
<td style="border:1px solid #000">ATRASO O ADELANTO</td>
<td style="border:1px solid #000"><input type="number" name="atraso_adelanto" id="atraso_adelanto"  style="width:100%;border:none;" readonly></td>
<td style="border:1px solid #000;width:20%;"></td>
</tr>
<tr>
<td style="border:1px solid #000">PLAZO CONTRACTUAL</td>
<td style="border:1px solid #000"><input type="text" name="plazo_contractual" readonly style="width:100%;border:none;" value="<?php echo $obra['contrato_plazo'].' '; if(!empty($ampliaciones_de_obra)){ foreach($ampliaciones_de_obra as $amp): if(!empty($amp['resolucion_numero'])){ echo '+ '.$amp['plazo']; } endforeach; }  ?>"></td>
<td style="border:1px solid #000;width:20%;"></td>
</tr>
<tr>
<td style="border:1px solid #000">APROBADO</td>
<td style="border:1px solid #000"><input type="text" name="plazo_aprobado" value="<?php echo $obra['plazo_vigente']?>" style="width:100%;border:none;" readonly ></td>
<td style="border:1px solid #000;width:20%;"></td>
</tr>
<tr>
<td style="border:1px solid #000">PLAZO TRANSCURRIDO</td>
<td style="border:1px solid #000"><input type="text" name="plazo_transcurrido" style="width:100%;" value="<?php echo $certificado['plazo_transcurrido']?>" required></td>
<td style="border:1px solid #000;width:20%;"></td>
</tr>
<!--<tr>
<td style="border:1px solid #000">PORCENTAJE</td>
<td style="border:1px solid #000"><input type="text" name="porcentaje_avance" style="width:100%;" required></td>
<td style="border:1px solid #000;width:20%;"></td>
</tr>-->
  </tbody>
</table>
</div>    </div></div>
<div class="row justify-content-center" id="listar_descuentos">

      <div class="col-8">
      <div class="card-body cards-titulo">   
         <center>
            DESCUENTOS
          </center>
    </div>
<br>

    <div class="table-responsive">
    <table class="table table-bordered" >
<thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">DESCRIPCION</th>
      <th scope="col">VALOR</th>
      </tr>
</thead>
<tbody>
<?php foreach($descuentos as $desc): 
$descuentos_aplicados = info_descuento_certificado($cert_id,$desc['idcertificados_descuentos']);
?>
<tr>
<td class="text-center"><input <?php if(isset($descuentos_aplicados)){ echo 'checked'; } ?> type="checkbox" id="checkbox_descuento_<?php echo $desc['idcertificados_descuentos']; ?>" class="filled-in" name="descuento_aplica[]" value="<?php echo $desc['idcertificados_descuentos']; ?>"><label for="checkbox_descuento_<?php echo $desc['idcertificados_descuentos']; ?>"></label></td>
<td><?php echo $desc['descripcion']; ?></td>
<td><?php echo $desc['valor']; ?> %</td>
</tr>
<?php endforeach; ?>
  </tbody>
</table>
</div>
</div>
</div>

<?php if($obra['anticipo_financiero'] == 1){ ?>
<div class="row justify-content-center hide" id="info_anticipo">

      <div class="col-8">
      <div class="card-body cards-titulo">   
         <center>
            ANTICIPO FINANCIERO
          </center>
    </div>
<br>
    <div class="table-responsive">
    <table class="table table-bordered" >
<thead>
    <tr>
      <th scope="col">DEFINICION</th>
      <th scope="col">MONTO</th>
      <th scope="col">PORCENTAJE</th>
      </tr>
</thead>
<tbody>
<tr>
  <td>MONTO DE CONTRATO</td>
  <td><?php echo $obra['contrato_monto']; ?></td>
  <td>100%</td>
</tr>
<tr>
  <td>ANTICIPO FINANCIERO</td>
  <td><input type="number" name="monto_anticipo_financiero" value="<?php echo ($obra['contrato_monto']*$obra['valor_anticipo_financiero'])/100; ?>" readonly></td>
  <td><input type="number" name="valor_anticipo_financiero" value="<?php echo $obra['valor_anticipo_financiero']; ?>" readonly></td>
</tr>
<?php 
$monto_anticipo_acumulado = $anticipos_acumulados['total'];
$total_anticipo_financiero = ($obra['contrato_monto']*$obra['valor_anticipo_financiero'])/100;

 ?>
<tr id="anticipo_acumulado">
  <td>MONTO ACUMULADO</td>
  <td><?php echo $monto_anticipo_acumulado; ?></td>
  <td><?php echo ($monto_anticipo_acumulado*100)/$obra['contrato_monto']; ?></td>
</tr>
<tr id="anticipo_descuento">
  <td>DESCUENTO ANTICIPO</td>
  <td><input type="number" name="monto_descuento_anticipo" id="monto_descuento_anticipo" value=""><span id="resto_monto_anticipo"></span></td>
  <td><input type="number" name="valor_descuento_anticipo" id="valor_descuento_anticipo" value=""><span id="resto_porcentaje_anticipo"></span></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>

<?php } ?>




<div id="div_fecha_venc">
      <hr>
      <div class="card-body cards-titulo">   
         <center>
            FECHA DE VENCIMIENTO: <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" style="border:none" readonly >
          </center>
    </div>

<br>
</div>
<input name="idobras" value="<?php echo $obra_id; ?>" id="cert_idobras" hidden>
        
      </div>
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="ml-auto my-auto mr-3">

            <a onclick="confirmar_certificado()" title="Confirmar" data-toggle="tooltip" style="color:green;" id="confirmar_certificado"><i class="fas fa-check"></i> Confirmar</a>
<!--            <a onclick="confirmar_anticipo()" title="Confirmar" data-toggle="tooltip" style="color:green;display:none;" id="confirmar_anticipo"><i class="fas fa-check"></i> Confirmar</a>
-->
          </div>
        </div>
      </div>

    </div>
</div>
</div>
</form>

<script>
  function submit_agregar_certificado()
{
    validar = $("#form_agregar_certificado").validate();
    if(validar){
    confirmar = $('#form_agregar_certificado').submit();
    if(confirmar){
      $(location).attr("href", "certificados");
    }
    }
}

function confirmar_anticipo(){
    swal({
  title: "Confirmar",
  text: "Si continua Se procedera a editar el certificado",
  buttons: true,
})
  .then((willDelete) => {

if (willDelete) {


    swal("Se ha creado un nuevo certificado de obra.", {
    icon: "success",
    });

      confirmar = $('#form_agregar_certificado').submit();

    
  } else {
    swal("Los cambios permanecen.");
  }



});
  }

function confirmar_certificado(){
    var n_cert = $("#nro_cert").val();
    var idobras = $("#cert_idobras").val();

    validar = $("#form_agregar_certificado").validate();



swal({
  title: "Confirmar",
  text: "Si continua Se procedera a crear el certificado",
  buttons: true,
})
  .then((willDelete) => {

if (willDelete) {


    swal("Se ha creado un nuevo certificado de obra.", {
    icon: "success",
    });

      confirmar = $('#form_agregar_certificado').submit();

  } else {
    swal("Los cambios permanecen.");
  }



});
          }
function cancelar_certificado(){
swal({
  title: "Esta seguro?",
  text: "Si continua se perderan todos los cambios",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
  .then((willDelete) => {
if (willDelete) {
    swal("Se han perdido todos los cambios", {
    });
        location.reload();
  } else {
    swal("Los cambios permanecen.");
  }
});

}

  /** 
  FUNCION SUMA (CADA VEZ QUE SE AGREGA UN VALOR EN COLUMNA "PRESENTE CERTIFICADO") 
  **/



$(document).ready(function(){

    $(document).ready(function(){
    var cantidad = [];
    var cantidades_aprobadas = [];
    var acumulado = [];
    var total_acum = [];
    var precio_unitario = [];
    var importe = [];
    var importe_total = [];
    var disponible = [];
  var suma_importe = 0;
  var input_importe = '';
  var suma_importe_total = 0;
  var input_importe_total = '';
var input_cantidades_aprobadas = '';

	
	/*$('#tabla_items').find('tr#trindi').each(function() {
               var row = [];
               var flag = false;
               $(this).children().each(function() {
                   input_importe = $(this).find("input[name='importe[]']");
                   suma_importe = input_importe.val() + suma_importe;
       	       });             
              
	});
	$('#sum_total').html(suma_importe);
	*/
    $('#tabla_items').find('tr#trindi').each(function(i) {
      var row_cantidad = [];
      var row_cantidades_aprobadas = [];
      var row_acumulado = [];
      var row_total_acum = [];
      var row_precio_unitario = [];
      var row_importe = [];
      var row_disponible = [];
      var row_importe_total = [];
      var input_disponible = '';
      var input_total_acum = '';
      //var input_importe = '';
      var flag = false;
      $(this).each(function() {
        var input_cantidad = $(this).find('input[name="cantidad[]"]');
       input_disponible = $(this).find('input[name="disponibles[]"]');
       input_cantidades_aprobadas = $(this).find('input[name="cantidad_aprobada[]"]');
        var input_acumulado = $(this).find('input[name="cantidad_acumulada[]"]');
         input_total_acum = $(this).find('input[name="total_individual_acumulado[]"]');
        input_disponible = $(this).find('input[name="disponibles[]"]');
        var input_precio_unitario = $(this).find('input[name="precio_unitario_items[]"]');
        input_importe = $(this).find('input[name="importe[]"]');
		    input_importe_total = $(this).find('input[name="importe_total[]"]');
		//suma_importe = input_importe.val() + suma_importe;
    var suma_disponible = '';
    var result_disponible = '';
    var suma = '';
        
                   if (input_acumulado[0]) {
                       flag = true;
                       row_acumulado.push(input_acumulado.val());
                    
                   } else {
                   row_acumulado.push($(this).text() );
                   }

                   if (input_cantidad[0]) {
                     if (input_cantidad.val() > 0) {
                       flag = true;
                       row_cantidad.push(input_cantidad.val());
                     }
                   } else {
                   row_cantidad.push($(this).text() );
                   }

                   if (input_cantidades_aprobadas[0]) {
                     if (input_cantidades_aprobadas.val() > 0) {
                       flag = true;
                       row_cantidades_aprobadas.push(input_cantidades_aprobadas.val());
                     }
                   } else {
                   row_cantidad.push($(this).text() );
                   }
                   
                   if (input_total_acum[0]) {
                       flag = true;
                       suma = parseFloat(input_cantidad.val()) + parseFloat(input_acumulado.val());
                       row_total_acum.push(suma.toFixed(3));
                    
                   } else {
                   row_total_acum.push($(this).text() );
                   }

                   if (input_disponible[0]) {
                       flag = true;
                       suma_disponible = parseFloat(input_cantidad.val()) + parseFloat(input_acumulado.val());
                       result_disponible = parseFloat(input_cantidades_aprobadas.val()) - parseFloat(suma_disponible);

                       row_disponible.push(result_disponible);
                    
                   } else {
                   row_disponible.push($(this).text() );
                   }

                   if (input_precio_unitario[0]) {
                       flag = true;
                       row_precio_unitario.push(input_precio_unitario.val());
                    
                   } else {
                   row_precio_unitario.push($(this).text() );
                   }
                   
                   
                  if (input_importe[0]) {
                      flag = true;
                      row_importe.push(input_importe.val());
                   } 

                  if (input_importe_total[0]) {
                      flag = true;
                      row_importe_total.push(input_importe_total.val());
                   } 
                    
                   if (flag) {   

                 cantidad.push(row_cantidad);
                 cantidades_aprobadas.push(row_cantidades_aprobadas);
                 acumulado.push(row_acumulado);
                 total_acum.push(row_total_acum);
                 disponible.push(row_disponible);
                 precio_unitario.push(row_precio_unitario);
                 importe.push(row_importe);
                 importe_total.push(row_importe_total);

               }
               
                 });
                 
                input_disponible.val(disponible[i]); 
                input_total_acum.val(total_acum[i]); 

                input_importe.val((parseFloat(total_acum[i])*parseFloat(precio_unitario[i])).toFixed(2));

                input_importe_total.val(parseFloat(cantidades_aprobadas[i])*parseFloat(precio_unitario[i]));
                

    }); //FINAL $('#tabla_items').find('tr#trindi').each(function(i) {  
  
  $('#tabla_items').find('td').each(function() {      
    input_importe = parseFloat($(this).find('input[name="importe[]"]').val())||0;
    suma_importe = input_importe + suma_importe;     
    
  });

  $('#sum_total').val(suma_importe.toFixed(2));
  $('#obra_ejecutada').val(suma_importe.toFixed(2));
            //$('#sum_total').html(suma_importe);  

  $('#tabla_items').find('td').each(function() {      
      input_importe_total = parseFloat($(this).find('input[name="importe_total[]"]').val())||0;
      suma_importe_total = input_importe_total + suma_importe_total;     
  });


  $('#monto_total_aprobado').val(suma_importe_total.toFixed(2));
            //$('#sum_total').html(suma_importe);  
            var valor_mont_contr = $('#monto_total_aprobado').val();
var valor_obra_ejec = $('#obra_ejecutada').val();
var porc_obra_ejec = '';

if(valor_obra_ejec != ''){
 porc_obra_ejec = (valor_obra_ejec*100)/valor_mont_contr;
 $('#porc_obra_ejecutada').val(porc_obra_ejec.toFixed(2));
}
  });
  $('input[name="cantidad[]"]').on( 'change', function(){ 
    var cantidad = [];
    var cantidades_aprobadas = [];
    var acumulado = [];
    var total_acum = [];
    var precio_unitario = [];
    var importe = [];
    var importe_total = [];
    var disponible = [];
  var suma_importe = 0;
  var input_importe = '';
  var suma_importe_total = 0;
  var input_importe_total = '';
var input_cantidades_aprobadas = '';

	
	/*$('#tabla_items').find('tr#trindi').each(function() {
               var row = [];
               var flag = false;
               $(this).children().each(function() {
                   input_importe = $(this).find("input[name='importe[]']");
                   suma_importe = input_importe.val() + suma_importe;
       	       });             
              
	});
	$('#sum_total').html(suma_importe);
	*/
    $('#tabla_items').find('tr#trindi').each(function(i) {
      var row_cantidad = [];
      var row_cantidades_aprobadas = [];
      var row_acumulado = [];
      var row_total_acum = [];
      var row_precio_unitario = [];
      var row_importe = [];
      var row_disponible = [];
      var row_importe_total = [];
      var input_disponible = '';
      var input_total_acum = '';
      //var input_importe = '';
      var flag = false;
      $(this).each(function() {
        var input_cantidad = $(this).find('input[name="cantidad[]"]');
       input_disponible = $(this).find('input[name="disponibles[]"]');
       input_cantidades_aprobadas = $(this).find('input[name="cantidad_aprobada[]"]');
        var input_acumulado = $(this).find('input[name="cantidad_acumulada[]"]');
         input_total_acum = $(this).find('input[name="total_individual_acumulado[]"]');
        input_disponible = $(this).find('input[name="disponibles[]"]');
        var input_precio_unitario = $(this).find('input[name="precio_unitario_items[]"]');
        input_importe = $(this).find('input[name="importe[]"]');
		    input_importe_total = $(this).find('input[name="importe_total[]"]');
		//suma_importe = input_importe.val() + suma_importe;
    var suma_disponible = '';
    var result_disponible = '';
    var suma = '';
        
                   if (input_acumulado[0]) {
                       flag = true;
                       row_acumulado.push(input_acumulado.val());
                    
                   } else {
                   row_acumulado.push($(this).text() );
                   }

                   if (input_cantidad[0]) {
                     if (input_cantidad.val() > 0) {
                       flag = true;
                       row_cantidad.push(input_cantidad.val());
                     }
                   } else {
                   row_cantidad.push($(this).text() );
                   }

                   if (input_cantidades_aprobadas[0]) {
                     if (input_cantidades_aprobadas.val() > 0) {
                       flag = true;
                       row_cantidades_aprobadas.push(input_cantidades_aprobadas.val());
                     }
                   } else {
                   row_cantidad.push($(this).text() );
                   }
                   
                   if (input_total_acum[0]) {
                       flag = true;
                       suma = parseFloat(input_cantidad.val()) + parseFloat(input_acumulado.val());
                       row_total_acum.push(suma.toFixed(3));
                    
                   } else {
                   row_total_acum.push($(this).text() );
                   }

                   if (input_disponible[0]) {
                       flag = true;
                       suma_disponible = parseFloat(input_cantidad.val()) + parseFloat(input_acumulado.val());
                       result_disponible = parseFloat(input_cantidades_aprobadas.val()) - parseFloat(suma_disponible);

                       row_disponible.push(result_disponible);
                    
                   } else {
                   row_disponible.push($(this).text() );
                   }

                   if (input_precio_unitario[0]) {
                       flag = true;
                       row_precio_unitario.push(input_precio_unitario.val());
                    
                   } else {
                   row_precio_unitario.push($(this).text() );
                   }
                   
                   
                  if (input_importe[0]) {
                      flag = true;
                      row_importe.push(input_importe.val());
                   } 

                  if (input_importe_total[0]) {
                      flag = true;
                      row_importe_total.push(input_importe_total.val());
                   } 
                    
                   if (flag) {   

                 cantidad.push(row_cantidad);
                 cantidades_aprobadas.push(row_cantidades_aprobadas);
                 acumulado.push(row_acumulado);
                 total_acum.push(row_total_acum);
                 disponible.push(row_disponible);
                 precio_unitario.push(row_precio_unitario);
                 importe.push(row_importe);
                 importe_total.push(row_importe_total);

               }
               
                 });
                 
                input_disponible.val(disponible[i]); 
                input_total_acum.val(total_acum[i]); 

                input_importe.val((parseFloat(total_acum[i])*parseFloat(precio_unitario[i])).toFixed(2));

                input_importe_total.val(parseFloat(cantidades_aprobadas[i])*parseFloat(precio_unitario[i]));
                

    }); //FINAL $('#tabla_items').find('tr#trindi').each(function(i) {  
  
  $('#tabla_items').find('td').each(function() {      
    input_importe = parseFloat($(this).find('input[name="importe[]"]').val())||0;
    suma_importe = input_importe + suma_importe;     
    
  });

  $('#sum_total').val(suma_importe.toFixed(2));
  $('#obra_ejecutada').val(suma_importe.toFixed(2));
            //$('#sum_total').html(suma_importe);  

  $('#tabla_items').find('td').each(function() {      
      input_importe_total = parseFloat($(this).find('input[name="importe_total[]"]').val())||0;
      suma_importe_total = input_importe_total + suma_importe_total;     
  });


  $('#monto_total_aprobado').val(suma_importe_total.toFixed(2));
            //$('#sum_total').html(suma_importe);  
            var valor_mont_contr = $('#monto_total_aprobado').val();
var valor_obra_ejec = $('#obra_ejecutada').val();
var porc_obra_ejec = '';

if(valor_obra_ejec != ''){
 porc_obra_ejec = (valor_obra_ejec*100)/valor_mont_contr;
 $('#porc_obra_ejecutada').val(porc_obra_ejec.toFixed(2));
}
  });







});











$(document).ready(function() {
 
  var month = $("#month").val();
  var year = $("#year").val();
  var dias = $("#certificado_vencimiento").val();

  if(month == month){
    var summonth = parseFloat(month)+1; 

  }
  if(summonth < 10){
    summonth = '0'+summonth;
  }
  if(month != null || year != null){

  if(month < 10){
    month = '0'+month;
  }

  var fecha = year+'-'+summonth+'-01';

        $.ajax({
            type: 'POST',
            url: 'includes/ajax/fecha_vencimiento.php',
            data: "fecha=" + fecha +"&dias=" + dias,
            success: function(data) {
                $('#fecha_vencimiento').val(data);
            }
        });
  }
});

$(document).ready(function() {

  var numero = $('input[name="numero_certificado_edit"]').val();

        $.ajax({
            type: 'POST',
            url: 'includes/ajax/monto_planoficial.php',
            data: "numero=" + numero +"&idobras=" + <?php echo $obra_id; ?>,
            success: function(data) {
                $('#monto_planoficial').val(data);
            }
        });
                $.ajax({
            type: 'POST',
            url: 'includes/ajax/avance_planoficial.php',
            data: "numero=" + numero +"&idobras=" + <?php echo $obra_id; ?>,
            success: function(data) {
                $('#avance_planoficial').val(data);
            }
        });
});

$(document).ready(function() {
  
$('input[name="cantidad[]"]').on( 'change', function(){ 
  var obra_ejec = $('#porc_obra_ejecutada').val();
  var obra_prev = $('#avance_planoficial').val();




        $.ajax({
            type: 'POST',
            url: 'includes/ajax/atraso_adelanto.php',
            data: "obra_ejec=" + obra_ejec +"&obra_prev=" + obra_prev,
            success: function(data) {
                $('#atraso_adelanto').val(data);
            }
        });
});

$('input[name="cantidad[]"]').on( 'change', function(){ 

var importe_a_certificar = $('#sum_total').val();

var monto_dsc_ant = (importe_a_certificar*<?php echo $obra['valor_anticipo_financiero'] ?>)/100;
var porce_dsc_ant = (monto_dsc_ant*100)/importe_a_certificar;

$('#monto_descuento_anticipo').val(monto_dsc_ant);
$('#valor_descuento_anticipo').val(porce_dsc_ant);

var resto_monto_anticipo = monto_dsc_ant-<?php if(isset($anticipos_acumulados['total'])){ echo $anticipos_acumulados['total'];}else{echo '0';} ?>;
var resto_porcentaje_anticipo = (resto_monto_anticipo*100)/monto_dsc_ant;

$('#resto_monto_anticipo').html(resto_monto_anticipo);
$('#resto_porcentaje_anticipo').html(resto_porcentaje_anticipo);

if(resto_porcentaje_anticipo < porce_dsc_ant){
$('#monto_descuento_anticipo').attr('readonly', 'false');
$('#valor_descuento_anticipo').attr('readonly', 'false');
}


});



});
 /*  $('input').on( 'change', function(){ 
 
var month = $("#month").val();
var year = $("#year").val();


if(month != null || year != null){
var fecha_creada = year+'-'+month+'-'+'01';
var fecha_venc = new Date(fecha_creada);
var dias_venc = 60; // Número de días a agregar
fecha_venc.setDate(fecha_venc.getDate() + dias_venc);
fecha_venc.format.date(fecha_venc, "yyyy-MM-dd");


$('#fecha_vencimiento').val(fecha_creada);

console.log(month,year,fecha_venc)*/


$('#aplica_anticipo').on( 'click', function(){ 

$('#aplica_anticipo').hide();
$('#aplica_anticipo').hide();
$('#div_tabla_items').hide();
$('#avance_de_obra').hide();
$('#listar_descuentos').hide();
$('#anticipo_acumulado').hide();
$('#anticipo_descuento').hide();
$('#info_anticipo').show();
$('#nro_cert').val(0).attr('hidden', 'true');
$('#texto_nro_cert').html('CERTIFICADO DE ANTICIPO FINANCIERO');
$('#fecha_medicion_anticipo').hide();
$('#plazo_transcurrido_anticipo').hide();
$('#div_fecha_venc').hide();

$('#confirmar_certificado').hide();
$('#confirmar_anticipo').show();
});


</script>

