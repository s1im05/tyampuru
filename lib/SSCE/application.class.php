<?php
class SSCE_Application {
    
    private $_oConfig;
    private $_sConfigFile;
    private $_oDb;
    private $_oView;
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
            $sIncludePath   = '';
            if (preg_match('/SSCE_([A-Za-z]+)/', $sClassName, $aMatch) && isset($aMatch[1])){
                $sIncludePath   = dirname(__FILE__).'/'.strtolower($aMatch[1]).'.class.php';
            } elseif (preg_match('/^([A-Za-z]+)?_?Controller$/', $sClassName, $aMatch)){
                $sIncludePath   = dirname(__FILE__).'/controllers/'.(isset($aMatch[1]) ? strtolower($aMatch[1]).'.controller.class.php' : 'controller.class.php');
            } elseif (preg_match('/^([A-Za-z]+)?_?Model$/', $sClassName, $aMatch)){
                $sIncludePath   = dirname(__FILE__).'/models/'.(isset($aMatch[1]) ? strtolower($aMatch[1]).'.model.class.php' : 'model.class.php');
            }
            
            if ($sIncludePath === '') {
                throw new Exception("Autoloader Exception: can't match {$sClassName}");
            } elseif (!file_exists($sIncludePath)) {
                throw new Exception("Autoloader Exception: file {$sIncludePath} not exists");
            } else {
                require_once $sIncludePath;
            }
        }
        
        require_once 'base.class.php';
        
        $this->_oConfig = new SSCE_Config($this->_sConfigFile);
        setlocale(LC_ALL , $this->getConfig()->project->locale);
        $this->_oView   = new SSCE_View($this->getConfig()->templates->path);
        
        require_once $_SERVER['DOCUMENT_ROOT'].$this->getConfig()->db->lib_path.'/Generic.php';
        require_once $_SERVER['DOCUMENT_ROOT'].$this->getConfig()->db->lib_path.'/Mysql.php';
        $this->_oDb = DbSimple_Generic::connect("mysql://".$this->getConfig()->db->user.($this->getConfig()->db->password ? ":".$this->getConfig()->db->password:'' )."@".$this->getConfig()->db->host."/".$this->getConfig()->db->database);
        $this->getDb()->setIdentPrefix($this->getConfig()->db->table_prefix);
        $this->getDb()->query("SET NAMES utf8");

        $oRoutesConfig  = new SSCE_Config($_SERVER['DOCUMENT_ROOT'].$this->getConfig()->router->path);
        
        $this->_oRequest    = new SSCE_Request($oRoutesConfig->routes);
        $this->_oDirector   = new SSCE_Director(array(
            'db'        => $this->getDb(),
            'config'    => $this->getConfig(),
            'request'   => $this->getRequest(),
            'view'      => $this->getView(),
        ));
        $this->getDirector()->bootstrap()->runCurrent();
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
    
    public function getView() {
        return $this->_oView;
    }
}