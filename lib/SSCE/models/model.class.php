<?php
class Model {
    
    protected $_oDb;
    protected $_oConfig;
    protected $_sTable;
    protected $_sIdField    = 'id';
    
    private $_aData = array();
 
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
    
    public function __set($sAttr, $mValue){
        switch ($sAttr) {
            case $this->_sIdField: 
                $this->_aData  = $this->getDb()->selectRow("SELECT * FROM ?_".$this->_sTable." WHERE `".$this->_sIdField."`  = ?d LIMIT 1;", $mValue);
            break;
            default:
                $this->_aData[$sAttr]   = $mValue;
        }
    }
    
    public function __get($sAttr){
        switch ($sAttr) {
            case 'data':
                return $this->_aData;
            break;
            default:
                if (isset($this->_aData[$sAttr])) {
                    return $this->_aData[$sAttr];
                } else {
                    trigger_error(
                        'Property "'.$sAttr.'" is undefined',
                        E_USER_NOTICE);
                    return null;
                }
        }
    }
}