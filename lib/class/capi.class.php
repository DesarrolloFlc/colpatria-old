<?php

require PATH_SITE . DS . 'config/globalParameters.php';

class Capi 
{
	function getData($id_client) 
	{
		$sql = "SELECT d.*,
					   c.document,
					   c.persontype,
					   c.firstname
				  FROM data_capi AS d
				 INNER JOIN client AS c ON(c.id = d.id_client)
				 WHERE d.id_client = '$id_client' ";
		return mysqli_query($GLOBALS['link'], $sql);
	}
}
