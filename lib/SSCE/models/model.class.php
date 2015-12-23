<?php
class Model {
    
    protected $_oDb;
    protected $_oConfig;
 
    public function __construct($oDb, $oConfig){
        $this->_oDb        = $oDb;
        $this->_oConfig    = $oConfig;
    }
    
    public function getDb(){
        return $this->_oDb;
    }
    
    public function getConfig(){
        return $this->_oConfig;
    }
}