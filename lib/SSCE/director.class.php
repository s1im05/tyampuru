<?php
class SSCE_Director {
    
    private $_aObjects;

    
    public function __construct($aObjects){
        $this->_aObjects    = $aObjects;
        
        require_once 'controllers/controller.class.php';
        
    }
    
    public function bootstrap() {
        require_once 'controllers/bootstrap.controller.class.php';
        $oBootstrap = new Bootstrap_Controller($this->getObjects());
        $oBootstrap->run();
        return $this;
    }
    
    public function getObjects(){
        return $this->_aObjects;
    }
}