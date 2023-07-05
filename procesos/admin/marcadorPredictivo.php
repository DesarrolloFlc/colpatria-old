<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], [1, 6])) {
	echo "<h1>No tiene autorizaci�n para este m�dulo</h1>";
	exit;
}
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'user.class.php';

$user = new User();
$user_groups = $user->getGroups();
$users = $user->getUsers();
?>
<!-- Page Head -->
<h2>Marcador predictivo</h2>
<!--<a href="../includes/_Data_Credito_1.php" class="">borrar esto al terminar</a>-->
<p id="page-intro">Creaci&oacute;n de la base para marcador predictivo</p>
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<h3>Marcador predictivo</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">Creaci&oacute;n de base</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
			<div class="notification error   png_bg" id="result_search" style="display: none">
				<a href="#" class="close">
					<img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
				</a>
				<div id="msg_result_search"></div>
			</div>
			<form id="generarBaseMarcador" name="generarBaseMarcador" method="POST" enctype="multipart/form-data" action="../includes/controllerMarcador.php" target="grp">
				<label>Proceso:<br>
					<select id="proceso_id" name="proceso_id">
						<option value="">Seleccione..</option>
						<option value="1">Seguros</option>
						<option value="2">Capitalizaci&oacute;n</option>
					</select>
				</label>
				<label>Tipo de marcaci&oacute;n:<br>
					<select id="tipo_marcacion" name="tipo_marcacion">
						<option value="">Seleccione..</option>
						<option value="1">Local</option>
						<option value="2">Nacional</option>
						<option value="3">Celular</option>
					</select>
				</label>
				<label>Archivo:<br>
					<input type="file" id="file_marcador" name="file_marcador">
				</label>
				<input class="button" type="submit" value="Generar base marcador predictivo >>">
				<input type="hidden" id="action" name="action" value="generarBaseMarcador">
			</form>
			<iframe width="1" height="1" id="grp" name="grp" style="visibility:hidden"></iframe><!---->
			<div id="imagen_marcacion"></div>
		</div><!-- FIN TAB1 -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('select#tipo_marcacion').change(function(event) {
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		const dato = $(this).val();
		if(dato !== ''){
			strHtml = `<label>Estructura del archivo
				<br><br>
				<img src="../../images/general/${dato}.png">
			</label>`;
			$('div#imagen_marcacion').html(strHtml);
		}
	});
});
</script>
<?php
	require_once PATH_SITE . DS . 'template/general/footer.php';
?>