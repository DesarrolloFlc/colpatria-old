<tr>
	<td colspan="2" align="center"><strong>PERSONA JURIDICA</strong></td>
</tr>
<tr>
	<td>Razon social</td>
	<td>
		<input type="text" name="razonsocial" id="razonsocial" Class="obligatorio" onkeypress="return validar_letra(event)" title="Razon social">
	</td>
</tr>
<tr>
	<td>NIT</td>
	<td>
		<input type="text" name="nit" id="nit" onkeypress="return validar_num(event)" class="obligatorio" title="NIT">
		Cod. Verf.
		<input type="text" name="digitochequeo" id="digitochequeo" onkeypress="return validar_num(event)" maxlength="1" size="4" class="obligatorio" title="Cod. Verf.">
	</tr>
<tr>
	<td>Re-escribir NIT</td>
	<td>
		<input type="text" name="nit2" id="nit2" onkeypress="return validar_num(event)" onpaste="alert('No no no...');return false" class="obligatorio" title="Re-escribir NIT">
		Cod. Verf.
		<input type="text" name="digitochequeo2" id="digitochequeo2" onkeypress="return validar_num(event)" onpaste="alert('No no no...');return false" size="4" class="obligatorio" maxlength="1" title="Cod. Verf.">
	</td>
</tr>
<tr>
	<td>CIIU</td>
	<td>
		<select id="ciiu" name="ciiu" class="obligatorio" title="CIIU">
			<option value="">-Opciones-</option>
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
	<td>Ciudad oficina ppal.</td>
	<td>
		<select id="ciudadoficina" name="ciudadoficina" class="obligatorio" title="Ciudad oficina ppal">
			<option value="">-Opciones-</option>
<?php
if(isset($ciudades) && !empty($ciudades) && is_array($ciudades)){
	foreach($ciudades as $ciudad){
?>
			<option value="<?=$ciudad['id']?>"><?=$ciudad['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Dirección oficina ppal.</td>
	<td>
		<input type="text" name="direccionoficinappal" id="direccionoficinappal" class="obligatorio" onkeypress="return validar_letra(event)" title="Dirección oficina ppal" onblur="$(this).ocultarEsteCampo(event);">
	</td>
</tr>
<tr>
	<td>Nomenclatura</td>
	<td>
		<select name="nomenclatura_emp" id="nomenclatura_emp" title="Nomenclatura">
			<option value="Nomenclatura nueva">Nomenclatura nueva</option>
			<option value="Nomenclatura antigua">Nomenclatura antigua</option>
			<option value="SD">SD</option>
		</select>
	</td>
</tr>
<tr>
	<td>Teléfono oficina</td>
	<td>
		<input type="text" name="telefonoficina" id="telefonoficina" onchange="$(this).checkTamanoTele(event, 7);" onkeypress="return validar_num(event)" maxlength="7" class="obligatorio" title="Teléfono oficina">
	</td>
</tr>
<tr>
	<td>Fax oficina</td>
	<td>
		<input type="text" name="faxoficina" id="faxoficina" onchange="$(this).checkTamanoTele(event, 7);" onkeypress="return validar_num(event)" maxlength="7" title="Fax oficina">
	</td>
</tr>
<tr>
	<td>Celular oficina</td>
	<td>
		<input type="text" name="celularoficina" id="celularoficina" onchange="$(this).checkTamanoTele(event, 10);" onkeypress="return validar_num(event)" maxlength="10" class="obligatorio" title="Celular oficina">
	</td>
</tr>
<tr>
	<td>Ciudad sucursal</td>
	<td colspan="3">
		<select id="ciudadsucursal" name="ciudadsucursal" title="Ciudad sucursal">
			<option value="">-Opciones-</option>
<?php
if(isset($ciudades) && !empty($ciudades) && is_array($ciudades)){
	foreach($ciudades as $ciudad){
?>
			<option value="<?=$ciudad['id']?>"><?=$ciudad['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Dirección sucursal</td>
	<td>
		<input type="text" name="direccionsucursal" id="direccionsucursal" onkeypress="return validar_letra(event)" title="Dirección sucursal" onblur="$(this).ocultarEsteCampo(event);">
	</td>
</tr>
<tr>
	<td>Nomenclatura</td>
	<td>
		<select name="nomenclatura_emp2" id="nomenclatura_emp2" title="Nomenclatura">
			<option value="Nomenclatura nueva">Nomenclatura nueva</option>
			<option value="Nomenclatura antigua">Nomenclatura antigua</option>
			<option value="SD">SD</option>
		</select>
	</td>
</tr>
<tr>
	<td>Teléfono sucursal</td>
	<td>
		<input type="text" name="telefonosucursal" id="telefonosucursal" onchange="$(this).checkTamanoTele(event, 7);" onkeypress="return validar_num(event)" maxlength="7" title="Teléfono sucursal">
	</td>
</tr>
<tr>
	<td>Fax sucursal</td>
	<td>
		<input type="text" name="faxsucursal" id="faxsucursal" onchange="$(this).checkTamanoTele(event, 7);" onkeypress="return validar_num(event)" maxlength="7" title="Fax sucursal">
	</td>
</tr>
<tr>
	<td>Actividad economica ppal.</td>
	<td>
		<select id="actividadeconomicappal" name="actividadeconomicappal" class="obligatorio" title="Actividad economica ppal">
			<option value="">-Opciones-</option>
<?php
if(isset($actividades) && !empty($actividades) && is_array($actividades)){
	foreach($actividades as $actividad){
?>
			<option value="<?=$actividad['id']?>"><?=$actividad['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Otro:</td>
	<td>
		<input type="text" name="detalleactividadeconomicappal" onkeypress="return validar_letra(event)" id="detalleactividadeconomicappal" disabled title="Otro">
	</td>
</tr>
<tr>
	<td>Tipo empresa</td>
	<td>
		<select id="tipoempresaemp" name="tipoempresaemp" class="obligatorio" title="Tipo empresa">
			<option value="">-Opciones-</option>
<?php
if(isset($tipo_empresa) && !empty($tipo_empresa) && is_array($tipo_empresa)){
	foreach($tipo_empresa as $tipo_empre){
?>
			<option value="<?=$tipo_empre['id']?>"><?=$tipo_empre['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Re-escribir Teléfono oficina</td>
	<td>
		<input type="text" name="telefonoficina2" id="telefonoficina2" onkeypress="return validar_num(event)" maxlength="7" onblur="$(this).validarReTelefono(event, 'form_fingering', 'telefonoficina', 'Los campos de telefono de oficina no coinciden.')" title="Re-escribir Teléfono oficina">
	</td>
</tr>
<tr>
	<td>Re-escribir Celular oficina</td>
	<td>
		<input type="text" name="celularoficina2" id="celularoficina2" onkeypress="return validar_num(event)" maxlength="10" onblur="$(this).validarReTelefono(event, 'form_fingering', 'celularoficina', 'Los campos de celular de oficina no coinciden.')" title="Re-escribir Celular oficina">
	</td>
</tr>
<tr>
	<td>Activos empresa</td>
	<td>
		<input type="text" id="activosemp" name="activosemp" onkeypress="return validar_num(event)" class="obligatorio" title="Activos empresa">
	</td>
</tr>
<tr>
	<td>Re-escribir dirección oficina ppal.</td>
	<td>
		<input type="text" name="direccionoficinappal2" id="direccionoficinappal2" class="obligatorio" onkeypress="return validar_letra(event)" title="Dirección oficina ppal" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'direccionoficinappal', 'Las direcciones de oficina principal no coinciden por favor validelos.');">
	</td>
</tr>
<tr>
	<td>Pasivos empresa</td>
	<td>
		<input type="text"  id="pasivosemp" name="pasivosemp" onkeypress="return validar_num(event)" class="obligatorio" title="Pasivos empresa">
	</td>
</tr>
<tr>
	<td>Re-escribir dirección sucursal</td>
	<td>
		<input type="text" name="direccionsucursal" id="direccionsucursal" onkeypress="return validar_letra(event)" title="Dirección sucursal" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'direccionsucursal', 'Las direcciones de sucursal no coinciden por favor validelos.');">
	</td>
</tr>
<tr>
	<td>Ingresos mensuales empresa</td>
	<td>
		<select id="ingresosmensualesemp" name="ingresosmensualesemp" class="obligatorio" title="Ingresos mensuales empresa">
			<option value="">-Opciones-</option>
<?php
if(isset($ingresos_mensuales_emp) && !empty($ingresos_mensuales_emp) && is_array($ingresos_mensuales_emp)){
	foreach($ingresos_mensuales_emp as $ingreso_mensuales_emp){
?>
			<option value="<?=$ingreso_mensuales_emp['id']?>"><?=$ingreso_mensuales_emp['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Egresos mensuales empresa</td>
	<td>
		<select id="egresosmensualesemp" name="egresosmensualesemp" class="obligatorio" title="Egresos mensuales empresa">
			<option value="">-Opciones-</option>
<?php
if(isset($egresos_mensuales_emp) && !empty($egresos_mensuales_emp) && is_array($egresos_mensuales_emp)){
	foreach($egresos_mensuales_emp as $egreso_mensuales_emp){
?>
			<option value="<?=$egreso_mensuales_emp['id']?>"><?=$egreso_mensuales_emp['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
    <td style="width: 100px;display: table-cell;">Administrador expuesto publicamente?</td>
    <td>
        <select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado expuesta_publica-->
            <option value="">Seleccion...</option>
            <option value="-1">SI</option>
            <option value="0">NO</option>
            <option value="2">SD</option>
        </select>
    </td>
</tr>
<!-- <tr>
    <td style="width: 100px;display: table-cell;">Vinculo persona expuesta publicamente?</td>
    <td>
        <select id="servidor_publico" name="servidor_publico" style="font-size: 12px; margin-right: 15px">agregar campo llamado servidor_publico
            <option value="">Seleccion...</option>
            <option value="-1">SI</option>
            <option value="0">NO</option>
            <option value="2">SD</option>
        </select>
    </td>
</tr> -->
<tr>
    <td style="width: 100px;display: table-cell;">Administra recursos publicos?</td>
    <td>
        <select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px"><!--agregar campo llamado recursos_publicos-->
            <option value="">Seleccion...</option>
            <option value="-1">SI</option>
            <option value="0">NO</option>
            <option value="2">SD</option>
        </select>
    </td>
</tr>
<tr>
    <td style="width: 100px;display: table-cell;">Obligaciones tributarias en otro pais?</td>
    <td>
        <select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado tributarias_otro_pais-->
            <option value="">Seleccion...</option>
            <option value="-1">SI</option>
            <option value="0">NO</option>
            <option value="2">SD</option>
        </select>
        Cuales?: 
        <input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado tributarias_paises-->
    </td>
</tr>
<tr>
	<td colspan="2">SOCIOS</td>
</tr>
<tr>
	<td>Socio No. 1:</td>
	<td>
		<input type="text" name="socio1" id="socio1" onkeypress="return validar_num(event)" title="Socio No. 1">
	</td>
</tr>
<tr>
	<td>Socio No. 2:</td>
	<td>
		<input type="text" name="socio2" id="socio2" onkeypress="return validar_num(event)" title="Socio No. 2">
	</td>
</tr>
<tr>
	<td>Socio No. 3:</td>
	<td>
		<input type="text" name="socio3" id="socio3" onkeypress="return validar_num(event)" title="Socio No. 3">
	</td>
</tr>