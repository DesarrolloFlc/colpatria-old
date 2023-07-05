<table id="table_parte1" width="491">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>INFORMACI&Oacute;N ECON&Oacute;MICA DEL TOMADOR</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ocupacion(empleado)</td>
		<td>
			<select id="profesion" name="profesion" style="font-size: 12px; margin-right: 5px" title="Ocupacion(empleado)" data-oldvalue="<?=$dataform['profesion']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($profesiones) && !empty($profesiones) && is_array($profesiones)){
	foreach($profesiones as $profesion){
        $slect = '';
        if($dataform['profesion'] == $profesion['id'])
            $slect = ' selected';
?>
				<option value="<?=$profesion['id']?>"<?=$slect?>><?=$profesion['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Empresa donde labora:</td>
		<td><input type="text" id="nombreempresa" name="nombreempresa" style="width: 240px" onkeypress="return validar_letra(event)" title="Empresa donde labora" value="<?=$dataform['nombreempresa']?>" data-oldvalue="<?=$dataform['nombreempresa']?>"></td>
	</tr>
	<tr>
		<td>Cargo:</td>
		<td><input type="text" id="cargo" name="cargo" style="width: 260px" onkeypress="return validar_letra(event)" title="Cargo" value="<?=$dataform['cargo']?>" data-oldvalue="<?=$dataform['cargo']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Actividad economica:</td>
		<td>
			<select id="tipoactividad" name="tipoactividad" style="font-size: 12px; margin-right: 5px" title="Actividad economica" data-oldvalue="<?=$dataform['tipoactividad']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($actEconomicas) && !empty($actEconomicas) && is_array($actEconomicas)){
	foreach($actEconomicas as $actEconomica){
        $slect = '';
        if($dataform['tipoactividad'] == $actEconomica['id'])
            $slect = ' selected';
?>
				<option value="<?=$actEconomica['id']?>"<?=$slect?>><?=$actEconomica['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">CIIU(codigo):</td>
		<td>
			
			<select id="ciiu" name="ciiu" style="font-size: 12px; margin-right: 5px" title="CIIU(codigo)" data-oldvalue="<?=$dataform['ciiu']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($ciius) && !empty($ciius) && is_array($ciius)){
	foreach($ciius as $ciiu){
        $slect = '';
        if($dataform['ciiu'] == $ciiu['codigo'])
            $slect = ' selected';
?>
				<option value="<?=$ciiu['codigo']?>"<?=$slect?>><?=$ciiu['descripcion']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Producto que comercializa:</td>
		<td><input type="text" id="detalletipoactividad" name="detalletipoactividad" style="width: 220px" onkeypress="return validar_letra(event)" title="Producto que comercializa" value="<?=$dataform['detalletipoactividad']?>" data-oldvalue="<?=$dataform['detalletipoactividad']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Activos:</td>
		<td>
			<input type="text" id="totalactivos" name="totalactivos" style="width: 100px; margin-right: 20px" title="Activos" onkeypress="return validar_num(event)" value="<?=$dataform['totalactivos']?>" data-oldvalue="<?=$dataform['totalactivos']?>">
			Pasivos:
			<input type="text" id="totalpasivos" name="totalpasivos" style="width: 100px" title="Pasivos" onkeypress="return validar_num(event)" value="<?=$dataform['totalpasivos']?>" data-oldvalue="<?=$dataform['totalpasivos']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Patrimonio:</td>
		<td>
			<input type="text" id="patrimonio" name="patrimonio" style="width: 100px" title="Patrimonio" onkeypress="return validar_num(event)" value="<?=$dataform['patrimonio']?>" data-oldvalue="<?=$dataform['patrimonio']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ingresos mensuales:</td>
		<td>
			<select id="ingresosmensuales" name="ingresosmensuales" style="font-size: 12px; margin-right: 5px" title="Ingresos mensuales" data-oldvalue="<?=$dataform['ingresosmensuales']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($ingresos) && !empty($ingresos) && is_array($ingresos)){
	foreach($ingresos as $ingreso){
        $slect = '';
        if($dataform['ingresosmensuales'] == $ingreso['id'])
            $slect = ' selected';
?>
				<option value="<?=$ingreso['id']?>"<?=$slect?>><?=$ingreso['description']?></option>
<?php
	}
}
?>
			</select>
			Egresos mensuales:
			<select id="egresosmensuales" name="egresosmensuales" style="font-size: 12px; margin-right: 5px" title="Egresos mensuales" data-oldvalue="<?=$dataform['egresosmensuales']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($egresos) && !empty($egresos) && is_array($egresos)){
	foreach($egresos as $egreso){
        $slect = '';
        if($dataform['egresosmensuales'] == $egreso['id'])
            $slect = ' selected';
?>
				<option value="<?=$egreso['id']?>"<?=$slect?>><?=$egreso['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Procedencia de fondos:</td>
		<td>
			<input type="text" id="procedencia_fondos" name="procedencia_fondos" style="width: 300px" onkeypress="return validar_letra(event)" title="Procedencia de fondos" value="<?=$dataform['procedencia_fondos']?>" data-oldvalue="<?=$dataform['procedencia_fondos']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Otros ingresos:</td>
		<td>
			<select id="otrosingresos" name="otrosingresos" style="font-size: 12px; margin-right: 5px" title="Otros ingresos" data-oldvalue="<?=$dataform['otrosingresos']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($ingresos) && !empty($ingresos) && is_array($ingresos)){
	foreach($ingresos as $ingreso){
        $slect = '';
        if($dataform['otrosingresos'] == $ingreso['id'])
            $slect = ' selected';
?>
				<option value="<?=$ingreso['id']?>"<?=$slect?>><?=$ingreso['description']?></option>
<?php
	}
	$slect = '';
    if($dataform['otrosingresos'] == '13')
        $slect = ' selected';
}
?>
				<option value="13"<?=$slect?>>SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Concepto otros ingresos:</td>
		<td>
			<input type="text" id="conceptosotrosingresos" name="conceptosotrosingresos" style="width: 300px" onkeypress="return validar_letra(event)" title="Concepto otros ingresos" value="<?=$dataform['conceptosotrosingresos']?>" data-oldvalue="<?=$dataform['conceptosotrosingresos']?>">
		</td>
	</tr>
</table>