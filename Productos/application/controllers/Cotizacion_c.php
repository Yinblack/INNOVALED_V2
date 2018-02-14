<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cotizacion_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
  				$this->load->model('Producto_m');
  				$this->load->model('Cotizacion_m');
  				$this->load->library('cart');
	}

  public function deleteCotizacion(){
    $IdCotizacion=$_POST['IdCotizacion'];
    if ($this->db->delete('cotizacionproducto', array('IdCotizacion' => $IdCotizacion))) {
      if ($this->Cotizacion_m->deleteCotizacion($IdCotizacion)) {
        echo 'success';
      }else{
        echo "error";
      }
    }else{
      echo "error";
    }
  }


}