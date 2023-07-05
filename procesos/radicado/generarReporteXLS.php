<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(0);
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'radicados.class.php';

if (isset($_SESSION['group']) && in_array($_SESSION['group'], ["6", "1", "8", "2", "10"])) {
    if (!isset($_GET['consR']) || $_GET['consR'] != 'download') {
        exit;
    }
    $header = ['# RADICADO', 'TIPO', 'SUCURSAL', 'OFICIAL', 'NIT/CEDULA', 'NOMBRE/RAZON SOCIAL', 'FECHA RADICACION', 'FECHA ENVIO', 'FECHA RECIBIDO', 'ESTADO'];
    $col_name = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    $array[] = [0 => $data, 1 => $header, 2 => $col_name, 3 => 'Reporte Radicados Sucursal', 4 => 'Reporte_radicadosXSucursal'];
    if (isset($_GET['type']) && $_GET['type'] == 'sucur') {
        if ($data = Radicados::clientesDelOficialSucursal($_GET['fecha_inicio'], $_GET['fecha_fin'], $_GET['sucursales'])) {
            crearCsv($header, $data, 'Reporte_radicadosXSucursal');
        }
    } else if ($_GET['type'] == 'ofic') {
        if ($data = Radicados::clientesDelOficialOficial($_GET['fecha_inicio'], $_GET['fecha_fin'], $_GET['oficiales'])) {
            crearXls($array);
        }
    }
}

function crearCsv($header, $data, $nombre) {
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Description: File Transfer");
    header("Content-Encoding: UTF-8");
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=" . $nombre . "_" . date('his') . ".csv");
    header("Expires: 0");
    header("Pragma: public");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $fh = fopen('php://output', 'w');
    fputcsv($fh, $header, ';');
    foreach ($data as $objeto) {
        $objeto['estado'] = getEstados($objeto['estado']);
        $objeto['tipo'] = getTipo($objeto['tipo']);
        fputcsv($fh, $objeto, ';');
    }
    fclose($fh);
    exit;
}

function getEstados($id) {
    $estados = ['Radicado', 'No enviado', 'Recibido', 'Devuelto', 'Cancelado'];
    return $estados[$id] ?? 'Radicado';
}

function getTipo($id) {
    $tipos = ['Fisico', 'Virtual', 'Fisico', 'Financial virtual'];
    return $tipos[$id] ?? 'Fisico';
}

function crearXls($arrays) {
    require_once PATH_CLASS . DS . 'PHPExcel.php';
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
            'color' => array('rgb' => 'EB8F00'),
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
            $objPHPExcel->getActiveSheet()->SetCellValue($col_name[$i] . $col, $col_campos[$i]);
            $objPHPExcel->getActiveSheet()->getStyle($col_name[$i] . $col)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle($col_name[$i] . $col)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
            $objPHPExcel->getActiveSheet()->getStyle($col_name[$i] . $col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $objPHPExcel->getActiveSheet()->getStyle($col_name[$i] . $col)->applyFromArray($styleArray1);
            $objPHPExcel->getActiveSheet()->getColumnDimension($col_name[$i])->setAutoSize(true);
        }
        $col++;
        foreach ($objetos as $objeto) {
            for ($j = 0; $j < $col_name_can; $j++) {
                if ($j == 9)
                    $objPHPExcel->getActiveSheet()->SetCellValue($col_name[$j] . $col, getEstados($objeto[$j]));
                elseif ($j == 1)
                    $objPHPExcel->getActiveSheet()->SetCellValue($col_name[$j] . $col, getTipo($objeto[$j]));
                else
                    $objPHPExcel->getActiveSheet()->SetCellValue($col_name[$j] . $col, $objeto[$j]);
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
        $objPHPExcel->getActiveSheet()->getStyle($col_name[0] . '1:' . $col_name[($col_name_can - 1)] . ($col - 1))->applyFromArray($styleArray);


        $objPHPExcel->getActiveSheet()->setTitle($titulo);
        $hoja_activa++;
        $col = 1;
    }
    $objPHPExcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=' . $nombre_doc . date('dmYHis') . '.xlsx');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit();
}
