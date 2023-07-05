<?php
$DIR_ROOT = dirname(dirname(dirname(__FILE__)));
$PATH_IMAGES_TMP = SITE_ROOT . DS . "tmp_images/";
$PATH_IMAGES_TMP2 = $DIR_ROOT . DS . SITE_ROOT . DS . "tmp_images/";
$DIR_DEFAULT = "images_colpatria";
$PATH_IMAGES = $DIR_ROOT."/../".$DIR_DEFAULT."/";

$server = "localhost";
$userdb = "colpatria_sgd";
$passdb = "colpatria_sgd";
$db  = "colpatria_sgd";

/*$link = mysql_connect($server,$userdb,$passdb);
mysql_select_db($db,$link);
mysql_query("SET NAMES 'utf8'");*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect($server, $userdb, $passdb, $db);
//mysql_select_db($db,$link);
mysqli_query($link, "SET NAMES 'utf8'");