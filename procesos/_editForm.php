<?php
require_once '../lib/class/general.class.php';
require_once '../lib/class/official.class.php';
require_once '../lib/class/form.class.php';
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
    <link rel="stylesheet" href="/Colpatria/resources/css/calendar.css" type="text/css" media="screen" />
 <script type="text/javascript" src="../resources/scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="/Colpatria/resources/scripts/jquery.qtip-1.0.0-rc3.min.js"></script>
<script src="../lib/js/tools.js" type="text/javascript"  ></script>
    <script type="text/javascript" src="/Colpatria/lib/js/cal.js"></script>

</head>
<body>
<form method="POST" action="_saveEdit.php">
<table>
<tr>
        <td>Fecha radicado:</td>
        <td>
           	<input type="text" name="fecharadicado" id="fecharadicado" value="<?php echo $dataform['fecharadicado']?>"  />
        </td>
    </tr>

    <tr>
        <td>Fecha de solicitud:</td>
        <td>
            <input type="text" name="fechasolicitud" id="fechasolicitud" value="<?php echo $dataform['fechasolicitud']?>"  />
        </td>
    </tr>
    <tr>
        <td>Sucursal:</td>
        <td>
            <select id="sucursal" name="sucursal" class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($sucursales)) {
                    $complemento = "";
                    if( $result['id'] == $dataform['sucursal']){
                        $complemento = " selected='selected' ";
                    }
                    echo "<option value='{$result['id']}'$complemento>{$result['sucursal']}</option>";
                    $complemento = "";
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
			if( $result['id'] == $dataform['area'])	 	
			 	$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
		  $complemento = "";  
		}

                ?>
            </select>
</td>
    </tr>

    <tr>
        <td>Funcionario:</td>
        <td> 
		<input type="text" name="id_official" id="id_official" onKeypress="onlyChars();"  class="obligatorio" value="<?php echo $dataform['id_official']?>"/></td>
    </tr>


    <tr>
        <td>Formulario:</td>
        <td>

            <select id="formulario" name="formulario" class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($formularios)) {
			if( $result['id'] == $dataform['formulario'])	 	
			 	$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
		  $complemento = "";
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
			if( $result['id'] == $dataform['clasecliente'])	 	
			 	$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
		  $complemento = "";
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
        <td> <input type="text" name="primerapellido" id="primerapellido" onKeypress="onlyChars();" class="obligatorio" value="<?php echo $dataform['primerapellido']?>"/></td>
    </tr>
    <tr>
        <td>Segundo apellido</td>
        <td><input type="text" name="segundoapellido" id="segundoapellido" onKeypress="onlyChars();"  value="<?php echo $dataform['segundoapellido']?>"/></td>
    </tr>
    <tr>
        <td>Nombres</td>
        <td> <input type="text" name="nombres" id="nombres" onKeypress="onlyChars();" size="60" class="obligatorio" value="<?php echo $dataform['nombres']?>"/></td>
    </tr>
    <tr>
        <td>Tipo documento:</td>
        <td>
            <select id="tipodocumento" name="tipodocumento" class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($tipo_documento)) {			
			if( $result['id'] == $dataform['tipodocumento'])	 	
			 	$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
		  $complemento = "";
                }
                ?>
            </select>
        </td>
    </tr>


    <tr>
        <td>No. documento</td>
        <td><input type="text" name="documento" id="documento" onKeyPress="onlyNumbers();" class="obligatorio" value="<?php echo $dataform['documento']?>" readonly/>  </td>
    </tr>
    <tr>
        <td>Re-escribir documento</td>
        <td><input type="text" name="documento2" id="documento2" onKeyPress="onlyNumbers();" onpaste="alert('No no no ..');return false"  class="obligatorio" value="<?php echo $dataform['documento']?>"/>  </td>
    </tr>
    <tr>
        <td>Fecha expedición</td>
        <td> 
                       <input type="text" name="fechaexpedicion" id="fechaexpedicion" value="<?php echo $dataform['fechaexpedicion']?>"  />        </td>
    </tr>

    <tr>
        <td>Lugar expedición:</td>
        <td>
            <select id="lugarexpedicion" name="lugarexpedicion"  class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($lugar_expedicion)) {			
			if( $result['id'] == $dataform['lugarexpedicion'])	 	
			 	$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
			  $complemento = "";
                }
                ?>
            </select>
        </td>
    </tr>

<?php 
 if ($type_person == "1") {

?>
    <tr>
        <td>Fecha nacimiento:</td>
        <td>
             <input type="text" name="fechanacimiento" id="fechanacimiento" value="<?php echo $dataform['fechanacimiento']?>"  />        
        </td>
    </tr>

    <tr>
        <td>Lugar de nacimiento</td>
        <td>
            <select id="lugarnacimiento" name="lugarnacimiento"  class="obligatorio" >
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($lugar_nacimiento)) {
			if( $result['id'] == $dataform['lugarnacimiento'])	 	
				$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
		  $complemento = "";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Sexo</td>
        <td>
            <select id="sexo" name="sexo"  class="obligatorio">
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
            <select id="nacionalidad" name="nacionalidad"  class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($paises)) {
			if( $result['id'] == $dataform['nacionalidad'])	 	
				$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>" . utf8_encode($result['description']) . "</option>";
			$complemento = "";
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
            <select id="estadocivil" name="estadocivil"  class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($estados_civiles)) {
			if( $result['id'] == $dataform['estadocivil'])	 	
				$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
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
        <td><input type="text" name="direccionresidencia" id="direccionresidencia"  class="obligatorio" value="<?php echo $dataform['direccionresidencia']?>" /></td>        
    </tr>
    <tr>
        <td>Ciudad residencia</td>
        <td >
            <select id="ciudadresidencia" name="ciudadresidencia"  class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($ciudades)) {
			if( $result['id'] == $dataform['ciudadresidencia'])	 	
				$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
			$complemento = "";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Teléfono residencia</td>
        <td> <input type="text" name="telefonoresidencia" id="telefonoresidencia" onKeyPress="onlyNumbers();"   class="obligatorio" value="<?php echo $dataform['telefonoresidencia']?>"/></td>
    </tr>
    <tr>
        <td>Nombre empresa</td>
        <td><input type="text" name="nombreempresa" id="nombreempresa" onKeypress="onlyChars();"  class="obligatorio" value="<?php echo $dataform['nombreempresa']?>"/></td>
    </tr>
    <tr>
        <td>Ciudad empresa</td>
        <td>            
            <select id="ciudadempresa" name="ciudadempresa"  class="obligatorio">
                <option value="">-Opciones-</option>
                <?php
                while ($result = mysqli_fetch_array($ciudades_empresa)) {
			if( $result['id'] == $dataform['ciudadempresa'])	 	
				$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
			$complemento = "";
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Dirección empresa</td>
        <td> <input type="text" name="direccionempresa" id="direccionempresa" value="<?php echo $dataform['direccionempresa']?>"/></td>
    </tr>
    <tr>
        <td>Nomenclatura</td>
        <td>
            <select name="nomenclatura" id="nomenclatura">
                <option value="Nomenclatura nueva"  <?php if($dataform['nomenclatura'] == "Nomenclatura nueva") echo "selected='selected'"?>>Nomenclatura nueva</option>
                <option value="Nomenclatura antigua"  <?php if($dataform['nomenclatura'] == "Nomenclatura antigua") echo "selected='selected'"?>>Nomenclatura antigua</option>
                <option value="SD"  <?php if($dataform['nomenclatura'] == "SD") echo "selected='selected'"?>>SD</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Teléfono laboral</td>
        <td><input type="text" name="telefonolaboral" id="telefonolaboral" onKeyPress="onlyNumbers();"  class="obligatorio" value="<?php echo $dataform['telefonolaboral']?>"/></td>
    </tr>
    <tr>
        <td>Celular</td>
        <td><input type="text" name="celular" id="celular" onKeyPress="onlyNumbers();" value="<?php echo $dataform['celular']?>" />    </td>
    </tr>
    <tr>
        <td>E-mail</td>
        <td> <input type="text" name="correoelectronico" id="correoelectronico" value="<?php echo $dataform['correoelectronico']?>"/></td>
    </tr>
    <tr>
        <td>Cargo</td>
        <td> <input type="text" name="cargo" id="cargo" onKeypress="onlyChars();" value="<?php echo $dataform['cargo']?>"/></td>
    </tr>

    <tr>
        <td>Actv. economica</td>
        <td>
            <select id="actividadeconomicaempresa" name="actividadeconomicaempresa"  class="obligatorio">
                <option value=""> -- Seleccione una opción -- </option>
                <?php
                while ($result = mysqli_fetch_array($actividad_econo)) {
			if( $result['id'] == $dataform['actividadeconomicaempresa'])	 	
				$complemento = " selected='selected'";
                    echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
			$complemento = "";
                }
                ?>
            </select>

    </tr>
<?php } ?>
    <!-- ACTIVIDAD ECONOMICA -->
    <tr>
        <td colspan="4"><div class="title_form">2. ACTIVIDAD ECONOMICA</div></td>
    </tr>

    <?php
    if ($type_person == "1") {        
        ?>
        <input type="hidden" id="persontype" name="persontype" value="1">
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
				if( $result['id'] == $dataform['profesion'])	 	
					$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
				$complemento = "";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Ocupación</td>
            <td>
                <select id="ocupacion" name="ocupacion" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ocupaciones)) {
				if( $result['id'] == $dataform['ocupacion'])	 	
					$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
				$complemento = "";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>CIIU</td>
            <td>
                <select id="ciiu" name="ciiu">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciiu)) {
                        $complemento = "";
                        if( isset($result['id']) && $result['id'] == $dataform['ciiu'])
                            $complemento = " selected='selected'";
                        echo "<option value='{$result['codigo']}'$complemento>{$result['codigo']}</option>";
                        $complemento = "";
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
				if( $result['id'] == $dataform['ingresosmensuales'])	 	
					$complemento = " selected='selected'";	
                        echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
				$complemento = "";
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
			   if( $result['id'] == $dataform['otrosingresos'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
			$complemento = "";
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
			  if( $result['id'] == $dataform['egresosmensuales'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
			$complemento = "";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Conpto. otros ingresos</td>
            <td><input type="text" name="conceptosotrosingresos" id="conceptosotrosingresos" value="<?php echo $dataform['conceptosotrosingresos']?>"/></td>
        </tr>
        <tr>
            <td>Tipo de actividad</td>
            <td>
                <select id="tipoactividad" name="tipoactividad" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($tipo_actividad)) {
			if( $result['id'] == $dataform['tipoactividad'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
				$complemento = "";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nivel estudios</td>
            <td>
                <select id="nivelestudios" name="nivelestudios">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($estudios)) {
				if( $result['id'] == $dataform['nivelestudios'])	 	
					$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                    	  $complemento = "";	
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
			  if( $result['id'] == $dataform['tipovivienda'])	 	
				$complemento = " selected='selected'";			
                        echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
				$complemento = "";
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
            <td><input type="text" name="totalactivos" id="totalactivos" onKeyPress="onlyNumbers();" class="obligatorio" value="<?php echo $dataform['totalactivos']?>"/></td>
        </tr>
        <tr>
            <td>Total pasivos</td>
            <td><input type="text" name="totalpasivos" id="totalpasivos" onKeyPress="onlyNumbers();" class="obligatorio" value="<?php echo $dataform['totalpasivos']?>"/></td>    
        </tr>


        <?php
    } else {
        ?>
        <!-- PERSONA JURIDICA -->
        <input type="hidden" id="persontype" name="persontype" value="2">
        <tr>
            <td colspan="2">PERSONA JURIDICA</td>
        </tr>
        <tr>
            <td>Razon social</td>
            <td><input type="text" name="razonsocial" id="razonsocial" Class="obligatorio" value="<?php echo $dataform['razonsocial']?>"/></td>
        </tr>
        <tr>
            <td>NIT</td>
            <td><input type="text" name="nit" id="nit" onKeypress="onlyNumbers();" class="obligatorio" value="<?php echo $dataform['nit']?>"/>
            Cod. Verf.
            <input type="text" name="digitochequeo" id="digitochequeo" onKeypress="onlyNumbers();" size="4" class="obligatorio" value="<?php echo $dataform['digitochequeo']?>"/>
        </tr>   
	 <tr>
            <td>Re-escribir NIT</td>
            <td><input type="text" name="nit2" id="nit2" onKeypress="onlyNumbers();" onpaste="alert('No no no...');return false" class="obligatorio" value="<?php echo $dataform['nit']?>"/>
            Cod. Verf.
            <input type="text" name="digitochequeo2" id="digitochequeo2" onKeypress="onlyNumbers();" onpaste="alert('No no no...');return false" size="4" class="obligatorio" value="<?php echo $dataform['digitochequeo']?>"/>
        </tr>
        <tr>
            <td>CIIU</td>
            <td>
                <select id="ciiu" name="ciiu" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciiu)) {
			   if( $result['id'] == $dataform['ciiu'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['codigo']}'  $complemento>{$result['codigo']}</option>";
				$complemento = "";
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
			if( $result['id'] == $dataform['ciudadoficina'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}'  $complemento>{$result['description']}</option>";
			$complemento = "";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Dirección oficina ppal.</td>
            <td><input type="text" name="direccionoficinappal" id="direccionoficinappal" class="obligatorio" value="<?php echo $dataform['direccionoficinappal']?>"/></td>
        </tr>
        <tr>
            <td>Nomenclatura</td>
            <td>
                <select name="nomenclatura_emp" id="nomenclatura_emp">
                <option value="Nomenclatura nueva"  <?php if($dataform['nomenclatura_emp'] == "Nomenclatura nueva") echo "selected='selected'"?>>Nomenclatura nueva</option>
                <option value="Nomenclatura antigua"  <?php if($dataform['nomenclatura_emp'] == "Nomenclatura antigua") echo "selected='selected'"?>>Nomenclatura antigua</option>
                <option value="SD"  <?php if($dataform['nomenclatura_emp'] == "SD") echo "selected='selected'"?>>SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Teléfono oficina</td>
            <td><input type="text" name="telefonoficina" id="telefonoficina" onKeyPress="onlyNumbers();" class="obligatorio" value="<?php echo $dataform['telefonoficina']?>"/></td>
        </tr>
        <tr>
            <td>Fax oficina</td>
            <td> <input type="text" name="faxoficina" id="faxoficina" onKeyPress="onlyNumbers();" value="<?php echo $dataform['faxoficina']?>"/></td>
        </tr>
        <tr>
            <td>Ciudad sucursal</td>
            <td colspan="3">  

                <select id="ciudadsucursal" name="ciudadsucursal">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ciudades_sucursal)) {
			if( $result['id'] == $dataform['ciudadsucursal'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}'  $complemento>{$result['description']}</option>";
			$complemento = "";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Dirección sucursal</td>
            <td ><input type="text" name="direccionsucursal" id="direccionsucursal" value="<?php echo $dataform['direccionsucursal']?>"/></td>
        </tr>
        <tr>
            <td>Nomenclatura</td>
            <td>
                <select name="nomenclatura_emp2" id="nomenclatura_emp2">
                <option value="Nomenclatura nueva"  <?php if($dataform['nomenclatura_emp2'] == "Nomenclatura nueva") echo "selected='selected'"?>>Nomenclatura nueva</option>
                <option value="Nomenclatura antigua"  <?php if($dataform['nomenclatura_emp2'] == "Nomenclatura antigua") echo "selected='selected'"?>>Nomenclatura antigua</option>
                <option value="SD"  <?php if($dataform['nomenclatura_emp2'] == "SD") echo "selected='selected'"?>>SD</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Teléfono sucursal</td>
            <td> <input type="text" name="telefonosucursal" id="telefonosucursal" onKeyPress="onlyNumbers();" value="<?php echo $dataform['telefonosucursal']?>"/></td>
        </tr>
        <tr>
            <td>Fax sucursal</td>
            <td><input type="text" name="faxsucursal" id="faxsucursal" onKeyPress="onlyNumbers();" value="<?php echo $dataform['faxsucursal']?>"/></td>
        </tr>
        <tr>
            <td>Actividad economica ppal.</td>
            <td>
                <select id="actividadeconomicappal" name="actividadeconomicappal" onChange="javascript:cambiarEstadoActividad()" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($actividades)) {
			if( $result['id'] == $dataform['actividadeconomicappal'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}'  $complemento>{$result['description']}</option>";
			$complemento = "";
                    }
                    ?>
                </select>
		<div id="otrosactividad">Otro:<input type="text"  name="detalleactividadeconomicappal"  onKeypress="onlyChars();" id="detalleactividadeconomicappal" value="<?php echo $dataform['detalleactividadeconomicappal']?>"/> </div>
            </td>
        </tr>
        <tr>
            <td>Tipo empresa</td>
            <td>
                <select id="tipoempresaemp" name="tipoempresaemp" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($tipo_empresa_emp)) {
			   if( $result['id'] == $dataform['tipoempresaemp'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}'  $complemento>{$result['description']}</option>";
				$complemento = "";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Activos empresa</td>
            <td><input type="text" id="activosemp" name="activosemp" onKeyPress="onlyNumbers();" class="obligatorio" value="<?php echo $dataform['activosemp']?>"/></td>
        </tr>
        <tr>
            <td>Pasivos empresa</td>
            <td><input type="text"  id="pasivosemp" name="pasivosemp" onKeyPress="onlyNumbers();" class="obligatorio" value="<?php echo $dataform['pasivosemp']?>"/></td>
        </tr>
        <tr>
            <td>Ingresos mensuales empresa</td>
            <td><select id="ingresosmensualesemp" name="ingresosmensualesemp" class="obligatorio">
                    <option value="">-Opciones-</option>
                    <?php
                    while ($result = mysqli_fetch_array($ingresos_mensuales_emp)) {
			if( $result['id'] == $dataform['ingresosmensualesemp'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}'  $complemento>{$result['description']}</option>";
				$complemento = "";
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
			if( $result['id'] == $dataform['egresosmensualesemp'])	 	
				$complemento = " selected='selected'";
                        echo "<option value='{$result['id']}'  $complemento>{$result['description']}</option>";
				$complemento = "";
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
		<td><input type="text" name"socio1" id="socio1" onKeyPress="onlyNumbers();" value="<?php echo $dataform['socio1']?>"/></td>
	</tr>
	<tr>
		<td>Socio No. 2:</td>
		<td><input type="text" name"socio2" id="socio2" onKeyPress="onlyNumbers();" value="<?php echo $dataform['socio2']?>"/></td>
	</tr>
	<tr>
		<td>Socio No. 3:</td>
		<td><input type="text" name"socio3" id="socio3" onKeyPress="onlyNumbers();" value="<?php echo $dataform['socio3']?>"/></td>
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
            <option value="Si" <?php if($dataform['monedaextranjera'] == "Si") echo "selected='selected'"?>>Si</option>
            <option value="No" <?php if($dataform['monedaextranjera'] == "No") echo "selected='selected'"?>>No</option>
            <option value="SD" <?php if($dataform['monedaextranjera'] == "SD") echo "selected='selected'"?>>SD</option>
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
			if( $result['id'] == $dataform['tipotransacciones'])	 	
				$complemento = " selected='selected'";
                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
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
        <td>
            Firma del cliente: </td>
        <td><select name="firma" id="firma" class="obligatorio" >
                <option value="">-Opciones-</option>
                <option value="Si" <?php if($dataform['firma'] == "Si") echo "selected='selected'"?>>Si</option>
                <option value="No" <?php if($dataform['firma'] == "No") echo "selected='selected'"?>>No</option>
            </select></td>
    </tr>

    <tr>
        <td>
            Huella del cliente: </td>
        <td><select name="huella" id="huella" class="obligatorio">
                <option value="">-Opciones-</option>
                <option value="Si" <?php if($dataform['huella'] == "Si") echo "selected='selected'"?>>Si</option>
                <option value="No" <?php if($dataform['huella'] == "No") echo "selected='selected'"?>>No</option>
            </select></td>
    </tr>

    <!-- INFORMACION ENTREVISTA -->
    <tr>
        <td>        
            Lugar de entrevista:</td>
        <td><input type="text" name="lugarentrevista" id="lugarentrevista"  class="obligatorio" value="<?php echo $dataform['lugarentrevista']?>"/>        </td>
    </tr>

    <tr>
        <td>
            Fecha entrevista:</td>
        <td>
                        <input type="text" name="fechaentrevista" id="fechaentrevista" value="<?php echo $dataform['fechaentrevista']?>"  />                </td>
    </tr>

    <tr>
        <td>
            Hora entrevista:</td>
        <td>
            <select id="horaentrevista" name="horaentrevista" size="8px" class="obligatorio">
                <option value="">---</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {	
			if($dataform['horaentrevista'] == $i) $complemento = "selected='selected'";
                    echo "<option value='$i' $complemento>$i</option>";
			$complemento = "";
                }
                ?>
            </select>
            <select id="tipohoraentrevista" name="tipohoraentrevista" class="obligatorio">
                <option value="">---</option>
                <option value="am" <?php if($dataform['tipohoraentrevista'] == "am") echo "selected='selected'"?>>am</option>
                <option value="pm" <?php if($dataform['tipohoraentrevista'] == "pm") echo "selected='selected'"?>>pm</option>       
            </select>     
        </td>
    </tr>

    <tr>
        <td>
            Resultado entrevista: </td>
        <td><select name="resultadoentrevista" id="resultadoentrevista" class="obligatorio">
                <option value="">-Opciones-</option>
                <option value="Aceptado" <?php if($dataform['resultadoentrevista'] == "Aceptado") echo "selected='selected'"?>>Aceptado</option>
                <option value="Rechazado" <?php if($dataform['resultadoentrevista'] == "Rechazado") echo "selected='selected'"?>>Rechazado</option>
            </select>     </td>
    </tr>

    <tr>
        <td>
            Observaciones:</td>
        <td><textarea name="observacionesentrevista" id="observacionesentrevista" value="<?php echo $dataform['observacionesentrevista']?>"></textarea></td>
    </tr>

    <tr>
        <td>
            Nombre intermediario y/o asesor responsable:</td>
        <td><input type="text" name="nombreintermediario" id="nombreintermediario" class="obligatorio" value="<?php echo $dataform['nombreintermediario']?>"/></td>
    </tr>
<tr>
    <td colspan="4" align="center"><input type="submit" value="Guardar cambios" /></td>
</tr>
</table>
<input type="hidden" name="id_form" id="id_form" value="<?php echo $_GET['id_form']?>" />
<input type="hidden" name="daniel" id="daniel" value="" />
</form>
</body>
</html>