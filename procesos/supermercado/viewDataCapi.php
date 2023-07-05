<?php
session_start();
require_once '../../includes.php';
require_once '../../lib/class/supermercado.class.php';
extract($_GET);
if($data = Supermercado::getFulldataCapi($id_data)){
	if(!isset($data['error'])){
?>
<html>
<head>
	<title>DocFinder: Datos del cliente en Capi</title>
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
<?php
//print_r($data);
/*foreach ($data as $key => $value) {
	echo $key."<br>";
}*/
?>
<img src="../../images/general/logo_colpatria.png" align="left" width="140px" height="120px"><h2>Datos del cliente en Capi</h2>
<hr />
<table>
<tr>
	<td class="titulo">Fecha de Creacion:</td>
	<td>
	<?php
		echo $data['date_created']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Sucursal:</td>
	<td>
	<?php
		echo $data['sucursal']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Fecha de Expedicion:</td>
	<td>
	<?php
		echo $data['fechaexpedicion']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Titulo:</td>
	<td>
	<?php
		echo $data['titulo']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Digito de Chequeo:</td>
	<td>
	<?php
		echo $data['digitochequeo']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Consecutivo:</td>
	<td>
	<?php
		echo $data['consecutivo']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Tipo de Documento:</td>
	<td>
	<?php
		echo $data['tipodocumento']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Documento:</td>
	<td>
	<?php
		echo $data['documento']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">primerapellido:</td>
	<td></td>
</tr>
<tr>
	<td class="titulo">Fecha de Nacimiento:</td>
	<td>
	<?php
		echo $data['fechanacimiento']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Lugar de Nacimiento:</td>
	<td>
	<?php
		echo $data['lugarnacimiento']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Numero de Hijos:</td>
	<td>
	<?php
		echo $data['numerohijos']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Estado Civil:</td>
	<td>
	<?php
		echo $data['estadocivil']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Nivel de Estudios:</td>
	<td>
	<?php
		echo $data['nivelestudios']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Ingresos:</td>
	<td>
	<?php
		echo number_format($data['ingr
		es
		os'])?></td>
</tr>
<tr>
	<td class="titulo">Egresos:</td>
	<td>
	<?php
		echo number_format($data['egr
		es
		os'])?></td>
</tr>
<tr>
	<td class="titulo">Activos:</td>
	<td>
	<?php
		echo number_format($data['act
		iv
		os'])?></td>
</tr>
<tr>
	<td class="titulo">Pasivos:</td>
	<td>
	<?php
		echo number_format($data['pas
		iv
		os'])?></td>
</tr>
<tr>
	<td class="titulo">Profesion:</td>
	<td>
	<?php
		echo $data['profesion']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Empresa:</td>
	<td>
	<?php
		echo $data['empresa']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Ingresos Mensuales:</td>
	<td>
	<?php
		echo $data['ingresosmensuales']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Egresos Mensuales:</td>
	<td>
	<?php
		echo $data['egresosmensuales']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Ciudad Laboral:</td>
	<td>
	<?php
		echo $data['ciudadlaborall']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Direccion Laboral:</td>
	<td>
	<?php
		echo $data['direccionlaboral']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Telefono Laboral:</td>
	<td>
	<?php
		echo $data['telefonolaboral']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Ciudad de Residencia:</td>
	<td>
	<?php
		echo $data['ciudadresidenciaa']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Direccion de Residencia:</td>
	<td>
	<?php
		echo $data['direccionresidencia']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Telefono Residencia 1:</td>
	<td>
	<?php
		echo $data['telefonoresidencia1']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Telefono Residencia 2:</td>
	<td>
	<?php
		echo $data['telefonoresidencia2']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Celular:</td>
	<td>
	<?php
		echo $data['celular']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Correo Electronico:</td>
	<td>
	<?php
		echo $data['correoelectronico']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Nit:</td>
	<td>
	<?php
		echo $data['nit']
	?>
	</td>
</tr>
<tr>
	<td class="titulo">Razon Social:</td>
	<td>
	<?php
		echo $data['razonsocial']
	?>
	</td>
</tr>

</table>
</body>
</html>
<?php
}else{
	echo $data['error'];
}
}else{
	echo "Ocurrio un error, comunicarse con el administrador";
}
?>


