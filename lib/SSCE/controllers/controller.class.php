<?php
class Controller {
    
    private $_oDb;
    private $_oConfig;
    private $_oRequest;
    
    public function __construct($aObjects) {
        $this->_oDb         = $aObjects['db'];
        $this->_oConfig     = $aObjects['config'];
        $this->_oRequest    = $aObjects['request'];
    }
    
    public function getDb(){
        return $this->_oDb;
    }
    
    public function getConfig(){
        return $this->_oConfig;
    }
    
    public function getRequest(){
        return $this->_oRequest;
    }
}