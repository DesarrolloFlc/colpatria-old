<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8"])) {
    echo "No tiene permiso para esta �rea";
    exit;
}

require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'general.class.php';
$general = new General();
$tiposDocumentos = $general->getTipoDocumento();
?>
<!-- Page Head -->
<h2>Reporte interno de clientes desactualizados</h2>
<p id="page-intro">Detalle de los clientes que se encuentren desactualizados en DocFinder.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
    <div class="content-box-header">
        <h3>Parametros de generaci&oacute;n</h3>

        <ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Reporte desactualizados</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">        
        <div class="tab-content default-tab" id="tab2">
            <form action="reportDesactualizados.xls.php" method="POST" name="reportDesactualizados" id="reportDesactualizados" target="grp_linde">
                <table>
                    <!--<tbody>
                        <tr>
                            <td>Fecha inicio:</td>
                            <td><input type="text" name="fecha_inicio" id="fecha_inicio" />(YYYY-MM-DD)</td>
                        </tr>
                        <tr>
                            <td>Fecha fin:</td>
                            <td><input type="text" name="fecha_fin" id="fecha_fin" />(YYYY-MM-DD)</td>
                        </tr>
                        <tr>
                            <td>Tipo de documento:</td>
                            <td>
                                <select id="tipo_documento" name="tipo_documento">
                                    <option value="">-- Todas --</option>
                                    <?php while ($tipoDocumento = mysqli_fetch_array($tiposDocumentos)): ?>
                                        <option value="<?php echo $tipoDocumento['id'] ?>"><?php echo $tipoDocumento['description'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tipo de marca:</td>
                            <td>
                                <select id="tipo_marca" name="tipo_marca">
                                    <option value="">-- Todas --</option>
                                    <option value="1">CLIENTE FATCA</option>
                                    <option value="2">TRANSACCIONES EN EXTERIOR</option>
                                    <option value="3">CLIENTE RECALCITRANTE</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>-->
                    <tfoot>
                        <tr>
                            <td colspan="2"><input type="submit" class="button" value="Generar reporte >>"/></td>
                        </tr>
                    </tfoot>
                </table>
            </form>
            <iframe width="1" height="1" id="grp_linde" name="grp_linde" style="visibility:hidden"></iframe><!---->
        </div>       
    </div>
</div>
