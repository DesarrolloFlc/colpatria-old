<br>
<table>
	<tr>
		<td>Firma del cliente: </td>
		<td>
			<select name="firma" id="firma" class="obligatorio">
				<option value="">-Opciones-</option>
				<option value="Si">Si</option>
				<option value="No">No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Huella del cliente: </td>
		<td>
			<select name="huella" id="huella" class="obligatorio">
				<option value="">-Opciones-</option>
				<option value="Si">Si</option>
				<option value="No">No</option>
			</select>
		</td>
	</tr>
	<!-- INFORMACION ENTREVISTA -->
	<tr>
		<td>Lugar de entrevista:</td>
		<td><input type="text" name="lugarentrevista" id="lugarentrevista"  class="obligatorio" onkeypress="return validar_letra(event)"></td>
	</tr>
	<tr>
		<td>Fecha entrevista:</td>
		<td>
			<select name="fechaentrevista_a" id="fechaentrevista_a" class="obligatorio">
				<option value="">---</option>
				<option vaue="2011">2011</option>
			</select>
			<select name="fechaentrevista_m" id="fechaentrevista_m" class="obligatorio">
				<option value="">---</option>
<?php
for($i = 01; $i <= 12; $i++){
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
			<select name="fechaentrevista_d" id="fechaentrevista_d" class="obligatorio">
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
		<td>Hora entrevista:</td>
		<td>
			<select id="horaentrevista" name="horaentrevista" size="8px">
				<option value="">---</option>
<?php
for($i = 1; $i <= 12; $i++){
?>
				<option value="<?=$i?>"><?=$i?></option>
<?php
}
?>
			</select>
			<select id="tipohoraentrevista" name="tipohoraentrevista">
				<option value="">---</option>
				<option value="am">am</option>
				<option value="pm">pm</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Resultado entrevista: </td>
		<td>
			<select name="resultadoentrevista" id="resultadoentrevista" class="obligatorio">
				<option value="">-Opciones-</option>
				<option value="Aceptado">Aceptado</option>
				<option value="Rechazado">Rechazado</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Observaciones:</td>
		<td><textarea name="observacionesentrevista" id="observacionesentrevista" onkeypress="return validar_letra(event)"></textarea></td>
	</tr>
	<tr>
		<td>Nombre intermediario y/o asesor responsable:</td>
		<td><input type="text" name="nombreintermediario" id="nombreintermediario" class="obligatorio" onkeypress="return validar_letra(event)"/></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><input type="submit" value="Anexar caraB" /></td>
	</tr>
</table>
<input type="hidden" name="type" id="type" value="2">
<input type="hidden" name="num_images" id="num_images" value="">