<?php
$username = 'colpatria_sgd';
$password = 'colpatria_sgd';
try{
    $dbh = new PDO("mysql:host=localhost;dbname=colpatria_sgd;charset=utf8", $username, $password);
    if(!$dbh){
        echo "No se pudo conectar a la base de datos";
        exit();
    }
    $dbh->exec("set names utf8");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //
    //26 campos
    $tdoc_colpatria = array(
        0 => "NUL",
        1 => "C.C",
        2 => "C.E",
        3 => "NIT",
        4 => "T.I",
        5 => "PASAPORTE",
        6 => "TARJETA DEL SEGURO SOCIAL",
        7 => "SOC. EXTRANJERA SIN NIT EN COLO",
        8 => "FIDEICOMISO",
        9 => "REGISTRO CIVIL",
        10 => "SIN DOCUMENTO",
        11 => "SF",
    );
    $sql = "SELECT IF(client.persontype = 1, 'NATURAL', 'JURIDICO') AS tipo_persona, param_tipodocumento.description,
            IF(client.persontype = 1, concat_ws(' ', data.nombres, data.primerapellido, data.segundoapellido), data.razonsocial) AS Nombre_o_Razón_Social,
            data.documento, data.digitochequeo, data.estado_autos, formu.date_created, data_renovacion_autos.fecha_diligenciamiento,
            data.fechanacimiento, data.lugarnacimiento, data.fechaexpedicion, data.lugarexpedicion, data.nacionalidad, data.ciudadresidencia,
            IF(client.persontype = 1, data.direccionresidencia, data.direccionoficinappal) AS Direccion_residencia_o_pj, 
            IF(client.persontype = 1, data.telefonoresidencia, data.telefonoficina) AS telefono_residencia_o_pj,
            data.telefonolaboral, data.celular, data.celularoficina, IF(data.correoelectronico = '', 'NA',data.correoelectronico) AS correoelectronico,
            data.ingresosmensuales, data.egresosmensuales, data.otrosingresos, data.conceptosotrosingresos, 
            IF(data.activosemp = '','NA',data.activosemp) AS activo, IF(data.pasivosemp = '','NA',data.pasivosemp) AS pasivo,
            client.id AS client_id, client.document AS client_document
            FROM data
            INNER JOIN client ON(data.documento = client.document)
            INNER JOIN data_renovacion_autos ON(data.documento = data_renovacion_autos.documento)
            INNER JOIN param_tipodocumento ON(data.tipodocumento = param_tipodocumento.id)
            INNER JOIN form formu ON(formu.id_client = client.id)";
    $result = $dbh->query($sql);
    if($result){
        $dirautos = "/var/www/html/Aplicativos.Serverfin04/Colpatria/autosfile/";
        $ar = fopen($dirautos."autos_".date('Ymd').".txt", "a") or die("Problemas en la creacion");
        while($row = $result->fetch(PDO::FETCH_ASSOC)){//900718127
            $tipo_doc = 0;
            for($index = 0; $index < count($tdoc_colpatria); $index++){
                if($tdoc_colpatria[$index] == $row['description']){
                    $tipo_doc = $index;
                    break;
                }
            }
            $estados = getEstado($row['estado_autos'], $row['client_id'], $row['client_document']);
            if($estados !== false && is_array($estados))
                $estado = date("Y-m-d", strtotime($estados['date']));
            else
                $estado = date("Y-m-d", strtotime($row['fecha_diligenciamiento']));

            $campos = $row['tipo_persona'] . "," .
                        $tipo_doc . "," .
                        $row['Nombre_o_Razón_Social'] . "," .
                        $row['documento'] . "," .
                        $row['digitochequeo'] . "," .
                        'Vigente hasta '.$estado . "," .
                        ((strtotime($row['date_created'])) ? date('Y-m-d', strtotime($row['date_created'])) : ''). "," .
                        ((strtotime($row['fecha_diligenciamiento'])) ? date('Y-m-d', strtotime($row['fecha_diligenciamiento'])) : ''). "," .
                        ((strtotime($row['fechanacimiento'])) ? date('Y-m-d', strtotime($row['fechanacimiento'])) : ''). "," .
                        $row['lugarnacimiento'] . "," .
                        ((strtotime($row['fechaexpedicion'])) ? date('Y-m-d', strtotime($row['fechaexpedicion'])) : ''). "," .
                        $row['lugarexpedicion'] . "," .
                        $row['nacionalidad'] . "," .
                        $row['ciudadresidencia'] . "," .
                        $row['Direccion_residencia_o_pj'] . "," .
                        $row['telefono_residencia_o_pj'] . "," .
                        $row['telefonolaboral'] . "," .
                        $row['celular'] . "," .
                        $row['celularoficina'] . "," .
                        $row['correoelectronico'] . "," .
                        $row['ingresosmensuales'] . "," .
                        $row['egresosmensuales'] . "," .
                        $row['otrosingresos'] . "," .
                        $row['conceptosotrosingresos'] . "," .
                        $row['activo'] . "," .
                        $row['pasivo'] . "";
            fputs($ar, $campos);
            fputs($ar, "\r\n");
        }
        fclose($ar);
    }else{
        echo "No se pudo ejecutar la consulta ()";
        exit();
    }

    echo "Los datos se cargaron correctamente.";
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
function getEstado($estado, $id_client, $documento){
    $SQL = "";
    $username = 'colpatria_sgd';
    $password = 'colpatria_sgd';
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=colpatria_sgd;charset=utf8", $username, $password);
        if(!$dbh){
            echo "No se pudo conectar a la base de datos";
            exit();
        }
        $dbh->exec("set names utf8");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        if($estado < 3){
            $SQL = "SELECT MAX(a.d) + INTERVAL 365 DAY AS date, (MAX(a.d) + INTERVAL 365 DAY) >= NOW() AS valid
                FROM
                (
                    (
                        SELECT date_created AS d FROM data_capi_confirm
                        WHERE id_contact BETWEEN 1 AND 3 AND id_client = $id_client AND status = 1 ORDER BY date_created DESC LIMIT 1
                    )UNION(
                        SELECT date_created AS d FROM data_confirm
                        WHERE id_contact BETWEEN 1 AND 3  AND id_client = $id_client AND status = 1 ORDER BY date_created DESC LIMIT 1
                    )UNION(
                        SELECT CAST(data.fechasolicitud AS DATE) AS d   FROM data INNER JOIN form ON form.id = data.id_form
                        WHERE form.id_client = $id_client ORDER BY data.fechasolicitud DESC LIMIT 1
                    )UNION(
                        SELECT fecha_datacredito AS d FROM client
                        WHERE id = $id_client LIMIT 1
                    )
                ) AS a";
        }else{
            $SQL = "SELECT MAX(a.d) + INTERVAL 365 DAY AS date, (MAX(a.d) + INTERVAL 365 DAY) >= NOW() AS valid
                FROM
                (
                    SELECT fecha_diligenciamiento AS d FROM data_renovacion_autos
                    WHERE documento = $documento ORDER BY fecha_diligenciamiento DESC LIMIT 1
                ) AS a";
        }
        $result = $dbh->query($SQL);
        if($result){
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row;
        }else
            return false;
        $dbh = null;
    }catch(PDOException $e){
        return false;
    }
}
?>