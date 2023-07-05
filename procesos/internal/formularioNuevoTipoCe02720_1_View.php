<table id="table_parte1">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="center"><strong>DATOS B&Aacute;SICA DEL TOMADOR</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Primer apellido:</td>
		<td>
			<input type="text" id="primerapellido" name="primerapellido" style="width: 130px; margin-right: 30px" onkeypress="return validar_letra(event)" title="Primer apellido">
			Segundo apellido:&nbsp;
			<input type="text" id="segundoapellido" name="segundoapellido" style="width: 130px" onkeypress="return validar_letra(event)" title="Segundo apellido">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombres:</td>
		<td><input type="text" id="nombres" name="nombres" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)" title="Nombres"></td>
	</tr>
	<input type="hidden" id="sexo" name="sexo" value="SD">
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo documento:</td>
		<td>
			<select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px" title="Tipo documento">
				<option value="">Seleccione...</option>
<?php
if(isset($tipoDocumentos) && !empty($tipoDocumentos) && is_array($tipoDocumentos)){
	foreach($tipoDocumentos as $tipo){
?>
				<option value="<?=$tipo['id']?>"><?=$tipo['description']?></option>
<?php
	}
}
?>
			</select>
			Numero identificacion:&nbsp;<input type="text" id="documento" name="documento" style="width: 130px; display: initial;" title="Numero identificacion" onblur="$(this).ocultarEsteCampo(event);">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Fecha expedicion:</td>
		<td>
			<select id="f_exp_a" name="f_exp_a" onchange="$(this).verificarFecha(event, 'exp', '1');" style="font-size: 12px" title="Año de fecha expedicion">
				<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
			</select>
			<select id="f_exp_m" name="f_exp_m" onchange="$(this).verificarFecha(event, 'exp', '1');" style="font-size: 12px" title="Mes de fecha expedicion">
				<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$val_m.'">'.$val_m.'</option>';
}
?>
			</select>
			<select id="f_exp_d" name="f_exp_d" onblur="$(this).verificarFechaDoble(event, 'exp', '1');" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de fecha expedicion">
				<option value="">Dia</option>
			</select>
		</td>
	</tr>
	<input type="hidden" id="lugarexpedicion" name="lugarexpedicion" value="99999">
	<tr>
		<td style="width: 100px;display: table-cell;">Fecha nacimiento:</td>
		<td>
			<select id="f_nac_a" name="f_nac_a" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px" title="Año de fecha nacimiento">
				<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
			</select>
			<select id="f_nac_m" name="f_nac_m" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px" title="Mes de fecha nacimiento">
				<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$val_m.'">'.$val_m.'</option>';
}
?>
			</select>
			<select id="f_nac_d" name="f_nac_d" onblur="$(this).verificarFechaDoble(event, 'nac', '1');" style="font-size: 12px" title="Dia de fecha nacimiento">
				<option value="">Dia</option>
			</select>
		</td>
	</tr>
	<input type="hidden" id="lugarnacimiento" name="lugarnacimiento" value="99999">
	<tr>
		<td style="width: 100px;display: table-cell;">Nacionalidad:</td>
		<td>
			<select id="paisnacimiento" name="paisnacimiento" onblur="$(this).verificarPais(event, 'paisnacimiento');" style="font-size: 12px" title="Nacionalidad">
				<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
?>
				<option value="<?=$pais['id']?>"><?=$pais['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nacionalidad 2:</td>
		<td>
			<select id="nacionalidad_otra" name="nacionalidad_otra" onblur="$(this).verificarPais(event, 'nacionalidad_otra');" style="font-size: 12px" title="Nacionalidad 2">
				<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
?>
				<option value="<?=$pais['id']?>"><?=$pais['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Obligaciones fiscales en otro pais?</td>
		<td>
			<select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 15px" title="Obligaciones fiscales en otro pais">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
			Cuales?
			<input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px; margin-left: 10px" disabled onkeypress="return validar_letra(event)" title="Cuales">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Producto o seguro:</td>
		<td><input type="text" id="producto_seguro" name="producto_seguro" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)" title="Producto o seguro a adquirir"></td><!--CREAR NUEVO CAMPO producto_seguro-->
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Direccion residencia:</td>
		<td><input type="text" id="direccionresidencia" name="direccionresidencia" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion residencia" onblur="$(this).ocultarEsteCampo(event);"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ciudad y departamento:</td>
		<td>
			<select id="ciudadresidencia" name="ciudadresidencia" style="font-size: 12px" title="Ciudad y departamento">
				<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
?>
				<option value="<?=$ciudad['id']?>"><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Telefono:</td>
		<td>
			<input type="text" id="telefonoresidencia" name="telefonoresidencia" style="width: 130px; margin-right: 40px" maxlength="7" onchange="$(this).checkTamanoTele(event, 7);" onkeypress="return validar_num(event)" title="Telefono">
			Celular:
			<input type="text" id="celular" name="celular" style="width: 130px" maxlength="10" onchange="$(this).checkTamanoTele(event, 10);" onkeypress="return validar_num(event)" title="Celular">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">E-mail:</td>
		<td><input type="text" id="correoelectronico" name="correoelectronico" style="width: 240px" onkeypress="return validar_letra(event)" title="E-mail" onblur="$(this).ocultarEsteCampo(event);"></td>
	</tr>
	<input type="hidden" id="direccionempresa" name="direccionempresa" value="SD">
	<input type="hidden" id="telefonolaboral" name="telefonolaboral" value="0">
	<input type="hidden" id="ciudadempresa" name="ciudadempresa" value="99999">
	<input type="hidden" id="celularoficinappal" name="celularoficinappal" value="0">
	<input type="hidden" id="tipoempresaemp" name="tipoempresaemp" value="4">
	<input type="hidden" id="tipoempresaemp_cual" name="tipoempresaemp_cual" value="SD">
</table>