<?php
session_start();

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportCallGeneral.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_SITE . DS . 'config/globalParameters.php';

extract($_POST);

//if( !empty($hora )) {
//	$hora = $hora+1;
//	$complemento = " WHERE data.date_created >= '$fecha_inicio $hora:00:00' AND data.date_created  <= '$fecha_fin $hora:59:59' AND formu.status  = '1' AND data.status = '1'  ";
//} else {
	$complemento = " WHERE data.date_created >= '2012-02-01 00:00:00' AND data.date_created <= '2012-02-30 23:59:59'  AND formu.status  = '1' AND data.status = '1' GROUP BY data.contacto ";
//}


$sql = "SELECT client.document, 
			   data.persontype,
			   data.documento, 
			   con.description,
			   user.name,
			   data.primerapellido,
			   data.segundoapellido,
			   data.nombres,
			   datageneral.fechaexpedicion,
			   lugar_exp.description,
			   data.numerohijos,
			   param_estadocivil.description,
			   param_estudio.description,
			   param_profesion.description,
			   data.direccionresidencia,
			   lugar_resi.description,
			   data.telefonoresidencia,
			   data.celular,
			   data.correoelectronico,
			   param_ingresosmensuales.description,
			   param_egresosmensuales.description,
			   data.razonsocial,
			   data.nit,
			   data.digitochequeo,
			   lugar_oficina.description,
			   data.direccionoficinappal,
			   data.telefonooficina,
			   param_actividad.description,
			   data.activosemp,
			   data.pasivosemp,
			   param_ingresosmensuales_emp.description,
			   param_egresosmensuales_emp.description,
			   data.observacion,
			   data.date_created 
		  FROM data_confirm data 
		 INNER JOIN param_contact con ON con.id = data.id_contact
		 INNER JOIN user ON user.id = data.id_user
		  LEFT JOIN param_ciudad lugar_exp ON lugar_exp.id = data.lugarexpedicion 
		  LEFT JOIN param_ciudad lugar_resi ON lugar_resi.id = data.ciudadresidencia
		  LEFT JOIN param_ingresosmensuales ON param_ingresosmensuales.id = data.ingresosmensuales
		  LEFT JOIN param_egresosmensuales ON param_egresosmensuales.id = data.egresosmensuales 
		  LEFT JOIN param_ciudad lugar_oficina ON lugar_oficina.id = data.ciudadoficina
		  LEFT JOIN param_actividad ON param_actividad.id = data.actividadeconomicappal
		  LEFT JOIN param_ingresosmensuales_emp ON param_ingresosmensuales_emp.id = data.ingresosmensualesemp
		  LEFT JOIN param_egresosmensuales_emp ON param_egresosmensuales_emp.id = data.egresosmensualesemp
		  LEFT JOIN param_estadocivil ON param_estadocivil.id = data.estadocivil
		  LEFT JOIN param_estudio ON param_estudio.id = data.nivelestudios
		  LEFT JOIN param_profesion ON param_profesion.id = data.profesion
		 INNER JOIN client ON client.id = data.id_client
		 INNER JOIN form AS formu ON formu.id_client = client.id  
		  LEFT JOIN data AS datageneral ON datageneral.id_form = formu.id 
		  $complemento";
//$complemento GROUP BY client.id, formu.id_client,datageneral.id_form, data.id , , formu.id_client,client.id GROUP BY data.id
$result = mysqli_query($GLOBALS['link'], $sql);
?>
<table>
	<tr>
		<td>Document</td>
		<td>Tipo de persona</td>
		<td>Documento</td>
		<td>Contacto</td>
		<td>Usuario</td>
		<td>Primer apellido</td>
		<td>Segundo apellido</td>
		<td>Nombres</td>
		<td>Fecha expedicion</td>
		<td>Lugar expedicion</td>
		<td>No. hijos</td>
		<td>Estado civil</td>
		<td>Nivel estudios</td>
		<td>Profesion</td>
		<td>Direcci�n residencia</td>
		<td>Lugar residencia</td>
		<td>Tel�fono residencia</td>
		<td>Celular</td>
		<td>E-mail</td>
		<td>Ingresos mensuales</td>
		<td>Egresos mensuales</td>
		<td>Razon social</td>
		<td>NIT</td>
		<td>Digito chequeo</td>
		<td>Lugar oficina</td>
		<td>Direccion oficina ppal</td>
		<td>Tel�fono oficina</td>
		<td>Actividad</td>
		<td>Activos empresa</td>
		<td>Pasivos empresa</td>
		<td>Ingresos mensuales empresa</td>
		<td>Egresos mensuales empresa</td>
		<td>Observaci&oacute;n</td>
		<td>Fecha gesti&oacute;n</td>
	</tr>
<?php
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
	</tr>
<?php
}
?>
</table>
