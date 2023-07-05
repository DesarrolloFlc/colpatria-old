<?php
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'official.class.php';
require_once PATH_CCLASS . DS . 'form.class.php';
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

$form = new Form();
$dataform = mysqli_fetch_array($form->getFormInfo($_GET['id_form']));

$type_person = $_GET['type'];

$fecharadicado = explode("-",$dataform['fecharadicado']);
?>
<html>
<head>
    <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/calendar.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery.qtip-1.0.0-rc3.min.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/lib/js/tools.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/lib/js/cal.js"></script>
</head>
<body>
    <!--
<?=json_encode($dataform);?>
-->
<?php
if($dataform['formulario'] != '15'){
?>
<form method="POST" action="saveEdit.php">
<table>
    <tr>
        <td>Fecha radicado:</td>
        <td>
           	<input type="text" name="fecharadicado" id="fecharadicado" value="<?=$dataform['fecharadicado']?>" data-oldvalue="<?=$dataform['fecharadicado']?>">
        </td>
    </tr>
    <tr>
        <td>Fecha de solicitud:</td>
        <td>
            <input type="text" name="fechasolicitud" id="fechasolicitud" value="<?=$dataform['fechasolicitud']?>" data-oldvalue="<?=$dataform['fechasolicitud']?>">
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
            <select id="clasecliente" name="clasecliente" class="obligatorio" data-oldvalue="$dataform['clasecliente']">
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
        <td>No. documento</td>
        <td>
            <input type="text" name="documento" id="documento" onKeyPress="onlyNumbers();" class="obligatorio" value="<?=$dataform['documento']?>" data-oldvalue="<?=$dataform['documento']?>" readonly>
        </td>
    </tr>
    <tr>
        <td>Re-escribir documento</td>
        <td>
            <input type="text" name="documento2" id="documento2" onKeyPress="onlyNumbers();" onpaste="alert('No no no ..');return false"  class="obligatorio" value="<?=$dataform['document']?>" data-oldvalue="<?=$dataform['document']?>">
        </td>
    </tr>
    <tr>
        <td>Fecha expedición</td>
        <td>
            <input type="text" name="fechaexpedicion" id="fechaexpedicion" value="<?=$dataform['fechaexpedicion']?>" data-oldvalue="<?=$dataform['fechaexpedicion']?>">
        </td>
    </tr>
    <tr>
        <td>Lugar expedición:</td>
        <td>
            <select id="lugarexpedicion" name="lugarexpedicion"  class="obligatorio" data-oldvalue="$dataform['lugarexpedicion']">
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
        <td>Fecha nacimiento:</td>
        <td>
            <input type="text" name="fechanacimiento" id="fechanacimiento" value="<?=$dataform['fechanacimiento']?>" data-oldvalue="<?=$dataform['fechanacimiento']?>">        
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
            <select id="nacionalidad" name="nacionalidad" class="obligatorio" data-value="<?=$dataform['nacionalidad']?>">
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
        <td >INFORMACIÓN DOMICILIO Y OFICINA</td>
    </tr>
    <tr>
        <td>Dirección residencia</td>
        <td><input type="text" name="direccionresidencia" id="direccionresidencia" class="obligatorio" value="<?=$dataform['direccionresidencia']?>" data-oldvalue="<?=$dataform['direccionresidencia']?>"></td>        
    </tr>
    <tr>
        <td>Ciudad residencia</td>
        <td >
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
        while($result = mysqli_fetch_array($ciiu)){
            $complemento = "";
            if(isset($result['id']) && $result['id'] == $dataform['ciiu'])
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['codigo']?>" <?=$complemento?>><?=$result['codigo']?></option>
<?php
            $complemento = "";
        }
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
        <td>Re-escribir NIT</td>
        <td><input type="text" name="nit2" id="nit2" onKeypress="onlyNumbers();" onpaste="alert('No no no...');return false" class="obligatorio" value="<?=$dataform['nit']?>" data-oldvalue="<?=$dataform['nit']?>">
        Cod. Verf.
        <input type="text" name="digitochequeo2" id="digitochequeo2" onKeypress="onlyNumbers();" onpaste="alert('No no no...');return false" size="4" class="obligatorio" value="<?=$dataform['digitochequeo']?>" data-oldvalue="<?=$dataform['digitochequeo']?>">
    </tr>
    <tr>
        <td>CIIU</td>
        <td>
            <select id="ciiu" name="ciiu" class="obligatorio" data-oldvalue="<?=$dataform['ciiu']?>">
                <option value="">-Opciones-</option>
<?php
        while($result = mysqli_fetch_array($ciiu)){
            if(isset($result['id']) && ($result['id'] == $dataform['ciiu']))
                $complemento = ' selected="selected"';
?>
                <option value="<?=$result['codigo']?>" <?=$complemento?>><?=$result['codigo']?></option>
<?php
            $complemento = "";
        }
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
                <option value="Si" <?php if($dataform['firma'] == "Si") echo "selected='selected'"?>>Si</option>
                <option value="No" <?php if($dataform['firma'] == "No") echo "selected='selected'"?>>No</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Huella del cliente:</td>
        <td>
            <select name="huella" id="huella" class="obligatorio" data-oldvalue="<?=$dataform['huella']?>">
                <option value="">-Opciones-</option>
                <option value="Si" <?php if($dataform['huella'] == "Si") echo "selected='selected'"?>>Si</option>
                <option value="No" <?php if($dataform['huella'] == "No") echo "selected='selected'"?>>No</option>
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
        <td>Fecha entrevista:</td>
        <td>
            <input type="text" name="fechaentrevista" id="fechaentrevista" value="<?=$dataform['fechaentrevista']?>" data-oldvalue="<?=$dataform['fechaentrevista']?>">
        </td>
    </tr>
    <tr>
        <td>Hora entrevista:</td>
        <td>
            <select id="horaentrevista" name="horaentrevista" size="8px" class="obligatorio" data-oldvalue="<?=$dataform['horaentrevista']?>">
                <option value="">---</option>
<?php
    for($i = 1; $i <= 12; $i++){
        if($dataform['horaentrevista'] == $i) $complemento = "selected='selected'";
?>
                <option value="<?=$i?>" <?=$complemento?>><?=$i?></option>
<?php
        $complemento = "";
    }
?>
            </select>
            <select id="tipohoraentrevista" name="tipohoraentrevista" class="obligatorio" data-oldvalue="<?=$dataform['tipohoraentrevista']?>">
                <option value="">---</option>
                <option value="am" <?php if($dataform['tipohoraentrevista'] == "am") echo "selected='selected'"?>>am</option>
                <option value="pm" <?php if($dataform['tipohoraentrevista'] == "pm") echo "selected='selected'"?>>pm</option>       
            </select>     
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
            <textarea name="observacionesentrevista" id="observacionesentrevista" value="<?=$dataform['observacionesentrevista']?>" data-oldvalue="<?=$dataform['observacionesentrevista']?>"></textarea>
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
<?php
}else{
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
<input type="hidden" name="id_form" id="id_form" value="<?=$_GET['id_form']?>">
<input type="hidden" name="formulario" id="formulario" value="15">
<input type="hidden" name="type_person" id="type_person" value="<?=$type_person?>">
<input type="hidden" name="id_data" id="id_data" value="<?=$dataform['id']?>">
<table>
    <tr>
        <td>
        <table>
            <tr>
                <td style="width: 80px">Fecha de radicado:</td><!--fecharadicado-->
                <td>
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
                        <option value="<?=$i?>"<?=$select?>><?=$val_m?></option>
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
                        <option value="<?=$i?>"<?=$select?>><?=$val_m?></option>
<?php
    }
?>
                    </select>
                    <select id="f_dil_d" name="f_dil_d" onblur="$(this).verificarFechaDoble(event, 'dil', '1');" style="font-size: 12px">
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
                    <input type="text" id="cual_clasecliente" name="cual_clasecliente" style="width: 130px;" disabled value="<?=$dataform['cual_clasecliente']?>"data-oldvalue="<?=$dataform['cual_clasecliente']?>"><!--agregar campo llamado cual_clasecliente-->
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
                    <input type="text" id="documento" name="documento" onBlur="ocultarCampoDoc();" style="width: 130px" value="<?=$dataform['document']?>"<?=(($type_person == '1') ? "disabled" : "")?> data-oldvalue="<?=$dataform['document']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Fecha expedicion:</td><!--fechaexpedicion-->
                <td>
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
                        <option value="<?=$i?>"<?=$select?>><?=$val_m?></option>
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
                        <option value="<?=$i?>"<?=$select?>><?=$val_m?></option>
<?php
    }
?>
                    </select>
                    <select id="f_nac_d" name="f_nac_d" style="font-size: 12px" onblur="$(this).verificarFechaDoble(event, 'nac', '1');">
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
                    <input type="text" id="tipoempresaemp_cual" name="tipoempresaemp_cual" style="width: 100px" disabled value="<?=$dataform['tipoempresaemp_cual']?>" data-oldvalue="<?=$dataform['tipoempresaemp_cual']?>"><!--agregar campo llamado tipoempresaemp_cual-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['recursos_publicos']?>"><!--agregar campo llamado recursos_publicos-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['recursos_publicos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['recursos_publicos'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Grado de poder publico?
                    <select id="poder_publico" name="poder_publico" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['poder_publico']?>"><!--agregar campo llamado poder_publico-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['poder_publico'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['poder_publico'] == "0") ? "selected" : "")?>>NO</option>
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
                    </select>
                    Indique
                    <input type="text" id="reconocimiento_cual" name="reconocimiento_cual" style="width: 180px; margin-left: 10px" disabled value="<?=$dataform['reconocimiento_cual']?>" data-oldvalue="<?=$dataform['reconocimiento_cual']?>"><!--agregar campo llamado reconocimiento_cual-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Servidor publico?</td>
                <td>
                    <select id="servidor_publico" name="servidor_publico" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['servidor_publico']?>"><!--agregar campo llamado servidor_publico-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['servidor_publico'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['servidor_publico'] == "0") ? "selected" : "")?>>NO</option>
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
                    </select>
                    Cargo:
                    <input type="text" id="cargo_politica" name="cargo_politica" style="width: 180px; margin-left: 10px" disabled value="<?=$dataform['cargo_politica']?>" data-oldvalue="<?=$dataform['cargo_politica']?>"><!--agregar campo llamado cargo_politica-->
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
                        <option value="<?=$i?>"<?=$select?>><?=$val_m?></option>
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
                        <option value="<?=$i?>"<?=$select?>><?=$val_m?></option>
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
                    </select>
                    Nombre: 
                    <input type="text" id="publica_nombre" name="publica_nombre" style="width: 100px" disabled value="<?=$dataform['publica_nombre']?>" data-oldvalue="<?=$dataform['publica_nombre']?>"><!--agregar campo llamado publica_nombre-->
                    Cargo: 
                    <input type="text" id="publica_cargo" name="publica_cargo" style="width: 100px" disabled value="<?=$dataform['publica_cargo']?>" data-oldvalue="<?=$dataform['publica_cargo']?>"><!--agregar campo llamado publica_cargo-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Representante internacional?</td>
                <td>
                    <select id="repre_internacional" name="repre_internacional" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['repre_internacional']?>"><!--agregar campo llamado repre_internacional-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['repre_internacional'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['repre_internacional'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Indique: 
                    <input type="text" id="internacional_indique" name="internacional_indique" style="width: 180px" disabled value="<?=$dataform['internacional_indique']?>" data-oldvalue="<?=$dataform['internacional_indique']?>"><!--agregar campo llamado internacional_indique-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tributarias en otro pais?</td>
                <td>
                    <select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tributarias_otro_pais']?>"><!--agregar campo llamado tributarias_otro_pais-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['tributarias_otro_pais'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['tributarias_otro_pais'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Cuales?: 
                    <input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" disabled value="<?=$dataform['tributarias_paises']?>" data-oldvalue="<?=$dataform['tributarias_paises']?>"><!--agregar campo llamado tributarias_paises-->
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
                        echo '<option value="'.$actEconomica['id'].'"'.$slect.'>'.$actEconomica['description'].'</option>';
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
                        echo '<option value="'.$ciiu['codigo'].'"'.$slect.'>'.$ciiu['codigo'].'</option>';
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
                        echo '<option value="'.$profesion['id'].'"'.$slect.'>'.$profesion['description'].'</option>';
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
                        echo '<option value="'.$ciiu['codigo'].'"'.$slect.'>'.$ciiu['codigo'].'</option>';
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
                        echo '<option value="'.$ingreso['id'].'"'.$slect.'>'.$ingreso['description'].'</option>';
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
                        echo '<option value="'.$egreso['id'].'"'.$slect.'>'.$egreso['description'].'</option>';
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
                        echo '<option value="'.$ingreso['id'].'"'.$slect.'>'.$ingreso['description'].'</option>';
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
                    <input type="text" id="nit" name="nit" style="width: 130px; margin-right: 10px" onBlur="ocultarCampoNit();" value="<?=$dataform['nit']?>" data-oldvalue="<?=$dataform['nit']?>" disabled>
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
                        echo '<option value="'.$tipoempresa['id'].'"'.$slect.'>'.$tipoempresa['description'].'</option>';
                    }
?>
                    </select>
                    Otra: 
                    <input type="text" id="tipoempresajur_otra" name="tipoempresajur_otra" style="width: 130px; margin-left: 10px" disabled value="<?=$dataform['tipoempresajur_otra']?>" data-oldvalue="<?=$dataform['tipoempresajur_otra']?>"><!--agregar campo llamado tipoempresajur_otra-->
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
                        echo '<option value="'.$ciiu['codigo'].'"'.$slect.'>'.$ciiu['codigo'].'</option>';
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
                        echo '<option value="'.$ciudad['id'].'"'.$slect.'>'.$ciudad['ciudad'].'</option>';
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
                        echo '<option value="'.$ingreso['id'].'"'.$slect.'>'.$ingreso['description'].'</option>';
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
                        echo '<option value="'.$egreso['id'].'"'.$slect.'>'.$egreso['description'].'</option>';
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
                        echo '<option value="'.$ingreso['id'].'"'.$slect.'>'.$ingreso['description'].'</option>';
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
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($tipoDocumentos as $tipo) {
                        $slect = '';
                        if($dataform['tipo_id'] == $tipo['id'])
                            $slect = ' selected';
                        echo '<option value="'.$tipo['id'].'"'.$slect.'>'.$tipo['description'].'</option>';
                    }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
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
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($tipoDocumentos as $tipo) {
                        $slect = '';
                        if($dataform['tipo_id'] == $tipo['id'])
                            $slect = ' selected';
                        echo '<option value="'.$tipo['id'].'"'.$slect.'>'.$tipo['description'].'</option>';
                    }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
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
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($tipoDocumentos as $tipo) {
                        $slect = '';
                        if($dataform['tipo_id'] == $tipo['id'])
                            $slect = ' selected';
                        echo '<option value="'.$tipo['id'].'"'.$slect.'>'.$tipo['description'].'</option>';
                    }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
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
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($tipoDocumentos as $tipo) {
                        $slect = '';
                        if($dataform['tipo_id'] == $tipo['id'])
                            $slect = ' selected';
                        echo '<option value="'.$tipo['id'].'"'.$slect.'>'.$tipo['description'].'</option>';
                    }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
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
                    <select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipo_id']?>">
                        <option value="">Seleccione...</option>
<?php
                    foreach ($tipoDocumentos as $tipo) {
                        $slect = '';
                        if($dataform['tipo_id'] == $tipo['id'])
                            $slect = ' selected';
                        echo '<option value="'.$tipo['id'].'"'.$slect.'>'.$tipo['description'].'</option>';
                    }
?>
                    </select>
                    Numero id:
                    <input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px" value="<?=$dataform['identificacion']?>" data-oldvalue="<?=$dataform['identificacion']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Razon social / nombre</td>
                <td>
                    <input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" value="<?=$dataform['nombre_accionista']?>" data-oldvalue="<?=$dataform['nombre_accionista']?>">
                    % Participacion:
                    <input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px" value="<?=$dataform['porcentaje']?>" data-oldvalue="<?=$dataform['porcentaje']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
                <td>
                    <select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_recursos']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_recursos'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_recursos'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Reconocimiento publico?
                    <select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['publico_reconocimiento']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_reconocimiento'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_reconocimiento'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
                <td>
                    <select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px" data-oldvalue="<?=$dataform['publico_expuesta']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['publico_expuesta'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['publico_expuesta'] == "0") ? "selected" : "")?>>NO</option>
                    </select>
                    Tributarias en otro pais?
                    <select id="declaracion_tributaria[]" name="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" data-oldvalue="<?=$dataform['declaracion_tributaria']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['declaracion_tributaria'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['declaracion_tributaria'] == "0") ? "selected" : "")?>>NO</option>
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
                    </select>
                    Cual?
                    <select id="tipotransacciones" name="tipotransacciones" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['tipotransacciones']?>" disabled>
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
                    <input type="text" id="tipotransacciones_cual" name="tipotransacciones_cual" style="width: 135px" disabled value="<?=$dataform['tipotransacciones_cual']?>" data-oldvalue="<?=$dataform['tipotransacciones_cual']?>"><!--agregar campo llamado tipotransacciones_cual-->
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
                    </select>
                    Cuentas moneda extranjera?
                    <select id="cuentas_monedaextranjera" name="cuentas_monedaextranjera" style="font-size: 12px; margin-right: 5px" data-oldvalue="<?=$dataform['cuentas_monedaextranjera']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['cuentas_monedaextranjera'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['cuentas_monedaextranjera'] == "0") ? "selected" : "")?>>NO</option>
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
                    <input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" disabled value="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>">
                    Identificacion:
                    <input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" disabled value="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Entidad:</td>
                <td>
                    <input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>">
                    Monto:
                    <input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>">
                    Ciudad:
                    <input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Pais:</td>
                <td>
                    <input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>">
                    Moneda:
                    <input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#2</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo de producto:</td>
                <td>
                    <input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" disabled value="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>">
                    Identificacion:
                    <input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" disabled value="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Entidad:</td>
                <td>
                    <input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>">
                    Monto:
                    <input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>">
                    Ciudad:
                    <input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Pais:</td>
                <td>
                    <input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>">
                    Moneda:
                    <input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#3</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Tipo de producto:</td>
                <td>
                    <input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" disabled value="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_tipo']) && !empty($dataform['producto_tipo']) ? $dataform['producto_tipo'] : '')?>">
                    Identificacion:
                    <input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" disabled value="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_identificacion']) && !empty($dataform['producto_identificacion']) ? $dataform['producto_identificacion'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Entidad:</td>
                <td>
                    <input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_entidad']) && !empty($dataform['producto_entidad']) ? $dataform['producto_entidad'] : '')?>">
                    Monto:
                    <input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_monto']) && !empty($dataform['producto_monto']) ? $dataform['producto_monto'] : '')?>">
                    Ciudad:
                    <input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_ciudad']) && !empty($dataform['producto_ciudad']) ? $dataform['producto_ciudad'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Pais:</td>
                <td>
                    <input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_pais']) && !empty($dataform['producto_pais']) ? $dataform['producto_pais'] : '')?>">
                    Moneda:
                    <input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" disabled value="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>" data-oldvalue="<?=(isset($dataform['producto_moneda']) && !empty($dataform['producto_moneda']) ? $dataform['producto_moneda'] : '')?>">
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
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#1</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Año:</td>
                <td>
                    <input type="text" id="rec_ano[]" name="rec_ano[]" style="width: 50px; margin-right: 5px" disabled value="<?=(isset($dataform['rec_ano']) && !empty($dataform['rec_ano']) ? $dataform['rec_ano'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_ano']) && !empty($dataform['rec_ano']) ? $dataform['rec_ano'] : '')?>">
                    Ramo:
                    <input type="text" id="rec_ramo[]" name="rec_ramo[]" style="width: 220px; margin-right: 5px" disabled value="<?=(isset($dataform['rec_ramo']) && !empty($dataform['rec_ramo']) ? $dataform['rec_ramo'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_ramo']) && !empty($dataform['rec_ramo']) ? $dataform['rec_ramo'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Compañia:</td>
                <td>
                    <input type="text" id="rec_compania[]" name="rec_compania[]" style="width: 150px; margin-right: 8px" disabled value="<?=(isset($dataform['rec_compania']) && !empty($dataform['rec_compania']) ? $dataform['rec_compania'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_compania']) && !empty($dataform['rec_compania']) ? $dataform['rec_compania'] : '')?>">
                    Valor:
                    <input type="text" id="rec_valor[]" name="rec_valor[]" style="width: 120px; margin-right: 5px" disabled value="<?=(isset($dataform['rec_valor']) && !empty($dataform['rec_valor']) ? $dataform['rec_valor'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_valor']) && !empty($dataform['rec_valor']) ? $dataform['rec_valor'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Resultado:</td>
                <td>
                    <input type="text" id="rec_resultado[]" name="rec_resultado[]" style="width: 150px" disabled value="<?=(isset($dataform['rec_resultado']) && !empty($dataform['rec_resultado']) ? $dataform['rec_resultado'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_resultado']) && !empty($dataform['rec_resultado']) ? $dataform['rec_resultado'] : '')?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><strong style="font-size: 14px">#2</strong></td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Año:</td>
                <td>
                    <input type="text" id="rec_ano[]" name="rec_ano[]" style="width: 50px; margin-right: 5px" disabled value="<?=(isset($dataform['rec_ano']) && !empty($dataform['rec_ano']) ? $dataform['rec_ano'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_ano']) && !empty($dataform['rec_ano']) ? $dataform['rec_ano'] : '')?>">
                    Ramo:
                    <input type="text" id="rec_ramo[]" name="rec_ramo[]" style="width: 220px; margin-right: 5px" disabled value="<?=(isset($dataform['rec_ramo']) && !empty($dataform['rec_ramo']) ? $dataform['rec_ramo'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_ramo']) && !empty($dataform['rec_ramo']) ? $dataform['rec_ramo'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Compañia:</td>
                <td>
                    <input type="text" id="rec_compania[]" name="rec_compania[]" style="width: 150px; margin-right: 8px" disabled value="<?=(isset($dataform['rec_compania']) && !empty($dataform['rec_compania']) ? $dataform['rec_compania'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_compania']) && !empty($dataform['rec_compania']) ? $dataform['rec_compania'] : '')?>">
                    Valor:
                    <input type="text" id="rec_valor[]" name="rec_valor[]" style="width: 120px; margin-right: 5px" disabled value="<?=(isset($dataform['rec_valor']) && !empty($dataform['rec_valor']) ? $dataform['rec_valor'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_valor']) && !empty($dataform['rec_valor']) ? $dataform['rec_valor'] : '')?>">
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Resultado:</td>
                <td>
                    <input type="text" id="rec_resultado[]" name="rec_resultado[]" style="width: 150px" disabled value="<?=(isset($dataform['rec_resultado']) && !empty($dataform['rec_resultado']) ? $dataform['rec_resultado'] : '')?>" data-oldvalue="<?=(isset($dataform['rec_resultado']) && !empty($dataform['rec_resultado']) ? $dataform['rec_resultado'] : '')?>">
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
                    </select>
                    Huella:
                    <select id="huella" name="huella" style="font-size: 12px; margin-left: 5px" data-oldvalue="<?=$dataform['huella']?>">
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['huella'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['huella'] == "0") ? "selected" : "")?>>NO</option>
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
            echo '<option value="'.$i.'"'.$select.'>'.$i.'</option>';
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
            echo '<option value="'.$i.'"'.$select.'>'.$val_m.'</option>';
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
                echo '<option value="'.$day.'"'.$select.'>'.$day.'</option>';
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
                    echo '<option value="'.$hor.'"'.$select.'>'.$hor.'</option>';
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
                    echo '<option value="'.$hor.'"'.$select.'>'.$hor.'</option>';
                }
?>
                    </select>
                    <select id="h_ent_z" name="h_ent_z" style="font-size: 12px">
                        <option value="">Horario</option>
                        <option value="AM"<?=(($dataform['tipohoraentrevista'] == "AM") ? "selected" : "")?>>A.M.</option>
                        <option value="PM"<?=(($dataform['tipohoraentrevista'] == "PM") ? "selected" : "")?>>P.M.</option>
                    </select>
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
                        echo '<option value="'.$ciudad['id'].'"'.$slect.'>'.$ciudad['ciudad'].'</option>';
                    }
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 80px">Fecha de verificacion:</td><!--agregar campo llamado verificacion_fecha-->
                <td>
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
            echo '<option value="'.$i.'"'.$select.'>'.$i.'</option>';
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
            echo '<option value="'.$i.'"'.$select.'>'.$val_m.'</option>';
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
                echo '<option value="'.$day.'"'.$select.'>'.$day.'</option>';
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
                    echo '<option value="'.$hor.'"'.$select.'>'.$hor.'</option>';
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
                    echo '<option value="'.$hor.'"'.$select.'>'.$hor.'</option>';
                }
?>
                    </select>
                    <select id="h_ver_z" name="h_ver_z" style="font-size: 12px">
                        <option value="">Horario</option>
                        <option value="AM"<?=(($h_h[2] == "AM") ? "selected" : "")?>>A.M.</option>
                        <option value="PM"<?=(($h_h[2] == "PM") ? "selected" : "")?>>P.M.</option>
                    </select>
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
                    <textarea cols="40" rows="4" id="verificacion_observacion" name="verificacion_observacion" value="<?=$dataform['verificacion_observacion']?>" data-oldvalue="<?=$dataform['verificacion_observacion']?>"></textarea><!--agregar campo llamado verificacion_observacion-->
                </td>
            </tr>
            <tr>
                <td style="width: 100px;display: table-cell;">Firma:</td>
                <td>
                    <select id="verificacion_firma" name="verificacion_firma" style="font-size: 12px" data-oldvalue="<?=$dataform['verificacion_firma']?>"><!--agregar campo llamado verificacion_firma-->
                        <option value="">Seleccion...</option>
                        <option value="-1"<?=(($dataform['verificacion_firma'] == "-1") ? "selected" : "")?>>SI</option>
                        <option value="0"<?=(($dataform['verificacion_firma'] == "0") ? "selected" : "")?>>NO</option>
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
<?php
}
?>
</body>
</html>