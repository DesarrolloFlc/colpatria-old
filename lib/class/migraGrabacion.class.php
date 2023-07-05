<?php

require_once PATH_SITE . DS . 'config/globalParameters.php';

class migraGrabacion {
	function getGrabaciones( $document ) {
		$sql = "SELECT * FROM migra_grabacion WHERE document = '$document'";
		return mysqli_query($GLOBALS['link'], $sql);
	}
}