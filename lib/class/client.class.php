<?php
//require_once $_SERVER['DOCUMENT_ROOT'].'/Aplicativos.Serverfin04' . '/Colpatria/config/globalParameters.php';
//require_once ("conexion.class.php");
//require_once dirname(dirname(__FILE__)) . "/includes.php";
//require_once ('../../includes.php');
require_once PATH_SITE . DS . 'config/globalParameters.php';
require_once PATH_CLASS . DS . '_conexion.php';

class Client{

    function getId($document = null, $persontype = null) {
        $sql = "SELECT id FROM client WHERE document = '$document' AND persontype = '$persontype'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    public static function getClientes($document) {
        $conexion = new Conexion();
        $SQL = "SELECT * FROM client WHERE document = '$document'";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() > 0) {
            $objetos = array();
            while($consulta = $conexion->sacarRegistro())
                $objetos[] = $consulta;
            
            $conexion->desconectar();
            return $objetos;
        } else
            return false;
    }

    function get($id) {
        $sql = "SELECT c.*, 
                       pr.descripcion AS regimen_str
                  FROM client AS c 
                 INNER JOIN param_regimen AS pr ON(pr.id = c.regimen_id)
                 WHERE c.id = '$id'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getSup($id) {
        $sql = "SELECT * FROM sup_client WHERE id = '$id'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function updatePersonType($id, $type) {
        $sql = "UPDATE client SET persontype = '$type' WHERE id = '$id'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function add($document, $persontype, $firstname, $lastname) {
        $document = mysqli_real_escape_string($GLOBALS['link'], $document);
        $firstname = mysqli_real_escape_string($GLOBALS['link'], $firstname);
        $lastname = mysqli_real_escape_string($GLOBALS['link'], $lastname);
        $sql = "INSERT INTO client
                (
                    document, persontype, firstname, lastname, vigente
                )
                VALUES
                (
                    '$document', '$persontype', '$firstname', '$lastname', '0'
                )";
        //echo $sql;
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return -1;
    }

    /* function addPrueba(){
      $sql = "INSERT INTO `colpatria_sgd`.`client`
      (
      `id`, `document`, `persontype`, `firstname`, `lastname`, `type`, `date_created`, `flag`, `capi`, `date_updated`, `status_migracion`, `status_form`, `last_updater`, `date_updated_document`
      )
      VALUES
      (
      NULL, '32633800', '1', 'LARA BELE�O MARTHA CECILIA', '', 'SGV', '2011-08-25 09:20:24', 'MIGRACION', 'No', '0000-00-00', 'Activo', 'Activo', '0', '0000-00-00 00:00:00'
      )";
      if( mysqli_query($GLOBALS['link'], $sql))
      return 0;
      else
      return -1;
      } */

    function search($type, $criterio, $text){
        $comp = "";
        $comp1 = "";
        if($type == 1 && $criterio == 1){
            $comp = "AND client.document = '$text'";
        }elseif($type == 1 && $criterio == 2){
            $comp = "AND client.document LIKE '%" . $text . "%'";
        }elseif($type == 2 && $criterio == 1){
            $comp = "AND CONCAT(client.firstname,' ',client.lastname) = '" . $text . "'";
        }elseif($type == 2 && $criterio == 2){
            $comp = "AND CONCAT(client.firstname,' ',client.lastname) LIKE '%" . $text . "%'";
        }
        /*$sql = "SELECT client.*, param_sucursales.sucursal AS sucursal 
                  FROM client 
                  LEFT JOIN form ON(form.id_client = client.id)
                  LEFT JOIN data ON(data.id_form = form.id)
                  LEFT JOIN param_sucursales ON(param_sucursales.id = data.sucursal)
                 WHERE client.estado = 0 $comp
                 GROUP BY client.id";*/
        $sql = "SELECT client.*, IF(client.vigente = '0', datos.sucursal, 'Formulario no vigente') AS sucursal, datos.date_created
                  FROM client 
                  LEFT JOIN 
                  (
                    SELECT * FROM v_ultima_data ORDER BY id_client, date_created DESC
                  ) AS datos ON(datos.id_client = client.id) 
                 WHERE client.estado = '0' $comp 
                 GROUP BY client.id";//144330551
        /*$sql = "SELECT c.*, 
                       IF(c.vigente = '0', d.sucursal, 'Formulario no vigente') AS sucursal, 
                       d.date_created
                  FROM client AS c
                  LEFT JOIN (SELECT f.id,
                                    f.id_client,
                                    d.id_form,
                                    s.sucursal,
                                    f.date_created 
                               FROM form AS f
                              INNER JOIN data AS d ON(d.id_form = f.id)
                               LEFT JOIN param_sucursales AS s ON(s.id = d.sucursal)
                              ORDER BY 2 ASC, 5 DESC
                       ) AS d ON(d.id_client = c.id)
                 WHERE c.estado = '0' $comp 
                 GROUP BY c.id";*/
        //echo $sql;
        return mysqli_query($GLOBALS['link'], $sql);
    }
    public static function buscarCliente($type, $criterio, $text){
        $comp = "";
        $comp1 = "";
        if($type == 1 && $criterio == 1){
            $comp = "AND c.document = '$text'";
        }elseif($type == 1 && $criterio == 2){
            $comp = "AND c.document LIKE '%" . $text . "%'";
        }elseif($type == 2 && $criterio == 1){
            $comp = "AND CONCAT(c.firstname,' ',c.lastname) = '" . $text . "'";
        }elseif($type == 2 && $criterio == 2){
            $comp = "AND CONCAT(c.firstname,' ',c.lastname) LIKE '%" . $text . "%'";
        }
        $conn = new Conexion();
        $SQL = "SELECT * 
                  FROM client AS c 
                 WHERE c.estado = '0' $comp";
        if($conn->consultar($SQL)){
            if($conn->getNumeroRegistros() > 0){
                $objs = array();
                $con2 = new Conexion();
                while($row = $conn->sacarRegistro('str')){
                    $SQ1 = "SELECT f.id,
                                   f.id_client,
                                   d.id_form,
                                   s.sucursal,
                                   f.date_created 
                              FROM form AS f
                             INNER JOIN data AS d ON(d.id_form = f.id)
                              LEFT JOIN param_sucursales AS s ON(s.id = d.sucursal)
                             WHERE f.id_client = :id_client
                               AND f.status = 1
                             ORDER BY 2 ASC, 5 DESC
                             LIMIT 0, 1";
                    if($con2->consultar($SQ1, array(':id_client'=> $row['id']))){
                        if($con2->getNumeroRegistros() > 0){
                            $row2 = $con2->sacarRegistro('str');
                            $row['id_form'] = $row2['id'];
                            $row['id_client'] = $row2['id_client'];
                            $row['sucursal'] = ($row['vigente'] == '0') ? $row2['sucursal'] : 'Formulario no vigente';
                            $row['fecha_creacion'] = $row2['date_created'];
                        }
                    }
                    $objs[] = $row;
                }
                $con2->desconectar();
                $conn->desconectar();
                return $objs;
            }else{
                $conn->desconectar();
                return false;
            }
        }else{
            $conn->desconectar();
            return false;
        }
    }

    function searchSup($type, $criterio, $text) {
        $sql = "SELECT sup_client.*, param_sucursales.sucursal AS sucursal
                FROM sup_client
                LEFT JOIN form ON form.id_client = sup_client.id
                LEFT JOIN data ON data.id_form = form.id
                LEFT JOIN param_sucursales ON param_sucursales.id = data.sucursal
                WHERE 1 ";
        if ($type == 1 && $criterio == 1) {
            $sql.= "AND document = '$text'";
        } elseif ($type == 1 && $criterio == 2) {
            $sql.= "AND document LIKE '%" . $text . "%'";
        } elseif ($type == 2 && $criterio == 1) {
            $sql.= "AND CONCAT(firstname,' ',lastname) = '" . $text . "'";
        } elseif ($type == 2 && $criterio == 2) {
            $sql.= "AND CONCAT(firstname,' ',lastname) LIKE '%" . $text . "%'";
        }
        $sql .= " GROUP BY form.id_client ";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getUltimoMovimiento($id_client) {
        $fecha1 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT date_created FROM form WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1"));
        $fecha2 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT date_created FROM data_confirm WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1"));
        $fecha3 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT date_created FROM data_capi_confirm WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1"));
        $fecha4 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT fecha_datacredito FROM client WHERE id = '$id_client' LIMIT 1")); //fECHA DATA CREDITO SKRV
        

        if ($fecha1['date_created'] > $fecha2['date_created'] && $fecha1['date_created'] > $fecha3['date_created'] && $fecha1['date_created'] > $fecha4['fecha_datacredito'] ) {
            return $fecha1['date_created'];
        } else if ($fecha2['date_created'] > $fecha1['date_created'] && $fecha2['date_created'] > $fecha3['date_created'] && $fecha2['date_created'] > $fecha4['fecha_datacredito'] ) {
            return $fecha2['date_created'];
        } else if ($fecha3['date_created'] > $fecha1['date_created'] && $fecha3['date_created'] > $fecha2['date_created'] && $fecha3['date_created'] > $fecha4['fecha_datacredito']) {
            return $fecha3['date_created'];
        } else if($fecha4['fecha_datacredito'] !== '0000-00-00 00:00:00') {
            return $fecha4['fecha_datacredito'] . "[DC]";
        }else{
            return '0000-00-00 00:00:00';
        } 
    }

    function getEstadoInformacion($id_client, $regimen_id = '2') {
        $intervalo = 365;
        $anios = 1;
        if($regimen_id == '1')
            return "No aplica";
        else if($regimen_id == '2'){
            $intervalo = 730;
            $anios = 2;
        }
        $query = <<< SQL
			SELECT MAX(a.d) + INTERVAL $intervalo DAY AS date, (MAX(a.d) + INTERVAL $intervalo DAY) >= NOW() AS valid, DATE(MAX(a.d)) AS actual
			FROM
			(
				(
					SELECT date_created AS d 
                      FROM data_capi_confirm
					 WHERE (id_contact BETWEEN 1 AND 3) 
                       AND id_client = $id_client 
                       AND status = 1 
                     ORDER BY date_created DESC 
                     LIMIT 1
				)UNION(
					SELECT date_created AS d 
                      FROM data_confirm
					 WHERE (id_contact BETWEEN 1 AND 3) 
                       AND id_client = $id_client 
                       AND status = 1 
                     ORDER BY date_created DESC 
                     LIMIT 1
				)UNION(
					SELECT CAST(data.fechasolicitud AS DATE) AS d 
                      FROM data 
                     INNER JOIN form ON(form.id = data.id_form)
					 WHERE form.id_client = $id_client 
                     ORDER BY data.fechasolicitud DESC 
                     LIMIT 1
				)UNION(
					SELECT fecha_datacredito AS d 
                      FROM client
					 WHERE id = $id_client 
                     LIMIT 1
				)
			) AS a
SQL;
        $data = mysqli_fetch_assoc(mysqli_query($GLOBALS['link'], $query));
        /*$nextAnio = date('Y-m-d', strtotime($data['actual']." +".$anios." years"));
        if($nextAnio >= date('Y-m-d'))
            return "Vigente hasta " . date("Y-m-d", strtotime($nextAnio));
        else
            return "Desactualizado";*/

        if($data['valid']){
            return "Vigente hasta " . date("Y-m-d", strtotime($data['date']));
        }else{
            return "Desactualizado";
        }
    }

    function activeCliente($id_cliente) {
        $conn = new Conexion();
        $now = date('Y-m-d');
        $sql = "UPDATE client 
                   SET estado = '0', type = 'SGV', vigente = '0', date_updated = '$now', flag = '' 
                 WHERE id = '$id_cliente'";
        if($conn->ejecutar($sql)){
            $conn->desconectar();
            return true;
        }else{
            $conn->desconectar();
            return false;
        }
    }

    function actializaDataCredito($id, $fecha) {
        $con = new Conexion();
        $SQL = "UPDATE client SET fecha_datacredito='" . date("Y-m-d", strtotime($fecha)) . " 00:00:00' WHERE id = " . $id . " ";
        $con->ejecutar($SQL);
    }

    function getinfoclientesactualizados($id) {
        $con = new Conexion();
        $SQL = "SELECT 
    client.id,
    client.type,
    client.capi,
    (SELECT 
            MAX(a.d) + INTERVAL 365 DAY AS date
        FROM
            ((SELECT 
                date_created AS d
            FROM
                data_capi_confirm
            WHERE
                id_contact BETWEEN 1 AND 3
                    AND id_client = ".$id."
                    AND status = 1
            ORDER BY date_created DESC
            LIMIT 1) UNION (SELECT 
                date_created AS d
            FROM
                data_confirm
            WHERE
                id_contact BETWEEN 1 AND 3
                    AND id_client = ".$id."
                    AND status = 1
            ORDER BY date_created DESC
            LIMIT 1) UNION (SELECT 
                CAST(data.fechasolicitud AS DATE) AS d
            FROM
                data
            INNER JOIN form ON form.id = data.id_form
            WHERE
                form.id_client = ".$id."
            ORDER BY data.fechasolicitud DESC
            LIMIT 1) UNION (SELECT 
                fecha_datacredito AS d
            FROM
                client
            WHERE
                id = ".$id."
            LIMIT 1)) AS a) as Valido_,
    (select 
            MAX(a.d)
        from
            ((SELECT 
                date_created as d
            FROM
                form
            WHERE
                id_client = '".$id."'
            ORDER BY date_created DESC
            LIMIT 1) union (SELECT 
                date_created as d
            FROM
                data_confirm
            WHERE
                id_client = '".$id."'
            ORDER BY date_created DESC
            LIMIT 1) union (SELECT 
                date_created as d
            FROM
                data_capi_confirm
            WHERE
                id_client = '".$id."'
            ORDER BY date_created DESC
            LIMIT 1) union (SELECT 
                fecha_datacredito as d
            FROM
                client
            WHERE
                id = '".$id."'
            LIMIT 1)) as a) as ultimo_m
from
    client
where
    client.id = '".$id."'";
        $con->consultar($SQL);
        if ($con->getNumeroRegistros() > 0) {
            $objetos = array();
            $consulta = $con->sacarRegistro();
            $con->desconectar();
            return $consulta;
        } else {
            return false;
        }
//        return $SQL;
    }
    
    function getUltimaMarca($id_client) {
        $fecha1 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT date_created FROM form WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1"));
        $fecha2 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT date_created FROM data_confirm WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1"));
        $fecha3 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT date_created FROM data_capi_confirm WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1"));
        $fecha4 = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT fecha_datacredito FROM client WHERE id = '$id_client' LIMIT 1")); //fECHA DATA CREDITO SKRV
        

        if ($fecha1['date_created'] > $fecha2['date_created'] && $fecha1['date_created'] > $fecha3['date_created'] && $fecha1['date_created'] > $fecha4['fecha_datacredito'] ) {
//            return "fecha1";
        } else if ($fecha2['date_created'] > $fecha1['date_created'] && $fecha2['date_created'] > $fecha3['date_created'] && $fecha2['date_created'] > $fecha4['fecha_datacredito'] ) {
//            return "fecha2";
        } else if ($fecha3['date_created'] > $fecha1['date_created'] && $fecha3['date_created'] > $fecha2['date_created'] && $fecha3['date_created'] > $fecha4['fecha_datacredito']) {
//            return "fecha3";
        } else {
            return "[DC]";
        } 
    }

    public static function dataMatriz($id) {
        $conn = new Conexion();
        $SQL = "SELECT * 
                  FROM data_matriz 
                 WHERE id = '$id'";
        if($conn->consultar($SQL)){
            if ($conn->getNumeroRegistros() == 1){
                $consulta = $conn->sacarRegistro('str');
                $conn->desconectar();
                return $consulta;
            }else{
                $conn->desconectar();
                return false;
            }
        }else{
            $conn->desconectar();
            return false;
        }
    }

    public static function listadataMatriz($id_client) {
        $conn = new Conexion();
        $SQL = "SELECT * 
                  FROM data_matriz 
                 WHERE id_client = '$id_client'";
        if($conn->consultar($SQL)){
            if ($conn->getNumeroRegistros() == 1){
                $consulta = $conn->sacarRegistro('str');
                $conn->desconectar();
                return $consulta;
            }else{
                $conn->desconectar();
                return false;
            }
        }else{
            $conn->desconectar();
            return false;
        }
    }
    public static function actualizarItemRadicadoComplementaria($documento, $lote, $especial){
        $conn = new Conexion();
        $SQL = "UPDATE radicados_items
                   SET documento_especial = :documento_especial
                 WHERE documento = :documento
                   AND id_radicados = :id_radicados";
        if($conn->ejecutar($SQL, array(':documento_especial'=> $especial, ':documento'=> $documento, ':id_radicados'=> $lote))){
            $conn->desconectar();
            return true;
        }else{
            $conn->desconectar();
            return false;
        }
    }
}