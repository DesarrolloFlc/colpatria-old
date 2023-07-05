<?php
if (!isset($_SESSION)) {
	session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
set_time_limit(0);
header("Content-Type: text/html;charset=utf-8");

require_once PATH_CCLASS . DS . 'formulario.php';
require_once PATH_CCLASS . DS . 'radicados2.class.php';
require_once PATH_CCLASS . DS . 'ClientesNuevoRegimen.php';
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\IOFactory as IOFactoryWord;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

function cargueBaseGestorVentasAction($request)
{
	if (isset($request['FILES']['file'])) {
		echo json_encode(['error' => 'No se adjunto archivo, por favor verifique.']);
		exit;
	}
	$file = $request['FILES']['file'];
	$mime = mime_content_type($file['tmp_name']);
	if (isset($file['size']) && $file['size'] >= '52063686') {
		echo json_encode(["error" => "El archivo adjunto no debe ser mayo a 50MB"]);
		exit;
	}
	if (isset($mime) && !in_array($mime, Formulario::MIME_EXCEL)) {
		echo json_encode(["error" => "Esta intentando adjuntar un archivo con un formato diferente al requerido"]);
		exit;
	}

	$tipo = obtenerTipoArchivo($mime);
	if ($tipo == "Csv") {
		$reader = new Csv();
		//$encoding = Csv::guessEncoding($r['FILES']['file']['tmp_name']);
		$reader->setInputEncoding("UTF");
		$reader->setDelimiter("\t");
		$reader->setSheetIndex(0);
	} else {
		$reader = IOFactory::createReader($tipo);
		$reader->setReadDataOnly(true);
	}

	$spreadsheet = $reader->load($file['tmp_name']);

	$objWorksheet = $spreadsheet->getActiveSheet();
	$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
	if (intval($highestRow) > 2001) {
		echo json_encode(['error' => 'La cantidad de registros a cargar excede el límite permitido, por favor verifique.', 'highestRow' => $highestRow, 'type' => gettype($highestRow)]);
		exit;
	}
	$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
	$highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

	if ($highestRow > 1) {
		$radDatos = [
			"tipo" => 4,
			"id_sucursal" => 1000,
			"utc" => "NULL",
			"telefono" => "3364677",
			"extension" => 6607,
			"id_usuarioenvia" => 5833,
			"lote" => "NULL",
			"fecha_recibido" => date('Y-m-d'),
			"id_usuariorecibido" => 5833,
			"estado" => 2,
			"fecha_envio" => date('Y-m-d')
		];
		$rad = new Radicados();
		$rad->setAtributos($radDatos);
		$rad->registrar();
	}

	$fh = fopen(PATH_LOGS . DS . 'cargueBaseGestorVentas_' . date('YmdHis') . '.log', "a");
	$bien = 0;
	$mal = 0;
	for ($row = 2; $row <= $highestRow; ++$row) {
		$nombreCompleto = mb_strtoupper(trim(preg_replace("/\s+/", " ", $objWorksheet->getCellByColumnAndRow(1, $row)->getValue()))); //A
		$tipoDocumentoStr = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(2, $row)->getValue())); //B
		$documento = str_replace(".", "", trim($objWorksheet->getCellByColumnAndRow(3, $row)->getValue())); //C
		$direccionresidencia = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(4, $row)->getValue())); //D

		$celular = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(5, $row)->getValue())); //E
		$profesion = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(6, $row)->getValue())); //F
		$ciiu = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(7, $row)->getValue())); //G
		$codigoIngresos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(8, $row)->getValue())); //H
		$ingresos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(9, $row)->getValue())); //I
		$codigoEgresos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(10, $row)->getValue())); //J
		$egresos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(11, $row)->getValue())); //K
		$codigoActivos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(12, $row)->getValue())); //L
		$activos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(13, $row)->getValue())); //M
		$codigoPasivos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(14, $row)->getValue())); //N
		$pasivos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(15, $row)->getValue())); //O
		$estadocivil = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(16, $row)->getValue())); //P
		$nacionalidad = trim($objWorksheet->getCellByColumnAndRow(17, $row)->getValue()); //Q
		$nivelestudios = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(18, $row)->getValue())); //R
		$vivienda = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(19, $row)->getValue())); //S
		$numerohijos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(20, $row)->getValue())); //T
		$compania = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(21, $row)->getValue())); //U
		$cargo = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(22, $row)->getValue())); //V
		$direccionoficinappal = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(23, $row)->getValue())); //W
		$telefonoficina = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(24, $row)->getValue())); //X
		//$fechanacimiento = date('Y-m-d H:i:s', PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(trim($objWorksheet->getCellByColumnAndRow(25, $row)->getValue())));//Escribir en Excel
		$fechanacimiento = \PhpOffice\PhpSpreadsheet\Style\NumberFormat::toFormattedString(trim($objWorksheet->getCellByColumnAndRow(25, $row)->getValue()), \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD2); //Leer de Excel//Y
		$conceptosotrosingresos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(26, $row)->getValue())); //Z
		$pais_ingresos = mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(27, $row)->getValue())); //AA

		$tipoPersona = '1';
		if ($tipoDocumentoStr == 'NIT')
			$tipoPersona = '2';

		$radItem = [':documento' => $documento, ':descripcion' => $nombreCompleto, ':id_radicados' => $rad->getId(), ':estado' => 2];
		try {
			$rad->agregarItems($radItem);
		} catch (Exception $e1) {
			$mal++;
			fputcsv($fh, ['ERRORITEMRADICADO', $row, json_encode($radItem), $e1->getMessage(), $e1->getCode()], '|');
			continue;
		}


		$cliente_id = Formulario::obtenerIdCliente($documento, $tipoPersona/*, 2*/);
		if (!isset($cliente_id) || empty($cliente_id) || $cliente_id === false) {
			$cliente_id = Formulario::crearNuevoCliente($documento, $tipoPersona, $nombreCompleto/*, 2*/);
		}

		$radForm = [
			':id_client' => $cliente_id,
			':type' => 'FORMULARIO',
			':lote' => 'LOTE_' . $rad->getId(),
			':planilla' => 'PLANILLA',
			':id_user' => 5833,
			':log_planilla' => '0',
			':log_lote' => $rad->getId(),
			':num_images' => '0',
			':marca' => ""
		];
		$rad->agregarForm($radForm);
		$form_id = $rad->getUltimaId();
		//$form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', 'LOTE_'.$rad->getId(), '0', 5833, '0', '');
		//
		$razonsocial = 'SD';
		$nit = '*';
		$primerapellido = 'SD';
		$segundoapellido = 'SD';
		$nombres = 'SD';
		$tipodocumento = '5';
		if ($tipoPersona == '1') {
			$nombre = dividirNombre($nombreCompleto);
			$nombres = $nombre[0];
			$primerapellido = $nombre[1];
			$segundoapellido = $nombre[2];
			$tipodocumento = obtenerTipoDocumento(trim($objWorksheet->getCellByColumnAndRow(2, $row)->getValue()));
		} elseif ($tipoPersona == '2') {
			$razonsocial = $nombreCompleto;
			$nit = $documento;
			$direccionoficinappal = ($direccionoficinappal == 'NULL') ? $direccionresidencia : $direccionoficinappal;
		} else {
		}
		$data = [
			'id_form' => $form_id,
			'fecharadicado' => date("Y-m-d"),
			'fechasolicitud' => date("Y-m-d"),
			'sucursal' => '1000',
			'area' => '1000',
			'lote' => 'LOTE_' . $rad->getId(),
			'formulario' => '18',
			'id_official' => 'USUARIO WEBSERVICE',
			'clasecliente' => '4',
			'primerapellido' => $primerapellido,
			'segundoapellido' => $segundoapellido,
			'nombres' => $nombres,
			'tipodocumento' => $tipodocumento,
			'documento' => $documento,
			'fechaexpedicion' => '0000-00-00',
			'lugarexpedicion' => '99999',
			'fechanacimiento' => $fechanacimiento,
			'nacionalidad' => $rad->obtenerPais($nacionalidad), //(isset($da['nacionalidad']) && !empty($da['nacionalidad'])) ? $da['nacionalidad'] : '249', 
			'numerohijos' => $numerohijos,
			'estadocivil' => obtenerEstadoCivil($estadocivil),
			'direccionresidencia' => $direccionresidencia,
			'telefonoresidencia' => $celular,
			'nombreempresa' => ($compania != 'NULL') ? $compania : 'SD',
			'direccionempresa' => ($direccionoficinappal != 'NULL') ? $direccionoficinappal : 'SD',
			'telefonolaboral' => ($telefonoficina != 'NULL') ? $telefonoficina : '*',
			'celular' => $celular,
			'cargo' => ($cargo != 'NULL') ? $cargo : 'SD',
			'profesion' => '900',
			'ocupacion' => '900',
			'detalleocupacion' => $profesion,
			'ciiu' => $ciiu,
			'ingresosmensuales' => obtenerIngresoEgreso($codigoIngresos),
			'egresosmensuales' => obtenerIngresoEgreso($codigoEgresos),
			'conceptosotrosingresos' => ($conceptosotrosingresos != 'NULL') ? $conceptosotrosingresos : 'SD',
			'nivelestudios' => obtenerNivelEstudio($nivelestudios),
			'tipovivienda' => obtenerTipoVivienda($vivienda),
			'totalactivos' => obtenerActivosPasivos($codigoActivos),
			'totalpasivos' => obtenerActivosPasivos($codigoPasivos),

			'razonsocial' => $razonsocial,
			'nit' => $nit,

			'direccionoficinappal' => ($direccionoficinappal != 'NULL') ? $direccionoficinappal : 'SD',
			'telefonoficina' => ($telefonoficina != 'NULL') ? $telefonoficina : '*',
			'celularoficina' => ($celular != 'NULL') ? $celular : '*',

			'monedaextranjera' => '2',
			'tipotransacciones' => '8',
			'firma' => '2',
			'huella' => '2',
			'lugarentrevista' => 'SD',
			'fechaentrevista' => '0000-00-00',
			'horaentrevista' => '00:00',
			'tipohoraentrevista' => 'SD',
			'resultadoentrevista' => 'APROBADO',
			'observacionesentrevista' => 'SD',
			'nombreintermediario' => 'USUARIO WEBSERVICE',

			'celularoficinappal' => $celular,
			'telefonoficinappal' => $telefonoficina,
			'origen_fondos' => ($conceptosotrosingresos != 'NULL') ? $conceptosotrosingresos : 'SD',
			'procedencia_fondos' => ($conceptosotrosingresos != 'NULL') ? $conceptosotrosingresos : 'SD'
		];
		try {
			$idData = Formulario::insertPrimaryDataNew($form_id, $data, $cliente_id, $rad->conn, 1);
			$bien++;
		} catch (\Exception $e) {
			$mal++;
			fputcsv($fh, ['ERRORDATA', $row, json_encode($data), $e->getMessage(), $e->getCode()], '|');
			//throw new Exception("Ocurrio un error(Exception):".$e->getMessage(), (int)$e->getCode());
			//1970-01-01 02:06:09","nacionalidad":46
		}
	}
	fclose($fh);
	unset($dCar);
	unset($per);
	echo json_encode(array('exito' => 'La carga de la base (gestor de ventas) se realizo satisfactoriamente.<br>Se cargaron ' . $bien . ' registros<br>Se presentaron ' . $mal . ' errores.'));
}
function cargueBaseActualizacionRegimenAction($request)
{
	if (!isset($request['FILES']['file'])) {
		echo json_encode(['error' => 'No se adjunto archivo, por favor verifique.']);
		exit;
	}
	$file = $request['FILES']['file'];
	$mime = mime_content_type($file['tmp_name']);
	if (isset($file['size']) && $file['size'] >= '52063686') {
		echo json_encode(["error" => "El archivo adjunto no debe ser mayo a 50MB"]);
		exit;
	}
	if (isset($mime) && !in_array($mime, Formulario::MIME_EXCEL)) {
		echo json_encode(["error" => "Esta intentando adjuntar un archivo con un formato diferente al requerido"]);
		exit;
	}

	$tipo = obtenerTipoArchivo($mime);
	if ($tipo == "Csv") {
		$reader = new Csv();
		//$encoding = Csv::guessEncoding($r['FILES']['file']['tmp_name']);
		$reader->setInputEncoding("UTF");
		$reader->setDelimiter("\t");
		$reader->setSheetIndex(0);
	} else {
		$reader = IOFactory::createReader($tipo);
		$reader->setReadDataOnly(true);
	}

	$spreadsheet = $reader->load($file['tmp_name']);

	$objWorksheet = $spreadsheet->getActiveSheet();
	$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
	if (intval($highestRow) > 4001) {
		echo json_encode(['error' => 'La cantidad de registros a cargar excede el límite permitido, por favor verifique.', 'highestRow' => $highestRow, 'type' => gettype($highestRow)]);
		exit;
	}
	$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
	$highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

	$fh = fopen(PATH_LOGS . DS . 'cargueBaseActualizacionRegimen_' . date('YmdHis') . '.log', "a");
	$cli = new ClientesNuevoRegimen();
	$errores = 0;
	$exitoso = 0;
	for ($row = 2; $row <= $highestRow; ++$row) {
		$fe = trim($objWorksheet->getCellByColumnAndRow(7, $row)->getValue());
		$fec = ($fe != '' && $fe != '0000-00-00') ? \PhpOffice\PhpSpreadsheet\Style\NumberFormat::toFormattedString($fe, \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD2) : "NULL";
		if (strlen($fec) !== 10 || count(explode('-', $fec)) !== 3)
			$fec = "NULL";
		$dat = [
			'creador_id' => $_SESSION['id'],
			'regimen_str' => mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(1, $row)->getValue())), //A
			'tipo_persona_str' => mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(2, $row)->getValue())), //B
			'tipo_producto' => str_replace(".", "", trim($objWorksheet->getCellByColumnAndRow(3, $row)->getValue())), //C
			'tipodocumento_str' => mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(4, $row)->getValue())), //D
			'numero_documento' => mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(5, $row)->getValue())), //E
			'nombre_completo' => mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(6, $row)->getValue())), //F
			'fecha_expedicion' => $fec, //G
			'regimen_id' => (trim($objWorksheet->getCellByColumnAndRow(8, $row)->getValue()) != '') ? trim($objWorksheet->getCellByColumnAndRow(8, $row)->getValue()) : '0', //H
			'tipodocumento_id' => mb_strtoupper(trim($objWorksheet->getCellByColumnAndRow(9, $row)->getValue())) //I
		];

		$cli->setAtributos($dat);

		try {
			$cli->registrar();
			$exitoso++;
		} catch (\Exception $e) {
			$errores++;
			fputcsv($fh, [$row, json_encode($dat), $e->getMessage(), $e->getCode()], '|');
			//$cli->actualizar();
		}
		$persontype = '1';
		if ($dat['tipodocumento_id'] == '7')
			$persontype = '2';
		if ($cliente_id = Formulario::obtenerIdCliente($dat['numero_documento'], $persontype/*, 2*/)) {
			Formulario::actualizarRegimen($cliente_id, 3/*, 2*/);
		} else {
			$cliente_id = Formulario::crearNuevoCliente($dat['numero_documento'], $persontype, $dat['nombre_completo'], 2, 3/*, 2*/);
		}
		unset($dat);
	}
	$mensajeErrores = '';
	if (!empty($errores)) {
		$mensajeErrores = '<br>Pero se presentaron ' . $errores . ' errores al cargar la base';
	}
	fclose($fh);
	echo json_encode(['exito' => 'La carga de la base (Actualizacion de regimen) se realizo satisfactoriamente<br>Se cargaron ' . $exitoso . ' registros.' . $mensajeErrores]);
}
function cargueEvidenciaWordAction($request)
{
	if (!isset($request['FILES']['file'])) {
		echo json_encode(['error' => 'No se adjunto archivo, por favor verifique.']);
		exit;
	}
	$file = $request['FILES']['file'];
	$mime = mime_content_type($file['tmp_name']);
	if (isset($file['size']) && $file['size'] >= '52063686') {
		echo json_encode(["error" => "El archivo adjunto no debe ser mayo a 50MB"]);
		exit;
	}
	if (isset($mime) && !in_array($mime, ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf'])) {
		echo json_encode(["error" => "Esta intentando adjuntar un archivo con un formato diferente al requerido"]);
		exit;
	}
	$ext = obtenerTipoArchivoWord($mime);
	$fileName = $request['radicado_item_id'] . "_" . $request['documento'] . "_" . date('Ymd') . ".";

	if (!file_exists(PATH_EVIDENCIAS . DS . $request['documento'])) {
		mkdir(PATH_EVIDENCIAS . DS . $request['documento'], 0777, true);
	}

	if (!move_uploaded_file($file['tmp_name'], PATH_EVIDENCIAS . DS . $request['documento'] . DS . $fileName . $ext)) {
		echo json_encode(['error'=> 'Ocurrio un error al momento de cargar el archivo, por favor contacte con el administrador']);
		exit;
	}
	$file = $fileName . $ext;
	$message = "";
	if ($mime !== 'application/pdf') {
		try {
			Settings::setPdfRendererPath(PATH_COMPOSER . DS . 'vendor' . DS . 'tecnickcom' . DS . 'tcpdf');
			Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
			$temDoc = PATH_EVIDENCIAS . DS . $request['documento'] . DS . $fileName . $ext;
			$phpWord = IOFactoryWord::load($temDoc);
			$xmlWriter = IOFactoryWord::createWriter($phpWord, 'PDF');
			$xmlWriter->save(PATH_EVIDENCIAS . DS . $request['documento'] . DS . $fileName . "pdf");
			unlink($temDoc);
			$file = $fileName . "pdf";
		} catch (\Exception $ef) {
			$message = "<br>Ocurrio una excepcion al momento de convertir el archivo de WORD a PDF, por favor contacte con el administrador<br>" . $ef->getMessage();
		}
	}
	$resp = true;
	try {
		$resp = Formulario::agregarEvidenciaItemRadicado($request['radicado_item_id'], $request['resultado'], $request['documento'], $file);
	} catch (\Exception $e) {
		if ((int) $e->getCode() !== 23000) {
			echo json_encode(['error'=> 'Ocurrio una excepcion al momento de guardar el registro de la evidencia, por favor contacte con el administrador<br>' . $e->getMessage()]);
			exit;
		}
	}
	if (!$resp) {
		echo json_encode(['error'=> 'Ocurrio un error al momento de guardar el registro de la evidencia, por favor contacte con el administrador']);
		exit;
	}
	echo json_encode(['exito'=> 'La carga del archivo se realizo satisfactoriamente.' . $message]);
}
function eliminarEvidenciaWordAction($request)
{
	if ((!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1"]))) {
		echo json_encode(['error'=> 'Usted no cuenta con sesion activa, o cuenta con los permisos necesario para realizar esta accion, contacte con el administrador.']);
		exit;
	}
	if (!isset($request['radicado_item_id']) || empty($request['radicado_item_id'])) {
		echo json_encode(['error'=> 'No se recibio el identificador del cliente a quien pertenece la evidencia, por favor verifique']);
		exit;
	}
	$conn = new Conexion();
	if (!$conn->consultar("SELECT * FROM radicado_item_evidencias WHERE radicado_item_id = :radicado_item_id", [':radicado_item_id'=> $request['radicado_item_id']])) {
		echo json_encode(['error'=> 'No se encontro registro para eliminar, por favor verifique.']);
		exit;
	}
	if ($conn->getNumeroRegistros() !== 1) {
		echo json_encode(['error'=> 'El registro a eliminar no genero resultados, verifique por favor.']);
		exit;
	}
	$row = $conn->sacarRegistro('str');
	if (!$conn->ejecutar("DELETE FROM radicado_item_evidencias WHERE radicado_item_id = :radicado_item_id", [':radicado_item_id'=> $request['radicado_item_id']])) {
		echo json_encode(['error'=> 'Ocurrio un error al momento de eliminar el registro, contacte con el administrador.']);
		exit;
	}
	$part = explode('/', $row['directorio']);
	$cliente = $part[(count($part) - 1)];
	$mensaje = "";
	if (!unlink(PATH_EVIDENCIAS . DS . $cliente . DS . $row['archivo'])) {
		$mensaje = "<br>Pero el archivo de la evidencia no se pudo eliminar.";
	}
	echo json_encode(['exito'=> 'Se realizo la eliminacion de la evidencia correctamente.' . $mensaje]);
}
function verEvidenciaAction($request)
{
	if (!isset($request['radicado_item_id']) || empty($request['radicado_item_id'])) {
		echo json_encode(['error'=> 'No se recibio el identificador del cliente a quien pertenece la evidencia, por favor verifique']);
		exit;
	}
	$conn = new Conexion();
	if (!$conn->consultar("SELECT * FROM radicado_item_evidencias WHERE radicado_item_id = :radicado_item_id", [':radicado_item_id'=> $request['radicado_item_id']])) {
		echo json_encode(['error'=> 'No se encontro registro para eliminar, por favor verifique.']);
		exit;
	}
	if ($conn->getNumeroRegistros() !== 1) {
		echo json_encode(['error'=> 'El registro a eliminar no genero resultados, verifique por favor.']);
		exit;
	}
	$row = $conn->sacarRegistro('str');
	$part = explode('/', $row['directorio']);
	$cliente = $part[(count($part) - 1)];
	$row['cliente'] = $cliente;

	$row['full_path'] = PATH_EVIDENCIAS . DS . $cliente . DS . $row['archivo'];
	$row['path'] = PATH_EVIDENCIAS_PATH . DS . $cliente . DS . $row['archivo'];

	$row['mime'] = mime_content_type($row['full_path']);
	$row['extension'] = obtenerTipoArchivoWord($row['mime']);

	echo json_encode(['exito'=> 'Se encontro la evidencia', 'item'=> $row]);
}
function obtenerTipoDocumento($texto)
{
	if (strtolower($texto) == 'cedula ciudadanía' || strtolower($texto) == 'cedula ciudadania')
		return '1';
	elseif (strtolower($texto) == 'cedula extranjería' || strtolower($texto) == 'cedula extranjeria')
		return '3';
	elseif (strtolower($texto) == 'documento identidad')
		return '8';
	elseif (strtolower($texto) == 'nit')
		return '7';
	elseif (strtolower($texto) == 'pasaporte')
		return '10';
	elseif (strtolower($texto) == 'tarjeta identidad')
		return '2';
	else
		return '5';
}
function dividirNombre($texto)
{
	$noms = explode(' ', $texto);
	$cant = count($noms);
	switch ($cant) {
		case 1:
			return [$texto, '', ''];
			break;
		case 2:
			return [trim($noms[0]), trim($noms[1]), ''];
			break;
		case 3:
			return [trim($noms[0]), trim($noms[1]), trim($noms[2])];
			break;
		case 4:
			return [trim($noms[0]) . ' ' . trim($noms[1]), trim($noms[2]), trim($noms[3])];
			break;

		default:
			$nom = ['', trim($noms[($cant - 2)]), trim($noms[($cant - 1)])];
			for ($i = 0; $i < ($cant - 2); $i++) {
				if ($i == 0)
					$nom[0] = trim($noms[$i]);
				else
					$nom[0] .= ' ' . trim($noms[$i]);
			}
			return $nom;
			break;
	}
}
function obtenerEstadoCivil($texto)
{
	if (strtolower($texto) == 'casado')
		return '2';
	elseif (strtolower($texto) == 'divorciado')
		return '6';
	elseif (strtolower($texto) == 'soltero')
		return '1';
	elseif (strtolower($texto) == 'viudo')
		return '4';
	elseif (strtolower($texto) == 'separado')
		return '3';
	elseif (strtolower($texto) == 'union libre')
		return '5';
	else
		return '7';
}
function obtenerNivelEstudio($texto)
{
	if (strtolower($texto) == 'especialización' || strtolower($texto) == 'especializacion')
		return '5';
	elseif (strtolower($texto) == 'primaria')
		return '2';
	elseif (strtolower($texto) == 'secundaria')
		return '3';
	elseif (strtolower($texto) == 'universitaria')
		return '4';
	elseif (strtolower($texto) == 'posgrado')
		return '7';
	else
		return '6';
}
function obtenerTipoVivienda($texto)
{
	if (strtolower($texto) == 'vivienda arrendada' || strtolower($texto) == 'arrendada')
		return '2';
	elseif (strtolower($texto) == 'vivienda familiar' || strtolower($texto) == 'familiar')
		return '3';
	elseif (strtolower($texto) == 'vivienda propia' || strtolower($texto) == 'propia')
		return '1';
	else
		return '5';
}
function obtenerIngresoEgreso($codigo)
{
	switch ($codigo) {
		case '1':
		case '4':
			return 3;
			break;
		case '2':
		case '5':
			return 14;
			break;
		case '3':
		case '6':
			return 5;
			break;
		case '39':
		case '42':
			return 7;
			break;
		case '40':
		case '41':
		case '43':
		case '44':
			return 9;
			break;

		default:
			return 13;
			break;
	}
}
function obtenerActivosPasivos($codigo)
{
	switch ($codigo) {
		case '1':
		case '18':
		case '67':
			//return '9999999';
			return '10000000';
			break;
		case '2':
		case '19':
		case '68':
			//return '25000000';
			return '40000000';
			break;
		case '3':
		case '20':
		case '69':
			return '100000000';
			break;
		case '4':
		case '21':
		case '70':
			return '300000000';
			break;
		case '5':
		case '22':
		case '71':
			return '300000001';
			break;

		default:
			return '*';
			break;
	}
}
function descargaEstructuraAction($request)
{
	switch ($request['tipo']) {
		case '1':
			$file = 'estructura_cargue_gestor_ventas.xlsx';
			break;
		case '2':
			$file = 'estructura_cargue_datacredito.xlsx';
			break;
		case '3':
			$file = 'estructura_cargue_cambio_regimen.xlsx';
			break;

		default:
			$file = 'estructura_cargue_gestor_ventas.xlsx';
			break;
	}

	$path = PATH_INCLUDES . DS . $file;
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename=' . $file);
	header('Pragma: no-cache');
	readfile($path);
}
function obtenerTipoArchivo($tipo)
{
	$tipos = [
		'text/plain' => "Csv",
		'application/vnd.ms-excel' => "Csv",
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => "Xlsx",
	];
	return $tipos[$tipo] ?? "Csv";
}
function obtenerTipoArchivoWord($tipo)
{
	$tipos = [
		'application/msword'=> 'doc',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document'=> 'docx',
		'application/vnd.ms-fontobject'=> 'eot',
		'application/epub+zip'=> 'epub',
		'application/pdf'=> 'pdf',
	];
	return $tipos[$tipo] ?? 'docx';
}
