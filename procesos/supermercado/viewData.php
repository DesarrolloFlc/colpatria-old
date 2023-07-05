<?php
session_start();
require_once '../../includes.php';
require_once PATH_CCLASS.DS.'supermercado.class.php';
extract($_GET);
if($data = Supermercado::getFulldataSeguros($id_data)){
	if(!isset($data['error'])){
?>
<html>
<head>
	<title>DocFinder: Datos del cliente en Seguros</title>
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
/*foreach ($data as $key => $value) {
	echo $key."<br>";
}*/
?>
<img src="../../images/general/logo_colpatria.png" align="left" width="140px" height="120px"><h2>Datos del cliente en Seguros</h2>
<hr />
<table>
<tr>
	<td class="titulo">Fecha de Creacion</td>
	<td><?=$data['fecha_creacion']?></td>
</tr>
<tr>
	<td class="titulo">Compañia</td>
	<td><?=$data['compania']?></td>
</tr>
<tr>
	<td class="titulo">Nombres</td>
	<td><?=$data['primernombre']." ".$data['segundonombre']." ".$data['primerapellidos']." ".$data['segundoapellido']?></td>
</tr>
<tr>
	<td class="titulo">Tipo de Documento</td>
	<td><?=$data['tipodocumento']?></td>
</tr>
<tr>
	<td class="titulo">Documento</td>
	<td><?=$data['documento']?></td>
</tr>
<tr>
	<td class="titulo">Fecha de Compra</td>
	<td><?=$data['fechacompra']?></td>
</tr>
<tr>
	<td class="titulo">Fecha de Emision</td>
	<td><?=$data['fechaemision']?></td>
</tr>
<tr>
	<td class="titulo">Numero de Producto</td>
	<td><?=$data['numeroproducto']?></td>
</tr>
<tr>
	<td class="titulo">Producto Comprado</td>
	<td><?=$data['productocomprado']?></td>
</tr>
<tr>
	<td class="titulo">Direccion de Residencia</td>
	<td><?=$data['direccionresidencia']?></td>
</tr>
<tr>
	<td class="titulo">Telefono de Residencia</td>
	<td><?=$data['teltfonoresidencia']?></td>
</tr>
<tr>
	<td class="titulo">Lugar de Nacimiento</td>
	<td><?=$data['lugarnacimiento']?></td>
</tr>
<tr>
	<td class="titulo">Fecha de Nacimiento</td>
	<td><?=$data['fechanacimiento']?></td>
</tr>
<tr>
	<td class="titulo">Genero</td>
	<td><?=$data['genero']?></td>
</tr>
<tr>
	<td class="titulo">Estado Civil</td>
	<td><?=$data['estadocivil']?></td>
</tr>
<tr>
	<td class="titulo">Ciudad de Residencia</td>
	<td><?=$data['ciudadresidencia']?></td>
</tr>
<tr>
	<td class="titulo">Departamento de Residencia</td>
	<td><?=$data['departamentoresidencia']?></td>
</tr>
<tr>
	<td class="titulo">Nivel de Estudios</td>
	<td><?=$data['nivelestudios']?></td>
</tr>
<tr>
	<td class="titulo">Ocupacion</td>
	<td><?=$data['ocupacion']?></td>
</tr>
<tr>
	<td class="titulo">Actividad Economica</td>
	<td><?=$data['actividadeconomica']?></td>
</tr>
<tr>
	<td class="titulo">Profesion</td>
	<td><?=$data['profesion']?></td>
</tr>
<tr>
	<td class="titulo">Numero de Hijos</td>
	<td><?=$data['numerohijos']?></td>
</tr>
<tr>
	<td class="titulo">Empresa donde Trabajo</td>
	<td><?=$data['empresatrabajo']?></td>
</tr>
<tr>
	<td class="titulo">Direccion de Trabajo</td>
	<td><?=$data['direcciontrabajo']?></td>
</tr>
<tr>
	<td class="titulo">Telefono de Trabajo</td>
	<td><?=$data['telefonotrabajo']?></td>
</tr>
<tr>
	<td class="titulo">Otros Ingresos</td>
	<td><?=number_format($data['otrosingresos'])?></td>
</tr>
<tr>
	<td class="titulo">Total Activos</td>
	<td><?=number_format($data['totalactivos'])?></td>
</tr>
<tr>
	<td class="titulo">Total Pasivos</td>
	<td><?=number_format($data['totalpasivos'])?></td>
</tr>
<tr>
	<td class="titulo">Moneda Extranjera?</td>
	<td><?=$data['monedaextranjera']?></td>
</tr>
<tr>
	<td class="titulo">Tipo de Transaccion</td>
	<td><?=$data['tipotransacciones']?></td>
</tr>
<tr>
	<td class="titulo">Sucursal</td>
	<td><?=$data['sucursal']?></td>
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


