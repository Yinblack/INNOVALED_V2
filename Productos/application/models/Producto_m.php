<?php
class Producto_m extends CI_Model {
	function __construct() {
 		parent::__construct();
        $this->load->library('cart');
 	}

    public function getAll(){
        $this->db->select('producto.IdProducto AS IdProducto, producto.Nombre AS producto, MostrarPrecio AS mostrar, Orden AS orden, linea.Etiqueta AS linea, sublinea.Etiqueta AS sublinea');
        $this->db->from('producto');
        $this->db->join('sublinea', 'producto.IdSubLinea = sublinea.IdSubLinea');
        $this->db->join('linea', 'sublinea.IdLinea = linea.IdLinea');
        $this->db->group_by("producto.IdProducto");
        $this->db->where('producto.Estado', '1');
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }

		public function getProductosRelacionados($IdSubLinea, $IdProducto){
				$this->db->select('producto.IdProducto as IdProducto, producto.Nombre as NombreProducto, producto.Marca as Marca, producto.Precio as Precio, producto.MostrarPrecio as MostrarPrecio, producto.Descripcion as Descripcion, sublinea.Etiqueta as Sublinea, linea.Etiqueta as Linea, moneda.Etiqueta as Moneda');
				$this->db->from('producto');
        $this->db->join('sublinea', 'producto.IdSubLinea = sublinea.IdSubLinea');
        $this->db->join('linea', 'sublinea.IdLinea = linea.IdLinea');
        $this->db->join('moneda', 'producto.IdMoneda = moneda.IdMoneda');
        $this->db->group_by("producto.IdProducto");
				$this->db->where('producto.IdProducto !=', $IdProducto);
				$this->db->where('sublinea.IdSubLinea', $IdSubLinea);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{

            return $this->getProductosRelacionadosTwo();

        }
		}
		public function getProductosRelacionadosTwo(){
			$this->db->select('producto.IdProducto as IdProducto, producto.Nombre as NombreProducto, producto.Marca as Marca, producto.Precio as Precio, producto.MostrarPrecio as MostrarPrecio, producto.Descripcion as Descripcion, sublinea.Etiqueta as Sublinea, linea.Etiqueta as Linea, moneda.Etiqueta as Moneda');
			$this->db->from('producto');
			$this->db->join('sublinea', 'producto.IdSubLinea = sublinea.IdSubLinea');
			$this->db->join('linea', 'sublinea.IdLinea = linea.IdLinea');
			$this->db->join('moneda', 'producto.IdMoneda = moneda.IdMoneda');
			$this->db->group_by("producto.IdProducto");
			$this->db->limit(6);
			$itemsTwo = $this->db->get();
			if ($itemsTwo->num_rows() > 0){
					return $itemsTwo;
			}else{
					return false;
			}
		}

    public function getProductoById($IdProducto){
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->join('sublinea', 'producto.IdSubLinea = sublinea.IdSubLinea');
        $this->db->join('linea', 'sublinea.IdLinea = linea.IdLinea');
        $this->db->join('moneda', 'producto.IdMoneda = moneda.IdMoneda');
        $this->db->group_by("producto.IdProducto");
        $this->db->where('producto.IdProducto', $IdProducto);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            $array=$items->unbuffered_row('array');
            return $array;
        }else{
            return false;
        }
    }

    public function getProductoByIdFix($IdProducto){
        $this->db->select('producto.IdProducto as IdProducto, producto.Nombre as NombreProducto, producto.Marca as Marca, producto.Precio as Precio, producto.MostrarPrecio as MostrarPrecio, producto.Descripcion as Descripcion, sublinea.Etiqueta as Sublinea, sublinea.IdSubLinea as IdSublinea, linea.Etiqueta as Linea, moneda.Etiqueta as Moneda');
        $this->db->from('producto');
        $this->db->join('sublinea', 'producto.IdSubLinea = sublinea.IdSubLinea');
        $this->db->join('linea', 'sublinea.IdLinea = linea.IdLinea');
        $this->db->join('moneda', 'producto.IdMoneda = moneda.IdMoneda');
        $this->db->group_by("producto.IdProducto");
        $this->db->where('producto.IdProducto', $IdProducto);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            $array=$items->unbuffered_row('array');
            return $array;
        }else{
            return false;
        }
    }

    public function getEscalasPrecioByIdProducto($IdProducto){
        $this->db->select('producto.IdProducto AS IdProducto, producto.Nombre AS producto, producto.Precio AS precio, precioescala.IdPrecioEscala as IdPrecioEscala, precioescala.Desde as desde, precioescala.Descuento as descuento');
        $this->db->from('precioescala');
        $this->db->join('producto', 'precioescala.IdProducto = producto.IdProducto');
        $this->db->group_by("IdPrecioEscala");
        $this->db->where('producto.IdProducto', $IdProducto);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }

    public function getCaracteristicasFromIdProducto($IdProducto){
        $this->db->select('*');
        $this->db->from('caracteristica');
        $this->db->join('producto', 'caracteristica.IdProducto = producto.IdProducto');
        $this->db->group_by("caracteristica.IdCarecterisctica");
        $this->db->where('producto.IdProducto', $IdProducto);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }


    public function getPrecioFromId($IdProducto){
        $this->db->select('producto.Precio AS precio');
        $this->db->from('producto');
        $this->db->where('producto.IdProducto', $IdProducto);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            $array=$items->unbuffered_row('array');
            return $array['precio'];
        }else{
            return false;
        }
    }



    public function updateProducto($dataProducto, $IdProducto){
        if ($this->db->update('producto', $dataProducto, "IdProducto = ".$IdProducto)) {
            return true;
        }else{
            return false;
        }
    }

    public function addProducto($dataProducto){
        if ($this->db->insert('producto', $dataProducto)) {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
            return false;
        }
    }

    public function addEscalaPrecio($dataEscalaPrecio){
        if ($this->db->insert('precioescala', $dataEscalaPrecio)) {
            return  true;
        }else{
            return false;
        }
    }

    public function updateEscalaPrecio($dataEscalaPrecio){
        if ($this->db->replace('precioescala', $dataEscalaPrecio)) {
            return  true;
        }else{
            return false;
        }
    }

    public function addCaracteristica($dataCaracteristicas){
        if ($this->db->insert('caracteristica', $dataCaracteristicas)) {
            return  true;
        }else{
            return false;
        }
    }

    public function updateCaracteristica($dataCaracteristicas){
        if ($this->db->replace('caracteristica', $dataCaracteristicas)) {
            return  true;
        }else{
            return false;
        }
    }

    public function deleteCaracteristica($IdCarecterisctica){
        if ($this->db->delete('caracteristica', array('IdCarecterisctica' => $IdCarecterisctica))) {
            return true;
        }else{
            return false;
        }
    }


    public function getLineas(){
        $this->db->select('*');
        $this->db->from('linea');
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }

    public function getLineasSublineas(){
        $this->db->select('*');
        $this->db->from('linea');
        $lineas = $this->db->get();
        if ($lineas->num_rows() > 0){
            $arrayResult=array();
            foreach ($lineas->result() as $row){
                $this->db->select('*');
                $this->db->from('sublinea');
                $this->db->where('IdLinea', $row->IdLinea);
                $sublineas = $this->db->get();
                if ($sublineas->num_rows() > 0){
                    $counter=0;
                    foreach ($sublineas->result() as $x){
                        $arrayResult["'".$row->Etiqueta."'"][$counter]['IdSubLinea']=$x->IdSubLinea;
                        $arrayResult["'".$row->Etiqueta."'"][$counter]['Sublinea']=$x->Etiqueta;
                        $counter++;
                    }
                }
            }
            return $arrayResult;
        }else{
            return false;
        }
    }

    public function getSubLineas(){
        $this->db->select('*');
        $this->db->from('sublinea');
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }

    public function getMonedas(){
        $this->db->select('*');
        $this->db->from('moneda');
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }

    public function getAllEscalasPrecios(){
        $this->db->select('producto.IdProducto AS IdProducto, producto.Nombre AS producto, producto.Precio AS precio, precioescala.IdPrecioEscala as IdPrecioEscala, precioescala.Desde as desde, precioescala.Descuento as descuento');
        $this->db->from('precioescala');
        $this->db->join('producto', 'precioescala.IdProducto = producto.IdProducto');
        $this->db->group_by("IdPrecioEscala");
        $this->db->where('producto.Estado', '1');
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            return $items;
        }else{
            return false;
        }
    }

    public function getPrecioEscalaFromId($IdPrecioEscala){
        $this->db->select('*');
        $this->db->from('precioescala');
        $this->db->join('producto', 'precioescala.IdProducto = producto.IdProducto');
        $this->db->group_by("IdPrecioescala");
        $this->db->where('precioescala.IdPrecioEscala', $IdPrecioEscala);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            $array=$items->unbuffered_row('array');
            return $array;
        }else{
            return false;
        }
    }

    public function deleteEscalaPrecio($IdEscalaPrecio){
        if ($this->db->delete('precioescala', array('IdPrecioEscala' => $IdEscalaPrecio))) {
            return true;
        }else{
            return false;
        }
    }


    public function deleteLinea($IdLinea){
        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries
        if ($this->db->delete('linea', array('IdLinea' => $IdLinea))) {
            return true;
        }else{
            return false;
        }
    }

    public function deleteSubLinea($IdSubLinea){
        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries
        if ($this->db->delete('sublinea', array('IdSubLinea' => $IdSubLinea))) {
            return true;
        }else{
            return false;
        }
    }

    public function addLinea($dataLinea){
        if ($this->db->insert('linea', $dataLinea)) {
            return  true;
        }else{
            return false;
        }
    }

    public function addSubLinea($dataSubLinea){
        if ($this->db->insert('sublinea', $dataSubLinea)) {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }else{
            return false;
        }
    }

    public function updateLinea($Etiqueta, $IdLinea){
				$this->db->set('Etiqueta', $Etiqueta);
        $this->db->where('IdLinea', $IdLinea);
        $this->db->update('linea');
        return true;
    }

    public function updateSubLinea($Etiqueta, $IdSubLinea){
        $this->db->set('Etiqueta', $Etiqueta);
        $this->db->where('IdSubLinea', $IdSubLinea);
        $this->db->update('sublinea');
        return true;
    }




    public function getSubLineasFromLinea($IdLinea){
        $this->db->select('*');
        $this->db->from('sublinea');
        $this->db->where('IdLinea', $IdLinea);
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            $counter=0;
            $arrayResult=array();
            foreach ($items->result() as $row){
                $arrayResult[$counter]['IdSubLinea']=$row->IdSubLinea;
                $arrayResult[$counter]['Etiqueta']=$row->Etiqueta;
                $counter++;
            }
            return $arrayResult;
        }else{
            return false;
        }
    }

    public function getProductosFromSublinea($IdSubLinea){
        $this->db->select('producto.IdProducto as IdProducto, producto.Nombre as NombreProducto, producto.Marca as Marca, producto.Precio as Precio, producto.MostrarPrecio as MostrarPrecio, producto.Descripcion as Descripcion, moneda.Etiqueta as Moneda, sublinea.Etiqueta as Sublinea, linea.Etiqueta as Linea');
        $this->db->from('producto');
        $this->db->join('moneda', 'producto.IdMoneda = moneda.IdMoneda');
        $this->db->join('sublinea', 'producto.IdSubLinea = sublinea.IdSubLinea');
        $this->db->join('linea', 'sublinea.IdLinea = linea.IdLinea');
        $this->db->group_by("producto.IdProducto");
        $this->db->where('producto.IdSubLinea', $IdSubLinea);
        $this->db->where('producto.Estado', '1');
        $items = $this->db->get();
        if ($items->num_rows() > 0){
					setlocale(LC_MONETARY, 'en_PE');
            $counter=0;
            $arrayResult=array();
            foreach ($items->result() as $row){
                $arrayResult[$counter]['OnCart']='No';
                if ($this->cart->total_items()>0) {
                    $Cart=$this->cart->contents();
                    foreach ($Cart as $item){
                        if ($item['id']==$row->IdProducto) {
                             $arrayResult[$counter]['OnCart']='Si';
                        }
                    }
                }else{
                    $arrayResult[$counter]['OnCart']='No';
                }
								$this->db->select('*');
								$this->db->from('precioescala');
								$this->db->where('precioescala.IdProducto', $row->IdProducto);
								$result = $this->db->get();
								if ($result->num_rows() > 0){
									$arrayResult[$counter]['PrecioEscala']=1;
								}else{
									$arrayResult[$counter]['PrecioEscala']=0;
								}
                $arrayResult[$counter]['IdProducto']=$row->IdProducto;
                $arrayResult[$counter]['NombreProducto']=$row->NombreProducto;
                $arrayResult[$counter]['Marca']=$row->Marca;
								$arrayResult[$counter]['Precio']=number_format($row->Precio, 2, '.', ',');
                $arrayResult[$counter]['MostrarPrecio']=$row->MostrarPrecio;
                $arrayResult[$counter]['Descripcion']=$row->Descripcion;
                $arrayResult[$counter]['Moneda']=$row->Moneda;
                $arrayResult[$counter]['Sublinea']=$row->Sublinea;
                $arrayResult[$counter]['Linea']=$row->Linea;
                $counter++;
            }
            return $arrayResult;
        }else{
            return false;
        }
    }


    function getProductosFromSublineaReturnItems($IdSubLinea){
        $this->db->select('producto.IdProducto as IdProducto, producto.Nombre as NombreProducto, producto.Marca as Marca, producto.Precio as Precio, producto.MostrarPrecio as MostrarPrecio, producto.Descripcion as Descripcion, moneda.Etiqueta as Moneda, sublinea.Etiqueta as Sublinea, linea.Etiqueta as Linea');
        $this->db->from('producto');
        $this->db->join('moneda', 'producto.IdMoneda = moneda.IdMoneda');
        $this->db->join('sublinea', 'producto.IdSubLinea = sublinea.IdSubLinea');
        $this->db->join('linea', 'sublinea.IdLinea = linea.IdLinea');
        $this->db->group_by("producto.IdProducto");
        $this->db->where('producto.IdSubLinea', $IdSubLinea);
        $this->db->where('producto.Estado', '1');
        $items = $this->db->get();
        if ($items->num_rows() > 0){
            $counter=0;
            $arrayResult=array();
            foreach ($items->result() as $row){
                $arrayResult[$counter]['OnCart']='No';
                if ($this->cart->total_items()>0) {
                    $Cart=$this->cart->contents();
                    foreach ($Cart as $item){
                        if ($item['id']==$row->IdProducto) {
                             $arrayResult[$counter]['OnCart']='Si';
                        }
                    }
                }else{
                    $arrayResult[$counter]['OnCart']='No';
                }
                                $this->db->select('*');
                                $this->db->from('precioescala');
                                $this->db->where('precioescala.IdProducto', $row->IdProducto);
                                $result = $this->db->get();
                                if ($result->num_rows() > 0){
                                    $arrayResult[$counter]['PrecioEscala']=1;
                                }else{
                                    $arrayResult[$counter]['PrecioEscala']=0;
                                }
                $arrayResult[$counter]['IdProducto']=$row->IdProducto;
                $arrayResult[$counter]['NombreProducto']=$row->NombreProducto;
                $arrayResult[$counter]['Marca']=$row->Marca;
                                $arrayResult[$counter]['Precio']=number_format($row->Precio, 2, '.', ',');
                $arrayResult[$counter]['MostrarPrecio']=$row->MostrarPrecio;
                $arrayResult[$counter]['Descripcion']=$row->Descripcion;
                $arrayResult[$counter]['Moneda']=$row->Moneda;
                $arrayResult[$counter]['Sublinea']=$row->Sublinea;
                $arrayResult[$counter]['Linea']=$row->Linea;
                $counter++;
            }
            return $arrayResult;
        }else{
            return false;
        }
    }

}
?>
