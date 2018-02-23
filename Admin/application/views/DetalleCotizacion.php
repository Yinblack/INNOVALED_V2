<div class="col-xs-12">
    <div class="block block-condensed">
        <div class="app-heading app-heading-small">
            <div class="title">
              <?php
              setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
              $date= date("d M Y h:i:s A", strtotime($Cotizacion['TimeUpload'])) . "\n";
              ?>
                <h3>Informacion del cliente</h3>
                <p>Fecha: <?=$date;?></p>
            </div>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="text-sm text-uppercase text-bolder margin-bottom-5">Nombre</h4>
                    <p class="subheader"><?=$Cotizacion['NombreCliente']?></p>
                </div>
                <div class="col-md-4">
                    <h4 class="text-sm text-uppercase text-bolder margin-bottom-5">Correo</h4>
                    <p class="subheader"><?=$Cotizacion['Correo']?></p>
                </div>
                <div class="col-md-4">
                    <h4 class="text-sm text-uppercase text-bolder margin-bottom-5">Telefono</h4>
                    <p class="subheader"><?=$Cotizacion['Telefono']?></p>
                </div>
            </div>
        </div>
        <div class="block-content padding-top-15 padding-bottom-10">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="text-sm text-uppercase text-bolder margin-bottom-5">Empresa</h4>
                    <p class="subheader"><?=$Cotizacion['Empresa']?></p>
                </div>
                <div class="col-md-8">
                    <h4 class="text-sm text-uppercase text-bolder margin-bottom-5">Descripción</h4>
                    <p class="subheader"><?=$Cotizacion['Descripcion']?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($Cotizacion['Tipo']=='producto'): ?>
<div class="col-xs-12">
    <div class="block block-condensed">
        <!-- START HEADING -->
        <div class="app-heading app-heading-small">
            <div class="title">
                <h3>Productos</h3>
                <p></p>
            </div>
        </div>
        <!-- END HEADING -->
        <div class="block-content">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($ProductosByCotizacion):
                        $subtotal=0;
                    foreach ($ProductosByCotizacion->result() as $row):
                        $subtotal=$row->Precio+$subtotal;
                        $subtotalPorProducto=$row->Qty*$row->Precio;
                ?>
                    <tr id="<?=$row->IdProducto;?>">
                        <td><?=$row->IdProducto;?></td>
                        <td><?=$row->producto;?></td>
                        <td><?=$row->Qty;?></td>
                        <td>
                            <a target="_blank" href="DetalleProducto?IdProducto=<?=$row->IdProducto;?>"><button class="btn btn-default btn-icon"><span class="fa fa-eye"></span></button></a>
                        </td>
                    </tr>
                <?php
                    endforeach;
                    endif;
                    if (!isset($subtotal)) {
                      $subtotal=0;
                      $subtotalIva=0;
                    }else{
                      $subtotalIva=$subtotal*1.18;
                      $subtotalIva=number_format($subtotalIva, 2, '.', ',');
                      $subtotal=number_format($subtotal, 2, '.', ',');
                    }
                ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Subtotal:</td>
                        <td><?=$subtotal;?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total:</td>
                        <td><?=$subtotalIva;?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?php endif ?>

<?php if ($Cotizacion['Tipo']=='servicio'): ?>
<div class="col-xs-12">
    <div class="block block-condensed">
        <!-- START HEADING -->
        <div class="app-heading app-heading-small">
            <div class="title">
                <h3>Servicio</h3>
                <p></p>
            </div>
        </div>
        <!-- END HEADING -->
        <div class="block-content">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Proyecto</th>
                        <th>Tipo</th>
                        <th>Ambiente</th>
                        <th>Dimensiones</th>
                        <th>Calidad</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($ServiciosByCotizacion):
                    foreach ($ServiciosByCotizacion->result() as $row):
                ?>
                    <tr>
                        <td><?=$row->Proyecto;?></td>
                        <td><?=$row->Tipo;?></td>
                        <td><?=$row->Ambiente;?></td>
                        <td><?=$row->Dimensiones;?></td>
                        <td><?=$row->Calidad;?></td>
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
<?php endif ?>
