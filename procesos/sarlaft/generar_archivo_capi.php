<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
header("Content-Type: text/html;charset=utf-8");
require "includes.php";
require_once PATH_CLASS.DS.'_conexion.php';
dataActualizacionesColpatria();

function dataActualizacionesColpatria(){
	$conn = new Conexion();
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Description: File Transfer");
	header("Content-Encoding: UTF-8");
	header("Content-Type: text/csv; charset=UTF-8");
	header("Expires: 0");
	header("Pragma: public");
	echo "\xEF\xBB\xBF"; // UTF-8 BOM

	$header = array('NOMBRE Y/O RAZON SOCIAL', 'TIPO DOCUMENTO', 'DIGITO VERIFICACION', 'DOCUMENTO', 'FECHA NACIIMIENTO', 'CORREO ELECTRONICO', 'CELULAR', 'DIRECCION', 'ESTADO DOCUMENTACION', 'FECHA HASTA', 'TIPO COMPAÑIA');
	$fh = fopen(PATH_SARLAFT.DS.'finleco_sarlaft_capi_'.date('Ymd').'.txt', 'a');
	fputcsv($fh, $header, "\t");


	$SQL = "SELECT c.id,
				   cap.date_created, 
				   c.firstname,
				   cap.tipodocumento,
				   c.document,
				   cap.fechanacimiento,
				   cap.digitochequeo,
				   cap.telefonoresidencia1,
				   cap.correoelectronico,
				   'CAPI' AS tipocompania,
				   c.vigente,
				   CASE c.persontype WHEN '1' THEN MAX(cap.direccionresidencia) WHEN '2' THEN MAX(cap.direccionlaboral) ELSE 'SD' END AS direccion,
				   c.regimen_id
			  FROM client AS c
			 INNER JOIN (SELECT dc.date_created,
			 					dc.tipodocumento,
			 					dc.fechanacimiento,
			 					dc.digitochequeo,
			 					dc.telefonoresidencia1,
			 					dc.correoelectronico,
			 					dc.direccionresidencia,
			 					dc.direccionlaboral,
			 					dc.id_client
						   FROM data_capi AS dc
						  ORDER BY dc.id_client, dc.date_created DESC
			) AS cap ON(cap.id_client = c.id)
			 GROUP BY c.id";
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
            while($consulta = $conn->sacarRegistro('str')){
                $vigencia = getEstadoInformacion2($consulta['id'], $consulta['regimen_id']);
                if($consulta['vigente'] != '0')
                    $vigencia[0] = "No vigente";
                fputcsv($fh, array(trim($consulta['firstname']), trim($consulta['tipodocumento']), trim($consulta['digitochequeo']), trim($consulta['document']), trim($consulta['fechanacimiento']), trim($consulta['correoelectronico']), trim($consulta['telefonoresidencia1']), trim($consulta['direccion']), trim($vigencia[0]), trim($vigencia[1]), trim($consulta['tipocompania'])), "\t");
            }
            // Close the file
            fclose($fh);
            // Make sure nothing else is sent, our file is done
            exit();
        }
    }
}
function getEstadoInformacion2($id_client, $regimen_id = '2') {
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

	if($data['valid']){
		$conn->desconectar();
		return array("Vigente", date("Y-m-d", strtotime($data['date'])));
	}else{
		$conn->desconectar();
		return array("Desactualizado", "");
	}
}
?>