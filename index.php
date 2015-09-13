<?php
$bDevelopment   = isset( $_SERVER['CUSTOM_ENVIRONMENT'] ) && ( $_SERVER['CUSTOM_ENVIRONMENT'] == 'dev' ) || isset($_GET['debug_s1im']);
if ( $bDevelopment ) {
    error_reporting(E_ALL ^ E_DEPRECATED);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

session_start();
ob_start();
setlocale(LC_ALL ,"ru_RU.UTF-8");

require_once dirname(__FILE__).'/lib/config.php';

$sErrors    = ob_get_contents();
ob_end_clean();
