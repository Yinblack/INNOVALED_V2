<?php
class ControllerRoutes extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->titulo = 'INNOVALED';
        $this->_view->js = '
        ';
        $this->_view->renderizar('Header');
        $this->_view->renderizar('Home');
        $this->_view->renderizar('Footer');
    }

    public function productos()
    {
        $this->_view->titulo = 'INNOVALED | Productos';
        $this->_view->productos = 'active';
        $this->_view->renderizar('Header');
        $this->_view->renderizar('Productos');
        $this->_view->renderizar('Footer');
    }

    public function DetalleProducto()
    {
        $this->_view->titulo = 'INNOVALED | Detalle de producto';
        $this->_view->productos = 'active';
        $this->_view->js = '
            <script src="assets/js/detalleProducto.js"></script>
        ';
        $this->_view->renderizar('Header');
        $this->_view->renderizar('DetalleProducto');
        $this->_view->renderizar('Footer');
    }

}
?>
