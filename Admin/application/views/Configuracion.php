<div class="col-xs-12 col-sm-6 col-md-6">
  <div class="block">
      <form id="Impuesto">
        <div class="app-heading app-heading-small noHPadding">
            <div class="title">
                <h2>Impuestos</h2>
                <p><small>* Campos obligatorios</small></p>
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Porcetaje de impuestos *</span>
            <input type="text" class="form-control" name="Impuesto" id="Impuesto" value="<?=$configuracion['ImpuestoPorcentaje'];?>">
        </div>
        <div class="col-xs-12 nopadding">
            <div class="input-group">
                <button type="button" class="btn btn-success btn-icon-fixed" id="btnUpdateImpuesto"><span class="fa fa-floppy-o"></span> Guardar</button>
            </div>
        </div>
        </form>
  </div>
</div>

<div class="col-xs-12 col-sm-6 col-md-6">
  <div class="block">
      <form id="correosCotizacion">
        <div class="app-heading app-heading-small noHPadding">
            <div class="title">
                <h2>Correos<small> Correos a los cuales se enviaran las cotizaciones.</small></h2>
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Correo 1</span>
            <input type="text" class="form-control" name="Correo1" id="Correo1" value="<?=$configuracion['Correo1'];?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon">Correo 2</span>
            <input type="text" class="form-control" name="Correo2" id="Correo2" value="<?=$configuracion['Correo2'];?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon">Correo 3</span>
            <input type="text" class="form-control" name="Correo3" id="Correo3" value="<?=$configuracion['Correo3'];?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon">Correo 4</span>
            <input type="text" class="form-control" name="Correo4" id="Correo4" value="<?=$configuracion['Correo4'];?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon">Correo 5</span>
            <input type="text" class="form-control" name="Correo5" id="Correo5" value="<?=$configuracion['Correo5'];?>">
        </div>
        <div class="col-xs-12 nopadding">
            <div class="input-group">
                <button type="button" class="btn btn-success btn-icon-fixed" id="btnUpdateCorreos"><span class="fa fa-floppy-o"></span> Guardar</button>
            </div>
        </div>
      </form>
  </div>
</div>
