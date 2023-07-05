<?php
$method = [];
if (!empty($_GET)) $method = $_GET;
if (!empty($_POST)) $method = $_POST;

if (isset($method['meth']) && $method['meth'] == 'js') {
	require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
}
$domain = 'site';
$action = 'index';

if (isset($method['domain'])) {
	$domain = $method['domain'];
}
if (isset($method['action'])) {
	$action = $method['action'];
}
if (substr($action, 0, 6) == 'cargue' || substr($action, 0, 6) == 'cargar') {
	$method['FILES'] = $_FILES;
}
date_default_timezone_set('America/Bogota');
require_once PATH_CLASS . DS . '_conexion.php';
//require_once PATH_MODELS.DS.'site.php';
//require_once PATH_MODELS.DS.'festivos.php';

require_once PATH_CONTROLLERS . DS . 'Controller' . $domain . '.php';
call_user_func($action . 'Action', $method);
