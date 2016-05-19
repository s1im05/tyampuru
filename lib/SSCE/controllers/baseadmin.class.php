<?php
namespace SSCE\Controllers;

class BaseAdmin extends Base {
    
    protected $_sLayout     = 'index.php';

    public function __construct(){
        $oUser      = new \SSCE\Models\User($this->options);

        if (!$oUser->isLogged()){
            $this->_sLayout     = 'login.php';
        }
    }
}