<br>
<div id="formulari_ug045">
	<table style="width: 100%;">
		<tr>
			<td colspan="3">
<?php
if(isset($tipoDocumento) && !empty($tipoDocumento) && is_array($tipoDocumento)){
	foreach($tipoDocumento as $tipo){
		$checked = '';
		if($tipo['id'] == '1')
			$checked = ' checked="checked"';
?>
				<?=$tipo['description'];?>
				<input type="radio" name="grupodoc" id="grupodoc" value="<?=$tipo['id'];?>"<?=$checked?>>
<?php
	}
}
?>
			</td>
		</tr>
		<tr>
			<td>Número</td>
			<td style="width: 50%;">
				<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero" name="numero" maxlength="10" onblur="$(this).ocultarCampoDocAutos(event);" title="Número"> 
			</td>
			<td>
				Cod. Verf.
				<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 20%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero_" name="numero_" disabled="true" maxlength="1" title="Cod. Verf.">
			</td>
		</tr>
	</table>
	<table id="tblnombres" style="width: 100%;">
		<tr>
			<td>Primer Apellido</td>
			<td>Segundo Apellido</td>
			<td>Nombres</td>
		</tr>
		<tr>
			<td>
				<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtpapellido" name="txtpapellido" onkeypress="return validar_letra(event)" title="Primer Apellido">
			</td>
			<td>
				<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtsapellido" name="txtsapellido" onkeypress="return validar_letra(event)" title="Segundo Apellido">
			</td>
			<td>
				<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtnombres" name="txtnombres" onkeypress="return validar_letra(event)" title="Nombres">
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>Ocupación/ Actividad Económica</td>
			<td colspan="2">
				<div id="dv_ocupaciones">
					<select id="ocupacti" name="ocupacti" class="obligatorio"  style="width: 100%;" data-detalle="Detalle Ocupacion" title="Ocupación/ Actividad Económica">
						<option value="">-Opciones-</option>
<?php
if(isset($ocupaciones) && !empty($ocupaciones) && is_array($ocupaciones)){
	foreach($ocupaciones as $ocupacion){
?>
						<option value="<?=$ocupacion['id']?>"><?=$ocupacion['description']?></option>
<?php
	}
}
?>
					</select>
				</div>
				<div id="dv_acteconomicas">
					<select id="actecono" name="actecono" class="obligatorio"  style="width: 100%;" data-detalle="Detalle Actividad" title="Ocupación/ Actividad Económica">
						<option value="">-Opciones-</option>
<?php
if(isset($acteconomicas) && !empty($acteconomicas) && is_array($acteconomicas)){
	foreach($acteconomicas as $acteconomica){
?>
						<option value="<?=$acteconomica['id']?>"><?=$acteconomica['description']?></option>
<?php
	}
}
?>
					</select>
				</div>
			</td>
		</tr>
		<tr id="tr_detalle_ocu_act"></tr>
		<tr>
			<td>Ciudad</td>
			<td colspan="2">
				<select id="ciudad" name="ciudad" style="width: 100%;" title="Ciudad">
					<option value="">--Seleccione ciudad--</option>
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
			<td>Dirección</td>
			<td colspan="2">
				<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="direccion" name="direccion" onkeypress="return validar_letra(event)" title="Dirección">
			</td>
		</tr>
		<tr>
			<td>Teléfono</td>
			<td colspan="2">
				<input type="text" class="obligatorio" onkeypress="return validar_num(event)" onpaste="return false;" id="telefono" name="telefono"  size="10" maxlength="10" style="margin-left: 1px; margin-right: 1px; width: 40%;" title="Teléfono">
			</td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td colspan="2">
				<input type="text" class="obligatorio" onpaste="return false;" id="email" name="email" style="margin-left: 1px; margin-right: 1px; width: 40%;" onkeypress="return validar_letra(event)" title="E-mail">
			</td>
		</tr>
		<tr>
			<td>Numero de poliza</td>
			<td colspan="2">
				<input type="text" class="obligatorio" onkeypress="return validar_num(event)" onpaste="return false;" id="npoliza" name="npoliza" style="margin-left: 1px; margin-right: 1px; width: 40%;" title="Numero de poliza">
			</td>
		</tr>
		<tr>
			<td>Fecha de diligenciamiento</td>
			<td colspan="2">
				<select id="age" name="age" title="Año de diligenciamiento">
<?php
$anio = date("Y");
for($index = 0; $index < 20; $index++){
?>
					<option value="<?=$anio;?>"><?=$anio;?></option>
<?php
	$anio--;
}
?>
				</select>
				<select id="mes_" name="mes_" title="Mes de diligenciamiento">
					<option value="">--</option>
					<option value="01">Enero</option>
					<option value="02">Febrero</option>
					<option value="03">Marzo</option>
					<option value="04">Abril</option>
					<option value="05">Mayo</option>
					<option value="06">Junio</option>
					<option value="07">Julio</option>
					<option value="08">Agosto</option>
					<option value="09">Septiembre</option>
					<option value="10">Octubre</option>
					<option value="11">Noviembre</option>
					<option value="12">Diciembre</option>
				</select>
				<select id="dia" name="dia" title="Dia de diligenciamiento">
					<option value="">--</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td>Re-escribir Número</td>
						<td>
							<input type="text" style="margin-left: 1px; margin-right: 1px; width: 100%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero2" name="numero2" maxlength="10" onblur="$(this).validarCampoDocAutos();" title="Re-escribir Número">
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center"><input type="submit" value="Crear formulario" id="button_form_fingering"></td>
		</tr>
	</table>
</div>
<input type="hidden" name="type" id="type" value="4">
<input type="hidden" name="tipo_norma_id" value="1">
<input type="hidden" name="regimen_id" value="2">
<input type="hidden" name="num_images" id="num_images" value="">
<input type="hidden" name="domain" id="domain" value="form">
<input type="hidden" name="action"   id="action" value="guardarFormularioRenovacionAutos">
<input type="hidden" name="meth" id="meth" value="js">
<input type="hidden" name="respOut" id="respOut" value="json">
<script>
$(document).ready(function(){
	if($('input:radio[name="grupodoc"]:checked').val() == '7'){
		$('#dv_ocupaciones').hide();
		$('#dv_acteconomicas').show();
	}else{
		$('#dv_ocupaciones').show();
		$('#dv_acteconomicas').hide();
	}
	$('select#ocupacti, select#actecono').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '221' || $(this).val() == '810'){
			var str_detall = $(this).attr('data-detalle');
			var strHtml = '<td>'+str_detall+'</td><td>'+
			'<input type="text" id="detalle" name="detalle" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;">'+
			'</td>';
			$('tr#tr_detalle_ocu_act').html(strHtml);
		}else{
			$('tr#tr_detalle_ocu_act').html('');
		}
	});
	$("#mes_").change(function() {//sinthia
		/*
		* Treinta dias tiene Septiembre, 
		Abril(4), Junio(6) y Noviembre (11)
		Todo el resto tienen treinta y uno
		Excepto Febrero que tiene Veintiocho
		o veintinueve en años bisiestos.
		*/
		var cdias = 0;
		if($("#mes_").val() == 4 || $("#mes_").val() == 6 || $("#mes_").val() == 11){
			cdias = 30;
		}else if($("#mes_").val() == 2){
			var año = (new Date).getFullYear();
			var bisiesto = (año % 4 == 0) && ((año % 100 != 0) || (año % 400 == 0));
			if (bisiesto == true){
				cdias = 29;
			}else{
				cdias = 28;
			}
		}else{
			cdias = 31;
		}
		var option = "";
		for(var i = 1; i <= cdias; i++){
			if(i <= 9){
				option = option + "<option value='0" + i + "'>0" + i + "</option>";
			}else{
				option = option + "<option value='" + i + "'>" + i + "</option>";
			}
		}
		$('#dia').html(option);
	});
	$('input[name="grupodoc"]').change(function(event){//sinthia
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		$('tr#tr_detalle_ocu_act').html('');
		if($(this).val() == '7'){
			$('#actecono').val('');
			//$("input#numero_").prop('disabled', true); //jQuery 1.6+
			$("input#numero_").removeAttr('disabled');//jQuery 1.5 and below
			$("#tblnombres").html('');
			var trtable = '<tr>' +
							'<td colspan="3">Nombre/Razón Social</td>' +
						'</tr>' +
						'<tr>' +
							'<td colspan="3">' +
								'<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="razonsocial" name="razonsocial" onkeypress="return validar_letra(event)" title="Nombre/Razón Social">' +
							'</td>' +
						'</tr>';
			$("#tblnombres").html(trtable);
			$('#dv_ocupaciones').hide();
			$('#dv_acteconomicas').show();
		}else{
			$('#ocupacti').val('');
			//$("input#numero_").prop('disabled', false);//jQuery 1.6+
			$("input#numero_").attr('disabled', 'disabled');// jQuery 1.5 and below
			$("#tblnombres").html('');
			var trtable = '<tr>' +
							'<td>Primer Apellido</td>' +
							'<td>Segundo Apellido</td>' +
							'<td>Nombres</td>' +
						'</tr>' +
						'<tr >' +
							'<td>' +
								'<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtpapellido" name="txtpapellido" onkeypress="return validar_letra(event)" title="Primer Apellido">' +
							'</td>' +
							'<td>' +
								'<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtsapellido" name="txtsapellido" onkeypress="return validar_letra(event)" title="Segundo Apellido">' +
							'</td>' +
							'<td>' +
								'<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtnombres" name="txtnombres" onkeypress="return validar_letra(event)" title="Nombres">' +
							'</td>' +
						'</tr>';
			$("#tblnombres").html(trtable);
			$('#dv_ocupaciones').show();
			$('#dv_acteconomicas').hide();
		}
	});
	$('form#form_fingering').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).find('input[name="numero"]').val() == ''){
			alert('Por favor digite el numero de identificacion del cliente.');
			$(this).find('input[name="numero"]').focus();
			return false;
		}
		if($('input:radio[name="grupodoc"]:checked').val() == '7'){
			if($(this).find('input[name="razonsocial"]').val() == ''){
				alert('Por favor digite la razon social del cliente.');
				$(this).find('input[name="razonsocial"]').focus();
				return false;
			}
		}else{
			if($(this).find('input[name="txtpapellido"]').val() == ''){
				alert('Por favor digite el primer apellido del cliente.');
				$(this).find('input[name="txtpapellido"]').focus();
				return false;
			}
			if($(this).find('input[name="txtsapellido"]').val() == ''){
				alert('Por favor digite el segundo apellido del cliente.');
				$(this).find('input[name="txtsapellido"]').focus();
				return false;
			}
			if($(this).find('input[name="txtnombres"]').val() == ''){
				alert('Por favor digite los nombres del cliente.');
				$(this).find('input[name="txtnombres"]').focus();
				return false;
			}
		}
		if($(this).find('input[name="npoliza"]').val() == ''){
			alert('Por favor digite el numero de la poliza.');
			$(this).find('input[name="npoliza"]').focus();
			return false;
		}
		if($(this).find('select[name="age"]').val() == ''){
			alert('Por favor seleccione el año de diligenciamiento');
			$(this).find('select[name="age"]').focus();
			return false;
		}
		if($(this).find('select[name="mes_"]').val() == ''){
			alert('Por favor seleccione el mes de diligenciamiento');
			$(this).find('select[name="mes_"]').focus();
			return false;
		}
		if($(this).find('select[name="dia"]').val() == ''){
			alert('Por favor seleccione el dia de diligenciamiento');
			$(this).find('select[name="dia"]').focus();
			return false;
		}
		var nop = false;
		var ultimo = '';
		$(this).find('input, select, textarea').each(function(index, el) {
			if($(el).val() == '' && !$(el).attr('disabled') && $(el).attr('type') != 'hidden' && $(el).attr('type') != 'submit'){
				if($(el).attr('name') == 'ocupacti' && $('input:radio[name="grupodoc"]:checked').val() != '7'){
					alert('El campo '+ $(el).attr('title') +' no puede estar vacio. name: ' + $(el).attr('name'));
					$(el).focus();
					nop = true;
					ultimo = $(el).attr('name');
					return false;
				}else if($(el).attr('name') == 'actecono' && $('input:radio[name="grupodoc"]:checked').val() == '7'){
					alert('El campo '+ $(el).attr('title') +' no puede estar vacio. name: ' + $(el).attr('name'));
					$(el).focus();
					nop = true;
					ultimo = $(el).attr('name');
					return false;
				}else if($(el).attr('name') != 'actecono' && $(el).attr('name') != 'ocupacti'){
					alert('El campo '+ $(el).attr('title') +' no puede estar vacio.. name: ' + $(el).attr('name'));
					$(el).focus();
					nop = true;
					ultimo = $(el).attr('name');
					return false;
				}
			}
		});
		if(nop){
			$('form#form_fingering #'+ultimo).focus();
			return false;
		}
		var data = $(this).serialize();
		$.ajax({
			beforeSend: function(){
				$('form#form_fingering input#button_form_fingering').attr('disabled', true);
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
				}else{
					alert('Ocurrio un error al momento de agregar el nuevo formulario, contacte con el administrador por favor.');
					console.log(dato);
				}
			},
			complete: function(jqXHR, textStatus){
				$('form#form_fingering input#button_form_fingering').removeAttr('disabled');
			},
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				console.log(ajaxOptions);
				console.log(thrownError);
				$('form#form_fingering input#button_form_fingering').removeAttr('disabled');
				alert("Error(form_fingering): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
});
$.fn.ocultarCampoDocAutos = function(e){
	if($(this).val() != '')
		$(this).hide();
}
$.fn.validarCampoDocAutos = function(e){
	if($('input[name="numero"]').val() != $(this).val()){
		alert("El numero de documento no coinciden por favor validelos.");
		$('input[name="numero"]').val('');
		$(this).val('');
		$('input[name="numero"]').show();
	}
}
</script>