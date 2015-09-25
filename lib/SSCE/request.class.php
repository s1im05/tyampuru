<?php
class SSCE_Request {
    
    public function __construct(){
        if (in_array(strtolower( ini_get('magic_quotes_gpc')), array('1', 'on'))) {
            $_POST      = array_map('stripslashes', $_POST );
            $_GET       = array_map('stripslashes', $_GET );
            $_COOKIE    = array_map('stripslashes', $_COOKIE );
        }
    }
    
}