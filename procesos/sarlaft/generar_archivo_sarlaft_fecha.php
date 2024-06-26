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

	$header = array('NOMBRE Y/O RAZON SOCIAL', 'TIPO DOCUMENTO', 'DIGITO VERIFICACION', 'DOCUMENTO', 'FECHA NACIIMIENTO', 'GENERO', 'CORREO ELECTRONICO', 'CELULAR', 'DIRECCION', 'TELEFONO', 'ESTADO DOCUMENTACION', 'FECHA HASTA', 'TIPO COMPAÑIA', 'TIPO NORMA', 'REGIMEN', 'FECHA DIGITACION', 'FECHA RADICACION');
	$fh = fopen(PATH_SARLAFT.DS.'finleco_sarlaft_'.date('YmdHis').'.txt', 'a');
	fputcsv($fh, $header, "\t");


	$SQL = "SELECT t1.id, 
				   t4.date_created, 
				   t1.firstname,  
				   IF(t1.persontype = 1, t4.tipodocumento, 'NIT') AS tipodocumento, 
				   t1.document, 
				   t4.genero,
				   t4.fechanacimiento, 
				   t4.digitochequeo, 
				   t4.celular, 
				   t4.correoelectronico, 
				   t4.tipocompania, 
				   t1.vigente,
				   CASE t1.persontype WHEN '1' THEN MAX(t4.direccionresidencia) WHEN '2' THEN MAX(t4.direccionoficinappal) ELSE 'SD' END AS direccion,
				   CASE t1.persontype WHEN '1' THEN MAX(t4.telefonoresidencia) WHEN '2' THEN MAX(t4.telefonoficina) ELSE 'SD' END AS telefono,
				   t1.regimen_id,
				   t1.tipo_norma_id, 
				   tn.descripcion AS tipo_norma_str,
				   pr.descripcion AS regimen_str,
				   t4.fecha_creacion AS fecha_radicado,
				   IF(t4.formulario IN (19, 20), 'NORMA 027/20', 'NORMA 055/16') AS norma_formulario,
				   t4.log_lote,
				   t4.log_planilla
			  FROM client AS t1
			 INNER JOIN (SELECT f.id_client, 
			 					f.date_created, 
			 					IF(d.sexo = 'Masculino', 'M', IF(d.sexo = 'Femenino', 'F', 'SD') ) AS genero, 
			 					d.fechanacimiento, 
			 					pt.description AS tipodocumento, 
			 					d.digitochequeo, 
			 					d.celular, 
			 					d.correoelectronico, 
			 					'SGV' AS tipocompania,
			 					d.direccionresidencia, 
			 					d.telefonoresidencia, 
			 					d.direccionoficinappal, 
			 					d.telefonoficina,
			 					d.formulario,
			 					r.fecha_creacion,
			 					f.log_lote,
			 					f.log_planilla
			 			   FROM form AS f 
			 			  INNER JOIN data AS d ON(d.id_form = f.id)
			 			  INNER JOIN radicados AS r ON(r.id = f.log_lote)
			 			   LEFT JOIN param_tipodocumento AS pt ON(pt.id = d.tipodocumento)
			 			  WHERE f.date_created >= '2021-09-01' AND f.status = 1
			 			  ORDER BY f.id_client, f.date_created DESC
			 ) AS t4 ON(t4.id_client = t1.id)
			 INNER JOIN param_tipo_norma AS tn ON(tn.id = t1.tipo_norma_id)
			 INNER JOIN param_regimen AS pr ON(pr.id = t1.regimen_id)
			 GROUP BY t1.id/*, t4.log_lote, t4.log_planilla*/";
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
            while($row = $conn->sacarRegistro('str')){
                $vigencia = getEstadoInformacion2($row['id'], $row['regimen_id']);
                if($row['vigente'] != '0')
                    $vigencia[0] = "No vigente";
                fputcsv($fh, array(trim($row['firstname']), trim($row['tipodocumento']), trim($row['digitochequeo']), trim($row['document']), trim($row['fechanacimiento']), trim($row['genero']), trim($row['correoelectronico']), trim($row['celular']), trim($row['direccion']), trim($row['telefono']), trim($vigencia[0]), trim($vigencia[1]), trim($row['tipocompania']), $row['norma_formulario'], $row['regimen_str'], $row['date_created'], $row['fecha_radicado']), "\t");
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