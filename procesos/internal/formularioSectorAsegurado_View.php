<input type="hidden" name="formulario" id="formulario" value="20">
<table>
	<tr>
		<td>
		<table>
			<!-- <tr>
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
			</tr> -->
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
					<select id="f_dil_d" name="f_dil_d" style="font-size: 12px" title="Dia de fecha de diligenciamiento">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Ciudad:</td>
				<td>
					<select id="ciudad" name="ciudad" style="font-size: 12px" title="Ciudad">
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
				<td>Sucursal:</td>
				<td>
					<select id="sucursal" name="sucursal" style="font-size: 12px" title="Sucursal">
						<option value="">Seleccione...</option>
<?php
if(isset($sucursales) && !empty($sucursales) && is_array($sucursales)){
	foreach($sucursales as $sucursal){
?>
						<option value="<?=$sucursal['id']?>"><?=$sucursal['sucursal']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<!-- <tr>
				<td>Area:</td>
				<td>
					<select id="area" name="area" style="font-size: 12px" title="Area">
						<option value="">Seleccione...</option>
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
			</tr> -->
			<input type="hidden" name="area" value="<?=(isset($radInfo['id_sucursal'])) ? $radInfo['id_sucursal'] : '2653'?>">
			<input type="hidden" name="id_official" value="<?=(isset($radInfo['oficial_nombre'])) ? $radInfo['oficial_nombre'] : '0'?>">
			<input type="hidden" name="fecharadicado" value=<?=(isset($radInfo['fecha_creacion'])) ? $radInfo['fecha_creacion'] : ''?>>
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
<?php
if($request['tipo_persona'] == '1'){
?>
	<tr>
		<td>
		<table width="491">
			<tr style="background-color: #cabbf7; color: #00e;">
				<td colspan="2" align="center"><strong>DECLARACIONES Y AUTORIZACIONES</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Fuente de origen de fondos</td>
				<td>
					<input type="text" id="origen_fondos" name="origen_fondos" style="width: 360px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Fuente de origen de fondos">
				</td>
			</tr>
		</table>
		</td>
	</tr>
<?php
}
?>
	<tr>
		<td>
<?php
require_once PATH_INTERNAL.DS.$request['action'].'_Beneficiarios_View.php';
?>
		</td>
	</tr>
	<input type="hidden" id="otras_operaciones" name="otras_operaciones" value="SD">
	<input type="hidden" id="productos_exterior" name="productos_exterior" value="2">
	<input type="hidden" id="cuentas_monedaextranjera" name="cuentas_monedaextranjera" value="2">
	<input type="hidden" id="reclamaciones" name="reclamaciones" value="2">
	<input type="hidden" id="firma_entrevista" name="firma_entrevista" value="2">
	<input type="hidden" id="verificacion_ciudad" name="verificacion_ciudad" value="99999">
	<tr>
		<td>
		<table>
			<tr style="background-color: #cabbf7; color: #00e;">
				<td colspan="2" style="width: 100px;display: table-cell;"><strong>CLÁUSULA DE AUTORIZACIÓN</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Autoriza tratamiento comercial?</td>
				<td style="width: 350px">
					<select id="auto_correo" name="auto_correo" style="font-size: 12px; margin-right: 10px" title="Autoriza el envio por correo">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Autoriza tratamiendo de datos?
					<select id="auto_sms" name="auto_sms" style="font-size: 12px;" title="Autoriza el envio de SMS">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Canales por los que no se quiere contacto:</td>
				<td>
					<input type="text" id="sin_contacto_canal" name="sin_contacto_canal" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Canales por los que no se quiere contacto">
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table width="491">
			<tr style="background-color: #cabbf7; color: #00e;">
				<td colspan="2" align="center"><strong>FIRMA Y HUELLA</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Firma:</td>
				<td>
					<select id="firma" name="firma" style="font-size: 12px; margin-right: 20px" title="Firma">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
					</select>
					Huella:
					<select id="huella" name="huella" style="font-size: 12px; margin-left: 5px" title="Huella">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
					</select>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table>
			<tr style="background-color: #cabbf7; color: #00e;">
				<td colspan="2" align="center"><strong>10. CONFIRMACI&Oacute;N DE LA INFORMACI&Oacute;N</strong></td>
			</tr>
			<tr>
				<td style="width: 80px">Fecha de verificacion:</td>
				<td>
					<select id="f_ver_a" name="f_ver_a" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px" title="Año de fecha de verificacion">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_ver_m" name="f_ver_m" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px" title="Mes de fecha de verificacion">
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
					<select id="f_ver_d" name="f_ver_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de fecha de verificacion">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Lugar entrevista:</td>
				<td>
					<input type="text" id="lugarentrevista" name="lugarentrevista" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Lugar entrevista">
					<input type="hidden" name="resultadoentrevista" value="APROBADO">
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Hora:</td>
				<td>
					
					<select id="h_ver_h" name="h_ver_h" style="font-size: 12px" title="Hora">
						<option value="">Hora</option>
<?php
for ($i=1; $i <= 12; $i++) { 
	$hor = $i;
	if (strlen($i) == 1) {
		$hor = '0'.$i;
	}
	echo '<option value="'.$hor.'">'.$hor.'</option>';
}
?>
					</select>
					<select id="h_ver_m" name="h_ver_m" style="font-size: 12px" title="Minuto">
						<option value="">Minuto</option>
<?php
for ($i=0; $i <= 59; $i++) { 
	$hor = $i;
	if (strlen($i) == 1) {
		$hor = '0'.$i;
	}
	echo '<option value="'.$hor.'">'.$hor.'</option>';
}
?>
					</select>
					<select id="h_ver_z" name="h_ver_z" style="font-size: 12px" title="Horario">
						<option value="">Horario</option>
						<option value="AM">A.M.</option>
						<option value="PM">P.M.</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre y cargo de quien verifica:</td>
				<td>
					<input type="text" id="nombreintermediario" name="nombreintermediario" style="width: 350px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Nombre y cargo de quien verifica">
					<input type="hidden" id="clave_inter" name="clave_inter" value="0">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre del intermediario:</td>
				<td>
					<input type="text" id="verificacion_nombre" name="verificacion_nombre" style="width: 350px; margin-right: 5px" onkeypress="return validar_letra(event)" title="Nombre del intermediario">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre del asesor:</td>
				<td>
					<input type="text" id="verificacion_cargo" name="verificacion_cargo" style="width: 350px; margin-right: 5px" onkeypress="return validar_letra(event)" title="Nombre del asesor">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Observaciones:</td>
				<td>
					<textarea cols="40" rows="4" id="verificacion_observacion" name="verificacion_observacion" onkeypress="return validar_letra(event)" title="Observaciones"></textarea>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Firma:</td>
				<td>
					<select id="verificacion_firma" name="verificacion_firma" style="font-size: 12px" title="Firma">
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
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
<?php
require_once PATH_INTERNAL.DS.$request['action'].'_Peps_View.php';
?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
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
	$('select[name="tipoempresaemp"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '5'){
			$('input[name="tipoempresaemp_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="tipoempresaemp_cual"]').val('').attr('disabled', true);
		}
	});
	$('select[name="sector_actividad"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '8'){
			$('input[name="sector_actividad_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="sector_actividad_cual"]').val('').attr('disabled', true);
		}
	});
	$('select[name="monedaextranjera"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('select[name="tipotransacciones"]').removeAttr('disabled');
			$('input[name="tipotransacciones_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('select[name="tipotransacciones"]').val('').change().attr('disabled', true);
			$('input[name="tipotransacciones_cual"]').val('').attr('disabled', true);
		}
	});
	$('select[name="responsable_rut"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="codigo_rut"]').removeAttr('disabled');
			$('input[name="correoelectronico_otro"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="codigo_rut"]').val('').attr('disabled', true);
			$('input[name="correoelectronico_otro"]').val('').attr('disabled', true);
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
			$('table#beneficiarios_nat_table select[name^="be_expuesto_politico"]').removeAttr('disabled');
			$('table#beneficiarios_nat_table select[name^="be_poliza_seguro"]').removeAttr('disabled');
			$('table#beneficiarios_nat_table input[name="ben_nat_obligacion_paises"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('table#beneficiarios_nat_table input[name^="be_nombre_completo"]').val('').attr('disabled', true);
			$('table#beneficiarios_nat_table select[name^="be_tipodocumento_id"]').val('').change().attr('disabled', true);
			$('table#beneficiarios_nat_table input[name^="be_identificacion"]').val('').attr('disabled', true);
			$('table#beneficiarios_nat_table select[name^="be_expuesto_politico"]').val('').change().attr('disabled', true);
			$('table#beneficiarios_nat_table select[name^="be_poliza_seguro"]').val('').change().attr('disabled', true);
			$('table#beneficiarios_nat_table input[name="ben_nat_obligacion_paises"]').val('').attr('disabled', true);
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
			$('table#accionistas_nat_table select[name^="tipo_id"]').removeAttr('disabled');
			$('table#accionistas_nat_table input[name^="identificacion"]').removeAttr('disabled');
			$('table#accionistas_nat_table input[name^="nombre_accionista"]').removeAttr('disabled');
			$('table#accionistas_nat_table input[name^="porcentaje"]').removeAttr('disabled');
			$('table#accionistas_nat_table select[name^="publico_reconocimiento"]').removeAttr('disabled');
			$('table#accionistas_nat_table select[name^="publico_expuesta"]').removeAttr('disabled');
			$('table#accionistas_nat_table select[name^="beneficiario_final"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('table#accionistas_nat_table select[name^="tipo_id"]').val('').change().attr('disabled', true);
			$('table#accionistas_nat_table input[name^="identificacion"]').val('').attr('disabled', true);
			$('table#accionistas_nat_table input[name^="nombre_accionista"]').val('').attr('disabled', true);
			$('table#accionistas_nat_table input[name^="porcentaje"]').val('').attr('disabled', true);
			$('table#accionistas_nat_table select[name^="publico_reconocimiento"]').val('').change().attr('disabled', true);
			$('table#accionistas_nat_table select[name^="publico_expuesta"]').val('').change().attr('disabled', true);
			$('table#accionistas_nat_table select[name^="beneficiario_final"]').val('').change().attr('disabled', true);
		}
	});
	$('select[name="si_peps_nat"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){//"input[name^=load_file]"
			$('table#peps_nat_table select[name^="pep_vinculo_relacion"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="pep_tipo_pep"]').removeAttr('disabled');
			$('table#peps_nat_table input[name^="pep_nombre_razon"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="pep_tipodocumento_id"]').removeAttr('disabled');
			$('table#peps_nat_table input[name^="pep_identificacion"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="pep_nacionalidad_id"]').removeAttr('disabled');
			$('table#peps_nat_table input[name^="pep_entidad"]').removeAttr('disabled');
			$('table#peps_nat_table input[name^="pep_cargo"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="f_vinpep_a"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="f_vinpep_m"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="f_vinpep_d"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="f_despep_a"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="f_despep_m"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="f_despep_d"]').removeAttr('disabled');
			$('table#peps_nat_table select[name^="pep_cuentas_otros_paises"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('table#peps_nat_table select[name^="pep_vinculo_relacion"]').val('').attr('disabled', true);
			$('table#peps_nat_table select[name^="pep_tipo_pep"]').val('').change().attr('disabled', true);
			$('table#peps_nat_table input[name^="pep_nombre_razon"]').val('').attr('disabled', true);
			$('table#peps_nat_table select[name^="pep_tipodocumento_id"]').val('').change().attr('disabled', true);
			$('table#peps_nat_table input[name^="pep_identificacion"]').val('').attr('disabled', true);
			$('table#peps_nat_table select[name^="pep_nacionalidad_id"]').val('').change().attr('disabled', true);
			$('table#peps_nat_table input[name^="pep_entidad"]').val('').attr('disabled', true);
			$('table#peps_nat_table input[name^="pep_cargo"]').val('').attr('disabled', true);
			$('table#peps_nat_table select[name^="f_vinpep_a"]').val('').change().attr('disabled', true);
			$('table#peps_nat_table select[name^="f_vinpep_m"]').val('').change().attr('disabled', true);
			$('table#peps_nat_table select[name^="f_vinpep_d"]').val('').change().attr('disabled', true);
			$('table#peps_nat_table select[name^="f_despep_a"]').val('').change().attr('disabled', true);
			$('table#peps_nat_table select[name^="f_despep_m"]').val('').change().attr('disabled', true);
			$('table#peps_nat_table select[name^="f_despep_d"]').val('').change().attr('disabled', true);
			$('table#peps_nat_table select[name^="pep_cuentas_otros_paises"]').val('').change().attr('disabled', true);
		}
	});
	$('select[name="si_peps_vinculados"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){//"input[name^=load_file]"
			$('table#peps_vinculados_table select[name^="pep_vinculo_relacion"]').removeAttr('disabled');
			$('table#peps_vinculados_table input[name^="pep_nombre_razon"]').removeAttr('disabled');
			$('table#peps_vinculados_table select[name^="pep_tipodocumento_id"]').removeAttr('disabled');
			$('table#peps_vinculados_table input[name^="pep_identificacion"]').removeAttr('disabled');
			$('table#peps_vinculados_table select[name^="pep_nacionalidad_id"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('table#peps_vinculados_table select[name^="pep_vinculo_relacion"]').val('').attr('disabled', true);
			$('table#peps_vinculados_table select[name^="pep_tipo_pep"]').val('').change().attr('disabled', true);
			$('table#peps_vinculados_table input[name^="pep_nombre_razon"]').val('').attr('disabled', true);
			$('table#peps_vinculados_table select[name^="pep_tipodocumento_id"]').val('').change().attr('disabled', true);
			$('table#peps_vinculados_table input[name^="pep_identificacion"]').val('').attr('disabled', true);
			$('table#peps_vinculados_table select[name^="pep_nacionalidad_id"]').val('').change().attr('disabled', true);
		}
	});
	$('form#form_fingering').submit(function(event) {
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		var nop = false;
		var ultimo = '';
		$(this).find('input, select, textarea').each(function(index, el) {
			if($(el).val() == '' && (!$(el).attr('disabled') && $(el).attr('type') != 'hidden' && $(el).attr('type') != 'submit')){
				alert('El campo '+ $(el).attr('title') +' no puede estar vacio. name: ' + $(el).attr('name'));
				nop = true;
				ultimo = $(el).attr('name');
				return false;
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