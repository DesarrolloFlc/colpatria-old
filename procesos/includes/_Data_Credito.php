<?php

require_once('../../includes.php');
require_once PATH_CLASS . DS . 'PHPExcel.php';
require_once '../../lib/class/client.class.php';

$conn = new Conexion();
$u = new Client();
$temp = file('datacredito/Actualización_de_Información_19012014_datacredito.csv');
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Description: File Transfer");
header("Content-Encoding: UTF-8");
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=getClientesDataCredito_" . date("Y-m-d") . ".csv");
header("Expires: 0");
header("Pragma: public");
echo "\xEF\xBB\xBF"; // UTF-8 BOM

$fh = fopen('php://output', 'w');
fputcsv($fh, array('DOCUMENTO', 'EXITE?', 'SGV', 'CAPI'), ';');
$cexisten = 0;
$csgv = 0;
$ccapi = 0;
$cnoexisten = 0;
$fecha = "2014-01-19"; //enviada por colpatria
$n = count($temp);
for ($i = 1; $i < $n; $i++) {
    $datos_leer = explode(";", $temp[$i]);
    $documento = trim($datos_leer[0]);
    $id = $u->getClientes($documento);
    $id = $id [0];
    if ($id["id"] != "" && $id["id"] != NULL) {
        $cexisten++;
        if ($id["type"] == 'SGV') {
            $csgv++;
        }
        if ($id["capi"] == 'Si') {
            $ccapi++;
        }
        $u->actializaDataCredito($id["id"], $fecha);
        fputcsv($fh, array($documento, 'SI', $id["type"], $id["capi"]), ';');
        
    } else {
        $cnoexisten++;
        fputcsv($fh, array($documento, 'NO', 'NO', 'NO'), ';');
    }
}
fputcsv($fh, array('Existen:', $cexisten, '', ''), ';');
fputcsv($fh, array('No existen:', $cnoexisten, '', ''), ';');
fputcsv($fh, array('C. capi:', $ccapi, '', ''), ';');
fputcsv($fh, array('C. sgv:', $csgv, '', ''), ';');
