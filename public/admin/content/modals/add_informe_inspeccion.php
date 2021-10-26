<div class="modal fade" id="add_informe_inspeccion" tabindex="-1" role="dialog" aria-labelledby="add_informe_inspeccion" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_informe_inspeccion">Cargar nuevo documento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="obra.php?id=<?php echo $obra['idobras']; ?>" name="form_informe_inspeccion" method="post" enctype="multipart/form-data">       
      <div class="modal-body">
          <div class="card-body">
            <div class="row justify-content-center">          
           <h5 class="p-b-20"><b>INFORME DE PROGRESO MENSUAL DE OBRA</b></h5>
            <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <input type="text" name="informe_inspeccion" value="1" hidden>
            <input type="text" id="caja" name="caja" hidden />
            <input type="text" id="idobra" name="idobra" hidden />
            <div class="form-group">
            <label for="numero_informe"> Numero <span class="danger">*</span> </label>
            <input type="number" class="form-control required" id="numero_informe" name="numero" required> 
            <small class="form-control-feedback"> Indique el numero del certificado al que corresponde. </small>
            </div>
            <div class="form-group">
            <label for="fecha_informe"> Fecha <span class="danger">*</span> </label>
            <input type="text" class="form-control required" id="fecha_informe" name="fecha" required> 
            <small class="form-control-feedback"> Indique la fecha que corresponde al informe. </small>
            </div>
            <div class="form-group">
            <label for="fecha_informe"> Documento <span class="danger">*</span> </label>
            <input type="file" name="archivo" id="archivo_informe" class="dropify-es" required />
            <small class="form-control-feedback"> Seleccione o arrastre el archivo. </small>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            <p>El documento debe cumplir con los siguientes requisitos:</p>
            <li>El documento debe ser unico y en formato de archivos pdf.</li>
            <li>El informe debe presentarse en el siguiente orden:
            <ol>
            <li>Informacion de obra</li>
            <li>Desarrollo</li>
            <li>Curva y avance</li>
            <li>Planillas</li>
            <li>Anexos</li>
            </ol>
            </li>
            </div>
            </div>    
            </div>                                    
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info waves-effect waves-light">Agregar nuevo</button>
        </div>
        </form>
    </div>
  </div>
</div>