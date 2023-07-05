<?php
session_start();
require_once '../../lib/class/client.class.php';
$cliente = new Client();
$result_crear = $cliente->addPrueba();
echo "$result_crear";