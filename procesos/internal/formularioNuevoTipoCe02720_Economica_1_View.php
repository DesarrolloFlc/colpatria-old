<table id="table_parte1" width="491">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>INFORMACI&Oacute;N ECON&Oacute;MICA DEL TOMADOR</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir numero identificacion</td>
		<td>
			<input type="text" name="documento2" id="documento2" onpaste="alert('No se puede copiar.');return false" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'documento', 'El numero de documento no coinciden por favor validelos.');" onpaste="return false;" class="obligatorio" title="text">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ocupacion(empleado)</td>
		<td>
			<select id="profesion" name="profesion" style="font-size: 12px; margin-right: 5px" title="Ocupacion(empleado)">
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
		<td style="width: 100px;display: table-cell;">Empresa donde labora:</td>
		<td><input type="text" id="nombreempresa" name="nombreempresa" style="width: 240px" onkeypress="return validar_letra(event)" title="Empresa donde labora"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir Fecha nacimiento:</td>
		<td>
			<select id="f_nac2_a" name="f_nac2_a" onchange="$(this).verificarFecha(event, 'nac2', '1');" style="font-size: 12px" title="Año de fecha nacimiento">
				<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
			</select>
			<select id="f_nac2_m" name="f_nac2_m" onchange="$(this).verificarFecha(event, 'nac2', '1');" style="font-size: 12px" title="Mes de fecha nacimiento">
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
			<select id="f_nac2_d" name="f_nac2_d" onblur="$(this).verificarFechaDoble(event, 'nac', '2');" style="font-size: 12px" title="Dia de fecha nacimiento">
				<option value="">Dia</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Cargo:</td>
		<td><input type="text" id="cargo" name="cargo" style="width: 260px" onkeypress="return validar_letra(event)" title="Cargo"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir Fecha expedicion:</td>
		<td>
			<select id="f_exp2_a" name="f_exp2_a" onchange="$(this).verificarFecha(event, 'exp2', '1');" style="font-size: 12px" title="Año de fecha expedicion">
				<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
			</select>
			<select id="f_exp2_m" name="f_exp2_m" onchange="$(this).verificarFecha(event, 'exp2', '1');" style="font-size: 12px" title="Mes de fecha expedicion">
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
			<select id="f_exp2_d" name="f_exp2_d" onblur="$(this).verificarFechaDoble(event, 'exp', '2');" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de fecha expedicion">
				<option value="">Dia</option>
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
		<td style="width: 100px;display: table-cell;">Re-escribir Nacionalidad 2:</td>
		<td>
			<select id="nacionalidad_otra2" name="nacionalidad_otra2" onblur="$(this).verificarRePais(event, 'nacionalidad_otra', 'Nacionalidad 2');" style="font-size: 12px" title="Nacionalidad 2">
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
		<td style="width: 100px;display: table-cell;">Re-escribir Nacionalidad:</td>
		<td>
			<select id="paisnacimiento2" name="paisnacimiento2" onblur="$(this).verificarRePais(event, 'paisnacimiento', 'Nacionalidad');" style="font-size: 12px" title="Nacionalidad">
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
		<td style="width: 100px;display: table-cell;">Producto que comercializa:</td>
		<td><input type="text" id="detalletipoactividad" name="detalletipoactividad" style="width: 220px" onkeypress="return validar_letra(event)" title="Producto que comercializa"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Activos:</td>
		<td>
			<input type="text" id="totalactivos" name="totalactivos" style="width: 100px; margin-right: 20px" title="Activos" onkeypress="return validar_num(event)">
			Pasivos:
			<input type="text" id="totalpasivos" name="totalpasivos" style="width: 100px" title="Pasivos" onkeypress="return validar_num(event)">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir Direccion residencia:</td>
		<td><input type="text" id="direccionresidencia2" name="direccionresidencia2" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion residencia" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'direccionresidencia', 'Las direcciones de residencia no coinciden por favor validelas.');"></td>
	</tr>
	<!-- <tr>
		<td style="width: 100px;display: table-cell;">Patrimonio:</td>
		<td>
			<input type="text" id="patrimonio" name="patrimonio" style="width: 100px" title="Patrimonio" onkeypress="return validar_num(event)">
		</td>
	</tr> -->
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir Telefono:</td>
		<td>
			<input type="text" id="telefonoresidencia2" name="telefonoresidencia2" style="width: 130px; margin-right: 40px" maxlength="7" onchange="$(this).checkTamanoTele(event, 7);" onkeypress="return validar_num(event)" title="Telefono" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'telefonoresidencia', 'Los telefonos no coinciden por favor validelos.');">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ingresos mensuales:</td>
		<td>
			<input type="text" id="ingresos_mensuales_pesos" name="ingresos_mensuales_pesos" style="width: 100px; margin-right: 20px" title="Ingresos mensuales" onkeypress="return validar_num(event)">
			<!-- <select id="ingresosmensuales" name="ingresosmensuales" style="font-size: 12px; margin-right: 5px" title="Ingresos mensuales">
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
			</select> -->
			Egresos mensuales:
			<input type="text" id="egresos_mensuales_pesos" name="egresos_mensuales_pesos" style="width: 100px; margin-right: 20px" title="egresos mensuales" onkeypress="return validar_num(event)">

			<!-- <select id="egresosmensuales" name="egresosmensuales" style="font-size: 12px; margin-right: 5px" title="Egresos mensuales">
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
			</select> -->
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir Celular:</td>
		<td>
			<input type="text" id="celular2" name="celular2" style="width: 130px" maxlength="10" onchange="$(this).checkTamanoTele(event, 10);" onkeypress="return validar_num(event)" title="Celular" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'celular', 'Los numeros de celular no coinciden, por favor validelos.');">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Procedencia de fondos:</td>
		<td>
			<input type="text" id="procedencia_fondos" name="procedencia_fondos" style="width: 300px" onkeypress="return validar_letra(event)" title="Procedencia de fondos">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Otros ingresos:</td>
		<td>
			<input type="text" id="otros_ingresos_pesos" name="otros_ingresos_pesos" style="width: 100px; margin-right: 20px" title="Otros ingresos" onkeypress="return validar_num(event)">

			<!-- <select id="otrosingresos" name="otrosingresos" style="font-size: 12px; margin-right: 5px" title="Otros ingresos">
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
			</select> -->
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir E-mail:</td>
		<td><input type="text" id="correoelectronico2" name="correoelectronico2" style="width: 240px" onkeypress="return validar_letra(event)" title="E-mail" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'correoelectronico', 'Los e-mails no coinciden por favor validelos.');"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Concepto otros ingresos:</td>
		<td>
			<input type="text" id="conceptosotrosingresos" name="conceptosotrosingresos" style="width: 300px" onkeypress="return validar_letra(event)" title="Concepto otros ingresos">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">El pago de la prima sera en moneda extranjera?</td>
		<td>
			<select id="monedaextranjera" name="monedaextranjera" style="font-size: 12px; margin-right: 15px" title="pago de la prima sera en moneda extranjera?">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
			</select>
			El pago de la prima se hara desde una cuenta del exterior?
			<select id="cuentas_monedaextranjera" name="cuentas_monedaextranjera" style="font-size: 12px; margin-right: 15px" title="pago de la prima se hara desde una cuenta del exterior">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
			</select>
		</td>
	</tr>
</table>