<?php
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'client.class.php';
$dataform = Client::dataMatriz($_GET['id']);
$type_person = $_GET['type'];
?>
<html>
<head>
    <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/calendar.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery.qtip-1.0.0-rc3.min.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/lib/js/tools.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/lib/js/cal.js"></script>
    <style type="text/css">
        * {
            font-size: 10px;

        }
        body {
            font-family: Verdana, Helvetica, sans-serif;
        }
        label {
            font-size: 11px;
            font-weight: bold;
        }
        table#primera tr td:first-child, table#table_parte9 tr td:first-child, table#table_parte10 tr td:first-child {
            width: 150px;
            text-align: right;
        }
        table#table_parte3 tr td:first-child {
            width: 160px;
            text-align: right;
        }
        table#table_parte2 tr td:first-child {
            width: 210px;
            text-align: right;
        }
        table#table_parte4 tr td:first-child {
            width: 230px;
            text-align: right;
        }
        table#table_parte5 tr td:first-child, table#table_parte7 tr td:first-child {
            width: 110px;
            text-align: right;
        }
        table#primera tr td:last-child, 
        table#table_parte2 tr td:last-child, 
        table#table_parte3 tr td:last-child, 
        table#table_parte4 tr td:last-child, 
        table#table_parte5 tr td:last-child, 
        table#table_parte7 tr td:last-child, 
        table#table_parte9 tr td:last-child, 
        table#table_parte10 tr td:last-child {
            padding-left: 5px;
        }
    </style>
</head>
<body>
    <!--
<?//=json_encode($dataform);?>
-->
<?php
$daneCiudades = General::getCiudadesDanes();
$sucursales = General::getSucursalesLista();
$clasesVinculacion = General::getclaseVinculacion();
$tipoDocumentos = General::getTipoDocumentoID();
$tipoempresas = General::getTipoEmpresaID();
$actEconomicas = General::getActividadesEconomicas();
$ciius = General::getCiiuId();
$profesiones = General::getProfesionesID();
$ingresos = General::getIngresosMensualesID();
$egresos = General::getEgresosMensualesID();
$transacciones = General::getTipoTransaccionesID();
$paises = General::getPaisesID();
$areas = General::getAreasID();
$funcionarios = General::getOfficials();
?>
<form method="POST" action="saveEditNew.php">
<input type="hidden" name="id_form" id="id_form" value="<?php echo $_GET['id_form']?>">
<input type="hidden" name="formulario" id="formulario" value="15">
<input type="hidden" name="type_person" id="type_person" value="<?=$type_person?>">
<input type="hidden" name="id_data" id="id_data" value="<?=$dataform['id']?>">
<table>
    <tr>
        <td>
            <table id="primera">
                <tr>
                    <td><label>Fecha de radicado:</label></td><!--fecharadicado-->
                    <td><?=$dataform['fecharadicado']?></td>
                </tr>
                <tr>
                    <td><label>Fecha de diligenciamiento:</label></td><!--fechasolicitud-->
                    <td><?=$dataform['fechasolicitud']?></td>
                </tr>
                <tr>
                    <td><label>Ciudad:</label></td>
                    <td>
                        <select id="ciudad" name="ciudad" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
    /*agregar campo llamado ciudad*/
                        foreach ($daneCiudades as $ciudad) {
                            $slect = '';
                            if($dataform['ciudad'] == $ciudad['id'])
                                $slect = ' selected';
                            echo '<option value="'.$ciudad['id'].'"'.$slect.'>'.$ciudad['ciudad'].'</option>';
                        }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Sucursal:</label></td>
                    <td>
                        <select id="sucursal" name="sucursal" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($sucursales as $sucursal) {
                            $slect = '';
                            if($dataform['sucursal'] == $sucursal['id'])
                                $slect = ' selected';
                            echo '<option value="'.$sucursal['id'].'"'.$slect.'>'.$sucursal['sucursal'].'</option>';
                        }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Area:</label></td>
                    <td>
                        <select id="area" name="area" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($areas as $area) {
                            $slect = '';
                            if($dataform['area'] == $area['id'])
                                $slect = ' selected';
                            echo '<option value="'.$area['id'].'"'.$slect.'>'.$area['description'].'</option>';
                        }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Funcionario:</label></td>
                    <td>
                        <select id="id_official" name="id_official" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($funcionarios as $funcionario) {
                            $slect = '';
                            if(strtoupper(trim($dataform['id_official'])) == strtoupper(trim($funcionario['name'])))
                                $slect = ' selected';
                            echo '<option value="'.strtoupper(trim($funcionario['name'])).'"'.$slect.'>'.strtoupper(trim($funcionario['name'])).'</option>';
                        }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Tipo de solicitud:</label></td>
                    <td><?=$dataform['tipo_solicitud']?> </td>
                </tr>
                <tr>
                    <td><label>Clase vinculacion:</label></td>
                    <td>
                        <select id="clasecliente" name="clasecliente" style="font-size: 12px; margin-right: 5px">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($clasesVinculacion as $clase) {
                            $slect = '';
                            if($dataform['clasecliente'] == $clase['id'])
                                $slect = ' selected';
                            echo '<option value="'.$clase['id'].'"'.$slect.'>'.$clase['description'].'</option>';
                        }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Cual?:</label></td>
                    <td><?=$dataform['cual_clasecliente']?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
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
                    <td colspan="2"></td>
                </tr>
            </table>
            <table id="table_parte2">
                <tr>
                    <td><label>Primer apellido:</label></td>
                    <td><?=$dataform['primerapellido']?></td>
                </tr>
                <tr>
                    <td><label>Segundo apellido:</label></td>
                    <td><?=$dataform['segundoapellido']?></td>
                </tr>
                <tr>
                    <td><label>Nombres:</label></td>
                    <td><?=$dataform['nombres']?></td>
                </tr>
                <tr>
                    <td><label>Tipo documento:</label></td>
                    <td>
                        <select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($tipoDocumentos as $tipo) {
                            $slect = '';
                            if($dataform['tipodocumento'] == $tipo['id'])
                                $slect = ' selected';
                            echo '<option value="'.$tipo['id'].'"'.$slect.'>'.$tipo['description'].'</option>';
                        }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Numero identificacion:&nbsp;:</label></td>
                    <td><?=$dataform['documento']?></td>
                </tr>
                <tr>
                    <td><label>Fecha expedicion:</label></td><!--fechaexpedicion-->
                    <td><?=$dataform['fechaexpedicion']?></td>
                </tr>
                <tr>
                    <td><label>Lugar expedicion:</label></td>
                    <td>
                        <select id="lugarexpedicion" name="lugarexpedicion" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
                    foreach ($daneCiudades as $ciudad) {
                            $slect = '';
                            if($dataform['lugarexpedicion'] == $ciudad['id'])
                                $slect = ' selected';
                        echo '<option value="'.$ciudad['id'].'"'.$slect.'>'.$ciudad['ciudad'].'</option>';
                    }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Fecha nacimiento:</label></td><!--fechanacimiento-->
                    <td><?=$dataform['fechanacimiento']?></td>
                </tr>
                <tr>
                    <td><label>Lugar nacimiento:</label></td>
                    <td>
                        <select id="lugarnacimiento" name="lugarnacimiento" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
                    foreach ($daneCiudades as $ciudad) {
                            $slect = '';
                            if($dataform['lugarnacimiento'] == $ciudad['id'])
                                $slect = ' selected';
                        echo '<option value="'.$ciudad['id'].'"'.$slect.'>'.$ciudad['ciudad'].'</option>';
                    }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Nacionalidad:</label></td>
                    <td>
                        <select id="paisnacimiento" name="paisnacimiento" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($paises as $pais) {
                            $slect = '';
                            if($dataform['paisnacimiento'] == $pais['id'])
                                $slect = ' selected';
                            echo '<option value="'.$pais['id'].'"'.$slect.'>'.$pais['description'].'</option>';
                        }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Nacionalidad 2:</label></td>
                    <td>
                        <select id="nacionalidad_otra" name="nacionalidad_otra" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($paises as $pais) {
                            $slect = '';
                            if($dataform['nacionalidad_otra'] == $pais['id'])
                                $slect = ' selected';
                            echo '<option value="'.$pais['id'].'"'.$slect.'>'.$pais['description'].'</option>';
                        }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Direccion residencia:</label></td>
                    <td><?=$dataform['direccionresidencia']?></td>
                </tr>
                <tr>
                    <td><label>Ciudad y departamento:</label></td>
                    <td>
                        <select id="ciudadresidencia" name="ciudadresidencia" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
                    foreach ($daneCiudades as $ciudad) {
                            $slect = '';
                            if($dataform['ciudadresidencia'] == $ciudad['id'])
                                $slect = ' selected';
                        echo '<option value="'.$ciudad['id'].'"'.$slect.'>'.$ciudad['ciudad'].'</option>';
                    }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>E-mail:</label></td>
                    <td><?=$dataform['correoelectronico']?></td>
                </tr>
                <tr>
                    <td><label>Telefono:</label></td>
                    <td><?=$dataform['telefonoresidencia']?></td>
                </tr>
                <tr>
                    <td><label>Celular:</label></td>
                    <td><?=$dataform['celular']?></td>
                </tr>
                <tr>
                    <td><label>Empresa donde trabaja:</label></td>
                    <td><?=$dataform['nombreempresa']?></td>
                </tr>
                <tr>
                    <td><label>Direccion oficina:</label></td>
                    <td><?=$dataform['direccionempresa']?></td>
                </tr>
                <tr>
                    <td><label>Telefono oficina:</label></td>
                    <td><?=$dataform['telefonolaboral']?></td>
                </tr>
                <tr>
                    <td><label>Ciudad empresa:</label></td>
                    <td>
                        <select id="ciudadempresa" name="ciudadempresa" style="font-size: 12px">
                            <option value="">Seleccione...</option>
    <?php
                    foreach ($daneCiudades as $ciudad) {
                            $slect = '';
                            if($dataform['ciudadempresa'] == $ciudad['id'])
                                $slect = ' selected';
                        echo '<option value="'.$ciudad['id'].'"'.$slect.'>'.$ciudad['ciudad'].'</option>';
                    }
    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Celular oficina:</label></td>
                    <td><?=$dataform['celularoficinappal']?></td>
                </tr>
                <tr>
                    <td><label>Tipo empresa:</label></td>
                    <td>
                        <select id="tipoempresaemp" name="tipoempresaemp" style="font-size: 12px; margin-right: 5px">
                            <option value="">Seleccione...</option>
<?php
                        foreach ($tipoempresas as $tipoempresa) {
                            $slect = '';
                            if($dataform['tipoempresaemp'] == $tipoempresa['id'])
                                $slect = ' selected';
                            echo '<option value="'.$tipoempresa['id'].'"'.$slect.'>'.$tipoempresa['description'].'</option>';
                        }
?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Cual?:</label></td>
                    <td><?=$dataform['tipoempresaemp_cual']?></td>
                </tr>
                <tr>
                    <td><label>Maneja recursos publicos?:</label></td>
                    <td>
                        <?=($dataform['recursos_publicos'] == "-1") ? "SI" : ($dataform['recursos_publicos'] == "0" ? "NO" : "")?>
                    </td>
                </tr>
                <tr>
                    <td><label>MGrado de poder publico?:</label></td>
                    <td><?=(($dataform['poder_publico'] == "-1") ? "SI" : ($dataform['poder_publico'] == "0" ? "NO" : ""))?></td>
                </tr>
                <tr>
                    <td><label>Reconocimiento publico?:</label></td>
                    <td><?=(($dataform['reconocimiento_publico'] == "-1") ? "SI" : ($dataform['reconocimiento_publico'] == "0" ? "NO" : ""))?></td>
                </tr>
                <tr>
                    <td><label>Indique:</label></td>
                    <td><?=$dataform['reconocimiento_cual']?></td>
                </tr>
                <tr>
                    <td><label>Servidor publico?:</label></td>
                    <td><?=(($dataform['servidor_publico'] == "-1") ? "SI" : ($dataform['servidor_publico'] == "0" ? "NO" : ""))?></td>
                </tr>
                <tr>
                    <td><label>Persona expuesta politicamente?:</label></td>
                    <td>
                        <?=(($dataform['expuesta_politica'] == "-1") ? "SI" : ($dataform['expuesta_politica'] == "0" ? "NO" : ""))?>
                    </td>
                </tr>
                <tr>
                    <td><label>Cargo:</label></td>
                    <td><?=$dataform['cargo_politica']?></td>
                </tr>
                <tr>
                    <td><label>Inicio:</label></td>
                    <td><?=$dataform['cargo_politica_ini']?></td>
                </tr>
                <tr>
                    <td><label>Fin:</label></td>
                    <td><?=$dataform['cargo_politica_fin']?></td>
                </tr>
                <tr>
                    <td><label>Persona expuesta publicamente?:</label></td>
                    <td><?=(($dataform['expuesta_publica'] == "-1") ? "SI" : ($dataform['expuesta_publica'] == "0" ? "NO" : ""))?></td>
                </tr>
                <tr>
                    <td><label>Nombre:</label></td>
                    <td><?=$dataform['publica_nombre']?></td>
                </tr>
                <tr>
                    <td><label>Cargo:</label></td>
                    <td><?=$dataform['publica_cargo']?></td>
                </tr>
                <tr>
                    <td><label>Representante internacional?:</label></td>
                    <td><?=(($dataform['repre_internacional'] == "-1") ? "SI" : ($dataform['repre_internacional'] == "0" ? "NO" : ""))?></td>
                </tr>
                <tr>
                    <td><label>Indique:</label></td>
                    <td><?=$dataform['internacional_indique']?></td>
                </tr>
                <tr>
                    <td><label>Tributarias en otro pais?:</label></td>
                    <td><?=(($dataform['tributarias_otro_pais'] == "-1") ? "SI" : ($dataform['tributarias_otro_pais'] == "0" ? "NO" : ""))?></td>
                </tr>
                <tr>
                    <td><label>Cuales?:</label></td>
                    <td><?=$dataform['tributarias_paises']?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td>
        <table style="width: 100%">
            <tr>
                <td align="center"><strong>2. ACTIVIDAD ECON&Oacute;MICA</strong></td>
            </tr>
        </table>
<?php
if($type_person == "1"){
?>
        <table>
            <tr>
                <td>PERSONA NATURAL</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <table id="table_parte3">
            <tr>
                <td><label>Actividad economica:</label></td>
                <td>
                    <select id="tipoactividad" name="tipoactividad" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($actEconomicas as $actEconomica) {
                        $slect = '';
                        if($dataform['tipoactividad'] == $actEconomica['id'])
                            $slect = ' selected';
                        echo '<option value="'.$actEconomica['id'].'"'.$slect.'>'.$actEconomica['description'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>CIIU(codigo):</label></td>
                <td>
                    <select id="ciiu" name="ciiu" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($ciius as $ciiu) {
                        $slect = '';
                        if($dataform['ciiu'] == $ciiu['codigo'])
                            $slect = ' selected';
                        echo '<option value="'.$ciiu['codigo'].'"'.$slect.'>'.$ciiu['codigo'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Ocupacion / Profesion:</label></td>
                <td>
                    <select id="profesion" name="profesion" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($profesiones as $profesion) {
                        $slect = '';
                        if($dataform['profesion'] == $profesion['id'])
                            $slect = ' selected';
                        echo '<option value="'.$profesion['id'].'"'.$slect.'>'.$profesion['description'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Cargo:</label></td>
                <td><?=$dataform['cargo']?></td>
            </tr>
            <tr>
                <td><label>Actividad secundaria:</label></td>
                <td><?=$dataform['actividadeconomicaempresa']?></td>
            </tr>
            <tr>
                <td><label>CIIU</label></td>
                <td>
                    <select id="ciiu_otro" name="ciiu_otro" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado ciiu_otro-->
                        <option value="">Seleccione...</option>
<?php
                    foreach ($ciius as $ciiu) {
                        $slect = '';
                        if($dataform['ciiu_otro'] == $ciiu['codigo'])
                            $slect = ' selected';
                        echo '<option value="'.$ciiu['codigo'].'"'.$slect.'>'.$ciiu['codigo'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Direccion:</label></td>
                <td><?=$dataform['direccionoficinappal']?></td>
            </tr>
            <tr>
                <td><label>Telefono:</label></td>
                <td><?=$dataform['telefonoficinappal']?></td>
            </tr>
            <tr>
                <td><label>Tipo de comercio:</label></td>
                <td><?=$dataform['detalletipoactividad']?></td>
            </tr>
            <tr>
                <td><label>Ingresos mensuales:</label></td>
                <td>
                    <select id="ingresosmensuales" name="ingresosmensuales" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($ingresos as $ingreso) {
                        $slect = '';
                        if($dataform['ingresosmensuales'] == $ingreso['id'])
                            $slect = ' selected';
                        echo '<option value="'.$ingreso['id'].'"'.$slect.'>'.$ingreso['description'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Activos:</label></td>
                <td><?=$dataform['totalactivos']?></td>
            </tr>
            <tr>
                <td><label>Pasivos:</label></td>
                <td><?=$dataform['totalpasivos']?></td>
            </tr>
            <tr>
                <td><label>Egresos mensuales:</label></td>
                <td>
                    <select id="egresosmensuales" name="egresosmensuales" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($egresos as $egreso) {
                        $slect = '';
                        if($dataform['egresosmensuales'] == $egreso['id'])
                            $slect = ' selected';
                        echo '<option value="'.$egreso['id'].'"'.$slect.'>'.$egreso['description'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Patrimonio:</label></td>
                <td><?=$dataform['patrimonio']?></td>
            </tr>
            <tr>
                <td><label>Otros ingresos:</label></td>
                <td>
                    <select id="otrosingresos" name="otrosingresos" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($ingresos as $ingreso) {
                        $slect = '';
                        if($dataform['otrosingresos'] == $ingreso['id'])
                            $slect = ' selected';
                        echo '<option value="'.$ingreso['id'].'"'.$slect.'>'.$ingreso['description'].'</option>';
                    }
?>
                        <option value="13"<?=(($dataform['otrosingresos'] == "13") ? "selected" : "")?>>SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Concepto otros ingresos:</label></td>
                <td><?=$dataform['conceptosotrosingresos']?></td>
            </tr>
        </table>
<?php
}elseif($type_person == "2"){
?>
        <table>
            <tr>
                <td colspan="2">PERSONA JUR&Iacute;DICA</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <table>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Nombre o Razon social:</label></td>
                <td><?=$dataform['razonsocial']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>NIT:</label></td>
                <td><?=$dataform['nit']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>DIV:</label></td>
                <td><?=$dataform['digitochequeo']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Tipo de empresa:</label></td>
                <td>
                    <select id="tipoempresajur" name="tipoempresajur" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado tipoempresajur-->
                        <option value="">Seleccione...</option>
<?php
                    foreach ($tipoempresas as $tipoempresa) {
                        $slect = '';
                        if($dataform['tipoempresajur'] == $tipoempresa['id'])
                            $slect = ' selected';
                        echo '<option value="'.$tipoempresa['id'].'"'.$slect.'>'.$tipoempresa['description'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Otra:</label></td>
                <td><?=$dataform['tipoempresajur_otra']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Actividad economica:</label></td>
                <td><?=$dataform['detalleactividadeconomicappal']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>CIIU(codigo):</label></td>
                <td>
                    <select id="ciiu" name="ciiu" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($ciius as $ciiu) {
                        $slect = '';
                        if($dataform['ciiu'] == $ciiu['codigo'])
                            $slect = ' selected';
                        echo '<option value="'.$ciiu['codigo'].'"'.$slect.'>'.$ciiu['codigo'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Direccion oficina principal:</label></td>
                <td><?=$dataform['direccionoficinappal']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Ciudad / Departamento:</label></td>
                <td>
                    <select id="ciudadoficina" name="ciudadoficina" style="font-size: 12px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($daneCiudades as $ciudad) {
                        $slect = '';
                        if($dataform['ciudadoficina'] == $ciudad['id'])
                            $slect = ' selected';
                        echo '<option value="'.$ciudad['id'].'"'.$slect.'>'.$ciudad['ciudad'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Telefono:</label></td>
                <td><?=$dataform['telefonoficina']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>E-mail:</label></td>
                <td><?=$dataform['correoelectronico_otro']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Celular:</label></td>
                <td><?=$dataform['celularoficina']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Direccion sucursal:</label></td>
                <td><?=$dataform['direccionsucursal']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Ingresos mensuales:</label></td>
                <td>
                    <select id="ingresosmensualesemp" name="ingresosmensualesemp" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($ingresos as $ingreso) {
                        $slect = '';
                        if($dataform['ingresosmensualesemp'] == $ingreso['id'])
                            $slect = ' selected';
                        echo '<option value="'.$ingreso['id'].'"'.$slect.'>'.$ingreso['description'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Activos:</label></td>
                <td><?=$dataform['activosemp']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Pasivos:</label></td>
                <td><?=$dataform['pasivosemp']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Egresos mensuales:</label></td>
                <td>
                    <select id="egresosmensualesemp" name="egresosmensualesemp" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($egresos as $egreso) {
                        $slect = '';
                        if($dataform['egresosmensualesemp'] == $egreso['id'])
                            $slect = ' selected';
                        echo '<option value="'.$egreso['id'].'"'.$slect.'>'.$egreso['description'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Patrimonio:</label></td>
                <td><?=$dataform['patrimonio']?></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Otros ingresos:</label></td>
                <td>
                    <select id="otrosingresosemp" name="otrosingresosemp" style="font-size: 12px; margin-right: 5px">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($ingresos as $ingreso) {
                        $slect = '';
                        if($dataform['otrosingresosemp'] == $ingreso['id'])
                            $slect = ' selected';
                        echo '<option value="'.$ingreso['id'].'"'.$slect.'>'.$ingreso['description'].'</option>';
                    }
?>
                        <option value="13">SD</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;"><label>Concepto otros ingresos:</label></td>
                <td><?=$dataform['concepto_otrosingresosemp']?></td>
            </tr>
        </table>
<?php
}
?>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td>
        <table style="width: 100%">
            <tr>
                <td colspan="2" align="center"><strong>3. DECLARACI&Oacute;N DE ORIGEN DE LOS BIENES Y/O FONDOS</strong></td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td style="width: 175px; text-align: right;"><label>Fuente de origen de fondos:</label></td>
                <td><?=$dataform['origen_fondos']?></td>
            </tr>
            <tr>
                <td style="width: 175px; text-align: right;"><label>Pais de procedencia:</label></td>
                <td><?=$dataform['procedencia_fondos']?></td>
            </tr>
        </table>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td>
        <table style="width: 100%">
            <tr>
                <td colspan="2" align="center"><strong>4. ACTIVIDADES EN OPERACIONES INTERNACIONALES</strong></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <table id="table_parte4">
            <tr>
                <td><label>Operaciones en moneda extranjera?:</label></td>
                <td><?=(($dataform['monedaextranjera'] == "-1") ? "SI" : ($dataform['monedaextranjera'] == "0" ? "NO" : ""))?></td>
            </tr>
            <tr>
                <td><label>Cual?:</label></td>
                <td>
                    <select id="tipotransacciones" name="tipotransacciones" disabled>
                        <option value="">Seleccione...</option>
<?php
                    foreach ($transacciones as $transaccion) {
                        $slect = '';
                        if($dataform['tipotransacciones'] == $transaccion['id'])
                            $slect = ' selected';
                        echo '<option value="'.$transaccion['id'].'"'.$slect.'>'.$transaccion['description'].'</option>';
                    }
?>
                    </select>
                    <?=$dataform['tipotransacciones_cual']?>
                </td>
            </tr>
            <tr>
                <td><label>Otras operaciones:</label></td>
                <td><?=$dataform['otras_operaciones']?></td><!--agregar campo llamado otras_operaciones-->
            </tr>
            <tr>
                <td><label>Productos en el exterior?:</label></td>
                <td><?=(($dataform['productos_exterior'] == "-1") ? "SI" : ($dataform['productos_exterior'] == "0" ? "NO" : ""))?></td>
            </tr>
            <tr>
                <td><label>Cuentas moneda extranjera?:</label></td>
                <td><?=(($dataform['cuentas_monedaextranjera'] == "-1") ? "SI" : ($dataform['cuentas_monedaextranjera'] == "0" ? "NO" : ""))?></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td colspan="2" align="center">CUENTAS EN MONEDA EXTRANJERA</td>
            </tr>
        </table>
        <table id="table_parte5">
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#1</strong></td>
            </tr>
            <tr>
                <td><label>Tipo de producto:</label></td>
                <td><?=$dataform['producto_tipo']?></td>
            </tr>
            <tr>
                <td><label>Identificacion:</label></td>
                <td><?=$dataform['producto_identificacion']?></td>
            </tr>
            <tr>
                <td><label>Entidad:</label></td>
                <td><?=$dataform['producto_entidad']?></td>
            </tr>
            <tr>
                <td><label>Monto:</label></td>
                <td><?=$dataform['producto_monto']?></td>
            </tr>
            <tr>
                <td><label>Ciudad:</label></td>
                <td><?=$dataform['producto_ciudad']?></td>
            </tr>
            <tr>
                <td><label>Pais:</label></td>
                <td><?=$dataform['producto_pais']?></td>
            </tr>
            <tr>
                <td><label>Moneda:</label></td>
                <td><?=$dataform['producto_moneda']?></td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#2</strong></td>
            </tr>
            <tr>
                <td><label>Tipo de producto:</label></td>
                <td><?=$dataform['producto_tipo']?></td>
            </tr>
            <tr>
                <td><label>Identificacion:</label></td>
                <td><?=$dataform['producto_identificacion']?></td>
            </tr>
            <tr>
                <td><label>Entidad:</label></td>
                <td><?=$dataform['producto_entidad']?></td>
            </tr>
            <tr>
                <td><label>Monto:</label></td>
                <td><?=$dataform['producto_monto']?></td>
            </tr>
            <tr>
                <td><label>Ciudad:</label></td>
                <td><?=$dataform['producto_ciudad']?></td>
            </tr>
            <tr>
                <td><label>Pais:</label></td>
                <td><?=$dataform['producto_pais']?></td>
            </tr>
            <tr>
                <td><label>Moneda:</label></td>
                <td><?=$dataform['producto_moneda']?></td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#3</strong></td>
            </tr>
            <tr>
                <td><label>Tipo de producto:</label></td>
                <td><?=$dataform['producto_tipo']?></td>
            </tr>
            <tr>
                <td><label>Identificacion:</label></td>
                <td><?=$dataform['producto_identificacion']?></td>
            </tr>
            <tr>
                <td><label>Entidad:</label></td>
                <td><?=$dataform['producto_entidad']?></td>
            </tr>
            <tr>
                <td><label>Monto:</label></td>
                <td><?=$dataform['producto_monto']?></td>
            </tr>
            <tr>
                <td><label>Ciudad:</label></td>
                <td><?=$dataform['producto_ciudad']?></td>
            </tr>
            <tr>
                <td><label>Pais:</label></td>
                <td><?=$dataform['producto_pais']?></td>
            </tr>
            <tr>
                <td><label>Moneda:</label></td>
                <td><?=$dataform['producto_moneda']?></td>
            </tr>
        </table>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td>
        <table style="width: 100%;">
            <tr>
                <td colspan="2" align="center"><strong>5. INFORMACION SOBRE RECLAMACIONES EN SEGUROS</strong></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 230px; text-align: right;"><label>Reclamaciones o indemnizaciones?:</label></td>
                <td style="padding-left: 5px;"><?=(($dataform['reclamaciones'] == "-1") ? "SI" : ($dataform['reclamaciones'] == "0" ? "NO" : ""))?></td>
            </tr>
        </table>
        <table id="table_parte7">
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#1</strong></td>
            </tr>
            <tr>
                <td><label>Año:</label></td>
                <td><?=$dataform['rec_ano']?></td>
            </tr>
            <tr>
                <td><label>Ramo:</label></td>
                <td><?=$dataform['rec_ramo']?></td>
            </tr>
            <tr>
                <td><label>Compañia:</label></td>
                <td><?=$dataform['rec_compania']?></td>
            </tr>
            <tr>
                <td><label>Valor:</label></td>
                <td><?=$dataform['rec_valor']?></td>
            </tr>
            <tr>
                <td><label>Resultado:</label></td>
                <td><?=$dataform['rec_resultado']?></td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#2</strong></td>
            </tr>
            <tr>
                <td><label>Año:</label></td>
                <td><?=$dataform['rec_ano']?></td>
            </tr>
            <tr>
                <td><label>Ramo:</label></td>
                <td><?=$dataform['rec_ramo']?></td>
            </tr>
            <tr>
                <td><label>Compañia:</label></td>
                <td><?=$dataform['rec_compania']?></td>
            </tr>
            <tr>
                <td><label>Valor:</label></td>
                <td><?=$dataform['rec_valor']?></td>
            </tr>
            <tr>
                <td><label>Resultado:</label></td>
                <td><?=$dataform['rec_resultado']?></td>
            </tr>
        </table>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td>
        <table style="width: 100%;">
            <tr>
                <td colspan="2" align="center"><strong>8. FRIMA Y HUELLA</strong></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 110px; text-align: right;"><label>Firma:</label></td>
                <td style="width: 300px; padding-left: 5px;"><?=$dataform['firma']?></td>
            </tr>
            <tr>
                <td style="width: 110px; text-align: right;"><label>Huella:</label></td>
                <td style="width: 300px; padding-left: 5px;"><?=$dataform['huella']?></td>
            </tr>
        </table>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td>
        <table style="width: 100%;">
            <tr>
                <td colspan="2" align="center"><strong>9. INFORMACI&Oacute;N ENTREVISTA</strong></td>
            </tr>
        </table>
        <table id="table_parte9">
            <tr>
                <td><label>Lugar entrevista:</label></td>
                <td><?=$dataform['lugarentrevista']?></td>
            </tr>
            <tr>
                <td><label>Resultado:</label></td>
                <td><?=$dataform['resultadoentrevista']?></td>
            </tr>
            <tr>
                <td><label>Fecha de entrevista:</label></td><!--fechaentrevista-->
                <td><?=$dataform['fechaentrevista']?></td>
            </tr>
            <tr>
                <td><label>Hora:</label></td><!--fechaentrevista-->
                <td><?=$dataform['horaentrevista']?> <?=$dataform['tipohoraentrevista']?></td>
            </tr>
            <tr>
                <td><label>Observaciones:</label></td>
                <td><?=$dataform['observacionesentrevista']?></td>
            </tr>
            <tr>
                <td><label>Nombre Intermediario / Asesor / Entrevistador:</label></td>
                <td><?=$dataform['nombreintermediario']?> </td>
            </tr>
            <tr>
                <td><label>Clave:</label></td>
                <td><?=$dataform['clave_inter']?></td>
            </tr>
            <tr>
                <td><label>Firma entrevistador:</label></td>
                <td><?=(($dataform['firma_entrevista'] == "-1") ? "SI" : ($dataform['firma_entrevista'] == "0" ? "NO" : ""))?></td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td>
        <table style="width: 100%;">
            <tr>
                <td colspan="2" align="center"><strong>10. CONFIRMACI&Oacute;N DE LA INFORMACI&Oacute;N</strong></td>
            </tr>
        </table>
        <table id="table_parte10">
            <tr>
                <td><label>Ciudad:</label></td>
                <td>
                    <select id="verificacion_ciudad" name="verificacion_ciudad" style="font-size: 12px"><!--agregar campo llamado verificacion_ciudad-->
                        <option value="">Seleccione...</option>
<?php
                    foreach ($daneCiudades as $ciudad) {
                        $slect = '';
                        if($dataform['verificacion_ciudad'] == $ciudad['id'])
                            $slect = ' selected';
                        echo '<option value="'.$ciudad['id'].'"'.$slect.'>'.$ciudad['ciudad'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Fecha de verificacion:</label></td><!--agregar campo llamado verificacion_fecha-->
                <td><?=$dataform['verificacion_fecha']?></td>
            </tr>
            <tr>
                <td><label>Hora:</label></td><!--agregar campo llamado verificacion_fecha-->
                <td><?=date('h:i:A', strtotime($dataform['verificacion_hora']))?></td>
            </tr>
            <tr>
                <td><label>Nombre y cargo de verificador:</label></td>
                <td><?=$dataform['verificacion_nombre']?></td>
            </tr>
            <tr>
                <td><label>Observaciones:</label></td>
                <td><?=$dataform['verificacion_observacion']?></td>
            </tr>
            <tr>
                <td><label>Firma:</label></td>
                <td><?=(($dataform['verificacion_firma'] == "-1") ? "SI" : ($dataform['verificacion_firma'] == "0" ? "NO" : ""))?></td>
            </tr>
        </table>
        </td>
    </tr>
    <!-- <tr>
        <td align="center"><input type="submit" value="Crear formulario"></td>
    </tr> -->
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
<script type="text/javascript">
$(document).ready(function(){
    console.log("aca");
    $('select[name="clasecliente"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '10'){
            $('input[name="cual_clasecliente"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="cual_clasecliente"]').val('');
            $('input[name="cual_clasecliente"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="tipoempresaemp"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '5'){
            $('input[name="tipoempresaemp_cual"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="tipoempresaemp_cual"]').val('');
            $('input[name="tipoempresaemp_cual"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="reconocimiento_publico"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="reconocimiento_cual"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="reconocimiento_cual"]').val('');
            $('input[name="reconocimiento_cual"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="expuesta_politica"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="cargo_politica"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="cargo_politica"]').val('');
            $('input[name="cargo_politica"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="expuesta_publica"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="publica_nombre"]').removeAttr('disabled');
            $('input[name="publica_cargo"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="publica_nombre"]').val('');
            $('input[name="publica_nombre"]').attr('disabled', 'disabled');
            $('input[name="publica_cargo"]').val('');
            $('input[name="publica_cargo"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="repre_internacional"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="internacional_indique"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="internacional_indique"]').val('');
            $('input[name="internacional_indique"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="tributarias_otro_pais"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name="tributarias_paises"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="tributarias_paises"]').val('');
            $('input[name="tributarias_paises"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="tipoempresajur"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '5'){
            $('input[name="tipoempresajur_otra"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="tipoempresajur_otra"]').val('');
            $('input[name="tipoempresajur_otra"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="monedaextranjera"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('select[name="tipotransacciones"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('select[name="tipotransacciones"]').val('');
            $('select[name="tipotransacciones"]').attr('disabled', 'disabled');
            $('input[name="tipotransacciones_cual"]').val('');
            $('input[name="tipotransacciones_cual"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="tipotransacciones"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '7'){
            $('input[name="tipotransacciones_cual"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="tipotransacciones_cual"]').val('');
            $('input[name="tipotransacciones_cual"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="cuentas_monedaextranjera"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){
            $('input[name^="producto_tipo"]').removeAttr('disabled');
            $('input[name^="producto_identificacion"]').removeAttr('disabled');
            $('input[name^="producto_entidad"]').removeAttr('disabled');
            $('input[name^="producto_monto"]').removeAttr('disabled');
            $('input[name^="producto_ciudad"]').removeAttr('disabled');
            $('input[name^="producto_pais"]').removeAttr('disabled');
            $('input[name^="producto_moneda"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name^="producto_tipo"]').val('');
            $('input[name^="producto_tipo"]').attr('disabled', 'disabled');
            $('input[name^="producto_identificacion"]').val('');
            $('input[name^="producto_identificacion"]').attr('disabled', 'disabled');
            $('input[name^="producto_entidad"]').val('');
            $('input[name^="producto_entidad"]').attr('disabled', 'disabled');
            $('input[name^="producto_monto"]').val('');
            $('input[name^="producto_monto"]').attr('disabled', 'disabled');
            $('input[name^="producto_ciudad"]').val('');
            $('input[name^="producto_ciudad"]').attr('disabled', 'disabled');
            $('input[name^="producto_pais"]').val('');
            $('input[name^="producto_pais"]').attr('disabled', 'disabled');
            $('input[name^="producto_moneda"]').val('');
            $('input[name^="producto_moneda"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="reclamaciones"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '-1'){//"input[name^=load_file]"
            $('input[name^="rec_ano"]').removeAttr('disabled');
            $('input[name^="rec_ramo"]').removeAttr('disabled');
            $('input[name^="rec_compania"]').removeAttr('disabled');
            $('input[name^="rec_valor"]').removeAttr('disabled');
            $('input[name^="rec_resultado"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name^="rec_ano"]').val('');
            $('input[name^="rec_ano"]').attr('disabled', 'disabled');
            $('input[name^="rec_ramo"]').val('');
            $('input[name^="rec_ramo"]').attr('disabled', 'disabled');
            $('input[name^="rec_compania"]').val('');
            $('input[name^="rec_compania"]').attr('disabled', 'disabled');
            $('input[name^="rec_valor"]').val('');
            $('input[name^="rec_valor"]').attr('disabled', 'disabled');
            $('input[name^="rec_resultado"]').val('');
            $('input[name^="rec_resultado"]').attr('disabled', 'disabled');
        }
    });
    $('select[name^="otrosingresos"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '13'){
            $('input[name^="concepto"]').val('SD');
        }else{
            $('input[name^="concepto"]').val('');
        }
    })
});

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
</form>
</body>
</html>