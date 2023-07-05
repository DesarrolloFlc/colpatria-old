<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'form.class.php';
extract($_GET);
$form = new Form();
$data = mysqli_fetch_array($form->getFullInfoForm($id_form));
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
<img src="<?=SITE_ROOT?>/images/general/logo_colpatria.png" align="left" width="140px" height="120px"><h2>Digitaci&oacute;n de formulario</h2>
<hr />
<table>
<tr>
	<td class="titulo">Fecha de creaci&oacute;n:</td>
	<td><?=$data['fechacreacion']?></td>	
</tr>
<tr>
	<td class="titulo">Documento:</td>
	<td><?=number_format((double)$data['document'])?></td>	
</tr>
	<td class="titulo">Tipo de persona:</td>
	<td><?=$data['tipopersona']?></td>	
</tr>
<tr>
	<td class="titulo">Fecha radicado:</td>
	<td><?=$data['fecharadicado']?></td>	
</tr>
<tr>
	<td class="titulo">Fecha solicitud:</td>
	<td><?=$data['fechasolicitud']?></td>	
</tr>
<tr>
	<td class="titulo">Area:</td>
	<td><?=$data['descripcionarea']?></td>
</tr>
<tr>
	<td class="titulo">Sucursal:</td>
	<td><?=$data['sucursal']?></td>	
</tr>
<tr>
	<td class="titulo">Responsable:</td>
	<td><?=$data['responsable']?></td>	
</tr>
<tr>
	<td class="titulo">Clase cliente:</td>
	<td><?=$data['clasecliente']?></td>	
</tr>
<tr>
	<td class="titulo">Nombre/Raz&oacute;n social:</td>
	<td><?=$data['nombrerazon']?></td>	
</tr>
<tr>
	<td class="titulo">Tipo documento:</td>
	<td><?=$data['tipodocumento']?></td>	
</tr>
<tr>
	<td class="titulo">Documento:</td>
	<td><?=number_format((double)$data['document'])?></td>	
</tr>
<tr>
	<td class="titulo">Digito chequeo:</td>
	<td><?=$data['digitochequeo']?></td>	
</tr>
<tr>
	<td class="titulo">Nombre representente legal:</td>	
	<td><?=$data['nombrerepresentante']?></td>	
</tr>
<tr>
	<td class="titulo">Documento representente legal:</td>	
	<td><?=$data['documentorepresentante']?></td>	
</tr>
<tr>
	<td class="titulo">Fecha representente legal:</td>	
	<td><?=$data['fechaexpedicionrepresentante']?></td>	
</tr>
<tr>
	<td class="titulo">Lugar expedici&oacute;n representente legal:</td>	
	<td><?=$data['lugarexpedicionrepresentante']?></td>	
</tr>

<tr>
	<td class="titulo">Fecha expedici&oacute;n:</td>
	<td><?=$data['fechaexpedicion']?></td>	
</tr>
<tr>
	<td class="titulo">Lugar expedici&oacute;n:</td>
	<td><?=$data['lugarexpedicion']?></td>	
</tr>
<tr>
	<td class="titulo">Fecha nacimiento:</td>
	<td><?=$data['fechanacimiento']?></td>	
</tr>
<tr>
	<td class="titulo">Lugar nacimiento:</td>
	<td><?=$data['lugarnacimiento']?></td>	
</tr>
<tr>
	<td class="titulo">Sexo:</td>
	<td><?=$data['sexo']?></td>	
</tr>

<tr>
	<td class="titulo">Nacionalidad:</td>
	<td><?=$data['pais']?></td>	
</tr>
<tr>
	<td class="titulo">N&uacute;mero de hijos:</td>
	<td><?=$data['numerohijos']?></td>	
</tr>
<tr>
	<td class="titulo">Estado civil:</td>
	<td><?=$data['estadocivil']?></td>	
</tr>
<tr>
	<td class="titulo">Direcci&oacute;n de residencia:</td>
	<td><?=$data['direccionresidencia'] == "" ? "SD" : $data['direccionresidencia']?></td>	
</tr>
<tr>
	<td class="titulo">Ciudad de residencia:</td>
	<td><?=$data['lugarresidencia'] == "" ? "SD" : $data['lugarresidencia']?></td>	
</tr>
<tr>
	<td class="titulo">Tel&eacute;fono de residencia:</td>
	<td><?=$data['telefonoresidencia'] == "0" ? "SD" : $data['telefonoresidencia']?></td>	
</tr>
<tr>
	<td class="titulo">Nombre empresa:</td>
	<td><?=$data['nombreempresa'] == "" ? "SD" : $data['nombreempresa']?></td>	
</tr>
<tr>
	<td class="titulo">Lugar empresa:</td>
	<td><?=$data['lugarempresa'] == "" ? "SD" : $data['lugarempresa'] ?></td>	
</tr>
<tr>
	<td class="titulo">Direcci&oacute;n empresa:</td>
	<td><?=$data['direccionempresa'] == "" ? "SD" : $data['direccionempresa']?></td>	
</tr>
<tr>
	<td class="titulo">Nomenclatura:</td>
	<td><?=$data['nomenclatura'] == "" ? "SD" : $data['nomenclatura']?></td>	
</tr>
<tr>
	<td class="titulo">Tel&eacute;fono laboral:</td>
	<td><?=$data['telefonolaboral']?></td>	
</tr>
<tr>
	<td class="titulo">Correo electronico:</td>
	<td><?=$data['correoelectronico']?></td>	
</tr>
<tr>
	<td class="titulo">Cargo:</td>
	<td><?=$data['cargo']?></td>	
</tr>
<tr>
	<td class="titulo">Actividad econ&oacute;mica:</td>
	<td><?=$data['actividadecono']?></td>	
</tr>
<tr>
	<td class="titulo">Profesi&oacute;n:</td>
	<td><?=$data['profesion']?></td>	
</tr>
<tr>
	<td class="titulo">Ocupaci&oacute;n:</td>
	<td><?=$data['ocupacion']?></td>	
</tr>
<tr>
	<td class="titulo">CIIU:</td>
	<td><?=$data['ciiu']?></td>	
</tr>
<tr>
	<td class="titulo">Ingresos mensuales:</td>
	<td><?=$data['ingresosmensuales']?></td>	
</tr>
<tr>
	<td class="titulo">Otros ingresos:</td>
	<td><?=$data['otrosingresos']?></td>	
</tr>
<tr>
	<td class="titulo">Egresos mensuales:</td>
	<td><?=$data['egresosmensuales']?></td>	
</tr>
<tr>
	<td class="titulo">Concepto otros ingresos:</td>
	<td><?=$data['conceptos']?></td>	
</tr>
<tr>
	<td class="titulo">Actividad:</td>
	<td><?=$data['actividad']?></td>	
</tr>
<tr>
	<td class="titulo">Nivel de estudio:</td>
	<td><?=$data['estudios']?></td>	
</tr>
<tr>
	<td class="titulo">Tipo de vivienda:</td>
	<td><?=$data['tipovivienda']?></td>	
</tr>
<tr>
	<td class="titulo">Estrato:</td>
	<td><?=$data['estrato']?></td>	
</tr>
<tr>
	<td class="titulo">Total activos:</td>
	<td><?=number_format((double)$data['totalactivos'])?></td>	
</tr>
<tr>
	<td class="titulo">Total pasivos:</td>
	<td><?=number_format((double)$data['totalpasivos'])?></td>	
</tr>
<tr>
	<td class="titulo">Lugar oficina ppal:</td>
	<td><?=$data['lugaroficina']?></td>	
</tr>
<tr>
	<td class="titulo">Direcci&oacute;n oficina ppal:</td>
	<td><?=$data['direccionofi']?></td>	
</tr>
<tr>
	<td class="titulo">Nomenclatura emp:</td>
	<td><?=$data['nomenclaturaemp']?></td>	
</tr>
<tr>
	<td class="titulo">Tel&eacute;fono oficina:</td>
	<td><?=$data['telefonooficina']?></td>	
</tr>
<tr>
	<td class="titulo">Fax oficina:</td>
	<td><?=$data['faxoficina'] == "0" ? "SD" : $data['faxoficina']?></td>	
</tr>
<tr>
	<td class="titulo">Ciudad sucursal:</td>
	<td><?=$data['lugarsucursal'] == "" ? "SD" : $data['lugarsucursal']?></td>	
</tr>
<tr>
	<td class="titulo">Direcci&oacute;n sucursal:</td>
	<td><?=$data['direccionsucursal']?></td>	
</tr>
<tr>
	<td class="titulo">Nomenclatura:</td>
	<td><?=$data['nomenclaturaemp2']?></td>	
</tr>
<tr>
	<td class="titulo">Tel&eacute;fono sucursal:</td>
	<td><?=$data['telefonosucursal'] == "0" ? "SD" : $data['telefonosucursal']?></td>	
</tr>
<tr>
	<td class="titulo">Fax sucursal:</td>
	<td><?=$data['faxsucursal'] == "0" ? "SD" : $data['faxsucursal']?></td>	
</tr>
<tr>
	<td class="titulo">Actividad:</td>
	<td><?=$data['actividad2']?></td>	
</tr>
<tr>
	<td class="titulo">Detalle actividad:</td>
	<td><?=$data['detalleactividad']?></td>	
</tr>
<tr>
	<td class="titulo">Tipo empresa:</td>
	<td><?=$data['tipoemp']?></td>	
</tr>
<tr>
	<td class="titulo">Activos empresa:</td>
	<td><?=number_format((double)(double)$data['activosemp'])?></td>	
</tr>
<tr>
	<td class="titulo">Pasivos empresa:</td>
	<td><?=number_format((double)(double)$data['pasivosemp'])?></td>	
</tr>
<tr>
	<td class="titulo">Ingresos mensuales empresa:</td>
	<td><?=$data['ingresosmensuemp']?></td>	
</tr>
<tr>
	<td class="titulo">Egresos mensuales empresa:</td>
	<td><?=$data['egresosmensuemp']?></td>	
</tr>
<tr>
	<td class="titulo">Moneda extranjera:</td>
	<td><?=$data['monedaextranjera']?></td>	
</tr>
<tr>
	<td class="titulo">Tipo transacciones:</td>
	<td><?=$data['tipotransacciones']?></td>	
</tr>
<tr>
	<td class="titulo">Firma:</td>
	<td><?=$data['firma']?></td>	
</tr>
<tr>
	<td class="titulo">Huella:</td>
	<td><?=$data['huella']?></td>	
</tr>
<tr>
	<td class="titulo">Lugar entrevista:</td>
	<td><?=$data['lugarentrevista']?></td>	
</tr>
<tr>
	<td class="titulo">Resultado entrevista:</td>
	<td><?=$data['resultadoentrevista']?></td>	
</tr>
<tr>
	<td class="titulo">Observacionesentrevista:</td>
	<td><?=$data['observacionesentrevista']?></td>	
</tr>
<tr>
	<td class="titulo">Nombre intermediario:</td>
	<td><?=$data['nombreintermediario']?></td>	
</tr>
<tr>
	<td class="titulo">Socio 1:</td>
	<td><?=$data['socio1']?></td>	
</tr>
<tr>
	<td class="titulo">Socio 2:</td>
	<td><?=$data['socio2']?></td>	
</tr>
<tr>
	<td class="titulo">Socio 3:</td>
	<td><?=$data['socio3']?></td>	
</tr>
</tr>
</table>
</body>
</html>


