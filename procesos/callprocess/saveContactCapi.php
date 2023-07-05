<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'contactcapi.class.php';
require_once PATH_CCLASS . DS . 'recordecapi.class.php';

$metn = $_POST;
extract($_POST);

if (!isset($nacionalidad_cual)) $nacionalidad_cual = '';
if (!isset($obligaciones_paises)) $obligaciones_paises = '';

if (isset($id_client) && $id_client != "" && $id_contact != "" && $persontype == "1") {
	$contacto = new Contactcapi();

    $fechanacimiento = $fechanacimiento_a . "-" . $fechanacimiento_m . "-" . $fechanacimiento_d;

	$contacto->addConfirm($id_client, $id_contact, $_SESSION['id'], $documento, $primerapellido, $segundoapellido, $nombres, $fechanacimiento, $id_profesion, str_replace("'", "''", $empresa), $id_ingresos, $id_egresos, $activos, $pasivos, $direccionlaboral, $id_ciudad, $direccionresidencia, $celular, $correoelectronico, $telefonoresidencia, $numerohijos, $estadocivil, $nivelestudios, $observacion, $respuesta_libre, $nacionalidad, $nacionalidad_otra, $nacionalidad_cual, $pais_residencia, $obligaciones_otras, $obligaciones_paises);

	$lastid = $contacto->lastId();
	if ($lastid  <= 0) {
		echo "err";
		exit;
	}
	if (!in_array($id_contact, ["1", "2", "3", "4", "6", "7", "9", "11", "13"])) exit;

	$recordcapi = new Recordecapi();
	echo $recordcapi->add($lastid, $_FILES['grabacion']['tmp_name'], $_FILES['grabacion']['name'])
		? "todo ok" : "<br>PIAL";
	
} else if (isset($id_client) && $id_client != "" && $id_contact != "" && $persontype == "2") {
	$contacto = new Contactcapi();

	$contacto->addConfirmJuridico($id_client, $id_contact, $_SESSION['id'], $razonsocial, $nit, $digitochequeo, $ciudadoficina, $direccionoficinappal, $telefonoficina, $actividadeconomicappal, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $correoelectronico, $observacion, $respuesta_libre, $nacionalidad, $nacionalidad_otra, $nacionalidad_cual, $pais_residencia, $obligaciones_otras, $obligaciones_paises);

	$lastid = $contacto->lastId();
	if ($lastid <= 0) {
		echo "err";
		exit;
	}
	if (!in_array($id_contact, ["1", "2", "3", "4", "6", "7", "9", "11", "13"])) exit;

	$recordcapi = new Recordecapi();
	echo $recordcapi->add($lastid, $_FILES['grabacion']['tmp_name'], $_FILES['grabacion']['name'])
		? "todo ok" : "<br>PIAL";

}else{
	print_r($_POST);
	echo "Los parametros de env�o son insuficientes";
}
