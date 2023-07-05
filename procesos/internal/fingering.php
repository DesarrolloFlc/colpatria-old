<?php
session_start();
if(!isset($_SESSION['id'])){
    echo "Su sesi&oacute;n ha caducado, por favor inicie sesi&oacute;n para poder seguir digitando...";
    exit();
}
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'image.class.php';
require_once PATH_CCLASS . DS . 'log.class.php';
$image = new Image();
$image_now = $image->getImageDB($_SESSION['id']);
$image_now = mysqli_fetch_array($image_now);
$images_faltantes = $image->getImages(1, $_SESSION['id']);
$images_faltantes = mysqli_fetch_array($images_faltantes);
$lote = explode("_", $image_now['filename']);


$marca = "";
if (isset($lote[3]) && strlen($lote[3]) != 3) {
    $marca = explode(".", $lote[3]);
    $marca = $marca[0];
}

if (isset($lote[1]))
    $lote = $lote[0] . "_" . $lote[1];
else
    $lote = $lote[0] . "_";

$planilla = mysqli_fetch_array($image->getPlanilla($_SESSION['id']));
$next_images = $image->getNextImages($_SESSION['id'], $image_now['id']);
$planilla_lote = mysqli_fetch_array($image->getPlanillaLote($_SESSION['id'], $lote));

$planilla1 = explode("_", $planilla['filename']);
$planilla1 = $planilla1[0];

extract($_GET);
?>
<html>
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestor documental. FinlecoBPO - Colpatria - <?=$lote?></title>        
        <!-- Source File -->
        <link rel="stylesheet" href="../../css/general.css" type="text/css" />
        <link type="image/x-icon" href="../../images/icons/favicon.ico" rel="icon" />
        <script src="../../resources/scripts/jquery-1.3.2.min.js" type="text/javascript"></script>


    </head>
<body>
<?php
if ($images_faltantes['total'] <= 0) {
    echo "<h1>No hay m&aacute;s im&aacute;genes para indexar en estos momentos.</h1>".$images_faltantes['total'];
    $num_planillas_faltantes = mysqli_fetch_array($image->getPlanillaActiva($_SESSION['id']));
    if ($num_planillas_faltantes['total'] > 0) {
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
<!--<div class="digitalizar_msg">Imágenes en cola de producción:&nbsp;<?php echo $images_faltantes['total']; ?></div>
<div style="clear:both;"></div>-->
    <div id="digitalizar_left" >
        <!--<object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" value="<?php //echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $image_now['filename'];    ?>">
        </object>-->
        <object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" value="<?php echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $image_now['filename']; ?>">                
            <embed width=620 height=650 src="<?php echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $image_now['filename']; ?>" type="image/tiff">
        </object>

    </div>
    <p><?php echo $image_now['filename']; ?></p>
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
                    <select name="tipodocumento_1" id="tipodocumento_1">
                        <option value="">-- Seleccione un tipo de documento --</option>
                        <option value="1">Formulario</option>
                        echo '<option value="6">Formulario nuevo</option>';
                        <!--<option value="2">Formulario Cara B</option>
                        <option value="3">Documento Anexo</option> -->
                        <option value="4">Formato Renovacion Autos</option>
                        <option value="5">Documentacion Complementaria</option>
                    </select>
                </td>
            </tr>
        </table>
        <form method="POST" action="saveImage.php" enctype="multipart/form-data" id="form_fingering" name="form_fingering">
            <div id="fields_form" style="width:100%; height: auto;"></div>
            <input type="hidden" name="id_imagen_tmp" id="id_imagen_tmp" value="<?=$image_now['id']?>" />
            <input type="hidden" name="id_form" id="id_form" value="<?=$id_form?>" />
            <input type="hidden" name="id_user" id="id_user" value="<?=$_SESSION['id']?>" />
            <input type="hidden" name="lote" id="lote" value="<?=$lote ?>" />
            <input type="hidden" name="planilla1" id="planilla1" value="<?=$planilla1?>" />
            <input type="hidden" name="marca" id="marca" value="<?=$marca ?>" />
            <input type="hidden" name="planilla_lote" id="planilla_lote" value="<?=$planilla_lote['filename']?>">
        </form>
    </div>

    <div id="thumbs_images">
        <!--<object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" TOOLBAR=off value="<?php //echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla['filename']; ?>">
        </object>
        <object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" TOOLBAR=off  value="<?php //echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla_lote['filename']; ?>">
        </object>-->
        <object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" TOOLBAR=off value="<?php echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla['filename']; ?>">                
            <embed width=110 TOOLBAR=off height=160 src="<?php echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla['filename']; ?>" type="image/tiff">
        </object>
        <object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" TOOLBAR=off value="<?php echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla_lote['filename']; ?>">                
            <embed width=110 TOOLBAR=off height=160 src="<?php echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla_lote['filename']; ?>" type="image/tiff">
        </object>
        <?php
        while ($next_img = mysqli_fetch_array($next_images)) {
            ?>
            <!--<object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                <param name="src" TOOLBAR=off  value="<?php echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $next_img['filename']; ?>">
            </object>-->
            <object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                <param name="src" TOOLBAR=off value="<?php echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $next_img['filename']; ?>">                
                <embed width=110 TOOLBAR=off height=160 src="<?php echo $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $next_img['filename']; ?>" type="image/tiff">
            </object>
            <?php
        }
        ?>
    </div>
        <!--  <div style="clear:both;"></div>
          <div class="digitalizar_msg">Imágen digitalizada por <i><b><?php //echo $image_now['username']; ?></i></b></div>            -->
<script type="text/javascript">
$(document).ready(function() {
    window.moveTo(0, 0);
    window.resizeTo(window.screen.width, window.screen.height - 25);
    $("#tipodocumento_1").change(function() {
        if ($('#tipodocumento_1').val() != "") {
            $.post('fieldsForm.php', {type: $('#tipodocumento_1').val()}, function(data) {
                $('#fields_form').html(data);
            });
        }
    });
    $("#tipopersona").change(function() {
        /* if( $('#tipopersona').val() != "") {
            $.post('fields.php', {type_person: $('#tipopersona').val()},function( data) {
            $('#fields_persona').html(data);                          
            });
            }*/
    });
});
function validar_num(e) {
    tecla_codigo = (document.all) ? e.keyCode : e.which;
    if (tecla_codigo == 8)
        return true;
    patron = /^\d+$/;
    tecla_valor = String.fromCharCode(tecla_codigo);
    return patron.test(tecla_valor);
}
function validar_letra(e){
    tecla_codigo = (document.all) ? e.keyCode : e.which;
    if(((e.keyCode || e.which) == 8) || ((e.keyCode || e.which) == 9))return true;
    patron =/^[A-ZÑÁÉÍÓÚ0-9@#-_\s\.]*$/;
    tecla_valor = String.fromCharCode(tecla_codigo);
    return patron.test(tecla_valor);
}
</script>
</body>
</html>