<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CLASS . DS . 'connect.php';

$conn = new Connect();
$conn->consultar("SELECT * FROM radicados WHERE 1 LIMIT 10");
while ($consulta = $conn->sacarRegistros()) {
	echo json_encode($consulta);
}
