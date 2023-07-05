<?php
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'general.class.php';
$general = new General();
$tipo_documento = $general->getTipoDocumento();
$ciudades = $general->getCiudades();
$ocupaciones = $general->getOcupaciones();
$acteconomicas = $general->getActividades();
date_default_timezone_set('America/Bogota');
?>
<br>
<div id="formulari_ug045">
    <table style="width: 100%;">
        <tr>
            <td colspan="3">
                <?php
                while ($result = mysqli_fetch_array($tipo_documento)) {
                    if ($result['id'] == 1) {
                        ?>
                        <?php echo $result['description']; ?><input type="radio" name="grupodoc" id="grupodoc" value="<?php echo $result['id']; ?>" checked> 
                        <?php
                    } else {
                        ?>
                        <?php echo $result['description']; ?><input type="radio" name="grupodoc" id="grupodoc" value="<?php echo $result['id']; ?>"> 
                        <?php
                    }
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Número</td>
            <td  style="width: 50%;">
                <input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero" name="numero" maxlength="10" onblur="ocultarCampoDocAutos();"> 
            </td>
            <td>
                Cod. Verf.
                <input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 20%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero_" name="numero_" disabled="true" maxlength="1">
            </td>
        </tr>
    </table>
    <table id="tblnombres" style="width: 100%;">
        <tr> 
            <td>Primer Apellido</td> 
            <td>Segundo Apellido</td> 
            <td>Nombres</td> 
        </tr> 
        <tr > 
            <td> 
                <input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtpapellido" name="txtpapellido" onkeypress="return validar_letra(event)"> 
            </td> 
            <td> 
                <input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtsapellido" name="txtsapellido" onkeypress="return validar_letra(event)"> 
            </td> 
            <td> 
                <input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtnombres" name="txtnombres" onkeypress="return validar_letra(event)"> 
            </td> 
        </tr>
    </table>
    <table>
        <tr>
            <td>Ocupación/ Actividad Económica</td>

            <td colspan="2">
                <div id="dv_ocupaciones">
                    <select id="ocupacti" name="ocupacti" class="obligatorio"  style="width: 100%;" data-detalle="Detalle Ocupacion">
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($ocupaciones)) {
                            echo "<option value='{$result['id']}'>{$result['description']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id="dv_acteconomicas">
                    <select id="actecono" name="actecono" class="obligatorio"  style="width: 100%;" data-detalle="Detalle Actividad">
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($acteconomicas)) {
                            echo "<option value='{$result['id']}'>{$result['description']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </td>
        </tr>
        <tr id="tr_detalle_ocu_act">
        </tr>
        <tr>
            <td>Ciudad</td>
            <td colspan="2">
                <select id="ciudad" name="ciudad" style="width: 100%;">
                    <option value="">--Seleccione ciudad--</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciudades)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Dirección</td>
            <td colspan="2"><input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="direccion" name="direccion" onkeypress="return validar_letra(event)"></td>
        </tr>
        <tr>
            <td>Teléfono</td>
            <td colspan="2"><input type="text" class="obligatorio" onkeypress="return validar_num(event)" onpaste="return false;" id="telefono" name="telefono"  size="10" maxlength="10" style="margin-left: 1px; margin-right: 1px; width: 40%;"></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td colspan="2"><input type="text" class="obligatorio" onpaste="return false;" id="email" name="email" style="margin-left: 1px; margin-right: 1px; width: 40%;" onkeypress="return validar_letra(event)"></td>
        </tr>
        <tr>
            <td>Numero de poliza</td>
            <td colspan="2"><input type="text" class="obligatorio" onkeypress="return validar_num(event)" onpaste="return false;" id="npoliza" name="npoliza" style="margin-left: 1px; margin-right: 1px; width: 40%;" ></td>
        </tr>
        <tr>
            <td>Fecha de diligenciamiento</td>
            <td colspan="2">
                <select id="age" name="age">
                    <?php
                    $anio = date("Y");
                    for ($index = 0; $index < 20; $index++) {
                        ?>
                        <option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
                        <?php
                        $anio--;
                    }
                    ?>
                </select>
                <select  id="mes_" name="mes_" >
                    <option value="">--</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <select  id="dia" name="dia" >
                    <option value="">--</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table>
                    <tr>
                        <td>Re-escribir Número</td>
                        <td>
                            <input type="text" style="margin-left: 1px; margin-right: 1px; width: 100%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero2" name="numero2" maxlength="10" onblur="validarCampoDocAutos();"> 
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center"><input type="submit" value="Crear formulario" /></td>
        </tr>
    </table>
</div>
<script>
$(document).ready(function(){
    $('select#ocupacti, select#actecono').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '221' || $(this).val() == '810'){
            var str_detall = $(this).attr('data-detalle');
            var strHtml = '<td>'+str_detall+'</td><td>'+
            '<input type="text" id="detalle" name="detalle" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;">'+
            '</td>';
            $('tr#tr_detalle_ocu_act').html(strHtml);
        }else{
            $('tr#tr_detalle_ocu_act').html('');
        }
    });
});
</script>