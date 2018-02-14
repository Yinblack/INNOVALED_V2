<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
  				$this->load->model('Producto_m');
					$this->load->model('Cotizacion_m');
					$this->load->model('Configuracion_m');
	}

	public function ListProductos(){
		$data=array(
			'title'       =>'INNOVALED | Listado de productos',
			'header'      =>'Listado',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Listado de productos</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/jquery.dataTables.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/dataTables.bootstrap.min.js"></script>
		        <script type="text/javascript" src="assets/js/ListProductos.js"></script>
			'
		);
		$data['productos']=$this->Producto_m->getAll();
		$this->load->view('Header',$data);
		$this->load->view('ListProductos',$data);
		$this->load->view('Footer',$data);
	}

	public function NuevoProducto(){
		$data=array(
			'title'       =>'INNOVALED | Nuevo producto',
			'header'      =>'Producto',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Nuevo producto</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/NuevoProducto.js"></script>
			'
		);
		$data['Lineas']=$this->Producto_m->getLineas();
		$data['SubLineas']=$this->Producto_m->getSubLineas();
		$data['Monedas']=$this->Producto_m->getMonedas();
		$this->load->view('Header',$data);
		$this->load->view('NuevoProducto',$data);
		$this->load->view('Footer',$data);
	}

	public function UpdateProducto(){
		$data=array(
			'title'       =>'INNOVALED | Modificar producto',
			'header'      =>'Producto',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Modificar producto</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/UpdateProducto.js"></script>
			'
		);
		$IdProducto=$_GET['IdProducto'];
		$data['Producto']=$this->Producto_m->getProductoById($IdProducto);
		$data['EscalasPrecio']=$this->Producto_m->getEscalasPrecioByIdProducto($IdProducto);
		$data['Caracteristicas']=$this->Producto_m->getCaracteristicasFromIdProducto($IdProducto);
		$data['Lineas']=$this->Producto_m->getLineas();
		$data['SubLineas']=$this->Producto_m->getSubLineas();
		$data['Monedas']=$this->Producto_m->getMonedas();
		$this->load->view('Header',$data);
		$this->load->view('UpdateProducto',$data);
		$this->load->view('Footer',$data);
	}

	public function NuevaEscalaPrecio(){
		$data=array(
			'title'       =>'INNOVALED | Nueva escala de precio',
			'header'      =>'Escala de precio',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Nueva escala de precio</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
						<script type="text/javascript" src="assets/js/vendor/bootstrap-select/bootstrap-select.js"></script>
						<script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/NuevaEscalaPrecio.js"></script>
			'
		);
		$data['productos']=$this->Producto_m->getAll();
		$this->load->view('Header',$data);
		$this->load->view('NuevaEscalaPrecio',$data);
		$this->load->view('Footer',$data);
	}

	public function UpdateEscalaPrecio(){
		$data=array(
			'title'       =>'INNOVALED | Modificar escala de precio',
			'header'      =>'Escala de precio',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Modificar escala de precio</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/UpdateEscalaPrecio.js"></script>
			'
		);
		$IdPrecioEscala=$_GET['IdPrecioEscala'];
		$data['PrecioEscala']=$this->Producto_m->getPrecioEscalaFromId($IdPrecioEscala);
		$data['productos']=$this->Producto_m->getAll();
		$this->load->view('Header',$data);
		$this->load->view('UpdateEscalaPrecio',$data);
		$this->load->view('Footer',$data);
	}


	public function ListEscalaPrecios(){
		$data=array(
			'title'       =>'INNOVALED | Listado de escalas de precios',
			'header'      =>'Listado',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Listado de escalas de precios</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/jquery.dataTables.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/dataTables.bootstrap.min.js"></script>
		        <script type="text/javascript" src="assets/js/ListEscalaPrecios.js"></script>
			'
		);
		$data['escalaPrecios']=$this->Producto_m->getAllEscalasPrecios();
		$this->load->view('Header',$data);
		$this->load->view('ListEscalaPrecios',$data);
		$this->load->view('Footer',$data);
	}

	public function LineaSublinea(){
		$data=array(
			'title'       =>'INNOVALED | Administrador de lineas y sublineas',
			'header'      =>'Listado',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Administrador de lineas y sublineas</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/jquery.dataTables.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/dataTables.bootstrap.min.js"></script>
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/LineaSublinea.js"></script>
			'
		);
		$data['lineas']=$this->Producto_m->getLineas();
		$this->load->view('Header',$data);
		$this->load->view('LineaSublinea',$data);
		$this->load->view('Footer',$data);
	}

	public function ListCotizaciones(){
		$data=array(
			'title'       =>'INNOVALED | Listado de cotizaciones',
			'header'      =>'Listado',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Listado de cotizaciones</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/jquery.dataTables.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/dataTables.bootstrap.min.js"></script>
		        <script type="text/javascript" src="assets/js/ListCotizaciones.js"></script>
			'
		);
		$data['cotizaciones']=$this->Cotizacion_m->getAll();
		$this->load->view('Header',$data);
		$this->load->view('ListCotizaciones',$data);
		$this->load->view('Footer',$data);
	}

	public function DetalleCotizacion(){
		$data=array(
			'title'       =>'INNOVALED | Cotizacion',
			'header'      =>'Listado',
			'description' =>'',
			'breadcrumb' =>'
        	    <li class="active">Detalle de cotizacion</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/jquery.dataTables.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/datatables/dataTables.bootstrap.min.js"></script>
			'
		);
		$IdCotizacion=$_GET['IdCotizacion'];
		$data['Cotizacion']=$this->Cotizacion_m->getCotizacionFromId($IdCotizacion);
		$data['ProductosByCotizacion']=$this->Cotizacion_m->getProductosByCotizacion($IdCotizacion);
		$data['ServiciosByCotizacion']=$this->Cotizacion_m->getServiciosByCotizacion($IdCotizacion);
		$data['configuracion']=$this->Configuracion_m->getConfiguracion();
		$this->load->view('Header',$data);
		$this->load->view('DetalleCotizacion',$data);
		$this->load->view('Footer',$data);
	}

	public function Configuracion(){
		$data=array(
			'title'       =>'INNOVALED | Configuración',
			'header'      =>'Configuración',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Configuración general</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/Configuracion.js"></script>
			'
		);
		$data['configuracion']=$this->Configuracion_m->getConfiguracion();
		$this->load->view('Header',$data);
		$this->load->view('Configuracion',$data);
		$this->load->view('Footer',$data);
	}

	public function ProfileConfig(){
		$data=array(
			'title'       =>'INNOVALED | Configuración',
			'header'      =>'Configuración',
			'description' =>'',
			'breadcrumb' =>'
        	                <li class="active">Configuración general</li>
			',
			'css' =>'
			',
			'js' =>'
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
		        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        <script type="text/javascript" src="assets/js/ProfileConfig.js"></script>
			'
		);
		$this->load->view('Header',$data);
		$this->load->view('ProfileConfig',$data);
		$this->load->view('Footer',$data);
	}


}
