<?php
session_start();
if(!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8"]) && !isset($_SESSION['id']) && !in_array($_SESSION['id'], ["1184", "1305"])) {
	echo "No tiene permiso para esta área" . $_SESSION['group'];
	exit;
}

require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header_2.php';
require_once PATH_CLASS . DS . '_conexion.php';
require_once PATH_CCLASS . DS . 'form.class.php';
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'user.class.php';

$form = new Form();
$planillas = $form->getPlanillasLog();
$general = new General();
$sucursales = $general->getSucursales();
$tareas = User::obtenerTareas();
$gestores = User::obtenerUsuariosOperacion();
?>
<link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/tipsy.css" type="text/css" media="screen">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?=SITE_ROOT?>/resources/scripts/jquery.tipsy.js" type="text/javascript" charset="utf-8"></script>
<!-- Page Head -->
<h2>Reporte interno de productividad</h2>
<p id="page-intro">Detalle de la productividad de los asesores en DocFinder.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
      <div class="content-box-header">
        <h3>Parametros de generaci&oacute;n</h3>

        <ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Reporte diario</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab3">Reporte por rango de fechas</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab4">Reporte productividad</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab5">Reporte de gesti&oacute;n</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
    	<div class="tab-content default-tab" id="tab2">
    		<form method="POST" name="reporteProductivivdadDiaria" id="reporteProductivivdadDiaria">
    			<p>
					<label>Fecha:</label>
					<input class="classpickerfecha text-input" style="width: 100px;" type="text" name="fecha">(YYYY-MM-DD)
				</p>
				<p style="display: table;">
					<input class="button" type="submit" value="Generar reporte >>" id="input_reporteProductivivdadDiaria" style="display: table-cell;">
					<img src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none; vertical-align: middle; margin-left: 5px;" id="loading_reporteProductivivdadDiaria">
				</p>
				<p>
					<input type="hidden" name="action" value="reporteProductivivdadDiaria">
				</p>
			</form>
			<div style="display: none; width: 39px; height: 15px;" id="img_generarReporteProductivivdadDiaria" title="Descargue copia del reporte aqui!">
				<a href="#" onclick="$(this).generarReporteProductivivdadDiaria(event);"><img src="<?=SITE_ROOT?>/images/icons/xlsx_icon.png" alt=""></a>
				<div class="tipsy tipsy-w" style="top: 300px; left: 320px; visibility: visible; display: block; opacity: 0.8;"><div class="tipsy-arrow"></div><div class="tipsy-inner">Descargue copia del reporte aqui!</div></div>
			</div>
			<div class="col-md-12" style="height: 300px;">
				<canvas id="myChart_cumpli" width="100%" height="20"></canvas>
			</div>
        </div>
        <div class="tab-content" id="tab3">
        	<form method="POST" name="reporteProductividadRango" id="reporteProductividadRango">
				<p>
					<strong>Fecha incial:</strong>
					<input class="classpickerfecha text-input" style="width: 100px; margin-right: 20px;" type="text" name="fechaini">
					<strong>Fecha final:</strong>
					<input class="classpickerfecha text-input" style="width: 100px; margin-right: 20px;" type="text" name="fechafin">
					<strong>Actividad:</strong>
					<select name="tarea_id" style="margin-right: 20px;">
						<option value="">Seleccionar...</option>
<?php
foreach($tareas as $tarea){
?>
						<option value="<?=$tarea['id']?>"><?=$tarea['descripcion']?></option>
<?php
}
?>
					</select>
					<strong>Gestor:</strong>
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
					<input class="button" type="submit" value="Generar reporte >>" id="input_reporteProductividadRango">
				</p>
				<input type="hidden" name="action" value="reporteProductividadRango">
			</form>
			<!-- <div style="/*display: none; */width: 39px; height: 15px;" id="img_generarReporteProductividadRango" title="Descargue copia del reporte aqui!">
				<a href="#" onclick="$(this).generarReporteProductividadRango(event);"><img src="../../images/icons/xlsx_icon.png" alt=""></a>
			</div> -->
			<div class="col-md-12" style="height: 300px;">
				<canvas id="myChart_cumpli_line" width="100%" height="20"></canvas>
			</div>
			<iframe width="1" height="1" id="gpr_rep1" name="gpr_rep1" style="visibility:hidden"></iframe>
        </div>
        <div class="tab-content" id="tab4">
        	<form method="GET" name="reporteProductividadTarea" id="reporteProductividadTarea">
				<p>
					<strong>Fecha incial:</strong>
					<input class="classpickerfecha text-input" style="width: 100px; margin-right: 20px;" type="text" name="fechaini">
					<strong>Fecha final:</strong>
					<input class="classpickerfecha text-input" style="width: 100px; margin-right: 20px;" type="text" name="fechafin">
					<strong>Actividad:</strong>
					<select name="tarea_id" style="margin-right: 20px;">
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
					<input class="button" type="submit" value="Generar reporte >>" id="input_reporteProductividadTarea">
				</p>
				<input type="hidden" name="domain" value="meta">
				<input type="hidden" name="action" value="reporteProductividadTarea">
				<input type="hidden" name="meth" value="js">
			</form>
        </div>
        <div class="tab-content" id="tab5">
        	<form method="POST" name="reporteGestionDocumental" id="reporteGestionDocumental">
				<p>
					<strong>Fecha incial:</strong>
					<input class="classpickerfecha text-input" style="width: 100px; margin-right: 20px;" type="text" name="fecha_ini" id="fecha_ini">
					<strong>Fecha final:</strong>
					<input class="classpickerfecha text-input" style="width: 100px; margin-right: 20px;" type="text" name="fecha_fin" id="fecha_fin">
				</p>
				<p>
					<div id="div-botton-gestion-documental">
						<input class="button" type="submit" value="Generar reporte >>" id="input_reporteGestionDocumental">
						<img src="<?=SITE_ROOT?>/images/icons/loading.gif" alt="Cargando..." style="display: none;">
					</div>
				</p>
				<input type="hidden" name="domain" value="reporte">
				<input type="hidden" name="action" value="reporteGestionDocumental">
				<input type="hidden" name="meth" value="js">
			</form>
        </div>
    </div>
</div>
<div id="box-descarga-archivo" style="display:none;">
	<p class="text-center">
		<a href="#">
			Descargue el archivo haciendo click aqui!&nbsp;&nbsp;
		</a>
	</p>
</div>
<div id="clientlist_div"></div>
<script type="text/javascript">
$(document).ready(function(){
	const ctx5 = document.getElementById('myChart_cumpli').getContext('2d');
	const myChart_cumpli = new Chart(ctx5, {
		type: 'bar',
		data: {
			labels: [],
			datasets: [{
				label: 'Productividad',
				data: [],
				backgroundColor: ["rgba(255, 105, 40, 0.7)"],
				borderColor: ["rgba(255, 105, 40, 1)"],
				borderWidth: 1
			},
			{
				label: 'Meta diaria',
				data: [],
				backgroundColor: ["rgba(255, 194, 40, 0.7)"],
				borderColor: ["rgba(255, 194, 40, 1)"],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
	const ctx4 = document.getElementById('myChart_cumpli_line').getContext('2d');
	const myChart_cumpli_line = new Chart(ctx4, {
		type: 'line',
		data: {
			labels: [],
			datasets: [{
				label: 'Productividad',
				data: [],
				backgroundColor: ["rgba(255, 105, 40, 0.7)"],
				borderColor: ["rgba(255, 105, 40, 1)"],
				borderWidth: 3
			},
			{
				label: 'Meta diaria',
				data: [],
				backgroundColor: ["rgba(255, 194, 40, 0.7)"],
				borderColor: ["rgba(255, 194, 40, 1)"],
				borderWidth: 3
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
	$('form#reporteProductivivdadDiaria').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('input[name="fecha"]', this).val() == ''){
			alert('Debe seleccionar la fecha para la meta.');
			$('input[name="fecha"]', this).focus();
			return false;
		}
		const form = this;
		$.ajax({
			beforeSend: function(){
				$('input#input_reporteProductivivdadDiaria').attr('disabled', true);
				$('img#loading_reporteProductivivdadDiaria').show();
			},
			data: $(form).serialize(),
			type: 'post',
			url: '../../lib/general/procesos.php',
			dataType: 'json',
			success: function(dato){
				if (!dato.exito || !dato.items) {
					myChart_cumpli.data.datasets[0].data = [];
					myChart_cumpli.data.datasets[0].backgroundColor = [];
					myChart_cumpli.data.datasets[0].borderColor = [];
					myChart_cumpli.data.datasets[1].data = [];
					myChart_cumpli.data.datasets[1].backgroundColor = [];
					myChart_cumpli.data.datasets[1].borderColor = [];
					myChart_cumpli.data.labels = [];
					myChart_cumpli.update();
					if (dato.exito) alert(dato.exito);
					else {
						alert(dato.error ? dato.error : 'Ocurrio un error interno, contacte con el administrador.');
						if (!dato.error) console.log(dato);
					}
					$('div#img_generarReporteProductivivdadDiaria').hide();
					return false;
				}
				const cant = dato.items.length;
				let labels = [];
				let colBaPro = [];
				let colBoPro = [];
				let colBaMet = [];
				let colBoMet = [];
				let met = [];
				let pro = [];
				for(let i = 0; i < cant; i++){
					met[i] = dato.items[i].meta_diaria;
					pro[i] = dato.items[i].cantidad;
					colBaPro[i] = "rgba(255, 105, 40, 0.7)";
					colBoPro[i] = "rgba(255, 105, 40, 1)";
					colBaMet[i] = "rgba(255, 194, 40, 0.7)";
					colBoMet[i] = "rgba(255, 194, 40, 1)";
					labels[i] = dato.items[i].gestor_usuario + ' - ' + dato.items[i].actividad;
				}
				myChart_cumpli.data.datasets[0].data = pro;
				myChart_cumpli.data.datasets[0].backgroundColor = colBaPro;
				myChart_cumpli.data.datasets[0].borderColor = colBoPro;
				myChart_cumpli.data.datasets[1].data = met;
				myChart_cumpli.data.datasets[1].backgroundColor = colBaMet;
				myChart_cumpli.data.datasets[1].borderColor = colBoMet;
				myChart_cumpli.data.labels = labels;
				myChart_cumpli.update();
				$('div#img_generarReporteProductivivdadDiaria').show();
			},
			complete: function(jqXHR, textStatus){
				$('input#input_reporteProductivivdadDiaria').removeAttr('disabled');
				$('img#loading_reporteProductivivdadDiaria').hide();
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert("Error(reporteProductivivdadDiaria): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
	$('form#reporteProductividadRango').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('input[name="fechaini"]', this).val() == ''){
			alert('Debe seleccionar la fecha inicial.');
			$('input[name="fechaini"]', this).focus();
			return false;
		}
		if($('input[name="fechafin"]', this).val() == ''){
			alert('Debe seleccionar la fecha final.');
			$('input[name="fechafin"]', this).focus();
			return false;
		}
		if($('select[name="tarea_id"]', this).val() == ''){
			alert('Debe seleccionar la actividad.');
			$('select[name="tarea_id"]', this).focus();
			return false;
		}
		if($('select[name="gestor_id"]', this).val() == ''){
			alert('Debe seleccionar el gestor.');
			$('select[name="gestor_id"]', this).focus();
			return false;
		}
		const form = this;
		$.ajax({
			beforeSend: function(){
				$('input#input_reporteProductividadRango').attr('disabled', true);
			},
			data: $(form).serialize(),
			type: 'post',
			url: '../../lib/general/procesos.php',
			dataType: 'json',
			success: function(dato){
				if(dato.exito && dato.items){
					myChart_cumpli_line.data.datasets[0].data = [];
					myChart_cumpli_line.data.datasets[0].backgroundColor = [];
					myChart_cumpli_line.data.datasets[0].borderColor = [];
					myChart_cumpli_line.data.datasets[1].data = [];
					myChart_cumpli_line.data.datasets[1].backgroundColor = [];
					myChart_cumpli_line.data.datasets[1].borderColor = [];
					myChart_cumpli_line.data.labels = [];
					myChart_cumpli_line.update();
					if (dato.exito) alert(dato.exito);
					else {
						alert(dato.error ? dato.error : 'Ocurrio un error interno, contacte con el administrador.');
						if (!dato.error) console.log(dato);
					}
					return false;
				}
				const cant = dato.items.length;
				let labels = [];
				let colBaPro = "";
				let colBoPro = "";
				let colBaMet = "";
				let colBoMet = "";
				let met = [];
				let pro = [];
				for(let i = 0; i < cant; i++){
					met[i] = dato.items[i].meta_diaria;
					pro[i] = dato.items[i].cantidad;
					colBaPro = "rgba(255, 105, 40, 0.1)";
					colBoPro = "rgba(255, 105, 40, 1)";
					colBaMet = "rgba(255, 194, 40, 0.1)";
					colBoMet = "rgba(255, 194, 40, 1)";
					labels[i] = dato.items[i].dia_mes;
				}
				myChart_cumpli_line.data.datasets[0].data = pro;
				myChart_cumpli_line.data.datasets[0].backgroundColor = colBaPro;
				myChart_cumpli_line.data.datasets[0].borderColor = colBoPro;
				myChart_cumpli_line.data.datasets[1].data = met;
				myChart_cumpli_line.data.datasets[1].backgroundColor = colBaMet;
				myChart_cumpli_line.data.datasets[1].borderColor = colBoMet;
				myChart_cumpli_line.data.labels = labels;
				myChart_cumpli_line.update();
			},
			complete: function(jqXHR, textStatus){
				$('input#input_reporteProductividadRango').removeAttr('disabled');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert("Error(reporteProductividadRango): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
	$('form#reporteProductividadTarea').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('input[name="fechaini"]', this).val() == ''){
			alert('Debe seleccionar la fecha inicial.');
			$('input[name="fechaini"]', this).focus();
			return false;
		}
		if($('input[name="fechafin"]', this).val() == ''){
			alert('Debe seleccionar la fecha final.');
			$('input[name="fechafin"]', this).focus();
			return false;
		}
		if($('select[name="tarea_id"]', this).val() == ''){
			alert('Debe seleccionar la actividad.');
			$('select[name="tarea_id"]', this).focus();
			return false;
		}
		const datedif = $.fn.datediff($('input[name="fechaini"]', this).val(), $('input[name="fechafin"]', this).val());
		if(datedif <= 0 || datedif > 31){
			alert('Este reporte solo se puede generar para un rango de 31 dias maximo, por favor revise el rango de fechas.');
			return false
		}
		const form = this;
		$.ajax({
			beforeSend: function(){
				$('input#input_reporteProductividadTarea').attr('disabled', true);
				$.facebox.loading();
			},
			data: $(form).serialize(),
			type: 'get',
			url: '../includes/Controller.php',
			dataType: 'json',
			success: function(dato){
				if(!dato.exito || !dato.file_name){
					if (dato.exito) alert(dato.exito);
					else {
						alert(dato.error ? dato.error : 'Ocurrio un error al momento de generar el archivo, contacte con el administrador.');
						if (!dato.error) console.log(dato);
					}
					return false;
				}
				$('div#box-descarga-archivo > p > a').attr('onclick', `$(this).descargarReporteGenerado(event, '${dato.file_name}', 'reporte')`);
				$('div#box-descarga-archivo > p > a').attr('href', '#' + dato.file_name);
				$.facebox({
					div: '#box-descarga-archivo',
					checkClose: true
				});
			},
			complete: function(jqXHR, textStatus){
				$('input#input_reporteProductividadTarea').removeAttr('disabled');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert("Error(reporteProductividadTarea): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
	$('form#reporteGestionDocumental').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('input[name="fecha_ini"]', this).val() == ''){
			alert('Debe seleccionar la fecha inicial.');
			$('input[name="fecha_ini"]', this).focus();
			return false;
		}
		if($('input[name="fecha_fin"]', this).val() == ''){
			alert('Debe seleccionar la fecha final.');
			$('input[name="fecha_fin"]', this).focus();
			return false;
		}
		const form = this;
		$.ajax({
			beforeSend: function(){
				$('input#input_reporteGestionDocumental').attr('disabled', true);
				$('div#div-botton-gestion-documental > img').show();
				$.facebox.loading();
			},
			data: $(form).serialize(),
			type: 'get',
			url: '../includes/Controller.php',
			dataType: 'json',
			success: function(dato){
				if(!dato.exito || !dato.file_name){
					if (dato.exito) alert(dato.exito);
					else {
						alert(dato.error ? dato.error : 'Ocurrio un error al momento de generar el archivo, contacte con el administrador.');
						if (!dato.error) console.log(dato);
					}
					return false;
				}
				$('div#box-descarga-archivo > p > a').attr('onclick', `$(this).descargarReporteGenerado(event, '${dato.file_name}', 'reporte')`);
				$('div#box-descarga-archivo > p > a').attr('href', '#' + dato.file_name);
				$.facebox({
					div: '#box-descarga-archivo',
					checkClose: true
				});
			},
			complete: function(jqXHR, textStatus){
				//$('form#buscarAsignacionesCliente #button_buscarAsignacionesCliente').button('reset');
				$('input#input_reporteGestionDocumental').removeAttr('disabled');
				$('div#div-botton-gestion-documental > img').hide();
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert("Error(reporteGestionDocumental): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
});
$.fn.generarReporteProductivivdadDiaria = function(e){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	if($('form#reporteProductivivdadDiaria input[name="fecha"]').val() == ''){
		alert('Debe seleccionar la fecha para la meta.');
		$('form#reporteProductivivdadDiaria input[name="fecha"]').focus();
		return false;
	}
	$.ajax({
		beforeSend: function(){
			$('input#input_reporteProductivivdadDiaria').attr('disabled', true);
			$('img#loading_reporteProductivivdadDiaria').show();
			$.facebox.loading();
		},
		data: {
			domain: 'meta',
			action: 'generarReporteProductivivdadDiaria',
			meth: 'js',
			fecha: $('form#reporteProductivivdadDiaria input[name="fecha"]').val()
		},
		type: 'get',
		url: '../includes/Controller.php',
		dataType: 'json',
		success: function(dato){
			if (!dato.exito || !dato.file_name) {
				if (dato.exito) alert(dato.exito);
				else {
					alert(dato.error ? dato.error : 'Ocurrio un error al momento de generar el archivo, contacte con el administrador.');
					if (!dato.error) console.log(dato);
				}
				return false;
			}
			$('div#box-descarga-archivo > p > a').attr('onclick', '$(this).descargarReporteGenerado(event, \''+dato.file_name+'\', \'reporte\')');
			$('div#box-descarga-archivo > p > a').attr('href', '#'+dato.file_name);
			$.facebox({
				div: '#box-descarga-archivo',
				checkClose: true
			});
		},
		complete: function(jqXHR, textStatus){
			$('input#input_reporteProductivivdadDiaria').removeAttr('disabled');
			$('img#loading_reporteProductivivdadDiaria').hide();
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr, ajaxOptions, thrownError);
			alert("Error(generarReporteProductivivdadDiaria): "+xhr.status+" Error: "+xhr.responseText);
		}
	});
};
$.fn.generarReporteProductividadRango = function(e){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	const datedif = $.fn.datediff($('form#reporteProductividadRango input[name="fechaini"]').val(), $('form#reporteProductividadRango input[name="fechafin"]').val());
	if(datedif <= 0 || datedif > 31){
		alert('Este reporte solo se puede generar para un rango de 31 dias maximo, por favor revise el rango de fechas.');
		return false
	}
	const fechaini = $('form#reporteProductividadRango input[name="fechaini"]').val();
	const fechafin = $('form#reporteProductividadRango input[name="fechafin"]').val();
	const tarea_id = $('form#reporteProductividadRango select[name="tarea_id"]').val();
	const gestor_id = $('form#reporteProductividadRango select[name="gestor_id"]').val();
	$('iframe#gpr_rep1').attr('src', `../meta/procesos.php?domain=gestion&action=generarReporteProductividadRango&dias=${datedif}&fechaini=${fechaini}&fechafin=${fechafin}&tarea_id=${tarea_id}&gestor_id=${gestor_id}`);
};
$.fn.datediff = function(date1, date2){
	const d1 = date1.split('-');
	const d2 = date2.split('-');

	const dat1 = new Date(d1[0], d1[1] - 1, d1[2]);
	const dat2 = new Date(d2[0], d2[1] - 1, d2[2]);

	return Math.round((dat2 - dat1) / (1000 * 60 * 60 * 24)) + 1;
}
$.fn.descargarReporteGenerado = function(e, file_name, dominio){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	const win = window.open(`../includes/Controller.php?domain=${dominio}&action=descargarReporteGenerado&meth=js&file=${file_name}`, '_blank');
	win.focus();
}
</script>
<?php 
require_once PATH_SITE . DS . 'template/general/footer.php';
