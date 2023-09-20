<table style="width: 100%;">
	<tr>
		<td colspan="2" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td align="right" style="width: 30%;">Tipo persona:</td>
		<td align="left" style="width: 70%;">
			<select name="persontype">
				<option value="">Seleccione...</option>
				<option value="1">Natural</option>
				<option value="2">Juridico</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right">Documento/Nit:</td>
		<td align="left">
			<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 35%;" onkeypress="return validar_num(event)" onpaste="return false;" name="document" maxlength="15">
		</td>
	</tr>
	<tr>
		<td align="right">Nombre / Razon social:</td>
		<td align="left">
			<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 90%;" onkeypress="return validar_letra(event)"  onpaste="return false;" name="firstname">
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<!-- <input type="submit" value="Indexar documentos" id="button_form_fingering"> -->
			<button type="submit" id="button_form_fingering" style="padding: 5px;">Indexar documentos</button>
		</td>
	</tr>
</table>
<input type="hidden" name="type" value="10">
<input type="hidden" name="tipo_norma_id" value="1">
<input type="hidden" name="regimen_id" value="2">
<input type="hidden" name="num_images" value="">
<input type="hidden" name="domain" value="form">
<input type="hidden" name="action" value="guardarDocComplementarioPorRegimen">
<input type="hidden" name="meth" value="js">
<input type="hidden" name="respOut" value="json">
<script>
$(document).ready(function(){
	$('form#form_fingering').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('select[name="persontype"]', this).val() == ''){
			alert('Por favor seleccione el tipo de persona.');
			$('select[name="persontype"]', this).focus();
			return false;
		}
		if($('input[name="document"]', this).val() == ''){
			alert('Por favor digite el numero de identificacion del cliente.');
			$('input[name="document"]', this).focus();
			return false;
		}
		if($('select[name="firstname"]', this).val() == '2'){
			alert('Por favor digite el nombre y/o razon social del cliente.');
			$('input[name="firstname"]', this).focus();
			return false;
		}
		const form = this;
		$.ajax({
			beforeSend: function(){
				$('form#form_fingering button#button_form_fingering').attr('disabled', true);
			},
			data: $(form).serialize(),
			type: 'POST',
			url: '../includes/Controller.php',
			dataType: 'json',
			success: function(dato){
				if (!dato.url) {
					alert(dato.error ? dato.error : 'Ocurrio un error al momento de agregar el nuevo formulario, contacte con el administrador por favor.');
					if (!dato.error) console.log(dato);
					return false;
				}
				alert(dato.exito);
				window.location.href = dato.url;
			},
			complete: function(jqXHR, textStatus){
				$('form#form_fingering button#button_form_fingering').removeAttr('disabled');
			},
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert("Error(form_fingering): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
});
</script>