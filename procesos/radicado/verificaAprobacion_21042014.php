<?php
session_start();
if(!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8"]) && (!isset($_SESSION['id']) || $_SESSION['id'] != '2956')) {
	echo "No tiene permiso para esta �rea";
  exit;
}
require_once dirname(dirname(dirname(__FILE__))) . "/template/general/header.php";
?>
<!-- Facebox jQuery Plugin -->
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/facebox.js"></script>
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
                    <td><input type="text" name="id" id="id" class="one" onkeypress="return validar_num(event)" /></td>
                  </tr> 
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2"><input type="submit" id="aprobareRadicadoButton" class="button" value="Verificar radicado >>"/></td>
                  </tr>
                </tfoot>
              </table>
              <input type="hidden" id="action" name="action" value="busquedadeRadicado">
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
              <input type="hidden" id="action" name="action" value="aprobarClientes">
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
                    <td><input type="text" name="fecha_inicio" id="fecha_inicio" class="one" />(YYYY-MM-DD)</td>
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
              <input type="hidden" id="action" name="action" value="reporteLotesPlanillas">
            </form>          
         </div>
         <!--<div id="box"><a href="#" onclick="$.fn.abrirBox1(event);">Daniel</a></div>-->
         <div id="box1" style="display:none;">
          <br>
          <form id="devolverRadicadoForm" name="devolverRadicadoForm" onsubmit="$.fn.devolverRadicadoForm(event,this);">
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
                <option value="Sin Datos de contacto">Sin Datos de contacto</option>
                <option value="Sin datos de cliente">Sin datos de cliente</option>
                <option value="Sin Datos financieros ">Sin Datos financieros</option>
                <option value="Actividad Economica">Actividad Economica</option>
                <option value="Huella y/o Firma">Huella y/o Firma</option>
                <option value="Datos Entrevista">Datos Entrevista</option>
                <option value="Falta documentos adicionales o ilegibles">Falta documentos adicionales o ilegibles</option>
                <option value="Formulario">Formulario</option>
                <option value="Actividad econ&oacute;mica persona natural o jur&iacute;dica">Actividad econ&oacute;mica persona natural o jur&iacute;dica</option>
                <option value="Ocupaci&oacute;n o profesi&oacute;n">Ocupaci&oacute;n o profesi&oacute;n</option>
              </select>
            </p>
            <p>
              <label>Observaciones:</label>              
              <select name="observation[]" id="observation" multiple="multiple">  
                <option value="Formulario ilegible (Formulario)">Formulario ilegible (Formulario)</option>
                <option value="Deterioro de formularios (cuando la informacion no sea rescatable) (Formulario)">Deterioro de formularios (cuando la informacion no sea rescatable) (Formulario).</option>
                <option value="Fotocopia de la cedula nueva o ilegible (Sin documentos adicionales)">Fotocopia de la cedula nueva o ilegible (Sin documentos adicionales)</option>
                <option value="SIN Direccion, telefonos (Datos de Contacto)">SIN Direccion, telefonos (Datos de Contacto)</option>
                <option value="SIN Ocupacion, profesi&oacute;n (Datos del Cliente)">SIN Ocupacion, profesi&oacute;n (Datos del Cliente)</option>
                <option value="Debe diligenciar actividad economica">Debe diligenciar actividad economica</option>
                <option value="SIN Informacion financiera (Datos Financieros)">SIN Informacion financiera (Datos Financieros)</option>
                <option value="Huella ilegible fisico (Huella y/o Firma)">Huella ilegible fisico (Huella y/o Firma)</option>
                <option value="Falta huella o firma(Huella y/o Firma)">Falta huella o firma(Huella y/o Firma)</option>
                <option value="La Huella de la fotocopia del documento de identificacion no coincide con el f&iacute;sico (Huella)">La Huella de la fotocopia del documento de identificacion no coincide con el f&iacute;sico (Huella)</option>
                <option value="Formulario con enmendaduras">Formulario con enmendaduras</option>
                <option value="Falta formulario (Formulario)">Falta formulario (Formulario)</option>
                <option value="La entrevista debe estar totalmente diligenciada (fecha,HORA  lugar, aceptacion y nombre legible del asesor o intermediario)">La entrevista debe estar totalmente diligenciada (fecha,HORA  lugar, aceptacion y nombre legible del asesor o intermediario)</option>
                <option value="Sin documentacion adicional o documentos soportes(fotocopia del certificado de representacion legal, Rut, certificado de la alcaldia etc. (Sin documentos adicionales)">Sin documentacion adicional o documentos soportes(fotocopia del certificado de representacion legal, Rut, certificado de la alcaldia etc. (Sin documentos adicionales)</option>
                <option value="Falta fecha de diligenciamiento formulario(Datos Entrevista)">Falta fecha de diligenciamiento formulario(Datos Entrevista)</option>
                <option value="Sin diligenciar tipo actividad o tipo de actividad econ&oacute;mica">Sin diligenciar tipo actividad o tipo de actividad econ&oacute;mica</option>
                <option value="Campo sin diligenciar">Campo sin diligenciar</option>
                <option value="Informaci&oacute;n laboral sin diligenciar">Informaci&oacute;n laboral sin diligenciar</option>
              </select>
            </p>
            <input type="hidden" name="id_sucursal" id="id_sucursal">
            <input type="hidden" name="id_official" id="id_official">
            <input type="hidden" name="clienteid_dev" id="clienteid_dev">
            <input type="hidden" name="typepos" id="typepos">
            <input type="hidden" name="radicado_id" id="radicado_id">
            <input type="hidden" name="action" id="action" value="devolverRadicadoForm">
            <p>
              <input type="submit" id="devolverItem" class="button" value="Realizar devolucion >>"/>
            </p>            
          </form>
         </div>
         <div id="box2" style="display:none;">
          <br>
         </div>
         <div id="boxError" style="display:none;">
         </div>
    </div>
</div>
