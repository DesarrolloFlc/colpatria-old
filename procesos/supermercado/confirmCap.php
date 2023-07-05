<?php
session_start();
require_once '../../includes.php';
require_once '../../template/general/header.php';
require_once PATH_CCLASS.DS.'supermercado.class.php';

extract($_GET);

if( empty($_SESSION['id']) OR empty($_SESSION['group']) ) {
	echo "<br>No tiene permisos, por favor logueese nuevamente.";
	exit;
}
	

if( empty($persontype) ) {
	$data_agente = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT persontype FROM sup_client WHERE id = '$id_client'"));
	$persontype = $data_agente['persontype'];
}

if (empty($id_client) || empty($persontype)) {
    echo "<h1>No ha seleccionado ningún cliente</h1>";
    exit;
}

$data_client = Supermercado::getDataCapi($id_client);
if(isset($data_client['error'])){
    $errorbusq = $data_client['error'];
    echo "
    <script>
        alert('ATENCION!!!!  $errorbusq');
    </script>";
}
$ciudades = Supermercado::getCiudades();
$contacts = Supermercado::getContacts();
$profesiones = Supermercado::getProfesiones();
$ingresos_mensuales = Supermercado::getIngresosMensuales();
$egresos_mensuales = Supermercado::getEgresosMensuales();
$estados_civiles = Supermercado::getEstadosCiviles();
$estudios = Supermercado::getEstudios();



//Data capi
$lastDateConfirm = Supermercado::getLastConfirmCapi($id_client);
$count_display = 0;

//Data general
$lastDateConfirm2 = Supermercado::getLastConfirmSeg($id_client);
$sepuede = true;
if(isset($lastDateConfirm['date_created']) || isset($lastDateConfirm2['date_created'])){
    if(isset($lastDateConfirm['date_created']) && $lastDateConfirm['date_created'] != "") {
    	if((date("Y-m-d", strtotime($lastDateConfirm['date_created']))) >= (date("Y-m-d", strtotime("-10 month"))) ){
    	   $sepuede = false;
           echo "<script>
                    alert('ATENCION!!!!  El cliente no se puede confirmar.');
                </script>";	
    		$count_display++;
    	} 
    }elseif(isset($lastDateConfirm2['date_created']) && $lastDateConfirm2['date_created'] != "") {
        if ((date("Y-m-d", strtotime($lastDateConfirm2['date_created']))) >= (date("Y-m-d", strtotime("-10 month")))) {
            $sepuede = false;
           echo "<script>
                    alert('ATENCION!!!!  El cliente no se puede confirmar.');
                </script>"; 
            $count_display++;
        }
    }
}
?>

<!-- Page Head -->
<h2>Confirmación de cliente en CAPI Supermercado</h2>
<p id="page-intro">Actualización de datos del cliente</p>

<div class="clear"></div> <!-- End .clear -->
<div style="float: right"><a href="viewClientSup.php?id_client=<?php echo $id_client ?>" class="button">Regresar al cliente >></a></div>
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
			<td><?php echo $data_client['documento']?></td>
		</tr>
		<tr>
			<td><b>Nombres:</b></td>
			<td><?php echo $data_client['nombres']." ".$data_client['primerapellido']." ".$data_client['segundoapellido']?></td>
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
			<td><?php echo $data_client['ciudadlaborall']?></td>
		</tr>
		<tr>
			<td><b>Direcci&oacute;n laboral:</b></td>
			<td><?php echo $data_client['direccionlaboral']?></td>
			<td><b>Telefono laboral:</b></td>
			<td><?php echo $data_client['telefonolaboral']?></td>
		</tr>
		<tr>
			<td><b>Ciudad residencia:</b></td>
			<td><?php echo $data_client['ciudadresidenciaa']?></td>
			<td><b>Direcci&oacute;n de residencia:</b></td>
			<td><?php echo $data_client['direccionresidencia']?></td>
		</tr>
		<tr>
			<td><b>Telefono residencia:</b></td>
			<td><?php echo $data_client['telefonoresidencia1']?></td>
			<td><b>Telefono residencia:</b></td>
			<td><?php echo $data_client['telefonoresidencia2']?></td>
		</tr>
        <tr>
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
			<td><?php echo $data_client['nit']?></td>
			<td><b>Raz&oacute;n social:</b></td>
			<td><?php echo $data_client['razonsocial']?></td>
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
		<form  action="saveContactCapi.php" id="confirmClientCapi" name="confirmClientCapi"  method="POST" enctype="multipart/form-data" target="grp1">
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->



<?php if($persontype == "1"): ?>
                    <p>
                        <label>Cédula:</label>
                        <input class="text-input small-input" type="text" id="documento" name="documento" value="<?php echo $data_client['documento'];?>" /> 
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
                            for( $i = 0;  $i < 7; $i++ ) {                                
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
                            foreach ($estados_civiles as $result) {
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
                            foreach ($estudios as $result) {
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
                            foreach($profesiones as $result){
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
                            foreach($ciudades as $result) {
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
                            foreach($ingresos_mensuales as $result) {
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
                            foreach ($egresos_mensuales as $result) {
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
                        <label>Celular:</label>
                        <input class="text-input small-input" type="text" id="celular" name="celular" value="<?php echo $data_client['celular'];?>" /> 
                    </p>
        		<p>
                        <label>Correo electronico:</label>
                        <input class="text-input small-input" type="text" id="correoelectronico" name="correoelectronico" value="<?php echo $data_client['correoelectronico'];?>" /> 
                    </p>



                    <p>
                        <label>Resultado de la gestión:</label>
                        <select name="id_contact" id="id_contact">
                            <option value="">--Seleccione una opción--</option>
                            <?php
                            foreach($contacts as $cont) {
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

<?php elseif($persontype == "2"): ?>
<?php 

$ciudades_ofippal = Supermercado::getCiudades();
$actividades = Supermercado::getActividades();
//$egresos_mensuales = Supermercado::getEgresosMensuales();
$ingresos_mensuales_emp = Supermercado::getIngresosMensualesEmp();
$egresos_mensuales_emp = Supermercado::getEgresosMensualesEmp();
?>
   <p>
                        <label>Razón social:</label>
                        <input class="text-input small-input" type="text" id="razonsocial" name="razonsocial"  value="<?php echo $data_client['razonsocial'];?>" /> 
                    </p>
                    <p>
                        <label>NIT:</label>
                        <input type="text" name="nit" id="nit" class="text-input small-input" value="<?php echo $data_client['nit'];?>"/>
                        Cod. Verf.
                        <input type="text" name="digitochequeo" id="digitochequeo" size="4" class="text-input small-input" value="<?php echo $data_client['digitochequeo'];?>"/>
                    </p>
                    
                    <p>
                        <label>Ciudad oficina ppal.</label>        
                        <select name="ciudadoficina" id="ciudadoficina">
                            <option value="">-Opciones-</option>
                            <?php
                            foreach ($ciudades_ofippal as $result) {
                                $complemento = "";
                                if( isset($data_client['ciudadoficina']) && $result['id'] == $data_client['ciudadoficina'])
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
                            foreach ($actividades as $result) {
                                $complemento = "";
                                if( isset($data_client['actividadeconomicappal']) && $result['id'] == $data_client['
                                    actividadeconomicappal'])
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
                            foreach ($ingresos_mensuales_emp as $result) {
                                $complemento = "";
                                if( isset($data_client['ingresosmensualesemp']) && $result['id'] == $data_client['ingresosmensualesemp'])
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
                            foreach ($egresos_mensuales_emp as $result) {
                                $complemento = "";
                                if( isset($data_client['egresosmensualesemp']) && $result['id'] == $data_client['egresosmensualesemp'])
                                    $complemento = "selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                            ?>      
                        </select>
                    </p> 
                    
                    
                     <p>
                        <label>E-mail.</label>
                        <input class="text-input small-input" type="text" id="correoelectronico" name="correoelectronico"  value="<?php echo $data_client['correoelectronico'];?>"/> 
                    </p>
                    <p>
                        <label>Resultado de la gestión:</label>
                        <select name="id_contact" id="id_contact">
                            <option value="">--Seleccione una opción--</option>
                            <?php
                            foreach($contacts as $cont) {
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

<?php endif; ?>


<?php 
	if( $count_display > 0 ) {
	?>		
	<?php 
	} else {
	?>
		   <input class="button" type="submit" value="Guardar actualización>>" /><!-- onclick="$(this).attr('disabled','disabled');"-->
    <?php
	}
	?>

		 
		</p>
                </fieldset>
        <iframe  width="1" height="1" id="grp1" name="grp1" style="visibility:hidden"></iframe><!---->
		</form>
                <div class="clear"></div><!-- End .clear -->

        </div> <!-- End #tab2 -->    
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->
<?php
}
require_once '../../template/general/footer.php';
?>
