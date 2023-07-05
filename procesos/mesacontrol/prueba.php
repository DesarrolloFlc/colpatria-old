<!DOCTYPE html>
<html>
<head>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Doc. Finder | Finleco BPO - Colpatria</title>
	<!-- <script type="text/javascript" src="../../resources/scripts/jquery-1.4.2.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="/Colpatria/resources/scripts/simpla.jquery.configuration_2.js"></script>
    <!-- <script type="text/javascript" src="/Colpatria/resources/scripts/jquery.wysiwyg.js"></script> -->
    <script type="text/javascript" src="/Colpatria/resources/scripts/jquery.qtip.min.js"></script>
    <script type="text/javascript" src="/Colpatria/lib/js/tools_2.js"></script>
    <script type="text/javascript" src="/Colpatria/lib/js/cal.js"></script>
</head>
</head>
<body>
<form id="form_ordenadd_masiva" name="form_ordenadd_masiva" method="post">
	<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
		<p>
			<label>Planilla:</label>
			<input type="text" name="planilla" id="planilla">
		</p>
		<input type="hidden" name="asesor" id="asesor" value="<?=$_SESSION['id']?>">
		<p>
			<label>Tipo documento:</label>
			<select id="tipo_documento" name="tipo_documento">
				<option value="">-Opciones-</option>
				<option value="0">Fisico</option>
				<option value="1">Virtual</option>
			</select>
		</p>
		<p>
			<label>Fecha de recepcion:</label>
			<input type="text" name="fecha_recepcion" id="fecha_recepcion" size="7" class="classpickerfecha">(YYYY-MM-DD)
		</p>
		<p>
			<label>Subir archivo:</label>
			<input type="file" name="archivo" id="archivo">
		</p>
		<p>
			<input class="button" type="submit" value="Crear Orden de Producción >>">
		</p>
	</fieldset>
	<div class="clear"></div><!-- End .clear -->
</form>
<script type="text/javascript">
$(document).ready(function(){
	$('form#form_ordenadd_masiva').submit(function(event) {
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('form#form_ordenadd_masiva input[name="planilla"]').val() == ''){
			alert('Debe digitar el numero de planilla.');
			$('form#form_ordenadd_masiva input[name="planilla"]').focus();
			return false;
		}
		if($('form#form_ordenadd_masiva select[name="tipo_documento"]').val() == ''){
			alert('Debe seleccionar el tipo de documento.');
			$('form#form_ordenadd_masiva select[name="tipo_documento"]').focus();
			return false;
		}
		if($('form#form_ordenadd_masiva input[name="fecha_recepcion"]').val() == ''){
			alert('Debe seleccionar la fecha de recepcion.');
			$('form#form_ordenadd_masiva input[name="fecha_recepcion"]').focus();
			return false;
		}
		if($('form#form_ordenadd_masiva input[name="archivo"]').val() == ''){
			alert('Debe seleccionar un archivo a subir.');
			$('form#form_ordenadd_masiva input[name="archivo"]').focus();
			return false;
		}
		//return false;
		var formData = new FormData();
		formData.append('file', document.getElementById("archivo").files[0]);
		formData.append('action', 'ordenadd_masiva');
		formData.append('planilla', $('form#form_ordenadd_masiva input[name="planilla"]').val());
		formData.append('tipo_documento', $('form#form_ordenadd_masiva select[name="tipo_documento"]').val());
		formData.append('fecha_recepcion', $('form#form_ordenadd_masiva input[name="fecha_recepcion"]').val());
		//console.log(formData);
		$.ajax({
			/*beforeSend: function(){
				$(bar).css('color', '#fff');
			},*/			
			//data: 'action=1&planilla=2&tipo_documento=3&fecha_recepcion=4',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			type: 'post',
			url: 'procesos.php',
			dataType: 'json',
			success: function(dato, textStatus, jqXHR) {
				console.log(dato);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				console.log(ajaxOptions);
				console.log(thrownError);
				/*$("#fileUploadError").removeClass("hide").text("An error occured!");
				$("#files").children().last().remove();
				$("#uploadFile").closest("form").trigger("reset");*/
			}
		});
	});
});
</script>
</body>
</html>