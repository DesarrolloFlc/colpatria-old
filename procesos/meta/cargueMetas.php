<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["1", "6"])) {
	echo "<h1>No tiene autorizaci�n para este m�dulo</h1>";
	exit;
}
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header_2.php';
require_once PATH_CLASS . DS . '_conexion.php';
require_once PATH_CCLASS . DS . 'user.class.php';

$user = new User();
$user_groups = $user->getGroups();
$users = $user->getUsers();
$tareas = User::obtenerTareas();
$gestores = User::obtenerUsuariosOperacion();
?>
<!-- Page Head -->
<h2>Cargue de metas.</h2>
<!--<a href="../includes/_Data_Credito_1.php" class="">borrar esto al terminar</a>-->
<p id="page-intro">Creaci&oacute;n y parametrizaci&oacute;n de metas.</p>
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<h3>Metas</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab1" class="default-tab">Cargue de meta</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
			<div class="notification error png_bg" id="result_search" style="display: none">
				<a href="#" class="close">
					<img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
				</a>
				<div id="msg_result_search"></div>
			</div>
			<form id="crearMeta" name="crearMeta" method="POST">
				<p>
					<label>Actividad:</label>
					<select name="tarea_id">
						<option value="">Seleccionar...</option>
<?php
foreach($tareas as $tarea){
?>
						<option value="<?=$tarea['id']?>"><?=$tarea['descripcion']?></option>
<?php
}
?>
					</select>
				</p>
				<p>
					<label>Gestor:</label>
					<select name="gestor_id">
						<option value="">Seleccionar...</option>
<?php
foreach($gestores as $gestor){
?>
						<option value="<?=$gestor['id']?>"><?=$gestor['name']?></option>
<?php
}
?>
					</select>
				</p>
				<p>
					<label>Fecha:</label>
					<input class="classpickerfecha text-input" style="width: 100px;" type="text" name="fecha" id="fecha" />(YYYY-MM-DD)
				</p>
				<p>
					<label>Meta diaria:</label>
					<input class="text-input" style="width: 4%;" type="text" id="meta_diaria" name="meta_diaria">
				</p>
				<p>
					<label>Horas de gestion d&iacute;a:</label>
					<input class="text-input" style="width: 3%;" type="text" id="horas_gestion_dia" name="horas_gestion_dia">
				</p>
				<p>
					<input class="button" type="submit" value="Crear nueva meta >>" id="input_crearMeta">
				</p>
				<input type="hidden" id="action" name="action" value="crearMeta">
			</form>
			<div id="imagen_marcacion"></div>
		</div><!-- FIN TAB1 -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('form#crearMeta').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('select[name="tarea_id"]', this).val() == ''){
			alert('Debe seleccionar la actividad para la meta.');
			$('select[name="tarea_id"]', this).focus();
			return false;
		}
		if($('select[name="gestor_id"]', this).val() == ''){
			alert('Debe seleccionar el gestor para la meta.');
			$('select[name="gestor_id"]', this).focus();
			return false;
		}
		if($('input[name="fecha"]', this).val() == ''){
			alert('Debe seleccionar la fecha para la meta.');
			$('input[name="fecha"]', this).focus();
			return false;
		}
		if($('input[name="meta_diaria"]', this).val() == ''){
			alert('Debe digitar la meta diaria.');
			$('input[name="meta_diaria"]', this).focus();
			return false;
		}
		if($('input[name="horas_gestion_dia"]', this).val() == ''){
			alert('Debe digitar las horas de gestion diarias.');
			$('input[name="horas_gestion_dia"]', this).focus();
			return false;
		}
		var datos = $(this).serialize();
		$.ajax({
			beforeSend: function(){
				//$('form#buscarAsignacionesCliente #button_buscarAsignacionesCliente').button('loading');
				//$('div#content-11').html('');
				$('input#input_crearMeta').attr('disabled', true);
			},
			data: datos,
			type: 'post',
			url: '../../lib/general/procesos.php',
			dataType: 'json',
			success: function(dato){
				if(dato.exito){
					alert(dato.exito);
					$('form#crearMeta').reset();
				}else
					alert(dato.error);
			},
			complete: function(jqXHR, textStatus){
				//$('form#buscarAsignacionesCliente #button_buscarAsignacionesCliente').button('reset');
				$('input#input_crearMeta').removeAttr('disabled');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert("Error(crearMeta): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
});
</script>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
	