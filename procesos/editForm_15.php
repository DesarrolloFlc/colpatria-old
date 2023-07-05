<?php
$daneCiudades = General::getCiudadesDanes();
$sucursales = General::getSucursalesLista();
$clasesVinculacion = General::getclaseVinculacion();
$tipoDocumentos = General::getTipoDocumentoID();
$tipoempresas = General::getTipoEmpresaID();
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
<form method="POST" action="saveEditNew.php" id="saveEditNew" name="saveEditNew">
<input type="hidden" name="id_form" id="id_form" value="<?=$_GET['id_form']?>">
<input type="hidden" name="formulario" id="formulario" value="15">
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
            <tr>
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
            </tr>
            <tr>
                <td>Funcionario:</td>
                <td>
                    <select id="id_official" name="id_official" style="font-size: 12px" data-oldvalue="<?=$dataform['id_official']?>">
                        <option value="">Seleccione...</option>
<?php
    foreach ($funcionarios as $funcionario) {
        $slect = '';
        if(strtoupper(trim($dataform['id_official'])) == strtoupper(trim($funcionario['name'])))
            $slect = ' selected';
?>
                        <option value="<?=strtoupper(trim($funcionario['name']))?>"<?=$slect?>><?=strtoupper(trim($funcionario['name']))?></option>
<?php
    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tipo de solicitud:</td>
                <td>
                    <select id="tipo_solicitud" name="tipo_solicitud" data-oldvalue="<?=$dataform['tipo_solicitud']?>"><!--agregar campo llamado tipo_solicitud-->
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
                    <input type="text" id="cual_clasecliente" name="cual_clasecliente" style="width: 130px;" readonly value="<?=$dataform['cual_clasecliente']?>"data-oldvalue="<?=$dataform['cual_clasecliente']?>"><!--agregar campo llamado cual_clasecliente-->
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table id="table_parte1">
            <tr>
                <td colspan="2" align="center"><strong>1. INFORMACI&Oacute;N B&Aacute;SICA</strong></td>
            </tr>
            <tr>
                <td colspan="2">Persona natural y jur&iacute;dica (Para persona jur&iacute;dica seran los datos del representante legal)</td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Primer apellido:</td>
                <td>
                    <input type="text" id="primerapellido" name="primerapellido" style="width: 130px; margin-right: 30px" value="<?=$dataform['primerapellido']?>" data-oldvalue="<?=$dataform['primerapellido']?>">
                    Segundo apellido:&nbsp;
                    <input type="text" id="segundoapellido" name="segundoapellido" style="width: 130px" value="<?=$dataform['segundoapellido']?>" data-oldvalue="<?=$dataform['segundoapellido']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nombres:</td>
                <td><input type="text" id="nombres" name="nombres" style="width: 200px; margin-right: 40px" value="<?=$dataform['nombres']?>" data-oldvalue="<?=$dataform['nombres']?>"></td>
            </tr>
            <tr>
                <td>Genero</td>
                <td>
                    <select id="sexo" name="sexo" data-oldvalue="<?=$dataform['sexo']?>">
                        <option value="">-Opciones-</option>
                        <option value="Femenino" <?php if($dataform['sexo'] == "Femenino") echo "selected='selected'"?>>Femenino</option>
                        <option value="Masculino" <?php if($dataform['sexo'] == "Masculino") echo "selected='selected'"?>>Masculino</option>
                        <option value="SD" <?php if($dataform['sexo'] == "SD") echo "selected='selected'"?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo documento:</td>
                <td>
                    <select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipodocumento']?>">
                        <option value="">Seleccione...</option>
<?php
    foreach ($tipoDocumentos as $tipo) {
        $slect = '';
        if($dataform['tipodocumento'] == $tipo['id'])
            $slect = ' selected';
?>
                        <option value="<?=$tipo['id']?>"<?=$slect?>><?=$tipo['description']?></option>
<?php
    }
?>
                    </select>
                    Numero identificacion:&nbsp;
                    <input type="text" id="documento" name="documento" onBlur="ocultarCampoDoc();" style="width: 130px" value="<?=$dataform['document']?>"<?=(($type_person == '1') ? "readonly" : "")?> data-oldvalue="<?=$dataform['document']?>">
                </td>
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
                <td style="width: 100px;display: table-cell;">Lugar expedicion:</td>
                <td>
                    <select id="lugarexpedicion" name="lugarexpedicion" style="font-size: 12px" data-oldvalue="<?=$dataform['lugarexpedicion']?>">
                        <option value="">Seleccione...</option>
<?php
    foreach ($daneCiudades as $ciudad) {
            $slect = '';
            if($dataform['lugarexpedicion'] == $ciudad['id'])
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
                <td style="width: 100px;display: table-cell;">Lugar nacimiento:</td>
                <td>
                    <select id="lugarnacimiento" name="lugarnacimiento" style="font-size: 12px" data-oldvalue="<?=$dataform['lugarnacimiento']?>">
                        <option value="">Seleccione...</option>
<?php
    foreach ($daneCiudades as $ciudad) {
        $slect = '';
        if($dataform['lugarnacimiento'] == $ciudad['id'])
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
                <td style="width: 100px;display: table-cell;">Nacionalidad:</td>
                <td>
                    <select id="paisnacimiento" name="paisnacimiento" style="font-size: 12px" data-oldvalue="<?=$dataform['paisnacimiento']?>">
                        <option value="">Seleccione...</option>
<?php
    foreach ($paises as $pais) {
        $slect = '';
        if($dataform['paisnacimiento'] == $pais['id'])
            $slect = ' selected';
?>
                        <option value="<?=$pais['id']?>"<?=$slect?>><?=$pais['description']?></option>
<?php
    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nacionalidad 2:</td>
                <td>
                    <select id="nacionalidad_otra" name="nacionalidad_otra" style="font-size: 12px" data-oldvalue="<?=$dataform['nacionalidad_otra']?>">
                        <option value="">Seleccione...</option>
<?php
    foreach ($paises as $pais) {
        $slect = '';
        if($dataform['nacionalidad_otra'] == $pais['id'])
            $slect = ' selected';
?>
                        <option value="<?=$pais['id']?>"<?=$slect?>><?=$pais['description']?></option>
<?php
    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Direccion residencia:</td>
                <td><input type="text" id="direccionresidencia" name="direccionresidencia" style="width: 240px" value="<?=$dataform['direccionresidencia']?>" data-oldvalue="<?=$dataform['direccionresidencia']?>"></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Ciudad y departamento:</td>
                <td>
                    <select id="ciudadresidencia" name="ciudadresidencia" style="font-size: 12px" data-oldvalue="<?=$dataform['ciudadresidencia']?>">
                        <option value="">Seleccione...</option>
<?php
    foreach ($daneCiudades as $ciudad) {
            $slect = '';
            if($dataform['ciudadresidencia'] == $ciudad['id'])
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
                <td style="width: 100px;display: table-cell;">E-mail:</td>
                <td>
                    <input type="text" id="correoelectronico" name="correoelectronico" style="width: 240px" value="<?=$dataform['correoelectronico']?>" data-oldvalue="<?=$dataform['correoelectronico']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Telefono:</td>
                <td>
                    <input type="text" id="telefonoresidencia" name="telefonoresidencia" style="width: 130px; margin-right: 40px" maxlength="7" onblur="$(this).checkTamanoTele(7);" value="<?=$dataform['telefonoresidencia']?>" data-oldvalue="<?=$dataform['telefonoresidencia']?>">
                    Celular:
                    <input type="text" id="celular" name="celular" style="width: 130px" maxlength="10" onblur="$(this).checkTamanoTele(10);" value="<?=$dataform['celular']?>" data-oldvalue="<?=$dataform['celular']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Empresa donde trabaja:</td>
                <td><input type="text" id="nombreempresa" name="nombreempresa" style="width: 240px" value="<?=$dataform['nombreempresa']?>" data-oldvalue="<?=$dataform['nombreempresa']?>"></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Direccion oficina:</td>
                <td>
                    <input type="text" id="direccionempresa" name="direccionempresa" style="width: 180px; margin-right: 10px" value="<?=$dataform['direccionempresa']?>" data-oldvalue="<?=$dataform['direccionempresa']?>">
                    Telefono oficina:
                    <input type="text" id="telefonolaboral" name="telefonolaboral" style="width: 100px" value="<?=$dataform['telefonolaboral']?>" data-oldvalue="<?=$dataform['telefonolaboral']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Ciudad empresa</td>
                <td>
                    <select id="ciudadempresa" name="ciudadempresa" style="font-size: 12px" data-oldvalue="<?=$dataform['ciudadempresa']?>">
                        <option value="">Seleccione...</option>
<?php
    foreach ($daneCiudades as $ciudad) {
        $slect = '';
        if($dataform['ciudadempresa'] == $ciudad['id'])
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
                <td style="width: 100px;display: table-cell;">Celular oficina:</td>
                <td>
                    <input type="text" id="celularoficinappal" name="celularoficinappal" style="width: 160px" value="<?=$dataform['celularoficinappal']?>" data-oldvalue="<?=$dataform['celularoficinappal']?>"><!--agregar campo llamado celularoficinappal-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo empresa</td>
                <td>
                    <select id="tipoempresaemp" name="tipoempresaemp" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipoempresaemp']?>">
                        <option value="">Seleccione...</option>
<?php
    foreach ($tipoempresas as $tipoempresa) {
        $slect = '';
        if($dataform['tipoempresaemp'] == $tipoempresa['id'])
            $slect = ' selected';
?>
                        <option value="<?=$tipoempresa['id']?>"<?=$slect?>><?=$tipoempresa['description']?></option>
<?php
    }
?>
                    </select>
                    Cual?
                    <input type="text" id="tipoempresaemp_cual" name="tipoempresaemp_cual" style="width: 100px" readonly value="<?=$dataform['tipoempresaemp_cual']?>" data-oldvalue="<?=$dataform['tipoempresaemp_cual']?>"><!--agregar campo llamado tipoempresaemp_cual-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['recursos_publicos']?>"><!--agregar campo llamado recursos_publicos-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['recursos_publicos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['recursos_publicos'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['recursos_publicos'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Grado de poder publico?
                    <select id="poder_publico" name="poder_publico" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['poder_publico']?>"><!--agregar campo llamado poder_publico-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['poder_publico'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['poder_publico'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['poder_publico'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Reconocimiento publico?</td>
                <td>
                    <select id="reconocimiento_publico" name="reconocimiento_publico" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['reconocimiento_publico']?>"><!--agregar campo llamado reconocimiento_publico-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['reconocimiento_publico'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['reconocimiento_publico'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['reconocimiento_publico'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Indique
                    <input type="text" id="reconocimiento_cual" name="reconocimiento_cual" style="width: 180px; margin-left: 10px" readonly value="<?=$dataform['reconocimiento_cual']?>" data-oldvalue="<?=$dataform['reconocimiento_cual']?>"><!--agregar campo llamado reconocimiento_cual-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Servidor publico?</td>
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
                <td style="width: 100px;display: table-cell;">Persona expuesta politicamente?</td>
                <td>
                    <select id="expuesta_politica" name="expuesta_politica" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['expuesta_politica']?>"><!--agregar campo llamado expuesta_politica-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['expuesta_politica'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['expuesta_politica'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['expuesta_politica'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Cargo:
                    <input type="text" id="cargo_politica" name="cargo_politica" style="width: 180px; margin-left: 10px" readonly value="<?=$dataform['cargo_politica']?>" data-oldvalue="<?=$dataform['cargo_politica']?>"><!--agregar campo llamado cargo_politica-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">&nbsp;</td>
                <td>
                    Inicio
                    <select id="f_ini_a" name="f_ini_a" onchange="$(this).verificarFecha(event, 'ini', '0');" style="font-size: 12px"><!--agregar campo llamado cargo_politica_ini-->
                        <option value="">Año</option>
<?php
    $f_r = explode('-', $dataform['cargo_politica_ini']);
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
                    <select id="f_ini_m" name="f_ini_m" onchange="$(this).verificarFecha(event, 'ini', '0');" style="font-size: 12px">
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
                    <select id="f_ini_d" name="f_ini_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px">
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
                    Fin
                    <select id="f_fin_a" name="f_fin_a" onchange="$(this).verificarFecha(event, 'fin', '0');" style="font-size: 12px"><!--agregar campo llamado cargo_politica_fin-->
                        <option value="">Año</option>
<?php
    $f_r = explode('-', $dataform['cargo_politica_fin']);
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
                    <select id="f_fin_m" name="f_fin_m" onchange="$(this).verificarFecha(event, 'fin', '0');" style="font-size: 12px">
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
                    <select id="f_fin_d" name="f_fin_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px">
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
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['expuesta_publica']?>"><!--agregar campo llamado expuesta_publica-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['expuesta_publica'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['expuesta_publica'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['expuesta_publica'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Nombre: 
                    <input type="text" id="publica_nombre" name="publica_nombre" style="width: 100px" readonly value="<?=$dataform['publica_nombre']?>" data-oldvalue="<?=$dataform['publica_nombre']?>"><!--agregar campo llamado publica_nombre-->
                    Cargo: 
                    <input type="text" id="publica_cargo" name="publica_cargo" style="width: 100px" readonly value="<?=$dataform['publica_cargo']?>" data-oldvalue="<?=$dataform['publica_cargo']?>"><!--agregar campo llamado publica_cargo-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Representante internacional?</td>
                <td>
                    <select id="repre_internacional" name="repre_internacional" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['repre_internacional']?>"><!--agregar campo llamado repre_internacional-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['repre_internacional'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['repre_internacional'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['repre_internacional'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Indique: 
                    <input type="text" id="internacional_indique" name="internacional_indique" style="width: 180px" readonly value="<?=$dataform['internacional_indique']?>" data-oldvalue="<?=$dataform['internacional_indique']?>"><!--agregar campo llamado internacional_indique-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tributarias en otro pais?</td>
                <td>
                    <select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tributarias_otro_pais']?>"><!--agregar campo llamado tributarias_otro_pais-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['tributarias_otro_pais'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['tributarias_otro_pais'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['tributarias_otro_pais'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Cuales?: 
                    <input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" readonly value="<?=$dataform['tributarias_paises']?>" data-oldvalue="<?=$dataform['tributarias_paises']?>"><!--agregar campo llamado tributarias_paises-->
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table>
            <tr>
                <td colspan="2" align="center"><strong>2. ACTIVIDAD ECON&Oacute;MICA</strong></td>
            </tr>
<?php
    if($type_person == "1"){
?>
            <tr>
                <td colspan="2">PERSONA NATURAL</td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Actividad economica:</td>
                <td>
                    <select id="tipoactividad" name="tipoactividad" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipoactividad']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($actEconomicas as $actEconomica) {
            $slect = '';
            if($dataform['tipoactividad'] == $actEconomica['id'])
                $slect = ' selected';
?>
                        <option value="<?=$actEconomica['id']?>"<?=$slect?>><?=$actEconomica['description']?></option>
<?php
        }
?>
                    </select>
                    CIIU(codigo):
                    <select id="ciiu" name="ciiu" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['ciiu']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($ciius as $ciiu) {
            $slect = '';
            if($dataform['ciiu'] == $ciiu['codigo'])
                $slect = ' selected';
?>
                        <option value="<?=$ciiu['codigo']?>"<?=$slect?>><?=$ciiu['descripcion']?></option>
<?php
        }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Ocupacion / Profesion</td>
                <td>
                    <select id="profesion" name="profesion" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['profesion']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($profesiones as $profesion) {
            $slect = '';
            if($dataform['profesion'] == $profesion['id'])
                $slect = ' selected';
?>
                        <option value="<?=$profesion['id']?>"<?=$slect?>><?=$profesion['description']?></option>
<?php
        }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Cargo:</td>
                <td><input type="text" id="cargo" name="cargo" style="width: 260px" value="<?=$dataform['cargo']?>" data-oldvalue="<?=$dataform['cargo']?>"></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Actividad secundaria:</td>
                <td>
                    <input type="text" id="actividadeconomicaempresa" name="actividadeconomicaempresa" style="width: 130px; margin-right: 15px" value="<?=$dataform['actividadeconomicaempresa']?>" data-oldvalue="<?=$dataform['actividadeconomicaempresa']?>">
                    CIIU:
                    <select id="ciiu_otro" name="ciiu_otro" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['ciiu_otro']?>"><!--agregar campo llamado ciiu_otro-->
                        <option value="">Seleccione...</option>
<?php
        foreach ($ciius as $ciiu) {
            $slect = '';
            if($dataform['ciiu_otro'] == $ciiu['codigo'])
                $slect = ' selected';
?>
                        <option value="<?=$ciiu['codigo']?>"<?=$slect?>><?=$ciiu['descripcion']?></option>
<?php
        }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Direccion:</td>
                <td>
                    <input type="text" id="direccionoficinappal" name="direccionoficinappal" style="width: 180px; margin-right: 15px" value="<?=$dataform['direccionoficinappal']?>" data-oldvalue="<?=$dataform['direccionoficinappal']?>">
                    Telefono:
                    <input type="text" id="telefonoficinappal" name="telefonoficinappal" style="width: 100px" value="<?=$dataform['telefonoficinappal']?>" data-oldvalue="<?=$dataform['telefonoficinappal']?>"><!--agregar campo llamado telefonoficinappal-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo de comercio:</td>
                <td><input type="text" id="detalletipoactividad" name="detalletipoactividad" style="width: 220px" value="<?=$dataform['detalletipoactividad']?>" data-oldvalue="<?=$dataform['detalletipoactividad']?>"></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Ingresos mensuales:</td>
                <td>
                    <select id="ingresosmensuales" name="ingresosmensuales" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['ingresosmensuales']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($ingresos as $ingreso) {
            $slect = '';
            if($dataform['ingresosmensuales'] == $ingreso['id'])
                $slect = ' selected';
?>
                        <option value="<?=$ingreso['id']?>"<?=$slect?>><?=$ingreso['description']?></option>
<?php
        }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Activos:</td>
                <td>
                    <input type="text" id="totalactivos" name="totalactivos" style="width: 100px; margin-right: 20px" value="<?=$dataform['totalactivos']?>" data-oldvalue="<?=$dataform['totalactivos']?>">
                    Pasivos:
                    <input type="text" id="totalpasivos" name="totalpasivos" style="width: 100px" value="<?=$dataform['totalpasivos']?>" data-oldvalue="<?=$dataform['totalpasivos']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Egresos mensuales:</td>
                <td>
                    <select id="egresosmensuales" name="egresosmensuales" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['egresosmensuales']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($egresos as $egreso) {
            $slect = '';
            if($dataform['egresosmensuales'] == $egreso['id'])
                $slect = ' selected';
?>
                        <option value="<?=$egreso['id']?>"<?=$slect?>><?=$egreso['description']?></option>
<?php
        }
?>
                    </select>
                    Patrimonio:
                    <input type="text" id="patrimonio" name="patrimonio" style="width: 100px" value="<?=$dataform['patrimonio']?>" data-oldvalue="<?=$dataform['patrimonio']?>"><!--agregar campo llamado patrimonio-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Otros ingresos:</td>
                <td>
                    <select id="otrosingresos" name="otrosingresos" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['otrosingresos']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($ingresos as $ingreso) {
            $slect = '';
            if($dataform['otrosingresos'] == $ingreso['id'])
                $slect = ' selected';
?>
                        <option value="<?=$ingreso['id']?>"<?=$slect?>><?=$ingreso['description']?></option>
<?php
        }
?>
                        <option value="13"<?=(($dataform['otrosingresos'] == "13") ? "selected" : "")?>>SD</option>
                    </select>
                    Concepto otros ingresos:
                    <input type="text" id="conceptosotrosingresos" name="conceptosotrosingresos" style="width: 150px" value="<?=$dataform['conceptosotrosingresos']?>" data-oldvalue="<?=$dataform['conceptosotrosingresos']?>">
                </td>
            </tr>
<?php
    }elseif($type_person == "2"){
?>
            <tr>
                <td colspan="2">PERSONA JUR&Iacute;DICA</td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nombre o Razon social:</td>
                <td><input type="text" id="razonsocial" name="razonsocial" style="width: 280px" value="<?=$dataform['razonsocial']?>" data-oldvalue="<?=$dataform['razonsocial']?>"></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">NIT:</td>
                <td>
                    <input type="text" id="nit" name="nit" style="width: 130px; margin-right: 10px" onBlur="ocultarCampoNit();" value="<?=$dataform['nit']?>" data-oldvalue="<?=$dataform['nit']?>" readonly>
                    DIV:
                    <input type="text" id="digitochequeo" name="digitochequeo" style="width: 80px; margin-left: 10px" value="<?=$dataform['digitochequeo']?>" data-oldvalue="<?=$dataform['digitochequeo']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo de empresa</td>
                <td>
                    <select id="tipoempresajur" name="tipoempresajur" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipoempresajur']?>"><!--agregar campo llamado tipoempresajur-->
                        <option value="">Seleccione...</option>
<?php
        foreach ($tipoempresas as $tipoempresa) {
            $slect = '';
            if($dataform['tipoempresajur'] == $tipoempresa['id'])
                $slect = ' selected';
?>
                        <option value="<?=$tipoempresa['id']?>"<?=$slect?>><?=$tipoempresa['description']?></option>
<?php
        }
?>
                    </select>
                    Otra: 
                    <input type="text" id="tipoempresajur_otra" name="tipoempresajur_otra" style="width: 130px; margin-left: 10px" readonly value="<?=$dataform['tipoempresajur_otra']?>" data-oldvalue="<?=$dataform['tipoempresajur_otra']?>"><!--agregar campo llamado tipoempresajur_otra-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Actividad economica:</td>
                <td>
                    <input type="text" id="detalleactividadeconomicappal" name="detalleactividadeconomicappal" style="width: 180px; margin-right: 10px" value="<?=$dataform['detalleactividadeconomicappal']?>" data-oldvalue="<?=$dataform['detalleactividadeconomicappal']?>">
                    CIIU(codigo):
                    <select id="ciiu" name="ciiu" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['ciiu']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($ciius as $ciiu) {
            $slect = '';
            if($dataform['ciiu'] == $ciiu['codigo'])
                $slect = ' selected';
?>
                        <option value="<?=$ciiu['codigo']?>"<?=$slect?>><?=$ciiu['descripcion']?></option>
<?php
        }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Direccion oficina principal:</td>
                <td><input type="text" id="direccionoficinappal" name="direccionoficinappal" style="width: 240px" value="<?=$dataform['direccionoficinappal']?>" data-oldvalue="<?=$dataform['direccionoficinappal']?>"></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Ciudad / Departamento:</td>
                <td>
                    <select id="ciudadoficina" name="ciudadoficina" style="font-size: 12px" data-oldvalue="<?=$dataform['ciudadoficina']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($daneCiudades as $ciudad) {
            $slect = '';
            if($dataform['ciudadoficina'] == $ciudad['id'])
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
                <td style="width: 100px;display: table-cell;">Telefono:</td>
                <td>
                    <input type="text" id="telefonoficina" name="telefonoficina" style="width: 100px; margin-right: 10px" onblur="$(this).checkTamanoTele(7);" maxlength="7" value="<?=$dataform['telefonoficina']?>" data-oldvalue="<?=$dataform['telefonoficina']?>">
                    E-mail:
                    <input type="text" id="correoelectronico_otro" name="correoelectronico_otro" style="width: 230px" value="<?=$dataform['correoelectronico_otro']?>" data-oldvalue="<?=$dataform['correoelectronico_otro']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Celular:</td>
                <td>
                    <input type="text" id="celularoficina" name="celularoficina" style="width: 100px; margin-right: 10px" onblur="$(this).checkTamanoTele(10);" maxlength="10" value="<?=$dataform['celularoficina']?>" data-oldvalue="<?=$dataform['celularoficina']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Direccion sucursal:</td>
                <td><input type="text" id="direccionsucursal" name="direccionsucursal" style="width: 240px" value="<?=$dataform['direccionsucursal']?>" data-oldvalue="<?=$dataform['direccionsucursal']?>"></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Ingresos mensuales:</td>
                <td>
                    <select id="ingresosmensualesemp" name="ingresosmensualesemp" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['ingresosmensualesemp']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($ingresos as $ingreso) {
            $slect = '';
            if($dataform['ingresosmensualesemp'] == $ingreso['id'])
                $slect = ' selected';
?>
                        <option value="<?=$ingreso['id']?>"<?=$slect?>><?=$ingreso['description']?></option>
<?php
        }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Activos:</td>
                <td>
                    <input type="text" id="activosemp" name="activosemp" style="width: 100px; margin-right: 20px" value="<?=$dataform['activosemp']?>" data-oldvalue="<?=$dataform['activosemp']?>">
                    Pasivos:
                    <input type="text" id="pasivosemp" name="pasivosemp" style="width: 100px" value="<?=$dataform['pasivosemp']?>" data-oldvalue="<?=$dataform['pasivosemp']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Egresos mensuales:</td>
                <td>
                    <select id="egresosmensualesemp" name="egresosmensualesemp" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['egresosmensualesemp']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($egresos as $egreso) {
            $slect = '';
            if($dataform['egresosmensualesemp'] == $egreso['id'])
                $slect = ' selected';
?>
                        <option value="<?=$egreso['id']?>"<?=$slect?>><?=$egreso['description']?></option>
<?php
        }
?>
                    </select>
                    Patrimonio:
                    <input type="text" id="patrimonio" name="patrimonio" style="width: 100px" value="<?=$dataform['patrimonio']?>" data-oldvalue="<?=$dataform['patrimonio']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Otros ingresos:</td>
                <td>
                    <select id="otrosingresosemp" name="otrosingresosemp" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['otrosingresosemp']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($ingresos as $ingreso) {
            $slect = '';
            if($dataform['otrosingresosemp'] == $ingreso['id'])
                $slect = ' selected';
?>
                        <option value="<?=$ingreso['id']?>"<?=$slect?>><?=$ingreso['description']?></option>
<?php
        }
?>
                        <option value="13">SD</option>
                    </select>
                    Concepto otros ingresos:
                    <input type="text" id="concepto_otrosingresosemp" name="concepto_otrosingresosemp" style="width: 150px" value="<?=$dataform['concepto_otrosingresosemp']?>" data-oldvalue="<?=$dataform['concepto_otrosingresosemp']?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Idenficacion de los accionistas o asociados</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Accionista #1</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo id:</td>
                <td>
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue-a="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($tipoDocumentos as $tipo) {
            $slect = '';
            if($dataform['tipo_id'] == $tipo['id'])
                $slect = ' selected';
?>
                        <option value="<?=$tipo['id']?>"<?=$slect?>><?=$tipo['description']?></option>
<?php
        }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue-a="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue-a="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue-a="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_recursos'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_reconocimiento'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_expuesta'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['declaracion_tributaria'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Accionista #2</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo id:</td>
                <td>
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue-a="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($tipoDocumentos as $tipo) {
            $slect = '';
            if($dataform['tipo_id'] == $tipo['id'])
                $slect = ' selected';
?>
                        <option value="<?=$tipo['id']?>"<?=$slect?>><?=$tipo['description']?></option>
<?php
        }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue-a="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue-a="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue-a="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_recursos'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_reconocimiento'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_expuesta'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['declaracion_tributaria'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Accionista #3</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo id:</td>
                <td>
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue-a="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($tipoDocumentos as $tipo) {
            $slect = '';
            if($dataform['tipo_id'] == $tipo['id'])
                $slect = ' selected';
?>
                        <option value="<?=$tipo['id']?>"<?=$slect?>><?=$tipo['description']?></option>
<?php
        }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue-a="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue-a="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue-a="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_recursos'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_reconocimiento'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_expuesta'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['declaracion_tributaria'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Accionista #4</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo id:</td>
                <td>
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue-a="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($tipoDocumentos as $tipo) {
            $slect = '';
            if($dataform['tipo_id'] == $tipo['id'])
                $slect = ' selected';
?>
                        <option value="<?=$tipo['id']?>"<?=$slect?>><?=$tipo['description']?></option>
<?php
        }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue-a="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue-a="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue-a="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_recursos'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_reconocimiento'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_expuesta'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['declaracion_tributaria'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Accionista #5</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo id:</td>
                <td>
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue-a="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
        foreach ($tipoDocumentos as $tipo) {
            $slect = '';
            if($dataform['tipo_id'] == $tipo['id'])
                $slect = ' selected';
?>
                        <option value="<?=$tipo['id']?>"<?=$slect?>><?=$tipo['description']?></option>
<?php
        }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue-a="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue-a="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue-a="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_recursos'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_reconocimiento'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue-a="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['publico_expuesta'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue-a="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['declaracion_tributaria'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
<?php
    }
?>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table>
            <tr>
                <td colspan="2" align="center"><strong>3. DECLARACI&Oacute;N DE ORIGEN DE LOS BIENES Y/O FONDOS</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Fuente de origen de fondos</td>
                <td>
                    <input type="text" id="origen_fondos" name="origen_fondos" style="width: 160px; margin-right: 10px" value="<?=$dataform['origen_fondos']?>" data-oldvalue="<?=$dataform['origen_fondos']?>"><!--agregar campo llamado origen_fondos-->
                    Pais de procedencia:
                    <input type="text" id="procedencia_fondos" name="procedencia_fondos" style="width: 100px" value="<?=$dataform['procedencia_fondos']?>" data-oldvalue="<?=$dataform['procedencia_fondos']?>"><!--agregar campo llamado procedencia_fondos-->
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table>
            <tr>
                <td colspan="2" align="center"><strong>4. ACTIVIDADES EN OPERACIONES INTERNACIONALES</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Operaciones en moneda extranjera?</td>
                <td>
                    <select id="monedaextranjera" name="monedaextranjera" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['monedaextranjera']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['monedaextranjera'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['monedaextranjera'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['monedaextranjera'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Cual?
                    <select id="tipotransacciones" name="tipotransacciones" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipotransacciones']?>" readonly>
                        <option value="">Seleccione...</option>
<?php
    foreach ($transacciones as $transaccion) {
        $slect = '';
        if($dataform['tipotransacciones'] == $transaccion['id'])
            $slect = ' selected';
?>
                        <option value="<?=$transaccion['id']?>"<?=$slect?>><?=$transaccion['description']?></option>
<?php
    }
?>
                        <option value="">Seleccione...</option>
                    </select>
                    <input type="text" id="tipotransacciones_cual" name="tipotransacciones_cual" style="width: 135px" readonly value="<?=$dataform['tipotransacciones_cual']?>" data-oldvalue="<?=$dataform['tipotransacciones_cual']?>"><!--agregar campo llamado tipotransacciones_cual-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Otras operaciones:</td>
                <td><input type="text" id="otras_operaciones" name="otras_operaciones" style="width: 260px" value="<?=$dataform['otras_operaciones']?>" data-oldvalue="<?=$dataform['otras_operaciones']?>"></td><!--agregar campo llamado otras_operaciones-->
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Productos en el exterior?</td>
                <td>
                    <select id="productos_exterior" name="productos_exterior" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['productos_exterior']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['productos_exterior'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['productos_exterior'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['productos_exterior'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Cuentas moneda extranjera?
                    <select id="cuentas_monedaextranjera" name="cuentas_monedaextranjera" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['cuentas_monedaextranjera']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['cuentas_monedaextranjera'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['cuentas_monedaextranjera'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['cuentas_monedaextranjera'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><strong>Cuentas en moneda extranjera</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#1</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo de producto:</td>
                <td>
                    <input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" readonly value="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>">
                    Identificacion:
                    <input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" readonly value="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Entidad:</td>
                <td>
                    <input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>">
                    Monto:
                    <input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>">
                    Ciudad:
                    <input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Pais:</td>
                <td>
                    <input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>">
                    Moneda:
                    <input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#2</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo de producto:</td>
                <td>
                    <input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" readonly value="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>">
                    Identificacion:
                    <input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" readonly value="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Entidad:</td>
                <td>
                    <input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>">
                    Monto:
                    <input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>">
                    Ciudad:
                    <input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Pais:</td>
                <td>
                    <input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>">
                    Moneda:
                    <input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#3</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo de producto:</td>
                <td>
                    <input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" readonly value="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>">
                    Identificacion:
                    <input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" readonly value="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Entidad:</td>
                <td>
                    <input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>">
                    Monto:
                    <input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>">
                    Ciudad:
                    <input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Pais:</td>
                <td>
                    <input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>">
                    Moneda:
                    <input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" readonly value="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>" data-oldvalue-p="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>">
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table>
            <tr>
                <td colspan="2" align="center"><strong>5. INFORMACION SOBRE RECLAMACIONES EN SEGUROS</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Reclamaciones o indemnizaciones?</td>
                <td style="width: 400px;display: table-cell;">
                    <select id="reclamaciones" name="reclamaciones" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['reclamaciones']?>"><!--agregar campo llamado reclamaciones-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['reclamaciones'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['reclamaciones'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['reclamaciones'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#1</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Año:</td>
                <td>
                    <input type="text" id="rec_ano[]" name="rec_ano[]" style="width: 50px; margin-right: 5px" readonly value="<?=(isset($dataform['rec_ano']) && !empty($dataform['rec_ano']) ? $dataform['rec_ano'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_ano']) && !empty($dataform['rec_ano']) ? $dataform['rec_ano'] : '')?>">
                    Ramo:
                    <input type="text" id="rec_ramo[]" name="rec_ramo[]" style="width: 220px; margin-right: 5px" readonly value="<?=(isset($dataform['rec_ramo']) && !empty($dataform['rec_ramo']) ? $dataform['rec_ramo'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_ramo']) && !empty($dataform['rec_ramo']) ? $dataform['rec_ramo'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Compañia:</td>
                <td>
                    <input type="text" id="rec_compania[]" name="rec_compania[]" style="width: 150px; margin-right: 8px" readonly value="<?=(isset($dataform['rec_compania']) && !empty($dataform['rec_compania']) ? $dataform['rec_compania'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_compania']) && !empty($dataform['rec_compania']) ? $dataform['rec_compania'] : '')?>">
                    Valor:
                    <input type="text" id="rec_valor[]" name="rec_valor[]" style="width: 120px; margin-right: 5px" readonly value="<?=(isset($dataform['rec_valor']) && !empty($dataform['rec_valor']) ? $dataform['rec_valor'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_valor']) && !empty($dataform['rec_valor']) ? $dataform['rec_valor'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Resultado:</td>
                <td>
                    <input type="text" id="rec_resultado[]" name="rec_resultado[]" style="width: 150px" readonly value="<?=(isset($dataform['rec_resultado']) && !empty($dataform['rec_resultado']) ? $dataform['rec_resultado'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_resultado']) && !empty($dataform['rec_resultado']) ? $dataform['rec_resultado'] : '')?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#2</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Año:</td>
                <td>
                    <input type="text" id="rec_ano[]" name="rec_ano[]" style="width: 50px; margin-right: 5px" readonly value="<?=(isset($dataform['rec_ano']) && !empty($dataform['rec_ano']) ? $dataform['rec_ano'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_ano']) && !empty($dataform['rec_ano']) ? $dataform['rec_ano'] : '')?>">
                    Ramo:
                    <input type="text" id="rec_ramo[]" name="rec_ramo[]" style="width: 220px; margin-right: 5px" readonly value="<?=(isset($dataform['rec_ramo']) && !empty($dataform['rec_ramo']) ? $dataform['rec_ramo'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_ramo']) && !empty($dataform['rec_ramo']) ? $dataform['rec_ramo'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Compañia:</td>
                <td>
                    <input type="text" id="rec_compania[]" name="rec_compania[]" style="width: 150px; margin-right: 8px" readonly value="<?=(isset($dataform['rec_compania']) && !empty($dataform['rec_compania']) ? $dataform['rec_compania'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_compania']) && !empty($dataform['rec_compania']) ? $dataform['rec_compania'] : '')?>">
                    Valor:
                    <input type="text" id="rec_valor[]" name="rec_valor[]" style="width: 120px; margin-right: 5px" readonly value="<?=(isset($dataform['rec_valor']) && !empty($dataform['rec_valor']) ? $dataform['rec_valor'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_valor']) && !empty($dataform['rec_valor']) ? $dataform['rec_valor'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Resultado:</td>
                <td>
                    <input type="text" id="rec_resultado[]" name="rec_resultado[]" style="width: 150px" readonly value="<?=(isset($dataform['rec_resultado']) && !empty($dataform['rec_resultado']) ? $dataform['rec_resultado'] : '')?>" data-oldvalue-r="<?=(isset($dataform['rec_resultado']) && !empty($dataform['rec_resultado']) ? $dataform['rec_resultado'] : '')?>">
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table>
            <tr>
                <td colspan="2" align="center"><strong>8. FRIMA Y HUELLA</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Firma:</td>
                <td style="width: 300px">
                    <select id="firma" name="firma" style="font-size: 12px; margin-right: 20px" data-oldvalue="<?=$dataform['firma']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['firma'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['firma'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['firma'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                    Huella:
                    <select id="huella" name="huella" style="font-size: 12px; margin-left: 5px" data-oldvalue="<?=$dataform['huella']?>">
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
            <tr>
                <td colspan="2" align="center"><strong>9. INFORMACI&Oacute;N ENTREVISTA</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Lugar entrevista:</td>
                <td>
                    <input type="text" id="lugarentrevista" name="lugarentrevista" style="width: 180px; margin-right: 10px" value="<?=$dataform['lugarentrevista']?>">
                    Resultado:
                    <select id="resultadoentrevista" name="resultadoentrevista" style="font-size: 12px" data-oldvalue="<?=$dataform['resultadoentrevista']?>">
                        <option value="">Seleccion...</option>
                        <option value="APROBADO"<?=(($dataform['resultadoentrevista'] == "APROBADO") ? "selected" : "")?>>Aprobado</option>
                        <option value="RECHAZADO"<?=(($dataform['resultadoentrevista'] == "RECHAZADO") ? "selected" : "")?>>Rechazado</option>
                    </select>
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
        if($h_h[1] == $hor)
            $select = 'selected';
?>
                        <option value="<?=$hor?>"<?=$select?>><?=$hor?></option>
<?php
    }
?>
                    </select>
                    <select id="tipohoraentrevista" name="tipohoraentrevista" style="font-size: 12px" data-oldvalue="<?=$dataform['tipohoraentrevista']?>">
                        <option value="">Horario</option>
                        <option value="AM"<?=(($dataform['tipohoraentrevista'] == "AM") ? "selected" : "")?>>A.M.</option>
                        <option value="PM"<?=(($dataform['tipohoraentrevista'] == "PM") ? "selected" : "")?>>P.M.</option>
                    </select>
                    <input type="hidden" id="horaentrevista" name="horaentrevista" value="<?=$dataform['horaentrevista']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Observaciones:</td>
                <td>
                    <textarea cols="40" rows="4" id="observacionesentrevista" name="observacionesentrevista"></textarea>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nombre Intermediario / Asesor / Entrevistador:</td>
                <td>
                    <input type="text" id="nombreintermediario" name="nombreintermediario" style="width: 190px; margin-right: 10px" value="<?=$dataform['nombreintermediario']?>" data-oldvalue="<?=$dataform['nombreintermediario']?>">
                    Clave:
                    <input type="text" id="clave_inter" name="clave_inter" style="width: 100px" value="<?=$dataform['clave_inter']?>" data-oldvalue="<?=$dataform['clave_inter']?>"><!--agregar campo llamado clave_inter-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Firma entrevistador:</td>
                <td>
                    <select id="firma_entrevista" name="firma_entrevista" style="font-size: 12px" data-oldvalue="<?=$dataform['firma_entrevista']?>"><!--agregar campo llamado firma_entrevista-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['firma_entrevista'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['firma_entrevista'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['firma_entrevista'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table>
            <tr>
                <td colspan="2" align="center"><strong>10. CONFIRMACI&Oacute;N DE LA INFORMACI&Oacute;N</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Ciudad:</td>
                <td>
                    <select id="verificacion_ciudad" name="verificacion_ciudad" style="font-size: 12px" data-oldvalue="<?=$dataform['verificacion_ciudad']?>"><!--agregar campo llamado verificacion_ciudad-->
                        <option value="">Seleccione...</option>
<?php
    foreach ($daneCiudades as $ciudad) {
        $slect = '';
        if($dataform['verificacion_ciudad'] == $ciudad['id'])
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
                <td style="width: 80px">Fecha de verificacion:</td><!--agregar campo llamado verificacion_fecha-->
                <td>
                    <input type="hidden" id="verificacion_fecha" name="verificacion_fecha" value="<?=$dataform['verificacion_fecha']?>">
                    <select id="f_ver_a" name="f_ver_a" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px">
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
                    <select id="f_ver_m" name="f_ver_m" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px">
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
                    <select id="f_ver_d" name="f_ver_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px">
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
                    <select id="h_ver_h" name="h_ver_h" style="font-size: 12px"><!--agregar campo llamado verificacion_hora-->
                        <option value="">Hora</option>
<?php
    if($dataform['verificacion_hora'] == '00:00:00')
        $h_h = array("", "", "");
    else
        $h_h = explode(':', date('h:i:A', strtotime($dataform['verificacion_hora'])));

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
                    <select id="h_ver_m" name="h_ver_m" style="font-size: 12px">
                        <option value="">Minuto</option>
<?php
    for ($i=0; $i <= 59; $i++) { 
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
                    <select id="h_ver_z" name="h_ver_z" style="font-size: 12px">
                        <option value="">Horario</option>
                        <option value="AM"<?=(($h_h[2] == "AM") ? "selected" : "")?>>A.M.</option>
                        <option value="PM"<?=(($h_h[2] == "PM") ? "selected" : "")?>>P.M.</option>
                    </select>
                    <input type="hidden" id="verificacion_hora" name="verificacion_hora" value="<?=$dataform['verificacion_hora']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Nombre y cargo de verificador:</td>
                <td>
                    <input type="text" id="verificacion_nombre" name="verificacion_nombre" style="width: 230px; margin-right: 5px" value="<?=$dataform['verificacion_nombre']?>" data-oldvalue="<?=$dataform['verificacion_nombre']?>"><!--agregar campo llamado verificacion_nombre-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Observaciones:</td>
                <td>
                    <textarea cols="40" rows="4" id="verificacion_observacion" name="verificacion_observacion" value="<?=$dataform['verificacion_observacion']?>" data-oldvalue="<?=$dataform['verificacion_observacion']?>"><?=$dataform['verificacion_observacion']?></textarea><!--agregar campo llamado verificacion_observacion-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Firma:</td>
                <td>
                    <select id="verificacion_firma" name="verificacion_firma" style="font-size: 12px" data-oldvalue="<?=$dataform['verificacion_firma']?>"><!--agregar campo llamado verificacion_firma-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['verificacion_firma'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['verificacion_firma'] == "0") ? "selected" : "")?>>NO</option>
                        <option value="2"<?=(($dataform['verificacion_firma'] == "2") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td align="center"><input type="submit" value="Crear formulario"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
</form>
<script type="text/javascript">
$(document).ready(function(){
    //console.log("aca");
    $('select[name="clasecliente"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '10'){
            $('input[name="cual_clasecliente"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="cual_clasecliente"]').val('');
            $('input[name="cual_clasecliente"]').attr('readonly', true);
        }
    });
    $('select[name="tipoempresaemp"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '5'){
            $('input[name="tipoempresaemp_cual"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="tipoempresaemp_cual"]').val('');
            $('input[name="tipoempresaemp_cual"]').attr('readonly', true);
        }
    });
    $('select[name="reconocimiento_publico"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="reconocimiento_cual"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="reconocimiento_cual"]').val('');
            $('input[name="reconocimiento_cual"]').attr('readonly', true);
        }
    });
    $('select[name="expuesta_politica"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="cargo_politica"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="cargo_politica"]').val('');
            $('input[name="cargo_politica"]').attr('readonly', true);
        }
    });
    $('select[name="expuesta_publica"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="publica_nombre"]').removeAttr('readonly');
            $('input[name="publica_cargo"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="publica_nombre"]').val('');
            $('input[name="publica_nombre"]').attr('readonly', true);
            $('input[name="publica_cargo"]').val('');
            $('input[name="publica_cargo"]').attr('readonly', true);
        }
    });
    $('select[name="repre_internacional"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="internacional_indique"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="internacional_indique"]').val('');
            $('input[name="internacional_indique"]').attr('readonly', true);
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
    $('select[name="tipoempresajur"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '5'){
            $('input[name="tipoempresajur_otra"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name="tipoempresajur_otra"]').val('');
            $('input[name="tipoempresajur_otra"]').attr('readonly', true);
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
    $('select[name="cuentas_monedaextranjera"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name^="producto_tipo"]').removeAttr('readonly');
            $('input[name^="producto_identificacion"]').removeAttr('readonly');
            $('input[name^="producto_entidad"]').removeAttr('readonly');
            $('input[name^="producto_monto"]').removeAttr('readonly');
            $('input[name^="producto_ciudad"]').removeAttr('readonly');
            $('input[name^="producto_pais"]').removeAttr('readonly');
            $('input[name^="producto_moneda"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name^="producto_tipo"]').val('');
            $('input[name^="producto_tipo"]').attr('readonly', true);
            $('input[name^="producto_identificacion"]').val('');
            $('input[name^="producto_identificacion"]').attr('readonly', true);
            $('input[name^="producto_entidad"]').val('');
            $('input[name^="producto_entidad"]').attr('readonly', true);
            $('input[name^="producto_monto"]').val('');
            $('input[name^="producto_monto"]').attr('readonly', true);
            $('input[name^="producto_ciudad"]').val('');
            $('input[name^="producto_ciudad"]').attr('readonly', true);
            $('input[name^="producto_pais"]').val('');
            $('input[name^="producto_pais"]').attr('readonly', true);
            $('input[name^="producto_moneda"]').val('');
            $('input[name^="producto_moneda"]').attr('readonly', true);
        }
    });
    $('select[name="reclamaciones"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){//"input[name^=load_file]"
            $('input[name^="rec_ano"]').removeAttr('readonly');
            $('input[name^="rec_ramo"]').removeAttr('readonly');
            $('input[name^="rec_compania"]').removeAttr('readonly');
            $('input[name^="rec_valor"]').removeAttr('readonly');
            $('input[name^="rec_resultado"]').removeAttr('readonly');
        }else if($(this).val() != ''){
            $('input[name^="rec_ano"]').val('');
            $('input[name^="rec_ano"]').attr('readonly', true);
            $('input[name^="rec_ramo"]').val('');
            $('input[name^="rec_ramo"]').attr('readonly', true);
            $('input[name^="rec_compania"]').val('');
            $('input[name^="rec_compania"]').attr('readonly', true);
            $('input[name^="rec_valor"]').val('');
            $('input[name^="rec_valor"]').attr('readonly', true);
            $('input[name^="rec_resultado"]').val('');
            $('input[name^="rec_resultado"]').attr('readonly', true);
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

        if($(this).find('select[name="f_nac_a"]').val() != '' && $(this).find('select[name="f_nac_m"]').val() != '' && $(this).find('select[name="f_nac_d"]').val() != ''){
            var fechanacimiento = $(this).find('select[name="f_nac_a"]').val() + '-' + $(this).find('select[name="f_nac_m"]').val() + '-' + $(this).find('select[name="f_nac_d"]').val();
            if($(this).find('input[name="fechanacimiento"]').val() != fechanacimiento)
                datos['fechanacimiento'] = fechanacimiento;
        }else{
            alert('La fecha de nacimiento no puede estar vacia o incompleta.');
            return false;
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

        if($(this).find('select[name="f_ver_a"]').val() != '' && $(this).find('select[name="f_ver_m"]').val() != '' && $(this).find('select[name="f_ver_d"]').val() != ''){
            var verificacion_fecha = $(this).find('select[name="f_ver_a"]').val() + '-' + $(this).find('select[name="f_ver_m"]').val() + '-' + $(this).find('select[name="f_ver_d"]').val();
            if($(this).find('input[name="verificacion_fecha"]').val() != verificacion_fecha)
                datos['verificacion_fecha'] = verificacion_fecha;
        }else{
            alert('La fecha de verificacion no puede estar vacia o incompleta.');
            return false;
        }

        if($(this).find('select[name="h_ent_h"]').val() != '' && $(this).find('select[name="h_ent_m"]').val() != ''){
            var horaentrevista = $(this).find('select[name="h_ent_h"]').val() + ':' + $(this).find('select[name="h_ent_m"]').val();
            if(horaentrevista != $(this).find('input[name="horaentrevista"]').val())
                datos['horaentrevista'] = horaentrevista;
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
        //console.log(datos);
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