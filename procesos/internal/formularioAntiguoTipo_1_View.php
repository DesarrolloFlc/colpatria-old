<tr>
	<td colspan="2" align="center"><strong>PERSONA NATURAL</strong></td>
</tr>
<tr>
	<td>Profesión</td>
	<td>
		<select id="profesion" name="profesion" class="obligatorio" title="Profesión">
			<option value="">-Opciones-</option>
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
	<td>Ocupación</td>
	<td>
		<select id="ocupacion" name="ocupacion" class="obligatorio" onchange="$(this).changeOcupacion();" title="Ocupación">
			<option value="">-Opciones-</option>
<?php
if(isset($ocupaciones) && !empty($ocupaciones) && is_array($ocupaciones)){
	foreach($ocupaciones as $ocupacion){
?>
			<option value="<?=$ocupacion['id']?>"><?=$ocupacion['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr id="trdetalleocupacion">
	<td>Que tipo de ventas?</td>
	<td>
		<input type="text" name="detalleocupacion" id="detalleocupacion" onkeypress="return validar_letra(event)" disabled title="Que tipo de ventas">
	</td>
</tr>
<tr>
	<td>CIIU</td>
	<td>
		<select id="ciiu" name="ciiu" title="CIIU">
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
	<td>Ingresos mensuales</td>
	<td>
		<select id="ingresosmensuales" name="ingresosmensuales" class="obligatorio" title="Ingresos mensuales">
			<option value="">-Opciones-</option>
<?php
if(isset($ingresos_mensuales) && !empty($ingresos_mensuales) && is_array($ingresos_mensuales)){
	foreach($ingresos_mensuales as $ingresos_mensual){
?>
			<option value="<?=$ingresos_mensual['id']?>"><?=$ingresos_mensual['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Otros ingresos</td>
	<td>
		<select id="otrosingresos" name="otrosingresos" title="Otros ingresos">
			<option value="">-Opciones-</option>
<?php
if(isset($otros_ingresos) && !empty($otros_ingresos) && is_array($otros_ingresos)){
	foreach($otros_ingresos as $otros_ingreso){
?>
			<option value="<?=$otros_ingreso['id']?>"><?=$otros_ingreso['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Egresos mensuales</td>
	<td>
		<select id="egresosmensuales" name="egresosmensuales" class="obligatorio" title="Egresos mensuales">
			<option value="">-Opciones-</option>
<?php
if(isset($egresos_mensuales) && !empty($egresos_mensuales) && is_array($egresos_mensuales)){
	foreach($egresos_mensuales as $egresos_mensual){
?>
			<option value="<?=$egresos_mensual['id']?>"><?=$egresos_mensual['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Conpto. otros ingresos</td>
	<td>
		<input type="text" name="conceptosotrosingresos" id="conceptosotrosingresos" onkeypress="return validar_letra(event)" title="Conpto. otros ingresos">
	</td>
</tr>
<tr>
	<td>Tipo de actividad</td>
	<td>
		<select id="tipoactividad" name="tipoactividad" class="obligatorio" onchange="$(this).changeTipoAtividad();" title="Tipo de actividad">
			<option value="">-Opciones-</option>
<?php
if(isset($tipo_actividades) && !empty($tipo_actividades) && is_array($tipo_actividades)){
	foreach($tipo_actividades as $tipo_actividad){
?>
			<option value="<?=$tipo_actividad['id']?>"><?=$tipo_actividad['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr id="trdetalletipoactividad">
	<td>Otra, Cual?</td>
	<td>
		<input type="text" name="detalletipoactividad" id="detalletipoactividad" onkeypress="return validar_letra(event)" disabled title="Otra, Cual">
	</td>
</tr>
<tr>
	<td>Nivel estudios</td>
	<td>
		<select id="nivelestudios" name="nivelestudios" title="Nivel estudios">
			<option value="">-Opciones-</option>
<?php
if(isset($estudios) && !empty($estudios) && is_array($estudios)){
	foreach($estudios as $estudio){
?>
			<option value="<?=$estudio['id']?>"><?=$estudio['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Tipo vivienda</td>
	<td>
		<select id="tipovivienda" name="tipovivienda" title="Tipo vivienda">
			<option value="">-Opciones-</option>
<?php
if(isset($tipo_viviendas) && !empty($tipo_viviendas) && is_array($tipo_viviendas)){
	foreach($tipo_viviendas as $tipo_vivienda){
?>
			<option value="<?=$tipo_vivienda['id']?>"><?=$tipo_vivienda['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Estrato</td>
	<td>
		<select id="estrato" name="estrato" title="Estrato">
			<option value="">-Opciones-</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="SD">SD</option>
		</select>
	</td>
</tr>
<tr>
	<td>Total activos</td>
	<td>
		<input type="text" name="totalactivos" id="totalactivos" onkeypress="return validar_num(event)" class="obligatorio" title="Total activos">
	</td>
</tr>
<tr>
	<td>Total pasivos</td>
	<td>
		<input type="text" name="totalpasivos" id="totalpasivos" onkeypress="return validar_num(event)" class="obligatorio" title="Total pasivos">
	</td>
</tr>
<tr>
    <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
    <td>
        <select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado expuesta_publica-->
            <option value="">Seleccion...</option>
            <option value="-1">SI</option>
            <option value="0">NO</option>
            <option value="2">SD</option>
        </select>
    </td>
</tr>
<tr>
    <td style="width: 100px;display: table-cell;">Vinculo persona expuesta publicamente?</td>
    <td>
        <select id="servidor_publico" name="servidor_publico" style="font-size: 12px; margin-right: 15px"><!--agregar campo llamado servidor_publico-->
            <option value="">Seleccion...</option>
            <option value="-1">SI</option>
            <option value="0">NO</option>
            <option value="2">SD</option>
        </select>
    </td>
</tr>
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