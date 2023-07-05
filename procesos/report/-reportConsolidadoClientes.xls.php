<?php
session_start();
//ini_set("memory_limit","800M");
require_once dirname(dirname(dirname(__FILE__))) . '/includes.php';
require_once PATH_CLASS . DS . 'PHPExcel.php';
require_once PATH_CLASS . DS . 'conexion.php';
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportConsolidadoClientes.xls");
header("Pragma: no-cache");
header("Expires: 0");

extract($_POST);
if (!empty($hora)) {
	$hora = $hora+1;
	$complemento = " WHERE formu.date_created >= '$fecha_inicio $hora:00:00' AND formu.date_created  <= '$fecha_fin $hora:59:59' AND formu.status = '1' ";
} else {
	$complemento = " WHERE formu.date_created >= '$fecha_inicio 00:00:00' AND formu.date_created <= '$fecha_fin 23:59:59'  AND formu.status = '1' ";
}

if (!empty($area)) {
	$complemento.= " AND data.area = '$area' ";
} 

if (!empty($sucursal)) {
	$complemento.= " AND data.sucursal = '$sucursal' ";

}
$conexion = new Conexion();
$objetos = array();
$SQL = "SELECT IF(persontype = '1', 'Natural', 'Juridico'), document, firstname, 
			   IF(status_migracion = 'Activo', 'Migraci�n', ''), 
			   IF(status_form = 'Activo', 'Formulario', ''), date_created
		  FROM client 
		 WHERE status_migracion = 'Activo' OR status_form = 'Activo'";

$conexion->consultar($SQL);
if($conexion->getNumeroRegistros() > 0){
?>
<table>
	<tr>
		<td>Tipo de Person</td>
		<td>Identificaci&oacute;n</td>
		<td>Nombre / Razon Social</td>
		<td colspan="2">El cliente cuenta con informaci�n en.</td>
	</tr>
<?php
	while ($registro = $conexion->sacarRegistro()) {
?>
	<tr>
		<td><?=$registro[0]?></td>
		<td><?=$registro[1]?></td>
		<td><?=$registro[2]?></td>
		<td><?=$registro[3]?></td>
		<td><?=$registro[4]?></td>
		<td><?=$registro[5]?></td>
	</tr>
<?php
	}
}

function crearXls($arrays){
	$nombre_doc = '';
	$col = 3;
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
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($hoja_activa);

		$col_name_can = count($array[2]);
		$col_name = $array[2];
		$col_campos = $array[1];
		$objetos = $array[0];
		$titulo = $array[3];
		$nombre_doc = $array[4];
		for ($i = 0; $i < $col_name_can; $i++) {
			$objPHPExcel->getActiveSheet()->SetCellValue($col_name[$i].$col, $col_campos[$i]);
			$objPHPExcel->getActiveSheet()->getStyle($col_name[$i].$col)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle($col_name[$i].$col)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle($col_name[$i].$col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);		
			$objPHPExcel->getActiveSheet()->getStyle($col_name[$i].$col)->applyFromArray($styleArray1);
			$objPHPExcel->getActiveSheet()->getColumnDimension($col_name[$i])->setAutoSize(true);
		}
		$col++;
		foreach ($objetos as $objeto) {
			for ($j=0; $j < $col_name_can; $j++) { 
				$objPHPExcel->getActiveSheet()->SetCellValue($col_name[$j].$col, htmlentities($objeto[$j]));
			}
			$col++;
		}
		$styleArray = array(
	  				'borders' => array(
	    				'allborders' => array(
	      					'style' => PHPExcel_Style_Border::BORDER_DOTTED
	    				)
	  				)
		);
		$objPHPExcel->getActiveSheet()->getStyle($col_name[0].'3:'.$col_name[($col_name_can - 1)].($col - 1))->applyFromArray($styleArray);


		$objPHPExcel->getActiveSheet()->setTitle($titulo);
		$hoja_activa++;
		$col = 3;
	}
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename='.$nombre_doc.'.xlsx');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
}
