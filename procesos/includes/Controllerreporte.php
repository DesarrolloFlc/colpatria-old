<?php
if (!isset($_SESSION)) session_start();

ini_set('memory_limit', '-1');
set_time_limit(0);
header("Content-Type: text/html;charset=utf-8");

require_once PATH_CCLASS . DS . 'reporte.php';
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function reporteGestionDocumentalAction($request){//http://192.168.6.9/Colpatria/procesos/includes/Controller.php?action=reporteGestionDocumental&domain=reporte&meth=js&fecha_ini=2020-09-01&fecha_fin=2020-09-30
	$spreadsheet = new Spreadsheet();
	$spreadsheet->getProperties()
		->setCreator('FinlecoBPO Group')
		->setLastModifiedBy('FinlecoBPO Group')
		->setTitle('Reporte de gestion documental Colpatria')
		->setSubject('Gestion documental Colpatria')
		->setDescription('Reporte que contiene la gestion documental de la unidad Colpatria')
		->setKeywords('Reporte Gestion Documental')
		->setCategory('Reporte de gestion');

	$header = array(
		array('Finleco produccion', 'Fisicos', '% Proceso', 'Digitales', '% Proceso', 'Contingencia virtual', '% Proceso', 'Financial virtual', '% Proceso', 'TOTAL'),
		array('Clientes radicados', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Clientes no ha llegado el radicado', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Clientes aprobados por Finleco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Finleco devueltos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Clientes Cancelados', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Clientes no llegaron los documentos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Total', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array(),
		array('Total de clientes procesados hasta digitalización', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Clientes con documentación complementaria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Clientes con FUCC para digitar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Total de clientes procesados hasta digitación', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array(),
		array('Finleco Gestion telefonica', 'Gestiones telefonicas de seguros', NULL, NULL, '% Proceso', 'Gestiones telefonicas de capi', NULL, '% Proceso', 'TOTAL', NULL),
		array('Total de clientes gestión telefónica', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Gestión telefónica efectiva', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
		array('Total de clientes gestión telefónica confirmados', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
	);

	$styleTittles = array(
		'font' => array(
			'bold' => true,
			'color'=> array('argb' => 'FFFFFF'),
			'size' => 16,
		),
		'alignment' => array(
			'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
		),
		'borders' => array(
			'allBorders' => array(
				'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
				'color' => array('argb' => 'FFFFFF'),
			),
		),
		'fill' => array(
			'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
			'startColor' => array(
				'argb' => '285E9E',
			),
		),
	);
	$styleRelleno = array(
		'font' => array(
			//'bold' => true,
			'color'=> array('argb' => '000000'),/*
			'size' => 16,*/
		),
		'alignment' => array(
			'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
			'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
		),
		'borders' => array(
			'allBorders' => array(
				'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
				'color' => array('argb' => 'FFFFFF'),
			),
		),
		'fill' => array(
			'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
			'startColor' => array(
				'argb' => 'D8E2F3',
			),
		),
	);
	$spreadsheet->setActiveSheetIndex(0)
		->mergeCells('A1:J1')
		->mergeCells('A3:J3')
		->mergeCells('A5:J5')
		->mergeCells('B20:D20')
		->mergeCells('B21:D21')
		->mergeCells('B22:D22')
		->mergeCells('B23:D23')
		->mergeCells('F20:G20')
		->mergeCells('F21:G21')
		->mergeCells('F22:G22')
		->mergeCells('F23:G23')
		->mergeCells('I20:J20')
		->mergeCells('I21:J21')
		->mergeCells('I22:J22')
		->mergeCells('I23:J23')
		->setCellValue('A1', 'REPORTE DE GESTION DOCUMENTAL FINLECO')
		->setCellValue('A3', 'Fecha de generacion desde: '.date('Y-m-d', strtotime($request['fecha_ini'])).' hasta: '.date('Y-m-d', strtotime($request['fecha_fin'])))
		->setCellValue('A5', 'REPORTE DEL PROCESO');

	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(45);
	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
	$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

	$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($styleTittles);
	$styleTittles['font']['size'] = 12;
	$spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($styleTittles);
	$spreadsheet->getActiveSheet()->getStyle('A5')->applyFromArray($styleTittles);
	$spreadsheet->getActiveSheet()->fromArray($header, NULL, 'A6');

	$spreadsheet->getActiveSheet()->getStyle('A6:J6')->getAlignment()
		->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
		->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

	$spreadsheet->getActiveSheet()->getStyle('A20:J20')->getAlignment()
		->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
		->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

	$spreadsheet->getActiveSheet()->getStyle('A6:J6')->getFont()
		->setBold(true);
	$spreadsheet->getActiveSheet()->getStyle('A20:J20')->getFont()
		->setBold(true);
	$spreadsheet->getActiveSheet()->getStyle('A13')->getFont()
		->setBold(true);

	$spreadsheet->getActiveSheet()->getStyle('B6')->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
			->setARGB('89A6D8');

	$spreadsheet->getActiveSheet()->getStyle('D6')->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
			->setARGB('89A6D8');

	$spreadsheet->getActiveSheet()->getStyle('F6')->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
			->setARGB('89A6D8');

	$spreadsheet->getActiveSheet()->getStyle('H6')->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
			->setARGB('89A6D8');

	$spreadsheet->getActiveSheet()->getStyle('J6')->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
			->setARGB('89A6D8');

	$spreadsheet->getActiveSheet()->getStyle('B20')->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
			->setARGB('89A6D8');

	$spreadsheet->getActiveSheet()->getStyle('F20')->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
			->setARGB('89A6D8');

	$spreadsheet->getActiveSheet()->getStyle('I20')->getFill()
		->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		->getStartColor(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
			->setARGB('89A6D8');

	$spreadsheet->getActiveSheet()->getStyle('B7:B13')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('D7:D13')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('F7:F13')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('H7:H13')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('J7:J13')->applyFromArray($styleRelleno);

	$spreadsheet->getActiveSheet()->getStyle('B15:B18')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('D15:D18')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('F15:F18')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('H15:H18')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('J15:J18')->applyFromArray($styleRelleno);

	$spreadsheet->getActiveSheet()->getStyle('B21:B23')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('F21:F23')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->getStyle('I21:I23')->applyFromArray($styleRelleno);
	$spreadsheet->getActiveSheet()->setTitle('DOCUMENTAL');

	foreach(range('B','J') as $columnID)
		foreach(range(7, 13) as $columnNum)
			$spreadsheet->getActiveSheet()->setCellValue($columnID.$columnNum, 0);
	$spreadsheet->getActiveSheet()->setCellValue('C7', '');
	$spreadsheet->getActiveSheet()->setCellValue('E7', '');
	$spreadsheet->getActiveSheet()->setCellValue('G7', '');
	$spreadsheet->getActiveSheet()->setCellValue('I7', '');

	foreach(range('B','J') as $columnID)
		foreach(range(15, 18) as $columnNum)
			$spreadsheet->getActiveSheet()->setCellValue($columnID.$columnNum, 0);
	$spreadsheet->getActiveSheet()->setCellValue('C15', '');
	$spreadsheet->getActiveSheet()->setCellValue('E15', '');
	$spreadsheet->getActiveSheet()->setCellValue('G15', '');
	$spreadsheet->getActiveSheet()->setCellValue('I15', '');

	foreach(range('B','J') as $columnID)
		foreach(range(21, 23) as $columnNum)
			$spreadsheet->getActiveSheet()->setCellValue($columnID.$columnNum, 0);

	if($rads = Reporte::informacionClientesRadicados($request['fecha_ini'], $request['fecha_fin'])){
		if(isset($rads['items']) && is_array($rads['items']) && !empty($rads['items'])){
			foreach($rads['items'] as $item){
				switch ($item['tipo']){
					case '0':
					case '2':
					case '6':
						$spreadsheet->getActiveSheet()->setCellValue('B7', intval($spreadsheet->getActiveSheet()->getCell('B7')->getValue()) + intval($item['cantidad']));
						$spreadsheet->getActiveSheet()->setCellValue('B8', intval($spreadsheet->getActiveSheet()->getCell('B8')->getValue()) + intval($item['no_a_llegado']));
						$spreadsheet->getActiveSheet()->setCellValue('B9', intval($spreadsheet->getActiveSheet()->getCell('B9')->getValue()) + intval($item['recibido']));
						$spreadsheet->getActiveSheet()->setCellValue('B10', intval($spreadsheet->getActiveSheet()->getCell('B10')->getValue()) + intval($item['devuelto']));
						$spreadsheet->getActiveSheet()->setCellValue('B11', intval($spreadsheet->getActiveSheet()->getCell('B11')->getValue()) + intval($item['cancelado']));
						$spreadsheet->getActiveSheet()->setCellValue('B12', intval($spreadsheet->getActiveSheet()->getCell('B12')->getValue()) + intval($item['no_llego']));
						$spreadsheet->getActiveSheet()->setCellValue('B13', '=SUM(B8:B12)');
						if(intval($item['cantidad']) > 0){
							$spreadsheet->getActiveSheet()->setCellValue('C8', round((intval($item['no_a_llegado']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('C9', round((intval($item['recibido']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('C10', round((intval($item['devuelto']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('C11', round((intval($item['cancelado']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('C12', round((intval($item['no_llego']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('C13', '=SUM(C8:C12)');
						}else{
							$spreadsheet->getActiveSheet()->setCellValue('C8', 0);
							$spreadsheet->getActiveSheet()->setCellValue('C9', 0);
							$spreadsheet->getActiveSheet()->setCellValue('C10', 0);
							$spreadsheet->getActiveSheet()->setCellValue('C11', 0);
							$spreadsheet->getActiveSheet()->setCellValue('C12', 0);
							$spreadsheet->getActiveSheet()->setCellValue('C13', 0);
						}
						break;
					case '1':
					case '7':
						$spreadsheet->getActiveSheet()->setCellValue('D7', intval($spreadsheet->getActiveSheet()->getCell('D7')->getValue()) + intval($item['cantidad']));
						$spreadsheet->getActiveSheet()->setCellValue('D8', intval($spreadsheet->getActiveSheet()->getCell('D8')->getValue()) + intval($item['no_a_llegado']));
						$spreadsheet->getActiveSheet()->setCellValue('D9', intval($spreadsheet->getActiveSheet()->getCell('D9')->getValue()) + intval($item['recibido']));
						$spreadsheet->getActiveSheet()->setCellValue('D10', intval($spreadsheet->getActiveSheet()->getCell('D10')->getValue()) + intval($item['devuelto']));
						$spreadsheet->getActiveSheet()->setCellValue('D11', intval($spreadsheet->getActiveSheet()->getCell('D11')->getValue()) + intval($item['cancelado']));
						$spreadsheet->getActiveSheet()->setCellValue('D12', intval($spreadsheet->getActiveSheet()->getCell('D12')->getValue()) + intval($item['no_llego']));
						$spreadsheet->getActiveSheet()->setCellValue('D13', '=SUM(D8:D12)');
						if(intval($item['cantidad']) > 0){
							$spreadsheet->getActiveSheet()->setCellValue('E8', round((intval($item['no_a_llegado']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('E9', round((intval($item['recibido']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('E10', round((intval($item['devuelto']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('E11', round((intval($item['cancelado']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('E12', round((intval($item['no_llego']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('E13', '=SUM(E8:E12)');
						}else{
							$spreadsheet->getActiveSheet()->setCellValue('E8', 0);
							$spreadsheet->getActiveSheet()->setCellValue('E9', 0);
							$spreadsheet->getActiveSheet()->setCellValue('E10', 0);
							$spreadsheet->getActiveSheet()->setCellValue('E11', 0);
							$spreadsheet->getActiveSheet()->setCellValue('E12', 0);
							$spreadsheet->getActiveSheet()->setCellValue('E13', 0);
						}
						break;
					case '3':
						$spreadsheet->getActiveSheet()->setCellValue('H7', $item['cantidad']);
						$spreadsheet->getActiveSheet()->setCellValue('H8', $item['no_a_llegado']);
						$spreadsheet->getActiveSheet()->setCellValue('H9', $item['recibido']);
						$spreadsheet->getActiveSheet()->setCellValue('H10', $item['devuelto']);
						$spreadsheet->getActiveSheet()->setCellValue('H11', $item['cancelado']);
						$spreadsheet->getActiveSheet()->setCellValue('H12', $item['no_llego']);
						$spreadsheet->getActiveSheet()->setCellValue('H13', '=SUM(H8:H12)');
						if(intval($item['cantidad']) > 0){
							$spreadsheet->getActiveSheet()->setCellValue('I8', round((intval($item['no_a_llegado']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('I9', round((intval($item['recibido']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('I10', round((intval($item['devuelto']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('I11', round((intval($item['cancelado']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('I12', round((intval($item['no_llego']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('I13', '=SUM(I8:I12)');
						}else{
							$spreadsheet->getActiveSheet()->setCellValue('I8', 0);
							$spreadsheet->getActiveSheet()->setCellValue('I9', 0);
							$spreadsheet->getActiveSheet()->setCellValue('I10', 0);
							$spreadsheet->getActiveSheet()->setCellValue('I11', 0);
							$spreadsheet->getActiveSheet()->setCellValue('I12', 0);
							$spreadsheet->getActiveSheet()->setCellValue('I13', 0);
						}
						break;
					case '5':
						$spreadsheet->getActiveSheet()->setCellValue('F7', $item['cantidad']);
						$spreadsheet->getActiveSheet()->setCellValue('F8', $item['no_a_llegado']);
						$spreadsheet->getActiveSheet()->setCellValue('F9', $item['recibido']);
						$spreadsheet->getActiveSheet()->setCellValue('F10', $item['devuelto']);
						$spreadsheet->getActiveSheet()->setCellValue('F11', $item['cancelado']);
						$spreadsheet->getActiveSheet()->setCellValue('F12', $item['no_llego']);
						$spreadsheet->getActiveSheet()->setCellValue('F13', '=SUM(F8:F12)');
						if(intval($item['cantidad']) > 0){
							$spreadsheet->getActiveSheet()->setCellValue('G8', round((intval($item['no_a_llegado']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('G9', round((intval($item['recibido']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('G10', round((intval($item['devuelto']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('G11', round((intval($item['cancelado']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('G12', round((intval($item['no_llego']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('G13', '=SUM(G8:G12)');
						}else{
							$spreadsheet->getActiveSheet()->setCellValue('G8', 0);
							$spreadsheet->getActiveSheet()->setCellValue('G9', 0);
							$spreadsheet->getActiveSheet()->setCellValue('G10', 0);
							$spreadsheet->getActiveSheet()->setCellValue('G11', 0);
							$spreadsheet->getActiveSheet()->setCellValue('G12', 0);
							$spreadsheet->getActiveSheet()->setCellValue('G13', 0);
						}
						break;
				}
			}
			$spreadsheet->getActiveSheet()->setCellValue('J7', '=SUM(B7,D7,F7,H7)');
			$spreadsheet->getActiveSheet()->setCellValue('J8', '=SUM(B8,D8,F8,H8)');
			$spreadsheet->getActiveSheet()->setCellValue('J9', '=SUM(B9,D9,F9,H9)');
			$spreadsheet->getActiveSheet()->setCellValue('J10', '=SUM(B10,D10,F10,H10)');
			$spreadsheet->getActiveSheet()->setCellValue('J11', '=SUM(B11,D11,F11,H11)');
			$spreadsheet->getActiveSheet()->setCellValue('J12', '=SUM(B12,D12,F12,H12)');
			$spreadsheet->getActiveSheet()->setCellValue('J13', '=SUM(B13,D13,F13,H13)');
		}
	}
	$spreadsheet->getActiveSheet()->getStyle('C8:C13')->getNumberFormat()->setFormatCode('0%');
	$spreadsheet->getActiveSheet()->getStyle('E8:E13')->getNumberFormat()->setFormatCode('0%');
	$spreadsheet->getActiveSheet()->getStyle('I8:I13')->getNumberFormat()->setFormatCode('0%');
	$spreadsheet->getActiveSheet()->getStyle('G8:G13')->getNumberFormat()->setFormatCode('0%');

	if($digits = Reporte::informacionClientesDigitalizados($request['fecha_ini'], $request['fecha_fin'])){
		if(isset($digits['items']) && is_array($digits['items']) && !empty($digits['items'])){
			foreach($digits['items'] as $item){
				switch ($item['tipo']){
					case '0':
					case '2':
					case '6':
						$spreadsheet->getActiveSheet()->setCellValue('B15', intval($spreadsheet->getActiveSheet()->getCell('B15')->getValue()) + intval($item['cantidad']));
						break;
					case '1':
					case '7':
						$spreadsheet->getActiveSheet()->setCellValue('D15', intval($spreadsheet->getActiveSheet()->getCell('D15')->getValue()) + intval($item['cantidad']));
						break;
					case '3':
						$spreadsheet->getActiveSheet()->setCellValue('H15', $item['cantidad']);
						break;
					case '5':
						$spreadsheet->getActiveSheet()->setCellValue('F15', $item['cantidad']);
						break;
				}
			}
			$spreadsheet->getActiveSheet()->setCellValue('J15', '=SUM(B15,D15,F15,H15)');
		}
	}

	if($comples = Reporte::informacionClientesDocumentacionComplementaria($request['fecha_ini'], $request['fecha_fin'])){
		if(isset($comples['items']) && is_array($comples['items']) && !empty($comples['items'])){
			foreach($comples['items'] as $item){
				switch ($item['tipo']){
					case '0':
					case '2':
					case '6':
						$spreadsheet->getActiveSheet()->setCellValue('B16', intval($spreadsheet->getActiveSheet()->getCell('B16')->getValue()) + intval($item['cantidad']));
						break;
					case '1':
					case '7':
						$spreadsheet->getActiveSheet()->setCellValue('D16', intval($spreadsheet->getActiveSheet()->getCell('D16')->getValue()) + intval($item['cantidad']));
						break;
					case '3':
						$spreadsheet->getActiveSheet()->setCellValue('H16', $item['cantidad']);
						break;
					case '5':
						$spreadsheet->getActiveSheet()->setCellValue('F16', $item['cantidad']);
						break;
				}
			}
			$spreadsheet->getActiveSheet()->setCellValue('J16', '=SUM(B16,D16,F16,H16)');
		}
	}

	if($parad = Reporte::informacionClientesParaDigitar($request['fecha_ini'], $request['fecha_fin'])){
		if(isset($parad['items']) && is_array($parad['items']) && !empty($parad['items'])){
			foreach($parad['items'] as $item){
				switch ($item['tipo']){
					case '0':
					case '2':
					case '6':
						$spreadsheet->getActiveSheet()->setCellValue('B17', intval($spreadsheet->getActiveSheet()->getCell('B17')->getValue()) + intval($item['cantidad']));
						break;
					case '1':
					case '7':
						$spreadsheet->getActiveSheet()->setCellValue('D17', intval($spreadsheet->getActiveSheet()->getCell('D17')->getValue()) + intval($item['cantidad']));
						break;
					case '3':
						$spreadsheet->getActiveSheet()->setCellValue('H17', $item['cantidad']);
						break;
					case '5':
						$spreadsheet->getActiveSheet()->setCellValue('F17', $item['cantidad']);
						break;
				}
			}
			$spreadsheet->getActiveSheet()->setCellValue('J17', '=SUM(B17,D17,F17,H17)');
		}
	}

	if($digita = Reporte::informacionClientesDigitados($request['fecha_ini'], $request['fecha_fin'])){
		if(isset($digita['items']) && is_array($digita['items']) && !empty($digita['items'])){
			foreach($digita['items'] as $item){
				switch ($item['tipo']){
					case '0':
					case '2':
					case '6':
						$spreadsheet->getActiveSheet()->setCellValue('B18', intval($spreadsheet->getActiveSheet()->getCell('B18')->getValue()) + intval($item['cantidad']));
						break;
					case '1':
					case '7':
						$spreadsheet->getActiveSheet()->setCellValue('D18', intval($spreadsheet->getActiveSheet()->getCell('D18')->getValue()) + intval($item['cantidad']));
						break;
					case '3':
						$spreadsheet->getActiveSheet()->setCellValue('H18', $item['cantidad']);
						break;
					case '5':
						$spreadsheet->getActiveSheet()->setCellValue('F18', $item['cantidad']);
						break;
				}
			}
			$spreadsheet->getActiveSheet()->setCellValue('J18', '=SUM(B18,D18,F18,H18)');
		}
	}

	if($confs = Reporte::informacionGestionesTelefonicas($request['fecha_ini'], $request['fecha_fin'])){
		if(isset($confs['items']) && is_array($confs['items']) && !empty($confs['items'])){
			foreach($confs['items'] as $item){
				switch ($item['tipo']){
					case '1':
						$spreadsheet->getActiveSheet()->setCellValue('B21', $item['cantidad']);
						$spreadsheet->getActiveSheet()->setCellValue('B22', $item['efectivas']);
						$spreadsheet->getActiveSheet()->setCellValue('B23', $item['confirmadas']);
						if(intval($item['cantidad']) > 0){
							$spreadsheet->getActiveSheet()->setCellValue('E21', 1);
							$spreadsheet->getActiveSheet()->setCellValue('E22', round((intval($item['efectivas']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('E23', round((intval($item['confirmadas']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
						}else{
							$spreadsheet->getActiveSheet()->setCellValue('E21', 0);
							$spreadsheet->getActiveSheet()->setCellValue('E22', 0);
							$spreadsheet->getActiveSheet()->setCellValue('E23', 0);
						}
						break;
					case '2':
						$spreadsheet->getActiveSheet()->setCellValue('F21', $item['cantidad']);
						$spreadsheet->getActiveSheet()->setCellValue('F22', $item['efectivas']);
						$spreadsheet->getActiveSheet()->setCellValue('F23', $item['confirmadas']);
						if(intval($item['cantidad']) > 0){
							$spreadsheet->getActiveSheet()->setCellValue('F21', 1);
							$spreadsheet->getActiveSheet()->setCellValue('F22', round((intval($item['efectivas']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
							$spreadsheet->getActiveSheet()->setCellValue('F23', round((intval($item['confirmadas']) * 100) / intval($item['cantidad']), 0, PHP_ROUND_HALF_EVEN) / 100);
						}else{
							$spreadsheet->getActiveSheet()->setCellValue('F21', 0);
							$spreadsheet->getActiveSheet()->setCellValue('F22', 0);
							$spreadsheet->getActiveSheet()->setCellValue('F23', 0);
						}
						break;
				}
			}
			$spreadsheet->getActiveSheet()->setCellValue('I21', '=SUM(B21,F21)');
			$spreadsheet->getActiveSheet()->setCellValue('I22', '=SUM(B22,F22)');
			$spreadsheet->getActiveSheet()->setCellValue('I23', '=SUM(B23,F23)');
		}
	}
	$spreadsheet->getActiveSheet()->getStyle('E21:E23')->getNumberFormat()->setFormatCode('0%');
	$spreadsheet->getActiveSheet()->getStyle('H21:H23')->getNumberFormat()->setFormatCode('0%');

	$writer = new Xlsx($spreadsheet);
	$file = 'reporteGestion_'.date('YmdHis').'.xlsx';
	$filename = PATH_FILES.DS.$file;
	$writer->save($filename);

	$info = array('exito'=> 'Datos generados correctamente.');
	if(file_exists($filename))
		$info['file_name'] = $file;
	echo json_encode($info);
}
function descargarReporteGeneradoAction($request){
	$path = PATH_FILES.DS.$request['file'];
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename='.$request['file']);
	header('Pragma: no-cache');
	readfile($path);
}
function eliminaArchivoReporteAction($request){
	if(file_exists(PATH_FILES.DS.$request['file'])){
		if(unlink(PATH_FILES.DS.$request['file']))
			echo json_encode(array('exito'=> 'Archivo eliminado satisfactoriamente!'));
		else
			echo json_encode(array('error'=> 'unlink no pudo eliminar el archivo "'.$request['file'].'" solicitado!'));
	}else
		echo json_encode(array('error'=> 'El archivo no existe para ser eliminado.'));
}
?>