<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'image.class.php';
extract($_POST);
$image = new Image();
$alguna = $image->getImageForm($id_image);
$primera = mysqli_fetch_array($alguna);
?>
 <object width=500 height=600 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
    <param name="src" value="../../../<?=$primera['directory']?>/<?=$primera['filename']?>">
</object>
