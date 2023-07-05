<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
set_time_limit(0);
require_once '../../lib/class/client.class.php';
$doc = '1094247926';
$Typ = '1';
$nom = 'PEÑA FLOREZ GABRIEL';
$vig = '0';
$cliente = new Client();
echo $cliente->add($doc, $Typ, $nom, "")
?>