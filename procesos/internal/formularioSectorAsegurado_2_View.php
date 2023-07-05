<table style="width: 491px; max-width: 491px;">
	<tr>
		<td style="width: 100px;display: table-cell;">Residencia fiscal sociedad:</td>
		<td>
			<select id="residencia_sociedad" name="residencia_sociedad" style="font-size: 12px" title="Residencia fiscal sociedad">
				<option value="">Seleccione</option>
				<option value="NACIONAL">NACIONAL</option>
				<option value="EXTRANJERA">EXTRANJERA</option>
				<option value="SD">SD</option>
			</select>
		</td>
	</tr>
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>DATOS B&Aacute;SICOS DE LA EMPRESA</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombre o razon social:</td>
		<td><input type="text" id="razonsocial" name="razonsocial" style="width: 280px" onkeypress="return validar_letra(event)" title="Nombre de la empresa"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">NIT:</td>
		<td>
			<input type="text" id="nit" name="nit" style="width: 130px; margin-right: 10px" title="NIT" onblur="$(this).ocultarEsteCampo(event);" onkeypress="return validar_num(event)">
			DIV:
			<input type="text" id="digitochequeo" name="digitochequeo" style="width: 80px; margin-left: 10px" title="DIV" onkeypress="return validar_num(event)">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Direccion oficina principal:</td>
		<td><input type="text" id="direccionoficinappal" name="direccionoficinappal" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion oficina principal"></td>
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
		<td style="width: 100px;display: table-cell;">Sector:</td>
		<td>
			<input type="text" id="detalleactividadeconomicappal" name="detalleactividadeconomicappal" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Actividad economica">
		</td>
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
			<input type="text" id="telefonoficina" name="telefonoficina" style="width: 100px; margin-right: 10px" onchange="$(this).checkTamanoTele(event, 7);" maxlength="7" title="Telefono" onkeypress="return validar_num(event)">
			E-mail:
			<input type="text" id="correoelectronico" name="correoelectronico" style="width: 230px" onkeypress="return validar_letra(event)" title="E-mail">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Administra recursos publicos?</td>
		<td>
			<select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos"><!--agregar campo llamado recursos_publicos-->
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
			Persona expuesta politicamente?
			<select id="expuesta_politica" name="expuesta_politica" style="font-size: 12px; margin-right: 15px" title="Persona expuesta politicamente">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Familiar de expuesto politico?</td>
		<td>
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
		<td style="width: 100px;display: table-cell;">Tributarias en otro pais?</td>
		<td>
			<select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px" title="Tributarias en otro pais">
				<option value="">Seleccion...</option>
				<option value="-1">SI</option>
				<option value="0">NO</option>
				<option value="2">SD</option>
			</select>
			Cuales?: 
			<input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" disabled onkeypress="return validar_letra(event)" title="Cuales tributarias en otro pais">
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
	<tr>
		<td style="width: 100px;display: table-cell;">Activos:</td>
		<td>
			<input type="text" id="activosemp" name="activosemp" style="width: 100px; margin-right: 20px" onkeypress="return validar_num(event)" title="Activos">
			Ingresos mensuales:
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
		<td style="width: 100px;display: table-cell;">Pasivos:</td>
		<td>
			<input type="text" id="pasivosemp" name="pasivosemp" style="width: 100px" onkeypress="return validar_num(event)" title="Pasivos">
			Otros ingresos:
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
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Patrimonio:</td>
		<td>
			<input type="text" id="patrimonio" name="patrimonio" style="width: 100px" title="Patrimonio" onkeypress="return validar_num(event)">
			Egresos mensuales:
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
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Concepto otros ingresos:</td>
		<td>
			<input type="text" id="concepto_otrosingresosemp" name="concepto_otrosingresosemp" style="width: 350px" onkeypress="return validar_letra(event)" title="Concepto otros ingresos">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Origen de fondos:</td>
		<td>
			<input type="text" id="origen_fondos" name="origen_fondos" style="width: 360px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Origen de fondos">
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
		<td style="width: 100px;display: table-cell;">Cual:</td>
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
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>DATOS B&Aacute;SICOS DEL REPRESENTANTE LEGAL</strong></td>
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
		<td style="width: 100px;display: table-cell;">Tipo identificacion:</td>
		<td>
			<select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px" title="Tipo identificacion">
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
			Numero identificacion:&nbsp;<input type="text" id="documento" name="documento" style="width: 130px; display: initial;" title="Numero identificacion">
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
		<td style="width: 100px;display: table-cell;">País:</td>
		<td>
			<select id="nacionalidad" name="nacionalidad" style="font-size: 12px" title="País">
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
		<td style="width: 100px;display: table-cell;">Telefono:</td>
		<td>
			<input type="text" id="telefonoresidencia" name="telefonoresidencia" style="width: 130px; margin-right: 40px" maxlength="7" onchange="$(this).checkTamanoTele(event, 7);" onkeypress="return validar_num(event)" title="Telefono">
			Celular:
			<input type="text" id="celular" name="celular" style="width: 130px" maxlength="10" onchange="$(this).checkTamanoTele(event, 10);" onkeypress="return validar_num(event)" title="Celular">
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2"><strong>ACCIONISTAS</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Hay accionistas?</td>
		<td>
			<select id="si_accionistas_nat" name="si_accionistas_nat" style="font-size: 12px; margin-right: 15px" title="Hay accionistas">
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
			<table id="accionistas_nat_table">
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
					<td style="width: 100px;display: table-cell;">Nombres y apellidos</td>
					<td>
						<input type="text" id="nombre_accionista[<?=$acc?>]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Razon social / nombre" disabled="disabled">
						% Participacion:
						<input type="text" id="porcentaje[<?=$acc?>]" name="porcentaje[]" style="width: 40px" onkeypress="return validar_num(event)" title="% Participacion" disabled="disabled">
					</td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Incluido en el RNVE?</td>
					<td>
						<select id="publico_reconocimiento[<?=$acc?>]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" title="Reconocimiento publico" disabled="disabled">
							<option value="">Seleccion...</option>
							<option value="-1">SI</option>
							<option value="0">NO</option>
							<option value="2">SD</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width: 100px;display: table-cell;">Persona expuesta politicamente?</td>
					<td>
						<select id="publico_expuesta[<?=$acc?>]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" title="Persona expuesta politicamente" disabled="disabled">
							<option value="">Seleccion...</option>
							<option value="-1">SI</option>
							<option value="0">NO</option>
							<option value="2">SD</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
<?php
}
?>
			</table>
		</td>
	</tr>
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
		<td colspan="2" align="left"><hr></td>
	</tr>
	<tr>
	<td colspan="2" align="left">
	<table id="junta_directiva" width="100%">
<?php
for($jun = 0; $jun < 5; $jun++){
?>
	<tr>
		<td colspan="2" align="left"><strong>Miembro(<?=($jun + 1)?>)</strong></td>
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
		<td style="width: 100px;display: table-cell;">Nombres y apellidos:</td>
		<td><input type="text" id="ju_nombre_completo[<?=$jun?>]" name="ju_nombre_completo[]" style="width: 240px" onkeypress="return validar_letra(event)" title="Nombres y apellidos(Miembro <?=($jun + 1)?>)" disabled="disabled"></td>
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
</table>