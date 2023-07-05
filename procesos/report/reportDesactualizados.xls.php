<?php
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CLASS . DS . '_conexion.php';

$SQL = <<< SQL
SELECT cl.id,
	   cl.document, 
	   cl.firstname,
	   IF(da.formulario = '15', CONCAT(cr.ciudad, ', ', cr.departamento), IF(cl.persontype = '1', lugar_resi.description, '')) AS ciudadresidencia, 
	   da.telefonoresidencia,
	   ce.ciudad AS ciudadempresa,
	   da.telefonolaboral,
	   da.celular,
	   IF(da.formulario = '15', co.ciudad, IF(cl.persontype = '1', 'NA', lugar_emp.description)) AS ciudadoficina, 
	   da.telefonoficina,
	   da.faxoficina,
	   da.celularoficina,
	   lugar_sucursal.description AS ciudadsucursal, 
	   da.telefonosucursal,
	   da.faxsucursal,
	   CONCAT(c1.ciudad, ', ', c1.departamento) AS ciudad,
	   da.celularoficinappal,
	   da.telefonoficinappal,
	   'SEGUROS' AS tipo,
	   cl.vigente
  FROM client AS cl
 INNER JOIN form AS fr ON(fr.id_client = cl.id)
 INNER JOIN data AS da ON(da.id_form = fr.id)
  LEFT JOIN param_ciudadesdane AS cr ON(cr.cod_dane = da.ciudadresidencia)
  LEFT JOIN param_ciudad AS lugar_resi ON(lugar_resi.id = da.ciudadresidencia)
  LEFT JOIN param_ciudadesdane AS ce ON(ce.cod_dane = da.ciudadempresa)
  LEFT JOIN param_ciudadesdane AS co ON(co.cod_dane = da.ciudadoficina)
  LEFT JOIN param_ciudad AS lugar_emp ON(lugar_emp.codigo = da.ciudadoficina)
  LEFT JOIN param_ciudad AS lugar_sucursal ON(lugar_sucursal.id = da.ciudadsucursal)
  LEFT JOIN param_ciudadesdane AS c1 ON(c1.cod_dane = da.ciudad)
 WHERE cl.vigente = '0'
   AND cl.id IN (SELECT f.id_client FROM form AS f WHERE f.id_client = cl.id AND YEAR(f.date_created) >= '2015')
  GROUP BY cl.id,
	   cl.document, 
	   cl.firstname,
	   IF(da.formulario = '15', CONCAT(cr.ciudad, ', ', cr.departamento), IF(cl.persontype = '1', lugar_resi.description, '')), 
	   IF(da.telefonoresidencia = '', '0', da.telefonoresidencia),
	   ce.ciudad,
	   IF(da.telefonolaboral = '', '0', da.telefonolaboral),
	   IF(da.celular = '', '0', da.celular),
	   IF(da.formulario = '15', co.ciudad, IF(cl.persontype = '1', 'NA', lugar_emp.description)), 
	   IF(da.telefonoficina = '', '0', da.telefonoficina),
	   IF(da.faxoficina = '', '0', da.faxoficina),
	   IF(da.celularoficina = '', '0', da.celularoficina),
	   lugar_sucursal.description, 
	   IF(da.telefonosucursal = '', '0', da.telefonosucursal),
	   IF(da.faxsucursal = '', '0', da.faxsucursal),
	   CONCAT(c1.ciudad, ', ', c1.departamento),
	   IF(da.celularoficinappal = '', '0', da.celularoficinappal),
	   IF(da.telefonoficinappal = '', '0', da.telefonoficinappal),
	   'SEGUROS',
	   cl.vigente
SQL;

$conn = new Conexion();
if (!$conn->consultar($SQL)) exit;
if ($conn->getNumeroRegistros() <= 0) exit;

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Description: File Transfer");
header("Content-Encoding: UTF-8");
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=reporteDesactualizados_" . date('his') . ".csv");
header("Expires: 0");
header("Pragma: public");
echo "\xEF\xBB\xBF"; // UTF-8 BOM

$fh = fopen('php://output', 'w');
fputcsv($fh, ['DOCUMENTO', 'NOMBRE / RAZON SOCIAL', 'CIUDAD RESIDENCIA', 'TELEFONO RESIDENCIA', 'CIUDAD EMPRESA', 'TELEFONO EMPRESA', 'CELULAR', 'CIUDAD OFICINA', 'TELEFONO OFICINA', 'FAX OFICINA', 'CELULAR OFICINA', 'CIUDAD SUCURSAL', 'TELEFONO SUCURSAL', 'FAX SUCURSAL', 'CIUDAD', 'CELULAR OFICINA PPAL', 'TELEFONO OFICINA PPAL', 'TIPO'], ';');
$conn2 = new Conexion();
while ($dat = $conn->sacarRegistro('str')) {
	$estado = getEstadoInformacion2($dat['id'], $conn2);
	if ($estado[0] == 'Desactualizado') {
		fputcsv($fh, [$dat['document'], $dat['firstname'], $dat['ciudadresidencia'], $dat['telefonoresidencia'], $dat['ciudadempresa'], $dat['telefonolaboral'], $dat['celular'], $dat['ciudadoficina'], $dat['telefonoficina'], $dat['faxoficina'], $dat['celularoficina'], $dat['ciudadsucursal'], $dat['telefonosucursal'], $dat['faxsucursal'], $dat['ciudad'], $dat['celularoficinappal'], $dat['telefonoficinappal'], $dat['tipo']], ';');
	}
}
$conn2->desconectar();
$conn->desconectar();

function getEstadoInformacion2($id_client, $conn)
{
	$query = <<< SQL
            SELECT MAX(a.d) + INTERVAL 365 DAY AS date, (MAX(a.d) + INTERVAL 365 DAY) >= NOW() AS valid
            FROM
            (
                (
                    SELECT date_created AS d FROM data_capi_confirm
                    WHERE id_contact BETWEEN 1 AND 3 AND id_client = $id_client AND status = 1 ORDER BY date_created DESC LIMIT 1
                )UNION(
                    SELECT date_created AS d FROM data_confirm
                    WHERE id_contact BETWEEN 1 AND 3 AND id_client = $id_client AND status = 1 ORDER BY date_created DESC LIMIT 1
                )UNION(
                    SELECT CAST(data.fechasolicitud AS DATE) AS d FROM data INNER JOIN form ON form.id = data.id_form
                    WHERE form.id_client = $id_client ORDER BY data.fechasolicitud DESC LIMIT 1
                )UNION(
                    SELECT fecha_datacredito AS d FROM client
                    WHERE id = $id_client LIMIT 1
                )
            ) AS a
SQL;
	$conn->consultar($query);
	$data = $conn->sacarRegistro('str');

	return $data['valid'] ? ["Vigente", date("Y-m-d", strtotime($data['date']))] : ["Desactualizado", ""];
}
