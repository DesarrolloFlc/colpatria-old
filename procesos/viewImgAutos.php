<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'image.class.php';
require_once PATH_CCLASS . DS . 'form.class.php';

extract($_GET);
$form = new Form();
$image = new Image();
//$infoform = $form->getFormInfo($id_forma);
//$infoform = mysqli_fetch_array($infoform);

$primera = $image->getImageForm($id_image);
$primera = mysqli_fetch_array($primera);
$images = $image->getImagesForm($id_forma);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Doc. Finder | Finleco BPO - Colpatria</title>
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.12.4.min.js"></script>
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
</div>
<div id="imagefull">
    <object width=500 height=600 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
        <param name="src" value="/<?=$primera['directory'] . DS . $primera['filename']?>">                
        <embed width=500 height=600 src="/<?=$primera['directory'] . DS . $primera['filename']?>" type="image/tiff">
    </object>
</div>
<script type="text/javascript">
function cargar_imagen(id) {
    $.post('selectImage.php', {id_image: id}, function(data) {
        $("#imagefull").html(data);
    });
}
$(document).ready(function() {
    $('.unabled_image').click(function() {
        $.get($(this).attr('href'), function(data) {
            if (data == 0) {
                alert("Imagen desactivada.");
                location.reload();
            }
            else if (data == 1)
                alert("Ocurrio un error durante la desactivacion.");
        })
        return false;
    });
});
</script>
</body>
</html>
