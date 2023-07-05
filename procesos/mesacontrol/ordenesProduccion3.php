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
                    <br /><small>Escriba la información que desea buscar(p.e: 8023656)</small>
                </p>
                <p>
                    <input type="hidden" name="action" id="action" value="search_orden0" />
                    <input class="button" type="submit" id="search_orden" value="Realizar búsqueda " />
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
<script src="../../resources/scripts/datatables.min.js"></script>
<script>
$(document).ready(function(){
	//$.fn.buscarTodasLasOrdenes();
	$('table#lista-ordenes').DataTable({
        "processing": true,
        "autoWidth": false,
        "pageLength": 20,
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
			data: datos,
			type: 'get',
			url: '../../lib/general/procesos.php',
			dataType: 'json',
			success: function(dato){
				if(dato.exito && dato.items){
					$('table#table_asignaciones').DataTable().destroy();
					$('table#table_asignaciones').DataTable({
						data: dato.items,
						"pageLength": 5,
						columns: [
							{ "data": "check_cli", "className": "dt-center" },
							{ "data": "id" },
							{ "data": "operacion" },
							{ "data": "direccion" },
							{ "data": "ciudad" },
							{ "data": "tel1" },
							{ "data": "cel1" },
							{ "data": "detalle_producto" },
							{ "data": "valor_mora_str" },
							{ "data": "pago_min_str" },
							{ "data": "dias_mora" }
						],
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
					$('.no-paste-cut').bind('cut paste', function(event){
						(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
						return false;
					});
					$('.input-paste-num').bind('paste', function(){
						var elemnt = this;
						var patron =/[^\W]/;
						var newValue = $(elemnt).val().replace(patron, "");
					})
					$('#table_asignaciones tfoot th').each( function(){
						if($(this).attr('data-search') == "true"){
							var title = $(this).text();
							$(this).html( '<input type="text" placeholder="'+title+'" style="width: 100%;">' );
						}
					});
					// DataTable
					$('#table_asignaciones').DataTable().columns().every(function(){
						var that = this;
						$('input', this.footer()).on('keyup change', function(){
							if(that.search() !== this.value){
								that.search(this.value).draw();
							}
						});
					});
				}else{
					$('strong#cliente_nombre').html('');
					$('strong#cliente_documento').html('');
					$('table#table_asignaciones').DataTable().destroy();
					var strHtml = '<table class="display stripe hover cell-border" id="table_asignaciones" style="min-width: 960px; width: 960px; max-width: 960px; font-size: 10px;">'+
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
					$('table#table_asignaciones').DataTable({
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
					$('#table_asignaciones tfoot th').each( function(){
						if($(this).attr('data-search') == "true"){
							var title = $(this).text();
							$(this).html( '<input type="text" placeholder="'+title+'" style="width: 100%;">' );
						}
					});
					// DataTable
					var table_asignaciones = $('#table_asignaciones').DataTable();
					table_asignaciones.columns().every(function(){
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
				//$('form#buscarAsignacionesCliente #button_buscarAsignacionesCliente').button('reset');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				bootbox.alert("Error(buscarAsignacionesCliente): "+xhr.status+" Error: "+xhr.responseText);
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
</script>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
