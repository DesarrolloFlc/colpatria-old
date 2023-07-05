<tr>
	<td colspan="2">PERSONA NATURAL</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Actividad economica:</td>
	<td>
		<select id="tipoactividad" name="tipoactividad" style="font-size: 12px; margin-right: 5px" title="Actividad economica">
			<option value="">Seleccione...</option>
<?php
if(isset($actEconomicas) && !empty($actEconomicas) && is_array($actEconomicas)){
	foreach($actEconomicas as $actEconomica){
?>
			<option value="<?=$actEconomica['id']?>"><?=$actEconomica['description']?></option>
<?php
	}
}
?>
		</select>
		CIIU(codigo):
		<select id="ciiu" name="ciiu" style="font-size: 12px; margin-right: 5px" title="CIIU(codigo)">
			<option value="">Seleccione...</option>
<?php
if(isset($ciius) && !empty($ciius) && is_array($ciius)){
	foreach($ciius as $ciiu){
?>
			<option value="<?=$ciiu['codigo']?>"><?=$ciiu['descripcion']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Ocupacion / Profesion</td>
	<td>
		<select id="profesion" name="profesion" style="font-size: 12px; margin-right: 5px" title="Ocupacion / Profesion">
			<option value="">Seleccione...</option>
<?php
if(isset($profesiones) && !empty($profesiones) && is_array($profesiones)){
	foreach($profesiones as $profesion){
?>
			<option value="<?=$profesion['id']?>"><?=$profesion['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Cargo:</td>
	<td><input type="text" id="cargo" name="cargo" style="width: 260px" onkeypress="return validar_letra(event)" title="Cargo"></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Actividad secundaria:</td>
	<td>
		<input type="text" id="detalleactividadeconomicappal" name="detalleactividadeconomicappal" style="width: 130px; margin-right: 15px" onkeypress="return validar_letra(event)" title="Actividad secundaria">
		CIIU:
		<select id="ciiu_otro" name="ciiu_otro" style="font-size: 12px; margin-right: 5px" title="CIIU"><!--agregar campo llamado ciiu_otro-->
			<option value="">Seleccione...</option>
<?php
if(isset($ciius) && !empty($ciius) && is_array($ciius)){
	foreach($ciius as $ciiu){
?>
			<option value="<?=$ciiu['codigo']?>"><?=$ciiu['descripcion']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Direccion:</td>
	<td>
		<input type="text" id="direccionoficinappal" name="direccionoficinappal" style="width: 180px; margin-right: 15px" onkeypress="return validar_letra(event)" title="Direccion">
		Telefono:
		<input type="text" id="telefonoficinappal" name="telefonoficinappal" style="width: 100px" onblur="$(this).checkTamanoTele(7);" maxlength="7" title="Telefono"><!--agregar campo llamado telefonoficinappal-->
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Tipo de comercio:</td>
	<td><input type="text" id="detalletipoactividad" name="detalletipoactividad" style="width: 220px" onkeypress="return validar_letra(event)" title="Tipo de comercio"></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Ingresos mensuales:</td>
	<td>
		<select id="ingresosmensuales" name="ingresosmensuales" style="font-size: 12px; margin-right: 5px" title="Ingresos mensuales">
			<option value="">Seleccione...</option>
<?php
if(isset($ingresos) && !empty($ingresos) && is_array($ingresos)){
	foreach($ingresos as $ingreso){
?>
			<option value="<?=$ingreso['id']?>"><?=$ingreso['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Activos:</td>
	<td>
		<input type="text" id="totalactivos" name="totalactivos" style="width: 100px; margin-right: 20px" title="Activos">
		Pasivos:
		<input type="text" id="totalpasivos" name="totalpasivos" style="width: 100px" title="Pasivos">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Egresos mensuales:</td>
	<td>
		<select id="egresosmensuales" name="egresosmensuales" style="font-size: 12px; margin-right: 5px" title="Egresos mensuales">
			<option value="">Seleccione...</option>
<?php
if(isset($egresos) && !empty($egresos) && is_array($egresos)){
	foreach($egresos as $egreso){
?>
			<option value="<?=$egreso['id']?>"><?=$egreso['description']?></option>
<?php
	}
}
?>
		</select>
		Patrimonio:
		<input type="text" id="patrimonio" name="patrimonio" style="width: 100px" title="Patrimonio"><!--agregar campo llamado patrimonio-->
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Otros ingresos:</td>
	<td>
		<select id="otrosingresos" name="otrosingresos" style="font-size: 12px; margin-right: 5px" title="Otros ingresos">
			<option value="">Seleccione...</option>
<?php
if(isset($ingresos) && !empty($ingresos) && is_array($ingresos)){
	foreach($ingresos as $ingreso){
?>
			<option value="<?=$ingreso['id']?>"><?=$ingreso['description']?></option>
<?php
	}
}
?>
			<option value="13">SD</option>
		</select>
		Concepto otros ingresos:
		<input type="text" id="conceptosotrosingresos" name="conceptosotrosingresos" style="width: 150px" onkeypress="return validar_letra(event)" title="Concepto otros ingresos">
	</td>
</tr>