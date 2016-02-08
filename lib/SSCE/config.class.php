<?php
class SSCE_Config {
    
    private $_aData;
 
    public function __construct($sConfigFile){
        if (file_exists($sConfigFile)) {
            $this->_aData   = json_decode( file_get_contents($sConfigFile) );
        } else {
            throw new Exception('Unable to load config file');
        }
    }

    public function __get($sKey){
        if (isset($this->_aData->$sKey)){
            return $this->_aData->$sKey;
        }
    }
    
    public function getData() {
        return $this->_aData;
    }
}