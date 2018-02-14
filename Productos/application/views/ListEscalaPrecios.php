<div class="block block-condensed">
    <!-- START HEADING -->
    <div class="app-heading app-heading-small">
        <div class="title">
        </div>
    </div>
    <!-- END HEADING -->
    <div class="block-content">
        <table class="table table-striped table-bordered data-simple">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Id producto</th>
                    <th>Producto</th>
                    <th>Desde</th>
                    <th>Precio base</th>
                    <th>% Descuento</th>
                    <th>Descuento</th>
                    <th>Precio con descuento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($escalaPrecios):
                foreach ($escalaPrecios->result() as $row):
                  $precioCnDescuento=$row->precio-($row->precio*($row->descuento/100));
                  $descuento=$row->precio*($row->descuento/100);
            ?>
                <tr id="<?=$row->IdPrecioEscala;?>">
                    <td><?=$row->IdPrecioEscala;?></td>
                    <td><?=$row->IdProducto;?></td>
                    <td><?=$row->producto;?></td>
                    <td><?=$row->desde;?></td>
                    <td><?=$row->precio;?></td>
                    <td><?=$row->descuento;?></td>
                    <td><?=$descuento;?></td>
                    <td><?=$precioCnDescuento;?></td>
                    <td>
                        <a href="UpdateEscalaPrecio?IdPrecioEscala=<?=$row->IdPrecioEscala;?>"><button class="btn btn-default btn-icon"><span class="fa fa-pencil"></span></button></a>
                        <a onclick="deletePrecioEscala(<?=$row->IdPrecioEscala;?>)"><button class="btn btn-default btn-icon"><span class="fa fa-times"></span></button></a>
                    </td>
                </tr>
            <?php
                endforeach;
                endif;
            ?>
            </tbody>
        </table>
    </div>
</div>
