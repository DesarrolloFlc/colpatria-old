<?php
require_once PATH_SITE . DS . 'config/globalParameters.php';

class Contact
{

    function addConfirmNatural($id_client, $id_form, $id_user, $documento, $primerapellido, $segundoapellido, $nombres, $fechaexpedicion, $lugarexpedicion, $numerohijos, $estadocivil, $nivelestudios, $profesion, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $celular, $correoelectronico, $ingresosmensuales, $egresosmensuales, $contact, $observacion, $persontype) {
        if(!isset($estadocivil) || $estadocivil == '')
            $estadocivil = "NULL";
        if(!isset($nivelestudios) || $nivelestudios == '')
            $nivelestudios = "NULL";
        $sql = "INSERT INTO data_confirm
                (
                    id_client, id_form, id_user, documento, primerapellido, segundoapellido, nombres, fechaexpedicion,
                    lugarexpedicion, numerohijos, estadocivil, nivelestudios, profesion, direccionresidencia, ciudadresidencia,
                    telefonoresidencia, celular, correoelectronico, ingresosmensuales, egresosmensuales, id_contact, observacion,persontype
                )
                VALUES
                (
                    '$id_client', '$id_form','$id_user', '$documento', '$primerapellido', '$segundoapellido', '$nombres', '$fechaexpedicion',
					'$lugarexpedicion', '$numerohijos', $estadocivil, $nivelestudios, '$profesion', '$direccionresidencia', '$ciudadresidencia'
					,'$telefonoresidencia', '$celular', '$correoelectronico', '$ingresosmensuales', '$egresosmensuales', '$contact', '$observacion'
					,'$persontype'
                )";
                //error_log($sql, 0);
        if (mysqli_query($GLOBALS['link'], $sql)){
?>
            <script type="text/javascript">
                alert("Confirmacion exitosa.");
                location.href = "../viewClient.php?id_client=<?php echo $id_client; ?>";
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Hubo problemas con la confirmacion, contacte al administrador del sistema.");
            </script>
            <?php
        }
    }

    function addConfirmJuridic($id_client, $id_form, $id_user, $persontype, $nit, $razonsocial, $digitochequeo, $ciudadoficina, $direccionoficinappal, $telefonoficina, $actividadeconomicappal, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $correoelectronico, $contact, $observacion) {
        $sql = "INSERT INTO data_confirm
                (
                    id_client, id_form, id_user, persontype, razonsocial, nit, digitochequeo, ciudadoficina, direccionoficinappal, telefonooficina, actividadeconomicappal, activosemp, pasivosemp, ingresosmensualesemp, egresosmensualesemp, correoelectronico, id_contact, observacion
                )
                VALUES
                (
                    '$id_client', '$id_form', '$id_user', '$persontype', '$razonsocial', '$nit', '$digitochequeo', '$ciudadoficina', '$direccionoficinappal', '$telefonoficina', '$actividadeconomicappal', '$activosemp', '$pasivosemp', '$ingresosmensualesemp', '$egresosmensualesemp', '$correoelectronico', '$contact', '$observacion'
                )";
        if (mysqli_query($GLOBALS['link'], $sql)) {
            ?>
            <script type="text/javascript">
                alert("Confirmacion exitosa.");
                location.href = "../viewClient.php?id_client=<?php echo $id_client; ?>";
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Hubo problemas con la confirmacion, contacte al administrador del sistema.");
            </script>
            <?php
        }
    }

    function lastId() {
        return mysqli_insert_id($GLOBALS['link']);
    }

    function getLastConfirm($id_client) {
        $sql = "SELECT date_created FROM data_confirm WHERE ( id_contact BETWEEN '1' AND '4') AND id_client='$id_client' ORDER BY date_created DESC LIMIT 1";
        $result = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql));
        return $result['date_created'];
    }

    function getLastConfirmDatacredito($id_client) {
        /*
         * SKRV- Actualizacion Data Credito
         */
        $fecha1 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT date_created FROM form WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1"));
        $fecha2 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT date_created FROM data_confirm WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1"));
        $fecha3 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT date_created FROM data_capi_confirm WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1"));
        $fecha4 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT fecha_datacredito FROM client WHERE id = '$id_client' LIMIT 1")); //fECHA DATA CREDITO SKRV


        if ($fecha1['date_created'] > $fecha2['date_created'] && $fecha1['date_created'] > $fecha3['date_created'] && $fecha1['date_created'] > $fecha4['fecha_datacredito']) {
//            return $fecha1['date_created'];
        } else if ($fecha2['date_created'] > $fecha1['date_created'] && $fecha2['date_created'] > $fecha3['date_created'] && $fecha2['date_created'] > $fecha4['fecha_datacredito']) {
//            return $fecha2['date_created'];
        } else if ($fecha3['date_created'] > $fecha1['date_created'] && $fecha3['date_created'] > $fecha2['date_created'] && $fecha3['date_created'] > $fecha4['fecha_datacredito']) {
//            return $fecha3['date_created'];
        } else {
            return $fecha4['fecha_datacredito'];
        }
    }

    function getContactTelf($id_client) {
        $sql = "SELECT confirm.observacion, 
                       confirm.date_created, 
                       us.name, 
                       param_contact.type,
                       param_contact.description, 
                       CONCAT(recorde.directory,'/',recorde.filename) AS filename,
                       recorde.filename AS file
                  FROM client cli 
                 INNER JOIN data_confirm confirm ON (cli.id = confirm.id_client) 
                 INNER JOIN param_contact ON (param_contact.id = confirm.id_contact)
                  LEFT JOIN user us ON (us.id = confirm.id_user) 
                  LEFT JOIN record AS recorde ON (recorde.id_data_confirm = confirm.id) 
                 WHERE confirm.id_client = '$id_client' 
                 ORDER BY confirm.date_created DESC";

        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getContactTelfSup($id_client) {
        $sql = "SELECT confirm.observacion, confirm.date_created, us.name, param_contact.type,param_contact.description, CONCAT(recorde.directory,'/',recorde.filename) AS filename    
			FROM client cli INNER JOIN sup_data_confirm confirm ON cli.id = confirm.id_client 
					  INNER JOIN param_contact ON param_contact.id = confirm.id_contact
					  INNER JOIN user us ON us.id = confirm.id_user 
					  LEFT JOIN record AS recorde ON recorde.id_data_confirm = confirm.id 
					  WHERE confirm.id_client = '$id_client' 
					   ORDER BY confirm.date_created DESC";

        return mysqli_query($GLOBALS['link'], $sql);
    }

    function addConfirmDataClient($data, $id_form, $fecha) {
        $sql = "UPDATE data SET ";
        if(!empty($data)){
            $array = explode("|", $data);
            if(!empty($array) && count($array) > 1){
                for ($index = 0; $index < count($array); $index++) {
                    $arrtemp = explode(":", $array[$index]);
                    if($arrtemp[0] != 'fechaexpedicion_d' && $arrtemp[0] != 'fechaexpedicion_m' && $arrtemp[0] != 'fechaexpedicion_a')
                        $sql = $sql . $arrtemp[0] . "='" . strtoupper($arrtemp[1]) . "', ";
                }
            }
        }
        $fecha = " fechaexpedicion='" . $fecha . "', estado_autos='1' ";
        $sql = $sql . $fecha;
        $sql = $sql . " WHERE id_form='" . $id_form . "';";
        if (mysqli_query($GLOBALS['link'], $sql)) {
            return true;
        } else {
            return false;
        }
    }

//    function functionAlerts($idcliente, $data, $contact) {//sinthia rodriguez
//        return "idcliente:". $idcliente ." - {" . $data . "} - resultado: " . $contact;
//    }
}
