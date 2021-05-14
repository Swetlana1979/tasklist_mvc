<?php
include_once('m/сonnect.php');

function my_autoloader($classname){
	$s = substr($classname,0,1);
	$s = ($s=='C')?'c/':'m/';
	$path = $s.$classname.".php";
	include_once($path);
}
spl_autoload_register('my_autoloader');

$action='action_';
$action.=(isset($_GET['act']))?$_GET['act']:'index';
$cName = isset($_GET['c'])?('C_'.$_GET['c']):('C_Task');
$controller = new $cName();
$controller->request($action);
?>
