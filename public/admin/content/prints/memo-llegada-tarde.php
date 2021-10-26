<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$memorandum = find_by_id('memorandums','idmemorandums',$id);  

$agentes = find_by_id('memorandums_agentes','idmemorandums',$id);  
cabecera_print_memo(clean($memorandum['titulo']));
?>

<div class="row">
<div class="col-md-12">
<table class="table" >
<tbody>
  <tr>
    <td style="border:2px solid #000000;width:50%">Para informacion de <br /> <br /> <b><?php echo find_select('nombre','direcciones','iddireccion',$memorandum["receptor"]); ?><?php echo find_select('nombre','departamentos','iddepartamentos',$memorandum["receptor"]); ?></b></td>
    <td style="border:2px solid #000000;width:50%">Producido por<br /> <br /> <b><?php echo find_select('nombre','direcciones','iddireccion',$memorandum["emisor"]); ?></b> <br /><br /> Paraná, <?php echo format_date_memorandum(date("d-m-Y")); ?></td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="row">
<div class="col-12" style="text-align: justify;"><br/>
<span style="padding-left:150px">Por el presente se justifica la llegada tarde a la Repartición del Agente </span> <?php echo user_name_memo_llegada_tarde($agentes['agente']); ?> en el dia de la fecha.


</div>
</div>

