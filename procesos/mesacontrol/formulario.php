<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header_2.php';
require_once PATH_CCLASS . DS . 'official.class.php';
require_once PATH_CCLASS . DS . 'general.class.php';
$general = new General();
$areas = $general->getAreas();
$sucursales = $general->getSucursales();
$digitadores = $general->getDigitadores();
?>
<!-- Page Head -->
<h2>Crear Orden de producción</h2>
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<h3>Creación de orden</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="">Diligenciar Orden</a></li>
			<li><a href="#tab2" class="default-tab">Masivo de ordenes</a></li>
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
		<div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
			<div class="notification success  png_bg" id="result_notif" style="display:none;">
				<a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div id="msg_adduser"></div>
			</div>
			<form action="../../lib/general/procesos.php" method="POST" id="form_ordenadd" name="form_ordenadd">
				<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
					<p>
						<label>Planilla:</label>
						<input type="text" name="planilla" id="planilla"/>
					</p>
					<p>
						<label>Lote:</label>
						<input type="text" name="lote" id="lote" size="6"/>
					</p>
					<!--<p>
						<label>Asesor:</label>
						<select id="asesor" name="asesor">
							<option value="">-Opciones-</option>
<?php
//while ($result = mysqli_fetch_array($digitadores)) {
	//echo "<option value='{$result['id']}'>{$result['name']}</option>";
	//}
?>
						</select>
					</p>-->
					<input type="hidden" name="asesor" id="asesor" value="<?=$_SESSION['id']?>">
					<p>
						<label>Cantidad de formularios:</label>
						<input type="text" name="cantidad" id="cantidad" size="6"/>
					</p>
					<p>
						<label>Sucursal:</label>
						<select id="sucursal" name="sucursal">
							<option value="">-Opciones-</option>
<?php
while ($result = mysqli_fetch_array($sucursales)){
	echo "<option value='{$result['id']}'>{$result['sucursal']}</option>";
}
?>
						</select>
					</p>
					<p>	
						<label>&Aacute;rea:</label>
						<select id="area" name="area">
							<option value="">-Opciones-</option>
<?php
while ($result = mysqli_fetch_array($areas)){
	echo "<option value='{$result['id']}'>{$result['description']}</option>";
}
?>
						</select>
					</p>
					<p>
						<label>Devoluciones:</label>
						<input type="text" name="devoluciones" id="devoluciones" maxlength="3" style="width: 3em;">
					</p>
					<p>
						<label>No llegaron:</label>
						<input type="text" name="no_llegaron" id="no_llegaron" maxlength="3" style="width: 3em;">
					</p>
					<p>
						<label>Fecha:</label>
						<input type="text" name="fecha" id="fecha" size="6" class="classpickerfecha">
					</p>
					<p>
						<label>Total formularios:</label>
						<input type="text" name="total_formularios" id="total_formularios" size="6"/>
					</p>
					<p>
						<input type="hidden" name="action" id="action" value="add_orden" />
						<input class="button" type="submit" value="Crear Orden de Producción >>" />
					</p>
				</fieldset>
				<div class="clear"></div><!-- End .clear -->
			</form>
		</div> <!-- End #tab1 -->
		<div class="tab-content default-tab" id="tab2"> <!-- This is the target div. id must match the href of this div's tab -->
			<div class="notification success  png_bg" id="result_notif" style="display:none;">
				<a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div id="msg_adduser"></div>
			</div>
			<div>Descargue una copia de la estructura a cargar <a href="download.php">aqui</a></div>
			<hr>
			<form id="form_ordenadd_masiva" name="form_ordenadd_masiva" method="post">
				<fieldset>
					<p>
						<label>Planilla:</label>
						<input type="number" name="planilla_num" id="planilla_num">
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
				<div class="clear"></div>
			</form>
		</div>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
$(document).ready(function(){
	$('form#form_ordenadd_masiva').submit(function(event) {
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('input[name="planilla_num"]', this).val() == ''){
			alert('Debe digitar el numero de planilla.');
			$('input[name="planilla_num"]', this).focus();
			return false;
		}
		if($('input[name="fecha_recepcion"]', this).val() == ''){
			alert('Debe seleccionar la fecha de recepcion.');
			$('input[name="fecha_recepcion"]', this).focus();
			return false;
		}
		if($('input[name="archivo"]', this).val() == ''){
			alert('Debe seleccionar un archivo a subir.');
			$('input[name="archivo"]', this).focus();
			return false;
		}else{
			var tipos = $('input[name="archivo"]', this).val().split(".");
			var tipo = tipos[(tipos.length - 1)];
			if(tipo.toLowerCase() != 'csv'){
				alert('Debe seleccionar un tipo de archivo valido(CSV)');
				$('input[name="archivo"]', this).focus();
				return false;
			}
		}
		const form = this;
		var formData = new FormData();
		formData.append('file', $('input[name="archivo"]', form)[0].files[0]);
		formData.append('action', 'ordenadd_masiva');
		formData.append('planilla', $('input[name="planilla_num"]', form).val());
		formData.append('fecha_recepcion', $('input[name="fecha_recepcion"]', form).val());
		$.ajax({
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			type: 'post',
			url: '../../lib/general/procesos.php',
			dataType: 'json',
			success: function(dato, textStatus, jqXHR) {
				if(dato.exito){
					alert(dato.exito + "\n" + dato.resp);
					$('form#form_ordenadd_masiva').reset();
				}else
					alert(dato.error);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert('Ocurrio el siguiente error:\n' + thrownError + '\n' + xhr.responseText);
			}
		});
	});
});
</script>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
