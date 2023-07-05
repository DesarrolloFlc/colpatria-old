<?php

require_once PATH_SITE . DS . "config/globalParameters.php";

class Official {

    function getOfficials() {
        $sql = "SELECT id, name FROM official WHERE status = '0' ORDER BY name ASC";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getOfficial($id_official) {
        $sql = "SELECT * FROM official WHERE id = '$id_official'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    public static function addOficial($id, $identificacion, $name, $email, $email_father) {
        $SQL = "INSERT INTO official
    			(
    				id, identificacion, name, email, email_father
    		   	)
				VALUES
				(
					$id, $identificacion, '$name', '$email', '$email_father'
				)";
        $resp = mysqli_query($GLOBALS['link'], $SQL);
        if ($resp)
            return true;
        else
            return false;
    }

}

?>