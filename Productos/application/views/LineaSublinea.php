<div class="col-xs-12 col-md-6">
<div class="block block-condensed">
    <!-- START HEADING -->
    <div class="app-heading app-heading-small">
        <div class="title">
            <h5>Tabla Lineas</h5>
            <p></p>
        </div>
    </div>
    <!-- END HEADING -->
    <div class="block-content">
        <table class="table table-striped table-bordered data-simple">
            <thead>
                <tr>
                    <th>Id Linea</th>
                    <th>Etiqueta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
                if ($lineas):
                foreach ($lineas->result() as $row):
            ?>
                <tr id="<?=$row->IdLinea;?>">
                    <td><?=$row->IdLinea;?></td>
                    <td><?=$row->Etiqueta;?></td>
                    <td>
                        <a onclick="showSublineas(<?=$row->IdLinea;?>)"><button class="btn btn-default btn-icon"><span class="fa fa-list"></span></button></a>
                        <a onclick="showModalUpdate(<?=$row->IdLinea;?>, <?="'".$row->Etiqueta."'";?>);" ><button class="btn btn-default btn-icon"><span class="fa fa-pencil"></span></button></a>
                        <a onclick="showModalAddSublinea(<?=$row->IdLinea;?>)"><button class="btn btn-default btn-icon"><span class="fa fa-plus"></span></button></a>
                        <a onclick="deleteLinea(<?=$row->IdLinea;?>)"><button class="btn btn-default btn-icon"><span class="fa fa-times"></span></button></a>
                    </td>
                </tr>
            <?php
                endforeach;
                endif;
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-default nuevaLinea" data-toggle="modal" data-target="#modal-add-etiqueta">Nueva <span class="icon-plus-circle pull-right"></span></button>
    </div>
</div>
</div>


<div class="col-xs-12 col-md-6">
<div class="block block-condensed">
    <!-- START HEADING -->
    <div class="app-heading app-heading-small">
        <div class="title">
            <h5>Tabla Sublineas</h5>
            <p>Selecciona una linea para ver las sublineas.</p>
        </div>
    </div>
    <!-- END HEADING -->

    <div class="block-content">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id Sublinea</th>
                    <th>Etiqueta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="sublineasContainer">
            </tbody>
        </table>
    </div>

</div>
</div>

<!-- MODAL ADD LINEA -->
<div class="modal fade" id="modal-add-etiqueta" tabindex="-1" role="dialog" aria-labelledby="modal-add-etiqueta-header">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-add-etiqueta-header">Nueva linea</h4>
            </div>
            <form id="addLinea">
                <div class="modal-body">
                    <div class="input-group inputCliente">
                        <span class="input-group-addon">Etiqueta: </span>
                        <input type="text" class="form-control" name="Etiqueta" id="Etiqueta">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-default addLinea">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL ADD LINEA -->

<!-- MODAL UPDATE LINEA -->
<div class="modal fade" id="modal-update-etiqueta" tabindex="-1" role="dialog" aria-labelledby="modal-update-etiqueta-header">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-update-etiqueta-header">Modificar linea</h4>
            </div>
            <form id="updateLinea">
            <div class="modal-body">
                <div class="input-group inputCliente">
                    <span class="input-group-addon">Etiqueta: </span>
                    <input type="text" class="form-control" name="Etiqueta" id="Etiqueta" value="">
                    <input type="hidden" name="IdLinea" id="IdLinea" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default updateLinea">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL UPDATE LINEA -->

<!-- MODAL ADD SUBLINEA -->
<div class="modal fade" id="modal-add-sublinea" tabindex="-1" role="dialog" aria-labelledby="modal-add-sublinea-header">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-add-sublinea-header">Agregar sublinea</h4>
            </div>
            <form id="addSubLinea">
            <div class="modal-body">
                <div class="input-group inputCliente">
                    <span class="input-group-addon">Etiqueta: </span>
                    <input type="text" class="form-control" name="Etiqueta" id="Etiqueta" value="">
                    <input type="hidden" name="IdLinea" id="IdLinea" value="">
                </div>
                <div class="input-group inputCliente">
                    <input type="file" class="file btn-default btn-icon-fixed" name="Imagen" id="Imagen" title="<span class='fa fa-cloud-upload'></span> Imagen">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default addSubLinea">Agregar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL ADD SUBLINEA -->

<!-- MODAL UPDATE SUBLINEA -->
<div class="modal fade" id="modal-update-sublinea" tabindex="-1" role="dialog" aria-labelledby="modal-update-sublinea-header">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-update-sublinea-header">Modificar sublinea</h4>
            </div>
            <form id="updateSubLinea">
            <div class="modal-body">
                <div class="input-group inputCliente">
                    <span class="input-group-addon">Etiqueta: </span>
                    <input type="text" class="form-control" name="Etiqueta" id="Etiqueta" value="">
                    <input type="hidden" name="IdSubLinea" id="IdSubLinea" value="">
                </div>
                <div class="col-xs-12 nopadding">
                    <img src="" alt="" class="col-xs-12" id="containerImgSubLinea" style="width: 150px;">
                </div>
                <div class="input-group inputCliente">
                    <input type="file" class="file btn-default btn-icon-fixed" name="Imagen" id="Imagen" title="<span class='fa fa-cloud-upload'></span> Cambiar imagen">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-default updateSubLinea">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL UPDATE SUBLINEA -->
