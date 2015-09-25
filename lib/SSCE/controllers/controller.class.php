<?php
abstract class Controller {
    
    private $_oDb;
    private $_oConfig;
    private $_oRequest;
    private $_aViewVars = array();
    
    protected $_sTitle  = '';
    protected $_sLayout  = 'index.php';
    protected $_sTemplate  = 'template.php';
    
    public function __construct($aObjects) {
        $this->_oDb         = $aObjects['db'];
        $this->_oConfig     = $aObjects['config'];
        $this->_oRequest    = $aObjects['request'];
    }
    
    public abstract function run();
    
    public function getDb(){
        return $this->_oDb;
    }
    
    public function getConfig(){
        return $this->_oConfig;
    }
    
    public function getRequest(){
        return $this->_oRequest;
    }
    
    public function getTitle(){
        return $this->_sTitle;
    }
    
    public function setTitle($sTitle){
        $this->_sTitle  = $sTitle;
        return $this;
    }
    
    public function setTemplate($sTemplate){
        $this->_sTemplate  = $sTemplate;
        return $this;
    }
    
    public function setLayout($sLayout){
        $this->_sLayout  = $sLayout;
        return $this;
    }
    
    public function assign($sKey, $mVar) {
        $this->_aViewVars[$sKey]    = $mVar;
        return this;
    }
    
}