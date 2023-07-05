<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(0);
//ini_set("memory_limit","800M");
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CLASS . DS . 'PHPExcel.php';
require_once PATH_CLASS . DS . 'conexion.php';
$action = $_POST['action'];
call_user_func($action, $_POST);
//generarReporte();
/*header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportConsolidadoClientes.xls");
header("Pragma: no-cache");
header("Expires: 0");*/
//require_once $_SERVER['DOCUMENT_ROOT'] . '/Colpatria/config/globalParameters.php';
function reporteConsolidado($request)
{
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Description: File Transfer");
    header("Content-Encoding: UTF-8");
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=reportConsolidadoClientes".date('his').".csv");
    header("Expires: 0");
    header("Pragma: public");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $fh = fopen( 'php://output', 'w' );
    $header = ['TIPO PERSONA','DOCUMENTO','NOMBRE / RAZON SOCIAL','ESTADO EN MIGRACION','EN FORMULARIO','FECHA DE CREACION', 'ULTIMO MOVIMIENTO'];
    fputcsv($fh, $header, ';');
	
	$fecha_inicio = $request['fecha_inicio'];
	$fecha_fin = $request['fecha_fin'];
	$complemento = '';
	if(isset($fecha_inicio) && $fecha_inicio != "" && isset($fecha_fin) && $fecha_fin != ""){
		$complemento .= "AND t2.date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'";
	}
	$conn = new Conexion();
	$SQL = "SELECT t2.id, 
				   t2.document, 
				   t1.documento, 
				   t2.persontype, 
				   t1.persontype 
			  FROM workflow AS t1 
			  LEFT OUTER JOIN client AS t2 ON(t1.documento = t2.document AND t1.persontype = t2.persontype) 
			 WHERE t1.estado = 0 
			   AND t1.persontype > 0
			   AND t2.id IS NOT NULL 
			   $complemento";
	$conn->consultar($SQL);
	if($conn->getNumeroRegistros() > 0){
		while ($row = $conn->sacarRegistro()){
			$SQLU = "UPDATE client SET estado_dev = 1 WHERE id = {$row[0]}";
			$conn->ejecutar($SQLU);
		}
	}
    $SQL = "SELECT IF(t1.persontype = '1', 'Natural', 'Juridico'), 
				   t1.document, t1.firstname, 
				   IF(t1.status_migracion = 'Activo', 'Migracion', ''), 
				   IF(t1.status_form = 'Activo', 'Formulario', ''), 
				   t1.date_created, 
				   MAX(t2.date_created) AS fecha_conf_capi, 
				   MAX(t3.date_created) AS fecha_conf, 
				   MAX(t5.fechasolicitud) AS fecha_data, 
				   MAX(t1.fecha_datacredito) AS fecha_datacredito
			  FROM client AS t1
			  LEFT JOIN data_capi_confirm AS t2 ON(t2.id_client = t1.id)
			  LEFT JOIN data_confirm AS t3 ON(t3.id_client = t1.id)
			  LEFT JOIN form AS t4 ON(t4.id_client = t1.id)
			  LEFT JOIN data AS t5 ON(t5.id_form = t4.id)
			 WHERE t1.estado_dev = 0
			   AND t1.estado = 0
			   AND (t1.status_migracion != '' AND t1.status_form != '')
			   AND t1.date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'
			 GROUP BY t1.id";
	$conn->consultar($SQL);
	if($conn->getNumeroRegistros() > 0){
		while ($row = $conn->sacarRegistro()){
			$fecha = false;
			if (($row['fecha_conf_capi'] > $row['fecha_conf']) && ($row['fecha_conf_capi'] > $row['fecha_data']) && ($row['fecha_conf_capi'] > $row['fecha_datacredito']))
				$fecha = $row['fecha_conf_capi'];
			else if (($row['fecha_conf'] > $row['fecha_conf_capi']) && ($row['fecha_conf'] > $row['fecha_data']) && ($row['fecha_conf'] > $row['fecha_datacredito']))
				$fecha = $row['fecha_conf'];
			else if (($row['fecha_data'] > $row['fecha_conf_capi']) && ($row['fecha_data'] > $row['fecha_conf']) && ($row['fecha_data'] > $row['fecha_datacredito']))
				$fecha = $row['fecha_data'];
			else if (($row['fecha_datacredito'] > $row['fecha_conf_capi']) && ($row['fecha_datacredito'] > $row['fecha_conf']) && ($row['fecha_datacredito'] > $row['fecha_data']))
				$fecha = $row['fecha_datacredito'];

			$fec_now = date('Y-m-d');
			$fec_365 = date('Y-m-d', strtotime($fecha . ' +365 days'));

			$fec_mov = $fec_365 > $fec_now ? $fec_365 : $fec_now;

			fputcsv($fh, [$row[0],$row[1],$row[2],$row[3],$row[4],$row[5], (($fecha === false) ? 'Desactualizado' : 'Vigente hasta: ' . $fec_mov)], ';');
		}
	}
	$SQLUF = "UPDATE client SET estado_dev = 0 WHERE 1";
	$conn->ejecutar($SQLUF);
    fclose($fh);
    exit;
}
/*function reporteConsolidado($request){
	$fecha_inicio = $request['fecha_inicio'];
	$fecha_fin = $request['fecha_fin'];
	$complemento = 'WHERE ';
	if(isset($fecha_inicio) && $fecha_inicio != "" && isset($fecha_fin) && $fecha_fin != ""){
		$complemento .= "date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'";
	}
	$conexion = new Conexion();
	$objetos = [];
	$SQL = "SELECT COUNT(*)
			FROM client 
			$complemento";
	//echo $SQL;
	$conexion->consultar($SQL);
	//echo $conexion->getNumeroRegistros()."<br>";
	if($conexion->getNumeroRegistros() > 0){
		$consulta = $conexion->sacarRegistro();
		$cantidad = $consulta[0];
	}
	/*echo $cantidad;
	exit();
	if($cantidad > 1000){
		$numini = 0;
		$numlength = 1000;
		$lastnum = 0;
		$objetos = [];
		while ($numini <= $cantidad) {
			$SQL = "SELECT 
					 IF(t1.persontype = '1', 'Natural', 'Juridico'), t1.document, t1.firstname, 
					 IF(t1.status_migracion = 'Activo', 'Migración', ''), 
					 IF(t1.status_form = 'Activo', 'Formulario', ''), t1.date_created
					FROM
					 client AS t1 LEFT OUTER JOIN workflow AS t2 ON (t1.document = t2.documento AND t1.firstname = t2.nombre)
					WHERE (t1.status_migracion != '' AND t1.status_form != '')
					 AND t1.date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'
					 AND t2.id IS NULL
					 LIMIT $numini, $numlength";			
			$conexion->consultar($SQL);
			while ($consulta = $conexion->sacarRegistro()) {
				$objetos[] = $consulta;
			}
			$numini = $numini + $numlength;
		}
	}else{
		$objetos = [];
		$SQL = "SELECT 
				 IF(t1.persontype = '1', 'Natural', 'Juridico'), t1.document, t1.firstname, 
				 IF(t1.status_migracion = 'Activo', 'Migración', ''), 
				 IF(t1.status_form = 'Activo', 'Formulario', ''), t1.date_created
				FROM
				 client AS t1 LEFT OUTER JOIN workflow AS t2 ON (t1.document = t2.documento AND t1.firstname = t2.nombre)
				WHERE (t1.status_migracion != '' AND t1.status_form != '')
				 AND t1.date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'
				 AND t2.id IS NULL";		
		$conexion->consultar($SQL);
		while ($consulta = $conexion->sacarRegistro()) {
			$objetos[] = $consulta;
		}
	}
	/*echo $numini;
	exit();
	$col_campos = array('TIPO PERSONA', 'DOCUMENTO', 'NOMBRE / RAZON SOCIAL', 'ESTADO EN MIGRACION', 'EN FORMULARIO', 'FECHA DE CREACION');
	$col_name = array('A','B','C','D','E','F');

	$array = [];
	$array[] = array(0 => $objetos, 1 => $col_campos, 2 => $col_name, 3 => 'reportConsolidadoClientes', 4 => 'Reporte_ConsolidadoClientes'.$fecha_inicio.'_'.$fecha_fin);
	//print_r($array);
	crearXls($array);
}
function reporteConsolidadoEstados_($request){
	$fecha_inicio = $request['fecha_inicio'];
	$fecha_fin = $request['fecha_fin'];
	$complemento = 'WHERE ';
	if(isset($fecha_inicio) && $fecha_inicio != "" && isset($fecha_fin) && $fecha_fin != ""){
		$complemento .= "date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'";
	}
	$conexion = new Conexion();
	$objetos = [];
	$SQL = "SELECT COUNT(*)
			FROM client 
			$complemento";
	$conexion->consultar($SQL);
	if($conexion->getNumeroRegistros() > 0){
		$consulta = $conexion->sacarRegistro('num');
		$cantidad = $consulta[0];
	}
	if($cantidad > 1000){
		$numini = 0;
		$numlength = 1000;
		$lastnum = 0;
		$objetos = [];
		while ($numini <= $cantidad) {
			$SQL = "SELECT t2.date_created, t2.log_planilla, t2.log_lote, 
						IF(t4.id IS NULL, '0000-00-00', t4.date_created),
						t6.log_planilla, IF(t4.id IS NULL, '', t4.lote), 
						t5.sucursal, t3.document, t3.firstname, 
						IF(t4.id IS NULL, 'Digitado', 'En Devolucion')
					FROM data AS t1 
						INNER JOIN form AS t2 ON(t1.id_form = t2.id) 
						INNER JOIN client AS t3 ON(t2.id_client = t3.id)
						LEFT OUTER JOIN workflow AS t4 ON(t3.document = t4.documento)
						INNER JOIN param_sucursales AS t5 ON(t1.sucursal = t5.id)
						LEFT OUTER JOIN 
						(
						SELECT log_lote, log_planilla FROM form GROUP BY log_lote
						) AS t6 ON(t4.lote = t6.log_lote)
					WHERE t2.date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'
					LIMIT $numini, $numlength";
			$conexion->consultar($SQL);
			while ($consulta = $conexion->sacarRegistro('num'))
				$objetos[] = $consulta;
			$numini = $numini + $numlength;
		}
	}else{
		$objetos = [];
		$SQL = "SELECT t2.date_created, t2.log_planilla, t2.log_lote, 
						IF(t4.id IS NULL, '0000-00-00', t4.date_created),
						t6.log_planilla, IF(t4.id IS NULL, '', t4.lote), 
						t5.sucursal, t3.document, t3.firstname, 
						IF(t4.id IS NULL, 'Digitado', 'En Devolucion')
				FROM data AS t1 
				INNER JOIN form AS t2 ON(t1.id_form = t2.id) 
				INNER JOIN client AS t3 ON(t2.id_client = t3.id)
				LEFT OUTER JOIN workflow AS t4 ON(t3.document = t4.documento)
				INNER JOIN param_sucursales AS t5 ON(t1.sucursal = t5.id)
				LEFT OUTER JOIN 
				(
				SELECT log_lote, log_planilla FROM form GROUP BY log_lote
				) AS t6 ON(t4.lote = t6.log_lote)
				WHERE t2.date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'";
		$conexion->consultar($SQL);
		while ($consulta = $conexion->sacarRegistro('num'))
			$objetos[] = $consulta;
	}
	$conexion->liberar();
	$col_campos = array('FECHA DE DIGITACION', 'PLANILLA', 'LOTE', 'FECHA DE DEVOLUCION', 'PLANILLA DE DEVOLUCION', 'LOTE DE DEVOLUCION','SUCURSAL', 'DOCUMENTO','NOMBRE / RAZON SOCIAL', 'ESTADO EN DEVOLUCION');
	$col_name = array('A','B','C','D','E','F','G','H','I','J');

	$array = [];
	$array[] = array(0 => $objetos, 1 => $col_campos, 2 => $col_name, 3 => 'reporteClientesEstadoDevolucion', 4 => 'Reporte_ConsolidadoClientesConEstadoenDevolucion'.$fecha_inicio.'_'.$fecha_fin);
	//echo json_encode($array);
	unset($objetos);
	unset($col_campos);
	unset($col_name);
	crearXls($array);
}*/
function reporteConsolidadoEstados($request)
{
	$table = ["FECHA DE DIGITACION","PLANILLA","LOTE","FECHA DE DEVOLUCION","PLANILLA DE DEVOLUCION","LOTE DE DEVOLUCION","SUCURSAL","DOCUMENTO","NOMBRE / RAZON SOCIAL","ESTADO EN DEVOLUCION"];
	$fecha_inicio = $request['fecha_inicio'];
	$fecha_fin = $request['fecha_fin'];
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Description: File Transfer");
	header("Content-Encoding: UTF-8");
	header("Content-Type: text/csv; charset=UTF-8");
	header("Content-Disposition: attachment; filename=Reporte_ConsolidadoClientesConEstadoenDevolucion".$fecha_inicio."_".$fecha_fin."_".date('his').".csv");
	header("Expires: 0");
	header("Pragma: public");
	echo "\xEF\xBB\xBF"; // UTF-8 BOM

	$fh = fopen( 'php://output', 'w' );
	fputcsv($fh, $table, ';');
	$conn = new Conexion();
	$SQL = "SELECT t0.date_created, t0.log_planilla, t0.log_lote, IF(t5.id_work IS NULL, '0000-00-00', t5.date_created),
  				t6.log_planilla, IF(t5.id_work IS NULL, '', t5.lote), t4.sucursal, t0.document, t0.firstname,
  				IF(t5.id_work IS NULL, 'Digitado', 'En Devolucion')
			FROM
			(
				SELECT t1.id AS id_form, t1.date_created, t1.log_planilla, t1.log_lote, 
          			t2.id AS id_client, t2.document, t2.persontype, t2.firstname
  				FROM form AS t1
  				INNER JOIN client AS t2 ON(t1.id_client = t2.id)  
  				WHERE t1.status = 1
  				AND t2.estado = 0
  				AND t1.date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59'
			)AS t0
			INNER JOIN data AS t3 ON(t0.id_form = t3.id_form)
			INNER JOIN param_sucursales AS t4 ON(t3.sucursal = t4.id)
			LEFT OUTER JOIN 
			(
				SELECT id AS id_work, date_created, persontype, documento, lote 
				FROM workflow WHERE persontype > 0
			)
			AS t5 ON(t0.document = t5.documento AND t0.persontype = t5.persontype)
			LEFT OUTER JOIN
			(
  				SELECT log_lote, log_planilla FROM form GROUP BY log_lote
			) AS t6 ON(t5.lote = t6.log_lote)";
	$conn->consultar($SQL);
	while ($row = $conn->sacarRegistro('num')) {
		fputcsv($fh, array(trim($row[0]),trim($row[1]),trim($row[2]),trim($row[3]),trim($row[4]),trim($row[5]),trim($row[6]),trim($row[7]),trim($row[8]),trim($row[9])), ';');
	}
	fclose($fh);
	exit;
}
function reporteCalidad($request)
{
	$fecha_inicio = $request['fecha_inicio'];
	$fecha_fin = $request['fecha_fin'];
	$conexion = new Conexion();
	$objetos = [];
	$SQL = "SELECT t2.sucursal, t1.sucursal, COUNT(*)
			  FROM (SELECT data.*, 
						   form.date_created 
					  FROM data 
					 INNER JOIN form ON(data.id_form = form.id) 
					 WHERE (form.date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59')
				   ) AS t1
			 INNER JOIN param_sucursales AS t2 ON(t1.sucursal = t2.id)
			 GROUP BY t1.sucursal";
	$conexion->consultar($SQL);
	while ($consulta = $conexion->sacarRegistro()) {
		$conexion2 = new Conexion();
		$sucursal = $consulta[0];
		$sucursalid = $consulta[1];
		$SQL2 = "SELECT COUNT(*)
				   FROM workflow
				  WHERE id_sucursal = $sucursalid
				    AND (date_created BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_fin 23:59:59')";
		$conexion2->consultar($SQL2);
		$consulta2 = $conexion2->sacarRegistro();
		$devoluciones = $consulta2[0];		
		$totalenviados = $consulta[2] + $devoluciones;
		$objeto = [];
		$objeto[0] = $sucursal;
		$objeto[1] = $totalenviados;
		$objeto[2] = $consulta[2];
		$objeto[3] = $devoluciones;
		$objeto[4] = round(($devoluciones * 100) / $totalenviados)." %";
		$objetos[] = $objeto;
	}
	$col_campos = array('SUCURSAL', 'ENVIADOS', 'DIGITADOS', 'DEVUELTOS', 'PORCENTAJE');
	$col_name = array('A','B','C','D','E');

	$array = [];
	$array[] = array(0 => $objetos, 1 => $col_campos, 2 => $col_name, 3 => 'reporteCalidadSucursales', 4 => 'Reporte_CalidadPorSucursales'.$fecha_inicio.'_'.$fecha_fin);
	crearXls($array);
}
function crearXls($arrays)
{
	$nombre_doc = '';
	$col = 1;
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("FinlecoBPO");
	$objPHPExcel->getProperties()->setLastModifiedBy("FinlecoBPO");
	$objPHPExcel->getProperties()->setTitle("Reporte Listado de Clientes");
	$objPHPExcel->getProperties()->setSubject("Reporte Listado de Clientes");
	$objPHPExcel->getProperties()->setDescription("Reporte Listado de Clientes, generated using PHP classes.");
	$styleArray1 = array(
		'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array('rgb'=>'EB8F00'),
		)
	);
	$hoja_activa = 0;
	$tam_obj = count($arrays);
	for ($n = 0; $n < $tam_obj; $n++) {
		$array = $arrays[$n];
		unset($arrays[$n]);
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($hoja_activa);

		$col_name_can = count($array[2]);
		$col_name = $array[2];
		unset($array[2]);
		$col_campos = $array[1];
		unset($array[1]);
		$objetos = $array[0];
		unset($array[0]);
		$titulo = $array[3];
		unset($array[3]);
		$nombre_doc = $array[4];
		for ($i = 0; $i < $col_name_can; $i++) {
			$objPHPExcel->getActiveSheet()->SetCellValue($col_name[$i].$col, $col_campos[$i]);
			$objPHPExcel->getActiveSheet()->getStyle($col_name[$i].$col)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle($col_name[$i].$col)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle($col_name[$i].$col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);		
			$objPHPExcel->getActiveSheet()->getStyle($col_name[$i].$col)->applyFromArray($styleArray1);
			$objPHPExcel->getActiveSheet()->getColumnDimension($col_name[$i])->setAutoSize(true);
		}
		unset($col_campos);
		$col++;
		foreach ($objetos as $objeto) {
			for ($j=0; $j < $col_name_can; $j++) {
				$objPHPExcel->getActiveSheet()->SetCellValue($col_name[$j].$col, htmlentities($objeto[$j]));
			}
			$col++;
			unset($objeto);
		}
		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_DOTTED
				)
			)
		);
		$objPHPExcel->getActiveSheet()->getStyle($col_name[0].'1:'.$col_name[($col_name_can - 1)].($col - 1))->applyFromArray($styleArray);

		$objPHPExcel->getActiveSheet()->setTitle($titulo);
		$hoja_activa++;
		$col = 1;
	}
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename='.$nombre_doc.'.xlsx');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit();
}
