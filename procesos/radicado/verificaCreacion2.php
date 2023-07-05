<?php
session_start();

if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8"]) && (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 'radicador')){
    echo "No tiene permiso para esta �rea";
    exit;
}
require_once dirname(dirname(dirname(__FILE__))) . "/template/general/header_2.php";
require_once PATH_CCLASS . DS . 'general.class.php';

$general = new General();
$sucursales = $general->getSucursales();
$sucursales2 = $general->getSucursales();
?>

<!-- Page Head -->
<h2>Creaci&oacute;n de radicado para el envio de documentaci&oacute;n f&iacute;sica</h2>
<p id="page-intro">Radicar documentos f&iacute;sicos a enviar por sucursal.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
    <div class="content-box-header">
        <h3>Parametros</h3>

        <ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Creaci&oacute;n de radicado</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab5">Creaci&oacute;n de radicado masivo</a></li>
            <li><a href="#tab3">Verificar estado de radicado</a></li>
            <li><a href="#tab4">Consulta radicados por usuario</a></li>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">        
        <div class="tab-content default-tab" id="tab2">
            <div class="notification attention png_bg"> 
                <a href="#" class="close">
                    <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_erradduser">No olvide diligenciar todos los campos.</div>
            </div>
            <div class="notification success png_bg" id="result_notif" style="display:none;"> 
                <a href="#" class="close">
                    <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_adduser"></div>
            </div>
            <form method="POST" name="creaciondeRadicado" id="creaciondeRadicado">
                <div id="focus-example">
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 250px;">Sucursal y/o area que remite el formulario:</td>
                                <td>
                                    <select name="id_sucursal" onchange="$.fn.verificarCorredores(event, this, 'creaciondeRadicado');" alt="Se&ntilde;or radicador selecciones la sucursal en la cual quedar&aacute; radicado el cliente o sus clientes">
                                        <option value="">Seleccione una sucursal</option>
                                        <?php while ($sucursal = mysqli_fetch_array($sucursales)): ?>
                                            <option value="<?php echo $sucursal['id'] ?>"><?php echo $sucursal['sucursal'] ?></option>
                                        <?php endwhile; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Utc:</td>
                                <td>
                                    <input type="text" name="utc" size="4" onkeypress="return validar_num(event)" disabled="disabled" maxlength="2"  alt="Se&ntilde;or radicador si la sucursal en la cual usted va a radicar es una corredora, por favor indique el numero de la Unidad Tecnico Comercial" onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                </td>
                            </tr>
                            <tr>
                                <td>Telefono:</td>
                                <td>
                                    <input type="text" name="telefono" size="10" onkeypress="return validar_num(event)" maxlength="7" alt="Se&ntilde;or radicador ingrese su numero de tel&eacute;fono, para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                </td>
                            </tr>
                            <tr>
                                <td>Extension:</td>
                                <td>
                                    <input type="text" name="extension" size="4" onkeypress="return validar_num(event)" maxlength="4"  alt="Se&ntilde;or radicador ingrese su numero de extenci&oacute;n , para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: right;">
                                    <div style="display: inline;">&nbsp;</div>
                                    <input type="submit" class="button" value="Creaci&oacute;n de radicado >>" id="botonCrearRadicado"/>
                                    <div style="display: inline; width: 16px; height: 16px;"><img id="imgloading" src="../../images/icons/loading.gif" style="display: none;" /></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <p id="page-intro">&nbsp;&nbsp;Crear listado de clientes para este radicado.</p>
                    <table>
                        <tr>
                            <td width="20%">Nombre y/o Raz&oacute;n Social del cliente:</td>
                            <td>
                                <input type="text" name="nombre_cli" size="50" alt="Diligencie los Nombres y Apellidos completos y/o el nombre de la Raz&oacute;n Social completa." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                            </td>
                        </tr>
                        <tr>
                            <td>Documento de identificaci&oacute;n:</td>
                            <td>
                                <input type="text" name="documento_cli" size="14" onkeypress="return validar_num(event)"  maxlength="10" alt="Si el cliente es una persona juridica, diligencie el n&uacute;mero de identificacion sin el digito de chequeo y/o verificaci&oacute;n." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                            </td>
                        </tr>
                        <tr>
                            <td>Documento especial:</td>
                            <td>
                                <input type="checkbox" name="chkoptesp">
                                <span class="input-notification attention png_bg">Marque esta opcion unicamente si el cliente tiene formato Sarlaft.</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="button" class="button" value="Agregar cliente" onclick="$.fn.agregarCliente(event);"/></td>
                        </tr>
                        
                    </table>
                    <table id="listaclientes">
                        <thead>
                            <tr>
                                <th>Nombre Cliente</th>
                                <th>Documento</th>
                                <th width="10%" align="center" valign="middle">Doc. especial</th>
                                <th width="16" align="center" valign="middle">Borrar</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>  
                    <input type="hidden" name="action" value="creaciondeRadicadoFisico">
                    <input type="hidden" name="clientes" value="">
                    <input type="hidden" name="tipo" value="0">
                    <input type="hidden" name="domain" value="radicados">
                    <input type="hidden" name="meth" value="js">
                </div>
            </form>
        </div>
        <div class="tab-content" id="tab3">
            <form method="POST" name="busquedadeRadicado" id="busquedadeRadicado">
                <table>
                    <tbody>
                        <tr>
                            <td width="120">Numero de radicado:</td>
                            <td>
                                <input type="text" name="id" class="one text-input" onkeypress="return validar_num(event)" alt="Se&ntilde;or radicador ingrese el numero de radicado que desea consultar para verificar el estado del los clientes de este radicado." />
                            </td>
                        </tr> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><input type="submit" class="button" value="Verificar estado de radicado >>" id="buttonbusquedadeRadicado" /></td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="action" value="busquedadeRadicado">
                <input type="hidden" name="domain" value="radicados">
                <input type="hidden" name="meth" value="js">
            </form>
            <table id="listaRadicados">
                <thead>
                    <tr>
                        <th width="10%"># de radicado</th>
                        <th width="32%">Sucursal</th>
                        <th width="32%">Funcionario</th>
                        <th width="14%">Fecha de envio</th>
                        <th width="10%" align="center" valign="middle">Estado</th>
                        <th width="2%" align="center" valign="middle">Descargar</th>
                    </tr>
                </thead>
                <tbody id="radicadoBuscado"></tbody>
            </table><br>
            <table id="listadoClientes">
            </table>
        </div>
        <div class="tab-content" id="tab4">
            <div class="notification success  png_bg" id="result_notif_busradicofi" style="display:none;"> 
                <a href="#" class="close">
                    <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_notieneradicados"></div>
            </div>
            <form method="POST" id="radicadosyClientesxoficial" name="radicadosyClientesxoficial" onsubmit="$.fn.radicadosyClientesxoficial(event);">
                <table>
                    <tbody>
                        <tr>
                            <td>Fecha inicio:</td>
                            <td><input type="text" name="fecha_inicio" class="classpickerfecha text-input" />(YYYY-MM-DD)</td>
                        </tr>
                        <tr>
                            <td>Fecha fin:</td>
                            <td><input type="text" name="fecha_fin" class="classpickerfecha text-input" />(YYYY-MM-DD)</td>
                        </tr>  
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <input type="submit" id="buttonradicadosyClientesxoficial" class="button" value="Buscar clientes radicados >>"/>
                                <div id="imgdownpdf" style="display: inline; width: 16px; height: 16px; margin-left: 80%;" original-title="Con este boton puede descargar una copia del listado de radicados."></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="action" value="radicadosyClientesxoficial">
                <input type="hidden" name="domain" value="radicados">
                <input type="hidden" name="meth" value="js">
            </form>
            <table id="lista-radicados">
                <thead>
                    <tr>
                        <th  style="font-size: 12px !important;" width="10%"># de radicado</th>
                        <th  style="font-size: 12px !important;" width="20%">Documento de identificaci&oacute;n</th>
                        <th  style="font-size: 12px !important;" width="44%">Nombre y/o Raz&oacute;n Social del cliente</th>
                        <th  style="font-size: 12px !important;" width="14%">Fecha de envio</th>
                        <th  style="font-size: 12px !important;" width="12%" align="center" valign="middle">Estado</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table><br>
        </div>
        <div class="tab-content" id="tab5">
            <div class="notification attention png_bg"> 
                <a href="#" class="close">
                    <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_erradduser">No olvide diligenciar todos los campos, tenga en cuenta que el archivo a subir debe tener un minimo de 5 clientes</div>
            </div>
            <div class="notification success  png_bg" id="result_notif" style="display:none;"> 
                <a href="#" class="close">
                    <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_adduser"></div>
            </div>
            <form method="post" name="creaciondeRadicadoMasivo" id="creaciondeRadicadoMasivo" enctype="multipart/form-data" action="../includes/controllerRadicado.php" target="grp"><!--  -->
                <div id="focus-example">
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 250px;">Sucursal y/o area que remite el formulario:</td>
                                <td>
                                    <select name="id_sucursal" onchange="$.fn.verificarCorredores(event, this, 'creaciondeRadicadoMasivo');" alt="Se&ntilde;or radicador selecciones la sucursal en la cual quedar&aacute; radicado el cliente o sus clientes">
                                        <option value="">Seleccione una sucursal</option>
                                        <?php while ($sucursal2 = mysqli_fetch_array($sucursales2)): ?>
                                            <option value="<?php echo $sucursal2['id'] ?>"><?php echo $sucursal2['sucursal'] ?></option>
                                        <?php endwhile; ?>
                                        </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Utc:</td>
                                <td>
                                    <input type="text" name="utc" size="4" onkeypress="return validar_num(event)" disabled="disabled" maxlength="2"  alt="Se&ntilde;or radicador si la sucursal en la cual usted va a radicar es una corredora, por favor indique el numero de la Unidad Tecnico Comercial" onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                </td>
                            </tr>
                            <tr>
                                <td>Telefono:</td>
                                <td>
                                    <input type="text" name="telefono" size="10" onkeypress="return validar_num(event)" maxlength="7" alt="Se&ntilde;or radicador ingrese su numero de tel&eacute;fono, para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                </td>
                            </tr>
                            <tr>
                                <td>Extension:</td>
                                <td>
                                    <input type="text" name="extension" size="4" onkeypress="return validar_num(event)" maxlength="4"  alt="Se&ntilde;or radicador ingrese su numero de extenci&oacute;n , para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                </td>
                            </tr>
<?php
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "1"|| $_SESSION['group'] == "6"/*  || $_SESSION['group'] == "8" || $_SESSION['group'] == "3"*/)){
?>
                            <tr>
                                <td>Empresa:</td>
                                <td>
                                    <select name="tipo" alt="Se&ntilde;or radicador seleccione esta opcion para identificar la empresa a la que pertenecen los clientes del radicado">
                                        <option value="">Seleccione...</option>
                                        <option value="2">Colpatria seguros</option>
                                        <option value="6">Falabella</option>
                                        <option value="7">Cencosud</option>
                                    </select>
                                </td>
                            </tr>
<?php
    }else{
?>
                            <input type="hidden" name="tipo" value="2">
<?php
    }
?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: right;">
                                    <div style="display: inline;">&nbsp;</div>
                                    <input type="submit" class="button" value="Creaci&oacute;n de radicado >>" id="botonCreaciondeRadicadoMasivo"/>
                                    <div style="display: inline; width: 16px; height: 16px;"><img id="imgloading" src="../../images/icons/loading.gif" style="display: none;" /></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <p id="page-intro">&nbsp;&nbsp;Cargar listado de clientes para este radicado. (descarga estructura de cargue <a href="../../lib/ApachePOIImplements/download.php">aqui</a>)</p>
                    <table id="files_loaders">
                        <tr>
                            <td width="5%">Archivo:</td>
                            <td><input type="file" name="file_masivo">
                            </td>
                        </tr>
                    </table> 
                    <input type="hidden" name="action" value="cargueRadicadoMasivo">
                    <input type="hidden" name="domain" value="radicados">
                    <input type="hidden" name="meth" value="js">
                </div>
            </form>
            <iframe width="1" height="1" id="grp" name="grp" style="visibility:hidden"></iframe><!---->
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
<script src="../../resources/scripts/datatables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('table#lista-radicados').DataTable({
        "pageLength": 15,
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
        "order": [[ 3, "desc" ]],
    });

    $("form#creaciondeRadicado").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('select[name="id_sucursal"]', this).val() == '') {
            $('p.text-center > span').html('Por favor seleccione una sucursal');
            $.facebox({
                div: '#box-errores'
            });
            return false;
        }
        if ($('select[name="id_sucursal"] option:selected', this).text().search('CORREDORES') >= 0 && $('input[name="utc"]', this).val() == '') {
            $('p.text-center > span').html('Por favor digite el codigo de corredor');
            $.facebox({
                div: '#box-errores'
            });
            return false;
        }
        if ($('input[name="telefono"]', this).val() == '') {
            $('p.text-center > span').html('Por favor digite un numero de telefono');
            $.facebox({
                div: '#box-errores'
            });
            return false;
        }
        if ($('[name="tipo"]', this).val() == '') {
            $('p.text-center > span').html('Debe seleccionar el tipo de radicado para continuar.');
            $.facebox({
                div: '#box-errores'
            });
            return false;
        }
        if ($('input[name="clientes"]', this).val() == '') {
            $('p.text-center > span').html('No ha agregado clientes para esta orden por favor agregue su listado');
            $.facebox({
                div: '#box-errores'
            });
            return false;
        }
        if (!confirm('Esta seguro que la informaci\xF3n que radic\xF3 y va a enviar de todos los clientes esta completa, debidamente diligenciada y tiene todos los documentos adicionales para cumplir con los p\xE1rametros exigidos por SARLAFT, y que son su responsabilidad, y por lo tanto estos clientes no tendr\xE1n ninguna causal de devoluci\xF3n?')) return false;
        const form = this;
        $.ajax({
            beforeSend: function() {
                $(form).find('#botoncrearRadicado').attr('disabled', true);
                $.facebox.loading();
            },
            data: $(form).serialize(),
            type: 'POST',
            url: '../includes/Controller.php',
            dataType: 'json',
            success: function(dato) {
                if ((!dato.exito && dato.error) ||(!dato.exito && !dato.error)) {
                    $('p.text-center > span').html(dato.error ? dato.error : 'Ocurrio un error al momento de crear el nuevo radicado, contacte con el administrador.');
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
                $(form).reset();
                $(form).find('table#listaclientes > tbody').html('');
                $(form).find('input[name="clientes"]').val('');
                window.location.href = "generarReportePDF.php?idradicado=" + dato.radicado['id'];
            },
            complete: function(jqXHR, textStatus){
                $(form).find('#botoncrearRadicado').removeAttr('disabled');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
                $('p.text-center > span').html("Error(creaciondeRadicado): " + jqXHR.status + ":::" + jqXHR.responseText)
                $.facebox({
                    div: '#box-errores'
                });
            }
        });
    });
    $("form#busquedadeRadicado").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($('input[name="id"]', this).val() == ''){
            $('p.text-center > span').html('Por favor digite el numero de radicado')
            $.facebox({
                div: '#box-errores'
            });
            return false;
        }
        const form = this;
        $.ajax({
            beforeSend: function() {
                $('input#buttonbusquedadeRadicado').attr('disabled', true);
                $.facebox.loading();
            },
            data: $(form).serialize(),
            type: 'GET',
            url: '../includes/Controller.php',
            dataType: 'json',
            success: function(dato) {
                if ((!dato.exito && dato.error) || (!dato.exito && !dato.error)) {
                    $('p.text-center > span').html(dato.error ? dato.error : 'Ocurrio un error al momento de consultar el radicado, por favor contacte con el administrador.')
                    $.facebox({
                        div: '#box-errores'
                    });
                    if (!dato.error) console.log(dato);
                    return false;
                }
                const strHTML = `<td>${dato.radicado['id']}</td>
                <td>${dato.sucursal}</td>
                <td>${dato.funcionario}</td>
                <td>${dato.radicado['fecha_creacion']}</td>
                <td>${dato.estado}</td>
                <td>
                    <a href="generarReportePDF.php?idradicado=${dato.radicado['id']}&downpdf=download">
                        <img src="../../resources/images/icons/pdf_icon.gif" title="Descargar PDF" alt="Descargar PDF" />
                    </a>
                </td>`;
                let strItems = `<tr>
                    <td width="20%">Documento</td>
                    <td>Nombre</td>
                    <td width="10%">Estado</td>
                </tr>`;
                if (dato.items) {
                    const lengtitems = dato.items.length;
                    for (let i = 0; i < lengtitems; i++) {
                        strItems += `<tr>
                            <td width="20%">${dato.items[i].documento}</td>
                            <td>${dato.items[i].descripcion}</td>
                            <td width="10%">${dato.items[i].estado_str}</td>
                        </tr>`;
                    }
                }
                $('#radicadoBuscado').html(strHTML);
                $('#listadoClientes').html(strItems);
                $.facebox.close();
                //window.open("generarReportePDF.php?idradicado="+id, '_blanck');
            },
            complete: function(jqXHR, textStatus){
                $('input#buttonbusquedadeRadicado').removeAttr('disabled');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
                $('p.text-center > span').html("Error(busquedadeRadicado): " + jqXHR.status + ":::" + jqXHR.responseText)
                $.facebox({
                    div: '#box-errores'
                });
            }
        });
    });
    $("form#radicadosyClientesxoficial").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('input[name="fecha_inicio"]', this).val() == '') {
            $('p.text-center > span').html('Por favor seleccione una fecha inicial.')
            $.facebox({
                div: '#box-errores'
            });
            return false;
        }
        if ($('input[name="fecha_fin"]', this).val() == '') {
            $('p.text-center > span').html('Por favor seleccione una fecha final.')
            $.facebox({
                div: '#box-errores'
            });
            return false;
        }
        const form = this;
        $.ajax({
            beforeSend: function() {
                $('input#buttonradicadosyClientesxoficial').attr('disabled', true);
                $.facebox.loading();
            },
            data: $(form).serialize(),
            type: 'GET',
            url: '../includes/Controller.php',
            dataType: 'json',
            success: function(dato) {
                if ((!dato.exito && dato.error) || (!dato.exito && !dato.error)) {
                    $('p.text-center > span').html(dato.error ? dato.error : 'Ocurrio un error al momento de consultar los radicados, contacte con el administrador.');
                    $.facebox({
                        div: '#box-errores'
                    });
                    if (!dato.error) console.log(dato);
                    if (!dato.exito) {
                        $('table#lista-radicados').DataTable().destroy();
                        $('table#lista-radicados').DataTable({
                            data: [],
                            "pageLength": 15,
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
                            "order": [[ 3, "desc" ]],
                        });
                        $('#imgdownpdf').html('');
                    }
                    return false;
                }
                $('table#lista-radicados').DataTable().destroy();
                $('table#lista-radicados').DataTable({
                    "data": dato.items,
                    "columns": [
                        { "data": "id_radicados" },
                        { "data": "documento" },
                        { "data": "descripcion" },
                        { "data": "fecha_creacion" },
                        { "data": "estado_str" }
                    ],
                    "pageLength": 15,
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
                    "order": [[ 3, "desc" ]],
                });
                $('#imgdownpdf').html(`<a href="generarReportePDF.php?${datos}&consR=download"><img id="imgloading" src="../../images/icons/pdf_download_8.gif" />`);
                /*$('#imgdownpdf').qtip({
                    content: {
                        text: 'Por medio de este icono, descargue una copia del reporte con la informacion consultada'
                    },
                    show: {
                        ready: true
                    },
                    hide: {
                        target: $('.content-box-tabs'),
                        event: 'mouseover'
                    },
                    style: {
                        width: '350px',
                        classes: 'qtip-dark qtip-shadow qtip-tipsy'
                    },
                    position: {// Position my top left...
                        my: 'bottom right', // Position my top left...
                        at: 'left top' // at the bottom right of...
                    }
                });*/
                $.facebox.close();
            },
            complete: function(jqXHR, textStatus){
                $('input#buttonradicadosyClientesxoficial').removeAttr('disabled');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
                $('p.text-center > span').html("Error(radicadosyClientesxoficial): " + jqXHR.status + ":::" + jqXHR.responseText)
                $.facebox({
                    div: '#box-errores'
                });
            }
        });
    });
    $("form#creaciondeRadicadoMasivo").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('select[name="id_sucursal"]', this).val() == '') {
            alert('Por favor seleccione una sucursal');
            $('select[name="id_sucursal"]', this).focus();
            return false;
        }
        if ($('select[name="id_sucursal"] option:selected', this).text().search('CORREDORES') >= 0 && $('input[name="utc"]', this).val() == '') {
            alert('Por favor digite el codigo de corredor');
            $('input[name="utc"]', this).focus();
            return false;
        }
        if ($('input[name="telefono"]', this).val() == '') {
            alert('Por favor digite un numero de telefono');
            $('input[name="telefono"]', this).focus();
            return false;
        }
        if($('[name="tipo"]', this).val() == ''){
            alert('Debe seleccionar el tipo de radicado a crear.');
            $('[name="tipo"]', this).focus();
            return false;
        }
        if ($('input[name="file_masivo"]', this).val() == '') {
            alert('Debe selecionar un archivo a cargar, recuerde que son minimo 5 cliente.');
            $('input[name="file_masivo"]', this).focus();
            return false;
        }
        const fparts = $('input[name="file_masivo"]', this).val().split(".");
        const exten = fparts[(fparts.length - 1)];
        if(exten != 'xls' && exten != 'xlsx'){
            alert("Debe cargar un archivo con formato permitido (xls, xlsx)");
            $('input[name="file_masivo"]', this).focus();
            return false;
        }
        if (!confirm('Esta seguro que la informaci\xF3n que radic\xF3 y va a enviar de todos los clientes esta completa, debidamente diligenciada y tiene todos los documentos adicionales para cumplir con los p\xE1rametros exigidos por SARLAFT, y que son su responsabilidad, y por lo tanto estos clientes no tendr\xE1n ninguna causal de devoluci\xF3n?')) return false;
        const form = this;
        const formData = new FormData();
        formData.append('file_masivo', $('input[name="file_masivo"]', form)[0].files[0]);
        $.each($(form).serializeArray(), function(key, input){
            formData.append(input.name, input.value);
        });
        $.ajax({
            beforeSend: function(){
                $('#botonCreaciondeRadicadoMasivo', form).attr('disabled', true);
                $.facebox.loading();
            },
            url: '../includes/Controller.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(dato) {
                console.log(dato);
            },
            complete: function(jqXHR, textStatus){
                $(form).find('#botonCreaciondeRadicadoMasivo').removeAttr('disabled');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
                $('p.text-center > span').html('<strong>Error(creaciondeRadicadoMasivo)!</strong> '+errorThrown+': '+jqXHR.responseText)
                $.facebox({
                    div: '#box-errores'
                });
            }
        });
        /*$('form#creaciondeRadicadoMasivo #botoncrearRadicado').attr('disabled', 'disabled');
        $('form#creaciondeRadicadoMasivo #imgloading').show();
        var forma = document.creaciondeRadicadoMasivo;
        forma.submit();*/
    });
});
$.fn.agregarCliente = function(e) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if ($('form#creaciondeRadicado select[name="id_sucursal"]').val() == '') {
        $('p.text-center > span').html('Por favor seleccione una sucursal');
        $.facebox({
            div: '#box-errores'
        });
        return false;
    }
    if ($('form#creaciondeRadicado input[name="nombre_cli"]').val() == '') {
        $('p.text-center > span').html('Por favor digite el nombre del cliente si piensa agregar uno nuevo');
        $.facebox({
            div: '#box-errores'
        });
        return false;
    }
    if ($('form#creaciondeRadicado input[name="documento_cli"]').val() == '') {
        $('p.text-center > span').html('Por favor digite el documento del cliente si piensa agregar uno nuevo');
        $.facebox({
            div: '#box-errores'
        });
        return false;
    }
    if (!$('input[name="chkoptesp"]').is(':checked')) {
        $.fn.validaAgregarCliente('0');
        return false;
    }
    $.ajax({
        data: {
            action: 'validarCliente2',
            domain: 'radicados',
            meth: 'js',
            cliente: $('form#creaciondeRadicado input[name="documento_cli"]').val()
        },
        type: 'GET',
        url: '../includes/Controller.php',
        dataType: 'json',
        success: function(dato) {
            if ((!dato.exito && dato.error) || (!dato.exito && !dato.error)) {
                $('p.text-center > span').html(dato.error ? dato.error : 'Ocurrio un error al momento de verificar si el cliente tenia formulario inicia, contacte con el administrador');
                $.facebox({
                    div: '#box-errores'
                });
                if (!dato.error) console.log(dato);
                return false;
            }
            $.fn.validaAgregarCliente(form, '1');
        }
    });
};
$.fn.validaAgregarCliente = function (docEspe){
    if (!confirm('Esta seguro que la informaci\xF3n que radic\xF3 y va a enviar esta completa, debidamente diligenciada y tiene todos los documentos adicionales para cumplir con los p\xE1rametros exigidos por SARLAFT, y que son su responsabilidad, y por lo tanto este cliente no tendr\xE1 ninguna causal de devoluci\xF3n?')) {
        return false;
    }

    const documento = $('form#creaciondeRadicado input[name="documento_cli"]').val().trim();
    if($('form#creaciondeRadicado input[name="clientes"]').val().indexOf(documento) !== -1){
        $('p.text-center > span').html(`Ya ha agregado un cliente con este numero de documento(<strong>${documento}</strong>), por favor verifique.`)
        $.facebox({
            div: '#box-errores'
        });
        return false;
    }
    const nombre = $('form#creaciondeRadicado input[name="nombre_cli"]').val().trim().toUpperCase();
    const optesp = docEspe == '0' ? 'NO' : (docEspe == '1' ? 'SI' : '');

    const strHtml = `<tr class="tr_content">
        <td>${nombre}</td>
        <td>${documento}</td>
        <td>${optesp}</td>
        <td align="center" valign="middle" class="td_formatopiso">
            <a href="#" onclick="$(this).hidetr(event, '${nombre}', '${documento}', ${docEspe});">
                <img src="../../resources/images/icons/cross_circle.png" title="Eliminar" alt="Eliminar" />
            </a>
        </td>
    </tr>`;
    $('table#listaclientes > tbody').append(strHtml);

    const clientes = $('form#creaciondeRadicado input[name="clientes"]').val();

    let valueclis = clientes === ""
        ? nombre + '|' + documento + '|' + docEspe
        : clientes + '||' + nombre + '|' + documento + '|' + docEspe;

    $('form#creaciondeRadicado input[name="clientes"]').val(valueclis);

    $('form#creaciondeRadicado input[name="nombre_cli"]').val('');
    $('form#creaciondeRadicado input[name="documento_cli"]').val('');
    if($('form#creaciondeRadicado input[name="chkoptesp"]').is(':checked'))
        $('form#creaciondeRadicado input[name="chkoptesp"]').attr('checked', false);

    $('p.text-center > span').html('Se agrego el cliente satisfactoriamente.');
    $.facebox({
        div: '#box-errores'
    });
}
$.fn.hidetr = function(e, nombre, documento, docEspe) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if(!confirm(String.fromCharCode(191) + 'Seguro que desea borrar este cliente?')){
        return false;
    }
    const str = nombre + '|' + documento + '|' + docEspe;
    if (str === $('form#creaciondeRadicado input[name="clientes"]').val()) {
        $('form#creaciondeRadicado input[name="clientes"]').val('');
    } else {
        const str1 = $('form#creaciondeRadicado input[name="clientes"]').val();
        const str2 = str1.indexOf(str) <= 0 ? str1.replace(str + '||', '') : str1.replace('||' + str, '');
        $('form#creaciondeRadicado input[name="clientes"]').val(str2);
    }
    $(this).parent('.td_formatopiso').parent('.tr_content').animate({opacity: 'hide'}, "slow");
};
</script>
