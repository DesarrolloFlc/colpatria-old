<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
header("Content-Type: text/html;charset=utf-8");
require "includes.php";
require_once PATH_CLASS.DS.'_conexion.php';
require_once PATH_PHPEXCEL.DS.'Classes'.DS.'PHPExcel.php';

dataDigitadosColpatria();
function dataDigitadosColpatria(){
	$conn = new Conexion();
	/*header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Description: File Transfer");
	header("Content-Encoding: UTF-8");
	header("Content-Type: text/csv; charset=UTF-8");
	header("Expires: 0");
	header("Pragma: public");
	echo "\xEF\xBB\xBF"; // UTF-8 BOM*/

	$header = array(
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
		'ESTADO'
	);
	$name = 'finleco_digitados_hasta_'.date('Ymd').'.xlsx';
	/*$fh = fopen(PATH_SARLAFT.DS.'finleco_digitados_hasta_'.date('Ymd').'.txt', 'a');
	fputcsv($fh, $header, "\t");*/

	$hoy = date('Y-m-d');
	$SQL = <<< SQL
	SELECT IF(cl.persontype = '1', 'NATURAL','JURIDICO') AS persontype,
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
		   no.description AS nacionalidad_otra, 
		   IF(cl.persontype = '1', da.numerohijos, 'NA') AS numerohijos,
		   IF(cl.persontype = '1', pe.description, 'NA') AS estadocivil, 
		   da.correoelectronico, 
		   da.celular, 
		   da.telefonoresidencia, 
		   da.direccionresidencia, 
		   IF(da.formulario IN ('15', '19', '20'), CONCAT(cr.ciudad, ', ', cr.departamento), IF(cl.persontype = '1', lugar_resi.description, '')) AS ciudadresidencia, 
		   da.nombreempresa, 
		   da.direccionempresa,
		   da.nomenclatura,
		   da.telefonolaboral, 
		   ce.ciudad AS ciudadempresa, 
		   da.celularoficinappal, 
		   IF(da.formulario IN ('15', '19', '20'), te1.description, pac.description) AS tipoempresaemp, 
		   da.tipoempresaemp_cual, 
		   CASE da.recursos_publicos WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS recursos_publicos,
		   CASE da.poder_publico WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS poder_publico,
		   CASE da.reconocimiento_publico WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS reconocimiento_publico,
		   da.reconocimiento_cual, 
		   CASE da.servidor_publico WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS servidor_publico,
		   CASE da.expuesta_politica WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS expuesta_politica,
		   da.cargo_politica, 
		   da.cargo_politica_ini, 
		   da.cargo_politica_fin,
		   CASE da.expuesta_publica WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS expuesta_publica,
		   da.publica_nombre, 
		   da.publica_cargo, 
		   CASE da.repre_internacional WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS repre_internacional,
		   da.internacional_indique, 
		   CASE da.tributarias_otro_pais WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS tributarias_otro_pais,
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
		   da.ciiu AS ciiu_, 
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
		   CASE da.monedaextranjera WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS monedaextranjera,
		   tt.description AS tipotransacciones, 
		   da.tipotransacciones_cual, 
		   da.otras_operaciones, 
		   CASE da.productos_exterior WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS productos_exterior,
		   CASE da.cuentas_monedaextranjera WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS cuentas_monedaextranjera,
		   CASE da.reclamaciones WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS reclamaciones,
		   CASE da.auto_correo WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS auto_correo,
		   CASE da.auto_sms WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS auto_sms,
		   CASE da.firma WHEN 'Si' THEN 'SI' WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS firma,
		   CASE da.huella WHEN 'Si' THEN 'SI' WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS huella,
		   da.lugarentrevista, 
		   da.resultadoentrevista, 
		   da.fechaentrevista, 
		   CONCAT(da.horaentrevista, ' ', da.tipohoraentrevista) AS horaentrevista, 
		   da.observacionesentrevista, 
		   da.nombreintermediario, 
		   da.clave_inter,
		   CASE da.firma_entrevista WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS firma_entrevista,
		   cv.ciudad AS verificacion_ciudad, 
		   da.verificacion_fecha, 
		   da.verificacion_hora, 
		   da.verificacion_nombre, 
		   da.verificacion_observacion, 
		   CASE da.verificacion_firma WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS verificacion_firma,
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
		   cl.regimen_id
	  FROM data AS da
	 INNER JOIN form AS fo ON(fo.id = da.id_form)
	 INNER JOIN client AS cl ON(cl.id = fo.id_client)
	 INNER JOIN radicados AS ra ON(ra.id = fo.log_lote)
	  LEFT OUTER JOIN radicados_items AS ri ON(cl.document = ri.documento AND fo.log_lote = ri.id_radicados)
	 INNER JOIN user AS ur ON(ur.id = ra.id_usuarioenvia)
	 INNER JOIN user AS ud ON(ud.id = fo.id_user)
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
	  LEFT JOIN param_paises AS no ON(no.id = da.nacionalidad_otra)
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
	  LEFT JOIN param_actividad AS pact ON(pact.id = da.actividadeconomicappal)
	 /*WHERE (fo.date_created BETWEEN '2007-01-01 00:00:00' AND '$hoy 23:59:59') */
	 WHERE (fo.date_created BETWEEN '2019-05-01 00:00:00' AND '2019-05-31 23:59:59')
	   AND fo.status = 1
SQL;
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			$objPHPExcel = new PHPExcel();

			// Set document properties
			$objPHPExcel->getProperties()->setCreator("FinlecoBPO Group")
				->setLastModifiedBy("FinlecoBPO Group")
				->setTitle("Reporte de clientes digitados en aplicativo")
				->setSubject("Clientes digitados")
				->setDescription("Reporte con el listado de clientes que fueron digitados en el proceso de sarlaf")
				->setKeywords("Reporte de clientes digitados")
				->setCategory("Reportes de clientes");

			// Add some data
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle("Todo");
			$objPHPExcel->getActiveSheet()->fromArray($header, null, 'A1');
			$cont = 2;
			/*while($dat = $conn->sacarRegistro('str')){
				$objPHPExcel->getActiveSheet()->fromArray($dat, null, 'A'.$cont);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$cont)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
				$cont++;
			}*/
			//exit;
            while($dat = $conn->sacarRegistro('str')){
            	$idData = $dat['idData'];
				$acci = getAccionistas($idData);
				$recl = getReclamaciones($idData);
				$prod = getProductos($idData);

				$formularioId = $dat['formularioId'];
				$socio1 = "";
				$socio2 = "";
				$socio3 = "";
				if($formularioId != '15'){
					$socio1 = $dat['socio1'];
					$socio2 = $dat['socio2'];
					$socio3 = $dat['socio3'];
				}

				if(is_null($dat['fecha_envio']) || empty($dat['fecha_envio']) || $dat['fecha_envio'] == '0000-00-00')
					$dat['fecha_envio'] = "2013-06-12";
				else
					$dat['fecha_envio'] = $dat['fecha_envio'];

				if(is_null($dat['fecha_recibido']) || empty($dat['fecha_recibido']) || $dat['fecha_recibido'] == '0000-00-00')
					$dat['fecha_recibido'] = "2013-06-12";
				else
					$dat['fecha_recibido'] = $dat['fecha_recibido'];

				if($dat['date_created'] == "")
					$dat['date_created'] = "SD";

				if($dat['detalleactividadeconomicappal'] == "")
					$dat['detalleactividadeconomicappal'] = "NA";

				if($dat['actividadeconomicaempresa'] == "")
					$dat['actividadeconomicaempresa'] = "NA";

				if($dat['detalletipoactividad'] == "")
					$dat['detalletipoactividad'] = "NA";

				if($dat['nombreempresa'] == "")
					$dat['nombreempresa'] = "NA";

				if($dat['nomenclatura'] == "")
					$dat['nomenclatura'] = "NA";

				$ultimoestado = getEstadoInformacion($dat['clienteId'], $dat['regimen_id']);

				$row = array(
					trim(preg_replace("/\s+/", " ", $dat['persontype'])), 
					trim(preg_replace("/\s+/", " ", $dat['document'])), 
					trim(preg_replace("/\s+/", " ", $dat['firstname'])), 
					trim(preg_replace("/\s+/", " ", $dat['tipodocumento_cli'])), 
					trim(preg_replace("/\s+/", " ", $dat['log_planilla'])), 
					trim(preg_replace("/\s+/", " ", $dat['log_lote'])), 
					trim(preg_replace("/\s+/", " ", $dat['formulario'])), 
					trim(preg_replace("/\s+/", " ", $dat['fecharadicado'])),//date('d/m/Y', PHPExcel_Shared_Date::ExcelToPHP($dat['fecharadicado'])))), 
					trim(preg_replace("/\s+/", " ", $dat['fecha_envio'])), 
					trim(preg_replace("/\s+/", " ", $dat['fecha_recibido'])), 
					trim(preg_replace("/\s+/", " ", $dat['fechasolicitud'])), 
					trim(preg_replace("/\s+/", " ", $dat['date_created'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ciudad'])), 'ciu'), 
					trim(preg_replace("/\s+/", " ", $dat['sucursal'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['area'])), 'str'), 
					trim(preg_replace("/\s+/", " ", $dat['oficial'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipo_solicitud'])), 'str'), 
					trim(preg_replace("/\s+/", " ", $dat['clasecliente'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['cual_clasecliente'])), 'str'), 
					trim(preg_replace("/\s+/", " ", $dat['primerapellido'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['segundoapellido'])), 'str'), 
					trim(preg_replace("/\s+/", " ", $dat['nombres'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['sexo'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipodocumento'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['documento'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['fechaexpedicion'])), 'fec'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['lugarexpedicion'])), 'ciu'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['fechanacimiento'])), 'fec'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['lugarnacimiento'])), 'ciu'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['paisnacimiento'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['nacionalidad_otra'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['numerohijos'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['estadocivil'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['correoelectronico'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['celular'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['telefonoresidencia'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['direccionresidencia'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ciudadresidencia'])), 'ciu'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['nombreempresa'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['direccionempresa'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['nomenclatura'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['telefonolaboral'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ciudadempresa'])), 'ciu'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['celularoficinappal'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipoempresaemp'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipoempresaemp_cual'])), 'str'), 
					trim(preg_replace("/\s+/", " ", $dat['recursos_publicos'])), 
					trim(preg_replace("/\s+/", " ", $dat['poder_publico'])), 
					trim(preg_replace("/\s+/", " ", $dat['reconocimiento_publico'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['reconocimiento_cual'])), 'str'), 
					trim(preg_replace("/\s+/", " ", $dat['servidor_publico'])), 
					trim(preg_replace("/\s+/", " ", $dat['expuesta_politica'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['cargo_politica'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['cargo_politica_ini'])), 'fec'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['cargo_politica_fin'])), 'fec'), 
					trim(preg_replace("/\s+/", " ", $dat['expuesta_publica'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['publica_nombre'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['publica_cargo'])), 'str'), 
					trim(preg_replace("/\s+/", " ", $dat['repre_internacional'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['internacional_indique'])), 'str'), 
					trim(preg_replace("/\s+/", " ", $dat['tributarias_otro_pais'])), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tributarias_paises'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipoactividad'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ciiu'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['profesion'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['cargo'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ocupacion'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['detalleocupacion'])), 'str'), 
					trim(preg_replace("/\s+/", " ", $dat['actividadeconomicaempresa'])), /**/
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ciiu_otro'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['direccionoficinappal'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['nomenclatura_emp'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['telefonoficinappal'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['detalletipoactividad'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ingresosmensuales'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['totalactivos'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['totalpasivos'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['egresosmensuales'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['patrimonio'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['otrosingresos'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['conceptosotrosingresos'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['nivelestudios'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipovivienda'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['estrato'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['razonsocial'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['nit'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['digitochequeo'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipoempresajur'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipoempresajur_otra'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['actividadeconomica'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['detalleactividadeconomicappal'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ciiu_'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['direccionoficinappal'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ciudadoficina'])), 'ciu'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['telefonoficina'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['faxoficina'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['correoelectronico_otro'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['celularoficina'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['direccionsucursal'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ciudadsucursal'])), 'ciu'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['nomenclatura_emp2'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['telefonosucursal'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['faxsucursal'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['ingresosmensualesemp'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['activosemp'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['pasivosemp'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['egresosmensualesemp'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['patrimonio'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['otrosingresosemp'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['concepto_otrosingresosemp'])), 'str'), 
					CleanDat(((isset($acci[0][1])) ? $acci[0][1] : ''), 'str'), 
					CleanDat(((isset($acci[0][2])) ? $acci[0][2] : $socio1), 'tel'), 
					CleanDat(((isset($acci[0][3])) ? $acci[0][3] : ''), 'str'), 
					CleanDat(((isset($acci[0][4])) ? $acci[0][4] : ''), 'num'), 
					CleanDat(((isset($acci[0][5])) ? $acci[0][5] : ''), 'str'), 
					CleanDat(((isset($acci[0][6])) ? $acci[0][6] : ''), 'str'), 
					CleanDat(((isset($acci[0][7])) ? $acci[0][7] : ''), 'str'), 
					CleanDat(((isset($acci[0][8])) ? $acci[0][8] : ''), 'str'),  
					CleanDat(((isset($acci[1][1])) ? $acci[1][1] : ''), 'str'), 
					CleanDat(((isset($acci[1][2])) ? $acci[1][2] : $socio2), 'tel'), 
					CleanDat(((isset($acci[1][3])) ? $acci[1][3] : ''), 'str'), 
					CleanDat(((isset($acci[1][4])) ? $acci[1][4] : ''), 'num'), 
					CleanDat(((isset($acci[1][5])) ? $acci[1][5] : ''), 'str'), 
					CleanDat(((isset($acci[1][6])) ? $acci[1][6] : ''), 'str'), 
					CleanDat(((isset($acci[1][7])) ? $acci[1][7] : ''), 'str'), 
					CleanDat(((isset($acci[1][8])) ? $acci[1][8] : ''), 'str'), 
					CleanDat(((isset($acci[2][1])) ? $acci[2][1] : ''), 'str'), 
					CleanDat(((isset($acci[2][2])) ? $acci[2][2] : $socio3), 'tel'), 
					CleanDat(((isset($acci[2][3])) ? $acci[2][3] : ''), 'str'), 
					CleanDat(((isset($acci[2][4])) ? $acci[2][4] : ''), 'num'), 
					CleanDat(((isset($acci[2][5])) ? $acci[2][5] : ''), 'str'), 
					CleanDat(((isset($acci[2][6])) ? $acci[2][6] : ''), 'str'), 
					CleanDat(((isset($acci[2][7])) ? $acci[2][7] : ''), 'str'), 
					CleanDat(((isset($acci[2][8])) ? $acci[2][8] : ''), 'str'), 
					CleanDat(((isset($acci[3][1])) ? $acci[3][1] : ''), 'str'), 
					CleanDat(((isset($acci[3][2])) ? $acci[3][2] : ''), 'tel'), 
					CleanDat(((isset($acci[3][3])) ? $acci[3][3] : ''), 'str'), 
					CleanDat(((isset($acci[3][4])) ? $acci[3][4] : ''), 'num'), 
					CleanDat(((isset($acci[3][5])) ? $acci[3][5] : ''), 'str'), 
					CleanDat(((isset($acci[3][6])) ? $acci[3][6] : ''), 'str'), 
					CleanDat(((isset($acci[3][7])) ? $acci[3][7] : ''), 'str'), 
					CleanDat(((isset($acci[3][8])) ? $acci[3][8] : ''), 'str'), 
					CleanDat(((isset($acci[4][1])) ? $acci[4][1] : ''), 'str'), 
					CleanDat(((isset($acci[4][2])) ? $acci[4][2] : ''), 'tel'), 
					CleanDat(((isset($acci[4][3])) ? $acci[4][3] : ''), 'str'), 
					CleanDat(((isset($acci[4][4])) ? $acci[4][4] : ''), 'num'), 
					CleanDat(((isset($acci[4][5])) ? $acci[4][5] : ''), 'str'), 
					CleanDat(((isset($acci[4][6])) ? $acci[4][6] : ''), 'str'), 
					CleanDat(((isset($acci[4][7])) ? $acci[4][7] : ''), 'str'), 
					CleanDat(((isset($acci[4][8])) ? $acci[4][8] : ''), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['origen_fondos'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['procedencia_fondos'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['monedaextranjera'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipotransacciones'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['tipotransacciones_cual'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['otras_operaciones'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['productos_exterior'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['cuentas_monedaextranjera'])), 'str'), 
					CleanDat(((isset($prod[0][1])) ? $prod[0][1] : ''), 'str'), 
					CleanDat(((isset($prod[0][2])) ? $prod[0][2] : ''), 'tel'), 
					CleanDat(((isset($prod[0][3])) ? $prod[0][3] : ''), 'str'), 
					CleanDat(((isset($prod[0][4])) ? $prod[0][4] : ''), 'tel'), 
					CleanDat(((isset($prod[0][6])) ? $prod[0][6] : ''), 'str'), 
					CleanDat(((isset($prod[0][5])) ? $prod[0][5] : ''), 'str'), 
					CleanDat(((isset($prod[0][7])) ? $prod[0][7] : ''), 'tel'), 
					CleanDat(((isset($prod[1][1])) ? $prod[1][1] : ''), 'str'), 
					CleanDat(((isset($prod[1][2])) ? $prod[1][2] : ''), 'tel'), 
					CleanDat(((isset($prod[1][3])) ? $prod[1][3] : ''), 'str'), 
					CleanDat(((isset($prod[1][4])) ? $prod[1][4] : ''), 'tel'), 
					CleanDat(((isset($prod[1][6])) ? $prod[1][6] : ''), 'str'), 
					CleanDat(((isset($prod[1][5])) ? $prod[1][5] : ''), 'str'), 
					CleanDat(((isset($prod[1][7])) ? $prod[1][7] : ''), 'tel'), 
					CleanDat(((isset($prod[2][1])) ? $prod[2][1] : ''), 'str'), 
					CleanDat(((isset($prod[2][2])) ? $prod[2][2] : ''), 'tel'), 
					CleanDat(((isset($prod[2][3])) ? $prod[2][3] : ''), 'str'), 
					CleanDat(((isset($prod[2][4])) ? $prod[2][4] : ''), 'tel'), 
					CleanDat(((isset($prod[2][6])) ? $prod[2][6] : ''), 'str'), 
					CleanDat(((isset($prod[2][5])) ? $prod[2][5] : ''), 'str'), 
					CleanDat(((isset($prod[2][7])) ? $prod[2][7] : ''), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['reclamaciones'])), 'str'), 
					CleanDat(((isset($recl[0][1])) ? $recl[0][1] : ''), 'tel'), 
					CleanDat(((isset($recl[0][2])) ? $recl[0][2] : ''), 'str'), 
					CleanDat(((isset($recl[0][3])) ? $recl[0][3] : ''), 'str'), 
					CleanDat(((isset($recl[0][4])) ? $recl[0][4] : ''), 'tel'), 
					CleanDat(((isset($recl[0][5])) ? $recl[0][5] : ''), 'str'), 
					CleanDat(((isset($recl[1][1])) ? $recl[1][1] : ''), 'tel'), 
					CleanDat(((isset($recl[1][2])) ? $recl[1][2] : ''), 'str'), 
					CleanDat(((isset($recl[1][3])) ? $recl[1][3] : ''), 'str'), 
					CleanDat(((isset($recl[1][4])) ? $recl[1][4] : ''), 'tel'), 
					CleanDat(((isset($recl[1][5])) ? $recl[1][5] : ''), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['auto_correo'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['auto_sms'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['firma'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['huella'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['lugarentrevista'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['resultadoentrevista'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['fechaentrevista'])), 'fec'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['horaentrevista'])), 'num'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['observacionesentrevista'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['nombreintermediario'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['clave_inter'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['firma_entrevista'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['verificacion_ciudad'])), 'ciu'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['verificacion_fecha'])), 'fec'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['verificacion_hora'])), 'tel'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['verificacion_nombre'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['verificacion_observacion'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['verificacion_firma'])), 'str'), 
					CleanDat(trim(preg_replace("/\s+/", " ", $dat['usuario_digitador'])), 'str'), 
					$ultimoestado
				);
                //fputcsv($fh, $row, "\t");
				$objPHPExcel->getActiveSheet()->fromArray($row, null, 'A'.$cont);
				
				$cont++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('H')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save(PATH_SARLAFT.DS.$name);
            // Close the file
            //fclose($fh);
            // Make sure nothing else is sent, our file is done
            exit();
        }
    }
}
function getEstadoInformacion($id_client, $regimen_id = '2') {
	$intervalo = 365;
	$anios = 1;
	if($regimen_id == '1')
		return "No aplica";
	else if($regimen_id == '2'){
		$intervalo = 730;
		$anios = 2;
	}
	$conn = new Conexion();
	$query = <<< SQL
	SELECT MAX(a.d) + INTERVAL $intervalo DAY AS date, (MAX(a.d) + INTERVAL $intervalo DAY) >= NOW() AS valid
	  FROM (
	  			(SELECT date_created AS d
	  			   FROM data_capi_confirm
	  			  WHERE id_contact BETWEEN 1 AND 3
	  			    AND id_client = $id_client
	  			    AND status = 1
	  			  ORDER BY date_created DESC LIMIT 1
	  			)
	  			UNION
		        (SELECT date_created AS d
		           FROM data_confirm
		          WHERE id_contact BETWEEN 1 AND 3
		            AND id_client = $id_client
		            AND status = 1
		          ORDER BY date_created DESC LIMIT 1
		        )
		        UNION
		        (SELECT CAST(data.fechasolicitud AS DATE) AS d
		           FROM data
		          INNER JOIN form ON form.id = data.id_form
		          WHERE form.id_client = $id_client
		          ORDER BY data.fechasolicitud DESC LIMIT 1
		        )
		        UNION
		        (SELECT fecha_datacredito AS d
		           FROM client
		          WHERE id = $id_client LIMIT 1
		        )
		    ) AS a
SQL;
	if($conn->consultar($query)){
		if($conn->getNumeroRegistros() > 0){
			$data = $conn->sacarRegistro('str');
			if($data['valid'])
				return "Vigente hasta " . date("Y-m-d", strtotime($data['date']));
			else
				return "Desactualizado";
			
		}
	}
}
function getAccionistas($idData){
	$conn = new Conexion();
	$data = array();
	$SQL = "SELECT da.id,
				   ptd.description AS tipo_id, 
				   da.identificacion,
				   da.nombre_accionista,
				   da.porcentaje,
				   CASE da.publico_recursos WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END,
				   CASE da.publico_reconocimiento WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END,
				   CASE da.publico_expuesta WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END,
				   da.declaracion_tributaria
			  FROM data_socios AS da
			 INNER JOIN param_tipodocumento AS ptd ON(ptd.id = da.tipo_id)
			 WHERE data_id = '$idData'";
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			while ($dat = $conn->sacarRegistro('num')) {
				$data[] = $dat;
			}
		}
	}
	$conn->desconectar();
	return $data;
}
function getReclamaciones($idData){
	$conn = new Conexion();
	$data = array();
	$SQL = "SELECT id,
				   rec_ano,
				   rec_ramo,
				   rec_compania,
				   rec_valor,
				   rec_resultado
			  FROM data_reclamaciones 
			 WHERE data_id = '$idData'";
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			while ($dat = $conn->sacarRegistro('num')) {
				$data[] = $dat;
			}
		}
	}
	$conn->desconectar();
	return $data;
}
function getProductos($idData){
	$conn = new Conexion();
	$data = array();
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
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			while ($dat = $conn->sacarRegistro('num')) {
				$data[] = $dat;
			}
		}
	}
	$conn->desconectar();
	return $data;
}
function CleanDat($dat, $tipo){
	switch ($tipo) {
		case 'str':
			if(empty($dat) || is_null($dat))
				return 'SD';
			break;
		case 'num':
			if($dat == '' || is_null($dat) || strtoupper($dat) == 'NA' || strtoupper($dat) == 'N/A' || strtoupper($dat) == 'SD')
				return '*';
			break;
		case 'fec':
			$fec = date("Y-m-d", strtotime($dat));
			if(empty($dat) || is_null($dat) || ($fec == '1969-12-31' && $fec != $dat))
				return '0000-00-00';
			break;
		case 'ciu':
			if(empty($dat) || is_null($dat))
				return 'SD, SD';
			break;
		case 'tel':
			if(empty($dat) || is_null($dat) || strtoupper($dat) == 'NA' || strtoupper($dat) == 'N/A' || strtoupper($dat) == 'SD')
				return '*';
	}
	return $dat;
}
?>