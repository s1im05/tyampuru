<?php
error_reporting(0);
require_once '../lib/SSCE/base.class.php';
$oApplication   = new SSCE\Application('../lib/config_admin.json');

$oApplication->bootstrap('run_admin')->action();