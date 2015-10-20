<?php
class SSCE_Director {
    
    private $_aObjects;

    
    public function __construct($aObjects){
        $this->_aObjects    = $aObjects;
        require_once 'controllers/controller.class.php';
        
    }
    
    public function bootstrap() {
        require_once __DIR__.'/controllers/bootstrap.controller.class.php';
        $oBootstrap = new Bootstrap_Controller($this->getObjects());
        $oBootstrap->run();
        return $this;
    }
    
    public function runCurrent(){
        $sCurrent   = $this->getRequest()->getCurrent();
        $sCurrentClassName  = ucfirst($sCurrent).'_Controller';
        
        if (file_exists(__DIR__.'/controllers/'.$sCurrent.'.controller.class.php')) {
            require_once __DIR__.'/controllers/'.$sCurrent.'.controller.class.php';
            $oCurrentController = new $sCurrentClassName($this->getObjects());
            $oCurrentController->run();
        } elseif ($aPage    = $this->getDb()->selectRow("SELECT * FROM ?_pages WHERE name = ? LIMIT 1;", $sCurrent)) {
            var_dump($aPage);
        } else {
            $this->getRequest()->go404();
        }
    }
    
    public function getObjects(){
        return $this->_aObjects;
    }
    
    public function getRequest() {
        return $this->_aObjects['request'];
    }
    
    public function getDb() {
        return $this->_aObjects['db'];
    }
}