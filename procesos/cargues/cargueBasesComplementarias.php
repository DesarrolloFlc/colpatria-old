<?php
session_start();

if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8", "2", "11"]) && !isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'radicador') {
	echo "No tiene permiso para esta �rea";
	exit;
}

require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header_2.php';
require_once PATH_CCLASS . DS . 'general.class.php';

$active1 = ' class="default-tab"';
$active11 = ' default-tab';
$active2 = '';
$active21 = '';
if($_SESSION['group'] == "11"){
	$active2 = ' class="default-tab"';
	$active21 = ' default-tab';
	$active1 = '';
	$active11 = '';
}
?>
<!-- Page Head -->
<h2>Cargue de bases con informaci&oacute;n complementaria para los clientes en DocFinder</h2>
<p id="page-intro">Informaci&oacute;n complementaria.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
	<div class="content-box-header">
		<!-- <h3>Parametros</h3> -->
		<ul class="content-box-tabs">
<?php
	if(isset($_SESSION['group']) && ($_SESSION['group'] != "11")){
?>
			<li><a href="#tab2"<?=$active1?>>Base gestor de ventas</a></li>
<?php
	}
	if(isset($_SESSION['group']) && ($_SESSION['group'] == "6" || $_SESSION['group'] == "11")){
		if($_SESSION['group'] != "11"){
?>
			<li><a href="#tab3">Base datos datacredito</a></li>
<?php
		}
?>
			<li><a href="#tab4"<?=$active2?>>Actualizacion de regimen</a></li>
<?php
	}
?>
		</ul>
		<div class="clear"></div>
	</div>
	<!-- End .content-box-header -->
	<div class="content-box-content">
		<div class="tab-content<?=$active11?>" id="tab2">
		    <div class="notification information png_bg">
		        <a href="#" class="close">
		        	<img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
		        </a>
		        <div>
		        	<h3 style="padding-bottom: 0px; color: #FFFF">Cargue de base gestor de ventas.</h3>
		        </div>
		    </div>
			<div class="notification attention png_bg"> 
				<!-- <div id="msg_erradduser">
					No olvide que la base a cargar debe ser en formato XLSX.
				</div> -->
				<ul style="padding-left: 36px; padding-top: 10px;">
					<li>No olvide que la base a cargar debe ser en formato XLSX.</li>
					<li>La base a cargar debe tener una estructura definida, descargue una copia de la estructura <a href="#" onclick="$(this).descargaEstructura(event, 1);"><strong>aquí</strong></a></li>
					<li>La base a cargar debe ser de máximo 2 mil registros, debido al cuidado del rendimiento del servicio y de la aplicación.</li>
				</ul>
			</div>
			<div class="notification success  png_bg" id="result_notif" style="display:none;">
				<a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div id="msg_adduser"></div>
			</div>
			<form method="POST" name="cargueBaseGestorVentas" id="cargueBaseGestorVentas">
				<table>
					<tbody>
						<tr>
							<td style="width: 250px;">Archivo a cargar:</td>
							<td>
								<input type="file" name="file" class="text-input">
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2" style="text-align: right;"><!--style="padding-left: 82%;" -->
								<div style="display: inline;">&nbsp;</div>
								<input type="submit" class="button" value="Cargar base >>" id="botoncargueBaseGestorVentas">
								<div style="display: inline; width: 16px; height: 16px;"><img id="imgloading" src="../../images/icons/loading.gif" style="display: none;" /></div>
							</td>
						</tr>
					</tfoot>
				</table>
				<input type="hidden" name="domain" value="cargue">
				<input type="hidden" name="action" value="cargueBaseGestorVentas">
				<input type="hidden" name="meth" value="js">
			</form> 
		</div>
		<div class="tab-content" id="tab3">
		    <div class="notification information png_bg">
		        <a href="#" class="close">
		        	<img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
		        </a>
		        <div>
		        	<h3 style="padding-bottom: 0px; color: #FFFF">Cargue de datos adicionales datacredito.</h3>
		        </div>
		    </div>
			<div class="notification attention png_bg"> 
				<!-- <div id="msg_erradduser">
					No olvide que la base a cargar debe ser en formato XLSX.
				</div> -->
				<ul style="padding-left: 36px; padding-top: 10px;">
					<li>No olvide que la base a cargar debe ser en formato XLSX.</li>
					<li>La base a cargar debe tener una estructura definida, descargue una copia de la estructura <a href="#" onclick="$(this).descargaEstructura(event, 2);"><strong>aquí</strong></a></li>
					<li>La base a cargar debe ser de máximo 4 mil registros, debido al cuidado del rendimiento del servicio y de la aplicación.</li>
				</ul>
			</div>
			<div class="notification success  png_bg" id="result_notif" style="display:none;">
				<a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div id="msg_adduser"></div>
			</div>
			<form method="POST" name="cargueBaseDatosDatacredito" id="cargueBaseDatosDatacredito">
				<table>
					<tbody>
						<tr>
							<td style="width: 250px;">Archivo a cargar:</td>
							<td>
								<input type="file" name="file" class="text-input">
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2" style="text-align: right;"><!--style="padding-left: 82%;" -->
								<div style="display: inline;">&nbsp;</div>
								<input type="submit" class="button" value="Cargar base >>" id="botoncargueBaseDatosDatacredito">
								<div style="display: inline; width: 16px; height: 16px;"><img id="imgloading" src="../../images/icons/loading.gif" style="display: none;" /></div>
							</td>
						</tr>
					</tfoot>
				</table>
				<input type="hidden" name="domain" value="cargue">
				<input type="hidden" name="action" value="cargueBaseDatosDatacredito">
				<input type="hidden" name="meth" value="js">
			</form> 
		</div>
		<div class="tab-content<?=$active21?>" id="tab4">
		    <div class="notification information png_bg">
		        <a href="#" class="close">
		        	<img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
		        </a>
		        <div>
		        	<h3 style="padding-bottom: 0px; color: #FFFF">Cargue de datos para la actualizacion del regimen del cliente.</h3>
		        </div>
		    </div>
			<div class="notification attention png_bg"> 
				<!-- <div id="msg_erradduser">
					No olvide que la base a cargar debe ser en formato XLSX.
				</div> -->
				<ul style="padding-left: 36px; padding-top: 10px;">
					<li>No olvide que la base a cargar debe ser en formato XLSX.</li>
					<li>La base a cargar debe tener una estructura definida, descargue una copia de la estructura <a href="#" onclick="$(this).descargaEstructura(event, 3);"><strong>aquí</strong></a></li>
					<li>La base a cargar debe ser de máximo 4 mil registros, debido al cuidado del rendimiento del servicio y de la aplicación.</li>
				</ul>
			</div>
			<div class="notification success  png_bg" id="result_notif" style="display:none;">
				<a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div id="msg_adduser"></div>
			</div>
			<form method="POST" name="cargueBaseActualizacionRegimen" id="cargueBaseActualizacionRegimen">
				<table>
					<tbody>
						<tr>
							<td style="width: 250px;">Archivo a cargar:</td>
							<td>
								<input type="file" name="file" class="text-input">
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2" style="text-align: right;"><!--style="padding-left: 82%;" -->
								<div style="display: inline;">&nbsp;</div>
								<input type="submit" class="button" value="Cargar base >>" id="botoncargueBaseActualizacionRegimen">
								<div style="display: inline; width: 16px; height: 16px;"><img id="imgloading" src="../../images/icons/loading.gif" style="display: none;" /></div>
							</td>
						</tr>
					</tfoot>
				</table>
				<input type="hidden" name="domain" value="cargue">
				<input type="hidden" name="action" value="cargueBaseActualizacionRegimen">
				<input type="hidden" name="meth" value="js">
			</form> 
		</div>
	</div>
</div>
<div id="box-errores" style="display:none;">
	<p class="text-center">
		<span>
			Descargue el archivo haciendo click aqui!&nbsp;&nbsp;
		</span>
	</p>
</div>
<script>
$(document).ready(function($) {
	$('form#cargueBaseGestorVentas').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).find('input[name="file"]').val() == ''){
			$('p.text-center > span').html('Debe seleccionar el archivo a cargar, recuerde que debe ser con formato especifico(XLSX).')
			$.facebox({
				div: '#box-errores'
			});
			return false;
		}
		const part = $(this).find('input[name="file"]').val().split('.');
		if(part[(part.length - 1)].toLowerCase() != 'xlsx'){
			$('p.text-center > span').html('Debe seleccionar un archivo con formato especifico(XLSX).')
			$.facebox({
				div: '#box-errores'
			});
			return false;
		}
		const formData = new FormData();

		formData.append('file', $(this).find('input[name="file"]')[0].files[0]);

		$.each($(this).serializeArray(), function(key, input){
			formData.append(input.name, input.value);
		});
		const form = this;
		$.ajax({
			beforeSend: function(){
				$('input#botoncargueBaseGestorVentas').attr('disabled', true);
				$.facebox.loading();
			},
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			type: 'post',
			url: '../includes/Controller.php',
			dataType: 'json',
			success: function(dato){
				if ((!dato.exito && dato.error) || (!dato.exito && !dato.error)) {
					$('p.text-center > span').html(dato.error ? dato.error : 'Ocurrio un error al momento de generar el archivo, contacte con el administrador.');
					$.facebox({
						div: '#box-errores'
					});
					if (!dato.error) console.log(dato);
					return false;
				}
				$('p.text-center > span').html(dato.exito);
				$.facebox({
					div: '#box-errores'
				});
			},
			complete: function(jqXHR, textStatus){
				//$.facebox.close();
				$('input#botoncargueBaseGestorVentas').removeAttr('disabled');
			},
			error: function(xhr, ajaxOptions, thrownError){
				console.log(xhr, ajaxOptions, thrownError);
				$('p.text-center > span').html("Error(cargueBaseGestorVentas): "+xhr.status+" Error: "+xhr.responseText);
				$.facebox({
					div: '#box-errores'
				});
			}
		});
	});
	$('form#cargueBaseDatosDatacredito').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).find('input[name="file"]').val() == ''){
			$('p.text-center > span').html('Debe seleccionar el archivo a cargar, recuerde que debe ser con formato especifico(XLSX).')
			$.facebox({
				div: '#box-errores'
			});
			return false;
		}
		const part = $(this).find('input[name="file"]').val().split('.');
		if(part[(part.length - 1)].toLowerCase() != 'xlsx'){
			$('p.text-center > span').html('Debe seleccionar un archivo con formato especifico(XLSX).')
			$.facebox({
				div: '#box-errores'
			});
			return false;
		}
		const formData = new FormData();

		formData.append('file', $(this).find('input[name="file"]')[0].files[0]);

		$.each($(this).serializeArray(), function(key, input){
			formData.append(input.name, input.value);
		});
		const form = this;
		$.ajax({
			beforeSend: function(){
				$('input#botoncargueBaseDatosDatacredito').attr('disabled', true);
				$.facebox.loading();
			},
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			type: 'post',
			url: '../includes/Controller.php',
			dataType: 'json',
			success: function(dato){
				if ((!dato.exito && dato.error) || (!dato.exito && !dato.error)) {
					$('p.text-center > span').html(dato.error ? dato.error : 'Ocurrio un error al momento de generar el archivo, contacte con el administrador.');
					$.facebox({
						div: '#box-errores'
					});
					if (!dato.error) console.log(dato);
					return false;
				}
				
				$('p.text-center > span').html(dato.exito);
				$.facebox({
					div: '#box-errores'
				});
			},
			complete: function(jqXHR, textStatus){
				//$.facebox.close();
				$('input#botoncargueBaseDatosDatacredito').removeAttr('disabled');
			},
			error: function(xhr, ajaxOptions, thrownError){
				console.log(xhr, ajaxOptions, thrownError);
				$('p.text-center > span').html("Error(cargueBaseDatosDatacredito): "+xhr.status+" Error: "+xhr.responseText);
				$.facebox({
					div: '#box-errores'
				});
			}
		});
	});
	$('form#cargueBaseActualizacionRegimen').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).find('input[name="file"]').val() == ''){
			$('p.text-center > span').html('Debe seleccionar el archivo a cargar, recuerde que debe ser con formato especifico(XLSX).')
			$.facebox({
				div: '#box-errores'
			});
			return false;
		}
		const part = $(this).find('input[name="file"]').val().split('.');
		if(part[(part.length - 1)].toLowerCase() != 'xlsx'){
			$('p.text-center > span').html('Debe seleccionar un archivo con formato especifico(XLSX).')
			$.facebox({
				div: '#box-errores'
			});
			return false;
		}
		const formData = new FormData();

		formData.append('file', $(this).find('input[name="file"]')[0].files[0]);

		$.each($(this).serializeArray(), function(key, input){
			formData.append(input.name, input.value);
		});
		const form = this;
		$.ajax({
			beforeSend: function(){
				$('input#botoncargueBaseActualizacionRegimen').attr('disabled', true);
				$.facebox.loading();
			},
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			type: 'post',
			url: '../includes/Controller.php',
			dataType: 'json',
			success: function(dato){
				if ((!dato.exito && dato.error) || (!dato.exito && !dato.error)) {
					$('p.text-center > span').html(dato.error ? dato.error : 'Ocurrio un error al momento de generar el archivo, contacte con el administrador.');
					$.facebox({
						div: '#box-errores'
					});
					if (!dato.error) console.log(dato);
					return false;
				}
				$('p.text-center > span').html(dato.exito);
				$.facebox({
					div: '#box-errores'
				});
			},
			complete: function(jqXHR, textStatus){
				//$.facebox.close();
				$('input#botoncargueBaseActualizacionRegimen').removeAttr('disabled');
			},
			error: function(xhr, ajaxOptions, thrownError){
				console.log(xhr, ajaxOptions, thrownError);
				$('p.text-center > span').html("Error(cargueBaseActualizacionRegimen): "+xhr.status+" Error: "+xhr.responseText);
				$.facebox({
					div: '#box-errores'
				});
			}
		});
	});
});
$.fn.descargaEstructura = function(e, tipo){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	window.open('../includes/Controller.php?tipo='+tipo+'&domain=cargue&action=descargaEstructura&meth=js', '_blank');
}
</script>
