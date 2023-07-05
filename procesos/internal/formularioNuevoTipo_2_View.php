<tr>
	<td colspan="2">PERSONA JUR&Iacute;DICA</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Nombre o Razon social:</td>
	<td><input type="text" id="razonsocial" name="razonsocial" style="width: 280px" onkeypress="return validar_letra(event)" title="Nombre o Razon social"></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">NIT:</td>
	<td>
		<input type="text" id="nit" name="nit" style="width: 130px; margin-right: 10px" onblur="$(this).ocultarEsteCampo(event);" title="NIT">
		DIV:
		<input type="text" id="digitochequeo" name="digitochequeo" style="width: 80px; margin-left: 10px" title="DIV">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Tipo de empresa</td>
	<td>
		<select id="tipoempresajur" name="tipoempresajur" style="font-size: 12px; margin-right: 5px" title="Tipo de empresa"><!--agregar campo llamado tipoempresajur-->
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
		Otra: 
		<input type="text" id="tipoempresajur_otra" name="tipoempresajur_otra" style="width: 130px; margin-left: 10px" onkeypress="return validar_letra(event)" title="Otra tipo de empresa"><!--agregar campo llamado tipoempresajur_otra-->
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Actividad economica:</td>
	<td>
		<input type="text" id="detalleactividadeconomicappal" name="detalleactividadeconomicappal" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Actividad economica">
		CIIU(codigo):
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
	<td style="width: 100px;display: table-cell;">Direccion oficina principal:</td>
	<td><input type="text" id="direccionoficinappal" name="direccionoficinappal" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion oficina principal" onblur="$(this).ocultarEsteCampo(event);"></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Ciudad / Departamento:</td>
	<td>
		<select id="ciudadoficina" name="ciudadoficina" style="font-size: 12px" title="Ciudad / Departamento">
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
		<input type="text" id="telefonoficina" name="telefonoficina" style="width: 100px; margin-right: 10px" onchange="$(this).checkTamanoTele(event, 7);" maxlength="7" title="Telefono">
		E-mail:
		<input type="text" id="correoelectronico_otro" name="correoelectronico_otro" style="width: 230px" onkeypress="return validar_letra(event)" title="E-mail" onblur="$(this).ocultarEsteCampo(event);">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Celular:</td>
	<td>
		<input type="text" id="celularoficina" name="celularoficina" style="width: 100px; margin-right: 10px" onchange="$(this).checkTamanoTele(event, 10);" maxlength="10" title="Celular">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Direccion sucursal:</td>
	<td><input type="text" id="direccionsucursal" name="direccionsucursal" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion sucursal" onblur="$(this).ocultarEsteCampo(event);"></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Ingresos mensuales:</td>
	<td>
		<select id="ingresosmensualesemp" name="ingresosmensualesemp" style="font-size: 12px; margin-right: 5px" title="Ingresos mensuales">
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
	<td style="width: 100px;display: table-cell;">Activos:</td>
	<td>
		<input type="text" id="activosemp" name="activosemp" style="width: 100px; margin-right: 20px" onkeypress="return validar_num(event)" title="Activos">
		Pasivos:
		<input type="text" id="pasivosemp" name="pasivosemp" style="width: 100px" onkeypress="return validar_num(event)" title="Pasivos">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Re-escribir direccion oficina principal:</td>
	<td><input type="text" id="direccionoficinappal2" name="direccionoficinappal2" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion oficina principal" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'direccionoficinappal', 'Las direcciones de oficina principal no coinciden por favor validelas.');"></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Egresos mensuales:</td>
	<td>
		<select id="egresosmensualesemp" name="egresosmensualesemp" style="font-size: 12px; margin-right: 5px" title="Egresos mensuales">
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
		Patrimonio:
		<input type="text" id="patrimonio" name="patrimonio" style="width: 100px" title="Patrimonio">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Re-escribir e-mail:</td>
	<td>
		<input type="text" id="correoelectronico_otro2" name="correoelectronico_otro2" style="width: 230px" onkeypress="return validar_letra(event)" title="E-mail" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'correoelectronico_otro', 'Los e-mails no coinciden por favor validelos.');">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Otros ingresos:</td>
	<td>
		<select id="otrosingresosemp" name="otrosingresosemp" style="font-size: 12px; margin-right: 5px" title="Otros ingresos">
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
		Concepto otros ingresos:
		<input type="text" id="concepto_otrosingresosemp" name="concepto_otrosingresosemp" style="width: 150px" onkeypress="return validar_letra(event)" title="Concepto otros ingresos">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Re-escribir NIT:</td>
	<td>
		<input type="text" id="nit2" name="nit2" style="width: 130px; margin-right: 10px" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'nit', 'El numero de nit no coinciden por favor validelos.');" title="text">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Re-escribir Telefono:</td>
	<td>
		<input type="text" id="telefonoficina2" name="telefonoficina2" style="width: 100px; margin-right: 10px" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'telefonoficina', 'Los telefonos no coinciden por favor validelos.');" maxlength="7" title="text">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Re-escribir Celular:</td>
	<td>
		<input type="text" id="celularoficina2" name="celularoficina2" style="width: 100px; margin-right: 10px" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'celularoficina', 'Los numeros de celular no coinciden, por favor validelos.');" maxlength="10" title="text">
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2"><strong>Idenficacion de los accionistas o asociados</strong></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Hay accionistas?</td>
	<td>
		<select id="si_accionistas_table" name="si_accionistas_table" style="font-size: 12px; margin-right: 15px" title="Hay accionistas">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0" selected>NO</option>
		</select>
	</td>
</tr>
<tr>
	<td colspan="2"><hr></td>
</tr>
<tr>
	<td colspan="2">
		<table id="accionistas_table">
<?php
for($acc = 0; $acc < 5; $acc++){
?>
			<tr>
				<td colspan="2"><strong>Accionista #<?=($acc + 1)?></strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo id:</td>
				<td>
					<select id="tipo_id[<?=$acc?>]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo id" disabled="disabled">
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
					Numero id:
					<input type="text" id="identificacion[<?=$acc?>]" name="identificacion[]" style="width: 130px" onkeypress="return validar_num(event)" title="Numero id" disabled="disabled">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
				<td>
					<input type="text" id="nombre_accionista[<?=$acc?>]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Razon social / nombre" disabled="disabled">
					% Participacion:
					<input type="text" id="porcentaje[<?=$acc?>]" name="porcentaje[]" style="width: 40px" onkeypress="return validar_num(event)" title="% Participacion" disabled="disabled">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
				<td>
					<select id="publico_recursos[<?=$acc?>]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos" disabled="disabled">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Reconocimiento publico?
					<select id="publico_reconocimiento[<?=$acc?>]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" title="Reconocimiento publico" disabled="disabled">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
				<td>
					<select id="publico_expuesta[<?=$acc?>]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" title="Persona expuesta publicamente" disabled="disabled">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Tributarias en otro pais?
					<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[<?=$acc?>]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)" title="Tributarias en otro pais" disabled="disabled">
				</td>
			</tr>
<?php
	if($acc === 0){
?>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir direccion sucursal:</td>
				<td><input type="text" id="direccionsucursal2" name="direccionsucursal2" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion sucursal" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'direccionsucursal', 'Las direcciones de sucursal no coinciden por favor validelos.');"></td>
			</tr>
<?php
	}
?>
			<tr>
				<td colspan="2"><hr></td>
			</tr>
<?php
}
?>
		</table>
	</td>
</tr>
<!-- <tr>
	<td colspan="2"><strong>Accionista #1</strong></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Tipo id:</td>
	<td>
		<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo id">
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
		Numero id:
		<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" onkeypress="return validar_num(event)" title="Numero id">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
	<td>
		<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Razon social / nombre">
		% Participacion:
		<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" onkeypress="return validar_num(event)" title="% Participacion">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
	<td>
		<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Reconocimiento publico?
		<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" title="Reconocimiento publico">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
	<td>
		<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" title="Persona expuesta publicamente">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Tributarias en otro pais?
		<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)" title="Tributarias en otro pais">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Re-escribir direccion sucursal:</td>
	<td><input type="text" id="direccionsucursal2" name="direccionsucursal2" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion sucursal" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'direccionsucursal', 'Las direcciones de sucursal no coinciden por favor validelos.');"></td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2"><strong>Accionista #2</strong></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Tipo id:</td>
	<td>
		<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo id">
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
		Numero id:
		<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" onkeypress="return validar_num(event)" title="Numero id">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
	<td>
		<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Razon social / nombre">
		% Participacion:
		<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" onkeypress="return validar_num(event)" title="% Participacion">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
	<td>
		<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Reconocimiento publico?
		<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" title="Reconocimiento publico">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
	<td>
		<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" title="Persona expuesta publicamente">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Tributarias en otro pais?
		<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)" title="Tributarias en otro pais">
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2"><strong>Accionista #3</strong></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Tipo id:</td>
	<td>
		<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" onkeypress="return validar_num(event)" title="Tipo id">
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
		Numero id:
		<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" title="Numero id">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
	<td>
		<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Razon social / nombre">
		% Participacion:
		<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" onkeypress="return validar_num(event)" title="% Participacion">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
	<td>
		<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Reconocimiento publico?
		<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" title="Reconocimiento publico">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
	<td>
		<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" title="Persona expuesta publicamente">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Tributarias en otro pais?
		<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)" title="Tributarias en otro pais">
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2"><strong>Accionista #4</strong></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Tipo id:</td>
	<td>
		<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo id">
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
		Numero id:
		<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" onkeypress="return validar_num(event)" title="Numero id">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
	<td>
		<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Razon social / nombre">
		% Participacion:
		<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" onkeypress="return validar_num(event)" title="% Participacion">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
	<td>
		<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Reconocimiento publico?
		<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" title="Reconocimiento publico">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
	<td>
		<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" title="Persona expuesta publicamente">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Tributarias en otro pais?
		<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)" title="Tributarias en otro pais">
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2"><strong>Accionista #5</strong></td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Tipo id:</td>
	<td>
		<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" title="Tipo id">
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
		Numero id:
		<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" onkeypress="return validar_num(event)" title="Numero id">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
	<td>
		<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Razon social / nombre">
		% Participacion:
		<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" onkeypress="return validar_num(event)" title="% Participacion">
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
	<td>
		<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Reconocimiento publico?
		<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" title="Reconocimiento publico">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
	</td>
</tr>
<tr>
	<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
	<td>
		<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" title="Persona expuesta publicamente">
			<option value="">Seleccion...</option>
			<option value="-1">SI</option>
			<option value="0">NO</option>
			<option value="2">SD</option>
		</select>
		Tributarias en otro pais?
		<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)" title="Tributarias en otro pais">
	</td>
</tr> -->