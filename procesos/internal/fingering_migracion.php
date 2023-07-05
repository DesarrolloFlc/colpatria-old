<?php
session_start();
if(!isset($_SESSION['id']) || !in_array($_SESSION['id'], [1, 1302, 2939, 2956, 2067, 2368])){
    echo "<h1>Usted no tiene permisos para ingresar a esta area...</h1>";
    exit;
}

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'image.class.php';
require_once PATH_CCLASS . DS . 'log.class.php';
$image = new Image();
$cliente = $image->getClienteMigracion();
if ($cliente === false) {
    echo "<h1>No se encontraron clientes de migracion para digitar...</h1>";
    exit;
}
//print_r($cliente);
/*$cliente = array();
$cliente['id'] = 216776;
$cliente['document'] = 20000009;
$cliente['filename'] = '20000009ANEXO126-03-11.tif';*/
$image_now = $image->getImageDBMG($cliente['id']);
$image_now = mysqli_fetch_array($image_now);
$images_faltantes = $image->getImagesMG(1, $cliente['id']);
$images_faltantes = mysqli_fetch_array($images_faltantes);

//$lote = explode("_", $image_now['filename']);//LOTE_8001_01.tif


$marca = "";
/*if( count($lote[3]) != 3 )  {
	$marca = explode(".",$lote[3]);
	$marca = $marca[0];
}*/

$lote = "LOTE_0";

//$planilla = mysqli_fetch_array($image->getPlanilla($_SESSION['id']));
$next_images = $image->getNextImagesMG($cliente['id'], $image_now['filename']);
$planilla_lote = mysqli_fetch_array( $image->getPlanillaLoteMG($cliente['id']));

/*$planilla1 = explode( "_",$planilla['filename']);*/
//$planilla1 = $planilla1[0];
$planilla1 = "PLANILLA0";

extract($_GET);

?>
<html>
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestor documental. FinlecoBPO - Colpatria</title>        
        <!-- Source File -->
        <link rel="stylesheet" href="../../css/general.css" type="text/css" />
        <link type="image/x-icon" href="../../images/icons/favicon.ico" rel="icon" />
        <script src="../../resources/scripts/jquery-1.3.2.min.js" type="text/javascript"></script>

        <script languaje="javascript" type="text/javascript">
            window.moveTo(0, 0);
            window.resizeTo(window.screen.width, window.screen.height - 25);            
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#tipodocumento").change(function(){
                    if( $('#tipodocumento').val() != "") {
                        $.post('fieldsForm.php', {type: $('#tipodocumento').val(), migracion: 'SI'},function( data) {
                            $('#fields_form').html(data);                          
                        });
                    }
                });
                $("#tipopersona").change(function(){
                    /* if( $('#tipopersona').val() != "") {
                        $.post('fields.php', {type_person: $('#tipopersona').val()},function( data) {
                            $('#fields_persona').html(data);                          
                        });
                    }*/
                });                
            });
            $.fn.clienteMigracionDesactivar = function(e){
                (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
                if($('form#clienteMigracionDesactivar #accion').val() == ''){
                    alert('Para rechazar este cliente debe seleccionar la accion...');
                    $('form#clienteMigracionDesactivar #accion').focus();
                    return false;
                }
                if(confirm('Esta seguro que desea desactivar este cliente de migracion?')){
                    var causal = $('form#clienteMigracionDesactivar #accion').val();
                    var id_user = $('form#form_fingering #id_user').val();
                    var id_imagen = $('form#form_fingering #id_imagen_tmp').val();//document_client
                    var documento = $('form#form_fingering #document_client').val();
                    var id_client = $('form#form_fingering #id_client').val();
                    var lote = $('form#form_fingering #lote').val();
                    var action = $('form#clienteMigracionDesactivar #action').val();
                    var datos = 'causal='+causal+'&id_user='+id_user+'&id_imagen='+id_imagen+'&documento='+documento+'&id_client='+id_client+'&lote='+lote+'&action='+action;
                    $.ajax({
                        beforeSend: function(){
                        },
                        data: datos,
                        type: 'POST',
                        url: '../includes/controllerClient_migracion.php',
                        dataType: 'json',
                        success: function(dato){
                            //alert(dato)
                            if(dato.exito){
                                alert(dato.exito);
                                document.location.href = "fingering_migracion.php";
                            }
                        }
                    });
                }else
                    return false;
            };
            $.fn.closeVentana = function(e,id_client){
                (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
                if(confirm('Esta seguro que desea cerrar la ventana?')){
                    $.ajax({
                        beforeSend: function(){
                        },
                        data: 'action=closeVentana&id_client='+id_client,
                        type: 'POST',
                        url: '../includes/controllerClient_migracion.php',
                        dataType: 'json',
                        success: function(dato){
                            //alert(dato)
                            if(dato.exito){
                                alert('la ventana se cerrar despues de aceptar este mensaje...');
                                window.self.close();
                            }
                        }
                    });
                }else
                    return false;
            };
        </script>


    </head>
    <body>
        <?php
        if ($images_faltantes['total'] <= 0) {
            echo "<h1>No hay m&aacute;s im&aacute;genes para indexar en estos momentos.</h1>";
	     $num_planillas_faltantes = mysqli_fetch_array($image->getPlanillaActiva($_SESSION['id']));	     
	     if( $num_planillas_faltantes['total'] > 0 ) {
	     	?>
		<form action="../../lib/general/procesos.php" method="POST">
		<input type="submit" class="button" value="Archivar planillas >>" />
		<input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id_user" id="id_user"  />
		<input type="hidden" name="action" id="action" value="desactivarPlanillas"/>
		</form>
		<?php
	     } 		
            exit;
        }

        if (empty($id_form)) {
            $log = new Log();
            $id_form_log = mysqli_fetch_array($log->getIdIndexacion($_SESSION['id']));
            $id_form = $id_form_log['id_form'];
        }
        ?>
        <!--<div class="digitalizar_msg">Imágenes en cola de producción:&nbsp;<?php //echo $images_faltantes['total']; ?></div>
        <div style="clear:both;"></div>-->
        <button type="button" onclick="$.fn.closeVentana(event,<?php echo $cliente['id']; ?>)">Cerrar ventana</button>
        <div>
            <form id="clienteMigracionDesactivar" name="clienteMigracionDesactivar" onsubmit="$.fn.clienteMigracionDesactivar(event);">
                <label>Desactive si las imagenes no cumplen con las especificaiones minimas</label>
                <select id="accion" name="accion">
                    <option value="">Seleccione...</option>
                    <option value="Sin Datos de contacto">Sin Datos de contacto</option>
                    <option value="Sin datos de cliente">Sin datos de cliente</option>
                    <option value="Sin Datos financieros ">Sin Datos financieros</option>
                    <option value="Huella y/o Firma">Huella y/o Firma</option>
                    <option value="Datos Entrevista">Datos Entrevista</option>
                    <option value="Falta documentos adicionales o ilegibles">Falta documentos adicionales o ilegibles</option>
                    <option value="Formulario">Formulario</option>
                </select>
                <input type="hidden" id="action" name="action" value="clienteMigracionDesactivar">
                <button type="submit">Desactivar</button>
            </form>            
        </div>
        <div id="digitalizar_left" >
            <object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                <param name="src" value="../../../migracion/<?php echo $cliente['documento'][0].'/'.$cliente['documento'].'/'.$image_now['filename'] ?>">                
                <embed width=620 height=650 src="../../../migracion/<?php echo $cliente['documento'][0].'/'.$cliente['documento'].'/'.$image_now['filename'] ?>" type="image/tiff">
            </object>

        </div>
        <p><?php echo $image_now['filename'];?></p>
        <div id="digitalizar_right">
            <table>              
                <tr>
                    <td>Lote</td>
                    <td><input type="text" name="lote" id="lote" value="<?php echo $lote; ?>" disabled/></td>
                    <td>Marca:</td>
                    <td><input type="text" name="marca" id="marca" value="<?php echo $marca; ?>" disabled/></td>
                </tr>

                <tr>
                    <td>Documento:</td>
                    <td>
                        <select name="tipodocumento" id="tipodocumento">
                            <option value="">-- Seleccione un tipo de documento --</option>
                            <option value="1">Formulario</option>
                            <!--<option value="2">Formulario Cara B</option>
                            <option value="3">Documento Anexo</option> -->
                        </select>
                    </td>
                </tr>
            </table>
            <form method="POST" action="saveImageMG.php" enctype="multipart/form-data" id="form_fingering" name="form_fingering">   
                <div id="fields_form" style="width:100%; height: auto;"></div>    
                <input type="hidden" name="id_imagen_tmp" id="id_imagen_tmp" value="<?php echo $image_now['id']; ?>" />                
                <input type="hidden" name="id_form" id="id_form" value="<?php echo $id_form; ?>" />
                <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id']; ?>" />
                <input type="hidden" name="document_client" id="document_client" value="<?php echo $cliente['documento']; ?>" />
                <input type="hidden" name="id_client" id="id_client" value="<?php echo $cliente['id']; ?>" />
                <input type="hidden" name="lote" id="lote" value="<?php echo $lote ?>" />   
                <input type="hidden" name="planilla1" id="planilla1" value="<?php echo $planilla1;?>" />
                <input type="hidden" name="marca" id="marca" value="<?php echo $marca ?>" />    
            </form>
        </div>

        <div id="thumbs_images">
            <object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                <param name="src" TOOLBAR=off value="../../../migracion/<?php echo $cliente['documento'][0].'/'.$cliente['documento'].'/'.$image_now['filename'] ?>">                
                <embed width=110 TOOLBAR=off height=160 src="../../../migracion/<?php echo $cliente['documento'][0].'/'.$cliente['documento'].'/'.$image_now['filename'] ?>" type="image/tiff">
            </object>
            <?php
            while ($next_img = mysqli_fetch_array($next_images)) {
                ?>
                <object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                    <param name="src" TOOLBAR=off value="../../../migracion/<?php echo $cliente['documento'][0].'/'.$cliente['documento'].'/'.$next_img['filename'] ?>">                
                    <embed width=110 TOOLBAR=off height=160 src="../../../migracion/<?php echo $cliente['documento'][0].'/'.$cliente['documento'].'/'.$next_img['filename'] ?>" type="image/tiff">
                </object>
                <?php
            }
            ?>
        </div>

      <!--  <div style="clear:both;"></div>
        <div class="digitalizar_msg">Imágen digitalizada por <i><b><?php //echo $image_now['username']; ?></i></b></div>            -->
</body>
</html>