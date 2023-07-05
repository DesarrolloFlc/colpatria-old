<table id="table_parte1" width="491">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>INFORMACI&Oacute;N DE LOS BENEFICIARIOS DEL PRODUCTO DE SEGUROS</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Beneficiarios diferentes al tomador?</td>
		<td>
			<select id="beneficiarios_diferentes" name="beneficiarios_diferentes" style="font-size: 12px; margin-right: 5px" title="Beneficiarios diferentes al tomador">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
			Son personas naturales?
			<select id="beneficiarios_naturales" name="beneficiarios_naturales" style="font-size: 12px; margin-right: 5px" title="Son personas naturales">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
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
	<input type="hidden" id="be_tipo[<?=$ben?>]" name="be_tipo[]" value="2">
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
		<td style="width: 100px;display: table-cell;">Fecha expedicion:</td><!--fechaexpedicion-->
		<td>
			<select id="f_expbe_a[<?=$ben?>]" name="f_expbe_a[]" onchange="$(this).verificarFechaMultiple(event, 'expbe', '0', <?=$ben?>);" style="font-size: 12px" title="Año de fecha expedicion(beneficiario <?=($ben + 1)?>)" disabled="disabled">
				<option value="">Año</option>
<?php
	$an = 1900;
	$anl = date('Y');
	for($i = $an; $i <= $anl; $i++){
?>
				<option value="<?=$i?>"><?=$i?></option>
<?php
	}
?>
				<option value="ND">ND</option>
			</select>
			<select id="f_expbe_m[<?=$ben?>]" name="f_expbe_m[]" onchange="$(this).verificarFechaMultiple(event, 'expbe', '0', <?=$ben?>);" style="font-size: 12px" title="Mes de fecha expedicion(beneficiario <?=($ben + 1)?>)" disabled="disabled">
				<option value="">Mes</option>
<?php
	$an = 1;
	for($i = $an; $i <= 12; $i++){
		$val_m = '0'.$i;
		if($i > 9)
			$val_m = $i;
?>
				<option value="<?=$i?>"><?=$val_m?></option>
<?php
	}
?>
				<option value="ND">ND</option>
			</select>
			<select id="f_expbe_d[<?=$ben?>]" name="f_expbe_d[]" title="Fecha de expedici&oacute;n: dia(beneficiario <?=($ben + 1)?>)" style="font-size: 12px" title="Dia de fecha expedicion" disabled="disabled">
				<option value="">Dia</option>
			</select>
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
			Beneficiario de poliza?
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
	</table>
	</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Son personas juridicas?</td>
		<td>
			<select id="beneficiarios_jur" name="beneficiarios_jur" style="font-size: 12px; margin-right: 5px" title="Son personas juridicas">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Hay beneficiarios juridicos?</td>
		<td>
			<select id="si_beneficiarios_jur" name="si_beneficiarios_jur" style="font-size: 12px; margin-right: 5px" title="Hay beneficiarios juridicos">
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
	<table id="beneficiarios_jur_table" width="100%">
<?php
for($ben = 4; $ben < 8; $ben++){
?>
	<tr>
		<td colspan="2" align="left"><strong>Beneficiario juridico(<?=($ben - 3)?>)</strong></td>
	</tr>
	<input type="hidden" id="be_tipo[<?=$ben?>]" name="be_tipo[]" value="3">
	<tr>
		<td style="width: 100px;display: table-cell;">Nombre de la empresa:</td>
		<td><input type="text" id="be_razon_social[<?=$ben?>]" name="be_razon_social[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombre de la empresa(beneficiario <?=($ben - 3)?>)" disabled="disabled"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">NIT:</td>
		<td>
			<input type="text" id="be_nit[<?=$ben?>]" name="be_nit[]" style="width: 130px; display: initial;" title="NIT(beneficiario <?=($ben - 3)?>)" disabled="disabled" onkeypress="return validar_num(event)">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombres y apellidos(representante legal):</td>
		<td><input type="text" id="be_nombre_completo[<?=$ben?>]" name="be_nombre_completo[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombres y apellidos(representante legal)(beneficiario <?=($ben - 3)?>)" disabled="disabled"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo documento:</td>
		<td>
			<select id="be_tipodocumento_id[<?=$ben?>]" name="be_tipodocumento_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo documento(beneficiario <?=($ben - 3)?>)" disabled="disabled">
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
			Numero:&nbsp;<input type="text" id="be_identificacion[<?=$ben?>]" name="be_identificacion[]" style="width: 130px; display: initial;" title="Numero(beneficiario <?=($ben - 3)?>)" disabled="disabled">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Beneficiario de poliza?</td>
		<td>			
			<select id="be_poliza_seguro[<?=$ben?>]" name="be_poliza_seguro[]" style="font-size: 12px; margin-right: 5px" title="Beneficiario de poliza(beneficiario <?=($ben - 3)?>)" disabled="disabled">
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
	</table>
	</td>
	</tr>
</table>