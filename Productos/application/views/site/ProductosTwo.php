<section id="Banners" class="normalSection">
	<div class="content full nopaddingBottom nopaddingTop">
			<div class="col-xs-12 nopadding" id="slideBanners">
				<div class="col-xs-12 nopadding">
					<a href="#Quote" class="col-xs-12 nopadding scrollTo">
						<img src="assets/img/site/banners/1.jpg" alt="" class="col-xs-12 nopadding">
					</a>
				</div>
				<div class="col-xs-12 nopadding">
					<a href="#Quote" class="col-xs-12 nopadding scrollTo">
						<img src="assets/img/site/banners/2.jpg" alt="" class="col-xs-12 nopadding">
					</a>
				</div>
				<div class="col-xs-12 nopadding">
					<a href="#Quote" class="col-xs-12 nopadding scrollTo">
						<img src="assets/img/site/banners/3.jpg" alt="" class="col-xs-12 nopadding">
					</a>
				</div>
				<div class="col-xs-12 nopadding">
					<a href="#Quote" class="col-xs-12 nopadding scrollTo">
						<img src="assets/img/site/banners/4.jpg" alt="" class="col-xs-12 nopadding">
					</a>
				</div>
				<div class="col-xs-12 nopadding">
					<a href="#Quote" class="col-xs-12 nopadding scrollTo">
						<img src="assets/img/site/banners/5.jpg" alt="" class="col-xs-12 nopadding">
					</a>
				</div>
			</div>
		</div>
</section>

	    <section class="normalSection" id="Quote">
          <div class="content nopaddingBottom">
              <h1 class="Heav textGrey">
                COTIZA TUS PRODUCTOS
              </h1>
              <div class="col-xs-12 nopadding" style="border: 1px solid rgba(0, 0, 0, 0.10);">
                <div class="col-xs-12 noHorizontalPadding" id="lineas">
                      <?php
                          if ($Lineas):
                          $counter=0;
                          foreach ($Lineas->result() as $row):
                          $active = ($counter == 0) ? "active" : "";
                      ?>
                  <a href="<?=$counter?>" class="col-xs-12 col-md-3 semi-bold text-center tabPer tab<?=$counter?> <?=$active;?>"><?=$row->Etiqueta;?></a>
                      <?php
                        $counter++;
                          endforeach;
                          endif;
                      ?>
                </div>
                <div class="col-xs-12 noHorizontalPadding verticalPadding backWhite" id="contentTabs">
                <?php foreach ($LineasSublinea as $linea => $arraySublineas): ?>
                  <div class="col-xs-12 text-center" id="<?=$key;?>">
                    <div class="col-xs-11 centered nopadding slide_sublineas">
                    <?php foreach ($arraySublineas as $position => $arrayDatos): ?>
                      <div class="col-xs-12">
                        <a href="<?=$arrayDatos['IdSubLinea'];?>" name="<?=$arrayDatos['Sublinea'];?>" class="goProductosSublinea IdSubLinea<?=$arrayDatos['IdSubLinea'];?>">
													<div>
														<div class="vertical">
															<img src="assets/img/Sublineas/<?=$arrayDatos['IdSubLinea'];?>/img.png" alt="" class="col-xs-12">
														</div>
													</div>
                          <span class="bold textGrey"><?=$arrayDatos['Sublinea'];?></span>
                        </a>
                      </div>
                    <?php endforeach ?>
                    </div>
                    <a href="" class="arrow left"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                    <a href="" class="arrow right"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                  </div>
                <?php endforeach ?>
                </div>
              </div>

            </div>
      </section>



      <section class="normalSection" id="ProductosCotizacion">
          <div class="content nopaddingBottom">

              <div class="col-xs-12 nopadding backWhite centered text-left" style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                <div class="col-xs-12" id="topBarCarrito">
                  <div class="col-xs-8 nopadding" style="height: 50px;">
                    <div class="col-xs-12 nopadding vertical">
                      <h3 class="vertical textBlack nomargin bold">PRODUCTOS PARA COTIZAR</h3>
                    </div>
                  </div>
                  <div class="col-xs-4 nopadding" style="height: 50px;">
                    <div class="col-xs-12 nopadding vertical">
                      <div class="col-xs-12 nopadding">
                        <div class="col-xs-12 pull-right" style="width: 180px;">
                          <div class="col-xs-6 text-center" style="border-right: 1px solid #ddd;">
                            <a href="#" class="col-xs-12 nopadding">
                              <img src="assets/img/web/Icons/cart.svg" alt="" class="col-xs-12 nopadding" style="width: 35px;">
                              <div class="number <?=$colorClass;?>"><?=$noItemsOnCart;?></div>
                            </a>
                          </div>
                          <div class="col-xs-6 text-center">
                            <a href="#" class="chevrone_down col-xs-12 nopadding toggleCart">
                              <i class="fa fa-chevron-down textRed" aria-hidden="true"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 nopadding partCart">
                  <div class="col-xs-12 nopadding" id="tittleTables">
                    <div class="col-xs-4 verticalPadding text-center"><h4 class="textBlack nomargin bold">Producto</h4></div>
                    <div class="col-xs-3 verticalPadding text-center"><h4 class="textBlack nomargin bold">Cantidad</h4></div>
                    <div class="col-xs-2 verticalPadding text-center"><h4 class="textBlack nomargin bold">Precio</h4></div>
                    <div class="col-xs-2 verticalPadding text-center"><h4 class="textBlack nomargin bold">Importe</h4></div>
                    <div class="col-xs-1 verticalPadding text-center hidden-xs"><h4 class="textBlack nomargin bold"><small style="font-size: 75% !important;">Eliminar</small></h4></div>
                  </div>
                  <div class="col-xs-12 nopadding" id="containerItemsCart">
                  <?php
                    foreach ($Cart as $item):
                    $totalPrecioByProducto=$item['qty']*$item['price'];
                  ?>
                    <div class="col-xs-12 item" id="<?=$item['id'];?>">
                      <div class="col-xs-4">
                        <div class="col-xs-12 nopadding vertical">
                          <div class="col-xs-12 vertical nopadding text-center">
                            <h3 class="regular nomargin"><?=$item['name'];?></h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-3 containerNoItems">
                        <div class="col-xs-12 nopadding vertical">
                          <div class="col-xs-12 nopadding vertical">
                            <div class="col-xs-4 nopadding text-center">
                              <a href="#" class="square centered action" act="minus">-</a>
                            </div>
                            <div class="col-xs-4 nopadding text-center">
                              <input type="text" class="square centered" id="qty" name="qty" rowid="<?=$item['rowid'];?>" value="<?=$item['qty'];?>">
                              <input type="hidden" id="price" name="price" value="<?=$item['price'];?>">
                            </div>
                            <div class="col-xs-4 nopadding text-center">
                              <a href="#" class="square centered action" act="plus">+</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-2">
                        <div class="col-xs-12 nopadding vertical">
                          <div class="col-xs-12 nopadding vertical text-center">
                            <span>S/ <?=$item['price'];?></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-2">
                        <div class="col-xs-12 nopadding vertical">
                          <div class="col-xs-12 nopadding vertical text-center">
                            <span id="<?=$item['rowid'];?>"><?=$totalPrecioByProducto;?></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-1">
                        <div class="col-xs-12 nopadding vertical">
                          <div class="col-xs-12 nopadding vertical text-center">
                            <a onclick="deleteItemFromCart(<?=$item['id'];?>);"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  endforeach
                  ?>
                  </div>
                </div>
                <div class="col-xs-12 text-center vpadding partCart">
                  <div class="col-xs-12 centered vxpadding nopaddingBottom noHorizontalPadding">
                    <form id="CotizacionDatosCliente">
                      <div class="col-xs-12 col-sm-6 col-md-3 nomarginTop" style="margin: 15px 0px;">
                        <input type="text" name="nombre" id="nombre" class="Style1">
                        <span class="placeholder">Nombre y apellidos *</span>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-3 nomarginTop" style="margin: 15px 0px;">
                        <input type="text" name="correo" id="correo" class="Style1 group">
                        <span class="placeholder">Correo *</span>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-3 nomarginTop" style="margin: 15px 0px;">
                        <input type="text" name="telefono" id="telefono" class="Style1 group">
                        <span class="placeholder">Telefono *</span>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-3 nomarginTop" style="margin: 15px 0px;">
                        <input type="text" name="empresa" id="empresa" class="Style1">
                        <span class="placeholder">Nombre de la empresa</span>
                      </div>
                      <div class="col-xs-12 text-left">
                        <p class="bold">Observaciones</p>
                        <textarea name="observaciones" id="observaciones" cols="30" rows="5" class="col-xs-12"></textarea>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-xs-12 vpadding nopaddingTop partCart">
                  <a href="#" class="Button1 pull-right submitCotizacionProductos"><span class="textWhite">OBTENER COTIZACIÓN</span><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                  <a href="#" class="ButtonBack pull-right" form="CotizacionDatosCliente"><img src="assets/img/web/Icons/left-arrow.svg" alt=""><span class="textWhite">VOLVER ATRAS</span></a>
                </div>
              </div>

        </div>
      </section>



      <section class="normalSection" id="ProductosCotizar">
          <div class="content">

              <div class="col-xs-12 nopadding backWhite centered text-left" style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                <div class="col-xs-12" id="toggleProductosCotizar">
                  <div class="col-xs-8 nopadding" style="height: 75px;">
                    <div class="col-xs-12 nopadding vertical">
                      <div class="col-xs-12 nopadding vertical" id="labels">
                        <h5 class="textBlack light nomargin"></h5>
                        <h3 class="textBlack nomargin bold text-uppercase">Selecciona una sublinea</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-4 nopadding" style="height: 50px;">
                    <div class="col-xs-12 nopadding vertical">
                      <div class="col-xs-12 nopadding">
                        <div class="col-xs-12 pull-right" style="width: 220px;">
                          <div class="col-xs-6 text-center">
                          </div>
                          <div class="col-xs-6 text-center nopadding">
                            <a href="#" class="chevrone_down col-xs-12 nopadding toggleProductosResult">
                              <i class="fa fa-chevron-down textRed" aria-hidden="true"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 nopadding" id="containerProductos">

                </div>
              </div>

        </div>
      </section>

      <section class="normalSection Footer" id="ProductosCotizar">
        <div class="content full nopaddingBottom">

              <div class="col-xs-12 nopadding">
                <div class="col-xs-6 nopadding">
                  <div class="col-xs-12 nopadding container1 text-center">
                    <div class="col-xs-12 vertical">
                      <h4 class="textWhite bold text-uppercase">METODOS DE PAGO</h4>
                      <div class="col-xs-12 text-center nopadding">
                        <div class="col-xs-12 centered" style="width: auto;">
                          <a href="#" class="textWhite icon">
                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                          </a>
                          <a href="#" class="textWhite icon">
                            <i class="fa fa-cc-visa" aria-hidden="true"></i>
                          </a>
                          <a href="#" class="textWhite icon">
                            <i class="fa fa-cc-mastercard" aria-hidden="true"></i>
                          </a>
                          <a href="#" class="textWhite icon">
                            <i class="fa fa-cc-diners-club" aria-hidden="true"></i>
                          </a>
                          <a href="#" class="textWhite icon">
                            <i class="fa fa-cc-paypal" aria-hidden="true"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 nopadding container2 text-center">
                    <div class="col-xs-12 vertical">
                      <h4 class="textWhite bold text-uppercase">Encuentranos tambien en:</h4>
                      <div class="col-xs-12 text-center nopadding">
                        <div class="col-xs-12 centered" style="width: auto;">
                          <a href="#" class="textWhite icon2">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                          </a>
                          <a href="#" class="textWhite icon2">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                          </a>
                          <a href="#" class="textWhite icon2">
                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                          </a>
                          <a href="#" class="textWhite icon2">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6 container3 nopadding">
                  <div class="col-xs-12 vertical text-center">
                    <div class="col-xs-12 text-center">
                      <img class="col-xs-10 col-md-8 vpadding nopaddingTop centered" src="assets/img/site/logo_white.png" alt="">
                      <h3 class="textWhite vxpadding nopaddingTop">Av. Marginal 603 Urb. Javier Prado Oeste</h3>
                    </div>
                    <div class="col-xs-12 text-center">
                      <a href="#"><h4 class="textWhite">NOSOTROS</h4></a>
                      <a href="#"><h4 class="textWhite">CONTACTENOS</h4></a>
                      <a href="#"><h4 class="textWhite">TERMINOS Y CONDICIONES</h4></a>
                      <a href="#"><h4 class="textWhite">SEGURIDAD Y PRIVACIDAD</h4></a>
                      <a href="#"><h4 class="textWhite">TRABAJA CON NOSOTROS</h4></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 copyright text-center vpadding">
                <h4 class="">2017 INNOVALED PERU S.A.C. | Todos los derechos reservados</h4>
              </div>

        </div>
      </section>

<div class="modal-options" data-izimodal-group="group1" data-izimodal-loop="" data-izimodal-title="La cotizacion ha sido enviada." data-izimodal-subtitle="Recibira una copia en el correo proporcionado">
  <p style="padding: 15px;">En un momento procesaremos su cotizacion y no contactaremos con usted. Buen día¡</p>
</div>
<div class="beforeSend" data-izimodal-title="Enviando cotización" data-izimodal-subtitle="Espere un momento."></div>
