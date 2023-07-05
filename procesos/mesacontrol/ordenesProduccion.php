<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header_2.php';
require_once PATH_CCLASS . DS . 'form.class.php';
require_once PATH_CCLASS . DS . 'case.class.php';
require_once PATH_CCLASS . DS . 'ordenproduccion.class.php';
?>
<!-- Page Head -->
<h2>Ordenes de producci&oacute;n</h2>
<p id="page-intro">Ordenes de producci&oacute;n creadas por Finleco</p>
<div class="clear"></div> <!-- End .clear -->
<ul class="shortcut-buttons-set"> <!-- Replace the icons URL's with your own -->
    <li>
    	<a class="shortcut-button" href="formulario.php">
    		<span>
                <img src="../../resources/images/icons/pencil.png" alt="icon" />
               	<br>
                Crear orden de producción
            </span>
        </a>
    </li>
</ul>
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"  id="box_search_result">
    <div class="content-box-header">
    	<h3>B&uacute;squeda de ordenes de producci&oacute;n</h3>
    	<ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Buscador</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab3">Generar planilla general</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
            <form method="get" id="form_ordensearch" name="form_ordensearch"><!-- action="ordenesProduccion.php"  -->
                <p>
                	<label>Criterio de búsqueda:</label>
                    <select name="criterio1" id="criterio1" class="small-input">
                        <option value="">-- Seleccione una opción --</option>
                        <option value="1">Planilla</option>
                        <option value="2">Lote</option>
                    </select> 
                </p>
                <p>
                    <label>Texto a buscar:</label>
                    <input class="text-input medium-input" type="text" id="texto" name="texto" /> <span class="input-notification attention png_bg">Campo obligatorio</span>
                    <br />
                    <small>Escriba la información que desea buscar(p.e: 8023656)</small>
                </p>
                <p style="display: initial;">
                    <input type="hidden" name="action" id="action" value="search_orden0">
                    <input class="button" type="submit" id="search_orden" value="Realizar búsqueda">
                    <div id="search_orden_loading" style="width: 16px; height: 16px; display: initial;"><img style="display: none;" src="../../images/icons/loading.gif"><div>
                </p>
            </form>
        </div>
        <div class="tab-content" id="tab3">
            <form method="get" id="generarPlanillaGeneral" name="generarPlanillaGeneral"><!-- action="ordenesProduccion.php"  -->
                <p>
                    <label>Numero de planilla:</label>
                    <input class="text-input small-input" type="text" id="planilla" name="planilla"> <span class="input-notification attention png_bg">Campo obligatorio</span>
                    <br><small>Escriba la información que desea buscar(p.e: 1000)</small>
                </p>
                <p>
                    <input type="hidden" name="action" id="action" value="generarPlanillaGeneral">
                    <input class="button" type="submit" id="button_generarPlanillaGeneral" value="Generar planilla">
                </p>
            </form>
        </div>
    </div>
</div>
<div class="tab-content default-tab" id="tab_resultsearch"></div>
<div class="clear"></div>
<div class="content-box" id="box_search_result">
    <div class="content-box-header">
        <h3>Ordenes de producci&oacute;n</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Ordenes</a></li> <!-- href must be unique and match the id of target div -->            
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
<?php
	//if(isset($_SESSION['id']) && !empty($_SESSION['id']) && !is_null($_SESSION['id']) && $_SESSION['id'] == '1'){
?>
		<small style="padding-bottom: 5px; display: block; margin-left: 14px;">Selecci&oacute;n masiva p&aacute;gina actual</small>
	    <input type="checkbox" name="aprobacion_masiva" id="aprobacion_masiva" value="aprobacion_masiva" onchange="$(this).chequearMasivos(event);" style="margin-left: 14px;">
	    <input class="button" type="submit" id="search_orden" value="Aprobaci&oacute;n masiva" onclick="$(this).aprobacionMasiva(event);">
	    <div id="search_orden_loading" style="width: 16px; height: 16px; display: initial;"><img style="display: none;" src="../../images/icons/loading.gif"><div>
<?php
	//}
?>
        <div class="tab-content default-tab" id="tab2">
            <table id="lista-ordenes" class="display" style="font-size: 12px ! important;">
                <thead>
                    <tr>
                        <th style="width: 5%; max-width: 5%; min-width: 5%; font-size: 12px;" align="center">Editar</th>
                        <th style="width: 5%; max-width: 5%; min-width: 5%;; font-size: 12px;">Planilla</th>
                        <th style="width: 4%; max-width: 4%; min-width: 4%;; font-size: 12px;">Lote</th>
                        <th style="width: 11.5%; max-width: 11.5%; min-width: 11.5%;; font-size: 12px;">Cantidad formularios</th>
                        <th style="width: 8.5%; max-width: 8.5%; min-width: 8.5%;; font-size: 12px;">Devoluciones</th>
                        <th style="width: 7%; max-width: 7%; min-width: 7%;; font-size: 12px;">No llegaron</th>
                        <th style="width: 10%; max-width: 10%; min-width: 10%;; font-size: 12px;">Total formularios</th>
                        <th style="background-color:#ccc000; color: white; width: 12%; max-width: 12%; min-width: 12%;; font-size: 12px;">Formularios digitados</th>
                        <th style="background-color:#ccc000; color: white; width: 12.5%; max-width: 12.5%; min-width: 12.5%;; font-size: 12px;">Devoluciones creadas</th>
                        <th style="background-color:#ccc000; color: white; width: 12%; max-width: 12%; min-width: 12%;; font-size: 12px;">Marcados no llegaron</th>
                        <th style="width: 12.5%; max-width: 12.5%; min-width: 12.5%;; font-size: 12px;">Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th data-search="false"></th>
                        <th data-search="true">Planilla</th>
                        <th data-search="true">Lote</th>
                        <th data-search="true">Cantidad formularios</th>
                        <th data-search="true">Devoluciones</th>
                        <th data-search="true">No llegaron</th>
                        <th data-search="true">Total formularios</th>
                        <th data-search="true">Formularios digitados</th>
                        <th data-search="true">Devoluciones creadas</th>
                        <th data-search="true">Marcados no llegaron</th>
                        <th data-search="true">Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div id="boxEndGenerarPlanilla" style="display:none;"></div>
<div id="boxAprobarOrden" style="display:none;"></div>
<script src="../../resources/scripts/datatables.min.js"></script>
<script src="../../resources/scripts/pdfobject/pdfobject.min.js"></script>
<script>
$(document).ready(function(){
	/*$('input#button_generarPlanillaGeneral').click(function(event) {
		$.facebox({div: '#boxEndGenerarPlanilla'});
	});*/
	//$.fn.buscarTodasLasOrdenes();
	$('table#lista-ordenes').DataTable({
        "processing": true,
        "autoWidth": false,
        "pageLength": 50,
        //"serverSide": true,
        "ajax": {
        	"url": "../../lib/general/procesos.php",
        	"type": "GET",
        	"data": {
        		"action": "buscarTodasLasOrdenes"
        	}
        },
		//data: dato,
		columns: [
			{ "data": "inicio" },
			{ "data": "planilla" },
			{ "data": "lote" },
			{ "data": "cantidad_formularios" },
			{ "data": "devoluciones" },
			{ "data": "no_llegaron" },
			{ "data": "total_formularios" },
			{ "data": "form_digitado" },
			{ "data": "form_devolucion" },
			{ "data": "form_noLlegaron" },
			{ "data": "acciones" }
		],
		"lengthChange": false,
		"language": {
			"paginate": {
				"next": "Siguiente",
				"previous": "Anterior"
			},
			"info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
			"infoEmpty": "Sin datos",
			"emptyTable": "No se encontraron datos para mostrar.",
		    "loadingRecords": "Cargando...",
		    "processing":     "Procesando, por favor espere...",
		},
		drawCallback: function(){
			$('.paginate_button:not(.disabled)', this.api().table().container())
			.on('click', function(){
				if($('input[name="aprobacion_masiva"]').is(':checked'))
					$('input[name="aprobacion_masiva"]').prop('checked', false);
				$('input[name^="check_"]').each(function(index, el) {
					if($(el).is(':checked'))
						$(el).prop('checked', false);
				});
			});
		}
	});
	$('#lista-ordenes tfoot th').each( function(){
		if($(this).attr('data-search') == "true"){
			var title = $(this).text();
			$(this).html( '<input type="text" placeholder="'+title+'" style="width: 100%;">' );
		}
	});
	// DataTable
	var table_82 = $('#lista-ordenes').DataTable();
	table_82.columns().every(function(){
		var that = this;
		$('input', this.footer()).on('keyup change', function(){
			if(that.search() !== this.value){
				that.search(this.value).draw();
			}
		});
	});
	$('form#form_ordensearch').submit(function(event) {
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('form#form_ordensearch select#criterio1').val() == ''){
			alert('Debe seleccionar el criterio de busqueda.');
			$('form#form_ordensearch select#criterio1').focus();
			return false;
		}
		if($('form#form_ordensearch input#texto').val() == ''){
			alert('Debe digitar el texto a buscar.');
			$('form#form_ordensearch input#texto').focus();
			return false;
		}
		var datos = $(this).serialize();
		$.ajax({
			beforeSend: function(){
				$('input#search_orden').attr('disabled', true);
				$('div#search_orden_loading > img').show();
				$('input[name="aprobacion_masiva"]')[0].checked = false;
				//$('form#buscarAsignacionesCliente #button_buscarAsignacionesCliente').button('loading');
				//$('div#content-11').html('');
			},
			data: datos,
			type: 'get',
			url: '../../lib/general/procesos.php',
			dataType: 'json',
			success: function(dato){
				if(dato.data && dato.data.length > 0){
					$('table#lista-ordenes').DataTable().destroy();
					$('table#lista-ordenes').DataTable({
						data: dato.data,
						"pageLength": 30,
						columns: [
							{ "data": "inicio" },
							{ "data": "planilla" },
							{ "data": "lote" },
							{ "data": "cantidad_formularios" },
							{ "data": "devoluciones" },
							{ "data": "no_llegaron" },
							{ "data": "total_formularios" },
							{ "data": "form_digitado" },
							{ "data": "form_devolucion" },
							{ "data": "form_noLlegaron" },
							{ "data": "acciones" }
						],
						"lengthChange": false,
						"language": {
							"paginate": {
								"next": "Siguiente",
								"previous": "Anterior"
							},
							"info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
							"infoEmpty": "Sin datos",
							"emptyTable": "No se encontraron datos para mostrar.",
						    "loadingRecords": "Cargando...",
						    "processing":     "Procesando, por favor espere...",
						},
						drawCallback: function(){
							$('.paginate_button:not(.disabled)', this.api().table().container())
							.on('click', function(){
								if($('input[name="aprobacion_masiva"]').is(':checked'))
									$('input[name="aprobacion_masiva"]').prop('checked', false);
								$('input[name^="check_"]').each(function(index, el) {
									if($(el).is(':checked'))
										$(el).prop('checked', false);
								});
							});
						}
					});
					$('.no-paste-cut').bind('cut paste', function(event){
						(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
						return false;
					});
					$('.input-paste-num').bind('paste', function(){
						var elemnt = this;
						var patron =/[^\W]/;
						var newValue = $(elemnt).val().replace(patron, "");
					})
					$('#lista-ordenes tfoot th').each( function(){
						if($(this).attr('data-search') == "true"){
							var title = $(this).text();
							$(this).html( '<input type="text" placeholder="'+title+'" style="width: 100%;">' );
						}
					});
					// DataTable
					$('#lista-ordenes').DataTable().columns().every(function(){
						var that = this;
						$('input', this.footer()).on('keyup change', function(){
							if(that.search() !== this.value){
								that.search(this.value).draw();
							}
						});
					});
				}else{/*
					$('strong#cliente_nombre').html('');
					$('strong#cliente_documento').html('');
					$('table#lista-ordenes').DataTable().destroy();
					var strHtml = '<table class="display stripe hover cell-border" id="lista-ordenes" style="min-width: 960px; width: 960px; max-width: 960px; font-size: 10px;">'+
						'<thead>'+
							'<tr>'+
								'<th style="width: 3%; text-align: center;"><!--<input type="checkbox" onclick="$(this).checkUncheckTodo(event);">--></th>'+
								'<th style="width: 7%; text-align: center;">Id</th>'+
								'<th style="width: 10%;">Operacion</th>'+
								'<th style="width: 15%;">Direccion</th>'+
								'<th style="width: 13%;">Ciudad</th>'+
								'<th style="width: 8.5%;">Telefono</th>'+
								'<th style="width: 8.5%;">Celular</th>'+
								'<th style="width: 10%;">Producto</th>'+
								'<th style="width: 10%;">Valor mora</th>'+
								'<th style="width: 11%;">Pago minimo</th>'+
								'<th style="width: 4%;">Mora</th>'+
							'</tr>'+
						'</thead>'+
						'<tfoot>'+
							'<tr>'+
								'<th data-search="false"></th>'+
								'<th data-search="true">123456789</th>'+
								'<th data-search="true">Operacion</th>'+
								'<th data-search="true">Direccion</th>'+
								'<th data-search="true">Ciudad</th>'+
								'<th data-search="true">Telefono</th>'+
								'<th data-search="true">Celular</th>'+
								'<th data-search="true">Producto</th>'+
								'<th data-search="true">Valor mora</th>'+
								'<th data-search="true">Pago minimo</th>'+
								'<th data-search="true">Mora</th>'+
							'</tr>'+
						'</tfoot>'+
					'</table>';
					$('div#content-asignaciones').html(strHtml);
					$('table#lista-ordenes').DataTable({
						"autoWidth": false,
						"searching": false,
						"lengthChange": false,
						"language": {
							"paginate": {
								"next": "Siguiente",
								"previous": "Anterior"
							},
							"info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
							"infoEmpty": "Sin datos",
							"emptyTable": "No se encontraron datos para mostrar.",
							"loadingRecords": "Cargando...",
							"processing": "Procesando, por favor espere...",
						}
					});
					$('#lista-ordenes tfoot th').each( function(){
						if($(this).attr('data-search') == "true"){
							var title = $(this).text();
							$(this).html( '<input type="text" placeholder="'+title+'" style="width: 100%;">' );
						}
					});
					// DataTable
					var lista-ordenes = $('#lista-ordenes').DataTable();
					lista-ordenes.columns().every(function(){
						var that = this;
						$('input', this.footer()).on('keyup change', function(){
							if(that.search() !== this.value){
								that.search(this.value).draw();
							}
						});
					});*/
					$('table#lista-ordenes').DataTable().destroy();
					$('table#lista-ordenes').DataTable({
						data: [],
						"pageLength": 5,
						columns: [
							{ "data": "inicio" },
							{ "data": "planilla" },
							{ "data": "lote" },
							{ "data": "cantidad_formularios" },
							{ "data": "devoluciones" },
							{ "data": "no_llegaron" },
							{ "data": "total_formularios" },
							{ "data": "form_digitado" },
							{ "data": "form_devolucion" },
							{ "data": "form_noLlegaron" },
							{ "data": "acciones" }
						],
						"lengthChange": false,
						"language": {
							"paginate": {
								"next": "Siguiente",
								"previous": "Anterior"
							},
							"info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
							"infoEmpty": "Sin datos",
							"emptyTable": "No se encontraron datos para mostrar.",
						    "loadingRecords": "Cargando...",
						    "processing":     "Procesando, por favor espere...",
						}
					});
					$('.no-paste-cut').bind('cut paste', function(event){
						(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
						return false;
					});
					$('.input-paste-num').bind('paste', function(){
						var elemnt = this;
						var patron =/[^\W]/;
						var newValue = $(elemnt).val().replace(patron, "");
					})
					$('#lista-ordenes tfoot th').each( function(){
						if($(this).attr('data-search') == "true"){
							var title = $(this).text();
							$(this).html( '<input type="text" placeholder="'+title+'" style="width: 100%;">' );
						}
					});
					// DataTable
					$('#lista-ordenes').DataTable().columns().every(function(){
						var that = this;
						$('input', this.footer()).on('keyup change', function(){
							if(that.search() !== this.value){
								that.search(this.value).draw();
							}
						});
					});
				}
			},
			complete: function(jqXHR, textStatus){
				$('input#search_orden').removeAttr('disabled');
				$('div#search_orden_loading > img').hide();
				//$('form#buscarAsignacionesCliente #button_buscarAsignacionesCliente').button('reset');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert("Error(buscarAsignacionesCliente): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
	$('form#generarPlanillaGeneral').submit(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($('form#generarPlanillaGeneral input[name="planilla"]').val() == ''){
			alert('Debe digitar el numero de la planilla para poder generarla.');
			$('form#generarPlanillaGeneral input[name="planilla"]').focus();
			return false;
		}
		var datos = $(this).serialize();
		$.ajax({
			data: datos,
			type: 'get',
			url: 'procesos.php',
			dataType: 'json',
			success: function(dato){
				if(dato.exito && dato.file_name){
					console.log(dato);
					var options = {
						width: "850px",
						height: "500px"
					};
					var file = dato.path + dato.file_name;
					PDFObject.embed(file, "#boxEndGenerarPlanilla", options);
				}else{
					var message = '';
					if(dato.exito)
						message = dato.exito;
					else
						message = dato.error;
					$('div#boxEndGenerarPlanilla').html(message);
				}
				$.facebox({div: 'div#boxEndGenerarPlanilla'});
			},
			complete: function(jqXHR, textStatus){
				//$('form#buscarAsignacionesCliente #button_buscarAsignacionesCliente').button('reset');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert("Error(buscarAsignacionesCliente): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
});
$.fn.buscarTodasLasOrdenes = function(){
	var datos = "action=buscarTodasLasOrdenes";
	$.ajax({
		data: datos,
		type: 'get',
		url: '../../lib/general/procesos.php',
		dataType: 'json',
		success: function(dato){
			$('table#lista-ordenes').DataTable({
				data: dato,
				columns: [
					{ "data": "inicio" },
					{ "data": "planilla" },
					{ "data": "lote" },
					{ "data": "cantidad_formularios" },
					{ "data": "devoluciones" },
					{ "data": "no_llegaron" },
					{ "data": "total_formularios" },
					{ "data": "form_digitado" },
					{ "data": "form_devolucion" },
					{ "data": "form_noLlegaron" },
					{ "data": "acciones" }
				],
				"processing": true,
		        'searching': false,
				"lengthChange": false,
				"language": {
					"paginate": {
						"next": "Siguiente",
						"previous": "Anterior"
					},
					"info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
					"infoEmpty": "Sin datos",
					"emptyTable": "No se encontraron datos para mostrar."
				}
			});
			$('#lista-ordenes tfoot th').each( function(){
				if($(this).attr('data-search') == "true"){
					var title = $(this).text();
					$(this).html( '<input type="text" placeholder="'+title+'" style="width: 100%;">' );
				}
			});
			// DataTable
			var table_82 = $('#lista-ordenes').DataTable();
			table_82.columns().every(function(){
				var that = this;
				$('input', this.footer()).on('keyup change', function(){
					if(that.search() !== this.value){
						that.search(this.value).draw();
					}
				});
			});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr, ajaxOptions, thrownError);
			alert('Ocurrio el siguiente error:\n' + thrownError + '\n' + xhr.responseText);
		}
	});
}
$.fn.aprobarOrderProduccion = function(e, orden_id, cantidad_datos, tipo){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	var confirmacion = false;
	if(tipo == 1)
		confirmacion = confirm('Esta seguro que desea aprobar orden?');
	if((tipo == 1 && confirmacion) || tipo == 2){
		var datos = 'action=aprobarOrderProduccion&orden_id=' + orden_id + '&cantidad_datos=' + cantidad_datos;
		$.ajax({
			beforeSend: function(){
				//$('form#formTareasBase #button_formTareasBase').button('loading');
				//$("div#content-11").mCustomScrollbar('destroy');
				//$('div#content-11').html('');
				$('div#div_img_loading_' + orden_id).css('display', 'initial');
			},
			data: datos,
			type: 'post',
			url: 'procesos.php',
			dataType: 'json',
			success: function(dato){
				if(dato.exito){
					if(tipo == 1){
						$('div#boxAprobarOrden').html(dato.exito);
						$.facebox({div: 'div#boxAprobarOrden'});
					}else if(tipo == 2){
						$('input[name="check_' + orden_id + '"]')[0].checked = false;
						$('input[name="check_' + orden_id + '"]').attr('disabled', true);
					}
					$('a#a_edit_orden_' + orden_id).remove();
					$('a#a_del_orden_' + orden_id).remove();
					$('a#button_aprobar_' + orden_id).parent().html('<img src="../../resources/images/icons/tick_circle.png" alt="icon" class="aprobado">');
				}else if(dato.error){
					$('div#boxAprobarOrden').html(dato.error);
					$.facebox({div: 'div#boxAprobarOrden'});
				}else{
					console.log(dato);
					$('div#boxAprobarOrden').html("Ocurrio un error al momento de la aprobacion, contacte con el administrador...");
					$.facebox({div: 'div#boxAprobarOrden'});
				}
			},
			complete: function(jqXHR, textStatus){
				//$('form#buscarAsignacionesCliente #button_buscarAsignacionesCliente').button('reset');
				$('div#div_img_loading_' + orden_id).css('display', 'none');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert('Ocurrio el siguiente error:\n' + thrownError + '\n' + xhr.responseText);
			}
		});
	}
}
$.fn.aprobacionMasiva = function(e){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	if(confirm('Esta seguro que desea realizar la aprobacion masiva de las ordenes seleccionadas?')){
		var datos = $('table#lista-ordenes').DataTable().rows( {page:'current'} ).data();
		var tam = datos.length;
		var si_puede = false;
		for(var i = 0; i < tam; i++){
			if($('input[name="check_' + datos[i].id + '"]').is(':checked')){
				si_puede = true;
				var cantidad_datos = parseInt(datos[i].devoluciones) + parseInt(datos[i].total_formularios);
				$.fn.aprobarOrderProduccion(e, datos[i].id, cantidad_datos, 2);
			}
		}
		if(!si_puede)
			alert('No selecciono ninguna orden para aprobar masivamente.');
		else{
			$('input[name="aprobacion_masiva"]').prop('checked', false);
			$('div#boxAprobarOrden').html('La aprobacion de las ordenes seleccionadas se realizo satisfactoriamente.');
			$.facebox({div: 'div#boxAprobarOrden'});
		}
	}
};
$.fn.chequearMasivos = function(e){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	var datos = $('table#lista-ordenes').DataTable().rows( {page:'current'} ).data();
	console.log($('table#lista-ordenes').DataTable().rows( {page:'current'} ).data());
	var check = false;
	if($(this).is(':checked')){
		console.log("CHEQUEADO");
		check = true;
	}else{
		console.log("NO CHEQUEADO");
	}
	if(datos.length > 0){
		var tam = datos.length;
		for(var i = 0; i < tam; i++){
			if(check === true){
				if(datos[i].se_puede_aprobar && !$('input[name="check_' + datos[i].id + '"]').is(':disabled')){
					$('input[name="check_' + datos[i].id + '"]')[0].checked = true;
				}
			}else{
				$('input[name="check_' + datos[i].id + '"]')[0].checked = false;
			}
		}
	}
};
$.fn.eliminarOrderProduccion = function(e, orden_id){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	var este = this;
	if(confirm('Esta seguro que desea eliminar la orden?')){
		var datos = 'action=eliminarOrderProduccion&orden_id=' + orden_id;
		$.ajax({
			beforeSend: function(){
				$('div#div_img_loading_' + orden_id).css('display', 'initial');
			},
			data: datos,
			type: 'post',
			url: 'procesos.php',
			dataType: 'json',
			success: function(dato){
				if(dato.exito){
					$('div#boxAprobarOrden').html(dato.exito);
					$.facebox({div: 'div#boxAprobarOrden'});

					var table = $('table#lista-ordenes').DataTable();
					var info = table.page.info();
					var row = $(este).parents('tr');
					table.row(row).remove().draw();

					if((info.pages - 1) > info.page){
						table.page(info.page).draw('page');
					}

				}else if(dato.error){
					$('div#boxAprobarOrden').html(dato.error);
					$.facebox({div: 'div#boxAprobarOrden'});
				}else{
					console.log(dato);
					$('div#boxAprobarOrden').html("Ocurrio un error al momento de la aprobacion, contacte con el administrador...");
					$.facebox({div: 'div#boxAprobarOrden'});
				}
			},
			complete: function(jqXHR, textStatus){
				$('div#div_img_loading_' + orden_id).css('display', 'none');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
				alert('Ocurrio el siguiente error:\n' + thrownError + '\n' + xhr.responseText);
			}
		});

	}
};
</script>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
