<table id="table_parte1">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="center"><strong>DATOS B&Aacute;SICOS DE LA EMPRESA</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombre de la empresa:</td>
		<td><input type="text" id="razonsocial" name="razonsocial" style="width: 280px" onkeypress="return validar_letra(event)" title="Nombre de la empresa" value="<?=$dataform['razonsocial']?>" data-oldvalue="<?=$dataform['razonsocial']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">NIT:</td>
		<td>
			<input type="text" id="nit" name="nit" style="width: 130px; margin-right: 10px" title="NIT" readonly onkeypress="return validar_num(event)" value="<?=$dataform['nit']?>" data-oldvalue="<?=$dataform['nit']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Producto o seguro:</td>
		<td><input type="text" id="producto_seguro" name="producto_seguro" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)" title="Producto o seguro a adquirir" value="<?=$dataform['producto_seguro']?>" data-oldvalue="<?=$dataform['producto_seguro']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Obligaciones fiscales en otro pais?</td>
		<td>
			<select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 15px" title="Obligaciones fiscales en otro pais" data-oldvalue="<?=$dataform['tributarias_otro_pais']?>">
				<option value="">Seleccion...</option>
				<option value="-1"<?=(($dataform['tributarias_otro_pais'] == "-1") ? "selected" : "")?>>SI</option>
				<option value="0"<?=(($dataform['tributarias_otro_pais'] == "0") ? "selected" : "")?>>NO</option>
				<option value="2"<?=(($dataform['tributarias_otro_pais'] == "2") ? "selected" : "")?>>SD</option>
			</select>
			Cuales?
			<input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px; margin-left: 10px" disabled onkeypress="return validar_letra(event)" title="Cuales" value="<?=$dataform['tributarias_paises']?>" data-oldvalue="<?=$dataform['tributarias_paises']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Direccion:</td>
		<td><input type="text" id="direccionoficinappal" name="direccionoficinappal" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion" value="<?=$dataform['direccionoficinappal']?>" data-oldvalue="<?=$dataform['direccionoficinappal']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ciudad / Departamento:</td>
		<td>
			<select id="ciudadoficina" name="ciudadoficina" style="font-size: 12px" title="Ciudad / Departamento" data-oldvalue="<?=$dataform['ciudadoficina']?>">
				<option value="">Seleccione...</option>
	<?php
	if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
		foreach($daneCiudades as $ciudad){
    	$slect = '';
        if($dataform['ciudadoficina'] == $ciudad['id'])
            $slect = ' selected';
	?>
				<option value="<?=$ciudad['id']?>"<?=$slect?>><?=$ciudad['ciudad']?></option>
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
			<input type="text" id="telefonoficina" name="telefonoficina" style="width: 100px; margin-right: 10px" onchange="$(this).checkTamanoTele(event, 7);" maxlength="7" title="Telefono" onkeypress="return validar_num(event)" value="<?=$dataform['telefonoficina']?>" data-oldvalue="<?=$dataform['telefonoficina']?>">
			Celular:
			<input type="text" id="celularoficina" name="celularoficina" style="width: 100px; margin-right: 10px" onchange="$(this).checkTamanoTele(event, 10);" maxlength="10" title="Celular" onkeypress="return validar_num(event)" value="<?=$dataform['celularoficina']?>" data-oldvalue="<?=$dataform['celularoficina']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">E-mail:</td>
		<td>
			<input type="text" id="correoelectronico_otro" name="correoelectronico_otro" style="width: 230px" onkeypress="return validar_letra(event)" title="E-mail" value="<?=$dataform['correoelectronico_otro']?>" data-oldvalue="<?=$dataform['correoelectronico_otro']?>">
		</td>
	</tr>
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="center"><strong>DATOS B&Aacute;SICOS DEL REPRESENTANTE LEGAL</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Primer apellido:</td>
		<td>
			<input type="text" id="primerapellido" name="primerapellido" style="width: 130px; margin-right: 30px" onkeypress="return validar_letra(event)" title="Primer apellido" value="<?=$dataform['primerapellido']?>" data-oldvalue="<?=$dataform['primerapellido']?>">
			Segundo apellido:&nbsp;
			<input type="text" id="segundoapellido" name="segundoapellido" style="width: 130px" onkeypress="return validar_letra(event)" title="Segundo apellido" value="<?=$dataform['segundoapellido']?>" data-oldvalue="<?=$dataform['segundoapellido']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombres:</td>
		<td><input type="text" id="nombres" name="nombres" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)" title="Nombres" value="<?=$dataform['nombres']?>" data-oldvalue="<?=$dataform['nombres']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo identificacion:</td>
		<td>
			<select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px" title="Tipo identificacion" data-oldvalue="<?=$dataform['tipodocumento']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($tipoDocumentos) && !empty($tipoDocumentos) && is_array($tipoDocumentos)){
	foreach($tipoDocumentos as $tipo){
    	$slect = '';
        if($dataform['tipodocumento'] == $tipo['id'])
            $slect = ' selected';
?>
				<option value="<?=$tipo['id']?>"<?=$slect?>><?=$tipo['description']?></option>
<?php
	}
}
?>
			</select>
			Numero identificacion:&nbsp;<input type="text" id="documento" name="documento" style="width: 130px; display: initial;" title="Numero identificacion" value="<?=$dataform['documento']?>" data-oldvalue="<?=$dataform['documento']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nacionalidad:</td>
		<td>
			<select id="paisnacimiento" name="paisnacimiento" style="font-size: 12px" title="Nacionalidad" data-oldvalue="<?=$dataform['paisnacimiento']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
    	$slect = '';
        if($dataform['paisnacimiento'] == $pais['id'])
            $slect = ' selected';
?>
				<option value="<?=$pais['id']?>"<?=$slect?>><?=$pais['description']?></option>
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
			<select id="nacionalidad_otra" name="nacionalidad_otra" style="font-size: 12px" title="Nacionalidad 2" data-oldvalue="<?=$dataform['nacionalidad_otra']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
    	$slect = '';
        if($dataform['nacionalidad_otra'] == $pais['id'])
            $slect = ' selected';
?>
				<option value="<?=$pais['id']?>"<?=$slect?>><?=$pais['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
</table>