<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(0);

/*header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportCallCapi.xls");
header("Pragma: no-cache");
header("Expires: 0");*/

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_SITE . DS . 'config/globalParameters.php';
extract($_POST);

if (!empty($hora )) {
	$hora = $hora + 1;
	$complemento = " WHERE con.date_created >= '$fecha_inicio $hora:00:00' AND con.date_created  <= '$fecha_fin $hora:59:59' AND con.status = '1'";
} else {
	$complemento = " WHERE con.date_created >= '$fecha_inicio 00:00:00' AND con.date_created <= '$fecha_fin 23:59:59' AND con.status = '1' ";
}


$sql = <<<SQL
SELECT param_contact.type,
	   param_contact.description,
	   cli.document,
	   con.documento,
	   con.primerapellido,
	   con.segundoapellido,
	   con.nombres,
	   IF( param_contact.id = '1',con.fechanacimiento,''),
	   IF( param_contact.id = '1',param_profesion.description,''),
	   IF( param_contact.id = '1',con.empresa,''),
	   IF( param_contact.id = '1',param_ingresosmensuales.description,''),
	   IF( param_contact.id = '1',param_egresosmensuales.description,''),
	   IF( param_contact.id = '1',con.direccionlaboral,''),
	   IF( param_contact.id = '1',param_ciudad.description,''),
	   IF( param_contact.id = '1',con.direccionresidencia,''),
	   IF( param_contact.id = '1',con.telefonoresidencia,''),
	   IF( param_contact.id = '1',con.celular,''),
	   IF( param_contact.id = '1',con.correoelectronico,''),
	   IF( param_contact.id = '1',con.numerohijos,''),
	   IF( param_contact.id = '1',param_estadocivil.description,''),
	   IF( param_contact.id = '1',param_estudio.description,''),
	   con.observacion,
	   user.name,
	   CASE con.respuesta_libre WHEN 1 THEN 'SI' WHEN 2 THEN 'NO' WHEN 3 THEN 'N/A' ELSE '' END,
	   pa.description AS nacionalidad,
	   CASE con.nacionalidad_otra WHEN 1 THEN 'SI' WHEN 2 THEN 'NO' WHEN 3 THEN 'N/A' ELSE '' END,
	   nc.description AS nacionalidad_cual,
	   pr.description AS pais_residencia,
	   CASE con.obligaciones_otras WHEN 1 THEN 'SI' WHEN 2 THEN 'NO' WHEN 3 THEN 'N/A' ELSE '' END,
	   con.obligaciones_paises,
	   con.date_created
  FROM client cli 
 INNER JOIN data_capi ON (data_capi.id_client = cli.id)
 INNER JOIN data_capi_confirm con ON (con.id_client = data_capi.id_client)
 INNER JOIN param_contact ON (param_contact.id = con.id_contact)
  LEFT JOIN param_profesion ON (param_profesion.id = con.id_profesion)
  LEFT JOIN param_ingresosmensuales ON (param_ingresosmensuales.id = con.id_ingresos)
  LEFT JOIN param_egresosmensuales ON (param_egresosmensuales.id = con.id_egresos)
  LEFT JOIN param_ciudad ON (param_ciudad.id = con.id_ciudad)
  LEFT JOIN param_estadocivil ON (param_estadocivil.id = con.estadocivil)
  LEFT JOIN param_estudio ON (param_estudio.id = con.nivelestudios)
  LEFT JOIN user ON (user.id = con.id_user)
  LEFT JOIN param_paises AS pa ON(pa.id = con.nacionalidad)
  LEFT JOIN param_paises AS nc ON(nc.id = con.nacionalidad_cual)
  LEFT JOIN param_paises AS pr ON(pr.id = con.pais_residencia)
  $complemento
SQL;


$result = mysqli_query($GLOBALS['link'], $sql);
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Description: File Transfer");
header("Content-Encoding: UTF-8");
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=reportCallCapi_".date('his').".csv");
header("Expires: 0");
header("Pragma: public");
echo "\xEF\xBB\xBF"; // UTF-8 BOM
$head = [
	'Tipo gestión',
	'Gestión',
	'Documento',
	'Documento actualizado',
	'Primer apellido',
	'Segundo apellido',
	'Nombres',
	'Fecha de nacimiento',
	'Profesión',
	'Empresa',
	'Ingresos mensuales',
	'Egresos mensuales',
	'Dirección laboral',
	'Ciudad',
	'Dirección residencia',
	'Teléfono residencia',
	'Celular',
	'Correo electronico',
	'Numero hijos',
	'Estado civil',
	'Nivel de estudios',
	'Observación gestión',
	'Usuario gestor',
	'Respues libre?',
	'Nacionalidad',
	'Nacionalidad otra',
	'Nacionalidad cual',
	'Pais residencia',
	'Obligaciones en otros paises',
	'Cuales paises',
	'Fecha de gestión'
];
$fh = fopen( 'php://output', 'w' );
fputcsv($fh, $head, ';');
if ($_SESSION['id'] != 893 && $_SESSION['id'] != 1184) {
	while ($registro = mysqli_fetch_array($result, MYSQLI_NUM)) {
		fputcsv($fh, $registro, ';');
	}
}
fclose($fh);
exit;
