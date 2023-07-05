<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'official.class.php';
$general = new General();
$sucursales = $general->getSucursales();
$actividades = $general->getActividades();
$clasecliente = $general->getClaseCliente();
$egresos_mensuales = $general->getEgresosMensuales();
$egresos_mensuales_emp = $general->getEgresosMensualesEmp();
$estados_civiles = $general->getEstadosCiviles();
$estudios = $general->getEstudios();
$ingresos_mensuales = $general->getIngresosMensuales();
$ingresos_mensuales_emp = $general->getIngresosMensualesEmp();
$ocupaciones = $general->getOcupaciones();
$otros_ingresos = $general->getOtrosIngresos();
$profesiones = $general->getProfesiones();
$sexo = $general->getSexo();
$tipo_documento = $general->getTipoDocumento();
$tipo_documento_conyuge = $general->getTipoDocumento();
$tipo_empresa = $general->getTipoEmpresa();
$tipo_empresa_emp = $general->getTipoEmpresa();
$tipo_persona = $general->getTipoPersona();
$tipo_transacciones = $general->getTipoTransacciones();
$tipo_vivienda = $general->getTipoVivienda();
$tipo_actividad = $general->getTiposActividad();
$ciiu = $general->getCiiu();
$ciiu_emp = $general->getCiiu();
$ciudades = $general->getCiudades();
$ciudades_empresa = $general->getCiudades();
$ciudades_oficina = $general->getCiudades();
$ciudades_sucursal = $general->getCiudades();
$ciudades_moneda = $general->getCiudades();
$paises = $general->getPais();
$actividad_econo = $general->getActividadEcono();
$lugar_expedicion = $general->getCiudades();
$lugar_nacimiento = $general->getCiudades();
$areas = $general->getAreas();
$formularios = $general->getFormularios();

$ciudad_beneficiario = $general->getCiudades();

$official = new Official();
$officials = $official->getOfficials();
extract($_POST);
?>
<table>
    <tr>
        <td>Fecha radicado:</td>
        <td>
            <select name="fecharadicado_a" id="fecharadicado_a" class="obligatorio" onchange="$(this).verificarFecha(event, 'fecharadicado');">
                <option value="">---</option>
<?php
$an = 2013;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
    echo '<option value="'.$i.'">'.$i.'</option>';
?>
            </select>
            <select name="fecharadicado_m" id="fecharadicado_m" class="obligatorio" onchange="$(this).verificarFecha(event, 'fecharadicado');">
                <option value="">---</option>
                <?php
                for ($i = 01; $i <= 12; $i++) {
                    if (strlen($i) == 1)
                        $num = "0" . $i;
                    else
                        $num = $i;
                    echo "<option value='$num'>$num</option>";
                }
                ?>             
            </select>
            <select name="fecharadicado_d" id="fecharadicado_d"  class="obligatorio" >
                <option value="">---</option>
                <?php
                for ($i = 01; $i <= 31; $i++) {
                    if (strlen($i) == 1)
                        $num = "0" . $i;
                    else
                        $num = $i;
                    echo "<option value='$num'>$num</option>";
                }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <td>Fecha de solicitud:</td>
        <td>
            <select name="fechasolicitud_a" id="fechasolicitud_a" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechasolicitud');">
                <option value="">---</option>
                <option vaue="2007">2007</option>
                <option vaue="2008">2008</option>
                <option vaue="2009">2009</option>
                <option vaue="2010">2010</option>
                <option vaue="2011">2011</option>
                <option vaue="2012">2012</option>
                <option vaue="2013">2013</option>
                <option vaue="2014">2014</option>
                <option vaue="2015">2015</option>
                <option vaue="2016">2016</option>
                <option vaue="2017">2017</option>
                <option vaue="2018">2018</option>
                <option vaue="2019">2019</option>
                <option vaue="2020">2020</option>
            </select>
            <select name="fechasolicitud_m" id="fechasolicitud_m" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechasolicitud');">
                <option value="">---</option>
                <?php
                for ($i = 01; $i <= 12; $i++) {
                    if (strlen($i) == 1) {
                        $num = "0" . $i;
                    } else {
                        $num = $i;
                    }
                    echo "<option value='$num'>$num</option>";
                }
                ?>             
            </select>
            <select name="fechasolicitud_d" id="fechasolicitud_d"  class="obligatorio" >
                <option value="">---</option>
                <?php
                for ($i = 01; $i <= 31; $i++) {
                    if (strlen($i) == 1)
                        $num = "0" . $i;
                    else
                        $num = $i;
                    echo "<option value='$num'>$num</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Sucursal:</td>
        <td>
            <select id="sucursal" name="sucursal" class="obligatorio" onblur="$.fn.verificarFechaSolicitud();">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($sucursales)) {
                    echo "<option value='{$result['id']}'>{$result['sucursal']}</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Area:</td>
        <td> <select id="area" name="area" class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($areas)) {
                    echo "<option value='{$result['id']}'>{$result['description']}</option>";
                }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <td>Funcionario:</td>
        <td> 
            <!--<input type="text" name="id_official" id="id_official" onkeypress="return validar_letra(event)"  class="obligatorio"/>-->
            <select id="id_official" name="id_official" class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($officials)) {
                    echo "<option value='".strtoupper($result['name'])."'>".strtoupper($result['name'])."</option>";
                }
                ?>
            </select>
        </td>
    </tr>


    <tr>
        <td>Formulario:</td>
        <td>

            <select id="formulario" name="formulario" class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($formularios)) {
                    echo "<option value='{$result['id']}'>{$result['description']}</option>";
                }
                ?>
            </select>


        </td>
    </tr>
    <tr>
        <td>Clase de cliente</td>
        <td>
            <select id="clasecliente" name="clasecliente" class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($clasecliente)) {
                    echo "<option value='{$result['id']}'>{$result['description']}</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <!-- INFORMACION BASICA -->
    <tr>
        <td colspan="2"><div class="title_form">1. INFORMACIÓN BASICA</div></td>
    </tr>
    <tr>
        <td>No. documento</td>
        <td><input type="text" name="documento" id="documento" onkeypress="return validar_num(event)" onpaste="return false;"  onBlur="ocultarCampoDoc();" class="obligatorio"/>  </td><!--onKeyPress="onlyNumbers();"-->
    </tr>
    <tr>
        <td>Tipo documento:</td>
        <td>
            <select id="tipodocumento" name="tipodocumento" class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($tipo_documento)) {
                    echo "<option value='{$result['id']}'>{$result['description']}</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Primer apellido</td>
        <td> <input type="text" name="primerapellido" id="primerapellido" onkeypress="return validar_letra(event)" class="obligatorio"/></td>
    </tr>
    <tr>
        <td>Segundo apellido</td>
        <td><input type="text" name="segundoapellido" id="segundoapellido" onkeypress="return validar_letra(event)" /></td>
    </tr>

    <tr>
        <td>Re-escribir Fecha de solicitud:</td>
        <td>
            <select name="fechasolicitud2_a" id="fechasolicitud2_a" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechasolicitud2');">
                <option value="">---</option>
                <option vaue="2007">2007</option>
                <option vaue="2008">2008</option>
                <option vaue="2009">2009</option>
                <option vaue="2010">2010</option>
                <option vaue="2011">2011</option>
                <option vaue="2012">2012</option>
                <option vaue="2013">2013</option>
                <option vaue="2014">2014</option>
                <option vaue="2015">2015</option>
                <option vaue="2016">2016</option>
                <option vaue="2017">2017</option>
                <option vaue="2018">2018</option>
                <option vaue="2019">2019</option>
                <option vaue="2020">2020</option>
            </select>
            <select name="fechasolicitud2_m" id="fechasolicitud2_m" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechasolicitud2');">
                <option value="">---</option>
                <?php
                for ($i = 01; $i <= 12; $i++) {
                    if (strlen($i) == 1) {
                        $num = "0" . $i;
                    } else {
                        $num = $i;
                    }
                    echo "<option value='$num'>$num</option>";
                }
                ?>             
            </select>
            <select name="fechasolicitud2_d" id="fechasolicitud2_d"  class="obligatorio" >
                <option value="">---</option>
                <?php
                for ($i = 01; $i <= 31; $i++) {
                    if (strlen($i) == 1)
                        $num = "0" . $i;
                    else
                        $num = $i;
                    echo "<option value='$num'>$num</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Nombres</td>
        <td> <input type="text" name="nombres" id="nombres" onkeypress="return validar_letra(event)" size="60" class="obligatorio" onblur="$.fn.verificarReFechaSolicitud();"/></td>
    </tr>
    <tr>
        <td>Fecha expedición</td>
        <td> 
            <select name="fechaexpedicion_a" id="fechaexpedicion_a" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechaexpedicion');">
                <option value="">---</option>
                <?php
                for ($i = 1915; $i <= 2020; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>   
            </select>
            <select name="fechaexpedicion_m" id="fechaexpedicion_m" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechaexpedicion');">
                <option value="">---</option>
                <?php
                for ($i = 01; $i <= 12; $i++) {
                    if (strlen($i) == 1)
                        $num = "0" . $i;
                    else
                        $num = $i;
                    echo "<option value='$num'>$num</option>";
                }
                ?>             
            </select>
            <select name="fechaexpedicion_d" id="fechaexpedicion_d" class="obligatorio">
                <option value="">---</option>
                <?php
                for ($i = 01; $i <= 31; $i++) {
                    if (strlen($i) == 1)
                        $num = "0" . $i;
                    else
                        $num = $i;
                    echo "<option value='$num'>$num</option>";
                }
                ?>
            </select>
        </td>
    </tr>    
    <tr>
        <td>Lugar expedición:</td>
        <td>
            <select id="lugarexpedicion" name="lugarexpedicion"  class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($lugar_expedicion)) {
                    echo "<option value='{$result['id']}'>{$result['description']}</option>";
                }
                ?>
            </select>
        </td>
    </tr>    
    <tr>
        <td>Re-escribir documento</td>
        <td><input type="text" name="documento2" id="documento2" onkeypress="return validar_num(event)" onpaste="alert('No se puede copiar.');return false" onBlur="validarCampoDoc();" onpaste="return false;" class="obligatorio"/>  </td>
    </tr>
    <tr>
        <td>Re-escribir Tipo persona:</td>
        <td><select id="tipopersona2" name="tipopersona2" onblur="$(this).revisarTipoPersona(event);">
                <option value="">-- Seleccione una opción --</option>
                <?php
                while ($result = mysqli_fetch_array($tipo_persona)) {
                    echo "<option value='{$result['id']}'>{$result['description']}</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    <?php
    if ($type_person == "1") {//NATURAL
        ?>
        <tr>
            <td>Fecha nacimiento:</td>
            <td>
                <select name="fechanacimiento_a" id="fechanacimiento_a"  class="obligatorio" onblur="$.fn.verificarFecNacOcultar(event);" onchange="$(this).verificarFecha(event, 'fechanacimiento');">
                    <option value="">---</option>
                    <?php
                    for ($i = 1915; $i <= 2020; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>   
                </select>
                <select name="fechanacimiento_m" id="fechanacimiento_m"  class="obligatorio" onblur="$.fn.verificarFecNacOcultar(event);" onchange="$(this).verificarFecha(event, 'fechanacimiento');">
                    <option value="">---</option>
                    <?php
                    for ($i = 01; $i <= 12; $i++) {
                        if (strlen($i) == 1)
                            $num = "0" . $i;
                        else
                            $num = $i;
                        echo "<option value='$num'>$num</option>";
                    }
                    ?>             
                </select>
                <select name="fechanacimiento_d" id="fechanacimiento_d"  class="obligatorio" onblur="$.fn.verificarFecNacOcultar(event);">
                    <option value="">---</option>
                    <?php
                    for ($i = 01; $i <= 31; $i++) {
                        if (strlen($i) == 1)
                            $num = "0" . $i;
                        else
                            $num = $i;
                        echo "<option value='$num'>$num</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>Lugar de nacimiento</td>
            <td>
                <select id="lugarnacimiento" name="lugarnacimiento"  class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($lugar_nacimiento)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Sexo</td>
            <td>
                <select id="sexo" name="sexo" class="obligatorio" onblur="ocultarCampoGenero();">
                    <option value="">-Opciones-</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nacionalidad</td>
            <td colspan="3">
                <select id="nacionalidad" name="nacionalidad"  class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($paises)) {
                        echo "<option value='{$result['id']}'>" . utf8_encode($result['description']) . "</option>";
                    }
                    ?>
                </select>        
            </td> 
        </tr>
        <tr>
            <td>No. hijos</td>
            <td>
                <select name="numerohijos" id="numerohijos"  class="obligatorio">
                    <option value="">-Opciones-</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="SD">SD</option>        
                </select>
            </td>
        </tr>

        <tr>
            <td>Est. civil</td>
            <td>
                <select id="estadocivil" name="estadocivil"  class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($estados_civiles)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>  
            </td>
        </tr>
        <tr>
            <td>Re-escribir Fecha nacimiento:</td>
            <td>
                <select name="fechanacimiento2_a" id="fechanacimiento2_a"  class="obligatorio" onblur="$(this).checkFechaNacimiento(event);" onchange="$(this).verificarFecha(event, 'fechanacimiento2');">
                    <option value="">---</option>
                    <?php
                    for ($i = 1915; $i <= 2016; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>   
                </select>
                <select name="fechanacimiento2_m" id="fechanacimiento2_m"  class="obligatorio" onblur="$(this).checkFechaNacimiento(event);" onchange="$(this).verificarFecha(event, 'fechanacimiento2');">
                    <option value="">---</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        if (strlen($i) == 1)
                            $num = "0".$i;
                        else
                            $num = $i;
                        echo "<option value='$num'>$num</option>";
                    }
                    ?>             
                </select>
                <select name="fechanacimiento2_d" id="fechanacimiento2_d"  class="obligatorio" onblur="$(this).checkFechaNacimiento(event);">
                    <option value="">---</option>
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        if (strlen($i) == 1)
                            $num = "0".$i;
                        else
                            $num = $i;
                        echo "<option value='$num'>$num</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <!-- INFORMACION DOMICILIO Y OFICINA -->
        <tr>
            <td >INFORMACIÓN DOMICILIO Y OFICINA</td>
        </tr>
        <tr>
            <td>Dirección residencia</td>
            <td><input type="text" name="direccionresidencia" id="direccionresidencia" onkeypress="return validar_letra(event)" class="obligatorio" /></td>        
        </tr>
        <tr>
            <td>Ciudad residencia</td>
            <td >
                <select id="ciudadresidencia" name="ciudadresidencia"  class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciudades)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Teléfono residencia</td>
            <td> <input type="text" name="telefonoresidencia" id="telefonoresidencia" onkeypress="return validar_num(event)" maxlength="7" onpaste="return false;" onblur="$(this).checkTamanoTele(7);" class="obligatorio"/></td><!--onBlur="ocultarCampoTelf();"-->
        </tr>
        <tr>
            <td>Nombre empresa</td>
            <td><input type="text" name="nombreempresa" id="nombreempresa" onkeypress="return validar_letra(event)"   class="obligatorio"/></td>
        </tr>
        <tr>
            <td>Ciudad empresa</td>
            <td>            
                <select id="ciudadempresa" name="ciudadempresa"  class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciudades_empresa)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Dirección empresa</td>
            <td> <input type="text" name="direccionempresa" id="direccionempresa" onkeypress="return validar_letra(event)" /></td>
        </tr>
        <tr>
            <td>Nomenclatura</td>
            <td>
                <select name="nomenclatura" id="nomenclatura">
                    <option value="Nomenclatura nueva">Nomenclatura nueva</option>
                    <option value="Nomenclatura antigua">Nomenclatura antigua</option>
                    <option value="SD">SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Teléfono laboral</td>
            <td><input type="text" name="telefonolaboral" id="telefonolaboral" onkeypress="return validar_num(event)" maxlength="7" class="obligatorio" onblur="$(this).checkTamanoTele(7);"></td>
        </tr>
        <tr>
            <td>Celular</td>
            <td><input type="text" name="celular" id="celular" onkeypress="return validar_num(event)" maxlength="10" onblur="$(this).checkTamanoTele(10);"></td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td> <input type="text" name="correoelectronico" id="correoelectronico" onkeypress="return validar_letra(event)" /></td>
        </tr>    
        <tr>
            <td>Repetir telefono residencia:</td>
            <td><input type="text" name="telefonoresidencia2" onkeypress="return validar_num(event)" maxlength="7" onBlur="validarCampoTelf();" onpaste="return false;" class="obligatorio" id="telefonoresidencia2" /></td>
        </tr>
        <tr>
            <td>Cargo</td>
            <td> <input type="text" name="cargo" id="cargo" onkeypress="return validar_letra(event)"/></td>
        </tr>
        <tr>
            <td>Re-escribir Sexo</td>
            <td>
                <select id="sexo2" name="sexo2" onblur="validarCampoGenero();">
                    <option value="">-Opciones-</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Actv. economica</td>
            <td>
                <select id="actividadeconomicaempresa" name="actividadeconomicaempresa"  class="obligatorio">
                    <option value=""> -- Seleccione una opción -- </option>
                    <?php
                    while ($result = mysqli_fetch_array($actividad_econo)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Repetir celular</td>
            <td><input type="text" name="celular2" id="celular2" onkeypress="return validar_num(event)" maxlength="10" onblur="validarCampoCel();" onpaste="return false;" class="obligatorio"></td>
        </tr>
    <?php } ?>
    <!-- ACTIVIDAD ECONOMICA -->
    <tr>
        <td colspan="4"><div class="title_form">2. ACTIVIDAD ECONOMICA</div></td>
    </tr>

    <?php
    if ($type_person == "1") {//NATURAL
        ?>
        <tr>
            <td>PERSONA NATURAL</td>
        </tr>
        <tr>
            <td>Profesión</td>
            <td>
                <select id="profesion" name="profesion"  class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($profesiones)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Ocupación</td>
            <td>
                <select id="ocupacion" name="ocupacion" class="obligatorio" onchange="$(this).changeOcupacion();">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ocupaciones)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr id="trdetalleocupacion" style="display:none;">
            <td>Que tipo de ventas?</td>
            <td>
                <input type="text" name="detalleocupacion" id="detalleocupacion" onkeypress="return validar_letra(event)">
            </td>
        </tr>

        <tr>
            <td>CIIU</td>
            <td>
                <select id="ciiu" name="ciiu">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciiu)) {
                        echo "<option value='{$result['codigo']}'>{$result['descripcion']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Ingresos mensuales</td>
            <td>
                <select id="ingresosmensuales" name="ingresosmensuales" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ingresos_mensuales)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Otros ingresos</td>
            <td>
                <select id="otrosingresos" name="otrosingresos">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($otros_ingresos)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Egresos mensuales</td>
            <td>
                <select id="egresosmensuales" name="egresosmensuales" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($egresos_mensuales)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Conpto. otros ingresos</td>
            <td><input type="text" name="conceptosotrosingresos" id="conceptosotrosingresos" onkeypress="return validar_letra(event)" /></td>
        </tr>
        <tr>
            <td>Tipo de actividad</td>
            <td>
                <select id="tipoactividad" name="tipoactividad" class="obligatorio" onchange="$(this).changeTipoAtividad();">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($tipo_actividad)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr id="trdetalletipoactividad" style="display:none;">
            <td>Otra, Cual?</td>
            <td>
                <input type="text" name="detalletipoactividad" id="detalletipoactividad" onkeypress="return validar_letra(event)">
            </td>
        </tr>
        <tr>
            <td>Nivel estudios</td>
            <td>
                <select id="nivelestudios" name="nivelestudios">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($estudios)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>  
            </td>
        </tr>
        <tr>
            <td>Tipo vivienda</td>
            <td>
                <select id="tipovivienda" name="tipovivienda">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($tipo_vivienda)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Estrato</td>
            <td>
                <select id="estrato" name="estrato">
                    <option value="">-Opciones-</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="SD">SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Total activos</td>
            <td><input type="text" name="totalactivos" id="totalactivos" onkeypress="return validar_num(event)" class="obligatorio"/></td>
        </tr>
        <tr>
            <td>Total pasivos</td>
            <td><input type="text" name="totalpasivos" id="totalpasivos" onkeypress="return validar_num(event)" class="obligatorio"/></td>    
        </tr>
        <tr>
            <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
            <td>
                <select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado expuesta_publica-->
                    <option value="">Seleccion...</option>
                    <option value="-1">SI</option>
                    <option value="0">NO</option>
                    <option value="2">SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td style="width: 100px;display: table-cell;">Vinculo persona expuesta publicamente?</td>
            <td>
                <select id="servidor_publico" name="servidor_publico" style="font-size: 12px; margin-right: 15px"><!--agregar campo llamado servidor_publico-->
                    <option value="">Seleccion...</option>
                    <option value="-1">SI</option>
                    <option value="0">NO</option>
                    <option value="2">SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td style="width: 100px;display: table-cell;">Administra recursos publicos?</td>
            <td>
                <select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px"><!--agregar campo llamado recursos_publicos-->
                    <option value="">Seleccion...</option>
                    <option value="-1">SI</option>
                    <option value="0">NO</option>
                    <option value="2">SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td style="width: 100px;display: table-cell;">Obligaciones tributarias en otro pais?</td>
            <td>
                <select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado tributarias_otro_pais-->
                    <option value="">Seleccion...</option>
                    <option value="-1">SI</option>
                    <option value="0">NO</option>
                    <option value="2">SD</option>
                </select>
                Cuales?: 
                <input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado tributarias_paises-->
            </td>
        </tr>
        <?php
    } else {
        ?>
        <!-- PERSONA JURIDICA -->
        <tr>
            <td colspan="2">PERSONA JURIDICA</td>
        </tr>
        <tr>
            <td>Razon social</td>
            <td><input type="text" name="razonsocial" id="razonsocial" Class="obligatorio" onkeypress="return validar_letra(event)"/></td>
        </tr>
        <tr>
            <td>NIT</td>
            <td><input type="text" name="nit" id="nit" onkeypress="return validar_num(event)" class="obligatorio"/>
                Cod. Verf.
                <input type="text" name="digitochequeo" id="digitochequeo" onkeypress="return validar_num(event)" maxlength="1" size="4" class="obligatorio">
        </tr>   
        <tr>
            <td>Re-escribir NIT</td>
            <td><input type="text" name="nit2" id="nit2" onkeypress="return validar_num(event)" onpaste="alert('No no no...');return false" class="obligatorio" />
                Cod. Verf.
                <input type="text" name="digitochequeo2" id="digitochequeo2" onkeypress="return validar_num(event)" onpaste="alert('No no no...');return false" size="4" class="obligatorio" maxlength="1">
        </tr>
        <tr>
            <td>CIIU</td>
            <td>
                <select id="ciiu" name="ciiu" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciiu)) {
                        echo "<option value='{$result['codigo']}'>{$result['codigo']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Ciudad oficina ppal.</td>
            <td>
                <select id="ciudadoficina" name="ciudadoficina" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciudades_oficina)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Dirección oficina ppal.</td>
            <td><input type="text" name="direccionoficinappal" id="direccionoficinappal" class="obligatorio" onkeypress="return validar_letra(event)" /></td>
        </tr>
        <tr>
            <td>Nomenclatura</td>
            <td>
                <select name="nomenclatura_emp" id="nomenclatura_emp">
                    <option value="Nomenclatura nueva">Nomenclatura nueva</option>
                    <option value="Nomenclatura antigua">Nomenclatura antigua</option>
                    <option value="SD">SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Teléfono oficina</td>
            <td><input type="text" name="telefonoficina" id="telefonoficina" onblur="$(this).checkTamanoTele(7);" onkeypress="return validar_num(event)" maxlength="7" class="obligatorio"/></td>
        </tr>
        <tr>
            <td>Fax oficina</td>
            <td> <input type="text" name="faxoficina" id="faxoficina" onblur="$(this).checkTamanoTele(7);" onkeypress="return validar_num(event)" maxlength="7"></td>
        </tr>
        <tr>
            <td>Celular oficina</td>
            <td><input type="text" name="celularoficina" id="celularoficina" onblur="$(this).checkTamanoTele(10);" onkeypress="return validar_num(event)" maxlength="10" class="obligatorio"/></td>
        </tr>
        <tr>
            <td>Ciudad sucursal</td>
            <td colspan="3">  

                <select id="ciudadsucursal" name="ciudadsucursal">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciudades_sucursal)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Dirección sucursal</td>
            <td ><input type="text" name="direccionsucursal" id="direccionsucursal" onkeypress="return validar_letra(event)" /></td>
        </tr>
        <tr>
            <td>Nomenclatura</td>
            <td>
                <select name="nomenclatura_emp2" id="nomenclatura_emp2">
                    <option value="Nomenclatura nueva">Nomenclatura nueva</option>
                    <option value="Nomenclatura antigua">Nomenclatura antigua</option>
                    <option value="SD">SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Teléfono sucursal</td>
            <td> <input type="text" name="telefonosucursal" id="telefonosucursal" onblur="$(this).checkTamanoTele(7);" onkeypress="return validar_num(event)" maxlength="7"></td>
        </tr>
        <tr>
            <td>Fax sucursal</td>
            <td><input type="text" name="faxsucursal" id="faxsucursal" onblur="$(this).checkTamanoTele(7);" onkeypress="return validar_num(event)" maxlength="7"></td>
        </tr>
        <tr>
            <td>Actividad economica ppal.</td>
            <td>
                <select id="actividadeconomicappal" name="actividadeconomicappal" onChange="javascript:cambiarEstadoActividad()" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($actividades)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
                <div id="otrosactividad" style="display: none">Otro:<input type="text" disabled="disabled" name="detalleactividadeconomicappal"  onkeypress="return validar_letra(event)" id="detalleactividadeconomicappal"/> </div>
            </td>
        </tr>
        <tr>
            <td>Tipo empresa</td>
            <td>
                <select id="tipoempresaemp" name="tipoempresaemp" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($tipo_empresa_emp)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Re-escribir Teléfono oficina</td>
            <td><input type="text" name="telefonoficina2" id="telefonoficina2" onkeypress="return validar_num(event)" maxlength="7" onBlur="validarCampoTelfOfi();"></td>
        </tr>
        <tr>
            <td>Re-escribir Celular oficina</td>
            <td><input type="text" name="celularoficina2" id="celularoficina2" onkeypress="return validar_num(event)" maxlength="10" onBlur="validarCampoCelOfi();"></td>
        </tr>
        <tr>
            <td>Activos empresa</td>
            <td><input type="text" id="activosemp" name="activosemp" onkeypress="return validar_num(event)" class="obligatorio"/></td>
        </tr>
        <tr>
            <td>Pasivos empresa</td>
            <td><input type="text"  id="pasivosemp" name="pasivosemp" onkeypress="return validar_num(event)" class="obligatorio"/></td>
        </tr>
        <tr>
            <td>Ingresos mensuales empresa</td>
            <td><select id="ingresosmensualesemp" name="ingresosmensualesemp" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ingresos_mensuales_emp)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td>Egresos mensuales empresa</td>
            <td>
                <select id="egresosmensualesemp" name="egresosmensualesemp" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($egresos_mensuales_emp)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="width: 100px;display: table-cell;">Administrador expuesto publicamente?</td>
            <td>
                <select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado expuesta_publica-->
                    <option value="">Seleccion...</option>
                    <option value="-1">SI</option>
                    <option value="0">NO</option>
                    <option value="2">SD</option>
                </select>
            </td>
        </tr>
        <!-- <tr>
            <td style="width: 100px;display: table-cell;">Vinculo persona expuesta publicamente?</td>
            <td>
                <select id="servidor_publico" name="servidor_publico" style="font-size: 12px; margin-right: 15px">agregar campo llamado servidor_publico
                    <option value="">Seleccion...</option>
                    <option value="-1">SI</option>
                    <option value="0">NO</option>
                    <option value="2">SD</option>
                </select>
            </td>
        </tr> -->
        <tr>
            <td style="width: 100px;display: table-cell;">Administra recursos publicos?</td>
            <td>
                <select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px"><!--agregar campo llamado recursos_publicos-->
                    <option value="">Seleccion...</option>
                    <option value="-1">SI</option>
                    <option value="0">NO</option>
                    <option value="2">SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td style="width: 100px;display: table-cell;">Obligaciones tributarias en otro pais?</td>
            <td>
                <select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado tributarias_otro_pais-->
                    <option value="">Seleccion...</option>
                    <option value="-1">SI</option>
                    <option value="0">NO</option>
                    <option value="2">SD</option>
                </select>
                Cuales?: 
                <input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado tributarias_paises-->
            </td>
        </tr>
        <tr>
            <td colspan="2">SOCIOS</td>
        </tr>
        <tr>
            <td>Socio No. 1:</td>
            <td><input type="text" name="socio1" id="socio1" onkeypress="return validar_num(event)"></td>
        </tr>
        <tr>
            <td>Socio No. 2:</td>
            <td><input type="text" name="socio2" id="socio2" onkeypress="return validar_num(event)"></td>
        </tr>
        <tr>
            <td>Socio No. 3:</td>
            <td><input type="text" name="socio3" id="socio3" onkeypress="return validar_num(event)"></td>
        </tr>
        <?php
    }
    ?>            
    <!-- ACTIVIDADES EN OPERACIONES INTERNACIONALES -->
    <tr>
        <td colspan="4"><div class="title_form">3. ACTIVIDADES EN OPERACIONES INTERNACIONALES</div></td>
    </tr>
</tr>
<tr>
    <td>Moneda extranjera</td>
    <td>
        <select id="monedaextranjera" name="monedaextranjera" class="obligatorio">
            <option value="">-Opciones-</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
        </select>
    </td>
</tr>
<tr>
    <td>Tipo transacciones</td>
    <td>
        <select id="tipotransacciones" name="tipotransacciones">
            <option value="">-Opciones-</option>
            <?php
            while ($result = mysqli_fetch_array($tipo_transacciones)) {
                echo "<option value='{$result['id']}'>{$result['description']}</option>";
            }
            ?>
            <option value="SD">SD</option>
        </select>
    </td>            
</tr>

<tr>
    <td colspan="4"><div class="title_form">FORMULARIO CARA B</div></td>
</tr>
<tr>
    <td>
        Firma del cliente: </td>
    <td><select name="firma" id="firma" class="obligatorio" >
            <option value="">-Opciones-</option>
            <option value="Si">Si</option>
        </select></td>
</tr>

<tr>
    <td>
        Huella del cliente: </td>
    <td><select name="huella" id="huella" class="obligatorio">
            <option value="">-Opciones-</option>
            <option value="Si">Si</option>
        </select></td>
</tr>

<!-- INFORMACION ENTREVISTA -->
<tr>
    <td>        
        Lugar de entrevista:</td>
    <td><input type="text" name="lugarentrevista" id="lugarentrevista"  class="obligatorio" onkeypress="return validar_letra(event)"/>        </td>
</tr>

<tr>
    <td>
        Fecha entrevista:</td>
    <td>
        <select name="fechaentrevista_a" id="fechaentrevista_a" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechaentrevista');">
            <option value="">---</option>
            <option vaue="2007">2007</option>
            <option vaue="2008">2008</option>
            <option vaue="2009">2009</option>
            <option vaue="2010">2010</option>
            <option vaue="2011">2011</option>
            <option vaue="2012">2012</option>
            <option vaue="2013">2013</option>
            <option vaue="2014">2014</option>
            <option vaue="2015">2015</option>
            <option vaue="2011">2016</option>
            <option vaue="2012">2017</option>
            <option vaue="2013">2018</option>
            <option vaue="2014">2019</option>
            <option vaue="2015">2020</option>
        </select>
        <select name="fechaentrevista_m" id="fechaentrevista_m" class="obligatorio" onchange="$(this).verificarFecha(event, 'fechaentrevista');">
            <option value="">---</option>
            <?php
            for ($i = 01; $i <= 12; $i++) {
                if (strlen($i) == 1)
                    $num = "0" . $i;
                else
                    $num = $i;
                echo "<option value='$num'>$num</option>";
            }
            ?>             
        </select>
        <select name="fechaentrevista_d" id="fechaentrevista_d" class="obligatorio">
            <option value="">---</option>
            <?php
            for ($i = 01; $i <= 31; $i++) {
                if (strlen($i) == 1)
                    $num = "0" . $i;
                else
                    $num = $i;
                echo "<option value='$num'>$num</option>";
            }
            ?>
        </select>
    </td>
</tr>

<tr>
    <td>
        Hora entrevista:</td>
    <td>
        <select id="horaentrevista" name="horaentrevista" size="8px" class="obligatorio">
            <option value="">---</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
        <select id="tipohoraentrevista" name="tipohoraentrevista" class="obligatorio">
            <option value="">---</option>
            <option value="am">am</option>
            <option value="pm">pm</option>       
        </select>     
    </td>
</tr>

<tr>
    <td>
        Resultado entrevista: </td>
    <td><select name="resultadoentrevista" id="resultadoentrevista" class="obligatorio">
            <option value="">-Opciones-</option>
            <option value="Aceptado" selected>Aceptado</option>
            <option value="Rechazado">Rechazado</option>
        </select>     </td>
</tr>

<tr>
    <td>
        Observaciones:</td>
    <td><textarea name="observacionesentrevista" id="observacionesentrevista" onkeypress="return validar_letra(event)"></textarea></td>
</tr>

<tr>
    <td>
        Nombre intermediario y/o asesor responsable:</td>
    <td><input type="text" name="nombreintermediario" id="nombreintermediario" class="obligatorio" onkeypress="return validar_letra(event)"/></td>
</tr>
<tr>
    <td colspan="4" align="center"><input type="submit" value="Crear formulario" /></td>
</tr>
</table>
<script type="text/javascript">
$(document).ready(function(){
    $('select[name="tributarias_otro_pais"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="tributarias_paises"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="tributarias_paises"]').val('');
            $('input[name="tributarias_paises"]').attr('disabled', 'disabled');
        }
    });
});
$.fn.verificarFecha = function(e, call){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    var f_a = $('select#'+call+'_a').val();
    var f_m = $('select#'+call+'_m').val();
    if(f_a != '' && f_m != ''){
        var d = new Date(f_a, f_m, 0).getDate();
        var d_str = '';
        str_d = '<option value="">---</option>';
        for(var i = 1; i <= d; i++){
            d_str = '0'+i;
            if(i > 9)
                d_str = i;
            str_d += '<option value="'+d_str+'">'+d_str+'</option>';
        }
        $('select#'+call+'_d').html(str_d);
    }
}
</script>