<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'contact.class.php';
require_once PATH_CCLASS . DS . 'recorde.class.php';
require_once PATH_CCLASS . DS . 'alert.class.php';

extract($_POST);
if ($id_client === "" || $persontype === "") {
	echo "Los parametros de envío son insuficientes, id_client: ".$id_client.", persontype: ".$persontype;
	exit;
}
$contacto = new Contact();

$fechaexpedicion = $fechaexpedicion_a . "-" . $fechaexpedicion_m . "-" . $fechaexpedicion_d;
if (!isset($estadocivil) || $estadocivil == '') $estadocivil = '0';
if (!isset($nivelestudios) || $nivelestudios == '') $nivelestudios = '0';
if (!isset($profesion) || $profesion == '') $profesion = '0';
if (!isset($ingresosmensuales) || $ingresosmensuales == '') $ingresosmensuales = '0';
if (!isset($egresosmensuales) || $egresosmensuales == '') $egresosmensuales = '0';
if (!isset($digitochequeo) || $digitochequeo == '') $digitochequeo = '0';
if (!isset($actividadeconomicappal) || $actividadeconomicappal == '') $actividadeconomicappal = '0';
if (!isset($ingresosmensualesemp) || $ingresosmensualesemp == '') $ingresosmensualesemp = '0';
if (!isset($egresosmensualesemp) || $egresosmensualesemp == '') $egresosmensualesemp = '0';

if ($persontype == "1") {
	$fechaexpedicion = $fechaexpedicion_a . "-" . $fechaexpedicion_m . "-" . $fechaexpedicion_d;
	$contacto->addConfirmNatural($id_client, $id_form, $_SESSION['id'], trim($documento), trim($primerapellido), trim($segundoapellido), trim($nombres), $fechaexpedicion, $lugarexpedicion, $numerohijos, $estadocivil, $nivelestudios, $profesion, trim($direccionresidencia), $ciudadresidencia, trim($telefonoresidencia), trim($celular), trim($correoelectronico), $ingresosmensuales, $egresosmensuales, $contact, trim($observacion), $persontype);
	$lastid = $contacto->lastId();
	if($lastid <= 0){
		echo "err";
		exit;
	}
	if (!in_array($contact, ["1", "2", "3", "4", "6", "7", "9", "11", "13"])) exit;

	if($contact == "1"){
		if(!empty(trim($confirmdata))){
			$fh = fopen('log_actualizaciones.log',"a");
			fputcsv($fh, array($id_form, trim($confirmdata), date('Y-m-d H:i:s')), '|');
			fclose($fh);
		}
		$contacto->addConfirmDataClient(trim($confirmdata), $id_form, $fechaexpedicion);
	}
	$record = new Recorde();
	echo $record->add($lastid, $_FILES['grabacion']['tmp_name'], $_FILES['grabacion']['name'])
		? "todo ok" : "<br>PIAL";
	/*
	//alertas
	$u = new EmailAlert();
	$u->generateAlert($id_client, $contact, $alertingresos, "");
	$u->alertDirecciones(array("id" => $id_client, "documento" => $documento, "tipo" => $persontype), array("direccion_residencia" => $direccionresidencia, "direccion_oficina" => "", "direccion_empresa" => "", "direccion_sucursal" => ""));
	$u->alertTelefonos(array("id" => $id_client, "documento" => $documento, "tipo" => $persontype), array("telefono_residencia" => $telefonoresidencia, "telefono_laboral" => 0, "telefono_oficina" => 0, "telefono_sucursal" => 0));
	$u->alertNombres(array("id" => $id_client, "documento" => $documento, "nombre" => $nombres, "papellido" => $primerapellido, "sapellido" => $segundoapellido, "razonsocial" => ""), "confirmacion");
	*/
}else if ($persontype == "2") {
	$contacto->addConfirmJuridic($id_client, $id_form, $_SESSION['id'], $persontype, trim($nit), trim($razonsocial), trim($digitochequeo), $ciudadoficina, trim($direccionoficinappal), trim($telefonoficina), $actividadeconomicappal, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, trim($correoelectronico), $contact, trim($observacion));
	$lastid = $contacto->lastId();
	if($lastid <= 0){
		echo "err";
		exit;
	}
	if (!in_array($contact, ["1", "2", "3", "4", "6", "7", "9", "11", "13"])) exit;

	if($contact == "1"){
		$contacto->addConfirmDataClient(trim($confirmdata), $id_form, $fechaexpedicion);
	}
	$record = new Recorde();
	echo $record->add($lastid, $_FILES['grabacion']['tmp_name'], $_FILES['grabacion']['name'])
		? "todo ok" : "<br>PIAL";
	/*
	$u = new EmailAlert();
	$u->generateAlert($id_client, $contact, $alertingresos, "");
	$u->alertDirecciones(array("id" => $id_client, "documento" => $nit, "tipo" => $persontype),  array("direccion_residencia" => "", "direccion_oficina" => $direccionoficinappal, "direccion_empresa" => "", "direccion_sucursal" => ""));
	$u->alertTelefonos(array("id" => $id_client, "documento" => $nit, "tipo" => $persontype), array("telefono_residencia" => 0, "telefono_laboral" => 0, "telefono_oficina" => $telefonoficina, "telefono_sucursal" => 0));
	$u->alertNombres(array("id" => $id_client, "documento" => $nit, "nombre" => "", "papellido" => "", "sapellido" => "", "razonsocial" => $razonsocial));
	*/
}
