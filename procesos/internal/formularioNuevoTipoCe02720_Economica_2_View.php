<table id="table_parte1" width="491">
<tr>
	<td style="width: 100px;display: table-cell;">Re-escribir NIT:</td>
	<td>
		<input type="text" id="nit2" name="nit2" style="width: 130px; margin-right: 10px" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'nit', 'El numero de nit no coinciden por favor validelos.');" title="text" onkeypress="return validar_num(event)">
	</td>
</tr>
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>INFORMACI&Oacute;N DE MIEMBROS DE JUNTA DIRECTIVA</strong></td>
	</tr>
	<tr>
		<td style="width: 100px; display: table-cell;">Hay miembros de la junta directiva?</td>
		<td>
			<select id="si_junta_directiva" name="si_junta_directiva" style="font-size: 12px; margin-right: 5px" title="Hay miembros de la junta directiva">
				<option value="-1">SI</option>
				<option value="0" selected>NO</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir E-mail:</td>
		<td>
			<input type="text" id="correoelectronico_otro2" name="correoelectronico_otro2" style="width: 230px" onkeypress="return validar_letra(event)" title="E-mail" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'correoelectronico_otro', 'Los e-mails no coinciden por favor validelos.');">
		</td>
	</tr>
	<tr>
		<td colspan="2" align="left"><hr></td>
	</tr>
	<tr>
	<td colspan="2" align="left">
	<table id="junta_directiva" width="100%">
<?php
for($jun = 0; $jun < 3; $jun++){
?>
	<tr>
		<td colspan="2" align="left"><strong>Miembro(<?=($jun + 1)?>)</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombres y apellidos:</td>
		<td><input type="text" id="ju_nombre_completo[<?=$jun?>]" name="ju_nombre_completo[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombres y apellidos(Miembro <?=($jun + 1)?>)" disabled="disabled"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo documento:</td>
		<td>
			<select id="ju_tipodocumento_id[<?=$jun?>]" name="ju_tipodocumento_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo documento(Miembro <?=($jun + 1)?>)" disabled="disabled">
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
			Numero:&nbsp;<input type="text" id="ju_identificacion[<?=$jun?>]" name="ju_identificacion[]" style="width: 130px; display: initial;" title="Numero (Miembro <?=($jun + 1)?>)" disabled="disabled">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Expuesto politico?</td>
		<td>
			<select id="ju_expuesto_politico[<?=$jun?>]" name="ju_expuesto_politico[]" style="font-size: 12px; margin-right: 5px" title="Expuesto politico(Miembro <?=($jun + 1)?>)" disabled="disabled">
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
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>INFORMACI&Oacute;N ECON&Oacute;MICA DEL TOMADOR (PERSONA JUR&Iacute;DICA)</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Actividad economica:</td>
		<td>
			<input type="text" id="detalleactividadeconomicappal" name="detalleactividadeconomicappal" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Actividad economica">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir Direccion:</td>
		<td><input type="text" id="direccionoficinappal2" name="direccionoficinappal2" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'direccionoficinappal', 'Las direcciones no coinciden por favor validelas.');"></td>
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
		<td style="width: 100px;display: table-cell;">Producto que comercializa:</td>
		<td><input type="text" id="detalletipoactividad" name="detalletipoactividad" style="width: 220px" onkeypress="return validar_letra(event)" title="Producto que comercializa"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Re-escribir Numero identificacion:</td>
		<td>
			&nbsp;<input type="text" id="documento2" name="documento2" style="width: 130px; display: initial;" title="Numero identificacion" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'documento', 'El numero de documento no coinciden por favor validelos.');">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Activos:</td>
		<td>
			<input type="text" id="activosemp" name="activosemp" style="width: 100px; margin-right: 20px" onkeypress="return validar_num(event)" title="Activos">
			Pasivos:
			<input type="text" id="pasivosemp" name="pasivosemp" style="width: 100px" onkeypress="return validar_num(event)" title="Pasivos">
		</td>
	</tr>
	<!-- <tr>
		<td style="width: 100px;display: table-cell;">Patrimonio:</td>
		<td>
			<input type="text" id="patrimonio" name="patrimonio" style="width: 100px" title="Patrimonio" onkeypress="return validar_num(event)">
		</td>
	</tr> -->
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
		<td style="width: 100px;display: table-cell;">Ingresos mensuales:</td>
		<td>
		<input type="text" id="ingresos_mensuales_emp_pesos" name="ingresos_mensuales_emp_pesos" style="width: 100px; margin-right: 20px" title="Ingresos mensuales" onkeypress="return validar_num(event)">
			<!-- <select id="ingresosmensualesemp" name="ingresosmensualesemp" style="font-size: 12px; margin-right: 5px" title="Ingresos mensuales">
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
			<input type="text" id="egresos_mensuales_emp_pesos" name="egresos_mensuales_emp_pesos" style="width: 100px; margin-right: 20px" title="egresos mensuales" onkeypress="return validar_num(event)">
			<!-- <select id="egresosmensualesemp" name="egresosmensualesemp" style="font-size: 12px; margin-right: 5px" title="Egresos mensuales">
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
		<td style="width: 100px;display: table-cell;">Procedencia de fondos:</td>
		<td>
			<input type="text" id="procedencia_fondos" name="procedencia_fondos" style="width: 300px" onkeypress="return validar_letra(event)" title="Procedencia de fondos">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Otros ingresos:</td>
		<td>
			<input type="text" id="otros_ingresos_emp_pesos" name="otros_ingresos_emp_pesos" style="width: 100px; margin-right: 20px" title="Otros ingresos" onkeypress="return validar_num(event)">

			<!-- <select id="otrosingresosemp" name="otrosingresosemp" style="font-size: 12px; margin-right: 5px" title="Otros ingresos">
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
			Concepto otros ingresos:
			<input type="text" id="concepto_otrosingresosemp" name="concepto_otrosingresosemp" style="width: 350px" onkeypress="return validar_letra(event)" title="Concepto otros ingresos">
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

	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>INFORMACI&Oacute;N DE LA COMPOSICI&Oacute;N ACCIONARIA DEL TOMADOR (PERSONA JUR&Iacute;DICA)</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Alguna persona natural con beneficios?</td>
		<td>
			<select id="accionista_beneficios" name="accionista_beneficios" style="font-size: 12px; margin-right: 5px" title="Alguna persona natural con beneficios">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Hay accionistas naturales?</td>
		<td>
			<select id="si_accionistas_nat" name="si_accionistas_nat" style="font-size: 12px; margin-right: 5px" title="Hay beneficiarios naturales">
				<option value="-1">SI</option>
				<option value="0" selected>NO</option>
			</select>
		</td>
	</tr>
	<tr>
	<td colspan="2" align="left">
	<table id="accionistas_nat_table" width="100%">
<?php
for($ben = 0; $ben < 3; $ben++){
?>
	<tr>
		<td colspan="2" align="left"><strong>Accionista natural(<?=($ben + 1)?>)</strong></td>
	</tr>
	<input type="hidden" id="be_tipo[<?=$ben?>]" name="be_tipo[]" value="1">
	<tr>
		<td style="width: 100px;display: table-cell;">Nombres y apellidos:</td>
		<td><input type="text" id="be_nombre_completo[<?=$ben?>]" name="be_nombre_completo[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombres y apellidos(Accionista natural <?=($ben + 1)?>)" disabled="disabled"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo identificacion:</td>
		<td>
			<select id="be_tipodocumento_id[<?=$ben?>]" name="be_tipodocumento_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo identificacion(Accionista natural <?=($ben + 1)?>)" disabled="disabled">
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
			Numero:&nbsp;<input type="text" id="be_identificacion[<?=$ben?>]" name="be_identificacion[]" style="width: 130px; display: initial;" title="Numero(Accionista natural <?=($ben + 1)?>)" disabled="disabled">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Fecha expedicion:</td><!--fechaexpedicion-->
		<td>
			<select id="f_expac_a[<?=$ben?>]" name="f_expac_a[]" onchange="$(this).verificarFechaMultiple(event, 'expac', '0', <?=$ben?>);" style="font-size: 12px" title="Año de fecha expedicion(Accionista natural <?=($ben + 1)?>)" disabled="disabled">
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
			<select id="f_expac_m[<?=$ben?>]" name="f_expac_m[]" onchange="$(this).verificarFechaMultiple(event, 'expac', '0', <?=$ben?>);" style="font-size: 12px" title="Mes de fecha expedicion(Accionista natural <?=($ben + 1)?>)" disabled="disabled">
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
			<select id="f_expac_d[<?=$ben?>]" name="f_expac_d[]" title="Fecha de expedici&oacute;n: dia(Accionista natural <?=($ben + 1)?>)" style="font-size: 12px" title="Dia de fecha expedicion" disabled="disabled">
				<option value="">Dia</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Expuesto politico?</td>
		<td>
			<select id="be_expuesto_politico[<?=$ben?>]" name="be_expuesto_politico[]" style="font-size: 12px; margin-right: 5px" title="Expuesto politico(Accionista natural <?=($ben + 1)?>)" disabled="disabled">
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
		<td style="width: 100px;display: table-cell;">Accionista juridico con beneficios?</td>
		<td>
			<select id="beneficiarios_jur" name="beneficiarios_jur" style="font-size: 12px; margin-right: 5px" title="Accionista juridico con beneficios">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
			Cotiza en bolsa o RNVE?
			<select id="cotiza_rnve" name="cotiza_rnve" style="font-size: 12px; margin-right: 5px" title="Cotiza en bolsa o RNVE">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Hay accionistas juridicos?</td>
		<td>
			<select id="si_accionistas_jur" name="si_accionistas_jur" style="font-size: 12px; margin-right: 5px" title="Hay accionistas juridicos">
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
	<table id="accionistas_jur_table" width="100%">
<?php
for($ben = 3; $ben < 6; $ben++){
?>
	<tr>
		<td colspan="2" align="left"><strong>Accionista juridico(<?=($ben - 2)?>)</strong></td>
	</tr>
	<input type="hidden" id="be_tipo[<?=$ben?>]" name="be_tipo[]" value="0">
	<tr>
		<td style="width: 100px;display: table-cell;">Nombre de la empresa:</td>
		<td><input type="text" id="be_razon_social[<?=$ben?>]" name="be_razon_social[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombre de la empresa(Beneficiario juridico <?=($ben - 3)?>)" disabled="disabled"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">NIT:</td>
		<td>
			<input type="text" id="be_nit[<?=$ben?>]" name="be_nit[]" style="width: 130px; display: initial;" title="NIT(Beneficiario juridico <?=($ben - 3)?>)" disabled="disabled" onkeypress="return validar_num(event)">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombres y apellidos(representante legal):</td>
		<td><input type="text" id="be_nombre_completo[<?=$ben?>]" name="be_nombre_completo[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombres y apellidos(representante legal)(Beneficiario juridico <?=($ben - 3)?>)" disabled="disabled"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo ID:</td>
		<td>
			<select id="be_tipodocumento_id[<?=$ben?>]" name="be_tipodocumento_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo ID(Beneficiario juridico <?=($ben - 3)?>)" disabled="disabled">
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
			Numero ID:&nbsp;<input type="text" id="be_identificacion[<?=$ben?>]" name="be_identificacion[]" style="width: 130px; display: initial;" title="Numero ID(Beneficiario juridico <?=($ben - 3)?>)" disabled="disabled">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Expuesto politico?</td>
		<td>			
			<select id="be_expuesto_politico[<?=$ben?>]" name="be_expuesto_politico[]" style="font-size: 12px; margin-right: 5px" title="Expuesto politico(Beneficiario juridico <?=($ben - 3)?>)" disabled="disabled">
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