<?php
require_once PATH_SITE . DS . 'config/globalParameters.php';
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

class Alert 
{

    function getInfoAlert2() {
        $sql = "    SELECT cliente.firstname AS nombre, cliente.document AS documento
                      FROM client AS cliente
                INNER JOIN form AS formulario ON formulario.id_client = cliente.id
                INNER JOIN data AS datos ON datos.id_form = formulario.id
                     WHERE datos.actividadeconomicappal = 813
                       AND datos.ingresosmensuales IN(3,4,5,6,7,8,9,10,11,12)";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getInfoAlert3() {
        $sql = "    SELECT cliente.firstname AS nombre, cliente.document AS documento
                      FROM client AS cliente
                INNER JOIN form AS formulario ON formulario.id_client = cliente.id
                INNER JOIN data AS datos ON datos.id_form = formulario.id
                     WHERE datos.actividadeconomicappal = 809
                       AND datos.ingresosmensuales IN(3,4,5,6,7,8,9,10,11,12)";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getActividad() {
        $sql = "SELECT id, description
                  FROM param_actividad";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getInfoAlert4($id_actividad) {
        $sql = "    SELECT cliente.firstname AS nombre, cliente.document AS documento
                      FROM client AS cliente
                INNER JOIN form AS formulario ON formulario.id_client = cliente.id
                INNER JOIN data AS datos ON datos.id_form = formulario.id
                     WHERE datos.actividadeconomicappal = '$id_actividad'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getInfoAlert5() {
        $sql = "    SELECT cliente.firstname AS nombre, cliente.document AS documento
                      FROM client AS cliente
                INNER JOIN form AS formulario ON formulario.id_client = cliente.id
                INNER JOIN data_confirm AS datos ON datos.id_form = formulario.id
                     WHERE datos.id_contact IN(8,9,10)";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTransaccion() {
        $sql = "SELECT id, description
                  FROM param_tipotransacciones";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getInfoAlert6($id_transaccion) {
        $sql = "    SELECT cliente.firstname AS nombre, cliente.document AS documento
                      FROM client AS cliente
                INNER JOIN form AS formulario ON formulario.id_client = cliente.id
                INNER JOIN data AS datos ON datos.id_form = formulario.id
                     WHERE datos.tipotransacciones =  '$id_transaccion'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getInfoAlert7() {
        $sql = "    SELECT cliente.firstname AS nombre, cliente.document AS documento
                      FROM client AS cliente
                INNER JOIN param_tipopersona AS tipo_persona ON tipo_persona.id = cliente.persontype
                INNER JOIN form AS formulario ON formulario.id_client = cliente.id
                INNER JOIN data AS datos ON datos.id_form = formulario.id
                     WHERE tipo_persona.description = 'Natural'
                       AND (datos.totalactivos+datos.totalpasivos)>300000000";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getInfoAlert12() {
        $sql = "    SELECT cliente.firstname AS nombre, cliente.document AS documento
                      FROM client AS cliente
                INNER JOIN form AS formulario ON formulario.id_client = cliente.id
                INNER JOIN data_confirm AS datos ON datos.id_form = formulario.id
                     WHERE datos.id_contact = 3";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getInfoAlert14() {
        $sql = "    SELECT cliente.firstname AS nombre, cliente.document AS documento
                      FROM client AS cliente
                INNER JOIN form AS formulario ON formulario.id_client = cliente.id
                INNER JOIN data AS datos ON datos.id_form = formulario.id
                INNER JOIN data_confirm AS datos_con ON datos_con.id_form = formulario.id
                     WHERE datos_con.id IN (
                                            SELECT id AS id_data
                                              FROM (
                                                        SELECT G.id, G.id_client, G.date_created
                                                          FROM client C
                                                    INNER JOIN data_confirm G ON C.id = G.id_client
                                                         WHERE C.persontype = 2
                                                      ORDER BY G.date_created DESC) T1
                                          GROUP BY T1.id_client)
                      AND datos.actividadeconomicappal != datos_con.actividadeconomicappal";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getInfoAlert15() {
        $sql = "    SELECT cliente.firstname AS nombre, cliente.document AS documento
                      FROM client AS cliente
                INNER JOIN form AS formulario ON formulario.id_client = cliente.id
                INNER JOIN data AS datos ON datos.id_form = formulario.id
                INNER JOIN data_confirm AS datos_con ON datos_con.id_form = formulario.id
                     WHERE datos_con.id IN (
                                            SELECT id AS id_data
                                              FROM (
                                                        SELECT G.id, G.id_client, G.date_created
                                                          FROM client C
                                                    INNER JOIN data_confirm G ON C.id = G.id_client
                                                      ORDER BY G.date_created DESC) T1
                                          GROUP BY T1.id_client)
                      AND (
                               datos.documento != datos_con.documento
                            OR datos.telefonoresidencia != datos_con.telefonoresidencia
                            OR datos.nit != datos_con.nit)";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getInfoAlert16($idClient, $resultado, $ingresos) {
        /*
         * 10/04/2014 Sinthia Rodriguez
         */
        $sql = "select 
                    CONCAT_WS(' ', data.nombres, data.primerapellido, data.segundoapellido) as nombre, 
                    data.razonsocial,   
                    sum(param_ingresosmensuales.value) as ingresosmensuales,
                    sum(if(data.ingresosmensualesemp = 0,
                        0,
                        param_ingresosmensuales_emp.value)) as ingresosmensuales_emp,
                    client.persontype,
                    client.document,
                    data.tipoactividad,
                    data.actividadeconomicappal,
                    (select 
                            param_contact.description
                        from
                            param_contact
                        where
                            id = " . $resultado . ") as resultado,
                    sum(if(data.totalactivos = '',
                        0,
                        data.totalactivos) - if(data.totalpasivos = '',
                        0,
                        data.totalpasivos)) as patrimonio_natural,
                    sum(if(data.activosemp = '',
                        0,
                        data.activosemp) - if(data.pasivosemp = '',
                        0,
                        data.pasivosemp)) as patrimonio_juridico,
                    data.monedaextranjera,
                    (select 
                            param_ingresosmensuales.value
                        from
                            param_ingresosmensuales
                        where
                            param_ingresosmensuales.id = " . $ingresos . ") as ingresos_anteriores
                from
                     data
                        LEFT JOIN form ON data.id_form = form.id
                        LEFT JOIN client ON form.id_client = client.id
                        left join
                    param_ingresosmensuales ON data.ingresosmensuales = param_ingresosmensuales.id
                        left join
                    param_ingresosmensuales_emp ON if(data.ingresosmensualesemp = '',
                        7,
                        data.ingresosmensualesemp) = param_ingresosmensuales_emp.id
                where
                    client.id = '" . $idClient . "'";
//        return $sql;
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getinfoAlertDirecciones($id, $direcciones) {
        $condicion = " client.estado = 0 ";
        $comp = " and";
        if ($direcciones["direccion_empresa"] != "" && $direcciones["direccion_empresa"] != "SD") {
            $condicion .= $comp . " data.direccionempresa = '" . $direcciones["direccion_empresa"] . "'";
            $comp = " or";
        }
        if ($direcciones["direccion_oficina"] != "" && $direcciones["direccion_oficina"] != "SD") {
            $condicion .= $comp . " data.direccionoficinappal = '" . $direcciones["direccion_oficina"] . "'";
            $comp = " or";
        }
        if ($direcciones["direccion_residencia"] != "" && $direcciones["direccion_residencia"] != "SD") {
            $condicion .= $comp . " data.direccionresidencia = '" . $direcciones["direccion_residencia"] . "'";
            $comp = " or";
        }
        if ($direcciones["direccion_sucursal"] != "" && $direcciones["direccion_sucursal"] != "SD") {
            $condicion .= $comp . " data.direccionsucursal = '" . $direcciones["direccion_sucursal"] . "'";
            $comp = " or";
        }

        $sql = "select distinct 
                client.id,
                client.firstname,
                client.persontype,
                data.documento,
                data.direccionempresa,
                data.direccionoficinappal,
                data.direccionresidencia,
                data.direccionsucursal
            from
                client
                    inner join
                form ON client.id = form.id_client
                    inner join
                data ON form.id = data.id_form
            where " . $condicion;
        $comp = " and";
//        return $sql;

        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getinfoAlertTelefonos($id, $telefonos) {
        $condicion = " client.estado = 0 ";
        $comp = " and";
        if ($telefonos["telefono_oficina"] != "") {
            $condicion .= $comp . " data.telefonoficina = '" . $telefonos["telefono_oficina"] . "'";
            $comp = " or";
        }
        if ($telefonos["telefono_laboral"] != "") {
            $condicion .= $comp . " data.telefonolaboral = '" . $telefonos["telefono_laboral"] . "'";
            $comp = " or";
        }
        if ($telefonos["telefono_residencia"] != "") {
            $condicion .= $comp . " data.telefonoresidencia = '" . $telefonos["telefono_residencia"] . "'";
            $comp = " or";
        }
        if ($telefonos["telefono_sucursal"] != "") {
            $condicion .= $comp . " data.telefonosucursal = '" . $telefonos["telefono_sucursal"] . "'";
            $comp = " or";
        }

        $sql = "select distinct 
                client.id,
                client.firstname,
                client.persontype,
                data.documento,
                    data.telefonoficina,
                    data.telefonolaboral,
                    data.telefonoresidencia,
                    data.telefonosucursal
            from
                client
                    inner join
                form ON client.id = form.id_client
                    inner join
                data ON form.id = data.id_form
            where " . $condicion;
        $comp = " and";
//        return $sql;

        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getinfoAlert18($documento) {

        $sql = "select distinct
    client.id,
    client.document,
    data.nombres,
    data.primerapellido,
    data.segundoapellido,
    data.razonsocial
from
    client
        inner join
    form ON client.id = form.id_client
        inner join
    data ON form.id = data.id_form
where
    client.estado = 0
        and client.document = " . $documento;
//        return $sql;

        return mysqli_query($GLOBALS['link'], $sql);
    }

}

class EmailAlert {

    /**
     * Cambios en los tipos de actividad de los clientes en las actualizaciones
     * id_alert=14
     * Reporte de clientes que cuando se confirmen cambien algún tipo de información
     * id_alert=15
     * Cambios financieros en los clientes cuando en la actualización de la información supera entre cambio y cambio el 50% de ingresos del formulario anterior
     * Lista desplegable para validación por tipo de actividad  (filtro adicional)
     * Nota: Validar los clientes con el mismo número de identificación y con nombre diferente, este no debe ir en las alertas.
     * Clientes que vivan en ciudades zona roja. (Jackeline envira el listado de las ciudades.)
     *

     * @param type $id_form
     */
    public static function generateContactAlerts($id_form) {
        //  Clientes ilocalizados (call )
        $sql = <<<SQL
				SELECT cliente.firstname AS nombre, cliente.document AS documento
				FROM client AS cliente
					INNER JOIN form AS formulario ON formulario.id_client = cliente.id
					INNER JOIN data_confirm AS datos ON datos.id_form = formulario.id
				WHERE datos.id_contact IN(8,9,10)
SQL;

        // Clientes renuentes (call )
        $sql = <<<SQL
				SELECT cliente.firstname AS nombre, cliente.document AS documento
				FROM client AS cliente
				INNER JOIN form AS formulario ON formulario.id_client = cliente.id
				INNER JOIN data_confirm AS datos ON datos.id_form = formulario.id
				WHERE datos.id_contact = 3
SQL;
    }

    /**
     * Lista desplegable para validación por tipo de actividad  (filtro adicional)
     * Nota: Validar los clientes con el mismo número de identificación y con nombre diferente, este no debe ir en las alertas.
     * @param type $id_form
     */
    public static function generateFormAlerts($id_form) {
        $msgs = array();
        $query = <<<SQL
					SELECT d.documento, d.actividadeconomicappal, d.ingresosmensuales, d.totalactivos, d.totalpasivos,
						 d.direccionresidencia, d.direccionempresa, d.direccionoficinappal, d.direccionsucursal
					FROM data AS d
					WHERE d.id_form = $id_form
SQL;
        $result = mysqli_query($GLOBALS['link'], $query);
        $data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if (!empty($data)) {
            // Clientes con actividad Hogar que sus ingresos superen $1.000.000
            if ($data['actividadeconomicappal'] == 813 && in_array($data['ingresosmensuales'], array(3, 4, 5, 6, 7, 8, 9, 10, 11, 12))) {
                $msgs[] = "Actividad Hogar con ingresos que superan $1.000.000";
            }
            // Clientes con actividad Estudiante que sus ingresos superen $1.000.000
            if ($data['actividadeconomicappal'] == 809 && in_array($data['ingresosmensuales'], array(3, 4, 5, 6, 7, 8, 9, 10, 11, 12))) {
                $msgs[] = "Actividad Estudiante con ingresos que superan $1.000.000";
            }
            // Clientes naturales con Patrimonio superior a $300.000.000
            if ($data['persontype'] == 1 && $data['totalactivos'] + $data['totalpasivos'] > 300000000) {
                $msgs[] = "Persona Natural con Patrimonio superior a $300.000.000";
            }
            // Clientes con transacciones en el exterior
            if ($data['monedaextranjera'] == 'Si' && in_array($data['tipotransacciones'], array(7, 8, 'SD'))) {
                $msgs[] = "Cliente con transacciones en el exterior";
            }

            self::_chekAddressInfo($id_form, $data, $msgs);
            self::_checkPhoneInfo($id_form, $data, $msgs);

            // Clientes que vivan en ciudades zona roja. (Jackeline envira el listado de las ciudades.)



            if (!empty($msgs)) {
                self::sendAlertEmail($msgs, $data);
            }

            /*
              $data[id];//122879
              $data[id_form];//122938
              $data[fecharadicado];//2013-01-01
              $data[fechasolicitud];//2013-01-01
              $data[sucursal];//230
              $data[area];//14
              $data[lote];//LOTE_0103
              $data[formulario];//1
              $data[id_official];//FINLECOTEST
              $data[clasecliente];//1

              $data[tipodocumento];//1
              $data[documento];//808080
              $data[fechaexpedicion];//1929-01-01
              $data[lugarexpedicion];//35
              $data[fechanacimiento];//1915-01-01
              $data[lugarnacimiento];//35
              $data[sexo];//Femenino
              $data[nacionalidad];//2
              $data[numerohijos];//0
              $data[estadocivil];//1
              $data[direccionresidencia];//TEST
              $data[ciudadresidencia];//35
              $data[telefonoresidencia];//1234567
              $data[nombreempresa];//TEST
              $data[ciudadempresa];//35
              $data[direccionempresa];//TEST
              $data[nomenclatura];//Nomenclatura antigua
              $data[telefonolaboral];//1234567
              $data[celular];//1234567890
              $data[correoelectronico];//TEST@TEST.COM
              $data[cargo];//TEST
              $data[actividadeconomicaempresa];//1
              $data[profesion];//1
              $data[ocupacion];//1
              $data[detalleocupacion];//
              $data[ciiu];//5002
              $data[ingresosmensuales];//1
              $data[otrosingresos];//1
              $data[egresosmensuales];//1
              $data[conceptosotrosingresos];//TEST
              $data[tipoactividad];//1
              $data[detalletipoactividad];//
              $data[nivelestudios];//1
              $data[tipovivienda];//1
              $data[estrato];//1
              $data[totalactivos];//12345677
              $data[totalpasivos];//12344556
              $data[razonsocial];//
              $data[nit];//
              $data[digitochequeo];//0
              $data[ciudadoficina];//
              $data[direccionoficinappal];//
              $data[nomenclatura_emp];//
              $data[telefonoficina];//0
              $data[faxoficina];//0
              $data[celularoficina];//0
              $data[ciudadsucursal];//
              $data[direccionsucursal];//
              $data[nomenclatura_emp2];//
              $data[telefonosucursal];//0
              $data[faxsucursal];//0
              $data[actividadeconomicappal];//0
              $data[detalleactividadeconomicappal];//
              $data[tipoempresaemp];//0
              $data[activosemp];//
              $data[pasivosemp];//
              $data[ingresosmensualesemp];//
              $data[egresosmensualesemp];//

              ;//1
              $data[firma];//Si
              $data[huella];//Si
              $data[lugarentrevista];//TEST
              $data[fechaentrevista];//2013-01-01
              $data[horaentrevista];//7
              $data[tipohoraentrevista];//am
              $data[resultadoentrevista];//Aceptado
              $data[observacionesentrevista];//TEST
              $data[nombreintermediario];//TEST
              $data[socio1];//
              $data[socio2];//
              $data[socio3];//
             */
        }
    }

    function sendAlertEmail(&$msgs, &$data) {
        $mail = new PHPMailer();
        $body = "
		<style>
			body{font-family:Arial, Helvetica, sans-serif; font-size:13px;}
			.info, .success, .warning, .error, .validation {border: 1px solid;margin: 10px 0px;padding:15px 10px 15px 50px;}
			.info {color: #00529B;background-color: #BDE5F8;background-image: url('info.png');}
			.success {color: #4F8A10;background-color: #DFF2BF;}
			.warning {color: #9F6000;background-color: #FEEFB3;}
			.error {color: #D8000C;background-color: #FFBABA;}
		</style>
		<p>Se ha generado la siguiente alerta</p><br>
		<p>
			<b>Documento:</b> {$data['documento']}<br/>
		</p>";
        foreach ($msgs as $msg) {
            $body .= '<p class="warning">' . $msg . '</p>';
        }

        $mail->IsSendmail();
        $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
        $mail->Subject = "Alerta en Doc Finder.";
        $mail->MsgHTML($body);
        if (isset($oficial['email'])) {
            $address = $oficial['email'];
            $mail->AddAddress($address, $oficial['name']);
        }
        $mail->AddCC("neurobug@gmail.com", "Juan Carlos Cruz");
        //$mail->AddAddress("jackeline.gutierrez@ui.colpatria.com", "Jackeline Gutierrez");
        //$mail->AddCC("operacioncolpatria@finlecobpo.com", "Operacion Colpatria Doc Finder");
        if (!$mail->Send()) {
            return "Mailer Error: " . $mail->ErrorInfo;
        } else {
            return "Se ha enviado un correo con alertas";
        }
    }

    // Clientes con diferente No. de identificación e igual dirección (reporte adicional)
    private function _chekAddressInfo($id_form, &$data, &$msgs) {
        $query = <<<SQL
SELECT
	d1.documento, d1.direccionresidencia, d1.direccionempresa, d1.direccionoficinappal, d1.direccionsucursal,
	d2.documento AS documento2, d2.direccionresidencia AS direccionresidencia2, d2.direccionempresa AS direccionempresa2, d2.direccionoficinappal AS direccionoficinappal2, d2.direccionsucursal AS direccionsucursal2
FROM data AS d1 JOIN data AS d2 ON(d1.documento = {$data['documento']} AND d1.documento != d2.documento)
WHERE (d1.direccionresidencia IS NOT NULL AND d1.direccionresidencia != '' AND d1.direccionresidencia = d2.direccionresidencia))
	OR	(d1.direccionempresa IS NOT NULL AND d1.direccionempresa != '' AND d1.direccionempresa IN (d2.direccionresidencia, d2.direccionempresa, d2.direccionoficinappal, d2.direccionsucursal))
	OR (d1.direccionoficinappal IS NOT NULL AND d1.direccionoficinappal != '' AND d1.direccionoficinappal IN (d2.direccionresidencia, d2.direccionempresa, d2.direccionoficinappal, d2.direccionsucursal))
	OR (d1.direccionsucursal IS NOT NULL AND d1.direccionsucursal != '' AND d1.direccionsucursal IN (d2.direccionresidencia, d2.direccionempresa, d2.direccionoficinappal, d2.direccionsucursal))
SQL;
        $result = mysqli_query($GLOBALS['link'], $query);
        $data2 = mysqli_fetch_assoc($result);
        if (!empty($data2)) {
            $msg = '';
            while ($row = mysqli_fetch_assoc($result)) {
                if ($msg == '') {
                    $msg = <<<TABLE
						<tr>
							<th>Documento</th>
							<th>Direccion Residencia</th>
							<th>Direccion Empresa</th>
							<th>Direccion Oficinappal</th>
							<th>Direccion Sucursal</th>
						<tr>
						<tr>
							<td>{$row['documento']}</th>
							<td>{$row['direccionresidencia']}</th>
							<td>{$row['direccionempresa']}</th>
							<td>{$row['direccionoficinappal']}</th>
							<td>{$row['direccionsucursal']}</th>
						<tr>
TABLE;
                }
                $msg .=<<<TABLE
						<tr>
							<td>{$row['documento2']}</th>
							<td>{$row['direccionresidencia2']}</th>
							<td>{$row['direccionempresa2']}</th>
							<td>{$row['direccionoficinappal2']}</th>
							<td>{$row['direccionsucursal2']}</th>
						<tr>
TABLE;
            }
            $msgs[] = "Tiene coincidencias en la informaci&oacute;n de direcci&oacute;n con los siguientes clientes:<br>$msg";
        }
        mysqli_free_result($result);
    }

    // Clientes con diferente No. de identificación e igual No. de teléfono (reporte adicional)
    public function _checkPhoneInfo($id_form, &$data, &$msgs) {

        $query = <<<SQL
SELECT
	d1.documento, d1.telefonoresidencia, d1.telefonolaboral, d1.telefonoficina, d1.telefonosucursal, d1.celular,
	d2.documento AS documento2, d2.telefonoresidencia AS telefonoresidencia2, d2.telefonolaboral AS 2, d2.telefonoficina AS telefonoficina2, d2.telefonosucursal AS telefonosucursal2, d2.celular AS celular2
FROM data AS d1 JOIN data AS d2 ON(d1.documento = {$data['documento']} AND d1.documento != d2.documento)
WHERE (d1.telefonoresidencia IS NOT NULL AND d1.telefonoresidencia != 0 AND d1.telefonoresidencia IN (d2.telefonoresidencia, d2.telefonolaboral, d2.telefonoficina, d2.telefonosucursal, d2.celular))
	OR	(d1.telefonolaboral IS NOT NULL AND d1.telefonolaboral != 0 AND d1.telefonolaboral IN (d2.telefonoresidencia, d2.telefonolaboral, d2.telefonoficina, d2.telefonosucursal, d2.celular))
	OR (d1.telefonoficina IS NOT NULL AND d1.telefonoficina != 0 AND d1.telefonoficina IN (d2.telefonoresidencia, d2.telefonolaboral, d2.telefonoficina, d2.telefonosucursal, d2.celular))
	OR (d1.telefonosucursal IS NOT NULL AND d1.telefonosucursal != 0 AND d1.telefonosucursal IN (d2.telefonoresidencia, d2.telefonolaboral, d2.telefonoficina, d2.telefonosucursal, d2.celular))
	OR (d1.celular IS NOT NULL AND d1.celular != 0 AND d1.celular IN (d2.telefonoresidencia, d2.telefonolaboral, d2.telefonoficina, d2.telefonosucursal, d2.celular))
SQL;
        $result = mysqli_query($GLOBALS['link'], $query);
        $data2 = mysqli_fetch_assoc($result);
        if (!empty($data2)) {
            $msg = '';
            while ($row = mysqli_fetch_assoc($result)) {
                if ($msg == '') {
                    $msg = <<<TABLE
								<tr>
									<th>Documento</th>
									<th>Telefono Residencia</th>
									<th>Telefono Laboral</th>
									<th>Telefono Oficinappal</th>
									<th>Telefono Sucursal</th>
									<th>Celular</th>
								<tr>
								<tr>
									<td>{$row['documento']}</th>
									<td>{$row['telefonoresidencia']}</th>
									<td>{$row['telefonolaboral']}</th>
									<td>{$row['telefonoficina']}</th>
									<td>{$row['telefonosucursal']}</th>
									<td>{$row['celular']}</th>
								<tr>
TABLE;
                }
                $msg .=<<<TABLE
								<tr>
									<td>{$row['documento2']}</th>
									<td>{$row['telefonoresidencia2']}</th>
									<td>{$row['telefonolaboral2']}</th>
									<td>{$row['telefonoficina2']}</th>
									<td>{$row['telefonosucursal2']}</th>
									<td>{$row['celular2']}</th>
								<tr>
TABLE;
            }
            $msgs[] = "Tiene coincidencias en la informaci&oacute;n de direcci&oacute;n con los siguientes clientes:<br>$msg";
        }
        mysqli_free_result($result);
    }

    public function generateAlert($idClient, $resultado, $ingresos_nuevos, $cambioActividad) {
        /*
         * 10/04/2014 Sinthia Rodriguez
         * es llamada desde:
         * procesos/callprocess/savecontac.php
         * procesos/internal/saveImage.php
         */
        $u = new Alert();
        $count = 1;
        $resultadosql = $u->getInfoAlert16($idClient, $resultado, $ingresos_nuevos);
        while ($result = mysqli_fetch_array($resultadosql)) {
            $nombres = $result["nombre"];
            $documento = $result["document"];
            $razonsocial = $result["razonsocial"];
            $ingresosmensuales = $result["ingresosmensuales"];
            $ingresosmensuales_iniciales = $result["ingresos_anteriores"];
            $ingresosmensuales_emp = $result["ingresosmensuales_emp"];
            $persontype = $result["persontype"];
            $tipoactividad = $result["tipoactividad"];
            $actividadeconomicappal = $result["actividadeconomicappal"];
            $resultado = $result["resultado"];
            $patrimonio_natural = $result["patrimonio_natural"];
            $patrimonio_juridico = $result["patrimonio_juridico"];
            $monedaextranjera = $result["monedaextranjera"];
            $count++;
        }
        $mensaje = "";
//        $mensaje .= "-" . $nombres . "-" . $ingresosmensuales . "-". $ingresosmensuales_iniciales;
//        $mensaje .= $u->getInfoAlert16($idClient, $resultado, $ingresos_nuevos);
        
        if ($persontype == 1) {//natural
            $mensaje .= "El cliente " . $nombres . " con documento de identidad " . $documento;

            if ($resultado == "ILOCALIZADO" || $resultado == "RENUENTE") {
                $mensaje .= " se encuentra " . $resultado . ".";
            } else {
                if ($tipoactividad == "10") {//hogar
                    if ($ingresosmensuales > 1000000) {

                        $mensaje .= " con actividad hogar tiene ingresos superiores a 1'000,000. \r\n";
                        $mensaje .= "<br>";
                        $mensaje .= " Ingresos actuales: " . number_format($ingresosmensuales) . ".";
                    }
                } elseif ($tipoactividad == "5") {//estudiante
                    if ($ingresosmensuales > 1000000) {

                        $mensaje .= " con actividad estudiante tiene ingresos superiores a 1'000,000. \r\n";
                        $mensaje .= "<br>";
                        $mensaje .= " Ingresos actuales: " . number_format($ingresosmensuales) . ".";
                    }
                }
                if ($patrimonio_natural > 300000000) {
                    $mensaje .= "<br>";
                    $mensaje .= "\r\n El cliente tiene un patrimonio que supera los 300'000,000.";
                    $mensaje .= "<br>";
                    $mensaje .= "\r\n El patrimonio actual es de " . number_format($patrimonio_natural) . ".";
                }
                if ($ingresosmensuales_iniciales > ($ingresosmensuales / 2)) {
                    $mensaje .= "<br>";
                    $mensaje .= "\r\n Los ingresos del cliente superan el 50% al formulario anterior.";
                }
            }
        } elseif ($persontype == 2) {//juridico
            $mensaje .= "El cliente " . $razonsocial . " con documento de identidad " . $documento;
            if ($resultado == "ILOCALIZADO" || $resultado == "RENUENTE") {
                $mensaje .= " se encuentra " . $resultado . ".";
            } else {
                if ($actividadeconomicappal == "813") { //hogar
                    $mensaje .= " con actividad hogar tiene ingresos superiores a 1'000,000. \r\n";
                    $mensaje .= "<br>";
                    $mensaje .= " Ingresos actuales: " . number_format($ingresosmensuales_emp) . ".";
                } elseif ($actividadeconomicappal == "809") {//estudiante
                    $mensaje .= " con actividad hogar tiene ingresos superiores a 1'000,000. \r\n";
                    $mensaje .= "<br>";
                    $mensaje .= " Ingresos actuales: " . number_format($ingresosmensuales_emp) . ".";
                }
                if ($patrimonio_juridico > 300000000) {
                    $mensaje .= "<br>";
                    $mensaje .= "\r\n El cliente tiene un patrimonio que supera los 300'000,000.";
                    $mensaje .= "<br>";
                    $mensaje .= "\r\n El patrimonio actual es de " . number_format($patrimonio_juridico) . ".";
                }
                if ($ingresosmensuales_iniciales > ($ingresosmensuales_emp / 2)) {
                    $mensaje .= "<br>";
                    $mensaje .= "\r\n Los ingresos del cliente superan el 50% al formulario anterior.";
                }
            }
        }
        if ($monedaextranjera == "Si") {
            $mensaje .= "<br>";
            $mensaje .= "\r\n El cliente cuenta con transacciones en el exterior.";
        }
        if ($cambioActividad != "") {
            if ($cambioActividad["cambioact"] == true) {
                $mensaje .= "<br>";
                $mensaje .= " El cliente Cambio de actividad. <br>";
            }
        }
        
//        $mensaje = wordwrap($mensaje, 70, "\r\n");
        if ($count > 0) {
            $mail = new PHPMailer();
            $mail->IsSendmail();
            $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
            $mail->Subject = "Alertas Doc. Finder";
            $mail->MsgHTML($mensaje);
            $mail->AddAddress("palertas.finleco@gmail.com", "prueba alertas");
//        $mail->AddAddress("jackeline.gutierrez@axacolpatria.co", "Jackeline Gutierrez Bohorquez");
//        $mail->AddAddress("laura.riveros@finlecobpo.com", "Laura Riveros");
            if (!$mail->Send()) {
                return "Mailer Error: " . $mail->ErrorInfo;
            } else {
                return true;
            }
        }
    }

    public function alertDirecciones($datos, $direcciones) {

        $mensaje = "";
        $cantidad = 0;
        $u = new Alert();

        if (($direcciones["direccion_sucursal"] != "" && $direcciones["direccion_sucursal"] != "SD") || ($direcciones["direccion_residencia"] != "" && $direcciones["direccion_residencia"] != "SD") || ($direcciones["direccion_oficina"] != "" && $direcciones["direccion_oficina"] != "SD") || ($direcciones["direccion_empresa"] != "" && $direcciones["direccion_empresa"] != "SD")) {
            $clientes = $u->getinfoAlertDirecciones($datos['id'], $direcciones);
            while ($result = mysqli_fetch_array($clientes)) {
                if ($result["id"] != $datos["id"]) {
                    if (($result["direccionsucursal"] != "" && $result["direccionsucursal"] != "SD") || ($result["direccionresidencia"] != "" && $result["direccionresidencia"] != "SD") || ($result["direccionoficinappal"] != "" && $result["direccionoficinappal"] != "SD") || ($result["direccionempresa"] != "" && $result["direccionempresa"] != "SD")) {
                        $mensaje .= " <p> ";
                        $mensaje .="Cliente: " . $result["documento"];
                        $mensaje .="<br> Nombre: " . $result["firstname"];
                        if ($result["persontype"] == "1") {
                            $mensaje .=" <br> Tipo de cliente: Natural";
                        } else {
                            $mensaje .=" <br> Tipo de cliente: Juridico";
                        }
                        if ($result["direccionempresa"] != "" && $result["direccionempresa"] != "SD" && $result["direccionempresa"] == $direcciones["direccion_empresa"]) {
                            $mensaje .=" <br> Direccion empresa: " . $result["direccionempresa"];
                        }
                        if ($result["direccionoficinappal"] != "" && $result["direccionoficinappal"] != "SD" && $result["direccionoficinappal"] == $direcciones["direccion_oficina"]) {
                            $mensaje .=" <br> Direccion oficina: " . $result["direccionoficinappal"];
                        }
                        if ($result["direccionresidencia"] != "" && $result["direccionresidencia"] != "SD" && $result["direccionresidencia"] == $direcciones["direccion_residencia"]) {
                            $mensaje .=" <br> Direccion residencia: " . $result["direccionresidencia"];
                        }
                        if ($result["direccionsucursal"] != "" && $result["direccionsucursal"] != "SD" && $result["direccionsucursal"] == $direcciones["direccion_sucursal"]) {
                            $mensaje .=" <br> Direccion sucursal: " . $result["direccionsucursal"];
                        }
                        $mensaje .= " </p> ";
                        $cantidad++;
                    }
                }
            }
        }

        if ($mensaje != "") {

            $mensaje1 = " <p> ";
            $mensaje1 .= "Se encontraron " . $cantidad . " coincidencias con el cliente " . $datos['documento'] . ". Datos del cliente: ";
            if ($direcciones["direccion_empresa"] != "" && $direcciones["direccion_empresa"] != "SD") {
                $mensaje1 .= " <br> Direccion empresa: " . $direcciones["direccion_empresa"];
            }
            if ($direcciones["direccion_oficina"] != "" && $direcciones["direccion_oficina"] != "SD") {
                $mensaje1 .= " <br> Direccion oficina: " . $direcciones["direccion_oficina"];
            }
            if ($direcciones["direccion_residencia"] != "" && $direcciones["direccion_residencia"] != "SD") {
                $mensaje1 .= " <br> Direccion residencia: " . $direcciones["direccion_residencia"];
            }
            if ($direcciones["direccion_sucursal"] != "" && $direcciones["direccion_sucursal"] != "SD") {
                $mensaje1 .= " <br> Direccion sucursal: " . $direcciones["direccion_sucursal"];
            }

            $mensaje1 .= " </p> ";

            $mail = new PHPMailer();
            $mail->IsSendmail();
            $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
            $mail->Subject = "Alertas Doc. Finder Direcciones";
            $mail->MsgHTML($mensaje1 . $mensaje);
            $mail->AddAddress("palertas.finleco@gmail.com", "prueba alertas");
//            $mail->AddAddress("jackeline.gutierrez@axacolpatria.co", "Jackeline Gutierrez Bohorquez");
//            $mail->AddAddress("laura.riveros@finlecobpo.com", "Laura Riveros");
            if (!$mail->Send()) {
                return "Mailer Error: " . $mail->ErrorInfo;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function alertTelefonos($datos, $telefonos) {

        $mensaje = "";
        $cantidad = 0;
        $u = new Alert();

        if (($telefonos["telefono_sucursal"] != "" && $telefonos["telefono_sucursal"] != "0") || ($telefonos["telefono_laboral"] != "" && $telefonos["telefono_laboral"] != "0") || ($telefonos["telefono_residencia"] != "" && $telefonos["telefono_residencia"] != "0") || ($telefonos["telefono_oficina"] != "" && $telefonos["telefono_oficina"] != "0")) {
            $clientes = $u->getinfoAlertTelefonos($datos['id'], $telefonos);
            while ($result = mysqli_fetch_array($clientes)) {
                if ($result["id"] != $datos["id"]) {
                    if (($result["telefonosucursal"] != "0" && $result["telefonosucursal"] != "SD") || ($result["telefonoresidencia"] != "0" && $result["telefonoresidencia"] != "SD") || ($result["telefonolaboral"] != "0" && $result["telefonolaboral"] != "SD") || ($result["telefonoficina"] != "0" && $result["telefonoficina"] != "SD")) {
                        $mensaje .= " <p> ";
                        $mensaje .="Cliente: " . $result["documento"];
                        $mensaje .="<br> Nombre: " . $result["firstname"];
                        if ($result["persontype"] == "1") {
                            $mensaje .=" <br> Tipo de cliente: Natural";
                        } else {
                            $mensaje .=" <br> Tipo de cliente: Natural";
                        }
                        if ($result["telefonoficina"] != "0" && $result["telefonoficina"] != "SD" && $result["telefonoficina"] == $telefonos["telefono_oficina"]) {
                            $mensaje .=" <br> Telefono oficina: " . $result["telefonoficina"];
                        }
                        if ($result["telefonolaboral"] != "0" && $result["telefonolaboral"] != "SD" && $result["telefonolaboral"] == $telefonos["telefono_laboral"]) {
                            $mensaje .=" <br> Telefono laboral: " . $result["telefonolaboral"];
                        }
                        if ($result["telefonoresidencia"] != "0" && $result["telefonoresidencia"] != "SD" && $result["telefonoresidencia"] == $telefonos["telefono_residencia"]) {
                            $mensaje .=" <br> Telefono residencia: " . $result["telefonoresidencia"];
                        }
                        if ($result["telefonosucursal"] != "0" && $result["telefonosucursal"] != "SD" && $result["telefonosucursal"] == $telefonos["telefono_sucursal"]) {
                            $mensaje .=" <br> Telefono sucursal: " . $result["telefonosucursal"];
                        }
                        $mensaje .= " </p> ";
                        $cantidad++;
                    }
                }
            }
        }

        if ($mensaje != "") {
            $mensaje1 = " <p> ";
            $mensaje1 .= "Se encontraron " . $cantidad . " coincidencias con el cliente " . $datos['documento'] . ". Datos del cliente: ";
            if ($telefonos["telefono_oficina"] != "" && $telefonos["telefono_oficina"] != "0") {
                $mensaje1 .= " <br> Telefono oficina: " . $telefonos["telefono_oficina"];
            }
            if ($telefonos["telefono_residencia"] != "" && $telefonos["telefono_residencia"] != "0") {
                $mensaje1 .= " <br> Telefono residencia: " . $telefonos["telefono_residencia"];
            }
            if ($telefonos["telefono_laboral"] != "" && $telefonos["telefono_laboral"] != "0") {
                $mensaje1 .= " <br> Telefono laboral: " . $telefonos["telefono_laboral"];
            }
            if ($telefonos["telefono_sucursal"] != "" && $telefonos["telefono_sucursal"] != "0") {
                $mensaje1 .= " <br> Telefono sucursal: " . $telefonos["telefono_sucursal"];
            }
            $mensaje1 .= " </p> ";
            $mail = new PHPMailer();
            $mail->IsSendmail();
            $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
            $mail->Subject = "Alertas Doc. Finder Telefonos";
            $mail->MsgHTML($mensaje1 . $mensaje);
            $mail->AddAddress("palertas.finleco@gmail.com", "prueba alertas");
//            $mail->AddAddress("jackeline.gutierrez@axacolpatria.co", "Jackeline Gutierrez Bohorquez");
//            $mail->AddAddress("laura.riveros@finlecobpo.com", "Laura Riveros");
            if (!$mail->Send()) {
                return "Mailer Error: " . $mail->ErrorInfo;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function alertNombres($nombre, $observacion = NULL) {

        $mensaje = "";
        $cantidad = 0;
        $u = new Alert();
        $clientes = $u->getinfoAlert18($nombre["documento"]);
        while ($result = mysqli_fetch_array($clientes)) {
            if ($result["razonsocial"] == "") {
                if ($result["nombres"] != $nombre["nombre"] || $result["primerapellido"] != $nombre["papellido"] || $result["segundoapellido"] != $nombre["sapellido"]) {
                    $mensaje .= "<p>";
                    $mensaje .= " <br> Documento: " . $result["document"];
                    $mensaje .= " <br> Nombres: " . $result["nombres"];
                    $mensaje .= " <br> Primer apellido: " . $result["primerapellido"];
                    $mensaje .= " <br> Segundo apellido: " . $result["segundoapellido"];
                    $mensaje .= "</p>";
                    $cantidad++;
                }
            } else {
                if ($result["razonsocial"] != $nombre["razonsocial"]) {
                    $mensaje .= "<p>";
                    $mensaje .= " <br> Documento: " . $result["document"];
                    $mensaje .= " <br> Razon social: " . $result["razonsocial"];
                    $mensaje .= "</p>";
                    $cantidad++;
                }
            }
        }
//        return $clientes;

        if ($mensaje != "") {
            $mensaje1 = $observacion . " <p> ";
            $mensaje1 .= "Se encontraron " . $cantidad . " coincidencias con el cliente " . $nombre["documento"] . ". Datos del cliente: ";
            if ($nombre["razonsocial"] == "") {
                $mensaje1 .= " <br> Nombres: " . $nombre["nombre"];
                $mensaje1 .= " <br> Primer apellido: " . $nombre["papellido"];
                $mensaje1 .= " <br> Segundo apellido: " . $nombre["sapellido"];
            } else {
                $mensaje1 .= " <br> Razon social: " . $nombre["razonsocial"];
            }
            $mensaje1 .= " </p> ";
            $mail = new PHPMailer();
            $mail->IsSendmail();
            $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
            $mail->Subject = "Alertas Doc. Finder Nombres";
            $mail->MsgHTML($mensaje1 . $mensaje);
            $mail->AddAddress("palertas.finleco@gmail.com", "prueba alertas");
//            $mail->AddAddress("jackeline.gutierrez@axacolpatria.co", "Jackeline Gutierrez Bohorquez");
//            $mail->AddAddress("laura.riveros@finlecobpo.com", "Laura Riveros");
            if (!$mail->Send()) {
                return "Mailer Error: " . $mail->ErrorInfo;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

}
