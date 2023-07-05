<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["3", "1", "2", "4" , "5", "6", "7", "8"])) exit;

extract($_GET);
$nombre = $nombre;
?>
<html>
<head>
<link href="<?=SITE_ROOT?>/resources/scripts/cloudZoom/cloud-zoom.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/cloudZoom/cloud-zoom.1.0.2.js"></script>
</head>
<body>
<a href="../../migracion/<?=$nombre[0] . DS . $document . DS . $nombre?>" class="cloud-zoom" id="zoom1" rel="adjustX: 10, adjustY:-4">
    <img src="../../migracion/<?=$nombre[0] . DS . $document . DS . $nombre?>" width="400" height="500" alt="" title="Optional title display" />
</a>        
</body>
</html>
