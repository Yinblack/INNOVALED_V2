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

        $this->db->select('linea.Etiqueta as NombreLinea, sublinea.Etiqueta as NombreSublinea');
        $this->db->from('sublinea');
        $this->db->join('linea', 'sublinea.IdLinea = linea.IdLinea');
        $this->db->group_by("sublinea.IdSublinea");
        $this->db->where('sublinea.IdSublinea', $IdSubLinea);
        $lineaSublinea = $this->db->get();

        foreach ($lineaSublinea->result() as $row){
                $NombreLinea=$row->NombreLinea;
                $NombreSublinea=$row->NombreSublinea;
        }

        if ($items->num_rows() > 0){
            $counter=0;
            $arrayResult=array();
            $html='';
            $html.='
                <div class="col-xs-12 noHorizontalPadding text-center tittleProductos">
                    <h3 class="text-left col-xs-12 nomargin noHorizontalPadding">'.$NombreLinea.'</h3>
                    <h4 class="text-left col-xs-12 nomargin noHorizontalPadding vpadding nopaddingBottom">'.$NombreSublinea.'</h4>
                </div>
            ';
            foreach ($items->result() as $row){
                $IdProducto=$row->IdProducto;
                $enCarrito=$this->getExistenciaEnCarrito($IdProducto);
                if ($enCarrito>0) {
                    $class='active';
                }else{
                    $class='';
                }
                $tienePrecioEscala=$this->tienePrecioEscala($IdProducto);
                if ($tienePrecioEscala) {
                    $html1='
                                    <div class="vertical end">
                                        <p class="col-xs-12 nopadding nomargin text-center textRed light">
                                            <small>Descuento por cantidad</small>
                                        </p>
                                    </div>
                    ';
                }else{
                    $html1='';
                }
                $NombreProducto=$row->NombreProducto;
                $Marca=$row->Marca;
                $Precio=number_format($row->Precio, 2, '.', ',');
                $MostrarPrecio=$row->MostrarPrecio;
                $Descripcion=$row->Descripcion;
                if (strlen($Descripcion) > 150){
                    $Descripcion=substr($Descripcion, 0, 150).'...';
                }
                $Moneda=$row->Moneda;
                $Sublinea=$row->Sublinea;
                $Linea=$row->Linea;
                $html.='
                    <div class="col-xs-12 item" id="item'.$IdProducto.'">
                        <div class="col-xs-12 nopadding">
                            <div class="sect height col-xs-12 col-sm-1 col-md-1 nopadding">
                                <div class="vertical">
                                    <div class="col-xs-12 nopadding">
                                        <div class="checkbox '.$class.'" IdProducto="'.$IdProducto.'">
                                            <input type="checkbox" tabindex="0">
                                            <div>
                                                <svg version="1.1" id="nochecked" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 39.2 41.6" style="enable-background:new 0 0 39.2 41.6;" xml:space="preserve">
                                                    <path class="unchecked" d="M1.5,6.6H34c0.6,0,1,0.4,1,1v32.5c0,0.6-0.4,1-1,1H1.5c-0.6,0-1-0.4-1-1V7.6C0.5,7.1,0.9,6.6,1.5,6.6z"></path>
                                                </svg>
                                                <svg version="1.1" id="checked" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 39.2 41.6" style="enable-background:new 0 0 39.2 41.6;" xml:space="preserve">
                                                    <path class="cheked_1" d="M3.8,20.9c4.9,5.1,9.1,10.9,12.4,17.2c6-12.9,13.7-25,23.1-35.7L37.1,0C30.8,6.2,21,18,15.9,27.5
                                                        c-2.4-3.9-5.2-7.6-8.4-10.8L3.8,20.9L3.8,20.9z"></path>
                                                    <path class="checked_2" d="M35,17.5v22.6c0,0.6-0.4,1-1,1H1.5c-0.6,0-1-0.4-1-1V7.6c0-0.6,0.4-1,1-1H21"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sect col-xs-12 col-sm-8 col-lg-9 nopadding">
                                <div class="col-xs-12 col-sm-3 height">
                                    '.$html1.'
                                    <img src="Admin/assets/img/Productos/'.$IdProducto.'/img_1.jpg" alt="" class="product">
                                </div>
                                <div class="col-xs-12 col-sm-6 height text-left">
                                    <h5 class="col-xs-12 noHorizontalPadding vpadding nopaddingBottom nomargin bold">'.$NombreProducto.'</h5>
                                    <p class="col-xs-12 noHorizontalPadding vpadding nopaddingBottom nomargin light">'.$Descripcion.'</p>
                                </div>
                                <div class="col-xs-12 col-sm-3 height">
                                    <h5 class="col-xs-12 noHorizontalPadding vpadding nomargin regular">'.$Moneda.' '.$Precio.'</h5>
                                    <div class="vertical end" style="pointer-events: none;">
                                        <div class="col-xs-12 nopadding text-center">
                                            <a href="DetalleProductoTwo?IdProducto='.$IdProducto.'" class="verMas centered">VER MAS</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sect col-xs-12 col-sm-3 col-lg-2 height">
                                <div class="vertical">
                                    <div class="col-xs-12 nopadding text-center">
                                        <div class="col-xs-12 nopadding dicrease">
                                            <div class="input">
                                                <input type="text" value="'.$enCarrito.'" class="Cantidad'.$IdProducto.'">
                                            </div>
                                            <a href="#" class="minus">
                                                <img src="assets/img/minusGrey.svg" alt="">
                                            </a>
                                            <a href="#" class="plus">
                                                <img src="assets/img/plusGrey.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
            return $html;
        }else{
            return false;
        }
    }

    function getExistenciaEnCarrito($IdProducto){
        $enCarrito=0;
        if ($this->cart->total_items()>0) {
            $Cart=$this->cart->contents();
            foreach ($Cart as $item){
                if ($item['id']==$IdProducto) {
                    $qty=$item['qty'];
                    $enCarrito=$qty;
                }
            }
        }
        return $enCarrito;
    }

    function tienePrecioEscala($IdProducto){
        $this->db->select('*');
        $this->db->from('precioescala');
        $this->db->where('precioescala.IdProducto', $IdProducto);
        $result = $this->db->get();
        if ($result->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

}
?>
