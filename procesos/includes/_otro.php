<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
require_once('../../includes.php');
require_once PATH_CLASS.DS.'PHPExcel.php';
require_once PATH_CLASS.DS.'_conexion.php';
obtenerImagenesPesos();
//obtenerRecordsPesos();
function obtenerImagenesPesos(){
	$conn = new Conexion();
	$fp = fopen("obtenerImagenesPesos_".date('His').".csv", "a");
	fputcsv($fp, array('ID_CLIENTE', 'DOCUMENTO', 'ID_IMAGEN', 'IMAGEN_NOMBRE', 'ORIGINAL_IMAGEN', 'IMAGEN_TIPO', 'PESO EN KB', 'PESO EN MB', 'FECHA_CREACION', 'EXISTE?'), '|');
	$path = '/var/www/html/Aplicativos.Serverfin04/images_colpatria';
	$SQL = "SELECT i.id,
				   i.filename,
				   i.date_created,
				   i.original_file, 
				   it.name AS tipo_imagen,
				   c.id AS id_client,
				   c.document
			  FROM image AS i
			 INNER JOIN imagetype AS it ON(it.id = i.id_imagetype)
			 INNER JOIN form AS f ON(f.id = i.id_forma)
			 INNER JOIN client AS c ON(c.id = f.id_client)
			 WHERE DATE(i.date_created) < '2015-01-01'";
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			$totalKb = 0;
			$totalMb = 0;
			while($dat = $conn->sacarRegistro('str')){
				if(file_exists($path.DS.$dat['filename'])){
					if($fileBytes = filesize($path.DS.$dat['filename'])){
						$fileKb = floatval($fileBytes) / 1024;
						$fileMb = floatval($fileBytes) / pow(1024, 2);
						$totalKb += $fileKb;
						$totalMb += $fileMb;
						fputcsv($fp, array($dat['id_client'], $dat['document'], $dat['id'], $dat['filename'], $dat['original_file'], $dat['tipo_imagen'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", $dat['date_created'], 'SI'), '|');
					}else
						fputcsv($fp, array($dat['id_client'], $dat['document'], $dat['id'], $dat['filename'], $dat['original_file'], $dat['tipo_imagen'], '0', '0', $dat['date_created'], 'SI_SIN_PESO'), '|');
				}else

					fputcsv($fp, array($dat['id_client'], $dat['document'], $dat['id'], $dat['filename'], $dat['original_file'], $dat['tipo_imagen'], '0', '0', $dat['date_created'], 'NO'), '|');
			}
		}
	}
	fputcsv($fp, array(), '|');
	fputcsv($fp, array('TOTAL KB', 'TOTAL MB'), '|');
	fputcsv($fp, array(str_replace(".", "," , strval(round($totalKb, 2)))." Kb", str_replace(".", "," , strval(round($totalMb, 2)))." Mb"), '|');

	echo "TOTAL KB: ".str_replace(".", "," , strval(round($totalKb, 2)))." Kb".": TOTAL MB: ".str_replace(".", "," , strval(round($totalMb, 2)))." Mb";
	echo "TERMINO...";
	fclose($fp);
}
function obtenerRecordsPesos(){
	$conn = new Conexion();
	$fp = fopen("obtenerRecordsPesos_".date('His').".csv", "a");
	fputcsv($fp, array('ID_CLIENTE', 'DOCUMENTO', 'ID_GRABACION', 'GRABACION_NOMBRE', 'PESO EN KB', 'PESO EN MB', 'FECHA_CREACION', 'EXISTE?'), '|');
	$path = '/home/storage/records_colpatria';
	$SQL = "SELECT r.id,
				   r.filename,
				   r.date_created,
				   c.id AS id_client,
				   c.document
			  FROM record AS r
			 INNER JOIN data_confirm AS dc ON(dc.id = r.id_data_confirm)
			 INNER JOIN client AS c ON(c.id = dc.id_client)
			 WHERE DATE(r.date_created) < '2015-01-01'";
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			$totalKb = 0;
			$totalMb = 0;
			while($dat = $conn->sacarRegistro('str')){
				$name = explode('.', $dat['filename']);
				$nMp3 = $name[0].'.mp3';
				if(file_exists($path.DS.$dat['filename'])){
					if($fileBytes = filesize($path.DS.$dat['filename'])){
						$fileKb = floatval($fileBytes) / 1024;
						$fileMb = floatval($fileBytes) / pow(1024, 2);
						$totalKb += $fileKb;
						$totalMb += $fileMb;
						fputcsv($fp, array($dat['id_client'], $dat['document'], $dat['id'], $dat['filename'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", $dat['date_created'], 'SI'), '|');
					}else
						fputcsv($fp, array($dat['id_client'], $dat['document'], $dat['id'], $dat['filename'], '0', '0', $dat['date_created'], 'SI_SIN_PESO'), '|');
				}else
					fputcsv($fp, array($dat['id_client'], $dat['document'], $dat['id'], $dat['filename'], '0', '0', $dat['date_created'], 'NO'), '|');
			}
		}
	}
	fputcsv($fp, array(), '|');
	fputcsv($fp, array('TOTAL KB', 'TOTAL MB'), '|');
	fputcsv($fp, array(str_replace(".", "," , strval(round($totalKb, 2)))." Kb", str_replace(".", "," , strval(round($totalMb, 2)))." Mb"), '|');

	echo "TOTAL KB: ".str_replace(".", "," , strval(round($totalKb, 2)))." Kb".": TOTAL MB: ".str_replace(".", "," , strval(round($totalMb, 2)))." Mb";
	echo "TERMINO...";
	fclose($fp);
}