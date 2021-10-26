<?php
require_once('../../includes/load.php');
require_once('../../../uploads/files.php'); 
cabecera('Neutralizaciones de obras');
$user = current_user();
?>
<div id="lista_neutralizaciones">
<div class="row justify-content-center">
         <div class="col-12">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
              
                  <h1 class="titulo-bienvenida">Neutralizaciones de Obras</h1>
              </div>
              <div class="ml-auto my-auto mr-3">
              <?php if(permiso('admin') || permiso('obras')){ ?>
             <a id="btn_agregar" onclick="form_agregar_neutralizacion(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
              </div>
              </div>
              </div>
         </div>
<div class="row justify-content-center">
  <div class="col-12">
    <div class="card">
      <!-- Nav tabs -->
<ul class="nav nav-tabs customtab justify-content-center" role="tablist">


<li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" aria-controls="neutralizaciones-todo" href="neutralizaciones-todo.php" data-target="#neutralizaciones-todo">TODOS</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="neutralizaciones-tramite" href="neutralizaciones-tramite.php" data-target="#neutralizaciones-tramite">EN TRAMITE</a></li>
<li class="nav-item"><a class="nav-link " data-toggle="tab" role="tab" aria-controls="neutralizaciones-aprobado" href="neutralizaciones-aprobado.php" data-target="#neutralizaciones-aprobado">APROBADOS</a></li>

</ul>

<div class="tab-content">

<div class="tab-pane show active fade" role="tabpanel" id="neutralizaciones-todo"></div>

<div class="tab-pane fade" role="tabpanel" id="neutralizaciones-tramite"></div>

<div class="tab-pane fade" role="tabpanel" id="neutralizaciones-aprobado"></div>
</div>
        </div>
      </div>
    </div>
    </div>
    <div id="editar_neutralizacion"></div>
    <script>
      $(document).ready(function() {
    var contentResult;

    $("a[data-toggle='tab']").on("show.bs.tab", function (e) {
      if ( e.relatedTarget ) {
        $( $(e.relatedTarget).data("target") ).empty();
      }
      var url = $(e.target).attr("href");
      var $tabTarget = $( $(e.target).data("target") );
      $.get( url, function( result ) {
        $tabTarget.html(result);
      });
      $( $(e.relatedTarget).data("target") ).removeClass('active');
    });


});

   $(document).ready(function(){
     $.ajax({url:"neutralizaciones-todo.php",success:function(tabdata){
     $("#neutralizaciones-todo").append(tabdata);
    }});

});
  </script>
<script type="text/javascript" src="includes/ajax/scripts/obras-tramites.js"></script>
        <?php 
    require_once('../forms/agregar_neutralizacion.php');
        pie(); ?>