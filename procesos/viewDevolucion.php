<?php
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_SITE . DS . 'config/globalParameters.php';
extract($_GET);
$devolucion = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT * FROM workflow WHERE id = '$id_devolucion'"));
?>
<html>
<head>
	<style> 
		body {
			font-family: Calibri, Tahoma;
		}
	</style> 
</head>
<body>
<h2>Detalle de devoluci&oacute;n</h2>
<hr />
<table>
	<tr>
		<td style="font-weight:bold">Lote:</td>
		<td><?=$devolucion['lote']?></td></tr>
	<tr>
	<tr>
		<td style="font-weight:bold">Documento:</td>
		<td><?=$devolucion['documento']?></td>
	</tr>
	<tr>
		<td style="font-weight:bold">Nombre:</td>
		<td><?=$devolucion['nombre']?></td>
	</tr>
	<tr>
		<td style="font-weight:bold">Causal:</td>
		<td><?=$devolucion['causal']?></td>
	</tr>
	<tr>
		<td style="font-weight:bold">Observaci&oacute;n:</td>
		<td><?=$devolucion['observation']?></td>
	</tr>
		<td style="font-weight:bold">Fecha creaci&oacute;n:</td>
		<td><?=$devolucion['date_created']?></td>
	</tr>
</table>
</body>
</html>
