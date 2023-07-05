<?php
session_start();

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportGeneral.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_SITE . DS . 'config/globalParameters.php';

extract($_POST);

if (!empty($hora)) {
	$hora = $hora+1;
	$complemento = " WHERE formu.date_created >= '$fecha_inicio $hora:00:00' AND formu.date_created  <= '$fecha_fin $hora:59:59' AND formu.status = '1' ";
} else {
	$complemento = " WHERE formu.date_created >= '$fecha_inicio 00:00:00' AND formu.date_created <= '$fecha_fin 23:59:59'  AND formu.status = '1' ";
}

if(!empty($area)) {
	$complemento.= " AND data.area = '$area' ";
} 

if(!empty($sucursal)) {
	$complemento.= " AND data.sucursal = '$sucursal' ";

}

$sql = "SELECT formu.num_images, 
			   cli.document,
			   IF(cli.persontype = '1', 'NATURAL','JURIDICO'),
			   formu.id,
			   formu.type,
			   formu.log_lote,
			   formu.marca,
			   formu.log_planilla,
			   formu.date_created, 
			   user.name,
			   data.fecharadicado,
			   data.fechasolicitud,
			   sucursal.sucursal,
			   param_area.description,
			   data.lote,
			   data.id_official,
			   param_clasecliente.description, 
			   IF( cli.persontype = '1', CONCAT(data.primerapellido,' ',data.segundoapellido,' ',data.nombres), data.razonsocial ),
			   IF( cli.persontype = '1',param_tipodocumento.description,'NIT'),
			   IF( cli.persontype = '1',data.documento,data.nit),
			   IF( cli.persontype = '1','NA',data.digitochequeo),
			   IF( cli.persontype = '1',data.fechaexpedicion,'NA'),
			   IF( cli.persontype = '1',lugar_exp.description,'NA'),
			   IF( cli.persontype = '1',data.fechanacimiento,'NA'),
			   IF( cli.persontype = '1',lugar_nac.description,'NA'),
			   IF( cli.persontype = '1',data.sexo,'NA'),
			   IF( cli.persontype = '1',param_pais.description, 'NA'),
			   IF( cli.persontype = '1',data.numerohijos,'NA'),
			   IF( cli.persontype = '1',param_estadocivil.description,'NA'),
			   data.direccionresidencia,
			   lugar_resi.description,
			   data.telefonoresidencia,
			   IF( cli.persontype = '1',data.nombreempresa,'NA'),
			   lugar_emp.description,
			   data.direccionempresa,
			   data.nomenclatura,
			   IF( cli.persontype = '1',data.telefonolaboral,'NA'),
			   IF(data.correoelectronico='','SD',data.correoelectronico),
			   IF( cli.persontype = '1',data.cargo,'NA'),
			   param_actividadecono.description,
			   IF( cli.persontype = '1',param_profesion.description,'NA'),
			   IF( cli.persontype = '1',param_ocupacion.description,'NA'),
			   IF(param_ciiu.codigo='','SD',param_ciiu.codigo),
			   param_ingresosmensuales.description,
			   IF( cli.persontype = '1',param_otrosingresos.description,'NA'),
			   param_egresosmensuales.description,
			   IF(cli.persontype = '1',data.conceptosotrosingresos,'NA'),
			   param_actividad.description,
			   IF( cli.persontype = '1',param_estudio.description,'NA'),
			   IF( cli.persontype = '1',param_tipovivienda.description,'NA'),
			   IF( cli.persontype = '1',data.estrato,'NA'),
			   data.totalactivos,
			   data.totalpasivos,
			   lugar_oficina.description,
			   data.direccionoficinappal,
			   data.nomenclatura_emp,
			   data.telefonoficina,
			   IF( cli.persontype = '2',data.faxoficina,'NA'),
			   lugar_sucursal.description,
			   data.direccionsucursal,
			   data.nomenclatura_emp2,
			   data.telefonosucursal,
			   data.faxsucursal,
			   param_actividad.description,
			   data.detalleactividadeconomicappal,
			   IF( cli.persontype = '1','NA',param_tipoempresa.description),
			   data.activosemp,
			   data.pasivosemp,
			   param_ingresosmensuales_emp.description,
			   param_egresosmensuales_emp.description,
			   data.monedaextranjera,
			   IF(cli.persontype = '1','NA',param_tipotransacciones.description),
			   data.firma,
			   data.huella,
			   data.lugarentrevista,
			   data.resultadoentrevista,
			   data.observacionesentrevista,
			   data.nombreintermediario,
			   data.socio1,
			   data.socio2,
			   data.socio3,
			   param_contact.type,
			   param_contact.description,
			   confirma.observacion,
			   usercont.name,
			   confirma.date_created 
		  FROM client cli 
		 INNER JOIN form formu ON formu.id_client = cli.id 
		 INNER JOIN data ON formu.id = data.id_form 
		  LEFT JOIN  param_sucursales sucursal ON sucursal.id = data.sucursal 
		  LEFT JOIN param_area ON param_area.id = data.area  
		  LEFT JOIN param_formulario ON param_formulario.id = data.formulario
		  LEFT JOIN  param_clasecliente ON  param_clasecliente.id = data.clasecliente 
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
		  $complemento";
$result = mysqli_query($GLOBALS['link'], $sql);
?>
<table>
	<tr>
		<td>N�mero im�genes</td>
		<td>Documento</td>
		<td>Tipo de persona</td>
		<td>Id formulario</td>
		<td>Tipo formulario</td>
		<td>No. lote</td>
		<td>Marca</td>
		<td>No. planilla</td>
		<td>Fecha creaci�n</td>
		<td>Usuario</td>
		<td>Fecha radicado</td>
		<td>Fecha solicitud</td>
		<td>Sucursal</td>
		<td>Area</td>
		<td>Lote</td>
		<td>Id_official</td>
		<td>Clase cliente</td>
		<td>Nombre y/o Raz�n Social</td>
		<td>TIpo documento</td>
		<td>Nro. ID</td>
		<td>Digito de Chequeo</td>
		<td>Fecha expedicion</td>
		<td>Lugar expedicion</td>
		<td>Fecha nacimiento</td>
		<td>Lugar nacimiento</td>
		<td>Sexo</td>
		<td>Nacionalidad</td>
		<td>No. hijos</td>
		<td>Estado civil</td>
		<td>Direcci�n residencia</td>
		<td>Lugar residencia</td>
		<td>Tel�fono residencia</td>
		<td>Nombre empresa</td>
		<td>Lugar empresa</td>
		<td>Direcci�n empresa</td>
		<td>Nomenclatura</td>
		<td>Tel�fono laboral</td>
		<td>E-mail</td>
		<td>Cargo</td>
		<td>Actividad economica</td>
		<td>Profesion</td>
		<td>Ocupacion</td>
		<td>CIIU</td>
		<td>Ingresos mensuales</td>
		<td>Otros ingresos</td>
		<td>Egresos mensuales</td>
		<td>Concepto otros ingresos</td>
		<td>Actividad</td>
		<td>Nivel estudios</td>
		<td>Tipo vivienda</td>
		<td>Estrato</td>
		<td>Total activos</td>
		<td>Total pasivos</td>
		<td>Lugar oficina</td>
		<td>Direccion oficina ppal</td>
		<td>Nomenclatura</td>
		<td>Tel�fono oficina</td>
		<td>Fax oficina</td>
		<td>Lugar sucursal</td>
		<td>Direcci�n sucursal</td>
		<td>Nomenclatura</td>
		<td>Tel�fono sucursal</td>
		<td>Fax sucursal</td>
		<td>Actividad</td>
		<td>Detalle actividad economica ppal</td>
		<td>Tipo empresa</td>
		<td>Activos empresa</td>
		<td>Pasivos empresa</td>
		<td>Ingresos mensuales empresa</td>
		<td>Egresos mensuales empresa</td>
		<td>Moneda extranjera</td>
		<td>Tipo transacciones</td>
		<td>Firma</td>
		<td>Huella</td>
		<td>Lugar entrevista</td>
		<td>Resultado entrevista</td>
		<td>Observaciones entrevista</td>
		<td>Nombre intermediario</td>
		<td>Socio1</td>
		<td>Socio2</td>
		<td>Socio3</td>
		<td>Tipo contacto</td>
		<td>Contacto</td>
		<td>Observaci&oacute;n</td>
		<td>Gestor contacto</td>
		<td>Fecha contacto</td>
	</tr>
<?php
if ($_SESSION['id'] != 893 && $_SESSION['id'] != 1184) {
	while ($registro = mysqli_fetch_array($result)) {
?>
	<tr>
		<td><?=$registro[0]?></td>
		<td><?=$registro[1]?></td>
		<td><?=$registro[2]?></td>
		<td><?=$registro[3]?></td>
		<td><?=$registro[4]?></td>
		<td><?=$registro[5]?></td>
		<td><?=$registro[6]?></td>
		<td><?=$registro[7]?></td>
		<td><?=$registro[8]?></td>
		<td><?=$registro[9]?></td>
		<td><?=$registro[10]?></td>
		<td><?=$registro[11]?></td>
		<td><?=$registro[12]?></td>
		<td><?=$registro[13]?></td>
		<td><?=$registro[14]?></td>
		<td><?=$registro[15]?></td>
		<td><?=$registro[16]?></td>
		<td><?=$registro[17]?></td>
		<td><?=$registro[18]?></td>
		<td><?=$registro[19]?></td>
		<td><?=$registro[20]?></td>
		<td><?=$registro[21]?></td>
		<td><?=$registro[22]?></td>
		<td><?=$registro[23]?></td>
		<td><?=$registro[24]?></td>
		<td><?=$registro[25]?></td>
		<td><?=$registro[26]?></td>
		<td><?=$registro[27]?></td>
		<td><?=$registro[28]?></td>
		<td><?=$registro[29]?></td>
		<td><?=$registro[30]?></td>
		<td><?=$registro[31]?></td>
		<td><?=$registro[32]?></td>
		<td><?=$registro[33]?></td>
		<td><?=$registro[34]?></td>
		<td><?=$registro[35]?></td>
		<td><?=$registro[36]?></td>
		<td><?=$registro[37]?></td>
		<td><?=$registro[38]?></td>
		<td><?=$registro[39]?></td>
		<td><?=$registro[40]?></td>
		<td><?=$registro[41]?></td>
		<td><?=$registro[42]?></td>
		<td><?=$registro[43]?></td>
		<td><?=$registro[44]?></td>
		<td><?=$registro[45]?></td>
		<td><?=$registro[46]?></td>
		<td><?=$registro[47]?></td>
		<td><?=$registro[48]?></td>
		<td><?=$registro[49]?></td>
		<td><?=$registro[50]?></td>
		<td><?=$registro[51]?></td>
		<td><?=$registro[52]?></td>
		<td><?=$registro[53]?></td>
		<td><?=$registro[54]?></td>
		<td><?=$registro[55]?></td>
		<td><?=$registro[56]?></td>
		<td><?=$registro[57]?></td>
		<td><?=$registro[58]?></td>
		<td><?=$registro[59]?></td>
		<td><?=$registro[60]?></td>
		<td><?=$registro[61]?></td>
		<td><?=$registro[62]?></td>
		<td><?=$registro[63]?></td>
		<td><?=$registro[64]?></td>
		<td><?=$registro[65]?></td>
		<td><?=$registro[66]?></td>
		<td><?=$registro[67]?></td>
		<td><?=$registro[68]?></td>
		<td><?=$registro[69]?></td>
		<td><?=$registro[70]?></td>
		<td><?=$registro[71]?></td>
		<td><?=$registro[72]?></td>
		<td><?=$registro[73]?></td>
		<td><?=$registro[74]?></td>
		<td><?=$registro[75]?></td>
		<td><?=$registro[76]?></td>
		<td><?=$registro[77]?></td>
		<td><?=$registro[78]?></td>
		<td><?=$registro[79]?></td>
		<td><?=$registro[80]?></td>
		<td><?=$registro[81]?></td>
		<td><?=$registro[82]?></td>
		<td><?=$registro[83]?></td>
		<td><?=$registro[84]?></td>
		<td><?=$registro[85]?></td>
		<td><?=$registro[86]?></td>
		<td><?=$registro[87]?></td>
		<td><?=$registro[88]?></td>
		<td><?=$registro[89]?></td>
	</tr>
<?php
	}
}
?>
</table>