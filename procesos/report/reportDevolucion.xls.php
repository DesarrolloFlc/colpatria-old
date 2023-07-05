<?php
session_start();

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportDevoluciones.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_SITE . DS . 'config/globalParameters.php';

extract($_POST);

if( !empty($hora )) {
	$hora = $hora+1;
	$complemento = " WHERE wf.date_created >= '$fecha_inicio $hora:00:00' AND wf.date_created  <= '$fecha_fin $hora:59:59' AND wf.status = '1' ";
} else {
	$complemento = " WHERE wf.date_created >= '$fecha_inicio 00:00:00' AND wf.date_created <= '$fecha_fin 23:59:59'  AND wf.status = '1' ";
}

if( !empty($area)) {
	$complemento.= " AND wf.id_area = '$area' ";
} 

if( !empty($sucursal)) {
	$complemento.= " AND wf.id_sucursal = '$sucursal' ";

}

if( !empty($lote)) {
	$complemento.= " AND wf.lote = '$lote' ";

}

$sql = "SELECT wf.lote,
			   wf.documento,
			   wf.nombre,
			   wf.causal,
			   wf.observation,
			   param_area.description,
			   param_sucursales.sucursal,
			   official.identificacion,
			   official.name,
			   wf.date_created,
			   user.name,
			   wf.id_sucursal AS centro_costo
		  FROM workflow wf 
		 INNER JOIN user ON user.id = wf.id_user 
		  LEFT JOIN official ON official.id = wf.id_official 
		 INNER JOIN  param_sucursales ON param_sucursales.id = wf.id_sucursal
		  LEFT JOIN param_area ON param_area.id = wf.id_area 
		  $complemento";
$result = mysqli_query($GLOBALS['link'], $sql);
?>
<table>
	<tr>
		<td>Lote</td>
		<td>Identificaci&oacute;n</td>
		<td>Nombre</td>
		<td>Causal</td>
		<td>Observaci&oacute;n</td>
		<td>&Aacute;rea</td>
		<td>Sucursal</td>
		<td>Identificaci&oacute;n del responsable</td>
		<td>Nombre del responsable</td>
		<td>Fecha de creaci&oacute;n</td>
		<td>Creador devoluci&oacute;n</td>
		<td>Centro de costo</td>
	</tr>
<?php
while( $registro = mysqli_fetch_array($result)) {
?>
	<tr>
		<td><?=$registro[0]?></td>
		<td><?=$registro[1]?></td>
		<td><?=$registro[2]?></td>
		<td><?=$registro[3]?></td>
		<td><?=$registro[4]?></td>
		<td><?=$registro[5]?></td>
		<td><?=$registro[6]?></td>
		<td><?=$registro[7]?></td>
		<td><?=$registro[8]?></td>
		<td><?=$registro[9]?></td>
		<td><?=$registro[10]?></td>
		<td><?=$registro[11]?></td>
	</tr>
<?php
}
?>
</table>
