<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8", "2"]) && !isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'radicador') {
	echo "No tiene permiso para esta �rea";
	exit;
}

require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header_2.php';
require_once PATH_CCLASS . DS . 'general.class.php';
?>

<!-- Page Head -->
<h2>Cargue de bases complementarias para el proceso gestor de ventas</h2>
<p id="page-intro">Informaci&oacute;n complementaria del gestor de ventas.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
	<div class="content-box-header">
		<!-- <h3>Parametros</h3> -->
		<ul class="content-box-tabs">
			<li><a href="#tab2" class="default-tab">Base gestor de ventas</a></li>
		</ul>
		<div class="clear"></div>
	</div>
	<!-- End .content-box-header -->
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab2">
			<div class="notification attention png_bg"> 
				<!-- <div id="msg_erradduser">
					No olvide que la base a cargar debe ser en formato XLSX.
				</div> -->
				<ul style="padding-left: 36px; padding-top: 10px;">
					<li>No olvide que la base a cargar debe ser en formato XLSX.</li>
					<li>La base a cargar debe tener una estructura definida, descargue una copia de la estructura <a href="#" onclick="$(this).descargaEstructura(event);"><strong>aquí</strong></a></li>
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
								<input type="file" name="file" id="file"class="text-input">
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
});
$.fn.descargaEstructura = function(e){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	window.open('../includes/Controller.php?tipo=1&domain=cargue&action=descargaEstructura&meth=js', '_blank');
}
</script>
