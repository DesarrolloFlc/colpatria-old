<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
header("Content-Type: text/html;charset=utf-8");
require "includes.php";
require_once PATH_CLASS.DS.'_conexion.php';
require_once PATH_CCLASS.DS.'radicados.class.php';

dataRadicadosColpatria();
function dataRadicadosColpatria(){
	$conn = new Conexion();
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Description: File Transfer");
	header("Content-Encoding: UTF-8");
	header("Content-Type: text/csv; charset=UTF-8");
	header("Expires: 0");
	header("Pragma: public");
	echo "\xEF\xBB\xBF"; // UTF-8 BOM

	$header = array('# RADICADO', 'TIPO', 'SUCURSAL', 'OFICIAL', 'NIT/CEDULA', 'NOMBRE/RAZON SOCIAL', 'FECHA RADICACION', 'FECHA ENVIO', 'FECHA RECIBIDO', 'ESTADO');
	$fh = fopen(PATH_SARLAFT.DS.'finleco_radicados_hasta_'.date('Ymd').'.txt', 'a');
	fputcsv($fh, $header, "\t");

	if($data = Radicados::clientesDelOficialSucursal(date('Y-m-d', strtotime("-6 days")), date('Y-m-d'), 'T')){
		foreach ($data as $objeto) {
			$objeto['estado'] = getEstados($objeto['estado']);
			$objeto['tipo'] = getTipo($objeto['tipo']);
			fputcsv($fh, $objeto, "\t");
		}
	}
}
function getEstados($id) {
	switch ($id) {
		case '0':
			return 'Radicado';
			break;
		case '1':
			return 'No enviado';
			break;
		case '2':
			return 'Recibido';
			break;
		case '3':
			return 'Devuelto';
			break;
		case '4':
			return 'Cancelado';
			break;
	}
}
function getTipo($id) {
	if ($id == 0 || $id == 2)
		return 'Fisico';
	elseif($id == 3)
		return 'Financial virtual';
	else
		return 'Virtual';
}
?>