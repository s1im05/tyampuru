<?php
namespace SSCE;

class View {
    
    protected $_sTemplate;
    protected $_sLayout;
    protected $_sTitle;
    protected $_aVars   = array();
    protected $_sTemplatePath;
    
    private $_sTemplateName = 'template';
    private $_sPathName     = 'path';
    private $_sTitleName    = 'title';
    private $_sTplPath      = '/tpl';
    private $_sLang         = '';
    
    
    public function __construct($sTemplatePath, $sLang){
        $this->_sTemplatePath   = $sTemplatePath;
        $this->_sLang           = $sLang;
    }
    
    public function assign($sName, $mVal){
        $this->_aVars[$sName]   = $mVal;
        return $this;
    }
    
    public function getVar($sName){
        return isset($this->_aVars[$sName]) ? $this->_aVars[$sName] : null;
    }
    
    public function render(){
        ob_end_flush();
        $this->assign($this->_sPathName,        $this->_sTemplatePath);
        $this->assign($this->_sTitleName,       $this->getTitle());
        $this->assign($this->_sTemplateName,    $this->getTemplate());
        foreach($this->_aVars as $sName => $mVal){
            $$sName = $mVal;
        }

        ob_start();
        $sCwd   = getcwd();
        
        $iLevel = error_reporting();
        error_reporting(0);
        
        require_once 'helpers/view.helper.php';
        chdir($_SERVER['DOCUMENT_ROOT'].$this->_sTemplatePath.$this->_sTplPath);

        require $this->getLayout();
        $aData  = ob_get_contents();
        ob_clean();
        
        error_reporting($iLevel);
        chdir($sCwd);
        
        return $aData;
    }
    
    
    public function setTemplate($sTemplate){
        $this->_sTemplate = $sTemplate;
        return $this;
    }
    
    public function getTemplate(){
        return $this->_sTemplate;
    }
    
    public function setTitle($sTitle){
        $this->_sTitle = $sTitle;
        return $this;
    }
    
    public function getTitle(){
        return $this->_sTitle;
    }
    
    public function setLayout($sLayout){
        $this->_sLayout = $sLayout;
        return $this;
    }
    
    public function getLayout(){
        return $this->_sLayout;
    }
    
    public function lang($aStrings, $sDefault = ''){
        return (isset($aStrings[$this->_sLang]) && $aStrings[$this->_sLang] != '') ? $aStrings[$this->_sLang] : $sDefault;
    }
    
    public function getLang(){
        return $this->_sLang;
    }
    
    public function isLang($sLang){
        return ($this->_sLang === $sLang);
    }
}