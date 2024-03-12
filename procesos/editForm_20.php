<?php
$daneCiudades = General::getCiudadesDanes();
$sucursales = General::getSucursalesLista();
$clasesVinculacion = General::getclaseVinculacion();
$tipoDocumentos = General::getTipoDocumentoID();
$tipoempresas = General::getTipoEmpresaID();
$tipoActividad = Formulario::getTiposActividad();
$actEconomicas = General::getActividadesEconomicas();
$ciius = Formulario::getCiiuId();
$profesiones = General::getProfesionesID();
$ingresos = General::getIngresosMensualesID();
$egresos = General::getEgresosMensualesID();
$transacciones = General::getTipoTransaccionesID();
$paises = General::getPaisesID();
$areas = General::getAreasID();
$funcionarios = General::getOfficials();
?>
<!-- FORMULARIO <?=$dataform['formulario']?> -->
<form method="POST" action="saveEditNew.php" id="saveEditNew" name="saveEditNew">
<input type="hidden" name="id_form" id="id_form" value="<?=$_GET['id_form']?>">
<input type="hidden" name="formulario" id="formulario" value="20">
<input type="hidden" name="type_person" id="type_person" value="<?=$type_person?>">
<input type="hidden" name="id_data" id="id_data" value="<?=$dataform['id']?>">
<input type="hidden" name="action" id="action" value="saveEditNew">
<input type="hidden" name="domain" id="domain" value="form">
<input type="hidden" name="meth" id="meth" value="js">
<input type="hidden" name="respOut" id="respOut" value="json">
<table>


    <tr>
        <td>
        <table>
            <!-- <tr>
                <td style="width: 80px">Fecha de radicado:</td>
                <td>
                    <input type="hidden" id="fecharadicado" name="fecharadicado" value="<?=$dataform['fecharadicado']?>">
                    <select id="f_rad_a" name="f_rad_a" onchange="$(this).verificarFecha(event, 'rad', '1');" style="font-size: 12px">
                        <option value="">Año</option>
<?php
$f_r = explode('-', $dataform['fecharadicado']);
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++){
    $select = '';
    if($i == $f_r[0])
        $select = ' selected';
?>
                        <option value="<?=$i?>"<?=$select?>><?=$i?></option>
<?php
}
?>
                    </select>
                    <select id="f_rad_m" name="f_rad_m" onchange="$(this).verificarFecha(event, 'rad', '1');" style="font-size: 12px">
                        <option value="">Mes</option>
<?php
$an = 1;
for($i = $an ;$i <= 12; $i++){
    $select = '';
    $val_m = '0'.$i;
    if($i > 9)
        $val_m = $i;
    if($val_m == $f_r[1])
        $select = ' selected';
?>
                        <option value="<?=$val_m?>"<?=$select?>><?=$val_m?></option>
<?php
}
?>
                    </select>
                    <select id="f_rad_d" name="f_rad_d" style="font-size: 12px">
                        <option value="">Dia</option>
<?php
for ($d = 1; $d <= 31; $d++) { 
    $time = mktime(12, 0, 0, $f_r[1], $d, $f_r[0]);          
    if (date('m', $time) == $f_r[1]){
        $select = '';
        $day = date('d', $time);
        if($day == $f_r[2])
            $select = ' selected';
?>
                        <option value="<?=$day?>"<?=$select?>><?=$day?></option>
<?php
    }
}
?>
                    </select>
                </td>
            </tr> -->
            <tr>
                <td style="width: 80px">Fecha de diligenciamiento:</td>
                <td>
                    <input type="hidden" id="fechasolicitud" name="fechasolicitud" value="<?=$dataform['fechasolicitud']?>">
                    <select id="f_dil_a" name="f_dil_a" onchange="$(this).verificarFecha(event, 'dil', '1');" style="font-size: 12px">
                        <option value="">Año</option>
<?php
$f_r = explode('-', $dataform['fechasolicitud']);
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++){
    $select = '';
    if($i == $f_r[0])
        $select = ' selected';
?>
                        <option value="<?=$i?>"<?=$select?>><?=$i?></option>
<?php
}
?>
                    </select>
                    <select id="f_dil_m" name="f_dil_m" onchange="$(this).verificarFecha(event, 'dil', '1');" style="font-size: 12px">
                        <option value="">Mes</option>
<?php
$an = 1;
for($i = $an; $i <= 12; $i++){
    $select = '';
    $val_m = '0'.$i;
    if($i > 9)
        $val_m = $i;
    if($val_m == $f_r[1])
        $select = ' selected';
?>
                        <option value="<?=$val_m?>"<?=$select?>><?=$val_m?></option>
<?php
}
?>
                    </select>
                    <select id="f_dil_d" name="f_dil_d" style="font-size: 12px"><!-- onblur="$(this).verificarFechaDoble(event, 'dil', '1');"-->
                        <option value="">Dia</option>
<?php
for ($d = 1; $d <= 31; $d++) { 
    $time = mktime(12, 0, 0, $f_r[1], $d, $f_r[0]);          
    if (date('m', $time) == $f_r[1]){
        $select = '';
        $day = date('d', $time);
        if($day == $f_r[2])
            $select = ' selected';
?>
                        <option value="<?=$day?>"<?=$select?>><?=$day?></option>
<?php
    }
}
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Ciudad:</td>
                <td>
                    <select id="ciudad" name="ciudad" style="font-size: 12px" data-oldvalue="<?=$dataform['ciudad']?>">
                        <option value="">Seleccione...</option>
<?php
/*agregar campo llamado ciudad*/
foreach ($daneCiudades as $ciudad) {
    $slect = '';
    if($dataform['ciudad'] == $ciudad['id'])
        $slect = ' selected';
?>
                        <option value="<?=$ciudad['id']?>"<?=$slect?>><?=$ciudad['ciudad']?></option>
<?php
}
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Sucursal:</td>
                <td>
                    <select id="sucursal" name="sucursal" style="font-size: 12px" data-oldvalue="<?=$dataform['sucursal']?>">
                        <option value="">Seleccione...</option>
<?php
foreach ($sucursales as $sucursal) {
    $slect = '';
    if($dataform['sucursal'] == $sucursal['id'])
        $slect = ' selected';
?>
                        <option value="<?=$sucursal['id']?>"<?=$slect?>><?=$sucursal['sucursal']?></option>
<?php
}
?>
                    </select>
                </td>
            </tr>
            <!-- <tr>
                <td>Area:</td>
                <td>
                    <select id="area" name="area" style="font-size: 12px" data-oldvalue="<?=$dataform['area']?>">
                        <option value="">Seleccione...</option>
<?php
foreach ($areas as $area) {
    $slect = '';
    if($dataform['area'] == $area['id'])
        $slect = ' selected';
?>
                        <option value="<?=$area['id']?>"<?=$slect?>><?=$area['description']?></option>
<?php
}
?>
                    </select>
                </td>
            </tr> -->
            <tr>
                <td>Tipo de solicitud:</td>
                <td>
                    <select id="tipo_solicitud" name="tipo_solicitud" data-oldvalue="<?=$dataform['tipo_solicitud']?>">
                        <option value="">Seleccion...</option>
                        <option value="VINCULACION"<?=(($dataform['tipo_solicitud'] == "VINCULACION") ? "selected" : "")?>>Vinculacion</option>
                        <option value="ACTUALIZACION"<?=(($dataform['tipo_solicitud'] == "ACTUALIZACION") ? "selected" : "")?>>Actualizacion</option>
                        <option value="SD"<?=(($dataform['tipo_solicitud'] == "SD") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Clase vinculacion:</td>
                <td>
                    <select id="clasecliente" name="clasecliente" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['clasecliente']?>">
                        <option value="">Seleccione...</option>
<?php
foreach ($clasesVinculacion as $clase) {
    $slect = '';
    if($dataform['clasecliente'] == $clase['id'])
        $slect = ' selected';
?>
                        <option value="<?=$clase['id']?>"<?=$slect?>><?=$clase['description']?></option>
<?php
}
?>
                    </select>
                    Cual?
                    <input type="text" id="cual_clasecliente" name="cual_clasecliente" style="width: 130px;" readonly value="<?=$dataform['cual_clasecliente']?>"data-oldvalue="<?=$dataform['cual_clasecliente']?>">
                </td>
            </tr>
        </table>
        </td>
    </tr>


    <tr>
        <td>
<?php
require_once 'editForm_20_'.$type_person.'.php';
?>
        </td>
    </tr>
<?php
if($type_person == '1'){
?>
    <tr>
        <td>
        <table>
            <tr style="background-color: #cabbf7; color: #00e;">
                <td colspan="2" align="center"><strong>DECLARACIONES Y AUTORIZACIONES</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Fuente de origen de fondos</td>
                <td>
                    <input type="text" id="origen_fondos" name="origen_fondos" style="width: 360px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Fuente de origen de fondos" value="<?=$dataform['origen_fondos']?>"data-oldvalue="<?=$dataform['origen_fondos']?>">
                </td>
            </tr>
        </table>
        </td>
    </tr>
<?php
}
?>
    <tr>
        <td>
<?php
require_once 'editForm_20_Beneficiarios.php';
?>
        </td>
    </tr>
    <tr>
        <td>
        <table>
            <tr style="background-color: #cabbf7; color: #00e;">
                <td colspan="2" style="width: 100px; display: table-cell;"><strong>CLÁUSULA DE AUTORIZACIÓN</strong></td>
            </tr>
            <tr>
                <td style="width: 100px; display: table-cell;">Autoriza tratamiento comercial?</td>
                <td style="width: 350px">
                    <select id="auto_correo" name="auto_correo" style="font-size: 12px; margin-right: 10px" title="Autoriza el envio por correo" data-oldvalue="<?=$dataform['auto_correo']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['auto_correo'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['auto_correo'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['auto_correo'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px; display: table-cell;">Autoriza tratamiendo de datos?</td>
                <td style="width: 350px">
                    <select id="auto_sms" name="auto_sms" style="font-size: 12px;" title="Autoriza el envio de SMS" data-oldvalue="<?=$dataform['auto_sms']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['auto_sms'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['auto_sms'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['auto_sms'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Canales en los que no autoriza contacto</td>
                <td>
                    <input type="text" id="sin_contacto_canal" name="sin_contacto_canal" style="width: 190px; margin-right: 10px"  style="width: 360px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Canales en los que no autoriza contacto" value="<?=$dataform['sin_contacto_canal']?>"data-oldvalue="<?=$dataform['sin_contacto_canal']?>">
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table width="491">
            <tr style="background-color: #cabbf7; color: #00e;">
                <td colspan="2" align="center"><strong>FIRMA Y HUELLA</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Firma:</td>
                <td>
                    <select id="firma" name="firma" style="font-size: 12px; margin-right: 20px" title="Firma" data-oldvalue="<?=$dataform['firma']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['firma'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['firma'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['firma'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Huella:
                    <select id="huella" name="huella" style="font-size: 12px; margin-left: 5px" title="Huella" data-oldvalue="<?=$dataform['huella']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['huella'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['huella'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['huella'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table>
            <tr style="background-color: #cabbf7; color: #00e;">
                <td colspan="2" align="center"><strong>10. CONFIRMACI&Oacute;N DE LA INFORMACI&Oacute;N</strong></td>
            </tr>
            <tr>
                <td style="width: 80px">Fecha de verificacion:</td>
                <td>
                    <input type="hidden" id="verificacion_fecha" name="verificacion_fecha" value="<?=$dataform['verificacion_fecha']?>">
                    <select id="f_ver_a" name="f_ver_a" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px" title="Año de fecha de verificacion">
                        <option value="">Año</option>
<?php
$f_r = explode('-', $dataform['verificacion_fecha']);
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++){
    $select = '';
    if($i == $f_r[0])
        $select = ' selected';
?>
                        <option value="<?=$i?>"<?=$select?>><?=$i?></option>
<?php
}
?>
                    </select>
                    <select id="f_ver_m" name="f_ver_m" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px" title="Mes de fecha de verificacion">
                        <option value="">Mes</option>
<?php
$an = 1;
for($i = $an; $i <= 12; $i++){
    $select = '';
    $val_m = '0'.$i;
    if($i > 9)
        $val_m = $i;
    if($val_m == $f_r[1])
        $select = ' selected';
?>
                        <option value="<?=$val_m?>"<?=$select?>><?=$val_m?></option>
<?php
}
?>
                    </select>
                    <select id="f_ver_d" name="f_ver_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de fecha de verificacion">
                        <option value="">Dia</option>
<?php
for ($d = 1; $d <= 31; $d++) { 
    $time = mktime(12, 0, 0, $f_r[1], $d, $f_r[0]);
    if (date('m', $time) == $f_r[1]){
        $select = '';
        $day = date('d', $time);
        if($day == $f_r[2])
            $select = ' selected';
?>
                        <option value="<?=$day?>"<?=$select?>><?=$day?></option>
<?php
    }
}
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Lugar entrevista:</td>
                <td>
                    <input type="text" id="lugarentrevista" name="lugarentrevista" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Lugar entrevista" value="<?=$dataform['lugarentrevista']?>"data-oldvalue="<?=$dataform['lugarentrevista']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 80px">Hora:</td>
                <td>
                    
                    <select id="h_ver_h" name="h_ver_h" style="font-size: 12px" title="Hora">
                        <option value="">Hora</option>
<?php
if($dataform['verificacion_hora'] == '00:00:00')
    $h_h = array("", "", "");
else
    $h_h = explode(':', date('h:i:A', strtotime($dataform['verificacion_hora'])));

for ($i = 1; $i <= 12; $i++) { 
    $hor = $i;
    if (strlen($i) == 1) {
        $hor = '0'.$i;
    }
    $select = '';
    if($h_h[0] == $hor)
        $select = 'selected';
?>
                        <option value="<?=$hor?>"<?=$select?>><?=$hor?></option>
<?php
}
?>
                    </select>
                    <select id="h_ver_m" name="h_ver_m" style="font-size: 12px" title="Minuto">
                        <option value="">Minuto</option>
<?php
for ($i = 0; $i <= 59; $i++) { 
    $hor = $i;
    if (strlen($i) == 1) {
        $hor = '0'.$i;
    }
    $select = '';
    if($h_h[1] == $hor)
        $select = 'selected';
?>
                        <option value="<?=$hor?>"<?=$select?>><?=$hor?></option>
<?php
}
?>
                    </select>
                    <select id="h_ver_z" name="h_ver_z" style="font-size: 12px" title="Horario">
                        <option value="">Horario</option>
                        <option value="AM"<?=(($h_h[2] == "AM") ? "selected" : "")?>>A.M.</option>
                        <option value="PM"<?=(($h_h[2] == "PM") ? "selected" : "")?>>P.M.</option>
                    </select>
                    <input type="hidden" id="verificacion_hora" name="verificacion_hora" value="<?=$dataform['verificacion_hora']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nombre y cargo de quien verifica:</td>
                <td>
                    <input type="text" id="nombreintermediario" name="nombreintermediario" style="width: 350px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Nombre y cargo de quien verifica" value="<?=$dataform['nombreintermediario']?>"data-oldvalue="<?=$dataform['nombreintermediario']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nombre del intermediario:</td>
                <td>
                    <input type="text" id="verificacion_nombre" name="verificacion_nombre" style="width: 350px; margin-right: 5px" onkeypress="return validar_letra(event)" title="Nombre del intermediario" value="<?=$dataform['verificacion_nombre']?>"data-oldvalue="<?=$dataform['verificacion_nombre']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nombre del asesor:</td>
                <td>
                    <input type="text" id="verificacion_cargo" name="verificacion_cargo" style="width: 350px; margin-right: 5px" onkeypress="return validar_letra(event)" title="Nombre del asesor" value="<?=$dataform['verificacion_cargo']?>"data-oldvalue="<?=$dataform['verificacion_cargo']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Observaciones:</td>
                <td>
                    <textarea cols="40" rows="4" id="verificacion_observacion" name="verificacion_observacion" onkeypress="return validar_letra(event)" title="Observaciones" data-oldvalue="<?=$dataform['origen_fondos']?>"><?=$dataform['origen_fondos']?></textarea>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Firma:</td>
                <td>
                    <select id="verificacion_firma" name="verificacion_firma" style="font-size: 12px" title="Firma" data-oldvalue="<?=$dataform['verificacion_firma']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['verificacion_firma'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['verificacion_firma'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['verificacion_firma'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"></td>
                <td></td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
<?php
require_once 'editForm_20_Peps.php';
?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td align="center"><input type="submit" value="Editar formulario"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
</form>
<script type="text/javascript">
$(document).ready(function(){
    $('select[name="clasecliente"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '10'){
            $('input[name="cual_clasecliente"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="cual_clasecliente"]').val('');
            $('input[name="cual_clasecliente"]').attr('readonly', true);
        }
    });
    // $('select[name="tipoempresaemp"]').change(function(event){
    //     (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
    //     if($(this).val() == '5'){
    //         $('input[name="tipoempresaemp_cual"]').removeAttr('readonly');
    //     }else if($(this).val() != ''){
    //         $('input[name="tipoempresaemp_cual"]').val('');
    //         $('input[name="tipoempresaemp_cual"]').attr('readonly', true);
    //     }
    // });
    $('select[name="sector_actividad"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '8'){
            $('input[name="sector_actividad_cual"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="sector_actividad_cual"]').val('');
            $('input[name="sector_actividad_cual"]').attr('disabled', true);
        }
    });
    $('select[name="tributarias_otro_pais"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="tributarias_paises"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="tributarias_paises"]').val('');
            $('input[name="tributarias_paises"]').attr('disabled', true);
        }
    });
    $('select[name="monedaextranjera"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('select[name="tipotransacciones"]').removeAttr('readonly');
        }else if($(this).val() == '0' || $(this).val() == '2'){
            $('select[name="tipotransacciones"]').val('8').change();
            $('select[name="tipotransacciones"]').attr('readonly', true);
            $('input[name="tipotransacciones_cual"]').val('SD');
            $('input[name="tipotransacciones_cual"]').attr('readonly', true);
        }else if($(this).val() != ''){
            $('select[name="tipotransacciones"]').val('');
            $('select[name="tipotransacciones"]').attr('readonly', true);
            $('input[name="tipotransacciones_cual"]').val('');
            $('input[name="tipotransacciones_cual"]').attr('readonly', true);
        }
    });
    $('select[name="tipotransacciones"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '7'){
            $('input[name="tipotransacciones_cual"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="tipotransacciones_cual"]').val('');
            $('input[name="tipotransacciones_cual"]').attr('readonly', true);
        }
    });
    $('select[name^="otrosingresos"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '13'){
            $('input[name^="concepto"]').val('SD');
        }else{
            $('input[name^="concepto"]').val('');
        }
    });
    $('form#saveEditNew').submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        var datos = {};
        $(this).find("[data-oldvalue]").each(function(index, el) {
            if($(el).val() != $(el).attr('data-oldvalue')){
                datos[$(el).attr('name')] = $(el).val();
                console.log($(el).attr('name') + '->' + $(el).val() + ':::' + $(el).attr('data-oldvalue'));
            }
        });
        // if($(this).find('select[name="f_rad_a"]').val() != '' && $(this).find('select[name="f_rad_m"]').val() != '' && $(this).find('select[name="f_rad_d"]').val() != ''){
        //     var fecharadicado = $(this).find('select[name="f_rad_a"]').val() + '-' + $(this).find('select[name="f_rad_m"]').val() + '-' + $(this).find('select[name="f_rad_d"]').val();
        //     if($(this).find('input[name="fecharadicado"]').val() != fecharadicado)
        //         datos['fecharadicado'] = fecharadicado;
        // }else{
        //     alert('La fecha de radicado no puede estar vacia o incompleta.');
        //     return false;
        // }

        if($(this).find('select[name="f_dil_a"]').val() != '' && $(this).find('select[name="f_dil_m"]').val() != ''&& $(this).find('select[name="f_dil_d"]').val() != ''){
            var fechasolicitud = $(this).find('select[name="f_dil_a"]').val() + '-' + $(this).find('select[name="f_dil_m"]').val() + '-' + $(this).find('select[name="f_dil_d"]').val();
            if($(this).find('input[name="fechasolicitud"]').val() != fechasolicitud)
                datos['fechasolicitud'] = fechasolicitud;
        }else{
            alert('La fecha de diligenciamiento no puede estar vacia o incompleta.');
            return false;
        }

        if($(this).find('select[name="f_exp_a"]').val() != '' && $(this).find('select[name="f_exp_m"]').val() != '' && $(this).find('select[name="f_exp_d"]').val() != ''){
            var fechaexpedicion = $(this).find('select[name="f_exp_a"]').val() + '-' + $(this).find('select[name="f_exp_m"]').val() + '-' + $(this).find('select[name="f_exp_d"]').val();
            if($(this).find('input[name="fechaexpedicion"]').val() != fechaexpedicion)
                datos['fechaexpedicion'] = fechaexpedicion;
        }

        if($(this).find('select[name="f_nac_a"]').val() != '' && $(this).find('select[name="f_nac_m"]').val() != '' && $(this).find('select[name="f_nac_d"]').val() != ''){
            var fechanacimiento = $(this).find('select[name="f_nac_a"]').val() + '-' + $(this).find('select[name="f_nac_m"]').val() + '-' + $(this).find('select[name="f_nac_d"]').val();
            if($(this).find('input[name="fechanacimiento"]').val() != fechanacimiento)
                datos['fechanacimiento'] = fechanacimiento;
        }

        if($(this).find('select[name="f_ver_a"]').val() != '' && $(this).find('select[name="f_ver_m"]').val() != '' && $(this).find('select[name="f_ver_d"]').val() != ''){
            var verificacion_fecha = $(this).find('select[name="f_ver_a"]').val() + '-' + $(this).find('select[name="f_ver_m"]').val() + '-' + $(this).find('select[name="f_ver_d"]').val();
            if($(this).find('input[name="verificacion_fecha"]').val() != verificacion_fecha)
                datos['verificacion_fecha'] = verificacion_fecha;
        }


        if($(this).find('select[name="h_ver_h"]').val() != '' && $(this).find('select[name="h_ver_m"]').val() != '' && $(this).find('select[name="h_ver_z"]').val() != ''){
            var verificacion_hora = $.fn.convertTime12to24($(this).find('select[name="h_ver_h"]').val() + ':' + $(this).find('select[name="h_ver_m"]').val() + ' ' + $(this).find('select[name="h_ver_z"]').val());
            if(verificacion_hora != $(this).find('input[name="verificacion_hora"]').val())
                datos['verificacion_hora'] = verificacion_hora;
        }
        if($.isEmptyObject(datos)){
            alert('No esta efectuando ningun cambio en la data del cliente.');
            return false;
        }
        datos['id_form'] = $(this).find('input[name="id_form"]').val();
        datos['type_person'] = $(this).find('input[name="type_person"]').val();
        datos['id_data'] = $(this).find('input[name="id_data"]').val();
        datos['action'] = $(this).find('input[name="action"]').val();
        datos['domain'] = $(this).find('input[name="domain"]').val();
        datos['meth'] = $(this).find('input[name="meth"]').val();
        datos['respOut'] = $(this).find('input[name="respOut"]').val();
        var form = this;
        $.ajax({
            beforeSend: function(){
                //$('table#table_list_result tbody tr td button#drea_button_add_'+posicion).button('loading');
            },
            data: datos,
            type: 'POST',
            url: 'includes/Controller.php',
            dataType: 'json',
            success: function(dato){
                console.log(dato);
                if(dato.exito){
                    alert(dato.exito);

                    /*$.each(datos, function(key, value){
                        if(key != 'domain' && key != 'action' && key != 'meth' && key != 'respOut' && key != 'id_form' && key != 'formulario' && key != 'type_person' && key != 'id_data')
                            $(form).find('[name="' + key + '"]').attr('data-oldvalue', value);
                        //alert( key + ": " + value );
                    });*/
                    location.reload(true);
                }else if(dato.error)
                    alert(dato.error);
                else
                    alert('Ocurrio un error, contacte con el administrador...');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
                alert("Error(saveEditNew): "+xhr.status+" Error: "+xhr.responseText);
            }
        });

    });
});
$.fn.convertTime12to24 = function(time12h){
    var tPart = time12h.split(' ');
    var hPart = tPart[0].split(':');

    if(hPart[0] === '12')
        hPart[0] = '00';

    if(tPart[1] === 'PM')
        hPart[0] = parseInt(hPart[0], 10) + 12;

    return hPart[0] + ':' + hPart[1] + ':00';
}
$.fn.verificarFecha = function(e, call, tipo){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    var f_a = $('select#f_'+call+'_a').val();
    var f_m = $('select#f_'+call+'_m').val();
    //alert('ano:'+f_a+' mes:'+f_m);
    if((f_a != '' && f_a != 'ND') && (f_m != '' && f_m != 'ND')){
        var d = new Date(f_a, f_m, 0).getDate();
        //alert(); // last day in January
        var d_str = '';
        str_d = '<option value="">Dia</option>';
        for(var i=1;i<=d;i++){
            d_str = '0'+i;
            if(i > 9)
                d_str = i;
            str_d += '<option value="'+i+'">'+d_str+'</option>';
        }
        $('select#f_'+call+'_d').html(str_d);
    }else if(f_a == 'ND' || f_m == 'ND'){
        //$('select#f_'+call+'_a option[value="ND"]').prop('selected', true);
        $('select#f_'+call+'_m option[value="ND"]').prop('selected', true);
        $('select#f_'+call+'_d').html('<option value="">Dia</option><option value="ND">ND</option>');
        $('select#f_'+call+'_d option[value="ND"]').prop('selected', true);
    }
}
$.fn.verificarFechaDoble = function(e, call, tipo){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if(tipo == '1'){
        var f_a = $('select#f_'+call+'_a').val();
        var f_m = $('select#f_'+call+'_m').val();
        var f_d = $(this).val();
        if(f_a != '' && f_m != '' && f_d != ''){
            $('select#f_'+call+'_a').hide();
            $('select#f_'+call+'_m').hide();
            $(this).hide();
        }
    }else if(tipo == '2'){
        var f_1 = $('select#f_'+call+'_a').val()+'-'+$('select#f_'+call+'_m').val()+'-'+$('select#f_'+call+'_d').val();
        var f_2 = $('select#f_'+call+'2_a').val()+'-'+$('select#f_'+call+'2_m').val()+'-'+$('select#f_'+call+'2_d').val();
        if(f_1 != f_2){
            alert("Las fechas no coinciden, por favor validelas.");
            $('select#f_'+call+'_a').show();
            $('select#f_'+call+'_a').val('');
            $('select#f_'+call+'_a').change();
            $('select#f_'+call+'_m').show();
            $('select#f_'+call+'_m').val('');
            $('select#f_'+call+'_m').change();
            $('select#f_'+call+'_d').show();
            $('select#f_'+call+'_d').val('');
            $('select#f_'+call+'_d').change();

            $('select#f_'+call+'2_a').val('');
            $('select#f_'+call+'2_a').change();
            $('select#f_'+call+'2_m').val('');
            $('select#f_'+call+'2_m').change();
            $('select#f_'+call+'2_d').val('');
            $('select#f_'+call+'2_d').change();

            $('select#f_'+call+'_a').focus();
        }
    }
}
</script>