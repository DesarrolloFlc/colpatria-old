<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(0);

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CLASS . DS . '_conexion.php';
require_once PATH_CCLASS . DS . 'meta.class.php';
require_once PATH_PHPEXCEL . DS . 'Classes'.DS.'PHPExcel.php';
if(isset($_GET['action']) && $_GET['action'] == 'generarReporteProductivivdadDiaria'){
	if($dat = Meta::reporteProductivivdadDiaria($_GET['fecha'])){
		if(isset($dat['items']) && is_array($dat['items']) && !empty($dat['items'])){
			$objPHPExcel = new PHPExcel();

			$objPHPExcel->getProperties()->setCreator("FinlecoBPO Group")
				->setLastModifiedBy("FinlecoBPO Group")
				->setTitle("Reporte de Cumplimiento Consolidado por Asesor")
				->setSubject("Consolidado por Asesor")
				->setDescription("Reporte con el cumplimiento consolidado por cada asesor")
				->setKeywords("Reporte cumplimiento consolidado asesor asesores")
				->setCategory("Reportes de cumplimiento");

			$objPHPExcel->setActiveSheetIndex(0);
			$styleTittles = array(
				'font' => array(
					'bold' => true,
					'color'=> array('rgb' => 'ffff'),
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_HAIR,
						'color' => array('rgb' => 'ffff'),
					),
				),
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array(
						'argb' => '285e9e',
					),
				),
			);
			$cont = 1;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$cont.':H'.$cont);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$cont, "GESTIÓN DOCUMENTAL COLPATRIA");
			$objPHPExcel->getActiveSheet()->getStyle('A'.$cont)->applyFromArray($styleTittles);
			$cont++;
			$tittlePresunta = array("CLIENTE", "ACTIVIDAD", "NOMBRE ASESOR", "USUARIO", "PRODUCTIVIDAD", "META DIARIA", "FORMULARIOS PENDIENTES PARA CUMPLIMIENTO", "% EJECUCION META DIARIA/GESTION REALIZADA");
			$objPHPExcel->getActiveSheet()->fromArray($tittlePresunta, NULL, 'A'.$cont);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$cont.':H'.$cont)->applyFromArray($styleTittles);
			$cont++;
			foreach($dat['items'] as $item){
				$metaDiaria = 'Sin meta';
				if(intval($item['meta_diaria']) > 0){
					if(intval($item['cantidad']) > intval($item['meta_diaria']))
						$metaDiaria = 0;
					else
						$metaDiaria = intval($item['meta_diaria']) - intval($item['cantidad']);
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$cont, 'COLPATRIA BACK Y DIGITACION');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$cont, $item['actividad']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$cont, $item['gestor_nombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$cont, $item['gestor_usuario']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$cont, intval($item['cantidad']));
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$cont, intval($item['meta_diaria']));
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$cont, $metaDiaria);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$cont, round(($item['cantidad'] * 100) / $item['meta_diaria']).'%');
				$objPHPExcel->getActiveSheet()->setCellValue('Z'.$cont, $item['actividad']." - ".$item['gestor_usuario']);

				$cont++;
			}
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(38);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(1);
			//$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setVisible(false);
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(60);
			$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setWrapText(true);


			$dataSeriesLabels = array(
				new PHPExcel_Chart_DataSeriesValues('String', 'Productividad_Diaria!$E$2', NULL, 1),	//	2010
				new PHPExcel_Chart_DataSeriesValues('String', 'Productividad_Diaria!$F$2', NULL, 1),	//	2011
			);
			$xAxisTickValues = array(
				//new PHPExcel_Chart_DataSeriesValues('String', "Worksheet!$D$3:$D$11", NULL, 4),	//	Q1 to Q4 'Productividad Diaria'!$D$3:$D$11
				new PHPExcel_Chart_DataSeriesValues('String', 'Productividad_Diaria!$Z$3:$Z$'.($cont - 1), NULL, 4),	//	Q1 to Q4
			);
			$dataSeriesValues = array(
				new PHPExcel_Chart_DataSeriesValues('Number', 'Productividad_Diaria!$E$3:$E$'.($cont - 1), NULL, 4),
				new PHPExcel_Chart_DataSeriesValues('Number', 'Productividad_Diaria!$F$3:$F$'.($cont - 1), NULL, 4),
			);
			//	Build the dataseries
			$series = new PHPExcel_Chart_DataSeries(
				PHPExcel_Chart_DataSeries::TYPE_BARCHART,		// plotType
				PHPExcel_Chart_DataSeries::GROUPING_STANDARD,	// plotGrouping
				range(0, count($dataSeriesValues)-1),			// plotOrder
				$dataSeriesLabels,								// plotLabel
				$xAxisTickValues,								// plotCategory
				$dataSeriesValues								// plotValues
			);
			//	Set additional dataseries parameters
			//		Make it a vertical column rather than a horizontal bar graph
			$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

			//	Set the series in the plot area
			$plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series));
			//	Set the chart legend
			$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);

			$title = new PHPExcel_Chart_Title('Productividad diaria');
			$yAxisLabel = new PHPExcel_Chart_Title('Gestiones');


			//	Create the chart
			$chart = new PHPExcel_Chart(
				'chart1',		// name
				$title,			// title
				$legend,		// legend
				$plotArea,		// plotArea
				true,			// plotVisibleOnly
				0,				// displayBlanksAs
				NULL,			// xAxisLabel
				$yAxisLabel		// yAxisLabel
			);

			//	Set the position where the chart should appear in the worksheet
			$chart->setTopLeftPosition('A'.($cont + 1));
			$chart->setBottomRightPosition('J'.($cont + 12));

			//	Add the chart to the worksheet
			$objPHPExcel->getActiveSheet()->addChart($chart);
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Productividad_Diaria');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="reporteProductivivdadDiaria_'.date('His').'.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->setIncludeCharts(TRUE);
			$objWriter->save('php://output');
			exit;
		}elseif(isset($dat['exito'])){
			echo '<script>parent.bootbox.alert("'.$dat['exito'].'");</script>';
		}elseif(isset($dat['error'])){
			echo '<script>parent.bootbox.alert("'.$dat['error'].'");</script>';
		}else{
			echo '<script>parent.bootbox.alert("Ocurrio un erro al momento de consultar los datos, contacte con el administrador...");</script>';
		}
	}else{
		echo '<script>parent.alert("Ocurrio un error al realizar la consulta, contacte con el administrador...");</script>';
	}
}
if(isset($_GET['action']) && $_GET['action'] == 'generarReporteProductividadRango'){
	if($dat = Meta::reporteProductividadRango($_GET['fechaini'], $_GET['fechafin'], $_GET['gestor_id'], $_GET['tarea_id'])){
		if(isset($dat['items']) && is_array($dat['items']) && !empty($dat['items'])){
			$itera = $_GET['dias'];
			$voc = array('F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT');
			$items = array();
			foreach($dat['items'] as $item){
				$items[$item['fecha']] = $item;
				$items['actividad'] = $item['actividad'];
				$items['gestor_nombre'] = $item['gestor_nombre'];
				$items['gestor_usuario'] = $item['gestor_usuario'];
			}
			$objPHPExcel = new PHPExcel();

			// Set document properties
			$objPHPExcel->getProperties()->setCreator("FinlecoBPO Group")
				->setLastModifiedBy("FinlecoBPO Group")
				->setTitle("Reporte de Cumplimiento Consolidado por Asesor")
				->setSubject("Consolidado por Asesor")
				->setDescription("Reporte con el cumplimiento consolidado por cada asesor")
				->setKeywords("Reporte cumplimiento consolidado asesor asesores")
				->setCategory("Reportes de cumplimiento");

			// Add some data
			$objPHPExcel->setActiveSheetIndex(0);
			$styleTittles = array(
				'font' => array(
					'bold' => true,
					'color'=> array('rgb' => 'ffff'),
					'size'=> 8,
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_HAIR,
						'color' => array('rgb' => 'ffff'),
					),
				),
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array(
						'argb' => '285e9e',
					),
				),
			);
			$styleContent = array(
				'font' => array(
					'bold' => false,
					//'color'=> array('rgb' => '0000'),
					'size'=> 8,
				),
			);
			$cont = 2;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$cont.':A'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$cont, "ACTIVIDAD BASE");
			$objPHPExcel->getActiveSheet()->getStyle('A'.$cont.':A'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(22);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.($cont + 2), $items['actividad']);

			$objPHPExcel->getActiveSheet()->mergeCells('B'.$cont.':B'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$cont, "COLABORADOR");
			$objPHPExcel->getActiveSheet()->getStyle('B'.$cont.':B'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.($cont + 2), $items['gestor_nombre']);

			$objPHPExcel->getActiveSheet()->mergeCells('C'.$cont.':C'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$cont, "META MES");
			$objPHPExcel->getActiveSheet()->getStyle('C'.$cont.':C'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);

			$objPHPExcel->getActiveSheet()->mergeCells('D'.$cont.':D'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$cont, "LLEVA");
			$objPHPExcel->getActiveSheet()->getStyle('D'.$cont.':D'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);

			$objPHPExcel->getActiveSheet()->mergeCells('E'.$cont.':E'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$cont, "% CUMPLIMIENTO");
			$objPHPExcel->getActiveSheet()->getStyle('E'.$cont.':E'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);

			$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(29);
			$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(29);

			$objPHPExcel->getActiveSheet()->getStyle('A'.($cont + 2).':E'.($cont + 2))->applyFromArray($styleContent);
			$u = 0;
			$d = 1;
			$t = 2;
			$metaMes = 0;
			$lleva = 0;
			$fechaini = date('Y-m-d', strtotime($_GET['fechaini']));
			$fechafin = date('Y-m-d', strtotime($_GET['fechafin']));
			$pieCant = '';
			$sumCant = '';
			$sumMeta = '';
			$contDias = 1;
			while(strtotime($fechaini) <= strtotime($fechafin)){
				if(date('w', strtotime($fechaini)) !== '0'){
					$objPHPExcel->getActiveSheet()->mergeCells($voc[$u].$cont.':'.$voc[$t].$cont);
					$objPHPExcel->getActiveSheet()->setCellValue($voc[$u].$cont, date('d/m/Y', strtotime($fechaini)));

					$objPHPExcel->getActiveSheet()->setCellValue($voc[$u].($cont + 1), "GESTION");
					$objPHPExcel->getActiveSheet()->getColumnDimension($voc[$u])->setWidth(8);
					$objPHPExcel->getActiveSheet()->setCellValue($voc[$d].($cont + 1), "META");
					$objPHPExcel->getActiveSheet()->getColumnDimension($voc[$d])->setWidth(6);
					$objPHPExcel->getActiveSheet()->setCellValue($voc[$t].($cont + 1), "% CUMPL");
					$objPHPExcel->getActiveSheet()->getColumnDimension($voc[$t])->setWidth(9);

					if(isset($items[$fechaini]) && !empty($items[$fechaini])){
						$meta = 'Sin meta';
						if(intval($items[$fechaini]['meta_diaria']) > 0)
							$meta = round(((intval($items[$fechaini]['cantidad']) * 100) / intval($items[$fechaini]['meta_diaria'])))."%";

						$objPHPExcel->getActiveSheet()->setCellValue($voc[$u].($cont + 2), $items[$fechaini]['cantidad']);
						$objPHPExcel->getActiveSheet()->setCellValue($voc[$d].($cont + 2), $items[$fechaini]['meta_diaria']);
						$objPHPExcel->getActiveSheet()->setCellValue($voc[$t].($cont + 2), $meta);
						$objPHPExcel->getActiveSheet()->getStyle($voc[$u].($cont + 2).':'.$voc[$t].($cont + 2))->applyFromArray($styleContent);

						$styleTittles['fill']['startcolor']['argb'] = '0000';
						$objPHPExcel->getActiveSheet()->getStyle($voc[$u].$cont.':'.$voc[$t].$cont)->applyFromArray($styleTittles);
						$objPHPExcel->getActiveSheet()->getStyle($voc[$u].($cont + 1).':'.$voc[$t].($cont + 1))->applyFromArray($styleTittles);

						$metaMes += intval($items[$fechaini]['meta_diaria']);
						$lleva += intval($items[$fechaini]['cantidad']);

						if($u == 0){
							$pieCant .= '$'.$voc[$u].'$'.($cont);
							$sumCant .= '$'.$voc[$u].'$'.($cont + 2);
							$sumMeta .= '$'.$voc[$d].'$'.($cont + 2);
						}else{
							$pieCant .= ';Productividad_rango!$'.$voc[$u].'$'.($cont);
							$sumCant .= ';Productividad_rango!$'.$voc[$u].'$'.($cont + 2);
							$sumMeta .= ';Productividad_rango!$'.$voc[$d].'$'.($cont + 2);
						}
					}else{
						$objPHPExcel->getActiveSheet()->setCellValue($voc[$u].($cont + 2), 0);
						$objPHPExcel->getActiveSheet()->setCellValue($voc[$d].($cont + 2), 0);
						$objPHPExcel->getActiveSheet()->setCellValue($voc[$t].($cont + 2), 'Sin meta');
						$objPHPExcel->getActiveSheet()->getStyle($voc[$u].($cont + 2).':'.$voc[$t].($cont + 2))->applyFromArray($styleContent);

						$styleTittles['fill']['startcolor']['argb'] = 'AB9A44';
						$objPHPExcel->getActiveSheet()->getStyle($voc[$u].$cont.':'.$voc[$t].$cont)->applyFromArray($styleTittles);
						$objPHPExcel->getActiveSheet()->getStyle($voc[$u].($cont + 1).':'.$voc[$t].($cont + 1))->applyFromArray($styleTittles);

						if($u == 0){
							$pieCant .= '$'.$voc[$u].'$'.($cont);
							$sumCant .= '$'.$voc[$u].'$'.($cont + 2);
							$sumMeta .= '$'.$voc[$d].'$'.($cont + 2);
						}else{
							$pieCant .= ';Productividad_rango!$'.$voc[$u].'$'.($cont);
							$sumCant .= ';Productividad_rango!$'.$voc[$u].'$'.($cont + 2);
							$sumMeta .= ';Productividad_rango!$'.$voc[$d].'$'.($cont + 2);
						}
					}
					$styleTittles['fill']['startcolor']['argb'] = '285e9e';
					$u += 3;
					$d += 3;
					$t += 3;

					$contDias++;
				}

				$fechaini = date('Y-m-d', strtotime("+1 day", strtotime($fechaini)));
			}
			//$pieCant .= ')';
//=(Productividad_rango!$F$2;Productividad_rango!$I$2;Productividad_rango!$L$2;Productividad_rango!$O$2;Productividad_rango!$R$2;Productividad_rango!$U$2;Productividad_rango!$X$2;Productividad_rango!$AA$2;Productividad_rango!$AD$2;Productividad_rango!$AG$2)
//=Productividad_rango!$F$2;Productividad_rango!$I$2;Productividad_rango!$L$2;Productividad_rango!$O$2;Productividad_rango!$R$2;Productividad_rango!$U$2;Productividad_rango!$X$2;Productividad_rango!$AA$2;Productividad_rango!$AD$2;Productividad_rango!$AG$2
			$objPHPExcel->getActiveSheet()->setCellValue('C'.($cont + 2), $metaMes);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.($cont + 2), $lleva);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.($cont + 2), round((($lleva * 100) / $metaMes))."%");


			$dataSeriesLabels = array(
				new PHPExcel_Chart_DataSeriesValues('String', 'Productividad_rango!$F$3', NULL, 1),	//	2010
				new PHPExcel_Chart_DataSeriesValues('String', 'Productividad_rango!$G$3', NULL, 1)	//	2011
			);
			//error_log("::::::".$pieCant, 0);
			//error_log("::::::".$contDias, 0);
			$xAxisTickValues = array(
				new PHPExcel_Chart_DataSeriesValues('String', 'Productividad_rango!'.$pieCant, NULL, $contDias)	//	Q1 to Q4
			);
			//error_log(":::".$pieCant, 0);
			$dataSeriesValues = array(
				new PHPExcel_Chart_DataSeriesValues('Number', 'Productividad_rango!'.$sumCant, NULL, $contDias),
				new PHPExcel_Chart_DataSeriesValues('Number', 'Productividad_rango!'.$sumMeta, NULL, $contDias)
			);
			//	Build the dataseries
			$series = new PHPExcel_Chart_DataSeries(
				PHPExcel_Chart_DataSeries::TYPE_LINECHART,		// plotType
				PHPExcel_Chart_DataSeries::GROUPING_STACKED,	// plotGrouping
				range(0, count($dataSeriesValues)-1),			// plotOrder
				$dataSeriesLabels,								// plotLabel
				$xAxisTickValues,								// plotCategory
				$dataSeriesValues								// plotValues
			);

			//	Set the series in the plot area
			$plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series));
			//	Set the chart legend
			$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_TOPRIGHT, NULL, false);

			$title = new PHPExcel_Chart_Title('Cumplimiento en rango de fecha asesor');
			$yAxisLabel = new PHPExcel_Chart_Title('Gestiones');
			//	Create the chart
			$chart = new PHPExcel_Chart(
				'chart1',		// name
				$title,			// title
				$legend,		// legend
				$plotArea,		// plotArea
				true,			// plotVisibleOnly
				0,				// displayBlanksAs
				NULL,			// xAxisLabel
				$yAxisLabel		// yAxisLabel
			);

			//	Set the position where the chart should appear in the worksheet
			$chart->setTopLeftPosition('A6');
			$chart->setBottomRightPosition($voc[$t].'24');

			//	Add the chart to the worksheet
			$objPHPExcel->getActiveSheet()->addChart($chart);
			//echo json_encode($items);
			//exit();
			/*
			while(strtotime($fechaini) <= strtotime($fechafin)){
				echo $fechaini."<br>";
				$fechaini = date('Y-m-d', strtotime("+1 day", strtotime($fechaini)));
			}*/
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Productividad_rango');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="reporteProductividadRango_'.date('His').'.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->setIncludeCharts(TRUE);
			$objWriter->save('php://output');
		}
	}else{
		echo '<script>parent.alert("Ocurrio un error al realizar la consulta, contacte con el administrador...");</script>';
	}
}
if(isset($_GET['action']) && $_GET['action'] == 'reporteProductividadTarea'){
	if($dat = Meta::reporteProductividadTarea($_GET['fechaini'], $_GET['fechafin'], $_GET['tarea_id'])){
		if(isset($dat['items']) && is_array($dat['items']) && !empty($dat['items']) && isset($dat['items']['usuarios']) && !empty($dat['items']['usuarios'])){
			$itera = $_GET['dias'];
			$voc = array('F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT');
			$items = array();
			foreach($dat['items']['usuarios'] as $key => $item){
				$otro = array();
				foreach ($item as $mas) {
					$otro[$mas['fecha']] = $mas;
				}
				$items[$key] = $otro;
				/*$items[$item['fecha']] = $item;
				$items['actividad'] = $item['actividad'];
				$items['gestor_nombre'] = $item['gestor_nombre'];
				$items['gestor_usuario'] = $item['gestor_usuario']*/;
			}
			$cantUs = count($dat['items']['usuarios']);
			$objPHPExcel = new PHPExcel();

			// Set document properties
			$objPHPExcel->getProperties()->setCreator("FinlecoBPO Group")
				->setLastModifiedBy("FinlecoBPO Group")
				->setTitle("Reporte de Cumplimiento Consolidado por Asesor")
				->setSubject("Consolidado por Asesor")
				->setDescription("Reporte con el cumplimiento consolidado por cada asesor")
				->setKeywords("Reporte cumplimiento consolidado asesor asesores")
				->setCategory("Reportes de cumplimiento");

			// Add some data
			$objPHPExcel->setActiveSheetIndex(0);
			$styleTittles = array(
				'font' => array(
					'bold' => true,
					'color'=> array('rgb' => 'ffff'),
					'size'=> 8,
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_HAIR,
						'color' => array('rgb' => 'ffff'),
					),
				),
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array(
						'argb' => '285e9e',
					),
				),
			);
			$styleContent = array(
				'font' => array(
					'bold' => false,
					//'color'=> array('rgb' => '0000'),
					'size'=> 8,
				),
			);
			$cont = 2;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$cont.':A'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$cont, "ACTIVIDAD BASE");
			$objPHPExcel->getActiveSheet()->getStyle('A'.$cont.':A'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(22);

			$objPHPExcel->getActiveSheet()->mergeCells('B'.$cont.':B'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$cont, "COLABORADOR");
			$objPHPExcel->getActiveSheet()->getStyle('B'.$cont.':B'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);

			$objPHPExcel->getActiveSheet()->mergeCells('C'.$cont.':C'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$cont, "META MES");
			$objPHPExcel->getActiveSheet()->getStyle('C'.$cont.':C'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);

			$objPHPExcel->getActiveSheet()->mergeCells('D'.$cont.':D'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$cont, "LLEVA");
			$objPHPExcel->getActiveSheet()->getStyle('D'.$cont.':D'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);

			$objPHPExcel->getActiveSheet()->mergeCells('E'.$cont.':E'.($cont + 1));
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$cont, "% CUMPLIMIENTO");
			$objPHPExcel->getActiveSheet()->getStyle('E'.$cont.':E'.($cont + 1))->applyFromArray($styleTittles);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);

			$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(29);
			$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(29);

			$objPHPExcel->getActiveSheet()->getStyle('A'.($cont + 2).':E'.($cont + 2))->applyFromArray($styleContent);
			$pieCant = '';
			$sumCant = '';
			$sumMeta = '';
			$acomp = 2;
			foreach($items as $key => $value){
				$u = 0;
				$d = 1;
				$t = 2;
				$fechaini = date('Y-m-d', strtotime($_GET['fechaini']));
				$fechafin = date('Y-m-d', strtotime($_GET['fechafin']));
				$metaMes = 0;
				$lleva = 0;
				$contDias = 1;
				while(strtotime($fechaini) <= strtotime($fechafin)){
					if(date('w', strtotime($fechaini)) !== '0'){
						if($acomp == 2){
							$objPHPExcel->getActiveSheet()->mergeCells($voc[$u].$cont.':'.$voc[$t].$cont);
							$objPHPExcel->getActiveSheet()->setCellValue($voc[$u].$cont, date('d/m/Y', strtotime($fechaini)));

							$objPHPExcel->getActiveSheet()->setCellValue($voc[$u].($cont + 1), "GESTION");
							$objPHPExcel->getActiveSheet()->getColumnDimension($voc[$u])->setWidth(8);
							$objPHPExcel->getActiveSheet()->setCellValue($voc[$d].($cont + 1), "META");
							$objPHPExcel->getActiveSheet()->getColumnDimension($voc[$d])->setWidth(6);
							$objPHPExcel->getActiveSheet()->setCellValue($voc[$t].($cont + 1), "% CUMPL");
							$objPHPExcel->getActiveSheet()->getColumnDimension($voc[$t])->setWidth(9);
						}

						if(isset($value[$fechaini]) && !empty($value[$fechaini])){
							$meta = 'Sin meta';
							if(intval($value[$fechaini]['meta_diaria']) > 0)
								$meta = round(((intval($value[$fechaini]['cantidad']) * 100) / intval($value[$fechaini]['meta_diaria'])))."%";

							$objPHPExcel->getActiveSheet()->setCellValue($voc[$u].($cont + $acomp), $value[$fechaini]['cantidad']);
							$objPHPExcel->getActiveSheet()->setCellValue($voc[$d].($cont + $acomp), $value[$fechaini]['meta_diaria']);
							$objPHPExcel->getActiveSheet()->setCellValue($voc[$t].($cont + $acomp), $meta);
							$objPHPExcel->getActiveSheet()->getStyle($voc[$u].($cont + $acomp).':'.$voc[$t].($cont + $acomp))->applyFromArray($styleContent);

							$styleTittles['fill']['startcolor']['argb'] = '0000';
							$objPHPExcel->getActiveSheet()->getStyle($voc[$u].$cont.':'.$voc[$t].$cont)->applyFromArray($styleTittles);
							$objPHPExcel->getActiveSheet()->getStyle($voc[$u].($cont + 1).':'.$voc[$t].($cont + 1))->applyFromArray($styleTittles);

							$metaMes += intval($value[$fechaini]['meta_diaria']);
							$lleva += intval($value[$fechaini]['cantidad']);

							$objPHPExcel->getActiveSheet()->setCellValue('A'.($cont + $acomp), $value[$fechaini]['actividad']);
							$objPHPExcel->getActiveSheet()->setCellValue('B'.($cont + $acomp), $value[$fechaini]['gestor_nombre']);
						}else{
							$objPHPExcel->getActiveSheet()->setCellValue($voc[$u].($cont + $acomp), 0);
							$objPHPExcel->getActiveSheet()->setCellValue($voc[$d].($cont + $acomp), 0);
							$objPHPExcel->getActiveSheet()->setCellValue($voc[$t].($cont + $acomp), 'Sin meta');
							$objPHPExcel->getActiveSheet()->getStyle($voc[$u].($cont + $acomp).':'.$voc[$t].($cont + $acomp))->applyFromArray($styleContent);

							$styleTittles['fill']['startcolor']['argb'] = '0000';
							$objPHPExcel->getActiveSheet()->getStyle($voc[$u].$cont.':'.$voc[$t].$cont)->applyFromArray($styleTittles);
							$objPHPExcel->getActiveSheet()->getStyle($voc[$u].($cont + 1).':'.$voc[$t].($cont + 1))->applyFromArray($styleTittles);

						}
						$styleTittles['fill']['startcolor']['argb'] = '285e9e';
						$u += 3;
						$d += 3;
						$t += 3;

						$contDias++;
					}

					$fechaini = date('Y-m-d', strtotime("+1 day", strtotime($fechaini)));
				}
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($cont + $acomp), $metaMes);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($cont + $acomp), $lleva);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.($cont + $acomp), round((($lleva * 100) / $metaMes))."%");
				$objPHPExcel->getActiveSheet()->getStyle('A'.($cont + $acomp).':E'.($cont + $acomp))->applyFromArray($styleContent);
				$acomp++;
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Productividad_rango');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="reporteProductividadRango_'.date('His').'.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			//$objWriter->setIncludeCharts(TRUE);
			$objWriter->save('php://output');
		}
	}else{
		echo '<script>parent.alert("Ocurrio un error al realizar la consulta, contacte con el administrador...");</script>';
	}
}
