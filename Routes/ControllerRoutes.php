<?php
class ControllerRoutes extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->titulo = 'INNOVALED';
        $this->_view->renderizar('Header');
        $this->_view->renderizar('Home');
        $this->_view->renderizar('Footer');
    }

}
?>
