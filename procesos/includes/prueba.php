<?php
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CLASS . DS . 'conexion.php';

function arbol($arbol){
	if($proces = procesos($arbol)){
		$cant = count($proces);
		$resuls = array($cant);
		for ($i=0; $i < $cant; $i++) { 
			$resuls[$i] = resultados($arbol, $proces[$i]);
		}
		return json_encode($resuls);
	}
}
function procesos($arbol){
	$conexion = new Conexion();
	$SQL = "SELECT DISTINCT ab_proceso FROM ab_arbolefectividad WHERE ab_accion =  '".$arbol."'";
	$conexion->consultar($SQL);
	$num_reg = $conexion->getNumeroRegistros();
	if($num_reg > 0){	
		$procesos = array();
		while ($cons = $conexion->sacarRegistro()) {
			$procesos[] = $cons['ab_proceso'];			
		}
		$conexion->desconectar();
		return $procesos;		
	}else{
		$conexion->desconectar();
		return false;		
	}
}
function resultados($arbol, $proceso){
	$conexion = new Conexion();
	$SQL = "SELECT ab_id, ab_resultado FROM ab_arbolefectividad WHERE ab_accion = '".$arbol."' and ab_proceso ='".$proceso."'";
	$conexion->consultar($SQL);
	if($conexion->getNumeroRegistros() > 0){		
		$nom_respuesta = array();
		$id_respuesta = array();
		while ($cons_s = $conexion->sacarRegistro()) {
			$nom_respuesta[] = $cons_s['ab_resultado'];
			$id_respuesta[] = $cons_s['ab_id'];
		}
		$conexion->desconectar();
		$menus = array('proceso'=>$proceso,'nom_respuesta'=>$nom_respuesta,'id_respuesta'=>$id_respuesta);
		return $menus;
	}else{
		$conexion->desconectar();
		return false;
	}
}
$arrayArbol = array(
	'COBRANZAS',
	'DEUDA ERRONEA',
	'DEUDA PRESUNTA',
	'GENERAL',
	'NO IDENTIFICADOS',
	'PAGOS EN EXCESO',
	'REZAGOS',
	'SECTOR PUBLICO'
);
$resp = json_decode(arbol($arrayArbol[6]));
//echo $resp[0]->proceso;
$table = '';
foreach ($resp as $pros) {
	$table .= 
		"<table><tr><td></td><td></td><td></td><td></td><td></td></tr></table>".
		"<br><br><table border=\"1\">".
		"<tr>".
		  "<td align=\"center\" bgcolor=\"#eb8f00\" colspan=\"2\"><font color=\"#ffffff\"><strong>PROCESO ".$pros->proceso."</strong></font></td>".
		"</tr>".
		"<tr>".
		  "<td align=\"center\" bgcolor=\"#4E6792\"><font color=\"#ffffff\"><strong>ID</strong></font></td>".
		  "<td align=\"center\" bgcolor=\"#4E6792\"><font color=\"#ffffff\"><strong>RESULTADO</strong></font></td>".
		"</tr>";
		$tam = count($pros->nom_respuesta);
		for ($i = 0; $i < $tam; $i++) {
			$table .= 
			"<tr>".
			  "<td align=\"center\">".$pros->id_respuesta[$i]."</td>".
			  "<td align=\"center\">".$pros->nom_respuesta[$i]."</td>".
			"</tr>";
		}
	$table .= "</table>";
}
header("Content-type: application/vnd.ms-excel");  
header("Content-Disposition: attachment; filename=ArboldeProcesosyResultados".$arrayArbol[0].".xls");  
header("Pragma: no-cache");  
header("Expires: 0");
echo $table;
?>