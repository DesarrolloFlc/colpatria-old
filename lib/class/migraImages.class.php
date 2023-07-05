<?php

require_once PATH_SITE . DS . 'config/globalParameters.php';

class migraImages {
	function getImagesMigra( $document ) {
		$sql = "SELECT * FROM migra_images WHERE document = '$document' AND status = '1' ";
		return mysqli_query($GLOBALS['link'], $sql);
	}
}