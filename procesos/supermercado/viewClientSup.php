<?php
session_start();


if( $_SESSION['group'] == "1" || $_SESSION['group'] == "2"  || $_SESSION['group'] == "3" || $_SESSION['group'] == "4" || $_SESSION['group'] == "5" || $_SESSION['group'] == "6" || $_SESSION['group'] == "7" || $_SESSION['group'] == "8") {
require_once '../../includes.php';
require_once PATH_CCLASS.DS.'supermercado.class.php';
require_once '../../template/general/header.php';
require_once '../../lib/class/client.class.php';
require_once '../../lib/class/form.class.php';
require_once '../../lib/class/image.class.php';
require_once '../../lib/class/migraGrabacion.class.php';
require_once '../../lib/class/migraImages.class.php';
require_once '../../lib/class/contactcapi.class.php';
require_once '../../lib/class/contact.class.php';
require_once '../../lib/class/user.class.php';


extract($_GET);

if (empty($id_client)) {
    echo "<h1>No ha seleccionado ning煤n cliente</h1>";
}

$clients = new Client();
$client = mysqli_fetch_array($clients->getSup($id_client));

$form = new Form();
$forms = $form->getFormsSupCap($id_client);
$formsS = $form->getFormsSupSeg($id_client);
$count_forms = mysqli_num_rows($forms);

//$image = new Image();

/*$migra_grabacion = new migraGrabacion();
$migra_grabaciones = $migra_grabacion->getGrabaciones($client['document']);
$migra_image = new migraImages();
$migra_images = $migra_image->getImagesMigra($client['document']);*/

//Historico de gestiones
$contact_histo = Supermercado::getContactTelfSeg($id_client);

$contactcapi_histo = Supermercado::getContactTelfCapi($id_client);
//$devoluciones = $form->getDevolucion($client['document']);

$user = new User();

?>

<!-- Page Head -->
<h2>Detalle del cliente</h2>
<p id="page-intro">Visi贸n general del cliente: </p>

<div class="clear"></div> <!-- End .clear -->
<div style="float: right"><a href="consulta_general.php" class="button">Regresar a la b&uacute;squeda</a></div>
<div class="clear"></div> <!-- End .clear -->
<br />
<div class="notification information png_bg">
    <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
    <div>
        Los movimientos de consulta que realice son guardados y monitoreados por su seguridad.
    </div>
</div>

<div class="clear"></div> <!-- End .clear -->

<div style="float: left; width: 400px; height: auto">
    <p>
        Nombre del cliente: <?php echo utf8_encode($client['firstname']) . " " . utf8_encode($client['lastname']); ?>
    </p>
    <p>
        Identificaci贸n: <span id="identificacionid" style="border:0;padding:0;margin:0"><?php echo $client['document']; ?></span><?php if( $_SESSION['group'] == "6"): ?><span id='editardocumentoSup'><img src="../../resources/images/icons/edit.png" alt="editar"/></span><?php endif; ?>
    </p>
</div>
<div style="float: left; width:400px; height:auto">
    <p>
        Tipo de cliente: <?php echo (($client['persontype'] == 1) ? "Natural" : "Jur铆dica"); ?>
    </p>
    <p>
        Cantidad de formularios: <?php echo $count_forms; ?>
    </p>
</div>

<div class="clear"></div> <!-- End .clear -->

<?php
if( $_SESSION['group'] == "4" || $_SESSION['group'] == "6"  || $_SESSION['group'] == "8" || $_SESSION['group'] == "3") {
	if( $client['campania'] == "2" || $client['campania'] == "3"){
?>
<input type="button" class="button" onClick="location.href='confirmClient.php?id_client=<?php echo $id_client;?>&persontype=<?php echo $client['persontype'];?>'" value="Confirmar generales >>" />

<?php
	}
if( $client['campania'] == "1" || $client['campania'] == "3"):?>
<input type="button" class="button" onClick="location.href='confirmCap.php?id_client=<?php echo $id_client;?>&persontype=<?php echo $client['persontype'];?>'" value="Confirmar CAPI >>" />
<?php endif;?>


<?php
}
?>


<br /><br /><br />

<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Datos del cliente</h3>
        <ul class="content-box-tabs">
        <?php
        $defaS = '';
        $defaC = '';
        if($client['campania'] == "2"){$defaS = "default-tab";$defaC = "";}
        elseif($client['campania'] == "1"){$defaC = "default-tab";$defaS = "";}
        elseif($client['campania'] == "3"){$defaS = "default-tab";$defaC = "";}
        if($client['campania'] == "2" || $client['campania'] == "3"){
        	?>
            <li><a href="#tab3" class="<?=$defaS?>">Datos Seguros</a></li> <!-- href must be unique and match the id of target div -->
        <?php
    	}
    	if($client['campania'] == "1" || $client['campania'] == "3"){?>
    		<li><a href="#tab4" class="<?=$defaC?>">Datos Capi</a></li> <!-- href must be unique and match the id of target div -->
        <?php
    	}
		if( $_SESSION['group'] == "1" || $_SESSION['group'] == "6"  || $_SESSION['group'] == "4"  || $_SESSION['group'] == "3" || $_SESSION['group'] == "8"):
			if($client['campania'] == "2" || $client['campania'] == "3"){?>
            <li><a href="#tab20" >Contactos telef&oacute;nicos</a></li> <!-- href must be unique and match the id of target div -->
		<?php 
			}
			if( $client['campania'] == "1" || $client['campania'] == "3"):?>
			<li><a href="#tab21" >Contactos Capi</a></li><?php endif;?>
		<?php endif;?>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
    	<div class="tab-content <?=$defaC?>" id="tab4">
            <table>
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha de publicaci贸n</th>                        
                        <th>Acciones</th>     
			   			<?php if( $_SESSION['group'] == "6" || $_SESSION['group'] == "3"  || $_SESSION['group'] == "7"  || $_SESSION['group'] == "5"  || $_SESSION['group'] == "8"): ?>
			   			<?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($form_detail = mysqli_fetch_array($forms)) {                    	
                        ?>
                        <tr>
                            <td>Datos</td>
                            <td><?php echo $form_detail['date_created'];?></td>
                            <td>
                                <a href="" onClick="window.open('viewDataCapi.php?id_data=<?php echo $form_detail['id'];?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" ><img src="../../resources/images/icons/show.jpg" alt="Ver detalles del cliente" /></a>
							<?php if( $_SESSION['group'] == "6"): ?>
                                <a href="" onClick="window.open('editDataCapi.php?id_data=<?php echo $form_detail['id'];?>&type=<?php echo $client['persontype']?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" ><img src="../../resources/images/icons/edit.png" alt="Editar formulario" /></a>                                
                                <!--<a href="../lib/general/procesos.php?action=disable_form&id_data=<?php //echo $form_detail['id']?>" class="disable_form" target="_blank" ><img src="../../resources/images/icons/cross.png" alt="Desactivar formulario" /></a>-->
							<?php endif; ?>
                            </td>
							<?php if( $_SESSION['group'] == "6" || $_SESSION['group'] == "3"  || $_SESSION['group'] == "7"  || $_SESSION['group'] == "5"  || $_SESSION['group'] == "8"): ?>
							<?php endif; ?>
                        </tr>
                        <?php
                    }?>
                </tbody>
            </table>
        </div>
        <div class="tab-content <?=$defaS?>" id="tab3">
            <table>
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha de publicaci贸n</th>                        
                        <th>Acciones</th>     
			   			<?php if( $_SESSION['group'] == "6" || $_SESSION['group'] == "3"  || $_SESSION['group'] == "7"  || $_SESSION['group'] == "5"  || $_SESSION['group'] == "8"): ?>
			   			<?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($form_detailS = mysqli_fetch_array($formsS)) {                    	
                        ?>
                        <tr>
                            <td>Datos</td>
                            <td><?php echo $form_detailS['fecha_creacion'];?></td>
                            <td>
                                <a href="" onClick="window.open('viewData.php?id_data=<?php echo $form_detailS['id'];?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" ><img src="../../resources/images/icons/show.jpg" alt="Ver detalles del cliente" /></a>
							<?php if( $_SESSION['group'] == "6"): ?>
                                <a href="" onClick="window.open('editData.php?id_data=<?php echo $form_detailS['id'];?>&type=<?php echo $client['persontype']?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" ><img src="../../resources/images/icons/edit.png" alt="Editar formulario" /></a>                                
                                <!--<a href="../lib/general/procesos.php?action=disable_form&id_data=<?php //echo $form_detailS['id']?>" class="disable_form" target="_blank" ><img src="../../resources/images/icons/cross.png" alt="Desactivar formulario" /></a>-->
							<?php endif; ?>
                            </td>
							<?php if( $_SESSION['group'] == "6" || $_SESSION['group'] == "3"  || $_SESSION['group'] == "7"  || $_SESSION['group'] == "5"  || $_SESSION['group'] == "8"): ?>
							<?php endif; ?>
                        </tr>
                        <?php
                    }?>
                </tbody>
            </table>
        </div>
	<?php 
	if( $_SESSION['group'] == "1" || $_SESSION['group'] == "6" || $_SESSION['group'] == "4" || $_SESSION['group'] == "3" || $_SESSION['group'] == "8"):?>
	<div class="tab-content" id="tab20">
		<table>
		<thead>
			<tr>
				<th>Tipo</th>
				<th>Contacto</th>
				<th>Observaci&oacute;n</th>
				<th>Gestor</th>
				<th>Fecha creaci&oacute;n</th>
				<th>Grabaci&oacute;n</th>
				<?php if( $_SESSION['group'] == "6" || $_SESSION['group'] == "8"): ?>
					<th>Acciones</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(!isset($contact_histo['error'])){
			foreach($contact_histo as $contacto){?>
			<tr>
				<td><?php echo $contacto['type']?></td>
				<td><?php echo $contacto['description']?></td>
				<td><?php echo $contacto['observacion']?></td>
				<td><?php echo $contacto['name']?></td>
				<td><?php echo $contacto['date_created']?></td>
				<td>
					<?php if( !empty($contacto['filename'])): ?>	
					<embed width="45" height="30" autostart="false" loop="false" playcount="1" src="../../../<?php echo $contacto['filename']?>"/>
					<?php endif;?>
				</td>
				<?php if( $_SESSION['group'] == "6"): ?>
				<td><img src="../../resources/images/icons/cross.png" alt="Desactivar formulario" /></td>
				<?php endif; ?>
			</tr>				
			<?php
			}
			}
			?>
		</tbody>
		</table>
	</div>
	<div class="tab-content" id="tab21">
		<table>
		<thead>
			<tr>
				<th>Tipo</th>
				<th>Contacto</th>
				<th>Acciones</th>
				<th>Observaci&oacute;n</th>
				<th>Gestor</th>
				<th>Fecha creaci&oacute;n</th>
				<th>Grabaci&oacute;n</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(!isset($contactcapi_histo['error'])){
			foreach($contactcapi_histo as $contacto2){?>
			<tr>
				<td><?php echo $contacto2['type']?></td>
				<td><?php echo $contacto2['description']?></td>	
				<td><a href="" onClick="window.open('viewDataCapi.php?id_data_capi=<?php echo $contacto2['id'];?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=600, height=400, top=85, left=140');return false;"><img src="../../resources/images/icons/edit.png" alt="Ver detalle" /></a></td>
				<td><?php echo $contacto2['observacion']?></td>
				<td><?php echo $contacto2['name']?></td>
				<td><?php echo $contacto2['date_created']?></td>
				<td>
					<?php if( !empty($contacto2['filename'])): ?>	
					<embed width="45" height="30" autostart="false" loop="false" playcount="1" src="../../../<?php echo $contacto2['filename']?>">
					<?php endif;?>
				</td>
			</tr>				
			<?php
			}
			}
			?>
		</tbody>
		</table>
	</div>	
	<?php endif; ?>
    </div>
</div>

	

<?php if( $_SESSION['group'] == 1 ||  $_SESSION['group'] == 6  ||  $_SESSION['group'] == 2  || $_SESSION['group'] == "8"  || $_SESSION['group'] == "4" ): ?>

<!--<div class="content-box"><!-- Start Content Box -->
    <!--<div class="content-box-header">
        <h3>Datos de migraci&oacute;n</h3>
        <ul class="content-box-tabs">
	     <li><a href="#tab2" class="default-tab">Im&aacute;genes</a></li> 
		<?php //if( $_SESSION['group'] != 2): ?>
            <li><a href="#tab5">Grabaciones</a></li>
		<?php //endif; ?>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <!--<div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                     
		<?php //while($miimage = mysqli_fetch_array($migra_images)) : ?>
		<tr>
			<td><?php //echo $miimage['filename'];?></td>
			<td><a href="" onClick="window.open('viewImageMigracion.php?nombre=<?php //echo $miimage['filename'];?>&document=<?php //echo $client['document']?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=830, height=540, top=85, left=140');return false;"><img src="../images/icons/show.gif" width="25" height="25" alt="Reproducir" /></a></td>
		</tr>
		<?php //endwhile; ?>                            
                                </tbody>
                            </table>
	</div>       

		<?php //if( $_SESSION['group'] != 2): ?>
	<div class="tab-content" id="tab5">
		<table>
		<thead>
		<tr>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Tel&eacute;fono</th>
            <th>Acciones</th>
		</tr>
		</thead>
		<tbody>
		<?php //while($migrabacion = mysqli_fetch_array($migra_grabaciones)) : ?>
		<tr>
			<td><?php //echo $migrabacion['date'];?></td>
			<td><?php //echo $migrabacion['hour'];?></td>
			<td><?php //echo $migrabacion['phone'];?></td>
			<td><a href="http://200.30.84.34/grabaciones_colpatria/salida/<?php //echo $migrabacion['file'];?>"><img src="../resources/images/icons/icon_sound.gif" width="25" height="25" alt="Reproducir" /></a></td>
		</tr>
		<?php //endwhile; ?>
		</tbody>
		</table>		
	</div>			
	<?php //endif; ?>
    </div>
</div>-->
<?php endif; ?>
<input type="hidden" name="id_client1" id="id_client1" value="<?php echo $_GET['id_client']?>" />
<div class="clear"></div> <!-- End .clear -->
<?php
require_once '../../template/general/footer.php';

} else {
echo "<h2>No tiene permisos para acceder a esta 醨ea</h2>";
}
?>
