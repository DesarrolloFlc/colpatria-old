<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8"])) {
    echo "No tiene permiso para esta �rea";
    exit;
}

require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'general.class.php';

$general = new General();
$sucursales = $general->getSucursales();
$areas = $general->getAreas();
?>

<!-- Page Head -->
<h2>Reporte Formato de Actualización</h2>
<p id="page-intro">Detalle de los formularios indexados en DocFinder.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
    <div class="content-box-header">
        <h3>Parametros de generaci&oacute;n</h3>

        <ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Reporte interno</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">        
        <div class="tab-content default-tab" id="tab2">
            <form action="reportFormatoActualizacion.xls.php" method="POST" name="reportGeneral" id="reportGeneral">
                <table>
                    <tbody>
                        <tr>
                            <td>Fecha:</td>
                            <td><input type="text" name="fecha_inicio" id="fecha_inicio" />(YYYY-MM-DD)</td>
                        </tr>
                        <tr>
                            <td>Fecha fin:</td>
                            <td><input type="text" name="fecha_fin" id="fecha_fin" />(YYYY-MM-DD)</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><input type="submit" class="button" value="Generar reporte >>"/></td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>       
    </div>
</div>
