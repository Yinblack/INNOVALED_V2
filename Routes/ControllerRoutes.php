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
            <script src="assets/js/Menu.js"></script>
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

}
?>
