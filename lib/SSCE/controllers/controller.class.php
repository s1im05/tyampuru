<?php
abstract class Controller {
    
    private $_sActionSuffix = 'Action';

    protected $_oDb;
    protected $_oConfig;
    protected $_oRequest;
    protected $_oView;
    protected $_sAction     = 'index';    
    protected $_sTitle      = '';
    protected $_sLayout     = 'index.php';
    protected $_sTemplate   = 'template.php';
    
    public function __construct($aObjects) {
        $this->_oDb         = $aObjects['db'];
        $this->_oConfig     = $aObjects['config'];
        $this->_oRequest    = $aObjects['request'];
        $this->_oView       = $aObjects['view'];
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
    
    public function getTemplate(){
        return $this->_sTemplate;
    }
    
    public function setLayout($sLayout){
        $this->_sLayout  = $sLayout;
        return $this;
    }
    
    public function getLayout(){
        return $this->_sLayout;
    }
    
    public function assign($sName, $mVal){
        $this->getView()->assign($sName, $mVal);
        return $this;
    }
}