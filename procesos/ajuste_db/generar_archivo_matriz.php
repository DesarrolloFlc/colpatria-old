<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
header("Content-Type: text/html;charset=utf-8");
require "includes.php";
require_once PATH_CLASS . DS . '_conexion.php';

generarDataMatriz();
function generarDataMatriz()
{
	$conn = new Conexion();
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Description: File Transfer");
	header("Content-Encoding: UTF-8");
	header("Content-Type: text/csv; charset=UTF-8");
	header("Expires: 0");
	header("Pragma: public");
	echo "\xEF\xBB\xBF"; // UTF-8 BOM

	$header = [
		'TIPO PERSONA', 
		'DOCUMENTO CLIENTE', 
		'NOMBRE CLIENTE', 
		'TIPO DOCUMENTO CLIENTE', 
		'FORMULARIO', 
		'FECHA RADICADO', 
		'FECHA DILIGENCIAMIENTO', 
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
		'TIDO DE DOCUMENTO', 
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
		'MANEJA RECURSOS PUBLICOS?', 
		'GRADO DE PODER PUBLICO?', 
		'RECONOCIMIENTO PUBLICO?', 
		'INDIQUE', 
		'ES SERVIDOR PUBLICO?', 
		'CONOCIDO EXPUESTO POLITICO?', 
		'CARGO', 
		'FECHA INICIO', 
		'FECHA FIN', 
		'VINCULO PERSONA PUBLICAMENTE EXPUESTA?', 
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
		'OBLIGACIONES TRIBUTARIAS OTROS PAISES?', 
		'CUALES', 
		'ACTIVIDAD ECONOMICA', 
		'CIIU(codigo)', 
		'OCUPACION/PROFESION', 
		'CARGO(asalariado)', 
		'OCUPACION', 
		'DETALLE', 
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
		'ORIGEN DE FONDOS', 
		'PAIS DE ORIGEN', 
		'OPERACIONES EN MONEDA EXTRANJERA?', 
		'CUAL?', 
		'OTRAS', 
		'OTRAS OPERACIONES', 
		'PRODUCTOS FINANCIEROS EN EL EXTERIOR', 
		'CUENTAS EN MONEDA EXTRANJERA?', 
		'HA TENIDO RECLAMACIONES?', 
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
		'CANTIDAD REGISTROS', 
		'FECHA CREACION CLIENTE', 
		'ESTADO', 
		'FUENTE ULTIMO MOVIMIENTO', 
		'TIPO NORMA', 
		'REGIMEN'
	];
	$fh = fopen(PATH_MATRIZ . DS . 'finleco_data_matriz_' . date('Ymd') . '.txt', 'a');
	fputcsv($fh, $header, "\t");


	$SQL = "SELECT IF(c.persontype = '1', 'NATURAL','JURIDICO') AS persontype,
				   c.document, 
				   c.firstname, 
				   IF(c.persontype = '1', td.description, 'NIT') AS tipodocumento_cli,
				   fu.description AS formulario, 
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
				   le.ciudad AS lugarexpedicion1, /*da.formulario = '15'*/
				   lugar_exp.description AS lugarexpedicion2, /*da.formulario != '15' && c.persontype = '1'*/
				   da.fechanacimiento,
				   ln.ciudad AS lugarnacimiento1, /*da.formulario = '15'*/
				   lugar_nac.description AS lugarnacimiento2, /*da.formulario != '15' && c.persontype = '1'*/
				   pn.description AS paisnacimiento1, /*da.formulario = '15'*/
				   pp.description AS paisnacimiento2, /*da.formulario != '15' && c.persontype = '1'*/
				   pno.description AS nacionalidad_otra,
				   IF(c.persontype = '1', da.numerohijos, 'NA') AS numerohijos,
				   IF(c.persontype = '1', pe.description, 'NA') AS estadocivil, 
				   da.correoelectronico, 
				   da.celular, 
				   da.telefonoresidencia, 
				   da.direccionresidencia, 
				   CONCAT(cr.ciudad, ', ', cr.departamento) AS ciudadresidencia1, /*da.formulario = '15'*/
				   lugar_resi.description AS ciudadresidencia2, /*da.formulario != '15' && c.persontype = '1'*/
				   da.nombreempresa, 
				   da.direccionempresa,
				   da.nomenclatura,
				   da.telefonolaboral, 
				   ce.ciudad AS ciudadempresa, 
				   da.celularoficinappal, 
				   te1.description AS tipoempresaemp1, /*da.formulario = '15'*/
				   pac.description AS tipoempresaemp2, /*da.formulario != '15'*/
				   da.tipoempresaemp_cual, 
				   CASE da.recursos_publicos WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS recursos_publicos,
				   CASE da.poder_publico WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS poder_publico,
				   CASE da.reconocimiento_publico WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS reconocimiento_publico,
				   da.reconocimiento_cual, 
				   CASE da.servidor_publico WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS servidor_publico,
				   CASE da.expuesta_politica WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS expuesta_politica,
				   da.cargo_politica, 
				   da.cargo_politica_ini, 
				   da.cargo_politica_fin,
				   CASE da.expuesta_publica WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS expuesta_publica,
				   da.publica_nombre,
				   da.publica_cargo, 
				   CASE da.repre_internacional WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS repre_internacional,
				   da.internacional_indique, 
				   CASE da.tributarias_otro_pais WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS tributarias_otro_pais,
				   da.tributarias_paises, 
				   ac.description AS tipoactividad1, /*da.formulario = '15'*/
				   pta.description AS tipoactividad2, /*da.formulario != '15' && c.persontype = '1'*/
				   da.ciiu AS ciiu,
				   pf.description AS profesion, 
				   da.cargo, 
				   IF(c.persontype = '1', poc.description, 'NA') AS ocupacion, 
				   da.detalleocupacion,
				   da.detalleactividadeconomicappal AS actividadeconomicaempresa1, /*da.formulario = '15'*/
				   pac.description AS actividadeconomicaempresa2, /*da.formulario != '15'*/
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
				   in2.description AS otrosingresos1, /*da.formulario = '15'*/
				   poi.value AS otrosingresos2, /*da.formulario != '15' && c.persontype = '1'*/ 
				   da.conceptosotrosingresos, 
				   IF(c.persontype = '1', pes.description, 'NA') AS nivelestudios,
				   IF(c.persontype = '1', ptv.description, 'NA') AS tipovivienda,
				   IF(c.persontype = '1', da.estrato, 'NA') AS estrato,
				   da.razonsocial, 
				   da.nit, 
				   da.digitochequeo, 
				   te2.description AS tipoempresajur,
				   da.tipoempresajur_otra, 
				   da.detalleactividadeconomicappal AS actividadeconomica1, /*da.formulario = '15'*/
				   pact.description AS actividadeconomica2, /*da.formulario != '15' && da.actividadeconomicappal != '0'*/
				   'NA' AS detalleactividadeconomicappal1, /*da.formulario = '15'*/
				   da.detalleactividadeconomicappal AS detalleactividadeconomicappal2, /*da.formulario != '15'*/
				   da.ciiu AS ciiu, 
				   da.direccionoficinappal, 
				   co.ciudad AS ciudadoficina1, /*da.formulario = '15'*/
				   lugar_emp.description AS ciudadoficina2, /*da.formulario != '15' && c.persontype != '1'*/
				   da.telefonoficina, 
				   da.faxoficina,
				   da.correoelectronico_otro, 
				   da.celularoficina, 
				   da.direccionsucursal, 
				   lugar_sucursal.description AS ciudadsucursal, 
				   da.nomenclatura_emp2,
				   da.telefonosucursal, 
				   da.faxsucursal,
				   in3.description AS ingresosmensualesemp1, /*da.formulario = '15'*/
				   pine.value AS ingresosmensualesemp2, /*da.formulario != '15'*/
				   da.activosemp, 
				   da.pasivosemp, 
				   eg2.description AS egresosmensualesemp1, /*da.formulario = '15'*/
				   peme.value AS egresosmensualesemp2, /*da.formulario != '15'*/
				   da.patrimonio, 
				   in4.description AS otrosingresosemp,
				   da.concepto_otrosingresosemp, 
				   da.origen_fondos, 
				   da.procedencia_fondos,
				   CASE da.monedaextranjera WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS monedaextranjera,
				   tt.description AS tipotransacciones, 
				   da.tipotransacciones_cual, 
				   da.otras_operaciones, 
				   CASE da.productos_exterior WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS productos_exterior,
				   CASE da.cuentas_monedaextranjera WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS cuentas_monedaextranjera,
				   CASE da.reclamaciones WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS reclamaciones,
				   CASE da.auto_correo WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS auto_correo,
				   CASE da.auto_sms WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS auto_sms,
				   CASE da.firma WHEN 'Si' THEN 'SI' WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS firma,
				   CASE da.huella WHEN 'Si' THEN 'SI' WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS huella,
				   da.lugarentrevista, 
				   da.resultadoentrevista, 
				   da.fechaentrevista, 
				   CONCAT(da.horaentrevista, ' ', da.tipohoraentrevista) AS horaentrevista,
				   da.observacionesentrevista, 
				   da.nombreintermediario, 
				   da.clave_inter,
				   CASE da.firma_entrevista WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS firma_entrevista,
				   cv.ciudad AS verificacion_ciudad, 
				   da.verificacion_fecha, 
				   da.verificacion_hora, 
				   da.verificacion_nombre, 
				   da.verificacion_observacion, 
				   CASE da.verificacion_firma WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END AS verificacion_firma,
				   da.cantidad_registros,
				   da.creacion_cliente,
				   /*ESTADO DEL CLIENTE*/
				   da.id AS idData,
				   c.id AS clienteId,
				   da.formulario AS formularioId,
				   da.fuente,
				   c.tipo_norma_id,
				   c.regimen_id,
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
			  FROM data_matriz AS da
			 INNER JOIN client AS c ON(c.id = da.id_client)
			 INNER JOIN param_regimen AS reg ON(reg.id = c.regimen_id)
			 INNER JOIN param_tipo_norma AS ptn ON(ptn.id = c.tipo_norma_id)
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
			  LEFT JOIN param_actividad AS pact ON(pact.id = da.actividadeconomicappal)";

	if (!$conn->consultar($SQL)) exit;

	if ($conn->getNumeroRegistros() <= 0) exit;

	while ($d = $conn->sacarRegistro('str')) {
		$c = [];
		$vigencia = getEstadoInformacion2($d['clienteId'], $d['regimen_id']);
		$lugExp = (!empty($d['lugarexpedicion1']) && $d['lugarexpedicion1'] != 'SD' && $d['lugarexpedicion1'] != 'NA') ? $d['lugarexpedicion1'] : $d['lugarexpedicion2'];
		$lugNac = (!empty($d['lugarnacimiento1']) && $d['lugarnacimiento1'] != 'SD' && $d['lugarnacimiento1'] != 'NA') ? $d['lugarnacimiento1'] : $d['lugarnacimiento2'];
		$paiNac = (!empty($d['paisnacimiento1']) && $d['paisnacimiento1'] != 'SD' && $d['paisnacimiento1'] != 'NA') ? $d['paisnacimiento1'] : $d['paisnacimiento2'];
		$ciuRes = (!empty($d['ciudadresidencia1']) && $d['ciudadresidencia1'] != 'SD' && $d['ciudadresidencia1'] != 'NA') ? $d['ciudadresidencia1'] : $d['ciudadresidencia2'];
		$tipEmp = (!empty($d['tipoempresaemp1']) && $d['tipoempresaemp1'] != 'SD' && $d['tipoempresaemp1'] != 'NA') ? $d['tipoempresaemp1'] : $d['tipoempresaemp2'];
		$tipAct = (!empty($d['tipoactividad1']) && $d['tipoactividad1'] != 'SD' && $d['tipoactividad1'] != 'NA') ? $d['tipoactividad1'] : $d['tipoactividad2'];
		$actEco = (!empty($d['actividadeconomicaempresa1']) && $d['actividadeconomicaempresa1'] != 'SD' && $d['actividadeconomicaempresa1'] != 'NA') ? $d['actividadeconomicaempresa1'] : $d['actividadeconomicaempresa2'];
		$otrIng = (!empty($d['otrosingresos1']) && $d['otrosingresos1'] != 'SD' && $d['otrosingresos1'] != 'NA') ? $d['otrosingresos1'] : $d['otrosingresos2'];
		$actEco2 = (!empty($d['actividadeconomica1']) && $d['actividadeconomica1'] != 'SD' && $d['actividadeconomica1'] != 'NA') ? ((is_numeric($d['actividadeconomica1'])) ? 'SD' : $d['actividadeconomica1']) : $d['actividadeconomica2'];
		$detAct = (!empty($d['detalleactividadeconomicappal1']) && $d['detalleactividadeconomicappal1'] != 'SD' && $d['detalleactividadeconomicappal1'] != 'NA') ? $d['detalleactividadeconomicappal1'] : ((is_numeric($d['detalleactividadeconomicappal2'])) ? 'SD' : $d['detalleactividadeconomicappal2']);
		$ciuOfi = (!empty($d['ciudadoficina1']) && $d['ciudadoficina1'] != 'SD' && $d['ciudadoficina1'] != 'NA') ? $d['ciudadoficina1'] : $d['ciudadoficina2'];
		$ingMen = (!empty($d['ingresosmensualesemp1']) && $d['ingresosmensualesemp1'] != 'SD' && $d['ingresosmensualesemp1'] != 'NA') ? $d['ingresosmensualesemp1'] : $d['ingresosmensualesemp2'];
		$egrMen = (!empty($d['egresosmensualesemp1']) && $d['egresosmensualesemp1'] != 'SD' && $d['egresosmensualesemp1'] != 'NA') ? $d['egresosmensualesemp1'] : $d['egresosmensualesemp2'];
		$proSeg = (!empty($d['producto_seguro'])) ? $d['producto_seguro'] : 'SD';
		$c = [
			$d['persontype'],
			$d['document'],
			trim(preg_replace("/\s+/", " ", str_replace('"', '', $d['firstname']))),
			$d['tipodocumento_cli'],
			$d['formulario'],
			$d['fecharadicado'],
			$d['fechasolicitud'],
			$d['ciudad'],
			$d['sucursal'],
			$d['area'],
			$d['oficial'],
			$d['tipo_solicitud'],
			$d['clasecliente'],
			trim(preg_replace("/\s+/", " ", $d['cual_clasecliente'])),
			trim(preg_replace("/\s+/", " ", $d['primerapellido'])),
			trim(preg_replace("/\s+/", " ", $d['segundoapellido'])),
			trim(preg_replace("/\s+/", " ", $d['nombres'])),
			$d['sexo'],
			$d['tipodocumento'],
			$d['documento'],
			$d['fechaexpedicion'],
			$lugExp,
			$d['fechanacimiento'],
			$lugNac,
			$proSeg,
			$paiNac,
			$d['nacionalidad_otra'],
			$d['numerohijos'],
			$d['estadocivil'],
			$d['correoelectronico'],
			$d['celular'],
			$d['telefonoresidencia'],
			trim(preg_replace("/\s+/", " ", str_replace('"', '', $d['direccionresidencia']))),
			$ciuRes,
			trim(preg_replace("/\s+/", " ", str_replace('"', '', $d['nombreempresa']))),
			trim(preg_replace("/\s+/", " ", $d['direccionempresa'])),
			$d['nomenclatura'],
			$d['telefonolaboral'],
			$d['ciudadempresa'],
			$d['celularoficinappal'],
			$tipEmp,
			trim(preg_replace("/\s+/", " ", $d['tipoempresaemp_cual'])),
			$d['recursos_publicos'],
			$d['poder_publico'],
			$d['reconocimiento_publico'],
			trim(preg_replace("/\s+/", " ", $d['reconocimiento_cual'])),
			$d['servidor_publico'],
			$d['expuesta_politica'],
			$d['cargo_politica'],
			$d['cargo_politica_ini'],
			$d['cargo_politica_fin'],
			$d['expuesta_publica'],
			$d['publica_nombre'],
			$d['publica_cargo'],
			$d['repre_internacional'],
			$d['internacional_indique'],
			$d['pep_expuesto'],
			$d['expuesta_extrangero'],
			$d['expuesta_internacional'],
			$d['conyuge_expuesto'],
			$d['asociado_expuesto'],
			$d['pep_familiar'],
			$d['pep_familia_nombre'],
			$d['pep_familia_cargo'],
			$d['tributarias_otro_pais'],
			trim(preg_replace("/\s+/", " ", $d['tributarias_paises'])),
			$tipAct,
			$d['ciiu'],
			$d['profesion'],
			$d['cargo'],
			$d['ocupacion'],
			trim(preg_replace("/\s+/", " ", $d['detalleocupacion'])),
			$actEco,
			$d['ciiu_otro'],
			trim(preg_replace("/\s+/", " ", $d['direccionoficinappal'])),
			$d['nomenclatura_emp'],
			$d['telefonoficinappal'],
			trim(preg_replace("/\s+/", " ", $d['detalletipoactividad'])),
			$d['ingresosmensuales'],
			$d['totalactivos'],
			$d['totalpasivos'],
			$d['egresosmensuales'],
			$d['patrimonio'],
			$otrIng,
			trim(preg_replace("/\s+/", " ", $d['conceptosotrosingresos'])),
			$d['nivelestudios'],
			$d['tipovivienda'],
			$d['estrato'],
			trim(preg_replace("/\s+/", " ", str_replace('"', '', $d['razonsocial']))),
			$d['nit'],
			$d['digitochequeo'],
			$d['tipoempresajur'],
			trim(preg_replace("/\s+/", " ", $d['tipoempresajur_otra'])),
			$actEco2,
			$detAct,
			$d['ciiu'],
			trim(preg_replace("/\s+/", " ", $d['direccionoficinappal'])),
			$ciuOfi,
			$d['telefonoficina'],
			$d['faxoficina'],
			$d['correoelectronico_otro'],
			$d['celularoficina'],
			trim(preg_replace("/\s+/", " ", $d['direccionsucursal'])),
			$d['ciudadsucursal'],
			$d['nomenclatura_emp2'],
			$d['telefonosucursal'],
			$d['faxsucursal'],
			$ingMen,
			$d['activosemp'],
			$d['pasivosemp'],
			$egrMen,
			$d['patrimonio'],
			$d['otrosingresosemp'],
			trim(preg_replace("/\s+/", " ", $d['concepto_otrosingresosemp'])),
			trim(preg_replace("/\s+/", " ", $d['origen_fondos'])),
			$d['paisnacimiento2'],
			$d['monedaextranjera'],
			$d['tipotransacciones'],
			trim(preg_replace("/\s+/", " ", $d['tipotransacciones_cual'])),
			$d['otras_operaciones'],
			$d['productos_exterior'],
			$d['cuentas_monedaextranjera'],
			$d['reclamaciones'],
			$d['auto_correo'],
			$d['auto_sms'],
			$d['firma'],
			$d['huella'],
			$d['lugarentrevista'],
			$d['resultadoentrevista'],
			$d['fechaentrevista'],
			$d['horaentrevista'],
			trim(preg_replace("/\s+/", " ", str_replace('"', '', $d['observacionesentrevista']))),
			trim(preg_replace("/\s+/", " ", $d['nombreintermediario'])),
			$d['clave_inter'],
			$d['firma_entrevista'],
			$d['verificacion_ciudad'],
			$d['verificacion_fecha'],
			$d['verificacion_hora'],
			trim(preg_replace("/\s+/", " ", $d['verificacion_nombre'])),
			trim(preg_replace("/\s+/", " ", $d['verificacion_observacion'])),
			$d['verificacion_firma'],
			$d['cantidad_registros'],
			$d['creacion_cliente'],
			$vigencia,
			$d['fuente'],
			$d['tipo_norma_str'],
			$d['regimen_str']
		];

		fputcsv($fh, $c, "\t");

		unset($c);
		unset($d);
		unset($lugExp);
		unset($lugNac);
		unset($paiNac);
		unset($ciuRes);
		unset($tipEmp);
		unset($tipAct);
		unset($actEco);
		unset($otrIng);
		unset($actEco2);
		unset($detAct);
		unset($ciuOfi);
		unset($ingMen);
		unset($egrMen);
	}
	fclose($fh);
	exit;
}
function getEstadoInformacion2($id_client, $regimen_id = '2'){
	$intervalo = 365;
	$anios = 1;
	if ($regimen_id == '1') {
		return "No aplica";
	} else if($regimen_id == '2'){
		$intervalo = 730;
		$anios = 2;
	}
	$conn = new Conexion();
	$query = <<< SQL
            SELECT MAX(a.d) + INTERVAL $intervalo DAY AS date, (MAX(a.d) + INTERVAL $intervalo DAY) >= NOW() AS valid
            FROM
            (
                (
                    SELECT date_created AS d 
                      FROM data_capi_confirm
                     WHERE (id_contact BETWEEN 1 AND 3) 
                       AND id_client = $id_client 
                       AND status = 1 
                     ORDER BY date_created DESC 
                     LIMIT 1
                )UNION(
                    SELECT date_created AS d 
                      FROM data_confirm
                     WHERE (id_contact BETWEEN 1 AND 3) 
                       AND id_client = $id_client 
                       AND status = 1 
                     ORDER BY date_created DESC 
                     LIMIT 1
                )UNION(
                    SELECT CAST(d.fechasolicitud AS DATE) AS d 
                      FROM data AS d
                     INNER JOIN form AS f ON(f.id = d.id_form)
                     WHERE f.id_client = $id_client 
                     ORDER BY d.fechasolicitud DESC 
                     LIMIT 1
                )UNION(
                    SELECT fecha_datacredito AS d 
                      FROM client
                     WHERE id = $id_client 
                     LIMIT 1
                )
            ) AS a
SQL;
	$conn->consultar($query);
	if ($conn->getNumeroRegistros() <= 0) {
		$conn->desconectar();
		return "Desactualizado";
	}
	$data = $conn->sacarRegistro('str');
	$conn->desconectar();

	return $data['valid'] ? ("Vigente hasta " . date("Y-m-d", strtotime($data['date']))) : "Desactualizado";
}
