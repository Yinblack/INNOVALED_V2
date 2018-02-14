<?php

class View
{
    private $_controlador;
    
    public function __construct(Request $peticion) {
        $this->_controlador = $peticion->getControlador();
    }
    
    public function renderizar($vista)
    {
        
        $_resource = array(
            'css' => LOCATION_RESOURCES.'css/',
            'img' => LOCATION_RESOURCES.'img/',
            'js' => LOCATION_RESOURCES.'js/'
        );
        
        $rutaView = ROOT . 'views' . DS . $vista . '.phtml';
        if(is_readable($rutaView)){
            include_once $rutaView;
        } 
        else {
            throw new Exception('Error de vista');
        }
    }
}

?>
