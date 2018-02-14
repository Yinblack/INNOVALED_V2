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
                    <th>Cliente</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Empresa</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
                if ($cotizaciones):

                foreach ($cotizaciones->result() as $row):
                  setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
                  $date= date("d M Y h:i:s A", strtotime($row->TimeUpload)) . "\n";
                ?>
                <tr id="<?=$row->IdCotizacion;?>">
                    <td><?=$row->IdCotizacion;?></td>
                    <td><?=$row->NombreCliente;?></td>
                    <td><?=$row->Correo;?></td>
                    <td><?=$row->Telefono;?></td>
                    <td><?=$row->Empresa;?></td>
                    <td><?=$row->Tipo;?></td>
                    <td><?=$date;?></td>
                    <td>
                        <a href="DetalleCotizacion?IdCotizacion=<?=$row->IdCotizacion;?>"><button class="btn btn-default btn-icon"><span class="fa fa-eye"></span></button></a>
                        <a onclick="deleteCotizacion(<?=$row->IdCotizacion;?>)"><button class="btn btn-default btn-icon"><span class="fa fa-times"></span></button></a>
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
