<?php
session_start();
require_once '../../template/general/header.php';
require_once '../../lib/class/official.class.php';
require_once '../../lib/class/general.class.php';
$official = new Official();
$officials = $official->getOfficials();

$general = new General();
$areas = $general->getAreas();
$sucursales = $general->getSucursales();
?>

<!-- Page Head -->
<h2>Enviar caso</h2>
<p id="page-intro">Enviar caso a responsable de documentación.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">

        <h3>Creación de casos</h3>

        <ul class="content-box-tabs">            
            <li><a href="#tab1"  class="default-tab">Escribir caso</a></li>
        </ul>

        <div class="clear"></div>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->            

            <div class="notification attention png_bg"> 
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    No olvide que el caso se notificará al responsable y al director de la sucursal vía e-mail.
                </div>
            </div>
            <div class="notification success  png_bg" id="result_notif" style="display:none;"> 
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_adduser">

                </div>
            </div>

            <form action="addCase.php" method="POST" id="form_caseadd" name="form_caseadd">
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Documento:</label>
                        <input type="text" name="documento" id="documento" onkeypress="return validar_num(event);" onpaste="alert('Digite el numero por favor');return false;" oncopy="alert('No se le permite esta opcion');return false;"/><!--onblur="$.fn.buscarCliente(event,$(this).val());"  -->
                        <img id="imgloading" src="../../images/icons/loading.gif" width="16" height="16" style="display:none;">
                    </p>
                    <p>
                        <label>Tipo de Cliente:</label>
                        <select id="persontype" name="persontype">
                            <option value="">Seleccione...</option>
                            <option value="1">Natural</option>
                            <option value="2">Juridico</option>
                        </select>
                    </p>
                    <p>
                        <label>Nombre cliente:</label>
                        <input type="text" name="nombre" id="nombre" size="80"/>
                    </p>
                    <p>
                        <label>Lote:</label>
                        <input type="text" name="lote" id="lote" size="6"/>
                    </p>
                    <p>	
                        <label>&Aacute;rea:</label>
                        <select id="area" name="area">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($areas)) {
                                echo "<option value='{$result['id']}'>{$result['description']}</option>";
                            }
                            ?>
                        </select>

                    </p>

                    <p>	
                        <label>Sucursal:</label>
                        <select id="sucursal" name="sucursal">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($sucursales)) {
                                echo "<option value='{$result['id']}'>{$result['sucursal']}</option>";
                            }
                            ?>
                        </select>

                    </p>



                    <p>
                        <label>Causal de devolución:</label>              
                        <select name="causaldevolucion" id="causaldevolucion" class="big-input">
                            <option value="">--Seleccione opción--</option>
                            <!-- <option value="Formulario ilegible">Formulario ilegible</option>
                           <option value="Deterioro de formularios (cuando la información no sea rescatable)">Deterioro de formularios (cuando la información no sea rescatable)</option>
                           <option value="La huella de la fotocopia de la cedula debe coincidir con la huella del formulario">La huella de la fotocopia de la cedula debe coincidir con la huella del formulario</option>
                           <option value="Datos financieros">Datos financieros</option>
                           <option value="Entrevista totalmente diligenciada(fecha, lugar, aceptación y firma del asesor o intermediario)">Entrevista totalmente diligenciada(fecha, lugar, aceptación y firma del asesor o intermediario)</option>
                           <option value="Fecha y lugar de expedición del documento de identificación">Fecha y lugar de expedición del documento de identificación</option>
                           <option value="Fecha y lugar de  nacimiento">Fecha y lugar de  nacimiento</option>
                           <option value="Fotocopia de la cedula nueva">Fotocopia de la cedula nueva</option>
                           <option value="Ocupación, profesión (si es comerciante debe tener qué tipo de comercialización)">Ocupación, profesión (si es comerciante debe tener qué tipo de comercialización)</option>
                           <option value="Dirección, teléfonos, nombres">Dirección, teléfonos, nombres</option>
                           <option value="Huella ilegible físico">Huella ilegible físico</option>
                           <option value="Datos personales">Datos personales</option> -->
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
                        <label>Responsable:</label>
                        <select name="official" id="official" >
                            <option value="">--Seleccione una opción--</option>
                            <?php
                            while ($offi = mysqli_fetch_array($officials)) {
                                echo "<option value='" . $offi['id'] . "'>" . $offi['name'] . "</option>";
                            }
                            ?>
                        </select>                        
                    </p>
                    <p>
                        <label>Observaciones:</label>              
                        <select name="observation[]" id="observation[]" class="big-input" multiple="multiple">
                            <!-- <option value="">--Seleccione opción--</option>
                             <option value="Formulario ilegible">Formulario ilegible</option>
                             <option value="Deterioro de formularios (cuando la información no sea rescatable)">Deterioro de formularios (cuando la información no sea rescatable)</option>
                             <option value="La huella de la fotocopia de la cedula debe coincidir con la huella del formulario">La huella de la fotocopia de la cedula debe coincidir con la huella del formulario</option>
                             <option value="Datos financieros">Datos financieros</option>
                             <option value="Entrevista totalmente diligenciada(fecha, lugar, aceptación y firma del asesor o intermediario)">Entrevista totalmente diligenciada(fecha, lugar, aceptación y firma del asesor o intermediario)</option>
                             <option value="Fecha y lugar de expedición del documento de identificación">Fecha y lugar de expedición del documento de identificación</option>
                             <option value="Fecha y lugar de  nacimiento">Fecha y lugar de  nacimiento</option>
                             <option value="Fotocopia de la cedula nueva">Fotocopia de la cedula nueva</option>
                             <option value="Ocupación, profesión (si es comerciante debe tener qué tipo de comercialización)">Ocupación, profesión (si es comerciante debe tener qué tipo de comercialización)</option>
                             <option value="Dirección, teléfonos, nombres">Dirección, teléfonos, nombres</option>
                             <option value="Huella ilegible físico">Huella ilegible físico</option>
                             <option value="Datos personales">Datos personales</option>
                                 <option value="Falta huella o firma">Falta huella o firma</option>
                                 <option value="Falta formulario">Falta formulario</option>
                                 <option value="Fotocopia cedula ilegible">Fotocopia cedula ilegible</option>
                                 <option value="Sin fotocopia de camara y comercio o Certicacion alcaldia">Sin fotocopia de camara y comercio o Certicacion alcaldia</option>
                                 <option value="Sin documentos adicionales o no vigentes (C�mara de comercio, personer�a jur�dica)">Sin documentos adicionales o no vigentes (C�mara de comercio, personer�a jur�dica)</option>
                            -->		
                            <option value="Formulario ilegible (Formulario)">Formulario ilegible (Formulario)</option>
                            <option value="Deterioro de formularios (cuando la informacion no sea rescatable) (Formulario)">Deterioro de formularios (cuando la informacion no sea rescatable) (Formulario).</option>
                            <option value="Fotocopia de la cedula nueva o ilegible (Sin documentos adicionales)">Fotocopia de la cedula nueva o ilegible (Sin documentos adicionales)</option>
                            <option value="SIN Direccion, telefonos (Datos de Contacto)">SIN Direccion, telefonos (Datos de Contacto)</option>
                            <option value="SIN Ocupacion, profesi�n (Datos del Cliente)">SIN Ocupacion, profesi�n (Datos del Cliente)</option>
                            <option value="Debe diligenciar actividad economica">Debe diligenciar actividad economica</option>
                            <option value="SIN Informacion financiera (Datos Financieros)">SIN Informacion financiera (Datos Financieros)</option>
                            <option value="Huella ilegible fisico (Huella y/o Firma)">Huella ilegible fisico (Huella y/o Firma)</option>
                            <option value="Falta huella o firma(Huella y/o Firma)">Falta huella o firma(Huella y/o Firma)</option>
                            <option value="La Huella de la fotocopia del documento de identificacion no coincide con el f�sico (Huella)">La Huella de la fotocopia del documento de identificacion no coincide con el f�sico (Huella)</option>
                            <option value="El numero de documento en el formulario esta errado o mal diligenciado">El numero de documento en el formulario esta errado o mal diligenciado</option>
                            <option value="Formulario con enmendaduras">Formulario con enmendaduras</option>
                            <option value="Falta formulario (Formulario)">Falta formulario (Formulario)</option>
                            <option value="La entrevista debe estar totalmente diligenciada (fecha,HORA  lugar, aceptacion y nombre legible del asesor o intermediario)">La entrevista debe estar totalmente diligenciada (fecha,HORA  lugar, aceptacion y nombre legible del asesor o intermediario)</option>
                            <option value="Sin documentacion adicional o documentos soportes(fotocopia del certificado de representacion legal, Rut, certificado de la alcaldia etc. (Sin documentos adicionales)">Sin documentacion adicional o documentos soportes(fotocopia del certificado de representacion legal, Rut, certificado de la alcaldia etc. (Sin documentos adicionales)</option>
                            <option value="Falta fecha de diligenciamiento formulario(Datos Entrevista)">Falta fecha de diligenciamiento formulario(Datos Entrevista)</option>
                            <option value="Sin diligenciar tipo actividad o tipo de actividad econ&oacute;mica">Sin diligenciar tipo actividad o tipo de actividad econ&oacute;mica</option>
                            <option value="Campo sin diligenciar">Campo sin diligenciar</option>
                            <option value="Informaci&oacute;n laboral sin diligenciar">Informaci&oacute;n laboral sin diligenciar</option>
                            <option value="No existe formulario de vinculación inicial">No existe formulario de vinculación inicial</option>
                        </select> 
                    </p>

                    <p>
                        <input class="button" type="submit" value="Enviar caso >>" />
                    </p>
                </fieldset>
                <div class="clear"></div><!-- End .clear -->
            </form>
        </div> <!-- End #tab2 -->    
    </div>
</div>

<div class="clear"></div>
<?php
require_once '../../template/general/footer.php';
?>