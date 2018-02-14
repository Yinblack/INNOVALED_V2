<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
  				$this->load->model('Producto_m');
	}
	public function addProducto(){
		$not = array(",","<?","?>","<?php");

		$Nombre=$_POST['Nombre'];
		$Nombre = str_replace($not, "", $Nombre);

		$Linea=$_POST['Linea'];
		$SubLinea=$_POST['SubLinea'];

		$Marca=$_POST['Marca'];
		$Marca = str_replace($not, "", $Marca);

		$Precio=$_POST['Precio'];
		$Mostrar=$_POST['Mostrar'];
		$Moneda=$_POST['Moneda'];
		$Show=$_POST['Show'];
		$Orden=$_POST['Orden'];

		$Descripcion=$_POST['Descripcion'];
		$Descripcion = str_replace($not, "", $Descripcion);

		$dataProducto = array(
			'IdSubLinea' => $SubLinea,
			'IdMoneda'    => $Moneda,
			'Nombre'  => $Nombre,
			'Slug'  => '',
			'Marca'  => $Marca,
			'Precio'  => $Precio,
			'MostrarPrecio'  => $Show,
			'Descripcion'  => $Descripcion,
			'Estado'  => '1',
			'Orden'  => $Orden
		);
		$result=true;
		$IdProducto=$this->Producto_m->addProducto($dataProducto);

		for ($i=1; $i < 100; $i++) {
			if (isset($_POST['Titulo'.$i])){
				$dataCaracteristicas = array(
					'IdProducto' => $IdProducto,
					'Titulo'     => $_POST['Titulo'.$i],
					'Valor'      => $_POST['Valor'.$i]
				);
				$this->Producto_m->addCaracteristica($dataCaracteristicas);
			}
		}
		if ($IdProducto!=false){
			$dir="assets/img/Productos/".$IdProducto."/";
			$dirPdf="assets/img/Productos/".$IdProducto."/pdf/";
			if (!file_exists($dir)) {
				if (mkdir($dir, 0777)) {
					mkdir($dirPdf, 0777);
				}
			}
			for ($i=1; $i < 6; $i++) {
				if ($_FILES['Imagen'.$i]['tmp_name']) {
					$file = 'img_'.$i.'.jpg';
					if (!move_uploaded_file( $_FILES['Imagen'.$i]['tmp_name'], $dir.$file)) {
						$result=false;
					}
				}
			}
			if ($_FILES['FichaTecnica']['tmp_name']) {
				$filePdf = 'FichaTecnica'.'.pdf';
				if (!move_uploaded_file( $_FILES['FichaTecnica']['tmp_name'], $dirPdf.$filePdf)) {
					$result=false;
				}
			}
			if ($result==true) {
				echo "success";
			}
		}else{
			echo "error al agregar informacion de producto.";
		}
	}

	public function updateProducto(){

		$IdProducto  =$_POST['IdProducto'];
		$Nombre      =$_POST['Nombre'];
		$Linea       =$_POST['Linea'];
		$SubLinea    =$_POST['SubLinea'];
		$Marca       =$_POST['Marca'];
		$Precio      =$_POST['Precio'];
		$Mostrar     =$_POST['Mostrar'];
		$Moneda      =$_POST['Moneda'];
		$Show        =$_POST['Show'];
		$Orden       =$_POST['Orden'];
		$Descripcion =$_POST['Descripcion'];
		if (isset($_POST['row_cnt'])) {
			$row_cnt=$_POST['row_cnt'];
		}else{
			$row_cnt=0;
		}

		$dataProducto = array(
			'IdSubLinea'    => $SubLinea,
			'IdMoneda'      => $Moneda,
			'Nombre'        => $Nombre,
			'Slug'          => '',
			'Marca'         => $Marca,
			'Precio'        => $Precio,
			'MostrarPrecio' => $Show,
			'Descripcion'   => $Descripcion,
			'Estado'        => '1',
			'Orden'         => $Orden
		);
		$result=true;
		if (!$this->Producto_m->updateProducto($dataProducto, $IdProducto)) {
			$result=false;
		}

		//CAracteristicas nuevas
		$init=$row_cnt+1;
		for ($i=$init; $i < 100; $i++) {
			if (isset($_POST['Titulo'.$i])){
				$dataCaracteristicas = array(
					'IdProducto' => $IdProducto,
					'Titulo'     => $_POST['Titulo'.$i],
					'Valor'      => $_POST['Valor'.$i]
				);
				if (!$this->Producto_m->addCaracteristica($dataCaracteristicas)) {
					$result=false;
				}
			}
		}

		//CAracteristicas a editar
		for ($i=1; $i <= $row_cnt; $i++) {
			if (isset($_POST['Titulo'.$i])){
				$dataCaracteristicas = array(
					'IdCarecterisctica' => $_POST['IdCarecterisctica'.$i],
					'IdProducto'        => $IdProducto,
					'Titulo'            => $_POST['Titulo'.$i],
					'Valor'             => $_POST['Valor'.$i]
				);
				if (!$this->Producto_m->updateCaracteristica($dataCaracteristicas)) {
					$result=false;
				}
			}
		}

		for ($i=1; $i <= $row_cnt; $i++) {
			if (isset($_POST['deleteItem'.$i])){
				$IdCarecterisctica=$_POST['deleteItem'.$i];
				if (!$this->Producto_m->deleteCaracteristica($IdCarecterisctica)) {
					$result=false;
				}
			}
		}

		$dir="assets/img/Productos/".$IdProducto."/";
		for ($i=1; $i < 6; $i++){
			if ($_FILES['img_'.$i]['tmp_name']) {
				$file = 'img_'.$i.'.jpg';
				if (!move_uploaded_file( $_FILES['img_'.$i]['tmp_name'], $dir.$file)) {
					$result=false;
				}
			}
		}

		for ($i=1; $i < 6; $i++){
			if (isset($_POST['delimg_'.$i]) && $_POST['delimg_'.$i]=='Quitar') {
				$file = 'img_'.$i.'.jpg';
				if (!unlink($dir.$file)) {
					$result=false;
				}
			}
		}

		if ($_FILES['FichaTecnica']['tmp_name']) {
			$dirPdf="assets/img/Productos/".$IdProducto."/pdf/";
			$filePdf = 'FichaTecnica'.'.pdf';
			if (!move_uploaded_file( $_FILES['FichaTecnica']['tmp_name'], $dirPdf.$filePdf)) {
				$result=false;
			}
		}

		if (isset($_POST['delFicha']) && $_POST['delFicha']=='Quitar') {
			$dirPdf="assets/img/Productos/".$IdProducto."/pdf/";
			$filePdf = 'FichaTecnica'.'.pdf';
			if (!unlink($dirPdf.$filePdf)) {
				$result=false;
			}
		}

		if ($result==true) {
			echo "success";
		}
	}

	public function deleteProducto(){
		$IdProducto=$_POST['IdProducto'];
		$dataProducto = array(
			'Estado' => '0'
		);
		if ($this->Producto_m->updateProducto($dataProducto, $IdProducto)) {
			$dirPdf="assets/img/Productos/".$IdProducto."/pdf/";
			foreach (glob($dirPdf."*.*") as $filename) {
			    if (is_file($filename)) {
			        unlink($filename);
			    }
			}
			rmdir($dirPdf);
			$dir="assets/img/Productos/".$IdProducto."/";
			foreach (glob($dir."*.*") as $filename) {
			    if (is_file($filename)) {
			        unlink($filename);
			    }
			}
			rmdir($dir);
			echo 'success';
		}else{
			echo "error";
		}
	}

	public function getPrecioFromId(){
		$IdProducto=$_POST['IdProducto'];
		$precio=$this->Producto_m->getPrecioFromId($IdProducto);
		echo $precio;
	}

	public function addEscalaPrecio(){
		$IdProducto=$_POST['Producto'];
		$Desde=$_POST['MayorQue'];
		$Descuento=$_POST['PorcentajeDescuento'];
		$dataEscalaPrecio = array(
			'IdProducto' => $IdProducto,
			'Desde'      => $Desde,
			'Descuento'  => $Descuento
		);
		if ($this->Producto_m->addEscalaPrecio($dataEscalaPrecio)) {
			echo "success";
		}
	}

	public function updateEscalaPrecio(){
		$IdProducto=$_POST['Producto'];
		$Desde=$_POST['MayorQue'];
		$Descuento=$_POST['PorcentajeDescuento'];
		$IdPrecioEscala=$_POST['IdPrecioEscala'];
		$dataEscalaPrecio = array(
			'IdPrecioEscala' => $IdPrecioEscala,
			'IdProducto'     => $IdProducto,
			'Desde'          => $Desde,
			'Descuento'      => $Descuento
		);
		if ($this->Producto_m->updateEscalaPrecio($dataEscalaPrecio)) {
			echo "success";
		}
	}

	public function deletePrecioEscala(){
		$IdEscalaPrecio=$_POST['IdEscalaPrecio'];
		if ($this->Producto_m->deleteEscalaPrecio($IdEscalaPrecio)) {
			echo 'success';
		}else{
			echo "error";
		}
	}

	public function addLinea(){
		$Etiqueta=$_POST['Etiqueta'];
		$dataLinea = array(
			'Etiqueta'  => $Etiqueta
		);
		if ($this->Producto_m->addLinea($dataLinea)) {
			echo "success";
		}
	}

	public function addSubLinea(){
		$Etiqueta=$_POST['Etiqueta'];
		$IdLinea=$_POST['IdLinea'];
		$dataSubLinea = array(
			'IdLinea'  => $IdLinea,
			'Etiqueta' => $Etiqueta
		);
		$IdSubLinea=$this->Producto_m->addSubLinea($dataSubLinea);
		if ($IdSubLinea!=false) {
			if ($_FILES['Imagen']['tmp_name']) {
				$dir="assets/img/Sublineas/".$IdSubLinea."/";
				if (!file_exists($dir)) {
					mkdir($dir, 0777);
				}
				$file = 'img.png';
				if (move_uploaded_file( $_FILES['Imagen']['tmp_name'], $dir.$file)) {
					echo "success";
				}
			}
		}
	}

	public function updateLinea(){
		$Etiqueta=$_POST['Etiqueta'];
		$IdLinea=$_POST['IdLinea'];
		if ($this->Producto_m->updateLinea($Etiqueta, $IdLinea)) {
			echo "success";
		}
	}

	public function updateSubLinea(){
		$Etiqueta=$_POST['Etiqueta'];
		$IdSubLinea=$_POST['IdSubLinea'];
		if ($this->Producto_m->updateSubLinea($Etiqueta, $IdSubLinea)) {
			if ($_FILES['Imagen']['tmp_name']) {
				$dir="assets/img/Sublineas/".$IdSubLinea."/";
				$file = 'img.png';
				if (move_uploaded_file($_FILES['Imagen']['tmp_name'], $dir.$file)) {
					echo "success";
				}
			}else{
				echo "success";
			}
		}
	}

	public function deleteLinea(){
		$IdLinea=$_POST['IdLinea'];
		if ($this->Producto_m->deleteLinea($IdLinea)) {
			echo 'success';
		}else{
			echo "OCUPADO";
		}
	}

	public function deleteSubLinea(){
		$IdSubLinea=$_POST['IdSubLinea'];
		if ($this->Producto_m->deleteSubLinea($IdSubLinea)) {
			$dir="assets/img/Sublineas/".$IdSubLinea."/";
			foreach (glob($dir."*.*") as $filename) {
			    if (is_file($filename)) {
			        unlink($filename);
			    }
			}
			rmdir($dir);
			echo 'success';
		}else{
			echo "OCUPADO";
		}
	}

	public function getSubLineasFromLinea(){
		$IdLinea=$_POST['IdLinea'];
		$sublineas=$this->Producto_m->getSubLineasFromLinea($IdLinea);
		if ($sublineas==false) {
			echo "Nan";
		}else{
			print_r(json_encode($sublineas));
		}
	}

	public function getProductosFromSublinea(){
		$IdSubLinea=$_POST['IdSubLinea'];
		$sublineas=$this->Producto_m->getProductosFromSublinea($IdSubLinea);
		if ($sublineas==false) {
			echo "Nan";
		}else{
			print_r(json_encode($sublineas));
		}
	}

	public function getProductosFromSublineaReturnItems(){
		$IdSubLinea=$_POST['IdSubLinea'];
		$html=$this->Producto_m->getProductosFromSublineaReturnItems($IdSubLinea);
		if ($html==false) {
			echo "error";
		}else{
			print_r($html);
		}
	}





}
