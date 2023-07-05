<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';
require_once PATH_CLASS.DS.'_conexion.php';
require_once PATH_CCLASS . DS . 'official.class.php';
//require_once '../../lib/class/client.class.php';
//clientes();
//clientes2();
//usuarios();
//clientsIlocalizadosNaturales();
//clientesSinGestiones();
//UpdateANDGetClientsCapi();
//insertGestionNoContacto();
//UpdateFechasGestiones();
//EliminarGestionesPorFechas();
//updateClientidMigraImagenes();
//updateClientidWorkFlow();
//subirclientesMigracionConImagenes();
//updateOficiales();
//udateClientesMigracio();
//UpdateANDGetClientsCapiJuridico();
//formatTiffChangue();
//UpdateANDGetClientsCapi();
//usuariosYOficiales();
//cargueMasivoDevoluciones();
//updateWorkflowPersontype();
//updateGestionesFormFecha();
//updateGestionesFormPlanilla();
//insertGestionNoContactoSeguros();
//updateFechasMigracion();
//updateIngresosEgresosMigracion();
//updateIngresosEgresosForms();
//updateProfesionOcupacion();
//updateNacionalidad();
//updateActividadEconomica();
//updateCamposConCampo();
//updateEstadoWorkflow();
//updateCamposFechaForm();
//updateGestionesFormFecha_doc();
//EliminarGestionesExtraCAPI();
//getClientesEnMigracionSinDigitar();
//getClientesSinDigitar();
//repararRadicacionFecha_RadicacionFisicos();
//repararRadicacionFecha_Aprobacion();
//sacarDatosPorvenir();
//updateClientesCapiNo();
//updateIDFORMCONFIRMFORM();
//updateSGVCliente();
//prueba();
//activarClientesMigracion();
//desactivarClientesSinDatosNiGes();
//imagenesExistente();
//subirImagenesPerdidas();
//deleteConfirmaciones();
//imagesEncontradas();
//clientesSinImagenes();
//clientesSinImagenes();
//imagesFaltantesSinNombreOriginal();
//findLostFileByFile();
//subirMigraImagenes();
//updateFechaAprobacionRadicado();
//exportUsuariosColpatria();
//subirRestanteImagenes();
//subirRestanteImagenes_2();
//buscarImagenesFaltantes();
//updateClientesNoSeguros();
function clientsIlocalizadosNaturales() {
    $conexion = new Conexion();
    $objetos = array();
    $SQL = "SELECT t6.description, t2.description, t0.document, t1.primerapellido, t1.segundoapellido, t1.nombres, t1.fechaexpedicion, 
				t5.description, t1.numerohijos, t3.description, t1.direccionresidencia, t4.description, 
				t1.telefonoresidencia, t1.celular, t1.correoelectronico, t7.description, t8.description, 
				t1.observacion, t1.id_client, t1.id_form 
			FROM data_confirm AS t1
			INNER JOIN client AS t0 ON(t1.id_client = t0.id)
			INNER JOIN param_tipopersona AS t2 ON(t1.persontype = t2.id)
			INNER JOIN param_estadocivil AS t3 ON(t1.estadocivil = t3.id)
			INNER JOIN param_ciudad AS t4 ON(t1.ciudadresidencia = t4.id)
			INNER JOIN param_ciudad AS t5 ON(t1.lugarexpedicion = t5.id)
			INNER JOIN param_contact AS t6 ON(t1.id_contact = t6.id)
			INNER JOIN param_ingresosmensuales AS t7 ON(t1.ingresosmensuales = t7.id)
			INNER JOIN param_egresosmensuales AS t8 ON(t1.egresosmensuales = t8.id)
			WHERE t1.id_contact BETWEEN '8' AND '10'
			AND t1.persontype = 1
			ORDER BY t1.id_client";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        while ($consulta = $conexion->sacarRegistro()) {
            $conexion1 = new Conexion();
            $id_client = $consulta[18];
            $SQL1 = "SELECT id 
					FROM data_confirm
					WHERE id_client = $id_client
					AND id_contact BETWEEN '1' AND '7'";
            $conexion1->consultar($SQL1);
            if ($conexion1->getNumeroRegistros() == 0) {
                $objetos[] = $consulta;
            }
        }
    }
    $col_campos = array('TIPO CONTACTO',
        'TIPO DE PERSONA',
        'DOCUMENTO',
        'PRIMER APELLIDO',
        'SEGUNDO APELLIDO',
        'NOMBRES',
        'FECHA EXPEDICION',
        'LUGAR DE EXPEDICION',
        'NUMERO DE HIJOS',
        'ESTADO CIVIL',
        'DIRECCION DE RESIDENCIA',
        'CIUDAD DE RESIDENCIA',
        'TELEFONO DE RESIDENCIA',
        'TELEFONO CELULAR',
        'CORREO ELECTRONICO',
        'INGRESOS MENSUALES',
        'EGRESOS MENSUALES',
        'OBSERVACION'
    );
    $col_name = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q');

    $array = array();
    $array[] = array(0 => $objetos, 1 => $col_campos, 2 => $col_name, 3 => 'Reporte Clientes Naturales', 4 => 'Reporte_clientescongestionesIlocalizados');
    //echo json_encode($array);
    $objetos1 = array();
    $SQL = "SELECT t6.description, t2.description, t1.nit, t1.razonsocial, t1.digitochequeo, 
				t1.direccionoficinappal, t4.description, t1.telefonooficina, t3.description, 
				t1.activosemp, t1.pasivosemp, t5.description, t7.description, 
				t1.observacion, t1.id_client, t1.id_form 
			FROM data_confirm AS t1
			#INNER JOIN client AS t0 ON(t1.id_client = t0.id)
			INNER JOIN param_tipopersona AS t2 ON(t1.persontype = t2.id)
			INNER JOIN param_actividad AS t3 ON(t1.actividadeconomicappal = t3.id)
			INNER JOIN param_ciudad AS t4 ON(t1.ciudadoficina = t4.id)
			INNER JOIN param_ingresosmensuales_emp AS t5 ON(t1.ingresosmensualesemp = t5.id)
			INNER JOIN param_contact AS t6 ON(t1.id_contact = t6.id)
			INNER JOIN param_egresosmensuales_emp AS t7 ON(t1.egresosmensualesemp = t7.id)
			WHERE t1.id_contact BETWEEN '8' AND '10'
			AND t1.persontype = 2
			ORDER BY t1.id_client";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        while ($consulta = $conexion->sacarRegistro()) {
            $conexion1 = new Conexion();
            $id_client = $consulta[14];
            $SQL1 = "SELECT id 
					FROM data_confirm
					WHERE id_client = $id_client
					AND id_contact BETWEEN '1' AND '7'";
            $conexion1->consultar($SQL1);
            if ($conexion1->getNumeroRegistros() == 0) {
                $objetos1[] = $consulta;
            }
        }
    }
    $col_campos1 = array('TIPO CONTACTO',
        'TIPO DE PERSONA',
        'NIT',
        'RAZON SOCIAL',
        'DIGITO DE CHEQUEO',
        'DIRECCION DE OFICINA',
        'CIUDAD DE OFICINA',
        'TELEFONO DE OFICINA',
        'ACTIVIDAD',
        'ACTIVOS',
        'PASIVOS',
        'INGRESOS MENSUALES',
        'EGRESOS MENSUALES',
        'OBSERVACION'
    );
    $col_name1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N');

    $array[] = array(0 => $objetos1, 1 => $col_campos1, 2 => $col_name1, 3 => 'Reporte Clientes Juridicos', 4 => 'Reporte_clientescongestionesIlocalizados');

    crearXls($array);
}

function clientesSinGestiones() {
    $conexion = new Conexion();
    $objetos = array();
    $SQL = "SELECT t2.description, t3.description, t0.document, t1.fechaexpedicion, t1.lugarexpedicion, t1.fechanacimiento, 
				t1.lugarnacimiento, t5.description, t1.primerapellido, t1.segundoapellido, t1.nombres, 
				t1.direccionresidencia, t1.ciudadresidencia, t1.telefonoresidencia, t1.celular, t1.correoelectronico, 
				t1.nombreempresa, t1.ciudadempresa, t1.direccionempresa, t1.telefonolaboral, t1.id_form, t.id_client
			FROM data AS t1
			INNER JOIN form AS t ON(t1.id_form = t.id)
			INNER JOIN client AS t0 ON(t.id_client = t0.id)
			INNER JOIN param_clasecliente AS t2 ON(t1.clasecliente = t2.id)
			INNER JOIN param_tipodocumento AS t3 ON(t1.tipodocumento = t3.id)
			INNER JOIN param_pais AS t5 ON(t1.nacionalidad = t5.id)
			WHERE t0.persontype = 1 AND t.status = 1";

    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        while ($consulta = $conexion->sacarRegistro()) {
            $conexion1 = new Conexion();
            $id_client = $consulta[21];
            $SQL1 = "SELECT id 
					FROM data_confirm
					WHERE id_client = $id_client";
            $conexion1->consultar($SQL1);
            if ($conexion1->getNumeroRegistros() == 0) {
                $SQL2 = "SELECT id 
						FROM data_capi_confirm
						WHERE id_client = $id_client";
                $conexion1->consultar($SQL2);
                if ($conexion1->getNumeroRegistros() == 0) {
                    $consulta[4] = getCiudad($consulta[4]);
                    $consulta[6] = getCiudad($consulta[6]);
                    $consulta[12] = getCiudad($consulta[12]);
                    $consulta[17] = getCiudad($consulta[17]);
                    $objetos[] = $consulta;
                }
            }
        }
    }
    $col_campos = array('TIPO CONTACTO',
        'TIPO DE DOCUMENTO',
        'DOCUMENTO',
        'FECHA DE EXPEDICION',
        'LUGAR DE EXPEDICION',
        'FECHA DE NACIMIENTO',
        'CIUDAD',
        'PAIS',
        'PRIMER APELLIDO',
        'SEGUNDO APELLIDO',
        'NOMBRES',
        'DIRECCION DE RESIDENCIA',
        'CIUDAD DE RESIDENCIA',
        'TELEFONO RESIDENCIA',
        'CELULAR',
        'CORREO ELECTRONICO',
        'NOMBRE DE LA EMPRESA',
        'CIUDAD EMPRESA',
        'DIRECCION EMPRESA',
        'TELEFONO LABORAL'
    );
    $col_name = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T');

    $array = array();
    $array[] = array(0 => $objetos, 1 => $col_campos, 2 => $col_name, 3 => 'Reporte Clientes Naturales', 4 => 'Reporte_clientescongestionesSinGestion');
    //echo json_encode($array);
    $objetos1 = array();
    $SQL = "SELECT t2.description, t3.description, t0.document, t1.fechaexpedicion, t1.lugarexpedicion, 
				t1.primerapellido, t1.segundoapellido, t1.nombres, t1.razonsocial, t1.nit, t1.digitochequeo, 
				t1.ciudadoficina, t1.direccionoficinappal, t1.nomenclatura_emp, t1.telefonoficina, t1.faxoficina, 
				t1.id_form, t.id_client
			FROM data AS t1
			INNER JOIN form AS t ON(t1.id_form = t.id)
			INNER JOIN client AS t0 ON(t.id_client = t0.id)
			INNER JOIN param_clasecliente AS t2 ON(t1.clasecliente = t2.id)
			INNER JOIN param_tipodocumento AS t3 ON(t1.tipodocumento = t3.id)
			WHERE t0.persontype = 2 AND t.status = 1";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        while ($consulta = $conexion->sacarRegistro()) {
            $conexion1 = new Conexion();
            $id_client = $consulta[17];
            $SQL1 = "SELECT id 
					FROM data_confirm
					WHERE id_client = $id_client";
            $conexion1->consultar($SQL1);
            if ($conexion1->getNumeroRegistros() == 0) {
                $SQL2 = "SELECT id 
						FROM data_capi_confirm
						WHERE id_client = $id_client";
                $conexion1->consultar($SQL2);
                if ($conexion1->getNumeroRegistros() == 0) {
                    $consulta[4] = getCiudad($consulta[4]);
                    $consulta[11] = getCiudad($consulta[11]);
                    $objetos1[] = $consulta;
                }
            }
        }
    }
    $col_campos1 = array('TIPO CONTACTO',
        'TIPO DE DOCUMENTO',
        'DOCUMENTO',
        'FECHA DE EXPEDICION',
        'LUGAR DE EXPEDICION',
        'PRIMER APELLIDO',
        'SEGUNDO APELLIDO',
        'NOMBRES',
        'RAZON SOCIAL',
        'NIT',
        'DIGITO DE CHEQUEO',
        'CIUDAD OFICINA',
        'DIRECCION OFICINA',
        'NOMENCLATURA DE LA EMPRESA',
        'TELEFONO OFICINA',
        'FAX OFICINA'
    );
    $col_name1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P');
    $array[] = array(0 => $objetos1, 1 => $col_campos1, 2 => $col_name1, 3 => 'Reporte Clientes Juridicos', 4 => 'Reporte_clientescongestionesSinGestion');
    crearXls($array);
}

function UpdateANDGetClientsCapi() {
    $conexion = new Conexion();
    $temp = file('files/UpdateANDGetClientsCapi/updateFechaAprobacionRadicado1.csv');
    $fp = fopen("files/UpdateANDGetClientsCapi/ClienteCapiMarcdosPredictivo_salida_ACT4.csv", "a");
    fwrite($fp, "ID;DOCUMENTO;TELEFONO;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);

        $fechaexpedicionP = explode('/', trim($datos_leer[0])); //A
        $fechaexpedicion = $fechaexpedicionP[2] . "-" . $fechaexpedicionP[1] . "-" . $fechaexpedicionP[0];
        $titulo = trim($datos_leer[1]); //B
        $digitochequeo = trim($datos_leer[2]); //C
        $consecutivo = trim($datos_leer[3]); //D
        $tipodocumento = getTipoDocumento(trim($datos_leer[4])); //E
        $documento = trim($datos_leer[5]); //F
        $cedula = trim($datos_leer[5]); //F
        $lastname1 = trim($datos_leer[6]); //G
        $lastname2 = trim($datos_leer[7]); //H
        $firstname = trim($datos_leer[8]); //I
        $ingresos = trim($datos_leer[9]); //J
        $egresos = trim($datos_leer[10]); //K
        $activos = trim($datos_leer[11]); //L
        $pasivos = trim($datos_leer[12]); //M
        $profesion = trim($datos_leer[13]); //N
        $cuidadlaboral = getCiudadDANE(trim($datos_leer[14])); //O
        $direccionlaboral = trim($datos_leer[15]); //P 
        $telefonolaboral = trim($datos_leer[16]); //Q
        $direccionresidencia = trim($datos_leer[19]); //T
        $telefonoresidencia1 = trim($datos_leer[20]); //U
        $telefonoresidencia2 = trim($datos_leer[21]); //V
        $ciudadresidencia = getCiudadDANE(trim($datos_leer[22])); //W
        $correoelectronico = trim($datos_leer[23]); //X
        $sucursal = trim($datos_leer[24]); //Y
        $fechanacimientoP = explode('/', trim($datos_leer[25])); //Z
        $fechanacimiento = $fechanacimientoP[2] . "-" . $fechanacimientoP[1] . "-" . $fechanacimientoP[0];
        $lugarnacimiento = trim($datos_leer[26]); //AA
        $empresa = trim($datos_leer[27]); //AB

        $SQL = "SELECT * FROM client WHERE document = '$cedula'";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() > 0) {
            echo $SQL . "<br>";
            echo "SI EXISTE<br>";
            $consulta = $conexion->sacarRegistro();
            $id_cliente = $consulta['id'];

            $SQLUC = "UPDATE client SET capi = 'Si' WHERE id = $id_cliente";
            $conexionUC = new Conexion();
            if ($conexionUC->ejecutar($SQLUC))
                echo "ACTUALIZADO_CLIENTE";
            else
                echo "NO_ACTUALIZADO_CLIENTE";

            $conexion2 = new Conexion();
            $SQL2 = "SELECT * FROM data_capi WHERE id_client = $id_cliente";
            echo $SQL2 . "<br>";
            $conexion2->consultar($SQL2);
            if ($conexion2->getNumeroRegistros() == 0) {
                $SQLI = "INSERT INTO data_capi 
					(
						id_client, sucursal, fechaexpedicion, titulo, digitochequeo, consecutivo, tipodocumento, documento, primerapellido, 
						segundoapellido, nombres, fechanacimiento, lugarnacimiento, ingresos, egresos, activos, pasivos, profesion, empresa, 
						ciudadlaboral, direccionlaboral, telefonolaboral, ciudadresidencia, direccionresidencia, telefonoresidencia1, 
						telefonoresidencia2, correoelectronico, id_user, flag
					)
					VALUES
					(
						$id_cliente, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento', '$lastname1', 
						'$lastname2', '$firstname', '$fechanacimiento', '$lugarnacimiento', '$ingresos', '$egresos', '$activos', '$pasivos', '$profesion', '$empresa', 
						'$cuidadlaboral', '$direccionlaboral', '$telefonolaboral', '$ciudadresidencia', '$direccionresidencia', '$telefonoresidencia1', 
						'$telefonoresidencia2', '$correoelectronico', 1, 'CARGUECAPIMERCADOPREDICTIVO_" . date('Ymd') . "'
					)";
                echo $SQLI . "<br><br>";
                if ($conexion2->ejecutar($SQLI)) {
                    echo "DATOS INSERTADOS<br>";
                    echo $SQLI . "<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;INGRESADODATA_CLIENTEINICIAL" . PHP_EOL);
                } else {
                    echo $SQLI . "<br>";
                    echo "ERROR<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOINGRESADODATA_CLIENTEINICIAL" . PHP_EOL);
                }
            } else {
                echo "TIENE DATOS<br><br>";
                //fwrite($fp, "$id_cliente;$documento;$telefonolaboral;TIENEDATOSDATA".PHP_EOL);
                //}

                /* $SQLU = "UPDATE data_capi
                  SET sucursal = '$sucursal', fechaexpedicion = '$fechaexpedicion', titulo = '$titulo', digitochequeo = $digitochequeo,
                  consecutivo = $consecutivo, primerapellido = '$lastname1', segundoapellido = '$lastname2', nombres = '$firstname',
                  fechanacimiento = '$fechanacimiento', lugarnacimiento = '$lugarnacimiento', ingresos = '$ingresos', egresos = '$egresos',
                  activos = '$activos', pasivos = '$pasivos', profesion = '$profesion', empresa = '$empresa',
                  ciudadlaboral = '$cuidadlaboral', direccionlaboral = '$direccionlaboral', telefonolaboral = '$telefonolaboral',
                  ciudadresidencia = '$cuidadlaboral', direccionresidencia = '$direccionresidencia', telefonoresidencia1 = '$telefonoresidencia1',
                  telefonoresidencia2 = '$telefonoresidencia2', correoelectronico = '$correoelectronico'
                  WHERE id_client = $id_cliente";
                  echo "$SQLU<br>";
                  if($conexion->ejecutar($SQLU)){
                  echo "_ACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                  fwrite($fp, "$id_cliente;$documento;$telefonolaboral;ACTUALIZADO".PHP_EOL);
                  }else{
                  echo "NOACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                  fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOACTUALIZADO".PHP_EOL);
                  }
                  } */
            }
        } else {
            $SQLC = "INSERT INTO client 
					(
						document, persontype, firstname, type, capi, date_updated, status_migracion, status_form, last_updater, date_updated_document
					)
					VALUES
					(
						'$cedula',1,'$firstname $lastname1 $lastname2','','Si','0000-00-00','Activo','Activo',0,'0000-00-00 00:00:00'
					)";
            echo $SQLC . "<br>";
            $lastID = 0;
            if ($conexion->ejecutar($SQLC)) {
                $lastID = $conexion->ultimaId();
                echo "$SQLC<br>";
                echo "INSERTADO CLIENTE CON CEDULA $cedula<br>";
                fwrite($fp, "$lastID;$documento;$telefonolaboral;INSERTADOCLIENTE" . PHP_EOL);
                //$lastID = $conexion->ultimaId();			
                $SQLI = "INSERT INTO data_capi 
						(
							id_client, sucursal, fechaexpedicion, titulo, digitochequeo, consecutivo, tipodocumento, documento, primerapellido, 
							segundoapellido, nombres, fechanacimiento, lugarnacimiento, ingresos, egresos, activos, pasivos, profesion, empresa, 
							ciudadlaboral, direccionlaboral, telefonolaboral, ciudadresidencia, direccionresidencia, telefonoresidencia1, 
							telefonoresidencia2, correoelectronico, id_user, flag
						)
						VALUES
						(
							$lastID, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento', '$lastname1', 
							'$lastname2', '$firstname', '$fechanacimiento', '$lugarnacimiento', '$ingresos', '$egresos', '$activos', '$pasivos', '$profesion', '$empresa', 
							'$cuidadlaboral', '$direccionlaboral', '$telefonolaboral', '$ciudadresidencia', '$direccionresidencia', '$telefonoresidencia1', 
							'$telefonoresidencia2', '$correoelectronico', 1, 'CARGUECAPIMERCADOPREDICTIVO_" . date('Ymd') . "'
						)";
                echo $SQLI . "<br><br>";
                if ($conexion->consultar($SQLI)) {
                    echo "$SQLI<br>";
                    echo "INSERTADoS DATOS DE CLIENTE CON CEDULA $cedula<br>";
                    fwrite($fp, "$lastID;$documento;$telefonolaboral;INGRESADODATA_SINCLIENTEINICIAL" . PHP_EOL);
                } else {
                    echo "$SQLI<br>";
                    echo "NOINSERTADoS DATOS DE CLIENTE CON CEDULA $cedula<br>";
                    fwrite($fp, "$lastID;$documento;$telefonolaboral;NOINGRESADODATA_SINCLIENTEINICIAL" . PHP_EOL);
                }
            } else {
                echo "$SQLC<br>";
                echo "NOINSERTADO CLIENTE CON CEDULA $cedula<br>";
                fwrite($fp, "$lastID;$documento;$telefonolaboral;NOINSERTADOCLIENTE" . PHP_EOL);
            }
        }
    }

    echo "Terminado...";
}

function UpdateANDGetClientsCapiJuridico() {
    $conexion = new Conexion();
    $temp = file('files/UpdateANDGetClientsCapiJuridico/ClienteCapiJuridicosMarcdosPredictivo.csv');
    $fp = fopen("files/UpdateANDGetClientsCapiJuridico/ClienteCapiJuridicosMarcdosPredictivo_salida_3.csv", "a");
    fwrite($fp, "ID;DOCUMENTO;TELEFONO;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);

        $cedula = trim($datos_leer[5]);
        /* $lastname1 = trim($datos_leer[6]);
          $lastname2 = trim($datos_leer[7]);
          $firstname = trim($datos_leer[8]); */
        $fechaexpedicionP = split('/', trim($datos_leer[0]));
        $fechaexpedicion = $fechaexpedicionP[2] . "-" . $fechaexpedicionP[1] . "-" . $fechaexpedicionP[0]; //A
        $titulo = trim($datos_leer[1]); //B
        $digitochequeo = trim($datos_leer[2]); //C
        $consecutivo = trim($datos_leer[3]); //D
        $tipodocumento = getTipoDocumento(trim($datos_leer[4])); //E
        $documento = trim($datos_leer[5]); //F
        $empresa = trim($datos_leer[8]); //I
        $direccionlaboral = trim($datos_leer[9]); //J
        $telefonolaboral = trim($datos_leer[10]); //K
        $direccionresidencia = trim($datos_leer[14]); //O
        $telefonoresidencia1 = trim($datos_leer[15]); //P
        $telefonoresidencia2 = trim($datos_leer[16]); //Q
        $ciudadlaboral = trim($datos_leer[18]); //S
        $sucursal = trim($datos_leer[20]); //U
        $representante = trim($datos_leer[21]); //V
        $ingresos = trim($datos_leer[24]); //Y
        $egresos = trim($datos_leer[25]); //Z
        $activos = trim($datos_leer[26]); //AA
        $pasivos = trim($datos_leer[27]); //AB

        $SQL = "SELECT * FROM client WHERE document = '$cedula'";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() > 0) {
            echo $SQL . "<br>";
            echo "SI EXISTE<br>";
            $consulta = $conexion->sacarRegistro();
            $id_cliente = $consulta['id'];

            $conexion2 = new Conexion();
            $SQL2 = "SELECT * FROM data_capi WHERE id_client = $id_cliente";
            echo $SQL2 . "<br>";
            $conexion2->consultar($SQL2);
            if ($conexion2->getNumeroRegistros() == 0) {
                echo "SIN DATOS <br><br>";
                $SQLI = "INSERT INTO data_capi 
					(
						id_client, sucursal, fechaexpedicion, titulo, digitochequeo, consecutivo, tipodocumento, documento, 
						nombres, ingresos, egresos, activos, pasivos, empresa, 
						ciudadlaboral, direccionlaboral, telefonolaboral, ciudadresidencia, direccionresidencia, telefonoresidencia1, 
						telefonoresidencia2, id_user, flag
					)
					VALUES
					(
						$id_cliente, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento', 
						'$representante', '$ingresos', '$egresos', '$activos', '$pasivos', '$empresa', 
						'$ciudadlaboral', '$direccionlaboral', '$telefonolaboral', '$ciudadlaboral', '$direccionresidencia', '$telefonoresidencia1', 
						'$telefonoresidencia2', 0, 'CARGUECAPIMERCADOPREDICTIVO_20130412'
					)";
                echo $SQLI . "<br>";
                if ($conexion2->ejecutar($SQLI)) {
                    echo "DATOS INSERTADOS<br>";
                    echo $SQLI . "<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;INGRESADO_DT" . PHP_EOL);
                } else {
                    echo $SQLI . "<br>";
                    echo "ERROR<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOINGRESADO_DT" . PHP_EOL);
                }
            } else {
                echo "TIENE DATOS<br><br>";
                /* $SQLU = "UPDATE data_capi
                  SET sucursal = '$sucursal', fechaexpedicion = '$fechaexpedicion', titulo = '$titulo', digitochequeo = $digitochequeo,
                  consecutivo = $consecutivo, nombres = '$representante',
                  ingresos = '$ingresos', egresos = '$egresos',
                  activos = '$activos', pasivos = '$pasivos', empresa = '$empresa', razonsocial = '$empresa', nit = '$documento',
                  ciudadlaboral = '$ciudadlaboral', direccionlaboral = '$direccionlaboral', telefonolaboral = '$telefonolaboral',
                  ciudadresidencia = '$ciudadlaboral', direccionresidencia = '$direccionresidencia', telefonoresidencia1 = '$telefonoresidencia1',
                  telefonoresidencia2 = '$telefonoresidencia2', flag = 'CARGUECAPIMERCADOPREDICTIVO_20130412'
                  WHERE id_client = $id_cliente";
                  echo $SQLU."<br>";
                  if($conexion2->ejecutar($SQLU)){
                  echo "ACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                  fwrite($fp, "$id_cliente;$documento;$telefonolaboral;ACTUALIZADO_DT".PHP_EOL);
                  }else{
                  echo "NOACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                  fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOACTUALIZADO_DT".PHP_EOL);
                  } */
                /* $SQLU = "UPDATE data_capi
                  SET nit = '$documento', razonsocial = '$empresa'
                  WHERE id_client = $id_cliente";
                  echo $SQLU."<br>";
                  if($conexion2->ejecutar($SQLU)){
                  echo "ACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                  fwrite($fp, "$id_cliente;$documento;$telefonolaboral;ACTUALIZADO_DT".PHP_EOL);
                  }else{
                  echo "NOACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                  fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOACTUALIZADO_DT".PHP_EOL);
                  } */
                //echo "$SQLU<br>";				
            }

            /* $SQLU = "UPDATE data_capi
              SET sucursal = $sucursal, fechaexpedicion = $fechaexpedicion, titulo = $titulo, digitochequeo = $digitochequeo,
              consecutivo = $consecutivo, primerapellido = $lastname1, segundoapellido = $lastname2, nombres = $firstname,
              fechanacimiento = $fechanacimiento, lugarnacimiento = $lugarnacimiento, ingresos = $ingresos, egresos = $egresos,
              activos = $activos, pasivos = $pasivos, profesion = $profesion, empresa = $empresa,
              cuidadlaboral = $cuidadlaboral, direccionlaboral = $direccionlaboral, telefonolaboral = $telefonolaboral,
              ciudadresidencia = $cuidadlaboral, direccionresidencia = $direccionresidencia, telefonoresidencia1 = $telefonoresidencia1,
              telefonoresidencia2 = $telefonoresidencia2, correoelectronico = $correoelectronico
              WHERE id_client = $id_cliente";
              $conexion->consultar($SQLU);
              //echo "$SQLU<br>";
              echo "ACTUALIZADO CLIENTE CON CEDULA $cedula<br>"; */
        } else {
            /* echo "NO EXISTE<br><br>";
              $SQLC = "INSERT INTO client
              (
              document, persontype, firstname, type, flag, capi, date_updated, status_migracion, status_form, last_updater, date_updated_document
              )
              VALUES
              (
              '$cedula',2,'$empresa','SGV', 'CARGUECAPIMERCADOPREDICTIVO_20130412', 'Si','0000-00-00','Activo','Inactivo',0,'0000-00-00 00:00:00'
              )";
              if($conexion->ejecutar($SQLC)){
              echo "$SQLC<br>";
              echo "INSERTADO CLIENTE CON CEDULA $cedula<br>";
              $lastID = $conexion->ultimaId();
              $SQLI = "INSERT INTO data_capi
              (
              id_client, sucursal, fechaexpedicion, titulo, digitochequeo, consecutivo, tipodocumento, documento,
              nombres, ingresos, egresos, activos, pasivos, empresa,
              ciudadlaboral, direccionlaboral, telefonolaboral, ciudadresidencia, direccionresidencia, telefonoresidencia1,
              telefonoresidencia2, id_user, flag
              )
              VALUES
              (
              $lastID, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento',
              '$representante', '$ingresos', '$egresos', '$activos', '$pasivos', '$empresa',
              '$ciudadlaboral', '$direccionlaboral', '$telefonolaboral', '$ciudadlaboral', '$direccionresidencia', '$telefonoresidencia1',
              '$telefonoresidencia2', 0, 'CARGUECAPIMERCADOPREDICTIVO_20130412'
              )";
              //$conexion->consultar($SQLI);
              if($conexion->ejecutar($SQLI)){
              echo "DATOS INSERTADOS<br>";
              echo $SQLI."<br><br>";
              fwrite($fp, "$lastID;$documento;$telefonolaboral;INGRESADO_DT_NC".PHP_EOL);
              }else{
              echo $SQLI."<br>";
              echo "ERROR<br><br>";
              fwrite($fp, "$lastID;$documento;$telefonolaboral;NOINGRESADO_DT_NC".PHP_EOL);
              }
              echo "$SQLI<br>";
              echo "INSERTADoS DATOS DE CLIENTE CON CEDULA $cedula<br>";
              }else{
              echo "$SQLC<br>";
              echo "NO INSERTO CLIENTE CON CEDULA $cedula<br>";
              fwrite($fp, "NULL;$documento;$telefonolaboral;NOINGRESADO_NC".PHP_EOL);
              } */
        }
    }
    fclose($fp);
    echo "Terminado...";
}

function insertGestionNoContacto() {
    $conexion = new Conexion();
    $temp = file('files/insertGestionNoContacto/insertGestionNoContacto29.csv');
    $n = count($temp);
    $objetos = array();
    $fp = fopen("files/insertGestionNoContacto/insertGestionNoContacto_salida29.csv", "a");
    fwrite($fp, "IDREGISTRO;ID;DOCUMENTO;FECHA;CAMPAÑA;ESTADO" . PHP_EOL);
    echo $n . " Cantidad de registros<br>";
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        //$id = trim($datos_leer[0]);
        $ced = trim($datos_leer[0]);

        $tipo_contacto = trim($datos_leer[3]);
        //$telefonoresidencia1 = trim($datos_leer[1]);

        /* $fecp = explode(' ', trim($datos_leer[2]));
          $fecpart = explode('/', $fecp[0]); */
        $fecpart = explode('/', trim($datos_leer[2]));

        $hor = rand(8, 19);
        $min = rand(0, 59);
        $seg = rand(0, 59);
        $fecha = $fecpart[2] . "-" . $fecpart[1] . "-" . $fecpart[0] . " $hor:$min:$seg";

        /* $SQL = "SELECT t1.*
          FROM data_capi AS t1
          INNER JOIN client AS t2 ON(t1.id_client = t2.id)
          WHERE t2.document = $ced";
          echo $SQL."<br>";
          //$SQL =  "SELECT * FROM data_capi WHERE id_client = $id";
          $conexion->consultar($SQL);
          if($conexion->getNumeroRegistros() > 0){
          $consulta = $conexion->sacarRegistro();
          $id_cliente = $consulta['id_client'];
          $documento = $consulta['documento'];
          $primerapellido = str_replace("'","",$consulta['primerapellido']);
          $segundoapellido = str_replace("'","",$consulta['segundoapellido']);
          $nombres = str_replace("'","",$consulta['nombres']);
          $fechanacimiento = $consulta['fechanacimiento'];
          $profesion = str_replace("'","",$consulta['profesion']);
          $empresa = str_replace("'","",$consulta['empresa']);
          $direccionlaboral = str_replace("'","",$consulta['direccionlaboral']);
          $direccionresidencia = str_replace("'","",$consulta['direccionresidencia']);
          $telefonoresidencia1 = $consulta['telefonoresidencia1'];
          if($tipo_contacto == '10')
          $observacion = 	$telefonoresidencia1." TELEFONO OCUPADO";
          else
          $observacion = 	$telefonoresidencia1." NO CONTESTAN";

          $SQLU = "INSERT INTO data_capi_confirm
          (
          id_client, id_user, id_contact, documento, primerapellido, segundoapellido, nombres, fechanacimiento,
          id_profesion, id_ingresos, id_egresos, activos, pasivos, direccionlaboral, id_ciudad, direccionresidencia,
          telefonoresidencia, observacion, date_created, status
          )
          VALUES
          (
          $id_cliente, 2090, '$tipo_contacto', '$documento', '$primerapellido', '$segundoapellido', '$nombres', '$fechanacimiento',
          '0', '0', '0', '0', '0', '$direccionlaboral', 0, '$direccionresidencia',
          '$telefonoresidencia1', '$observacion', '$fecha', 1
          )";
          echo $SQLU."<br><br>";
          //exit();
          $lastID = 0;
          if($conexion->ejecutar($SQLU)){
          //echo "$SQLU<br>";
          $lastID = $conexion->ultimaId();
          fwrite($fp, "$lastID;$id_cliente;$ced;$fecha;CAPI;INSERTADO".PHP_EOL);
          echo "CLIENTE INSERTADO CON ID $id_cliente<br><br>";
          }else{
          echo "ERROR<br><br>";
          fwrite($fp, "$lastID;$id_cliente;$ced;$fecha;CAPI;NO_INSERTADO".PHP_EOL);
          }
          }else{
          echo "NO SE ENCONTRO CLIENTE CON ID $id_cliente y CEDULA $ced<br><br>"; */
        //fwrite($fp, "0;$id_cliente;$ced;$fecha;NO_ENCONTRADO".PHP_EOL);
        $conexion1 = new Conexion();
        $SQLS = "SELECT t1.*, t2.id_client, t2.id AS id_form_, t3.persontype AS typeperson 
					FROM data AS t1 
					INNER JOIN form AS t2 ON(t1.id_form = t2.id)
					INNER JOIN client AS t3 ON(t2.id_client = t3.id) 
					WHERE t3.document = '$ced'
					ORDER BY t2.date_created DESC
					LIMIT 1";
        echo $SQLS . "<br>";
        //$SQLS =  "SELECT * FROM data_capi WHERE id_client = $id";
        $conexion1->consultar($SQLS);
        if ($conexion1->getNumeroRegistros() > 0) {
            $consulta = $conexion1->sacarRegistro();
            $id_cliente = $consulta['id_client'];
            $id_form = $consulta['id_form_'];
            $persontype = $consulta['typeperson'];
            $documento = $consulta['documento'];
            $primerapellido = $consulta['primerapellido'];
            $segundoapellido = $consulta['segundoapellido'];
            $nombres = $consulta['nombres'];
            $fechanacimiento = $consulta['fechanacimiento'];
            $profesion = $consulta['profesion'];
            $empresa = $consulta['nombreempresa'];
            $direccionlaboral = $consulta['direccionempresa'];
            $direccionresidencia = $consulta['direccionresidencia'];
            $telefonoresidencia1 = $consulta['telefonoresidencia'];
            //$observacion = 	$telefonoresidencia1." NO CONTESTAN";
            if ($tipo_contacto == '10')
                $observacion = $telefonoresidencia1 . " TELEFONO OCUPADO";
            else
                $observacion = $telefonoresidencia1 . " NO CONTESTAN";

            $SQLUS = "INSERT INTO data_confirm
						(
							id_client, id_form, persontype, id_user, id_contact, documento, primerapellido, segundoapellido, nombres, profesion, 
							ingresosmensuales, egresosmensuales, activosemp, pasivosemp, direccionoficinappal, ciudadresidencia, direccionresidencia, 
							telefonoresidencia, observacion, date_created, status
						)
						VALUES
						(
							$id_cliente, $id_form, '$persontype', 2090, '$tipo_contacto', '$documento', '$primerapellido', '$segundoapellido', '$nombres', '0',
							'0', '0', '0', '0', '$direccionlaboral', 0, '$direccionresidencia',
							'$telefonoresidencia1', '$observacion', '$fecha', 1
						)";
            echo $SQLUS . "<br>";
            $lastID = 0;
            //exit();
            if ($conexion1->consultar($SQLUS)) {
                //echo "$SQLUS<br>";
                //fwrite($fp, "$id_cliente;$ced;$fecha;INSERTADO".PHP_EOL);
                //echo "CLIENTE INSERTADO CON ID $id_cliente<br><br>";
                $lastID = $conexion->ultimaId();
                fwrite($fp, "$lastID;$id_cliente;$ced;$fecha;SEGURO;INSERTADO" . PHP_EOL);
                echo "CLIENTE INSERTADO CON ID $id_cliente<br><br>";
            } else {
                //echo "ERROR<br><br>";
                //fwrite($fp, "$id_cliente;$ced;$fecha;NOINSERTADO".PHP_EOL);
                echo "ERROR<br><br>";
                fwrite($fp, "$lastID;$id_cliente;$ced;$fecha;SEGURO;NO_INSERTADO" . PHP_EOL);
            }
        } else {
            echo "ERROR_NOENCONTRADO<br><br>";
            fwrite($fp, "0;0;$ced;$fecha;NINGUNO;NO_ENCONTRADO" . PHP_EOL);
        }
        //}
    }
    echo "Terminado...";
    //fclose($fp);
}

function insertGestionNoContactoSeguros() {
    $conexion = new Conexion();
    $temp = file('files/insertGestionNoContactoSeguros/insertGestionNoContactoSeguros2.csv');
    $n = count($temp);
    $objetos = array();
    $fp = fopen("files/insertGestionNoContactoSeguros/insertGestionNoContactoSeguros_salida2_2.csv", "a");
    fwrite($fp, "ID;DOCUMENTO;FECHA;ESTADO" . PHP_EOL);
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);


        $id = trim($datos_leer[0]);
        $ced = trim($datos_leer[1]);

        $fecp = trim($datos_leer[3]);
        $fecpart = explode('/', $fecp);
        $hor = rand(8, 19);
        $min = rand(0, 59);
        $seg = rand(0, 59);
        $fecha = $fecpart[2] . "-" . $fecpart[1] . "-" . $fecpart[0] . " $hor:$min:$seg";

        /* $SQL =  "SELECT t1.*, t2.* FROM data AS t1 
          INNER JOIN form AS t2 ON(t1.id_form = t2.id)
          INNER JOIN client AS t3 ON(t2.id_client = t3.id)
          WHERE t3.documento = $ced"; */
        $SQL = "SELECT t1.*, t2.id_client, t2.id AS id_form_, t3.persontype AS typeperson FROM data AS t1 
				INNER JOIN form AS t2 ON(t1.id_form = t2.id)
				INNER JOIN client AS t3 ON(t2.id_client = t3.id) 
				WHERE t3.document = '$ced'
				ORDER BY t2.date_created DESC
				LIMIT 1";
        //$SQL =  "SELECT * FROM data_capi WHERE id_client = $id";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() > 0) {
            $consulta = $conexion->sacarRegistro();
            $id_cliente = $consulta['id_client'];
            $id_form = $consulta['id_form_'];
            $persontype = $consulta['typeperson'];
            $documento = $consulta['documento'];
            $primerapellido = $consulta['primerapellido'];
            $segundoapellido = $consulta['segundoapellido'];
            $nombres = $consulta['nombres'];
            $fechanacimiento = $consulta['fechanacimiento'];
            $profesion = $consulta['profesion'];
            $empresa = $consulta['nombreempresa'];
            $direccionlaboral = $consulta['direccionempresa'];
            $direccionresidencia = $consulta['direccionresidencia'];
            $telefonoresidencia1 = $consulta['telefonoresidencia'];
            $observacion = $telefonoresidencia1 . " NO CONTESTAN";
            $SQLU = "INSERT INTO data_confirm
					(
						id_client, id_form, persontype, id_user, id_contact, documento, primerapellido, segundoapellido, nombres, profesion, 
						ingresosmensuales, egresosmensuales, activosemp, pasivosemp, direccionoficinappal, ciudadresidencia, direccionresidencia, 
						telefonoresidencia, observacion, date_created, status
					)
					VALUES
					(
						$id_cliente, $id_form, '$persontype', 2090, '8', '$documento', '$primerapellido', '$segundoapellido', '$nombres', '0',
						'0', '0', '0', '0', '$direccionlaboral', 0, '$direccionresidencia',
						'$telefonoresidencia1', '$observacion', '$fecha', 1
					)";
            echo $SQLU . "<br>";
            /* $SQLU = "UPDATE data_confirm 
              SET id_form = $id_form, persontype = $persontype, id_user = 2090
              WHERE id_client = $id_cliente AND id_contact = 8 AND id_user = 2060"; */
            //exit();
            if ($conexion->ejecutar($SQLU)) {
                //echo "$SQLU<br>";
                fwrite($fp, "$id_cliente;$ced;$fecha;INSERTADO" . PHP_EOL);
                echo "CLIENTE INSERTADO CON ID $id_cliente<br><br>";
            } else {
                echo "ERROR<br><br>";
                fwrite($fp, "$id_cliente;$ced;$fecha;NOINSERTADO" . PHP_EOL);
            }
            //$conexion->ejecutar($SQLU);
        } else {
            echo "NO SE ENCONTRO CLIENTE CON ID $id_cliente y CEDULA $ced<br>";
            /* $conexion1 = new Conexion();
              $SQL1 = "SELECT * FROM data WHERE documento = '$ced'";
              $conexion1->consultar($SQL1);
              $numcot = $conexion1->getNumeroRegistros();
              if ($numcot == 0){
              echo "NO SE ENCONTRO ESTE CLIENTE<br><br>";
              fwrite($fp, "$id;$ced;$fecha".PHP_EOL);
              }/*else{
              $consulta = $conexion1->sacarRegistro();
              $documento = $consulta['documento'];
              $primerapellido = $consulta['primerapellido'];
              $segundoapellido = $consulta['segundoapellido'];
              $nombres = $consulta['nombres'];
              $fechanacimiento = $consulta['fechanacimiento'];
              $direccionlaboral = $consulta['direccionempresa'];
              $direccionresidencia = $consulta['direccionresidencia'];
              $telefonoresidencia1 = $consulta['telefonoresidencia'];
              $observacion = 	$telefonoresidencia1." NO CONTESTAN";
              $SQLU1 = "INSERT data_capi_confirm
              (
              id_client, id_user, id_contact, documento, primerapellido, segundoapellido, nombres, fechanacimiento, id_profesion,
              id_ingresos, id_egresos, activos, pasivos, direccionlaboral, id_ciudad, direccionresidencia,
              telefonoresidencia, observacion, date_created, status
              )
              VALUES
              (
              $id, 2060, '8', '$documento', '$primerapellido', '$segundoapellido', '$nombres', '$fechanacimiento', '0',
              '0', '0', '0', '0', '$direccionlaboral', 0, '$direccionresidencia',
              '$telefonoresidencia1', '$observacion', '$fecha', 1
              )";
              echo "CLIENTE ENCONTRADO...<br><br>";
              echo $SQLU1."<br>";
              //exit();
              $conexion1->consultar($SQLU1);
              echo "CLIENTE INSERTADO CON ID $id<br><br>";
              } */
        }
    }
    fclose($fp);
    echo "Terminado...";
}

function UpdateFechasGestiones() {
    $conexion = new Conexion();
    $temp = file('files/UpdateFechasGestiones/UpdateFechasGestiones4.csv');
    $n = count($temp);
    $objetos = array();
    /* $fp = fopen("files/UpdateFechasGestiones/UpdateFechasGestiones_salida4.csv","a");
      fwrite($fp, "Tipo gestion;Gestion;IdGestion;Documento;Fecha de gestion;cantidad;error".PHP_EOL); */
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        $fecp = trim($datos_leer[5]);
        //$fec = trim($datos_leer[4]);
        //$fecp = explode(' ', $fec);
        //$fecpart = explode('/', $fecp[0]);		
        $fecpart = explode('/', $fecp);

        //$hor = rand(8,23);
        //$min = rand(0,59);
        $seg = rand(0, 59);

        //$fecha = $fecpart[2]."-".$fecpart[1]."-".$fecpart[0]." $hor:$min:$seg";
        //$fecha = $fecpart[2]."-".$fecpart[1]."-".$fecpart[0]." ".$fecp[1];
        $fecha = $fecpart[2] . "-" . $fecpart[1] . "-" . $fecpart[0];

        $feco = trim($datos_leer[4]);
        $fecopart = explode('/', $feco);
        $fecha_old = $fecopart[2] . "-" . $fecopart[1] . "-" . $fecopart[0];

        $gestion = trim($datos_leer[2]);
        $gestionSTR = trim($datos_leer[1]);
        $documento = trim($datos_leer[0]);
        /* $SQL = "SELECT COUNT(*) AS cantidad, t2.id 
          FROM data_capi_confirm AS t1
          LEFT JOIN client AS t2 ON(t1.id_client = t2.id)
          WHERE t2.document = '$documento' AND t1.id_contact = $gestion"; */
        $SQL = "SELECT COUNT(*) AS cantidad, t2.id, t1.date_created
				FROM data_capi_confirm AS t1 
				LEFT JOIN client AS t2 ON(t1.id_client = t2.id)
				WHERE t2.document = '$documento' 
				AND t1.id_contact = $gestion
				AND t1.date_created BETWEEN '$fecha_old 00:00:00' AND '$fecha_old 23:59:59'";
        /* $SQL = "SELECT COUNT(*)    
          FROM client cli INNER JOIN data_capi_confirm confirm ON cli.id = confirm.id_client
          INNER JOIN param_contact ON param_contact.id = confirm.id_contact
          WHERE cli.document = '$documento' AND confirm.id_contact = $gestion
          ORDER BY confirm.date_created DESC"; */
        echo "fecha: $fecha_old<br>" . $SQL . "<br>";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() > 0) {
            $consulta = $conexion->sacarRegistro();
            $id_client = $consulta[1];
            $date = $consulta[2];
            $cantidad = $consulta[0];
            if ($cantidad == 1) {

                $fec1 = trim($datos_leer[5]);
                $fecp1 = explode(' ', $fec1);
                $fecpart1 = explode('/', $fecp1[0]);
                $seg = rand(0, 59);
                $fechaF = $fecpart1[2] . "-" . $fecpart1[1] . "-" . $fecpart1[0] . " " . $fecp1[1] . ":$seg";


                $conexion1 = new Conexion();
                $SQLU = "UPDATE data_capi_confirm
						 SET date_created = REPLACE(date_created, '$fecha_old', '$fecha')
						 WHERE id_client = $id_client 
						 AND id_contact = $gestion
						 AND date_created = '$date'";
                echo $SQLU . "<br>";
                /* if($conexion1->ejecutar($SQLU)){
                  //$conexion1->desconectar();
                  fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;ACTUALIZADO".PHP_EOL);
                  echo "EL CLIENTE CON DOCUMENTO # $documento Y GESTION $gestionSTR FUE ACTUALIZADO A LA FECHA $fecha<br><br>";
                  }else{
                  //$conexion1->desconectar();
                  echo "NO SE PUDO ACTUALIZAR CLIENTE CON DOCUMENTO $documento<br><br>";
                  $tipoGes = trim($datos_leer[1]);
                  fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;NOACTUALIZADO".PHP_EOL);
                  } */
                echo "1 GESTION<br><br>";
            } else {
                //echo "MAS DE UNA GESTION<br>";
                //fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;MASDEUNAGESTION".PHP_EOL);
                if ($cantidad == 0) {
                    $SQL2 = "SELECT COUNT(*) AS cantidad, t2.id, t1.date_created
							FROM data_confirm AS t1
							INNER JOIN form ON(form.id = t1.id_form)
							LEFT JOIN client AS t2 ON(form.id_client = t2.id)
							WHERE t2.document = '$documento' 
							AND t1.id_contact = $gestion
							AND t1.date_created BETWEEN '$fecha_old 00:00:00' AND '$fecha_old 23:59:59'";
                    echo "fecha: $fecha_old<br>" . $SQL2 . "<br>";
                    $conexion->consultar($SQL2);
                    if ($conexion->getNumeroRegistros() > 0) {
                        $consulta = $conexion->sacarRegistro();
                        $id_client = $consulta[1];
                        $date = $consulta[2];
                        $cantidad = $consulta[0];
                        if ($cantidad == 1) {
                            $conexion1 = new Conexion();
                            $SQLU = "UPDATE data_confirm
									 SET date_created = REPLACE(date_created, '$fecha_old', '$fecha')
									 WHERE id_client = $id_client 
									 AND id_contact = $gestion
									 AND date_created = '$date'";
                            echo $SQLU . "<br>";
                            /* if($conexion1->ejecutar($SQLU)){
                              //$conexion1->desconectar();
                              fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;ACTUALIZADO".PHP_EOL);
                              echo "EL CLIENTE CON DOCUMENTO # $documento Y GESTION $gestionSTR FUE ACTUALIZADO A LA FECHA $fecha<br><br>";
                              }else{
                              //$conexion1->desconectar();
                              echo "NO SE PUDO ACTUALIZAR CLIENTE CON DOCUMENTO $documento<br><br>";
                              $tipoGes = trim($datos_leer[1]);
                              fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;NOACTUALIZADO".PHP_EOL);
                              } */
                            echo "1 GESTION<br><br>";
                        } else {
                            if ($cantidad == 0) {
                                echo "0 GESTIONES<br>";
                                //fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;CEROGESTION".PHP_EOL);
                            } else {
                                echo "MAS DE UNA GESTION<br>";
                                //fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;MASDEUNAGESTION".PHP_EOL);
                            }
                        }
                    } else {
                        echo "LA CEDULA $documento NO TIENE REGISTROS<br><br>";
                    }
                } else {
                    echo "MAS DE UNA GESTION $cantidad<br>";
                }
                /* $cantidad = $consulta[0];
                  $tipoGes = trim($datos_leer[0]);
                  fwrite($fp, "$tipoGes;$gestionSTR;$gestion;$documento;$fec;$cantidad".PHP_EOL); */
                /* $conexion2 = new Conexion();
                  $SQL1 = "SELECT t1.date_created, t2.id
                  FROM data_capi_confirm AS t1
                  LEFT JOIN client AS t2 ON(t1.id_client = t2.id)
                  WHERE t2.document = '$documento' AND t1.id_contact = $gestion
                  ORDER BY t1.date_created DESC
                  LIMIT 1";
                  echo $SQL1."<br>";
                  $conexion2->consultar($SQL1);
                  if($conexion2->getNumeroRegistros() > 0){ */
                /* $consulta2 = $conexion2->sacarRegistro();
                  $id_client2 = $consulta2[1];
                  $fecha2 = $consulta2[0];
                  $conexion3 = new Conexion();
                  $SQLU1 = "UPDATE data_capi_confirm
                  SET date_created = '$fecha'
                  WHERE id_client = $id_client2 AND id_contact = $gestion
                  AND date_created = '$fecha2'";
                  echo $SQLU1."<br><br>";
                  if($conexion3->ejecutar($SQLU1)){
                  //$conexion1->desconectar();
                  echo "EL CLIENTE CON DOCUMENTO # $documento Y GESTION $gestionSTR FUE ACTUALIZADO A LA FECHA $fecha<br><br>";
                  }else{
                  //$conexion1->desconectar();
                  echo "NO SE PUDO ACTUALIZAR CLIENTE CON DOCUMENTO $documento<br><br>";
                  $tipoGes = trim($datos_leer[1]);
                  fwrite($fp, "$tipoGes;$gestionSTR;$gestion;$documento;$fec;$cantidad;no se pudo".PHP_EOL);
                  } */
                /* }else{
                  echo "NO TIENE CONFIRMACION EN CAPI<br><br>";
                  $tipoGes = trim($datos_leer[1]);
                  fwrite($fp, "$tipoGes;$gestionSTR;$gestion;$documento;$fecha;0;no en capi".PHP_EOL);
                  } */
            }
            //echo "SE ENCONTRARON ".$consulta[0]." REGISTROS DE CEDULA $documento<br><br>";
        } else {
            echo "LA CEDULA $documento NO TIENE REGISTROS<br><br>";
        }
    }
    //fclose($fp);
    echo "TERMINO...";
}

function EliminarGestionesPorFechas() {
    $conexion = new Conexion();
    $temp = file('files/EliminarGestionesPorFechas/EliminarGestionesPorFechas7.csv');
    $n = count($temp);
    $fp = fopen("files/EliminarGestionesPorFechas/EliminarGestionesPorFechas_salida7.csv", "a");
    fwrite($fp, "ID;OLD_FECHA;NEW_FECHA;ESTADO" . PHP_EOL);
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        //$fecp = trim($datos_leer[4]);
        $documento = trim($datos_leer[0]);
        /* $tipo_contacto = trim($datos_leer[4]);
          $fec = trim($datos_leer[6]);
          $hora = trim($datos_leer[7]);
          $fec2 = trim($datos_leer[8]);

          $fecp = explode('/', $fec);
          $fecha = $fecp[2]."-".$fecp[1]."-".$fecp[0]." ".$hora;

          $fecp2 = explode('/', $fec2);
          $fecha2 = $fecp2[2]."-".$fecp2[1]."-".$fecp2[0]." ".$hora; */
        $f_o = explode(' ', trim($datos_leer[2]));
        $f_ol = explode('/', $f_o[0]);
        $fecha_old = $f_ol[2] . '-' . $f_ol[1] . '-' . $f_ol[0] . ' ' . $f_o[1];

        $f_n = explode(' ', trim($datos_leer[1]));
        $f_ne = explode('/', $f_n[0]);
        $fecha_new = $f_ne[2] . '-' . $f_ne[1] . '-' . $f_ne[0] . ' ' . $f_n[1];
        //$fec = trim($datos_leer[4]);
        //$fecp = explode(' ', $fec);
        //$fecpart = explode('/', $fecp[0]);		
        /* $fecpart = explode('/', $fecp);

          //$hor = rand(8,23);
          //$min = rand(0,59);
          $seg = rand(0,59); */

        //$fecha = $fecpart[2]."-".$fecpart[1]."-".$fecpart[0]." $hor:$min:$seg";
        /* $fecha = $fecpart[2]."-".$fecpart[1]."-".$fecpart[0];
          $gestion = trim($datos_leer[2]);
          $gestionSTR = trim($datos_leer[1]);
          $documento = trim($datos_leer[3]); */
        /* $SQL = "SELECT COUNT(*) AS cantidad, t2.id, t1.date_created
          FROM data_capi_confirm AS t1
          LEFT JOIN client AS t2 ON(t1.id_client = t2.id)
          WHERE t2.document = '$documento'
          AND t1.id_contact = $gestion
          AND t1.date_created BETWEEN '$fecha 00:00:00' AND '$fecha 23:59:59'"; */
        /* $SQL = "SELECT * FROM data_confirm AS t1 INNER JOIN client AS t2 ON(t1.id_client = t2.id)
          WHERE t1.id_contact = '$tipo_contacto'
          AND t2.document = '$documento'
          AND t1.date_created = '$fecha'"; */
        $SQL = "SELECT t1.* FROM data_confirm AS t1 
				INNER JOIN client AS t2 ON(t1.id_client = t2.id)
				WHERE t2.document = '$documento'
				AND t1.date_created LIKE '$fecha_old%'";
        echo "fecha: $fecha_old<br>" . $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        if ($cant == 1) {
            echo "tiene un solo registro<br>";
            /* $consulta = $conexion->sacarRegistro();
              $id = $consulta[0];

              $conexion1 = new Conexion();
              $SQLU = "DELETE FROM data_confirm
              WHERE id = $id";
              echo $SQLU."<br>";
              if($conexion1->ejecutar($SQLU)){
              //$conexion1->desconectar();
              echo "ELIMINDA ID $id<br><br>";
              fwrite($fp, "$id;ELIMNADA".PHP_EOL);
              }else{
              //$conexion1->desconectar();
              echo "NO SE PUDO ELIMINAR EL ID $id<br><br>";
              fwrite($fp, "$id;NOSEPUDO".PHP_EOL);
              } */
            //echo "SE ENCONTRARON ".$consulta[0]." REGISTROS DE CEDULA $documento<br><br>";
            $consulta = $conexion->sacarRegistro('str');
            $id = $consulta['id'];

            $conexion1 = new Conexion();
            $SQLU = "UPDATE data_confirm
					 SET date_created = REPLACE(date_created, '$fecha_old', '$fecha_new')
					 WHERE id = $id";
            echo $SQLU . "<br><br>";
            if ($conexion1->ejecutar($SQLU)) {
                //$conexion1->desconectar();
                echo "ACTUALIZADA ID $id<br><br>";
                fwrite($fp, "$id;$fecha_old;$fecha_new;ACTUALIZADA" . PHP_EOL);
            } else {
                //$conexion1->desconectar();
                echo "NO SE PUDO ACTUALIZAR EL ID $id<br><br>";
                fwrite($fp, "$id;$fecha_old;$fecha_new;NOSEPUDO" . PHP_EOL);
            }
        } else {
            if ($cant == 0) {
                # code...
                echo "LA CEDULA $documento NO TIENE REGISTROS<br><br>";
            } else {
                echo "LA CEDULA $documento TIENE MAS de un REGISTROS<br><br>";
            }
        }
    }
    fclose($fp);
    echo "TERMINO...";
}

function EliminarGestionesExtraCAPI() {
    $conexion = new Conexion();
    $temp = file('files/EliminarGestionesExtra/EliminarGestionesExtra1.csv');
    $n = count($temp);
    $fp = fopen("files/EliminarGestionesExtra/EliminarGestionesExtra_salida1.csv", "a");
    fwrite($fp, "IDELIMINADO;DOCUMENTO;DATOS;ESTADO" . PHP_EOL);
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        //$fecp = trim($datos_leer[4]);
        $documento = trim($datos_leer[0]);
        $tipo_contacto = trim($datos_leer[2]);
        $id_gestor = trim($datos_leer[5]);

        $fec = explode(" ", trim($datos_leer[6]));
        $fecp = explode('/', $fec[0]);
        $fecha = $fecp[2] . "-" . $fecp[1] . "-" . $fecp[0] . " " . $fec[1];

        $SQL = "SELECT t1.* 
				FROM data_capi_confirm AS t1 
				INNER JOIN client AS t2 ON(t1.id_client = t2.id)
				WHERE t2.document = $documento
				AND t1.id_contact = $tipo_contacto
				AND t1.id_user = $id_gestor
				AND t1.date_created LIKE '$fecha%'";
        echo "fecha: $fecha<br>" . $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        if ($cant == 1) {
            echo "tiene un solo registro<br>";
            $consulta = $conexion->sacarRegistro('str');
            $SQLD = "DELETE FROM data_capi_confirm WHERE id = " . $consulta['id'];
            echo $SQLD . "<br>";
            if ($conexion->ejecutar($SQLD)) {
                echo "GESTION ELIMINADA";
                fwrite($fp, $consulta['id'] . ";$documento;" . json_encode($consulta) . ";REGISTRO_ELIMINADO" . PHP_EOL);
            } else {
                echo "NO SE PUDO ELIMINADA LA GESTION";
                fwrite($fp, $consulta['id'] . ";$documento;" . json_encode($consulta) . ";NOSEPUDO_ELIMINADO" . PHP_EOL);
            }
        } else {
            if ($cant == 0) {
                # code...
                echo "LA CEDULA $documento NO TIENE REGISTROS<br><br>";
                fwrite($fp, "0;$documento;{document:$documento,id_contact:$tipo_contacto,id_user:2060,date_created:$fecha};SIN_REGISTROS" . PHP_EOL);
            } else {
                echo "LA CEDULA $documento TIENE MAS de un REGISTROS<br><br>";
                fwrite($fp, "0;$documento;{document:$documento,id_contact:$tipo_contacto,id_user:2060,date_created:$fecha};MAS_REGISTROS" . PHP_EOL);
            }
        }
    }
    fclose($fp);
    echo "TERMINO...";
}

function subirclientesMigracionConImagenes() {
    $conexion = new Conexion();
    $temp = file('clientesEnMigracionQueNoExisten/clientesEnMigracionQueNoExisten.csv');
    $fp = fopen("clientesEnMigracionQueNoExisten/clientesEnMigracionQueNoExisten_salida.csv", "a");
    fwrite($fp, "Documento;Nombre / Razon social;Accion o estado;Fuente" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        $document = trim($datos_leer[0]);
        $firstnameC = trim($datos_leer[1]);
        $fuente = trim($datos_leer[2]);
        $SQL = "SELECT * 
				FROM client AS t1 
				WHERE t1.document = '$document'";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() > 0) {
            //si se encontro el documento creado en clientes client
            echo $SQL . "<br>si se encontro el documento creado en clientes client<br>";
            $consulta = $conexion->sacarRegistro();
            $SQLS = "SELECT * 
					 FROM migra_images
					 WHERE document = '$document'";
            $conexion->consultar($SQLS);
            if ($conexion->getNumeroRegistros() > 0) {
                //se encotro el documento creado en migra_images
                echo $SQLS . "<br>se encotro el documento creado en migra_images<br>";
                $id_client = $consulta['id'];
                $fecha_creacion = date('Y-m-d');
                $SQLSU = "UPDATE migra_images
						 SET status = 1, id_client = $id_client, fecha_creacion = '$fecha_creacion'
						 WHERE document = '$document'";
                if ($conexion->ejecutar($SQLSU)) {
                    //se ejecuto la actualizacion el client en migra_images
                    echo $SQLSU . "<br>se ejecuto la actualizacion el client en migra_images<br><br>";
                    fwrite($fp, "$document;$firstnameC;FCLIENT_FMIGRAIMG_UMIGRAIMG_GOOD;$fuente" . PHP_EOL);
                } else {
                    //no se ejecuto la actualizacion el client en migra_images
                    echo $SQLSU . "<br>no se ejecuto la actualizacion el client en migra_images<br><br>";
                    fwrite($fp, "$document;$firstnameC;FCLIENT_FMIGRAIMG_UMIGRAIMG_FAIL;$fuente" . PHP_EOL);
                }
            } else {
                //no se encotro el documento creado en migra_images
                echo $SQLS . "<br>no se encotro el documento creado en migra_images<br><br>";
                fwrite($fp, "$document;$firstnameC;NO EXISTE EN MIGRACION;$fuente" . PHP_EOL);
            }
        } else {
            //no se encontro el documento creado en clientes client
            echo $SQL . "<br>no se encontro el documento creado en clientes client<br>";
            $SQLN = "SELECT * 
					 FROM migra_images
					 WHERE document = '$document'";
            $conexion->consultar($SQLN);
            if ($conexion->getNumeroRegistros() > 0) {
                //se encontro el cliente con imagenes en migracion migra_images
                echo $SQLN . "<br>se encontro el cliente con imagenes en migracion migra_images<br>";
                $conexionNI = new Conexion();
                $SQLNI = "INSERT INTO client
						 (
						 	document, persontype, firstname, type, flag, capi, status_migracion, status_form
						 )
						 VALUES
						 (
						 	'$document', 0, '$firstnameC', 'SGV', 'MIGRACION_IDENTICO', 'No', 'Activo', 'Activo'
						 )";
                if ($conexionNI->ejecutar($SQLNI)) {
                    //se ejecuto la insercion en client
                    echo $SQLNI . "<br>se ejecuto la insercion en client<br>";
                    $id_clientu = $conexionNI->ultimaId();
                    $SQLNU = "UPDATE migra_images
							 SET status = 1, id_client = $id_clientu, fecha_creacion = '$fecha_creacion'
							 WHERE document = '$document'";
                    if ($conexionNI->ejecutar($SQLNU)) {
                        //se ejecuto la actualizacion el client en migra_images
                        echo $SQLNU . "<br>se ejecuto la actualizacion el client en migra_images<br><br>";
                        fwrite($fp, "$document;$firstnameC;FMIGRAIMG_ICLIENT-GOOD_UMIGRAIMG-GOOD;$fuente" . PHP_EOL);
                    } else {
                        //no se ejecuto la actualizacion el client en migra_images
                        echo $SQLNU . "<br>no se ejecuto la actualizacion el client en migra_images<br><br>";
                        fwrite($fp, "$document;$firstnameC;FMIGRAIMG_ICLIENT-FAIL_UMIGRAIMG-FAIL;$fuente" . PHP_EOL);
                    }
                } else {
                    //no se ejecuto la insercion
                    echo $SQLNI . "<br>no se ejecuto la insercion<br><br>";
                    fwrite($fp, "$document;$firstnameC;ICLIENT-FAIL;$fuente" . PHP_EOL);
                }
            } else {
                //no encontro el cliente con imagenes en migracion migra_images
                echo $SQLN . "<br>no encontro el cliente con imagenes en migracion migra_images<br><br>";
                fwrite($fp, "$document;$firstnameC;NO EXISTE EN MIGRACION;$fuente" . PHP_EOL);
            }
        }
    }
    fclose($fp);
    echo "TERMINO...";
}

function updateClientidMigraImagenes() {
    $conexion = new Conexion();
    $SQL = "SELECT document 
			FROM  migra_images
			GROUP BY document";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        $conexion1 = new Conexion();
        while ($consulta = $conexion->sacarRegistro()) {
            $document = $consulta['document'];
            $SQLF = "SELECT id
					 FROM client
					 WHERE document = '$document'";
            $conexion1->consultar($SQLF);
            if ($conexion1->getNumeroRegistros() > 0) {
                $consul1 = $conexion1->sacarRegistro();
                $id_client = $consul1['id'];
                $SQLU = "UPDATE migra_images
						 SET id_client = $id_client
						 WHERE document = '$document'";
                if ($conexion1->ejecutar($SQLU)) {
                    echo "SE EJECUTO LA ACTUALIZACION<br>" . $SQLU . "<br><br>";
                } else
                    echo "NO SE EJECUTO LA ACTUALIZACION<br>" . $SQLU . "<br><br>";
            }else {
                echo "NO SE ENCONTRARON CLIENTES CON EL NUMERO DE DOCUMENTO $document<br>" . $SQLF . "<br><br>";
            }
        }
    }
}

function updateClientidWorkFlow() {
    //echo "ACA<br>";
    $conexion = new Conexion();
    $fp = fopen("updateClientidWorkFlow/updateClientidWorkFlow_salida.csv", "a");
    fwrite($fp, "Documento;Nombre / Razon social;Accion o estado" . PHP_EOL);
    $SQL = "SELECT documento, nombre 
			FROM  workflow
			WHERE id_client = 0";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        $conexion1 = new Conexion();
        while ($consulta = $conexion->sacarRegistro()) {
            $document = $consulta['documento'];
            $nombre = $consulta['nombre'];
            $SQLF = "SELECT id
					 FROM client
					 WHERE document = '$document'";
            $conexion1->consultar($SQLF);
            if ($conexion1->getNumeroRegistros() == 1) {
                /* $consul1 = $conexion1->sacarRegistro();
                  $id_client = $consul1['id'];
                  $SQLU = "UPDATE workflow
                  SET id_client = $id_client
                  WHERE documento = '$document'
                  AND nombre = '$nombre'";
                  if($conexion1->ejecutar($SQLU)){
                  echo "SE EJECUTO LA ACTUALIZACION<br>".$SQLU."<br><br>";
                  }else
                  echo "NO SE EJECUTO LA ACTUALIZACION<br>".$SQLU."<br><br>"; */
                fwrite($fp, "$document;$nombre;Un Registros" . PHP_EOL);
            } else {
                $cant = $conexion1->getNumeroRegistros();
                if ($cant < 1) {
                    echo "NO SE ENCONTRARON CLIENTES CON EL NUMERO DE DOCUMENTO $document<br>" . $SQLF . "<br><br>";
                    fwrite($fp, "$document;$nombre;Sin Registros" . PHP_EOL);
                } else {
                    echo "SE ENCONTRARON $cant CLIENTES CON EL NUMERO DE DOCUMENTO $document<br>" . $SQLF . "<br><br>";
                    fwrite($fp, "$document;$nombre;Mas de un Registros" . PHP_EOL);
                }
            }
        }
    } else
        echo "NO ENCONTRO REGISTROS<br>";
    echo "TERMINO...";
}

function activarClientesMigracion() {
    $conexion = new Conexion();
    $SQL = "SELECT t1.id 
			FROM clientes_migracion AS t1 
			LEFT OUTER JOIN form AS t2 ON(t1.id = t2.id_client) 
			LEFT OUTER JOIN workflow_migracion AS t3 ON(t1.id = t3.id_client)
			WHERE t2.id IS NULL
			AND t3.id IS NULL";
    echo $SQL . "<br><br>";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        $conexion2 = new Conexion();
        while ($consulta = $conexion->sacarRegistro()) {
            $id = $consulta[0];
            $SQL1 = "UPDATE clientes_migracion SET estado = 0 WHERE id = $id";
            echo $SQL1 . "<br>";
            if ($conexion2->ejecutar($SQL1)) {
                echo "ACTUALIZADO<br><br>";
            } else {
                echo "NO_ACTUALIZADO<br><br>";
            }
        }
    }
}

function updateOficiales() {
    $conexion = new Conexion();
    $SQL1 = "UPDATE official SET id = 0";
    $SQL = "SELECT identificacion 
			FROM  official
			WHERE 1";
    $conexion->ejecutar($SQL1);
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        while ($consulta = $conexion->sacarRegistro()) {
            $conexion1 = new Conexion();
            $identificacion = $consulta[0];
            $SQLF = "SELECT id
					 FROM user
					 WHERE identificacion = '$identificacion'";
            echo $SQLF . "<br>";
            $conexion1->consultar($SQLF);
            $cant = $conexion1->getNumeroRegistros();
            if ($cant == 1) {
                $consulta1 = $conexion1->sacarRegistro();
                $id = $consulta1[0];
                $SQLU = "UPDATE official
						 SET id = $id
						 WHERE identificacion = '$identificacion'";
                echo $SQLU . "<br>";
                if ($conexion1->ejecutar($SQLU)) {
                    echo "SE ACTUALIZO LA IDENTIFICACION $identificacion<br><br>";
                } else {
                    echo "NO SE PUDO ACTUALIZAR LA IDENTIFICACION $identificacion<br><br>";
                }
            } else {
                if ($cant < 1) {
                    echo "NO TIENE REGISTROS LA IDENTIFICACION $identificacion<br><br>";
                } else {
                    echo "TIENE MAS DE UN REGISTRO LA IDENTIFICACION $identificacion<br><br>";
                }
            }
        }
        echo "TERMINO";
    }
}

function udateClientesMigracio() {
    $conexion = new Conexion();
    $SQL = "SELECT documento 
			FROM  clientes_migracion
			WHERE id = 0";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        while ($consulta = $conexion->sacarRegistro()) {
            $conexion1 = new Conexion();
            $documento = $consulta[0];
            $SQL1 = "SELECT id FROM client WHERE document = '$documento'";
            echo $SQL1 . "<br>";
            $conexion1->consultar($SQL1);
            if ($conexion1->getNumeroRegistros() == 1) {
                $consulta1 = $conexion1->sacarRegistro();
                $id = $consulta1[0];
                $SQLU = "UPDATE clientes_migracion SET id = $id WHERE documento = '$documento'";
                echo $SQLU . "<br>";
                if ($conexion1->ejecutar($SQLU))
                    echo "SE ACTUALIZO DOCUMENTO NUMERO $documento<br><br>";
                else
                    echo "NO ACTUALIZADO DOCUMENTO $documento<br><br>";
            } else
                echo "MAS DE UN ID<br><br>";
        }
    }
}

function cargueMasivoDevoluciones() {
    $conexion = new Conexion();
    $temp = file('files/cargueMasivoDevoluciones/cargueMasivoDevoluciones3.csv');
    $fp = fopen("files/cargueMasivoDevoluciones/cargueMasivoDevoluciones_salida3.csv", "a");
    fwrite($fp, "ID;FECHAC;NOMBRE;DOCUMENTO;ACCION" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    $documentos = array();
    $causales = array();
    $oficiales = array();
    $observaciones = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        $persontype = trim($datos_leer[1]);
        $id_sucursal = trim($datos_leer[3]);
        $id_official = trim($datos_leer[5]);
        $documento = trim($datos_leer[6]);
        $name = trim($datos_leer[7]);
        $causal = trim($datos_leer[8]);
        $observacion = trim($datos_leer[9]);
        $lote = trim($datos_leer[10]);
        $planilla = trim($datos_leer[11]);
        $SQL = "INSERT INTO workflow
				(
					id_user, causal, id_official, observation, status, persontype, documento, nombre, id_sucursal, id_area, lote
				)
				VALUES
				(
					2090, '$causal', $id_official, '$observacion', 1, $persontype, '$documento', '$name', $id_sucursal, $id_sucursal, $lote
				)";
        if ($conexion->ejecutar($SQL)) {
            $ultimaId = $conexion->ultimaId();
            fwrite($fp, "$ultimaId;26/03/2013;$name;$documento;INSERTADO" . PHP_EOL);
            //enviarMailDevolucion($causal, $id_official, $observacion, $documento);
            $documentos[] = $documento;
            $causales[] = $causal;
            $oficiales[] = $id_official;
            $observaciones[] = $observacion;
        } else {
            fwrite($fp, "0;26/03/2013;$name;$documento;NOINSERTADO" . PHP_EOL);
        }
    }
    enviarMailDevolucion($documentos, $causales, $oficiales, $observaciones);
}

function enviarMailDevolucion($documentos, $causales, $oficiales, $observaciones) {
    $offici = new Official();
    $mail = new PHPMailer();
    $tam = count($documentos);
    $body = "";
    for ($i = 0; $i < $tam; $i++) {
        $body .= "
	    <p>Tienes una nueva devolución en Doc Finder, a continuación se presentan los detalles del caso.</p>
	    <p>Tipo: Devolución.</p>
	    <p>Causal: " . $causales[$i] . "</p>
	    <p>Cliente: " . $documentos[$i] . "</p>		
	    <p>Observación: " . utf8_encode($observaciones[$i]) . "</p>";
        foreach ($observaciones[$i] as $t)
            $body.="<br>" . $t;
        $body.= "<p>Caso creado por: " . $_SESSION['name'] . "</p>
	    <p>Fecha de creación: " . date("Y-m-d h:m:s") . "</p>  
	    <p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p><br /><br />";
    }

    $mail->IsSendmail();
    $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'App Doc Finder');
    $mail->Subject = "Tienes un nuevo caso en Doc Finder.";

    $mail->MsgHTML($body);
    //$address = $data_official['email'];
    //$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel Chico");
    $ultimoofi = 0;
    foreach ($oficiales as $id_official) {
        # code...
        $data_official = mysqli_fetch_array($offici->getOfficial($id_official));
        $address = $data_official['email'];
        if ($id_official != $ultimoofi) {
            $mail->AddAddress($address, $data_official['name']);
            if ($data_official['email_father'] != "")
                $mail->AddCC($data_official['email_father']);
        }
        $ultimoofi = $id_official;
    }
    //$mail->AddAddress("jackeline.gutierrez@ui.colpatria.com", "Jackeline Gutierrez");
    $mail->AddAddress("operacioncolpatria@finlecobpo.com", "App Doc Finder");

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        //echo "aca";
    }
}

function getTipoDocumento($tipoin) {
    $return = 'Cedula Ciudadania';
    switch ($tipoin) {
        case 'C':
            $return = 'Cedula Ciudadania';
            break;
        case 'E':
            $return = 'Cedula extranjeria';
            break;
        case 'P':
            $return = 'Pasaporte';
            break;
        case 'N':
            $return = 'NIT';
            break;
        case 'T':
            $return = 'Tarjeta de identidad';
            break;

        default:
            $return = 'Cedula Ciudadania';
            break;
    }
    return $return;
}

function getCiudad($idciudad) {
    $ciudad = '';
    $conexion = new Conexion();
    $SQL = "SELECT description FROM param_ciudad WHERE id = $idciudad";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() == 1) {
        $consulta = $conexion->sacarRegistro();
        $ciudad = $consulta['description'];
    } else {
        $ciudad = 'SD';
    }
    return $ciudad;
}

function getCiudadDANE($idciudad) {
    $ciudad = '';
    if (strlen($idciudad) == 4)
        $idciudad = '0' . $idciudad;
    $conexion = new Conexion();
    $SQL = "SELECT ciudad FROM param_ciudadesdane WHERE cod_dane = $idciudad";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() == 1) {
        $consulta = $conexion->sacarRegistro();
        $ciudad = $consulta['ciudad'];
    } else {
        $ciudad = 'SD';
    }
    return $ciudad;
}

function formatTiffChangue() {
    /* $fp = fopen("files/formatTiffChangue/formatTiffChangue_salida1.csv","a");
      fwrite($fp, "DOCUMENTO;ID;ESTADO".PHP_EOL); */
    $conexion = new Conexion();
    $SQL = "SELECT documento, id FROM clientes_migracion WHERE estado = 0 AND id != 0 ORDER BY documento"; //7221373
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        $str = "/var/www/html/migracion/";
        while ($consulta = $conexion->sacarRegistro()) {
            # code...
            $conexion2 = new Conexion();
            $documento = $consulta['documento'];
            $id_client = $consulta['id'];
            $doc = $documento[0];
            $dir = $str . $doc . "/" . $documento . "/";
            //echo "mogrify -format tiff ".$dir."*.jpg<br>";
            echo "convert " . $dir . "*.tiff -compress LZW " . $dir . $documento . "MULTI.tiff<br>";
            //exec("mogrify -format tiff ".$dir."*.jpg");
            exec("convert " . $dir . "*.tiff  -compress LZW " . $dir . $documento . "MULTI.tiff");
            /* $SQLI = "INSERT INTO migra_images
              (
              document, id_client, filename, status
              )
              VALUES
              (
              '$documento', $id_client, '".$documento."MULTI.tiff', 1
              )";
              echo $SQLI."<br>";
              if($conexion2->ejecutar($SQLI)){
              echo "LA INSERSION SE EJECUTO DEL ID $id_client<br>";
              fwrite($fp, "$documento;$id_client;INSERTADO".PHP_EOL);
              }else{
              echo "NO SE EJECUTO LA INSERSION DEL ID $id_client<br>";
              fwrite($fp, "$documento;$id_client;NOINSERTADO".PHP_EOL);
              } */

            /* $SQLU = "UPDATE migra_images 
              SET filename = REPLACE(filename, '.jpg', '.tiff')
              WHERE id_client = $id_client
              AND filename LIKE '%.jpg'";
              echo $SQLU."<br><br>";
              if($conexion2->ejecutar($SQLU)){
              echo "LA ACTUALIZACION SE EJECUTO DEL ID $id_client<br><br>";
              fwrite($fp, "$documento;$id_client;ACTUALIZADO".PHP_EOL);
              }else{
              echo "NO SE EJECUTO LA ACTUALIZACION DEL ID $id_client<br><br>";
              fwrite($fp, "$documento;$id_client;NOACTUALIZADO".PHP_EOL);
              } */
        }
        //fclose($fp);
        echo "TERMINO...";
        /* $documento = '7221373';
          $dir = $str.$documento[0]."/".$documento."/";
          exec("mogrify -format tiff ".$dir."*.jpg");
          exec("convert ".$dir."*.tiff ".$dir.$documento."MULTI.tiff"); */
    }
}

function usuariosYOficiales() {
    $conexion = new Conexion();
    $temp = file('files/usuariosYOficiales/usuariosYOficiales3.csv');
    $fp = fopen("files/usuariosYOficiales/usuariosYOficiales_salida3.csv", "a");
    fwrite($fp, "ID;FECHAC;NOMBRE;DOCUMENTO;APLICATIVO;GRUPO;EMAIL;FATHER;EFATHER;USER;ESTADO_U;ESTADO_O" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 0; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);

        /* $name = trim($datos_leer[1]);//Jimenez Bedoya, Yuli Caterine
          $namep = explode(',', $name);//[0]Jimenez Bedoya[1] Yuli Caterine
          $namecomple = trim($namep[1]).' '.trim($namep[0]); */
        $namecomple = trim($datos_leer[1]); //B

        $document = trim($datos_leer[2]); //C
        $permisos = trim($datos_leer[4]); //E
        $correo = trim($datos_leer[5]); //F
        $father = trim($datos_leer[6]); //G
        $correopadre = trim($datos_leer[7]); //H
        $usuario = 'ECOL' . substr($document, -4); //I
        //$usuario = trim($datos_leer[8]);//I
        $SQL = "SELECT * FROM user WHERE identificacion = '$document'";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() == 1) {
            //existe el usuario con $ducumento
            $consulta = $conexion->sacarRegistro();
            $id = $consulta['id'];
            $username = $consulta['username'];
            $fecha_creacion = $consulta['date_created'];
            $SQLU1 = "UPDATE user SET name = '$namecomple', correoelectronico = '$correo', sucursal = 'COLPATRIA_MASIVO' WHERE id = $id";
            $uus = '';
            /* if($conexion->ejecutar($SQLU1)){
              $uus = 'USER-UG';
              }else{
              $uus = 'USER-UE';
              }
              $SQL1 = "SELECT * FROM official_temp WHERE identificacion = '$document'";
              $conexion->consultar($SQL1);
              $cant = $conexion->getNumeroRegistros();
              if($cant == 1){
              $SQLU = "UPDATE official_temp
              SET id = $id, name = '$namecomple', email = '$correo', email_father = '$correopadre', status = 2
              WHERE identificacion = '$document'";
              if($conexion->ejecutar($SQLU)){
              fwrite($fp, "$id;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;$uus;OFICIAL-UG".PHP_EOL);
              }else{
              fwrite($fp, "$id;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;$uus;OFICIAL-UE".PHP_EOL);
              }
              }else{
              if($cant == 0){
              $SQLI = "INSERT INTO official_temp
              (
              id, identificacion, name, email, email_father, status
              )
              VALUES
              (
              $id, '$document', '$namecomple', '$correo', '$correopadre', 2
              )";
              if($conexion->ejecutar($SQLI)){
              fwrite($fp, "$id;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;$uus;OFICIAL-IG".PHP_EOL);
              }else{
              fwrite($fp, "$id;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;$uus;OFICIAL-IE".PHP_EOL);
              }
              }else
              echo "documento $document mas de una vez en oficiales<br><br>";
              } */
        } else {
            //no existe el usuario con $ducumento
            if ($conexion->getNumeroRegistros() == 0) {
                $uus = '';
                $SQLI = "INSERT INTO user
						 (
						 	id_group, username, password, identificacion, name, status, sucursal, correoelectronico
						 )
						 VALUES
						 (
						 	2, '$usuario', '$document', '$document', '$namecomple', 1, 'COLPATRIA_MASIVO_15012014', '$correo'
						 )";
                echo $SQLI . "<br>";
                if ($conexion->ejecutar($SQLI)) {
                    $ultimaId = $conexion->ultimaId();
                    $SQLI1 = "INSERT INTO official
							 (
							 	id, identificacion, name, email, email_father, status
							 )
							 VALUES
							 (
							 	$ultimaId, '$document', '$namecomple', '$correo', '$correopadre', 0
							 )";
                    echo $SQLI1 . "<br><br>";
                    if ($conexion->ejecutar($SQLI1)) {
                        $uus = 'USER-IG';
                        fwrite($fp, "$ultimaId;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;$uus;OFICIAL-IG" . PHP_EOL);
                    } else {
                        $uus = 'USER-IE';
                        fwrite($fp, "$ultimaId;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;$uus;OFICIAL-IE" . PHP_EOL);
                    }
                } else {
                    fwrite($fp, "NULL;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;USER-IE;OFICIAL-IE" . PHP_EOL);
                }
            } else {
                echo "creado mas de una vez<br><br>";
            }
        }
    }
    fclose($fp);
    echo "TERMINO...";
}

function crearXls($arrays) {
    //,'E');
    $nombre_doc = '';
    $col = 3;
    $objPHPExcel = new PHPExcel();
    // Set properties
    $objPHPExcel->getProperties()->setCreator("FinlecoBPO");
    $objPHPExcel->getProperties()->setLastModifiedBy("FinlecoBPO");
    $objPHPExcel->getProperties()->setTitle("Reporte Listado de Clientes");
    $objPHPExcel->getProperties()->setSubject("Reporte Listado de Clientes");
    $objPHPExcel->getProperties()->setDescription("Reporte Listado de Clientes, generated using PHP classes.");
    //agregar datos	
    //
	$styleArray1 = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'EB8F00'),
        )
    );
    //
    $hoja_activa = 0;
    $tam_obj = count($arrays);
    for ($n = 0; $n < $tam_obj; $n++) {
        $array = $arrays[$n];
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex($hoja_activa);

        $col_name_can = count($array[2]);
        $col_name = $array[2];
        $col_campos = $array[1];
        $objetos = $array[0];
        $titulo = $array[3];
        $nombre_doc = $array[4];
        for ($i = 0; $i < $col_name_can; $i++) {
            $objPHPExcel->getActiveSheet()->SetCellValue($col_name[$i] . $col, $col_campos[$i]);
            $objPHPExcel->getActiveSheet()->getStyle($col_name[$i] . $col)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle($col_name[$i] . $col)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
            $objPHPExcel->getActiveSheet()->getStyle($col_name[$i] . $col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $objPHPExcel->getActiveSheet()->getStyle($col_name[$i] . $col)->applyFromArray($styleArray1);
            $objPHPExcel->getActiveSheet()->getColumnDimension($col_name[$i])->setAutoSize(true);
        }
        //
        $col++;
        foreach ($objetos as $objeto) {
            for ($j = 0; $j < $col_name_can; $j++) {
                $objPHPExcel->getActiveSheet()->SetCellValue($col_name[$j] . $col, htmlentities($objeto[$j]));
            }
            $col++;
        }
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_DOTTED
                )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle($col_name[0] . '3:' . $col_name[($col_name_can - 1)] . ($col - 1))->applyFromArray($styleArray);


        $objPHPExcel->getActiveSheet()->setTitle($titulo);
        $hoja_activa++;
        $col = 3;
    }
    // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
    $objPHPExcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=' . $nombre_doc . '.xls');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}

function updateWorkflowPersontype() {
    $conexion = new Conexion();
    $SQL = "SELECT * FROM `workflow` AS t1
			LEFT OUTER JOIN client AS t2 ON(t1.documento = t2.document)
			WHERE t1.persontype = 0
			AND t1.estado = 0
			AND t2.id IS NOT NULL";
    echo $SQL . "<br>";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        while ($consulta = $conexion->sacarRegistro()) {
            $conexion1 = new Conexion();
            $documentcons = $consulta[17];
            $persontype = $consulta[18];
            $namepart = explode(' ', $consulta[10]);
            $name = trim($namepart[0]);
            $SQL1 = "SELECT * FROM client 
					 WHERE document = '$documentcons'
					 AND firstname LIKE '%$name%'";
            echo $SQL1 . "<br>";
            $conexion1->consultar($SQL1);
            $cant1 = $conexion1->getNumeroRegistros();
            if ($cant1 == 1) {
                $SQL2 = "UPDATE workflow 
						 SET persontype = $persontype
						 WHERE documento = '$documentcons'
					 	 AND nombre = '$name'";
                echo $SQL2 . "<br>";
                if ($conexion1->ejecutar($SQL2))
                    echo "ACTUALIZADO<br>";
                else
                    echo "NO_ACTUALIZADO<br>";

                echo "EXACTAMENTE UN REGISTRO<br><br>";
            }elseif ($cant1 > 1) {
                echo "MAS DE UN REGISTRO<br><br>";
            } else
                echo "CERO REGISTROS<br><br>";
        }
    }
}

function updateGestionesFormFecha() {
    $conexion = new Conexion();
    $temp = file('files/updateGestionesFormFecha/updateGestionesFormFecha16.csv');
    $fp = fopen("files/updateGestionesFormFecha/updateGestionesFormFecha_salida16.csv", "a");
    fwrite($fp, "DOCUMENTO;PLANILLA;LOTE;FECHAVIEJA;FECHANUEVA;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $planilla = trim($datos_leer[1]);
        $lote = trim($datos_leer[2]);

        $fec1 = explode(' ', trim($datos_leer[3]));
        //$fec1 = explode(' ', trim($datos_leer[2]));
        $fech1 = explode('/', $fec1[0]);
        $fecha = $fech1[2] . "-" . $fech1[1] . "-" . $fech1[0] . " " . $fec1[1];

        //$fec2 = explode(' ', trim($datos_leer[4]));
        $fech2 = explode('/', trim($datos_leer[4]));
        $fecha1 = $fech2[2] . "-" . $fech2[1] . "-" . $fech2[0] . " " . $fec1[1];

        $SQL = "SELECT t1.id FROM form AS t1
				INNER JOIN client AS t2 ON(t1.id_client = t2.id)
				WHERE t2.document = '$documento'
				AND t1.log_lote = $lote
				AND t1.log_planilla = $planilla
				AND t1.date_created LIKE '$fecha%'
				AND t1.status = 1";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        if ($cant == 1) {
            echo "exactamente un resultado<br>";
            while ($consulta = $conexion->sacarRegistro()) {
                $comple = "";
                /* if ($planilla == '550') {
                  $comple = ", log_planilla = '694', planilla = 'PLANILLA694'";
                  } */
                $SQLU = "UPDATE form 
						 SET date_created = REPLACE(date_created, '$fecha', '$fecha1')$comple
						 WHERE id = " . $consulta[0];
                echo $SQLU . "<br><br>";
                if ($conexion->ejecutar($SQLU)) {
                    fwrite($fp, "$documento;$planilla;$lote;$fecha;$fecha1;ACTUALIZADO" . PHP_EOL);
                    echo "ACTUALIZADO<br><br>";
                } else {
                    fwrite($fp, "$documento;$planilla;$lote;$fecha;$fecha1;NO_ACTUALIZADO" . PHP_EOL);
                    echo "NO_ACTUALIZADO<br><br>";
                }
            }
            //echo "<br>";
        } else {
            if ($cant == 0) {
                echo "cero resultado<br><br>";
                fwrite($fp, "$documento;$planilla;$lote;$fecha;$fecha1;NO_ENCONTRADO" . PHP_EOL);
            } else {
                echo "mas de un resultado<br><br>";
                fwrite($fp, "$documento;$planilla;$lote;$fecha;$fecha1;MAS_DE_UNRESULTADO:$cant" . PHP_EOL);
            }
        }
    }
    echo "<br><br>Termino...";
}

function updateGestionesFormPlanilla() {
    $conexion = new Conexion();
    $temp = file('files/updateGestionesFormPlanilla/updateGestionesFormPlanilla1.csv');
    $fp = fopen("files/updateGestionesFormPlanilla/updateGestionesFormPlanilla_salida1.csv", "a");
    fwrite($fp, "DOCUMENTO;LOTE;PLANILLAVIEJA;PLANILLANUEVA;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $lote = trim($datos_leer[1]);
        $planilla = trim($datos_leer[2]);
        $new_planilla = trim($datos_leer[3]);

        $SQL = "SELECT t1.id FROM form AS t1
				INNER JOIN client AS t2 ON(t1.id_client = t2.id)
				WHERE t2.document = '$documento'
				AND t1.log_lote = $lote
				AND t1.log_planilla = $planilla
				AND t1.status = 1";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        if ($cant == 1) {
            echo "exactamente un resultado<br>";
            while ($consulta = $conexion->sacarRegistro()) {
                $comple = "";
                /* if ($planilla == '550') {
                  $comple = ", log_planilla = '694', planilla = 'PLANILLA694'";
                  } */
                $SQLU = "UPDATE form 
						 SET log_planilla = '$new_planilla', planilla = 'PLANILLA$new_planilla'
						 WHERE id = " . $consulta[0];
                echo $SQLU . "<br>";
                if ($conexion->ejecutar($SQLU)) {
                    fwrite($fp, "$documento;$lote;$planilla;$new_planilla;ACTUALIZADO" . PHP_EOL);
                    echo "ACTUALIZADO<br><br>";
                } else {
                    fwrite($fp, "$documento;$lote;$planilla;$new_planilla;NO_ACTUALIZADO" . PHP_EOL);
                    echo "NO_ACTUALIZADO<br><br>";
                }
            }
            //echo "<br>";
        } else {
            if ($cant == 0) {
                echo "cero resultado<br><br>";
                fwrite($fp, "$documento;$lote;$planilla;$new_planilla;NO_ENCONTRADO" . PHP_EOL);
            } else
                echo "mas de un resultado<br><br>";
        }
    }
    echo "<br><br>Termino...";
}

function updateGestionesFormFecha_doc() {
    $conexion = new Conexion();
    $temp = file('files/updateGestionesFormFecha_doc/updateGestionesFormFecha_doc3.csv');
    $fp = fopen("files/updateGestionesFormFecha_doc/updateGestionesFormFecha_doc_salida3.csv", "a");
    fwrite($fp, "IDCONFIRM;DOCUMENTO;FECHAVIEJA;FECHANUEVA;CANTIDAD;ACCION;CAMPANA" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);

        //$fec1 = explode(' ', trim($datos_leer[2]));
        $fec1 = explode(' ', trim($datos_leer[3]));
        $fech1 = explode('/', $fec1[0]);
        $fecha1 = $fech1[2] . "-" . $fech1[1] . "-" . $fech1[0] . " " . $fec1[1];

        $fech2 = explode('/', trim($datos_leer[4]));
        $fecha = $fech2[2] . "-" . $fech2[1] . "-" . $fech2[0] . " " . $fec1[1];

        //$id_usuario = trim($datos_leer[2]);
        $tipocontacto = trim($datos_leer[2]);
        $idconfirm = 0;

        $SQL = "SELECT t1.id, t1.id_user FROM data_confirm AS t1
				INNER JOIN client AS t2 ON(t1.id_client = t2.id)
				WHERE t2.document = '$documento'
				AND t1.date_created LIKE '$fecha1%'
				AND t1.id_contact = $tipocontacto";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        if ($cant == 1) {
            echo "exactamente un resultado SEGURO<br>";
            //echo "<br>";
            $consulta = $conexion->sacarRegistro();
            $idconfirm = $consulta[0];
            $id_us_old = $consulta[1];
            /* $SQLU = "UPDATE data_confirm 
              SET date_created = REPLACE(date_created, '$fecha', '$fecha1')
              WHERE id = ".$consulta[0]; */
            $SQLU = "UPDATE data_confirm 
					 SET date_created = REPLACE(date_created, '$fecha1', '$fecha')
					 WHERE id = $idconfirm";
            echo $SQLU . "<br><br>";
            if ($conexion->ejecutar($SQLU)){
              echo "ACTUALIZADO<br><br>";
              fwrite($fp, "$idconfirm;$documento;$fecha1;$fecha;1;ACTUALIZADO;SEGUROS".PHP_EOL);
              }else{
              fwrite($fp, "$idconfirm;$documento;$fecha1;$fecha;1;NO_ACTUALIZADO;SEGUROS".PHP_EOL);
              echo "NO_ACTUALIZADO<br><br>";
              }
        } else {
            if ($cant == 0) {
                //echo "cero resultado<br><br>";
                $SQL2 = "SELECT t1.id, t1.id_user FROM data_capi_confirm AS t1
						INNER JOIN client AS t2 ON(t1.id_client = t2.id)
						WHERE t2.document = '$documento'
						AND t1.date_created LIKE '$fecha1%'
						AND t1.id_contact = $tipocontacto";
                echo $SQL2 . "<br>";
                $conexion->consultar($SQL2);
                $cant = $conexion->getNumeroRegistros();
                if ($cant == 1) {
                    echo "exactamente un resultado CAPI<br>";
                    $cont = 1;
                    /*while ($consulta = $conexion->sacarRegistro()) {
                        $idconfirm = $consulta[0];
                        $id_us_old = $consulta[1];
                        $SQLU = "UPDATE data_capi_confirm 
								 SET date_created = REPLACE(date_created, '$fecha1', '$fecha')
								 WHERE id = $idconfirm";
                        echo $SQLU . "<br><br>";
                        if ($conexion->ejecutar($SQLU)) {
                            fwrite($fp, "$idconfirm;$documento;$fecha;$fecha1;$cont;ACTUALIZADO;CAPI" . PHP_EOL);
                            echo "ACTUALIZADO<br><br>";
                        } else {
                            fwrite($fp, "$idconfirm;$documento;$fecha;$fecha1;$cont;NO_ACTUALIZADO;CAPI" . PHP_EOL);
                            echo "NO_ACTUALIZADO<br><br>";
                        }
                        $cont++;
                    }*/
                } else {
                    if ($cant == 0) {
                        //fwrite($fp, "$idconfirm;$documento;$fecha;$fecha1;1;NO_ACTUALIZADO;CAPI" . PHP_EOL);
                        echo "cero resultado CAPI<br><br>";
                    } else
                        echo "mas de un resultado CAPI<br><br>";
                }
            } else
                echo "mas de un resultado SEGURO<br><br>";
        }
    }
    echo "<br><br>Termino...";
}

function updateFechasMigracion() {
    $documentos = array(16483456, 14891460, 80275145, 51787833, 51787833, 41786531, 17303594, 79795015, 91177275, 1032364903, 1032364903, 1032364903, 1032364903, 1032364903, 2549912, 2549912, 1032370647, 5638289, 52325164, 16211570, 70124334, 39775700, 41373556, 51870435, 10016080, 17586811, 79708077, 79542520, 2192932, 18506446, 79598368, 468598, 1332134, 2103474, 2890795, 2908359, 5958293, 6776025, 7166429, 7535343, 10130449, 10236628, 11231394, 18510553, 20142649, 134373, 13700949);
    $fp = fopen("files/updateFechasMigracion/updateFechasMigracion_salida1.csv", "a");
    fwrite($fp, "DOCUMENTO;FECHA_ACTUAL;FECHA_QUE_QUEDO;ESTADO" . PHP_EOL);
    foreach ($documentos as $key) {
        $conexion = new Conexion();
        $SQL = "SELECT *, t3.document AS document_client FROM form AS t1 
			LEFT OUTER JOIN data AS t2 ON(t1.id = t2.id_form)
			INNER JOIN client AS t3 ON(t1.id_client = t3.id)
			WHERE t1.type = 'FORMULARIO_MIGRACION'
			AND t2.id IS NOT NULL
			AND t3.document = '$key'
			LIMIT 1";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        if ($cant > 0) {
            $conexion1 = new Conexion();
            while ($consulta = $conexion->sacarRegistro()) {
                $id_form = $consulta[0];
                $date_created = explode(' ', $consulta[5]);
                $dtc_date = $date_created[0];
                $fechasolicitud = $consulta[16];
                $documento = $consulta[27];
                $document = $consulta['document_client'];
                if (strlen($fechasolicitud) == 10) {
                    $SQLU = "UPDATE form SET date_created = REPLACE(date_created, '$dtc_date', '$fechasolicitud') 
						 WHERE id = $id_form";
                    echo $SQLU . "<br><br>";
                    if ($conexion1->ejecutar($SQLU)) {
                        fwrite($fp, "$documento;$dtc_date;$fechasolicitud;ACTUALIZADO" . PHP_EOL);
                    } else {
                        fwrite($fp, "$documento;$dtc_date;$fechasolicitud;NO_ACTUALIZADO" . PHP_EOL);
                    }
                } else {
                    echo "$key: $fechasolicitud _ NO SE PUEDE ACTUALIZAR<br><br>";
                    //fwrite($fp, "$document;$dtc_date;$fechasolicitud;NO_ACTUALIZADO".PHP_EOL);
                }
            }
            //echo "TERMINO...";
        }
    }
    fclose($fp);
}

function updateIngresosEgresosMigracion() {
    $temp = file('files/updateIngresosEgresosMigracion/updateIngresosEgresosMigracion.csv');
    $fp = fopen("files/updateIngresosEgresosMigracion/updateIngresosEgresosMigracion_salida.csv", "a");
    fwrite($fp, "DOCUMENTO;IDINGRESOANTERIOR;IDINGRESOACTUAL;IDEGRESOANTERIOR;IDEGRESOACTUAL;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $conexion = new Conexion();
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[1]);
        $ingresos = trim($datos_leer[3]);
        $egresos = trim($datos_leer[5]);
        $SQL = "SELECT t1.id, t4.ingresosmensuales, t4.egresosmensuales 
				FROM form AS t1
				LEFT OUTER JOIN client AS t2 ON(t1.id_client = t2.id)
				INNER JOIN data AS t4 ON(t1.id = t4.id_form)
				WHERE t2.document = '$documento'
				AND t1.type = 'FORMULARIO_MIGRACION'
				AND t1.status = 1
				GROUP BY t1.id";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        if ($cant == 1) {
            $consulta = $conexion->sacarRegistro();
            $id_form = $consulta[0];
            $ingresos_old = $consulta[1];
            $egresos_old = $consulta[2];
            echo "EXACTAMENTE UN REGISTRO<br>";
            $SQLU = "UPDATE data 
					 SET ingresosmensuales = $ingresos, egresosmensuales = $egresos
					 WHERE id_form = $id_form";
            echo $SQLU . "<br>";
            if ($conexion->ejecutar($SQLU)) {
                echo "FUE ACTUALIZADO<br><br>";
                fwrite($fp, "$documento;$ingresos_old;$ingresos;$egresos_old;$egresos;ACTUALIZADO" . PHP_EOL);
            } else {
                echo "NO SE PUDO ACTUALIZAR<br><br>";
                fwrite($fp, "$documento;$ingresos_old;$ingresos;$egresos_old;$egresos;NO_ACTUALIZADO" . PHP_EOL);
            }
        } else {
            if ($cant == 0)
                echo "NO TIENE REGISTROS<br><br>";
            else
                echo "POSEE MAS DE UN REGISTRO<br><br>";
        }
    }
    echo "TERMINO...";
    fclose($fp);
}

function updateIngresosEgresosForms() {
    $temp = file('files/updateIngresosEgresosForms/updateIngresosEgresosForms.csv');
    $fp = fopen("files/updateIngresosEgresosForms/updateIngresosEgresosForms_salida.csv", "a");
    fwrite($fp, "DOCUMENTO;IDINGRESOANTERIOR;IDINGRESOACTUAL;IDEGRESOANTERIOR;IDEGRESOACTUAL;PLANILLA;LOTE;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $conexion = new Conexion();
        $datos_leer = split(";", $temp[$i]);
        $planilla = trim($datos_leer[0]);
        $lote = trim($datos_leer[1]);
        $documento = trim($datos_leer[2]);
        $ingresos = trim($datos_leer[4]);
        $campoingresos = trim($datos_leer[5]);
        $egresos = trim($datos_leer[7]);
        $campoegresos = trim($datos_leer[8]);
        $SQL = "SELECT t1.id, t4.ingresosmensuales AS ing, t4.egresosmensuales AS egr, 
						t4.ingresosmensualesemp AS ingemp, t4.egresosmensualesemp AS egremp
				FROM form AS t1
				LEFT OUTER JOIN client AS t2 ON(t1.id_client = t2.id)
				INNER JOIN data AS t4 ON(t1.id = t4.id_form)				
				WHERE t2.document = '$documento'
				AND t1.log_planilla = $planilla
				AND t1.log_lote = $lote
				AND t1.status = 1
				GROUP BY t1.id";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        $ingresos_old = 0;
        $egresos_old = 0;
        if ($cant == 1) {
            echo "EXACTAMENTE UN REGISTRO<br>";
            $consulta = $conexion->sacarRegistro();
            $id_form = $consulta[0];
            $ingresos_old = $consulta[1];
            $egresos_old = $consulta[2];
            $SQLU = "UPDATE data 
					 SET $campoingresos = $ingresos, $campoegresos = $egresos
					 WHERE id_form = $id_form";
            echo $SQLU . "<br>";
            if ($conexion->ejecutar($SQLU)) {
                echo "FUE ACTUALIZADO<br><br>";
                fwrite($fp, "$documento;$ingresos_old;$ingresos;$egresos_old;$egresos;$planilla;$lote;ACTUALIZADO" . PHP_EOL);
            } else {
                echo "NO SE PUDO ACTUALIZAR<br><br>";
                fwrite($fp, "$documento;$ingresos_old;$ingresos;$egresos_old;$egresos;$planilla;$lote;NO_ACTUALIZADO" . PHP_EOL);
            }
        } else {
            if ($cant == 0)
                echo "NO TIENE REGISTROS<br><br>";
            else {
                echo "POSEE MAS DE UN REGISTRO<br><br>";
                fwrite($fp, "$documento;$ingresos_old;$ingresos;$egresos_old;$egresos;$planilla;$lote;NO_ACTUALIZADO_MASDEUNREGISTRO" . PHP_EOL);
            }
        }
    }
    echo "TERMINO...";
    fclose($fp);
}

function updateProfesionOcupacion() {
    $temp = file('files/updateProfesionOcupacion/updateProfesionOcupacion.csv');
    $fp = fopen("files/updateProfesionOcupacion/updateProfesionOcupacion_salida.csv", "a");
    fwrite($fp, "DOCUMENTO;IDPROFESIONANTERIOR;IDPROFESIONACTUAL;IDOCUPACIONANTERIOR;IDOCUPACIONACTUAL;PLANILLA;LOTE;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $conexion = new Conexion();
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $planilla = trim($datos_leer[1]);
        $lote = trim($datos_leer[2]);
        $profesion_str = trim($datos_leer[3]);
        $idprofesion = trim($datos_leer[4]);
        $ocupacion_str = trim($datos_leer[5]);
        $idocupacion = trim($datos_leer[6]);
        $comple = '';
        if ($profesion_str != '')
            $comple .= "profesion = " . $idprofesion;
        if ($profesion_str != '' && $ocupacion_str != '')
            $comple .= ", ";
        if ($ocupacion_str != '')
            $comple .= "ocupacion = " . $idocupacion;

        $SQL = "SELECT t1.id, t4.profesion, t4.ocupacion
				FROM form AS t1
				LEFT OUTER JOIN client AS t2 ON(t1.id_client = t2.id)
				INNER JOIN data AS t4 ON(t1.id = t4.id_form)				
				WHERE t2.document = '$documento'
				AND t1.log_planilla = $planilla
				AND t1.log_lote = $lote
				AND t1.status = 1
				GROUP BY t1.id";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        $ingresos_old = 0;
        $egresos_old = 0;
        if ($cant > 0) {
            echo "EXACTAMENTE UN REGISTRO<br>";
            while ($consulta = $conexion->sacarRegistro()) {
                $id_form = $consulta[0];
                $profesion_old = $consulta[1];
                $ocupacion_old = $consulta[2];
                $SQLU = "UPDATE data 
						 SET " . $comple . "
						 WHERE id_form = $id_form";
                echo $SQLU . "<br>";
                if ($conexion->ejecutar($SQLU)) {
                    echo "FUE ACTUALIZADO<br><br>";
                    fwrite($fp, "$documento;$profesion_old;$idprofesion;$ocupacion_old;$idocupacion;$planilla;$lote;ACTUALIZADO" . PHP_EOL);
                } else {
                    echo "NO SE PUDO ACTUALIZAR<br><br>";
                    fwrite($fp, "$documento;$profesion_old;$idprofesion;$ocupacion_old;$idocupacion;$planilla;$lote;NO_ACTUALIZADO" . PHP_EOL);
                }
            }
        } else {
            echo "NO TIENE REGISTROS<br><br>";
        }
    }
}

function updateNacionalidad() {
    $temp = file('files/updateNacionalidad/updateNacionalidad.csv');
    $fp = fopen("files/updateNacionalidad/updateNacionalidad_salida.csv", "a");
    fwrite($fp, "DOCUMENTO;IDNACIONALIDADANTERIOR;IDNACIONALIDADACTUAL;PLANILLA;LOTE;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $conexion = new Conexion();
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $planilla = trim($datos_leer[1]);
        $lote = trim($datos_leer[2]);
        $nacionalidad_str = trim($datos_leer[3]);
        $idnacionalidad = trim($datos_leer[4]);

        $SQL = "SELECT t1.id, t4.nacionalidad
				FROM form AS t1
				LEFT OUTER JOIN client AS t2 ON(t1.id_client = t2.id)
				INNER JOIN data AS t4 ON(t1.id = t4.id_form)				
				WHERE t2.document = '$documento'
				AND t1.log_planilla = $planilla
				AND t1.log_lote = $lote
				AND t1.status = 1
				GROUP BY t1.id";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        $nacionalidad_old = 0;
        if ($cant > 0) {
            if ($cant == 1)
                echo "EXACTAMENTE UN REGISTRO<br>";
            else
                echo "MAS DE UN REGISTRO<br>";
            while ($consulta = $conexion->sacarRegistro()) {
                $id_form = $consulta[0];
                $nacionalidad_old = $consulta[1];
                $SQLU = "UPDATE data 
						 SET nacionalidad = $idnacionalidad
						 WHERE id_form = $id_form";
                echo $SQLU . "<br>";
                if ($conexion->ejecutar($SQLU)) {
                    echo "FUE ACTUALIZADO<br><br>";
                    fwrite($fp, "$documento;$nacionalidad_old;$idnacionalidad;$planilla;$lote;ACTUALIZADO" . PHP_EOL);
                } else {
                    echo "NO SE PUDO ACTUALIZAR<br><br>";
                    fwrite($fp, "$documento;$nacionalidad_old;$idnacionalidad;$planilla;$lote;NO_ACTUALIZADO" . PHP_EOL);
                }
            }
        } else {
            echo "NO TIENE REGISTROS<br><br>";
        }
    }
}

function updateActividadEconomica() {
    $temp = file('files/updateActividadEconomica/updateActividadEconomica.csv');
    $fp = fopen("files/updateActividadEconomica/updateActividadEconomica_salida.csv", "a");
    fwrite($fp, "DOCUMENTO;IDACTIVIDADECOANTERIOR;IDACTIVIDADECOACTUAL;PLANILLA;LOTE;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $conexion = new Conexion();
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $planilla = trim($datos_leer[1]);
        $lote = trim($datos_leer[2]);
        $actividadeco_str = trim($datos_leer[3]);
        $idactividadeco = trim($datos_leer[4]);

        $SQL = "SELECT t1.id, t4.actividadeconomicaempresa
				FROM form AS t1
				LEFT OUTER JOIN client AS t2 ON(t1.id_client = t2.id)
				INNER JOIN data AS t4 ON(t1.id = t4.id_form)				
				WHERE t2.document = '$documento'
				AND t1.log_planilla = $planilla
				AND t1.log_lote = $lote
				AND t1.status = 1
				GROUP BY t1.id";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        $actividadeco_old = 0;
        if ($cant > 0) {
            if ($cant == 1)
                echo "EXACTAMENTE UN REGISTRO<br>";
            else
                echo "MAS DE UN REGISTRO<br>";
            while ($consulta = $conexion->sacarRegistro()) {
                $id_form = $consulta[0];
                $actividadeco_old = $consulta[1];
                $SQLU = "UPDATE data 
						 SET actividadeconomicaempresa = $idactividadeco
						 WHERE id_form = $id_form";
                echo $SQLU . "<br>";
                if ($conexion->ejecutar($SQLU)) {
                    echo "FUE ACTUALIZADO<br><br>";
                    fwrite($fp, "$documento;$actividadeco_old;$idactividadeco;$planilla;$lote;ACTUALIZADO" . PHP_EOL);
                } else {
                    echo "NO SE PUDO ACTUALIZAR<br><br>";
                    fwrite($fp, "$documento;$actividadeco_old;$idactividadeco;$planilla;$lote;NO_ACTUALIZADO" . PHP_EOL);
                }
            }
        } else {
            echo "NO TIENE REGISTROS<br><br>";
        }
    }
}

function updateCamposConCampo() {
    $temp = file('files/updateCamposConCampo/updateCamposConCampo43.csv');
    $fp = fopen("files/updateCamposConCampo/updateCamposConCampo_salida43.csv", "a");
    //fwrite($fp, "DOCUMENTO;IDACTIVIDADECOANTERIOR;IDACTIVIDADECOACTUAL;PLANILLA;LOTE;ESTADO".PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $conexion = new Conexion();
        $datos_leer = split(";", $temp[$i]);

        $documento = trim($datos_leer[0]);
        $planilla = trim($datos_leer[1]);
        $lote = trim($datos_leer[2]);
        $campodescript_str = trim($datos_leer[3]);
        $camponombre = trim($datos_leer[5]);
        if (trim($datos_leer[6]) == 'fecha') {
            $idp = explode('/', trim($datos_leer[4]));
            $idcampo = $idp[2] . "-" . $idp[1] . "-" . $idp[0];
        } else
            $idcampo = trim($datos_leer[4]);

        if ($i == 1)
            fwrite($fp, "DOCUMENTO;ID" . strtoupper($camponombre) . "ANTERIOR;ID" . strtoupper($camponombre) . "ACTUAL;PLANILLA;LOTE;ESTADO" . PHP_EOL);

        $SQL = "SELECT t1.id, t4." . $camponombre . "
				FROM form AS t1
				LEFT OUTER JOIN client AS t2 ON(t1.id_client = t2.id)
				INNER JOIN data AS t4 ON(t1.id = t4.id_form)				
				WHERE t2.document = '$documento'
				AND t1.log_planilla = $planilla
				AND t1.log_lote = $lote
				AND t1.status = 1
				GROUP BY t1.id";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        $campo_old = 0;
        if ($cant > 0) {
            if ($cant == 1)
                echo "EXACTAMENTE UN REGISTRO<br>";
            else
                echo "MAS DE UN REGISTRO<br>";
            while ($consulta = $conexion->sacarRegistro()) {
                $id_form = $consulta[0];
                $campo_old = $consulta[1];
                $SQLU = "UPDATE data 
						 SET $camponombre = '" . $idcampo . "'
						 WHERE id_form = $id_form";
                echo $SQLU . "<br>";
                if ($conexion->ejecutar($SQLU)) {
                    echo "FUE ACTUALIZADO<br><br>";
                    fwrite($fp, "$documento;$campo_old;$idcampo;$planilla;$lote;ACTUALIZADO" . PHP_EOL);
                } else {
                    echo "NO SE PUDO ACTUALIZAR<br><br>";
                    fwrite($fp, "$documento;$campo_old;$idcampo;$planilla;$lote;NO_ACTUALIZADO" . PHP_EOL);
                }
            }
        } else {
            echo "NO TIENE REGISTROS<br><br>";
        }
    }
}

function updateEstadoWorkflow() {
    $temp = file('files/updateEstadoWorkflow/updateEstadoWorkflow3.csv');
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $conexion = new Conexion();
        $datos_leer = explode(";", $temp[$i]);
        $id = trim($datos_leer[0]);
        $SQL = "UPDATE workflow SET estado = 1
				WHERE id = $id";
        echo $SQL . "<br>";
        if ($conexion->ejecutar($SQL))
            echo "ACTUALIZADO<br><br>";
        else
            echo "NO_ACTUALIZADO<br><br>";
    }
}

function updateCamposFechaForm() {
    $temp = file('files/updateCamposFechaForm/updateCamposFechaForm1.csv');
    $fp = fopen("files/updateCamposFechaForm/updateCamposFechaForm_salida1.csv", "a");
    fwrite($fp, "DOCUMENTO;PLANILLA;LOTE;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $conexion = new Conexion();
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $planilla = trim($datos_leer[1]);
        $lote = trim($datos_leer[2]);

        /* $fechaactual = '2013-05-16';
          $fechafinal = '2013-05-15'; */
        $fec1p = explode(' ', trim($datos_leer[3]));
        $fec1 = explode('/', $fec1p[0]);
        $horasFec1 = $fec1p[1];
        $fecha1 = $fec1[2] . "-" . $fec1[1] . "-" . $fec1[0];

        $fec2 = explode('/', trim($datos_leer[4]));
        $fecha2 = $fec2[2] . "-" . $fec2[1] . "-" . $fec2[0];

        $SQL = "SELECT id FROM client WHERE document = '$documento'";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        if ($cant > 0) {
            echo "EXACTAMENTE UN REGISTRO<br>";
            while ($consulta = $conexion->sacarRegistro()) {
                # code...
                $id_cliente = $consulta[0];
                $SQL1 = "UPDATE form 
						 SET date_created = REPLACE(date_created, '$fecha1', '$fecha2')
						 WHERE id_client = $id_cliente
						 AND log_planilla = $planilla 
						 AND log_lote = $lote
						 AND date_Created LIKE '%$fecha1 $horasFec1%'";
                echo $SQL1 . "<br><br>";
                if ($conexion->ejecutar($SQL1)) {
                    echo "SE ACTULIZO<br><br>";
                    fwrite($fp, "$documento;$planilla;$lote;ACTUALIZADO" . PHP_EOL);
                } else {
                    echo "NO SE ACTULIZO<br><br>";
                    fwrite($fp, "$documento;$planilla;$lote;NO_ACTUALIZADO" . PHP_EOL);
                }
            }
        } else {
            echo "NO TIENE REGISTROS<br><br>";
            fwrite($fp, "$documento;$planilla;$lote;NO_ACTUALIZADO" . PHP_EOL);
        }
    }
    echo "TERMINO...";
}

function getClientesEnMigracionSinDigitar() {
    $conexion = new Conexion();
    $fecha_antes = date('Y-m-d', strtotime('-10 month'));
    $table = "DOCUMENTO;GESTION" . PHP_EOL;
    $SQL = "SELECT t2.id, t2.document FROM migra_images AS t1 
			INNER JOIN client AS t2 ON(t1.document = t2.document)
			WHERE t1.status = 1
			GROUP BY t2.id
			ORDER BY t2.id";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        $conexion1 = new Conexion();
        $conexion2 = new Conexion();
        while ($consulta = $conexion->sacarRegistro()) {
            $id_client = $consulta[0];
            $document = $consulta[1];
            $SQL1 = "SELECT * FROM form WHERE id_client = $id_client";
            $conexion1->consultar($SQL1);
            if ($conexion1->getNumeroRegistros() == 0) {
                $SQL2 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client";
                $conexion1->consultar($SQL2);
                if ($conexion1->getNumeroRegistros() == 0) {
                    $table .= $document . ";NOFORM_NOCAPICONFIRM" . PHP_EOL;
                    $SQLU = "UPDATE client SET estado = 1 WHERE id = $id_client AND estado = 0";
                    $conexion2->ejecutar($SQLU);
                } else {
                    $SQL3 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client AND date_created >= $fecha_antes";
                    $conexion1->consultar($SQL3);
                    if ($conexion1->getNumeroRegistros() == 0)
                        $table .= $document . ";NOFORM_CAPICONFIRMOLD" . PHP_EOL;
                }
            }else {
                $SQL2 = "SELECT * FROM data_confirm WHERE id_client = $id_client";
                $conexion1->consultar($SQL2);
                if ($conexion1->getNumeroRegistros() == 0) {
                    $SQL3 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client";
                    $conexion1->consultar($SQL3);
                    if ($conexion1->getNumeroRegistros() == 0)
                        $table .= $document . ";FORM_NOCONFIRM_NOCAPICONFIRM" . PHP_EOL;
                    else {
                        $SQL4 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client AND date_created >= $fecha_antes";
                        $conexion1->consultar($SQL4);
                        if ($conexion1->getNumeroRegistros() == 0)
                            $table .= $document . ";FORM_NOCONFIRM_CAPICONFIRMOLD" . PHP_EOL;
                    }
                }else {
                    $SQL3 = "SELECT * FROM data_confirm WHERE id_client = $id_client AND date_created >= $fecha_antes";
                    $conexion1->consultar($SQL3);
                    if ($conexion1->getNumeroRegistros() == 0) {
                        $SQL4 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client";
                        $conexion1->consultar($SQL4);
                        if ($conexion1->getNumeroRegistros() == 0)
                            $table .= $document . ";FORM_CONFIRMOLD_NOCAPICONFIRM" . PHP_EOL;
                        else {
                            $SQL5 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client AND date_created >= $fecha_antes";
                            $conexion1->consultar($SQL5);
                            if ($conexion1->getNumeroRegistros() == 0)
                                $table .= $document . ";FORM_CONFIRMOLD_CAPICONFIRMOLD" . PHP_EOL;
                        }
                    }
                }
            }
        }
    }
    header('Content-Type: text/csv; charset=utf-8');
    header("Content-Disposition: attachment; filename=ClientesParaDigitarConfirmar" . date('his') . ".csv");
    echo $table;
}

function getClientesSinDigitar() {
    $conexion = new Conexion();
    $fecha_antes = date('Y-m-d', strtotime('-10 month'));
    $table = "ID_CLIENTE;DOCUMENTO;GESTION" . PHP_EOL;
    $SQL = "SELECT t2.id, t2.document FROM client AS t2
			WHERE t2.estado = 0
			GROUP BY t2.id
			ORDER BY t2.id";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        $conexion1 = new Conexion();
        $conexion2 = new Conexion();
        while ($consulta = $conexion->sacarRegistro()) {
            $id_client = $consulta[0];
            $document = $consulta[1];
            $SQL1 = "SELECT * FROM form WHERE id_client = $id_client";
            $conexion1->consultar($SQL1);
            if ($conexion1->getNumeroRegistros() == 0) {
                $SQL2 = "SELECT * FROM data_capi WHERE id_client = $id_client";
                $conexion1->consultar($SQL2);
                if ($conexion1->getNumeroRegistros() == 0) {
                    $SQL6 = "SELECT * FROM data_confirm WHERE id_client = $id_client";
                    $conexion1->consultar($SQL6);
                    if ($conexion1->getNumeroRegistros() == 0) {
                        $SQL7 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client";
                        $conexion1->consultar($SQL7);
                        if ($conexion1->getNumeroRegistros() == 0) {
                            $table .= $id_client . ";" . $document . ";NOFORM_NODATACAPI_NOFORMCONFIRM_NOCAPICONFIRM" . PHP_EOL;
                        }
                    }
                    //$table .= $document.";NOFORM_NODATACAPI".PHP_EOL;
                    /* $SQLU = "UPDATE client SET estado = 1 WHERE id = $id_client AND estado = 0";
                      $conexion2->ejecutar($SQLU); */
                } else {
                    $SQL3 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client AND date_created >= $fecha_antes";
                    $conexion1->consultar($SQL3);
                    if ($conexion1->getNumeroRegistros() == 0)
                        $table .= $id_client . ";" . $document . ";NOFORM_CAPICONFIRMOLD" . PHP_EOL;
                }
            }else {
                $SQL2 = "SELECT * FROM data_confirm WHERE id_client = $id_client";
                $conexion1->consultar($SQL2);
                if ($conexion1->getNumeroRegistros() == 0) {
                    $SQL3 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client";
                    $conexion1->consultar($SQL3);
                    if ($conexion1->getNumeroRegistros() == 0)
                        $table .= $id_client . ";" . $document . ";FORM_NOCONFIRM_NOCAPICONFIRM" . PHP_EOL;
                    else {
                        $SQL4 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client AND date_created >= $fecha_antes";
                        $conexion1->consultar($SQL4);
                        if ($conexion1->getNumeroRegistros() == 0)
                            $table .= $id_client . ";" . $document . ";FORM_NOCONFIRM_CAPICONFIRMOLD" . PHP_EOL;
                    }
                }else {
                    $SQL3 = "SELECT * FROM data_confirm WHERE id_client = $id_client AND date_created >= $fecha_antes";
                    $conexion1->consultar($SQL3);
                    if ($conexion1->getNumeroRegistros() == 0) {
                        $SQL4 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client";
                        $conexion1->consultar($SQL4);
                        if ($conexion1->getNumeroRegistros() == 0)
                            $table .= $id_client . ";" . $document . ";FORM_CONFIRMOLD_NOCAPICONFIRM" . PHP_EOL;
                        else {
                            $SQL5 = "SELECT * FROM data_capi_confirm WHERE id_client = $id_client AND date_created >= $fecha_antes";
                            $conexion1->consultar($SQL5);
                            if ($conexion1->getNumeroRegistros() == 0)
                                $table .= $id_client . ";" . $document . ";FORM_CONFIRMOLD_CAPICONFIRMOLD" . PHP_EOL;
                        }
                    }
                }
            }
        }
    }
    header('Content-Type: text/csv; charset=utf-8');
    header("Content-Disposition: attachment; filename=ClientesParaDigitarConfirmar" . date('his') . ".csv");
    echo $table;
}

function desactivarClientesSinDatosNiGes() {
    $temp = file('files/desactivarClientesSinDatosNiGes/desactivarClientesSinDatosNiGes.csv');
    $fp = fopen("files/desactivarClientesSinDatosNiGes/desactivarClientesSinDatosNiGes_salida.csv", "a");
    fwrite($fp, "IDCLIENTE;DOCUMENTO;ESTADO" . PHP_EOL);
    $n = count($temp);
    for ($i = 1; $i < $n; $i++) {
        $conexion = new Conexion();
        $datos_leer = explode(";", $temp[$i]);
        $id = trim($datos_leer[0]);
        $documento = trim($datos_leer[1]);
        $SQL = "UPDATE client SET estado = 2
				WHERE id = $id";
        echo $SQL . "<br>";
        if ($conexion->ejecutar($SQL)) {
            echo "ACTUALIZADO<br><br>";
            fwrite($fp, "$id;$documento;ACTUALIZADO" . PHP_EOL);
        } else {
            echo "NO_ACTUALIZADO<br><br>";
            fwrite($fp, "$id;$documento;NO_ACTUALIZADO" . PHP_EOL);
        }
    }
}

function repararRadicacionFecha_recibido() {
    $conexion = new Conexion();
    $table = "DOCUMENTO;GESTION" . PHP_EOL;
    $SQL = "SELECT * FROM radicados AS t1 
			INNER JOIN radicados_items AS t2 ON(t1.id = t2.id_radicados)
			WHERE t1.estado = 2";
}

function repararRadicacionFecha_RadicacionFisicos() {
    $conexion = new Conexion();
    $conexion2 = new Conexion();
    $table = "DOCUMENTO;GESTION" . PHP_EOL;
    $SQL = "SELECT id FROM `radicados` 
			WHERE tipo = 0 
			AND fecha_envio = '0000-00-00' 
			AND estado = 2";
    $conexion->consultar($SQL);
    echo "SE ENCONTRARON: " . $conexion->getNumeroRegistros() . "<br><br><br>";
    while ($consulta = $conexion->sacarRegistro()) {
        $lote = $consulta[0];
        $SQL2 = "SELECT id FROM form WHERE log_lote = $lote
				 GROUP BY log_lote";
        $conexion2->consultar($SQL2);
        if ($conexion2->getNumeroRegistros() > 0) {
            $consulta2 = $conexion2->sacarRegistro();
            $id_form = $consulta2[0];
            $SQL3 = "SELECT fecharadicado FROM `data` WHERE id_form = $id_form";
            $conexion2->consultar($SQL3);
            if ($conexion2->getNumeroRegistros() > 0) {
                $consulta2 = $conexion2->sacarRegistro();
                $fecharadicado = $consulta2[0];
                if (strlen($fecharadicado) == 10) {
                    $SQLU = "UPDATE radicados 
							 SET fecha_envio = '$fecharadicado'
							 WHERE id = $lote";
                    echo $SQLU . "<br>";
                    if ($conexion2->ejecutar($SQLU)) {
                        echo "SE ACTUALIZO_FECHA: LOTE:$lote<br><br>";
                    } else {
                        echo "NO_ACTUALIZO_FECHA: LOTE:$lote<br><br>";
                    }
                } else {
                    echo "LA FECHA ES MALA:$fecharadicado LOTE:$lote<br><br>";
                }
            }
        } else {
            echo "AUN NO FUE DIGITADO: LOTE:$lote<br><br>";
        }
    }
}

function repararRadicacionFecha_Aprobacion() {
    $conexion = new Conexion();
    $conexion2 = new Conexion();
    $table = "DOCUMENTO;GESTION" . PHP_EOL;
    $SQL = "SELECT id, fecha_recibido FROM `radicados` 
			WHERE estado = 2";
    $conexion->consultar($SQL);
    echo "SE ENCONTRARON: " . $conexion->getNumeroRegistros() . "<br><br><br>";
    while ($consulta = $conexion->sacarRegistro()) {
        $lote = $consulta[0];
        $fecha_recibido = $consulta[1];
        $SQL2 = "SELECT id, DATE_FORMAT(date_created, '%Y-%m-%d') FROM form 
				 WHERE log_lote = $lote
				 GROUP BY log_lote";
        $conexion2->consultar($SQL2);
        if ($conexion2->getNumeroRegistros() > 0) {
            $consulta2 = $conexion2->sacarRegistro();
            $id_form = $consulta2[0];
            $date_created = $consulta2[1];

            if ($fecha_recibido > $date_created) {
                echo $lote . "<br>";
            }
        } else {
            //echo "AUN NO FUE DIGITADO: LOTE:$lote<br>";
        }
    }
}

function sacarDatosPorvenir() {
    $temp = file('files/sacarDatosPorvenir/sacarDatosPorvenir3.csv');

    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Description: File Transfer");
    header("Content-Encoding: UTF-8");
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=clientesParaSeguimientoPorvenir_" . date('his') . ".csv");
    header("Expires: 0");
    header("Pragma: public");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
    $fh = fopen('php://output', 'w');
    fputcsv($fh, array("numero_registro", "tipo_registro", "tipo_identificacion", "numero_identificacion", "razon_social", "primer_apellido", "segundo_apellido", "primer_nombre", "segundo_nombre", "tipo_aportante", "forma_pago", "forma_liquidacion", "correo_contacto", "nombre_contacto", "direccion_ultimopago", "cuidad_ultimopago", "departamento", "telefono_ultimopago", "direccion_sucursalprincipal", "ciudad_sucursalprincipal", "departamento_sucursalprincipal", "telefono_sucursalprincipal", "direccion_correspondencia", "ciudad_correspondencia", "departamento_correspondencia", "telefono_correspondecia", "fax", "fecha_ultimodeposito"), ';');
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $objeto = array();
        $conexion = new Conexion();
        $datos_leer = explode(";", $temp[$i]);
        if (strlen($datos_leer[0]) == 628) {
            $objeto[] = trim(substr($datos_leer[0], 0, 8));
            $objeto[] = trim(substr($datos_leer[0], 8, 1));
            $objeto[] = trim(substr($datos_leer[0], 9, 2));
            $objeto[] = trim(substr($datos_leer[0], 11, 12));
            $objeto[] = trim(substr($datos_leer[0], 23, 120));
            $objeto[] = trim(substr($datos_leer[0], 143, 20));
            $objeto[] = trim(substr($datos_leer[0], 163, 20));
            $objeto[] = trim(substr($datos_leer[0], 183, 20));
            $objeto[] = trim(substr($datos_leer[0], 203, 20));
            $objeto[] = trim(substr($datos_leer[0], 223, 1));
            $objeto[] = trim(substr($datos_leer[0], 224, 1));
            $objeto[] = trim(substr($datos_leer[0], 225, 1));
            $objeto[] = trim(substr($datos_leer[0], 226, 60));
            $objeto[] = trim(substr($datos_leer[0], 286, 50));
            $objeto[] = trim(substr($datos_leer[0], 336, 40));
            $objeto[] = trim(substr($datos_leer[0], 376, 20));
            $objeto[] = trim(substr($datos_leer[0], 396, 20));
            $objeto[] = trim(substr($datos_leer[0], 416, 11));
            $objeto[] = trim(substr($datos_leer[0], 427, 40));
            $objeto[] = trim(substr($datos_leer[0], 467, 20));
            $objeto[] = trim(substr($datos_leer[0], 487, 20));
            $objeto[] = trim(substr($datos_leer[0], 507, 11));
            $objeto[] = trim(substr($datos_leer[0], 518, 40));
            $objeto[] = trim(substr($datos_leer[0], 558, 20));
            $objeto[] = trim(substr($datos_leer[0], 578, 20));
            $objeto[] = trim(substr($datos_leer[0], 598, 11));
            $objeto[] = trim(substr($datos_leer[0], 609, 11));
            $objeto[] = trim(substr($datos_leer[0], 620, 8));
            fputcsv($fh, $objeto, ';');
        }
    }
    // Close the file
    fclose($fh);
    // Make sure nothing else is sent, our file is done
    exit;
}

function updateClientesCapiNo() {
    $conexion = new Conexion();
    $SQL = "SELECT t2.id 
			FROM data_capi_confirm AS t1 
			INNER JOIN client AS t2 ON(t1.id_client = t2.id)
			WHERE t2.capi = 'No'
			GROUP BY t2.id";
    echo $SQL . "<br><br>";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        $conexion2 = new Conexion();
        while ($consulta = $conexion->sacarRegistro()) {
            $SQL2 = "UPDATE client SET capi = 'Si' WHERE id = " . $consulta[0];
            echo $SQL2 . "<br>";
            if ($conexion2->ejecutar($SQL2)) {
                echo "ACTUALIZADO<br><br>";
            } else {
                echo "NO_ACTUALIZADO<br><<br>";
            }
        }
    }
}

function updateSGVCliente() {
    $conexion = new Conexion();
    $SQL = "SELECT t1.id FROM client AS t1 INNER JOIN form AS t2 ON(t1.id = t2.id_client) WHERE t1.type != 'SGV'";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        $conn = new Conexion();
        while ($consulta = $conexion->sacarRegistro()) {
            $id_cliente = $consulta[0];
            $SQLU = "UPDATE client SET type = 'SGV' WHERE id = $id_cliente";
            if ($conn->ejecutar($SQLU))
                echo "ACTUALIZADO<br>";
            else
                echo "NO_ACTUALIZADO<br>";
        }
    }
}

function updateIDFORMCONFIRMFORM() {
    $conexion = new Conexion();
    $SQL = "SELECT t1.id, t1.id_client, t2.* 
			FROM data_confirm AS t1
			INNER JOIN form AS t2 ON(t1.id_client = t2.id_client) 
			WHERE t1.id_form = 0
			AND t2.status = 1
			GROUP BY t2.id_client";
    $conexion->consultar($SQL);
    if ($conexion->getNumeroRegistros() > 0) {
        $conn = new Conexion();
        while ($consulta = $conexion->sacarRegistro()) {
            $id = $consulta[0];
            $id_form = $consulta[2];
            $SQLU = "UPDATE data_confirm SET id_form = $id_form WHERE id = $id AND id_form = 0";
            echo $SQLU . "<br>";
            if ($conn->ejecutar($SQLU))
                echo "ACTUALIZADO<br><br>";
            else
                echo "NO_ACTUALIZADO<br><br>";
        }
    }
}

function prueba() {
    $temp = file('files/sacarDatosPorvenir/sacarDatosPorvenir2.csv');
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        //$id_cl_clientes = '';
        $objeto = array();
        $conexion = new Conexion();
        $datos_leer_ = explode(";", $temp[$i]);
        $datos_leer = $datos_leer_[0];
        if (strlen($datos_leer) === 628) {
            $numero_registro = trim(substr($datos_leer, 0, 8));
            $tipo_registro = trim(substr($datos_leer, 8, 1));
            $tipo_identificacion = trim(substr($datos_leer, 9, 2));
            $numero_identificacion = (int) trim(substr($datos_leer, 11, 12));
            $razon_social = trim(substr($datos_leer, 23, 120));
            $primer_apellido = trim(substr($datos_leer, 143, 20));
            $segundo_apellido = trim(substr($datos_leer, 163, 20));
            $primer_nombre = trim(substr($datos_leer, 183, 20));
            $segundo_nombre = trim(substr($datos_leer, 203, 20));
            $tipo_aportante = trim(substr($datos_leer, 223, 1));
            $forma_pago = trim(substr($datos_leer, 224, 1));
            $forma_liquidacion = trim(substr($datos_leer, 225, 1));
            $correo_contacto = trim(substr($datos_leer, 226, 60));
            $nombre_contacto = trim(substr($datos_leer, 286, 50));
            $direccion_ultimopago = trim(substr($datos_leer, 336, 40));
            $cuidad_ultimopago = trim(substr($datos_leer, 376, 20));
            $departamento = trim(substr($datos_leer, 396, 20));
            $telefono_ultimopago = (int) trim(substr($datos_leer, 416, 11));
            $direccion_sucursalprincipal = trim(substr($datos_leer, 427, 40));
            $ciudad_sucursalprincipal = trim(substr($datos_leer, 467, 20));
            $departamento_sucursalprincipal = trim(substr($datos_leer, 487, 20));
            $telefono_sucursalprincipal = (int) trim(substr($datos_leer, 507, 11));
            $direccion_correspondencia = trim(substr($datos_leer, 518, 40));
            $ciudad_correspondencia = trim(substr($datos_leer, 558, 20));
            $departamento_correspondencia = trim(substr($datos_leer, 578, 20));
            $telefono_correspondecia = (int) trim(substr($datos_leer, 598, 11));
            $fax = (int) trim(substr($datos_leer, 609, 11));
            $fecha_ultimodeposito = trim(substr($datos_leer, 620, 8));

            $SQLC = "INSERT INTO cl_clientes_ 
					(
						id_creador, numero_registro, tipo_registro, tipo_identificacion, numero_identificacion, razon_social,
						primer_apellido, segundo_apellido, primer_nombre, segundo_nombre, tipo_aportante, forma_pago, 
						forma_liquidacion, correo_contacto, nombre_contacto, direccion_ultimopago, cuidad_ultimopago, 
						departamento, telefono_ultimopago, direccion_sucursalprincipal, ciudad_sucursalprincipal, 
						departamento_sucursalprincipal, telefono_sucursalprincipal, direccion_correspondencia, 
						ciudad_correspondencia, departamento_correspondencia, telefono_correspondecia, fax, 
						fecha_ultimodeposito, plan_trabajo
					) 
					VALUES 
					(
						$id_creador, '$numero_registro', '$tipo_registro', '$tipo_identificacion', '$numero_identificacion', 
						'$razon_social', '$primer_apellido', '$segundo_apellido', '$primer_nombre', '$segundo_nombre', '$tipo_aportante', 
						'$forma_pago', '$forma_liquidacion', '$correo_contacto', '$nombre_contacto', '$direccion_ultimopago', 
						'$cuidad_ultimopago', '$departamento', '$telefono_ultimopago', '$direccion_sucursalprincipal', 
						'$ciudad_sucursalprincipal', '$departamento_sucursalprincipal', '$telefono_sucursalprincipal', 
						'$direccion_correspondencia', '$ciudad_correspondencia', '$departamento_correspondencia', 
						'$telefono_correspondecia', '$fax', '$fecha_ultimodeposito', $plan_trabajo
						
					)";
            echo $SQLC;
            if ($conexion->ejecutar($SQLC))
                $id_cl_clientes = $conexion->ultimaId();
            else
                $id_cl_clientes = false;
        }
        if ($id_cl_clientes) {
            if (strlen($datos_leer) === 194) {
                $numero_registro = trim(substr($datos_leer, 0, 8));
                $tipo_registro = trim(substr($datos_leer, 8, 1));
                $tipo_identificacion = trim(substr($datos_leer, 9, 2));
                $numero_identificacion = (int) trim(substr($datos_leer, 11, 12));
                $primer_nombre = trim(substr($datos_leer, 23, 20));
                $segundo_nombre = trim(substr($datos_leer, 43, 20));
                $primer_apellido = trim(substr($datos_leer, 63, 20));
                $segundo_apellido = trim(substr($datos_leer, 83, 20));
                $direccion_correspondencia = trim(substr($datos_leer, 103, 40));
                $ciudad_correspondencia = trim(substr($datos_leer, 143, 20));
                $departamento_correspondencia = trim(substr($datos_leer, 163, 20));
                $telefono_correspondencia = trim(substr($datos_leer, 183, 11));

                $SQLS = "INSERT INTO cl_clientes_sub_ 
						(
							id_cl_clientes, id_creador, numero_registro, tipo_registro, tipo_identificacion, 
							numero_identificacion, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, 
							direccion_correspondencia, ciudad_correspondencia, departamento_correspondencia, 
							telefono_correspondencia
						) 
						VALUES 
						(
							$id_cl_clientes, $id_creador, '$numero_registro', '$tipo_registro', '$tipo_identificacion', 
							'$numero_identificacion', '$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido', 
							'$direccion_correspondencia', '$ciudad_correspondencia', '$departamento_correspondencia', 
							'$telefono_correspondencia'
						)";
                $id_clientes_sub = '';
                if ($conexion->ejecutar($SQLS))
                    $id_clientes_sub = $conexion->ultimaId();
                else
                    $id_clientes_sub = false;
            }
            if (strlen($datos_leer) === 72) {
                $numero_registro = trim(substr($datos_leer, 0, 8));
                $tipo_registro = trim(substr($datos_leer, 8, 1));
                $periodo_deuda = trim(substr($datos_leer, 9, 6));
                $tipo_deuda = trim(substr($datos_leer, 15, 1));
                $valor_deudaobligatoria = (int) trim(substr($datos_leer, 16, 10));
                $valor_deudaporinteres = (int) trim(substr($datos_leer, 26, 10));
                $valor_deudafsp = (int) trim(substr($datos_leer, 36, 6));
                $valor_deudainteresfsp = (int) trim(substr($datos_leer, 42, 6));
                $valor_deudaoprtesempleador = (int) trim(substr($datos_leer, 48, 6));
                $fecha_ultimaliquidacioninteres = trim(substr($datos_leer, 54, 8));
                $valoribc = (int) trim(substr($datos_leer, 62, 10));

                $SQLP = "INSERT INTO tp2_presunta_ 
						(
							id_clientes_sub, id_creador, numero_registro, tipo_registro, periodo_deuda, 
							tipo_deuda, valor_deudaobligatoria, valor_deudaporinteres, valor_deudafsp, 
							valor_deudainteresfsp, valor_deudaoprtesempleador, fecha_ultimaliquidacioninteres, valoribc
						) 
						VALUES 
						(
							$id_clientes_sub, $id_creador, '$numero_registro', '$tipo_registro', '$periodo_deuda', 
							'$tipo_deuda', '$valor_deudaobligatoria', '$valor_deudaporinteres', '$valor_deudafsp', 
							'$valor_deudainteresfsp', '$valor_deudaoprtesempleador', '$fecha_ultimaliquidacioninteres', '$valoribc'
						)";
                if ($conexion->ejecutar($SQLP))
                    $id_presunta = $conexion->ultimaId();
                else
                    $id_presunta = false;
            }
        }
    }
}

function imagenesExistente() {
    $conn = new Conexion();
    $ruta = '/var/www/html/images_colpatria/';
    $SQL = "SELECT * 
			FROM image AS t1
			/*INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
			INNER JOIN client AS t3 ON(t3.id = t2.id_client)*/
			WHERE 1
			GROUP BY id_forma";
    if ($conn->consultar($SQL)) {
        if ($conn->getNumeroRegistros() > 0) {
            $conn_ = new Conexion();
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-Encoding: UTF-8");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=documentos_Digitar_" . date('his') . ".csv");
            header("Expires: 0");
            header("Pragma: public");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM

            $fh = fopen('php://output', 'w');
            fputcsv($fh, array('DOCUMENTO', 'NOMBRE', 'FECHA_DIGITACION', 'PLANILLA', 'LOTE'), ';');
            while ($consulta = $conn->sacarRegistro('str')) {
                $id_forma = $consulta['id_forma'];
                if (file_exists($ruta . $consulta['filename'])) {
                    $SQLF = "SELECT t2.*, t1.date_created AS fecha_digitacion, t1.log_lote, t1.log_planilla 
							FROM form AS t1 
							INNER JOIN client AS t2 ON(t2.id = t1.id_client)
							WHERE t1.id = $id_forma";
                    if ($conn_->consultar($SQLF)) {
                        $tam = $conn_->getNumeroRegistros();
                        if ($tam == 1) {
                            $consulta_ = $conn_->sacarRegistro('str');
                            fputcsv($fh, array($consulta_['document'], trim($consulta_['firstname'] . ' ' . $consulta_['lastname']), $consulta_['fecha_digitacion'], $consulta_['log_planilla'], $consulta_['log_lote']), ';');
                        } else {
                            if ($tam == 0)
                                fputcsv($fh, array('NO_EXISTE_' . $id_forma, '', '', '', ''), ';');
                            else
                                fputcsv($fh, array('MAS_DEUNREGISTRO_' . $id_forma, '', '', '', ''), ';');
                        }
                    } else
                        fputcsv($fh, array('ERRORCONSULTA_' . $id_forma, '', '', '', ''), ';');
                }
            }
            fclose($fh);
            // Make sure nothing else is sent, our file is done
            exit;
        } else
            echo "NO SE ENCONTRARON REGISTROS INCIAL";
    } else
        echo "LA CONSULTA NO SE PUDO REALIZAR AL INICIO";
}

function subirImagenesPerdidas() {
    $conn = new Conexion();
    $SQL = "SELECT * FROM image WHERE original_file != ''";
    if ($conn->consultar($SQL)) {
        if ($conn->getNumeroRegistros() > 0) {
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-Encoding: UTF-8");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=documentos_Encontrados_" . date('his') . ".csv");
            header("Expires: 0");
            header("Pragma: public");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM

            $fh = fopen('php://output', 'w');
            fputcsv($fh, array('FORMA_ID', 'NOMBRE_ORIGINAL', 'NOMBRE_FISICO', 'ESTADO'), ';');
            while ($consulta = $conn->sacarRegistro('str')) {
                $o_name = $consulta['original_file'];
                $forma_id = $consulta['id_forma'];
                $filename = $consulta['filename'];
                $o_p = explode('.', $o_name);
                if (file_exists('/var/www/html/consolidado/' . $o_p[0] . '.tif')) {
                    if (copy('/var/www/html/consolidado/' . $o_p[0] . '.tif', '/var/www/html/consolidado/encontrados/' . $filename))
                        fputcsv($fh, array($forma_id, $o_name, $filename, 'ENCONTRADO_COPIADO'), ';');
                    else
                        fputcsv($fh, array($forma_id, $o_name, $filename, 'ENCONTRADO_NOCOPIADO'), ';');
                }elseif (file_exists('/var/www/html/consolidado/' . $o_p[0] . '.TIF')) {
                    if (copy('/var/www/html/consolidado/' . $o_p[0] . '.TIF', '/var/www/html/consolidado/encontrados/' . $filename))
                        fputcsv($fh, array($forma_id, $o_name, $filename, 'ENCONTRADO_COPIADO'), ';');
                    else
                        fputcsv($fh, array($forma_id, $o_name, $filename, 'ENCONTRADO_NOCOPIADO'), ';');
                }elseif (file_exists('/var/www/html/consolidado/' . $o_p[0] . '.tiff')) {
                    if (copy('/var/www/html/consolidado/' . $o_p[0] . '.tiff', '/var/www/html/consolidado/encontrados/' . $filename))
                        fputcsv($fh, array($forma_id, $o_name, $filename, 'ENCONTRADO_COPIADO'), ';');
                    else
                        fputcsv($fh, array($forma_id, $o_name, $filename, 'ENCONTRADO_NOCOPIADO'), ';');
                }elseif (file_exists('/var/www/html/consolidado/' . $o_p[0] . '.TIFF')) {
                    if (copy('/var/www/html/consolidado/' . $o_p[0] . '.TIFF', '/var/www/html/consolidado/encontrados/' . $filename))
                        fputcsv($fh, array($forma_id, $o_name, $filename, 'ENCONTRADO_COPIADO'), ';');
                    else
                        fputcsv($fh, array($forma_id, $o_name, $filename, 'ENCONTRADO_NOCOPIADO'), ';');
                } else
                    fputcsv($fh, array($forma_id, $o_name, $filename, 'NO_ENCONTRADA'), ';');
            }
            fclose($fh);
            // Make sure nothing else is sent, our file is done
            exit;
        }else {
            echo "NO SE ENCONTRARON REGISTROS";
        }
    } else {
        echo "LA CONSULTA NO SE PUDO REALIZAR.";
    }
}

function deleteConfirmaciones() {
    $conn = new Conexion();
    $n = count($temp);
    $handle = fopen("files/deleteConfirmaciones/deleteConfirmaciones.csv", "r") or die("Couldn't get handle");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Description: File Transfer");
    header("Content-Encoding: UTF-8");
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=deleteConfirmaciones_" . date('his') . ".csv");
    header("Expires: 0");
    header("Pragma: public");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $fh = fopen('php://output', 'w');
    fputcsv($fh, array('CONTACT_ID', 'DATA', 'ESTADO'), ';');
    if ($handle) {
        while (!feof($handle)) {
            $buffer = fgets($handle, 4096);
            //echo $buffer."<br>";
            $datos_leer = explode(";", $buffer);
            $document = trim($datos_leer[1]); //cedula - B
            $contacto_str = trim($datos_leer[2]); //contacto - C
            $id_contact = trim($datos_leer[3]); //id - D
            $SQL = "SELECT t2.* 
        			FROM client As t1 
        			INNER JOIN data_capi_confirm AS t2 ON(t2.id_client = t1.id)
        			WHERE t1.document = $document
        			AND t2.id_contact = $id_contact
        			ORDER BY t2.date_created DESC
        			LIMIT 1";
            //echo $SQL."<br>";
            if ($conn->consultar($SQL)) {
                $tam = $conn->getNumeroRegistros();
                if ($tam == 1) {
                    $consulta = $conn->sacarRegistro('str');
                    $id = $consulta['id'];
                    $SQLD = "DELETE FROM data_capi_confirm WHERE id = $id";
                    //echo $SQLD."<br><br>";
                    if ($conn->ejecutar($SQLD))
                        fputcsv($fh, array($id, json_encode($consulta), 'ELIMINADO'), ';');
                    else
                        fputcsv($fh, array($id, json_encode($consulta), 'NO_ELIMINADO'), ';');
                }else {
                    if ($tam == 0)
                        fputcsv($fh, array('0', '', 'LA CONSULTA NO ENCONTRO RESULTADOS documento : ' . $document . ', CONTACTO : ' . $id_contact), ';');
                    //echo "LA CONSULTA NO ENCONTRO RESULTADOS documento : $document, CONTACTO : $id_contact<br><br>";
                    else
                        fputcsv($fh, array('0', '', 'LA CONSULTA ENCONTRO MAS DE UN RESULTADOS documento : ' . $document . ', CONTACTO : ' . $id_contact), ';');
                    //echo "LA CONSULTA ENCONTRO MAS DE UN RESULTADOS documento : $document, CONTACTO : $id_contact<br><br>";
                }
            } else
                fputcsv($fh, array('0', '', 'LA CONSULTA NO SE PUDO REALIZAR documento : $document, CONTACTO : $id_contact'), ';');
            //echo "LA CONSULTA NO SE PUDO REALIZAR documento : $document, CONTACTO : $id_contact<br><br>";
        }
    }
}

function imagesEncontradas() {
    /* if(file_exists('/var/www/html/images_colpatria/0000eba536107e7e3a4dc65e9783b2dd_1.tif'))
      echo "exite";
      exit(); */
    $path = '/var/www/html/Almacenamiento.Serverfin04/recuperadas/TODO/';
    $path2 = '/var/www/html/Aplicativos.Serverfin04/images_colpatria/';
    /* copy($path.'LOTE_8224_01.tif', '/var/www/html/Almacenamiento.Serverfin04/recuperadas/no_copiadas/LOTE_8224_01.tif');
      exit(); */
    $con = new Conexion();
    $SQL = "SELECT * FROM `image` WHERE original_file IS NOT NULL AND original_file != ''";
    if ($con->consultar($SQL)) {
        if ($con->getNumeroRegistros() > 0) {
            /* header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
              header("Content-Description: File Transfer");
              header("Content-Encoding: UTF-8");
              header("Content-Type: text/csv; charset=UTF-8");
              header("Content-Disposition: attachment; filename=deleteConfirmaciones_".date('his').".csv");
              header("Expires: 0");
              header("Pragma: public");
              echo "\xEF\xBB\xBF"; // UTF-8 BOM */

            $fh = fopen("imagesEncontradas_salida.csv", "a"); //fopen( 'php://output', 'w' );
            fputcsv($fh, array('FILE_NAME', 'CRYP_NAME', 'ESTADO'), ';');
            while ($consulta = $con->sacarRegistro('str')) {
                if (file_exists($path . $consulta['original_file'])) {
                    if (@copy($path . $consulta['original_file'], $path2 . $consulta['filename'])) {
                        unlink($path . $consulta['original_file']);
                        fputcsv($fh, array($consulta['original_file'], $consulta['filename'], 'ENCONTRADA_COPIADA'), ';');
                        //exit();
                    } else {
                        $errors = error_get_last();
                        @copy($path . $consulta['original_file'], '/var/www/html/Almacenamiento.Serverfin04/recuperadas/no_copiadas/' . $consulta['filename']);
                        unlink($path . $consulta['original_file']);
                        fputcsv($fh, array($consulta['original_file'], $consulta['filename'], 'ENCONTRADA_NOCOPIADA:' . $errors['message']), ';');
                    }
                } else
                    fputcsv($fh, array($consulta['original_file'], $consulta['filename'], 'NO_ENCONTRADA'), ';');
            }
        }
    }
}

function clientesSinImagenes() {
    $ruta = '/var/www/html/Aplicativos.Serverfin04/images_colpatria/';
    //if(file_exists('/var/www/html/Aplicativos.Serverfin04/images_colpatria/ce8faa210064246751f1d6d317633ef3_1.tif'))
    /* if(file_exists('/var/www/html/Almacenamiento.Serverfin04/images_colpatria/ce8faa210064246751f1d6d317633ef3_1.tif'))
      echo "Existe";
      else
      echo "NO_EXISTE";
      exit(); */
    $conn = new Conexion();
    $SQL = "SELECT t3.*, t1.firstname, t1.document, t2.log_planilla, t2.log_lote, t2.date_created AS fecha_digitacion 
			FROM client AS t1 
			INNER JOIN form AS t2 ON(t2.id_client = t1.id)
			INNER JOIN image AS t3 ON(t3.id_forma = t2.id)
			WHERE t3.id IS NOT NULL
			ORDER BY t3.id";
    if ($conn->consultar($SQL)) {
        if ($conn->getNumeroRegistros() > 0) {
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-Encoding: UTF-8");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=deleteConfirmaciones_" . date('his') . ".csv");
            header("Expires: 0");
            header("Pragma: public");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM*/

            $fh = fopen('php://output', 'w'); //$fh = fopen( 'php://output', 'w' );
            fputcsv($fh, array('DOCUMENTO', 'NOMBRE', 'FILE_NAME', 'CRYP_NAME', 'PLANILLA', 'LOTE', 'FECHA_DIGITACION', 'ESTADO', 'RUTA'), ';');
            while ($consulta = $conn->sacarRegistro('str')) {
                if (file_exists($ruta . $consulta['filename'])) {
                    fputcsv($fh, array($consulta['document'], $consulta['firstname'], $consulta['original_file'], $consulta['filename'], $consulta['log_planilla'], $consulta['log_lote'], $consulta['fecha_digitacion'], 'EXISTE', $ruta . $consulta['filename']), ';');
                } else
                    fputcsv($fh, array($consulta['document'], $consulta['firstname'], $consulta['original_file'], $consulta['filename'], $consulta['log_planilla'], $consulta['log_lote'], $consulta['fecha_digitacion'], 'NO_EXISTE', $ruta . $consulta['filename']), ';');
            }
        }else {
            
        }
    } else {
        
    }
}

function imagesFaltantesSinNombreOriginal() {
    $conn = new Conexion();
    $path = '/var/www/html/Almacenamiento.Serverfin04/recuperadas/TODO/';
    $path_back = '/var/www/html/Almacenamiento.Serverfin04/recuperadas/back_files/';
    $path2 = '/var/www/html/Aplicativos.Serverfin04/images_colpatria/';
    /* $SQL = "SELECT t1.*, t2.log_planilla, t2.log_lote 
      FROM image AS t1
      INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
      WHERE t1.original_file = ''
      AND t2.log_planilla != 0
      GROUP BY t1.id_forma
      ORDER BY t2.log_planilla, t1.id_forma"; */
    $SQL = "SELECT t1.*, t2.log_planilla, t2.log_lote 
			FROM image AS t1 
			INNER JOIN form AS t2 ON(t2.id = t1.id_forma) 
			WHERE t1.original_file = '' 
			AND t2.log_planilla != 0
			GROUP BY t2.log_lote 
			ORDER BY t2.log_planilla, t1.id_forma";
    if ($conn->consultar($SQL)) {
        $tam = $conn->getNumeroRegistros();
        if ($tam > 0) {
            /* header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
              header("Content-Description: File Transfer");
              header("Content-Encoding: UTF-8");
              header("Content-Type: text/csv; charset=UTF-8");
              header("Content-Disposition: attachment; filename=encontradasSinNombre_".date('his').".csv");
              header("Expires: 0");
              header("Pragma: public");
              echo "\xEF\xBB\xBF"; // UTF-8 BOM */

            $fh = fopen("imagesFaltantesSinNombreOriginal_salida.csv", "a"); //$fh = fopen( 'php://output', 'w' );
            fputcsv($fh, array('FILE_NAME', 'CRYP_NAME', 'ESTADO'), ';');
            while ($consulta = $conn->sacarRegistro('str')) {
                $conn_ = new Conexion();
                $id_forma = $consulta['id_forma'];
                $log_planilla = $consulta['log_planilla'];
                $log_lote = $consulta['log_lote'];
                /* $SQL_ = "SELECT t1.*, t2.log_planilla, t2.log_lote 
                  FROM image AS t1
                  INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
                  WHERE t1.original_file = ''
                  AND t1.id_forma = $id_forma
                  AND t2.log_planilla = $log_planilla
                  AND t2.log_lote = $log_lote"; */
                $SQL_ = "SELECT t1.*, t2.log_planilla, t2.log_lote 
						FROM image AS t1 
						INNER JOIN form AS t2 ON(t2.id = t1.id_forma) 
						WHERE t1.original_file = '' 
						AND t2.log_planilla = $log_planilla
						AND t2.log_lote = $log_lote
						ORDER BY t1.id, t1.id_forma";
                if ($conn_->consultar($SQL_)) {
                    if ($conn_->getNumeroRegistros() > 0) {
                        $objetos = array();
                        $i = 1;
                        while ($consulta_ = $conn_->sacarRegistro('str')) {
                            $p_fil = explode('.', $consulta_['filename']);
                            $ext = $p_fil[(count($p_fil) - 1)];
                            $name = 'LOTE_';
                            $lote = str_pad($consulta_['log_lote'], 4, "0", STR_PAD_LEFT);
                            $type = str_pad($i, 3, "0", STR_PAD_LEFT);
                            $name = $name . $lote . '_' . $type . '.' . $ext;
                            if (file_exists($path . $name)) {
                                $er_str = '';
                                @copy($path . $name, $path_back . $consulta_['filename']);
                                $er_back = error_get_last();
                                if (isset($er_back['message']))
                                    $er_str = '1: ' . $er_back['message'];
                                if (@copy($path . $name, $path2 . $consulta_['filename'])) {
                                    unlink($path . $name);
                                }
                                $er_back .= error_get_last();
                                if (isset($er_back['message']))
                                    $er_str .= ' 2: ' . $er_back['message'];
                                fputcsv($fh, array($name, $consulta_['filename'], 'EXISTE_' . $er_str), ';');
                            }else {
                                fputcsv($fh, array($name, $consulta_['filename'], 'NO_EXISTE'), ';');
                            }
                            $i++;
                        }
                    } else {
                        $sali = 'PLANILLA: ' . $log_planilla . ' LOTE: ' . $log_lote;
                        fputcsv($fh, array($sali, '', 'SIN_RESULTADOS'), ';');
                    }
                } else {
                    $sali = 'PLANILLA: ' . $log_planilla . ' LOTE: ' . $log_lote;
                    fputcsv($fh, array($sali, '', 'CONSULTA_NO_SE_PUDO'), ';');
                }
            }
        } else {
            
        }
    } else {
        
    }
}

function findLostFileByFile() {
    $path = '/var/www/html/Almacenamiento.Serverfin04/recuperadas/TODO_2/';
    $path2 = '/var/www/html/Aplicativos.Serverfin04/images_colpatria/';
    //echo $path.'LOTE_004_001.tif<br>';
    /* if(file_exists($path.'LOTE_0004_001.tif')){
      echo "Existe";
      }else
      echo "NO_EXISTE";
      exit(); */
    $conn = new Conexion();
    $temp = file('findLostFileByFile2.csv');
    $fh = fopen('findLostFileByFile7_salida.csv', 'a');
    fputcsv($fh, array('DOCUMENTO', 'NOMBRE', 'FILE_NAME', 'CRYP_NAME', 'PLANILLA', 'LOTE', 'FECHA_DIGITACION', 'ESTADO'), ';');
    $n = count($temp);
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        $DOCUMENTO = trim($datos_leer[0]); //DOCUMENTO - A
        $NOMBRE = trim($datos_leer[1]); //NOMBRE - B
        $FILE_NAME = trim($datos_leer[2]); //FILE_NAME - C
        $CRYP_NAME = trim($datos_leer[3]); //CRYP_NAME - D
        $PLANILLA = trim($datos_leer[4]); //PLANILLA - E
        $LOTE = trim($datos_leer[5]); //LOTE - F
        $FECHA_DIGITACION = trim($datos_leer[6]); //FECHA_DIGITACION - G
        $ESTADO = trim($datos_leer[7]); //ESTADO - H
        //LOTE_0680_078_1.tif
        /* $fl_p = explode('_', $FILE_NAME);
          $tam_f = count($fl_p);
          if($tam_f === 4){
          $fp_p = explode('.', $fl_p[($tam_f - 1)]);
          $FILE_NAME = $fl_p[0]."_".$fl_p[1]."_".$fl_p[2].".".$fp_p[1]; */

        //LOTE_075_269.tif
        $fl_p = explode('_', $FILE_NAME);
        $tam_f = count($fl_p);
        if ($tam_f === 3) {
            if (strlen($fl_p[1]) === 3)
                $fl_p[1] = '0' . $fl_p[1];
            $FILE_NAME = $fl_p[0] . $fl_p[1] . "_" . $fl_p[2];
            //echo $path.$FILE_NAME."<br>";
            if (file_exists($path . $FILE_NAME)) {
                if (!file_exists($path2 . $CRYP_NAME)) {
                    if (@copy($path . $FILE_NAME, $path2 . $CRYP_NAME)) {
                        fputcsv($fh, array($DOCUMENTO, $NOMBRE, $FILE_NAME, $CRYP_NAME, $PLANILLA, $LOTE, $FECHA_DIGITACION, $FILE_NAME . '_CAPIADO_A_' . $CRYP_NAME), ';');
                    } else
                        fputcsv($fh, array($DOCUMENTO, $NOMBRE, $FILE_NAME, $CRYP_NAME, $PLANILLA, $LOTE, $FECHA_DIGITACION, $CRYP_NAME . '_NO_COPIO'), ';');
                } else
                    fputcsv($fh, array($DOCUMENTO, $NOMBRE, $FILE_NAME, $CRYP_NAME, $PLANILLA, $LOTE, $FECHA_DIGITACION, $CRYP_NAME . '_EXISTIA'), ';');
            } else
                fputcsv($fh, array($DOCUMENTO, $NOMBRE, $FILE_NAME, $CRYP_NAME, $PLANILLA, $LOTE, $FECHA_DIGITACION, $FILE_NAME . '_NO_EXISTE'), ';');
        }
    }
}

function subirMigraImagenes() {
    $path_1 = "/var/www/html/migracion/";
    $path_2 = '/var/www/html/Aplicativos.Serverfin04/images_colpatria/';
    $conn = new Conexion();
    $SQL = "SELECT * 
			FROM  migra_images 
			WHERE filename LIKE '%MULTI.tiff'
			AND STATUS =2
			ORDER BY document";
    if ($conn->consultar($SQL)) {
        if ($conn->getNumeroRegistros() > 0) {
            $fh = fopen('subirMigraImagenes4_salida.csv', 'a');
            fputcsv($fh, array('ID_CLIENTE', 'DOCUMENTO', 'FILENAME', 'PATH', 'ESTADO'), ';');
            $i = 0;
            while ($consulta = $conn->sacarRegistro('str')) {
                $con_ = new Conexion();
                $document = $consulta['document'];
                $filename = $consulta['filename'];
                if (file_exists($path_1 . $document[0] . "/" . $document . "/" . $filename)) {
                    /* $SQL_ = "SELECT * 
                      FROM  image
                      WHERE original_file = '$filename'";
                      if($con_->consultar($SQL_)){
                      $cant_ = $con_->getNumeroRegistros();
                      if($cant_ > 0){
                      while($consulta_ = $con_->sacarRegistro('str')){
                      if(file_exists($path_2.$consulta_['filename'])){
                      fputcsv($fh, array($consulta['id_client'], $document, $filename, $path_1.$document[0]."/" .$document."/".$filename, 'EXITE_MIGRAIMG_SI-CRYPTFILE'), ';');
                      }else{
                      if(copy($path_1.$document[0]."/" .$document."/".$filename, $path_2.$consulta_['filename']))
                      fputcsv($fh, array($consulta['id_client'], $document, $filename, $path_1.$document[0]."/" .$document."/".$filename, 'EXITE_MIGRAIMG_NO-CRYPTFILE-COPIADA'), ';');
                      else
                      fputcsv($fh, array($consulta['id_client'], $document, $filename, $path_1.$document[0]."/" .$document."/".$filename, 'EXITE_MIGRAIMG_NO-CRYPTFILE-NOCOPIADA'), ';');
                      }
                      }
                      }else{
                      fputcsv($fh, array($consulta['id_client'], $document, $filename, $path_1.$document[0]."/" .$document."/".$filename, 'EXITE_MIGRAIMG_CERO-CRYPTFILE'), ';');
                      }
                      }else{
                      fputcsv($fh, array($consulta['id_client'], $document, $filename, $path_1.$document[0]."/" .$document."/".$filename, 'EXITE_MIGRAIMG_CONSULTA-CRYPTFILE'), ';');
                      } */
                    $i++;
                } else {
                    fputcsv($fh, array($consulta['id_client'], $document, $filename, $path_1 . $document[0] . "/" . $document . "/" . $filename, 'NO_EXISTE'), ';');
                    //echo "Documento: ".$path_1.$document[0]."/" .$document."/".$filename."<br>";
                }
            }
            echo "<br>existen $i";
        } else {
            
        }
    } else {
        
    }
}

function updateFechaAprobacionRadicado() {
    $conn = new Conexion();
    $temp = file('files/updateFechaAprobacionRadicado/updateFechaAprobacionRadicado.csv');
    $fp = fopen("files/updateFechaAprobacionRadicado/updateFechaAprobacionRadicado_salida.csv", "a");
    fwrite($fp, "ID;OLDFECHA;NEWFECHA;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        $radicado_id = trim($datos_leer[0]); //A - radicado
        $o_f = explode(' ', trim($datos_leer[1])); //B - fecha  radicacion
        $o_p = explode('/', $o_f[0]);
        $old_fecha = $o_p[2] . '-' . $o_p[1] . '-' . $o_p[0] . ' ' . $o_f[1];
        $n_fp = explode('/', trim($datos_leer[2])); //C - fecha aprobacio
        $new_fecha = $n_fp[2] . '-' . $n_fp[1] . '-' . $n_fp[0];
        $SQL = "SELECT id, fecha_envio FROM radicados WHERE id = $radicado_id AND fecha_creacion LIKE '$old_fecha%'";
        echo $SQL . "<br>";
        if ($conn->consultar($SQL)) {
            $cant = $conn->getNumeroRegistros();
            if ($cant == 1) {
                $consulta = $conn->sacarRegistro('str');
                echo "UN SOLO REGISTRO<br>";
                $SQU = "UPDATE radicados SET fecha_envio = '$new_fecha' WHERE id = $radicado_id";
                echo $SQU . "<br>";
                echo "<br>";
                if ($conn->ejecutar($SQU)) {
                    fwrite($fp, "$radicado_id;" . $consulta['fecha_envio'] . ";$new_fecha;ACTUALIZADO" . PHP_EOL);
                    echo "ACTUALIZADO<br><br>";
                } else {
                    fwrite($fp, "$radicado_id;" . $consulta['fecha_envio'] . ";$new_fecha;NOACTUALIZADO" . PHP_EOL);
                    echo "NOACTUALIZADO<br><br>";
                }
            } elseif ($cant == 0) {
                echo "CERO REGISTROAS<br><br>";
            } else {
                echo "MAS DE UN REGISTRO<br><br>";
            }
        }
    }
}
function exportUsuariosColpatria(){
    $conn = new Conexion();
    $SQL = "SELECT t1.id, t1.id_group, t2.name AS GRUPO, t1.identificacion AS IDENTIFICACION, t1.name AS 'NOMBRE COMPLETO', 
            t1.username AS USUARIO, t1.date_created AS 'FECHA DE CREACION', t1.correoelectronico AS CORREO, 
            IF(t1.status = 1, 'Activo', 'Inactivo') AS ESTADO
            FROM `user` AS t1 
            INNER JOIN `group` AS t2 ON(t2.id = t1.id_group)
            WHERE t1.id_group NOT IN (6, 3) AND t1.username NOT LIKE 'ICOL%' AND t1.username NOT LIKE 'IING%'";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-Encoding: UTF-8");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=exportUsuariosColpatria_".date('his').".csv");
            header("Expires: 0");
            header("Pragma: public");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM

            $fh = fopen( 'php://output', 'w' );
            $header = array('id', 'id_group', 'GRUPO', 'IDENTIFICACION', 'NOMBRE COMPLETO', 'USUARIO', 'FECHA DE CREACION', 'CORREO', 'ESTADO');
            fputcsv($fh, $header, ';');
            while($consulta = $conn->sacarRegistro('str'))
                fputcsv($fh, $consulta, ';');
            // Close the file
            fclose($fh);
            // Make sure nothing else is sent, our file is done
            exit;
        }
    }
}
function subirRestanteImagenes(){
    $i = 1;
    $path = '/var/www/html/Almacenamiento.Serverfin04';///imagenes_efectivas
    $conn = new Conexion();
    $files = scandir($path.'/imagenes_efectivas');
    $fp = fopen("files/subirRestanteImagenes/subirRestanteImagenes_salida.csv", "a");
    fwrite($fp, "NUMERO;OLDNAME;NEWNAME;ESTADO".PHP_EOL);
    foreach($files as $file){
        if($file != '..' && $file != '.'){
            //echo $file."<br>";
            $fi_p = explode('.', $file);
            $f_name = $fi_p[0];
            $SQL = "SELECT * 
                    FROM  `image` 
                    WHERE filename LIKE  '$f_name%'";
            if($conn->consultar($SQL)){
                $tam = $conn->getNumeroRegistros();
                if($tam == 1){
                    $consulta = $conn->sacarRegistro('str');
                    $name = $consulta['filename'];
                    //echo "UNO<br>";
                    if(copy($path.'/imagenes_efectivas/'.$file, $path.'/imagenes_copiadas/'.$name)){
                        if(unlink($path.'/imagenes_efectivas/'.$file))
                            fwrite($fp, $i.";".$file.";".$name.";COPIADO_ELIMINADO".PHP_EOL);
                        else
                            fwrite($fp, $i.";".$file.";".$name.";COPIADO_NOELIMINADO".PHP_EOL);
                    }else
                        fwrite($fp, $i.";".$file.";".$name.";NOCOPIADO_NOELIMINADO".PHP_EOL);
                }elseif($tam == 0){
                    //echo "CERO<br>";
                    fwrite($fp, $i.";".$file.";".$file.";CERO_REGISTROS".PHP_EOL);
                }else{
                    //echo "MAS<br>";
                    fwrite($fp, $i.";".$file.";".$file.";MAS_REGISTROS".PHP_EOL);
                }
            }
        }
        //echo $i."<br><br>";
        $i++;
    }
}
function subirRestanteImagenes_2(){
    $i = 1;
    $j = 0;
    $path = '/var/www/html/Almacenamiento.Serverfin04';
    $conn = new Conexion();
    $files = scandir($path.'/imagenes_efectivas');
    $fp = fopen("files/subirRestanteImagenes_2/subirRestanteImagenes_2_salida.csv", "a");
    //fwrite($fp, "NUMERO;OLDNAME;NEWNAME;ESTADO".PHP_EOL);
    foreach($files as $file){
        if($file != '..' && $file != '.'){
            //echo $file."<br>";
            $fi_p = explode(' ', $file);
            $f_p = array();
            for($i_1 = 0; $i_1 < count($fi_p); $i_1++){
                if(trim($fi_p[$i_1]) !== '')
                    $f_p[] = trim($fi_p[$i_1]);
            }
            //echo json_encode($f_p)."<br>";
            if(count($f_p) === 2){// && strlen($f_p[2]) === 5){
                //echo $file."<br>";
                $j++;
                $document = $f_p[0];
                $num = 1;
                if(strtoupper($f_p[1][0]) === 'A')
                    $num = 1;
                elseif(strtoupper($f_p[1][0]) === 'B')
                    $num = 2;
                elseif(strtoupper($f_p[1][0]) === 'C' || strtoupper($f_p[1][0]) === 'D')
                    $num = 3;
                if($num !== 0){
                    $SQL = "SELECT t1.* FROM image AS t1
                            INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
                            INNER JOIN client AS t3 ON(t3.id = t2.id_client)
                            WHERE t3.document = $document
                            AND t1.id_imagetype = $num
                            ORDER BY t1.date_created DESC
                            LIMIT 1";
                    if($conn->consultar($SQL)){
                        $tam = $conn->getNumeroRegistros();
                        if($tam === 1){
                            $consulta = $conn->sacarRegistro('str');
                            $name = $consulta['filename'];
                            if(copy($path.'/imagenes_efectivas/'.$file, $path.'/imagenes_copiadas/'.$name)){
                                if(unlink($path.'/imagenes_efectivas/'.$file))
                                    fwrite($fp, $i.";".$file.";".$name.";COPIADO_ELIMINADO".PHP_EOL);
                                else
                                    fwrite($fp, $i.";".$file.";".$name.";COPIADO_NOELIMINADO".PHP_EOL);
                            }else
                                fwrite($fp, $i.";".$file.";".$name.";NOCOPIADO_NOELIMINADO".PHP_EOL);
                            //echo "UNO<br>";
                        }else{
                            //echo "DIFERENTE: $tam<br>";
                            if(copy($path.'/imagenes_efectivas/'.$file, $path.'/imagenes_no_encontradas/'.$file)){
                                if(unlink($path.'/imagenes_efectivas/'.$file))
                                    fwrite($fp, $i.";".$file.";".$file.";NOENCONTRADO_COPIADO_ELIMINADO".PHP_EOL);
                                else
                                    fwrite($fp, $i.";".$file.";".$file.";NOENCONTRADO_COPIADO_NOELIMINADO".PHP_EOL);
                            }else
                                fwrite($fp, $i.";".$file.";".$file.";NOENCONTRADO_NOCOPIADO_NOELIMINADO".PHP_EOL);
                        }
                    }
                    //echo $file."<br>".$SQL."<br><br>";
                }
            }
        }
        //echo $i."<br><br>";
        $i++;
    }
    echo $j;
}
function buscarImagenesFaltantes(){
    $conn = new Conexion();
    $path1 = '/var/www/html/Aplicativos.Serverfin04/images_colpatria';
    $path2 = '/var/www/html/Almacenamiento.Serverfin04/images_colpatria';
    $SQL = "SELECT t1.original_file, t1.filename, t2.date_created,
            t3.document, t3.firstname, t2.log_planilla, t2.log_lote
            FROM image AS t1 
            INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
            INNER JOIN client AS t3 ON(t3.id = t2.id_client)
            WHERE t1.original_file NOT LIKE '%MULTI%'";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            $fp = fopen("files/buscarImagenesFaltantes/buscarImagenesFaltantes_1_salida.csv", "a");
            fwrite($fp, "DOCUMENTO;NOMBRE;PLANILLA;LOTE;FECHA CREACIO;ORIGINAL NOMBRE;NOMBRE FISICO;ESTADO".PHP_EOL);
            while($consulta = $conn->sacarRegistro('str')){
                $filename = $consulta['filename'];
                $documento = $consulta['document'];
                $nombre = $consulta['firstname'];
                $planilla = $consulta['log_planilla'];
                $lote = $consulta['log_lote'];
                $fecha = $consulta['date_created'];
                $origina = $consulta['original_file'];
                if(file_exists($path1.DS.$filename))
                    fwrite($fp, "$documento;$nombre;$planilla;$lote;$fecha;$origina;$filename;EXISTE".PHP_EOL);
                else
                    fwrite($fp, "$documento;$nombre;$planilla;$lote;$fecha;$origina;$filename;NO_EXISTE".PHP_EOL);
            }
        }
    }
}
function updateClientesNoSeguros(){
    $conn = new Conexion();
    $SQL = "SELECT t1.id 
            FROM `client` AS t1 
            LEFT OUTER JOIN form AS t2 ON(t2.id_client = t1.id)
            WHERE t2.id IS NULL
            AND t1.type != ''
            AND estado != 2";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            $fp = fopen("files/updateClientesNoSeguros/updateClientesNoSeguros_salida.csv", "a");
            fwrite($fp, "ID;ESTADO".PHP_EOL);
            while($consulta = $conn->sacarRegistro('str')){
                $SQU = "UPDATE client SET type = '' WHERE id = ".$consulta['id'];
                if($conn->ejecutar($SQU)){
                    echo "CLIENTE ${consulta['id']} ACTUALIZADO";
                    fwrite($fp, "${consulta['id']};ACTUALIZADO".PHP_EOL);
                }else{
                    echo "CLIENTE ${consulta['id']} NO_ACTUALIZADO";
                    fwrite($fp, "${consulta['id']};NO_ACTUALIZADO".PHP_EOL);
                }
            }
        }
    }
}
?>