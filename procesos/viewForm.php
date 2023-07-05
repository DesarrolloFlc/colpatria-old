<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'image.class.php';
require_once PATH_CCLASS . DS . 'form.class.php';
extract($_GET);
$form = new Form();
$image = new Image();
$infoform = $form->getFormInfo($id_forma);
$infoform = mysqli_fetch_array($infoform);

$primera = $image->getFirstImageForm($id_forma);
$primera = mysqli_fetch_array($primera);
$pathFile = dirname(PATH_SITE) . DS . "images_colpatria" . DS;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Doc. Finder | Finleco BPO - Colpatria</title>
        <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/pdfobject/pdfobject/pdfobject.min.js"></script>
        <style type="text/css" media="all" >
            body {
                font-family: Verdana, Tahoma;   
            }            
            #thumbs{width:220px; height:600px;overflow:auto; float: left;}
            #imagefull {
                padding-left: 20px;
                float:left;
                width: 400px;
                height: 600px;
                text-align: center;
            }
            a {
                text-decoration: none;
                font-size: 12px;
            }
            a img {
                border: none;
            }
        </style>
    </head>
    <body>
    <div id="thumbs">
        <table>
<?php
$images = $image->getImagesForm($id_forma);
while($thumb = mysqli_fetch_array($images)){
    if (!file_exists($pathFile . $thumb['filename'])) {
?>
            <div style="width: 100%; margin-left: auto; margin-right: auto;">
                <img style="width: 100%;" src="<?=SITE_ROOT?>/images/general/Imagen_no_disponible.jpg" />
            </div>
            <div class="alert" style="width: 500px; overflow-wrap: break-word; inline-size: auto; font-size: .6rem;">
                <strong>Ups!</strong> Parece que algo salio mal, contacta con el administrador.
            </div>
<?php
        continue;
    }
    $fileMime = mime_content_type($pathFile . $thumb['filename']);
?>
            <tr>
                <td>
<?php
    if($fileMime == 'image/tiff'){
?>
                    <!--<object width=200 height=220 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                        <param name="src" value="<?//=$thumb['directory'] . '/' . $thumb['filename']?>">
                        <param name="src" value="http://200.30.84.34:82/<?//=$thumb['directory'] . '/' . $thumb['filename']?>"> 
                    </object>-->
                    <object width=200 height=220 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                        <param name="src" value="/<?=$thumb['directory'] . '/' . $thumb['filename']?>">                
                        <embed width=200 height=220 src="/<?=$thumb['directory'] . '/' . $thumb['filename']?>" type="image/tiff">
                    </object>
                    <br />
                    <p>
                        <a href="#" onclick="cargar_imagen(<?=$thumb['id']?>)" class="button"><img src="../images/icons/show.gif" alt="Ver im�gen"/></a>
<?php
        if(isset($_SESSION['group']) && in_array($_SESSION['group'], ['3', '5', '6', '7', '8'])){
?>
                        <br>
                        Original: <?=$thumb['original_file']?> | 
                        <a href="../lib/general/procesos.php?action=unabled_image&id_image=<?=$thumb['id']?>" class="unabled_image">Desactivar</a>
<?php
        }
?>
                    </p>
<?php
    }else if($fileMime == 'application/pdf'){
?>
                    <div id="pdfthum_<?=$thumb['id']?>"></div>
                    <br>
                    <p>
                        <a href="#" onclick="$(this).mostrarPdfFuncion(event, '/<?=$thumb['directory'].'/'.$thumb['filename']?>')" class="button"><img src="../images/icons/show.gif" alt="Ver im�gen"/></a>
<?php
        if(isset($_SESSION['group']) && in_array($_SESSION['group'], ['3', '5', '6', '7', '8'])){
?>
                        <br>
                        Original: <?=$thumb['original_file'] ?> | 
                        <a href="../lib/general/procesos.php?action=unabled_image&id_image=<?=$thumb['id'];?>" class="unabled_image">Desactivar</a>
<?php
        }
?>
                    </p>
                    <script>
                    var opt = {
                        width: '200px',
                        height: '220px',
                        pdfOpenParams: {
                            view: 'FitB',
                            pagemode: 'thumbs'
                        }
                    };
                    PDFObject.embed("/<?=$thumb['directory'].'/'.$thumb['filename']?>", "#pdfthum_<?=$thumb['id']?>", opt);
                    </script>
<?php
    }
?>
                </td>
            </tr>
<?php
}
?>
        </table>
</div>
<div id="imagefull">
<?php 
if(isset($_SESSION['group']) && ($_SESSION['group'] == "6" || $_SESSION['group'] == "1" || $_SESSION['group'] == "8")){
?>
    <div style="float: left;">
        <a href="" onclick="window.open('viewData.php?id_form=<?=$id_forma?>', '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=560, height=610, top=85, left=140'); return false;">Ver digitaci&oacute;n</a>
    </div>
<?php
    if($_SESSION['group'] == "6"){
?>
    <div style="position: relative; left: 120px; top: 0px; z-index: 2;">
        <img src="../resources/images/icons/arrowbottom.png" width="20px" height="25px" alt="M�s im�genes">
    </div>
<?php
    }
}
?>
    <!--<object width=500 height=600
                 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
             <param name="src" value="http://200.30.84.34:82/<?//=$primera['directory']. '/' . $primera['filename']?>">
             <param name="src" value="/<?//=$primera['directory'] . '/' . $primera['filename']?>"> 
         </object> -->
<?php
if (!file_exists($pathFile . $primera['filename'])) {
?>
    <div style="width: 100%; margin-left: auto; margin-right: auto;">
        <img style="width: 100%;" src="<?=SITE_ROOT?>/images/general/Imagen_no_disponible.jpg" />
    </div>
    <div class="alert" style="width: 500px; overflow-wrap: break-word; inline-size: auto; font-size: .8rem;">
        <strong>Ups!</strong> Parece que algo salio mal, contacta con el administrador.
    </div>
</div>
</body>
</html>
<?php
    exit;
}
if(mime_content_type($pathFile . $primera['filename']) == 'image/tiff'){
?>
    <object width=500 height=600 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
        <param name="src" value="/<?=$primera['directory'] . '/' . $primera['filename']?>">                
        <embed width=500 height=600 src="/<?=$primera['directory'] . '/' . $primera['filename']?>" type="image/tiff">
    </object>
<?php
}else if(mime_content_type($pathFile . $primera['filename']) == 'application/pdf'){
?>
    <div id="pdf_full"></div>
    <script>
    var opt = {
        width: '500px',
        height: '600px',
        pdfOpenParams: {
            view: 'FitB'
        }
    };
    PDFObject.embed("/<?=$primera['directory'] . '/' . $primera['filename']?>", "#pdf_full", opt);
    </script>
<?php
}
?>
</div>
<script>
$(document).ready(function() {
    $('.unabled_image').click(function() {
        $.get($(this).attr('href'), function(data) {
            if (data == 0) {
                alert("Imagen desactivada.");
                location.reload();
            }else if (data == 1)
                alert("Ocurrio un error durante la desactivacion.");
        })
        return false;
    });
});
function cargar_imagen(id) {
    $.post('selectImage.php', {id_image: id}, function(data) {
        $("#imagefull").html(data);
    });
}
$.fn.mostrarPdfFuncion = function(e, fileName){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if(fileName != ''){

        var opt = {
            width: '500px',
            height: '600px',
            pdfOpenParams: {
                view: 'FitB'
            }
        };
        PDFObject.embed(fileName, "#pdf_full", opt);
    }
};
</script>
</body>
</html>
