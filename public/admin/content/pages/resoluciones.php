<?php
require_once('../../includes/load.php');
//require_once('../../includes/functions/notificaciones.php');
cabecera('Resoluciones');
$user = current_user();
 ?>
         <div class="row justify-content-center" id="listar_resoluciones">
        <div class="col-8">
          <div class="card">
                <div class="card-body cards-titulo">
            <div class="d-flex flex-wrap">
              <div class="my-auto ml-3">
                RESOLUCIONES
              </div>
              <div class="ml-auto my-auto mr-3">
              <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip"><i class="fas fa-plus"></i></a>
              <span class="pl-3"></span>
              <a title="Imprimir" data-toggle="tooltip"><i class="fas fa-print"></i></a>
              </div>
            </div>
           </div>
          </div>
        </div>
          <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap margin-dt">
                                            <div>
                                                <h3 class="card-title">Listado de resoluciones registradas</h3>
                                                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                                                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
                                            </div>
                                        </div>
      <div class="table-responsive">
              <table id="tabla_resoluciones" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>  
                    <th> Titulo </th>      
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>  
                    <th> Titulo </th>    
                  </tr>
                </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
</div>
<script type="text/javascript" src="includes/ajax/scripts/resoluciones.js"></script>
<?php 
require_once('../forms/agregar_resolucion.php');
pie(); 
?>