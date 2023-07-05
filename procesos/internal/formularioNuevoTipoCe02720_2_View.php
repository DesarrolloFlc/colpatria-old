<table id="table_parte1">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="center"><strong>DATOS B&Aacute;SICOS DE LA EMPRESA</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombre de la empresa:</td>
		<td><input type="text" id="razonsocial" name="razonsocial" style="width: 280px" onkeypress="return validar_letra(event)" title="Nombre de la empresa"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">NIT:</td>
		<td>
			<input type="text" id="nit" name="nit" style="width: 130px; margin-right: 10px" title="NIT" onblur="$(this).ocultarEsteCampo(event);" onkeypress="return validar_num(event)">
			<input type="hidden" id="digitochequeo" name="digitochequeo" value="0">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Producto o seguro:</td>
		<td><input type="text" id="producto_seguro" name="producto_seguro" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)" title="Producto o seguro a adquirir"></td><!--CREAR NUEVO CAMPO producto_seguro-->
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
		<td style="width: 100px;display: table-cell;">Direccion:</td>
		<td><input type="text" id="direccionoficinappal" name="direccionoficinappal" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion" onblur="$(this).ocultarEsteCampo(event);"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ciudad / Departamento:</td>
		<td>
			<select id="ciudadoficina" name="ciudadoficina" style="font-size: 12px" title="Ciudad / Departamento">
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
			<input type="text" id="telefonoficina" name="telefonoficina" style="width: 100px; margin-right: 10px" onchange="$(this).checkTamanoTele(event, 7);" maxlength="7" title="Telefono" onkeypress="return validar_num(event)">
			Celular:
			<input type="text" id="celularoficina" name="celularoficina" style="width: 100px; margin-right: 10px" onchange="$(this).checkTamanoTele(event, 10);" maxlength="10" title="Celular" onkeypress="return validar_num(event)">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">E-mail:</td>
		<td>
			<input type="text" id="correoelectronico_otro" name="correoelectronico_otro" style="width: 230px" onkeypress="return validar_letra(event)" title="E-mail" onblur="$(this).ocultarEsteCampo(event);">
		</td>
	</tr>
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="center"><strong>DATOS B&Aacute;SICOS DEL REPRESENTANTE LEGAL</strong></td>
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
		<td style="width: 100px;display: table-cell;">Tipo identificacion:</td>
		<td>
			<select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px" title="Tipo identificacion">
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
		<td style="width: 100px;display: table-cell;">Nacionalidad:</td>
		<td>
			<select id="paisnacimiento" name="paisnacimiento" style="font-size: 12px" title="Nacionalidad" onblur="$(this).verificarPais(event, 'paisnacimiento');">
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
			<select id="nacionalidad_otra" name="nacionalidad_otra" style="font-size: 12px" title="Nacionalidad 2" onblur="$(this).verificarPais(event, 'nacionalidad_otra');">
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
</table>