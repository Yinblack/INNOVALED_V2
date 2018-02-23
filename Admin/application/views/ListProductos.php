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
                    <th>Producto</th>
                    <th>Linea</th>
                    <th>Sublinea</th>
                    <th>Mostrar</th>
                    <th>Orden</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
                if ($productos):
                foreach ($productos->result() as $row):
            ?>
                <tr id="<?=$row->IdProducto;?>">
                    <td><?=$row->IdProducto;?></td>
                    <td><?=$row->producto;?></td>
                    <td><?=$row->linea;?></td>
                    <td><?=$row->sublinea;?></td>
                    <td><?=$row->mostrar;?></td>
                    <td><?=$row->orden;?></td>
                    <td>
                        <a href="UpdateProducto?IdProducto=<?=$row->IdProducto;?>"><button class="btn btn-default btn-icon"><span class="fa fa-pencil"></span></button></a>
                        <a target="_blank" href="DetalleProducto?IdProducto=<?=$row->IdProducto;?>"><button class="btn btn-default btn-icon"><span class="fa fa-eye"></span></button></a>
                        <a onclick="deleteProducto(<?=$row->IdProducto;?>)"><button class="btn btn-default btn-icon"><span class="fa fa-times"></span></button></a>
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
