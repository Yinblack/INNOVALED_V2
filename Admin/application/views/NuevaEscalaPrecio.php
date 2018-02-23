<div class="block">
<form id="NuevaEscalaPrecio">

    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="app-heading app-heading-small noHPadding">
            <div class="title">
                <h2>Datos generales</h2>
                <p><small>* Campos obligatorios</small></p>
            </div>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Producto: </span>
            <select class="bs-select form-control" data-live-search="true" name="Producto" id="Producto">
            <?php
                if ($productos):
                foreach ($productos->result() as $row):
            ?>
                <option value="<?=$row->IdProducto;?>"><?=$row->producto;?></option>
            <?php
                endforeach;
                endif;
            ?>
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Precio base: </span>
            <input type="text" class="form-control" value="" disabled="true" name="PrecioBase" id="PrecioBase">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Mayor que: </span>
            <input type="text" class="form-control values" name="MayorQue" id="MayorQue">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Porcentaje de descuento: </span>
            <input type="text" class="form-control values" name="PorcentajeDescuento" id="PorcentajeDescuento">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Descuento: </span>
            <input type="text" class="form-control" value="" disabled="true" name="Descuento" id="Descuento">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Nuevo precio: </span>
            <input type="text" class="form-control" value="" disabled="true" name="NuevoPrecio" id="NuevoPrecio">
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
