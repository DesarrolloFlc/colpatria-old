<?php
if (!isset($_SESSION)) session_start();

ini_set('memory_limit', '-1');
set_time_limit(0);
header("Content-Type: text/html;charset=utf-8");

require_once PATH_CCLASS . DS . 'meta.class.php';
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';

use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
function generarReporteProductivivdadDiariaAction($request){//http://192.168.6.9/Colpatria/procesos/includes/Controller.php?action=generarReporteProductivivdadDiaria&domain=meta&meth=js&fecha=2020-09-01
	if($dat = Meta::reporteProductivivdadDiaria($request['fecha'])){
		if(isset($dat['items']) && is_array($dat['items']) && !empty($dat['items'])){
			$spreadsheet = new Spreadsheet();
			$spreadsheet->getProperties()
				->setCreator('FinlecoBPO Group')
				->setLastModifiedBy('FinlecoBPO Group')
				->setTitle('Reporte de Cumplimiento Consolidado por Asesor')
				->setSubject('Consolidado por Asesor')
				->setDescription('Reporte con el cumplimiento consolidado por cada asesor')
				->setKeywords('Reporte cumplimiento consolidado asesor asesores')
				->setCategory('Reportes de cumplimiento');

			$styleTittles = [
				'font' => [
					'bold' => true,
					'color'=> ['argb' => 'FFFFFF'],
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
				],
				'borders' => [
					'allBorders' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
						'color' => ['argb' => 'FFFFFF'],
					],
				],
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
					'startColor' => ['argb' => '285E9E'],
				],
			];
			$header = [
				["GESTIÓN DOCUMENTAL COLPATRIA"],
				["CLIENTE", "ACTIVIDAD", "NOMBRE ASESOR", "USUARIO", "PRODUCTIVIDAD", "META DIARIA", "FORMULARIOS PENDIENTES PARA CUMPLIMIENTO", "% EJECUCION META DIARIA/GESTION REALIZADA"]
			];
			$spreadsheet->setActiveSheetIndex(0)
				->mergeCells('A1:H1');

			// Rename worksheet
			$spreadsheet->getActiveSheet()->setTitle('Productividad_Diaria');
			$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($styleTittles);
			$spreadsheet->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleTittles);
			$spreadsheet->getActiveSheet()->fromArray($header, NULL, 'A1');

			$cont = 3;
			foreach($dat['items'] as $item){
				$metaDiaria = 'Sin meta';
				if(intval($item['meta_diaria']) > 0){
					if(intval($item['cantidad']) > intval($item['meta_diaria']))
						$metaDiaria = 0;
					else
						$metaDiaria = intval($item['meta_diaria']) - intval($item['cantidad']);
				}
				$spreadsheet->getActiveSheet()->setCellValue('A'.$cont, 'COLPATRIA BACK Y DIGITACION');
				$spreadsheet->getActiveSheet()->setCellValue('B'.$cont, $item['actividad']);
				$spreadsheet->getActiveSheet()->setCellValue('C'.$cont, $item['gestor_nombre']);
				$spreadsheet->getActiveSheet()->setCellValue('D'.$cont, $item['gestor_usuario']);
				$spreadsheet->getActiveSheet()->setCellValue('E'.$cont, intval($item['cantidad']));
				$spreadsheet->getActiveSheet()->setCellValue('F'.$cont, intval($item['meta_diaria']));
				$spreadsheet->getActiveSheet()->setCellValue('G'.$cont, $metaDiaria);
				$spreadsheet->getActiveSheet()->setCellValue('H'.$cont, round(($item['cantidad'] * 100) / $item['meta_diaria']).'%');
				$spreadsheet->getActiveSheet()->setCellValue('Z'.$cont, $item['actividad']." - ".$item['gestor_usuario']);

				$cont++;
			}
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(38);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(12);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(16);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(14);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(1);
			//$spreadsheet->getActiveSheet()->getColumnDimension('Z')->setVisible(false);
			$spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(60);
			$spreadsheet->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setWrapText(true);


			$dataSeriesLabels = [
				new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Productividad_Diaria!$E$2', null, 1), // 2010
				new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Productividad_Diaria!$F$2', null, 1), // 2011
			];
			$xAxisTickValues = [
				new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Productividad_Diaria!$Z$3:$Z$'.($cont - 1), null, 4), // Q1 to Q4
			];
			$dataSeriesValues = [
				new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Productividad_Diaria!$E$3:$E$'.($cont - 1), null, 4),
				new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Productividad_Diaria!$F$3:$F$'.($cont - 1), null, 4),
			];
			// Build the dataseries
			$series = new DataSeries(
				DataSeries::TYPE_BARCHART, // plotType
				DataSeries::GROUPING_STANDARD, // plotGrouping
				range(0, count($dataSeriesValues) - 1), // plotOrder
				$dataSeriesLabels, // plotLabel
				$xAxisTickValues, // plotCategory
				$dataSeriesValues        // plotValues
			);
			// Set additional dataseries parameters
			//     Make it a horizontal bar rather than a vertical column graph
			$series->setPlotDirection(DataSeries::DIRECTION_COL);

			// Set the series in the plot area
			$plotArea = new PlotArea(null, [$series]);
			// Set the chart legend
			$legend = new Legend(Legend::POSITION_RIGHT, null, false);

			$title = new Title('Productividad diaria');
			$yAxisLabel = new Title('Gestiones');

			// Create the chart
			$chart = new Chart(
				'chart1', // name
				$title, // title
				$legend, // legend
				$plotArea, // plotArea
				true, // plotVisibleOnly
				'gap', // displayBlanksAs
				null, // xAxisLabel
				$yAxisLabel  // yAxisLabel
			);

			// Set the position where the chart should appear in the worksheet
			$chart->setTopLeftPosition('A'.($cont + 1));
			$chart->setBottomRightPosition('J'.($cont + 12));

			// Add the chart to the worksheet
			$spreadsheet->getActiveSheet()->addChart($chart);


			$file = 'reporteProductivivdadDiaria_'.date('YmdHis').'.xlsx';
			$filename = PATH_FILES.DS.$file;
			$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->setIncludeCharts(true);
			$writer->save($filename);

			$info = array('exito'=> 'Datos generados correctamente.');
			if(file_exists($filename))
				$info['file_name'] = $file;
			echo json_encode($info);
		}elseif(isset($dat['exito']) || isset($dat['error'])){
			echo json_encode($dat);
		}else{
			echo json_encode(array('error'=> 'Ocurrio un erro al momento de consultar los datos, contacte con el administrador...'));
		}
	}else{
		echo json_encode(array('error'=> 'Ocurrio un error al realizar la consulta, contacte con el administrador...'));
	}
}
function reporteProductividadTareaAction($request){
	if($dat = Meta::reporteProductividadTarea($request['fechaini'], $request['fechafin'], $request['tarea_id'])){
		if(isset($dat['items']) && is_array($dat['items']) && !empty($dat['items']) && isset($dat['items']['usuarios']) && !empty($dat['items']['usuarios'])){
			$itera = $request['dias'];
			$voc = array('F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT');
			$items = array();
			foreach($dat['items']['usuarios'] as $key => $item){
				$otro = array();
				foreach ($item as $mas) {
					$otro[$mas['fecha']] = $mas;
				}
				$items[$key] = $otro;
			}
			$cantUs = count($dat['items']['usuarios']);
			$spreadsheet = new Spreadsheet();
			$spreadsheet->getProperties()
				->setCreator('FinlecoBPO Group')
				->setLastModifiedBy('FinlecoBPO Group')
				->setTitle('Reporte de Cumplimiento Consolidado por Asesor')
				->setSubject('Consolidado por Asesor')
				->setDescription('Reporte con el cumplimiento consolidado por cada asesor')
				->setKeywords('Reporte cumplimiento consolidado asesor asesores')
				->setCategory('Reportes de cumplimiento');

			$styleTittles = [
				'font' => [
					'bold' => true,
					'color'=> ['argb' => 'FFFFFF'],
					'size'=> 8,
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
				],
				'borders' => [
					'allBorders' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
						'color' => ['argb' => 'FFFFFF'],
					],
				],
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
					'startColor' => ['argb' => '285E9E'],
				],
			];
			$styleContent = [
				'font' => [
					'bold' => false,
					//'color'=> array('rgb' => '0000'),
					'size'=> 8,
				],
			];
			$header = ["ACTIVIDAD BASE", "COLABORADOR", "META MES", "LLEVA", "% CUMPLIMIENTO"];
			$spreadsheet->setActiveSheetIndex(0)
				->mergeCells('A2:A3')
				->mergeCells('B2:B3')
				->mergeCells('C2:C3')
				->mergeCells('D2:D3')
				->mergeCells('E2:E3');

			// Rename worksheet
			$spreadsheet->getActiveSheet()->setTitle('Productividad_rango');

			$spreadsheet->getActiveSheet()->fromArray($header, NULL, 'A2');

			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(22);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(12);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(8);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(12);

			$spreadsheet->getActiveSheet()->getStyle('A2:E3')->applyFromArray($styleTittles);
			$spreadsheet->getActiveSheet()->getStyle('A4:E4')->applyFromArray($styleContent);

			$spreadsheet->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setWrapText(true);
			$spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(29);
			$spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(29);

			$pieCant = '';
			$sumCant = '';
			$sumMeta = '';
			$acomp = 2;
			$cont = 2;
			foreach($items as $key => $value){
				$u = 0;
				$d = 1;
				$t = 2;
				$fechaini = date('Y-m-d', strtotime($request['fechaini']));
				$fechafin = date('Y-m-d', strtotime($request['fechafin']));
				$metaMes = 0;
				$lleva = 0;
				$contDias = 1;
				while(strtotime($fechaini) <= strtotime($fechafin)){
					if(date('w', strtotime($fechaini)) !== '0'){
						if($acomp == 2){
							$spreadsheet->getActiveSheet()->mergeCells($voc[$u].$cont.':'.$voc[$t].$cont);
							$spreadsheet->getActiveSheet()->setCellValue($voc[$u].$cont, date('d/m/Y', strtotime($fechaini)));

							$spreadsheet->getActiveSheet()->fromArray(["GESTION", "META", "% CUMPL"], NULL, $voc[$u].($cont + 1));
							$spreadsheet->getActiveSheet()->getColumnDimension($voc[$u])->setWidth(8);
							$spreadsheet->getActiveSheet()->getColumnDimension($voc[$d])->setWidth(6);
							$spreadsheet->getActiveSheet()->getColumnDimension($voc[$t])->setWidth(9);
						}

						if(isset($value[$fechaini]) && !empty($value[$fechaini])){
							$meta = 'Sin meta';
							if(intval($value[$fechaini]['meta_diaria']) > 0)
								$meta = round(((intval($value[$fechaini]['cantidad']) * 100) / intval($value[$fechaini]['meta_diaria'])))."%";

							$spreadsheet->getActiveSheet()->fromArray([$value[$fechaini]['cantidad'], $value[$fechaini]['meta_diaria'], $meta], NULL, $voc[$u].($cont + $acomp));

							$spreadsheet->getActiveSheet()->getStyle($voc[$u].($cont + $acomp).':'.$voc[$t].($cont + $acomp))->applyFromArray($styleContent);

							$styleTittles['fill']['startColor']['argb'] = '000000';
							$spreadsheet->getActiveSheet()->getStyle($voc[$u].$cont.':'.$voc[$t].($cont + 1))->applyFromArray($styleTittles);

							$metaMes += intval($value[$fechaini]['meta_diaria']);
							$lleva += intval($value[$fechaini]['cantidad']);

							$spreadsheet->getActiveSheet()->fromArray([$value[$fechaini]['actividad'], $value[$fechaini]['gestor_nombre']], NULL, 'A'.($cont + $acomp));
						}else{
							$spreadsheet->getActiveSheet()->fromArray(['0', '0', 'Sin meta'], NULL, $voc[$u].($cont + $acomp));
							$spreadsheet->getActiveSheet()->getStyle($voc[$u].($cont + $acomp).':'.$voc[$t].($cont + $acomp))->applyFromArray($styleContent);

							$styleTittles['fill']['startColor']['argb'] = '000000';
							$spreadsheet->getActiveSheet()->getStyle($voc[$u].$cont.':'.$voc[$t].($cont + 1))->applyFromArray($styleTittles);

						}
						$styleTittles['fill']['startColor']['argb'] = '285E9E';
						$u += 3;
						$d += 3;
						$t += 3;

						$contDias++;
					}

					$fechaini = date('Y-m-d', strtotime("+1 day", strtotime($fechaini)));
				}

				$spreadsheet->getActiveSheet()->fromArray([$metaMes, $lleva, round((($lleva * 100) / $metaMes))."%"], NULL, 'C'.($cont + $acomp));
				$spreadsheet->getActiveSheet()->getStyle('A'.($cont + $acomp).':E'.($cont + $acomp))->applyFromArray($styleContent);
				$acomp++;
			}


			$file = 'reporteProductividadRango_'.date('YmdHis').'.xlsx';
			$filename = PATH_FILES.DS.$file;
			$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save($filename);

			$info = array('exito'=> 'Datos generados correctamente.');
			if(file_exists($filename))
				$info['file_name'] = $file;
			echo json_encode($info);
		}else
			echo json_encode($dat);
	}else
		echo json_encode(array('error'=> 'Ocurrio un error al realizar la consulta, contacte con el administrador...'));
}
?>