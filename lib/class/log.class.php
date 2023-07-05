<?php

require_once PATH_SITE . DS . 'config/globalParameters.php';

class Log {

    function getIdIndexacion($id_user) {
        $sql = "SELECT id_form FROM indexacion_log WHERE id_user = '$id_user' ORDER BY date_created DESC LIMIT 1";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function addIndexacion($id_form, $id_user) {
        $sql = "INSERT INTO indexacion_log(id_form,id_user) 
                VALUES('$id_form',$id_user)";
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return -1;
    }
}