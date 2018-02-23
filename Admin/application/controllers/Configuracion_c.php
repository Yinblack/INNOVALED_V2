<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
  				$this->load->model('Configuracion_m');
	}

    public function updateImpuesto(){
  		$Impuesto=$_POST['Impuesto'];
  		if ($this->Configuracion_m->updateImpuesto($Impuesto)) {
  			echo "success";
  		}
  	}

    public function updateCorreosCotizacion(){
      $Correo1=$_POST['Correo1'];
      $Correo2=$_POST['Correo2'];
      $Correo3=$_POST['Correo3'];
      $Correo4=$_POST['Correo4'];
      $Correo5=$_POST['Correo5'];
    	if ($this->Configuracion_m->updateCorreosCotizacion($Correo1, $Correo2, $Correo3, $Correo4, $Correo5)) {
    		echo "success";
    	}
    }

    public function getConfiguracion(){
      $result=$this->Configuracion_m->getConfiguracion();
      if ($result!=false) {
        print($result);
      }
    }


}
