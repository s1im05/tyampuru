<?php
class SSCE_Application {
    
    private $_oConfig;
    private $_sConfigFile;
    private $_oDb;
 
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
        
        if (in_array(strtolower( ini_get('magic_quotes_gpc')), array('1', 'on'))) {
            $_POST      = array_map('stripslashes', $_POST );
            $_GET       = array_map('stripslashes', $_GET );
            $_COOKIE    = array_map('stripslashes', $_COOKIE );
        }
        
        $this->_oConfig = new SSCE_Config($this->_sConfigFile);
        setlocale(LC_ALL , $this->getConfig()->project->locale);
        
        require_once $this->getConfig()->db->lib_path.'/Generic.php';
        require_once $this->getConfig()->db->lib_path.'/Mysql.php';
        $this->_oDb = DbSimple_Generic::connect("mysql://".$this->getConfig()->db->user.":".$this->getConfig()->db->password."@".$this->getConfig()->db->host."/".$this->getConfig()->db->database);
        $this->getDb()->setIdentPrefix($this->getConfig()->db->table_prefix);
        $this->getDb()->query("SET NAMES utf8;");
        
    }
    
    public function getConfig() {
        return $this->_oConfig->getData();
    }
    
    public function getDb() {
        return $this->_oDb;
    }
}