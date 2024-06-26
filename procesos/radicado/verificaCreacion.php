<?php
session_start();
if ((!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "2", "1", "8"])) && (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 'radicador')) {
    echo "No tiene permiso para esta �rea";
    exit;
}

//if (isset($_SESSION['group']) && ($_SESSION['group'] == "6" OR $_SESSION['group'] == "1" OR $_SESSION['group'] == "8" OR $_SESSION['group'] == "2" OR ((isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'radicador')))){
require_once dirname(dirname(dirname(__FILE__))) . "/template/general/header.php";
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
                    <img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_erradduser">No olvide diligenciar todos los campos.</div>
            </div>
            <div class="notification success  png_bg" id="result_notif" style="display:none;"> 
                <a href="#" class="close">
                    <img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
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
                                    <input type="text" name="utc" id="utc" size="4" onkeypress="return validar_num(event)" disabled="disabled" maxlength="2"  alt="Se&ntilde;or radicador si la sucursal en la cual usted va a radicar es una corredora, por favor indique el numero de la Unidad Tecnico Comercial" onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
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
                                    <input type="text" name="telefono" id="telefono" size="10" onkeypress="return validar_num(event)" maxlength="7" alt="Se&ntilde;or radicador ingrese su numero de tel&eacute;fono, para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                    <!--<span class="input-notification attention png_bg">Se&ntilde;or radicador ingrese su numero de tel&eacute;fono, para poderlo contactar si es necesario.</span>-->
                                </td>
                            </tr>
                            <tr>
                                <td>Extension:</td>
                                <td>
                                    <input type="text" name="extension" id="extension" size="4" onkeypress="return validar_num(event)" maxlength="4"  alt="Se&ntilde;or radicador ingrese su numero de extenci&oacute;n , para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                    <!--<span class="input-notification attention png_bg">Se&ntilde;or radicador ingrese su numero de extenci&oacute;n , para poderlo contactar si es necesario.</span>-->
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: right;"><!--style="padding-left: 82%;" margin-left: 86%;" -->
                                    <div style="display: inline;">&nbsp;</div>
                                    <input type="submit" class="button" value="Creaci&oacute;n de radicado >>" id="botoncrearRadicado"/>
                                    <div style="display: inline; width: 16px; height: 16px;"><img id="imgloading" src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none;" /></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <p id="page-intro">&nbsp;&nbsp;Crear listado de clientes para este radicado.</p>
                    <table>
                        <tr>
                            <td width="20%">Nombre y/o Raz&oacute;n Social del cliente:</td>
                            <td>
                                <input type="text" name="nombre_cli" id="nombre_cli" size="50" alt="Diligencie los Nombres y Apellidos completos y/o el nombre de la Raz&oacute;n Social completa." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                <!--<span class="input-notification attention png_bg">Diligencie los Nombres y Apellidos completos y/o el nombre de la Raz&oacute;n Social completa.</span>-->
                            </td>
                        </tr>
                        <tr>
                            <td>Documento de identificaci&oacute;n:</td>
                            <td>
                                <input type="text" name="documento_cli" id="documento_cli" size="14" onkeypress="return validar_num(event)"  maxlength="10" alt="Si el cliente es una persona juridica, diligencie el n&uacute;mero de identificacion sin el digito de chequeo y/o verificaci&oacute;n." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
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
                        <tr>
                            <td colspan="2"><input type="button" class="button" value="Agregar cliente" onclick="$.fn.agregarCliente(event);"/></td>
                        </tr>
                        
                    </table>
                    <table id="listaclientes">
                        <tr>
                            <td>Nombre Cliente</td>
                            <td>Documento</td>
                            <td width="10%" align="center" valign="middle">Doc. especial</td><!--Documento especial SKRV-->
                            <td width="16" align="center" valign="middle">Borrar</td>
                        </tr>
                    </table>  
                    <input type="hidden" name="action" value="creaciondeRadicado">
                    <input type="hidden" id="clientes" name="clientes" value="">
                    <input type="hidden" id="tipo" name="tipo" value="0">
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
                                <input type="text" name="id" id="id" class="one text-input" onkeypress="return validar_num(event)" alt="Se&ntilde;or radicador ingrese el numero de radicado que desea consultar para verificar el estado del los clientes de este radicado." />
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
                <input type="hidden" name="action" value="busquedadeRadicado">
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
                            <td><input type="text" name="fecha_inicio" id="fecha_inicio" class="one text-input" />(YYYY-MM-DD)</td>
                        </tr>
                        <tr>
                            <td>Fecha fin:</td>
                            <td><input type="text" name="fecha_fin" id="fecha_fin" class="text-input" />(YYYY-MM-DD)</td>
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
                <input type="hidden" name="action" value="radicadosyClientesxoficial">
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
            </table><br>
        </div>
        <div class="tab-content" id="tab5">
            <div class="notification attention png_bg"> 
                <a href="#" class="close">
                    <img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_erradduser">No olvide diligenciar todos los campos, tenga en cuenta que el archivo a subir debe tener un minimo de 5 clientes</div>
            </div>
            <div class="notification success  png_bg" id="result_notif" style="display:none;"> 
                <a href="#" class="close">
                    <img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
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
                                    <select name="id_sucursal" id="id_sucursal" onchange="$.fn.verificarCorredores(event, this, 'creaciondeRadicadoMasivo');" alt="Se&ntilde;or radicador selecciones la sucursal en la cual quedar&aacute; radicado el cliente o sus clientes">
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
                                    <input type="text" name="utc" id="utc" size="4" onkeypress="return validar_num(event)" disabled="disabled" maxlength="2"  alt="Se&ntilde;or radicador si la sucursal en la cual usted va a radicar es una corredora, por favor indique el numero de la Unidad Tecnico Comercial" onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                </td>
                            </tr>
                            <tr>
                                <td>Telefono:</td>
                                <td>
                                    <input type="text" name="telefono" id="telefono" size="10" onkeypress="return validar_num(event)" maxlength="7" alt="Se&ntilde;or radicador ingrese su numero de tel&eacute;fono, para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                    <!--<span class="input-notification attention png_bg">Se&ntilde;or radicador ingrese su numero de tel&eacute;fono, para poderlo contactar si es necesario.</span>-->
                                </td>
                            </tr>
                            <tr>
                                <td>Extension:</td>
                                <td>
                                    <input type="text" name="extension" id="extension" size="4" onkeypress="return validar_num(event)" maxlength="4"  alt="Se&ntilde;or radicador ingrese su numero de extenci&oacute;n , para poderlo contactar si es necesario." onpaste="alert('No se le permite esta opcion');return false;" oncopy="alert('No se le permite esta opcion');return false;" class="text-input">
                                    <!--<span class="input-notification attention png_bg">Se&ntilde;or radicador ingrese su numero de extenci&oacute;n , para poderlo contactar si es necesario.</span>-->
                                </td>
                            </tr>
<?php
    if(isset($_SESSION['group']) && in_array($_SESSION['group'], [1, 6])){
?>
                            <tr>
                                <td>Empresa:</td>
                                <td>
                                    <select name="tipo" id="tipo" alt="Se&ntilde;or radicador seleccione esta opcion para identificar la empresa a la que pertenecen los clientes del radicado">
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
                            <input type="hidden" id="tipo" name="tipo" value="2">
<?php
    }
?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: right;"><!--style="padding-left: 82%;" margin-left: 86%;" -->
                                    <div style="display: inline;">&nbsp;</div>
                                    <input type="submit" class="button" value="Creaci&oacute;n de radicado >>" id="botoncrearRadicado"/>
                                    <div style="display: inline; width: 16px; height: 16px;"><img id="imgloading" src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none;" /></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <p id="page-intro">&nbsp;&nbsp;Cargar listado de clientes para este radicado. (descarga estructura de cargue <a href="<?=SITE_ROOT?>/lib/ApachePOIImplements/download.php">aqui</a>)</p>
                    <table id="files_loaders">
                        <tr>
                            <td width="5%">Archivo:</td>
                            <td><input type="file" id="file_masivo" name="file_masivo">
                            </td>
                        </tr>
                    </table> 
                    <input type="hidden" name="action" value="creaciondeRadicadoMasivo">
                    <input type="hidden" id="clientes" name="clientes" value="">
                    <!-- <input type="hidden" id="tipo" name="tipo" value="2"> -->
                </div>
            </form>
            <iframe width="1" height="1" id="grp" name="grp" style="visibility:hidden"></iframe><!---->
        </div>
    </div>
</div>
