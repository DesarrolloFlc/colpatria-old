<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'client.class.php';

$action = $_POST['action'];
call_user_func($action, $_POST);

function buscarCliente($request){
	print_r($request);
	$documento = $request['documento'];
	if($clientes = Client::getClientes($documento)){

	}else
		echo json_encode(array('errorr' => 'No se encontraron clientes con este documento'));
}
?>