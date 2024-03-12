<table id="table_parte1" width="491">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>INFORMACI&Oacute;N DE LOS BENEFICIARIOS DEL PRODUCTO DE SEGUROS</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Hay beneficiarios naturales?</td>
		<td>
			<select id="si_beneficiarios_nat" name="si_beneficiarios_nat" style="font-size: 12px; margin-right: 5px" title="Hay beneficiarios naturales">
				<option value="-1">SI</option>
				<option value="0" selected>NO</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="left"><hr></td>
	</tr>
	<tr>
	<td colspan="2" align="left">
	<table id="beneficiarios_nat_table" width="100%">
<?php
for($ben = 0; $ben < 4; $ben++){
?>
	<tr>
		<td colspan="2" align="left"><strong>Beneficiario natural(<?=($ben + 1)?>)</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombres y apellidos:</td>
		<td><input type="text" id="be_nombre_completo[<?=$ben?>]" name="be_nombre_completo[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombres y apellidos(beneficiario <?=($ben + 1)?>)" disabled="disabled"></td>
	</tr>
	<input type="hidden" id="be_tipo[<?=$ben?>]" name="be_tipo[]" value="0">
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo documento:</td>
		<td>
			<select id="be_tipodocumento_id[<?=$ben?>]" name="be_tipodocumento_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo documento(beneficiario <?=($ben + 1)?>)" disabled="disabled">
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
			Numero:&nbsp;<input type="text" id="be_identificacion[<?=$ben?>]" name="be_identificacion[]" style="width: 130px; display: initial;" title="Numero identificacion(beneficiario <?=($ben + 1)?>)" disabled="disabled">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Expuesto politico?</td>
		<td>
			<select id="be_expuesto_politico[<?=$ben?>]" name="be_expuesto_politico[]" style="font-size: 12px; margin-right: 5px" title="Expuesto politico(beneficiario <?=($ben + 1)?>)" disabled="disabled">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Obligaciones tributarias en otros paises?</td>
		<td>
			<select id="be_poliza_seguro[<?=$ben?>]" name="be_poliza_seguro[]" style="font-size: 12px; margin-right: 5px" title="Beneficiario de poliza(beneficiario <?=($ben + 1)?>)" disabled="disabled">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="left"><hr></td>
	</tr>
<?php
}
?>
	<tr>
		<td style="width: 100px;display: table-cell;">Si respondio que el beneficiario tiene obligaciones tributarias, indique en que pais</td>
		<td><input type="text" id="ben_nat_obligacion_paises" name="ben_nat_obligacion_paises" style="width: 240px" onkeypress="return validar_letra(event)" title="Indique los paises en donde tiene obligacion" disabled="disabled"></td>
	</tr>
	</table>
	</td>
	</tr>
</table>