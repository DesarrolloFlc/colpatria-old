<?php
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
$doc = $_GET['doc'];
$suc = str_replace(' ', '_', $_GET['suc']);
$estado = $_GET['est'];
$id_radicado = $_GET['r_id'];
$num = $_GET['num'];
?>
<html>
<head>
</head>
<body>
<?php
if ($estado == '2' && isset($id_radicado)) {
  $numstr = strlen($num) > 1 ? $num : '0' . $num;
?>
  <object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
    <param name="src" value="<?=SITE_ROOT?>/virtuales_doc/vurtuales_aceptados/LOTE_<?=$id_radicado . "_" . $numstr?>.tiff">
    <embed width=620 height=650 src="<?=SITE_ROOT?>/virtuales_doc/vurtuales_aceptados/LOTE_<?=$id_radicado . "_" . $numstr?>.tiff" type="image/tiff">
  </object>';
<?php
} else {
?>
  <object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
    <param name="src" value="<?=SITE_ROOT?>/virtuales_doc/virtuales/<?=$suc . DS . $doc . DS . $suc . "_" . $doc?>_MULTI.tiff">
    <embed width=620 height=650 src="<?=SITE_ROOT?>/virtuales_doc/virtuales/<?=$suc . DS . $doc . DS . $suc . "_" . $doc?>_MULTI.tiff" type="image/tiff">
  </object>';
<?php
}              
?>
</body>
</html>