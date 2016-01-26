<?php
class SSCE_Director {
    
    private $_aObjects;
    private $_sCNameSuffix  = '_Controller';
    private $_sANameSuffix  = 'Action';

    
    public function __construct($aObjects){
        $this->_aObjects    = $aObjects;
        require_once 'helpers/controller.helper.php';
    }
    
    public function bootstrap() {
        $oBootstrap = new Bootstrap_Controller($this->getObjects());
        $oBootstrap->run();
        return $this;
    }
    
    public function runCurrent(){
        $sController    = $this->getRequest()->getController();
        if ($sController == '') {
            $this->getRequest()->go404();
        }
        $sCClass        = ucfirst($sController).$this->_sCNameSuffix;
        $sAction        = $this->getRequest()->getAction().$this->_sANameSuffix;

        try {
            $oController = new $sCClass($this->getObjects());
            call_user_func_array(array($oController, $sAction), $this->getRequest()->getParams());
        } catch (Exception $e) {
            $this->getRequest()->go404();
        }
        
        echo $this->getView()
            ->setTemplate($oController->getTemplate())
            ->setLayout($oController->getLayout())
            ->setTitle($oController->getTitle())
            ->render();
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