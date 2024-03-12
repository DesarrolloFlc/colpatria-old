<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8", "2"]) && (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 'radicador')){
    echo "No tiene permiso para esta �rea";
    exit;
}

require_once dirname(dirname(dirname(__FILE__))) . "/template/general/header.php";
require_once PATH_CCLASS . DS . 'general.class.php';

$general = new General();
$sucursales = $general->getSucursales();
?>
<!-- Page Head -->
<h2>Creaci&oacute;n de radicado para el envio de documentaci&oacute;n virtual</h2>
<p id="page-intro">Radicar documentos virtuales a enviar por sucursal.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
    <div class="content-box-header">
        <h3>Parametros</h3>

        <ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Creaci&oacute;n de radicado</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab3">Verificar estado de radicado</a></li>
            <li><a href="#tab4">Consulta radicados por usuario</a></li>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">        
        <div class="tab-content default-tab" id="tab2">
            <div class="notification attention png_bg"> 
                <a href="#" class="close"><img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_erradduser">
                    No olvide diligenciar todos los campos.
                </div>
            </div>
            <div class="notification success  png_bg" id="result_notif" style="display:none;"> 
                <a href="#" class="close"><img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_adduser">

                </div>
            </div>
            <form method="POST" name="creaciondeRadicado" id="creaciondeRadicado">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 250px;">Sucursal y/o area que remite el formulario:</td>
                            <td>
                                <select name="id_sucursal" id="id_sucursal" onchange="$.fn.verificarCorredores(event, this, 'creaciondeRadicado');" alt="Se&ntilde;or radicador selecciones la sucursal en la cual quedar&aacute; radicado el cliente o sus clientes">
                                    <option value="">Seleccione una sucursal</option>
                                    <?php while ($sucursal = mysqli_fetch_array($sucursales)): ?>
                                        <option value="<?php echo $sucursal['id'] ?>"><?php echo $sucursal['sucursal'] ?></option>
                                    <?php endwhile; ?>
                                </select><!--<span class="input-notification attention png_bg">Se&ntilde;or radicador selecciones la sucursal en la cual quedar&aacute; radicado el cliente o sus clientes</span>-->
                            </td>
                        </tr>
                        <tr>
                            <td>Utc:</td>
                            <td>
                                <input type="text" name="utc" id="utc" size="4" onkeypress="return validar_num(event)" disabled="disabled" maxlength="2" alt="Se&ntilde;or radicador si la sucursal en la cual usted va a radicar es una corredora, por favor indique el numero de la Unidad Tecnico Comercial" onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;">
                                <!--<span class="input-notification attention png_bg">Se&ntilde;or radicador si la sucursal en la cual usted va a radicar es una corredora, por favor indique el numero de la Unidad Tecnico Comercial</span>-->
                            </td>
                        </tr>
                  <!--<tr>
                    <td>Nombre de funcionario:</td>
                    <td><input type="text" name="funcionario" id="funcionario" size="50" /></td>
                  </tr>-->
                        <tr>
                            <td>Telefono:</td>
                            <td>
                                <input type="text" name="telefono" id="telefono" size="10" onkeypress="return validar_num(event)" maxlength="7" alt="Se&ntilde;or radicador ingrese su numero de tel&eacute;fono, para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;">
                                <!--<span class="input-notification attention png_bg">Se&ntilde;or radicador ingrese su numero de tel&eacute;fono, para poderlo contactar si es necesario.</span>-->
                            </td>
                        </tr>
                        <tr>
                            <td>Extension:</td>
                            <td>
                                <input type="text" name="extension" id="extension" size="4" onkeypress="return validar_num(event)" maxlength="4" alt="Se&ntilde;or radicador ingrese su numero de extenci&oacute;n , para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;">
                                <!--<span class="input-notification attention png_bg">Se&ntilde;or radicador ingrese su numero de extenci&oacute;n , para poderlo contactar si es necesario.</span>-->
                            </td>
                        </tr>
<?php
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "1"|| $_SESSION['group'] == "6"/*  || $_SESSION['group'] == "8" || $_SESSION['group'] == "3"*/)){
?>
                        <tr>
                            <td>Radicado contingencia?:</td>
                            <td>
                                <select name="tipo" id="tipo" alt="Se&ntilde;or radicador seleccione esta opcion si es un radicado de contingecia, adjunte correo de evidencia">
                                    <option value="">Seleccione...</option>
                                    <option value="5" selected>SI</option>
                                    <option value="1">NO</option>
                                </select>
                            </td>
                        </tr>
<?php
    }else{
?>
                        <input type="hidden" id="tipo" name="tipo" value="1">
<?php
    }
?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right;"><!--style="padding-left: 82%;" -->
                                <div style="display: inline;">&nbsp;</div>
                                <input type="submit" class="button" value="Creaci&oacute;n de radicado >>" id="botoncrearRadicado"/>
                                <div style="display: inline; width: 16px; height: 16px;"><img id="imgloading" src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none;" /></div>
                            </td>
                        </tr>
                    </tfoot>
                </table> 
                <input type="hidden" id="action" name="action" value="creaciondeRadicado">
                <input type="hidden" id="clientes" name="clientes" value="">
                <!-- <input type="hidden" id="tipo" name="tipo" value="1"> -->
            </form>

            <p id="page-intro">&nbsp;&nbsp;Crear listado de clientes para este radicado.</p>
            <form id="form_load_file" name="form_load_file" enctype="multipart/form-data" method="POST" action="../includes/controllerRadicado.php" target="grp">
                <table>
                    <tr>
                        <td width="20%">Nombre y/o Raz&oacute;n Social del cliente:</td>
                        <td>
                            <input type="text" name="nombre_cli" id="nombre_cli" size="50" alt="Diligencie los Nombres y Apellidos completos y/o el nombre de la Raz&oacute;n Social completa." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;">
                            <!--<span class="input-notification attention png_bg">Diligencie los Nombres y Apellidos completos y/o el nombre de la Raz&oacute;n Social completa.</span>-->
                        </td>
                    </tr>
                    <tr>
                        <td>Documento de identificaci&oacute;n:</td>
                        <td>
                            <input type="text" name="documento_cli" id="documento_cli" size="14" onkeypress="return validar_num(event)"  maxlength="15" alt="Si el cliente es una persona juridica, diligencie el n&uacute;mero de identificacion sin el digito de chequeo y/o verificaci&oacute;n." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;">
                            <!--<span class="input-notification attention png_bg">Si el cliente es una persona juridica, diligencie el n&uacute;mero de identificacion sin el digito de chequeo y/o verificaci&oacute;n.</span>-->
                        </td>
                    </tr>
                    <tr><!--SKRV Ingreso documento especial-->
                        <td>Documento especial:</td>
                        <td>
                            <input type="checkbox" name="chkoptesp" id="chkoptesp">
                            <span class="input-notification attention png_bg">Marque esta opcion unicamente si el cliente tiene formato Sarlaft.</span>
                        </td>
                    </tr><!--FIN SKRV Ingreso documento especial-->
                </table>
                <div class="notification attention png_bg" style="margin-top: 8px;"> 
                    <a href="#" class="close"><img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                    <div id="msg_erradduser">
                        Se&ntilde;or radicador, tenga en cuenta que los archivos deben estar nombrados de acuerdo con los parametros establecidos en el #6.2 del instructivo U-AR-LAFT-002 ACT0.
                    </div>
                </div>
                <table id="files_loaders">
                    <tr>
                        <td width="8%">Archivo:</td>
                        <td><input type="file" id="load_file" name="load_file[0]">
                            <div style="width:50px; display: inline; margin-left:20px;">
                                <a href="#" onclick="$.fn.agregarCargaarchivos(event);"><img src="<?=SITE_ROOT?>/resources/images/icons/show.jpg" title="Agregar archivos" alt="Agregar" /></a>
                            </div>
                            <span class="input-notification attention png_bg">Si el cliente tiene mas de un archivo, utilize el boton mas</span>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td colspan="2">
                            <input id="buttonAgregarCliente" type="button" class="button" value="Agregar cliente" onclick="$.fn.agregarCliente(event);"/>
                            <div style="display: inline; width: 16px; height: 16px;">
                                <img id="imgloading" src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none;" />
                            </div>
                        </td>
                    </tr>
                </table>
                <input type="hidden" id="action" name="action" value="cargarArchivo">
                <input type="hidden" id="sucursal_sub" name="sucursal_sub">
                <input type="hidden" id="documento_sub" name="documento_sub">
                <iframe  width="1" height="1" id="grp" name="grp" style="visibility:hidden"></iframe><!-- style="visibility:hidden"-->
            </form>
            <table id="listaclientes">
                <tr>
                    <td>Nombre Cliente</td>
                    <td>Documento</td>
                    <td width="10%" align="center" valign="middle">Doc. especial</td><!--Documento especial SKRV-->
                    <td width="16" align="center" valign="middle">Borrar</td>
                </tr>
            </table> 
        </div>

        <div class="tab-content" id="tab3">
            <form method="POST" name="busquedadeRadicado" id="busquedadeRadicado">
                <table>
                    <tbody>
                        <tr>
                            <td width="120">Numero de radicado:</td>
                            <td>
                                <input type="text" name="id" id="id" class="one" onkeypress="return validar_num(event)" alt="Se&ntilde;or radicador ingrese el numero de radicado que desea consultar para verificar el estado del los clientes de este radicado." />
                                <!--<span class="input-notification attention png_bg">Se&ntilde;or radicador ingrese el numero de radicado que desea consultar para verificar el estado del los clientes de este radicado.</span>-->
                            </td>
                        </tr> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><input type="submit" class="button" value="Verificar estado de radicado >>"/></td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" id="action" name="action" value="busquedadeRadicado">
            </form>
            <table id="listaRadicados">
                <tr>
                    <td width="10%"># de radicado</td>
                    <td width="32%">Sucursal</td>
                    <td width="32%">Funcionario</td>
                    <td width="14%">Fecha de envio</td>
                    <td width="10%" align="center" valign="middle">Estado</td>
                    <td width="2%" align="center" valign="middle">Descargar</td>
                </tr>
                <tr id="radicadoBuscado"></tr>
            </table><br>
            <table id="listadoClientes">
            </table>
        </div>
        <div class="tab-content" id="tab4">
            <div class="notification success  png_bg" id="result_notif_busradicofi" style="display:none;"> 
                <a href="#" class="close">
                    <img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_notieneradicados"></div>
            </div>
            <form method="POST" id="radicadosyClientesxoficial" name="radicadosyClientesxoficial" onsubmit="$.fn.radicadosyClientesxoficial(event);">
                <table>
                    <tbody>
                        <tr>
                            <td>Fecha inicio:</td>
                            <td><input type="text" name="fecha_inicio" id="fecha_inicio" class="one" />(YYYY-MM-DD)</td>
                        </tr>
                        <tr>
                            <td>Fecha fin:</td>
                            <td><input type="text" name="fecha_fin" id="fecha_fin" />(YYYY-MM-DD)</td>
                        </tr>  
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <input type="submit" class="button" value="Buscar clientes radicados >>"/>
                                <div id="imgdownpdf" style="display: inline; width: 16px; height: 16px; margin-left: 80%;" original-title="Con este boton puede descargar una copia del listado de radicados."></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" id="action" name="action" value="radicadosyClientesxoficial">
            </form>
            <table id="listadeRadicados">
                <tr>
                    <td width="10%"># de radicado</td>
                    <td width="20%">Documento de identificaci&oacute;n</td>
                    <td width="44%">Nombre y/o Raz&oacute;n Social del cliente</td>
                    <td width="14%">Fecha de envio</td>
                    <td width="10%" align="center" valign="middle">Estado</td>
                    <td width="2%" align="center" valign="middle">Descargar</td>
                </tr>
                <div id="listadeRadicadosItems"></div>
            </table><br>
        </div>
    </div>
</div>
