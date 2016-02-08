<?php
abstract class Base {
    
    protected $_oDb;
    protected $_oConfig;
    protected $_oRequest;
    protected $_oView;
    
    public function __construct($aObjects) {
        $this->_oDb         = $aObjects['db'];
        $this->_oConfig     = $aObjects['config'];
        $this->_oRequest    = $aObjects['request'];
        $this->_oView       = $aObjects['view'];
    }
    
    public function __get($sKey){
        switch ($sKey){
            case 'db': 
                return $this->getDb();
            case 'config': 
                return $this->getConfig();
            case 'request': 
                return $this->getRequest();
            case 'view': 
                return $this->getView();
            case 'options': 
                return array(
                    'db'        => $this->getDb(),
                    'config'    => $this->getConfig(),
                    'request'   => $this->getRequest(),
                    'view'      => $this->getView()
                );
            default: 
                return null;
        }
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
    
    public function getView(){
        return $this->_oView;
    }
}