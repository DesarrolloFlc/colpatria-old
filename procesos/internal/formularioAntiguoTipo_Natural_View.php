<tr>
	<td>Fecha nacimiento:</td>
	<td>
		<select name="fechanacimiento_a" id="fechanacimiento_a" class="obligatorio" onblur="$.fn.verificarFecNacOcultar(event);" onchange="$(this).verificarFecha(event, 'fechanacimiento');" title="Año nacimiento">
			<option value="">---</option>
<?php
for($i = 1915; $i <= date('Y'); $i++){
?>
			<option value="<?=$i?>"><?=$i?></option>
<?php
}
?>
		</select>
		<select name="fechanacimiento_m" id="fechanacimiento_m" class="obligatorio" onblur="$.fn.verificarFecNacOcultar(event);" onchange="$(this).verificarFecha(event, 'fechanacimiento');" title="Mes nacimiento">
			<option value="">---</option>
<?php
for($i = 01; $i <= 12; $i++){
	if (strlen($i) == 1)
		$num = "0" . $i;
	else
		$num = $i;
?>
			<option value="<?=$num?>"><?=$num?></option>
<?php
}
?>
		</select>
		<select name="fechanacimiento_d" id="fechanacimiento_d" class="obligatorio" onblur="$.fn.verificarFecNacOcultar(event);" title="Dia nacimiento">
			<option value="">---</option>
<?php
for ($i = 01; $i <= 31; $i++) {
	if (strlen($i) == 1)
		$num = "0" . $i;
	else
		$num = $i;
?>
			<option value="<?=$num?>"><?=$num?></option>
<?php
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Lugar de nacimiento</td>
	<td>
		<select id="lugarnacimiento" name="lugarnacimiento" class="obligatorio" title="Lugar de nacimiento">
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
	<td>Sexo</td>
	<td>
		<select id="sexo" name="sexo" class="obligatorio" onblur="$(this).ocultarCampoDoble(event);" title="Sexo">
			<option value="">-Opciones-</option>
			<option value="Femenino">Femenino</option>
			<option value="Masculino">Masculino</option>
		</select>
	</td>
</tr>
<tr>
	<td>Nacionalidad</td>
	<td colspan="3">
		<select id="nacionalidad" name="nacionalidad" class="obligatorio" title="Nacionalidad">
			<option value="">-Opciones-</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
?>
			<option value="<?=$pais['id']?>"><?=utf8_encode($pais['description'])?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>No. hijos</td>
	<td>
		<select name="numerohijos" id="numerohijos" class="obligatorio" title="No. hijos">
			<option value="">-Opciones-</option>
			<option value="0">0</option>
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
	<td>Est. civil</td>
	<td>
		<select id="estadocivil" name="estadocivil" class="obligatorio" title="Est. civil">
			<option value="">-Opciones-</option>
<?php
if(isset($estados_civiles) && !empty($estados_civiles) && is_array($estados_civiles)){
	foreach($estados_civiles as $estados_civil){
?>
			<option value="<?=$estados_civil['id']?>"><?=$estados_civil['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Re-escribir Fecha nacimiento:</td>
	<td>
		<select name="fechanacimiento2_a" id="fechanacimiento2_a" class="obligatorio" onblur="$(this).checkFechaNacimiento(event);" onchange="$(this).verificarFecha(event, 'fechanacimiento2');" title="Re-escribir Año nacimiento">
			<option value="">---</option>
<?php
for ($i = 1915; $i <= 2016; $i++) {
?>
			<option value="<?=$i?>"><?=$i?></option>
<?php
}
?>
		</select>
		<select name="fechanacimiento2_m" id="fechanacimiento2_m" class="obligatorio" onblur="$(this).checkFechaNacimiento(event);" onchange="$(this).verificarFecha(event, 'fechanacimiento2');" title="Re-escribir Mes nacimiento">
			<option value="">---</option>
<?php
for ($i = 1; $i <= 12; $i++) {
	if (strlen($i) == 1)
		$num = "0".$i;
	else
		$num = $i;
?>
			<option value="<?=$num?>"><?=$num?></option>
<?php
}
?>
		</select>
		<select name="fechanacimiento2_d" id="fechanacimiento2_d" class="obligatorio" onblur="$(this).checkFechaNacimiento(event);" title="Re-escribir Dia nacimiento">
			<option value="">---</option>
<?php
for ($i = 1; $i <= 31; $i++) {
	if (strlen($i) == 1)
		$num = "0".$i;
	else
		$num = $i;
?>
			<option value="<?=$num?>"><?=$num?></option>
<?php
}
?>
		</select>
	</td>
</tr>
<!-- INFORMACION DOMICILIO Y OFICINA -->
<tr>
	<td colspan="2" align="center"><strong>INFORMACIÓN DOMICILIO Y OFICINA</strong></td>
</tr>
<tr>
	<td>Dirección residencia</td>
	<td>
		<input type="text" name="direccionresidencia" id="direccionresidencia" onkeypress="return validar_letra(event)" class="obligatorio" title="Dirección residencia" onblur="$(this).ocultarEsteCampo(event);">
	</td>
</tr>
<tr>
	<td>Ciudad residencia</td>
	<td>
		<select id="ciudadresidencia" name="ciudadresidencia" class="obligatorio" title="Ciudad residencia">
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
	<td>Teléfono residencia</td>
	<td>
		<input type="text" name="telefonoresidencia" id="telefonoresidencia" onkeypress="return validar_num(event)" maxlength="7" onpaste="return false;" onchange="$(this).checkTamanoTele(event, 7);" class="obligatorio" title="Teléfono residencia">
	</td><!--onBlur="ocultarCampoTelf();"-->
</tr>
<tr>
	<td>Nombre empresa</td>
	<td>
		<input type="text" name="nombreempresa" id="nombreempresa" onkeypress="return validar_letra(event)" class="obligatorio" title="Nombre empresa">
	</td>
</tr>
<tr>
	<td>Ciudad empresa</td>
	<td>
		<select id="ciudadempresa" name="ciudadempresa" class="obligatorio" title="Ciudad empresa">
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
	<td>Dirección empresa</td>
	<td>
		<input type="text" name="direccionempresa" id="direccionempresa" onkeypress="return validar_letra(event)" title="Dirección empresa" onblur="$(this).ocultarEsteCampo(event);">
	</td>
</tr>
<tr>
	<td>Nomenclatura</td>
	<td>
		<select name="nomenclatura" id="nomenclatura" title="Nomenclatura">
			<option value="Nomenclatura nueva">Nomenclatura nueva</option>
			<option value="Nomenclatura antigua">Nomenclatura antigua</option>
			<option value="SD">SD</option>
		</select>
	</td>
</tr>
<tr>
	<td>Teléfono laboral</td>
	<td>
		<input type="text" name="telefonolaboral" id="telefonolaboral" onkeypress="return validar_num(event)" maxlength="7" class="obligatorio" onchange="$(this).checkTamanoTele(event, 7);" title="Teléfono laboral">
	</td>
</tr>
<tr>
	<td>Celular</td>
	<td>
		<input type="text" name="celular" id="celular" onkeypress="return validar_num(event)" maxlength="10" onchange="$(this).checkTamanoTele(event, 10);" title="Celular">
	</td>
</tr>
<tr>
	<td>Re-escribir dirección residencia</td>
	<td>
		<input type="text" name="direccionresidencia2" id="direccionresidencia2" onkeypress="return validar_letra(event)" class="obligatorio" title="Dirección residencia" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'direccionresidencia', 'Las direcciones de residencia no coinciden por favor validelos.');">
	</td>
</tr>
<tr>
	<td>E-mail</td>
	<td>
		<input type="text" name="correoelectronico" id="correoelectronico" onkeypress="return validar_letra(event)" title="E-mail" onblur="$(this).ocultarEsteCampo(event);">
	</td>
</tr>
<tr>
	<td>Re-escribir telefono residencia:</td>
	<td>
		<input type="text" name="telefonoresidencia2" onkeypress="return validar_num(event)" maxlength="7" onblur="$(this).validarReTelefono(event, 'form_fingering', 'telefonoresidencia', 'Los campos de telefono de residencia no coinciden.')" onpaste="return false;" class="obligatorio" id="telefonoresidencia2" title="Repetir telefono residencia">
	</td>
</tr>
<tr>
	<td>Cargo</td>
	<td>
		<input type="text" name="cargo" id="cargo" onkeypress="return validar_letra(event)" title="Cargo">
	</td>
</tr>
<tr>
	<td>Re-escribir Sexo</td>
	<td>
		<select id="sexo2" name="sexo2" onblur="$(this).validarReCampSel(event, 'form_fingering', 'sexo', 'Los campos de telefono de genero no coinciden.')" title="Re-escribir Sexo"><!--  onblur="validarCampoGenero();" -->
			<option value="">-Opciones-</option>
			<option value="Femenino">Femenino</option>
			<option value="Masculino">Masculino</option>
		</select>
	</td>
</tr>
<tr>
	<td>Actv. economica</td>
	<td>
		<select id="actividadeconomicaempresa" name="actividadeconomicaempresa" class="obligatorio" title="Actv. economica">
			<option value=""> -- Seleccione una opción -- </option>
<?php
if(isset($actividades_econo) && !empty($actividades_econo) && is_array($actividades_econo)){
	foreach($actividades_econo as $actividad_econo){
?>
			<option value="<?=$actividad_econo['id']?>"><?=$actividad_econo['description']?></option>
<?php
	}
}
?>
		</select>
	</td>
</tr>
<tr>
	<td>Re-escribir celular</td>
	<td>
		<input type="text" name="celular2" id="celular2" onkeypress="return validar_num(event)" maxlength="10" onblur="$(this).validarReTelefono(event, 'form_fingering', 'celular', 'Los campos de celular no coinciden.')" onpaste="return false;" class="obligatorio" title="Repetir celular">
	</td>
</tr>
<tr>
	<td>Re-escribir e-mail</td>
	<td>
		<input type="text" name="correoelectronico2" id="correoelectronico2" onkeypress="return validar_letra(event)" title="E-mail" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'correoelectronico', 'Los e-mails no coinciden por favor validelos.');">
	</td>
</tr>
<tr>
	<td>Re-escribir dirección empresa</td>
	<td>
		<input type="text" name="direccionempresa2" id="direccionempresa2" onkeypress="return validar_letra(event)" title="Dirección empresa" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'direccionempresa', 'Las direcciones de empresa no coinciden por favor validelos.');">
	</td>
</tr>