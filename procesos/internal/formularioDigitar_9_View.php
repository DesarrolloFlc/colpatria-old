<br>
<table>
	<tr>
		<td>Tipo persona: </td>
		<td>
			<select id="tipopersona" name="tipopersona">
				<option value="">-- Seleccione una opción --</option>
<?php
if(isset($tipoPersona) && !empty($tipoPersona) && is_array($tipoPersona)){
	foreach ($tipoPersona as $tipo) {
?>
				<option value="<?=$tipo['id']?>"><?=$tipo['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
</table>
<br>
<div id="fields_persona" style="width:100%; height: auto;"></div>    
<input type="hidden" name="type" id="type" value="9">
<input type="hidden" name="tipo_norma_id" value="2">
<input type="hidden" name="regimen_id" value="2">
<input type="hidden" name="num_images" id="num_images" value="">
<input type="hidden" name="domain" id="domain" value="form">
<input type="hidden" name="action"   id="action" value="guardarFormularioSectorAsegurado">
<input type="hidden" name="meth" id="meth" value="js">
<input type="hidden" name="respOut" id="respOut" value="json">
<script>
$(document).ready(function(){
	$("#tipopersona").change(function(){
		if($(this).val() != ""){
			var tipo = $(this).val();
			var lote = $('form#form_fingering input[name="lote"]').val();
			$.ajax({
				data: {
					domain: 'form',
					action: 'formularioSectorAsegurado',
					tipo_persona: tipo,
					lote: lote,
					meth: 'js',
					respOut: 'html'
				},
				type: 'GET',
				url: '../includes/Controller.php',
				dataType: 'html',
				success: function(dato){
					$('#fields_persona').html(dato);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					console.log(xhr, ajaxOptions, thrownError);
					alert("Error(guardarGestionDeposito): "+xhr.status+" Error: "+xhr.responseText);
				}
			});
		}
	});
});
</script>