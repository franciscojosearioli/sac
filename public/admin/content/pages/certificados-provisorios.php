<?php
require_once('../../includes/load.php');
$user = current_user();

?>
<div class="p-20" id="cc">
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="row">
              <div class="col-12">
      <div class="table-responsive">
       <table id="cert-provisorios" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%"
       >
        <thead>
          <tr>
            <th></th>
            <th class="text-center"> Nº </th>
            <th class="text-center"> Obra </th>
            <th class="text-center"> Medicion </th>
            <th class="text-center"> Fecha </th>
            <th class="text-center"> Vencimiento </th>
            <th class="text-center"> Importe </th>
            <th class="text-center"> Archivo </th>
            <th class="text-center"> Expediente </th>
            <th class="text-center"> Aprobacion </th>
            <th class="text-center"> Estado </th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th class="text-center"> Nº </th>
            <th class="text-center"> Obra </th>
            <th class="text-center"> Medicion </th>
            <th class="text-center"> Fecha </th>
            <th class="text-center"> Vencimiento </th>
            <th class="text-center"> Importe </th>
            <th class="text-center"> Archivo </th>
            <th class="text-center"> Expediente </th>
            <th class="text-center"> Aprobacion </th>
            <th class="text-center"> Estado </th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>



  </div></div></div>
<script type="text/javascript">
  $(document).ready(function() {

$('#cert-provisorios').DataTable({ 
             ajax: {
          url : 'includes/ajax/listar_certificados_provisorios.php',
          type: 'POST'
        },     
        dom: '<"top"flBp>irt<"bottom"i><"clear">flBp',
            "fnInitComplete": function(){
                // Disable TBODY scoll bars
                
                // Enable TFOOT scoll bars
                //$('.dataTables_scrollFoot').css('overflow', 'auto');
                
                $('.dataTables_scrollHead').css('overflow', 'auto');
                
                // Sync TFOOT scrolling with TBODY
                $('.dataTables_scrollFoot').on('scroll', function () {
                    $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
                });      
                
                $('.dataTables_scrollHead').on('scroll', function () {
                    $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
                });
            },
            language: {
                buttons: {
                    copy: 'Copiar',
                    excel: 'Exportar a Excel',
                    csv: 'Exportar a CSV',
                    pdf: 'Exportar a PDF',
                    colvis: 'Filtrar datos',
                    print: 'Imprimir'
                }
            },
            fixedHeader: {
                header: true,
                footer: true
            },
            buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: ['copy','excel','csv','pdf','print']
            },
            { extend: 'colvis',
              text: 'Filtro'  }
            ],
            columnDefs: [
            {
                targets: 0,
                className: 'select-checkbox',
                checkboxes: {
                    selectRow: true
                }
            },
            {
                orderable: false,
                targets: [0,1]
            }
            ],
            select: 
            {
                selector: 'td:first-child',
                style: 'multi'
            },
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            scrollY:        "300px",
            fixedColumns:   {
                heightMatch: 'none'
            }
    });

  
$('#change_estado').on( 'change', function(){ 
  var estado = $('#change_estado').val();
  var id = $('#n_certid').val();
  
        $.ajax({
            type: 'POST',
            url: 'includes/ajax/certificados_estados.php',
            data: "estado=" + estado +"&id=" + id,
            success: function(data) {
                $('#cc').load('certificados_confeccionados')
            }
        });
});

});

</script>