<?php
class SSCE_Application {
    
    private $_oConfig;
    private $_sConfigFile;
 
    public function __construct($sConfigFile){
        $this->_sConfigFile         = $sConfigFile;
        $this->_boot();
    }
    
    private function _boot(){
        session_start();
        ob_start();
        
        function __autoload($sClassName) {
            if (preg_match('/SSCE_([A-Za-z]+)/', $sClassName, $aMatch) && isset($aMatch[1])) {
                require_once dirname(__FILE__).'/'.strtolower($aMatch[1]).'.class.php';
            } else {
                throw new Exception("Unable to load {$sClassName}");
            }
        }
        
        $this->_oConfig = new SSCE_Config($this->_sConfigFile);
        setlocale(LC_ALL , $this->getConfig()->project->locale);
    }
    
    public function getConfig() {
        return $this->_oConfig->getData();
    }
}