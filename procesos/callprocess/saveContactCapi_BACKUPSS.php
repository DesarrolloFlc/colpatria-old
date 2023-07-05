<?php
session_start();
require_once '../../lib/class/contactcapi.class.php';
require_once '../../lib/class/recordecapi.class.php';

extract($_POST);

if( $id_client != "" && $id_contact != "" ) {
	$contacto = new Contactcapi();

    $fechanacimiento = $fechanacimiento_a . "-" . $fechanacimiento_m . "-" . $fechanacimiento_d;
		$contacto->addConfirm($id_client,$id_contact,$_SESSION['id'],$documento,$primerapellido,$segundoapellido,$nombres,$fechanacimiento,$id_profesion,$empresa,$id_ingresos,$id_egresos,
			$activos,$pasivos,$direccionlaboral,$id_ciudad,$direccionresidencia,$celular,$correoelectronico,$telefonoresidencia,$numerohijos,$estadocivil,$nivelestudios,$observacion);
			$lastid = $contacto->lastId();
		if( $lastid  > 0 ) {
			$recordcapi = new Recordecapi();	
			if( $recordcapi->add($lastid,$_FILES['grabacion']['tmp_name'],$_FILES['grabacion']['name']) ) {
				echo "todo ok";
			} else {
				echo "<br>PIAL";
				}
		} else {
	echo "err";
		}
	
} else {
	echo "Los parametros de envío son insuficientes";
}