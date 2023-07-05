<?php
session_start();
if( $_SESSION['group'] == "1" || $_SESSION['group'] == "2"  || $_SESSION['group'] == "3" || $_SESSION['group'] == "4" || $_SESSION['group'] == "5" || $_SESSION['group'] == "6" || $_SESSION['group'] == "7" || $_SESSION['group'] == "8") {
	$temp = file('archivos.csv');
    $n=count($temp);	
    echo $n;
	require_once '../lib/class/form.class.php';
	$form = new Form();
	$resp = $form->updatePlanillas();
	echo "aca3".$resp;
} else {
echo "<h2>No tiene permisos para acceder a esta área</h2>";
}
?>
