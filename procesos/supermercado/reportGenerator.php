<?php
session_start();
require_once '../../includes.php';
require_once PATH_CLASS.DS.'PHPExcel.php';
require_once PATH_CLASS.DS.'conexion.php';
$action = $_POST['action'];
call_user_func($action, $_POST);
function consolidadoClientesSup($request){
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Description: File Transfer");
	header("Content-Encoding: UTF-8");
	header("Content-Type: text/csv; charset=UTF-8");
	header("Content-Disposition: attachment; filename=reportConsolidadoClientes".date('his').".csv");
	header("Expires: 0");
	header("Pragma: public");
	echo "\xEF\xBB\xBF"; // UTF-8 BOM

	$fh = fopen( 'php://output', 'w' );
	fputcsv($fh, array('TIPO PERSONA','DOCUMENTO','NOMBRE / RAZON SOCIAL','ESTADO EN MIGRACION','EN FORMULARIO','FECHA DE CREACION'), ';');

	$fecha_inicio = $request['fecha_inicio'];
	$fecha_fin = $request['fecha_fin'];

	$conexion = new Conexion();
	$objetos = array();
	$SQL = "SELECT 
			 IF(t1.persontype = '1', 'Natural', 'Juridico'), t1.document, t1.firstname, 
			 IF(t1.status_migracion = 'Activo', 'Migracion', ''), 
			 IF(t1.status_form = 'Activo', '', ''), t1.date_created
			FROM
			 sup_client AS t1
			WHERE t1.estado_dev = 0
			 AND (t1.status_migracion != '' AND t1.status_form != '')
			 AND t1.date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'";
	$conexion->consultar($SQL);
	if($conexion->getNumeroRegistros() > 0){
		$conexion1 = new Conexion();
		while ($consulta = $conexion->sacarRegistro('num')){
			/*$table .= trim($consulta[0]).";".trim($consulta[1]).";".trim($consulta[2]).";".trim($consulta[3]).";".trim($consulta[4]).";".trim($consulta[5]).PHP_EOL;*/
			//$objetos[] = $consulta;
			fputcsv($fh, $consulta,';');
		}
	}
	/*foreach ($registros['items'] as $cliente) {
		fputcsv($fh, $cliente,';');
	}*/
	// Close the file
	fclose($fh);
	// Make sure nothing else is sent, our file is done
	exit;
}
?>