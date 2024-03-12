<?php
$daneCiudades = General::getCiudadesDanes();
$clasesVinculacion = General::getclaseVinculacion();
$tipoDocumentos = General::getTipoDocumentoID();
$actEconomicas = General::getActividadesEconomicas();
$ciius = Formulario::getCiiuId();
$profesiones = General::getProfesionesID();
$ingresos = General::getIngresosMensualesID();
$egresos = General::getEgresosMensualesID();
$paises = General::getPaisesID();
?>
<!-- FORMULARIO <?=$dataform['formulario']?> -->
<form method="POST" action="saveEditNew.php" id="saveEditNew" name="saveEditNew">
<input type="hidden" name="id_form" id="id_form" value="<?=$_GET['id_form']?>">
<input type="hidden" name="formulario" id="formulario" value="19">
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
                <td style="width: 80px">Fecha de diligenciamiento:</td><!--fechasolicitud-->
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
            <!-- <tr>
                <td>Tipo de solicitud:</td>
                <td>
                    <select id="tipo_solicitud" name="tipo_solicitud" data-oldvalue="<?=$dataform['tipo_solicitud']?>">
                        <option value="">Seleccion...</option>
                        <option value="VINCULACION"<?=(($dataform['tipo_solicitud'] == "VINCULACION") ? "selected" : "")?>>Vinculacion</option>
                        <option value="ACTUALIZACION"<?=(($dataform['tipo_solicitud'] == "ACTUALIZACION") ? "selected" : "")?>>Actualizacion</option>
                        <option value="SD"<?=(($dataform['tipo_solicitud'] == "SD") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr> -->
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
                    <input type="text" id="cual_clasecliente" name="cual_clasecliente" style="width: 130px;" value="<?=$dataform['cual_clasecliente']?>" data-oldvalue="<?=$dataform['cual_clasecliente']?>"<?=($dataform['clasecliente'] != '10') ? ' readonly' : '' ?>>
                </td>
            </tr>
        </table>
        </td>
    </tr>



    <tr>
        <td>
<?php
require_once 'editForm_19_' . $type_person . '.php';
?>
        </td>
    </tr>
    <tr>
        <td>
        <table>
            <tr style="background-color: #cabbf7; color: #00e;">
                <td colspan="2" align="center"><strong>INFORMACI&Oacute;N PERSONA EXPUESTAMENTE POL&Iacute;TICAMENTE (PEP) DEL <?=($type_person == '1') ? 'TOMADOR' : 'REPRESENTANTE LEGAL'?></strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta politicamente?</td>
                <td>
                    <select id="pep_expuesto" name="pep_expuesto" style="font-size: 12px; margin-right: 15px" title="Persona expuesta politicamente" data-oldvalue="<?=$dataform['pep_expuesto']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['pep_expuesto'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['pep_expuesto'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['pep_expuesto'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Expuesto politico extranjero?</td>
                <td>
                    <select id="expuesta_extrangero" name="expuesta_extrangero" style="font-size: 12px; margin-right: 15px" title="Expuesto politico extranjero" data-oldvalue="<?=$dataform['expuesta_extrangero']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['expuesta_extrangero'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['expuesta_extrangero'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['expuesta_extrangero'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Expuesto politico internacional?
                    <select id="expuesta_internacional" name="expuesta_internacional" style="font-size: 12px; margin-left: 10px" title="Expuesto politico internacional" data-oldvalue="<?=$dataform['expuesta_internacional']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['expuesta_internacional'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['expuesta_internacional'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['expuesta_internacional'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Conyuge de expuesto politico?</td>
                <td>
                    <select id="conyuge_expuesto" name="conyuge_expuesto" style="font-size: 12px; margin-right: 15px" title="Conyuge de expuesto politico" data-oldvalue="<?=$dataform['conyuge_expuesto']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['conyuge_expuesto'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['conyuge_expuesto'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['conyuge_expuesto'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Asociado expuesto politico?
                    <select id="asociado_expuesto" name="asociado_expuesto" style="font-size: 12px; margin-left: 10px" title="Asociado expuesto politico" data-oldvalue="<?=$dataform['asociado_expuesto']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['asociado_expuesto'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['asociado_expuesto'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['asociado_expuesto'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Familiar de expuesto politico?</td>
                <td>
                    <select id="pep_familiar" name="pep_familiar" style="font-size: 12px; margin-right: 5px" title="Familiar de expuesto politico" data-oldvalue="<?=$dataform['pep_familiar']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['pep_familiar'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['pep_familiar'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['pep_familiar'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Nombre: 
                    <input type="text" id="pep_familia_nombre" name="pep_familia_nombre" style="width: 100px" onkeypress="return validar_letra(event)" title="Nombre" value="<?=$dataform['pep_familia_nombre']?>" data-oldvalue="<?=$dataform['pep_familia_nombre']?>">
                    Cargo: 
                    <input type="text" id="pep_familia_cargo" name="pep_familia_cargo" style="width: 100px" onkeypress="return validar_letra(event)" title="Cargo" value="<?=$dataform['pep_familia_cargo']?>" data-oldvalue="<?=$dataform['pep_familia_cargo']?>">
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
<?php
require_once 'editForm_19_Economica_' . $type_person . '.php';
?>
        </td>
    </tr>
    <tr>
        <td>
<?php
//require_once PATH_INTERNAL.DS.$request['action'].'_Beneficiarios_View.php';
?>
        </td>
    </tr>
    <tr>
        <td>
        <table width="491">
            <tr style="background-color: #cabbf7; color: #00e;">
                <td colspan="2" align="center"><strong>DECLARACIONES Y AUTORIZACIONES</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Fuente de origen de fondos</td>
                <td>
                    <input type="text" id="origen_fondos" name="origen_fondos" style="width: 160px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Fuente de origen de fondos" value="<?=$dataform['origen_fondos']?>" data-oldvalue="<?=$dataform['origen_fondos']?>">
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table width="491">
            <tr style="background-color: #cabbf7; color: #00e;">
                <td colspan="2" align="center"><strong>AUTORIZACI&Oacute;N DE TRATAMIENTO DE DATOS PERSONALES</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Observaciones:</td>
                <td>
                    <textarea cols="40" rows="4" id="observacionesentrevista" name="observacionesentrevista" onkeypress="return validar_letra(event)" title="Observaciones" data-oldvalue="<?=$dataform['observacionesentrevista']?>"><?=$dataform['observacionesentrevista']?></textarea>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Canales en los que no autoriza contacto</td>
                <td>
                    <input type="text" id="sin_contacto_canal" name="sin_contacto_canal" style="width: 190px; margin-right: 10px" onkeypress="return validar_letra(event)" title="canales de no contacto" value="<?=$dataform['sin_contacto_canal']?>" data-oldvalue="<?=$dataform['sin_contacto_canal']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nombre Intermediario / Asesor / Entrevistador:</td>
                <td>
                    <input type="text" id="nombreintermediario" name="nombreintermediario" style="width: 190px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Nombre Intermediario / Asesor / Entrevistador" value="<?=$dataform['nombreintermediario']?>" data-oldvalue="<?=$dataform['nombreintermediario']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nombre de verificador:</td>
                <td>
                    <input type="text" id="verificacion_nombre" name="verificacion_nombre" style="width: 230px; margin-right: 5px" onkeypress="return validar_letra(event)" title="Nombre de verificador" value="<?=$dataform['verificacion_nombre']?>" data-oldvalue="<?=$dataform['verificacion_nombre']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Cargo:</td>
                <td>
                    <input type="text" id="verificacion_cargo" name="verificacion_cargo" style="width: 230px; margin-right: 5px" onkeypress="return validar_letra(event)" title="Cargo de verificador" value="<?=$dataform['verificacion_cargo']?>" data-oldvalue="<?=$dataform['verificacion_cargo']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Numero de cedula:</td>
                <td>
                    <input type="text" id="verificacion_documento" name="verificacion_documento" style="width: 230px; margin-right: 5px" onkeypress="return validar_num(event)" title="Documento de verificador" value="<?=$dataform['verificacion_documento']?>" data-oldvalue="<?=$dataform['verificacion_documento']?>">
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table width="491">
            <tr style="background-color: #cabbf7; color: #00e;">
                <td colspan="2" align="center"><strong>DOCUMENTOS REQUERIDOS</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Firma:</td>
                <td>
                    <select id="firma" name="firma" style="font-size: 12px; margin-right: 20px" title="Firma" data-oldvalue="<?=$dataform['firma']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['firma'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['firma'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                </td>
            </tr>
        </table>
        </td>
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
    $('select[name="tributarias_otro_pais"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="tributarias_paises"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="tributarias_paises"]').val('');
            $('input[name="tributarias_paises"]').attr('readonly', true);
        }
    });
    $('form#saveEditNew').submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        const datos = {};
        $(this).find("[data-oldvalue]").each(function(index, el) {

            if ($(el).val() !== $(el).attr('data-oldvalue')) {
                datos[$(el).attr('name')] = $(el).val();
            }
        });
        // if ($('select[name="f_rad_a"]', this).val() === '' || $('select[name="f_rad_m"]', this).val() === '' || $('select[name="f_rad_d"]', this).val() === '') {
        //     alert('La fecha de radicado no puede estar vacia o incompleta.');
        //     return false;
        // }
        // const fecharadicado = `${$('select[name="f_rad_a"]', this).val()}-${$('select[name="f_rad_m"]', this).val()}-${$('select[name="f_rad_d"]', this).val()}`;
        // if ($('input[name="fecharadicado"]', this).val() !== fecharadicado) {
        //     datos['fecharadicado'] = fecharadicado;
        // }

        if ($('select[name="f_dil_a"]', this).val() === '' || $('select[name="f_dil_m"]', this).val() === '' || $('select[name="f_dil_d"]', this).val() === '') {
            alert('La fecha de diligenciamiento no puede estar vacia o incompleta.');
            return false;
        }
        const fechasolicitud = `${$('select[name="f_dil_a"]', this).val()}-${$('select[name="f_dil_m"]', this).val()}-${$('select[name="f_dil_d"]', this).val()}`;
        if ($('input[name="fechasolicitud"]', this).val() !== fechasolicitud) {
            datos['fechasolicitud'] = fechasolicitud;
        }

        if ($('input[name="type_person"]', this).val() === '1') {

            if (($('select[name="f_exp_a"]', this).val() === '' || $('select[name="f_exp_m"]', this).val() === '' || $('select[name="f_exp_d"]', this).val() === '')) {
                alert('La fecha de expedicion no puede estar vacia o incompleta.');
                return false;
            }
            const fechaexpedicion = `${$('select[name="f_exp_a"]', this).val()}-${$('select[name="f_exp_m"]', this).val()}-${$('select[name="f_exp_d"]', this).val()}`;
            if ($('input[name="fechaexpedicion"]', this).val() !== fechaexpedicion) {
                datos['fechaexpedicion'] = fechaexpedicion; 
            }

            if (($('select[name="f_nac_a"]', this).val() === '' || $('select[name="f_nac_m"]', this).val() === '' || $('select[name="f_nac_d"]', this).val() === '')) {
                alert('La fecha de nacimiento no puede estar vacia o incompleta.');
                return false;
            }
            const fechanacimiento = `${$('select[name="f_nac_a"]', this).val()}-${$('select[name="f_nac_m"]', this).val()}-${$('select[name="f_nac_d"]', this).val()}`;
            if ($('input[name="fechanacimiento"]', this).val() != fechanacimiento) {
                datos['fechanacimiento'] = fechanacimiento;
            }
        }
        if ($.isEmptyObject(datos)) {
            alert('No esta efectuando ningun cambio en la data del cliente.');
            return false;
        }
        datos['id_form'] = $('input[name="id_form"]', this).val();
        datos['type_person'] = $('input[name="type_person"]', this).val();
        datos['id_data'] = $('input[name="id_data"]', this).val();
        datos['action'] = $('input[name="action"]', this).val();
        datos['domain'] = $('input[name="domain"]', this).val();
        datos['meth'] = $('input[name="meth"]', this).val();
        datos['respOut'] = $('input[name="respOut"]', this).val();
        const form = this;
        $.ajax({
            beforeSend: function(){
                //$('table#table_list_result tbody tr td button#drea_button_add_'+posicion).button('loading');
            },
            data: datos,
            type: 'POST',
            url: 'includes/Controller.php',
            dataType: 'json',
            success: function(dato){
                if (dato.exito) {
                    alert(dato.exito);

                    /*$.each(datos, function(key, value){
                        if(key != 'domain' && key != 'action' && key != 'meth' && key != 'respOut' && key != 'id_form' && key != 'formulario' && key != 'type_person' && key != 'id_data')
                            $(form).find('[name="' + key + '"]').attr('data-oldvalue', value);
                        //alert( key + ": " + value );
                    });*/
                    location.reload(true);
                    return false;
                }
                
                alert(dato.error ? dato.error : 'Ocurrio un error, contacte con el administrador...');
                if (!dato.error) console.log(dato)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr, ajaxOptions, thrownError);
                alert("Error(saveEditNew): "+xhr.status+" Error: "+xhr.responseText);
            }
        });

    });
});
$.fn.convertTime12to24 = function(time12h){
    const tPart = time12h.split(' ');
    let hPart = tPart[0].split(':');

    if (hPart[0] === '12') hPart[0] = '00';

    if (tPart[1] === 'PM') hPart[0] = parseInt(hPart[0], 10) + 12;

    return `${hPart[0]}:${hPart[1]}:00`;
}
$.fn.verificarFecha = function(e, call, tipo){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    const f_a = $(`select#f_${call}_a`).val();
    const f_m = $(`select#f_${call}_m`).val();
    if ((f_a !== '' && f_a !== 'ND') && (f_m !== '' && f_m !== 'ND')) {
        
        const d = new Date(f_a, f_m, 0).getDate();
        let d_str = '';
        let str_d = '<option value="">Dia</option>';
        for (let i = 1; i <= d; i++) {
            d_str = '0' + i;
            if (i > 9) d_str = i;
            str_d += `<option value="${i}">${d_str}</option>`;
        }
        $(`select#f_${call}_d`).html(str_d);
    } else if (f_a === 'ND' || f_m === 'ND') {

        $(`select#f_${call}_m option[value="ND"]`).prop('selected', true);
        $(`select#f_${call}_d`).html('<option value="">Dia</option><option value="ND">ND</option>');
        $(`select#f_${call}_d option[value="ND"]`).prop('selected', true);
    }
}
$.fn.verificarFechaDoble = function(e, call, tipo){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if (tipo === '1') {
        const f_a = $(`select#f_${call}_a`).val();
        const f_m = $(`select#f_${call}_m`).val();
        const f_d = $(this).val();
        if (f_a !== '' && f_m !== '' && f_d !== '') {
            $(`select#f_${call}_a`).hide();
            $(`select#f_${call}_m`).hide();
            $(this).hide();
        }
    } else if (tipo === '2') {
        const f_1 = `${$(`select#f_${call}_a`).val()}-${$(`select#f_${call}_m`).val()}-${$(`select#f_${call}_d`).val()}`;
        const f_2 = `${$(`select#f_${call}2_a`).val()}-${$(`select#f_${call}2_m`).val()}-${$(`select#f_${call}2_d`).val()}`;
        if (f_1 !== f_2) {
            alert("Las fechas no coinciden, por favor validelas.");
            $(`select#f_${call}_a`).show();
            $(`select#f_${call}_a`).val('');
            $(`select#f_${call}_a`).change();
            $(`select#f_${call}_m`).show();
            $(`select#f_${call}_m`).val('');
            $(`select#f_${call}_m`).change();
            $(`select#f_${call}_d`).show();
            $(`select#f_${call}_d`).val('');
            $(`select#f_${call}_d`).change();

            $(`select#f_${call}2_a`).val('');
            $(`select#f_${call}2_a`).change();
            $(`select#f_${call}2_m`).val('');
            $(`select#f_${call}2_m`).change();
            $(`select#f_${call}2_d`).val('');
            $(`select#f_${call}2_d`).change();

            $(`select#f_${call}_a`).focus();
        }
    }
}
</script>