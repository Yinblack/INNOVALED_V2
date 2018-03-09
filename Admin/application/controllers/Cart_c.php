<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
  				$this->load->model('Producto_m');
  				$this->load->model('Cotizacion_m');
					$this->load->model('Configuracion_m');
  				$this->load->library('cart');
	}

  function hasContent(){
    if ($this->cart->total_items() > 0) {
      echo "Success";
    }else{
      echo "Error";
    }
  }

	public function addProductoToCart(){
		$IdProducto =$_POST['IdProducto'];
		$Qty        =$_POST['Cantidad'];
    if ($Qty==0) {
      echo "Cantidad";
    }else{
		  $Producto=$this->Producto_m->getProductoByIdFix($IdProducto);
		  $porcentajeDescuento=$this->Cotizacion_m->getPrecioDescuento($IdProducto, $Qty);
		  if ($porcentajeDescuento!=false) {
		  	$precioUnitario=$Producto['Precio']-(($Producto['Precio']*$porcentajeDescuento)/100);
		  }else{
		  	$precioUnitario=$Producto['Precio'];
		  }
		  $dataProducto = array(
		      'id'      => $IdProducto,
		      'qty'     => $Qty,
		      'price'   => $precioUnitario,
		      'name'    => $Producto['NombreProducto'],
		      'marca'    => $Producto['Marca']
		  );
		  if ($this->cart->insert($dataProducto)) {
		  	echo 'Success';
		  }else{
		  	echo "Error";
		  }
    }
	}

  public function deleteProductoFromCart(){
    $IdProducto =$_POST['IdProducto'];
    foreach ($this->cart->contents() as $items){
      if ($items['id']==$IdProducto) {
        $rowid=$items['rowid'];
      }
    }
    if ($this->cart->remove($rowid)) {
      echo "Success";
    }else{
      echo "Error";
    }
  }

  public function getProductosFromCarrito(){
    $configuracion=$this->Configuracion_m->getConfiguracion();
    $iva=$configuracion['ImpuestoPorcentaje']/100;
    if ($this->cart->contents()) {
      $html='';
      $counter=1;
      $SubtotalGeneral=0;
      foreach ($this->cart->contents() as $item){
        $IdProducto=$item['id'];
        $Nombre=$item['name'];
        $Cantidad=$item['qty'];
        $Precio=$item['price'];
        $Subtotal=$Cantidad*$Precio;
        $SubtotalGeneral=$SubtotalGeneral+$Subtotal;
        $PrecioFormateado=number_format($Precio, 2, '.', ',');
        $SubtotalFormateado=number_format($Subtotal, 2, '.', ',');
        $rowId=$item['rowid'];
        $html.='
          <tr id="'.$IdProducto.'" IdProducto="'.$IdProducto.'">
            <th scope="row">'.$counter.'</th>
            <td class="text-left">'.$Nombre.'</td>
            <td>
              <div class="col-xs-12 nopadding dicrease">
                  <div class="input">
                      <input type="text" value="'.$Cantidad.'" class="Cantidad'.$IdProducto.'">
                  </div>
                  <a href="#" class="minus">
                      <img src="assets/img/minusGrey.svg" alt="">
                  </a>
                  <a href="#" class="plus">
                      <img src="assets/img/plusGrey.svg" alt="">
                  </a>
              </div>
            </td>
            <td class="precio" precio="'.$PrecioFormateado.'">'.$PrecioFormateado.'</td>
            <td class="importe" importe="'.$SubtotalFormateado.'">'.$SubtotalFormateado.'</td>
            <td>
              <a href="#" class="delete" onclick="deleteProductoFromCartModal('.$IdProducto.');">
                <img src="assets/img/delete.svg" alt=""/>
              </a>
            </td>
          </tr>
        ';
        $counter++;
      }
      $SubtotalGeneralConIva=($SubtotalGeneral*$iva)+$SubtotalGeneral;
      $SubtotalGeneralFormateado=number_format($SubtotalGeneral, 2, '.', ',');
      $SubtotalGeneralConIvaFormateado=number_format($SubtotalGeneralConIva, 2, '.', ',');
      $html.='
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>Subtotal</td>
          <td id="subtotal">'.$SubtotalGeneralFormateado.'</td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>Total(IGV: '.$iva.')</td>
          <td id="total" iva="'.$iva.'">'.$SubtotalGeneralConIvaFormateado.'</td>
          <td></td>
        </tr>
      ';
      print_r($html);
    }else{
      echo "Carrito vacio";
    }
  }

	public function uploadQtyCart(){
    $IdProducto =$_POST['IdProducto'];
    $Value      =$_POST['Value'];

		foreach ($this->cart->contents() as $item){
			if ($item['id']==$IdProducto){
				$rowid=$item['rowid'];
			}
		}

		$Producto=$this->Producto_m->getProductoByIdFix($IdProducto);
		$porcentajeDescuento=$this->Cotizacion_m->getPrecioDescuento($IdProducto, $Value);
		if ($porcentajeDescuento!=false) {
			$precioUnitario=$Producto['Precio']-(($Producto['Precio']*$porcentajeDescuento)/100);
		}else{
			$precioUnitario=$Producto['Precio'];
		}
		$data = array(
				'rowid'  => $rowid,
				'price'   => $precioUnitario,
				'qty' => $Value
		);
		if ($this->cart->update($data)) {
			echo "Success";
		}else{
			echo "Error";
		}
	}

/*COTIZACION SERVICIOS*/
  public function sendCotizacionServicio(){

    $proyecto      =$this->input->post('proyecto');
    $tipoPantalla  =$this->input->post('tipoPantalla');
    $ambiente      =$this->input->post('ambiente');
    $largo         =$this->input->post('largo');
    $ancho         =$this->input->post('ancho');
    $calidad       =$this->input->post('calidad');
    $nombre        =$this->input->post('nombre');
    $correo        =$this->input->post('correo');
    $telefono      =$this->input->post('telefono');
    $empresa       =$this->input->post('empresa');
    $observaciones =$this->input->post('observaciones');

		$word = iconv('UTF-8', 'windows-1252', 'INNOVALED PERÚ SAC');
		$cotizacion = iconv('UTF-8', 'windows-1252', 'Cotización');
		$Direccion=iconv('UTF-8', 'windows-1252', 'Dirección');
		$Telefono=iconv('UTF-8', 'windows-1252', 'Teléfono');
		$Descripcion=iconv('UTF-8', 'windows-1252', 'Descripción');
		$No=iconv('UTF-8', 'windows-1252', 'Nº');
		$termino1=iconv('UTF-8', 'windows-1252', '* Los valores comerciales  de la pre-cotización puede variar segun su posterior negociación con los asesores comerciales');
		$termino2=iconv('UTF-8', 'windows-1252', '* La pre-cotización tienen un tiempo de validez de 30 días.');

    date_default_timezone_set('America/Mexico_City');
    $date = date('d-m-Y H:i:s');
      $mensaje='';
            $mensaje .= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Skyline Invoice Email</title>
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Lato:400);
    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }
    a {
      text-decoration: none;
      border: 0;
      outline: none;
    }
    a img {
      border: none;
    }
    td, h1, h2, h3  {
      font-family: Helvetica, Arial, sans-serif;
      font-weight: 400;
    }
    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #ffffff;
    }
     table {
      border-collapse: collapse !important;
    }
    h1, h2, h3 {
      padding: 0;
      margin: 0;
      color: #ffffff;
      font-weight: 400;
    }
    h3 {
      color: #21c5ba;
      font-size: 24px;
    }
    .important-font {
      color: #21BEB4;
      font-weight: bold;
    }
    .hide {
      display: none !important;
    }
    .force-full-width {
      width: 100% !important;
    }
  </style>
  <style type="text/css" media="screen">
    @media screen {
      td, h1, h2, h3 {
        font-family: "Lato", "Helvetica Neue", "Arial", "sans-serif" !important;
      }
    }
  </style>
  <style type="text/css" media="only screen and (max-width: 480px)">
    @media only screen and (max-width: 480px) {
      table[class="w320"] {
        width: 320px !important;
      }
      table[class="w300"] {
        width: 300px !important;
      }
      table[class="w290"] {
        width: 290px !important;
      }
      td[class="w320"] {
        width: 320px !important;
      }
      td[class="mobile-center"] {
        text-align: center !important;
      }
      td[class="mobile-padding"] {
        padding-left: 20px !important;
        padding-right: 20px !important;
        padding-bottom: 20px !important;
      }
      td[class="mobile-block"] {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        padding-bottom: 20px !important;
      }
      td[class="mobile-border"] {
        border: 0 !important;
      }
      td[class*="reveal"] {
        display: block !important;
      }
    }
  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" >
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td valign="top">
          <center>
            <table cellspacing="0" cellpadding="0" width="900" class="w320">
              <tr>
                <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" width="95%">
                  <tr>
                    <td class="mobile-padding">
                      <!--Header -->
                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="mobile-block" width="30%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" valign="bottom" style="border-right:1px solid #ddd; height: 60px; background-color: #ffffff;color: #071a26;padding: 5px 5px 5px 5px;font-weight: 900; text-align: center;">
                                  <img width="200" height="25" style="margin: 5px 0px;" src="https://www.innovaled.pe/assets/img/logo_grey.png">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="70%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" valign="bottom" style="background-color: #ffffff;color: #071a26;font-weight: 900;height: 60px;padding: 0px 15px;font-size: 20px;line-height: 2;">
                                  '.$word.'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="mobile-block" width="30%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" valign="top" style="border-right:1px solid #ddd; height: 60px; background-color: #ffffff;color: #071a26;padding: 5px 5px 5px 5px;font-weight: 900; text-align: center;">
                                  '.$word.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="35%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td valign="top" style="background-color: #ffffff;color: #071a26;font-weight: 300; height: 60px; padding: 0px 15px;" align="left">
                                  '.$cotizacion.' '.$No.' ( 000 )
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="35%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td valign="top" style="background-color: #ffffff;color: #071a26;font-weight: 300; height: 60px; padding: 0px 15px;" align="right">
                                  Fecha: '.$date.'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td valign="top">
          <center>
            <table cellspacing="0" cellpadding="0" width="900" class="w320">
              <tr>
                <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" width="95%">
                  <tr>
                    <td class="mobile-padding">
                      <!--Datos de empresa -->
                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="mobile-block" width="33%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #ffffff;color: #071a26;padding: 25px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">
                                  RUC
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                  20547636202
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="33%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #ffffff;color: #071a26;padding: 25px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">
                                  '.$Telefono.'
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                  +51 1 393 4964
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="34%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #ffffff;color: #071a26;padding: 25px 5px 0px 5px;font-weight: 900;">
                                  Email
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                contacto@innovaled.pe
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="33%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #ffffff;color: #071a26;padding: 5px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">
                                  '.$Direccion.'
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                  Av. Marginal 603 Urb. Javier Prado Este
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="33%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #ffffff;color: #071a26;padding: 5px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">
                                  Web
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                  www.innovaled.pe
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="34%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #ffffff;color: #071a26;padding: 5px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">

                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">

                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td valign="top">
          <center>
            <table cellspacing="0" cellpadding="0" width="900" class="w320" bgcolor="#ededed">
              <tr>
                <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" width="95%">
                  <tr>
                    <td class="mobile-padding">
                      <!--Datos cliente -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ededed">
                        <tr>
                          <td style="text-align: left; font-weight: 900; color: #071a26; padding: 25px 0px 8px 5px; font-size: 16px;">
                            Datos del cliente
                            <br>
                            <br>
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 0px 5px;font-weight: 300; font-size: 15px;">
                                  Nombre
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 0px 5px;font-weight: 300; font-size: 15px;">
                                  Empresa
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 0px 5px;font-weight: 300; font-size: 15px;">
                                  Telefono
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 0px 5px;font-weight: 300; font-size: 15px;">
                                  Correo
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 20px 5px;font-weight: 700;">
                                  '.$nombre.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 20px 5px;font-weight: 700;">
                                  '.$empresa.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 20px 5px;font-weight: 700;">
                                  '.$telefono.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 20px 5px;font-weight: 700;">
                                  '.$correo.'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--WHITE SPACE -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                        <tr>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--  HEADER PRODUCTOS -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ededed">
                        <tr>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  Proyecto
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  Tipo
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  Ambiente
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  Largo y ancho
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  Calidad
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>

                      <!--  PRODUCTOS -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                        <tr>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                  '.$proyecto.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                  '.$tipoPantalla.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                  '.$ambiente.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                  '.$largo.' * '.$ancho.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="20%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                  '.$calidad.'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--WHITE SPACE -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                        <tr>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>

                      <!--TERMINOS Y CONDICIONES -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ededed">
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 16px; font-weight: 900; padding: 15px 0px;">
                            Terminos y condiciones
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 15px; font-weight: 300; padding: 10px 10px 10px 0px;">
                            '.$termino1.'
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 15px; font-weight: 300; padding: 10px 10px 10px 0px;">
                            '.$termino1.'
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 15px; font-weight: 300; padding: 10px 10px 10px 0px;">
                            * Limitado al stock actual de la empresa
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 15px; font-weight: 300; padding: 10px 10px 10px 0px;">
                            * Los precios no incluyen envio.
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td valign="top">
          <center>
            <table cellspacing="0" cellpadding="0" width="900" class="w320" bgcolor="#071b27" style="background-color: #071b27;">
              <tr>
                <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" width="95%">
                  <tr>
                    <td class="mobile-padding">
                      <!--FOOTER -->
                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="mobile-block" width="100%">
													<a class="color: #fff;" href="https://goo.gl/CJbHYS">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="padding: 15px 0px 10px 0px; color: #fff;" align="center">
                                  Obtén tu propio cotizador automático aquí <img width="25" height="25" style="margin: -8px 0px;" src="https://www.innovaled.pe/assets/img/plane.png">
                                </td>
                              </tr>
                            </table>
													</a>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>
      ';
      $subject = stripslashes('Cotizacion Innovaled - Proyecto');
      $subject = iconv('UTF-8', 'windows-1252', $subject);

      require_once(APPPATH.'libraries/phpmailer/PHPMailerAutoload.php');
      $mail = new PHPMailer;
      //$mail->SMTPDebug = 3;                               // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'in-v3.mailjet.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = '312aee5a0d2831720b12e1f3cc069e18';                 // SMTP username
      $mail->Password = 'cfd5c6b31a51a06e5b13d7f6c80d2494';                           // SMTP password
      $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 25;                                    // TCP port to connect to

			$mail->setFrom('ventas@innovaled.pe', $subject);
			$email=$this->Configuracion_m->getConfiguracion();
			if ($email['Correo1']!='') {
				$emaila=$email['Correo1'];
				$mail->addAddress($emaila);
			}
			if ($email['Correo2']!='') {
				$emailb=$email['Correo2'];
				$mail->addAddress($emailb);
			}
			if ($email['Correo3']!='') {
				$emailc=$email['Correo3'];
				$mail->addAddress($emailc);
			}
			if ($email['Correo4']!='') {
				$emaild=$email['Correo4'];
				$mail->addAddress($emaild);
			}
			if ($email['Correo5']!='') {
				$emaile=$email['Correo5'];
				$mail->addAddress($emaile);
			}

      $mail->addAddress($correo, 'Custom');     // Add a recipient
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = $subject;
      $mail->Body    = $mensaje;
      $mail->AltBody = '';

      if(!$mail->send()) {
          echo 'Ocurrio un error al enviar el mensaje (Por favor intentelo nuevamente).';
      } else {
        $dataPersona = array(
          'NombreCliente' => $nombre,
          'Correo'        => $correo,
          'Telefono'      => $telefono,
          'Empresa'       => $empresa,
          'Descripcion'   => $observaciones,
          'Tipo'          => 'servicio'
          );
        $dataServicio = array(
          'Proyecto'    => $proyecto,
          'Tipo'        => $tipoPantalla,
          'Ambiente'    => $ambiente,
          'Dimensiones' => $largo.'x'.$ancho,
          'Calidad'     => $calidad
          );
          $this->saveCotizacionServicio($dataPersona,$dataServicio);
      }

  }

  public function saveCotizacionServicio($dataPersona,$dataServicio){
    $IdCotizacion=$this->Cotizacion_m->saveCotizacion($dataPersona);
      if ($IdCotizacion!=false) {
        $dataServicio['IdCotizacion']=$IdCotizacion;
        if ($this->Cotizacion_m->saveCotizacionServicio($dataServicio)) {
          $estatus=true;
        }else{
          $estatus=false;
        }
      }
      if ($estatus) {
        echo 'success';
      }
  }

/*COTIZACION PRODUCTOS*/
	public function sendCotizacion(){
		$nombre        =$this->input->post('nombre');
		$correo        =$this->input->post('correo');
		$telefono      =$this->input->post('telefono');
		$empresa       =$this->input->post('empresa');
		$observaciones =$this->input->post('observaciones');

		$word = iconv('UTF-8', 'windows-1252', 'INNOVALED PERÚ SAC');
		$cotizacion = iconv('UTF-8', 'windows-1252', 'Cotización');
		$Direccion=iconv('UTF-8', 'windows-1252', 'Dirección');
		$Telefono=iconv('UTF-8', 'windows-1252', 'Teléfono');
		$Descripcion=iconv('UTF-8', 'windows-1252', 'Descripción');
		$No=iconv('UTF-8', 'windows-1252', 'Nº');
		$termino1=iconv('UTF-8', 'windows-1252', '* Los valores comerciales  de la pre-cotización puede variar segun su posterior negociación con los asesores comerciales');
		$termino2=iconv('UTF-8', 'windows-1252', '* La pre-cotización tienen un tiempo de validez de 30 días.');
		date_default_timezone_set('America/Mexico_City');
		$date = date('d-m-Y H:i:s');
			$mensaje='';
            $mensaje .= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Skyline Invoice Email</title>
  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Lato:400);
    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }
    a {
      text-decoration: none;
      border: 0;
      outline: none;
    }
    a img {
      border: none;
    }
    td, h1, h2, h3  {
      font-family: Helvetica, Arial, sans-serif;
      font-weight: 400;
    }
    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #ffffff;
    }
     table {
      border-collapse: collapse !important;
    }
    h1, h2, h3 {
      padding: 0;
      margin: 0;
      color: #ffffff;
      font-weight: 400;
    }
    h3 {
      color: #21c5ba;
      font-size: 24px;
    }
    .important-font {
      color: #21BEB4;
      font-weight: bold;
    }
    .hide {
      display: none !important;
    }
    .force-full-width {
      width: 100% !important;
    }
  </style>
  <style type="text/css" media="screen">
    @media screen {
      td, h1, h2, h3 {
        font-family: "Lato", "Helvetica Neue", "Arial", "sans-serif" !important;
      }
    }
  </style>
  <style type="text/css" media="only screen and (max-width: 480px)">
    @media only screen and (max-width: 480px) {
      table[class="w320"] {
        width: 320px !important;
      }
      table[class="w300"] {
        width: 300px !important;
      }
      table[class="w290"] {
        width: 290px !important;
      }
      td[class="w320"] {
        width: 320px !important;
      }
      td[class="mobile-center"] {
        text-align: center !important;
      }
      td[class="mobile-padding"] {
        padding-left: 20px !important;
        padding-right: 20px !important;
        padding-bottom: 20px !important;
      }
      td[class="mobile-block"] {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        padding-bottom: 20px !important;
      }
      td[class="mobile-border"] {
        border: 0 !important;
      }
      td[class*="reveal"] {
        display: block !important;
      }
    }
  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" >
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td valign="top">
          <center>
            <table cellspacing="0" cellpadding="0" width="900" class="w320">
              <tr>
                <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" width="95%">
                  <tr>
                    <td class="mobile-padding">
                      <!--Header -->
                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="mobile-block" width="30%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" valign="bottom" style="border-right:1px solid #ddd; height: 60px; background-color: #ffffff;color: #071a26;padding: 5px 5px 5px 5px;font-weight: 900; text-align: center;">
                                  <img width="200" height="25" style="margin: 5px 0px;" src="https://www.innovaled.pe/assets/img/logo.png">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="70%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" valign="bottom" style="background-color: #ffffff;color: #071a26;font-weight: 900;height: 60px;padding: 0px 15px;font-size: 20px;line-height: 2;">
                                  '.$word.'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="mobile-block" width="30%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" valign="top" style="border-right:1px solid #ddd; height: 60px; background-color: #ffffff;color: #071a26;padding: 5px 5px 5px 5px;font-weight: 900; text-align: center;">
                                  '.$word.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="35%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td valign="top" style="background-color: #ffffff;color: #071a26;font-weight: 300; height: 60px; padding: 0px 15px;" align="left">
                                  '.$cotizacion.' '.$No.' ( 000 )
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="35%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td valign="top" style="background-color: #ffffff;color: #071a26;font-weight: 300; height: 60px; padding: 0px 15px;" align="right">
                                  Fecha: '.$date.'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td valign="top">
          <center>
            <table cellspacing="0" cellpadding="0" width="900" class="w320">
              <tr>
                <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" width="95%">
                  <tr>
                    <td class="mobile-padding">
                      <!--Datos de empresa -->
                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="mobile-block" width="33%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #ffffff;color: #071a26;padding: 25px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">
                                  RUC
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                  20547636202
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="33%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #ffffff;color: #071a26;padding: 25px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">
                                  '.$Telefono.'
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                  +51 1 393 4964
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="34%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #ffffff;color: #071a26;padding: 25px 5px 0px 5px;font-weight: 900;">
                                  Email
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                contacto@innovaled.pe
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="33%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #ffffff;color: #071a26;padding: 5px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">
                                  '.$Direccion.'
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                  Av. Marginal 603 Urb. Javier Prado Este
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="33%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #ffffff;color: #071a26;padding: 5px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">
                                  Web
                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">
                                  www.innovaled.pe
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="34%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #ffffff;color: #071a26;padding: 5px 5px 0px 5px;border-right: 3px solid #ffffff;font-weight: 900;">

                                </td>
                              </tr>
                              <tr>
                                <td style="    background-color: #ffffff;padding: 5px 8px 22px 5px;border-top: 3px solid #ffffff;">

                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td valign="top">
          <center>
            <table cellspacing="0" cellpadding="0" width="900" class="w320" bgcolor="#ededed">
              <tr>
                <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" width="95%">
                  <tr>
                    <td class="mobile-padding">
                      <!--Datos cliente -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ededed">
                        <tr>
                          <td style="text-align: left; font-weight: 900; color: #071a26; padding: 25px 0px 8px 5px; font-size: 16px;">
                            Datos del cliente
                            <br>
                            <br>
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 0px 5px;font-weight: 300; font-size: 15px;">
                                  Nombre
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 0px 5px;font-weight: 300; font-size: 15px;">
                                  Empresa
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 0px 5px;font-weight: 300; font-size: 15px;">
                                  Telefono
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 0px 5px;font-weight: 300; font-size: 15px;">
                                  Correo
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 20px 5px;font-weight: 700;">
                                  '.$nombre.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 20px 5px;font-weight: 700;">
                                  '.$empresa.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 20px 5px;font-weight: 700;">
                                  '.$telefono.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #f5f5f5;color: #071a26;padding: 5px 5px 20px 5px;font-weight: 700;">
                                  '.$correo.'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--WHITE SPACE -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                        <tr>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--  HEADER PRODUCTOS -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ededed">
                        <tr>
                          <td class="mobile-block" align="center" width="5%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  '.$No.'
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="50%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  '.$Descripcion.' del producto
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="15%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  Cantidad
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="15%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  Precio U
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="15%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="background-color: #083c5c;color: #f2f2f2; text-align: center; padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;">
                                  Importe total
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>';
                      $counter=0;
                      $subTotal=0;
                      $configuracion=$this->Configuracion_m->getConfiguracion();
                      $impuesto=$configuracion['ImpuestoPorcentaje']/100;
                      foreach ($this->cart->contents() as $item){
                      	$counter++;
												$porcentajeDescuento=$this->Cotizacion_m->getPrecioDescuento($item['id'], $item['qty']);
												if ($porcentajeDescuento!=false) {
													$precioUnitario=$item['price']-(($item['price']*$porcentajeDescuento)/100);
												}else{
													$precioUnitario=$item['price'];
												}
                      	$subTotal=$subTotal+($precioUnitario*$item['qty']);
                      	$subTotalFormated=number_format($subTotal, 2);

	                    	$Impuestos=$subTotal*$impuesto;
	                    	$Impuestos=number_format($Impuestos, 2);

                      	$subTotalPorProducto=$precioUnitario*$item['qty'];
                      	$subTotalPorProducto = number_format($subTotalPorProducto, 2);
                        $mensaje.='
                          <!--  PRODUCTOS -->
                          <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                            <tr>
                              <td class="mobile-block" align="center" width="5%">
                                <table cellspacing="0" cellpadding="0" class="force-full-width">
                                  <tr>
                                    <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                      '.$counter.'
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td class="mobile-block" align="center" width="50%">
                                <table cellspacing="0" cellpadding="0" class="force-full-width">
                                  <tr>
                                    <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                      '.$item['name'].'
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td class="mobile-block" align="center" width="15%">
                                <table cellspacing="0" cellpadding="0" class="force-full-width">
                                  <tr>
                                    <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                      '.$item['qty'].'
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td class="mobile-block" align="center" width="15%">
                                <table cellspacing="0" cellpadding="0" class="force-full-width">
                                  <tr>
                                    <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                      '.$precioUnitario.'
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td class="mobile-block" align="center" width="15%">
                                <table cellspacing="0" cellpadding="0" class="force-full-width">
                                  <tr>
                                    <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 50px;">
                                      '.$subTotalPorProducto.'
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>';
                        }
                      $mensaje.='
                      <!--  SUBTOTAL -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#f8fafa">
                        <tr>
                          <td class="mobile-block" align="center" width="70%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 25px;">

                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="15%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 25px;">
                                  Sub total
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="15%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 700;font-size: 16px;border-bottom: 1px solid #ddd;height: 25px;">
                                  '.$subTotalFormated.'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--  SUBTOTAL -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#f8fafa">
                        <tr>
                          <td class="mobile-block" align="center" width="70%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 25px;">

                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="15%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 25px;">
                                  Impuestos
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="15%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 700;font-size: 16px;border-bottom: 1px solid #ddd;height: 25px;">
                                  '.$Impuestos.'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--  TOTAL -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#071a26">
                        <tr>
                          <td class="mobile-block" align="center" width="70%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd;height: 25px;">

                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="15%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 300;font-size: 15px;border-bottom: 1px solid #ddd; color: #fff; height: 25px;">
                                  Total
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" align="center" width="15%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="text-align: center;padding: 10px 5px 10px 5px;font-weight: 700;font-size: 16px;border-bottom: 1px solid #ddd; color: #fff; height: 25px;">
                                  '.number_format($subTotal+$Impuestos, 2).'
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--WHITE SPACE -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                        <tr>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="mobile-block" width="25%">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td style="height: 40px;">
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <!--TERMINOS Y CONDICIONES -->
                      <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ededed">
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 16px; font-weight: 900; padding: 15px 0px;">
                            Terminos y condiciones
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 15px; font-weight: 300; padding: 10px 10px 10px 0px;">
                            '.$termino1.'
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 15px; font-weight: 300; padding: 10px 10px 10px 0px;">
                            '.$termino2.'
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 15px; font-weight: 300; padding: 10px 10px 10px 0px;">
                            * Limitado al stock actual de la empresa
                          </td>
                        </tr>
                        <tr>
                          <td class="mobile-block" width="100%" style="font-size: 15px; font-weight: 300; padding: 10px 10px 10px 0px;">
                            * Los precios no incluyen envio.
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td valign="top">
          <center>
            <table cellspacing="0" cellpadding="0" width="900" class="w320" bgcolor="#071b27" style="background-color: #071b27;">
              <tr>
                <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" width="95%">
                  <tr>
                    <td class="mobile-padding">
                      <!--FOOTER -->
                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="mobile-block" width="100%">
													<a class="color: #fff;" href="https://goo.gl/CJbHYS">
                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="padding: 15px 0px 10px 0px; color: #fff;" align="center">
                                  Obtén tu propio cotizador automático aquí <img width="25" height="25" style="margin: -8px 0px;" src="https://www.innovaled.pe/assets/img/plane.png">
                                </td>
                              </tr>
                            </table>
													</a>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>

    </td>
  </tr>
</table>
</body>
</html>
			';
      $subject = stripslashes('Cotización Innovaled');
      $subject = iconv('UTF-8', 'windows-1252', $subject);
      require_once(APPPATH.'libraries/phpmailer/PHPMailerAutoload.php');
      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->Host = 'in-v3.mailjet.com';
      $mail->SMTPAuth = true;
      $mail->Username = '312aee5a0d2831720b12e1f3cc069e18';
      $mail->Password = 'cfd5c6b31a51a06e5b13d7f6c80d2494';
      $mail->SMTPSecure = 'TLS';
      $mail->Port = 587;
      $mail->setFrom('contacto@bloque9.net','Mailer');
			if ($configuracion['Correo1']!='') {
				$emaila=$configuracion['Correo1'];
				$mail->addAddress($emaila);
			}
			if ($configuracion['Correo2']!='') {
				$emailb=$configuracion['Correo2'];
				$mail->addAddress($emailb);
			}
			if ($configuracion['Correo3']!='') {
				$emailc=$configuracion['Correo3'];
				$mail->addAddress($emailc);
			}
			if ($configuracion['Correo4']!='') {
				$emaild=$configuracion['Correo4'];
				$mail->addAddress($emaild);
			}
			if ($configuracion['Correo5']!='') {
				$emaile=$configuracion['Correo5'];
				$mail->addAddress($emaile);
			}
			if ($correo!='') {
				$mail->addAddress($correo, 'Custom');
			}
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $mensaje;
			$mail->AltBody = '';
			if($mail->send()){
        $dataPersona = array(
          'NombreCliente' => $nombre,
          'Correo'        => $correo,
          'Telefono'      => $telefono,
          'Empresa'       => $empresa,
          'Descripcion'   => $observaciones,
          'Tipo'          => 'producto'
        );
        if ($this->saveCotizacionProducto($dataPersona)) {
          echo "Success";
        }else{
          echo "error al guardar en DB";
        }
			}else{
          print_r('Ocurrio un error al enviar el mensaje.');
          die();
			}
	}

	public function saveCotizacionProducto($dataPersona){
		$IdCotizacion=$this->Cotizacion_m->saveCotizacion($dataPersona);
		if ($IdCotizacion!=false) {
			foreach ($this->cart->contents() as $item){
				$dataCotizacionProducto = array(
					'IdCotizacion' => $IdCotizacion,
					'IdProducto'   => $item['id'],
					'Qty'          => $item['qty']
					);
				if ($this->Cotizacion_m->saveCotizacionProducto($dataCotizacionProducto)) {
					$this->cart->destroy();
          return true;
				}else{
					return false;
				}
			}
		}
	}

	public function CotizacionPdf(){
		$IdCotizacion=$_GET['IdCotizacion'];

		$dataCotizacion=$this->Cotizacion_m->getCotizacionFromId($IdCotizacion);
		$zeros='00000';
		if ($dataCotizacion['IdCotizacion']>=10) {
			$zeros='0000';
		}elseif ($dataCotizacion['IdCotizacion']>=100) {
			$zeros='000';
		}elseif ($dataCotizacion['IdCotizacion']>=1000) {
			$zeros='00';
		}elseif ($dataCotizacion['IdCotizacion']>=10000) {
			$zeros='0';
		}elseif ($dataCotizacion['IdCotizacion']>=100000) {
			$zeros='';
		}
		$IdCotizacionFormatted='CTZ-'.$zeros.$dataCotizacion['IdCotizacion'];
		$dataProductosByCotizacion=$this->Cotizacion_m->getProductosByCotizacion($IdCotizacion);
		$dataServiciosByCotizacion=$this->Cotizacion_m->getServiciosByCotizacion($IdCotizacion);

		date_default_timezone_set('America/Mexico_City');
		$date = date('d-m-Y H:i:s');

       	require_once(APPPATH.'libraries/fpdf/fpdf.php');
				$date = date_create();
				$unixToday=date_timestamp_get($date);
				$dir='assets/PDF/'.$unixToday.'/';
        if (!file_exists($dir)) {
        	mkdir($dir, 0777);
        }

				$Logo='assets/img/web/logo.png';
        $pdf = new FPDF('P','mm','A4');
        $pdf->SetAutoPageBreak(true);
				$pdf->SetTitle('Cotización Innovaled');
				$pdf->AddPage();

				$pdf->AddFont('OpensansRegular','','OpenSans-Regular.php');
				$pdf->AddFont('OpensansSemibold','','OpenSans-Semibold.php');
				$pdf->AddFont('OpensansBold','','OpenSans-Bold.php');
				$pdf->AddFont('OpensansExtraBold','','OpenSans-ExtraBold.php');

				/*LINEAS*/
				$pdf->SetLineWidth(.6);
				$pdf->SetDrawColor(1,1,64);
				$pdf->Line(86, 10, 86, 40);
				$pdf->Line(8, 40, 200, 40);

				$pdf->SetLineWidth(45);
				$pdf->SetDrawColor(237,237,237);
				$pdf->Line(30, 115, 180, 115);

				$pdf->SetLineWidth(20);
				$pdf->SetDrawColor(245,245,245);
				$pdf->Line(17.4, 120, 192.4, 120);

				$pdf->SetLineWidth(0.2);
				$pdf->SetDrawColor(0,0,0);

				/*HEADER*/
				$pdf->Image($Logo,10,17,70);
				$pdf->SetXY(16, 25);
				$pdf->SetFont('OpensansBold','',14);
				$pdf->Cell('50',8,iconv('UTF-8', 'windows-1252', 'INNOVALED PERÚ SAC'),'','','L');

				$pdf->SetXY(90, 18);
				$pdf->SetFont('OpensansBold','',18);
				$pdf->Cell('50',8,iconv('UTF-8', 'windows-1252', 'COTIZACIÓN'),'','','L');

				$pdf->Ln();
				$pdf->SetX(90);
				$pdf->SetFont('OpensansRegular','',12);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', 'N° '.$IdCotizacionFormatted),'','','L');

				$pdf->SetXY(10, 50);
				$pdf->SetFont('OpensansExtraBold','',12);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', 'RUC'),'','','L');
				$pdf->SetXY(10, 55);
				$pdf->SetFont('OpensansRegular','',11);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', '20547636202'),'','','L');

				$pdf->SetXY(78, 50);
				$pdf->SetFont('OpensansExtraBold','',12);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', 'Teléfono'),'','','L');
				$pdf->SetXY(78, 55);
				$pdf->SetFont('OpensansRegular','',11);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', '+51 1 393 4964'),'','','L');

				$pdf->SetXY(140, 50);
				$pdf->SetFont('OpensansExtraBold','',12);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', 'Email'),'','','L');
				$pdf->SetXY(140, 55);
				$pdf->SetFont('OpensansRegular','',11);
				$pdf->MultiCell('50',5,iconv('UTF-8', 'windows-1252', 'contacto@innovaled.pe'),'','L','');

				$pdf->SetXY(10, 70);
				$pdf->SetFont('OpensansExtraBold','',12);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', 'Dirección'),'','','L');
				$pdf->SetXY(10, 75);
				$pdf->SetFont('OpensansRegular','',11);
				$pdf->MultiCell('65',5,iconv('UTF-8', 'windows-1252', 'Av. Marginal 603 Urb. Javier Prado Este'),'','L','');

				$pdf->SetXY(78, 70);
				$pdf->SetFont('OpensansExtraBold','',12);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', 'Web'),'','','L');
				$pdf->SetXY(78, 75);
				$pdf->SetFont('OpensansRegular','',11);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', 'www.innovaled.pe'),'','','L');

				$pdf->SetXY(10, 98);
				$pdf->SetFont('OpensansExtraBold','',12);
				$pdf->Cell('50',5,iconv('UTF-8', 'windows-1252', 'Datos del cliente'),'','','L');

				$pdf->SetXY(10, 115);
				$pdf->SetFont('OpensansBold','',11);
				$pdf->Cell('40',5,iconv('UTF-8', 'windows-1252', 'Nombre'),'','','L');
				$pdf->SetXY(10, 120);
				$pdf->SetFont('OpensansRegular','',10);
				$pdf->Cell('40',5,iconv('UTF-8', 'windows-1252', $dataCotizacion['NombreCliente']),'','','L');

				$pdf->SetXY(58, 115);
				$pdf->SetFont('OpensansBold','',11);
				$pdf->Cell('40',5,iconv('UTF-8', 'windows-1252', 'Empresa'),'','','L');
				$pdf->SetXY(58, 120);
				$pdf->SetFont('OpensansRegular','',10);
				$pdf->Cell('40',5,iconv('UTF-8', 'windows-1252', $dataCotizacion['Empresa']),'','','L');

				$pdf->SetXY(106, 115);
				$pdf->SetFont('OpensansBold','',11);
				$pdf->Cell('40',5,iconv('UTF-8', 'windows-1252', 'Telefono'),'','','L');
				$pdf->SetXY(106, 120);
				$pdf->SetFont('OpensansRegular','',10);
				$pdf->Cell('40',5,iconv('UTF-8', 'windows-1252', $dataCotizacion['Telefono']),'','','L');

				$pdf->SetXY(154, 115);
				$pdf->SetFont('OpensansBold','',11);
				$pdf->Cell('40',5,iconv('UTF-8', 'windows-1252', 'Correo'),'','','L');
				$pdf->SetXY(154, 120);
				$pdf->SetFont('OpensansRegular','',10);
				$pdf->Cell('40',5,iconv('UTF-8', 'windows-1252', $dataCotizacion['Correo']),'','','L');



				$pdf->SetXY(10, 150);
				$pdf->SetFont('OpensansExtraBold','',11);
				$pdf->Cell('20',7,iconv('UTF-8', 'windows-1252', 'Nº'),1,'','L');
				$pdf->Cell('85',7,iconv('UTF-8', 'windows-1252', 'Descripción del producto'),1,'','L');
				$pdf->Cell('25',7,iconv('UTF-8', 'windows-1252', 'Cantidad'),1,'','L');
				$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', 'Precio U'),1,'','L');
				$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', 'Importe total'),1,1,'L');

				$pdf->SetLineWidth(0.2);
				$pdf->SetDrawColor(76,76,76);

				$pdf->SetFont('OpensansRegular','',10);
				$counter=1;
				$importeTotal=0;
				$configuracion=$this->Configuracion_m->getConfiguracion();
				$impuestos=$configuracion['ImpuestoPorcentaje']/100;

				foreach ($dataProductosByCotizacion->result() as $row) {
					setlocale(LC_MONETARY, 'en_PE');
					$precio=money_format('%.2n', $row->Precio) . "\n";
					$importeProducto=$row->Precio*$row->Qty;
					$importeProducto=money_format('%.2n', $importeProducto) . "\n";

					$importeTotal=$importeTotal+($row->Precio*$row->Qty);

					$NombreProducto=$row->producto;
					if (strlen($NombreProducto)>45) {
						$NombreProducto = substr($row->producto,0,100).'...';
					}

					$pdf->Cell('20',7,iconv('UTF-8', 'windows-1252', $counter),1,'','L');
					$pdf->Cell('85',7,iconv('UTF-8', 'windows-1252', $NombreProducto),1,'','L');
					$pdf->Cell('25',7,iconv('UTF-8', 'windows-1252', $row->Qty),1,'','L');
					$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', $precio),1,'','L');
					$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', $importeProducto),1,'1','L');
					$counter++;
				}
				/*SUBTOTAL*/
				$importeTotal=money_format('%.2n', $importeTotal) . "\n";
				$pdf->Cell('20',7,'' ,'','','L');
				$pdf->Cell('85',7,'','','','L');
				$pdf->Cell('25',7,'','','','L');
				$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', 'Subtotal'),1,'','L');
				$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', $importeTotal),1,'1','L');
				/*IMPUESTOS*/
				$impuesto=$importeTotal*$impuestos;
				$impuesto=money_format('%.2n', $impuesto) . "\n";
				$pdf->Cell('20',7,'' ,'','','L');
				$pdf->Cell('85',7,'','','','L');
				$pdf->Cell('25',7,'','','','L');
				$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', 'Impuestos'),1,'','L');
				$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', $impuesto),1,'1','L');
				/*TOTAL*/
				$pdf->SetFont('OpensansBold','',10);
				$total=$importeTotal*$impuestos+$importeTotal;
				$total=money_format('%.2n', $total) . "\n";
				$pdf->Cell('20',7,'' ,'','','L');
				$pdf->Cell('85',7,'','','','L');
				$pdf->Cell('25',7,'','','','L');
				$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', 'Total'),1,'','L');
				$pdf->Cell('30',7,iconv('UTF-8', 'windows-1252', $total),1,'1','L');

				/*TERMINOS Y CONDICIONES*/
				$pdf->SetFont('OpensansBold','',11);
				$pdf->Cell('188',25,iconv('UTF-8', 'windows-1252', ''),'','1','L');
				$pdf->Cell('188',7,iconv('UTF-8', 'windows-1252', 'Terminos y condiciones'),'','1','L');
				$pdf->SetFont('OpensansRegular','',9);
				$pdf->Cell('188',7,iconv('UTF-8', 'windows-1252', '- Los valores comerciales de la pre-cotización puede variar segun su posterior negociación con los asesores comerciales'),'','1','L');
				$pdf->Cell('188',7,iconv('UTF-8', 'windows-1252', '- La pre-cotización tienen un tiempo de validez de 30 días.'),'','1','L');
				$pdf->Cell('188',7,iconv('UTF-8', 'windows-1252', '- Limitado al stock actual de la empresa.'),'','1','L');
				$pdf->Cell('188',7,iconv('UTF-8', 'windows-1252', '- Los precios no incluyen envio.'),'','1','L');

				$pdf->Cell('188',15,iconv('UTF-8', 'windows-1252', ''),'','1','L');
				$pdf->SetFont('OpensansBold','',8);
				$pdf->SetTextColor(0,0,255);
				$pdf->Cell('188',7,iconv('UTF-8', 'windows-1252', 'Obtén tu propio cotizador automático aquí '),'','1','C','','https://goo.gl/CJbHYS');

				$pdfOut='Cotización Innovaled.pdf';
				if ($pdf->Output($dir.$pdfOut,'D')) {

				}

	}


}
