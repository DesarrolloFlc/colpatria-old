<?php

require_once PATH_SITE . DS . 'config/globalParameters.php';

class Retroalimentar
{
	function add( $id_case, $id_user, $lote, $fechaentrega ) {
		$sql = "INSERT INTO retroalimentacion(id_case, id_user,lote,fechaentrega) 
				VALUES('$id_case','$id_user','$lote','$fechaentrega')";
		return mysqli_query($GLOBALS['link'], $sql);
	}

	function history($id_case) {
		$sql = "SELECT * FROM retroalimentacion WHERE id_case = '$id_case' ";	
		return mysqli_query($GLOBALS['link'], $sql);
	}
}