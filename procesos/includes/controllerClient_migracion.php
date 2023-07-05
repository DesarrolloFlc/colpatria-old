<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'workflowmg.class.php';
$action = $_POST['action'];
call_user_func($action, $_POST);

function clienteMigracionDesactivar($request){
	$work = new Workflowmg();
	$work->setAtributos($request);
	if($work->registrar()){
		$err = '';
		if(!$work->desactivarClientMG())
			$err .= ' pero no se desactivo el cliente';
		if(!$work->desactivarImageMG())
			$err .= ' pero no se desactivaron las imagenes';
		echo json_encode(array('exito' => 'Se registro la devolucion de cliente en migracion'.$err));
	}else
		echo json_encode(array('errorr' => 'Ocurrio un error al momento de insertar la devolucion'));
}
function closeVentana($request){
	$work = new Workflowmg();
	$work->setId_client($request['id_client']);
	if($work->activarClientMG())
		echo json_encode(array('exito' => 'Se activo el cliente en migracion'));
	else
		echo json_encode(array('errorr' => 'Ocurrio un error al momento de activar el cliente...'));
}
?>