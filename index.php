<?php
//phpinfo();
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
define('ROOT',dirname(__FILE__));
require_once(ROOT.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'Autoload.php');
$route = new Router();
$route->run();
?>