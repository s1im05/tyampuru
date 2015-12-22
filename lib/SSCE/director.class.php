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
        $sController    = $this->getRequest()->getController();
        $sAction        = $this->getRequest()->getAction();
        $sControllerClassName  = ucfirst($sController).'_Controller';
        
        if (file_exists(__DIR__.'/controllers/'.$sController.'.controller.class.php')) {
            require_once __DIR__.'/controllers/'.$sController.'.controller.class.php';
            $oCurrentController = new $sControllerClassName($this->getObjects());
            $oCurrentController->$sAction();
            echo $this->getView()
                ->setTemplate($oCurrentController->getTemplate())
                ->setLayout($oCurrentController->getLayout())
                ->setTitle($oCurrentController->getTitle())
                ->render();
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
    
    public function getView() {
        return $this->_aObjects['view'];
    }
}