<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["1", "2", "3", "4", "5", "6", "7", "8", "10", "11"])) {
	echo "<h2>No tiene permisos para acceder a esta �rea</h2>";
	exit;
}
require_once dirname(dirname(__FILE__)) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'client.class.php';
require_once PATH_CCLASS . DS . 'form.class.php';
require_once PATH_CCLASS . DS . 'image.class.php';
require_once PATH_CCLASS . DS . 'migraGrabacion.class.php';
require_once PATH_CCLASS . DS . 'migraImages.class.php';
require_once PATH_CCLASS . DS . 'contactcapi.class.php';
require_once PATH_CCLASS . DS . 'contact.class.php';
require_once PATH_CCLASS . DS . 'user.class.php';
extract($_GET);

if(empty($id_client)){
	echo "<h1>No ha seleccionado ningún cliente</h1>";
	exit;
}

$clients = new Client();
$client = mysqli_fetch_array($clients->get($id_client));

$form = new Form();
$forms = $form->getForms($id_client);
$count_forms = mysqli_num_rows($forms);
$fromdocespe = mysqli_fetch_array($form->getCountFormsEspecial($client['document']));

$image = new Image();

$migra_grabacion = new migraGrabacion();
$migra_grabaciones = $migra_grabacion->getGrabaciones($client['document']);
$migra_image = new migraImages();
$migra_images = $migra_image->getImagesMigra($client['document']);

//Historico de gestiones
$contacts = new Contact();
$contact_histo = $contacts->getContactTelf($id_client);

$contactscapi = new Contactcapi();
$contactcapi_histo = $contactscapi->getContactTelf($id_client);

$devoluciones = $form->getDevolucion($client['document']);

$user = new User();
$matriz = Client::listadataMatriz($id_client);
$evidencias = Client::obtenerEvidencias($client['document']);
?>
<!-- Page Head -->
<h2>Detalle del cliente</h2>
<p id="page-intro">Visión general del cliente: </p>

<div class="clear"></div> <!-- End .clear -->
<div style="float: right"><a href="index.php" class="button">Regresar a la b&uacute;squeda</a></div>
<div class="clear"></div> <!-- End .clear -->
<br />
<div class="notification information png_bg">
	<a href="#" class="close"><img src="../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
	<div>
		Los movimientos de consulta que realice son guardados y monitoreados por su seguridad.
	</div>
</div>

<div class="clear"></div> <!-- End .clear -->

<div style="float: left; width: 400px; height: auto">
	<p>
		Nombre del cliente: <?php echo $client['firstname'] . " " . $client['lastname']; ?>
	</p>
	<p>
		Identificación: <span id="identificacionid" style="border:0;padding:0;margin:0"><?php echo $client['document']; ?></span><?php if ($_SESSION['group'] == "6"): ?><span id='editardocumento'><img src="../resources/images/icons/edit.png" alt="editar"/></span><?php endif; ?>
	</p>
</div>
<div style="float: left; width:400px; height:auto">
	<p>
		Tipo de cliente: <?php echo (($client['persontype'] == 1) ? "Natural" : "Jurídica"); ?>
	</p>
	<p>
		Cantidad de formularios: <?php echo $count_forms; ?>
	</p>
</div>
<div style="float: left; width:400px; height:auto">
	<p>
		Regimen: <?=$client['regimen_str']?>
	</p>
</div>
<div class="clear"></div> <!-- End .clear -->

<?php
if($_SESSION['group'] == "4" || $_SESSION['group'] == "6" || $_SESSION['group'] == "3") {//$_SESSION['group'] == "8" || 
?>
	<input type="button" class="button" onClick="location.href = 'callprocess/confirmClient.php?id_client=<?=$id_client;?>&persontype=<?=$client['persontype'];?>'" value="Confirmar cliente >>" />
<?php
	if($client['capi'] == "Si"){
?>
	<input type="button" class="button" onClick="location.href = 'callprocess/confirmCap.php?id_client=<?=$id_client;?>&persontype=<?=$client['persontype'];?>'" value="Confirmar CAPI >>" />
<?php
	}
	if($fromdocespe["cant"] > 0){
?>
					<!--<input type="button" class="button" onClick="location.href = 'callprocess/confirmug045.php?id_client=<?php echo $id_client; ?>&persontype=<?php //echo $client['persontype'];  ?>'" value="Confirmar UG045 >>" />-->
<?php
	}
}
?>
<br /><br /><br />
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<h3>Formularios del cliente</h3>
		<ul class="content-box-tabs">
<?php
if (isset($evidencias) && $evidencias !== false) {
?>
			<li><a href="#tab23">Evidencias de verificaciones</a></li>
<?php
}
if(isset($matriz) && is_array($matriz)){
?>
			<li><a href="#tab22">Registro matriz</a></li>
<?php
}
?>
			<li><a href="#tab4">Im&aacute;genes autos</a></li>
			<li><a href="#tab3" class="default-tab">Formularios</a></li> <!-- href must be unique and match the id of target div -->
<?php
if($_SESSION['group'] == "1" || $_SESSION['group'] == "6" || $_SESSION['group'] == "4" || $_SESSION['group'] == "3" || $_SESSION['group'] == "8"){
?>
			<li><a href="#tab20" >Contactos telef&oacute;nicos</a></li> <!-- href must be unique and match the id of target div -->
<?php
	if($client['capi'] == "Si"){
?>
			<li><a href="#tab21" >Contactos Capi</a></li>
<?php
	}
}
?>
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
<?php
if (isset($evidencias) && $evidencias !== false) {
?>
		<div class="tab-content" id="tab23">
			<table>
				<thead>
					<tr>
						<th>Radicado</th>
						<th>Resultado</th>
						<th>Creador</th>
						<th>Fecha de cargue</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
<?php
	foreach ($evidencias as $evidencia) {
?>
					<tr>
						<td><?=$evidencia['id_radicados']?></td>
						<td><?=$evidencia['resultado']?></td>
						<td><?=$evidencia['name']?></td>
						<td><?=date('Y-m-d h:i:s a', strtotime($evidencia['fecha_creacion']))?></td>
						<td><a href="#" onClick="$(this).mostrarEvidencias(event, <?=$evidencia['radicado_item_id']?>)">
							<img src="../resources/images/icons/show.jpg" alt="Ver evidencias" /></a>
						</td>
					</tr>
<?php
	}
?>
				</tbody>
			</table>
		</div>
<?php
}
if(isset($matriz) && is_array($matriz)){
?>
		<div class="tab-content" id="tab22">
			<table>
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Creaci&oacute;n de cliente</th>
						<th>Formularios</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Matriz consolidado</td>
						<td><?=date('Y-m-d h:i:s a', strtotime($client['date_created']))?></td>
						<td><?=$matriz['cantidad_registros']?></td>
						<td><a href="" onClick="window.open('editFormMatriz.php?id=<?=$matriz["id"]?>&type=<?=$client['persontype']?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=760, height=620, top=85, left=140'); return false;" target="_blank">
							<img src="../resources/images/icons/show.jpg" alt="Ver imagen" /></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
<?php
}
?>
		<div class="tab-content" id="tab4">
			<table>
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Cantidad imágenes</th>
						<th>Fecha de publicación</th>
						<th>Usuario</th>
						<th>Acciones</th> 
					</tr>
				</thead>
				<tbody>
<?php
$aut = $form->fomrAutos($id_client);
while($autos = mysqli_fetch_array($aut)){
?>
					<tr>
						<td>Autos</td>
						<td>1</td>
						<td><?=date('Y-m-d h:i:s a', strtotime($autos['date_created']))?></td>
						<td><?=$user->getName($autos['id_usuario'])?></td>
						<td><a href="" onClick="window.open('viewImgAutos.php?id_image=<?=$autos["id"]?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=760, height=620, top=85, left=140'); return false;" target="_blank">
							<img src="../resources/images/icons/show.jpg" alt="Ver imagen" /></a>
						</td>
					</tr>
<?php
}
?>
				</tbody>
			</table>
		</div>
		<div class="tab-content default-tab" id="tab3">
			<table>
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Cantidad imágenes</th>
						<th>Fecha de publicación</th>                        
						<th>Acciones</th>
<?php
if($_SESSION['group'] == "6" || $_SESSION['group'] == "3" || $_SESSION['group'] == "7" || $_SESSION['group'] == "5" || $_SESSION['group'] == "8"){
?>
						<th>Planilla</th>
						<th>Lote</th>
<?php
}
?>
						<th>Usuario</th>
					</tr>
				</thead>
				<tbody>
<?php
while($form_detail = mysqli_fetch_array($forms)){
?>
					<tr>
						<td><?=($form_detail['formulario'] == 16) ? "Actualizaci&oacute;n masiva" : "Formulario" ?></td>
						<td><?=$form_detail['num_images']?></td>
						<td><?=date('Y-m-d h:i:s a', strtotime($form_detail['date_created']));?></td>
						<td>
<?php
	if($form_detail['formulario'] != 16){
?>
							<a href="" onClick="window.open('viewForm.php?id_forma=<?php echo $form_detail['id']; ?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" >
								<img src="../resources/images/icons/show.jpg" alt="Ver detalles del cliente" />
							</a>
<?php
	}
	if ($_SESSION['group'] == "6"){
		if(!is_null($form_detail['formulario']) && !empty($form_detail['formulario'])){
?>
							<a href="" onClick="window.open('editForm.php?id_form=<?php echo $form_detail['id']; ?>&type=<?php echo $client['persontype'] ?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140'); return false;" target="_blank" >
								<img src="../resources/images/icons/edit.png" alt="Editar formulario" />
							</a>
<?php
		}
?>
							<a href="../lib/general/procesos.php?action=disable_form&id_form=<?php echo $form_detail['id'] ?>" class="disable_form" target="_blank" >
								<img src="../resources/images/icons/cross.png" alt="Desactivar formulario" />
							</a>
							<a href="" onClick="window.open('moveForm.php?id_form=<?php echo $form_detail['id']; ?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=300, height=160, top=85, left=140'); return false;" target="_blank" >
								<img src="../resources/images/icons/move.png" alt="Transladar formulario" />
							</a>
<?php
	}
?>
						</td>
<?php
	if($_SESSION['group'] == "6" || $_SESSION['group'] == "3" || $_SESSION['group'] == "7" || $_SESSION['group'] == "5" || $_SESSION['group'] == "8"){
?>
						<td><?=$form_detail['log_planilla']?></td>
						<td><?=$form_detail['log_lote']?></td>
<?php
	}
?>
						<td><?=$user->getName($form_detail['id_user'])?></td>
					</tr>
<?php
}
while($form_devolucion = mysqli_fetch_array($devoluciones)){
?>
					<tr>
						<td>Devoluci&oacute;n</td>
						<td>&nbsp;</td>
						<td><?=date('Y-m-d h:i:s a', strtotime($form_devolucion['date_created']))?></td>
						<td>
							<a href="" onClick="window.open('viewDevolucion.php?id_devolucion=<?php echo $form_devolucion['id'] ?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=300, height=280, top=85, left=140'); return false;" target="_blank" >
								<img src="../resources/images/icons/show.jpg" alt="Ver detalles del cliente" />
							</a>
						</td>
						<td>&nbsp;</td>
						<td><?=$form_devolucion['lote']?></td>
					</tr>
<?php
}
?>
				</tbody>
			</table>
		</div>
<?php
if($_SESSION['group'] == "1" || $_SESSION['group'] == "6" || $_SESSION['group'] == "4" || $_SESSION['group'] == "3" || $_SESSION['group'] == "8"){
?>
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
<?php
	if($_SESSION['group'] == "6" || $_SESSION['group'] == "8"){
?>
						<th>Acciones</th>
<?php
	}
?>
					</tr>
				</thead>
				<tbody>
<?php
	while($contacto = mysqli_fetch_array($contact_histo)){
		if(file_exists('/var/www/html/' . $contacto['filename']))
			$grabacion_sgd = $contacto['filename'];
		else{
			$grab_sgd = explode('.', $contacto['filename']);
			$grabacion_sgd = $grab_sgd[0] . '.mp3';
		}
		if(!file_exists('/var/www/html/'.$grabacion_sgd)){
			if(file_exists('/var/www/html/Almacenamiento.Serverfin/'.$contacto['filename']))
				$grabacion_sgd = 'Almacenamiento.Serverfin/'.$contacto['filename'];
			else{
				$grab_sgd = explode('.', $contacto['filename']);
				$grabacion_sgd = 'Almacenamiento.Serverfin/'.$grab_sgd[0].'.mp3';
				if(!file_exists('/var/www/html/Almacenamiento.Serverfin/'.$grab_sgd[0].'.mp3')){
					if(file_exists('/home/storage/'.$grab_sgd[0].'.mp3')){
						$grabacion_sgd = '../storage/'.$grab_sgd[0].'.mp3';
					}elseif(file_exists('/home/storage/'.$grab_sgd[0].'.wav')){
						$grabacion_sgd = '../storage/'.$grab_sgd[0].'.wav';
					}
				}
			}
		}
?>
					<tr>
						<td><?=$contacto['type']?></td>
						<td><?=$contacto['description']?></td>
						<td><?=$contacto['observacion']?></td>
						<td><?=$contacto['name']?></td>
						<td><?=date('Y-m-d h:i:s a', strtotime($contacto['date_created']))?></td>
						<td>
<?php
		if(!empty($contacto['filename'])){
?>
							<embed width="45" height="30" autostart="false" loop="false" playcount="1" src="../../<?=$grabacion_sgd?>">
<?php
		}
?>
						</td>
<?php
		if($_SESSION['group'] == "6"){
?>
						<td><img src="../resources/images/icons/cross.png" alt="Desactivar formulario" /></td>
<?php
		}
?>
					</tr>
<?php
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
	while($contacto2 = mysqli_fetch_array($contactcapi_histo)){
		if(file_exists('/var/www/html/' . $contacto2['filename']))
			$grabacion_capi = $contacto2['filename'];
		else {
			$grab_capi = explode('.', $contacto2['filename']);
			$grabacion_capi = $grab_capi[0] . '.mp3';
		}
		if(!file_exists('/var/www/html/'.$grabacion_capi)){
			$grab_capi = explode('.', $contacto2['filename']);
			if(file_exists('/home/storage/'.$grab_capi[0].'.mp3')){
				$grabacion_capi = '../storage/'.$grab_capi[0].'.mp3';
			}elseif(file_exists('/home/storage/'.$grab_capi[0].'.wav')){
				$grabacion_capi = '../storage/'.$grab_capi[0].'.wav';
			}
		}
?>
					<tr>
						<td><?=$contacto2['type']?></td>
						<td><?=$contacto2['description']?></td>	
						<td>
							<a href="" onClick="window.open('viewDataCapi.php?id_data_capi=<?=$contacto2['id']?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=600, height=400, top=85, left=140'); return false;">
								<img src="../resources/images/icons/edit.png" alt="Ver detalle" />
							</a>
						</td>
						<td><?=$contacto2['observacion']?></td>
						<td><?=$contacto2['name']?></td>
						<td><?=$contacto2['date_created']?></td>
						<td>
<?php
		if(!empty($contacto2['filename'])){
?>
							<embed width="45" height="30" autostart="false" loop="false" playcount="1" src="../../<?=$grabacion_capi?>">
<?php
		}
?>
						</td>
					</tr>
<?php
	}
?>
				</tbody>
			</table>
		</div>
<?php
}
?>
	</div>
</div>
<?php
if($_SESSION['group'] == 1 || $_SESSION['group'] == 6 || /*$_SESSION['group'] == 2 || $_SESSION['group'] == "8" || */$_SESSION['group'] == "4"){
?>
<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<h3>Datos de migraci&oacute;n</h3>
			<ul class="content-box-tabs">
				<li><a href="#tab2" class="default-tab">Im&aacute;genes</a></li>
<?php
	if($_SESSION['group'] != 2){
?>
				<li><a href="#tab5">Grabaciones</a></li>
<?php
	}
?>
			</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
		<div class="tab-content default-tab" id="tab2">
			<table>
				<thead>
					<tr>
						<th>Imagen</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
<?php
	while($miimage = mysqli_fetch_array($migra_images)){
?>
					<tr>
						<td><?=$miimage['filename']?></td>
						<td>
							<a href="" onClick="window.open('viewImageMigracion.php?nombre=<?php echo $miimage['filename']; ?>&document=<?php echo $client['document'] ?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=830, height=540, top=85, left=140'); return false;">
								<img src="../images/icons/show.gif" width="25" height="25" alt="Reproducir" />
							</a>
						</td>
					</tr>
<?php
	}
?>
				</tbody>
			</table>
		</div>
<?php
	if($_SESSION['group'] != 2){
?>
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
<?php
		while($migrabacion = mysqli_fetch_array($migra_grabaciones)){
?>
					<tr>
						<td><?=$migrabacion['date']?></td>
						<td><?=$migrabacion['hour']?></td>
						<td><?=$migrabacion['phone']?></td>
						<td>
							<a href="http://200.30.84.34/grabaciones_colpatria/salida/<?=$migrabacion['file']?>">
								<img src="../resources/images/icons/icon_sound.gif" width="25" height="25" alt="Reproducir" />
							</a>
						</td>
					</tr>
<?php
		}
?>
				</tbody>
			</table>
		</div>
<?php
	}
?>
	</div>
</div>
<?php
}
?>
<input type="hidden" name="id_client1" id="id_client1" value="<?php echo $_GET['id_client'] ?>" />
<div class="clear"></div> <!-- End .clear -->
<div id="box2" style="display:none;"><br></div>
<script>
$.fn.cerrarVentana = function() {
    //radioSelected.checked = false;
};
$.fn.mostrarEvidencias = function(e, radicado_item_id){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if (radicado_item_id === null) return false;
    
    $.ajax({
        beforeSend: function(){
            $.facebox.loading();
        },
        data: {
            action: 'verEvidencia',
            domain: 'cargue',
            meth: 'js',
            radicado_item_id: radicado_item_id
        },
        type: 'GET',
        url: './includes/Controller.php',
        dataType: 'json',
        success: function(dato){
			console.log(dato);
            if ((!dato.exito && dato.error) || (!dato.exito && !dato.error)) {
                $('p.text-center > span').html(dato.error ? dato.error : 'Ocurrio un error al momento de generar el archivo, contacte con el administrador.');
                $.facebox({
                    div: '#box-errores'
                });
                if (!dato.error) console.log(dato);
                return false;
            }
            $('#box2').html('<div id="muestra-pdf-evidencia"></div>');
            const tam = tamVentana();
            const widtam = (60 * tam[0]) / 100;
            var opt = {
                width: widtam + "px",
                height: "650px",
                pdfOpenParams: {
                    view: "FitH"
                }
            };
            PDFObject.embed(dato.item.path, "#muestra-pdf-evidencia", opt);
            $.facebox({
                div: '#box2'
            });
        },
        complete: function(jqXHR, textStatus){
            //$.facebox.close();
        },
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr, ajaxOptions, thrownError);
            $('p.text-center > span').html("Error(cargueBaseGestorVentas): "+xhr.status+" Error: "+xhr.responseText);
            $.facebox({
                div: '#box-errores'
            });
        }
    });
}
</script>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
