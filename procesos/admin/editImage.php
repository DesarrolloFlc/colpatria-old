<?php
session_start();
if (isset($_SESSION['group']) &&  $_SESSION['group'] == "6" ) {
	require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
} else {
	echo "<h1>No tiene autorizaci�n para este m�dulo</h1>";
}
