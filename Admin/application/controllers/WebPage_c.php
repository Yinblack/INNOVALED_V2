<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebPage_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
  				$this->load->model('Producto_m');
  				$this->load->model('Cotizacion_m');
  				$this->load->library('cart');
	}

	public function index(){
		$data=array(
			'title'       =>'INNOVALED Perú',
			'css' =>'
					<link rel="stylesheet" href="assets/css/web/slick.css">
					<link rel="stylesheet" href="assets/css/web/slick-theme.css">
					<link rel="stylesheet" href="assets/css/web/slider-pro.css">
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
					<link rel="stylesheet" href="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.css">
					<link rel="stylesheet" href="assets/css/site/productos.css">
			',
			'js' =>'
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
					<script type="text/javascript" src="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.js"></script>
					<script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
					<script type="text/javascript" src="assets/js/site/productos_two.js"></script>
					<script type="text/javascript" src="assets/js/site/Productos.js"></script>
					<script type="text/javascript" src="assets/js/site/goProductosSublinea.js"></script>
			'
		);
		$data['onHomeSect']='href';
		$data['onProductos']='active';
		$data['noItemsOnCart']=$this->Cotizacion_m->totalItems();
		$data['colorClass'] = ($data['noItemsOnCart']==0) ? "empty":"";
		$data['Cart']=$this->cart->contents();
		$data['Lineas']=$this->Producto_m->getLineas();
		$data['LineasSublinea']=$this->Producto_m->getLineasSublineas();
		$this->load->view('/site/Header',$data);
		$this->load->view('/site/ProductosTwo',$data);
		$this->load->view('/site/Footer',$data);
	}

	public function Home(){
		$data=array(
			'title'       =>'INNOVALED Perú',
			'css' =>'
					<link rel="stylesheet" href="assets/css/web/slick.css">
					<link rel="stylesheet" href="assets/css/web/slick-theme.css">
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
					<link rel="stylesheet" href="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.css">
			',
			'js' =>'
					<script type="text/javascript" src="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.js"></script>
					<script src="assets/js/site/Home.js"></script>
					<script src="assets/js/site/onePage.js"></script>
			'
		);
		$data['onHome']='active';
		$data['noItemsOnCart']=$this->Cotizacion_m->totalItems();
		$this->load->view('/site/Header',$data);
		$this->load->view('/site/Home',$data);
		$this->load->view('/site/Footer',$data);
	}

	public function Productos(){
		$data=array(
			'title'       =>'INNOVALED | Productos',
			'css' =>'
					<link rel="stylesheet" href="assets/css/web/slick.css">
					<link rel="stylesheet" href="assets/css/web/slick-theme.css">
					<link rel="stylesheet" href="assets/css/web/slider-pro.css">
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
					<link rel="stylesheet" href="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.css">
					<link rel="stylesheet" href="assets/css/site/productos.css">
			',
			'js' =>'
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
					<script type="text/javascript" src="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.js"></script>
					<script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
					<script type="text/javascript" src="assets/js/site/productos_two.js"></script>
					<script type="text/javascript" src="assets/js/site/Productos.js"></script>
					<script type="text/javascript" src="assets/js/site/goProductosSublinea.js"></script>
			'
		);
		$data['onHomeSect']='href';
		$data['onProductos']='active';
		$data['noItemsOnCart']=$this->Cotizacion_m->totalItems();
		$data['colorClass'] = ($data['noItemsOnCart']==0) ? "empty":"";
		$data['Cart']=$this->cart->contents();
		$data['Lineas']=$this->Producto_m->getLineas();
		$data['LineasSublinea']=$this->Producto_m->getLineasSublineas();
		$this->load->view('/site/Header',$data);
		$this->load->view('/site/ProductosTwo',$data);
		$this->load->view('/site/Footer',$data);
	}


	public function DetalleProductoTwo(){
			$data=array(
				'title'       =>'INNOVALED | Detalle Producto',
				'css' =>'
					<link rel="stylesheet" href="assets/css/web/slick.css">
					<link rel="stylesheet" href="assets/css/web/slick-theme.css">
					<link rel="stylesheet" href="assets/css/web/slider-pro.css">
					<link rel="stylesheet" href="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.css">
					<link rel="stylesheet" href="assets/css/site/productos.css">
				',
				'js' =>'
		        	<script type="text/javascript" src="assets/js/site/DetalleProductoTwo.js"></script>
						<script type="text/javascript" src="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.js"></script>
				'
			);
		$data['onHomeSect']='href';
		$data['onProductos']='active';
			$data['noItemsOnCart']=$this->Cotizacion_m->totalItems();

			$IdProducto=$_GET['IdProducto'];
			$data['onCart']=$this->Cotizacion_m->checkOnCart($IdProducto);
			$dir="assets/img/Productos/".$IdProducto."/";
			$data['images'] = glob($dir . "*.{jpg,jpeg,png,gif}",GLOB_BRACE);

            $pathPdf="assets/img/Productos/".$IdProducto."/pdf/FichaTecnica.pdf";
            $data['Pdf'] = (file_exists($pathPdf)) ? true : false;

            $data['IdProducto']=$IdProducto;
			$data['Producto']=$this->Producto_m->getProductoByIdFix($IdProducto);
			$data['EscalasPrecio']=$this->Producto_m->getEscalasPrecioByIdProducto($IdProducto);
			$data['Caracteristicas']=$this->Producto_m->getCaracteristicasFromIdProducto($IdProducto);

			$IdSubLinea=$data['Producto']['IdSublinea'];
			$data['productosRelacionados']=$this->Producto_m->getProductosRelacionados($IdSubLinea, $IdProducto);

		$this->load->view('/site/Header',$data);
		$this->load->view('/site/DetalleProductoTwo',$data);
		$this->load->view('/site/Footer',$data);
	}


	public function test(){

	}

	public function Quote(){
			$data=array(
				'title'       =>'INNOVALED | Cotización',
				'css' =>'
					<link rel="stylesheet" href="assets/css/web/slick.css">
					<link rel="stylesheet" href="assets/css/web/slick-theme.css">
					<link rel="stylesheet" href="assets/css/web/slider-pro.css">
					<link rel="stylesheet" href="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.css">
				',
				'js' =>'
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
				<script type="text/javascript" src="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.js"></script>
				<script type="text/javascript" src="assets/js/web/Servicios.js"></script>
				'
			);
			$data['noItemsOnCart']=$this->Cotizacion_m->totalItems();

			$this->load->view('/web/HeaderNoScroll',$data);
			$this->load->view('/web/Quote',$data);
			$this->load->view('/web/Footer',$data);
	}

	public function DetalleProducto(){
			$data=array(
				'title'       =>'INNOVALED | Detalle Producto',
				'css' =>'
					<link rel="stylesheet" href="assets/css/web/slick.css">
					<link rel="stylesheet" href="assets/css/web/slick-theme.css">
					<link rel="stylesheet" href="assets/css/web/slider-pro.css">
					<link rel="stylesheet" href="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.css">
				',
				'js' =>'
		        	<script type="text/javascript" src="assets/js/web/DetalleProducto.js"></script>
						<script type="text/javascript" src="https://main-gimmicklog.ssl-lolipop.jp/demo/iziModal/iziModal.min.js"></script>
				'
			);
			$data['noItemsOnCart']=$this->Cotizacion_m->totalItems();

			$IdProducto=$_GET['IdProducto'];
			$data['onCart']=$this->Cotizacion_m->checkOnCart($IdProducto);
			$dir="assets/img/Productos/".$IdProducto."/";
			$data['images'] = glob($dir . "*.{jpg,jpeg,png,gif}",GLOB_BRACE);

            $pathPdf="assets/img/Productos/".$IdProducto."/pdf/FichaTecnica.pdf";
            $data['Pdf'] = (file_exists($pathPdf)) ? true : false;

            $data['IdProducto']=$IdProducto;
			$data['Producto']=$this->Producto_m->getProductoByIdFix($IdProducto);
			$data['EscalasPrecio']=$this->Producto_m->getEscalasPrecioByIdProducto($IdProducto);
			$data['Caracteristicas']=$this->Producto_m->getCaracteristicasFromIdProducto($IdProducto);

			$IdSubLinea=$data['Producto']['IdSublinea'];
			$data['productosRelacionados']=$this->Producto_m->getProductosRelacionados($IdSubLinea, $IdProducto);

			$this->load->view('/web/HeaderNoScroll',$data);
			$this->load->view('/web/DetalleProducto',$data);
			$this->load->view('/web/Footer',$data);
	}

	public function Carrito(){
			$data=array(
				'title'       =>'INNOVALED | Carrito de Compras',
				'css' =>'
					<link rel="stylesheet" href="assets/css/web/slick.css">
					<link rel="stylesheet" href="assets/css/web/slick-theme.css">
					<link rel="stylesheet" href="assets/css/web/slider-pro.css">
				',
				'js' =>'
				'
			);
			$data['noItemsOnCart']=$this->Cotizacion_m->totalItems();
			$data['Lineas']=$this->Producto_m->getLineas();
			$data['LineasSublinea']=$this->Producto_m->getLineasSublineas();
			$this->load->view('/web/Header',$data);
			$this->load->view('/web/Carrito',$data);
			$this->load->view('/web/Footer',$data);
	}

	public function sendContacto(){
		$nombre=$_POST['nombre'];
		$correo=$_POST['correo'];
		$telefono=$_POST['telefono'];
		$mensaje=$_POST['mensaje'];

		$msj = '
				<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<title></title>
				</head>
				<body>
				<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>
						<table border="0" cellspacing="0" cellpadding="0" width="600" align="center">
					<tr style="background:#ff5443; height:15px;">
						<td colspan="5"></td>
					</tr>
							<tr>
								<td width="17"></td>
								<td width="569" colspan="3" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
									<p style ="margin:5px 0;"><strong>Nombre:</strong> '.$nombre.'</p>
									<p style ="margin:5px 0;"><strong>Correo:</strong> '.$correo.'</p>
									<p style ="margin:5px 0;"><strong>telefono:</strong> '.$telefono.'</p>
									<p style ="margin:5px 0;"><strong>Mensaje:</strong> '.$mensaje.'</p>
									</td>
								<td width="14"></td>
							</tr>
					<tr style="background:#bf4336; height:25px;">
						<td colspan="5"></td>
					</tr>
				</table></td>
					</tr>
				</table>
				</body>
				</html>';

		$subject = stripslashes('Contacto Innovaled');
		$subject = iconv('UTF-8', 'windows-1252', $subject);

		require_once(APPPATH.'libraries/phpmailer/PHPMailerAutoload.php');
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'in-v3.mailjet.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = '76ee47694c59244e2a9e145f1359fbe4';                 // SMTP username
		$mail->Password = '8635a8949fc61b3d7ee706033e9f2e82';                           // SMTP password
		$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('contacto@ramva.com.mx', $subject);
		$mail->addAddress('daniel.m.arvizu@gmail.com', 'Yo');     // Add a recipientmadadehu@gmail.com
		//$mail->addAddress('madadehu@gmail.com', 'madadehu');     // Add a recipient
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $msj;
		$mail->AltBody = '';

		if(!$mail->send()) {
				echo 'Ocurrio un error al enviar el mensaje (Por favor intentelo nuevamente).';
		} else {
			echo "success";
		}
	}




}
