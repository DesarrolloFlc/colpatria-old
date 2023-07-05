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
            <li><a href="#tab4" class="default-tab">Cargue seguros Supermercado</a></li>
            <li><a href="#tab5">Cargue capi Supermercado</a></li>
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
          <form method="POST" id="carguesegurosSupermercado" name="carguesegurosSupermercado" method="POST" enctype="multipart/form-data"  action="../includes/controllerSupermercado.php" target="grp1">
            <table>
              <tbody>
                <tr>
                  <td>Archivo:</td>
                  <td><input type="file" id="file_seg_sup" name="file_seg_sup"></td>
                </tr>
                <tr>
                  <td>Tipo de Clientes:</td>
                  <td>
                    <select id="persontype" name="persontype">
                      <option value="">Seleccione..</option>
                      <option value="1">Natural</option>
                      <option value="1">Juridico</option>
                    </select>
                  </td>
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
            <input type="hidden" id="action" name="action" value="carguesegurosSupermercado">
            <input type="hidden" id="tipe_file" name="tipe_file" value="subida">
            <iframe  width="500" height="300" id="grp1" name="grp1"></iframe><!-- style="visibility:hidden"-->
          </form>          
        </div>
        <div class="tab-content" id="tab5">
          <div class="notification success  png_bg" id="result_notif_busradicofi" style="display:none;"> 
            <a href="#" class="close">
              <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
            </a>
            <div id="msg_notieneradicados"></div>
          </div>
          <form id="carguecapiSupermercado" name="carguecapiSupermercado" method="POST" enctype="multipart/form-data"  action="../includes/controllerSupermercado.php" target="grp2">
            <table>
              <tbody>
                <tr>
                  <td>Archivo:</td>
                  <td><input type="file" id="file_cap_sup" name="file_cap_sup"></td>
                </tr>
                <tr>
                  <td>Tipo de Clientes:</td>
                  <td>
                    <select id="persontype" name="persontype">
                      <option value="">Seleccione..</option>
                      <option value="1">Natural</option>
                      <option value="1">Juridico</option>
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
            <input type="hidden" id="action" name="action" value="carguecapiSupermercado">
            <input type="hidden" id="tipe_file" name="tipe_file" value="subida">
            <iframe  width="500" height="300" id="grp1" name="grp2"></iframe><!-- style="visibility:hidden"-->
          </form>
        </div>
    </div>
</div>
<?php 
} else {
	echo "No tiene permiso para esta área";
}
?>