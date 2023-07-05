<?php
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
//$sexo = $general->getSexo();
$tipo_documento = $general->getTipoDocumento();
//$tipo_documento_conyuge = $general->getTipoDocumento();
//$tipo_empresa = $general->getTipoEmpresa();
$tipo_empresa_emp = $general->getTipoEmpresa();
//$tipo_persona = $general->getTipoPersona();
$tipo_transacciones = $general->getTipoTransacciones();
$tipo_vivienda = $general->getTipoVivienda();
$tipo_actividad = $general->getTiposActividad();
$ciiu = $general->getCiiu();
$ciius = Formulario::getCiiuId();
//$ciiu_emp = $general->getCiiu();
$ciudades = $general->getCiudades();
$ciudades_empresa = $general->getCiudades();
$ciudades_oficina = $general->getCiudades();
$ciudades_sucursal = $general->getCiudades();
//$ciudades_moneda = $general->getCiudades();
$paises = $general->getPais();
$actividad_econo = $general->getActividadEcono();
$lugar_expedicion = $general->getCiudades();
$lugar_nacimiento = $general->getCiudades();
$areas = $general->getAreas();
$formularios = $general->getFormularios();
//$ciudad_beneficiario = $general->getCiudades();
$official = new Official();
$officials = $official->getOfficials();
?>
<!-- FORMULARIO NO 15 -->
<form method="POST" id="saveEdit" name="saveEdit">
    <input type="hidden" name="id_form" id="id_form" value="<?=$_GET['id_form']?>">
    <!-- <input type="hidden" name="formulario" id="formulario" value="<?//=$dataform['formulario']?>"> -->
    <input type="hidden" name="type_person" id="type_person" value="<?=$type_person?>">
    <input type="hidden" name="id_data" id="id_data" value="<?=$dataform['id']?>">
    <input type="hidden" name="action" id="action" value="saveEditNew">
    <input type="hidden" name="domain" id="domain" value="form">
    <input type="hidden" name="meth" id="meth" value="js">
    <input type="hidden" name="respOut" id="respOut" value="json">
<table>
    <tr>
        <td style="width: 80px">Fecha de radicado:</td><!--fecharadicado-->
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
    </tr>
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
    <tr>
        <td>Sucursal:</td>
        <td>
            <select id="sucursal" name="sucursal" class="obligatorio" data-oldvalue="<?=$dataform['sucursal']?>">
                <option value="">-Opciones-</option>
<?php
    while($result = mysqli_fetch_array($sucursales)){
        $complemento = "";
        if($result['id'] == $dataform['sucursal']){
            $complemento = ' selected="selected" ';
        }
?>
                <option value="<?=$result['id']?>"<?=$complemento?>><?=$result['sucursal']?></option>
<?php
        $complemento = "";
    }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Area:</td>
        <td>
            <select id="area" name="area" class="obligatorio" data-oldvalue="<?=$dataform['area']?>">
                <option value="">-Opciones-</option>
<?php
    while($result = mysqli_fetch_array($areas)){
        if( $result['id'] == $dataform['area'])
            $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
        $complemento = "";
    }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Funcionario:</td>
        <td>
            <input type="text" name="id_official" id="id_official" onKeypress="onlyChars();" class="obligatorio" value="<?=$dataform['id_official']?>" data-oldvalue="<?=$dataform['id_official']?>">
        </td>
    </tr>
    <tr>
        <td>Formulario:</td>
        <td>
            <select id="formulario" name="formulario" class="obligatorio" data-oldvalue="<?=$dataform['formulario']?>">
                <option value="">-Opciones-</option>
<?php
    while($result = mysqli_fetch_array($formularios)){
        if($result['id'] == $dataform['formulario'])
            $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>"<?=$complemento?>><?=$result['description']?></option>
<?php
        $complemento = '';
    }
?>
            </select>

        </td>
    </tr>
    <tr>
        <td>Clase de cliente</td>
        <td>
            <select id="clasecliente" name="clasecliente" class="obligatorio" data-oldvalue="<?=$dataform['clasecliente']?>">
                <option value="">-Opciones-</option>
<?php
    while($result = mysqli_fetch_array($clasecliente)){
        if( $result['id'] == $dataform['clasecliente'])
            $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
        $complemento = '';
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
        <td>
            <input type="text" name="documento" id="documento" onKeyPress="onlyNumbers();" class="obligatorio" value="<?=$dataform['documento']?>" data-oldvalue="<?=$dataform['documento']?>" readonly>
        </td>
    </tr>
    <tr>
        <td>Tipo documento:</td>
        <td>
            <select id="tipodocumento" name="tipodocumento" class="obligatorio" data-oldvalue="<?=$dataform['tipodocumento']?>">
                <option value="">-Opciones-</option>
<?php
    while($result = mysqli_fetch_array($tipo_documento)){
        if( $result['id'] == $dataform['tipodocumento'])
            $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
        $complemento = '';
    }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Primer apellido</td>
        <td> <input type="text" name="primerapellido" id="primerapellido" onKeypress="onlyChars();" class="obligatorio" value="<?=$dataform['primerapellido']?>" data-oldvalue="<?=$dataform['primerapellido']?>"></td>
    </tr>
    <tr>
        <td>Segundo apellido</td>
        <td><input type="text" name="segundoapellido" id="segundoapellido" onKeypress="onlyChars();" value="<?=$dataform['segundoapellido']?>" data-oldvalue="<?=$dataform['segundoapellido']?>"></td>
    </tr>
    <tr>
        <td>Nombres</td>
        <td> <input type="text" name="nombres" id="nombres" onKeypress="onlyChars();" size="60" class="obligatorio" value="<?=$dataform['nombres']?>" data-oldvalue="<?=$dataform['nombres']?>"></td>
    </tr>
    <tr>
        <td style="width: 100px;display: table-cell;">Fecha expedicion:</td><!--fechaexpedicion-->
        <td>
            <input type="hidden" id="fechaexpedicion" name="fechaexpedicion" value="<?=$dataform['fechaexpedicion']?>">
            <select id="f_exp_a" name="f_exp_a" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px">
                <option value="">Año</option>
<?php
    $f_r = explode('-', $dataform['fechaexpedicion']);
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
            <select id="f_exp_m" name="f_exp_m" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px">
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
            <select id="f_exp_d" name="f_exp_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px">
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
        <td>Lugar expedición:</td>
        <td>
            <select id="lugarexpedicion" name="lugarexpedicion"  class="obligatorio" data-oldvalue="<?=$dataform['lugarexpedicion']?>">
                <option value="">-Opciones-</option>
<?php
    while($result = mysqli_fetch_array($lugar_expedicion)){
        if($result['id'] == $dataform['lugarexpedicion'])
            $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
        $complemento = '';
    }
?>
            </select>
        </td>
    </tr>
<?php 
    if($type_person == "1"){
?>
    <tr>
        <td style="width: 100px;display: table-cell;">Fecha nacimiento:</td><!--fechanacimiento-->
        <td>
            <input type="hidden" id="fechanacimiento" name="fechanacimiento" value="<?=$dataform['fechanacimiento']?>">
            <select id="f_nac_a" name="f_nac_a" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px">
                <option value="">Año</option>
<?php
        $f_r = explode('-', $dataform['fechanacimiento']);
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
            <select id="f_nac_m" name="f_nac_m" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px">
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
            <select id="f_nac_d" name="f_nac_d" style="font-size: 12px"><!-- onblur="$(this).verificarFechaDoble(event, 'nac', '1');"-->
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
        <td>Lugar de nacimiento</td>
        <td>
            <select id="lugarnacimiento" name="lugarnacimiento" class="obligatorio" data-oldvalue="<?=$dataform['lugarnacimiento']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($lugar_nacimiento)){
            if( $result['id'] == $dataform['lugarnacimiento'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = '';
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Sexo</td>
        <td>
            <select id="sexo" name="sexo"  class="obligatorio" data-oldvalue="<?=$dataform['sexo']?>">
                <option value="">-Opciones-</option>
                <option value="Femenino" <?php if($dataform['sexo'] == "Femenino") echo "selected='selected'"?>>Femenino</option>
                <option value="Masculino" <?php if($dataform['sexo'] == "Masculino") echo "selected='selected'"?>>Masculino</option>
                <option value="SD" <?php if($dataform['sexo'] == "SD") echo "selected='selected'"?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Nacionalidad</td>
        <td colspan="3">
            <select id="nacionalidad" name="nacionalidad" class="obligatorio" data-oldvalue="<?=$dataform['nacionalidad']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($paises)){
            if($result['id'] == $dataform['nacionalidad'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=utf8_encode($result['description'])?></option>
<?php
            $complemento = "";
        }
?>
            </select>        
        </td> 
    </tr>
    <tr>
        <td>No. hijos</td>
        <td>
            <select name="numerohijos" id="numerohijos" class="obligatorio" data-oldvalue="<?=$dataform['numerohijos']?>">
                <option value="">-Opciones-</option>
                <option value="0" <?php if($dataform['numerohijos'] == "0") echo "selected='selected'"?>>0</option>
                <option value="1" <?php if($dataform['numerohijos'] == "1") echo "selected='selected'"?>>1</option>
                <option value="2" <?php if($dataform['numerohijos'] == "2") echo "selected='selected'"?>>2</option>
                <option value="3" <?php if($dataform['numerohijos'] == "3") echo "selected='selected'"?>>3</option>        
                <option value="4" <?php if($dataform['numerohijos'] == "4") echo "selected='selected'"?>>4</option>        
                <option value="5" <?php if($dataform['numerohijos'] == "5") echo "selected='selected'"?>>5</option>        
                <option value="6" <?php if($dataform['numerohijos'] == "6") echo "selected='selected'"?>>6</option>        
                <option value="7" <?php if($dataform['numerohijos'] == "7") echo "selected='selected'"?>>7</option>        
                <option value="SD" <?php if($dataform['numerohijos'] == "SD") echo "selected='selected'"?>>SD</option>        
            </select>
        </td>
    </tr>
    <tr>
        <td>Est. civil</td>
        <td>
            <select id="estadocivil" name="estadocivil" class="obligatorio" data-oldvalue="<?=$dataform['estadocivil']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($estados_civiles)){
            if( $result['id'] == $dataform['estadocivil'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>  
        </td>
    </tr>    
    <!-- INFORMACION DOMICILIO Y OFICINA -->
    <tr>
        <td>INFORMACIÓN DOMICILIO Y OFICINA</td>
    </tr>
    <tr>
        <td>Dirección residencia</td>
        <td><input type="text" name="direccionresidencia" id="direccionresidencia" class="obligatorio" value="<?=$dataform['direccionresidencia']?>" data-oldvalue="<?=$dataform['direccionresidencia']?>"></td>        
    </tr>
    <tr>
        <td>Ciudad residencia</td>
        <td>
            <select id="ciudadresidencia" name="ciudadresidencia" class="obligatorio" data-oldvalue="<?=$dataform['ciudadresidencia']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($ciudades)){
            if( $result['id'] == $dataform['ciudadresidencia'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Teléfono residencia</td>
        <td>
            <input type="text" name="telefonoresidencia" id="telefonoresidencia" onKeyPress="onlyNumbers();" class="obligatorio" value="<?=$dataform['telefonoresidencia']?>" data-oldvalue="<?=$dataform['telefonoresidencia']?>">
        </td>
    </tr>
    <tr>
        <td>Nombre empresa</td>
        <td><input type="text" name="nombreempresa" id="nombreempresa" onKeypress="onlyChars();" class="obligatorio" value="<?=$dataform['nombreempresa']?>" data-oldvalue="<?=$dataform['nombreempresa']?>"></td>
    </tr>
    <tr>
        <td>Ciudad empresa</td>
        <td>            
            <select id="ciudadempresa" name="ciudadempresa"  class="obligatorio" data-oldvalue="<?=$dataform['ciudadempresa']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($ciudades_empresa)){
            if( $result['id'] == $dataform['ciudadempresa'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = '';
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Dirección empresa</td>
        <td>
            <input type="text" name="direccionempresa" id="direccionempresa" value="<?=$dataform['direccionempresa']?>" data-oldvalue="<?=$dataform['direccionempresa']?>">
        </td>
    </tr>
    <tr>
        <td>Nomenclatura</td>
        <td>
            <select name="nomenclatura" id="nomenclatura" data-oldvalue="<?=$dataform['nomenclatura']?>">
                <option value="Nomenclatura nueva"  <?php if($dataform['nomenclatura'] == "Nomenclatura nueva") echo "selected='selected'"?>>Nomenclatura nueva</option>
                <option value="Nomenclatura antigua"  <?php if($dataform['nomenclatura'] == "Nomenclatura antigua") echo "selected='selected'"?>>Nomenclatura antigua</option>
                <option value="SD"  <?php if($dataform['nomenclatura'] == "SD") echo "selected='selected'"?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Teléfono laboral</td>
        <td>
            <input type="text" name="telefonolaboral" id="telefonolaboral" onKeyPress="onlyNumbers();" class="obligatorio" value="<?=$dataform['telefonolaboral']?>" data-oldvalue="<?=$dataform['telefonolaboral']?>">
        </td>
    </tr>
    <tr>
        <td>Celular</td>
        <td>
            <input type="text" name="celular" id="celular" onKeyPress="onlyNumbers();" value="<?=$dataform['celular']?>" data-oldvalue="<?=$dataform['celular']?>">
        </td>
    </tr>
    <tr>
        <td>E-mail</td>
        <td>
            <input type="text" name="correoelectronico" id="correoelectronico" value="<?=$dataform['correoelectronico']?>" data-oldvalue="<?=$dataform['correoelectronico']?>">
        </td>
    </tr>
    <tr>
        <td>Cargo</td>
        <td>
            <input type="text" name="cargo" id="cargo" onKeypress="onlyChars();" value="<?=$dataform['cargo']?>" data-oldvalue="<?=$dataform['cargo']?>">
        </td>
    </tr>
    <tr>
        <td>Actv. economica</td>
        <td>
            <select id="actividadeconomicaempresa" name="actividadeconomicaempresa" class="obligatorio" data-oldvalue="<?=$dataform['actividadeconomicaempresa']?>">
                <option value=""> -- Seleccione una opción -- </option>
<?php
        while($result = mysqli_fetch_array($actividad_econo)){
            if( $result['id'] == $dataform['actividadeconomicaempresa'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = '';
        }
?>
            </select>
        </td>
    </tr>
<?php
    }
?>
    <!-- ACTIVIDAD ECONOMICA -->
    <tr>
        <td colspan="4"><div class="title_form">2. ACTIVIDAD ECONOMICA</div></td>
    </tr>
<?php
    if($type_person == "1"){
?>
    <input type="hidden" id="persontype" name="persontype" value="1" data-oldvalue="1">
    <tr>
        <td>PERSONA NATURAL</td>
    </tr>
    <tr>
        <td>Profesión</td>
        <td>
            <select id="profesion" name="profesion" class="obligatorio" data-oldvalue="<?=$dataform['profesion']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($profesiones)){
            if($result['id'] == $dataform['profesion'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
                $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Ocupación</td>
        <td>
            <select id="ocupacion" name="ocupacion" class="obligatorio" data-oldvalue="<?=$dataform['ocupacion']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($ocupaciones)){
            if($result['id'] == $dataform['ocupacion'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Detalle Ocupación</td>
        <td>
<?php
        $detailocupacion = '';
        if($dataform['detalleocupacion'] == '')
            $detailocupacion = 'NA';
        else
            $detailocupacion = $dataform['detalleocupacion'];
?>
            <input type="text" id="detalleocupacion" name="detalleocupacion" value="<?=$detailocupacion?>" data-oldvalue="<?=$detailocupacion?>" onKeypress="onlyChars();">
        </td>
    </tr>
    <tr>
        <td>CIIU</td>
        <td>
            <select id="ciiu" name="ciiu" data-oldvalue="<?=$dataform['ciiu']?>">
                <option value="">-Opciones-</option>
<?php
        foreach($ciius as $result){
            $complemento = "";
            if(isset($result['codigo']) && $result['codigo'] == $dataform['ciiu']){
                $complemento = ' selected="selected"';
            }
?>
                <option value="<?=$result['codigo']?>" <?=$complemento?>><?=$result['descripcion']?></option>
<?php
            $complemento = "";
        }
        /*while($result = mysqli_fetch_array($ciiu)){
            $complemento = "";
            if(isset($result['codigo']) && $result['codigo'] == $dataform['ciiu']){
                $complemento = ' selected="selected"';
            }
?>
                <option value="<?=$result['codigo']?>" <?=$complemento?>><?=$result['codigo']?></option>
<?php
            $complemento = "";
        }*/
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Ingresos mensuales</td>
        <td>
            <select id="ingresosmensuales" name="ingresosmensuales" class="obligatorio" data-oldvalue="<?=$dataform['ingresosmensuales']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($ingresos_mensuales)){
            if($result['id'] == $dataform['ingresosmensuales'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Otros ingresos</td>
        <td>
            <select id="otrosingresos" name="otrosingresos" data-oldvalue="<?=$dataform['otrosingresos']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($otros_ingresos)){
            if( $result['id'] == $dataform['otrosingresos'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Egresos mensuales</td>
        <td>
            <select id="egresosmensuales" name="egresosmensuales" class="obligatorio" data-oldvalue="<?=$dataform['egresosmensuales']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($egresos_mensuales)){
            if( $result['id'] == $dataform['egresosmensuales'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = '';
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Conpto. otros ingresos</td>
        <td>
            <input type="text" name="conceptosotrosingresos" id="conceptosotrosingresos" value="<?=$dataform['conceptosotrosingresos']?>" data-oldvalue="<?=$dataform['conceptosotrosingresos']?>">
        </td>
    </tr>
    <tr>
        <td>Tipo de actividad</td>
        <td>
            <select id="tipoactividad" name="tipoactividad" class="obligatorio" data-oldvalue="<?=$dataform['tipoactividad']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($tipo_actividad)){
            if( $result['id'] == $dataform['tipoactividad'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Nivel estudios</td>
        <td>
            <select id="nivelestudios" name="nivelestudios" data-oldvalue="<?=$dataform['nivelestudios']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($estudios)){
            if($result['id'] == $dataform['nivelestudios'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = '';
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Tipo vivienda</td>
        <td>
            <select id="tipovivienda" name="tipovivienda" data-oldvalue="<?=$dataform['tipovivienda']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($tipo_vivienda)){
            if($result['id'] == $dataform['tipovivienda'])
                $complemento = ' selected="selected"';
?>
                    <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Estrato</td>
        <td>
            <select id="estrato" name="estrato" data-oldvalue="<?=$dataform['estrato']?>">
                <option value="">-Opciones-</option>
                <option value="1" <?php if($dataform['estrato'] == "1") echo "selected='selected'"?>>1</option>
                <option value="2" <?php if($dataform['estrato'] == "2") echo "selected='selected'"?>>2</option>
                <option value="3" <?php if($dataform['estrato'] == "3") echo "selected='selected'"?>>3</option>
                <option value="4" <?php if($dataform['estrato'] == "4") echo "selected='selected'"?>>4</option>
                <option value="5" <?php if($dataform['estrato'] == "5") echo "selected='selected'"?>>5</option>
                <option value="6" <?php if($dataform['estrato'] == "6") echo "selected='selected'"?>>6</option>
                <option value="SD" <?php if($dataform['estrato'] == "SD") echo "selected='selected'"?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Total activos</td>
        <td><input type="text" name="totalactivos" id="totalactivos" onKeyPress="onlyNumbers();" class="obligatorio" value="<?=$dataform['totalactivos']?>" data-oldvalue="<?=$dataform['totalactivos']?>"></td>
    </tr>
    <tr>
        <td>Total pasivos</td>
        <td><input type="text" name="totalpasivos" id="totalpasivos" onKeyPress="onlyNumbers();" class="obligatorio" value="<?=$dataform['totalpasivos']?>" data-oldvalue="<?=$dataform['totalpasivos']?>"></td>    
    </tr>
    <tr>
        <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
        <td>
            <select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['expuesta_publica']?>"><!--agregar campo llamado expuesta_publica-->
                <option value="">Seleccion...</option>
                <option value="-1"<?=(($dataform['expuesta_publica'] == "-1") ? "selected" : "")?>>SI</option>
                <option value="0"<?=(($dataform['expuesta_publica'] == "0") ? "selected" : "")?>>NO</option>
                <option value="2"<?=(($dataform['expuesta_publica'] == "2") ? "selected" : "")?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td style="width: 100px;display: table-cell;">Vinculo persona expuesta publicamente?</td>
        <td>
            <select id="servidor_publico" name="servidor_publico" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['servidor_publico']?>"><!--agregar campo llamado servidor_publico-->
                <option value="">Seleccion...</option>
                <option value="-1"<?=(($dataform['servidor_publico'] == "-1") ? "selected" : "")?>>SI</option>
                <option value="0"<?=(($dataform['servidor_publico'] == "0") ? "selected" : "")?>>NO</option>
                <option value="2"<?=(($dataform['servidor_publico'] == "2") ? "selected" : "")?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td style="width: 100px;display: table-cell;">Administra recursos publicos?</td>
        <td>
            <select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['recursos_publicos']?>"><!--agregar campo llamado recursos_publicos-->
                <option value="">Seleccion...</option>
                <option value="-1"<?=(($dataform['recursos_publicos'] == "-1") ? "selected" : "")?>>SI</option>
                <option value="0"<?=(($dataform['recursos_publicos'] == "0") ? "selected" : "")?>>NO</option>
                <option value="2"<?=(($dataform['recursos_publicos'] == "2") ? "selected" : "")?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td style="width: 100px;display: table-cell;">Obligaciones tributarias en otro pais?</td>
        <td>
            <select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tributarias_otro_pais']?>"><!--agregar campo llamado tributarias_otro_pais-->
                <option value="">Seleccion...</option>
                <option value="-1"<?=(($dataform['tributarias_otro_pais'] == "-1") ? "selected" : "")?>>SI</option>
                <option value="0"<?=(($dataform['tributarias_otro_pais'] == "0") ? "selected" : "")?>>NO</option>
                <option value="2"<?=(($dataform['tributarias_otro_pais'] == "2") ? "selected" : "")?>>SD</option>
            </select>
            Cuales?: 
            <input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" readonly onkeypress="return validar_letra(event)" value="<?=$dataform['tributarias_paises']?>" data-oldvalue="<?=$dataform['tributarias_paises']?>"><!--agregar campo llamado tributarias_paises-->
        </td>
    </tr>
<?php
    }else{
?>
    <!-- PERSONA JURIDICA -->
    <input type="hidden" id="persontype" name="persontype" value="2" data-oldvalue="2">
    <tr>
        <td colspan="2">PERSONA JURIDICA</td>
    </tr>
    <tr>
        <td>Razon social</td>
        <td><input type="text" name="razonsocial" id="razonsocial" Class="obligatorio" value="<?=$dataform['razonsocial']?>" data-oldvalue="<?=$dataform['razonsocial']?>"></td>
    </tr>
    <tr>
        <td>NIT</td>
        <td><input type="text" name="nit" id="nit" onKeypress="onlyNumbers();" class="obligatorio" value="<?=$dataform['nit']?>" data-oldvalue="<?=$dataform['nit']?>">
        Cod. Verf.
        <input type="text" name="digitochequeo" id="digitochequeo" onKeypress="onlyNumbers();" size="4" class="obligatorio" value="<?=$dataform['digitochequeo']?>" data-oldvalue="<?=$dataform['digitochequeo']?>">
    </tr>
    <tr>
        <td>CIIU</td>
        <td>
            <select id="ciiu" name="ciiu" class="obligatorio" data-oldvalue="<?=$dataform['ciiu']?>">
                <option value="">-Opciones-</option>
<?php
        foreach($ciius as $result){
            $complemento = "";
            if(isset($result['codigo']) && $result['codigo'] == $dataform['ciiu']){
                $complemento = ' selected="selected"';
            }
?>
                <option value="<?=$result['codigo']?>" <?=$complemento?>><?=$result['descripcion']?></option>
<?php
            $complemento = "";
        }
        /*while($result = mysqli_fetch_array($ciiu)){
            if(isset($result['codigo']) && ($result['codigo'] == $dataform['ciiu']))
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['codigo']?>" <?=$complemento?>><?=$result['codigo']?></option>
<?php
            $complemento = "";
        }*/
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Ciudad oficina ppal.</td>
        <td>
            <select id="ciudadoficina" name="ciudadoficina" class="obligatorio" data-oldvalue="<?=$dataform['ciudadoficina']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($ciudades_oficina)){
            if($result['id'] == $dataform['ciudadoficina'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = '';
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Dirección oficina ppal.</td>
        <td>
            <input type="text" name="direccionoficinappal" id="direccionoficinappal" class="obligatorio" value="<?=$dataform['direccionoficinappal']?>" data-oldvalue="<?=$dataform['direccionoficinappal']?>">
        </td>
    </tr>
    <tr>
        <td>Nomenclatura</td>
        <td>
            <select name="nomenclatura_emp" id="nomenclatura_emp" data-oldvalue="<?=$dataform['nomenclatura_emp']?>">
                <option value="Nomenclatura nueva"  <?php if($dataform['nomenclatura_emp'] == "Nomenclatura nueva") echo "selected='selected'"?>>Nomenclatura nueva</option>
                <option value="Nomenclatura antigua"  <?php if($dataform['nomenclatura_emp'] == "Nomenclatura antigua") echo "selected='selected'"?>>Nomenclatura antigua</option>
                <option value="SD"  <?php if($dataform['nomenclatura_emp'] == "SD") echo "selected='selected'"?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Teléfono oficina</td>
        <td>
            <input type="text" name="telefonoficina" id="telefonoficina" onKeyPress="onlyNumbers();" class="obligatorio" value="<?=$dataform['telefonoficina']?>" data-oldvalue="<?=$dataform['telefonoficina']?>">
        </td>
    </tr>
    <tr>
        <td>Fax oficina</td>
        <td>
            <input type="text" name="faxoficina" id="faxoficina" onKeyPress="onlyNumbers();" value="<?=$dataform['faxoficina']?>" data-oldvalue="<?=$dataform['faxoficina']?>">
        </td>
    </tr>
    <tr>
        <td>Celular oficina</td>
        <td>
            <input type="text" name="celularoficina" id="celularoficina" onkeypress="return validar_num(event)" maxlength="10" value="<?=$dataform['celularoficina']?>" data-oldvalue="<?=$dataform['celularoficina']?>">
        </td>
    </tr>
    <tr>
        <td>Ciudad sucursal</td>
        <td colspan="3">
            <select id="ciudadsucursal" name="ciudadsucursal" data-oldvalue="<?=$dataform['ciudadsucursal']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($ciudades_sucursal)){
            if($result['id'] == $dataform['ciudadsucursal'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Dirección sucursal</td>
        <td>
            <input type="text" name="direccionsucursal" id="direccionsucursal" value="<?=$dataform['direccionsucursal']?>" data-oldvalue="<?=$dataform['direccionsucursal']?>">
        </td>
    </tr>
    <tr>
        <td>Nomenclatura</td>
        <td>
            <select name="nomenclatura_emp2" id="nomenclatura_emp2" data-oldvalue="<?=$dataform['nomenclatura_emp2']?>">
                <option value="Nomenclatura nueva"  <?php if($dataform['nomenclatura_emp2'] == "Nomenclatura nueva") echo "selected='selected'"?>>Nomenclatura nueva</option>
                <option value="Nomenclatura antigua"  <?php if($dataform['nomenclatura_emp2'] == "Nomenclatura antigua") echo "selected='selected'"?>>Nomenclatura antigua</option>
                <option value="SD"  <?php if($dataform['nomenclatura_emp2'] == "SD") echo "selected='selected'"?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Teléfono sucursal</td>
        <td>
            <input type="text" name="telefonosucursal" id="telefonosucursal" onKeyPress="onlyNumbers();" value="<?=$dataform['telefonosucursal']?>" data-oldvalue="<?=$dataform['telefonosucursal']?>">
        </td>
    </tr>
    <tr>
        <td>Fax sucursal</td>
        <td>
            <input type="text" name="faxsucursal" id="faxsucursal" onKeyPress="onlyNumbers();" value="<?=$dataform['faxsucursal']?>" data-oldvalue="<?=$dataform['faxsucursal']?>">
        </td>
    </tr>
    <tr>
        <td>Actividad economica ppal.</td>
        <td>
            <select id="actividadeconomicappal" name="actividadeconomicappal" onChange="javascript:cambiarEstadoActividad()" class="obligatorio" data-oldvalue="<?=$dataform['actividadeconomicappal']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($actividades)){
            if($result['id'] == $dataform['actividadeconomicappal'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
            <div id="otrosactividad">
                Otro:
                <input type="text"  name="detalleactividadeconomicappal"  onKeypress="onlyChars();" id="detalleactividadeconomicappal" value="<?=$dataform['detalleactividadeconomicappal']?>" data-oldvalue="<?=$dataform['detalleactividadeconomicappal']?>">
            </div>
        </td>
    </tr>
    <tr>
        <td>Tipo empresa</td>
        <td>
            <select id="tipoempresaemp" name="tipoempresaemp" class="obligatorio" data-oldvalue="<?=$dataform['tipoempresaemp']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($tipo_empresa_emp)){
            if($result['id'] == $dataform['tipoempresaemp'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Activos empresa</td>
        <td><input type="text" id="activosemp" name="activosemp" onKeyPress="onlyNumbers();" class="obligatorio" value="<?=$dataform['activosemp']?>" data-oldvalue="<?=$dataform['activosemp']?>"></td>
    </tr>
    <tr>
        <td>Pasivos empresa</td>
        <td><input type="text"  id="pasivosemp" name="pasivosemp" onKeyPress="onlyNumbers();" class="obligatorio" value="<?=$dataform['pasivosemp']?>" data-oldvalue="<?=$dataform['pasivosemp']?>"></td>
    </tr>
    <tr>
        <td>Ingresos mensuales empresa</td>
        <td>
            <select id="ingresosmensualesemp" name="ingresosmensualesemp" class="obligatorio" data-oldvalue="<?=$dataform['ingresosmensualesemp']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($ingresos_mensuales_emp)){
            if($result['id'] == $dataform['ingresosmensualesemp'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = "";
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Egresos mensuales empresa</td>
        <td>
            <select id="egresosmensualesemp" name="egresosmensualesemp" class="obligatorio" data-oldvalue="<?=$dataform['egresosmensualesemp']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($egresos_mensuales_emp)){
            if($result['id'] == $dataform['egresosmensualesemp'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
            $complemento = '';
        }
?>
            </select>
        </td>
    </tr>
    <tr>
        <td style="width: 100px;display: table-cell;">Administrador expuesto publicamente?</td>
        <td>
            <select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['expuesta_publica']?>"><!--agregar campo llamado expuesta_publica-->
                <option value="">Seleccion...</option>
                <option value="-1"<?=(($dataform['expuesta_publica'] == "-1") ? "selected" : "")?>>SI</option>
                <option value="0"<?=(($dataform['expuesta_publica'] == "0") ? "selected" : "")?>>NO</option>
                <option value="2"<?=(($dataform['expuesta_publica'] == "2") ? "selected" : "")?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td style="width: 100px;display: table-cell;">Administra recursos publicos?</td>
        <td>
            <select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['recursos_publicos']?>"><!--agregar campo llamado recursos_publicos-->
                <option value="">Seleccion...</option>
                <option value="-1"<?=(($dataform['recursos_publicos'] == "-1") ? "selected" : "")?>>SI</option>
                <option value="0"<?=(($dataform['recursos_publicos'] == "0") ? "selected" : "")?>>NO</option>
                <option value="2"<?=(($dataform['recursos_publicos'] == "2") ? "selected" : "")?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td style="width: 100px;display: table-cell;">Obligaciones tributarias en otro pais?</td>
        <td>
            <select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tributarias_otro_pais']?>"><!--agregar campo llamado tributarias_otro_pais-->
                <option value="">Seleccion...</option>
                <option value="-1"<?=(($dataform['tributarias_otro_pais'] == "-1") ? "selected" : "")?>>SI</option>
                <option value="0"<?=(($dataform['tributarias_otro_pais'] == "0") ? "selected" : "")?>>NO</option>
                <option value="2"<?=(($dataform['tributarias_otro_pais'] == "2") ? "selected" : "")?>>SD</option>
            </select>
            Cuales?: 
            <input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" readonly onkeypress="return validar_letra(event)" value="<?=$dataform['tributarias_paises']?>" data-oldvalue="<?=$dataform['tributarias_paises']?>"><!--agregar campo llamado tributarias_paises-->
        </td>
    </tr>
    <tr>
        <td colspan="2">SOCIOS</td>
    </tr>
    <tr>
        <td>Socio No. 1:</td>
        <td><input type="text" name="socio1" id="socio1" onkeypress="onlyNumbers();" value="<?=$dataform['socio1']?>" data-oldvalue="<?=$dataform['socio1']?>"></td>
    </tr>
    <tr>
        <td>Socio No. 2:</td>
        <td><input type="text" name="socio2" id="socio2" onkeypress="onlyNumbers();" value="<?=$dataform['socio2']?>" data-oldvalue="<?=$dataform['socio2']?>"></td>
    </tr>
    <tr>
        <td>Socio No. 3:</td>
        <td><input type="text" name="socio3" id="socio3" onkeypress="onlyNumbers();" value="<?=$dataform['socio3']?>" data-oldvalue="<?=$dataform['socio3']?>"></td>
    </tr>
<?php
    }
?>            
    <!-- ACTIVIDADES EN OPERACIONES INTERNACIONALES -->
    <tr>
        <td colspan="4">
            <div class="title_form">3. ACTIVIDADES EN OPERACIONES INTERNACIONALES</div>
        </td>
    </tr>
    <tr>
        <td>Moneda extranjera</td>
        <td>
            <select id="monedaextranjera" name="monedaextranjera" class="obligatorio" data-oldvalue="<?=$dataform['monedaextranjera']?>">
                <option value="">-Opciones-</option>
                <option value="Si" <?php if($dataform['monedaextranjera'] == "Si") echo "selected='selected'"?>>Si</option>
                <option value="No" <?php if($dataform['monedaextranjera'] == "No") echo "selected='selected'"?>>No</option>
                <option value="SD" <?php if($dataform['monedaextranjera'] == "SD") echo "selected='selected'"?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Tipo transacciones</td>
        <td>
            <select id="tipotransacciones" name="tipotransacciones" data-oldvalue="<?=$dataform['tipotransacciones']?>">
                <option value="">-Opciones-</option>
<?php
    while($result = mysqli_fetch_array($tipo_transacciones)){
        if($result['id'] == $dataform['tipotransacciones'])
            $complemento = ' selected="selected"';
?>
                <option value="<?=$result['id']?>" <?=$complemento?>><?=$result['description']?></option>
<?php
        $complemento = "";
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
        <td>Firma del cliente:</td>
        <td>
            <select name="firma" id="firma" class="obligatorio" data-oldvalue="<?=$dataform['firma']?>">
                <option value="">-Opciones-</option>
                <option value="-1"<?=(($dataform['firma'] == "-1") ? "selected" : "")?>>SI</option>
                <option value="0"<?=(($dataform['firma'] == "0") ? "selected" : "")?>>NO</option>
                <option value="2"<?=(($dataform['firma'] == "2") ? "selected" : "")?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Huella del cliente:</td>
        <td>
            <select name="huella" id="huella" class="obligatorio" data-oldvalue="<?=$dataform['huella']?>">
                <option value="">-Opciones-</option>
                <option value="-1"<?=(($dataform['huella'] == "-1") ? "selected" : "")?>>SI</option>
                <option value="0"<?=(($dataform['huella'] == "0") ? "selected" : "")?>>NO</option>
                <option value="2"<?=(($dataform['huella'] == "2") ? "selected" : "")?>>SD</option>
            </select>
        </td>
    </tr>
    <!-- INFORMACION ENTREVISTA -->
    <tr>
        <td>Lugar de entrevista:</td>
        <td>
            <input type="text" name="lugarentrevista" id="lugarentrevista"  class="obligatorio" value="<?=$dataform['lugarentrevista']?>" data-oldvalue="<?=$dataform['lugarentrevista']?>">
        </td>
    </tr>
    <tr>
        <td style="width: 80px">Fecha de entrevista:</td><!--fechaentrevista-->
        <td>
            <input type="hidden" id="fechaentrevista" name="fechaentrevista" value="<?=$dataform['fechaentrevista']?>">
            <select id="f_ent_a" name="f_ent_a" onchange="$(this).verificarFecha(event, 'ent', '0');" style="font-size: 12px">
                <option value="">Año</option>
<?php
    $f_r = explode('-', $dataform['fechaentrevista']);
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
            <select id="f_ent_m" name="f_ent_m" onchange="$(this).verificarFecha(event, 'ent', '0');" style="font-size: 12px">
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
            <select id="f_ent_d" name="f_ent_d" style="font-size: 12px">
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
            Hora:
            <select id="h_ent_h" name="h_ent_h" style="font-size: 12px">
                <option value="">Hora</option><!--horaentrevista-->
<?php
    $h_h = explode(':', $dataform['horaentrevista']);
    if(count($h_h) === 0){
        $h_h[0] = '00';
        $h_h[1] = '00';
    }else if(count($h_h) === 1){
        $h_h[1] = '00';
    }
    for ($i=1; $i <= 12; $i++) { 
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
            <select id="h_ent_m" name="h_ent_m" style="font-size: 12px">
                <option value="">Minuto</option>
<?php
    for ($i=0; $i <= 59; $i++) { 
        $hor = $i;
        if (strlen($i) == 1) {
            $hor = '0'.$i;
        }
        $select = '';
        if(isset($h_h[1]) && $h_h[1] == $hor)
            $select = 'selected';
?>
                <option value="<?=$hor?>"<?=$select?>><?=$hor?></option>
<?php
    }
?>
            </select>
            <select id="tipohoraentrevista" name="tipohoraentrevista" style="font-size: 12px" data-oldvalue="<?=strtoupper($dataform['tipohoraentrevista'])?>">
                <option value="">Horario</option>
                <option value="AM"<?=((strtoupper($dataform['tipohoraentrevista']) == "AM") ? "selected" : "")?>>A.M.</option>
                <option value="PM"<?=((strtoupper($dataform['tipohoraentrevista']) == "PM") ? "selected" : "")?>>P.M.</option>
            </select>
            <input type="hidden" id="horaentrevista" name="horaentrevista" value="<?=$dataform['horaentrevista']?>">
        </td>
    </tr>
    <tr>
        <td>Resultado entrevista: <?=$dataform['resultadoentrevista']?></td>
        <td>
            <select name="resultadoentrevista" id="resultadoentrevista" class="obligatorio" data-oldvalue="<?=$dataform['resultadoentrevista']?>">
                <option value="">-Opciones-</option>
                <option value="Aceptado" <?php if($dataform['resultadoentrevista'] == "Aceptado") echo "selected='selected'"?>>Aceptado</option>
                <option value="Rechazado" <?php if($dataform['resultadoentrevista'] == "Rechazado") echo "selected='selected'"?>>Rechazado</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Observaciones:</td>
        <td>
            <textarea name="observacionesentrevista" id="observacionesentrevista" value="<?=$dataform['observacionesentrevista']?>" data-oldvalue="<?=$dataform['observacionesentrevista']?>"><?=$dataform['observacionesentrevista']?></textarea>
        </td>
    </tr>
    <tr>
        <td>Nombre intermediario y/o asesor responsable:</td>
        <td>
            <input type="text" name="nombreintermediario" id="nombreintermediario" class="obligatorio" value="<?=$dataform['nombreintermediario']?>" data-oldvalue="<?=$dataform['nombreintermediario']?>">
        </td>
    </tr>
    <tr>
        <td colspan="4" align="center"><input type="submit" value="Guardar cambios" /></td>
    </tr>
</table>
<input type="hidden" name="id_form" id="id_form" value="<?=$_GET['id_form']?>">
</form>
<script type="text/javascript">
$(document).ready(function(){
    //console.log("aca");
    $('form#saveEdit').submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        var datos = {};
        $(this).find("[data-oldvalue]").each(function(index, el) {
            //console.log($(el).attr('name'));
            if($(el).val() != $(el).attr('data-oldvalue')){
                datos[$(el).attr('name')] = $(el).val();
                console.log($(el).attr('name') + '->' + $(el).val() + ':::' + $(el).attr('data-oldvalue'));
            }
        });
        if($(this).find('select[name="f_rad_a"]').val() != '' && $(this).find('select[name="f_rad_m"]').val() != '' && $(this).find('select[name="f_rad_d"]').val() != ''){
            var fecharadicado = $(this).find('select[name="f_rad_a"]').val() + '-' + $(this).find('select[name="f_rad_m"]').val() + '-' + $(this).find('select[name="f_rad_d"]').val();
            if($(this).find('input[name="fecharadicado"]').val() != fecharadicado)
                datos['fecharadicado'] = fecharadicado;
        }else{
            alert('La fecha de radicado no puede estar vacia o incompleta.');
            return false;
        }

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
        }else{
            alert('La fecha de expedicion no puede estar vacia o incompleta.');
            return false;
        }
        if($(this).find('select[name="ciiu"]').val() == ''){
            alert('El campo de CIIU no puede estar vacio.');
            $(this).find('select[name="ciiu"]').focus();
            return false;
        }
        if($(this).find('input[name="type_person"]').val() == '1'){
            if($(this).find('select[name="f_nac_a"]').val() != '' && $(this).find('select[name="f_nac_m"]').val() != '' && $(this).find('select[name="f_nac_d"]').val() != ''){
                var fechanacimiento = $(this).find('select[name="f_nac_a"]').val() + '-' + $(this).find('select[name="f_nac_m"]').val() + '-' + $(this).find('select[name="f_nac_d"]').val();
                if($(this).find('input[name="fechanacimiento"]').val() != fechanacimiento)
                    datos['fechanacimiento'] = fechanacimiento;
            }else{
                alert('La fecha de nacimiento no puede estar vacia o incompleta.');
                return false;
            }
        }

        if($(this).find('select[name="f_ini_a"]').val() != '' && $(this).find('select[name="f_ini_m"]').val() != '' && $(this).find('select[name="f_ini_d"]').val() != ''){
        }
        if($(this).find('select[name="f_fin_a"]').val() != '' && $(this).find('select[name="f_fin_m"]').val() != '' && $(this).find('select[name="f_fin_d"]').val() != ''){
        }

        if($(this).find('select[name="f_ent_a"]').val() != '' && $(this).find('select[name="f_ent_m"]').val() != '' && $(this).find('select[name="f_ent_d"]').val() != ''){
            var fechaentrevista = $(this).find('select[name="f_ent_a"]').val() + '-' + $(this).find('select[name="f_ent_m"]').val() + '-' + $(this).find('select[name="f_ent_d"]').val();
            if($(this).find('input[name="fechaentrevista"]').val() != fechaentrevista)
                datos['fechaentrevista'] = fechaentrevista;
        }else{
            alert('La fecha de entrevista no puede estar vacia o incompleta.');
            return false;
        }

        /*if($(this).find('select[name="f_ver_a"]').val() != '' && $(this).find('select[name="f_ver_m"]').val() != '' && $(this).find('select[name="f_ver_d"]').val() != ''){
            var verificacion_fecha = $(this).find('select[name="f_ver_a"]').val() + '-' + $(this).find('select[name="f_ver_m"]').val() + '-' + $(this).find('select[name="f_ver_d"]').val();
            if($(this).find('input[name="verificacion_fecha"]').val() != verificacion_fecha)
                datos['verificacion_fecha'] = verificacion_fecha;
        }else{
            alert('La fecha de verificacion no puede estar vacia o incompleta.');
            return false;
        }*/

        if($(this).find('select[name="h_ent_h"]').val() != '' && $(this).find('select[name="h_ent_m"]').val() != ''){
            var horaentrevista = $(this).find('select[name="h_ent_h"]').val() + ':' + $(this).find('select[name="h_ent_m"]').val();
            if(horaentrevista != $(this).find('input[name="horaentrevista"]').val())
                datos['horaentrevista'] = horaentrevista;
        }


        /*if($(this).find('select[name="h_ver_h"]').val() != '' && $(this).find('select[name="h_ver_m"]').val() != '' && $(this).find('select[name="h_ver_z"]').val() != ''){
            var verificacion_hora = $.fn.convertTime12to24($(this).find('select[name="h_ver_h"]').val() + ':' + $(this).find('select[name="h_ver_m"]').val() + ' ' + $(this).find('select[name="h_ver_z"]').val());
            if(verificacion_hora != $(this).find('input[name="verificacion_hora"]').val())
                datos['verificacion_hora'] = verificacion_hora;
        }*/
        if($.isEmptyObject(datos)){
            alert('No esta efectuando ningun cambio en la data del cliente.');
            return false;
        }
        //console.log(datos);
        //return false;
        datos['id_form'] = $(this).find('input[name="id_form"]').val();
        //datos['formulario'] = $(this).find('input[name="formulario"]').val();
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
</script>