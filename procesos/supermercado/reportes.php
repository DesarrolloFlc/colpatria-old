<?php
session_start();

if( $_SESSION['group'] == "6" OR  $_SESSION['group'] == "1" OR  $_SESSION['group'] == "8" OR  $_SESSION['group'] == "2") {
require_once '../../template/general/header.php';
?>

<!-- Page Head -->
<h2>Generaci&oacute;n de reportes para el modulo Supermercado.</h2>
<p id="page-intro">Reporte de consolidado de clientes y gestiones.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
      <div class="content-box-header">
        <h3>Parametros</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab4" class="default-tab">Reporte consolidado de clientes</a></li>
            <li><a href="#tab5">Reporte de gestiones</a></li>
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
          <form method="POST" id="consolidadoClientesSup" name="consolidadoClientesSup" action="reportGenerator.php">
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
                    <input type="submit" class="button" value="Generar reporte >>"/>
                    <div id="imgdownpdf" style="display: inline; width: 16px; heigth: 16px; margin-left: 80%;" original-title="Con este boton puede descargar una copia del listado de radicados."></div>
                  </td>
                </tr>
              </tfoot>
            </table>
            <input type="hidden" id="action" name="action" value="consolidadoClientesSup">
          </form>          
        </div>
        <div class="tab-content" id="tab5">
          <div class="notification success  png_bg" id="result_notif_busradicofi" style="display:none;"> 
            <a href="#" class="close">
              <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
            </a>
            <div id="msg_notieneradicados"></div>
          </div>
          <form method="POST" id="reporteGestionesSup" name="reporteGestionesSup">
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
                  <td>Hora:</td>
                  <td>
                    <select name="hora" id="hora">
                      <option value="">Todo</option>
                      <?php for( $i = 6; $i <= 21; $i++ ): ?>
                              <option><?php echo $i?></option>
                      <?php endfor;?>
                    </select>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2">
                    <input type="submit" class="button" value="Generar reporte >>">
                    <div id="imgdownpdf_2" style="display: inline; width: 16px; heigth: 16px; margin-left: 80%;" original-title="Con este boton puede descargar una copia del listado de radicados."></div>
                  </td>
                </tr>
              </tfoot>
            </table>
            <input type="hidden" id="action" name="action" value="reporteGestionesSup">
          </form>
        </div>
    </div>
</div>
<?php 
} else {
	echo "No tiene permiso para esta área";
}
?>