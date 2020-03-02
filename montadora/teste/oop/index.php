<?php
session_start();

header('Content-Type: text/html; charset=utf-8');

require_once 'Bootstrap.php';
define('RAIZ_PATH', '');
define('APP_ROOT', 'http'.(isset($_SERVER['HTTPS']) ? (($_SERVER['HTTPS']=="on") ? "s" : "") : "").'://' . $_SERVER['HTTP_HOST'] . '/'. RAIZ_PATH . '');

use coreSystem;

$System = new System();
$System->run();