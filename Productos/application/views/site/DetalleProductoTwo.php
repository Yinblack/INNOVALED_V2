      <section class="normalSection Footer" id="Quote">
        <div class="content nopaddingBottom">
            
          <div class="col-xs-12 nopadding" style="border: 1px solid rgba(0, 0, 0, 0.10);">
            <div class="col-xs-12 vpadding backWhite">
              <div class="col-xs-12 col-md-6 nopadding">
                <div class="col-xs-12 slideContainer">
                  <div class="col-xs-12 nopadding sliderProducto">
                    <?php foreach ($images as $key => $value): ?>
                      <div class="col-xs-12 nopadding containerImage">
                        <div class="col-xs-12 verticalContainer text-center">
                          <img src="<?=$value;?>" alt="" class="centered">
                        </div>
                      </div>
                    <?php endforeach ?>
                  </div>
                </div>
                <div class="col-xs-12 sliderThumbs">
                  <?php foreach ($images as $key => $value): ?>
                    <div class="col-xs-12 thumb backImage" style="background-image: url('<?=$value;?>');"></div>
                  <?php endforeach ?>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="col-xs-12 nopadding">
                  <div class="col-sx-12 vpadding noHorizontalPadding nopaddingTop">
                    <p class="text-uppercase nomargin">CATEGORIA <?=$Producto['Sublinea'];?></p>
                  </div>
                  <div class="col-xs-12 vpadding noHorizontalPadding nopaddingTop">
                    <?php
                    setlocale(LC_MONETARY, 'en_PE');
                    $precio=number_format($Producto['Precio'], 2, '.', ',');
                    ?>
                    <h1 class="textBlack bold nomargin"><div class="titleDetalle"><span>MARCA</span><?=$Producto['Marca'];?></div><div class="titleDetalle"><span>NOMBRE</span><?=$Producto['NombreProducto'];?></div></h1>
                  </div>
                  <div class="col-xs-12 vpadding noHorizontalPadding nopaddingTop">
                    <h2 class="textBlack bold nomargin textPrecio textRed text-left"><?=$Producto['Moneda'];?><?=$precio;?><small class="stock">En Stock</small></h2>
                  </div>
                </div>
                <div class="col-xs-12 nopadding border_bot"></div>
                <?php
                  if ($EscalasPrecio):
                ?>
                <div class="col-xs-12 nopadding">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>A partir de</th>
                        <th>Precio</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php foreach ($EscalasPrecio->result() as $row):
                            $nuevoPrecio=$row->precio+(($row->descuento/100)*$row->precio);
                            $nuevoPrecio=number_format($nuevoPrecio, 2, '.', ',');
                          ?>
                      <tr>
                        <td><?=$row->desde;?></td>
                        <td><?=$nuevoPrecio;?></td>
                      </tr>
                          <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <?php endif ?>
                <div class="col-xs-12 nopadding border_bot"></div>
                <div class="col-xs-12 nopadding vpadding">
                  <p class="text-justify"><?=$Producto['Descripcion'];?></p>
                </div>
                <div class="col-xs-12 nopadding border_bot"></div>
                <input type="hidden" class="" name="IdProducto" id="IdProducto" value="<?=$Producto['IdProducto'];?>">
                <?php if ($onCart!=true): ?>
                  <div class="col-xs-12 noHorizontalPadding vpadding addToCart text-left">
                    <input type="text" class="Qty" name="Qty" id="Qty" value="1"> <a href="#" class="addToCart"><i class="fa fa-cart-plus" aria-hidden="true"></i> COTIZAR</a>
                    <?php if ($Pdf): ?>
                      <a href="assets/img/Productos/<?=$IdProducto;?>/pdf/FichaTecnica.pdf" target="_blank" class="Button1 pull-right ficha" style="margin: 0px 5px;" form="CotizacionDatosCliente"><span class="textWhite"><i class="fa fa-download" style="margin-top: 4px; margin-right: 5px;" aria-hidden="true"></i> Ficha técnica</span></a>
                    <?php endif ?>
                  </div>
                <?php else: ?>
                  <div class="col-xs-12 noHorizontalPadding vpadding delToCart">
                    <a href="#" class="delToCart pull-left"><i class="fa fa-trash-o" aria-hidden="true"></i> QUITAR</a>
                    <?php if ($Pdf): ?>
                      <a href="assets/img/Productos/<?=$IdProducto;?>/pdf/FichaTecnica.pdf" target="_blank" class="Button1 pull-right ficha" style="margin: 0px 5px;" form="CotizacionDatosCliente"><span class="textWhite"><i class="fa fa-download" style="margin-top: 4px; margin-right: 5px;" aria-hidden="true"></i> Ficha técnica</span></a>
                    <?php endif ?>
                  </div>
                <?php endif ?>
                <div class="col-xs-12 nopadding">
                  <a onclick="goBack();" class="ButtonBack pull-left" form="CotizacionDatosCliente"><img src="assets/img/web/Icons/left-arrow.svg" alt=""><span class="textWhite">VOLVER ATRAS</span></a>
                </div>
                <?php
                  if ($Caracteristicas):
                ?>
                <di class="col-xs-12 nopadding">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Caracteristica</th>
                        <th>Descripción</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php foreach ($Caracteristicas->result() as $row):?>
                      <tr>
                        <td><?=$row->Titulo;?></td>
                        <td><?=$row->Valor;?></td>
                      </tr>
                          <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                      <?php endif ?>
              </div>
            </div>


        </div>
      </section>

      <section class="normalSection Footer" id="ProductosRelacionados">
        <div class="content nopaddingBottom">
            
      <div class="col-xs-12 nopadding text-center">
        <div class="col-xs-12 nopadding text-center">
            <h2 class="textBlack bold after innoText">PRODUCTOS RELACIONADOS</h2>
        </div>
      </div>
      <div class="col-xs-12 nopadding vpadding" id="containerProductosRelacionados">
        <?php
            if ($productosRelacionados):
            foreach ($productosRelacionados->result() as $row):
              if (strlen($row->Descripcion)>100) {
                $Descripcion = substr($row->Descripcion, 0, 100).'..';
              }else{
                $Descripcion = $row->Descripcion;
              }
        ?>
        <div class="col-xs-12 col-md-4">
        <div class="col-xs-12 nopadding blockRelacionado">
          <div class="col-xs-12 shadow text-center">
            <h4 class="col-xs-12 nopaddingBottom text-bold"><?=$row->NombreProducto;?></h4>
            <div class="col-xs-12 nopadding text-center border_bot">
              <img src="assets/img/Productos/<?=$row->IdProducto;?>/img_1.jpg" alt="" class="col-xs-12 nopadding centered" style="width: 150px;">
            </div>
            <p class="col-xs-12 vpadding nopaddingBottom noHorizontalPadding">
              <?=$Descripcion;?>
            </p>
            <div class="col-xs-12 noHorizontalPadding vpadding">
              <div class="col-xs-6 nopadding">
                <p class="nopadding nomargin bold"><?=$row->Marca;?></p>
              </div>
              <div class="col-xs-6 nopadding">
                <p class="nopadding nomargin bold"><?=$row->Moneda;?> <?=$row->Precio;?></p>
              </div>
            </div>
            <a href="Productos" class="col-xs-12 btnCot">COTIZAR PRODUCTO</a>
            <a href="DetalleProducto?IdProducto=<?=$row->IdProducto;?>" class="col-xs-12 verMas">Ver más</a>
          </div>
        </div>
        </div>
        <?php
            endforeach;
            endif;
        ?>
      </div>


        </div>
      </section>

