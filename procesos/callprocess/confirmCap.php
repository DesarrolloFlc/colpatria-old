<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'capi.class.php';
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'contactcapi.class.php';
require_once PATH_CCLASS . DS . 'contact.class.php';

extract($_GET);

if( empty($_SESSION['id']) OR empty($_SESSION['group']) ) {
	echo "<br>No tiene permisos, por favor logueese nuevamente.";
	exit;
}

if( empty($persontype) ) {
	$data_agente = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT persontype FROM client WHERE id = '$id_client'"));
	$persontype = $data_agente['persontype'];
}

if (empty($id_client) || empty($persontype)) {
    echo "<h1>No ha seleccionado ningún cliente</h1>";
    exit;
}

$capi = new Capi();
$data_client= mysqli_fetch_array($capi->getData($id_client));
$general = new General();
$ciudades = $general->getCiudades();
$contact = $general->getContacts();
$profesiones = $general->getProfesiones();
$ingresos_mensuales = $general->getIngresosMensuales();
$egresos_mensuales= $general->getEgresosMensuales();
$estados_civiles = $general->getEstadosCiviles();
$estudios = $general->getEstudios();



//Data capi
$datacapi = new Contactcapi();
$lastDateConfirm = $datacapi->getLastConfirm($id_client);
$count_display = 0;

//Data general
$dataconfirm = new Contact();
$lastDateConfirm2 = $dataconfirm ->getLastConfirm($id_client);
$sepuede = true;

if( $lastDateConfirm != "" || $lastDateConfirm2!= "") {
	if( (date("Y-m-d", strtotime($lastDateConfirm)) >= (date("Y-m-d", strtotime("-10 month")))) ||  (date("Y-m-d", strtotime($lastDateConfirm2)) >= (date("Y-m-d", strtotime("-10 month"))))) {
	$sepuede = false;
    ?>
		<script type="text/javascript" language="javascript">
			alert("ATENCION!!!!  El cliente no se puede confirmar.");			
		</script>
	<?php	
		$count_display++;
	} 
}
?>
<!-- Page Head -->
<h2>Confirmación de cliente en CAPI</h2>
<p id="page-intro">Actualización de datos del cliente</p>

<div class="clear"></div> <!-- End .clear -->
<div style="float: right"><a href="../viewClient.php?id_client=<?php echo $id_client ?>" class="button">Regresar al cliente >></a></div>
<div class="clear"></div> <!-- End .clear -->
<br />

<?php if($persontype == "1"): ?>
<table>
    <thead>
        <tr>
            <th colspan="10">Datos b&aacute;sicos de contacto</th>
        </tr>		
    </thead>
	<tbody>
		<tr>
			<td><b>Sucursal:</b></td>
			<td><?php echo $data_client['sucursal']?></td>
			<td><b>Fecha expedici&oacute;n:</b></td>
			<td><?php echo $data_client['fechaexpedicion']?></td>
		</tr>
		<tr>
			<td><b>Tipo documento:</b></td>
			<td><?php echo $data_client['tipodocumento']?></td>
			<td><b>Documento:</b></td>
			<td><?php echo $data_client['document']?></td>
		</tr>
		<tr>
			<td><b>Nombres:</b></td>
			<td><?php echo $data_client['firstname']?></td>
			<td><b>Fecha de nacimiento:</b></td>
			<td><?php echo $data_client['fechanacimiento']?></td>
		</tr>
		<tr>
			<td><b>Lugar de nacimiento:</b></td>
			<td><?php echo $data_client['lugarnacimiento']?></td>
			<td><b>Profesi&oacute;n:</b></td>
			<td><?php echo $data_client['profesion']?></td>
		</tr>
		<tr>
			<td><b>Empresa:</b></td>
			<td><?php echo $data_client['empresa']?></td>
			<td><b>Ciudad laboral:</b></td>
			<td><?php echo $data_client['ciudadlaboral']?></td>
		</tr>
		<tr>
			<td><b>Direcci&oacute;n laboral:</b></td>
			<td><?php echo $data_client['direccionlaboral']?></td>
			<td><b>Telefono laboral:</b></td>
			<td><?php echo $data_client['telefonolaboral']?></td>
		</tr>
		<tr>
			<td><b>Ciudad residencia:</b></td>
			<td><?php echo $data_client['ciudadresidencia']?></td>
			<td><b>Direcci&oacute;n de residencia:</b></td>
			<td><?php echo $data_client['direccionresidencia']?></td>
		</tr>
		<tr>
			<td><b>Telefono residencia:</b></td>
			<td><?php echo $data_client['telefonoresidencia1']?></td>
			<td><b>Telefono residencia:</b></td>
			<td><?php echo $data_client['telefonoresidencia2']?></td>
			<td><b>Celular:</b></td>
			<td><?php echo $data_client['celular']?></td>
			<td><b>E-mail:</b></td>
			<td><?php echo $data_client['correoelectronico']?></td>
		</tr>

	</tbody>
</table>
<?php elseif($persontype == "2"):?>
<table>
    <thead>
        <tr>
            <th colspan="10">Datos b&aacute;sicos de contacto</th>
        </tr>		
    </thead>
	<tbody>
		<tr>
			<td><b>Sucursal:</b></td>
			<td><?php echo $data_client['sucursal']?></td>
			<td><b>NIT:</b></td>
			<td><?php echo $data_client['document']?></td>
			<td><b>Raz&oacute;n social:</b></td>
			<td><?php echo $data_client['firstname']?></td>
		</tr>
		<tr>
			<td><b>Ciudad:</b></td>
			<td colspan="2"><?php echo $data_client['ciudadlaboral']?></td>
			<td><b>Direcci&oacute;n comercial:</b></td>
			<td colspan="2"><?php echo $data_client['direccionlaboral']?></td>
		</tr>
		<tr>
			<td><b>Telefono comercial 1:</b></td>
			<td><?php echo $data_client['telefonolaboral']?></td>
			<td><b>Telefono comercial 2:</b></td>
			<td><?php echo $data_client['telefonoresidencia1']?></td>
			<td><b>Telefono susc 1:</b></td>
			<td><?php echo $data_client['tel_SUSTR1']?></td>		
			<td><b>Telefono susc 1:</b></td>
			<td><?php echo $data_client['tel_SUSTR2']?></td>		
		</tr>
		<tr>
			<td><b>Fax:</b></td>
			<td colspan="2"><?php echo $data_client['celular']?></td>
			<td><b>E-mail:</b></td>
			<td colspan="2"><?php echo $data_client['correoelectronico']?></td>
		</tr>
	</tbody>
</table>


<?php endif; ?>

<br />
<?php
if($sepuede){
    $paises = General::getPaisesID();
?>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Actualización de datos</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab3" class="default-tab">Cliente</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab3"> <!-- This is the target div. id must match the href of this div's tab -->
		<form  action="saveContactCapi.php" id="confirmClientCapi" name="confirmClientCapi"  method="POST" enctype="multipart/form-data">
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->



<?php if($persontype == "1"): ?>
                    <p>
                        <label>Cédula:</label>
                        <input class="text-input small-input" type="text" id="documento" name="documento" value="<?php echo $data_client['document'];?>" /> 
                    </p>
                    <p>
                        <label>Primer apellido:</label>
                        <input class="text-input small-input" type="text" id="primerapellido" name="primerapellido" value="<?php echo $data_client['primerapellido'];?>" /> 
                    </p>
                    <p>
                        <label>Segundo apellido:</label>
                        <input class="text-input small-input" type="text" id="segundoapellido" name="segundoapellido" value="<?php echo $data_client['segundoapellido'];?>" /> 
                    </p>
                    <p>
                        <label>Nombres:</label>
                        <input class="text-input small-input" type="text" id="nombres" name="nombres" value="<?php echo $data_client['nombres'];?>" /> 
                    </p>        	
        		<p>
                        <?php
                        $fecha_exp = explode("-","0000-00-00");
                        if(isset($data_client['fechanacimiento']))
                            $fecha_exp = explode("-",$data_client['fechanacimiento']);
                        ?>
                        <label>Fecha de nacimiento:</label>
                        <select name="fechanacimiento_a" id="fechanacimiento_a">
                            <option value="">---</option>
                            <?php
                            for ($i = 1900; $i <= 2011; $i++) {
                                $complemento = '';
                                if( $i == $fecha_exp[0])
                                    $complemento = "selected='selected'";
                                echo "<option value='$i' $complemento>$i</option>";
                            }
                            ?>   
                        </select>
                        <select name="fechanacimiento_m" id="fechanacimiento_m">
                            <option value="">---</option>
                            <?php
                            for ($i = 01; $i <= 12; $i++) {                                
                            $complemento = '';
                                if (strlen($i) == 1)
                                    $num = "0" . $i;
                                else
                                    $num = $i;
                                if( $num == $fecha_exp[1])
                                    $complemento = "selected='selected'";
                                echo "<option value='$num' $complemento>$num</option>";
                            }
                            ?>             
                        </select>
                        <select name="fechanacimiento_d" id="fechanacimiento_d">
                            <option value="">---</option>
                            <?php
                            $complemento = "";
                            for ($i = 01; $i <= 31; $i++) {
                                if (strlen($i) == 1)
                                    $num = "0" . $i;
                                else
                                    $num = $i;
                                if( $num == $fecha_exp[1])
                                    $complemento = "selected='selected'";
                                echo "<option value='$num' $complemento>$num</option>";
                            }
                            ?>
                        </select>
                    </p>

            <p>
                        <label>Cantidad de hijos:</label>        
                        <select name="numerohijos" id="numerohijos">
                            <option value="">-Opciones-</option>
                            <?php
                            for( $i = 0;  $i < 16; $i++ ) {                                
                                 $complemento = "";
                                 if( isset($data_client['numerohijos']) && $i == $data_client['numerohijos'])
                                    $complemento = "selected='selected'";
                                ?>                            
                            <option value="<?php echo $i;?>" <?php echo $complemento;?>><?php echo $i;?></option>
                            <?php
                            }
                            ?>     
                        </select>
                    </p>      
                <p>
                        <label>Estado civil:</label>        
                        <select name="estadocivil" id="estadocivil">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($estados_civiles)) {
                                $complemento = "";                                                              
                                if( isset($data_client['estadocivil']) && $result['id'] == $data_client['estadocivil'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>      
                        </select>
                    </p>      
                    <p>
                        <label>Nivel de estudios:</label>        
                        <select name="nivelestudios" id="nivelestudios">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($estudios)) { 
                                $complemento = '';
                                if( isset($data_client['nivelestudios']) && $result['id'] == $data_client['nivelestudios'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>    
                        </select>
                    </p>   

      			<p>
                        <label>Profesión:</label>        
                        <select name="id_profesion" id="id_profesion">
                            <option value="">-Opciones-</option>
                            <?php
                            
                            while ($result = mysqli_fetch_array($profesiones)) {                                
                                $complemento = "";
                                   if( $result['id'] == $data_client['profesion'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>
                        </select>
                    </p>  


        		<p>         
                        <label>Ciudad de residencia:</label>        
                        <select name="id_ciudad" id="id_ciudad">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($ciudades)) {
                                
                            $complemento = "";
                                   if( $result['id'] == $data_client['ciudadresidencia'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>
                        </select>
                    </p>
        		<p>
                        <label>Direcci&oacute;n de residencia:</label>
                        <input class="text-input small-input" type="text" id="direccionresidencia" name="direccionresidencia" value="<?php echo $data_client['direccionresidencia'];?>" /> 
                    </p>

        		<p>
                        <label>Tel&eacute;fono residencia:</label>
                        <input class="text-input small-input" type="text" id="telefonoresidencia" name="telefonoresidencia" value="<?php echo $data_client['telefonoresidencia1'];?>" /> 
                    </p>

        		<p>
                        <label>Empresa donde labora:</label>
                        <input class="text-input small-input" type="text" id="empresa" name="empresa" value="<?php echo $data_client['empresa'];?>" /> 
                    </p>
        		<p>
                        <label>Direcci&oacute;n laboral:</label>
                        <input class="text-input small-input" type="text" id="direccionlaboral" name="direccionlaboral" value="<?php echo $data_client['direccionlaboral'];?>" /> 
                    </p>
            <p>
                        <label>Ingresos mensuales: </label>        
                        <select name="id_ingresos" id="id_ingresos">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($ingresos_mensuales)) {
                                
                             $complemento = "";
                                   if( isset($data_client['ingresosmensuales']) && $result['id'] == $data_client['ingresosmensuales'])
                                        $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>
                        </select>
                    </p>   
                    <p>
                        <label>Egresos mensuales:</label>        
                        <select name="id_egresos" id="id_egresos">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($egresos_mensuales)) {
                             $complemento = "";
                                   if( isset($data_client['egresosmensuales']) && $result['id'] == $data_client['egresosmensuales'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>
                        </select>
                    </p>   
			
                    <input type="hidden" name="activos" id="activos" value="<?php echo $data_client['activos'];?>">
                    <input type="hidden" name="pasivos" id="pasivos" value="<?php echo $data_client['pasivos'];?>">
			<!--<p>
                        <label>Activos:</label>
                        <input class="text-input small-input" type="text" id="activos" name="activos" value="<?php //echo $data_client['activos'];?>" /> 
                    </p>
			<p>
                        <label>Pasivos:</label>
                        <input class="text-input small-input" type="text" id="pasivos" name="pasivos" value="<?php //echo $data_client['pasivos'];?>" /> 
                    </p>-->


                    <p>
                    <label>Dio usted respuesta libre marcando con una X a las preguntas indicadas en el t&iacute;tulo de capitalizaci&oacute;n y se le suministro informaci&oacute;n sobre el mismo?</label>
                    <select id="respuesta_libre" name="respuesta_libre">
                        <option value="">Seleccione...</option>
                        <option value="1">SI</option>
                        <option value="2">NO</option>
                        <option value="3">N/A</option>
                    </select>
                    </p>

        		<p>
                        <label>Celular:</label>
                        <input class="text-input small-input" type="text" id="celular" name="celular" value="<?php echo $data_client['celular'];?>" /> 
                    </p>
        		<p>
                        <label>Correo electronico:</label>
                        <input class="text-input small-input" type="text" id="correoelectronico" name="correoelectronico" value="<?php echo $data_client['correoelectronico'];?>" /> 
                    </p>
                    <p>
                        <label>Nacionalidad:</label>
                        <select id="nacionalidad" name="nacionalidad">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($paises as $pais) {
                            echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
                        }
    ?>
                        </select>
                    </p>
                    <p>
                        <label>Tiene otra nacionalidad?</label>
                        <select id="nacionalidad_otra" name="nacionalidad_otra">
                            <option value="">Seleccione...</option>
                            <option value="1">SI</option>
                            <option value="2">NO</option>
                            <option value="3">N/A</option>
                        </select>
                    </p>
                    <p>
                        <label>Cual?</label>
                        <select id="nacionalidad_cual" name="nacionalidad_cual" disabled>
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($paises as $pais) {
                            echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
                        }
    ?>
                        </select>
                    </p>
                    <p>
                        <label>Pais de residencia:</label>
                        <select id="pais_residencia" name="pais_residencia">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($paises as $pais) {
                            echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
                        }
    ?>
                        </select>
                    </p>
                    <p>
                        <label>Sujeto a obligaciones en otros paises?</label>
                        <select id="obligaciones_otras" name="obligaciones_otras">
                            <option value="">Seleccione...</option>
                            <option value="1">SI</option>
                            <option value="2">NO</option>
                            <option value="3">N/A</option>
                        </select>
                    </p>
                    <p>
                        <label>Cuales:</label>
                        <input type="text" name="obligaciones_paises" id="obligaciones_paises" disabled>
                    </p>


                    <p>
                        <label>Resultado de la gestión:</label>
                        <select name="id_contact" id="id_contact">
                            <option value="">--Seleccione una opción--</option>
                            <?php
                            while ($cont = mysqli_fetch_array($contact)) {
                                ?>
                                <option value="<?php echo $cont['id']; ?>"><?php echo $cont['description']; ?></option>
                                <?php
                            }
                            ?>        
                        </select>
                    </p>
		        <p>
                        <label>Observaci&oacute;n:</label>
          		   <textarea name="observacion" id="observacion"></textarea>
                    </p>
                    <p>
				<label>Grabaci&oacute;n:</label>
				<input type="file" name="grabacion" id="grabacion" />
			</p>
			<input type="hidden" name="id_client" id="id_client" value="<?php echo $id_client?>"/>
				<input type="hidden" name="persontype" id="persontype" value="1" />
	<p>

<?php elseif($persontype == "2"): 

$ciudades_ofippal = $general->getCiudades();
$actividades = $general->getActividades();
$egresos_mensuales= $general->getEgresosMensuales();
$ingresos_mensuales_emp = $general->getIngresosMensualesEmp();
$egresos_mensuales_emp = $general->getEgresosMensualesEmp();
?>
   <p>
                        <label>Razón social:</label>
                        <input class="text-input small-input" type="text" id="razonsocial" name="razonsocial"  value="<?php echo $data_client['firstname'];?>" /> 
                    </p>
                    <p>
                        <label>NIT:</label>
                        <input type="text" name="nit" id="nit" class="text-input small-input" value="<?php echo $data_client['document'];?>"/>
                        Cod. Verf.
                        <input type="text" name="digitochequeo" id="digitochequeo" size="4" class="text-input small-input" value="<?php echo $data_client['digitochequeo'];?>"/>
                    </p>
                    
                    <p>
                        <label>Ciudad oficina ppal.</label>        
                        <select name="ciudadoficina" id="ciudadoficina">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($ciudades_ofippal)) {   
                                $complemento = "";                                                              
                                if( isset($data_client['ciudadlaboral']) && $result['id'] == $data_client['ciudadlaboral'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>      
                        </select>
                    </p> 

                           <p>
                        <label>Dirección oficina ppal.</label>
                        <input class="text-input small-input" type="text" id="direccionoficinappal" name="direccionoficinappal" value="<?php echo $data_client['direccionlaboral'];?>" /> 
                    </p>
                    
                       <p>
                        <label>Teléfono oficina.</label>
                        <input class="text-input small-input" type="text" id="telefonoficina" name="telefonoficina" value="<?php echo $data_client['telefonolaboral'];?>" /> 
                    </p>
                    
                         <p>
                        <label>Actividad económica ppal.</label>        
                        <select name="actividadeconomicappal" id="actividadeconomicappal">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($actividades)) {  
                                $complemento = "";                                                              
                                if( isset($data_client['actividadeconomicappal']) && $result['id'] == $data_client['actividadeconomicappal'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>      
                        </select>
                    </p> 
                    
                         <p>
                        <label>Activos empresa.</label>
                        <input class="text-input small-input" type="text" id="activosemp" name="activosemp" value="<?php echo $data_client['activos'];?>"/> 
                    </p>
                    
                         <p>
                        <label>Pasivos empresa.</label>
                        <input class="text-input small-input" type="text" id="pasivosemp" name="pasivosemp" value="<?php echo $data_client['pasivos'];?>"/> 
                    </p>
                    
                    
                        <p>
                        <label>Ingresos mensuales empresa.</label>        
                        <select name="ingresosmensualesemp" id="ingresosmensualesemp">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($ingresos_mensuales_emp)) { 
                                $complemento = "";
                                if( isset($data_client['ingresos']) && $result['id'] == $data_client['ingresos'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>      
                        </select>
                    </p> 
                    
                    
                        <p>
                        <label>Egresos mensuales empresa.</label>        
                        <select name="egresosmensualesemp" id="egresosmensualesemp">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($egresos_mensuales_emp)) {
                                  $complemento = "";                                                              
                                if( isset($data_client['egresos']) && $result['id'] == $data_client['egresos'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>      
                        </select>
                    </p> 
                    
                    <p>
                    <label>Dio usted respuesta libre marcando con una X a las preguntas indicadas en el t&iacute;tulo de capitalizaci&oacute;n y se le suministro informaci&oacute;n sobre el mismo?</label>
                    <select id="respuesta_libre" name="respuesta_libre">
                        <option value="">Seleccione...</option>
                        <option value="1">SI</option>
                        <option value="2">NO</option>
                        <option value="3">N/A</option>
                    </select>
                    </p>
                    
                     <p>
                        <label>E-mail.</label>
                        <input class="text-input small-input" type="text" id="correoelectronico" name="correoelectronico"  value="<?php echo $data_client['correoelectronico'];?>"/> 
                    </p>
                    <p>
                        <label>Nacionalidad:</label>
                        <select id="nacionalidad" name="nacionalidad">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($paises as $pais) {
                            echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
                        }
    ?>
                        </select>
                    </p>
                    <p>
                        <label>Tiene otra nacionalidad?</label>
                        <select id="nacionalidad_otra" name="nacionalidad_otra">
                            <option value="">Seleccione...</option>
                            <option value="1">SI</option>
                            <option value="2">NO</option>
                            <option value="3">N/A</option>
                        </select>
                    </p>
                    <p>
                        <label>Cual?</label>
                        <select id="nacionalidad_cual" name="nacionalidad_cual" disabled>
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($paises as $pais) {
                            echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
                        }
    ?>
                        </select>
                    </p>
                    <p>
                        <label>Pais de residencia:</label>
                        <select id="pais_residencia" name="pais_residencia">
                            <option value="">Seleccione...</option>
    <?php
                        foreach ($paises as $pais) {
                            echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
                        }
    ?>
                        </select>
                    </p>
                    <p>
                        <label>Sujeto a obligaciones en otros paises?</label>
                        <select id="obligaciones_otras" name="obligaciones_otras">
                            <option value="">Seleccione...</option>
                            <option value="1">SI</option>
                            <option value="2">NO</option>
                            <option value="3">N/A</option>
                        </select>
                    </p>
                    <p>
                        <label>Cuales:</label>
                        <input type="text" name="obligaciones_paises" id="obligaciones_paises" disabled>
                    </p>
                    <p>
                        <label>Resultado de la gestión:</label>
                        <select name="id_contact" id="id_contact">
                            <option value="">--Seleccione una opción--</option>
                            <?php
                            while ($cont = mysqli_fetch_array($contact)) {
                                ?>
                                <option value="<?php echo $cont['id']; ?>"><?php echo $cont['description']; ?></option>
                                <?php
                            }
                            ?>        
                        </select>
                    </p>
                    <p>
                        <label>Observaciones</label>
                        <textarea id="observacion" name="observacion"></textarea>				
                    </p>
                    <p>
				<label>Grabaci&oacute;n:</label>
				<input type="file" name="grabacion" id="grabacion" />
			</p>
                    <p>

			<input type="hidden" name="id_client" id="id_client" value="<?php echo $id_client?>"/>
				<input type="hidden" name="persontype" id="persontype" value="2" />
                    </p>

<?php endif; 

	if( $count_display > 0 ) { 
	} else {
	?>
		   <input class="button" type="submit" value="Guardar actualización>>" /><!-- onclick="$(this).attr('disabled','disabled');"-->
    <?php
	}
	?>

		 
		</p>
                </fieldset>
		</form>
<script type="text/javascript">
$(document).ready(function(){
    $('select[name="nacionalidad_otra"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '1'){
            $('select[name="nacionalidad_cual"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('select[name="nacionalidad_cual"]').val('');
            $('select[name="nacionalidad_cual"]').change();
            $('select[name="nacionalidad_cual"]').attr('disabled', 'disabled');
        }
    });
    $('select[name="obligaciones_otras"]').change(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($(this).val() == '1'){
            $('input[name="obligaciones_paises"]').removeAttr('disabled');
        }else if($(this).val() != ''){
            $('input[name="obligaciones_paises"]').val('');
            $('input[name="obligaciones_paises"]').attr('disabled', 'disabled');
        }
    });
    /*$('form#confirmClientCapi').submit(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($('select[name="nacionalidad_otra"]').val() == ''){
            alert('Debe seleccionar una opcion para la pregunta "Tiene otra nacionalidad?".');
            $('select[name="nacionalidad_otra"]').focus();
            return false;
        }else if($('select[name="nacionalidad_otra"]').val() == '1' && $('select[name="nacionalidad_cual"]').val() == ''){
            alert('Debe seleccionar "Cual?" nacionalidad tiene como otra nacionalidad.');
            $('select[name="nacionalidad_cual"]').focus();
            return false;
        }
        if($('select[name="obligaciones_otras"]').val() == ''){
            alert('Debe seleccionar una opcion para la pregunta "Sujeto a obligaciones en otros paises?".');
            $('select[name="obligaciones_otras"]').focus();
            return false;
        }else if($('select[name="obligaciones_otras"]').val() == '1' && $('input[name="obligaciones_paises"]').val() == ''){
            alert('Debe digitar en "Cuales?" paises tiene obligaciones.');
            $('input[name="obligaciones_paises"]').focus();
            return false;
        }
        var form = this;
        form.submit();
    });*/
})
</script>
                <div class="clear"></div><!-- End .clear -->

        </div> <!-- End #tab2 -->    
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->
<!--
<p>
<label>Dio usted respuesta libre marcando con una X a las preguntas indicadas en el t&iacute;tulo de capitalizaci&oacute;n y se le suministro informaci&oacute;n sobre el mismo?</label>
<select id="respuesta_libre" name="respuesta_libre">
    <option value="">Seleccione...</option>
    <option value="1">SI</option>
    <option value="2">NO</option>
</select>
</p>
-->
<?php
}
require_once PATH_SITE . DS . 'template/general/footer.php';
