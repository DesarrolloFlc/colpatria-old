<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(0);

/*header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportCallGeneral.xls");
header("Pragma: no-cache");
header("Expires: 0");*/

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_SITE . DS . 'config/globalParameters.php';

extract($_POST);

if (!empty($hora)) {
	$hora = $hora + 1;
	$complemento = " WHERE t1.date_created >= '$fecha_inicio $hora:00:00' AND t1.date_created  <= '$fecha_fin $hora:59:59' AND formu.status  = '1' AND t1.status = '1'  ";
} else {
	$complemento = " WHERE t1.date_created >= '$fecha_inicio 00:00:00' AND t1.date_created <= '$fecha_fin 23:59:59'  AND t1.status = '1'";
}


$sql = <<< SQL
SELECT client.document, 
	   t1.persontype,
	   t1.documento, 
	   con.description,
	   user.name,
	   t1.primerapellido,
	   t1.segundoapellido,
	   t1.nombres,
	   IF(t1.persontype = 1, datageneral.fechaexpedicion, 'N/A'),
	   IFNULL(lugar_exp.description, CONCAT(lex.departamento, ', ', lex.ciudad)),
	   t1.numerohijos,
	   param_estadocivil.description,
	   param_estudio.description,
	   param_profesion.description,
	   t1.direccionresidencia,
	   IFNULL(lugar_resi.description, CONCAT(lre.departamento, ', ', lre.ciudad)),
	   t1.telefonoresidencia,
	   t1.celular,
	   t1.correoelectronico,
	   param_ingresosmensuales.value,
	   param_egresosmensuales.value,
	   t1.razonsocial,
	   t1.nit,
	   t1.digitochequeo,
	   IFNULL(lugar_oficina.description, CONCAT(lof.departamento, ', ', lof.ciudad)),
	   t1.direccionoficinappal,
	   t1.telefonooficina,
	   param_actividad.description,
	   t1.activosemp,
	   t1.pasivosemp,
	   param_ingresosmensuales_emp.value,
	   param_egresosmensuales_emp.value,
	   t1.observacion,
	   t1.date_created,
	   datageneral.sucursal
  FROM data_confirm t1 
 INNER JOIN param_contact con ON(con.id = t1.id_contact)
  LEFT JOIN user ON(user.id = t1.id_user)
  LEFT JOIN param_ciudad lugar_exp ON(lugar_exp.id = t1.lugarexpedicion)
  LEFT JOIN param_ciudadesdane AS lex ON(lex.cod_dane = t1.lugarexpedicion)
  LEFT JOIN param_ciudad lugar_resi ON(lugar_resi.id = t1.ciudadresidencia)
  LEFT JOIN param_ciudadesdane AS lre ON(lre.cod_dane = t1.ciudadresidencia)
  LEFT JOIN param_ingresosmensuales ON(param_ingresosmensuales.id = t1.ingresosmensuales)
  LEFT JOIN param_egresosmensuales ON(param_egresosmensuales.id = t1.egresosmensuales )
  LEFT JOIN param_ciudad lugar_oficina ON(lugar_oficina.id = t1.ciudadoficina)
  LEFT JOIN param_ciudadesdane AS lof ON(lof.cod_dane = t1.ciudadoficina)
  LEFT JOIN param_actividad ON(param_actividad.id = t1.actividadeconomicappal)
  LEFT JOIN param_ingresosmensuales_emp ON(param_ingresosmensuales_emp.id = t1.ingresosmensualesemp)
  LEFT JOIN param_egresosmensuales_emp ON(param_egresosmensuales_emp.id = t1.egresosmensualesemp)
  LEFT JOIN param_estadocivil ON(param_estadocivil.id = t1.estadocivil)
  LEFT JOIN param_estudio ON(param_estudio.id = t1.nivelestudios)
  LEFT JOIN param_profesion ON(param_profesion.id = t1.profesion)
 INNER JOIN client ON(client.id = t1.id_client)
 INNER JOIN form AS formu ON(formu.id_client = client.id AND formu.id = t1.id_form)
  LEFT JOIN data AS datageneral ON(datageneral.id_form = formu.id )
$complemento
SQL;
//$complemento GROUP BY client.id, formu.id_client,datageneral.id_form, data.id , , formu.id_client,client.id GROUP BY data.id
//echo $sql;
$result = mysqli_query($GLOBALS['link'], $sql);
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Description: File Transfer");
header("Content-Encoding: UTF-8");
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=reporteCallCenter_".date('his').".csv");
header("Expires: 0");
header("Pragma: public");
echo "\xEF\xBB\xBF"; // UTF-8 BOM
$head = [
	'Document',
	'Tipo de persona',
	'Documento',
	'Contacto',
	'Usuario',
	'Primer apellido',
	'Segundo apellido',
	'Nombres',
	'Fecha expedicion',
	'Lugar expedicion',
	'No. hijos',
	'Estado civil',
	'Nivel estudios',
	'Profesion',
	'Dirección residencia',
	'Lugar residencia',
	'Teléfono residencia',
	'Celular',
	'E-mail',
	'Ingresos mensuales',
	'Egresos mensuales',
	'Razon social',
	'NIT',
	'Digito chequeo',
	'Lugar oficina',
	'Direccion oficina ppal',
	'Teléfono oficina',
	'Actividad',
	'Activos empresa',
	'Pasivos empresa',
	'Ingresos mensuales empresa',
	'Egresos mensuales empresa',
	'Observación',
	'Fecha gestión',
	'Centro de costo'
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