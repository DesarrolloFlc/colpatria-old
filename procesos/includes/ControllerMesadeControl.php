<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . "ordenproduccion.class.php";

$action = $_POST['action'];
call_user_func($action, $_POST);
function validaFechasOrden() {
    $orden = new Ordenproduccion();
    $str_ordenes = "";
    $result_search = $orden->validafechas();
    $count_results = mysqli_num_rows($result_search);
    if ($count_results == 0) {
        if ($ordenes = $orden->ordenesNoAprobadas()) {
            foreach ($ordenes as $ord) {
                if ($ord['dias_atrazo'] > 3) {
                    $tmp_orden = mysqli_fetch_array($orden->getOrden($ord['id_orden']));
                    
                    if ($tmp_orden['planilla'] != '0' && $tmp_orden['planilla'] != '') {
                        $str_ordenes .= " <tr> ";
                        $str_ordenes .= " <td> " . $tmp_orden['planilla'] . " </td> ";
                        $str_ordenes .= " <td> " . $ord['id_orden'] . " </td> ";
                        $str_ordenes .= " <td> ". $tmp_orden['date_created'] ." </td>  ";
                        $str_ordenes .= " </tr> ";
                    }
                }
            }
            if ($str_ordenes != "") {
                $orden->enviarMailControl($str_ordenes);
            }
            $orden->actualizaNotificacion();
            return true;
        }
    } else {
        return false;
    }
}
