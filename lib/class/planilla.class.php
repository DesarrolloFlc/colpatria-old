<?php

require_once PATH_SITE . DS . 'config/globalParameters.php';

class Planilla
{
	public function getPlanillaImg($planilla) {
		$sql = "SELECT * FROM planilla WHERE planilla = '$planilla' AND description = 'PLANILLA' ORDER BY planilla,lote";
		return mysqli_query($GLOBALS['link'], $sql);
	}
	public function getPlanillaLoteImg($planilla,$lote) {
		$sql = "SELECT * FROM planilla WHERE planilla = '$planilla' AND lote = '$lote' AND description = 'PLANILLA_LOTE' ORDER BY planilla,lote";
		return mysqli_query($GLOBALS['link'], $sql);
	}
}