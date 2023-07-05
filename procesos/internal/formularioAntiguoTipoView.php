<?php
if(!isset($_SESSION))
	session_start();
?>
<table>
	<tr>
		<td>Fecha radicado:</td>
		<td>
			<select name="fecharadicado_a" id="fecharadicado_a" class="obligatorio" onchange="$(this).verificarFecha(event, 'fecharadicado');" title="Año radicado">
				<option value="">---</option>
<?php
$an = 2013;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++){
?>
				<option value="<?=$i?>"><?=$i?></option>
<?php
}
?>
			</select>
			<select name="fecharadicado_m" id="fecharadicado_m" class="obligatorio" onchange="$(this).verificarFecha(event, 'fecharadicado');" title="Mes radicado">
				<option value="">---</option>
<?php
for ($i = 01; $i <= 12; $i++){
	if(strlen($i) == 1)
		$num = "0" . $i;
	else
		$num = $i;
?>
				<option value="<?=$num?>"><?=$num?></option>
<?php
}
?>
			</select>
			<select name="fecharadicado_d" id="fecharadicado_d" class="obligatorio" title="Dia radicado">
				<option value="">---</option>
<?php
for($i = 01; $i <= 31; $i++){
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
		<td>Fecha de solicitud:</td>
		<td>
			<select name="fechasolicitud_a" id="fechasolicitud_a" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechasolicitud');" title="Año solicitud">
				<option value="">---</option>
<?php
for($i = 2007; $i <= date('Y'); $i++){
?>
				<option vaue="<?=$i?>"><?=$i?></option>
<?php
}
?>
				<!-- <option vaue="2007">2007</option>
				<option vaue="2008">2008</option>
				<option vaue="2009">2009</option>
				<option vaue="2010">2010</option>
				<option vaue="2011">2011</option>
				<option vaue="2012">2012</option>
				<option vaue="2013">2013</option>
				<option vaue="2014">2014</option>
				<option vaue="2015">2015</option>
				<option vaue="2016">2016</option>
				<option vaue="2017">2017</option>
				<option vaue="2018">2018</option>
				<option vaue="2019">2019</option>
				<option vaue="2020">2020</option>
				<option vaue="2021">2021</option> -->
			</select>
			<select name="fechasolicitud_m" id="fechasolicitud_m" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechasolicitud');" title="Mes solicitud">
				<option value="">---</option>
<?php
for ($i = 01; $i <= 12; $i++) {
	if(strlen($i) == 1){
		$num = "0" . $i;
	}else{
		$num = $i;
	}
?>
				<option value="<?=$num?>"><?=$num?></option>
<?php
}
?>
			</select>
			<select name="fechasolicitud_d" id="fechasolicitud_d" class="obligatorio" title="Dia solicitud" onblur="$.fn.verificarFechaSolicitud();">
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
		<td>Sucursal:</td>
		<td>
			<select id="sucursal" name="sucursal" class="obligatorio" title="Sucursal">
				<option value="">-Opciones-</option>
<?php
if(isset($sucursales) && !empty($sucursales) && is_array($sucursales)){
	foreach($sucursales as $sucursal){
		$sel = '';
		if(isset($radInfo['id_sucursal']) && $radInfo['id_sucursal'] != '' && $sucursal['id'] == $radInfo['id_sucursal'])
			$sel = ' selected="selected"';
?>
				<option value="<?=$sucursal['id']?>"<?=$sel?>><?=$sucursal['sucursal']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Area:</td>
		<td>
			<select id="area" name="area" class="obligatorio" title="Area">
				<option value="">-Opciones-</option>
<?php
if(isset($areas) && !empty($areas) && is_array($areas)){
	foreach($areas as $area){
?>
				<option value="<?=$area['id']?>"><?=$area['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Funcionario:</td>
		<td> 
			<!--<input type="text" name="id_official" id="id_official" onkeypress="return validar_letra(event)" class="obligatorio"/>-->
			<select id="id_official" name="id_official" class="obligatorio" title="Funcionario">
				<option value="">-Opciones-</option>
<?php
if(isset($officials) && !empty($officials) && is_array($officials)){
	foreach($officials as $official){
		$sel = '';
		if(isset($radInfo['oficial_nombre']) && !is_null($radInfo['oficial_nombre']) && $official['name'] == $radInfo['oficial_nombre'])
			$sel = ' selected="selected"';
?>
				<option value="<?=strtoupper($official['name'])?>"<?=$sel?>><?=strtoupper($official['name'])?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Formulario:</td>
		<td>
			<select id="formulario" name="formulario" class="obligatorio" title="Formulario">
				<option value="">-Opciones-</option>
<?php
if(isset($formularios) && !empty($formularios) && is_array($formularios)){
	foreach($formularios as $formulario){
?>
				<option value="<?=$formulario['id']?>"><?=$formulario['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Clase de cliente</td>
		<td>
			<select id="clasecliente" name="clasecliente" class="obligatorio" title="Clase de cliente">
				<option value="">-Opciones-</option>
<?php
if(isset($claseclientes) && !empty($claseclientes) && is_array($claseclientes)){
	foreach($claseclientes as $clasecliente){
?>
				<option value="<?=$clasecliente['id']?>"><?=$clasecliente['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<!-- INFORMACION BASICA -->
	<tr>
		<td colspan="2"><div class="title_form">1. INFORMACIÓN BASICA</div></td>
	</tr>
	<tr>
		<td>No. documento</td>
		<td>
			<input type="text" name="documento" id="documento" onkeypress="return validar_num(event)" onpaste="return false;" onblur="$(this).ocultarCampoDoble(event);" class="obligatorio" title="No. documento">
		</td><!--onKeyPress="onlyNumbers();"-->
	</tr>
	<tr>
		<td>Tipo documento:</td>
		<td>
			<select id="tipodocumento" name="tipodocumento" class="obligatorio" title="Tipo documento">
				<option value="">-Opciones-</option>
<?php
if(isset($tipo_documentos) && !empty($tipo_documentos) && is_array($tipo_documentos)){
	foreach($tipo_documentos as $tipo_documento){
?>
				<option value="<?=$tipo_documento['id']?>"><?=$tipo_documento['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Primer apellido</td>
		<td>
			<input type="text" name="primerapellido" id="primerapellido" onkeypress="return validar_letra(event)" class="obligatorio" title="Primer apellido">
		</td>
	</tr>
	<tr>
		<td>Segundo apellido</td>
		<td>
			<input type="text" name="segundoapellido" id="segundoapellido" onkeypress="return validar_letra(event)" title="Segundo apellido">
		</td>
	</tr>
	<tr>
		<td>Re-escribir Fecha de solicitud:</td>
		<td>
			<select name="fechasolicitud2_a" id="fechasolicitud2_a" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechasolicitud2');" title="Re-escribir Año solicitud">
				<option value="">---</option>
<?php
for($i = 2007; $i <= date('Y'); $i++){
?>
				<option vaue="<?=$i?>"><?=$i?></option>
<?php
}
?>
				<!-- <option vaue="2007">2007</option>
				<option vaue="2008">2008</option>
				<option vaue="2009">2009</option>
				<option vaue="2010">2010</option>
				<option vaue="2011">2011</option>
				<option vaue="2012">2012</option>
				<option vaue="2013">2013</option>
				<option vaue="2014">2014</option>
				<option vaue="2015">2015</option>
				<option vaue="2016">2016</option>
				<option vaue="2017">2017</option>
				<option vaue="2018">2018</option>
				<option vaue="2019">2019</option>
				<option vaue="2020">2020</option>
				<option vaue="2021">2021</option> -->
			</select>
			<select name="fechasolicitud2_m" id="fechasolicitud2_m" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechasolicitud2');" title="Re-escribir Mes solicitud">
				<option value="">---</option>
<?php
for ($i = 01; $i <= 12; $i++) {
	if(strlen($i) == 1)
		$num = "0" . $i;
	else
		$num = $i;
?>
				<option value="<?=$num?>"><?=$num?></option>
<?php
}
?>
			</select>
			<select name="fechasolicitud2_d" id="fechasolicitud2_d" class="obligatorio" title="Re-escribir Dia solicitud" onblur="$.fn.verificarReFechaSolicitud();">
				<option value="">---</option>
<?php
for ($i = 01; $i <= 31; $i++) {
	if(strlen($i) == 1)
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
		<td>Nombres</td>
		<td>
			<input type="text" name="nombres" id="nombres" onkeypress="return validar_letra(event)" size="60" class="obligatorio" title="Nombres">
		</td>
	</tr>
	<tr>
		<td>Fecha expedición</td>
		<td> 
			<select name="fechaexpedicion_a" id="fechaexpedicion_a" class="obligatorio" onblur="$.fn.verificarFecExpOcultar(event);" onchange="$(this).verificarFecha(event, 'fechaexpedicion');" title="Año expedición">
				<option value="">---</option>
<?php
for($i = 1915; $i <= date('Y'); $i++){
?>
				<option value="<?=$i?>"><?=$i?></option>
<?php
}
?>
			</select>
			<select name="fechaexpedicion_m" id="fechaexpedicion_m" class="obligatorio" onblur="$.fn.verificarFecExpOcultar(event);" onchange="$(this).verificarFecha(event, 'fechaexpedicion');" title="Mes expedición">
				<option value="">---</option>
<?php
for ($i = 01; $i <= 12; $i++) {
	if(strlen($i) == 1)
		$num = "0" . $i;
	else
		$num = $i;
?>
				<option value="<?=$num?>"><?=$num?></option>
<?php
}
?>
			</select>
			<select name="fechaexpedicion_d" id="fechaexpedicion_d" class="obligatorio" onblur="$.fn.verificarFecExpOcultar(event);" title="Dia expedición">
				<option value="">---</option>
<?php
for ($i = 01; $i <= 31; $i++) {
	if(strlen($i) == 1)
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
	<tr>
		<td>Lugar expedición:</td>
		<td>
			<select id="lugarexpedicion" name="lugarexpedicion" class="obligatorio" title="Lugar expedición">
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
		<td>Re-escribir documento</td>
		<td>
			<input type="text" name="documento2" id="documento2" onkeypress="return validar_num(event)" onpaste="alert('No se puede copiar.');return false" onblur="$(this).validarReTelefono(event, 'form_fingering', 'documento', 'Los campos de documento no coinciden.')" onpaste="return false;" class="obligatorio" title="Re-escribir documento"><!--  onBlur="validarCampoDoc();" -->
		</td>
	</tr>
	<tr>
		<td>Re-escribir Tipo persona:</td>
		<td>
			<select id="tipopersona2" name="tipopersona2" onblur="$(this).revisarTipoPersona(event);">
				<option value="">-- Seleccione una opción --</option>
<?php
if(isset($tipo_persona) && !empty($tipo_persona) && is_array($tipo_persona)){
	foreach ($tipo_persona as $tipo) {
?>
				<option value="<?=$tipo['id']?>"><?=$tipo['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
<?php
if($request['tipo_persona'] == "1")//NATURAL
	require_once PATH_INTERNAL.DS.$request['action'].'_Natural_'.'View.php';
?>
<!-- ACTIVIDAD ECONOMICA -->
	<tr>
		<td colspan="4"><div class="title_form">2. ACTIVIDAD ECONOMICA</div></td>
	</tr>
<?php
	require_once PATH_INTERNAL.DS.$request['action'].'_'.$request['tipo_persona'].'_'.'View.php';
?>
	<tr>
		<td>Re-escribir Fecha de expedicion:</td>
		<td>
			<select name="fechaexpedicion2_a" id="fechaexpedicion2_a" class="obligatorio" onblur="$(this).checkFechaExpimiento(event);" onchange="$(this).verificarFecha(event, 'fechaexpedicion2');" title="Re-escribir Año nacimiento">
				<option value="">---</option>
<?php
	for ($i = 1915; $i <= date('Y'); $i++) {
?>
				<option value="<?=$i?>"><?=$i?></option>
<?php
	}
?>
			</select>
			<select name="fechaexpedicion2_m" id="fechaexpedicion2_m" class="obligatorio" onblur="$(this).checkFechaExpimiento(event);" onchange="$(this).verificarFecha(event, 'fechaexpedicion2');" title="Re-escribir Mes nacimiento">
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
			<select name="fechaexpedicion2_d" id="fechaexpedicion2_d" class="obligatorio" onblur="$(this).checkFechaExpimiento(event);" title="Re-escribir Dia nacimiento">
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
	<!-- ACTIVIDADES EN OPERACIONES INTERNACIONALES -->
	<tr>
		<td colspan="4">
			<div class="title_form">3. ACTIVIDADES EN OPERACIONES INTERNACIONALES</div>
		</td>
	</tr>
	<tr>
		<td>Moneda extranjera</td>
		<td>
			<select id="monedaextranjera" name="monedaextranjera" class="obligatorio" title="Moneda extranjera">
				<option value="">-Opciones-</option>
				<option value="Si">Si</option>
				<option value="No">No</option>
				<option value="SD">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Tipo transacciones</td>
		<td>
			<select id="tipotransacciones" name="tipotransacciones" title="Tipo transacciones">
				<option value="">-Opciones-</option>
<?php
if(isset($tipo_transacciones) && !empty($tipo_transacciones) && is_array($tipo_transacciones)){
	foreach($tipo_transacciones as $tipo_transaccion){
?>
				<option value="<?=$tipo_transaccion['id']?>"><?=$tipo_transaccion['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="4"><div class="title_form">FORMULARIO CARA B</div></td>
	</tr>
	<tr>
		<td>Firma del cliente: </td>
		<td>
			<select name="firma" id="firma" class="obligatorio" title="Firma del cliente">
				<option value="">-Opciones-</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Huella del cliente:</td>
		<td>
			<select name="huella" id="huella" class="obligatorio" title="Huella del cliente">
				<option value="">-Opciones-</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<!-- INFORMACION ENTREVISTA -->
	<tr>
		<td>Lugar de entrevista:</td>
		<td>
			<input type="text" name="lugarentrevista" id="lugarentrevista" class="obligatorio" onkeypress="return validar_letra(event)" title="Lugar de entrevista">
		</td>
	</tr>
	<tr>
		<td>Fecha entrevista:</td>
		<td>
			<select name="fechaentrevista_a" id="fechaentrevista_a" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechaentrevista');" title="Año entrevista">
				<option value="">---</option>
<?php
for($i = 2007; $i <= date('Y'); $i++){
?>
				<option vaue="<?=$i?>"><?=$i?></option>
<?php
}
?>
				<!-- <option vaue="2007">2007</option>
				<option vaue="2008">2008</option>
				<option vaue="2009">2009</option>
				<option vaue="2010">2010</option>
				<option vaue="2011">2011</option>
				<option vaue="2012">2012</option>
				<option vaue="2013">2013</option>
				<option vaue="2014">2014</option>
				<option vaue="2015">2015</option>
				<option vaue="2011">2016</option>
				<option vaue="2012">2017</option>
				<option vaue="2013">2018</option>
				<option vaue="2014">2019</option>
				<option vaue="2015">2020</option> -->
			</select>
			<select name="fechaentrevista_m" id="fechaentrevista_m" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechaentrevista');" title="Mes entrevista">
				<option value="">---</option>
<?php
for ($i = 01; $i <= 12; $i++) {
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
			<select name="fechaentrevista_d" id="fechaentrevista_d" class="obligatorio" title="Dia entrevista">
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
		<td>Hora entrevista:</td>
		<td>
			<select id="horaentrevista" name="horaentrevista" class="obligatorio" title="Hora entrevista">
				<option value="">---</option>
<?php
for ($i = 1; $i <= 12; $i++) {
?>
				<option value="<?=$i?>"><?=$i?></option>
<?php
}
?>
			</select>
			<select id="tipohoraentrevista" name="tipohoraentrevista" class="obligatorio" title="Hora entrevista">
				<option value="">---</option>
				<option value="am">am</option>
				<option value="pm">pm</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Resultado entrevista: </td>
		<td>
			<select name="resultadoentrevista" id="resultadoentrevista" class="obligatorio" title="Resultado entrevista">
				<option value="">-Opciones-</option>
				<option value="Aceptado" selected>Aceptado</option>
				<option value="Rechazado">Rechazado</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Observaciones:</td>
		<td>
			<textarea name="observacionesentrevista" id="observacionesentrevista" onkeypress="return validar_letra(event)" title="Observaciones"></textarea>
		</td>
	</tr>
	<tr>
		<td>Nombre intermediario y/o asesor responsable:</td>
		<td>
			<input type="text" name="nombreintermediario" id="nombreintermediario" class="obligatorio" onkeypress="return validar_letra(event)" title="Nombre intermediario y/o asesor responsable">
		</td>
	</tr>
	<tr>
		<td colspan="4" align="left" style="padding-left: 10px; padding-top: 20px;">
			<!-- <input type="submit" value="Crear formulario" id="button_form_fingering"> -->
			<button type="submit" id="button_form_fingering" style="padding: 5px;">Crear formulario</button>
		</td>
	</tr>
</table>
<script type="text/javascript">
$(document).ready(function(){
<?php
$dat = (isset($radInfo['fecha_creacion']) && !is_null($radInfo['fecha_creacion'])) ? explode('-', date('Y-m-d', strtotime($radInfo['fecha_creacion']))) : [];
if(isset($dat[0]) && !empty($dat[0]))
	echo '$(\'select[name="fecharadicado_a"]\').val(\''.$dat[0].'\').change();';
if(isset($dat[1]) && !empty($dat[1]))
	echo '$(\'select[name="fecharadicado_m"]\').val(\''.$dat[1].'\').change();';
if(isset($dat[2]) && !empty($dat[2]))
	echo '$(\'select[name="fecharadicado_d"]\').val(\''.$dat[2].'\').change();';
?>
	setTimeout(function() { $('select[name="fecharadicado_a"]').focus(); }, 1);
	$('select[name="tributarias_otro_pais"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="tributarias_paises"]').removeAttr('disabled');
		}else{
			$('input[name="tributarias_paises"]').val('');
			$('input[name="tributarias_paises"]').attr('disabled', true);
		}
	});
	$('form#form_fingering select[name="ocupacion"]').change(function(event) {
		/* Act on the event */
		if($(this).val() == '221'){
			$('form#form_fingering input[name="detalleocupacion"]').removeAttr('disabled');
		}else{
			$('form#form_fingering input[name="detalleocupacion"]').attr('disabled', true);
			$('form#form_fingering input[name="detalleocupacion"]').val('');
		}
	});
	$('form#form_fingering select[name="tipoactividad"]').change(function(event) {
		/* Act on the event */
		if($(this).val() == '8'){
			$('form#form_fingering input[name="detalletipoactividad"]').removeAttr('disabled');
		}else{
			$('form#form_fingering input[name="detalletipoactividad"]').attr('disabled', true);
			$('form#form_fingering input[name="detalletipoactividad"]').val('');
		}
	});
	$('form#form_fingering select[name="actividadeconomicappal"]').change(function(event) {
		/* Act on the event */
		if($(this).val() == '810'){
			$('form#form_fingering input[name="detalleactividadeconomicappal"]').removeAttr('disabled');
		}else{
			$('form#form_fingering input[name="detalleactividadeconomicappal"]').attr('disabled', true);
			$('form#form_fingering input[name="detalleactividadeconomicappal"]').val('');
		}
	});
	$('form#form_fingering').submit(function(event) {
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if ($(this).find('input[name="documento"]').val() == '') {
			alert("Por favor digite el numero de documento.");
			$(this).find('input[name="documento"]').css('background-color', 'red');
			return false;
		}
		if ($(this).find('input[name="documento"]').val() != $(this).find('input[name="documento2"]').val()) {
			alert("El No. de documento no coincide.");
			$(this).find('input[name="documento"]').css('background-color', 'red');
			return false;
		}
		if ($(this).find('select[name="tipodocumento"]').val() == '') {
			alert('Por favor seleccione el tipo de documento del cliente');
			$(this).find('select[name="tipodocumento"]').focus();
			return false;
		}
		if ($(this).find('input[name="nombres"]').val() == '') {
			alert('Por favor digite el nombre del cliente');
			$(this).find('input[name="nombres"]').focus();
			return false;
		} else if ($(this).find('input[name="nombres"]').val() == 'SD' || $(this).find('input[name="nombres"]').val() == 'NA') {
			alert('Por favor digite nombre de cliente valido, no puede ser SD ni NA.');
			$(this).find('input[name="nombres"]').focus();
			return false;
		}
		if ($(this).find('select[name="tipopersona"]').val() == "1") {
			//FECHANACIMIENTO
			if ($(this).find('select[name="fechanacimiento_a"]').val() == '') {
				alert('Por favor seleccione el a�o de nacimiento');
				$(this).find('select[name="fechanacimiento_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="fechanacimiento_m"]').val() == '') {
				alert('Por favor seleccione el mes de nacimiento');
				$(this).find('select[name="fechanacimiento_m"]').focus();
				return false;
			}
			if ($(this).find('select[name="fechanacimiento_d"]').val() == '') {
				alert('Por favor seleccione el dia de nacimiento');
				$(this).find('select[name="fechanacimiento_d"]').focus();
				return false;
			}
			//FECHAEXPEDICION
			if ($(this).find('select[name="fechaexpedicion_a"]').val() == '') {
				alert('Por favor seleccione el a�o de expedicion');
				$(this).find('select[name="fechaexpedicion_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="fechaexpedicion_m"]').val() == '') {
				alert('Por favor seleccione el mes de expedicion');
				$(this).find('select[name="fechaexpedicion_m"]').focus();
				return false;
			}
			if ($(this).find('select[name="fechaexpedicion_d"]').val() == '') {
				alert('Por favor seleccione el dia de expedicion');
				$(this).find('select[name="fechaexpedicion_d"]').focus();
				return false;
			}
			//Confirmar que la fecha de expedicion sea mayor a la de nacimiento
			var dif_anos = parseInt($(this).find('select[name="fechaexpedicion_a"]').val()) - parseInt($(this).find('select[name="fechanacimiento_a"]').val());
			if (dif_anos < 10) {
				alert('Por favor seleccione el a�o de expedicion valido, este no puede ser menor a la fecha de nacimiento y tampoco la diferencia entre estos puede ser menor a 10 a�os de edad');
				$(this).find('select[name="fechaexpedicion_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="lugarexpedicion"]').val() == '') {
				alert('Por favor seleccione lugar de expedicion');
				$(this).find('select[name="lugarexpedicion"]').focus();
				return false;
			}
			if ($(this).find('select[name="sexo"]').val() == '') {
				alert('Por favor seleccione sexo.');
				$(this).find('select[name="sexo"]').focus();
				return false;
			}
			if ($(this).find('select[name="nacionalidad"]').val() == '') {
				alert('Por favor seleccione nacionalidad.');
				$(this).find('select[name="nacionalidad"]').focus();
				return false;
			}
			if ($(this).find('select[name="numerohijos"]').val() == '') {
				alert('Por favor seleccione numero de hijos.');
				$(this).find('select[name="numerohijos"]').focus();
				return false;
			}
			if ($(this).find('select[name="ciudadresidencia"]').val() == '') {
				alert('Por favor seleccione una ciudad de residencia.');
				$(this).find('select[name="ciudadresidencia"]').focus();
				return false;
			}
			/*if( $("#telefonoresidencia").val() != "" ) {
			 if( $("#telefonoresidencia").val().length != "7"  &&  $("#telefonoresidencia").val().length != "9"  ) {
			 alert("El numero de telefono no es valido");	
			 $("#telefonoresidencia").css('background-color','red');  			
			 return false;
			 }
			 }*/
			if ($(this).find('input[name="nombreempresa"]').val() == '') {
				if ($(this).find('select[name="tipoactividad"]').val() == '1' || $(this).find('select[name="tipoactividad"]').val() != '2') {
					alert('Por favor digite el nombre de la empresa donde trabaja.');
					$(this).find('input[name="nombreempresa"]').focus();
					return false;
				}
			}
			/*if( $("#celular").val() != ""  ) {
			 if( $("#celular").val().length != "10"  || $("#celular").val().length < 10 || $("#celular").val().length > 10 ) {
			 alert("El numero de celular no es valido");	
			 $("#celular").css('background-color','red');  			
			 return false;
			 }
			 }*/
			if ($(this).find('select[name="actividadeconomicaempresa"]').val() == '') {
				alert('Por favor seleccione actividad economica.');
				$(this).find('select[name="actividadeconomicaempresa"]').focus();
				return false;
			}
			if ($(this).find('input[name="correoelectronico"]').val() != "" && $(this).find('input[name="correoelectronico"]').val() != "SD") {
				var status = false;
				var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
				if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
					alert("Por favor ingrese un mail valido.");
					$(this).find('input[name="correoelectronico"]').css('background-color', 'red');
					$(this).find('input[name="correoelectronico"]').focus();
					return false;
				}
			}
			if ($(this).find('input[name="cargo"]').val() == "") {
				alert("El campo de cargo no puede estar vac�o.");
				$(this).find('input[name="cargo"]').focus();
				return false;
			}
			if ($(this).find('select[name="profesion"]').val() == "" || $(this).find('select[name="profesion"]').val() == "0") {
				alert("El campo de profesion no puede estar vac�o.");
				$(this).find('select[name="profesion"]').css('background-color', 'red');
				$(this).find('select[name="profesion"]').focus();
				return false;
			}
			if ($(this).find('select[name="ocupacion"]').val() == "" || $(this).find('select[name="ocupacion"]').val() == "0") {
				alert("El campo de ocupaci�n no puede estar vac�o.");
				$(this).find('select[name="ocupacion"]').css('background-color', 'red');
				$(this).find('select[name="ocupacion"]').focus();
				return false;
			} else if ($(this).find('select[name="ocupacion"]').val() == "221" && $(this).find('input[name="detalleocupacion"]').val() == "") {//trdetalleocupacion
				alert("El campo de detalle de ocupaci�n no puede estar vac�o.");
				$(this).find('input[name="detalleocupacion"]').focus();
				return false;
			}
			if ($(this).find('select[name="ingresosmensuales"]').val() == "") {
				if ($(this).find('select[name="ocupacion"]').val() != "404" && $(this).find('select[name="ocupacion"]').val() != "405") {
					alert('Por favor seleccione ingresos mensuales.');
					$(this).find('select[name="ingresosmensuales"]').focus();
					return false;
				}
			}
			if ($(this).find('select[name="otrosingresos"]').val() == "") {
				alert('Por favor seleccione otros ingresos.');
				$(this).find('select[name="otrosingresos"]').focus();
				return false;
			}
			if ($(this).find('select[name="egresosmensuales"]').val() == "") {
				if ($(this).find('select[name="ocupacion"]').val() != "404" && $(this).find('select[name="#ocupacion"]').val() != "405") {
					alert('Por favor seleccione egresos mensuales.');
					$(this).find('select[name="egresosmensuales"]').focus();
					return false;
				}
			}
			if ($(this).find('input[name="conceptosotrosingresos"]').val() == "") {
				alert('El campo de concepto de otros ingresos no puede ir vacio, por favor digitelo.');
				$(this).find('input[name="conceptosotrosingresos"]').focus();
				return false;
			}
			if ($(this).find('select[name="tipoactividad"]').val() == '') {
				alert('Por favor seleccione el tipo de actividad.');
				$(this).find('select[name="tipoactividad"]').focus();
				return false;
			}
			if ($(this).find('select[name="tipoactividad"]').val() == '8' && $(this).find('input[name="detalletipoactividad"]').val() == '') {
				alert('Por favor digite el tipo de actividad para otros.');
				$(this).find('input[name="detalletipoactividad"]').focus();
				return false;
			}
			//$('#').val() == ''
			if ($(this).find('select[name="estrato"]').val() == '') {
				alert('Por favor seleccione estrato.');
				$(this).find('select[name="estrato"]').focus();
				return false;
			}
			if ($(this).find('select[name="totalactivos"]').val() == "") {
				if ($(this).find('select[name="ocupacion"]').val() != "404" && $(this).find('select[name="ocupacion"]').val() != "405") {
					alert('Por favor digite el total activos.');
					$(this).find('select[name="totalactivos"]').focus();
					return false;
				}
			}
			if ($(this).find('select[name="totalpasivos"]').val() == "") {
				if ($(this).find('select[name="ocupacion"]').val() != "404" && $(this).find('select[name="ocupacion"]').val() != "405") {
					alert('Por favor digite el total pasivos.');
					$(this).find('select[name="totalpasivos"]').focus();
					return false;
				}
			}
            if($(this).find('select[name="expuesta_publica"]').val() == ''){
                alert('Seleccione persona publicamente expuesta.');
                $(this).find('select[name="expuesta_publica"]').focus();
                return false;
            }
            if($(this).find('select[name="servidor_publico"]').val() == ''){
                alert('Seleccione vinculo con persona publicamente expuesta.');
                $(this).find('select[name="servidor_publico"]').focus();
                return false;
            }
            if($(this).find('select[name="recursos_publicos"]').val() == ''){
                alert('Seleccione si administra recursos publicos.');
                $(this).find('select[name="recursos_publicos"]').focus();
                return false;
            }
            if($(this).find('select[name="tributarias_otro_pais"]').val() == ''){
                alert('Seleccione si tiene obligaciones tributarias en otro pais.');
                $('#tributarias_otro_pais').focus();
                return false;
            }
            if($(this).find('select[name="tributarias_otro_pais"]').val() == '-1' && $(this).find('input[name="tributarias_paises"]').val() == ''){
                alert('Debe digitar el pais o los paises en donde tiene obligaciones tributarias');
                $(this).find('input[name="tributarias_paises"]').focus();
                return false;
            }
			$(".obligatorio").each(function() {
				count = 0;

				if ($(this).val() == "") {
					$(this).css('background-color', 'red');
					count++;
				}
			});
			if (count > 0) {
				alert("Por favor complete los campos obligatorios.");
				return false;
			}
		}else if ($(this).find('select[name="tipopersona"]').val() == "2") {
			//FECHAEXPEDICION
			if ($(this).find('select[name="fechaexpedicion_a"]').val() == '') {
				alert('Por favor seleccione el a�o de expedicion');
				$(this).find('select[name="fechaexpedicion_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="fechaexpedicion_m"]').val() == '') {
				alert('Por favor seleccione el mes de expedicion');
				$(this).find('select[name="fechaexpedicion_m"]').focus();
				return false;
			}
			if ($(this).find('select[name="fechaexpedicion_d"]').val() == '') {
				alert('Por favor seleccione el dia de expedicion');
				$(this).find('select[name="fechaexpedicion_d"]').focus();
				return false;
			}
			$(".obligatorio").each(function() {
				count = 0;
				if ($(this).val() == "") {
					$(this).css('background-color', 'red');
					count++;
				}
			});
			if (count > 0) {
				alert("Por favor complete los campos obligatorios.");
				return false;
			}
			if ($(this).find('input[name="nit"]').val() != $(this).find('input[name="nit2"]').val()) {
				alert("El No. de NIT no coincide.");
				$$(this).find('input[name="nit"]').css('background-color', 'red');
				return false;
			}
			if ($(this).find('select[name="ciudadoficina"]').val() == '') {
				alert("Por favor seleccione ciudadoficina.");
				$(this).find('select[name="ciudadoficina"]').focus();
				return false;
			}
			if ($(this).find('input[name="direccionoficinappal"]').val() == '') {
				alert("Por favor digite la direccion de la oficina principal.");
				$(this).find('input[name="direccionoficinappal"]').focus();
				return false;
			}
			if ($(this).find('select[name="actividadeconomicappal"]').val() == '810' && $(this).find('input[name="detalleactividadeconomicappal"]').val == '') {
				alert('Por favor debe digitar el detalle de la actividad economica principal.');
				$(this).find('input[name="detalleactividadeconomicappal"]').focus();
				return false;
			}
			if ($(this).find('select[name="tipoempresaemp"]').val() == '') {
				alert('Por favor seleccione el tipo de empresa.');
				$(this).find('select[name="tipoempresaemp"]').focus();
				return false;
			}
			if($(this).find('input[name="activosemp"]').val() == '' || $(this).find('input[name="activosemp"]').val() == 'SD' || $(this).find('input[name="activosemp"]').val() == 'NA'){
				alert('Por favor digite un valor valido para el campo activos empresa.');
				$(this).find('input[name="activosemp"]').focus();
				return false;
			}
			if($(this).find('input[name="pasivosemp"]').val() == '' || $(this).find('input[name="pasivosemp"]').val() == 'SD' || $(this).find('input[name="pasivosemp"]').val() == 'NA'){
				alert('Por favor digite un valor valido para el campo pasivos empresa.');
				$(this).find('input[name="pasivosemp"]').focus();
				return false;
			}
			if($(this).find('select[name="ingresosmensualesemp"]').val() == ''){
				alert('Por favor seleccione ingresos mensuales de la empresa.');
				$(this).find('select[name="ingresosmensualesemp"]').focus();
				return false;
			}
			if($(this).find('select[name="egresosmensualesemp"]').val() == ''){
				alert('Por favor seleccione egresos mensuales de la empresa.');
				$(this).find('select[name="egresosmensualesemp"]').focus();
				return false;
			}
            if($(this).find('select[name="expuesta_publica"]').val() == ''){
                alert('Seleccione persona publicamente expuesta.');
                $(this).find('select[name="expuesta_publica"]').focus();
                return false;
            }
            /*if($(this).find('select[name="servidor_publico"]').val() == ''){
                alert('Seleccione vinculo con persona publicamente expuesta.'):
                $(this).find('select[name="servidor_publico"]').focus();
                return false;
            }*/
            if($(this).find('select[name="recursos_publicos"]').val() == ''){
                alert('Seleccione si administra recursos publicos.');
                $(this).find('select[name="recursos_publicos"]').focus();
                return false;
            }
            if($(this).find('select[name="tributarias_otro_pais"]').val() == ''){
                alert('Seleccione si tiene obligaciones tributarias en otro pais.');
                $('#tributarias_otro_pais').focus();
                return false;
            }
            if($(this).find('select[name="tributarias_otro_pais"]').val() == '-1' && $(this).find('input[name="tributarias_paises"]').val() == ''){
                alert('Debe digitar el pais o los paises en donde tiene obligaciones tributarias');
                $(this).find('input[name="tributarias_paises"]').focus();
                return false;
            }
		}

		if ($(this).find('select[name="tipopersona"]').val() == "1") {
			if ($(this).find('input[name="telefonoresidencia"]').val() == '' && $(this).find('input[name="telefonolaboral"]').val() == '' && $(this).find('input[name="celular"]').val() == '') {
				alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
				$(this).find('input[name="telefonoresidencia"]').focus();
				return false;
			}
		}
		if ($(this).find('select[name="tipopersona"]').val() == "2") {
			if ($(this).find('input[name="telefonoficina"]').val() == '' && $(this).find('input[name="faxoficina"]').val() == '' && $(this).find('input[name="celularoficina"]').val() == '') {
				alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
				$(this).find('input[name="telefonoficina"]').focus();
				return false;
			}
		}
		//FECHAENTREVISTAformulario
		if ($(this).find('select[name="formulario"]').val() != '' && $(this).find('select[name="formulario"]').val() != '12') {
			if ($(this).find('select[name="fechaentrevista_a"]').val() == '') {
				alert('Por favor seleccione el a�o de entrevista');
				$(this).find('select[name="fechaentrevista_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="fechaentrevista_m"]').val() == '') {
				alert('Por favor seleccione el mes de entrevista');
				$(this).find('select[name="fechaentrevista_m"]').focus();
				return false;
			}
			if ($(this).find('select[name="fechaentrevista_d"]').val() == '') {
				alert('Por favor seleccione el dia de entrevista');
				$(this).find('select[name="fechaentrevista_d"]').focus();
				return false;
			}
		} else if ($(this).find('select[name="formulario"]').val() == '') {
			alert('Por favor seleccione el tipo de formulario.');
			$(this).find('select[name="formulario"]').focus();
			return false;
		}
		var nop = false;
		var ultimo = '';
		$(this).find('input, select, textarea').each(function(index, el) {
			if($(el).val() == '' && !$(el).attr('disabled') && $(el).attr('type') != 'hidden' && $(el).attr('type') != 'submit'){
				alert('El campo '+ $(el).attr('title') +' no puede estar vacio. name: ' + $(el).attr('name'));
				$(el).focus();
				nop = true;
				ultimo = $(el).attr('name');
				return false;
			}
		});
		if(nop){
			$('form#form_fingering #'+ultimo).focus();
			return false;
		}
		//return false;
		var data = $(this).serialize();
		$.ajax({
			beforeSend: function(){
				$('form#form_fingering button#button_form_fingering').attr('disabled', 'disabled');
			},
			data: data,
			type: 'POST',
			url: '../includes/Controller.php',
			dataType: 'json',
			success: function(dato){
				console.log(dato);
				if(dato.exito && dato.url){
					alert(dato.exito);
					window.location.href = dato.url;
				}else if(dato.error){
					alert(dato.error);
					$('form#form_fingering button#button_form_fingering').removeAttr('disabled');
				}else{
					alert('Ocurrio un error al momento de agregar el nuevo formulario, contacte con el administrador por favor.');
					console.log(dato);
					$('form#form_fingering button#button_form_fingering').removeAttr('disabled');
				}
			},
			complete: function(jqXHR, textStatus){
				//$('form#form_fingering button#button_form_fingering').removeAttr('disabled');
			},
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				console.log(ajaxOptions);
				console.log(thrownError);
				$('form#form_fingering button#button_form_fingering').removeAttr('disabled');
				alert("Error(form_fingering): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
});
$.fn.verificarFecha = function(e, call){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	var f_a = $('select#'+call+'_a').val();
	var f_m = $('select#'+call+'_m').val();
	//alert('ano:'+f_a+' mes:'+f_m);
	if(f_a != '' && f_m != ''){
		var d = new Date(f_a, f_m, 0).getDate();
		//alert(); // last day in January
		var d_str = '';
		str_d = '<option value="">---</option>';
		for(var i = 1; i <= d; i++){
			d_str = '0'+i;
			if(i > 9)
				d_str = i;
			str_d += '<option value="'+d_str+'">'+d_str+'</option>';
		}
		$('select#'+call+'_d').html(str_d);
	}
}
$.fn.validarReTelefono = function(e, form, campo, messaje){
	if($(this).val() != $('form#'+form+' input[name="'+campo+'"]').val()){
		alert(messaje);
		$(this).val('');
		$('form#'+form+' input[name="'+campo+'"]').show();
		$('form#'+form+' input[name="'+campo+'"]').val('');
		$('form#'+form+' input[name="'+campo+'"]').focus();
		return false;
	}
}
$.fn.validarReCampSel = function(e, form, campo, messaje){
	if($(this).val() != $('form#'+form+' select[name="'+campo+'"]').val()){
		alert(messaje);
		$(this).val('');
		$('form#'+form+' select[name="'+campo+'"]').show();
		$('form#'+form+' select[name="'+campo+'"]').val('').change();
		$('form#'+form+' select[name="'+campo+'"]').focus();
		return false;
	}
}
$.fn.ocultarCampoDoble = function(event){
	if($(this).val() != '')
		$(this).hide();
}
$.fn.verificarFechaSolicitud = function(){
	if($('select#fechasolicitud_a').val() == ''){
		$('select#fechasolicitud_a').focus();
		return false;
	}
	if($('select#fechasolicitud_m').val() == ''){
		$('select#fechasolicitud_m').focus();
		return false;
	}
	if($('select#fechasolicitud_d').val() == ''){
		$('select#fechasolicitud_d').focus();
		return false;
	}
	$('select#fechasolicitud_a').hide();
	$('select#fechasolicitud_m').hide();
	$('select#fechasolicitud_d').hide();
}
$.fn.verificarReFechaSolicitud = function(){
	if($('select#fechasolicitud2_a').val() == ''){
		$('select#fechasolicitud2_a').focus();
		return false;
	}else if($('select#fechasolicitud_a').val() != $('select#fechasolicitud2_a').val()){
		alert("Las fechas de solicitud no coinciden, por favor validelas.");
		$('select#fechasolicitud_a').show();
		$('select#fechasolicitud_m').show();
		$('select#fechasolicitud_d').show();
		$('select#fechasolicitud_a').val('');
		$('select#fechasolicitud_m').val('');
		$('select#fechasolicitud_d').val('');

		$('select#fechasolicitud_a').focus();
	}
	if($('select#fechasolicitud2_m').val() == ''){
		$('select#fechasolicitud2_m').focus();
		return false;
	}else if($('select#fechasolicitud_m').val() != $('select#fechasolicitud2_m').val()){
		alert("Las fechas de solicitud no coinciden, por favor validelas.");
		$('select#fechasolicitud_a').show();
		$('select#fechasolicitud_m').show();
		$('select#fechasolicitud_d').show();
		$('select#fechasolicitud_a').val('');
		$('select#fechasolicitud_m').val('');
		$('select#fechasolicitud_d').val('');

		$('select#fechasolicitud_a').focus();
	}
	if($('select#fechasolicitud2_d').val() == ''){
		$('select#fechasolicitud2_d').focus();
		return false;
	}else if($('select#fechasolicitud_d').val() != $('select#fechasolicitud2_d').val()){
		alert("Las fechas de solicitud no coinciden, por favor validelas.");
		$('select#fechasolicitud_a').show();
		$('select#fechasolicitud_m').show();
		$('select#fechasolicitud_d').show();
		$('select#fechasolicitud_a').val('');
		$('select#fechasolicitud_m').val('');
		$('select#fechasolicitud_d').val('');

		$('select#fechasolicitud_a').focus();
	}
}
$.fn.verificarFecNacOcultar = function(e) {
	if ($('#fechanacimiento_a').val() != '' && $('#fechanacimiento_m').val() != '' && $('#fechanacimiento_d').val() != '') {
		var fNac = $('#fechanacimiento_a').val() + '-' + $('#fechanacimiento_m').val() + '-' + $('#fechanacimiento_d').val();
		var fExp = $('#fechaexpedicion_a').val() + '-' + $('#fechaexpedicion_m').val() + '-' + $('#fechaexpedicion_d').val();
		var dif = diff_years(new Date(fExp), new Date(fNac));
		if(dif < 18){
			alert('La diferencia entre fecha de nacimiento y fecha de expedicion debe ser mayor a 18 años');
			//$('#fechanacimiento_a').hide();
			$('#fechanacimiento_a').val('').change();
			//$('#fechanacimiento_m').hide();
			$('#fechanacimiento_m').val('').change();
			//$('#fechanacimiento_d').hide();
			$('#fechanacimiento_d').val('').change();
			$('#fechanacimiento_a').focus();
			return false;
		}
		$('#fechanacimiento_a').hide();
		$('#fechanacimiento_m').hide();
		$('#fechanacimiento_d').hide();
	}
}
$.fn.verificarFecExpOcultar = function(e) {
	if ($('#fechaexpedicion_a').val() != '' && $('#fechaexpedicion_m').val() != '' && $('#fechaexpedicion_d').val() != '') {
		/*var fNac = $('#fechaexpedicion_a').val() + '-' + $('#fechaexpedicion_m').val() + '-' + $('#fechaexpedicion_d').val();
		var fExp = $('#fechaexpedicion_a').val() + '-' + $('#fechaexpedicion_m').val() + '-' + $('#fechaexpedicion_d').val();
		var dif = diff_years(new Date(fExp), new Date(fNac));
		if(dif < 18){
			alert('La diferencia entre fecha de nacimiento y fecha de expedicion debe ser mayor a 18 años');
			//$('#fechaexpedicion_a').hide();
			$('#fechaexpedicion_a').val('').change();
			//$('#fechaexpedicion_m').hide();
			$('#fechaexpedicion_m').val('').change();
			//$('#fechaexpedicion_d').hide();
			$('#fechaexpedicion_d').val('').change();
			$('#fechaexpedicion_a').focus();
			return false;
		}*/
		$('#fechaexpedicion_a').hide();
		$('#fechaexpedicion_m').hide();
		$('#fechaexpedicion_d').hide();
	}
}
function diff_years(dt2, dt1){
	var diff =(dt2.getTime() - dt1.getTime()) / 1000;
	diff /= (60 * 60 * 24);
	return Math.abs(Math.round(diff/365.25));
}
$.fn.checkFechaNacimiento = function(e) {
	var fec_a = ((parseInt($('#fechanacimiento_a').val()) == NaN) ? 0 : parseInt($('#fechanacimiento_a').val()));
	var fec_a2 = ((parseInt($('#fechanacimiento2_a').val()) == NaN) ? 0 : parseInt($('#fechanacimiento2_a').val()));
	var fec_m = ((parseInt($('#fechanacimiento_m').val()) == NaN) ? 0 : parseInt($('#fechanacimiento_m').val()));
	var fec_m2 = ((parseInt($('#fechanacimiento2_m').val()) == NaN) ? 0 : parseInt($('#fechanacimiento2_m').val()));
	var fec_d = ((parseInt($('#fechanacimiento_d').val()) == NaN) ? 0 : parseInt($('#fechanacimiento_d').val()));
	var fec_d2 = ((parseInt($('#fechanacimiento2_d').val()) == NaN) ? 0 : parseInt($('#fechanacimiento2_d').val()));
	if ((fec_a != fec_a2)) {
		alert("Las fechas de nacimiento no coinciden, por favor validelas.");
		$('#fechanacimiento_a').show();
		$('#fechanacimiento_m').show();
		$('#fechanacimiento_d').show();
		$('#fechanacimiento_a').val('');
		$('#fechanacimiento_m').val('');
		$('#fechanacimiento_d').val('');
		$('#fechanacimiento2_a').val('');
		$('#fechanacimiento2_m').val('');
		$('#fechanacimiento2_d').val('');
		$('#fechanacimiento_a').focus();
	}
	if(($('#fechanacimiento2_m').val() != '') && (fec_m != fec_m2)){
		alert("Las fechas de nacimiento no coinciden, por favor validelas.");
		$('#fechanacimiento_a').show();
		$('#fechanacimiento_m').show();
		$('#fechanacimiento_d').show();
		$('#fechanacimiento_a').val('');
		$('#fechanacimiento_m').val('');
		$('#fechanacimiento_d').val('');
		$('#fechanacimiento2_a').val('');
		$('#fechanacimiento2_m').val('');
		$('#fechanacimiento2_d').val('');
		$('#fechanacimiento_a').focus();
	}
	if(($('#fechanacimiento2_d').val() != '') && (fec_d != fec_d2)){
		alert("Las fechas de nacimiento no coinciden, por favor validelas.");
		$('#fechanacimiento_a').show();
		$('#fechanacimiento_m').show();
		$('#fechanacimiento_d').show();
		$('#fechanacimiento_a').val('');
		$('#fechanacimiento_m').val('');
		$('#fechanacimiento_d').val('');
		$('#fechanacimiento2_a').val('');
		$('#fechanacimiento2_m').val('');
		$('#fechanacimiento2_d').val('');
		$('#fechanacimiento_a').focus();
	}
}
$.fn.checkFechaExpimiento = function(e) {
	var fec_a = ((parseInt($('#fechaexpedicion_a').val()) == NaN) ? 0 : parseInt($('#fechaexpedicion_a').val()));
	var fec_a2 = ((parseInt($('#fechaexpedicion2_a').val()) == NaN) ? 0 : parseInt($('#fechaexpedicion2_a').val()));
	var fec_m = ((parseInt($('#fechaexpedicion_m').val()) == NaN) ? 0 : parseInt($('#fechaexpedicion_m').val()));
	var fec_m2 = ((parseInt($('#fechaexpedicion2_m').val()) == NaN) ? 0 : parseInt($('#fechaexpedicion2_m').val()));
	var fec_d = ((parseInt($('#fechaexpedicion_d').val()) == NaN) ? 0 : parseInt($('#fechaexpedicion_d').val()));
	var fec_d2 = ((parseInt($('#fechaexpedicion2_d').val()) == NaN) ? 0 : parseInt($('#fechaexpedicion2_d').val()));
	if ((fec_a != fec_a2)) {
		alert("Las fechas de expedicion no coinciden, por favor validelas.");
		$('#fechaexpedicion_a').show();
		$('#fechaexpedicion_m').show();
		$('#fechaexpedicion_d').show();
		$('#fechaexpedicion_a').val('');
		$('#fechaexpedicion_m').val('');
		$('#fechaexpedicion_d').val('');
		$('#fechaexpedicion2_a').val('');
		$('#fechaexpedicion2_m').val('');
		$('#fechaexpedicion2_d').val('');
		$('#fechaexpedicion_a').focus();
	}
	if(($('#fechaexpedicion2_m').val() != '') && (fec_m != fec_m2)){
		alert("Las fechas de expedicion no coinciden, por favor validelas.");
		$('#fechaexpedicion_a').show();
		$('#fechaexpedicion_m').show();
		$('#fechaexpedicion_d').show();
		$('#fechaexpedicion_a').val('');
		$('#fechaexpedicion_m').val('');
		$('#fechaexpedicion_d').val('');
		$('#fechaexpedicion2_a').val('');
		$('#fechaexpedicion2_m').val('');
		$('#fechaexpedicion2_d').val('');
		$('#fechaexpedicion_a').focus();
	}
	if(($('#fechaexpedicion2_d').val() != '') && (fec_d != fec_d2)){
		alert("Las fechas de expedicion no coinciden, por favor validelas.");
		$('#fechaexpedicion_a').show();
		$('#fechaexpedicion_m').show();
		$('#fechaexpedicion_d').show();
		$('#fechaexpedicion_a').val('');
		$('#fechaexpedicion_m').val('');
		$('#fechaexpedicion_d').val('');
		$('#fechaexpedicion2_a').val('');
		$('#fechaexpedicion2_m').val('');
		$('#fechaexpedicion2_d').val('');
		$('#fechaexpedicion_a').focus();
	}
}
</script>