<?php
class Request
{
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    
    public function __construct() {
        if(isset($_GET['url'])){

            $url = $_GET['url'];
            $this->_metodo = strtolower($url);

        }       
        
        $this->_controlador = DEFAULT_CONTROLLER;
        
        if(!$this->_metodo){
            $this->_metodo = 'index';
        }
        
        if(!isset($this->_argumentos)){
            $this->_argumentos = array();
        }
    }
    
    public function getControlador()
    {
        return 'ControllerRoutes';
    }
    
    public function getMetodo()
    {
        return $this->_metodo;
    }
}

?>