<?php
class Configuracion_m extends CI_Model {
	function __construct() {
 		parent::__construct();
 	}

  public function updateImpuesto($Impuesto){
      $this->db->set('ImpuestoPorcentaje', $Impuesto);
      $this->db->where('IdConfiguracion', 1);
      $this->db->update('configuracion');
      return true;
  }

  public function updateCorreosCotizacion($Correo1, $Correo2, $Correo3, $Correo4, $Correo5){
    $this->db->set('Correo1', $Correo1);
    $this->db->set('Correo2', $Correo2);
    $this->db->set('Correo3', $Correo3);
    $this->db->set('Correo4', $Correo4);
    $this->db->set('Correo5', $Correo5);
      $this->db->where('IdConfiguracion', 1);
      $this->db->update('configuracion');
      return true;
  }

  public function getConfiguracion(){
      $this->db->select('*');
      $this->db->from('configuracion');
      $items = $this->db->get();
      if ($items->num_rows() > 0){
          $array=$items->unbuffered_row('array');
          return $array;
      }else{
          return false;
      }
  }

}
?>
