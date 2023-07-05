<?php
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';
require_once PATH_SITE . DS . "config/globalParameters.php";
require_once PATH_CLASS.DS.'_conexion.php';
require_once PATH_CCLASS . DS . 'festivos.class.php';

use PHPMailer\PHPMailer\PHPMailer;

class Ordenproduccion {

    function addOrden($id_user, $planilla, $lote, $asesor, $cantidad, $sucursal, $area, $devoluciones, $fecha, $total_formularios, $no_llegaron) {
        $sql = "INSERT INTO ordenproduccion
                (
                    id_user, planilla, lote, asesor, cantidad_formularios, sucursal, area, devoluciones, no_llegaron, fecha, total_formularios
                )
                VALUES
                (
                    '$id_user', '$planilla', '$lote', '$asesor', '$cantidad', '$sucursal', '$area', '$devoluciones', '$no_llegaron', '$fecha', '$total_formularios'
                )";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function search($criterio, $texto) {
        if ($criterio == '1') {
            $sql = "    SELECT orden.id, orden.planilla, orden.lote, orden.cantidad_formularios, 
                               orden.devoluciones, orden.fecha, orden.total_formularios, 
                               usuario.name AS usuario, usuario2.name AS asesor, 
                               DATE(orden.date_created) AS fecha_creacion
                          FROM ordenproduccion AS orden 
                    INNER JOIN user AS usuario ON usuario.id = orden.id_user
                    INNER JOIN user AS usuario2 ON usuario2.id = orden.asesor
                         WHERE orden.planilla= '$texto'";
        } else {
            $sql = "    SELECT orden.id, orden.planilla, orden.lote, orden.cantidad_formularios, 
                               orden.devoluciones, orden.fecha, orden.total_formularios, 
                               usuario.name AS usuario, usuario2.name AS asesor, 
                               DATE(orden.date_created) AS fecha_creacion
                          FROM ordenproduccion AS orden 
                    INNER JOIN user AS usuario ON usuario.id = orden.id_user
                    INNER JOIN user AS usuario2 ON usuario2.id = orden.asesor
                         WHERE orden.lote= '$texto'";
        }
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getNumOrdenes() {
        $sql = "SELECT COUNT(*) as total 
			 FROM ordenproduccion ";
        $result = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql));
        return $result['total'];
    }

    function getOrdenes($inicio) {
        $sql = "SELECT orden.id, user.name, orden.planilla, orden.lote, orden.cantidad_formularios, 
                       orden.devoluciones, orden.total_formularios, orden.estado_aprobacion, orden.no_llegaron 
                  FROM ordenproduccion orden 
                  LEFT JOIN user ON user.id = orden.id_user 
                 ORDER BY orden.planilla DESC, orden.lote DESC 
                 LIMIT $inicio,40";
        //echo $sql;
        return mysqli_query($GLOBALS['link'], $sql);
    }
    static function getOrdenesTodas(){
    	$sql = "SELECT orden.id, 
    				   user.name, 
    				   orden.planilla, 
    				   orden.lote, 
    				   orden.cantidad_formularios, 
    				   orden.devoluciones, 
    				   orden.total_formularios, 
    				   orden.estado_aprobacion, 
    				   orden.no_llegaron 
    			  FROM ordenproduccion orden 
    			  LEFT JOIN user ON user.id = orden.id_user 
    			 ORDER BY orden.planilla DESC, orden.lote DESC";
    	//echo $sql;
    	$resp = mysqli_query($GLOBALS['link'], $sql);
    	$num_filas = mysqli_num_rows($resp);
    	//echo $num_filas;
    	$objs = array();
    	if($num_filas > 0){
    		while ($obj = mysqli_fetch_array($resp, MYSQLI_ASSOC)){
    			$obj['inicio'] = '';
    			if($obj['estado_aprobacion'] == 'Sin aprobar'){
    				$obj['inicio'] = '<a href="" onClick="window.open(\'editOrden.php?orden='.$obj['id'].'\', \'\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=420,height=200,top=85,left=140\'); return false;"><img src="../../resources/images/icons/edit.png" alt="Editar"/></a>';
    			}
    			$obj['form_digitado'] = self::getCountForms2($obj['planilla'], $obj['lote']);
    			$obj['form_devolucion'] = self::getCount2($obj['lote'], "0"); 
    			$obj['form_noLlegaron'] = self::getNoLlegaronForms($obj['lote']);
    			$obj['acciones'] = '';
    			$procesados = intval($obj['form_digitado']) + intval($obj['form_devolucion']) + intval($obj['form_noLlegaron']);
    			if ($obj['cantidad_formularios'] == $procesados && (intval($obj['form_digitado']) == $obj['total_formularios']) && (intval($obj['form_devolucion']) == $obj['devoluciones']) && (intval($obj['form_noLlegaron']) == $obj['no_llegaron'])){
    				if($obj['estado_aprobacion'] == 'Sin aprobar'){
    					$obj['acciones'] = '<a href="#" onclick="window.open(\'validacionOrden.php?orden='.$obj['id'].'&cantidad_datos='.($obj['devoluciones'] + $obj['total_formularios']).'\', \'\', \'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=300, top=85, left=140\');" class="button">Aprobar</a>';
    				}
    			}else
    				$obj['acciones'] = 'No esta lista para aprobaci&oacute;n.';

    			$objs[] = $obj;
	    	}
	    }
	    //print_r($objs);
	    return $objs;
    }

    function getOrden($id) {
        $sql = "SELECT * FROM ordenproduccion WHERE id='$id'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function changeStatus($id_orden, $estado) {
        $sql = "UPDATE ordenproduccion SET estado_aprobacion = '$estado' WHERE id='$id_orden'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function validafechas() {
        /**
         * SKRV
         */
        $fecha = date('Y-m-d');
        $SQL = "SELECT * FROM orden_recordatorio 
				WHERE fecha = '$fecha'";
        return mysqli_query($GLOBALS['link'], $SQL);
    }

    function actualizaNotificacion() {
        /**
         * SKRV
         */
        $fecha = date('Y-m-d');
        $SQL = "INSERT INTO orden_recordatorio(fecha) VALUES ('" . $fecha . "')";
        return mysqli_query($GLOBALS['link'], $SQL);
    }

    public static function validaFestivos($id) {
        /**
         * SKRV
         */
        $sql = "SELECT date_created FROM ordenproduccion WHERE id = " . $id;
        $result_search = mysqli_query($GLOBALS['link'], $sql);
        $count_results = mysqli_num_rows($result_search);

        $dactual = array(
            "dia" => date('d'),
            "mes" => date('m'),
            "anio" => date('Y'),
            "stdia" => date('N')
        );
        $dcreacion = array(
            "dia" => 0,
            "mes" => 0,
            "anio" => 0,
            "stdia" => 0
        );
        $sd = new festivos(date("d-m-Y"));
        $fcorridos = $sd->getFestivosCorridos();
        $festables = $sd->getFestivosFijos();
        $count = 0;

        if ($count_results > 0) {
            while ($consulta = mysqli_fetch_array($result_search)) {
//                echo "<br>" . $consulta["fecha_creacion"];
                $dcreacion = array(
                    "dia" => date('d', strtotime($consulta["date_created"])),
                    "mes" => date('m', strtotime($consulta["date_created"])),
                    "anio" => date('Y', strtotime($consulta["date_created"])),
                    "stdia" => date("N", strtotime($consulta["date_created"]))
                );
                if ($dactual["anio"] == $dcreacion["anio"]) {
                    /*
                      if ($dcreacion["mes"] == $dactual["mes"]) {
                      for ($dia = $dcreacion["dia"]; $dia <= $dactual["dia"]; $dia++) {
                      for ($i = 0; $i < count($fcorridos); $i++) {
                      $ftemp = explode("-", $fcorridos[$i]);
                      if ($dia == $ftemp[1] && $mes == $ftemp[0]) {
                      $count++;
                      }
                      }
                      for ($a = 0; $a < count($festables); $a++) {
                      $ftemp = explode("-", $festables[$a]);
                      if ($dia == $ftemp[1] && $mes == $ftemp[0]) {
                      $count++;
                      }
                      }
                      }
                      } else {

                      }
                     */
                    $dsemana = $dcreacion["stdia"];
                    for ($mes = 1; $mes <= 12; $mes++) {
                        if ($mes >= $dcreacion["mes"] && $mes <= $dactual["mes"]) {//---
                            for ($dia = 1; $dia <= 31; $dia++) {

                                if ($dia >= $dcreacion["dia"] || $mes > $dcreacion["mes"] && $dia <= $dactual["dia"]) {

                                    for ($i = 0; $i < count($fcorridos); $i++) {
                                        $ftemp = explode("-", $fcorridos[$i]);
                                        if ($dia == $ftemp[1] && $mes == $ftemp[0]) {
                                            $count++;
                                        }
                                    }
                                    for ($a = 0; $a < count($festables); $a++) {
                                        $ftemp = explode("-", $festables[$a]);
                                        if ($dia == $ftemp[1] && $mes == $ftemp[0]) {
                                            $count++;
                                        }
                                    }

                                    if ($dsemana == 7) {
                                        $count++;
                                    }

                                    $dsemana++;

                                    if ($dsemana == 8) {
                                        $dsemana = 1;
                                    }
                                }
                                if ($mes == $dactual["mes"] && $dia == $dactual["dia"]) {//---
                                    $dia = 31;
                                }

                                //----
                                if ($mes == 9 || $mes == 4 || $mes == 6 || $mes == 11) {
                                    if ($dia == 30) {
                                        $dia = 31;
                                    }
                                }
                                if ($mes == 2) {
                                    if ($dia == 28) {
                                        $dia = 31;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $count;
    }

    function ordenesNoAprobadas() {
        /**
         * SKRV
         */
        $fecha = date('Y-m-d');
        $SQL = "SELECT id, DATEDIFF('$fecha', date_created) AS diferencia
				FROM ordenproduccion where estado_aprobacion = 'Sin aprobar' and MONTH(date_created) > (MONTH('". $fecha ."') - 2) and YEAR(date_created) = YEAR('". $fecha ."')";
        $result_search = mysqli_query($GLOBALS['link'], $SQL);
        $count_results = mysqli_num_rows($result_search);

        if ($count_results > 0) {
            while ($orden_enabled = mysqli_fetch_array($result_search)) {
                $diferencia = $orden_enabled['diferencia'] - self::validaFestivos($orden_enabled['id']);
                if ($diferencia > 3) {
                    $oficial = array();
                    $oficial['dias_atrazo'] = $diferencia;
                    $oficial['id_orden'] = $orden_enabled['id'];
                    $array[] = $oficial;
                }
            }
            return $array;
        } else {
            return false;
        }
    }

    function enviarMailControl($datos) {
        $mail = new PHPMailer();
        $body = "Acontinuacion encuentra las ordenes de produccion sin aprobar: <br>";
        $body .= "<table>
                    <tr>
                        <td>Planilla</td>
                        <td>Consecutivo</td>
                        <td>Fecha creacion</td>
                    </tr>
                    " . $datos . "
                </table>";

        $mail->IsSendmail();

        $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
        $mail->Subject = "Control Ordenes de produccion.";

        $mail->MsgHTML($body);
//        if (isset($oficial['email'])) {
//            $address = $oficial['email'];
//            $mail->AddAddress($address, $oficial['name']);
//        }
//        $mail->AddAddress("palertas.finleco@gmail.com", "prueba alertas");
        $mail->AddAddress("laura.riveros@finlecobpo.com", "Laura Riveros");
        //$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel Chico P.");
//        if (isset($oficial['email_father']) && $oficial['email_father'] != "")
//            $mail->AddCC($oficial['email_father']);

        if (!$mail->Send()) {
            return "Mailer Error: " . $mail->ErrorInfo;
        } else {
            return true;
        }
    }

	static function getCountForms2($planilla, $lote) {
        $conn = new Conexion();
		$sql = "SELECT SUM(t.total) AS total
				  FROM (
				  	   (SELECT COUNT('x') AS total, 'form' AS tipo
				  	   	  FROM form 
				  	   	 WHERE log_lote = '$lote' 
				  	   	   AND status = '1'
				  	   )
				  	   UNION
				  	   (SELECT COUNT('x') AS total, 'renovacion' AS tipo
                          FROM 
                       (SELECT lote, documento
                           FROM data_renovacion_autos
                          WHERE lote = '$lote'
                          GROUP BY documento) AS dra
				  	   )
                       UNION
                       (SELECT COUNT('x') AS total, 'especiales' AS tipo
                           FROM radicados_items
                          WHERE id_radicados = '$lote'
                            AND estado = '2'
                            AND documento_especial IN ('2')
                       )
				  	) AS t";
        if($conn->consultar($sql)){
            if($conn->getNumeroRegistros() > 0){
                $dat = $conn->sacarRegistro('str');
                $conn->desconectar();
                return $dat['total'];
            }else{
                $conn->desconectar();
                return 0;
            }
        }else{
            $conn->desconectar();
            return 0;
        }
		//$result = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql));
		//return $result['total'];
	}
	static function getCount2($lote, $flag){
		$conn = new Conexion();
		$total = "";

		$sql = "SELECT COUNT('x') AS total 
				  FROM workflow 
				 WHERE lote = '$lote' 
				   AND status = '1'";
		if($conn->consultar($sql)){
			if($conn->getNumeroRegistros() > 0){
				$dat = $conn->sacarRegistro('str');
				if($dat['total'] > 0){
					if($flag == "1")
						$total = $total." - ";
					$total = $total.$dat['total']." en devoluci&oacute;n.";
				}else{
					if($flag == "1")
						$total = $total." - ";
					$total = $total." 0 en devoluci&oacute;n.";
				}
			}else{
				if($flag == "1")
					$total = $total." - ";
				$total = $total." 0 en devoluci&oacute;n.";
			}
		}else{
			if($flag == "1")
				$total = $total." - ";
			$total = $total." 0 en devoluci&oacute;n.";
		}
		return $total;
	}
	static function getNoLlegaronForms($lote){
		$conn = new Conexion();
		$SQL = "SELECT COUNT('x') AS total
				  FROM radicados AS t1
				 INNER JOIN radicados_items AS t2 ON(t2.id_radicados = t1.id)
				 WHERE t1.estado = 2
				   AND t2.estado = 1
				   AND t1.id = '$lote'";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$dat = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $dat['total'];
			}else{
				$conn->desconectar();
				return 0;
			}
		}else{
			$conn->desconectar();
			return 0;
		}
	}
    static function searchOrden($criterio, $texto) {
    	$objs = array(
    		'draw'=> 1,
			'recordsTotal'=> 0,
			'recordsFiltered'=> 0,
			'data'=> array()
		);
    	$comp = 'orden.lote = :texto';
    	if($criterio == '1')
    		$comp = 'orden.planilla = :texto';
		$conn = new Conexion();
		$SQL = "SELECT orden.id, 
					   orden.planilla, 
					   orden.lote, 
					   orden.cantidad_formularios, 
					   orden.devoluciones, 
					   orden.fecha, 
					   orden.total_formularios, 
					   usuario.name AS usuario, 
					   usuario2.name AS asesor, 
					   DATE(orden.date_created) AS fecha_creacion
				  FROM ordenproduccion AS orden 
				 INNER JOIN user AS usuario ON(usuario.id = orden.id_user)
				 INNER JOIN user AS usuario2 ON(usuario2.id = orden.asesor)
				 WHERE $comp";
		if($conn->consultar($SQL, array(':texto'=> $texto))){
			if($conn->getNumeroRegistros() > 0){
				$cant = $conn->getNumeroRegistros();
				$objs['recordsTotal'] = $cant;
				$objs['recordsFiltered'] = $cant;
				while($dat = $conn->sacarRegistro('str'))
					$objs['data'][] = $dat;
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
    static function informacionRadicado($id){
        $conn = new Conexion();
        $SQL = "SELECT t1.id,
                       ps.sucursal,
                       of.name AS oficial_nombre
                  FROM radicados AS t1
                 INNER JOIN param_sucursales AS ps ON(ps.id = t1.id_sucursal)
                 INNER JOIN user AS of ON(of.id = t1.id_usuarioenvia)
                 WHERE t1.id = :id";
        if($conn->consultar($SQL, array(':id'=> $id))){
            if($conn->getNumeroRegistros() == 1){
                $dat = $conn->sacarRegistro('str');
                $conn->desconectar();
                return $dat;
            }else{
                $conn->desconectar();
                return false;
            }
        }else{
            $conn->desconectar();
            return false;
        }
    }
    static function obtenerOrderId($id){
        $conn = new Conexion();
        $SQL = "SELECT o.*
                  FROM ordenproduccion AS o
                 WHERE o.id = :id";
        if($conn->consultar($SQL, array(':id'=> $id))){
            if($conn->getNumeroRegistros() == 1){
                $dat = $conn->sacarRegistro('str');
                $conn->desconectar();
                return $dat;
            }else{
                $conn->desconectar();
                return false;
            }
        }else{
            $conn->desconectar();
            return false;
        }
    }
    static function obtenerClientesDigitados($lote, $planilla){
        $conn = new Conexion();
        $SQL = "SELECT SUM(total) AS total_digitados
                  FROM (
                        (SELECT COUNT('x') AS total, 'form' AS tipo
                           FROM form
                          WHERE log_lote = :lote1
                            AND log_planilla = :planilla1
                            AND status = :status)
                        UNION
                        (SELECT COUNT('x') AS total, 'datar' AS tipo
                           FROM
                         (SELECT lote, planilla, documento
                            FROM data_renovacion_autos AS a
                           WHERE lote = :lote2
                             AND planilla = :planilla2
                           GROUP BY documento) AS dra)
                        UNION
                        (SELECT COUNT('x') AS total, 'radi' AS tipo
                           FROM radicados_items AS r
                          WHERE id_radicados = :lote3
                            AND estado = :estado
                            AND documento_especial IN ('2'))
                  ) AS tab";
        if($conn->consultar($SQL, array(':lote1'=> $lote, ':planilla1'=> $planilla, ':status'=> '1', ':lote2'=> $lote, ':planilla2'=> $planilla, ':lote3'=> $lote, ':estado'=> '2'))){
            if($conn->getNumeroRegistros() == 1){
                $dat = $conn->sacarRegistro('str');
                $conn->desconectar();
                return $dat;
            }else{
                $conn->desconectar();
                return false;
            }
        }else{
            $conn->desconectar();
            return false;
        }
    }
    static function obtenerClientesDevueltos($lote){
        $conn = new Conexion();
        $SQL = "SELECT COUNT('x') AS total_devueltos
                  FROM workflow 
                 WHERE lote = :lote";
        if($conn->consultar($SQL, array(':lote'=> $lote))){
            if($conn->getNumeroRegistros() == 1){
                $dat = $conn->sacarRegistro('str');
                $conn->desconectar();
                return $dat;
            }else{
                $conn->desconectar();
                return false;
            }
        }else{
            $conn->desconectar();
            return false;
        }
    }
    static function obtenerClientesNoLlegaron($lote){
        $conn = new Conexion();
        $SQL = "SELECT COUNT('x') AS total_nollegaron
                  FROM radicados_items 
                 WHERE id_radicados = :id_radicados
                   AND estado = :estado";
        if($conn->consultar($SQL, array(':id_radicados'=> $lote, ':estado'=> '1'))){
            if($conn->getNumeroRegistros() == 1){
                $dat = $conn->sacarRegistro('str');
                $conn->desconectar();
                return $dat;
            }else{
                $conn->desconectar();
                return false;
            }
        }else{
            $conn->desconectar();
            return false;
        }
    }
    static function aprobarOrden($orden_id, $estado){
        $conn = new Conexion();
        $SQL = "UPDATE ordenproduccion 
                   SET estado_aprobacion = :estado_aprobacion 
                 WHERE id = :orden_id";
        if($conn->ejecutar($SQL, array(':estado_aprobacion'=> $estado, ':orden_id'=> $orden_id))){
            $conn->desconectar();
            return array('exito'=> 'La orden se aprobo correctamente.');
        }else{
            $conn->desconectar();
            return array('error'=> 'Ocurrio un error al momento de aprobar la orden, contacte con el administrador.');
        }
    }
    static function eliminarOrden($orden_id){
        $conn = new Conexion();
        /*$SQL = "DELETE FROM ordenproduccion 
                 WHERE id = :orden_id";
        if($conn->ejecutar($SQL, array(':orden_id'=> $orden_id))){*/
        $SQL = "UPDATE ordenproduccion 
                   SET estado = :estado
                 WHERE id = :orden_id";
        if($conn->ejecutar($SQL, array(':orden_id'=> $orden_id, ':estado'=> '1'))){
            $conn->desconectar();
            return array('exito'=> 'La orden se elimino correctamente.');
        }else{
            $conn->desconectar();
            return array('error'=> 'Ocurrio un error al momento de eliminar la orden, contacte con el administrador.');
        }
    }
}
?>