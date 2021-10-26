<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
 
 
$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'acciones',
    2 => 'prioridad',
    3 => 'referencia', 
    4 => 'asunto',
    5 => 'iniciador',
    6 => 'ubicacion',
    7 => 'envia',
    8 => 'recibe',
    9 => 'observaciones'
);
 
 if(permiso('admin') || permiso('expedientes')){
$sql = "SELECT * FROM notas WHERE condicion=0 order by registro_fecha desc";
}else{
    $sql = "SELECT * FROM notas WHERE iddepartamentos = '".$user['iddepartamentos']."' AND condicion=0 order by registro_fecha desc";
}
$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array
    $nestedData=array();
     
    $nestedData[] = '<i class="far fa-circle"></i>';
if(!permiso('notas')){
     $nestedData[] = '<a class="i-dt-list" onclick="observaciones_nota('.$row['idnotas'].')" data-toggle="tooltip" title="Observar"><i class="mdi mdi-information-variant"></i></a>';
                    } 

if(permiso('admin') || permiso('notas')){
     $nestedData[] = '
     <a class="i-dt-list" onclick="observaciones_nota('.$row['idnotas'].')" data-toggle="tooltip" title="Observar"><i class="mdi mdi-information-variant"></i></a>
     <a class="i-dt-list" onclick="editar_nota('.$row['idnotas'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
     <a class="i-dt-list" onclick="pases_nota('.$row['idnotas'].')" data-toggle="tooltip" title="Realizar pase"><i class="mdi mdi-arrow-top-right"></i></a>';
                    } 

    if($row['prioridad'] == 1){
    $nestedData[] = '<center><span class="p-urgente">URGENTE</span></center>';
}
    if($row['prioridad'] == 2){
    $nestedData[] = '<center><span class="p-alto">ALTO</span></center>';
}
    if($row['prioridad'] == 3){
    $nestedData[] = '<center><span class="p-medio">MEDIO</span></center>';
}       
    if($row['prioridad'] == 4){
    $nestedData[] = '<center><span class="p-bajo">BAJO</span></center>';
}
    $nestedData[] = '<center>'.utf8_decode($row["referencia"]).'</center>';
    $nestedData[] = $row["asunto"];
    $nestedData[] = $row["iniciador"];

    $nestedData[] = '<b>'.find_select('nombre','departamentos','iddepartamentos',$row['iddepartamentos']).' - '.find_select('nombre','direcciones','iddireccion',$row['iddireccion']).'</b> desde el '.format_date($row['fecha_pase']);
    $nestedData[] = $row["emisor"];
    $nestedData[] = $row["receptor"];
    $nestedData[] = $row["observaciones"];
    $data[] = $nestedData;
    
}
 
 
 
$json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
 
echo json_encode($json_data);  // send data as json format

?>