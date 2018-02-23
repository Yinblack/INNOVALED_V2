<div class="block">
<form id="NuevoProducto">

    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="app-heading app-heading-small noHPadding">
            <div class="title">
                <h2>Datos generales</h2>
                <p><small>* Campos obligatorios</small></p>
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">Nombre *</span>
            <input type="text" class="form-control" name="Nombre" id="Nombre">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Linea *</span>
            <select class="form-control" name="Linea" id="Linea">
                <option value="" disabled="true" hidden="true" selected="true"></option>
            <?php
                if ($Lineas):
                foreach ($Lineas->result() as $row):
            ?>
                <option value="<?=$row->IdLinea;?>"><?=$row->Etiqueta;?></option>
            <?php
                endforeach;
                endif;
            ?>
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Sublinea *</span>
            <select class="form-control" name="SubLinea" id="SubLinea">
                <option value="" disabled="true" hidden="true" selected="true">Selecciona una linea.</option>
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Marca *</span>
            <input type="text" class="form-control" name="Marca" id="Marca">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Precio *</span>
            <input type="text" class="form-control" name="Precio" id="Precio">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Moneda *</span>
            <select class="form-control" name="Moneda" id="Moneda">
                <option value="" disabled="true" hidden="true" selected="true"></option>
            <?php
                if ($Monedas):
                foreach ($Monedas->result() as $row):
            ?>
                <option value="<?=$row->IdMoneda;?>"><?=$row->Etiqueta;?></option>
            <?php
                endforeach;
                endif;
            ?>
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Mostrar precio *</span>
            <select class="form-control" name="Mostrar" id="Mostrar">
                <option value="" disabled="true" hidden="true" selected="true"></option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Mostrar producto *</span>
            <select class="form-control" name="Show" id="Show">
                <option value="" disabled="true" hidden="true" selected="true"></option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Orden *</span>
            <input type="text" class="form-control" name="Orden" id="Orden">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Descripción</span>
            <textarea class="form-control" name="Descripcion" id="Descripcion" rows="3"></textarea>
        </div>
        <div class="input-group inputCliente">
            <input type="file" class="file btn-default btn-icon-fixed" name="Imagen1" id="Imagen1" title="<span class='fa fa-cloud-upload'></span> Imagen principal">
        </div>
        <div class="input-group inputCliente">
            <input type="file" class="file btn-default btn-icon-fixed" name="Imagen2" id="Imagen2" title="<span class='fa fa-cloud-upload'></span> Imagen 2">
        </div>
        <div class="input-group inputCliente">
            <input type="file" class="file btn-default btn-icon-fixed" name="Imagen3" id="Imagen3" title="<span class='fa fa-cloud-upload'></span> Imagen 3">
        </div>
        <div class="input-group inputCliente">
            <input type="file" class="file btn-default btn-icon-fixed" name="Imagen4" id="Imagen4" title="<span class='fa fa-cloud-upload'></span> Imagen 4">
        </div>
        <div class="input-group inputCliente">
            <input type="file" class="file btn-default btn-icon-fixed" name="Imagen5" id="Imagen5" title="<span class='fa fa-cloud-upload'></span> Imagen 5">
        </div>
        <div class="input-group inputCliente">
            <input type="file" class="file btn-default btn-icon-fixed" name="FichaTecnica" id="FichaTecnica" title="<span class='fa fa-cloud-upload'></span> Ficha tecnica (PDF)">
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="app-heading app-heading-small noHPadding">
            <div class="title">
                <h2>Información tecnica <small>Esta información se agregara en forma de lista.</small></h2>
            </div>
        </div>
        <div class="col-xs-12 nopadding">
            <div class="col-xs-12 nopadding" id="List">

            </div>
            <div class="input-group">
                <button type="button" class="btn btn-info btn-icon-fixed" id="addItem"><span class="icon-plus-circle"></span> Agregar elemento</button>
            </div>

        </div>
    </div>
    <div class="col-xs-12">
        <div class="input-group">
            <button type="button" class="btn btn-success btn-icon-fixed" id="formProcess"><span class="fa fa-floppy-o"></span> Guardar</button>
        </div>
        <div class="col-xs-12" id="errordiv"></div>
    </div>
</form>
</div>
