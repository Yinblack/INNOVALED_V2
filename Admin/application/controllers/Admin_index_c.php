<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_index_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
  				$this->load->model('WebPage_m');
  				$this->load->model('Persona_m');
	}

	public function index(){
		if ($this->Persona_m->isLogged()==true) {
			$data=array(
				'title'       =>'INNOVALED | Inicio',
				'header'      =>'Inicio',
				'description' =>'',
				'breadcrumb' =>'
        	                    <li class="active">Inicio</li>
				',
				'css' =>'
				',
				'js' =>'
				'
			);
			$this->load->view('Header',$data);
			$this->load->view('Index',$data);
			$this->load->view('Footer',$data);
		}else{
			$data=array(
				'title'       =>'INNOVALED | Inicio de sesión',
				'header'      =>'Inicio',
				'description' =>'Dashboard Vaeo Advance',
				'breadcrumb' =>'
        	                    <li class="active">Dashboard</li>
				',
				'css' =>'
				',
				'js' =>'
			        <script type="text/javascript" src="assets/js/vendor/noty/jquery.noty.packaged.js"></script>
		        	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		        	<script type="text/javascript" src="assets/js/Login.js"></script>
				'
			);
			$this->load->view('Login',$data);
		}
	}


}
