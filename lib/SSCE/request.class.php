<?php
class SSCE_Request {
    
    private $_aPath     = array();
    private $_aParams   = array();
    private $_sCurrent  = '';
    private $_bIsOk     = false;
    
    public function __construct(){
        if (in_array(strtolower( ini_get('magic_quotes_gpc')), array('1', 'on'))) {
            $_POST      = array_map('stripslashes', $_POST );
            $_GET       = array_map('stripslashes', $_GET );
            $_COOKIE    = array_map('stripslashes', $_COOKIE );
        }
        
        $aRequestUrl        = parse_url( $_SERVER['REQUEST_URI'] );
        $aPathUnfrm         = explode( '/', $aRequestUrl['path'] );
        array_shift( $aPathUnfrm );

        foreach ( $aPathUnfrm as $iKey  => $mVal ) {
            if ( $mVal == '' ) {
                unset( $aPathUnfrm[ $iKey ] );
                continue;
            }
            if ($iKey > 0) {
                $this->_aParams[]   = $mVal;
            } else {
                $this->_aPath[]     = $mVal;
            }
        }
        if (sizeof($this->_aPath) > 0) {
            $this->_sCurrent    = end($this->_aPath);
        } else {
            $this->_sCurrent    = 'main';
        }
        
        switch ($this->_sCurrent) {
            case '403':
                $this->_sCurrent    = 'error403';
                header("HTTP/1.0 403 Forbidden");
            break;
            case '404':
                $this->_sCurrent    = 'error404';
                header("HTTP/1.0 404 Not Found");
            break;
            default:
                $this->_bIsOk   = true;
        }
    }
    
    public function getPath() {
        return $this->_aPath;
    }
    
    public function getParams() {
        return $this->_aParams;
    }
    
    public function getCurrent() {
        return $this->_sCurrent;
    }
    
    public function isOk() {
        return $this->_bIsOk;
    }
    
    public function go404() {
        header('Location: /404');
        exit();
    }


    public function go($sUrl) {
        header('Location: '.$sUrl);
        exit();
    }


    public function refresh() {
        header('Location: '.substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'?')));
        exit();
    }


    public function getHeaders() {
        return $this->aHeader;
    }


    public function addHeader($sHeader) {
        $this->aHeader[]    = $sHeader;
        return $this;
    }
    
}