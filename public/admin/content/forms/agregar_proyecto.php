<div class="row form-center hide" id="agregar_proyecto">
<div class="col-lg-12 col-md-12">
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12">
        <div class="d-flex flex-wrap">
          <div>
            <h3 class="card-title">Agregar nuevo proyecto</h3>
          </div>
          <div class="ml-auto">
            <ul class="list-inline">
              <li>
                <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <hr class="m-t-0 m-b-0"> 
  </div>

<div class="card-body">
<form method="post" action="proyectos" id="form_agregar">
<div class="form-group p-20">
  <ul class="nav nav-tabs customtab2 justify-content-center m-b-30" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#generalidades" role="tab" aria-expanded="true">Generalidades</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#contratacion" role="tab" aria-expanded="false">Contratacion</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#tramite" role="tab" aria-expanded="false">Tramite</a>
    </li>  
  </ul>
<div class="tab-content">

<div class="tab-pane p-l-20 active" id="generalidades" role="tabpanel" aria-expanded="true">
<input type="text" name="add_proyecto" hidden>
<div class="form-group p-l-20">
<?php if(permiso('iluminacion') || permiso('señalamiento')){ ?>
<div class="row p-t-20">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="md-form form-md">
<label class="control-label">Numero de proyecto</label>
<input type="text" name="numero" class="form-control">
</div>
</div>
</div>
<?php } ?>                        
<div class="row p-t-20">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="md-form form-md">
<label class="control-label">Titulo de obra <span style="color:red;font-weight:700;">*</span></label>
<input type="text" name="titulo" class="form-control" required>  
</div>
</div>
</div>
<div class="row p-t-20">
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="md-form form-md">
<label class="control-label">Tipo de obra</label>
<input type="text" name="descripcion" class="form-control"> 
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="md-form form-md">
<label class="control-label">Longitud</label>
<input type="number" name="longitud" step="any" pattern="^\d+(?:\.\d{1,2})?$" class="form-control">
<small class="form-control-feedback"> En metros. </small>
</div>               
</div>       
</div>
<div class="row p-t-20">
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="md-form form-md">
<label class="control-label">Departamento / Localidad <span style="color:red;font-weight:700;">*</span></label>
<input type="text" name="ubicacion" class="form-control" required>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="md-form form-md">
<label class="control-label">Proyectista</label>
<input type="text" name="proyectista" class="form-control">
</div>
</div>
</div>
<div class="row p-t-20">
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="md-form form-md">
<label class="control-label">Presupuesto oficial <span style="color:red;font-weight:700;">*</span></label>
<input type="number" name="proyecto_monto" class="form-control" step="any" pattern="^\d+(?:\.\d{1,2})?$" required>
<small class="form-control-feedback"> Segun proyecto. </small>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="md-form form-md">
<label class="control-label">Fecha del presupuesto</label>
<input type="text" name="proyecto_monto_fecha" class="form-control">
</div>
</div>    
</div>
<div class="row p-t-20">
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="md-form form-md">
<label class="control-label">Plazo de ejecucion <span style="color:red;font-weight:700;">*</span></label>
<input type="text" name="proyecto_plazo" class="form-control" required>
<small class="form-control-feedback"> Segun proyecto. </small>
</div>
</div>    
<div class="col-lg-6 col-md-6 col-sm-6">
<div class="md-form form-md">
<label class="control-label">Plazo de garantia <span style="color:red;font-weight:700;">*</span></label>
<input type="text" name="plazo_garantia" class="form-control" required>
<small class="form-control-feedback"> Segun proyecto. </small>
</div>
</div> 
</div>
</div>
</div>

<div class="tab-pane p-l-20" id="contratacion" role="tabpanel" aria-expanded="false">
<div class="form-group p-l-20">
<div class="row p-t-20">
<div class="col-md-4">
<div class="md-form form-md">
<label class="control-label">Aprobacion de proyecto</label>
<input type="date" class="form-control" name="aprobacion_res_fecha">
<small class="form-control-feedback"> Fecha de Resolucion </small>     
</div>
</div>
<div class="col-md-2">
<div class="md-form form-md">
<label class="control-label">&nbsp;</label>
<input type="text" name="aprobacion_res_num" class="form-control">
<small class="form-control-feedback"> Numero </small>  
</div>
</div>      
<div class="col-md-4">
<div class="md-form form-md">
<label class="control-label">Adjudicacion a empresa</label>
<input type="date" name="adjudicacion_res_fecha" class="form-control">
<small class="form-control-feedback"> Fecha de Resolucion </small> 
</div>
</div>      
<div class="col-md-2">
<div class="md-form form-md">
<label class="control-label">&nbsp;</label>
<input type="text" name="adjudicacion_res_num" class="form-control">
<small class="form-control-feedback"> Numero </small> 
</div>
</div>
</div> 
<div class="row p-t-20">
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">Contratista</label>
<input type="text" name="contratista" class="form-control">
</div>
</div>
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">Tipo de contratacion</label>
<input type="text" name="tipo_contratacion" class="form-control">
</div>
</div>      
</div> 
<div class="row p-t-20">
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">Fuente de financiamiento</label>
<input type="text" name="tipo_financiamiento" class="form-control">
</div>
</div>
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">Firma del contrato</label>
<input type="date" name="contrato_fecha" class="form-control">
<small class="form-control-feedback"> Fecha de firma. </small>  
</div>
</div>          
</div> 
<div class="row p-t-20">
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">Monto contrato oficial</label>
<input type="number" name="contrato_monto" class="form-control" step="any" pattern="^\d+(?:\.\d{1,2})?$">
<small class="form-control-feedback"> Firma de contrato. </small> 
</div>
</div>
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">Plazo contrato oficial</label>
<input type="text" name="contrato_plazo" class="form-control">
<small class="form-control-feedback"> Firma de contrato. </small> 
</div>
</div>      
</div> 
</div> 
</div>

<div class="tab-pane p-l-20" id="tramite" role="tabpanel" aria-expanded="false">
<div class="form-group p-l-20">
<div class="row p-t-20">              
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">Nº Expediente</label>
<input type="text" name="expediente" class="form-control" required>                          
</div>
</div>     
<div class="col-md-6">
<label class="control-label">Prioridad</label>
<select class="form-control custom-select" name="prioridad">
<option value="1">Urgente</option>
<option value="2">Alto</option>
<option value="3">Medio</option>
<option value="4">Bajo</option>
</select>
</div>
</div>
<div class="row p-t-20">
<div class="col-md-12">
<label class="control-label">Estado del tramite</label>
<select class="form-control custom-select" name="tramite">
<option disabled selected>Pasos administrativos</option>
<option value="1">1. Relevando y confeccionando proyecto y pliegos</option>
<option value="2">2. Autorizando proyecto</option>
<option value="3">3. Visando pliegos (Encuadre legal)</option>
<option value="4">4. Reserva preventiva</option>
<option value="5">5. Tomado conocimiento</option>
<option value="6">6. Conf. proyecto de resolución llamado / Desig. Comision de est. / Aprobado de res.</option>
<option value="7">7. Cursado de invitacion y plazo de preparacion de ofertas</option>
<option value="8">8. Apertura de ofertas y armado de expediente</option>
<option value="9">9. Desglasando la garantia de oferta</option>
<option value="10">10. Designacion comision de estudio y resolucion</option>
<option value="11">11. Aprob. Res. de designacion</option>
<option value="12">12. Comision de estudios</option>
<option value="13">13. Reserva definitiva</option>
<option value="14">14. Confeccionando proyecto de resolucion de adjudicacion y aprobacion</option>
<option value="15">15. Notificacion al adjudicatario</option>
<option value="16">16. Solicitando gtia. contractual, notif. de perdedores, devol. de gtia.</option>
<option value="17">17. Redactando contrato</option>
<option value="18">18. Sellando contrato</option>
<option value="19">19. Designando inspeccion / Confeccion acta de inicio</option>
<option value="20">20. En ejecucion</option>
</select>
</div> 
</div>
</div>
</div>
</div>                  
</div>
<hr>
<div class="row p-t-20">
<div class="col-md-12">
<div class="md-form">
<label class="control-label">Observaciones</label>
<textarea name="observaciones" class="form-control md-textarea" length="50000" rows="4"></textarea>
</div>
</div>                        
</div>
</div>
</form>
<div class="card-body">
<hr class="m-t-0 m-b-0">
<div class="row p-t-20">
<div class="col-12">
<div class="d-flex flex-wrap">
<div>
<h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
</div>
<div class="ml-auto">
<ul class="list-inline">
<li>
<h6 class="text-muted"><a onclick="submit_agregar();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>    
</div>
