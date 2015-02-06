<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
$url;
if(isset($_GET['url']) )
	$url = $_GET['url'] ;
$err = "0";
require_once(ROOT.DS.'library'.DS.'bootstrap.php');