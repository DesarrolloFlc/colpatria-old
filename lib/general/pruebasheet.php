<?php
require_once '../../includes.php';
require_once PATH_PHPSHEET.DS.'vendor'.DS.'autoload.php';

/*use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');*/

/*$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load("../ApachePOIImplements/estructura_clientes_prueba.xlsx");
$spreadsheet->getSheet(0);*/




use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$inputFileType = 'Xlsx';
$inputFileName = '../ApachePOIImplements/estructura_clientes_prueba.xlsx';

/**  Create a new Reader of the type defined in $inputFileType  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
/**  Advise the Reader that we only want to load cell data  **/
$reader->setReadDataOnly(true);

$worksheetData = $reader->listWorksheetInfo($inputFileName);
$reader->setLoadSheetsOnly($worksheetData[0]['worksheetName']);
$spreadsheet = $reader->load($inputFileName);

$worksheet = $spreadsheet->getActiveSheet();
$datos = $worksheet->toArray();
$i = 0;
foreach ($datos as $item) {
	echo json_encode($item);
	$i++;
}
?>