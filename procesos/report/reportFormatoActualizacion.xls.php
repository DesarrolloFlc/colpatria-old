<?php
session_start();

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportCallSpecial.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'client.class.php';

extract($_POST);

$complemento = " WHERE (data_renovacion_autos.fecha_diligenciamiento >= '$fecha_inicio 00:00:00' AND data_renovacion_autos.fecha_diligenciamiento <= '$fecha_fin 23:59:59') ";

$sql = "SELECT 
    IF(client.persontype = 1, 'NATURAL', 'JURIDICO') AS tipo_persona, param_tipodocumento.description,
    IF(client.persontype = 1, concat_ws(' ', data.nombres, data.primerapellido, data.segundoapellido), data.razonsocial) AS Nombre_o_Razón_Social,
    data.documento, data.digitochequeo, data.estado_autos, formu.date_created, data_renovacion_autos.fecha_diligenciamiento,
    data.fechanacimiento,
    (
        SELECT param_ciudad.description
        FROM param_ciudad
        WHERE param_ciudad.id = data.lugarnacimiento
    ) AS lnacimiento, 
    data.fechaexpedicion,
    (
        SELECT param_ciudad.description
        FROM param_ciudad
        WHERE param_ciudad.id = data.lugarexpedicion
    ) AS lexpedicion,
    data.nacionalidad,
    (
        SELECT param_ciudad.description
        FROM param_ciudad
        WHERE param_ciudad.id = data.ciudadresidencia
    ) AS cresidencia,
    IF(client.persontype = 1, data.direccionresidencia, data.direccionoficinappal) AS Direccion_residencia_o_pj,
    IF(client.persontype = 1, data.telefonoresidencia, data.telefonoficina) AS telefono_residencia_o_pj,
    data.telefonolaboral, data.celular, data.celularoficina, 
    IF(data.correoelectronico = '', 'SD', data.correoelectronico) AS correoelectronico,
    data.ingresosmensuales, data.egresosmensuales, data.otrosingresos, data.conceptosotrosingresos,
    IF(data.activosemp = '', 'SD', data.activosemp) AS activo,
    IF(data.pasivosemp = '', 'SD', data.pasivosemp) AS pasivo,
    client.id
FROM data
INNER JOIN client ON(data.documento = client.document)
INNER JOIN data_renovacion_autos ON(data.documento = data_renovacion_autos.documento)
INNER JOIN param_tipodocumento ON(data.tipodocumento = param_tipodocumento.id)
INNER JOIN form formu ON(formu.id_client = client.id)
$complemento;";
$client = new Client();
$ultimoestado = "";
/* bgcolor="#EB8F00" */
$result = mysqli_query($GLOBALS['link'], $sql);

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Description: File Transfer");
header("Content-Encoding: UTF-8");
header("Content-Type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=reportCallSpecial" . date('his') . ".csv");
header("Expires: 0");
header("Pragma: public");
echo "\xEF\xBB\xBF"; // UTF-8 BOM
$cabecera = [
    "Tipo de Cliente",
    "Tipo Identificación",
    "Nombre y/o Razón Social",
    "Documento",
    "Digito de Chequeo",
    "Estado",
    "Fecha Solicitud FCC",
    "Fecha de Digitación F",
    "Fecha Nacimiento",
    "Lugar Nacimiento",
    "Fecha Expedición",
    "Lugar Expedición",
    "Nacionalidad",
    "Ciudad Residencia",
    "Dirección residencia y/o persona jurídica",
    "Teléfono Residencia y/o persona jurídica",
    "Teléfono Laboral",
    "Celular",
    "Celular Oficina",
    "Correo electrónico",
    "Ingresos Mensuales",
    "Egresos mensuales",
    "Otros ingresos",
    "Concepto Otros Ingresos",
    "Activos",
    "Pasivos"
];
$fh = fopen('php://output', 'w');
fputcsv($fh, $cabecera, ';');
while ($registro = mysqli_fetch_array($result)) {
    $ultimoestado = $client->getEstadoInformacion($registro[26]);
    $resultados = array($registro[0],
        $registro[1],
        $registro[2],
        $registro[3],
        $registro[4],
        $ultimoestado,
        $registro[6],
        $registro[7],
        $registro[8],
        $registro[9],
        $registro[10],
        $registro[11],
        $registro[12],
        $registro[13],
        $registro[14],
        $registro[15],
        $registro[16],
        $registro[17],
        $registro[18],
        $registro[19],
        $registro[20],
        $registro[21],
        $registro[22],
        $registro[23],
        $registro[24],
        $registro[25],
    );
    fputcsv($fh, $resultados, ';');
}
fclose($fh);
exit;
