<table id="table_parte1" width="491">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>ANEXO 1 - CONOCIMIENTO MEJORADO DE PERSONAS EXPUESTAS POL&Iacute;TICAMENTE</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Hay peps naturales?</td>
		<td>
			<select id="si_peps_nat" name="si_peps_nat" style="font-size: 12px; margin-right: 5px" title="Hay peps naturales">
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
			<table id="peps_nat_table" width="100%">
<?php
for($i = 0; $i < 5; $i++){
?>
				<tr>
					<td colspan="2" align="left"><strong>PEP(<?=($i + 1)?>)</strong></td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Vinculo/Relacion</td>
					<td>
						<select id="pep_vinculo_relacion[<?=$i?>]" name="pep_vinculo_relacion[]" style="font-size: 12px; margin-right: 5px" title="Vinculo/Relacion(<?=($i + 1)?>)" disabled="disabled">
							<option value="">Selecciones</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="99">SD</option>
						</select>
						Tipo PEP
						<select id="pep_tipo_pep[<?=$i?>]" name="pep_tipo_pep[]" style="font-size: 12px; margin-right: 5px" title="Tipo PEP(<?=($i + 1)?>)" disabled="disabled">
							<option value="">Selecciones</option>
							<option value="PEP LOCAL">PEP LOCAL</option>
							<option value="PEP DE ORGANIZACION">PEP DE ORGANIZACION</option>
							<option value="PEP EXTRANJERO">PEP EXTRANJERO</option>
							<option value="SD">SD</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Nombres y apellidos:</td>
					<td><input type="text" id="pep_nombre_razon[<?=$i?>]" name="pep_nombre_razon[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombres y apellidos(<?=($i + 1)?>)" disabled="disabled"></td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Tipo documento:</td>
					<td>
						<select id="pep_tipodocumento_id[<?=$i?>]" name="pep_tipodocumento_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo documento(<?=($i + 1)?>)" disabled="disabled">
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
						Numero:&nbsp;<input type="text" id="pep_identificacion[<?=$i?>]" name="pep_identificacion[]" style="width: 130px; display: initial;" title="Numero identificacion(<?=($i + 1)?>)" disabled="disabled">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Nacionalidad:</td>
					<td>
						<select id="pep_nacionalidad_id[<?=$i?>]" name="pep_nacionalidad_id[]" style="font-size: 12px" title="Nacionalidad(<?=($i + 1)?>)" disabled="disabled">
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
					<td style="width: 100px;display: table-cell;">Entidad:</td>
					<td><input type="text" id="pep_entidad[<?=$i?>]" name="pep_entidad[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Entidad(<?=($i + 1)?>)" disabled="disabled"></td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Cargo:</td>
					<td><input type="text" id="pep_cargo[<?=$i?>]" name="pep_cargo[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Cargo(<?=($i + 1)?>)" disabled="disabled"></td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Fecha vinculacion:</td>
					<td>
						<select id="f_vinpep_a[<?=$i?>]" name="f_vinpep_a[]" onchange="$(this).verificarFechaMultiple(event, 'vinpep', '0', <?=$i?>);" style="font-size: 12px" title="Año de fecha vinculacion(<?=($i + 1)?>)" disabled="disabled">
							<option value="">Año</option>
<?php
	$an = 1900;
	$anl = date('Y');
	for($x = $an; $x <= $anl; $x++)
		echo '<option value="'.$x.'">'.$x.'</option>';
?>
							<option value="ND">ND</option>
						</select>
						<select id="f_vinpep_m[<?=$i?>]" name="f_vinpep_m[]" onchange="$(this).verificarFechaMultiple(event, 'vinpep', '0', <?=$i?>);" style="font-size: 12px" title="Mes de fecha vinculacion(<?=($i + 1)?>)" disabled="disabled">
							<option value="">Mes</option>
<?php
	$an = 1;
	for($x = $an; $x <= 12; $x++){
		$val_m = '0'.$x;
		if($x > 9)
			$val_m = $x;
		echo '<option value="'.$x.'">'.$val_m.'</option>';
	}
?>
							<option value="ND">ND</option>
						</select>
						<select id="f_vinpep_d[<?=$i?>]" name="f_vinpep_d[]" style="font-size: 12px" title="Dia de fecha vinculacion<?=($i + 1)?>" disabled="disabled">
							<option value="">Dia</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Fecha desvinculacion:</td>
					<td>
						<select id="f_despep_a[<?=$i?>]" name="f_despep_a[]" onchange="$(this).verificarFechaMultiple(event, 'despep', '0', <?=$i?>);" style="font-size: 12px" title="Año de fecha desvinculacion(<?=($i + 1)?>)" disabled="disabled">
							<option value="">Año</option>
<?php
	$an = 1900;
	$anl = date('Y', strtotime('+3 years'));
	for($x = $an; $x <= $anl; $x++)
		echo '<option value="'.$x.'">'.$x.'</option>';
?>
							<option value="ND">ND</option>
						</select>
						<select id="f_despep_m[<?=$i?>]" name="f_despep_m[]" onchange="$(this).verificarFechaMultiple(event, 'despep', '0', <?=$i?>);" style="font-size: 12px" title="Mes de fecha desvinculacion(<?=($i + 1)?>)" disabled="disabled">
							<option value="">Mes</option>
<?php
	$an = 1;
	for($x = $an; $x <= 12; $x++){
		$val_m = '0'.$x;
		if($x > 9)
			$val_m = $x;
		echo '<option value="'.$x.'">'.$val_m.'</option>';
	}
?>
							<option value="ND">ND</option>
						</select>
						<select id="f_despep_d[<?=$i?>]" name="f_despep_d[]" style="font-size: 12px" title="Dia de fecha desvinculacion<?=($i + 1)?>" disabled="disabled">
							<option value="">Dia</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Cuenta otros paises?</td>
					<td>
						<select id="pep_cuentas_otros_paises[<?=$i?>]" name="pep_cuentas_otros_paises[]" style="font-size: 12px; margin-right: 5px" title="Cuenta otros paises(<?=($i + 1)?>)" disabled="disabled">
							<option value="">Seleccione</option>
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
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>IDENTIFICACI&Oacute;N DE VINCULADOS A PERSONAS EXPUESTAS POL&Iacute;TICAMENTE</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Hay vinculados a peps?</td>
		<td>
			<select id="si_peps_vinculados" name="si_peps_vinculados" style="font-size: 12px; margin-right: 5px" title="Hay vinculados a peps">
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
			<table id="peps_vinculados_table" width="100%">
<?php
for($i = 5; $i < 10; $i++){
?>
				<tr>
					<td colspan="2" align="left"><strong>Viculado a PEP(<?=($i - 4)?>)</strong></td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Vinculo/Relacion</td>
					<td>
						<select id="pep_vinculo_relacion[<?=$i?>]" name="pep_vinculo_relacion[]" style="font-size: 12px; margin-right: 5px" title="Vinculo/Relacion(<?=($i - 4)?>)" disabled="disabled">
							<option value="">Selecciones</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="99">SD</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Nombres y apellidos:</td>
					<td><input type="text" id="pep_nombre_razon[<?=$i?>]" name="pep_nombre_razon[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombres y apellidos(<?=($i - 4)?>)" disabled="disabled"></td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Tipo documento:</td>
					<td>
						<select id="pep_tipodocumento_id[<?=$i?>]" name="pep_tipodocumento_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo documento(<?=($i - 4)?>)" disabled="disabled">
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
						Numero:&nbsp;<input type="text" id="pep_identificacion[<?=$i?>]" name="pep_identificacion[]" style="width: 130px; display: initial;" title="Numero identificacion(<?=($i - 4)?>)" disabled="disabled">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Nacionalidad:</td>
					<td>
						<select id="pep_nacionalidad_id[<?=$i?>]" name="pep_nacionalidad_id[]" style="font-size: 12px" title="Nacionalidad(<?=($i - 4)?>)" disabled="disabled">
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
					<td colspan="2" align="left"><hr></td>
				</tr>
<?php
}
?>
			</table>
		</td>
	</tr>
</table>