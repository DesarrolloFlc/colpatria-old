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
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_warningradicado">No olvide diligenciar todos los campos.</div>
            </div>
            <div class="notification success  png_bg" id="result_notifok" style="display:none;"> 
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
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
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_warningradicado2">No olvide diligenciar todos los campos.</div>
            </div>
            <div class="notification success  png_bg" id="result_notifok2" style="display:none;"> 
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
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
                <p>
                    <label>Tipo de Cliente:</label>
                    <select id="persontype" name="persontype">
                        <option value="">Seleccione...</option>
                        <option value="1">Natural</option>
                        <option value="2">Juridico</option>
                    </select>
                </p>
                <!--<p>
                    <label>Lote:</label>
                    <input type="text" name="lote" id="lote" size="6" maxlength="6" onkeypress="return validar_num(event)"/>
                </p>-->
                <p>
                    <label>Causal de devoluci&oacute;n:</label>              
                    <select name="causaldevolucion" id="causaldevolucion" class="big-input">
                        <option value="">--Seleccione opci&oacute;n--</option>
                        <option value="Actividad Economica">Actividad Economica</option>
                        <option value="Codigo CIIU">Codigo CIIU</option>
                        <option value="Datos de entrevista">Datos de entrevista</option>
                        <option value="Datos de representante legal">Datos de representante legal</option>
                        <option value="Falta documentos adicionales">Falta documentos adicionales</option>
                        <option value="Falta fecha de diligenciamiento o solicitud">Falta fecha de diligenciamiento o solicitud</option>
                        <option value="Formulario"> Formulario</option>
                        <option value="Formulario de vinculación inicial">Formulario de vinculación inicial</option>
                        <option value="Formato renovación de autos">Formato renovación de autos</option>
                        <option value="Fotocopia de cedula">Fotocopia de cedula</option>
                        <option value="Huella y/o Firma">Huella y/o Firma</option>
                        <option value="Información laboral incompleta"> Información laboral incompleta</option>
                        <option value="Ocupación/profesión">Ocupación/profesión</option>
                        <option value="Peps">Pep's</option>
                        <option value="Radicado desordenado"> Radicado desordenado</option>
                        <option value="Sin datos completos de contacto">Sin datos completos de contacto</option>
                        <option value="Sin datos financieros">Sin datos financieros</option>
                    </select>
                </p>
                <p>
                    <label>Observaciones:</label>              
                    <select name="observation[]" id="observation" multiple="multiple">
                        <option value="Sin dirección/teléfonos/ciudad">Sin dirección/teléfonos/ciudad</option>
                        <option value="Nombre de empresa dirección / teléfono"> Nombre de empresa dirección / teléfono</option>
                        <option value="Debe diligenciar todos los campos (ingresos/egresos/activos/pasivos)">Debe diligenciar todos los campos (ingresos/egresos/activos/pasivos)</option>
                        <option value="Concepto de otros ingresos (especificar cuál es el concepto) en caso que exista valor.">Concepto de otros ingresos (especificar cuál es el concepto) en caso que exista valor.</option>
                        <option value="Debe diligenciar actividad económica">Debe diligenciar actividad económica</option>
                        <option value="Especificar la actividad, que comercia, independiente en qué?">Especificar la actividad, que comercia, independiente en qué?</option>
                        <option value="Huella ilegible físico">Huella ilegible físico</option>
                        <option value="Falta huella o firma">Falta huella o firma</option>
                        <option value="Formulario Desactualizado">Formulario Desactualizado</option>
                        <option value="La huella del documento de identificación no coincide con el físico">La huella del documento de identificación no coincide con el físico</option>
                        <option value="Debe venir totalmente diligenciada: lugar, fecha, hora, funcionario">Debe venir totalmente diligenciada: lugar, fecha, hora, funcionario</option>
                        <option value="Falta fecha de diligenciamiento y/o solicitud o entrevista (año-mes-día)">Falta fecha de diligenciamiento y/o solicitud o entrevista (año-mes-día)</option>
                        <option value="Cámara de comercio">Cámara de comercio</option>
                        <option value="Campos peps sin diligenciar o mal diligenciado">Campos pep's sin diligenciar o mal diligenciado</option>
                        <option value="El número de documento en el formulario esta errado o mal diligenciado">El número de documento en el formulario esta errado o mal diligenciado</option>
                        <option value="Rut">Rut</option>
                        <option value="Fotocopia de cedula">Fotocopia de cedula</option>
                        <option value="Certificación de la alcaldía vigente">Certificación de la alcaldía vigente</option>
                        <option value="Campo CIIU sin diligenciar o mal diligenciado">Campo CIIU sin diligenciar o mal diligenciado</option>
                        <option value="Acta de asamblea para copropiedades"> Acta de asamblea para copropiedades</option>
                        <option value="Lista de socios personas jurídicas">Lista de socios personas jurídicas</option>
                        <option value="Debe diligenciar correctamente los campos al radicar la documentación identificación y nombre">Debe diligenciar correctamente los campos al radicar la documentación identificación y nombre</option>
                        <option value="Falta fotocopia de cedula">Falta fotocopia de cedula</option>
                        <option value="Falta diligenciar datos del representante legal">Falta diligenciar datos del representante legal</option>
                        <option value="Debe ser actual, legible y ampliada al 150%">Debe ser actual, legible y ampliada al 150%</option>
                        <option value="Fotocopia cedula ilegible cara A">Fotocopia cedula ilegible cara A</option>
                        <option value="Fotocopia cedula ilegible cara B">Fotocopia cedula ilegible cara B</option>
                        <option value="Formulario ilegible">Formulario ilegible</option>
                        <option value="Falta formulario o formulario incompleto">Falta formulario o formulario incompleto</option>
                        <option value="Falta formulario cara A">Falta formulario cara A</option>
                        <option value="Falta formulario cara B">Falta formulario cara B</option>
                        <option value="Formulario con enmendadura">Formulario con enmendadura</option>
                        <option value="No existe formulario de vinculación inicial">No existe formulario de vinculación inicial</option>
                        <option value="Debe diligenciar campo">Debe diligenciar campo</option>
                        <option value="Falta numero de póliza">Falta numero de póliza</option>
                        <option value="Debe volver a radicar la documentacion">Debe volver a radicar la documentacion</option>
                        <option value="Camara de comercio superior a 30 dias">Camara de comercio superior a 30 días</option>
                    </select>
                </p>
                <input type="hidden" name="id_sucursal" id="id_sucursal">
                <input type="hidden" name="id_official" id="id_official">
                <input type="hidden" name="clienteid_dev" id="clienteid_dev">
                <input type="hidden" name="typepos" id="typepos">
                <input type="hidden" name="radicado_id" id="radicado_id">
                <input type="hidden" name="opcion" id="opcion" value="1">
                <input type="hidden" name="action" value="devolverRadicadoForm">
                <p>
                    <input type="submit" id="devolverItem" class="button" value="Realizar devolucion >>"/>
                </p>            
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
                    <div style="width: 16px; height: 16px; padding-left: 5px;"><img id="imgloading" src="../../images/icons/loading.gif" style="display: none;;" /></div>
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
</script>
</body>
</html>
