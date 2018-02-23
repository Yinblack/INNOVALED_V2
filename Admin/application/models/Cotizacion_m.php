<?php
class Cotizacion_m extends CI_Model {
	function __construct() {
 		parent::__construct();
 	}

    public function saveCotizacion($dataPersona){
        if ($this->db->insert('cotizacion', $dataPersona)) {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
            return false;
        }
    }

    public function saveCotizacionProducto($dataCotizacionProducto){
        if ($this->db->insert('cotizacionproducto', $dataCotizacionProducto)) {
            return  true;
        }else{
            return false;
        }
    }

    public function saveCotizacionServicio($dataServicio){
        if ($this->db->insert('cotizacionservicio', $dataServicio)) {
            return  true;
        }else{
            return false;
        }
    }

    public function getAll(){
        $this->db->select('*');
        $this->db->from('cotizacion');
        $this->db->order_by("IdCotizacion", "DESC");
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }

    public function deleteCotizacion($IdCotizacion){
        if ($this->db->delete('cotizacion', array('IdCotizacion' => $IdCotizacion))) {
            return true;
        }else{
            return false;
        }
    }

    public function getCotizacionFromId($IdCotizacion){
        $this->db->select('*');
        $this->db->from('cotizacion');
        $this->db->where('cotizacion.IdCotizacion', $IdCotizacion);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            $array=$items->unbuffered_row('array');
            return $array;
        }else{
            return false;
        }
    }

		public function getProductosByCotizacion($IdCotizacion){
        $this->db->select('producto.IdProducto AS IdProducto, producto.Nombre AS producto, cotizacionproducto.Qty as Qty, producto.Precio as Precio, producto.Descripcion as Descripcion');
        $this->db->from('producto');
        $this->db->join('cotizacionproducto', 'producto.IdProducto = cotizacionproducto.IdProducto');
        $this->db->group_by("cotizacionproducto.IdProducto");
        $this->db->where('cotizacionproducto.IdCotizacion', $IdCotizacion);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }

		public function getPrecioDescuento($IdProducto, $Qty){
        $this->db->select('producto.Precio as Precio, precioescala.Desde as Desde, precioescala.Descuento as Descuento');
        $this->db->from('precioescala');
        $this->db->join('producto', 'precioescala.IdProducto = producto.IdProducto');
        $this->db->group_by("precioescala.IdPrecioEscala");
				$this->db->where('precioescala.IdProducto', $IdProducto);
				$this->db->where('precioescala.Desde <=', $Qty);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
						$qtyCounter=0;
            foreach ($items->result() as $row){
							if ($row->Desde > $qtyCounter) {
								$porcentajeDesc=$row->Descuento;
								$qtyCounter=$row->Desde;
							}
						}
						return $porcentajeDesc;
        }else{
            return false;
        }
    }

    public function getServiciosByCotizacion($IdCotizacion){
        $this->db->select('*');
        $this->db->from('cotizacionservicio');
        $this->db->where('cotizacionservicio.IdCotizacion', $IdCotizacion);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }

  public function totalItems(){
    $total_items=0;
    foreach ($this->cart->contents() as $items){
      $total_items++;
    }
    return $total_items;
  }

  public function checkOnCart($IdProducto){
    $result=false;
    foreach ($this->cart->contents() as $items){
      if ($items['id']==$IdProducto) {
          $result=true;
      }
    }
    return $result;
  }


}
?>
