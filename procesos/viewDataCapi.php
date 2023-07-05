<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'contactcapi.class.php';
extract($_GET);

$contact = new Contactcapi();
$contactcapi_histo = mysqli_fetch_array($contact->getContact($id_data_capi));
?>
<html>
<head>
	<title>DocFinder: Digitaci&oacute;n de formulario</title>
</head>
<style>
body {
 font-family: Calibri, Arial;
}
table {
 font-size: 12px;
}
.titulo {
 font-weight:bold;
}
</style>
<body>
<img src="<?=SITE_ROOT?>/images/general/logo_colpatria.png" align="left" width="140px" height="120px"><h2>Detalle contacto Capi</h2>
<hr />

<table>
<tr>
	<td>Documento:</td>
	<td><?=number_format($contactcapi_histo['documento'])?></td>
</tr>
<tr>
	<td>Primer apellido:</td>
	<td><?=$contactcapi_histo['primerapellido']?></td>		
</tr>
<tr>
	<td>Segundo apellido:</td>
	<td><?=$contactcapi_histo['segundoapellido']?></td>		
</tr>
<tr>
	<td>Nombres:</td>
	<td><?=$contactcapi_histo['nombres']?></td>		
</tr>
<tr>
	<td>Fecha nacimiento:</td>
	<td><?=$contactcapi_histo['fechanacimiento']?></td>		
</tr>
<tr>
	<td>Empresa:</td>
	<td><?=$contactcapi_histo['empresa']?></td>		
</tr>
<tr>
	<td>Direcci�n laboral:</td>
	<td><?=$contactcapi_histo['direccionlaboral']?></td>		
</tr>
<tr>
	<td>Direcci�n residencia:</td>
	<td><?=$contactcapi_histo['direccionresidencia']?></td>		
</tr>
<tr>
	<td>Tel�fono residencia:</td>
	<td><?=$contactcapi_histo['telefonoresidencia']?></td>		
</tr>
<tr>
	<td>Celular:</td>
	<td><?=$contactcapi_histo['celular']?></td>		
</tr>
<tr>
	<td>Correo electr�nico:</td>
	<td><?=$contactcapi_histo['correoelectronico']?></td>		
</tr>
<tr>
	<td>No. hijos:</td>
	<td><?=$contactcapi_histo['numerohijos']?></td>		
</tr>
<tr>
	<td>Observaci�n:</td>
	<td><?=$contactcapi_histo['observacion']?></td>		
</tr>
<tr>
	<td>Fecha gesti�n:</td>
	<td><?=$contactcapi_histo['date_created']?></td>		
</tr>
</table>
</body>
</html>
