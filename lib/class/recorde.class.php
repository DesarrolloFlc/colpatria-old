<?php
require_once PATH_SITE . DS . 'config/globalParameters.php';

class Recorde 
{
	function add( $id_data_confirm, $temporal,$name)
	{
		$file_origen = $temporal;
		$name = $name;
       
        $onlyname = explode(".", $name);

	 	$unique_name = md5(uniqid(rand(), true)); 
        $finalname = $unique_name."_record.".$onlyname[count($onlyname)-1];
        
		$file_destino =  "/var/www/html/records_colpatria/". $finalname;
		if (copy($file_origen, $file_destino)) {

			$sql = "INSERT INTO record(id_data_confirm,directory,filename) 
					VALUES('$id_data_confirm','records_colpatria','$finalname')";
	
			if (mysqli_query($GLOBALS['link'], $sql))
		            return true;
		        else
		            return false;
		}
	}
}
