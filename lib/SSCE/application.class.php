<?php
class SSCE_Application {
    
    private $_oConfig;
    private $_sConfigFile;
    private $_oDb;
    private $_oRequest;
    private $_oDirector;
 
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
        
        require_once $this->getConfig()->db->lib_path.'/Generic.php';
        require_once $this->getConfig()->db->lib_path.'/Mysql.php';
        $this->_oDb = DbSimple_Generic::connect("mysql://".$this->getConfig()->db->user.":".$this->getConfig()->db->password."@".$this->getConfig()->db->host."/".$this->getConfig()->db->database);
        $this->getDb()->setIdentPrefix($this->getConfig()->db->table_prefix);
        $this->getDb()->query("SET NAMES utf8;");
        
        $this->_oRequest    = new SSCE_Request();
        $this->_oDirector   = new SSCE_Director(array(
            'db'        => $this->getDb(),
            'config'    => $this->getConfig(),
            'request'   => $this->getRequest(),
        ));
        $this->getDirector()->bootstrap();

    }
    
    public function getConfig() {
        return $this->_oConfig->getData();
    }
    
    public function getDb() {
        return $this->_oDb;
    }
    
    public function getRequest() {
        return $this->_oRequest;
    }
    
    public function getDirector() {
        return $this->_oDirector;
    }
}