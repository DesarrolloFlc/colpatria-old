<table id="table_parte1">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>DATOS B&Aacute;SICA DEL TOMADOR</strong></td>
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
			<select id="f_exp_a" name="f_exp_a" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px" title="Año de fecha expedicion">
				<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
			</select>
			<select id="f_exp_m" name="f_exp_m" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px" title="Mes de fecha expedicion">
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
			<select id="f_exp_d" name="f_exp_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de fecha expedicion">
				<option value="">Dia</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Lugar expedicion:</td>
		<td>
			<select id="lugarexpedicion" name="lugarexpedicion" style="font-size: 12px" title="Lugar expedicion">
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
			<select id="f_nac_d" name="f_nac_d" style="font-size: 12px" title="Dia de fecha nacimiento">
				<option value="">Dia</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nacionalidad:</td>
		<td>
			<select id="paisnacimiento" name="paisnacimiento" style="font-size: 12px" title="Nacionalidad">
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
			<select id="nacionalidad_otra" name="nacionalidad_otra" style="font-size: 12px" title="Nacionalidad 2">
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
		<td style="width: 100px;display: table-cell;">E-mail:</td>
		<td><input type="text" id="correoelectronico" name="correoelectronico" style="width: 240px" onkeypress="return validar_letra(event)" title="E-mail"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Lugar nacimiento:</td>
		<td>
			<select id="lugarnacimiento" name="lugarnacimiento" style="font-size: 12px" title="Lugar nacimiento">
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
		<td style="width: 100px;display: table-cell;">Direccion residencia:</td>
		<td><input type="text" id="direccionresidencia" name="direccionresidencia" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion residencia"></td>
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
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">CIIU(codigo):</td>
		<td>
			
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
		<td style="width: 100px;display: table-cell;">Tipo empresa</td>
		<td>
			<select id="tipoempresaemp" name="tipoempresaemp" style="font-size: 12px; margin-right: 5px" title="Tipo empresa">
				<option value="">Seleccione...</option>
<?php
if(isset($tipoempresas) && !empty($tipoempresas) && is_array($tipoempresas)){
	foreach($tipoempresas as $tipoempresa){
?>
				<option value="<?=$tipoempresa['id']?>"><?=$tipoempresa['description']?></option>
<?php
	}
}
?>
			</select>
			Cual?
			<input type="text" id="tipoempresaemp_cual" name="tipoempresaemp_cual" style="width: 100px" disabled onkeypress="return validar_letra(event)" title="Cual tipo empresa">
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
		<td style="width: 100px;display: table-cell;">Empresa donde labora:</td>
		<td><input type="text" id="nombreempresa" name="nombreempresa" style="width: 240px" onkeypress="return validar_letra(event)" title="Empresa donde labora"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Direccion oficina:</td>
		<td>
			<input type="text" id="direccionempresa" name="direccionempresa" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Direccion oficina">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ciudad empresa</td>
		<td>
			<select id="ciudadempresa" name="ciudadempresa" style="font-size: 12px" title="Ciudad empresa">
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
		<td style="width: 100px;display: table-cell;">Telefono oficina:</td>
		<td>
			<input type="text" id="telefonolaboral" name="telefonolaboral" style="width: 100px" onchange="$(this).checkTamanoTele(event, 7);" maxlength="7" onkeypress="return validar_num(event)" title="Telefono oficina">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Producto que comercializa:</td>
		<td><input type="text" id="detalletipoactividad" name="detalletipoactividad" style="width: 220px" onkeypress="return validar_letra(event)" title="Producto que comercializa"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Activos:</td>
		<td>
			<input type="text" id="totalactivos" name="totalactivos" style="width: 100px; margin-right: 20px" title="Activos" onkeypress="return validar_num(event)">
			Ingresos mensuales:
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
		<td style="width: 100px;display: table-cell;">Pasivos:</td>
		<td><input type="text" id="totalpasivos" name="totalpasivos" style="width: 100px" title="Pasivos" onkeypress="return validar_num(event)">
			Otros ingresos:
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
		</td>
	</tr>
	<!-- <tr>
		<td style="width: 100px;display: table-cell;">Patrimonio:</td>
		<td>
			<input type="text" id="patrimonio" name="patrimonio" style="width: 100px" title="Patrimonio" onkeypress="return validar_num(event)">
		</td>
	</tr> -->
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
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Concepto otros ingresos:</td>
		<td>
			<input type="text" id="conceptosotrosingresos" name="conceptosotrosingresos" style="width: 300px" onkeypress="return validar_letra(event)" title="Concepto otros ingresos">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Persona expuesta politicamente?</td>
		<td>
			<select id="expuesta_politica" name="expuesta_politica" style="font-size: 12px; margin-right: 15px" title="Persona expuesta politicamente">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
			Familiar de expuesto politico?
			<select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px" title="Familiar de expuesto politico">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
			<input type="hidden" id="cargo_politica" name="cargo_politica" value="SD">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;"></td>
		<td>
			<input type="hidden" id="publica_nombre" name="publica_nombre" title="Nombre" value="SD">
			<input type="hidden" id="publica_cargo" name="publica_cargo" title="Cargo" value="SD">
		</td>
	</tr>
	<input type="hidden" id="repre_internacional" name="repre_internacional" value="2">
	<input type="hidden" id="internacional_indique" name="internacional_indique" value="SD">
	<tr>
		<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
		<td>
			<select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
			Obligaciones tributarias en otro pais?
			<select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 15px" title="Obligaciones fiscales en otro pais">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Operaciones en moneda extranjera?</td>
		<td>
			<select id="monedaextranjera" name="monedaextranjera" style="font-size: 12px; margin-right: 5px" title="Operaciones en moneda extranjera">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Cual?</td>
		<td>
			<select id="tipotransacciones" name="tipotransacciones" style="font-size: 12px; margin-right: 5px" disabled title="Cual operacion en moneda extranjera">
				<option value="">Seleccione...</option>
<?php
if(isset($transacciones) && !empty($transacciones) && is_array($transacciones)){
	foreach($transacciones as $transaccion){
?>
				<option value="<?=$transaccion['id']?>"><?=$transaccion['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;"></td>
		<td>
			<input type="text" id="tipotransacciones_cual" name="tipotransacciones_cual" style="width: 135px" disabled onkeypress="return validar_letra(event)" title="Cual otra">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Responsable RUT?</td>
		<td>
			<select id="responsable_rut" name="responsable_rut" style="font-size: 12px; margin-right: 5px" title="Responsable RUT">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Codigo de responsabilidad</td>
		<td>
			<input type="text" id="codigo_rut" name="codigo_rut" style="width: 135px" disabled onkeypress="return validar_letra(event)" title="Codigo de responsabilidad">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">E-mail registrado en DIAN:</td>
		<td>
			<input type="text" id="correoelectronico_otro" name="correoelectronico_otro" style="width: 230px" onkeypress="return validar_letra(event)" title="E-mail" disabled>
		</td>
	</tr>
	<input type="hidden" id="tributarias_paises" name="tributarias_paises" value="SD">
	<input type="hidden" id="celularoficinappal" name="celularoficinappal" value="0">
</table>