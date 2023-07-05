<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
//error_reporting(E_ALL);
set_time_limit(0);
session_start();

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'client.class.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/Colpatria/config/globalParameters.php';
//require_once '../../lib/class/client.class.php';
//extract($_POST);
$complemento = '';
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

if(isset($_POST['hora']) && !empty($_POST['hora'])){
	$hora = $_POST['hora'] + 1;
	//$hora = $hora + 1;
	//$complemento = " WHERE (DATE(fo.date_created) BETWEEN '$fecha_inicio' AND '$fecha_fin') AND fo.status = 1";
	$complemento = " WHERE (DATE(fo.date_created) BETWEEN '$fecha_inicio' AND '$fecha_fin') AND fo.status = 1 AND fo.id_user != 3691";
}else
	//$complemento = " WHERE (DATE(fo.date_created) BETWEEN '$fecha_inicio' AND '$fecha_fin') AND fo.status = 1";
	$complemento = " WHERE (DATE(fo.date_created) BETWEEN '$fecha_inicio' AND '$fecha_fin') AND fo.status = 1 AND fo.id_user != 3691";

if(isset($_POST['area']) && !empty($_POST['area']))
	$complemento.= " AND da.area = '".$_POST['area']."' ";

if(isset($_POST['sucursal']) && !empty($_POST['sucursal']))
	$complemento.= " AND da.sucursal = '".$_POST['sucursal']."' ";

$SQL = <<< SQL
SELECT IF(cl.persontype = '1', 'NATURAL','JURIDICO'),
	   cl.document, 
	   cl.firstname, 
	   IF(cl.persontype = '1', td.description, 'NIT') AS tipodocumento_cli,
	   fu.description AS formulario, 
	   fo.log_planilla, 
	   fo.log_lote, 
	   da.fecharadicado, 
	   da.fechasolicitud, 
	   CONCAT(c1.ciudad, ', ', c1.departamento) AS ciudad,
	   su.sucursal, 
	   ar.description AS area, 
	   da.id_official AS oficial, 
	   da.tipo_solicitud, 
	   cc.description AS clasecliente, 
	   da.cual_clasecliente, 
	   da.primerapellido, 
	   da.segundoapellido, 
	   da.nombres, 
	   da.sexo, 
	   td.description AS tipodocumento, 
	   da.documento, 
	   da.fechaexpedicion, 
	   IF(da.formulario IN ('15', '19', '20'), le.ciudad, IF(cl.persontype = '1', lugar_exp.description, 'NA')) AS lugarexpedicion, 
	   da.fechanacimiento, 
	   IF(da.formulario IN ('15', '19', '20'), ln.ciudad, IF(cl.persontype = '1', lugar_nac.description, 'NA')) AS lugarnacimiento, 
	   IF(da.formulario IN ('15', '19', '20'), pn.description, IF(cl.persontype = '1', pp.description, 'NA')) AS paisnacimiento, 
	   pno.description AS nacionalidad_otra, 
	   IF(cl.persontype = '1', da.numerohijos, 'NA') AS numerohijos,
	   IF(cl.persontype = '1', pe.description, 'NA') AS estadocivil, 
	   da.correoelectronico, 
	   da.celular, 
	   da.telefonoresidencia, 
	   da.direccionresidencia, 
	   /*IF(da.formulario IN ('15', '19', '20'), CONCAT(cr.ciudad, ', ', cr.departamento), IF(cl.persontype = '1', lugar_resi.description, '')) AS ciudadresidencia, */
	   IF(da.formulario IN ('15', '19', '20'), CONCAT(cr.ciudad, ', ', cr.departamento), IF(cl.persontype = '1', lugar_resi.description, lugar_resi.description)) AS ciudadresidencia, 
	   da.nombreempresa, 
	   da.direccionempresa,
	   da.nomenclatura,
	   da.telefonolaboral, 
	   /*ce.ciudad AS ciudadempresa, */
	   IF(da.formulario IN ('15', '19', '20'), CONCAT(ce.ciudad, ', ', ce.departamento), IF(cl.persontype = '1', ciudad_emp.description, ciudad_emp.description)) AS ciudadempresa, 
	   da.celularoficinappal, 
	   IF(da.formulario IN ('15', '19', '20'), te1.description, pac.description) AS tipoempresaemp, 
	   da.tipoempresaemp_cual, 
	   da.recursos_publicos,
	   da.poder_publico,
	   da.reconocimiento_publico,
	   da.reconocimiento_cual, 
	   da.servidor_publico,
	   da.expuesta_politica,
	   da.cargo_politica, 
	   da.cargo_politica_ini, 
	   da.cargo_politica_fin,
	   da.expuesta_publica,
	   da.publica_nombre, 
	   da.publica_cargo, 
	   da.repre_internacional,
	   da.internacional_indique, 
	   da.tributarias_otro_pais,
	   da.tributarias_paises, 
	   IF(da.formulario IN ('15', '19', '20'), ac.description, IF(cl.persontype = '1', pta.description, 'NA')) AS tipoactividad, 
	   da.ciiu AS ciiu,
	   pf.description AS profesion, 
	   da.cargo, 
	   IF(cl.persontype = '1', poc.description, 'NA') AS ocupacion, 
	   da.detalleocupacion,
	   IF(da.formulario IN ('15', '19', '20'), da.detalleactividadeconomicappal, pac.description) AS actividadeconomicaempresa, 
	   da.ciiu_otro AS ciiu_otro, 
	   da.direccionoficinappal, 
	   da.nomenclatura_emp,
	   da.telefonoficinappal, 
	   da.detalletipoactividad, 
	   in1.description AS ingresosmensuales, 
	   da.totalactivos,
	   da.totalpasivos, 
	   eg1.description AS egresosmensuales, 
	   da.patrimonio,
	   IF(da.formulario IN ('15', '19', '20'), in2.description, IF(cl.persontype = '1', poi.value, 'NA')) AS otrosingresos, 
	   da.conceptosotrosingresos, 
	   IF(cl.persontype = '1', pes.description, 'NA') AS nivelestudios, 
	   IF(cl.persontype = '1', ptv.description, 'NA') AS tipovivienda,
	   IF(cl.persontype = '1', da.estrato, 'NA') AS estrato,
	   da.razonsocial, 
	   da.nit, 
	   da.digitochequeo, 
	   te2.description AS tipoempresajur,
	   da.tipoempresajur_otra, 
	   IF(da.formulario IN ('15', '19', '20'), da.detalleactividadeconomicappal, IF(da.actividadeconomicappal = '0', 'NA', pact.description)) AS actividadeconomica, 
	   IF(da.formulario IN ('15', '19', '20'), 'NA', da.detalleactividadeconomicappal) AS detalleactividadeconomicappal,
	   da.ciiu AS ciiu, 
	   da.direccionoficinappal, 
	   IF(da.formulario IN ('15', '19', '20'), co.ciudad, IF(cl.persontype = '1', 'NA', lugar_emp.description)) AS ciudadoficina, 
	   da.telefonoficina, 
	   da.faxoficina,
	   da.correoelectronico_otro, 
	   da.celularoficina, 
	   da.direccionsucursal, 
	   lugar_sucursal.description AS ciudadsucursal, 
	   da.nomenclatura_emp2,
	   da.telefonosucursal, 
	   da.faxsucursal,
	   IF(da.formulario IN ('15', '19', '20'), in3.description, pine.value) AS ingresosmensualesemp, 
	   da.activosemp, 
	   da.pasivosemp, 
	   IF(da.formulario IN ('15', '19', '20'), eg2.description, peme.value) AS egresosmensualesemp, 
	   da.patrimonio, 
	   in4.description AS otrosingresosemp,
	   da.concepto_otrosingresosemp, 
	   da.origen_fondos, 
	   da.procedencia_fondos, 
	   da.monedaextranjera,
	   tt.description AS tipotransacciones, 
	   da.tipotransacciones_cual, 
	   da.otras_operaciones, 
	   da.productos_exterior,
	   da.cuentas_monedaextranjera,
	   da.reclamaciones,
	   da.auto_correo,
	   da.auto_sms,
	   da.firma,
	   da.huella,
	   da.lugarentrevista, 
	   da.resultadoentrevista, 
	   da.fechaentrevista, 
	   CONCAT(da.horaentrevista, ' ', da.tipohoraentrevista) AS horaentrevista, 
	   da.observacionesentrevista, 
	   da.nombreintermediario, 
	   da.clave_inter,
	   da.firma_entrevista,
	   cv.ciudad AS verificacion_ciudad, 
	   da.verificacion_fecha, 
	   da.verificacion_hora, 
	   da.verificacion_nombre, 
	   da.verificacion_observacion, 
	   da.verificacion_firma,
	   ud.name AS usuario_digitador,
	   ra.fecha_envio,
	   ra.fecha_recibido, 
	   fo.date_created,
	   da.id AS idData,
	   cl.id AS clienteId,
	   da.formulario AS formularioId,
	   da.socio1,
	   da.socio2,
	   da.socio3,
	   cl.persontype,
	   cl.tipo_norma_id,
	   cl.regimen_id,
	   ptn.descripcion AS tipo_norma_str,
	   reg.descripcion AS regimen_str,
	   da.producto_seguro,
	   CASE da.pep_expuesto WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS pep_expuesto,
	   CASE da.expuesta_extrangero WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS expuesta_extrangero,
	   CASE da.expuesta_internacional WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS expuesta_internacional,
	   CASE da.conyuge_expuesto WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS conyuge_expuesto,
	   CASE da.asociado_expuesto WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS asociado_expuesto,
	   CASE da.pep_familiar WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS pep_familiar,
	   da.pep_familia_nombre,
	   da.pep_familia_cargo,
	   CASE da.accionista_beneficios WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS accionista_beneficios,
	   CASE da.cotiza_rnve WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS cotiza_rnve,
	   CASE da.beneficiarios_diferentes WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS beneficiarios_diferentes,
	   CASE da.beneficiarios_naturales WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS beneficiarios_naturales,
	   CASE da.beneficiarios_jur WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS beneficiarios_jur,
	   da.verificacion_cargo,
	   da.verificacion_documento,
	   CASE da.responsable_rut WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS responsable_rut,
	   da.codigo_rut
  FROM `data` AS da
 INNER JOIN form AS fo ON(fo.id = da.id_form)
 INNER JOIN client AS cl ON(cl.id = fo.id_client)
 INNER JOIN param_regimen AS reg ON(reg.id = cl.regimen_id)
 INNER JOIN param_tipo_norma AS ptn ON(ptn.id = cl.tipo_norma_id)
  LEFT JOIN radicados AS ra ON(ra.id = fo.log_lote)
  LEFT OUTER JOIN (SELECT id_radicados, documento 
  					 FROM radicados_items 
  					WHERE 1 
  					GROUP BY documento, id_radicados
     ) AS ri ON(cl.document = ri.documento AND fo.log_lote = ri.id_radicados)
  LEFT JOIN `user` AS ur ON(ur.id = ra.id_usuarioenvia)
 INNER JOIN `user` AS ud ON(ud.id = fo.id_user)
  LEFT JOIN param_formulario AS fu ON(fu.id = da.formulario)
  LEFT JOIN param_ciudadesdane AS c1 ON(c1.cod_dane = da.ciudad)
  LEFT JOIN param_sucursales AS su ON(su.id = da.sucursal)
  LEFT JOIN param_area AS ar ON(ar.id = da.area)
  LEFT JOIN param_clasecliente AS cc ON(cc.id = da.clasecliente)
  LEFT JOIN param_tipodocumento AS td ON(td.id = da.tipodocumento)
  LEFT JOIN param_ciudadesdane AS le ON(le.cod_dane = da.lugarexpedicion)
  LEFT JOIN param_ciudad AS lugar_exp ON(lugar_exp.id = da.lugarexpedicion)
  LEFT JOIN param_ciudadesdane AS ln ON(ln.cod_dane = da.lugarnacimiento)
  LEFT JOIN param_ciudad AS lugar_nac ON(lugar_nac.id = da.lugarnacimiento)
  LEFT JOIN param_paises AS pn ON(pn.id = da.paisnacimiento)
  LEFT JOIN param_paises AS pno ON(pno.id = da.nacionalidad_otra)
  LEFT JOIN param_ciudadesdane AS cr ON(cr.cod_dane = da.ciudadresidencia)
  LEFT JOIN param_ciudad AS lugar_resi ON(lugar_resi.id = da.ciudadresidencia)
  LEFT JOIN param_ciudadesdane AS ce ON(ce.cod_dane = da.ciudadempresa)
  LEFT JOIN param_ciudad AS ciudad_emp ON(ciudad_emp.id = da.ciudadempresa)
  LEFT JOIN param_tipoempresa AS te1 ON(te1.id = da.tipoempresaemp)
  LEFT JOIN param_actividad AS ac ON(ac.id = da.tipoactividad)
  LEFT JOIN param_tipoactividad AS pta ON(pta.id = da.tipoactividad)
  /*LEFT JOIN param_ciiu AS ci1 ON(ci1.codigo = da.ciiu)*/
  LEFT JOIN param_profesion AS pf ON(pf.id = da.profesion)
  /*LEFT JOIN param_ciiu AS ci2 ON(ci2.codigo = da.ciiu_otro)*/
  LEFT JOIN param_ingresosmensuales AS in1 ON(in1.id = da.ingresosmensuales)
  LEFT JOIN param_egresosmensuales AS eg1 ON(eg1.id = da.egresosmensuales)
  LEFT JOIN param_ingresosmensuales AS in2 ON(in2.id = da.otrosingresos)
  LEFT JOIN param_otrosingresos AS poi ON(poi.id = da.otrosingresos)
  LEFT JOIN param_tipoempresa AS te2 ON(te2.id = da.tipoempresajur)
  LEFT JOIN param_ciudadesdane AS co ON(co.cod_dane = da.ciudadoficina)
  LEFT JOIN param_ciudad AS lugar_emp ON(lugar_emp.codigo = da.ciudadoficina)
  LEFT JOIN param_ingresosmensuales AS in3 ON(in3.id = da.ingresosmensualesemp)
  LEFT JOIN param_ingresosmensuales_emp AS pine ON(pine.id = da.ingresosmensualesemp)
  LEFT JOIN param_egresosmensuales AS eg2 ON(eg2.id = da.egresosmensualesemp)
  LEFT JOIN param_egresosmensuales_emp AS peme ON(peme.id = da.egresosmensualesemp)
  LEFT JOIN param_ingresosmensuales AS in4 ON(in4.id = da.otrosingresosemp)
  LEFT JOIN param_tipotransacciones AS tt ON(tt.id = da.tipotransacciones)
  LEFT JOIN param_ciudadesdane AS cv ON(cv.cod_dane = da.verificacion_ciudad)
  LEFT JOIN param_pais AS pp ON(pp.id = da.nacionalidad)
  LEFT JOIN param_estadocivil AS pe ON(pe.id = da.estadocivil)
  LEFT JOIN param_actividadecono AS pac ON(pac.id = da.actividadeconomicaempresa)
  LEFT JOIN param_ocupacion AS poc ON(poc.id = da.ocupacion)
  LEFT JOIN param_estudio AS pes ON(pes.id = da.nivelestudios)
  LEFT JOIN param_tipovivienda AS ptv ON(ptv.id = da.tipovivienda)
  LEFT JOIN param_ciudad AS lugar_sucursal ON(lugar_sucursal.id = da.ciudadsucursal)
  LEFT JOIN param_actividad AS pact ON(pact.id = da.actividadeconomicappal)
 $complemento
SQL;

$client = new Client();
$ultimoestado = "";

/* bgcolor="#EB8F00" */
$cabeza = [
	'TIPO PERSONA', 
	'DOCUMENTO CLIENTE', 
	'NOMBRE CLIENTE', 
	'TIPO DOCUMENTO CLIENTE', 
	'PLANILLA', 
	'LOTE',
	'FORMULARIO', 
	'FECHA RADICADO', 
	'FECHA ENVIO REAL', 
	'FECHA APROBACION', 
	'FECHA DILIGENCIAMIENTO', 
	'FECHA DE DIGITACION', 
	'CIUDAD', 
	'SUCURSAL', 
	'AREA', 
	'OFICIAL', 
	'TIPO SOLICITUD', 
	'CLASE VINCULACION', 
	'CUAL', 
	'PRIMER APELLIDO', 
	'SEGUNDO APELLIDOS', 
	'NOMBRES', 
	'GENERO', 
	'TIPO DE DOCUMENTO', 
	'NUMERO IDENTIFICACION', 
	'FECHA EXPEDICION', 
	'LUGAR EXPEDICION',
	'FECHA NACIMIENTO', 
	'LUGAR NACIMIENTO', 
	'PRODUCTO O SEGURO A ADQUIRIR',
	'NACIONALIDAD', 
	'NACIONALIDAD 2', 
	'NUMERO DE HIJOS', 
	'ESTADO CIVIL',
	'CORREO ELECTRONICO', 
	'TELEFONO CELULAR', 
	'TELEFONO FIJO', 
	'DIRECCION RESIDENCIA', 
	'CIUDAD/DEPARTAMENTO', 
	'EMPRESA DONDE TRABAJA', 
	'DIRECCION OFICINA', 
	'NOMENCLATURA', 
	'TELEFONO OFICINA', 
	'CIUDAD DE LA EMPRESA', 
	'CELULAR OFICINA', 
	'TIPO EMPRESA', 
	'OTRO', 
	'MANEJA RECURSOS PUBLICOS?',//ADMINSTRA RECURSOS PUBLICOS
	'GRADO DE PODER PUBLICO?',
	'RECONOCIMIENTO PUBLICO?', 
	'INDIQUE', 
	'ES SERVIDOR PUBLICO?', 
	'CONOCIDO EXPUESTO POLITICO?',
	'CARGO', 
	'FECHA INICIO', 
	'FECHA FIN', 
	'VINCULO PERSONA PUBLICAMENTE EXPUESTA?',//VINCULO PPE
	'NOMBRE', 
	'CARGO',
	'REPRESENTANTE LEGAL INTERNACIONAL?', 
	'INDIQUE', 


		'ES UN PEP',
		'ES UN PEP EXTRANJERO',
		'ES UN PEP ORG INTERNACIONAL',
		'CONYUGUE DE PEP',
		'ASOCIADO DE UN PEP',
		'FAMILIAR DE PEP',
		'NOMBRE(PEP)',
		'CARGO',

	'OBLIGACIONES TRIBUTARIAS OTROS PAISES?',//OBLIGACIONES TRIBUTARIAS EN OTRO(S) PAISES
	'CUALES',//PAISES
	'ACTIVIDAD ECONOMICA', 
	'CIIU(codigo)', 
	'OCUPACION/PROFESION', 
	'CARGO(asalariado)', 
	'OCUPACION', 'DETALLE',
	'ACTIVIDAD SECUNDARIA', 
	'CIIU', 
	'DIRECCION', 
	'NOMENCLATURA', 
	'TELEFONO', 
	'PRODUCTO O SERVICIO COMERCIALIZA',
	'INGRESOS MENSUALES', 
	'ACTIVOS', 
	'PASIVOS', 
	'EGRESOS MENSUALES', 
	'PATRIMONIO',
	'OTROS INGRESOS', 
	'CONCEPTO OTROS INGRESOS', 
	'NIVEL DE ESTUDIOS', 
	'TIPO DE VIVIENDA', 
	'ESTRATO',
	'NOMBRE/RAZON SOCIAL', 
	'NIT', 
	'DIV', 
	'TIPO EMPRESA',
	'OTRO', 
	'ACTIVIDAD ECONOMICA', 
	'DETALLE', 
	'CIIU(codigo)', 
	'DIRECCION OFICINA PPAL', 
	'CIUDAD/DEPARTAMENTO',
	'TELEFONO', 
	'FAX OFICINA', 
	'E-MAIL', 
	'CELULAR', 
	'DIRECCION SUCURSAL', 
	'CIUDAD SUCURSAL', 
	'NOMENCLATURA',
	'TELEFONO SUCURSAL', 
	'FAX SUCURSAL', 
	'INGRESOS MENSUALES', 
	'ACTIVOS', 
	'PASIVOS', 
	'EGRESOS MENSUALES', 
	'PATRIMONIO', 
	'OTROS INGRESOS', 
	'CONCEPTO OTROS INGRESOS', 
	'TIPO ID #1', 
	'NUMERO ID #1', 
	'NOMBRE/RAZON SOCIAL #1', 
	'% PARTICIPACION #1',
	'MANEJA RECURSOS PUBLICOS? #1', 
	'RECONOCIMIENTO PUBLICO? #1', 
	'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #1', 
	'PAISES', 
	'TIPO ID #2', 
	'NUMERO ID #2', 
	'NOMBRE/RAZON SOCIAL #2', 
	'% PARTICIPACION #2',
	'MANEJA RECURSOS PUBLICOS? #2', 
	'RECONOCIMIENTO PUBLICO? #2', 
	'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #2', 
	'PAISES', 
	'TIPO ID #3', 
	'NUMERO ID #3', 
	'NOMBRE/RAZON SOCIAL #3', 
	'% PARTICIPACION #3',
	'MANEJA RECURSOS PUBLICOS? #3', 
	'RECONOCIMIENTO PUBLICO? #3', 
	'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #3', 
	'PAISES', 
	'TIPO ID #4', 
	'NUMERO ID #4', 
	'NOMBRE/RAZON SOCIAL #4', 
	'% PARTICIPACION #4',
	'MANEJA RECURSOS PUBLICOS? #4', 
	'RECONOCIMIENTO PUBLICO? #4', 
	'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #4', 
	'PAISES', 
	'TIPO ID #5', 
	'NUMERO ID #5', 
	'NOMBRE/RAZON SOCIAL #5', 
	'% PARTICIPACION #5',
	'MANEJA RECURSOS PUBLICOS? #5', 
	'RECONOCIMIENTO PUBLICO? #5', 
	'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #5', 
	'PAISES', 
	'ORIGEN DE FONDOS', 
	'PAIS DE ORIGEN', 
	'OPERACIONES EN MONEDA EXTRANJERA?', 
	'CUAL?', 
	'OTRAS',
	'OTRAS OPERACIONES', 
	'PRODUCTOS FINANCIEROS EN EL EXTERIOR', 
	'CUENTAS EN MONEDA EXTRANJERA?',
	'TIPO DE PRODUCTO #1', 
	'IDENTIFICACION DEL PRODUCTO #1', 
	'ENTIDAD #1', 
	'MONTO #1', 
	'CIUDAD #1', 
	'PAIS #1', 
	'MONEDA #1',
	'TIPO DE PRODUCTO #2', 
	'IDENTIFICACION DEL PRODUCTO #2', 
	'ENTIDAD #2', 
	'MONTO #2', 
	'CIUDAD #2', 
	'PAIS #2', 
	'MONEDA #2',
	'TIPO DE PRODUCTO #3', 
	'IDENTIFICACION DEL PRODUCTO #3', 
	'ENTIDAD #3', 
	'MONTO #3', 
	'CIUDAD #3', 
	'PAIS #3', 
	'MONEDA #3', 
	'HA TENIDO RECLAMACIONES?',
	'AÑO #1', 
	'RAMO #1', 
	'COMPAÑIA #1', 
	'VALOR #1', 
	'RESULTADO #1',
	'AÑO #2', 
	'RAMO #2', 
	'COMPAÑIA #2', 
	'VALOR #2', 
	'RESULTADO #2',
	'ENVIO DE INFORMACIION POR E-MAIL?', 
	'ENVIO DE INFORMACION POR SMS?', 
	'FIRMA?', 
	'HUELLA?',
	'LUGAR ENTREVISTA', 
	'RESULTADO', 
	'FECHA ENTREVISTA', 
	'HORA ENTREVISTA', 
	'OBSERVACIONES',
	'INTERMEDIARIO/ASESOR/ENTREVISTADOR', 
	'CLAVE', 
	'FIRMA INTERMEDIARIO/ASESOR/ENTREVISTADOR',
	'CIUDAD', 
	'FECHA VERIFICACION', 
	'HORA VERIFICACION', 
	'NOMBRE CARGO VERIFICADOR', 
	'OBSERVACIONES', 
	'FIRMA', 
	'DIGITADOR', 
	'ESTADO', 
	'ID DATA'
];
$conn = new Conexion();
if (!$conn->consultar($SQL)) exit;
if ($conn->getNumeroRegistros() <= 0) exit;
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Description: File Transfer");
header("Content-Encoding: UTF-8");
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=reportCallSpecial" . date('his') . ".csv");
header("Expires: 0");
header("Pragma: public");
echo "\xEF\xBB\xBF"; // UTF-8 BOM

$fh = fopen('php://output', 'w');
fputcsv($fh, $cabeza, ';');
$conn2 = new Conexion();
while ($dat = $conn->sacarRegistro('num')) {
	$idData = $dat[138];
	$acci = getAccionistas($idData, $conn2);
	$recl = getReclamaciones($idData, $conn2);
	$prod = getProductos($idData, $conn2);
	$formularioId = $dat[140];
	$socio1 = "";
	$socio2 = "";
	$socio3 = "";
	if($formularioId != '15'){
		$socio1 = $dat[141];
		$socio2 = $dat[142];
		$socio3 = $dat[143];
	}

	if(is_null($dat[135]) || empty($dat[135]) || $dat[135] == '0000-00-00')
		$dat[135] = "2013-06-12";
	else
		$dat[135] = $dat[135];

	if(is_null($dat[136]) || empty($dat[136]) || $dat[136] == '0000-00-00')
		$dat[136] = "2013-06-12";
	else
		$dat[136] = $dat[136];

	if($dat[137] == "")
		$dat[137] = "SD";

	if($dat[87] == "")
		$dat[87] = "NA";

	if($dat[65] == "")
		$dat[65] = "NA";

	if($dat[70] == "")
		$dat[70] = "NA";

	if($dat[35] == "")
		$dat[35] = "NA";

	if($dat[37] == "")
		$dat[37] = "NA";

	$dato45 = ($dat[45] == '-1') ? 'SI' : (($dat[45] == '0') ? 'NO' : 'SD');
	$dato52 = ($dat[52] == '-1') ? 'SI' : (($dat[52] == '0') ? 'NO' : 'SD');
	$dato47 = ($dat[47] == '-1') ? 'SI' : (($dat[47] == '0') ? 'NO' : 'SD');

	$ultimoestado = $client->getEstadoInformacion($dat[139]);
	fputcsv($fh, [
		$dat[0], 
		$dat[1], 
		$dat[2], 
		$dat[3], 
		$dat[5], 
		$dat[6], 
		$dat[4], 
		$dat[7], 
		$dat[135], 
		$dat[136], 
		$dat[8], 
		$dat[137], 
		$dat[9], 
		$dat[10], 
		$dat[11], 
		$dat[12], 
		$dat[13], 
		$dat[14], 
		$dat[15], 
		$dat[16], 
		$dat[17], 
		$dat[18], 
		$dat[19], 
		$dat[20], 
		$dat[21], 
		$dat[22], 
		$dat[23], 
		$dat[24], 
		$dat[25],
		$dat[149],
		$dat[26], 
		$dat[27], 
		$dat[28], 
		$dat[29], 
		$dat[30], 
		$dat[31], 
		$dat[32], 
		$dat[33], 
		$dat[34], 
		$dat[35], 
		$dat[36], 
		$dat[37], 
		$dat[38], 
		$dat[39], 
		$dat[40], 
		$dat[41], 
		$dat[42], 
		($dat[43] == '-1') ? 'SI' : (($dat[43] == '0') ? 'NO' : 'SD'), 
		($dat[44] == '-1') ? 'SI' : (($dat[44] == '0') ? 'NO' : 'SD'), 
		(($dat[140] == '15') ? $dato45 : $dato52), 
		$dat[46], 
		(($dat[140] == '15') ? $dato47 : 'SD'), 
		($dat[48] == '-1') ? 'SI' : (($dat[48] == '0') ? 'NO' : 'SD'), 
		$dat[49], 
		$dat[50], 
		$dat[51], 
		($dat[140] == '15') ? $dato52 : (($dat[144] == '1') ? $dato47 : 'SD'),//
		$dat[53], 
		$dat[54], 
		($dat[55] == '-1') ? 'SI' : (($dat[55] == '0') ? 'NO' : 'SD'), 
		$dat[56], 
		$dat[150],
		$dat[151],
		$dat[152],
		$dat[153],
		$dat[154],
		$dat[155],
		$dat[156],
		$dat[157],
		($dat[57] == '-1') ? 'SI' : (($dat[57] == '0') ? 'NO' : 'SD'), 
		$dat[58], 
		$dat[59], 
		$dat[60], 
		$dat[61], 
		$dat[62], 
		$dat[63], 
		$dat[64], 
		$dat[65], 
		$dat[66], 
		$dat[67], 
		$dat[68], 
		$dat[69], 
		$dat[70], 
		$dat[71], 
		$dat[72], 
		$dat[73], 
		$dat[74], 
		$dat[75], 
		$dat[76], 
		$dat[77], 
		$dat[78], 
		$dat[79], 
		$dat[80], 
		$dat[81], 
		$dat[82], 
		$dat[83], 
		$dat[84], 
		$dat[85], 
		$dat[86], 
		$dat[87], 
		$dat[88], 
		$dat[89], 
		$dat[90], 
		$dat[91], 
		$dat[92], 
		$dat[93], 
		$dat[94], 
		$dat[95], 
		$dat[96], 
		$dat[97], 
		$dat[98], 
		$dat[99], 
		$dat[100], 
		$dat[101], 
		$dat[102], 
		$dat[103], 
		$dat[104], 
		$dat[105], 
		$dat[106], 
		((isset($acci[0][1]) && $acci[0][1] != '') ? $acci[0][1] : 'SD'), 
		((isset($acci[0][2]) && $acci[0][2] != '') ? $acci[0][2] : $socio1), 
		((isset($acci[0][3]) && $acci[0][3] != '') ? $acci[0][3] : 'SD'), 
		((isset($acci[0][4]) && $acci[0][4] != '') ? $acci[0][4] : 'SD'), 
		((isset($acci[0][5]) && $acci[0][5] != '') ? $acci[0][5] : 'SD'), 
		((isset($acci[0][6]) && $acci[0][6] != '') ? $acci[0][6] : 'SD'), 
		((isset($acci[0][7]) && $acci[0][7] != '') ? $acci[0][7] : 'SD'), 
		((isset($acci[0][8]) && $acci[0][8] != '') ? $acci[0][8] : 'SD'),  
		((isset($acci[1][1]) && $acci[1][1] != '') ? $acci[1][1] : 'SD'), 
		((isset($acci[1][2]) && $acci[1][2] != '') ? $acci[1][2] : $socio2), 
		((isset($acci[1][3]) && $acci[1][3] != '') ? $acci[1][3] : 'SD'), 
		((isset($acci[1][4]) && $acci[1][4] != '') ? $acci[1][4] : 'SD'), 
		((isset($acci[1][5]) && $acci[1][5] != '') ? $acci[1][5] : 'SD'), 
		((isset($acci[1][6]) && $acci[1][6] != '') ? $acci[1][6] : 'SD'), 
		((isset($acci[1][7]) && $acci[1][7] != '') ? $acci[1][7] : 'SD'), 
		((isset($acci[1][8]) && $acci[1][8] != '') ? $acci[1][8] : 'SD'), 
		((isset($acci[2][1]) && $acci[2][1] != '') ? $acci[2][1] : 'SD'), 
		((isset($acci[2][2]) && $acci[2][2] != '') ? $acci[2][2] : $socio3), 
		((isset($acci[2][3]) && $acci[2][3] != '') ? $acci[2][3] : 'SD'), 
		((isset($acci[2][4]) && $acci[2][4] != '') ? $acci[2][4] : 'SD'), 
		((isset($acci[2][5]) && $acci[2][5] != '') ? $acci[2][5] : 'SD'), 
		((isset($acci[2][6]) && $acci[2][6] != '') ? $acci[2][6] : 'SD'), 
		((isset($acci[2][7]) && $acci[2][7] != '') ? $acci[2][7] : 'SD'), 
		((isset($acci[2][8]) && $acci[2][8] != '') ? $acci[2][8] : 'SD'), 
		((isset($acci[3][1]) && $acci[3][1] != '') ? $acci[3][1] : 'SD'), 
		((isset($acci[3][2]) && $acci[3][2] != '') ? $acci[3][2] : 'SD'), 
		((isset($acci[3][3]) && $acci[3][3] != '') ? $acci[3][3] : 'SD'), 
		((isset($acci[3][4]) && $acci[3][4] != '') ? $acci[3][4] : 'SD'), 
		((isset($acci[3][5]) && $acci[3][5] != '') ? $acci[3][5] : 'SD'), 
		((isset($acci[3][6]) && $acci[3][6] != '') ? $acci[3][6] : 'SD'), 
		((isset($acci[3][7]) && $acci[3][7] != '') ? $acci[3][7] : 'SD'), 
		((isset($acci[3][8]) && $acci[3][8] != '') ? $acci[3][8] : 'SD'), 
		((isset($acci[4][1]) && $acci[4][1] != '') ? $acci[4][1] : 'SD'), 
		((isset($acci[4][2]) && $acci[4][2] != '') ? $acci[4][2] : 'SD'), 
		((isset($acci[4][3]) && $acci[4][3] != '') ? $acci[4][3] : 'SD'), 
		((isset($acci[4][4]) && $acci[4][4] != '') ? $acci[4][4] : 'SD'), 
		((isset($acci[4][5]) && $acci[4][5] != '') ? $acci[4][5] : 'SD'), 
		((isset($acci[4][6]) && $acci[4][6] != '') ? $acci[4][6] : 'SD'), 
		((isset($acci[4][7]) && $acci[4][7] != '') ? $acci[4][7] : 'SD'), 
		((isset($acci[4][8]) && $acci[4][8] != '') ? $acci[4][8] : 'SD'), 
		$dat[107], 
		$dat[108], 
		($dat[109] == '-1') ? 'SI' : (($dat[109] == '0') ? 'NO' : 'SD'), 
		$dat[110], 
		$dat[111], 
		$dat[112], 
		($dat[113] == '-1') ? 'SI' : (($dat[113] == '0') ? 'NO' : 'SD'), 
		($dat[114] == '-1') ? 'SI' : (($dat[114] == '0') ? 'NO' : 'SD'), 
		((isset($prod[0][1])) ? $prod[0][1] : ''), 
		((isset($prod[0][2])) ? $prod[0][2] : ''), 
		((isset($prod[0][3])) ? $prod[0][3] : ''), 
		((isset($prod[0][4])) ? $prod[0][4] : ''), 
		((isset($prod[0][6])) ? $prod[0][6] : ''), 
		((isset($prod[0][5])) ? $prod[0][5] : ''), 
		((isset($prod[0][7])) ? $prod[0][7] : ''), 
		((isset($prod[1][1])) ? $prod[1][1] : ''), 
		((isset($prod[1][2])) ? $prod[1][2] : ''), 
		((isset($prod[1][3])) ? $prod[1][3] : ''), 
		((isset($prod[1][4])) ? $prod[1][4] : ''), 
		((isset($prod[1][6])) ? $prod[1][6] : ''), 
		((isset($prod[1][5])) ? $prod[1][5] : ''), 
		((isset($prod[1][7])) ? $prod[1][7] : ''), 
		((isset($prod[2][1])) ? $prod[2][1] : ''), 
		((isset($prod[2][2])) ? $prod[2][2] : ''), 
		((isset($prod[2][3])) ? $prod[2][3] : ''), 
		((isset($prod[2][4])) ? $prod[2][4] : ''), 
		((isset($prod[2][6])) ? $prod[2][6] : ''), 
		((isset($prod[2][5])) ? $prod[2][5] : ''), 
		((isset($prod[2][7])) ? $prod[2][7] : ''), 
		($dat[115] == '-1') ? 'SI' : (($dat[115] == '0') ? 'NO' : 'SD'), 
		((isset($recl[0][1])) ? $recl[0][1] : ''), 
		((isset($recl[0][2])) ? $recl[0][2] : ''), 
		((isset($recl[0][3])) ? $recl[0][3] : ''), 
		((isset($recl[0][4])) ? $recl[0][4] : ''), 
		((isset($recl[0][5])) ? $recl[0][5] : ''), 
		((isset($recl[0][1])) ? $recl[0][1] : ''), 
		((isset($recl[0][2])) ? $recl[0][2] : ''), 
		((isset($recl[0][3])) ? $recl[0][3] : ''), 
		((isset($recl[0][4])) ? $recl[0][4] : ''), 
		((isset($recl[0][5])) ? $recl[0][5] : ''), 
		($dat[116] == '-1') ? 'SI' : (($dat[116] == '0') ? 'NO' : 'SD'), 
		($dat[117] == '-1') ? 'SI' : (($dat[117] == '0') ? 'NO' : 'SD'), 
		($dat[118] == '-1') ? 'SI' : (($dat[118] == '0') ? 'NO' : 'SD'), 
		($dat[119] == '-1') ? 'SI' : (($dat[119] == '0') ? 'NO' : 'SD'), 
		$dat[120], 
		$dat[121], 
		$dat[122], 
		$dat[123], 
		preg_replace("/\s+/", " ", $dat[124]), 
		$dat[125], 
		$dat[126], 
		($dat[127] == '-1') ? 'SI' : (($dat[127] == '0') ? 'NO' : 'SD'), 
		$dat[128], 
		$dat[129], 
		$dat[130], 
		$dat[131], 
		preg_replace("/\s+/", " ", $dat[132]), 
		($dat[133] == '-1') ? 'SI' : (($dat[133] == '0') ? 'NO' : 'SD'), 
		$dat[134], 
		$ultimoestado, $idData
	], ';');
}
$conn->desconectar();
$conn2->desconectar();
fclose($fh);
exit;
function getAccionistas($idData, $conn)
{
	$data = [];
	$SQL = "SELECT da.id,
				   ptd.description AS tipo_id, 
				   da.identificacion,
				   da.nombre_accionista,
				   da.porcentaje,
				   CASE da.publico_recursos WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END,
				   CASE da.publico_reconocimiento WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END,
				   CASE da.publico_expuesta WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END,
				   da.declaracion_tributaria
			  FROM data_socios AS da
			 INNER JOIN param_tipodocumento AS ptd ON(ptd.id = da.tipo_id)
			 WHERE data_id = '$idData'";
	if ($conn->consultar($SQL)) return false;
	if ($conn->getNumeroRegistros() > 0) return false;
	
	while ($consulta = $conn->sacarRegistro('num')) {
		$data[] = $consulta;
	}
	return $data;
}
function getReclamaciones($idData, $conn)
{
	$data = [];
	$SQL = "SELECT id,
				   rec_ano,
				   rec_ramo,
				   rec_compania,
				   rec_valor,
				   rec_resultado
			  FROM data_reclamaciones 
			 WHERE data_id = '$idData'";
	if($conn->consultar($SQL)) return false;
	if($conn->getNumeroRegistros() > 0) return false;

	while ($consulta = $conn->sacarRegistro('num')) {
		$data[] = $consulta;
	}
	return $data;
}
function getProductos($idData, $conn)
{
	$data = [];
	$SQL = "SELECT id, 
				   tipo, 
				   identificacion_producto, 
				   entidad, 
				   monto, 
				   pais, 
				   ciudad, 
				   moneda 
			  FROM data_productos 
			 WHERE data_id = '$idData'";
	if ($conn->consultar($SQL)) return false;
	if ($conn->getNumeroRegistros() > 0) return false;

	while ($consulta = $conn->sacarRegistro('num')) {
		$data[] = $consulta;
	}
	return $data;
}
