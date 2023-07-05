<?php
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_SITE . DS . 'config/globalParameters.php';

$query = "SELECT cli.status_form,
				 data.documento AS documento,
				 data.tipodocumento,
				 param_tipodocumento.description AS tipo_documento,
				 data.primerapellido,
				 data.segundoapellido,
				 data.nombres,
				 data.sexo,
				 data.fechasolicitud,
				 data.fecharadicado,
				 data.fechanacimiento,
				 data.lugarnacimiento AS idlugarnacimiento,
				 lugar_nac.description AS lugarnacimiento,
				 data.nacionalidad,
				 param_pais.description AS paisdescripcion,
				 data.estadocivil AS id_estado_civil,
				 param_estadocivil.description AS estado_civil,
				 data.estrato AS estrato,
				 data.cargo AS cargo,
				 param_actividadecono.id AS actividadId,
				 param_actividadecono.description AS actividad,
				 param_ingresosmensuales.description AS ingresosmensuales,
				 param_ingresosmensuales.min AS ingresosmin,
				 param_ingresosmensuales.max AS ingresosmax,
				 param_ingresosmensuales.unidad AS ingresosunidad,
				 param_otrosingresos.description AS otrosingresos,
				 param_otrosingresos.min AS otrosmin,
				 param_otrosingresos.max AS otrosmax,
				 param_otrosingresos.unidad AS otrosunidad,
				 param_egresosmensuales.description AS egresosmensuales,
				 param_egresosmensuales.min AS egresosmin,
				 param_egresosmensuales.max AS egresosmax,
				 param_egresosmensuales.unidad AS egresosunidad,
				 data.conceptosotrosingresos,
				 data.nivelestudios AS idnivelestudios,
				 param_estudio.description AS nivelestudios,
				 data.telefonoresidencia,
				 data.correoelectronico,
				 param_profesion.id AS idprofesion,
				 param_profesion.description AS profesion,
				 param_tipoactividad.id AS idtipoactividad,
				 param_tipoactividad.description AS tipoactividad,
				 data.direccionresidencia,
				 data.ciudadresidencia AS idciudadresidencia,
				 lugar_resi.description AS ciudadresidencia,
				 cli.persontype
			FROM client cli 
		   INNER JOIN form formu ON formu.id_client = cli.id 
		   INNER JOIN data ON formu.id = data.id_form 
		    LEFT JOIN param_sucursales sucursal ON sucursal.id = data.sucursal 
			LEFT JOIN param_area ON param_area.id = data.area  
			LEFT JOIN param_formulario ON param_formulario.id = data.formulario
			LEFT JOIN param_clasecliente ON  param_clasecliente.id = data.clasecliente 
			LEFT JOIN param_tipodocumento ON param_tipodocumento.id = data.tipodocumento 
			LEFT JOIN param_ciudad lugar_exp ON lugar_exp.id = data.lugarexpedicion 
			LEFT JOIN param_ciudad lugar_nac ON lugar_nac.id = data.lugarnacimiento
			LEFT JOIN param_pais ON param_pais.id = data.nacionalidad
			LEFT JOIN param_estadocivil ON param_estadocivil.id = data.estadocivil
			LEFT JOIN param_ciudad lugar_resi ON lugar_resi.id = data.ciudadresidencia
			LEFT JOIN param_ciudad lugar_emp ON lugar_emp.id = data.ciudadempresa
			LEFT JOIN param_actividadecono ON param_actividadecono.id = data.actividadeconomicaempresa
			LEFT JOIN param_profesion ON param_profesion.id = data.profesion
			LEFT JOIN param_ocupacion ON param_ocupacion.id = data.ocupacion
			LEFT JOIN param_ciiu ON param_ciiu.codigo = data.ciiu 
			LEFT JOIN param_ingresosmensuales ON param_ingresosmensuales.id = data.ingresosmensuales
			LEFT JOIN param_otrosingresos ON param_otrosingresos.id = data.otrosingresos 
			LEFT JOIN param_egresosmensuales ON param_egresosmensuales.id = data.egresosmensuales 
			LEFT JOIN param_tipoactividad ON param_tipoactividad.id = data.tipoactividad
			LEFT JOIN param_estudio ON param_estudio.id = data.nivelestudios
			LEFT JOIN param_tipovivienda ON param_tipovivienda.id = data.tipovivienda
			LEFT JOIN param_ciudad lugar_oficina ON lugar_oficina.id = data.ciudadoficina
			LEFT JOIN param_ciudad lugar_sucursal ON lugar_sucursal.id = data.ciudadsucursal
			LEFT JOIN param_actividad ON param_actividad.id = data.actividadeconomicappal
			LEFT JOIN param_tipoempresa ON param_tipoempresa.id = data.tipoempresaemp
			LEFT JOIN param_ingresosmensuales_emp ON param_ingresosmensuales_emp.id = data.ingresosmensualesemp
			LEFT JOIN param_egresosmensuales_emp ON param_egresosmensuales_emp.id = data.egresosmensualesemp
			LEFT JOIN param_tipotransacciones ON param_tipotransacciones.id = data.tipotransacciones
		   INNER JOIN user ON user.id = formu.id_user 
			LEFT JOIN data_confirm confirma ON confirma.id_form = data.id_form 
			LEFT JOIN user usercont ON usercont.id = confirma.id_user 
			LEFT JOIN param_contact ON param_contact.id = confirma.id_contact 
		   WHERE cli.persontype = '1'
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
@mkdir($outDir);/**/
$file = fopen($outDir . '/naturales-' . date('Ymdhi') . '.xml', 'w');
if(!$file){
	echo "No se pudo generar el archivo";
	exit;
}
$fileClientes = '';
$fileEmpresas = '';
while ($row = mysqli_fetch_assoc($result)) {
	if ($row['persontype'] != '1') {
		continue;
	}
	//Rangos y unidades de INGRESOS
	if($row['ingresosunidad'] == '' || $row['ingresosunidad'] == 'NULL'){
		$row['ingresosunidad'] = 'SD';
		$row['ingresosmax']=0;
		$row['ingresosmin']=0;
	}

	$rangoI = rangosSMMV($row['ingresosmax'], $row['ingresosunidad']);
	$IDrangoI = IDunidadMedida($row['ingresosunidad']);
	//Rangos y unidades de EGRESOS
	if($row['egresosunidad'] == '' || $row['egresosunidad'] == 'NULL'){
		$row['egresosunidad'] = 'SD';
		$row['egresosmax']=0;
		$row['egresosmin']=0;
	}

	$rangoE = rangosSMMV($row['egresosmax'], $row['egresosunidad']);
	$IDrangoE = IDunidadMedida($row['egresosunidad']);
	//Rangos y unidades de OTROS
	if($row['otrosunidad'] == '' || $row['otrosunidad'] == 'NULL'){
		$row['otrosunidad'] = 'SD';
		$row['otrosmax']=0;
		$row['otrosmin']=0;
	}
	
	$rangoO = rangosSMMV($row['otrosmax'], $row['otrosunidad']);
	$IDrangoO = IDunidadMedida($row['otrosunidad']);

	$row['lugarnacimiento'] = explode(',', $row['lugarnacimiento']);
	$ciudadNAc = trim($row['lugarnacimiento'][0], ' ');
	if(isset($row['lugarnacimiento'][1])){
		$depNAc = trim($row['lugarnacimiento'][1], ' ');
	}else{
		$depNAc = "";
	}
	$rowDane1 = getDANE($ciudadNAc,$link);
	$CODciudadNAc = $rowDane1['cod_dane'];
	$CODdepNAc = $rowDane1['cod_departamento'];

	$row['ciudadresidencia'] = explode(',', $row['ciudadresidencia']);
	$ciudadRes = trim($row['ciudadresidencia'][0], ' ');					
	if(isset($row['ciudadresidencia'][1])){
		$depRes = trim($row['ciudadresidencia'][1], ' ');
	}else{
		$depRes = "";
	}
	$rowDane = getDANE($ciudadRes,$link);
	$CODciudadRes = $rowDane['cod_dane'];
	$CODdepRes = (int)$rowDane['cod_departamento'];

	$puntotelefono = '';
	if($row['telefonoresidencia'] != '' && $row['telefonoresidencia'] != '0'){
		$puntotelefono = "
		<PuntoContacto>
			<IDTipoPuntoContacto>1</IDTipoPuntoContacto>
			<TipoPuntoContacto>Telefono</TipoPuntoContacto>
			<IDUsoPuntoContacto>1</IDUsoPuntoContacto>
			<UsoPuntoContacto>Telefono de la casa</UsoPuntoContacto>
			<ValorPuntoContacto>{$row['telefonoresidencia']}</ValorPuntoContacto>
			<EstadoPuntoContacto>
				<IDEstado>1</IDEstado>
				<ValorEstado>Activo</ValorEstado>
			</EstadoPuntoContacto>
		</PuntoContacto>";
	}
	$puntomail = '';
	if($row['correoelectronico'] != ''){
		$puntomail = "
		<PuntoContacto>
			<IDTipoPuntoContacto>2</IDTipoPuntoContacto>
			<TipoPuntoContacto>Mail</TipoPuntoContacto>
			<IDUsoPuntoContacto>2</IDUsoPuntoContacto>
			<UsoPuntoContacto>Mail</UsoPuntoContacto>
			<ValorPuntoContacto>{$row['correoelectronico']}</ValorPuntoContacto>
			<EstadoPuntoContacto>
				<IDEstado>1</IDEstado>
				<ValorEstado>Activo</ValorEstado>
			</EstadoPuntoContacto>
		</PuntoContacto>";
	}
	$nivelestrato = '';
	if($row['estrato'] != '' && $row['estrato'] != 'SD'){
		$nivelestrato = "
		<NivelSocioEconomicoPersona>
			<IDNivelSocioEconomico>{$row['estrato']}</IDNivelSocioEconomico>
			<NivelSocioEconomico>Estrato {$row['estrato']}</NivelSocioEconomico>
		</NivelSocioEconomicoPersona>";
	}
	/*if($row['nacionalidad'] == '52')$row['nacionalidad'] = 57;*/
	$idGenero = (!empty($row['sexo']))? getIdGenero($row['sexo']): '';
	$fileClientes .= "
	<Persona>
		<IDCore>6</IDCore>
		<IDPersona>{$row['documento']}</IDPersona>
		<RolPersona>
			<IDRolPersona>1</IDRolPersona>
			<NombreRol>Cliente</NombreRol>
		</RolPersona>
		<PrefijoPersona />
		<PrimerNombrePersona>{$row['nombres']}</PrimerNombrePersona>
		<PrimerApellidoPersona>{$row['primerapellido']}</PrimerApellidoPersona>
		<SegundoApellidoPersona>{$row['segundoapellido']}</SegundoApellidoPersona>
		<DocumentoPersona>
			<IDTipoDocumento>{$row['tipodocumento']}</IDTipoDocumento>
			<NumeroDocumento>{$row['documento']}</NumeroDocumento>
			<TipoDocumento>{$row['tipo_documento']}</TipoDocumento>
		</DocumentoPersona>
		<FechaNacimiento>{$row['fechanacimiento']}</FechaNacimiento>
		<LugarNacimiento>
			<IDPais>{$row['nacionalidad']}</IDPais>
			<Pais>{$row['paisdescripcion']}</Pais>
			<IDDepartamento>$CODdepNAc</IDDepartamento>
			<Departamento>$depNAc</Departamento>
			<IDCiudad>$CODciudadNAc</IDCiudad>
			<Ciudad>$ciudadNAc</Ciudad>
		</LugarNacimiento>
		<GeneroPersona>
			<IdGeneroPersona>$idGenero</IdGeneroPersona>
			<Genero>{$row['sexo']}</Genero>
		</GeneroPersona>
		<EstadoCivilPersona>
			<IdEstadoCivilPersona>{$row['id_estado_civil']}</IdEstadoCivilPersona>
			<EstadoCivil>{$row['estado_civil']}</EstadoCivil>
		</EstadoCivilPersona>
		$nivelestrato
		<CargoLaboral>{$row['cargo']}</CargoLaboral>
		<TipoCotizante>
			<IDTipoCotizante>{$row['actividadId']}</IDTipoCotizante>
			<DescripcionTipoCotizante>{$row['actividad']}</DescripcionTipoCotizante>
		</TipoCotizante>
		<ProfesionPersona>
			<IDProfesion>{$row['idprofesion']}</IDProfesion>
			<Profesion>{$row['profesion']}</Profesion>
		</ProfesionPersona>
		<ActividadEconomicaPersona>
			<IDActividadEconomica>{$row['idtipoactividad']}</IDActividadEconomica>
			<ActividadEconomica>{$row['tipoactividad']}</ActividadEconomica>
		</ActividadEconomicaPersona>		
		<IndicadorFinanciero>
			<IDIndicadorFinanciero>1</IDIndicadorFinanciero>
			<DescripcionIndicadorFinanciero>Ingresos Mensuales</DescripcionIndicadorFinanciero>
			<ValorIndicadorFinanciero>{$rangoI}</ValorIndicadorFinanciero>
			<ValorMinimoRango>{$row['ingresosmin']}</ValorMinimoRango>
			<ValorMaximoRango>{$row['ingresosmax']}</ValorMaximoRango>
			<UnidadDeMedidaIndicador>
				<IDUnidadDeMedida>$IDrangoI</IDUnidadDeMedida>
				<NombreUnidadDeMedida>{$row['ingresosunidad']}</NombreUnidadDeMedida>
			</UnidadDeMedidaIndicador>
			<PeriodicidadIndicador>
				<IDPeriodicidad>1</IDPeriodicidad>
				<ValorPeriodicidad>Mensual</ValorPeriodicidad>
			</PeriodicidadIndicador>
		</IndicadorFinanciero>
		<IndicadorFinanciero>
			<IDIndicadorFinanciero>2</IDIndicadorFinanciero>
			<DescripcionIndicadorFinanciero>Egresos Mensuales</DescripcionIndicadorFinanciero>
			<ValorIndicadorFinanciero>{$rangoE}</ValorIndicadorFinanciero>
			<ValorMinimoRango>{$row['egresosmin']}</ValorMinimoRango>
			<ValorMaximoRango>{$row['egresosmax']}</ValorMaximoRango>
			<UnidadDeMedidaIndicador>
				<IDUnidadDeMedida>$IDrangoE</IDUnidadDeMedida>
				<NombreUnidadDeMedida>{$row['egresosunidad']}</NombreUnidadDeMedida>
			</UnidadDeMedidaIndicador>
			<PeriodicidadIndicador>
				<IDPeriodicidad>1</IDPeriodicidad>
				<ValorPeriodicidad>Mensual</ValorPeriodicidad>
			</PeriodicidadIndicador>
		</IndicadorFinanciero>
		<IndicadorFinanciero>
			<IDIndicadorFinanciero>5</IDIndicadorFinanciero>
			<DescripcionIndicadorFinanciero>Otros Ingresos</DescripcionIndicadorFinanciero>
			<ValorIndicadorFinanciero>{$rangoO}</ValorIndicadorFinanciero>
			<ValorMinimoRango>{$row['otrosmin']}</ValorMinimoRango>
			<ValorMaximoRango>{$row['otrosmax']}</ValorMaximoRango>
			<UnidadDeMedidaIndicador>
				<IDUnidadDeMedida>$IDrangoO</IDUnidadDeMedida>
				<NombreUnidadDeMedida>{$row['otrosunidad']}</NombreUnidadDeMedida>
			</UnidadDeMedidaIndicador>
			<PeriodicidadIndicador>
				<IDPeriodicidad>1</IDPeriodicidad>
				<ValorPeriodicidad>Mensual</ValorPeriodicidad>
			</PeriodicidadIndicador>
		</IndicadorFinanciero>
		<NivelEducacionPersona>
			<IDNivelEducacion>{$row['idnivelestudios']}</IDNivelEducacion>
			<NivelEducacion>{$row['nivelestudios']}</NivelEducacion>
		</NivelEducacionPersona>
		<DireccionPersona>
			<IDUsoDireccion>2</IDUsoDireccion>
			<UsoDireccion>Direccion residencia</UsoDireccion>
			<GeografiaDireccion>
				<IDPais>{$row['nacionalidad']}</IDPais>
				<Pais>{$row['paisdescripcion']}</Pais>
				<IDDepartamento>$CODdepRes</IDDepartamento>
				<Departamento>$depRes</Departamento>
				<IDCiudad>$CODciudadRes</IDCiudad>
				<Ciudad>$ciudadRes</Ciudad>
			</GeografiaDireccion>
			<Direccion>{$row['direccionresidencia']}</Direccion>
			<EstadoDireccion>
				<IDEstado>1</IDEstado>
				<ValorEstado>Activo</ValorEstado>
			</EstadoDireccion>
		</DireccionPersona>
		$puntotelefono
		$puntomail
		<FechaInicioRelacionComercial>{$row['fechasolicitud']}</FechaInicioRelacionComercial>
		<FechaFinRelacionComercial>{$row['fecharadicado']}</FechaFinRelacionComercial>
		<EstadoPersona>
			<IDEstado>1</IDEstado>
			<ValorEstado>Vigente</ValorEstado>
		</EstadoPersona>
	</Persona>\n";
}
fprintf($file, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
fprintf($file, "<Personas>\n");
fprintf($file, $fileClientes);
fprintf($file, "</Personas>\n");
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