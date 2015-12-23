<?php
class Model {
    
    private $_oDb;
    private $_oConfig;
 
    public function __construct($oDb, $oConfig){
        $thiis->_oDb        = $oDb;
        $thiis->_oConfig    = $oConfig;
    }
    
    public function getDb(){
        return $thiis->_oDB;
    }
    
    public function getConfig(){
        return $thiis->_oConfig;
    }
}