<?php
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CLASS . DS . '_conexion.php';
require_once PATH_CCLASS . DS . 'client.class.php';

if (!isset($_POST['fecha_inicio']) || !isset($_POST['fecha_fin']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_fin'])) {
	echo "<script>parent.alert('Error, La fecha de inicio o fecha de fin no pueden ser vacias.');</script>";
	exit;
}
$comp = "";
if (!empty($_POST['tipo_documento'])) {
	$comp .= " AND t_1.tipodocumento = " . $_POST['tipo_documento'];
}
if ($_POST['tipo_marca'] == 1) {
	$comp .= " AND (t_1.paisnacimiento != 'CO' OR t_1.nacionalidad_otra != 'CO' OR t_1.obligaciones_pais != 'CO')";
} else if ($_POST['tipo_marca'] == 2) {
	$comp .= " AND t_1.monedaextranjera = 'SI'";
} else if ($_POST['tipo_marca'] == 3) {
	$comp .= " AND (t_1.formato_paisn = 1 OR t_1.formato_nacio = 1 OR t_1.formato_oblip = 1)";
}
$datos = generarDataReporte($_POST['fecha_inicio'], $_POST['fecha_fin'], $comp);
if ($datos === false) {
	echo "<script>parent.alert('Ocurrio un error al momento de generar los datos del reporte, por favor contacte con el administrador.');</script>";
	exit;
}
if (!is_array($datos) || empty($datos)) {
	echo "<script>parent.alert('No se encontraron registros para la busqueda con los parametros especificados.');</script>";
	exit;
}
$ultimoestado = "";
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Description: File Transfer");
header("Content-Encoding: UTF-8");
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=reportCallSpecial" . date('his') . ".csv");
header("Expires: 0");
header("Pragma: public");
echo "\xEF\xBB\xBF"; // UTF-8 BOM

$fh = fopen('php://output', 'w');
fputcsv($fh, array('Tipo de persona', 'Sucursal', 'Area', 'Funcionario', 'Planilla', 'Lote Colpatria', 'Marca', 'Tipo de Cliente',
	'Tipo Identificación', 'Nombre y/o Razón Social', 'Documento', 'Nro. ID', 'Digito de Chequeo', 'Fecha de Radicacion Colpatria',
	'Fecha Envio Real Colpatria', 'Fecha de Aprobacion', 'Fecha Solicitud FCC', 'Fecha de Digitacion F',
	'Tipo de Actividad Persona Juridica', 'Detalle Actividad Economica', 'Tipo de Empresa Jurídica', 'Profesion', 'Ocupacion',
	'Detalle Ocupacion', 'No de hijos', 'Genero', 'Estrato', 'Estado Civil', 'Nivel Estudios', 'Cargo',
	'Tipo de Actividad Persona Natural', 'Detalle Tipo de Actividad Persona Natural', 'Fecha Nacimiento',
	'Lugar Nacimiento', 'Fecha Expedicion', 'Lugar Expedicion', 'Nacionalidad', 'Ciudad Residencia',
	'Direccion residencia y/o persona jurídica', 'Nomenclatura', 'Telefono Residencia y/o PJ', 'Telefono Laboral',
	'Celular', 'Celular Oficina', 'Fax', 'Correo electronico', 'Empresa donde labora', 'Ciiu', 'Ciudad Laboral',
	'Tipo Empresa Juridica', 'Tipo Vivienda', 'Ingresos Mensuales', 'Egresos mensuales', 'Otros ingresos',
	'Concepto Otros Ingresos', 'Activos', 'Pasivos', 'Transacciones en Moneda Extranjera', 'Tipo de Transacciones',
	'Nombre Representante Legal', 'Tipo de Documento Representante Legal', 'Documento Representante Legal',
	'Huella Verificada con documento de identificación', 'Firma', 'Entrevista', 'Lugar Entrevista', 'Fecha Entrevista',
	'Hora de Entrevista', 'Resultado Entrevista', 'Intermediario Entrevista', 'Usuario', 'Estado', //ACA INICIO NUEVOS
	'Pais de nacimiento', 'Otra nacionalidad?', 'Otra nacionalidad', 'Productos en el exterior?', 'Cuentas en moneda extranjera?', 
	'Obligaciones en otro pais?', 'Pais de otras obligaciones', 'Formato pais nacimiento', 'Formato nacionalidad', 'Formato obligaciones otro pais', 
	'Cliente FATCA?', 'Tipo de producto 1', 'Identificacion producto 1', 'Entidad 1', 'Monto1', 'Pais 1', 'Ciudad 1', 'Moneda 1', 
	'Tipo de producto 2', 'Identificacion producto 2', 'Entidad 2', 'Monto2', 'Pais 2', 'Ciudad 2', 'Moneda 2', 
	'Tipo id 1', 'Numero id 1', 'Nombre 1', 'Admin recursos publicos? 1', 'Grado porde publico? 1', 'Reconocimientos publicos? 1', 'Declaracion tributaria en otro pais? 1', 'Cual pais 1', 
	'Tipo id 2', 'Numero id 2', 'Nombre 2', 'Admin recursos publicos? 2', 'Grado porde publico? 2', 'Reconocimientos publicos? 2', 'Declaracion tributaria en otro pais? 2', 'Cual pais 2', 
	'Tipo id 3', 'Numero id 3', 'Nombre 3', 'Admin recursos publicos? 3', 'Grado porde publico? 3', 'Reconocimientos publicos? 3', 'Declaracion tributaria en otro pais? 3', 'Cual pais 3', 
	'Tipo id 4', 'Numero id 4', 'Nombre 4', 'Admin recursos publicos? 4', 'Grado porde publico? 4', 'Reconocimientos publicos? 4', 'Declaracion tributaria en otro pais? 4', 'Cual pais 4', 
	'Tipo id 5', 'Numero id 5', 'Nombre 5', 'Admin recursos publicos? 5', 'Grado porde publico? 5', 'Reconocimientos publicos? 5', 'Declaracion tributaria en otro pais? 5', 'Cual pais 5'), ';');
	//paisnacimiento, nacionalidad_otra, nacionalidad_cual, productos_exterior, cuentas_monedaextranjera, obligaciones_otropais, 
	//obligaciones_pais, otrosingresosemp, concepto_otrosingresosemp, formato_paisn, formato_nacio, formato_oblip,
	//tipo, identificacion_producto, entidad, monto, pais, ciudad, moneda, 
	//tipo_id, identificacion, nombre_accionista, publico_recursos, publico_grado, publico_reconocimiento, declaracion_tributaria, declaracion_pais
foreach($datos as $dato){
	$client = new Client();
	$i_a = [];//INFORMACION ARRAY
	if($dato['persontype'] == 1){//PERSONA NATURAL
		//NOMBRE COMPLETO
		$nom_com = trim($dato['nombres'].' '.trim($dato['primerapellido']).' '.trim($dato['segundoapellido']));
		//FECHA RADICADION COLPATRIA
		$fecha_rad_col = $dato['fecha_rad_col'];
		if(is_null($dato['fecha_rad_col']) || empty($dato['fecha_rad_col']) || $dato['fecha_rad_col'] == '0000-00-00')
			$fecha_rad_col = '2013-06-05';
		//FECHA ENVIO REAL COLPATRIA
		$fecha_envio = $dato['fecha_envio'];
		if(is_null($dato['fecha_envio']) || empty($dato['fecha_envio']) || $dato['fecha_envio'] == '0000-00-00')
			$fecha_envio = '2013-06-12';
		//FECHA DE APROBACION
		$fecha_recibido = $dato['fecha_recibido'];
		if(is_null($dato['fecha_recibido']) || empty($dato['fecha_recibido']) || $dato['fecha_recibido'] == '0000-00-00')
			$fecha_recibido = '2013-06-12';
		//FECHA DE DIGITACION F
		$date_created = $dato['date_created'];
		if(empty($dato['date_created']))
			$date_created = 'SD';
		//TIPO DE ACTIVIDAD ECONOMICA PERSONA JURIDICA
		$act_eco_prin = $dato['act_eco_prin'];
		if(is_null($dato['act_eco_prin']) || empty($dato['act_eco_prin']) || $dato['act_eco_prin'] == '0')
			$act_eco_prin = 'NA';
		//NACIONALIDAD
		$nacionalidad = $dato['nacionalidad'];
		//ESTADO
		$ultimoestado = $client->getEstadoInformacion($dato['client_id']);
		//LUGAR NACIMIENTO
		$lugarnacimiento = '';
		//
		$nacionalidad_otra = 'SD';
		if ($dato['nacionalidad_otra'] == '1')
			$nacionalidad_otra = 'SI';
		else if ($dato['nacionalidad_otra'] == '2')
			$nacionalidad_otra = 'NO';
		//
		$productos_exterior = 'SD';
		if ($dato['productos_exterior'] == '1')
			$productos_exterior = 'SI';
		else if ($dato['productos_exterior'] == '2')
			$productos_exterior = 'NO';
		//
		$cuentas_monedaextranjera = 'SD';
		if ($dato['cuentas_monedaextranjera'] == '1')
			$cuentas_monedaextranjera = 'SI';
		else if ($dato['cuentas_monedaextranjera'] == '2')
			$cuentas_monedaextranjera = 'NO';
		//
		$obligaciones_otropais = 'SD';
		if ($dato['obligaciones_otropais'] == '1')
			$obligaciones_otropais = 'SI';
		else if ($dato['obligaciones_otropais'] == '2')
			$obligaciones_otropais = 'NO';
		//
		$formato_paisn = 'SD';
		if ($dato['formato_paisn'] == '1')
			$formato_paisn = 'Recalcitrante';
		else if ($dato['formato_paisn'] == '8')
			$formato_paisn = 'Formato W8';
		else if ($dato['formato_paisn'] == '9')
			$formato_paisn = 'Formato W9';
		//
		$formato_nacio = 'SD';
		if ($dato['formato_nacio'] == '1')
			$formato_nacio = 'Recalcitrante';
		else if ($dato['formato_nacio'] == '8')
			$formato_nacio = 'Formato W8';
		else if ($dato['formato_nacio'] == '9')
			$formato_nacio = 'Formato W9';
		//
		$formato_oblip = 'SD';
		if ($dato['formato_oblip'] == '1')
			$formato_oblip = 'Recalcitrante';
		else if ($dato['formato_oblip'] == '8')
			$formato_oblip = 'Formato W8';
		else if ($dato['formato_oblip'] == '9')
			$formato_oblip = 'Formato W9';
		//
		$cliente_fatca = 'No';
		if((!is_null($dato['paisnacimiento']) && $dato['paisnacimiento'] != 'CO' && $dato['paisnacimiento'] != 'SD') || (!is_null($dato['nacionalidad_otra']) && $dato['nacionalidad_otra'] != 'CO' && $dato['nacionalidad_otra'] != 'SD') || (!is_null($dato['obligaciones_pais']) && $dato['obligaciones_pais'] != 'CO' && $dato['obligaciones_pais'] != 'SD'))
			$cliente_fatca = 'Si';
		$i_a = array(
			'NATURAL', $dato['sucursal'], $dato['area'], $dato['id_official'], $dato['log_planilla'], $dato['log_lote'], $dato['marca'], 
			$dato['tipo_cliente'], $dato['tipo_identificacion'], $nom_com, $dato['document'], $dato['document'], 'NA', 
			$fecha_rad_col, $fecha_envio, $fecha_recibido, $dato['fechasolicitud'], $date_created, $act_eco_prin, 'NA', 'NA', $dato['profesion'], 
			$dato['ocupacion'], $dato['detalleocupacion'], $dato['numerohijos'], $dato['sexo'], $dato['estrato'], $dato['estado_civil'], 
			$dato['estudios'], $dato['cargo'], $dato['tipoactividad'], $dato['detalletipoactividad'], $dato['fechanacimiento'], 
			$dato['lugarnacimiento'], $dato['fechaexpedicion'], $dato['lugarexpedicion'], $nacionalidad, $dato['ciudadresidencia'], 
			$dato['direccionresidencia'], $dato['nomenclatura'], (empty($dato['telefonoresidencia']) ? '0' : $dato['telefonoresidencia']), 
			(empty($dato['telefonolaboral']) ? '0' : $dato['telefonolaboral']), (empty($dato['celular']) ? '0' : $dato['celular']), 
			(empty($dato['celularoficina']) ? '0' : $dato['celularoficina']), (empty($dato['faxoficina']) ? '0' : $dato['faxoficina']), 
			(empty($dato['correoelectronico']) ? 'SD' : $dato['correoelectronico']), $dato['nombreempresa'], (empty($dato['ciiu']) ? 'SD' : $dato['ciiu']), 
			'NA', 'NA', $dato['tipovivienda'], $dato['ingresosmensuales'], $dato['egresosmensuales'], $dato['otrosingresos'], 
			$dato['conceptosotrosingresos'], $dato['totalactivos'], $dato['totalpasivos'], $dato['monedaextranjera'], 'NA', 'NA', 'NA', 'NA', 
			$dato['huella'], $dato['firma'], $dato['entrevista'], $dato['lugarentrevista'], $dato['fechaentrevista'], $dato['hora_entrevista'], 
			$dato['resultadoentrevista'], $dato['nombreintermediario'], $dato['usuario'], $ultimoestado, 
			$dato['paisnacimiento'], $nacionalidad_otra, $dato['nacionalidad_cual'], $productos_exterior, $cuentas_monedaextranjera, $obligaciones_otropais, 
			$dato['obligaciones_pais'], $formato_paisn, $formato_nacio, $formato_oblip, $cliente_fatca,
			(isset($dato['productos'][0]['tipo']) ? $dato['productos'][0]['tipo'] : ''), (isset($dato['productos'][0]['identificacion_producto']) ? $dato['productos'][0]['identificacion_producto'] : ''), 
			(isset($dato['productos'][0]['entidad']) ? $dato['productos'][0]['entidad'] : ''), (isset($dato['productos'][0]['monto']) ? $dato['productos'][0]['monto'] : ''),
			(isset($dato['productos'][0]['pais']) ? $dato['productos'][0]['pais'] : ''), (isset($dato['productos'][0]['ciudad']) ? $dato['productos'][0]['ciudad'] : ''), 
			(isset($dato['productos'][0]['moneda']) ? $dato['productos'][0]['moneda'] : ''),
			(isset($dato['productos'][1]['tipo']) ? $dato['productos'][1]['tipo'] : ''), (isset($dato['productos'][1]['identificacion_producto']) ? $dato['productos'][1]['identificacion_producto'] : ''), 
			(isset($dato['productos'][1]['entidad']) ? $dato['productos'][1]['entidad'] : ''), (isset($dato['productos'][1]['monto']) ? $dato['productos'][1]['monto'] : ''),
			(isset($dato['productos'][1]['pais']) ? $dato['productos'][1]['pais'] : ''), (isset($dato['productos'][1]['ciudad']) ? $dato['productos'][1]['ciudad'] : ''), 
			(isset($dato['productos'][1]['moneda']) ? $dato['productos'][1]['moneda'] : '')

		);
	}else if ($dato['persontype'] == 2) {//PERSONA JURIDICA
		//NOMBRE COMPLETO
		$nom_com = trim($dato['nombres'].' '.trim($dato['primerapellido']).' '.trim($dato['segundoapellido']));
		//FECHA RADICADION COLPATRIA
		$fecha_rad_col = $dato['fecha_rad_col'];
		if(is_null($dato['fecha_rad_col']) || empty($dato['fecha_rad_col']) || $dato['fecha_rad_col'] == '0000-00-00')
			$fecha_rad_col = '2013-06-05';
		//FECHA ENVIO REAL COLPATRIA
		$fecha_envio = $dato['fecha_envio'];
		if(is_null($dato['fecha_envio']) || empty($dato['fecha_envio']) || $dato['fecha_envio'] == '0000-00-00')
			$fecha_envio = '2013-06-12';
		//FECHA DE APROBACION
		$fecha_recibido = $dato['fecha_recibido'];
		if(is_null($dato['fecha_recibido']) || empty($dato['fecha_recibido']) || $dato['fecha_recibido'] == '0000-00-00')
			$fecha_recibido = '2013-06-12';
		//FECHA DE DIGITACION F
		$date_created = $dato['date_created'];
		if(empty($dato['date_created']))
			$date_created = 'SD';
		//TIPO DE ACTIVIDAD ECONOMICA PERSONA JURIDICA
		$act_eco_prin = $dato['act_eco_prin'];
		if(is_null($dato['act_eco_prin']) || empty($dato['act_eco_prin']) || $dato['act_eco_prin'] == '0')
			$act_eco_prin = 'NA';
		//ESTADO
		$ultimoestado = $client->getEstadoInformacion($dato['client_id']);
		//
		$productos_exterior = 'SD';
		if ($dato['productos_exterior'] == '1')
			$productos_exterior = 'SI';
		else if ($dato['productos_exterior'] == '2')
			$productos_exterior = 'NO';
			
		//
		$cuentas_monedaextranjera = 'SD';
		if ($dato['cuentas_monedaextranjera'] == '1')
			$cuentas_monedaextranjera = 'SI';
		else if ($dato['cuentas_monedaextranjera'] == '2')
			$cuentas_monedaextranjera = 'NO';
			
		//
		$formato_oblip = 'SD';
		if ($dato['formato_oblip'] == '1')
			$formato_oblip = 'Recalcitrante';
		else if ($dato['formato_oblip'] == '8')
			$formato_oblip = 'Formato W8';
		else if ($dato['formato_oblip'] == '9')
			$formato_oblip = 'Formato W9';
			
		//
		$cliente_fatca = 'No';
		if ((!is_null($dato['obligaciones_pais']) && $dato['obligaciones_pais'] != 'CO' && $dato['obligaciones_pais'] != 'SD')) $cliente_fatca = 'Si';
		$i_a = [
			'JURIDICO', 
			$dato['sucursal'], 
			$dato['area'], 
			$dato['id_official'], 
			$dato['log_planilla'], 
			$dato['log_lote'], 
			$dato['marca'], 
			$dato['tipo_cliente'], 
			'NIT', 
			$dato['razonsocial'], 
			$dato['document'], 
			$dato['document'], 
			$dato['digitochequeo'], 
			$fecha_rad_col, 
			$fecha_envio, 
			$fecha_recibido, 
			$dato['fechasolicitud'], 
			$date_created, $act_eco_prin, 
			$dato['detalleactividadeconomicappal'], 
			$dato['tipo_emp'], 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			$dato['ciudadoficina'], 
			$dato['direccionoficinappal'], 
			$dato['nomenclatura'], 
			(empty($dato['telefonoresidencia']) ? '0' : $dato['telefonoresidencia']), 
			(empty($dato['telefonoficina']) ? '0' : $dato['telefonoficina']), 
			(empty($dato['celular']) ? '0' : $dato['celular']), 
			(empty($dato['celularoficina']) ? '0' : $dato['celularoficina']), 
			(empty($dato['faxoficina']) ? '0' : $dato['faxoficina']), 
			(empty($dato['correoelectronico']) ? 'SD' : $dato['correoelectronico']), 
			'NA', 
			(empty($dato['ciiu']) ? 'SD' : $dato['ciiu']), 
			$dato['ciudadoficina'], 
			$dato['tipoempresaemp'], 
			'NA', 
			$dato['ingresosmensualesemp'], 
			$dato['egresosmensualesemp'], 
			$dato['otrosingresosemp'], 
			$dato['concepto_otrosingresosemp'], 
			$dato['activosemp'], 
			$dato['pasivosemp'], 
			$dato['monedaextranjera'], 
			$dato['tipotransacciones'], 
			$nom_com, 
			$dato['tipo_identificacion'], 
			$dato['documento'], 
			$dato['huella'], 
			$dato['firma'], 
			$dato['entrevista'], 
			$dato['lugarentrevista'], 
			$dato['fechaentrevista'], 
			$dato['hora_entrevista'], 
			$dato['resultadoentrevista'], 
			$dato['nombreintermediario'], 
			$dato['usuario'], 
			$ultimoestado, 
			'NA', 
			'NA', 
			'NA', 
			$productos_exterior, 
			$cuentas_monedaextranjera, 
			'NA', 
			'NA', 
			'NA', 
			'NA', 
			$formato_oblip, 
			$cliente_fatca,
			(isset($dato['productos'][0]['tipo']) ? $dato['productos'][0]['tipo'] : ''), 
			(isset($dato['productos'][0]['identificacion_producto']) ? $dato['productos'][0]['identificacion_producto'] : ''), 
			(isset($dato['productos'][0]['entidad']) ? $dato['productos'][0]['entidad'] : ''), 
			(isset($dato['productos'][0]['monto']) ? $dato['productos'][0]['monto'] : ''),
			(isset($dato['productos'][0]['pais']) ? $dato['productos'][0]['pais'] : ''), 
			(isset($dato['productos'][0]['ciudad']) ? $dato['productos'][0]['ciudad'] : ''), 
			(isset($dato['productos'][0]['moneda']) ? $dato['productos'][0]['moneda'] : ''),
			(isset($dato['productos'][1]['tipo']) ? $dato['productos'][1]['tipo'] : ''), 
			(isset($dato['productos'][1]['identificacion_producto']) ? $dato['productos'][1]['identificacion_producto'] : ''), 
			(isset($dato['productos'][1]['entidad']) ? $dato['productos'][1]['entidad'] : ''), 
			(isset($dato['productos'][1]['monto']) ? $dato['productos'][1]['monto'] : ''),
			(isset($dato['productos'][1]['pais']) ? $dato['productos'][1]['pais'] : ''), 
			(isset($dato['productos'][1]['ciudad']) ? $dato['productos'][1]['ciudad'] : ''), 
			(isset($dato['productos'][1]['moneda']) ? $dato['productos'][1]['moneda'] : ''),
			(isset($dato['socios'][0]['tipo']) ? $dato['socios'][0]['tipo'] : ''), 
			(isset($dato['socios'][0]['identificacion']) ? $dato['socios'][0]['identificacion'] : ''),
			(isset($dato['socios'][0]['nombre_accionista']) ? $dato['socios'][0]['nombre_accionista'] : ''), 
			(isset($dato['socios'][0]['publico_recursos']) ? (($dato['socios'][0]['publico_recursos'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][0]['publico_grado']) ? (($dato['socios'][0]['publico_grado'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][0]['publico_reconocimiento']) ? (($dato['socios'][0]['publico_reconocimiento'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][0]['declaracion_tributaria']) ? (($dato['socios'][0]['declaracion_tributaria'] == '1') ? 'Si' : 'No'): ''),
			(isset($dato['socios'][0]['declaracionpais']) ? $dato['socios'][0]['declaracionpais'] : ''),
			(isset($dato['socios'][1]['tipo']) ? $dato['socios'][1]['tipo'] : ''), 
			(isset($dato['socios'][1]['identificacion']) ? $dato['socios'][1]['identificacion'] : ''),
			(isset($dato['socios'][1]['nombre_accionista']) ? $dato['socios'][1]['nombre_accionista'] : ''), 
			(isset($dato['socios'][1]['publico_recursos']) ? (($dato['socios'][1]['publico_recursos'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][1]['publico_grado']) ? (($dato['socios'][1]['publico_grado'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][1]['publico_reconocimiento']) ? (($dato['socios'][1]['publico_reconocimiento'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][1]['declaracion_tributaria']) ? (($dato['socios'][1]['declaracion_tributaria'] == '1') ? 'Si' : 'No'): ''),
			(isset($dato['socios'][1]['declaracionpais']) ? $dato['socios'][1]['declaracionpais'] : ''),
			(isset($dato['socios'][2]['tipo']) ? $dato['socios'][2]['tipo'] : ''), 
			(isset($dato['socios'][2]['identificacion']) ? $dato['socios'][2]['identificacion'] : ''),
			(isset($dato['socios'][2]['nombre_accionista']) ? $dato['socios'][2]['nombre_accionista'] : ''), 
			(isset($dato['socios'][2]['publico_recursos']) ? (($dato['socios'][2]['publico_recursos'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][2]['publico_grado']) ? (($dato['socios'][2]['publico_grado'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][2]['publico_reconocimiento']) ? (($dato['socios'][2]['publico_reconocimiento'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][2]['declaracion_tributaria']) ? (($dato['socios'][2]['declaracion_tributaria'] == '1') ? 'Si' : 'No'): ''),
			(isset($dato['socios'][2]['declaracionpais']) ? $dato['socios'][2]['declaracionpais'] : ''),
			(isset($dato['socios'][3]['tipo']) ? $dato['socios'][3]['tipo'] : ''), 
			(isset($dato['socios'][3]['identificacion']) ? $dato['socios'][3]['identificacion'] : ''),
			(isset($dato['socios'][3]['nombre_accionista']) ? $dato['socios'][3]['nombre_accionista'] : ''), 
			(isset($dato['socios'][3]['publico_recursos']) ? (($dato['socios'][3]['publico_recursos'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][3]['publico_grado']) ? (($dato['socios'][3]['publico_grado'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][3]['publico_reconocimiento']) ? (($dato['socios'][3]['publico_reconocimiento'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][3]['declaracion_tributaria']) ? (($dato['socios'][3]['declaracion_tributaria'] == '1') ? 'Si' : 'No'): ''),
			(isset($dato['socios'][3]['declaracionpais']) ? $dato['socios'][3]['declaracionpais'] : ''),
			(isset($dato['socios'][4]['tipo']) ? $dato['socios'][4]['tipo'] : ''), 
			(isset($dato['socios'][4]['identificacion']) ? $dato['socios'][4]['identificacion'] : ''),
			(isset($dato['socios'][4]['nombre_accionista']) ? $dato['socios'][4]['nombre_accionista'] : ''), 
			(isset($dato['socios'][4]['publico_recursos']) ? (($dato['socios'][4]['publico_recursos'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][4]['publico_grado']) ? (($dato['socios'][4]['publico_grado'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][4]['publico_reconocimiento']) ? (($dato['socios'][4]['publico_reconocimiento'] == '1') ? 'Si' : 'No'): ''), 
			(isset($dato['socios'][4]['declaracion_tributaria']) ? (($dato['socios'][4]['declaracion_tributaria'] == '1') ? 'Si' : 'No'): ''),
			(isset($dato['socios'][4]['declaracionpais']) ? $dato['socios'][4]['declaracionpais'] : '')
		];
	}
	fputcsv($fh, $i_a, ';');
}
function generarDataReporte($fecha_ini, $fecha_fin, $comp)
{
	$conn = new Conexion();
	$SQL = "SELECT t2.persontype, t4.sucursal, t5.description AS area, t2.id_official, t2.log_planilla, t2.log_lote, t2.marca, 
			t7.description AS tipo_cliente, t8.description AS tipo_identificacion, t2.primerapellido, t2.segundoapellido, t2.nombres, 
			t2.razonsocial, t2.document, t2.digitochequeo, DATE(t34.fecha_creacion) AS fecha_rad_col, t33.fecha_envio, t33.fecha_recibido, 
			t2.fechasolicitud, t2.date_created, t27.description AS act_eco_prin, t2.detalleactividadeconomicappal, t28.description AS tipo_emp,
			t16.description AS profesion, t17.description AS ocupacion, t2.detalleocupacion, t2.numerohijos, t2.sexo, t2.estrato, 
			t12.description AS estado_civil, t23.description AS estudios, t2.cargo, t22.description AS tipoactividad, t2.detalletipoactividad, 
			t2.fechanacimiento, t10.description AS lugarnacimiento, t2.fechaexpedicion, t9.description AS lugarexpedicion, 
			t11.description AS nacionalidad, t13.description AS ciudadresidencia, t2.direccionresidencia,
			t2.direccionoficinappal, t2.nomenclatura, t2.telefonoresidencia, t2.telefonolaboral, t2.telefonoficina, t2.celular, t2.faxoficina,
			t2.correoelectronico, t2.nombreempresa, t18.codigo AS ciiu, t14.description AS ciudadoficina, t28.description AS tipoempresaemp,
			t24.description AS tipovivienda, t19.value AS ingresosmensuales, t29.value AS ingresosmensualesemp, t21.value AS egresosmensuales,
			t30.value AS egresosmensualesemp, t20.value AS otrosingresos, t2.conceptosotrosingresos, t2.totalactivos, t2.activosemp, 
			t2.totalpasivos, t2.pasivosemp, t2.monedaextranjera, t31.description AS tipotransacciones, t2.huella, t2.firma, 'SI' AS entrevista, 
			t2.lugarentrevista, t2.fechaentrevista, CONCAT(t2.horaentrevista,' ',t2.tipohoraentrevista) AS hora_entrevista, 
			t2.resultadoentrevista, t2.nombreintermediario, t32.name AS usuario, t2.client_id, t2.celularoficina, 
			IFNULL(t35.description, 'SD') AS paisnacimiento, t36.ciudad AS lugarnacimientofatca, t2.documento, t2.nacionalidad_otra, 
			IFNULL(t37.description, 'SD') AS nacionalidad_cual, t2.productos_exterior, t2.cuentas_monedaextranjera, 
			IFNULL(t38.description, 'SD') AS obligaciones_pais, t39.value AS otrosingresosemp, t2.concepto_otrosingresosemp, 
			t2.formato_paisn, t2.formato_nacio, t2.formato_oblip, t2.data_id/*, t2.paisnacimiento, t2.nacionalidad_cual, t2.obligaciones_pais*/
			FROM
			(
				SELECT t1.id AS client_id, t1.document, t1.persontype, t1.firstname, t1.lastname, 
				t1.type, t1.flag, t1.capi, t1.date_updated, t1.status_migracion, 
				t1.status_form, t1.last_updater, t1.date_updated_document, 
				t1.estado_dev, t1.estado, t1.fecha_datacredito, t3.*
				FROM client AS t1
				INNER JOIN 
				(
					SELECT t_2.id_client, t_2.id AS form_id, t_2.id_user, t_2.log_lote, t_2.date_created, t_2.log_planilla, t_2.marca, 
					t_1.id AS data_id, t_1.id_form, t_1.fecharadicado, t_1.fechasolicitud, t_1.sucursal, t_1.area, t_1.lote, t_1.formulario, 
					t_1.id_official, t_1.clasecliente, t_1.primerapellido, t_1.segundoapellido, t_1.nombres, t_1.tipodocumento, t_1.documento, 
					t_1.fechaexpedicion, t_1.lugarexpedicion, t_1.fechanacimiento, t_1.paisnacimiento, t_1.lugarnacimiento, t_1.nacionalidad_otra, 
					t_1.nacionalidad_cual, t_1.sexo, t_1.nacionalidad, t_1.numerohijos, t_1.estadocivil, t_1.direccionresidencia, 
					t_1.ciudadresidencia, t_1.telefonoresidencia, t_1.nombreempresa, t_1.ciudadempresa, t_1.direccionempresa, t_1.nomenclatura, 
					t_1.telefonolaboral, t_1.celular, t_1.correoelectronico, t_1.cargo, t_1.actividadeconomicaempresa, t_1.profesion, t_1.ocupacion, 
					t_1.detalleocupacion, t_1.ciiu, t_1.ingresosmensuales, t_1.otrosingresos, t_1.egresosmensuales, t_1.conceptosotrosingresos, 
					t_1.tipoactividad, t_1.detalletipoactividad, t_1.nivelestudios, t_1.tipovivienda, t_1.estrato, t_1.totalactivos, 
					t_1.totalpasivos, t_1.razonsocial, t_1.nit, t_1.digitochequeo, t_1.ciudadoficina, t_1.direccionoficinappal, t_1.nomenclatura_emp, 
					t_1.telefonoficina, t_1.faxoficina, t_1.celularoficina, t_1.ciudadsucursal, t_1.direccionsucursal, t_1.nomenclatura_emp2, 
					t_1.telefonosucursal, t_1.faxsucursal, t_1.actividadeconomicappal, t_1.detalleactividadeconomicappal, t_1.tipoempresaemp, 
					t_1.activosemp, t_1.pasivosemp, t_1.ingresosmensualesemp, t_1.egresosmensualesemp, t_1.otrosingresosemp, 
					t_1.concepto_otrosingresosemp, t_1.obligaciones_otropais, t_1.obligaciones_pais, t_1.monedaextranjera, t_1.tipotransacciones, 
					t_1.productos_exterior, t_1.cuentas_monedaextranjera, t_1.firma, t_1.huella, t_1.lugarentrevista, t_1.fechaentrevista, 
					t_1.horaentrevista, t_1.tipohoraentrevista, t_1.resultadoentrevista, t_1.observacionesentrevista, t_1.nombreintermediario, 
					t_1.socio1, t_1.socio2, t_1.socio3, t_1.estado_autos, t_1.formato_paisn, t_1.formato_nacio, t_1.formato_oblip 
					FROM data AS t_1
					INNER JOIN form AS t_2 ON(t_2.id = t_1.id_form)
					WHERE t_2.date_created BETWEEN '$fecha_ini 00:00:00' AND '$fecha_fin 23:59:59'
					AND t_2.status = 1 
					$comp
					ORDER BY t_2.id_client, t_2.date_created DESC
				) AS t3 ON(t3.id_client = t1.id)
				GROUP BY t3.id_client
			)AS t2
			LEFT JOIN param_sucursales AS t4 ON(t4.id = t2.sucursal)
			LEFT JOIN param_area AS t5 ON(t5.id = t2.area)
			LEFT JOIN param_formulario AS t6 ON(t6.id = t2.formulario)
			LEFT JOIN param_clasecliente AS t7 ON(t7.id = t2.clasecliente)
			LEFT JOIN param_tipodocumento AS t8 ON(t8.id = t2.tipodocumento)
			LEFT JOIN param_ciudad AS t9 ON(t9.id = t2.lugarexpedicion)
			LEFT JOIN param_ciudad AS t10 ON(t10.id = t2.lugarnacimiento)
			LEFT JOIN param_pais AS t11 ON(t11.id = t2.nacionalidad)
			LEFT JOIN param_estadocivil AS t12 ON(t12.id = t2.estadocivil)
			LEFT JOIN param_ciudad AS t13 ON(t13.id = t2.ciudadresidencia)
			LEFT JOIN param_ciudad AS t14 ON(t14.id = t2.ciudadoficina)
			LEFT JOIN param_actividadecono AS t15 ON(t15.id = t2.actividadeconomicaempresa)
			LEFT JOIN param_profesion AS t16 ON(t16.id = t2.profesion)
			LEFT JOIN param_ocupacion AS t17 ON(t17.id = t2.ocupacion)
			LEFT JOIN param_ciiu AS t18 ON(t18.codigo = t2.ciiu)
			LEFT JOIN param_ingresosmensuales AS t19 ON(t19.id = t2.ingresosmensuales)
			LEFT JOIN param_otrosingresos AS t20 ON(t20.id = t2.otrosingresos)
			LEFT JOIN param_egresosmensuales AS t21 ON(t21.id = t2.egresosmensuales)
			LEFT JOIN param_tipoactividad AS t22 ON(t22.id = t2.tipoactividad)
			LEFT JOIN param_estudio AS t23 ON(t23.id = t2.nivelestudios)
			LEFT JOIN param_tipovivienda AS t24 ON(t24.id = t2.tipovivienda)
			LEFT JOIN param_ciudad AS t25 ON(t25.id = t2.ciudadoficina)
			LEFT JOIN param_ciudad AS t26 ON(t26.id = t2.ciudadsucursal)
			LEFT JOIN param_actividad AS t27 ON(t27.id = t2.actividadeconomicappal)
			LEFT JOIN param_tipoempresa AS t28 ON(t28.id = t2.tipoempresaemp)
			LEFT JOIN param_ingresosmensuales_emp AS t29 ON(t29.id = t2.ingresosmensualesemp)
			LEFT JOIN param_egresosmensuales_emp AS t30 ON(t30.id = t2.egresosmensualesemp)
			LEFT JOIN param_tipotransacciones AS t31 ON(t31.id = t2.tipotransacciones)
			INNER JOIN user AS t32 ON(t32.id = t2.id_user)
			LEFT OUTER JOIN radicados AS t33 ON(t33.id = t2.log_lote)
			LEFT OUTER JOIN radicados_items AS t34 ON(t34.documento = t2.document AND t2.log_lote = t34.id_radicados)
			LEFT JOIN param_paises AS t35 ON(t35.codigo = t2.paisnacimiento)
			LEFT JOIN param_ciudadespaises AS t36 ON(t36.id = t2.lugarnacimiento)
			LEFT JOIN param_paises AS t37 ON(t37.codigo = t2.nacionalidad_cual)
			LEFT JOIN param_paises AS t38 ON(t38.codigo = t2.obligaciones_pais)
			LEFT JOIN param_ingresosmensuales_emp AS t39 ON(t39.id = t2.otrosingresosemp)";
	if(!$conn->consultar($SQL)){
		return false;
	}
	if($conn->getNumeroRegistros() <= 0){
		return false;
	}
	$objs = [];
	$conn2 = new Conexion();
	while($row = $conn->sacarRegistro('str')){
		$row['productos'] = getDataProductos($row['data_id'], $conn2);
		$row['socios'] = getDataSocios($row['data_id'], $conn2);
		$objs[] = $row;
	}
	$conn2->desconectar();
	return $objs;
}
function getDataProductos($data_id, $conn)
{
	$SQL = "SELECT t1.id, 
				   t1.data_id, 
				   t1.tipo, 
				   t1.identificacion_producto, 
				   t1.entidad, 
				   t1.monto, 
				   t1.pais AS pais_id, 
				   t2.description AS pais, 
				   t1.ciudad AS ciudad_id, 
				   CONCAT(t3.ciudad, ', ', t3.departamento_nombre) AS ciudad,
				   t1.moneda AS moneda_id, 
				   CONCAT(t4.pais, ', ', t4.moneda) AS moneda
			  FROM data_productos AS t1
			  LEFT JOIN param_paises AS t2 ON(t2.codigo = t1.pais)
			  LEFT JOIN param_ciudadespaises AS t3 ON(t3.id = t1.ciudad)
			  LEFT JOIN param_monedas AS t4 ON(t4.id = t1.moneda)
			 WHERE t1.data_id = $data_id";
	if (!$conn->consultar($SQL)) {
		return false;
	}
	if ($conn->getNumeroRegistros() <= 0) {
		return false;
	}
	$objs = [];
	while ($row = $conn->sacarRegistro('str')) {
		$objs[] = $row;
	}
	return $objs;
}
function getDataSocios($data_id, $conn)
{
	$SQL = "SELECT t1.id, 
				   t1.data_id, 
				   t1.tipo_id, 
				   t2.description AS tipo,
				   t1.identificacion, 
				   t1.nombre_accionista, 
				   t1.publico_recursos, 
				   t1.publico_grado, 
				   t1.publico_reconocimiento, 
				   t1.declaracion_tributaria, 
				   t1.declaracion_pais, 
				   t3.description AS declaracionpais
			  FROM data_socios AS t1
			  LEFT JOIN param_tipodocumento AS t2 ON(t2.id = t1.tipo_id)
			  LEFT JOIN param_paises AS t3 ON(t3.codigo = t1.declaracion_pais)
			 WHERE t1.data_id = $data_id";
 	if (!$conn->consultar($SQL)) {
		return false;
	}
	if ($conn->getNumeroRegistros() <= 0) {
		return false;
	}
	$objs = [];
	while ($row = $conn->sacarRegistro('str')) {
		$objs[] = $row;
	}
	return $objs;
}
