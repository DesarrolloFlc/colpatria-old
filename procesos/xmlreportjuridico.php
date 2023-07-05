<?php
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_SITE . DS . 'config/globalParameters.php';

$query = "SELECT cli.status_form,
				 data.nit AS nit,
				 '3' AS tipodocumento,
				 'NIT' AS tipo_documento,
				 data.razonsocial,
				 data.digitochequeo,
				 data.tipoempresaemp,
				 param_tipoempresa.description AS tipoorganizacion,
				 data.actividadeconomicappal AS idactividadeconomica,
				 param_actividad.description AS actividadeconomica,
				 data.activosemp,
				 '3' AS idactivosemp,
				 'pesos' AS unidadmedidaactivos,
				 data.pasivosemp,
				 '4' AS idpasivosemp,
				 'pesos' AS unidadmedidapasivos,
				 data.ingresosmensualesemp AS idingresosmensualesemp,
				 param_ingresosmensuales_emp.value AS ingresosmensualesemp,
				 data.egresosmensualesemp AS idegresosmensualesemp,
				 param_egresosmensuales_emp.value AS egresosmensualesemp,
				 ciudad_emp.description AS ciudademp,
				 data.direccionoficinappal AS direccionoficina,
				 data.telefonoficina AS telefonoficina,
				 data.faxoficina,
				 data.fechasolicitud,
				 cli.persontype
			FROM data 
		   INNER JOIN form formu ON (formu.id = data.id_form)
		   INNER JOIN client cli ON (cli.id = formu.id_client)
		    LEFT JOIN param_tipoempresa ON (param_tipoempresa.id = data.tipoempresaemp)
			LEFT JOIN param_ingresosmensuales_emp ON (param_ingresosmensuales_emp.id = data.ingresosmensualesemp)
			LEFT JOIN param_egresosmensuales_emp ON (param_egresosmensuales_emp.id = data.egresosmensualesemp)
			LEFT JOIN param_ciudad ciudad_emp ON (ciudad_emp.id = data.ciudadoficina)
			LEFT JOIN param_actividad ON (param_actividad.id = data.actividadeconomicappal)
		   WHERE cli.persontype = '2'
		   GROUP BY data.documento
		   ORDER BY formu.date_created";
/*
AND formu.date_created <= '2012-10-29'
GROUP BY data.documento
ORDER BY formu.date_created
LIMIT 0, 100
*/	
if (!$link) {
	echo "No hay conexion";
	exit;
}
$result = mysqli_query($GLOBALS['link'], $query);
if (!$result) {
	echo "No se pudo ejecutar la consulta (" . mysqli_error($link) . ")";
	exit;
}
$outDir = '../xmlreport/out';
@mkdir($outDir);
$file = fopen( $outDir . '/juridicos-' . date('Ymdhi') . '.xml', 'w');
if ($file) {
	echo "No se pudo generar el archivo";
	exit;
}
$fileClientes = '';
$fileEmpresas = '';
while($row = mysqli_fetch_assoc($result)){
	$row['ciudademp'] = explode(',', $row['ciudademp']);
	$ciudadRes = trim($row['ciudademp'][0], ' ');
	$depRes = isset($row['ciudademp'][1]) ? trim($row['ciudademp'][1], ' ') : "";
	$rowDane = getDANE($ciudadRes,$link);
	$CODciudadRes = $rowDane['cod_dane'];
	$CODdepRes = (int) $rowDane['cod_departamento'];

	$indicadoractivo = "";
	if ($row['activosemp'] != '' && $row['activosemp'] != '0') {
		$indicadoractivo = "
		<IndicadorFinanciero>
			<IDIndicadorFinanciero>3</IDIndicadorFinanciero>
			<DescripcionIndicadorFinanciero>Activos</DescripcionIndicadorFinanciero>
			<ValorIndicadorFinanciero>{$row['activosemp']}</ValorIndicadorFinanciero>
			<UnidadDeMedidaIndicador>
			<IDUnidadDeMedida>1</IDUnidadDeMedida>
			<NombreUnidadDeMedida>Pesos</NombreUnidadDeMedida>
			</UnidadDeMedidaIndicador>
			<PeriodicidadIndicador>
			<IDPeriodicidad>8</IDPeriodicidad>
			<ValorPeriodicidad>Anual</ValorPeriodicidad>
			</PeriodicidadIndicador>
		</IndicadorFinanciero>";
	}
	$indicadorpasivo = "";
	if ($row['pasivosemp'] != '' && $row['pasivosemp'] != '0') {
		$indicadorpasivo = "
		<IndicadorFinanciero>
			<IDIndicadorFinanciero>4</IDIndicadorFinanciero>
			<DescripcionIndicadorFinanciero>Pasivos</DescripcionIndicadorFinanciero>
			<ValorIndicadorFinanciero>{$row['pasivosemp']}</ValorIndicadorFinanciero>
			<UnidadDeMedidaIndicador>
			<IDUnidadDeMedida>1</IDUnidadDeMedida>
			<NombreUnidadDeMedida>Pesos</NombreUnidadDeMedida>
			</UnidadDeMedidaIndicador>
			<PeriodicidadIndicador>
			<IDPeriodicidad>8</IDPeriodicidad>
			<ValorPeriodicidad>Anual</ValorPeriodicidad>
			</PeriodicidadIndicador>
		</IndicadorFinanciero>";
	}
	$indicadoringresos = "";
	if ($row['ingresosmensualesemp'] != '' && $row['ingresosmensualesemp'] != '0') {
		$valoresI = minmaxingresos($row['idingresosmensualesemp']);
		$indicadoringresos = "				
		<IndicadorFinanciero>
			<IDIndicadorFinanciero>1</IDIndicadorFinanciero>
			<DescripcionIndicadorFinanciero>Ingresos Mensuales</DescripcionIndicadorFinanciero>
			<ValorIndicadorFinanciero>{$row['ingresosmensualesemp']}</ValorIndicadorFinanciero>
			<ValorMinimoRango>{$valoresI['min']}</ValorMinimoRango>
			<ValorMaximoRango>{$valoresI['max']}</ValorMaximoRango>
			<UnidadDeMedidaIndicador>
				<IDUnidadDeMedida>1</IDUnidadDeMedida>
				<NombreUnidadDeMedida>Pesos</NombreUnidadDeMedida>
			</UnidadDeMedidaIndicador>
			<PeriodicidadIndicador>
				<IDPeriodicidad>8</IDPeriodicidad>
				<ValorPeriodicidad>Anual</ValorPeriodicidad>
			</PeriodicidadIndicador>
		</IndicadorFinanciero>";
	}
	$indicadoregresos = "";
	if ($row['idegresosmensualesemp'] != '' && $row['idegresosmensualesemp'] != '0') {
		$valoresE = minmaxegregresos($row['idegresosmensualesemp']);
		$indicadoregresos = "
			<IndicadorFinanciero>
				<IDIndicadorFinanciero>2</IDIndicadorFinanciero>
				<DescripcionIndicadorFinanciero>Egresos Mensuales</DescripcionIndicadorFinanciero>
				<ValorIndicadorFinanciero>{$rangoE}</ValorIndicadorFinanciero>
				<ValorMinimoRango>{$valoresE['min']}</ValorMinimoRango>
				<ValorMaximoRango>{$valoresE['max']}</ValorMaximoRango>
				<UnidadDeMedidaIndicador>
					<IDUnidadDeMedida>1</IDUnidadDeMedida>
					<NombreUnidadDeMedida>Pesos</NombreUnidadDeMedida>
				</UnidadDeMedidaIndicador>
				<PeriodicidadIndicador>
					<IDPeriodicidad>8</IDPeriodicidad>
					<ValorPeriodicidad>Anual</ValorPeriodicidad>
				</PeriodicidadIndicador>
			</IndicadorFinanciero>";
	}

	$puntotelefono = '';
	if($row['telefonoficina'] != '' && $row['telefonoficina'] != '0'){
		$puntotelefono = "
		<PuntoContacto>
			<IDTipoPuntoContacto>1</IDTipoPuntoContacto>
			<TipoPuntoContacto>Telefono</TipoPuntoContacto>
			<IDUsoPuntoContacto>3</IDUsoPuntoContacto>
			<UsoPuntoContacto>Telefono oficina</UsoPuntoContacto>
			<ValorPuntoContacto>{$row['telefonoficina']}</ValorPuntoContacto>
			<EstadoPuntoContacto>
				<IDEstado>1</IDEstado>
				<ValorEstado>Activo</ValorEstado>
			</EstadoPuntoContacto>
		</PuntoContacto>";
	}
	$puntofax = '';
	if($row['faxoficina'] != '' && $row['faxoficina'] != '0'){
		$puntomail = "
		<PuntoContacto>
			<IDTipoPuntoContacto>1</IDTipoPuntoContacto>
			<TipoPuntoContacto>Fax</TipoPuntoContacto>
			<IDUsoPuntoContacto>3</IDUsoPuntoContacto>
			<UsoPuntoContacto>Fax oficina</UsoPuntoContacto>
			<ValorPuntoContacto>{$row['faxoficina']}</ValorPuntoContacto>
			<EstadoPuntoContacto>
				<IDEstado>1</IDEstado>
				<ValorEstado>Activo</ValorEstado>
			</EstadoPuntoContacto>
		</PuntoContacto>";
	}
	/*if($row['nacionalidad'] == '52')$row['nacionalidad'] = 57;*/
	$idGenero = (!empty($row['sexo']))? getIdGenero($row['sexo']): '';
	$fileClientes .= "
	<Organizacion>
		<IDCore>6</IDCore>
		<IDOrganizacion>{$row['nit']}</IDOrganizacion>
		<RolOrganizacion>
			<IDRolOrganizacion>1</IDRolOrganizacion>
			<NombreRol>Cliente</NombreRol>
		</RolOrganizacion>
		<NombreOrganizacion>{$row['razonsocial']}</NombreOrganizacion>
		<DocumentoOrganizacion>
			<IDTipoDocumento>3</IDTipoDocumento>
			<NumeroDocumento>{$row['nit']}</NumeroDocumento>
			<DigitoVerificacion>{$row['digitochequeo']}</DigitoVerificacion>
			<TipoDocumento>NIT</TipoDocumento>
		</DocumentoOrganizacion>
		<TipoOrganizacion>
			<IDTipoOrganizacion>{$row['tipoempresaemp']}</IDTipoOrganizacion>
			<NombreTipoOrganizacion>{$row['tipoorganizacion']}</NombreTipoOrganizacion>
			<DescripcionTipoOrganizacion>{$row['tipoorganizacion']}</DescripcionTipoOrganizacion>
			<ActividadEconomicaOrganizacion>{$row['actividadeconomica']}</ActividadEconomicaOrganizacion>
			<IDActividadEconomica>{$row['idactividadeconomica']}</IDActividadEconomica>
			<ActividadEconomica>{$row['actividadeconomica']}</ActividadEconomica>
		</TipoOrganizacion>	
		$indicadoractivo
		$indicadorpasivo
		$indicadoringresos
		$indicadoregresos
		<DireccionOrganizacion>
			<IDUsoDireccion>3</IDUsoDireccion>
			<UsoDireccion>Direccion de la oficina</UsoDireccion>
			<GeografiaDireccion>
			<IDPais>57</IDPais>
			<Pais>Colombia</Pais>
			<IDDepartamento>$CODdepRes</IDDepartamento>
			<Departamento>$depRes</Departamento>
			<IDCiudad>$CODciudadRes</IDCiudad>
			<Ciudad>$ciudadRes</Ciudad>
			</GeografiaDireccion>
			<Direccion>{$row['direccionoficina']}</Direccion>
			<EstadoDireccion>
			<IDEstado>1</IDEstado>
			<ValorEstado>Activo</ValorEstado>
			</EstadoDireccion>
		</DireccionOrganizacion>
		$puntotelefono
		$puntofax
		<EstadoOrganizacion>
			<IDEstado>1</IDEstado>
			<ValorEstado>Activo</ValorEstado>
		</EstadoOrganizacion>
		<FechaInicioRelacionComercial>2008-11-01</FechaInicioRelacionComercial>
	</Organizacion>\n";
}
fprintf($file, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
fprintf($file, "<Organizaciones>\n");
fprintf($file, $fileClientes);
fprintf($file, "</Organizaciones>\n");
fclose($file);
function rangosSMMV($valor, $unidad){
	$sal_min = 566700;
	switch ($unidad) {
		case 'SMMV':
			return $valor * $sal_min;
			break;
		case 'pesos':
			return $valor;
			break;
		case 'SD':
			return 0;
			break;
		default:
			return $valor * $sal_min;
			break;
	}
}
function minmaxingresos($id){
	$val = array();
	switch ($id) {
		case '1':
			$val['min'] = 0;
			$val['max'] = 100000000;
			return $val;
			break;
		case '2':
			$val['min'] = 100000001;
			$val['max'] = 500000000;
			return $val;
			break;
		case '3':
			$val['min'] = 500000001;
			$val['max'] = 1000000000;
			return $val;
			break;
		case '4':
			$val['min'] = 1000000001;
			$val['max'] = 5000000000;
			return $val;
			break;
		case '5':
			$val['min'] = 5000000001;
			$val['max'] = 20000000000;
			return $val;
			break;
		case '6':
			$val['min'] = 20000000001;
			$val['max'] = 50000000000;
			return $val;
			break;
		case '7':
			$val['min'] = 0;
			$val['max'] = 0;
			return $val;
			break;
		
		default:
			$val['min'] = 0;
			$val['max'] = 0;
			return $val;
			break;
	}
}
function minmaxegregresos($id){
	$val = array();
	switch ($id) {
		case '1':
			$val['min'] = 0;
			$val['max'] = 100000000;
			return $val;
			break;
		case '2':
			$val['min'] = 100000001;
			$val['max'] = 500000000;
			return $val;
			break;
		case '3':
			$val['min'] = 500000001;
			$val['max'] = 1000000000;
			return $val;
			break;
		case '4':
			$val['min'] = 1000000001;
			$val['max'] = 5000000000;
			return $val;
			break;
		case '5':
			$val['min'] = 5000000001;
			$val['max'] = 20000000000;
			return $val;
			break;
		case '6':
			$val['min'] = 20000000001;
			$val['max'] = 50000000000;
			return $val;
			break;
		case '7':
			$val['min'] = 0;
			$val['max'] = 0;
			return $val;
			break;
		
		default:
			$val['min'] = 0;
			$val['max'] = 0;
			return $val;
			break;
	}
}
function IDunidadMedida($unidad){
	$resp = 0;
	if($unidad == 'pesos'){
		$resp = 1;
	}
	if($unidad == 'SMMV'){
		$resp = 2;
	}
	return $resp;
}
function getIdGenero($genero){
	$gen = substr($genero, 0,1);
	switch ($gen) {
		case 'M':
			return 2;
			break;
		case 'F':
			return 1;
			break;		
		default:
			return 3;
			break;
	}
}
function getDANE($codCiudad,$link){
	$SQL = "SELECT cod_departamento, cod_dane FROM param_ciudadesdane WHERE ciudad LIKE '%$codCiudad%' AND estado = 0";
	$result = mysqli_query($GLOBALS['link'], $SQL);
	if($result){
		while($row = mysqli_fetch_assoc($result)){
			return $row;
		}
	}
}
?>