<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Aplicativos.Serverfin04' . '/Colpatria/config/globalParameters.php';
class Recordecapi{
	function add( $id_data_confirm, $temporal,$name)	{
		//error_log("La base de datos de Oracle no está disponible".json_encode(array($id_data_confirm, $temporal, $name)), 0);
		$file_origen = $temporal;
		$name = $name;

		$onlyname = explode(".", $name);

		$unique_name = md5(uniqid(rand(), true));
		$finalname = $unique_name."_record.".$onlyname[(count($onlyname) - 1)];

		$file_destino =  "/var/www/html/records_colpatria_capi/". $finalname;
		if(copy($file_origen, $file_destino)){

			$sql = "INSERT INTO recordcapi
					(
						id_data_confirm, directory, filename
					)
					VALUES
					(
						'$id_data_confirm', 'records_colpatria_capi', '$finalname'
					)";

			if(mysqli_query($GLOBALS['link'], $sql))
				return true;
			else
				return false;
		}
	}
}
?>
