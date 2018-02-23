<div class="block">                        
<form id="UpdateProducto">

    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="app-heading app-heading-small noHPadding">                                
            <div class="title">
                <h2>Datos generales</h2>
                <p><small>* Campos obligatorios</small></p>
            </div>                                
        </div>
        <input type="hidden" name="IdProducto" value="<?=$Producto['IdProducto'];?>">
        <div class="input-group">
            <span class="input-group-addon">Nombre *</span>
            <input type="text" class="form-control" name="Nombre" id="Nombre" value="<?=$Producto['Nombre'];?>">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Linea *</span>
            <select class="form-control" name="Linea" id="Linea">
                <option value="" disabled="true" hidden="true" selected="true"></option>
            <?php 
                if ($Lineas):
                foreach ($Lineas->result() as $row): 
                if ($Producto['IdLinea']==$row->IdLinea){
                    $select='selected';
                }else{
                    $select='';
                }
            ?>
                <option value="<?=$row->IdLinea;?>" <?=$select;?> ><?=$row->Etiqueta;?></option>
            <?php 
                endforeach;
                endif; 
            ?> 
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Sublinea *</span>
            <select class="form-control" name="SubLinea" id="SubLinea">
                <option value="" disabled="true" hidden="true" selected="true"></option>
            <?php 
                if ($SubLineas):
                foreach ($SubLineas->result() as $row):
                if ($Producto['IdSubLinea']==$row->IdSubLinea){
                    $select='selected';
                }else{
                    $select='';
                }
            ?>
                <option value="<?=$row->IdSubLinea;?>" <?=$select;?>><?=$row->Etiqueta;?></option>
            <?php 
                endforeach;
                endif; 
            ?> 
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Marca *</span>
            <input type="text" class="form-control" name="Marca" id="Marca" value="<?=$Producto['Marca'];?>">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Precio *</span>
            <input type="text" class="form-control" name="Precio" id="Precio" value="<?=$Producto['Precio'];?>">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Moneda *</span>
            <select class="form-control" name="Moneda" id="Moneda">
                <option value="" disabled="true" hidden="true" selected="true"></option>
            <?php 
                if ($Monedas):
                foreach ($Monedas->result() as $row):
                if ($Producto['IdMoneda']==$row->IdMoneda){
                    $select='selected';
                }else{
                    $select='';
                }
            ?>
                <option value="<?=$row->IdMoneda;?>" <?=$select;?>><?=$row->Etiqueta;?></option>
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
                <?php
                    $mostrarPrecio=array('Si','No');
                ?>
                <?php foreach ($mostrarPrecio as $key => $value): 
                    if ($Producto['MostrarPrecio']==$value) {
                        $select='selected';
                    }else{
                        $select='';
                    }
                ?>
                    <option value="<?=$value;?>" <?=$select;?> ><?=$value;?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Mostrar producto *</span>
            <select class="form-control" name="Show" id="Show">
                <option value="" disabled="true" hidden="true" selected="true"></option>
                <?php
                    $mostrarProducto=array(
                        '1'=>'Si',
                        '2'=>'No'
                    );
                ?>
                <?php foreach ($mostrarProducto as $key => $value): 
                    if ($Producto['Estado']==$key) {
                        $select='selected';
                    }else{
                        $select='';
                    }
                ?>
                    <option value="<?=$key;?>" <?=$select;?> ><?=$value;?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Orden *</span>
            <input type="text" class="form-control" name="Orden" id="Orden" value="<?=$Producto['Orden'];?>">
        </div>
        <div class="input-group inputCliente">
            <span class="input-group-addon">Descripción</span>
            <textarea class="form-control" name="Descripcion" id="Descripcion" rows="3"><?=$Producto['Descripcion'];?></textarea>
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

            <?php
                if ($Caracteristicas):
                    $row_cnt = $Caracteristicas->num_rows;
                    $counter=0;
                foreach ($Caracteristicas->result() as $row):
                    $counter++;
            ?>
                <div class="col-xs-12 nopadding itemToList fixed" IdCarecterisctica="<?=$row->IdCarecterisctica;?>" dataNoItem="<?=$counter;?>">
                    <div class="col-xs-12 col-sm-6 nopadding">
                        <div class="input-group">
                            <span class="input-group-addon">Titulo *</span>
                            <input type="text" class="form-control" value="<?=$row->Titulo;?>" name="Titulo<?=$counter;?>" id="Titulo<?=$counter;?>" required="true" data-msg-required="Agregue un titulo a la lista">
                        </div>
                    </div>
                    <input type="hidden" name="IdCarecterisctica<?=$counter;?>" value="<?=$row->IdCarecterisctica;?>">
                    <div class="col-xs-12 col-sm-6 nopadding">
                        <div class="input-group">
                            <span class="input-group-addon">Valor *</span>
                            <input type="text" IdCarecterisctica="<?=$row->IdCarecterisctica;?>" class="form-control" value="<?=$row->Valor;?>" name="Valor<?=$counter;?>" id="Valor<?=$counter;?>" required="true" data-msg-required="Agregue un texto a la lista">
                        </div>
                    </div>
                    <button type="button" onclick="deleteItem(<?=$counter;?>)" class="btn btn-default btn-icon"><span class="icon-circle-minus"></span></button>
                </div>
            <?php endforeach ?>
            <input type="hidden" id="row_cnt" name="row_cnt" value="<?=$row_cnt;?>">
            <?php endif ?>
            </div>
            <div class="input-group">
                <button type="button" class="btn btn-info btn-icon-fixed" id="addItem"><span class="icon-plus-circle"></span> Agregar elemento</button>
            </div> 
        </div>
        <div class="col-xs-12 nopadding">
            <div class="app-heading app-heading-small noHPadding">                                
                <div class="title">
                    <h2>Escalas de precios</h2>
                </div>                                
            </div>
            <div class="block table-responsive">                        
                <table class="table table-head-light table-striped">
                    <thead>
                        <tr>                                            
                            <th>Desde</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                            <th>Precio con descuento</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($EscalasPrecio):
                        foreach ($EscalasPrecio->result() as $row): 
                            $precioCnDescuento=$row->precio*($row->descuento/100);
                    ?>
                        <tr>
                            <td><?=$row->desde;?></td>
                            <td><?=$row->precio;?></td>
                            <td><?=$row->descuento;?></td>
                            <td><?=$precioCnDescuento;?></td>
                        </tr>
                    <?php
                endforeach;
                endif;
            ?>                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="app-heading app-heading-small noHPadding">                                
            <div class="title">
                <h2>Imagenes</h2>
            </div>                                
        </div>
        <div class="col-xs-12 nopadding">
            <div class="block table-responsive">                        
                <table class="table table-head-light table-striped">
                    <thead>
                        <tr>                                            
                            <th>#</th>
                            <th>Actual</th>
                            <th style="width: 315px;">Reemplazar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Imagen principal</td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_1.jpg")): ?>
                                    <img src="assets/img/Productos/<?=$Producto['IdProducto'];?>/img_1.jpg" alt="" style="width: 150px;">
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_1.jpg")): ?>
                                    <div class="input-group">
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="1" value="show"> Si<span></span></label>                                         
                                        </div>
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="1" value="hide" class="default" checked=""> No<span></span></label> 
                                        </div>
                                    </div>
                                    <div class="input-group inputCliente imageInput1" style="display: none;">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_1" id="img_1" title="<span class='fa fa-cloud-upload'></span> Imagen 2">
                                    </div>
                                <?php else: ?>
                                    <div class="input-group inputCliente">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_1" id="img_1" title="<span class='fa fa-cloud-upload'></span> Imagen principal">
                                    </div>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_1.jpg")): ?>
                                    <div class="app-checkbox"> 
                                        <label><input type="checkbox" name="delimg_1" value="Quitar"> Quitar imagen<span></span></label> 
                                    </div>
                                <?php endif ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Imagen 2</td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_2.jpg")): ?>
                                    <img src="assets/img/Productos/<?=$Producto['IdProducto'];?>/img_2.jpg" alt="" style="width: 150px;">
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_2.jpg")): ?>
                                    <div class="input-group">
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="2" value="show"> Si<span></span></label>                                         
                                        </div>
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="2" value="hide" checked="checked"> No<span></span></label> 
                                        </div>
                                    </div>
                                    <div class="input-group inputCliente imageInput2" style="display: none;">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_2" id="img_2" title="<span class='fa fa-cloud-upload'></span> Imagen 2">
                                    </div>
                                <?php else: ?>
                                    <div class="input-group inputCliente imageInput2">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_2" id="img_2" title="<span class='fa fa-cloud-upload'></span> Imagen 2">
                                    </div>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_2.jpg")): ?>
                                    <div class="app-checkbox"> 
                                        <label><input type="checkbox" name="delimg_2" value="Quitar"> Quitar imagen<span></span></label> 
                                    </div>
                                <?php endif ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Imagen 3</td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_3.jpg")): ?>
                                    <img src="assets/img/Productos/<?=$Producto['IdProducto'];?>/img_3.jpg" alt="" style="width: 150px;">
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_3.jpg")): ?>
                                    <div class="input-group">
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="3" value="show"> Si<span></span></label>                                         
                                        </div>
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="3" value="hide" checked="checked"> No<span></span></label> 
                                        </div>
                                    </div>
                                    <div class="input-group inputCliente imageInput3" style="display: none;">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_3" id="img_3" title="<span class='fa fa-cloud-upload'></span> Imagen 2">
                                    </div>
                                <?php else: ?>
                                    <div class="input-group inputCliente">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_3" id="img_3" title="<span class='fa fa-cloud-upload'></span> Imagen 3">
                                    </div>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_3.jpg")): ?>
                                    <div class="app-checkbox"> 
                                        <label><input type="checkbox" name="delimg_3" value="Quitar"> Quitar imagen<span></span></label> 
                                    </div>
                                <?php endif ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Imagen 4</td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_4.jpg")): ?>
                                    <img src="assets/img/Productos/<?=$Producto['IdProducto'];?>/img_4.jpg" alt="" style="width: 150px;">
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_4.jpg")): ?>
                                    <div class="input-group">
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="4" value="show"> Si<span></span></label>                                         
                                        </div>
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="4" value="hide" checked="checked"> No<span></span></label> 
                                        </div>
                                    </div>
                                    <div class="input-group inputCliente imageInput4" style="display: none;">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_4" id="img_4" title="<span class='fa fa-cloud-upload'></span> Imagen 2">
                                    </div>
                                <?php else: ?>
                                    <div class="input-group inputCliente">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_4" id="img_4" title="<span class='fa fa-cloud-upload'></span> Imagen 4">
                                    </div>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_4.jpg")): ?>
                                    <div class="app-checkbox"> 
                                        <label><input type="checkbox" name="delimg_4" value="Quitar"> Quitar imagen<span></span></label> 
                                    </div>
                                <?php endif ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Imagen 5</td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_5.jpg")): ?>
                                    <img src="assets/img/Productos/<?=$Producto['IdProducto'];?>/img_5.jpg" alt="" style="width: 150px;">
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_5.jpg")): ?>
                                    <div class="input-group">
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="pdf" value="show"> Si<span></span></label>                                         
                                        </div>
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="pdf" value="hide" checked="checked"> No<span></span></label> 
                                        </div>
                                    </div>
                                    <div class="input-group inputCliente imageInput5" style="display: none;">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_5" id="img_5" title="<span class='fa fa-cloud-upload'></span> Imagen 2">
                                    </div>
                                <?php else: ?>
                                    <div class="input-group inputCliente">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="img_5" id="img_5" title="<span class='fa fa-cloud-upload'></span> Imagen 5">
                                    </div>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists("assets/img/Productos/".$Producto['IdProducto']."/img_5.jpg")): ?>
                                    <div class="app-checkbox"> 
                                        <label><input type="checkbox" name="delimg_5" value="Quitar"> Quitar imagen<span></span></label> 
                                    </div>
                                <?php endif ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Ficha tecnica</td>
                            <td>
                                <?php 
                                $path="assets/img/Productos/".$Producto['IdProducto']."/pdf/FichaTecnica.pdf";
                                if (file_exists($path)): 
                                $filesize = filesize($path);
                                ?>
                                    FichaTecnica.pdf (<?=$filesize;?> Kb)
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists($path)):  ?>
                                    <div class="input-group">
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="6" value="show"> Si<span></span></label>                                         
                                        </div>
                                        <div class="app-radio inline"> 
                                            <label><input type="radio" name="6" value="hide" checked="checked"> No<span></span></label> 
                                        </div>
                                    </div>
                                    <div class="input-group inputCliente imageInput6" style="display: none;">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="FichaTecnica" id="FichaTecnica" title="<span class='fa fa-cloud-upload'></span> Ficha tecnica">
                                    </div>
                                <?php else: ?>
                                    <div class="input-group inputCliente">
                                        <input type="file" class="file btn-default btn-icon-fixed" name="FichaTecnica" id="FichaTecnica" title="<span class='fa fa-cloud-upload'></span> Ficha tecnica">
                                    </div>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if (file_exists($path)): ?>
                                    <div class="app-checkbox"> 
                                        <label><input type="checkbox" name="delFicha" value="Quitar"> Quitar ficha tecnica<span></span></label> 
                                    </div>
                                <?php endif ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
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