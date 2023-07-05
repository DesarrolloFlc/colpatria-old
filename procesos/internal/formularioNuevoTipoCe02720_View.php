<input type="hidden" name="formulario" id="formulario" value="19">
<table>
	<tr>
		<td>
		<table>
			<tr>
				<td style="width: 80px">Fecha de radicado: </td>
				<td>
					<select id="f_rad_a" name="f_rad_a" onchange="$(this).verificarFecha(event, 'rad', '1');" style="font-size: 12px" title="Año de fecha de radicado">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_rad_m" name="f_rad_m" onchange="$(this).verificarFecha(event, 'rad', '1');" style="font-size: 12px" title="Mes de fecha de radicado">
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
					<select id="f_rad_d" name="f_rad_d" style="font-size: 12px" title="Dia de fecha de radicado">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Fecha de diligenciamiento:</td>
				<td>
					<select id="f_dil_a" name="f_dil_a" onchange="$(this).verificarFecha(event, 'dil', '1');" style="font-size: 12px" title="Año de fecha de diligenciamiento">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_dil_m" name="f_dil_m" onchange="$(this).verificarFecha(event, 'dil', '1');" style="font-size: 12px" title="Mes de fecha de diligenciamiento">
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
					<select id="f_dil_d" name="f_dil_d" onblur="$(this).verificarFechaDoble(event, 'dil', '1');" style="font-size: 12px" title="Dia de fecha de diligenciamiento">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<input type="hidden" name="ciudad" value="99999">
			<input type="hidden" name="sucursal" value="<?=(isset($radInfo['id_sucursal'])) ? $radInfo['id_sucursal'] : '0'?>">
			<input type="hidden" name="area" value="<?=(isset($radInfo['id_sucursal'])) ? $radInfo['id_sucursal'] : '2653'?>">
			<input type="hidden" name="id_official" value="<?=(isset($radInfo['oficial_nombre'])) ? $radInfo['oficial_nombre'] : '0'?>">
			<tr>
				<td>Tipo de solicitud:</td>
				<td>
					<select id="tipo_solicitud" name="tipo_solicitud" title="Tipo de solicitud">
						<option value="">Seleccion...</option>
						<option value="VINCULACION">Vinculacion</option>
						<option value="ACTUALIZACION">Actualizacion</option>
						<option value="SD">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Clase vinculacion:</td>
				<td>
					<select id="clasecliente" name="clasecliente" style="font-size: 12px; margin-right: 5px" title="Clase vinculacion">
						<option value="">Seleccione...</option>
<?php
if(isset($clasesVinculacion) && !empty($clasesVinculacion) && is_array($clasesVinculacion)){
	foreach($clasesVinculacion as $clase){
?>
						<option value="<?=$clase['id']?>"><?=$clase['description']?></option>
<?php
	}
}
?>
					</select>
					Cual?
					<input type="text" id="cual_clasecliente" name="cual_clasecliente" style="width: 130px;" onkeypress="return validar_letra(event)" disabled title="Cual clase vinculacion">
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
<?php
require_once PATH_INTERNAL.DS.$request['action'].'_'.$request['tipo_persona'].'_'.'View.php';
?>
		</td>
	</tr>
	<tr>
		<td>
		<table id="table_parte1" width="491">
			<tr style="background-color: #cabbf7; color: #00e;">
				<td colspan="2" align="center"><strong>INFORMACI&Oacute;N PERSONA EXPUESTAMENTE POL&Iacute;TICAMENTE (PEP) DEL <?=($request['tipo_persona'] == '1') ? 'TOMADOR' : 'REPRESENTANTE LEGAL'?></strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta politicamente?</td>
				<td>
					<select id="pep_expuesto" name="pep_expuesto" style="font-size: 12px; margin-right: 15px" title="Persona expuesta politicamente">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					<input type="hidden" id="cargo_politica" name="cargo_politica" value="SD">
				</td>
			</tr>
<?php
if($request['tipo_persona'] == '2'){
?>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Celular:</td>
				<td>
					<input type="text" id="celularoficina2" name="celularoficina2" style="width: 100px; margin-right: 10px" onchange="$(this).checkTamanoTele(event, 10);" maxlength="10" title="Celular" onkeypress="return validar_num(event)" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'celularoficina', 'Los numeros de celular no coinciden, por favor validelos.');">
				</td>
			</tr>
<?php
}
?>
			<tr>
				<td style="width: 100px;display: table-cell;">Expuesto politico extranjero?</td>
				<td>
					<select id="expuesta_extrangero" name="expuesta_extrangero" style="font-size: 12px; margin-right: 15px" title="Expuesto politico extranjero">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Expuesto politico internacional?
					<select id="expuesta_internacional" name="expuesta_internacional" style="font-size: 12px; margin-left: 10px" title="Expuesto politico internacional">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
<?php
if($request['tipo_persona'] == '2'){
?>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Telefono:</td>
				<td>
					<input type="text" id="telefonoficina2" name="telefonoficina2" style="width: 100px; margin-right: 10px" onchange="$(this).checkTamanoTele(event, 7);" maxlength="7" title="Telefono" onkeypress="return validar_num(event)" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'telefonoficina', 'Los telefonos no coinciden por favor validelos.');">
				</td>
			</tr>
<?php
}
?>
			<tr>
				<td style="width: 100px;display: table-cell;">Conyuge de expuesto politico?</td>
				<td>
					<select id="conyuge_expuesto" name="conyuge_expuesto" style="font-size: 12px; margin-right: 15px" title="Conyuge de expuesto politico">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Asociado expuesto politico?
					<select id="asociado_expuesto" name="asociado_expuesto" style="font-size: 12px; margin-left: 10px" title="Asociado expuesto politico">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Re-escribir fecha de diligenciamiento:</td>
				<td>
					<select id="f_dil2_a" name="f_dil2_a" onchange="$(this).verificarFecha(event, 'dil2', '1');" style="font-size: 12px" title="text">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_dil2_m" name="f_dil2_m" onchange="$(this).verificarFecha(event, 'dil2', '1');" style="font-size: 12px" title="text">
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
					<select id="f_dil2_d" name="f_dil2_d" onblur="$(this).verificarFechaDoble(event, 'dil', '2');" style="font-size: 12px" title="text">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Familiar de expuesto politico?</td>
				<td>
					<select id="pep_familiar" name="pep_familiar" style="font-size: 12px; margin-right: 5px" title="Familiar de expuesto politico">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Nombre: 
					<input type="text" id="pep_familia_nombre" name="pep_familia_nombre" style="width: 100px" disabled onkeypress="return validar_letra(event)" title="Nombre">
					Cargo: 
					<input type="text" id="pep_familia_cargo" name="pep_familia_cargo" style="width: 100px" disabled onkeypress="return validar_letra(event)" title="Cargo">
				</td>
			</tr>
			<tr>
				<td>Re-escribir Tipo persona:</td>
				<td>
					<select id="tipopersona2" name="tipopersona2" onblur="$(this).revisarTipoPersona(event);">
						<option value="">-- Seleccione una opción --</option>
						<option value="1">Natural</option>
						<option value="2">Juridica</option>
					</select>
				</td>
			</tr>
			<input type="hidden" id="repre_internacional" name="repre_internacional" value="2">
			<input type="hidden" id="internacional_indique" name="internacional_indique" value="SD">
		</table>
		</td>
	</tr>
	<tr>
		<td>
<?php
require_once PATH_INTERNAL.DS.$request['action'].'_Economica_'.$request['tipo_persona'].'_'.'View.php';
?>
		</td>
	</tr>
	<tr>
		<td>
<?php
require_once PATH_INTERNAL.DS.$request['action'].'_Beneficiarios_View.php';
?>
		</td>
	</tr>
	<tr>
		<td>
		<table width="491">
			<tr style="background-color: #cabbf7; color: #00e;">
				<td colspan="2" align="center"><strong>DECLARACIONES Y AUTORIZACIONES</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Fuente de origen de fondos</td>
				<td>
					<input type="text" id="origen_fondos" name="origen_fondos" style="width: 160px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Fuente de origen de fondos">
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<input type="hidden" id="monedaextranjera" name="monedaextranjera" value="2">
	<input type="hidden" id="tipotransacciones" name="tipotransacciones" value="8">
	<input type="hidden" id="tipotransacciones_cual" name="tipotransacciones_cual" value="SD">
	<input type="hidden" id="otras_operaciones" name="otras_operaciones" value="SD">
	<input type="hidden" id="productos_exterior" name="productos_exterior" value="2">
	<input type="hidden" id="cuentas_monedaextranjera" name="cuentas_monedaextranjera" value="2">
	<input type="hidden" id="reclamaciones" name="reclamaciones" value="2">
	<input type="hidden" id="auto_correo" name="auto_correo" value="2">
	<input type="hidden" id="auto_sms" name="auto_sms" value="2">
	<tr>
		<td>
		<table width="491">
			<tr style="background-color: #cabbf7; color: #00e;">
				<td colspan="2" align="center"><strong>AUTORIZACI&Oacute;N DE TRATAMIENTO DE DATOS PERSONALES</strong></td>
			</tr>
			<input type="hidden" id="lugarentrevista" name="lugarentrevista" value="SD">
			<input type="hidden" id="resultadoentrevista" name="resultadoentrevista" value="SD">
			<tr>
				<td style="width: 100px;display: table-cell;">Observaciones:</td>
				<td>
					<textarea cols="40" rows="4" id="observacionesentrevista" name="observacionesentrevista" onkeypress="return validar_letra(event)" title="Observaciones"></textarea>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre Intermediario / Asesor / Entrevistador:</td>
				<td>
					<input type="text" id="nombreintermediario" name="nombreintermediario" style="width: 190px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Nombre Intermediario / Asesor / Entrevistador">
					<input type="hidden" id="clave_inter" name="clave_inter" value="0">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre de verificador:</td>
				<td>
					<input type="text" id="verificacion_nombre" name="verificacion_nombre" style="width: 230px; margin-right: 5px" onkeypress="return validar_letra(event)" title="Nombre de verificador">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Cargo:</td>
				<td>
					<input type="text" id="verificacion_cargo" name="verificacion_cargo" style="width: 230px; margin-right: 5px" onkeypress="return validar_letra(event)" title="Cargo de verificador">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Numero de cedula:</td>
				<td>
					<input type="text" id="verificacion_documento" name="verificacion_documento" style="width: 230px; margin-right: 5px" onkeypress="return validar_num(event)" title="Documento de verificador">
				</td>
			</tr>
			<input type="hidden" id="firma_entrevista" name="firma_entrevista" value="2">
		</table>
		</td>
	</tr>
	<input type="hidden" id="verificacion_ciudad" name="verificacion_ciudad" value="99999">
	<input type="hidden" id="verificacion_observacion" name="verificacion_observacion" value="SD">
	<input type="hidden" id="verificacion_firma" name="verificacion_firma" value="2">
	<input type="hidden" id="huella" name="huella" value="2">
	<tr>
		<td>
		<table width="491">
			<tr style="background-color: #cabbf7; color: #00e;">
				<td colspan="2" align="center"><strong>DOCUMENTOS REQUERIDOS</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Firma:</td>
				<td>
					<select id="firma" name="firma" style="font-size: 12px; margin-right: 20px" title="Firma">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
	    <td align="left" style="padding-left: 10px;">
	    	<!-- <input type="submit" value="Crear formulario" id="button_form_fingering"> -->
			<button type="submit" id="button_form_fingering" style="padding: 5px;">Crear formulario</button>
	    </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<script type="text/javascript">
$(document).ready(function(){
<?php
$dat = (isset($radInfo['fecha_creacion']) && !is_null($radInfo['fecha_creacion'])) ? explode('-', date('Y-m-d', strtotime($radInfo['fecha_creacion']))) : [];
if(isset($dat[0]) && !empty($dat[0]))
	echo '$(\'select[name="f_rad_a"]\').val(\''.$dat[0].'\').change();';
if(isset($dat[1]) && !empty($dat[1]))
	echo '$(\'select[name="f_rad_m"]\').val(\''.$dat[1].'\').change();';
if(isset($dat[2]) && !empty($dat[2]))
	echo '$(\'select[name="f_rad_d"]\').val(\''.$dat[2].'\').change();';
?>
	setTimeout(function() { $('select[name="f_rad_a"]').focus(); }, 1);
	$('select[name="clasecliente"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '10'){
			$('input[name="cual_clasecliente"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="cual_clasecliente"]').val('').attr('disabled', true);
		}
	});
	$('select[name="reconocimiento_publico"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="reconocimiento_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="reconocimiento_cual"]').val('').attr('disabled', true);
		}
	});
	$('select[name="expuesta_publica"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="publica_nombre"]').removeAttr('disabled');
			$('input[name="publica_cargo"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="publica_nombre"]').val('').attr('disabled', true);
			$('input[name="publica_cargo"]').val('').attr('disabled', true);
		}
	});
	$('select[name="tributarias_otro_pais"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="tributarias_paises"]').removeAttr('disabled');
		}else{
			$('input[name="tributarias_paises"]').val('').attr('disabled', true);
		}
	});
	$('select[name^="otrosingresos"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '13'){
			$('input[name^="concepto"]').val('SD');
		}else{
			$('input[name^="concepto"]').val('');
		}
	});
	$('select[name="si_beneficiarios_nat"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){//"input[name^=load_file]"
			$('table#beneficiarios_nat_table input[name^="be_nombre_completo"]').removeAttr('disabled');
			$('table#beneficiarios_nat_table select[name^="be_tipodocumento_id"]').removeAttr('disabled');
			$('table#beneficiarios_nat_table input[name^="be_identificacion"]').removeAttr('disabled');
			$('table#beneficiarios_nat_table select[name^="f_expbe_a"]').removeAttr('disabled');
			$('table#beneficiarios_nat_table select[name^="f_expbe_m"]').removeAttr('disabled');
			$('table#beneficiarios_nat_table select[name^="f_expbe_d"]').removeAttr('disabled');
			$('table#beneficiarios_nat_table select[name^="be_expuesto_politico"]').removeAttr('disabled');
			$('table#beneficiarios_nat_table select[name^="be_poliza_seguro"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('table#beneficiarios_nat_table input[name^="be_nombre_completo"]').val('').attr('disabled', true);
			$('table#beneficiarios_nat_table select[name^="be_tipodocumento_id"]').val('').change().attr('disabled', true);
			$('table#beneficiarios_nat_table input[name^="be_identificacion"]').val('').attr('disabled', true);
			$('table#beneficiarios_nat_table select[name^="f_expbe_a"]').val('').change().attr('disabled', true);
			$('table#beneficiarios_nat_table select[name^="f_expbe_m"]').val('').change().attr('disabled', true);
			$('table#beneficiarios_nat_table select[name^="f_expbe_d"]').val('').change().attr('disabled', true);
			$('table#beneficiarios_nat_table select[name^="be_expuesto_politico"]').val('').change().attr('disabled', true);
			$('table#beneficiarios_nat_table select[name^="be_poliza_seguro"]').val('').change().attr('disabled', true);
		}
	});
	$('select[name="si_beneficiarios_jur"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){//"input[name^=load_file]"
			$('table#beneficiarios_jur_table input[name^="be_razon_social"]').removeAttr('disabled');
			$('table#beneficiarios_jur_table input[name^="be_nit"]').removeAttr('disabled');
			$('table#beneficiarios_jur_table input[name^="be_nombre_completo"]').removeAttr('disabled');
			$('table#beneficiarios_jur_table select[name^="be_tipodocumento_id"]').removeAttr('disabled');
			$('table#beneficiarios_jur_table input[name^="be_identificacion"]').removeAttr('disabled');
			$('table#beneficiarios_jur_table select[name^="be_poliza_seguro"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('table#beneficiarios_jur_table input[name^="be_razon_social"]').val('').attr('disabled', true);
			$('table#beneficiarios_jur_table input[name^="be_nit"]').val('').attr('disabled', true);
			$('table#beneficiarios_jur_table input[name^="be_nombre_completo"]').val('').attr('disabled', true);
			$('table#beneficiarios_jur_table select[name^="be_tipodocumento_id"]').val('').change().attr('disabled', true);
			$('table#beneficiarios_jur_table input[name^="be_identificacion"]').val('').attr('disabled', true);
			$('table#beneficiarios_jur_table select[name^="be_poliza_seguro"]').val('').change().attr('disabled', true);
		}
	});
	$('select[name="si_junta_directiva"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){//"input[name^=load_file]"
			$('table#junta_directiva input[name^="ju_nombre_completo"]').removeAttr('disabled');
			$('table#junta_directiva select[name^="ju_tipodocumento_id"]').removeAttr('disabled');
			$('table#junta_directiva input[name^="ju_identificacion"]').removeAttr('disabled');
			$('table#junta_directiva select[name^="ju_expuesto_politico"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('table#junta_directiva input[name^="ju_nombre_completo"]').val('').attr('disabled', true);
			$('table#junta_directiva select[name^="ju_tipodocumento_id"]').val('').change().attr('disabled', true);
			$('table#junta_directiva input[name^="ju_identificacion"]').val('').attr('disabled', true);
			$('table#junta_directiva select[name^="ju_expuesto_politico"]').val('').change().attr('disabled', true);
		}
	});
	$('select[name="si_accionistas_nat"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){//"input[name^=load_file]"
			$('table#accionistas_nat_table input[name^="be_nombre_completo"]').removeAttr('disabled');
			$('table#accionistas_nat_table select[name^="be_tipodocumento_id"]').removeAttr('disabled');
			$('table#accionistas_nat_table input[name^="be_identificacion"]').removeAttr('disabled');
			$('table#accionistas_nat_table select[name^="f_expac_a"]').removeAttr('disabled');
			$('table#accionistas_nat_table select[name^="f_expac_m"]').removeAttr('disabled');
			$('table#accionistas_nat_table select[name^="f_expac_d"]').removeAttr('disabled');
			$('table#accionistas_nat_table select[name^="be_expuesto_politico"]').removeAttr('disabled');
			$('table#accionistas_nat_table select[name^="be_poliza_seguro"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('table#accionistas_nat_table input[name^="be_nombre_completo"]').val('').attr('disabled', true);
			$('table#accionistas_nat_table select[name^="be_tipodocumento_id"]').val('').change().attr('disabled', true);
			$('table#accionistas_nat_table input[name^="be_identificacion"]').val('').attr('disabled', true);
			$('table#accionistas_nat_table select[name^="f_expac_a"]').val('').change().attr('disabled', true);
			$('table#accionistas_nat_table select[name^="f_expac_m"]').val('').change().attr('disabled', true);
			$('table#accionistas_nat_table select[name^="f_expac_d"]').val('').change().attr('disabled', true);
			$('table#accionistas_nat_table select[name^="be_expuesto_politico"]').val('').change().attr('disabled', true);
			$('table#accionistas_nat_table select[name^="be_poliza_seguro"]').val('').change().attr('disabled', true);
		}
	});
	$('select[name="si_accionistas_jur"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){//"input[name^=load_file]"
			$('table#accionistas_jur_table input[name^="be_razon_social"]').removeAttr('disabled');
			$('table#accionistas_jur_table input[name^="be_nit"]').removeAttr('disabled');
			$('table#accionistas_jur_table input[name^="be_nombre_completo"]').removeAttr('disabled');
			$('table#accionistas_jur_table select[name^="be_tipodocumento_id"]').removeAttr('disabled');
			$('table#accionistas_jur_table input[name^="be_identificacion"]').removeAttr('disabled');
			$('table#accionistas_jur_table select[name^="be_expuesto_politico"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('table#accionistas_jur_table input[name^="be_razon_social"]').val('').attr('disabled', true);
			$('table#accionistas_jur_table input[name^="be_nit"]').val('').attr('disabled', true);
			$('table#accionistas_jur_table input[name^="be_nombre_completo"]').val('').attr('disabled', true);
			$('table#accionistas_jur_table select[name^="be_tipodocumento_id"]').val('').change().attr('disabled', true);
			$('table#accionistas_jur_table input[name^="be_identificacion"]').val('').attr('disabled', true);
			$('table#accionistas_jur_table select[name^="be_expuesto_politico"]').val('').change().attr('disabled', true);
		}
	});
	$('select[name="pep_familiar"]').change(function(event) {
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="pep_familia_nombre"]').removeAttr('disabled');
			$('input[name="pep_familia_cargo"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="pep_familia_nombre"]').val('').attr('disabled', true);
			$('input[name="pep_familia_cargo"]').val('').attr('disabled', true);
		}
	});
	$('form#form_fingering').submit(function(event) {
		/* Act on the event */
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		//window.location.href = 'fingering.php';
		//alert('Se envio bien');
		/*if($(this).find('select[name="f_rad_a"]').val() == ''){
			alert('Por favor seleccione el año de radicacion');
			$(this).find('select[name="f_rad_a"]').focus();
			return false;
		}
		if($(this).find('select[name="f_rad_m"]').val() == ''){
			alert('Por favor seleccione el mes de radicacion');
			$(this).find('select[name="f_rad_m"]').focus();
			return false;
		}
		if($(this).find('select[name="f_rad_d"]').val() == ''){
			alert('Por favor seleccione el dia de radicacion');
			$(this).find('select[name="f_rad_d"]').focus();
			return false;
		}
		if($(this).find('select[name="f_dil_a"]').val() == ''){
			alert('Por favor seleccione el año de diligenciamiento');
			$(this).find('select[name="f_dil_a"]').focus();
			return false;
		}
		if($(this).find('select[name="f_dil_m"]').val() == ''){
			alert('Por favor seleccione el mes de diligenciamiento');
			$(this).find('select[name="f_dil_m"]').focus();
			return false;
		}
		if($(this).find('select[name="f_dil_d"]').val() == ''){
			alert('Por favor seleccione el dia de diligenciamiento');
			$(this).find('select[name="f_dil_d"]').focus();
			return false;
		}
		if($(this).find('select[name="sucursal"]').val() == ''){
			alert('Por favor seleccione una sucursal');
			$(this).find('select[name="sucursal"]').focus();
			return false;
		}
		if($(this).find('select[name="clasecliente"]').val() == ''){
			alert('Por favor seleccione una clase de vinculacion');
			$(this).find('select[name="clasecliente"]').focus();
			return false;
		}else if($(this).find('select[name="clasecliente"]').val() == '10' && $(this).find('input[name="cual_clasecliente"]').val() == ''){
			alert('Debe digitar cual clase de vinculacion.');
			$(this).find('input[name="cual_clasecliente"]').focus();
			return false;
		}
		if ($(this).find('select[name="tipopersona"]').val() == "1") {
			if ($(this).find('input[name="nombres"]').val() == '') {
				alert('Por favor digite el nombre del cliente');
				$(this).find('input[name="nombres"]').focus();
				return false;
			} else if ($(this).find('input[name="nombres"]').val() == 'SD' || $(this).find('input[name="nombres"]').val() == 'NA') {
				alert('Por favor digite nombre de cliente valido, no puede ser SD ni NA.');
				$(this).find('input[name="nombres"]').focus();
				return false;
			}
			if ($(this).find('select[name="tipodocumento"]').val() == '') {
				alert('Por favor seleccione el tipo de documento del cliente');
				$(this).find('select[name="tipodocumento"]').focus();
				return false;
			}
			if ($(this).find('input[name="documento"]').val() == '') {
				alert("Por favor digite el numero de documento.");
				$(this).find('input[name="documento"]').css('background-color', 'red');
				$(this).find('input[name="documento"]').focus();
				return false;
			}else if ($(this).find('input[name="documento"]').val() != $(this).find('input[name="documento2"]').val()) {
				alert("El No. de documento no coincide.");
				$(this).find('input[name="documento"]').css('background-color', 'red');
				return false;
			}
			//FECHAEXPEDICION
			if ($(this).find('select[name="f_exp_a"]').val() == '') {
				alert('Por favor seleccione el año de expedicion');
				$(this).find('select[name="f_exp_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="f_exp_m"]').val() == '') {
				alert('Por favor seleccione el mes de expedicion');
				$(this).find('select[name="f_exp_m"]').focus();
				return false;
			}
			if ($(this).find('select[name="f_exp_d"]').val() == '') {
				alert('Por favor seleccione el dia de expedicion');
				$(this).find('select[name="f_exp_d"]').focus();
				return false;
			}
			if ($(this).find('select[name="lugarexpedicion"]').val() == '') {
				alert('Por favor seleccione lugar de expedicion');
				$(this).find('#lugarexpedicion').focus();
				return false;
			}
			//FECHANACIMIENTO
			if ($(this).find('select[name="f_nac_a"]').val() == '') {
				alert('Por favor seleccione el año de nacimiento');
				$(this).find('select[name="f_nac_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="f_nac_m"]').val() == '') {
				alert('Por favor seleccione el mes de nacimiento');
				$(this).find('select[name="f_nac_m"]').focus();
				return false;
			}
			if ($(this).find('select[name="f_nac_d"]').val() == '') {
				alert('Por favor seleccione el dia de nacimiento');
				$(this).find('select[name="f_nac_d"]').focus();
				return false;
			}
			//Confirmar que la fecha de expedicion sea mayor a la de nacimiento
			var dif_anos = parseInt($(this).find('select[name="f_exp_a"]').val()) - parseInt($(this).find('select[name="f_nac_a"]').val());
			if (dif_anos < 10) {
				alert('Por favor seleccione el año de expedicion valido, este no puede ser menor a la fecha de nacimiento y tampoco la diferencia entre estos puede ser menor a 10 años de edad');
				$(this).find('select[name="f_exp_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="paisnacimiento"]').val() == '') {
				alert('Por favor seleccione nacionalidad.');
				$(this).find('select[name="paisnacimiento"]').focus();
				return false;
			}
			if ($(this).find('input[name="correoelectronico"]').val() != "" && $(this).find('input[name="correoelectronico"]').val() != "SD") {
				var status = false;
				var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
				if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
					alert("Por favor ingrese un mail valido.");
					$(this).find('input[name="correoelectronico"]').css('background-color', 'red');
					return false;
				}
			}
			if ($(this).find('select[name="ciudadresidencia"]').val() == '') {
				alert('Por favor seleccione una ciudad de residencia.');
				$(this).find('select[name="ciudadresidencia"]').focus();
				return false;
			}
			if ($(this).find('input[name="nombreempresa"]').val() == '') {
				if ($(this).find('#tipoactividad').val() == '1' || $(this).find('#tipoactividad').val() != '2') {
					alert('Por favor digite el nombre de la empresa donde trabaja.');
					$(this).find('input[name="nombreempresa"]').focus();
					return false;
				}
			}
			/*if ($(this).find('input[name="actividadeconomicaempresa"]').val() == '') {
				alert('Por favor digite actividad economica.');
				$(this).find('input[name="actividadeconomicaempresa"]').focus();
				return false;
			}*/
			/*if ($(this).find('select[name="tipoactividad"]').val() == '') {
				alert('Por favor seleccione el tipo de actividad.');
				$(this).find('select[name="tipoactividad"]').focus();
				return false;
			}
			if ($(this).find('select[name="profesion"]').val() == "" || $(this).find('select[name="profesion"]').val() == "0") {
				alert("El campo de profesion no puede estar vacío.");
				$(this).find('select[name="profesion"]').focus();
				return false;
			}
			if ($(this).find('input[name="cargo"]').val() == "") {
				alert("El campo de cargo no puede estar vacío.");
				$(this).find('input[name="cargo"]').focus();
				return false;
			}
			if ($(this).find('select[name="ingresosmensuales"]').val() == "") {
				if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
					alert('Por favor seleccione ingresos mensuales.');
					$(this).find('select[name="ingresosmensuales"]').focus();
					return false;
				}
			}
			if ($(this).find('input[name="totalactivos"]').val() == "") {
				if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
					alert('Por favor digite el total activos.');
					$(this).find('input[name="totalactivos"]').focus();
					return false;
				}
			}
			if ($(this).find('input[name="totalpasivos"]').val() == "") {
				if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
					alert('Por favor digite el total pasivos.');
					$(this).find('input[name="totalpasivos"]').focus();
					return false;
				}
			}
			if ($(this).find('select[name="egresosmensuales"]').val() == "") {
				if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
					alert('Por favor seleccione egresos mensuales.');
					$(this).find('select[name="egresosmensuales"]').focus();
					return false;
				}
			}
			if ($(this).find('select[name="otrosingresos"]').val() == "") {
				alert('Por favor seleccione otros ingresos.');
				$(this).find('select[name="otrosingresos"]').focus();
				return false;
			}
			if ($(this).find('input[name="conceptosotrosingresos"]').val() == "") {
				alert('El campo de concepto de otros ingresos no puede ir vacio, por favor digitelo.');
				$(this).find('input[name="conceptosotrosingresos"]').focus();
				return false;
			}
			if ($(this).find('input[name="telefonoresidencia"]').val() == '' && $(this).find('input[name="celular"]').val() == '' && $(this).find('input[name="telefonolaboral"]').val() == '' && $(this).find('input[name="celularoficinappal"]').val() == '' && $(this).find('input[name="telefonoficinappal"]').val() == '') {
				alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
				$(this).find('input[name="telefonoresidencia"]').focus();
				return false;
			}
		}else if ($(this).find('select[name="tipopersona"]').val() == "2") {
			if ($(this).find('input[name="nit"]').val() != $(this).find('input[name="nit2"]').val()) {
				alert("El No. de NIT no coincide.");
				$(this).find('input[name="nit"]').css('background-color', 'red');
				return false;
			}
			if ($(this).find('select[name="tipoempresajur"]').val() == '') {
				alert('Por favor seleccione el tipo de empresa.');
				$(this).find('select[name="tipoempresajur"]').focus();
				return false;
			}
			if ($(this).find('input[name="detalleactividadeconomicappal"]').val == '') {
				alert('Por favor debe digitar el detalle de la actividad economica principal.');
				$(this).find('input[name="detalleactividadeconomicappal"]').focus();
				return false;
			}
			if ($(this).find('input[name="direccionoficinappal"]').val() == '') {
				alert("Por favor digite la direccion de la oficina principal.");
				$(this).find('input[name="direccionoficinappal"]').focus();
				return false;
			}
			if ($(this).find('select[name="ciudadoficina"]').val() == '') {
				alert("Por favor seleccione ciudadoficina.");
				$(this).find('select[name="ciudadoficina"]').focus();
				return false;
			}
			if($(this).find('select[name="ingresosmensualesemp"]').val() == ''){
				alert('Por favor seleccione ingresos mensuales de la empresa.');
				$(this).find('select[name="ingresosmensualesemp"]').focus();
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
			if($(this).find('select[name="egresosmensualesemp"]').val() == ''){
				alert('Por favor seleccione egresos mensuales de la empresa.');
				$(this).find('select[name="egresosmensualesemp"]').focus();
				return false;
			}
			if ($(this).find('input[name="telefonoresidencia"]').val() == '' && $(this).find('input[name="celular"]').val() == '' && $(this).find('input[name="telefonolaboral"]').val() == '' && $(this).find('input[name="celularoficinappal"]').val() == '' && $(this).find('input[name="telefonoficina"]').val() == '' && $(this).find('input[name="celularoficina"]').val() == '') {
				alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
				$(this).find('input[name="telefonoresidencia"]').focus();
				return false;
			}
		}*/
		var nop = false;
		var ultimo = '';
		$(this).find('input, select, textarea').each(function(index, el) {
			if($(el).val() == '' && !$(el).attr('disabled') && $(el).attr('type') != 'hidden' && $(el).attr('type') != 'submit'){
				alert('El campo '+ $(el).attr('title') +' no puede estar vacio. name: ' + $(el).attr('name'));
				nop = true;
				ultimo = $(el).attr('name');
			}
			if(nop)
				return false;
		});
		if(nop){
			$('form#form_fingering [name="'+ultimo+'"]').focus();
			return false;
		}
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
				console.log(xhr, ajaxOptions, thrownError);
				$('form#form_fingering button#button_form_fingering').removeAttr('disabled');
				alert("Error(form_fingering): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
});
$.fn.verificarPais = function(e, campo){
	if($(this).val() != '')
		$(this).hide();
}
$.fn.verificarRePais = function(e, campo, titulo){
	if($(this).val() != '' && ($(this).val() != $('#' + campo).val())){
		alert('Los campos ' + titulo + ' no coinciden, por favor validelos.');
		$('#' + campo).show();
		$('#' + campo).val('').change();
		$(this).val('').change();
	}
};
</script>