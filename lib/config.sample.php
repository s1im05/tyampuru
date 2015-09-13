<?php
if (!defined("PATH_SEPARATOR"))
    define("PATH_SEPARATOR", getenv("COMSPEC")? ";" : ":");
ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.dirname(__FILE__));

define("DB_HOST",'localhost');
define("DB_USER",'root');
define("DB_PASS",'');
define("DB_NAME",'db');
define("DB_PREF",'db__');
define("__SALT__",'#%b4Y$%B45bbhgh7^m,LA#V45b9y4n');

define('CORE_ROOT_PATH', realpath( dirname(__FILE__).'/..' ) );
define('CORE_VERSION', '0.0.1' );

define('TEMPLATE_PATH', CORE_ROOT_PATH.'/templates' );

define('IMAGE_DEFAULT_WIDTH', 800 );
define('IMAGE_DEFAULT_THUMB_WIDTH', 200 );
define('IMAGE_DEFAULT_THUMB_HEIGHT', 120 );

mb_internal_encoding('UTF-8');

require_once dirname(__FILE__).'/DbSimple/Generic.php';

$oDB    = DbSimple_Generic::connect("mysql://".DB_USER.":".DB_PASS."@".DB_HOST."/".DB_NAME);
$oDB->setErrorHandler('databaseErrorHandler');
$oDB->setIdentPrefix(DB_PREF);
$oDB->query("SET NAMES utf8;");

function databaseErrorHandler($message, $info) {
    if ( !error_reporting() ) return;
    echo "SQL Error: $message<br><pre>"; 
    print_r($info);
    echo "</pre>";
    exit();
}

if ( in_array( strtolower( ini_get( 'magic_quotes_gpc' ) ), array( '1', 'on' ) ) ) {
    $_POST      = array_map( 'stripslashes', $_POST );
    $_GET       = array_map( 'stripslashes', $_GET );
    $_COOKIE    = array_map( 'stripslashes', $_COOKIE );
}