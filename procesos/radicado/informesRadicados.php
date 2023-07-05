<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8", "2", "10"])) {
    echo "No tiene permiso para esta �rea";
    exit;
}
require_once dirname(dirname(dirname(__FILE__))) . "/template/general/header.php";
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'official.class.php';

$general = new General();
$sucursales = $general->getSucursales();
$oficials = new Official();
$oficiales = $oficials->getOfficials();
?>

<!-- Page Head -->
<h2>Generaci&oacute;n de informes para radicados creados por sucursal</h2>
<p id="page-intro">Reporte de documentos enviados por sucursal</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
    <div class="content-box-header">
        <h3>Parametros</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab4" class="default-tab">Consulta radicados por sucursales</a></li>
            <li><a href="#tab5">Consulta radicados por oficial</a></li>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">                
        <div class="tab-content default-tab" id="tab4">
            <div class="notification success  png_bg" id="result_notif_busradicofi" style="display:none;"> 
                <a href="#" class="close">
                    <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_notieneradicados"></div>
            </div>
            <form method="POST" id="radicadosyClientesxSucursal" name="radicadosyClientesxSucursal">
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
                        <tr>
                            <td>Sucursal:</td>
                            <td>
                                <select id="sucursales" name="sucursales">
                                    <option value="">Seleccione...</option>
                                    <option value="T">Todas</option>
                                    <?php while ($sucursal = mysqli_fetch_array($sucursales)): ?>
                                        <option value="<?=$sucursal['id']?>"><?=$sucursal['sucursal']?></option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                        </tr>
                        <!--<tr>
                            <td>Tipo de radicado:</td>
                            <td>
                            <select id="tiporadicado" name="tiporadicado">
                                <option value="2">Todos</option>
                                <option value="0">F&iacute;sico</option>
                                <option value="1">Virtual</option>
                            </select></td>
                        </tr>-->
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
                <input type="hidden" id="action" name="action" value="radicadosyClientesxSucursal">
            </form>
            <table id="listadeRadicados">
                <tr>
                    <td width="8%"># de radicado</td>
                    <td width="18%">Sucursal</td>
                    <td width="16%">Oficial</td>
                    <td width="10%"># Documento</td>
                    <td width="22%">Nombre y/o Raz&oacute;n Social del cliente</td>
                    <td width="14%">Fecha de radicacion</td>
                    <td width="6%">Fecha de envio</td>
                    <td width="6%" align="center" valign="middle">Estado</td>
                </tr>
            </table><br>
        </div>
        <div class="tab-content" id="tab5">
            <div class="notification success  png_bg" id="result_notif_busradicofi" style="display:none;"> 
                <a href="#" class="close">
                    <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_notieneradicados"></div>
            </div>
            <form method="POST" id="radicadosyClientesxOfficial" name="radicadosyClientesxOfficial">
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
                        <tr>
                            <td>Oficial:</td>
                            <td>
                                <select id="oficiales" name="oficiales">
                                    <option value="">Seleccione...</option>
                                    <option value="T">Todas</option>
                                    <?php while ($oficial = mysqli_fetch_array($oficiales)): ?>
                                        <option value="<?php echo $oficial['id'] ?>"><?php echo $oficial['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <input type="submit" class="button" value="Buscar clientes radicados >>">
                                <div id="imgdownpdf_2" style="display: inline; width: 16px; height: 16px; margin-left: 80%;" original-title="Con este boton puede descargar una copia del listado de radicados."></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" id="action" name="action" value="radicadosyClientesxOfficial">
            </form>
            <table id="listadeRadicados_2">
                <tr>
                    <td width="8%"># de radicado</td>
                    <td width="18%">Sucursal</td>
                    <td width="20%">Oficial</td>
                    <td width="16%">Documento de identificaci&oacute;n</td>
                    <td width="22%">Nombre y/o Raz&oacute;n Social del cliente</td>
                    <td width="10%">Fecha de radicacion</td>
                    <td width="6%" align="center" valign="middle">Estado</td>
                </tr>
            </table><br>
        </div>
    </div>
</div>
