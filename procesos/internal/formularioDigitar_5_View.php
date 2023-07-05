<table style="width: 100%;">
	<tr>
		<td colspan="3" align="center">
			<select id="tipo_cliente" name="tipo_cliente">
				<option value="1">Natural</option>
				<option value="2">Juridico</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			Documento:
			<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 25%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero" name="numero" maxlength="10">
			<br>
			Cod. Verf.
			<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 20%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero_" name="numero_" disabled="true" maxlength="1">
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center"><input type="submit" value="Indexar Imagen" id="button_form_fingering"></td>
	</tr>
</table>
<input type="hidden" name="type" id="type" value="5">
<input type="hidden" name="tipo_norma_id" value="1">
<input type="hidden" name="regimen_id" value="2">
<input type="hidden" name="num_images" id="num_images" value="">
<input type="hidden" name="domain" id="domain" value="form">
<input type="hidden" name="action"   id="action" value="guardarDocComplementaria">
<input type="hidden" name="meth" id="meth" value="js">
<input type="hidden" name="respOut" id="respOut" value="json">
<script>
$(document).ready(function(){
	$("#tipo_cliente").change(function() {
		if($('#tipo_cliente').val() == 1)
			$("input#numero_").attr('disabled', 'disabled');
		else
			$("input#numero_").removeAttr('disabled');
	});
	$('form#form_fingering').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).find('input[name="numero"]').val() == ''){
			alert('Por favor digite el numero de identificacion del cliente.');
			$(this).find('input[name="numero"]').focus();
			return false;
		}
		if($(this).find('select[name="tipo_cliente"]').val() == '2' && $(this).find('input[name="numero_"]').val() == ''){
			alert('Por favor digite codigo de verificacion del cliente.');
			$(this).find('input[name="numero_"]').focus();
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
				console.log(xhr, ajaxOptions, thrownError);
				$('form#form_fingering input#button_form_fingering').removeAttr('disabled');
				alert("Error(form_fingering): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
});
</script>