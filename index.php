<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 1);

require_once 'lib/SSCE/application.class.php';
$oApplication   = new SSCE_Application('lib/config.json');
