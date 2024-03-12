<?php
session_start();
if ((!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "2", "1", "8"])) && (!isset($_SESSION['id']) || $_SESSION['id'] != '2956') && ($_SESSION['group'] != 3 || $_SESSION['cargo'] != 'radicador')) {
    echo "No tiene permiso para esta �rea";
    exit;
}
require_once dirname(dirname(dirname(__FILE__))) . "/template/general/header.php";
//if ((isset($_SESSION['group']) && (in_array($_SESSION['group'], ["6", "2", "1", "8"]))) OR ( isset($_SESSION['id']) && $_SESSION['id'] == '2956') || ($_SESSION['group'] == 3 && $_SESSION['cargo'] == 'radicador')) {
    //require_once '../../template/general/header.php';
?>
<!-- Facebox jQuery Plugin -->
<!-- <script type="text/javascript" src="/Colpatria/resources/scripts/facebox.js"></script> -->
<!-- Page Head -->
<h2>Aprobaci&oacute;n de radicados y clientes en estos</h2>
<p id="page-intro">Se aprueba un radicado existen y los clientes que vienen en este.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
    <div class="content-box-header">
        <h3>Parametros de generaci&oacute;n</h3>

        <ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Aprobacion de radicado</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab3">Reporte planilla</a></li>
            <li><a href="#tab4">Cambiar estado de radicados</a></li>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
            <div class="notification attention png_bg" id="result_notifwr" style="display:none;"> 
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_warningradicado">No olvide diligenciar todos los campos.</div>
            </div>
            <div class="notification success  png_bg" id="result_notifok" style="display:none;"> 
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_addradicado"></div>
            </div>
            <form method="POST" name="aprobareRadicado" id="aprobareRadicado">
                <table>
                    <tbody>
                        <tr>
                            <td width="120">Numero de radicado:</td>
                            <td><input type="text" name="id" id="id" class="text-input" onkeypress="return validar_num(event)" /></td>
                        </tr> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><input type="submit" id="aprobareRadicadoButton" class="button" value="Verificar radicado >>"/></td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="action" value="busquedadeRadicado">
            </form>
            <table id="listaRadicados">
                <tr>
                    <td width="10%"># de radicado</td>
                    <td width="31%">Sucursal</td>
                    <td width="32%">Funcionario</td>
                    <td width="15%">Fecha de creaci&oacute;n</td>
                    <td width="10%" align="center" valign="middle">Estado</td>
                    <td width="2%" align="center" valign="middle">Descargar</td>
                </tr>
                <tr id="radicadoBuscado"></tr>
            </table>
            <br><br>
            <br>          
            <form id="aprobarClientes" name="aprobarClientes" method="POST">
                <div id="acordeonClientes" name="acordeonClientes" style="display:none;">
                    <table id="listadoClientes"></table>
                </div>
                <input type="hidden" name="action" value="aprobarClientes">
            </form>
        </div>
        <div class="tab-content" id="tab3">
            <div class="notification attention png_bg" id="result_notifwr" style="display:none;"> 
                <a href="#" class="close"><img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_warningradicado">No olvide diligenciar todos los campos.</div>
            </div>
            <div class="notification success  png_bg" id="result_notifok" style="display:none;"> 
                <a href="#" class="close"><img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_addradicado"></div>
            </div>
            <form method="POST" id="reporteLotesPlanillas" name="reporteLotesPlanillas">
                <table>
                    <tbody>
                        <tr>
                            <td>Fecha:</td>
                            <td><input type="text" name="fecha_inicio" id="fecha_inicio" class="text-input" />(YYYY-MM-DD)</td>
                        </tr> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <input type="submit" class="button" value="Buscar radicados por planilla >>"/>
                                <div id="imgdownpdf" style="display: inline; width: 16px; height: 16px; margin-left: 75%;" original-title="Con este boton puede descargar una copia del listado de radicados."></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="action" value="reporteLotesPlanillas">
            </form>          
        </div>
        <div class="tab-content" id="tab4">
            <div class="notification attention png_bg" id="result_notifwr2" style="display:none;"> 
                <a href="#" class="close"><img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_warningradicado2">No olvide diligenciar todos los campos.</div>
            </div>
            <div class="notification success  png_bg" id="result_notifok2" style="display:none;"> 
                <a href="#" class="close"><img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_addradicado2"></div>
            </div>
            <form method="POST" id="verificarCambioEstadoRadicado" name="verificarCambioEstadoRadicado">
                <table>
                    <tbody>
                        <tr>
                            <td width="120">Numero de radicado:</td>
                            <td><input type="text" name="id" class="text-input" onkeypress="return validar_num(event)" /></td>
                        </tr>
                        <tr>
                            <td width="120">Numero de documento:</td>
                            <td><input type="text" name="documento" id="documento" class="text-input" onkeypress="return validar_num(event)" /></td>
                        </tr>
                        <tr id="estado_actualCliente" style="display:none;">
                            <td width="120">Estado actual:</td>
                            <td id="estado_actualClientetd"></td>
                        </tr>
                        <tr id="nuevo_estadoCliente" style="display:none;">
                            <td width="120">Nuevo estado:</td>
                            <td id="nuevo_estadoClientetd"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <input type="submit" class="button" value="Buscar cliente por radicado >>"/>
                            </td>  
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="action" value="verificarCambioEstadoRadicado">
            </form> 
        <div id="div_cambioEstado" style="display:none;"><!---->
            <form method="POST" id="cambioEstadoRadicadoCliente" name="cambioEstadoRadicadoCliente">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="2">Si desea cambiar el estado del cliente en el radicado especificado, por favor click en el siguiente boton</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><input type="submit" class="button" value="Cambiar estado del cliente >>"/></td>  
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="action" value="cambioEstadoRadicadoCliente">
                <input type="hidden" id="id_cliente_c" name="id_cliente_c">
                <input type="hidden" id="nuevo_estado_c" name="nuevo_estado_c">
            </form>
        </div>
        </div>
        <!--<div id="box"><a href="#" onclick="$.fn.abrirBox1(event);">Daniel</a></div>-->
        <div id="box1" style="display:none;">
            <br>
            <form id="devolverRadicadoForm" name="devolverRadicadoForm" onsubmit="$.fn.devolverRadicadoForm(event, this);">
                <div style="padding-bottom: 10px;">
                    <label>Tipo de Cliente:</label>
                    <select id="persontype" name="persontype" onchange="$(this).buscarCausales(event);">
                        <option value="">Seleccione...</option>
                        <option value="1">Natural</option>
                        <option value="2">Juridico</option>
                    </select>
                </div>
                <!--<p>
                    <label>Lote:</label>
                    <input type="text" name="lote" id="lote" size="6" maxlength="6" onkeypress="return validar_num(event)"/>
                </p>-->
                <div style="padding-bottom: 10px;">
                    <label>Devoluci&oacute;n:</label>
                    <div style="display: flex; align-items: center;">
                        <select name="causaldevolucion" id="causaldevolucion" class="big-input" onchange="$(this).buscarObservacion();" disabled>
                            <option value="">Seleccione opci&oacute;n</option>
                        </select>
                        <div style="width: 16px; height: 16px; padding-left: 5px;">
                            <img id="imgloading-observacion" src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none;" />
                        </div>
                    </div>
                </div>
                <div style="padding-bottom: 10px;">
                    <label>Causal de devolución:</label>
                    <select name="causalobservacion[]" id="causalobservacion" multiple style="width: 100%; height: 140px; overflow-x: scroll;">
                    </select>
                </div>
                <div style="padding-bottom: 10px;">
                    <label>Observaciones:</label>
                    <textarea name="observation" id="observation" cols="10" rows="5"></textarea>
                </div>
                <input type="hidden" name="id_sucursal" id="id_sucursal">
                <input type="hidden" name="id_official" id="id_official">
                <input type="hidden" name="clienteid_dev" id="clienteid_dev">
                <input type="hidden" name="typepos" id="typepos">
                <input type="hidden" name="radicado_id" id="radicado_id">
                <input type="hidden" name="opcion" id="opcion" value="1">
                <input type="hidden" name="action" value="devolverRadicadoForm">
                <div style="display: flex; align-items: center;">
                    <input type="submit" id="devolverItem" class="button" value="Realizar devolucion >>"/>
                    <div style="width: 16px; height: 16px; padding-left: 5px;">
                        <img id="imgloading-agregar" src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none;" />
                    </div>
                </div>            
            </form>
        </div>
        <div id="box2" style="display:none;">
            <br>
        </div>
        <div id="box3" style="display:none;">
            <br>
            <form id="frmNdocCliente" name="frmNdocCliente"  method="POST">
                <table style="margin-left: 2%;" id="tablaform">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead> 
                    <tr>
                        <td>
                            Documento:
                        </td>
                        <td>
                            <input type="text" id="txtNdoc" name="txtNdoc" size="14" onkeypress="return validar_num(event);"  maxlength="10"  onpaste="return false;" oncopy="return false;" >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">    
                            <input type="button" value="Guardar"  style="margin-left: 38%;" onclick="$.fn.NdocCliente(event, txtNdoc.value);">
                        </td>
                    </tr>
                </table>
                <div id="dvalerta"></div>
                <input type="hidden" id="hddestado" name="hddestado" value="">
                <input type="hidden" id="hddradicado" name="hddradicado" value="">
                <input type="hidden" id="hdditem" name="hdditem" value="">
                <input type="hidden" id="hddocespe" name="hddocespe" value="">
                <input type="hidden" name="action" value="actualizaCliente" />
            </form>
        </div>
        <div id="boxError" style="display:none;">
        </div>
        <div id="box-evidencias" style="display:none;">
            <div>
                <h2>Evidencias para el cliente:</h2>
                <h4 id="nombre-cliente" style="font-style: italic;"></h4>
            </div>
            <form method="POST" name="form-evidencias" id="form-evidencias" style="padding-top: 20px; padding-bottom: 20px;" onsubmit="$(this).cargarArchivoEvidencias(event);">
                <div>
                    <label for="resultado">Resultado: </label>
                    <select name="resultado" id="resultado">
                        <option value="">Seleccione...</option>
                        <option value="Aprobado">Aprobado</option>
                        <option value="Devuelto">Devuelto</option>
                    </select>
                </div>
                <div style="padding-top: 10px;">
                <label for="file_evidencia">(Adjunte archivos en formato docx ó pdf)</label>
                    <input type="file" id="file_evidencia" name="file_evidencia">
                </div>
                <div style="padding-top: 10px; display: flex; align-items: center;">
                    <input type="submit" class="button" value="Cargar evidencias >>" id="botoncargueEvidencias">
                    <div style="width: 16px; height: 16px; padding-left: 5px;"><img id="imgloading" src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none;;" /></div>
                </div>
                <input type="hidden" name="radicado_item_id">
                <input type="hidden" name="documento">
                <input type="hidden" name="posicion">
				<input type="hidden" name="domain" value="cargue">
				<input type="hidden" name="action" value="cargueEvidenciaWord">
				<input type="hidden" name="meth" value="js">
            </form>
            <div class="notification error png_bg" id="evidecia-resultado-error" style="display: none;">
				<div id="mensaje-error" style="margin: 10px 10px;"></div>
			</div>
        </div>
        <div id="box-errores" style="display:none;">
            <p class="text-center">
                <span>
                    Descargue el archivo haciendo click aqui!&nbsp;&nbsp;
                </span>
            </p>
        </div>
    </div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
    
})
$.fn.cerrarVentana = function() {
    //radioSelected.checked = false;
};
$.fn.mostrarDivEvidencias = function(e, radicado_item_id, documento, pos, nombre){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    $('div#box-evidencias h4#nombre-cliente').text(nombre);
    $('form#form-evidencias input[name="radicado_item_id"]').val(radicado_item_id);
    $('form#form-evidencias input[name="documento"]').val(documento);
    $('form#form-evidencias input[name="posicion"]').val(pos);
    jQuery.facebox({ div: '#box-evidencias' });
};
$.fn.cargarArchivoEvidencias = function(e){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;

    if ($('select[name="resultado"]', this).val() === '') {
        $('div#evidecia-resultado-error div#mensaje-error').html("Debe seleccionar el tipo de resultado para la carga de la evidencia.");
        $('div#evidecia-resultado-error').show();
        setTimeout(() => { $('div#evidecia-resultado-error').hide(); }, 5000);
        return false;
    }
    if ($('input[name="file_evidencia"]', this).val() === '') {
        $('div#evidecia-resultado-error div#mensaje-error').html("Debe adjuntar el archivo a cargar, con el formato especifico.");
        $('div#evidecia-resultado-error').show();
        setTimeout(() => { $('div#evidecia-resultado-error').hide(); }, 5000);
        return false;
    }
    
	const formData = new FormData();

    formData.append('file', $(this).find('input[name="file_evidencia"]')[0].files[0]);

    const otros_datos = $(this).serializeArray();
    $.each(otros_datos, function(key, input){
        formData.append(input.name, input.value);
    });
    const form = this;
    $.ajax({
        beforeSend: function(){
            $('input#botoncargueEvidencias').attr('disabled', true);
            $('img#imgloading').show();
            //$.facebox.loading();
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        type: 'post',
        url: '../includes/Controller.php',
        dataType: 'json',
        success: function(dato){
            console.log(dato)
            if ((!dato.exito && dato.error) || (!dato.exito && !dato.error)) {
                $('div#evidecia-resultado-error div#mensaje-error').html(dato.error ? dato.error : 'Ocurrio un error al momento de generar el archivo, contacte con el administrador.');
                $('div#evidecia-resultado-error').show();
                setTimeout(() => { $('div#evidecia-resultado-error').hide(); }, 5000);
                if (!dato.error) console.log(dato);
                return false;
            }
            const pos = $('input[name="posicion"]', form).val();
            const item_id = $('input[name="radicado_item_id"]', form).val();
            $('p.text-center > span').html(dato.exito);
            $.facebox({
                div: '#box-errores'
            });
            $('a#evidencias-check-' + pos).css('filter', '').css('cursor', '').attr('onclick', `$(this).mostrarEvidencias(event, ${pos}, ${item_id});`);
            $('a#evidencias-del-' + pos).css('filter', '').css('cursor', '').attr('onclick', `$(this).eliminarEvidencias(event, ${pos}, ${item_id});`);
            //$.facebox.close();
        },
        complete: function(jqXHR, textStatus){
            //$.facebox.close();
            $('input#botoncargueEvidencias').removeAttr('disabled');
            $('img#imgloading').hide();
        },
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr, ajaxOptions, thrownError);
            $('p.text-center > span').html("Error(cargueBaseGestorVentas): "+xhr.status+" Error: "+xhr.responseText);
            $.facebox({
                div: '#box-errores'
            });
        }
    });
}
$.fn.mostrarEvidencias = function(e, pos, radicado_item_id){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if (radicado_item_id === null) return false;
    
    $.ajax({
        beforeSend: function(){
            $.facebox.loading();
        },
        data: {
            action: 'verEvidencia',
            domain: 'cargue',
            meth: 'js',
            posicion: pos, 
            radicado_item_id: radicado_item_id
        },
        type: 'GET',
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
            $('#box2').html('<div id="muestra-pdf-evidencia"></div>');
            const tam = tamVentana();
            const widtam = (60 * tam[0]) / 100;
            var opt = {
                width: widtam + "px",
                height: "650px",
                pdfOpenParams: {
                    view: "FitH"
                }
            };
            PDFObject.embed(dato.item.path, "#muestra-pdf-evidencia", opt);
            $.facebox({
                div: '#box2'
            });
        },
        complete: function(jqXHR, textStatus){
            //$.facebox.close();
        },
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr, ajaxOptions, thrownError);
            $('p.text-center > span').html("Error(cargueBaseGestorVentas): "+xhr.status+" Error: "+xhr.responseText);
            $.facebox({
                div: '#box-errores'
            });
        }
    });
}
$.fn.eliminarEvidencias = function(e, pos, radicado_item_id){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if (radicado_item_id === null) return false;

    if (!confirm('Esta seguro que desea eliminar la evidencia para este cliente, recuerde que esta acción no se puede deshacer, confirme?')) return false;

    $.ajax({
        beforeSend: function(){
            $.facebox.loading();
        },
        data: {
            action: 'eliminarEvidenciaWord',
            domain: 'cargue',
            meth: 'js',
            posicion: pos, 
            radicado_item_id: radicado_item_id
        },
        type: 'GET',
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
            $('a#evidencias-check-' + pos)
                .css('filter', 'grayscale(1)')
                .css('cursor', 'not-allowed')
                .attr('onclick', `$(this).mostrarEvidencias(event, ${pos}, ${null});`);
            $('a#evidencias-del-' + pos)
                .css('filter', 'grayscale(1)')
                .css('cursor', 'not-allowed')
                .attr('onclick', `$(this).eliminarEvidencias(event, ${pos}, ${null});`);
        },
        complete: function(jqXHR, textStatus){
            //$.facebox.close();
        },
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr, ajaxOptions, thrownError);
            $('p.text-center > span').html("Error(cargueBaseGestorVentas): "+xhr.status+" Error: "+xhr.responseText);
            $.facebox({
                div: '#box-errores'
            });
        }
    });
}
$.fn.buscarCausales = function(e){
    if ($(this).val() === '') return false;

    const tipo_persona = $(this).val();

$.ajax({
    beforeSend: function(){
        $('img#imgloading-observacion').show();
        $('select[name="causalobservacion[]"]').html('');
    },
    data: {
        action: 'buscarCausales',
        domain: 'radicados',
        meth: 'js',
        tipo_persona: tipo_persona
    },
    type: 'GET',
    url: '../includes/Controller.php',
    dataType: 'json',
    success: function(dato){
        if (dato.length <= 0) {
            $('select[name="causaldevolucion"]').html('<option value="">--Seleccione observaci&oacute;n--</option>');
            $('select[name="causaldevolucion"]').attr('disabled', true);
            return false;
        }

        let strHtml = '<option value="">--Seleccione observaci&oacute;n--</option>';
        for (let i = 0; i < dato.length; i++) {
            strHtml += `<option value="${dato[i]['id']}">${dato[i]['descripcion']}</option>`;
        }
        $('select[name="causaldevolucion"]').html(strHtml);
        $('select[name="causaldevolucion"]').removeAttr('disabled');
    },
    complete: function(jqXHR, textStatus){
        $('img#imgloading-observacion').hide();
    },
    error: function(xhr, ajaxOptions, thrownError){
        console.log(xhr, ajaxOptions, thrownError);
        $('p.text-center > span').html("Error(cargueBaseGestorVentas): "+xhr.status+" Error: "+xhr.responseText);
        $.facebox({
            div: '#box-errores'
        });
    }
});
};
$.fn.buscarObservacion = function(){
    if ($(this).val() === '') return false;

    const causal_id = $(this).val();

    $.ajax({
        beforeSend: function(){
            $('img#imgloading-observacion').show();
            $('select[name="causalobservacion[]"]').html('');
        },
        data: {
            action: 'buscarObservacionesCausal',
            domain: 'radicados',
            meth: 'js',
            causal_id: causal_id
        },
        type: 'GET',
        url: '../includes/Controller.php',
        dataType: 'json',
        success: function(dato){
            if (dato.length <= 0) return false;

            let strHtml = '';
            for (let i = 0; i < dato.length; i++) {
                strHtml += `<option value="${dato[i]['id']}">${dato[i]['descripcion']}</option>`;
            }
            $('select[name="causalobservacion[]"]').html(strHtml);
        },
        complete: function(jqXHR, textStatus){
            $('img#imgloading-observacion').hide();
        },
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr, ajaxOptions, thrownError);
            $('p.text-center > span').html("Error(cargueBaseGestorVentas): "+xhr.status+" Error: "+xhr.responseText);
            $.facebox({
                div: '#box-errores'
            });
        }
    });
};
</script>
</body>
</html>
