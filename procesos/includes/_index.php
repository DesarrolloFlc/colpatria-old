<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';
require_once PATH_CLASS . DS . '_conexion.php';
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
//EliminarGestionesPorFechas2();
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
//clientesDataCreditoEnDocFinder();
//DownloadAllCytis();
//DownloadAllCytis_2();
//cambiarHoraEntrevista();
//cambiarGestionUsuario();
//subirParamPaises();
//subirParamMonedas();
//subirCiudadesPaises();
//buscarMigracion();
//updateAprobacionFecha();
//datosTelefonicoPersonaNatural();
//imagenesExistente2();
//imagenesExistente3();
//dataActualizacionesColpatria();
//actualizarFormatoAutosTelefon();
//buscarDatosPorTelefono();
//buscarDatosTelefonoPorDocumento();
//dataActualizacionesColpatriaCapi();
//reporteCapiFecha();
//correccionFechaPublicacion();
//obtenerTelefonosClientes();
//confirmSinGrabacion();
//eliminarDuplicadosData();
//inforImagenesCliente();
//reporteCallCapiCompleto();
//reporteDigitacionCompleto();
//jsonClients();
//ultimosContactos();
//ultimosContactosTotal();
//eliminarDuplicadosDevoluciones();
//ordenesNoListasAprobar();
//eliminarLotePlanillaOrdenDeProduccion();
//documentosEspecialesNoEspeciales();
//updateComplementariosRadicados();
//baseSegurosDatosAVerificar();
//corregirDataDocumento();
//corregirDataGenero();
//corregirDataFechaNacimiento();
//actualizarDataSexoMasivo();
//datosContactoEstratos();
//corregirNacionalidades();
//dataCompletaCapi();
//corregirDatosPEPS();
//busquedaTelefonos();
//arreglarFechasConSlash();
//arreglarFechasConGuion();
//busquedaCorreoElectronico();
//informeDocumentosCarpetaVirtual();
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
    $temp = file('files/UpdateANDGetClientsCapi/updateFechaAprobacionRadicado68.csv');
    $fp = fopen("files/UpdateANDGetClientsCapi/ClienteCapiMarcdosPredictivo_salida_ACT68.csv", "a");
    fwrite($fp, "ID;DOCUMENTO;TELEFONO;ESTADO".PHP_EOL);
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
        //$cuidadlaboral = ""; //O
        //$direccionlaboral = ""; //P 
        //$telefonolaboral = trim($datos_leer[16]); //Q
        $direccionresidencia = trim($datos_leer[19]); //T
        $telefonoresidencia1 = trim($datos_leer[20]); //U
        $telefonoresidencia2 = trim($datos_leer[21]); //V
        $ciudadresidencia = getCiudadDANE(trim($datos_leer[22])); //W
        $correoelectronico = trim($datos_leer[23]); //X
        $sucursal = trim($datos_leer[24]); //Y
        //$sucursal = ""; //Y
        $fechanacimientoP = explode('/', trim($datos_leer[25])); //Z
        $fechanacimiento = $fechanacimientoP[2] . "-" . $fechanacimientoP[1] . "-" . $fechanacimientoP[0];
        //$fechanacimiento = "";
        $lugarnacimiento = trim($datos_leer[26]); //AA
        $empresa = trim($datos_leer[27]); //AB
		$celular = trim($datos_leer[29]);//AD
		
		if($tipodocumento != 'NIT' || $tipodocumento != 'N'){
            $SQL = "SELECT * FROM client WHERE document = '$cedula'";
            $conexion->consultar($SQL);
            if ($conexion->getNumeroRegistros() > 0) {
                echo $SQL . "<br>";
                echo "SI_EXISTE<br>";
                $consulta = $conexion->sacarRegistro();
                $id_cliente = $consulta['id'];

                $SQLUC = "UPDATE client SET capi = 'Si', firstname = '$firstname $lastname1 $lastname2', estado = '0', persontype = '1' WHERE id = $id_cliente";
                $conexionUC = new Conexion();
                if ($conexionUC->ejecutar($SQLUC))
                    echo "ACTUALIZADO_CLIENTE<br>";
                else
                    echo "NO_ACTUALIZADO_CLIENTE<br>";
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
    						telefonoresidencia2, correoelectronico, id_user, flag, celular
    					)
    					VALUES
    					(
    						$id_cliente, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento', '$lastname1', 
    						'$lastname2', '$firstname', '$fechanacimiento', '$lugarnacimiento', '$ingresos', '$egresos', '$activos', '$pasivos', '$profesion', '$empresa', 
    						'$cuidadlaboral', '$direccionlaboral', '$telefonolaboral', '$ciudadresidencia', '$direccionresidencia', '$telefonoresidencia1', 
    						'$telefonoresidencia2', '$correoelectronico', '1', 'CARGUECAPIMERCADOPREDICTIVO_" . date('Ymd') . "', '$celular'
    					)";
                    echo $SQLI . "<br>";
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

                    $SQLU = "UPDATE data_capi
                      SET sucursal = '$sucursal', fechaexpedicion = '$fechaexpedicion', titulo = '$titulo', digitochequeo = $digitochequeo,
                      consecutivo = $consecutivo, primerapellido = '$lastname1', segundoapellido = '$lastname2', nombres = '$firstname',
                      fechanacimiento = '$fechanacimiento', lugarnacimiento = '$lugarnacimiento', ingresos = '$ingresos', egresos = '$egresos',
                      activos = '$activos', pasivos = '$pasivos', profesion = '$profesion', empresa = '$empresa',
                      ciudadlaboral = '$cuidadlaboral', direccionlaboral = '$direccionlaboral', telefonolaboral = '$telefonolaboral',
                      ciudadresidencia = '$cuidadlaboral', direccionresidencia = '$direccionresidencia', telefonoresidencia1 = '$telefonoresidencia1',
                      telefonoresidencia2 = '$telefonoresidencia2', correoelectronico = '$correoelectronico', celular = '$celular'
                      WHERE id_client = $id_cliente";
                      echo "$SQLU<br>";
                      if($conexion->ejecutar($SQLU)){
                        echo "_ACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                        fwrite($fp, "$id_cliente;$documento;$telefonolaboral;ACTUALIZADO".PHP_EOL);
                      }else{
                        echo "NOACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                        fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOACTUALIZADO".PHP_EOL);
                      }
                }
            } else {
                echo $SQL . "<br>";
                echo "NO_EXISTE<br>";
                $SQLC = "INSERT INTO client 
    					(
    						document, persontype, firstname, type, capi, date_updated, status_migracion, status_form, last_updater, date_updated_document
    					)
    					VALUES
    					(
    						'$cedula','1','$firstname $lastname1 $lastname2','','Si','0000-00-00','Activo','Activo','0','0000-00-00 00:00:00'
    					)";
                echo $SQLC . "<br>";
                $lastID = 0;
                if ($conexion->ejecutar($SQLC)) {
                    $lastID = $conexion->ultimaId();
                    echo "$SQLC<br>";
                    echo "INSERTADO CLIENTE CON CEDULA $cedula<br>";
                    //fwrite($fp, "$lastID;$documento;$telefonolaboral;INSERTADOCLIENTE" . PHP_EOL);
                    //$lastID = $conexion->ultimaId();			
                    $SQLI = "INSERT INTO data_capi 
    						(
    							id_client, sucursal, fechaexpedicion, titulo, digitochequeo, consecutivo, tipodocumento, documento, primerapellido, 
    							segundoapellido, nombres, fechanacimiento, lugarnacimiento, ingresos, egresos, activos, pasivos, profesion, empresa, 
    							ciudadlaboral, direccionlaboral, telefonolaboral, ciudadresidencia, direccionresidencia, telefonoresidencia1, 
    							telefonoresidencia2, correoelectronico, id_user, flag, celular
    						)
    						VALUES
    						(
    							$lastID, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento', '$lastname1', 
    							'$lastname2', '$firstname', '$fechanacimiento', '$lugarnacimiento', '$ingresos', '$egresos', '$activos', '$pasivos', '$profesion', '$empresa', 
    							'$cuidadlaboral', '$direccionlaboral', '$telefonolaboral', '$ciudadresidencia', '$direccionresidencia', '$telefonoresidencia1', 
    							'$telefonoresidencia2', '$correoelectronico', '1', 'CARGUECAPIMERCADOPREDICTIVO_" . date('Ymd') . "', '$celular'
    						)";
                    echo $SQLI . "<br><br>";
                    if ($conexion->consultar($SQLI)) {
                        echo "$SQLI<br>";
                        echo "INSERTADoS DATOS DE CLIENTE CON CEDULA $cedula<br><br>";
                        fwrite($fp, "$lastID;$documento;$telefonolaboral;INGRESADODATA_SINCLIENTEINICIAL_CREADO".PHP_EOL);
                    } else {
                        echo "$SQLI<br>";
                        echo "NOINSERTADoS DATOS DE CLIENTE CON CEDULA $cedula<br><br>";
                        fwrite($fp, "$lastID;$documento;$telefonolaboral;NOINGRESADODATA_SINCLIENTEINICIAL_CREADO".PHP_EOL);
                    }
                } else {
                    echo "$SQLC<br>";
                    echo "NOINSERTADO CLIENTE CON CEDULA $cedula<br><br>";
                    fwrite($fp, "$lastID;$documento;$telefonolaboral;NOINSERTADOCLIENTE" . PHP_EOL);
                }
            }
		}
    }

    echo "Terminado...".$n;
}

function UpdateANDGetClientsCapiJuridico() {
    $conexion = new Conexion();
    $temp = file('files/UpdateANDGetClientsCapiJuridico/ClienteCapiJuridicosMarcdosPredictivo53.csv');
    $fp = fopen("files/UpdateANDGetClientsCapiJuridico/ClienteCapiJuridicosMarcdosPredictivo_salida_53.csv", "a");
    fwrite($fp, "ID;DOCUMENTO;TELEFONO;ESTADO".PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);

        $cedula = trim($datos_leer[4]);
        /*$lastname1 = trim($datos_leer[6]);
        $lastname2 = trim($datos_leer[7]);
        $firstname = trim($datos_leer[8]);*/
        $fechaexpedicionP = split('/', trim($datos_leer[0]));
        $fechaexpedicion = $fechaexpedicionP[2]."-".$fechaexpedicionP[1]."-".$fechaexpedicionP[0]; //A
        $titulo = trim($datos_leer[1]); //B
        $digitochequeo = trim($datos_leer[2]); //C
        $consecutivo = trim($datos_leer[3]); //D
        $documento = trim($datos_leer[4]); //E
        $tipodocumento = getTipoDocumento(trim($datos_leer[5])); //F
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
        $correoelectronico = trim($datos_leer[33]); //AH

        $SQL = "SELECT * FROM client WHERE document = '$cedula'";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() > 0) {
            echo $SQL."<br>";
            echo "SI EXISTE<br>";
            $consulta = $conexion->sacarRegistro();
            $id_cliente = $consulta['id'];

            $SQLUC = "UPDATE client SET capi = 'Si', firstname = '$empresa', estado = '0', persontype = '2' WHERE id = $id_cliente";
            $conexionUC = new Conexion();
            if ($conexionUC->ejecutar($SQLUC))
                echo "ACTUALIZADO_CLIENTE<br>";
            else
                echo "NO_ACTUALIZADO_CLIENTE<br>";

            $conexion2 = new Conexion();
            $SQL2 = "SELECT * FROM data_capi WHERE id_client = $id_cliente";
            echo $SQL2."<br>";
            $conexion2->consultar($SQL2);
            if ($conexion2->getNumeroRegistros() == 0) {
                echo "SIN DATOS <br><br>";
                $SQLI = "INSERT INTO data_capi 
					(
						id_client, sucursal, fechaexpedicion, titulo, digitochequeo, consecutivo, tipodocumento, documento, 
						nombres, ingresos, egresos, activos, pasivos, empresa, 
						ciudadlaboral, direccionlaboral, telefonolaboral, ciudadresidencia, direccionresidencia, telefonoresidencia1, 
						telefonoresidencia2, id_user, flag, celular, correoelectronico, nit, razonsocial
					)
					VALUES
					(
						$id_cliente, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento', 
						'$representante', '$ingresos', '$egresos', '$activos', '$pasivos', '$empresa', 
						'$ciudadlaboral', '$direccionlaboral', '$telefonolaboral', '$ciudadlaboral', '$direccionresidencia', '$telefonoresidencia1', 
						'$telefonoresidencia2', '0', 'CARGUECAPIMERCADOPREDICTIVO_" . date('Ymd') . "', '$telefonoresidencia2', '$correoelectronico',
                        '$documento', '$empresa'
					)";
                echo $SQLI."<br>";
                if ($conexion2->ejecutar($SQLI)) {
                    echo "DATOS INSERTADOS<br>";
                    echo $SQLI."<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;INGRESADO_DT".PHP_EOL);
                } else {
                    echo $SQLI."<br>";
                    echo "ERROR<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOINGRESADO_DT".PHP_EOL);
                }
            }else{
                echo "TIENE DATOS<br><br>";
                $SQLU = "UPDATE data_capi
                        SET sucursal = '$sucursal', fechaexpedicion = '$fechaexpedicion', titulo = '$titulo', 
                        digitochequeo = '$digitochequeo', consecutivo = '$consecutivo', nombres = '$representante',
                        ingresos = '$ingresos', egresos = '$egresos', activos = '$activos', pasivos = '$pasivos', 
                        empresa = '$empresa', razonsocial = '$empresa', nit = '$documento', ciudadlaboral = '$ciudadlaboral', 
                        direccionlaboral = '$direccionlaboral', telefonolaboral = '$telefonolaboral', ciudadresidencia = '$ciudadlaboral', 
                        direccionresidencia = '$direccionresidencia', telefonoresidencia1 = '$telefonoresidencia1',
                        telefonoresidencia2 = '$telefonoresidencia2', flag = 'CARGUECAPIMERCADOPREDICTIVO_" . date('Ymd') . "', celular = '$telefonoresidencia2'
                        WHERE id_client = $id_cliente";
                echo $SQLU."<br>";
                if($conexion2->ejecutar($SQLU)){
                    echo "ACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;ACTUALIZADO_DT".PHP_EOL);
                }else{
                    echo "NOACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOACTUALIZADO_DT".PHP_EOL);
                } 
                $SQLU = "UPDATE data_capi
                        SET nit = '$documento', razonsocial = '$empresa'
                        WHERE id_client = $id_cliente";
                echo $SQLU."<br>";
                if($conexion2->ejecutar($SQLU)){
                    echo "ACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;ACTUALIZADO_DT".PHP_EOL);
                }else{
                    echo "NOACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
                    fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOACTUALIZADO_DT".PHP_EOL);
                } 
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
        }else{
            echo "NO EXISTE<br><br>";
            $SQLC = "INSERT INTO client
                    (
                        document, persontype, firstname, type, flag, capi, 
                        date_updated, status_migracion, status_form, last_updater, 
                        date_updated_document
                    )
                    VALUES
                    (
                        '$cedula', 2, '$empresa', '', 'CARGUECAPIMERCADOPREDICTIVO_20140821', 'Si',
                        '0000-00-00', 'Activo', 'Inactivo', '0', '0000-00-00 00:00:00'
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
                            telefonoresidencia2, id_user, flag, celular
                        )
                        VALUES
                        (
                            $lastID, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento',
                            '$representante', '$ingresos', '$egresos', '$activos', '$pasivos', '$empresa',
                            '$ciudadlaboral', '$direccionlaboral', '$telefonolaboral', '$ciudadlaboral', '$direccionresidencia', '$telefonoresidencia1',
                            '$telefonoresidencia2', '0', 'CARGUECAPIMERCADOPREDICTIVO_" . date('Ymd') . "', '$telefonoresidencia2'
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
            }
        }
    }
    fclose($fp);
    echo "Terminado...".$n;
}

function insertGestionNoContacto() {
    $conexion = new Conexion();
    $temp = file('files/insertGestionNoContacto/insertGestionNoContacto42.csv');
    $n = count($temp);
    $fp = fopen("files/insertGestionNoContacto/insertGestionNoContacto_salida42.csv", "a");
    fwrite($fp, "IDREGISTRO;ID;DOCUMENTO;FECHA;CAMPAÑA;ESTADO" . PHP_EOL);
    echo $n . " Cantidad de registros<br>";
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        //$id = trim($datos_leer[0]);
        $ced = trim($datos_leer[0]);

        $tipo_contacto = trim($datos_leer[3]);
        $contacto_str = trim($datos_leer[1]);
        //$telefonoresidencia1 = trim($datos_leer[1]);

        /* $fecp = explode(' ', trim($datos_leer[2]));
          $fecpart = explode('/', $fecp[0]); */
        $fecpart = explode('/', trim($datos_leer[2]));
        $observacion = trim($datos_leer[4]);

        $hor = rand(8, 19);
        $min = rand(0, 59);
        $seg = rand(0, 59);
        $fecha = $fecpart[2] . "-" . $fecpart[1] . "-" . $fecpart[0] . " $hor:$min:$seg";

        $SQL = "SELECT t1.*
                  FROM data_capi AS t1
                 INNER JOIN client AS t2 ON(t1.id_client = t2.id)
                 WHERE t2.document = $ced";
                echo $SQL."<br>";
        //$SQL =  "SELECT * FROM data_capi WHERE id_client = $id";
        $conexion->consultar($SQL);
        if($conexion->getNumeroRegistros() > 0){
            echo "SE_ENCONTRO CLIENTE CON ID $id_cliente y CEDULA $ced<br><br>";
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
            //if($tipo_contacto == '10')
                //$observacion = 	$telefonoresidencia1." ".$contacto_str;
            //else
                //$observacion = 	$telefonoresidencia1." NO CONTESTAN";

            $SQLU = "INSERT INTO data_capi_confirm
                    (
                        id_client, id_user, id_contact, documento, primerapellido, segundoapellido, nombres, fechanacimiento,
                        id_profesion, id_ingresos, id_egresos, activos, pasivos, direccionlaboral, id_ciudad, direccionresidencia,
                        telefonoresidencia, observacion, date_created, status
                    )
                    VALUES
                    (
                        $id_cliente, 3206, '$tipo_contacto', '$documento', '$primerapellido', '$segundoapellido', '$nombres', 
                        '$fechanacimiento', '0', '0', '0', '0', '0', '$direccionlaboral', 0, '$direccionresidencia',
                        '$telefonoresidencia1', '$observacion', '$fecha', 1
                    )";
            echo $SQLU."<br>";
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
            echo "NO SE ENCONTRO CLIENTE CON ID $id_cliente y CEDULA $ced<br><br>";
            fwrite($fp, "0;0;$ced;$fecha;CAPI;NO_ENCONTRADO".PHP_EOL);
            /*$conexion1 = new Conexion();
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
            }*/
        }
    }
    echo "Terminado...";
    //fclose($fp);
}

function insertGestionNoContactoSeguros() {
    $conexion = new Conexion();
    $temp = file('files/insertGestionNoContactoSeguros/insertGestionNoContactoSeguros14.csv');
    $n = count($temp);
    $fp = fopen("files/insertGestionNoContactoSeguros/insertGestionNoContactoSeguros_salida2_14.csv", "a");
    fwrite($fp, "ID;DOCUMENTO;FECHA;ESTADO" . PHP_EOL);
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);


        //$id = trim($datos_leer[0]);
        $ced = trim($datos_leer[0]);
        $id_contact = trim($datos_leer[2]);

        $fecp = trim($datos_leer[1]);
        $fecpart = explode('/', $fecp);
        $hor = rand(8, 19);
        $min = rand(0, 59);
        $seg = rand(0, 59);
        $fecha = $fecpart[2] . "-" . $fecpart[1] . "-" . $fecpart[0] . " $hor:$min:$seg";
        $observ = strtoupper(trim($datos_leer[4]));
        //$id_user = trim($datos_leer[6]);

        /* $SQL =  "SELECT t1.*, t2.* FROM data AS t1 
          INNER JOIN form AS t2 ON(t1.id_form = t2.id)
          INNER JOIN client AS t3 ON(t2.id_client = t3.id)
          WHERE t3.documento = $ced"; */
        $SQL = "SELECT t1.*, 
                       t2.id_client, 
                       t2.id AS id_form_, 
                       t3.persontype AS typeperson 
                  FROM data AS t1 
				 INNER JOIN form AS t2 ON(t1.id_form = t2.id)
				 INNER JOIN client AS t3 ON(t2.id_client = t3.id) 
				 WHERE t3.document = '$ced'
				 ORDER BY t2.date_created DESC
				 LIMIT 1";
        //echo $SQL;
        //$SQL =  "SELECT * FROM data_capi WHERE id_client = $id";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() > 0) {
            echo "SE_ENCONTRO CLIENTE CON ID $id_cliente y CEDULA $ced<br>";
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
            //$observacion = $telefonoresidencia1.trim($datos_leer[1]);
            $observacion = $observ;
            $id_user = 3206;
            $SQLU = "INSERT INTO data_confirm
					(
						id_client, id_form, persontype, id_user, id_contact, documento, primerapellido, segundoapellido, nombres, profesion, 
						ingresosmensuales, egresosmensuales, activosemp, pasivosemp, direccionoficinappal, ciudadresidencia, direccionresidencia, 
						telefonoresidencia, observacion, date_created, status
					)
					VALUES
					(
						$id_cliente, $id_form, '$persontype', '$id_user', '$id_contact', '$documento', '$primerapellido', '$segundoapellido', '$nombres', '0',
						'0', '0', '0', '0', '$direccionlaboral', '0', '$direccionresidencia',
						'$telefonoresidencia1', '$observacion', '$fecha', '1'
					)";
            echo $SQLU."<br>";
            //$SQLU = "UPDATE data_confirm 
              //SET id_form = $id_form, persontype = $persontype, id_user = 2090
              //WHERE id_client = $id_cliente AND id_contact = 8 AND id_user = 2060";
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
        }else{
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
    $temp = file('files/UpdateFechasGestiones/UpdateFechasGestiones8.csv');
    $n = count($temp);
    $fp = fopen("files/UpdateFechasGestiones/UpdateFechasGestiones_salida8.csv","a");
    fwrite($fp, "Tipo gestion;Gestion;IdGestion;Documento;Fecha de gestion;cantidad;error;campaña".PHP_EOL);
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        //$fec = trim($datos_leer[4]);
        //$fecp = explode(' ', $fec);
        //$fecpart = explode('/', $fecp[0]);
        $t1 = explode(' ', trim($datos_leer[4]));
        $fecpart = explode('/', $t1[0]);

        //$hor = rand(8,23);
        //$min = rand(0,59);
        $seg = rand(0, 59);

        //$fecha = $fecpart[2]."-".$fecpart[1]."-".$fecpart[0]." $hor:$min:$seg";
        //$fecha = $fecpart[2]."-".$fecpart[1]."-".$fecpart[0]." ".$fecp[1];
        $fecha = $fecpart[2] . "-" . $fecpart[1] . "-" . $fecpart[0];

        $t2 = explode(' ', trim($datos_leer[3]));
        $fecopart = explode('/', $t2[0]);
        $fecha_old = $fecopart[2] . "-" . $fecopart[1] . "-" . $fecopart[0];

        $gestion = trim($datos_leer[2]);
        $gestionSTR = trim($datos_leer[1]);
        $documento = trim($datos_leer[0]);
        /* $SQL = "SELECT COUNT(*) AS cantidad, t2.id 
          FROM data_capi_confirm AS t1
          LEFT JOIN client AS t2 ON(t1.id_client = t2.id)
          WHERE t2.document = '$documento' AND t1.id_contact = $gestion"; */
        $SQL = "SELECT COUNT('x') AS cantidad, 
                       t2.id, 
                       t1.date_created
                  FROM data_capi_confirm AS t1 
                  LEFT JOIN client AS t2 ON(t1.id_client = t2.id)
                 WHERE t2.document = '$documento' 
                   AND t1.id_contact = $gestion
                   AND (t1.date_created BETWEEN '$fecha_old 00:00:00' AND '$fecha_old 23:59:59')";
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
                if($conexion1->ejecutar($SQLU)){
                  //$conexion1->desconectar();
                  fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;ACTUALIZADO;CAPI".PHP_EOL);
                  echo "EL CLIENTE CON DOCUMENTO # $documento Y GESTION $gestionSTR FUE ACTUALIZADO A LA FECHA $fecha<br><br>";
                }else{
                  //$conexion1->desconectar();
                  echo "NO SE PUDO ACTUALIZAR CLIENTE CON DOCUMENTO $documento<br><br>";
                  $tipoGes = trim($datos_leer[1]);
                  fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;NOACTUALIZADO;CAPI".PHP_EOL);
                  }
                echo "1 GESTION CAPI<br><br>";
            } else {
                //echo "MAS DE UNA GESTION<br>";
                //fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;MASDEUNAGESTION".PHP_EOL);
                if ($cantidad == 0) {
                    $SQL2 = "SELECT COUNT('x') AS cantidad, 
                                    t2.id, 
                                    t1.date_created
                               FROM data_confirm AS t1
                              INNER JOIN form ON(form.id = t1.id_form)
                               LEFT JOIN client AS t2 ON(form.id_client = t2.id)
                              WHERE t2.document = '$documento' 
                                AND t1.id_contact = $gestion
                                AND (t1.date_created BETWEEN '$fecha_old 00:00:00' AND '$fecha_old 23:59:59')";
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
                            if($conexion1->ejecutar($SQLU)){
                              //$conexion1->desconectar();
                              fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;ACTUALIZADO;SEGUROS".PHP_EOL);
                              echo "EL CLIENTE CON DOCUMENTO # $documento Y GESTION $gestionSTR FUE ACTUALIZADO A LA FECHA $fecha<br><br>";
                            }else{
                              //$conexion1->desconectar();
                              echo "NO SE PUDO ACTUALIZAR CLIENTE CON DOCUMENTO $documento<br><br>";
                              $tipoGes = trim($datos_leer[1]);
                              fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;NOACTUALIZADO;SEGUROS".PHP_EOL);
                            }
                            echo "1 GESTION SEGUROS<br><br>";
                        } else {
                            if ($cantidad == 0) {
                                echo "0 GESTIONES<br>";
                                fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;CEROGESTION;NINGUNO".PHP_EOL);
                            } else {
                                echo "MAS DE UNA GESTION<br>";
                                fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;MASDEUNAGESTION;SEGUROS".PHP_EOL);
                            }
                        }
                    } else {
                        echo "LA CEDULA $documento NO TIENE REGISTROS<br><br>";
                    }
                } else {
                    echo "MAS DE UNA GESTION $cantidad<br>";
                    fwrite($fp, "OK;$gestionSTR;$gestion;$documento;$fecp;$cantidad;MASDEUNAGESTION;CAPI".PHP_EOL);
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
        case 'D':
            $return = 'DNI';
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

function usuariosYOficiales(){
    $conexion = new Conexion();
    $temp = file('files/usuariosYOficiales/usuariosYOficiales7.csv');
    $fp = fopen("files/usuariosYOficiales/usuariosYOficiales_salida7.csv", "a");
    fwrite($fp, "ID;FECHAC;NOMBRE;DOCUMENTO;APLICATIVO;GRUPO;EMAIL;FATHER;EFATHER;USER;ESTADO_U;ESTADO_O" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for($i = 1; $i < $n; $i++){
    try{
        $datos_leer = split(";", $temp[$i]);
        /* $name = trim($datos_leer[1]);//Jimenez Bedoya, Yuli Caterine
          $namep = explode(',', $name);//[0]Jimenez Bedoya[1] Yuli Caterine
          $namecomple = trim($namep[1]).' '.trim($namep[0]); */
        $namecomple = trim($datos_leer[1]); //B

        $document = trim($datos_leer[2]);//C
        $permisos = trim($datos_leer[4]);//E
        $correo = trim($datos_leer[5]);//F
        $father = trim($datos_leer[6]);//G
        $correopadre = trim($datos_leer[7]);//H
        $usuario = trim($datos_leer[8]);//I
        if($usuario == '')
            $usuario = 'ECOL'.substr($document, -4);//I
        //$usuario = trim($datos_leer[8]);//I
        $SQL = "SELECT * FROM user WHERE identificacion = '$document'";
        echo $SQL."<br>";
        $conexion->consultar($SQL);
        if ($conexion->getNumeroRegistros() == 1){
            //existe el usuario con $ducumento
            /*$consulta = $conexion->sacarRegistro();
            $id = $consulta['id'];
            $username = $consulta['username'];
            $fecha_creacion = $consulta['date_created'];
            $SQLU1 = "UPDATE user SET name = '$namecomple', correoelectronico = '$correo', 
                    sucursal = 'COLPATRIA_MASIVO_16082014', status = '1', cargo = 'radicador'
                    WHERE id = $id";
            echo $SQLU1."<br><br>";
            $conexion->ejecutar($SQLU1);
            $SQOFI = "SELECT id FROM official WHERE id = $id";
            if($conexion->consultar($SQOFI)){
                if($conexion->getNumeroRegistros() == 0){
                    $SQIOFI = "INSERT INTO official
                                (id, identificacion, name, email, email_father)
                                VALUES
                                ($id, '$document', $namecomple, $correo, $correopadre)";
                    if($conexion->ejecutar($SQIOFI))
                        fwrite($fp, "ID;$fecha_creacion;$namecomple;$document;DOC FINDER;radicador;$correo;$father;$correopadre;$usuario;USER-UG;OFICIAL-IG".PHP_EOL);
                    else
                        fwrite($fp, "ID;$fecha_creacion;$namecomple;$document;DOC FINDER;radicador;$correo;$father;$correopadre;$usuario;USER-UG;OFICIAL-IE".PHP_EOL);
                }else{
                    $SQUOFI = "UPDATE official SET identificacion = '$document', name = '$namecomple', 
                                email = '$correo', email_father = '$correopadre'
                                WHERE id = $id";
                    if($conexion->ejecutar($SQUOFI))
                        fwrite($fp, "$id;$fecha_creacion;$namecomple;$document;DOC FINDER;radicador;$correo;$father;$correopadre;$usuario;USER-UG;OFICIAL-UG".PHP_EOL);
                    else
                        fwrite($fp, "$id;$fecha_creacion;$namecomple;$document;DOC FINDER;radicador;$correo;$father;$correopadre;$usuario;USER-UG;OFICIAL-UE".PHP_EOL);
                }
            }
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
        }else{
            $fecha_creacion = date('Y-m-d H:i:s');
            //no existe el usuario con $ducumento
            if($conexion->getNumeroRegistros() == 0){
                $uus = '';
                $SQLI = "INSERT INTO user
						 (
						 	id_group, username, password, identificacion, name, status, sucursal, correoelectronico, cargo
						 )
						 VALUES
						 (
						 	2, '$usuario', '$document', '$document', '$namecomple', 1, 'COLPATRIA_MASIVO_12122016', '$correo', 'radicador'
						 )";
                echo $SQLI."<br><br>";
                if($conexion->ejecutar($SQLI)){
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
                    if($conexion->ejecutar($SQLI1)){
                        $uus = 'USER-IG';
                        fwrite($fp, "$ultimaId;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;$uus;OFICIAL-IG" . PHP_EOL);
                    }else{
                        $uus = 'USER-IE';
                        fwrite($fp, "$ultimaId;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;$uus;OFICIAL-IE" . PHP_EOL);
                    }
                }else{
                    fwrite($fp, "NULL;$fecha_creacion;$namecomple;$document;DOC FINDER;$permisos;$correo;$father;$correopadre;$username;USER-IE;OFICIAL-IE" . PHP_EOL);
                }
            }else{
                echo "creado mas de una vez<br><br>";
            }
        }
    }catch(PDOException $e_pdo){
        $fp_ = fopen("files/usuariosYOficiales/usuariosYOficiales_exception7.csv", "a");
        fwrite($fp_, $temp[$i]."|".json_encode($e_pdo).PHP_EOL);
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

function updateGestionesFormFecha(){
    $conexion = new Conexion();
    $temp = file('files/updateGestionesFormFecha/updateGestionesFormFecha30.csv');
    $fp = fopen("files/updateGestionesFormFecha/updateGestionesFormFecha_salida30.csv", "a");
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
                // if ($planilla == '550') {
                  //$comple = ", log_planilla = '694', planilla = 'PLANILLA694'";
                  //}
                $SQLU = "UPDATE form 
						 SET date_created = REPLACE(date_created, '$fecha', '$fecha1')$comple
						 WHERE id = ".$consulta[0];
                echo $SQLU."<br>";
                if($conexion->ejecutar($SQLU)){
                    fwrite($fp, "$documento;$planilla;$lote;$fecha;$fecha1;ACTUALIZADO" . PHP_EOL);
                    echo "ACTUALIZADO<br><br>";
                }else{
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
    $temp = file('files/updateGestionesFormFecha_doc/updateGestionesFormFecha_doc5.csv');
    $fp = fopen("files/updateGestionesFormFecha_doc/updateGestionesFormFecha_doc_salida5.csv", "a");
    fwrite($fp, "IDCONFIRM;DOCUMENTO;FECHAVIEJA;FECHANUEVA;CANTIDAD;ACCION;CAMPANA" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);

        //$fec1 = explode(' ', trim($datos_leer[2]));
        $fec1 = explode(' ', trim($datos_leer[3]));
        $fech1 = explode('/', $fec1[0]);
        $fecha = $fech1[2] . "-" . $fech1[1] . "-" . $fech1[0] . " " . $fec1[1];

        $fech2 = explode('/', trim($datos_leer[4]));
        $fecha1 = $fech2[2] . "-" . $fech2[1] . "-" . $fech2[0] . " " . $fec1[1];

        //$id_usuario = trim($datos_leer[2]);
        $tipocontacto = trim($datos_leer[2]);
        $idconfirm = 0;

        $SQL = "SELECT t1.id, t1.id_user FROM data_confirm AS t1
				INNER JOIN client AS t2 ON(t1.id_client = t2.id)
				WHERE t2.document = '$documento'
				AND t1.date_created LIKE '$fecha%'
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
					 SET date_created = REPLACE(date_created, '$fecha', '$fecha1')
					 WHERE id = $idconfirm";
            echo $SQLU . "<br><br>";
            /*if ($conexion->ejecutar($SQLU)){
                echo "ACTUALIZADO<br><br>";
                fwrite($fp, "$idconfirm;$documento;$id_us_old;$id_usuario;1;ACTUALIZADO;SEGUROS".PHP_EOL);
            }else{
                fwrite($fp, "$idconfirm;$documento;$id_us_old;$id_usuario;1;NO_ACTUALIZADO;SEGUROS".PHP_EOL);
                echo "NO_ACTUALIZADO<br><br>";
            }*/
        } else {
            if ($cant == 0) {
                //echo "cero resultado<br><br>";
                $SQL2 = "SELECT t1.id, t1.id_user FROM data_capi_confirm AS t1
						INNER JOIN client AS t2 ON(t1.id_client = t2.id)
						WHERE t2.document = '$documento'
						AND t1.date_created LIKE '$fecha%'
						AND t1.id_contact = $tipocontacto";
                echo $SQL2 . "<br>";
                $conexion->consultar($SQL2);
                $cant = $conexion->getNumeroRegistros();
                if ($cant == 1) {
                    echo "exactamente un resultado CAPI<br>";
                    $cont = 1;
                    while ($consulta = $conexion->sacarRegistro()) {
                        $idconfirm = $consulta[0];
                        $id_us_old = $consulta[1];
                        $SQLU = "UPDATE data_capi_confirm 
								 SET date_created = REPLACE(date_created, '$fecha', '$fecha1')
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
                    }
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
    //$fp = fopen("files/updateCamposFechaForm/updateCamposFechaForm_salida1.csv", "a");
    //fwrite($fp, "DOCUMENTO;PLANILLA;LOTE;ESTADO" . PHP_EOL);
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
            /*while ($consulta = $conexion->sacarRegistro()) {
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
            }*/
        } else {
            echo "NO TIENE REGISTROS<br><br>";
            //fwrite($fp, "$documento;$planilla;$lote;NO_ACTUALIZADO" . PHP_EOL);
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
    $ruta = '/var/www/html/Aplicativos.Serverfin04/images_colpatria/';
    $ano = date('Y', strtotime('-6 years'));
    /*$SQL = "SELECT * 
			FROM image AS t1
			WHERE 1
			GROUP BY id_forma";*/
    /*$SQL = "SELECT t1.id, t1.id_forma, t1.filename, t2.id_client, t3.document, t3.firstname, t1.date_created 
              FROM image AS t1
             INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
             INNER JOIN client AS t3 ON(t3.id = t2.id_client)
             WHERE t1.date_created BETWEEN '2014-01-01' AND '2016-02-01'
             ORDER BY t1.date_created ASC";
    $SQL = "SELECT t1.id, t1.id_forma, t1.filename, t2.id_client, t3.document, t3.firstname, t1.date_created
              FROM image AS t1
             INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
             INNER JOIN client AS t3 ON(t3.id = t2.id_client)
             WHERE t1.date_created < '2014-01-01'
             ORDER BY t1.date_created ASC";*/
    $SQL = "SELECT t1.id, t1.id_forma, t1.filename, t2.id_client, t3.document, t3.firstname, t1.date_created
              FROM image AS t1
             INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
             INNER JOIN client AS t3 ON(t3.id = t2.id_client)
             WHERE DATE_FORMAT(t1.date_created, '%Y') <= :ano
             ORDER BY t1.date_created ASC";
    if ($conn->consultar($SQL, [':ano'=> $ano])) {
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
            fputcsv($fh, array('ID_IMAGEN', 'ID_FORMA', 'ID_CLIENTE', 'DOCUMENTO', 'NOMBRE CLIENTE', 'FECHA_SUBIDA_IMAGEN', 'RUTA', 'ESTADO'), ';');
            while ($consulta = $conn->sacarRegistro('str')) {
                $id_forma = $consulta['id_forma'];
                if(file_exists($ruta . $consulta['filename']))
                    fputcsv($fh, array($consulta['id'], $consulta['id_forma'], $consulta['id_client'], $consulta['document'], $consulta['firstname'], $consulta['date_created'], $ruta.$consulta['filename'], 'EXISTE'), ';');
                else
                    fputcsv($fh, array($consulta['id'], $consulta['id_forma'], $consulta['id_client'], $consulta['document'], $consulta['firstname'], $consulta['date_created'], $ruta.$consulta['filename'], 'NO_EXISTE'), ';');
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
    $SQL = "SELECT t1.id, 
                   t1.id_group, 
                   t2.name AS GRUPO, 
                   t1.identificacion AS IDENTIFICACION, 
                   t1.name AS 'NOMBRE COMPLETO', 
                   t1.username AS USUARIO, 
                   t1.date_created AS 'FECHA DE CREACION', 
                   t1.correoelectronico AS CORREO, 
                   IF(t1.cargo = 'radicador', 'SI', 'NO') AS RADICADOR, 
                   IF(t1.status = 1, 'Activo', 'Inactivo') AS ESTADO
              FROM user AS t1 
             INNER JOIN `group` AS t2 ON(t2.id = t1.id_group)
             WHERE t1.id_group NOT IN (6, 3) 
               AND t1.username NOT LIKE 'ICOL%' 
               AND t1.username NOT LIKE 'IING%'";
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
            $header = array('id', 'id_group', 'GRUPO', 'IDENTIFICACION', 'NOMBRE COMPLETO', 'USUARIO', 'FECHA DE CREACION', 'CORREO', 'RADICADOR', 'ESTADO');
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
function clientesDataCreditoEnDocFinder(){
    $conn = new Conexion();
    $file_path = dirname(__FILE__);
    $temp = file($file_path.'/files/clientesDataCreditoEnDocFinder/clientesDataCreditoEnDocFinder.csv');
    //$fh = fopen( 'php://output', 'w' );
    $fh = fopen($file_path."/files/clientesDataCreditoEnDocFinder/clientesDataCreditoEnDocFinder_salida.csv", "a");
    fputcsv($fh, array('DOCUMENTO', 'CLIENTES EN EL APLICATIVO', 'SEGUROS', 'CAPI', 'ESTADO'), ';');
    //echo ($n - 1)." Cantidad de registros<br>";
    $n = count($temp);
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $SQL = "SELECT id 
                FROM client
                WHERE document = $documento
                GROUP BY id";
        if($conn->consultar($SQL)){
            if($conn->getNumeroRegistros() == 1){
                $con_ = new Conexion();
                $SGV = '';
                $CAP = '';
                $consulta = $conn->sacarRegistro('str');
                $id = $consulta['id'];
                //SEGUROS
                $SQF = "SELECT id FROM form WHERE id_client = $id";
                if($con_->consultar($SQF)){
                    if($con_->getNumeroRegistros() > 0){
                        $SGV = 'SI';
                    }else
                        $SGV = 'NO';    
                }else
                    $SGV = 'ERROR_CONSULTA';
                //CAPI
                $SQC = "SELECT id FROM data_capi WHERE id_client = $id";
                if($con_->consultar($SQC)){
                    if($con_->getNumeroRegistros() > 0){
                        $CAP = 'SI';
                    }else
                        $CAP = 'NO';    
                }else
                    $CAP = 'ERROR_CONSULTA';

                fputcsv($fh, array($documento, 'SI', $SGV, $CAP, 'DATOS'), ';');
                $con_->desconectar();
            }else
                fputcsv($fh, array($documento, 'NO', 'NO', 'NO', 'NO_EXISTE'), ';');
        }else
            fputcsv($fh, array($documento, 'NO', 'NO', 'NO', 'ERROR_CONSULTA'), ';');
    }
}
function DownloadAllCytis(){
    $link = mysql_connect('localhost', 'colpatria_sgd', 'colpatria_sgd') or die('No se pudo conectar: ' . mysql_error());
    mysql_select_db('paises_mundo') or die('No se pudo seleccionar la base de datos');

    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Description: File Transfer");
    //header("Content-Encoding: UTF-8");
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=exportUsuariosColpatria_".date('his').".csv");
    header("Expires: 0");
    header("Pragma: public");
    //echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $fh = fopen( 'php://output', 'w' );
    fputcsv($fh, array('CIUDAD', 'PAIS', 'CODIGO PAIS', 'ESTADO'), '|');

    $SQL = "SELECT t1.Name AS CIUDAD, t2.Name AS PAIS, t2.Code AS 'CODIGO PAIS', t1.District AS 'ESTADO' 
            FROM `City` AS t1 
            INNER JOIN Country AS t2 ON(t2.Code = t1.CountryCode)
            ORDER BY t2.Name";
    $resp = mysqli_query($SQL, $link);
    while($consulta = mysqli_fetch_array($resp, MYSQL_NUM))
        fputcsv($fh, array($consulta[0], $consulta[1], $consulta[2], $consulta[3]), '|');

    mysql_free_result($resp);
}
function DownloadAllCytis_2(){
    $link = mysql_connect('localhost', 'colpatria_sgd', 'colpatria_sgd') or die('No se pudo conectar: ' . mysql_error());
    mysql_select_db('paises_mundo') or die('No se pudo seleccionar la base de datos');

    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Description: File Transfer");
    //header("Content-Encoding: UTF-8");
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=exportUsuariosColpatria_2_".date('his').".csv");
    header("Expires: 0");
    header("Pragma: public");
    //echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $fh = fopen( 'php://output', 'w' );
    fputcsv($fh, array('CIUDAD', 'PAIS', 'CODIGO PAIS'), '|');

    $SQL = "SELECT t1.Ciudad AS  'CIUDAD', t2.Name AS  'CIUDAD', t1.Paises_Codigo AS  'CODIGO PAIS'
            FROM  `Ciudades` AS t1
            LEFT JOIN Country AS t2 ON ( t2.Code2 = t1.Paises_Codigo ) 
            ORDER BY t2.Name";
    $resp = mysqli_query($SQL, $link);
    while($consulta = mysqli_fetch_array($resp, MYSQL_NUM))
        fputcsv($fh, array($consulta[0], $consulta[1], $consulta[2]), '|');

    mysql_free_result($resp);
}
function cambiarHoraEntrevista(){
    $conn = new Conexion();
    $temp = file('files/cambiarHoraEntrevista/cambiarHoraEntrevista.csv');
    /*$fp = fopen("files/cambiarHoraEntrevista/cambiarHoraEntrevista_salida.csv", "a");
    fwrite($fp, "IDREGISTRO;DOCUMENTO;OLDHORA;NEWHORA;ESTADO".PHP_EOL);*/
    $n = count($temp);
    echo $n;
    for($i = 1; $i < $n; $i++){
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $hora = trim($datos_leer[1]);
        $SQL = "SELECT * 
                FROM data AS t1 
                INNER JOIN form AS t3 ON(t3.id = t1.id_form)
                INNER JOIN client AS t2 ON(t2.id = t3.id_client)
                WHERE t2.document = $documento";
        echo $SQL."<br>";
        if($conn->consultar($SQL)){
            $tam = $conn->getNumeroRegistros();
            if($tam == 1){
                echo "EXACTAMENTE UNO<br><br>";
            }elseif($tam > 1){
                echo "MAS DE UN REGISTRO<br><br>";
            }else{
                echo "CERO REGISTROS<br><br>";
            }
        }else{
            echo "ERROR_CONSULTA<br><br>";
        }
    }
}
function cambiarGestionUsuario(){
    $conn = new Conexion();
    $temp = file('files/cambiarGestionUsuario/cambiarGestionUsuario.csv');
    $fp = fopen("files/cambiarGestionUsuario/cambiarGestionUsuario_salida.csv", "a");
    fwrite($fp, "IDREGISTRO;DOCUMENTO;IDCONTACTO;FECHA;OLDUSER;NEWUSER;ESTADO".PHP_EOL);
    $n = count($temp);
    echo $n;
    for($i = 1; $i < $n; $i++){
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $tipo_documento = trim($datos_leer[1]);
        $gestion_id = trim($datos_leer[4]);

        $fec = trim($datos_leer[34]);
        $f_p = explode(' ', $fec);
        $f_ps = explode('/', $f_p[0]);
        $fecha_gestion = $f_ps[2].'-'.$f_ps[1].'-'.$f_ps[0].' '.$f_p[1];
        $tipo = 't1.documento';
        if($tipo_documento == 2)
            $tipo = 't1.nit';
        $SQL = "SELECT t1.id, t1.id_user 
                FROM data_confirm AS t1
                WHERE $tipo = $documento
                AND t1.id_contact = $gestion_id
                AND t1.date_created LIKE '$fecha_gestion%'";
        echo $SQL."<br>";
        if($conn->consultar($SQL)){
            $tam = $conn->getNumeroRegistros();
            if($tam == 1){
                echo "EXACTAMENTE<br>";
                $consulta = $conn->sacarRegistro('str');
                $old_user = $consulta['id_user'];
                $id = $consulta['id'];
                $SQU = "UPDATE data_confirm SET id_user = '3154' WHERE id = $id";
                if($conn->ejecutar($SQU)){
                    echo "ACTUALIZADO<br><br>";
                    fwrite($fp, "$id;$documento;$gestion_id;$fec;$old_user;3154;ACTUALIZADO".PHP_EOL);
                }else{
                    echo "NO_ACTUALIZADO<br><br>";
                    fwrite($fp, "$id;$documento;$gestion_id;$fec;$old_user;3154;NO_ACTUALIZADO".PHP_EOL);
                }
            }elseif($tam > 1){
                echo "MAS<br><br>";
                fwrite($fp, "NULL;$documento;$gestion_id;$fec;0;3154;MAS".PHP_EOL);
            }else{
                echo "CERO<br><br>";
                fwrite($fp, "NULL;$documento;$gestion_id;$fec;0;3154;CERO".PHP_EOL);
            }
        }else{
            echo "NO_CONSULTA<br><br>";
            fwrite($fp, "NULL;$documento;$gestion_id;$fec;0;3154;ERROR_CONSULTA".PHP_EOL);
        }
    }
    echo "TERMINO...";
}
function subirParamPaises(){
    $temp = file('files/subirParamPaises/subirParamPaises.csv');
    $n = count($temp);
    echo $n;
    $username = 'colpatria_sgd';
    $password = 'colpatria_sgd';
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=colpatria_sgd_;charset=utf8", $username, $password);
        if(!$dbh){
            echo "No se pudo conectar a la base de datos";
            exit();
        }
        $dbh->exec("set names utf8");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        for($i = 1; $i < $n; $i++){
            $datos_leer = split(";", $temp[$i]);
            $codigo = trim($datos_leer[0]);
            $nombre = trim($datos_leer[1]);
            $SQL = "INSERT INTO param_paises 
                    (
                        codigo, description, ISO2
                    )
                    VALUES
                    (
                        '$codigo', '$nombre', '$codigo'
                    )";
            echo $SQL."<br><br>";
            $dbh->exec($SQL);
        }
    }catch(PDOException $e){
        print "Error!: ".$e->getMessage()."<br/>";
    }
}
function subirParamMonedas(){
    $temp = file('files/subirParamPaises/subirParamMonedas.csv');
    $n = count($temp);
    echo $n;
    $username = 'colpatria_sgd';
    $password = 'colpatria_sgd';
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=colpatria_sgd_;charset=utf8", $username, $password);
        if(!$dbh){
            echo "No se pudo conectar a la base de datos";
            exit();
        }
        $dbh->exec("set names utf8");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        for($i = 1; $i < $n; $i++){
            $datos_leer = split(";", $temp[$i]);
            $pais = trim($datos_leer[0]);
            $moneda = trim($datos_leer[1]);
            $SQL = "INSERT INTO param_monedas 
                    (
                        pais, moneda
                    )
                    VALUES
                    (
                        '$pais', '$moneda'
                    )";
            echo $SQL."<br><br>";
            $dbh->exec($SQL);
        }
    }catch(PDOException $e){
        print "Error!: ".$e->getMessage()."<br/>";
    }
}
function subirCiudadesPaises(){
    $temp = file('files/subirParamPaises/subirCiudadesPaises2.csv');
    $n = count($temp);
    echo $n;
    $username = 'colpatria_sgd';
    $password = 'colpatria_sgd';
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=colpatria_sgd_;charset=utf8", $username, $password);
        if(!$dbh){
            echo "No se pudo conectar a la base de datos";
            exit();
        }
        $dbh->exec("set names utf8");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        for($i = 1; $i < $n; $i++){
            $datos_leer = split(";", $temp[$i]);
            $ciudad = str_replace("'", "´", trim($datos_leer[0]));
            $pais_id = trim($datos_leer[1]);
            $departamento_codigo = str_replace("'", "´", trim($datos_leer[2]));
            $departamento_nombre = str_replace("'", "´", trim($datos_leer[3]));
            $SQL = "INSERT INTO param_ciudadespaises 
                    (
                        ciudad, pais_id, departamento_codigo, departamento_nombre
                    )
                    VALUES
                    (
                        '$ciudad', '$pais_id', '$departamento_codigo', '$departamento_nombre'
                    )";
            echo $SQL."<br><br>";
            $dbh->exec($SQL);
        }
    }catch(PDOException $e){
        print "Error!: ".$e->getMessage()."<br/>";
    }
}
function buscarMigracion(){
    $path = '/var/www/html/Aplicativos.Serverfin04/images_colpatria/';
    $conn = new Conexion();
    $SQL = "SELECT * 
            FROM  `image` 
            WHERE original_file LIKE  '%MULTI%'";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-Encoding: UTF-8");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=buscarMigracion_salida_".date('his').".csv");
            header("Expires: 0");
            header("Pragma: public");
            //echo "\xEF\xBB\xBF"; // UTF-8 BOM

            $fh = fopen( 'php://output', 'w' );
            fputcsv($fh, array('ID', 'FILENAME', 'ORIGINAL NAME', 'ESTADO'), '|');
            while($consulta = $conn->sacarRegistro('str')){
                $id = $consulta['id'];
                $filename = $consulta['filename'];
                $original_file = $consulta['original_file'];
                if(file_exists($path.$filename))
                    fputcsv($fh, array($id, $filename, $original_file, 'EXISTE'), '|');
                else
                    fputcsv($fh, array($id, $filename, $original_file, 'NO_EXISTE'), '|');
            }
            // Close the file
            fclose($fh);
            // Make sure nothing else is sent, our file is done
            exit();
        }
    }
}
function updateAprobacionFecha(){
    $conexion = new Conexion();
    $temp = file('files/updateAprobacionFecha/updateAprobacionFecha1.csv');
    //$fp = fopen("files/updateAprobacionFecha/updateAprobacionFecha_salida1.csv", "a");
    //fwrite($fp, "DOCUMENTO;PLANILLA;LOTE;FECHAVIEJA;FECHANUEVA;ESTADO" . PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = split(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $planilla = trim($datos_leer[1]);
        $lote = trim($datos_leer[2]);

        //$fec1 = explode(' ', trim($datos_leer[3]));
        //$fech1 = explode('/', $fec1[0]);
        //$fecha = $fech1[2] . "-" . $fech1[1] . "-" . $fech1[0] . " " . $fec1[1];
        $fech1 = explode('/', trim($datos_leer[3]));
        $fecha = $fech1[2]."-".$fech1[1]."-".$fech1[0];

        //$fec2 = explode(' ', trim($datos_leer[4]));
        //$fech2 = explode('/', trim($datos_leer[4]));
        //$fecha1 = $fech2[2] . "-" . $fech2[1] . "-" . $fech2[0] . " " . $fec1[1];
        $fech2 = explode('/', trim($datos_leer[4]));
        $fecha1 = $fech2[2]."-".$fech2[1]."-".$fech2[0];

        $SQL = "SELECT t2.id 
                FROM radicados_items AS t1
                INNER JOIN radicados AS t2 ON(t2.id = t1.id_radicados)
                WHERE t1.documento = '$documento'
                AND t1.id_radicados = '$lote'
                AND t2.fecha_recibido LIKE '$fecha%'";
        echo $SQL . "<br>";
        $conexion->consultar($SQL);
        $cant = $conexion->getNumeroRegistros();
        if ($cant == 1) {
            echo "exactamente un resultado<br>";
            while ($consulta = $conexion->sacarRegistro()) {
                $comple = "";
                // if ($planilla == '550') {
                  //$comple = ", log_planilla = '694', planilla = 'PLANILLA694'";
                  //}
                $SQLU = "UPDATE radicados 
                         SET fecha_recibido = REPLACE(fecha_recibido, '$fecha', '$fecha1')$comple
                         WHERE id = ".$consulta[0];
                echo $SQLU."<br>";
                /*if($conexion->ejecutar($SQLU)){
                    fwrite($fp, "$documento;$planilla;$lote;$fecha;$fecha1;ACTUALIZADO" . PHP_EOL);
                    echo "ACTUALIZADO<br><br>";
                }else{
                    fwrite($fp, "$documento;$planilla;$lote;$fecha;$fecha1;NO_ACTUALIZADO" . PHP_EOL);
                    echo "NO_ACTUALIZADO<br><br>";
                }*/
                echo "<br>";
            }
        } else {
            if ($cant == 0) {
                echo "cero resultado<br><br>";
                //fwrite($fp, "$documento;$planilla;$lote;$fecha;$fecha1;NO_ENCONTRADO" . PHP_EOL);
            } else {
                echo "mas de un resultado<br><br>";
                //fwrite($fp, "$documento;$planilla;$lote;$fecha;$fecha1;MAS_DE_UNRESULTADO:$cant" . PHP_EOL);
            }
        }
    }
    echo "<br><br>Termino...";
}
function datosTelefonicoPersonaNatural(){
    $conn = new Conexion();
    $SQL = "SELECT t1.fechanacimiento, TIMESTAMPDIFF(YEAR, t1.fechanacimiento, NOW()) AS edad, t3.document, t3.firstname, t1.telefonoresidencia, t1.direccionresidencia, t4.description AS ciudadresidencia,
            t1.nombreempresa, direccionempresa, t1.telefonolaboral, t5.description, t1.celular, t1.correoelectronico
            FROM `data` AS t1
            INNER JOIN form AS t2 ON(t2.id = t1.id_form)
            INNER JOIN client AS t3 ON(t3.id = t2.id_client)
            LEFT JOIN param_ciudad AS t4 ON(t4.id = t1.ciudadresidencia)
            LEFT JOIN param_ciudad AS t5 ON(t5.id = t1.ciudadempresa)
            WHERE t3.persontype = 1
            AND DATE_FORMAT(t1.fechanacimiento, '%Y') BETWEEN '1940' AND '1969'";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-Encoding: UTF-8");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=datosTelefonicoPersonaNatural_salida_".date('his').".csv");
            header("Expires: 0");
            header("Pragma: public");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM

            $fh = fopen( 'php://output', 'w' );
            fputcsv($fh, array('FECHA NACIMIENTO', 'EDAD', 'DOCUMENTO', 'NOMBRE COMPLETO', 'TELEFONO RESIDENCIA', 'DIRECCION RESIDENCIA', 'CIUDAD RESIDENCIA', 'NOMBRE EMPRESA', 'DIRECCION EMPRESA', 'TELEFONO EMPRESA', 'CIUDAD EMPRESA', 'CELULAR', 'CORREO ELECTRONICO'), ';');
            while($consulta = $conn->sacarRegistro('str')){
                if(strtotime($consulta['fechanacimiento']))
                    $consulta['fechanacimiento'] = date('Y-m-d', strtotime($consulta['fechanacimiento']));
                fputcsv($fh, $consulta, ';');
            }
            // Close the file
            fclose($fh);
            // Make sure nothing else is sent, our file is done
            exit();
        }
    }
}
function imagenesExistente2(){
    $conn = new Conexion();
    $ruta = '/var/www/html/Aplicativos.Serverfin04/images_colpatria/';
    /*header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Description: File Transfer");
    header("Content-Encoding: UTF-8");
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=documentos_Digitar_" . date('his') . ".csv");
    header("Expires: 0");
    header("Pragma: public");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $fh = fopen('php://output', 'w');
    fputcsv($fh, array('ID_CLIENTE', 'POSICION_PRIMERA', 'FECHA', 'CANTIDAD'), ';');*/
    $SQL = "SELECT t1.id
              FROM client AS t1
             INNER JOIN form AS t2 ON(t2.id_client = t1.id) 
             INNER JOIN image AS t3 ON(t3.id_forma = t2.id) 
             GROUP BY t1.id";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($consult1 = $conn->sacarRegistro('str')){
                $con2 = new Conexion();
                $id_client = $consult1['id'];
                $existe = false;
                $cont_cant = 0;
                $pos_exis = 0;
                $date = '';
                $SQ2 = "SELECT t1.*, t2.date_created AS date_created_form
                          FROM image AS t1
                         INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
                         WHERE t2.id_client = :id_client 
                           AND t1.id_imagetype = :id_imagetype
                         ORDER BY t2.date_created DESC";
                if($con2->consultar($SQ2, array(':id_client' => $id_client, ':id_imagetype' => 1))){
                    if($con2->getNumeroRegistros() > 0){
                        while($consult2 = $con2->sacarRegistro('str')){
                            if(!$existe){
                                if(file_exists($ruta.$consult2['filename'])){
                                    $existe = true;
                                    $pos_exis = $cont_cant + 1;
                                    $date = $consult2['date_created_form'];
                                }else{

                                }
                            }
                            $cont_cant++;
                        }
                    }else{

                    }
                }
                if($pos_exis === 1){
                    $SQU = "UPDATE client SET vigente = :vigente WHERE id = :id";
                    $con2->ejecutar($SQU, array(':vigente' => '0', ':id' => $id_client));
                }elseif($pos_exis <> 1 && $date < '2013-01-01 00:00:00'){
                    $SQU = "UPDATE client SET vigente = :vigente WHERE id = :id";
                    $con2->ejecutar($SQU, array(':vigente' => (($pos_exis === 0) ? 1 : $pos_exis), ':id' => $id_client));
                }
                //fputcsv($fh, array($id_client, $pos_exis, $date, $cont_cant), ';');
            }
        }else
            echo "NO SE ENCONTRARON REGISTROS INCIAL";
    }else
        echo "LA CONSULTA NO SE PUDO REALIZAR AL INICIO";
}
function imagenesExistente3(){//2017-06-22 Clientes no vigentes solo si no tienen imagenes, no importa la fecha
    $conn = new Conexion();
    $ruta = '/var/www/html/Aplicativos.Serverfin04/images_colpatria/';
    /*header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Description: File Transfer");
    header("Content-Encoding: UTF-8");
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=documentos_Digitar_" . date('his') . ".csv");
    header("Expires: 0");
    header("Pragma: public");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $fh = fopen('php://output', 'w');
    fputcsv($fh, array('ID_CLIENTE', 'POSICION_PRIMERA', 'FECHA', 'CANTIDAD'), ';');*/
    /*$SQL = "SELECT t1.id
              FROM client AS t1
             INNER JOIN form AS t2 ON(t2.id_client = t1.id) 
             INNER JOIN image AS t3 ON(t3.id_forma = t2.id) 
             GROUP BY t1.id";*/
    $SQL = "SELECT t1.id
              FROM client AS t1
             WHERE t1.vigente != '0' 
             GROUP BY t1.id";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($consult1 = $conn->sacarRegistro('str')){
                $con2 = new Conexion();
                $id_client = $consult1['id'];
                $existe = false;
                $cont_cant = 0;
                $pos_exis = 0;
                $date = '';
                $SQ2 = "SELECT t1.*, t2.date_created AS date_created_form
                          FROM image AS t1
                         INNER JOIN form AS t2 ON(t2.id = t1.id_forma)
                         WHERE t2.id_client = :id_client 
                           AND t1.id_imagetype IN (1, 6)
                         ORDER BY t2.date_created DESC";
                if($con2->consultar($SQ2, array(':id_client' => $id_client))){
                    if($con2->getNumeroRegistros() > 0){
                        while($consult2 = $con2->sacarRegistro('str')){
                            if(!$existe){
                                if(file_exists($ruta.$consult2['filename'])){
                                    $existe = true;
                                    $pos_exis = $cont_cant + 1;
                                    $date = $consult2['date_created_form'];
                                }else{

                                }
                            }
                            //$cont_cant++;
                        }
                    }else{

                    }
                }
                if($pos_exis === 1){
                    $SQU = "UPDATE client SET vigente = :vigente WHERE id = :id";
                    $con2->ejecutar($SQU, array(':vigente' => '0', ':id' => $id_client));
                }elseif($pos_exis <> 1 /*&& $date < '2013-01-01 00:00:00'*/){
                    $SQU = "UPDATE client SET vigente = :vigente WHERE id = :id";
                    $con2->ejecutar($SQU, array(':vigente' => (($pos_exis === 0) ? 1 : $pos_exis), ':id' => $id_client));
                }
                //fputcsv($fh, array($id_client, $pos_exis, $date, $cont_cant), ';');
            }
        }else
            echo "NO SE ENCONTRARON REGISTROS INCIAL";
    }else
        echo "LA CONSULTA NO SE PUDO REALIZAR AL INICIO";
}
function dataActualizacionesColpatria(){
    $conn = new Conexion();
    $SQL = "SELECT t1.id, t4.date_created, t1.firstname,  IF(t1.persontype = 1, t4.tipodocumento, 'NIT') AS tipodocumento, t1.document, t4.genero,
                   t4.fechanacimiento, t4.digitochequeo, t4.celular, t4.correoelectronico, t4.tipocompania, t1.vigente
              FROM client AS t1
             INNER JOIN (SELECT t2.id_client, t2.date_created, IF(t3.sexo = 'Masculino', 'M', IF(t3.sexo = 'Femenino', 'F', 'SD') ) AS genero, 
                                t3.fechanacimiento, t5.description AS tipodocumento, t3.digitochequeo, t3.celular, t3.correoelectronico, 'SGV' AS tipocompania
                           FROM form AS t2 
                          INNER JOIN data AS t3 ON(t3.id_form = t2.id)
                           LEFT JOIN param_tipodocumento AS t5 ON(t5.id = t3.tipodocumento)
                          ORDER BY t2.id_client, t2.date_created DESC
             ) AS t4 ON(t4.id_client = t1.id)
             GROUP BY t1.id";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-Encoding: UTF-8");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=dataActualizacionesColpatria_salida_".date('his').".csv");
            header("Expires: 0");
            header("Pragma: public");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM

            $fh = fopen( 'php://output', 'w' );
            fputcsv($fh, array('NOMBRE Y/O RAZON SOCIAL', 'TIPO DOCUMENTO', 'DIGITO VERIFICACION', 'DOCUMENTO', 'FECHA NACIIMIENTO', 'GENERO', 'CORREO ELECTRONICO', 'CELULAR', 'ESTADO DOCUMENTACION', 'FECHA HASTA', 'TIPO COMPAÑIA'), ';');
            while($consulta = $conn->sacarRegistro('str')){
                $vigencia = getEstadoInformacion2($consulta['id']);
                if($consulta['vigente'] != '0')
                    $vigencia[0] = "No vigente";
                fputcsv($fh, array($consulta['firstname'], $consulta['tipodocumento'], $consulta['digitochequeo'], $consulta['document'], $consulta['fechanacimiento'], $consulta['genero'], $consulta['correoelectronico'], $consulta['celular'], $vigencia[0], $vigencia[1], $consulta['tipocompania']), ';');
            }
            // Close the file
            fclose($fh);
            // Make sure nothing else is sent, our file is done
            exit();
        }
    }
}

function getEstadoInformacion2($id_client){
    $conn = new Conexion();
    $query = <<< SQL
            SELECT MAX(a.d) + INTERVAL 365 DAY AS date, (MAX(a.d) + INTERVAL 365 DAY) >= NOW() AS valid
            FROM
            (
                (
                    SELECT date_created AS d FROM data_capi_confirm
                    WHERE id_contact BETWEEN 1 AND 3 AND id_client = $id_client AND status = 1 ORDER BY date_created DESC LIMIT 1
                )UNION(
                    SELECT date_created AS d FROM data_confirm
                    WHERE id_contact BETWEEN 1 AND 3 AND id_client = $id_client AND status = 1 ORDER BY date_created DESC LIMIT 1
                )UNION(
                    SELECT CAST(data.fechasolicitud AS DATE) AS d FROM data INNER JOIN form ON form.id = data.id_form
                    WHERE form.id_client = $id_client ORDER BY data.fechasolicitud DESC LIMIT 1
                )UNION(
                    SELECT fecha_datacredito AS d FROM client
                    WHERE id = $id_client LIMIT 1
                )
            ) AS a
SQL;
    $conn->consultar($query);
    $data = $conn->sacarRegistro('str');
    
    if($data['valid']){
        $conn->desconectar();
        return array("Vigente", date("Y-m-d", strtotime($data['date'])));
    }else{
        $conn->desconectar();
        return array("Desactualizado", "");
    }
}
function dataActualizacionesColpatriaCapi(){
    $conn = new Conexion();
    $SQL = "SELECT t1.id, t4.date_created, t1.firstname,  t1.document, t1.vigente
              FROM client AS t1
             INNER JOIN data_capi AS t4 ON(t4.id_client = t1.id)
             GROUP BY t1.id";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-Encoding: UTF-8");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=dataActualizacionesColpatriaCapi_salida_".date('his').".csv");
            header("Expires: 0");
            header("Pragma: public");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM

            $fh = fopen( 'php://output', 'w' );
            fputcsv($fh, array('NOMBRE Y/O RAZON SOCIAL', 'DOCUMENTO', 'ESTADO DOCUMENTACION', 'FECHA HASTA'), ';');
            while($consulta = $conn->sacarRegistro('str')){
                $vigencia = getEstadoInformacion2($consulta['id']);
                if($consulta['vigente'] != '0')
                    $vigencia[0] = "No vigente";
                fputcsv($fh, array($consulta['firstname'], $consulta['document'], $vigencia[0], $vigencia[1]), ';');
            }
            // Close the file
            fclose($fh);
            // Make sure nothing else is sent, our file is done
            exit();
        }
    }
}
function actualizarFormatoAutosTelefon(){
    $conn = new Conexion();
    $SQL = "SELECT * 
              FROM data_renovacion_autos
             WHERE telefono = '2147483647'
               AND id_fomulario IS NOT NULL";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){

            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Description: File Transfer");
            header("Content-Encoding: UTF-8");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=actualizarFormatoAutosTelefon_salida_".date('his').".csv");
            header("Expires: 0");
            header("Pragma: public");
            echo "\xEF\xBB\xBF"; // UTF-8 BOM

            $fh = fopen( 'php://output', 'w' );
            fputcsv($fh, array('ID_DATA_RENOVACION', 'ID_FORM', 'TELEFONO', 'TELEFONO_NUEVO','ESTADO'), ';');
            while($consulta = $conn->sacarRegistro('str')){
                $con2 = new Conexion();
                $id_form = $consulta['id_fomulario'];
                $id = $consulta['iddata_renovacion_autos'];
                $SQ2 = "SELECT telefonoresidencia FROM data WHERE id_form = $id_form";
                if($con2->consultar($SQ2)){
                    if($con2->getNumeroRegistros() > 0){
                        $consulta2 = $con2->sacarRegistro('str');
                        $telefono = $consulta2['telefonoresidencia'];
                        $SQU = "UPDATE data_renovacion_autos SET telefono = '$telefono' WHERE iddata_renovacion_autos = $id";
                        if($con2->ejecutar($SQU))
                            fputcsv($fh, array($id, $id_form, '2147483647', $telefono, 'ACTUALIZADO'), ';');
                        else
                            fputcsv($fh, array($id, $id_form, '2147483647', $telefono, 'NO_ACTUALIZADO'), ';');
                    }
                }
                $con2->desconectar();
            }
        }
    }
}
function buscarDatosPorTelefono(){
    $conn = new Conexion();
    $nu = '00';
    $temp = file('files/buscarDatosPorTelefono/buscarDatosPorTelefono_'.$nu.'.csv');
    $fp = fopen("/home/storage/Colpatria/buscarDatosPorTelefono_salida_".$nu.".csv", "a");
    fputcsv($fp, array('NUMERO BUSCADO', 'DOCUMENTO', 'NOMBRE', 'DIRECCION', 'CIUDAD RESIDENCIA', 'DIRECCION EMPRESA', 'CIUDAD EMPRESA', 'CORREO', 'TELEFONO RESIDENCIA', 'TELEFONO LABORAL', 'CELULAR', 'TELEFONO OFICINA', 'FAX OFICINA', 'CELULAR OFICINA', 'TELEFONO SUCURSAL', 'FAX SUCURSAL', 'ESTADO'), ';');
    //fwrite($fp, "ID;DOCUMENTO;TELEFONO;ESTADO".PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        $telefono = trim($datos_leer[0]);
        //DATA
        $SQL1 = "SELECT t3.document AS DOCUMENTO, t3.firstname AS NOMBRE, t1.direccionresidencia AS DIRECCION,
                        t4.description AS 'CIUDAD RESIDENCIA', t1.direccionempresa AS 'DIRECCION EMPRESA',
                        t5.description AS 'CIUDAD EMPRESA', t1.correoelectronico AS CORREO,
                        t1.telefonoresidencia AS 'TELEFONO RESIDENCIA', t1.telefonolaboral AS 'TELEFONO LABORAL',
                        t1.celular AS CELULAR, t1.telefonoficina AS 'TELEFONO OFICINA', t1.faxoficina AS 'FAX OFICINA',
                        t1.celularoficina AS 'CELULAR OFICINA', t1.telefonosucursal AS 'TELEFONO SUCURSAL', t1.faxsucursal AS 'FAX SUCURSAL', 'DATA' AS ESTADO
                   FROM colpatria_sgd.data AS t1
                  INNER JOIN colpatria_sgd.form AS t2 ON(t2.id = t1.id_form)
                  INNER JOIN colpatria_sgd.client AS t3 ON(t3.id = t2.id_client)
                   LEFT JOIN colpatria_sgd.param_ciudad AS t4 ON(t4.id = t1.ciudadresidencia)
                   LEFT JOIN colpatria_sgd.param_ciudad AS t5 ON(t5.id = t1.ciudadempresa)
                  WHERE (t1.telefonoresidencia LIKE '$telefono%' OR t1.telefonolaboral LIKE '$telefono%' 
                     OR t1.celular LIKE '$telefono%' OR t1.telefonoficina LIKE '%$telefono%' 
                     OR t1.faxoficina LIKE '$telefono%' OR t1.celularoficina LIKE '$telefono%' 
                     OR t1.telefonosucursal LIKE '$telefono%' OR t1.faxsucursal LIKE '$telefono%')";
        if($conn->consultar($SQL1)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $telefono);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($telefono, '', '', '', '', '', '', '', $telefono, '', '', '', '', '', '', '', 'NO_DATA'), ';');
        }
        //DATA_CAPI
        $SQL2 = "SELECT t3.document AS DOCUMENTO, t3.firstname AS NOMBRE, t1.direccionresidencia AS DIRECCION,
                        t1.ciudadresidencia AS 'CIUDAD RESIDENCIA', t1.direccionlaboral AS 'DIRECCION EMPRESA',
                        t1.ciudadlaboral AS 'CIUDAD EMPRESA', t1.correoelectronico AS CORREO,
                        t1.telefonoresidencia1 AS 'TELEFONO RESIDENCIA', t1.telefonolaboral AS 'TELEFONO LABORAL',
                        t1.celular AS CELULAR, t1.telefonoresidencia2 AS 'TELEFONO OFICINA', '' AS 'FAX OFICINA',
                        '' AS 'CELULAR OFICINA', '' AS 'TELEFONO SUCURSAL', '' AS 'FAX SUCURSAL', 'DATA_CAPI' AS ESTADO
                   FROM colpatria_sgd.data_capi AS t1
                  INNER JOIN colpatria_sgd.client AS t3 ON(t3.id = t1.id_client)
                  WHERE (t1.telefonolaboral LIKE '$telefono%' OR t1.telefonoresidencia1 LIKE '$telefono%' OR t1.telefonoresidencia2 LIKE '$telefono%' OR t1.celular LIKE '$telefono%')";
        if($conn->consultar($SQL2)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $telefono);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($telefono, '', '', '', '', '', '', '', $telefono, '', '', '', '', '', '', '', 'NO_DATA_CAPI'), ';');
        }
        //COMCEL
        $SQL3 = "SELECT t1.documento AS DOCUMENTO, t1.nombre AS NOMBRE, t1.direccion AS DIRECCION,
                        t1.ciudad AS 'CIUDAD RESIDENCIA', '' AS 'DIRECCION EMPRESA',
                        '' AS 'CIUDAD EMPRESA', t1.email AS CORREO,
                        t1.tel1 AS 'TELEFONO RESIDENCIA', t1.tel2 AS 'TELEFONO LABORAL',
                        t1.tel3 AS CELULAR, t1.ref_tel AS 'TELEFONO OFICINA', t1.otras_lineas AS 'FAX OFICINA',
                        t3.linea_mora AS 'CELULAR OFICINA', '' AS 'TELEFONO SUCURSAL', '' AS 'FAX SUCURSAL', 'COMCEL' AS ESTADO
                   FROM finleco_comcel.t_clientes AS t1
                  INNER JOIN finleco_comcel.t_asignaciones AS t3 ON(t3.id_cliente = t1.id_cliente)
                  WHERE (t1.tel1 LIKE '%$telefono%' OR t1.tel2 LIKE '%$telefono%' OR t1.tel3 LIKE '%$telefono%' OR t1.ref_tel LIKE '%$telefono%' OR t1.otras_lineas LIKE '%$telefono%')
                     OR (t3.linea_mora LIKE '$telefono%')";
        if($conn->consultar($SQL3)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $telefono);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($telefono, '', '', '', '', '', '', '', $telefono, '', '', '', '', '', '', '', 'NO_COMCEL'), ';');
        }
        //TELMEX
        $SQL4 = "SELECT t1.documento AS DOCUMENTO, t1.nombre AS NOMBRE, t1.direccion AS DIRECCION,
                        t1.ciudad AS 'CIUDAD RESIDENCIA', '' AS 'DIRECCION EMPRESA',
                        '' AS 'CIUDAD EMPRESA', t1.email AS CORREO,
                        t1.tel1 AS 'TELEFONO RESIDENCIA', t1.tel2 AS 'TELEFONO LABORAL',
                        t1.tel3 AS CELULAR, t1.tel4 AS 'TELEFONO OFICINA', t1.noenviar_ivr1 AS 'FAX OFICINA',
                        t1.noenviar_ivr2 AS 'CELULAR OFICINA', t1.noenviar_ivr3 AS 'TELEFONO SUCURSAL', t1.noenviar_ivr4 AS 'FAX SUCURSAL', 'TELMEX' AS ESTADO
                   FROM finleco_telmex.t_clientes AS t1
                  WHERE (t1.tel1 LIKE '%$telefono%' OR t1.tel2 LIKE '%$telefono%' OR t1.tel3 LIKE '$telefono%' OR t1.tel4 LIKE '%$telefono%' 
                        OR t1.noenviar_ivr1 LIKE '%$telefono%'OR t1.noenviar_ivr2 LIKE '$telefono%'OR t1.noenviar_ivr3 LIKE '$telefono%'OR t1.noenviar_ivr4 LIKE '$telefono%')";
        if($conn->consultar($SQL4)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $telefono);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($telefono, '', '', '', '', '', '', '', $telefono, '', '', '', '', '', '', '', 'NO_TELMEX'), ';');
        }
        //OSIRIS
        $SQL5 = "SELECT t2.identificacion AS DOCUMENTO, t2.cl_nombre AS NOMBRE, '' AS DIRECCION,
                        t3.ci_nombre AS 'CIUDAD RESIDENCIA', '' AS 'DIRECCION EMPRESA',
                        '' AS 'CIUDAD EMPRESA', t2.cl_email AS CORREO,
                        t1.tl_telefono AS 'TELEFONO RESIDENCIA', '' AS 'TELEFONO LABORAL',
                        '' AS CELULAR, '' AS 'TELEFONO OFICINA', '' AS 'FAX OFICINA',
                        '' AS 'CELULAR OFICINA', '' AS 'TELEFONO SUCURSAL', '' AS 'FAX SUCURSAL', 'OSIRIS' AS ESTADO
                   FROM osiris_ing.tl_telefono AS t1
                  INNER JOIN osiris_ing.cl_clientes AS t2 ON(t2.cl_id = t1.cl_id)
                  INNER JOIN osiris_ing.ci_ciudad AS t3 ON(t3.ci_id = t1.ci_id)
                  WHERE (t1.tl_telefono LIKE '%$telefono%')";
        if($conn->consultar($SQL5)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $telefono);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($telefono, '', '', '', '', '', '', '', $telefono, '', '', '', '', '', '', '', 'NO_OSIRIS'), ';');
        }
    }
    exit();
}
function buscarDatosTelefonoPorDocumento(){
    $conn = new Conexion();
    $nu = '00';
    $temp = file('files/buscarDatosTelefonoPorDocumento/buscarDatosTelefonoPorDocumento_'.$nu.'.csv');
    $fp = fopen("/home/storage/Colpatria/buscarDatosTelefonoPorDocumento_salida_".$nu.".csv", "a");
    fputcsv($fp, array('NUMERO BUSCADO', 'DOCUMENTO', 'NOMBRE', 'DIRECCION', 'CIUDAD RESIDENCIA', 'DIRECCION EMPRESA', 'CIUDAD EMPRESA', 'CORREO', 'TELEFONO RESIDENCIA', 'TELEFONO LABORAL', 'CELULAR', 'TELEFONO OFICINA', 'FAX OFICINA', 'CELULAR OFICINA', 'TELEFONO SUCURSAL', 'FAX SUCURSAL', 'ESTADO'), ';');
    //fwrite($fp, "ID;DOCUMENTO;TELEFONO;ESTADO".PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        //DATA
        $SQL1 = "SELECT t3.document AS DOCUMENTO, t3.firstname AS NOMBRE, t1.direccionresidencia AS DIRECCION,
                        t4.description AS 'CIUDAD RESIDENCIA', t1.direccionempresa AS 'DIRECCION EMPRESA',
                        t5.description AS 'CIUDAD EMPRESA', t1.correoelectronico AS CORREO,
                        t1.telefonoresidencia AS 'TELEFONO RESIDENCIA', t1.telefonolaboral AS 'TELEFONO LABORAL',
                        t1.celular AS CELULAR, t1.telefonoficina AS 'TELEFONO OFICINA', t1.faxoficina AS 'FAX OFICINA',
                        t1.celularoficina AS 'CELULAR OFICINA', t1.telefonosucursal AS 'TELEFONO SUCURSAL', t1.faxsucursal AS 'FAX SUCURSAL', 'DATA' AS ESTADO
                   FROM colpatria_sgd.data AS t1
                  INNER JOIN colpatria_sgd.form AS t2 ON(t2.id = t1.id_form)
                  INNER JOIN colpatria_sgd.client AS t3 ON(t3.id = t2.id_client)
                   LEFT JOIN colpatria_sgd.param_ciudad AS t4 ON(t4.id = t1.ciudadresidencia)
                   LEFT JOIN colpatria_sgd.param_ciudad AS t5 ON(t5.id = t1.ciudadempresa)
                  WHERE t3.document = '$documento'";
        if($conn->consultar($SQL1)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $documento);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($documento, '', '', '', '', '', '', '', $documento, '', '', '', '', '', '', '', 'NO_DATA'), ';');
        }
        //DATA_CAPI
        $SQL2 = "SELECT t3.document AS DOCUMENTO, t3.firstname AS NOMBRE, t1.direccionresidencia AS DIRECCION,
                        t1.ciudadresidencia AS 'CIUDAD RESIDENCIA', t1.direccionlaboral AS 'DIRECCION EMPRESA',
                        t1.ciudadlaboral AS 'CIUDAD EMPRESA', t1.correoelectronico AS CORREO,
                        t1.telefonoresidencia1 AS 'TELEFONO RESIDENCIA', t1.telefonolaboral AS 'TELEFONO LABORAL',
                        t1.celular AS CELULAR, t1.telefonoresidencia2 AS 'TELEFONO OFICINA', '' AS 'FAX OFICINA',
                        '' AS 'CELULAR OFICINA', '' AS 'TELEFONO SUCURSAL', '' AS 'FAX SUCURSAL', 'DATA_CAPI' AS ESTADO
                   FROM colpatria_sgd.data_capi AS t1
                  INNER JOIN colpatria_sgd.client AS t3 ON(t3.id = t1.id_client)
                  WHERE t3.document = '$documento'";
        if($conn->consultar($SQL2)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $documento);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($documento, '', '', '', '', '', '', '', $documento, '', '', '', '', '', '', '', 'NO_DATA_CAPI'), ';');
        }
        //COMCEL
        $SQL3 = "SELECT t1.documento AS DOCUMENTO, t1.nombre AS NOMBRE, t1.direccion AS DIRECCION,
                        t1.ciudad AS 'CIUDAD RESIDENCIA', '' AS 'DIRECCION EMPRESA',
                        '' AS 'CIUDAD EMPRESA', t1.email AS CORREO,
                        t1.tel1 AS 'TELEFONO RESIDENCIA', t1.tel2 AS 'TELEFONO LABORAL',
                        t1.tel3 AS CELULAR, t1.ref_tel AS 'TELEFONO OFICINA', t1.otras_lineas AS 'FAX OFICINA',
                        t3.linea_mora AS 'CELULAR OFICINA', '' AS 'TELEFONO SUCURSAL', '' AS 'FAX SUCURSAL', 'COMCEL' AS ESTADO
                   FROM finleco_comcel.t_clientes AS t1
                  INNER JOIN finleco_comcel.t_asignaciones AS t3 ON(t3.id_cliente = t1.id_cliente)
                  WHERE t1.documento = '$documento'";
        if($conn->consultar($SQL3)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $documento);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($documento, '', '', '', '', '', '', '', $documento, '', '', '', '', '', '', '', 'NO_COMCEL'), ';');
        }
        //TELMEX
        $SQL4 = "SELECT t1.documento AS DOCUMENTO, t1.nombre AS NOMBRE, t1.direccion AS DIRECCION,
                        t1.ciudad AS 'CIUDAD RESIDENCIA', '' AS 'DIRECCION EMPRESA',
                        '' AS 'CIUDAD EMPRESA', t1.email AS CORREO,
                        t1.tel1 AS 'TELEFONO RESIDENCIA', t1.tel2 AS 'TELEFONO LABORAL',
                        t1.tel3 AS CELULAR, t1.tel4 AS 'TELEFONO OFICINA', t1.noenviar_ivr1 AS 'FAX OFICINA',
                        t1.noenviar_ivr2 AS 'CELULAR OFICINA', t1.noenviar_ivr3 AS 'TELEFONO SUCURSAL', t1.noenviar_ivr4 AS 'FAX SUCURSAL', 'TELMEX' AS ESTADO
                   FROM finleco_telmex.t_clientes AS t1
                  WHERE t1.documento = '$documento'";
        if($conn->consultar($SQL4)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $documento);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($documento, '', '', '', '', '', '', '', $documento, '', '', '', '', '', '', '', 'NO_TELMEX'), ';');
        }
        //OSIRIS
        $SQL5 = "SELECT t2.identificacion AS DOCUMENTO, t2.cl_nombre AS NOMBRE, '' AS DIRECCION,
                        t3.ci_nombre AS 'CIUDAD RESIDENCIA', '' AS 'DIRECCION EMPRESA',
                        '' AS 'CIUDAD EMPRESA', t2.cl_email AS CORREO,
                        t1.tl_telefono AS 'TELEFONO RESIDENCIA', '' AS 'TELEFONO LABORAL',
                        '' AS CELULAR, '' AS 'TELEFONO OFICINA', '' AS 'FAX OFICINA',
                        '' AS 'CELULAR OFICINA', '' AS 'TELEFONO SUCURSAL', '' AS 'FAX SUCURSAL', 'OSIRIS' AS ESTADO
                   FROM osiris_ing.tl_telefono AS t1
                  INNER JOIN osiris_ing.cl_clientes AS t2 ON(t2.cl_id = t1.cl_id)
                  INNER JOIN osiris_ing.ci_ciudad AS t3 ON(t3.ci_id = t1.ci_id)
                  WHERE t2.identificacion = '$documento'";
        if($conn->consultar($SQL5)){
            if($conn->getNumeroRegistros() > 0){
                while($consulta = $conn->sacarRegistro('str')){
                    array_unshift($consulta, $documento);
                    fputcsv($fp, $consulta, ';');
                }
            }else
                fputcsv($fp, array($documento, '', '', '', '', '', '', '', $documento, '', '', '', '', '', '', '', 'NO_OSIRIS'), ';');
        }
    }
    exit();
}

function reporteCapiFecha(){
    $conn = new Conexion();
    $nu = '02';
    $fp = fopen("/home/storage/Colpatria/reporteCapiFecha_salida_".$nu.".csv", "a");
    $head = array(
        'Tipo gestión',
        'Gestión',
        'Documento',
        'Documento actualizado',
        'Primer apellido',
        'Segundo apellido',
        'Nombres',
        'Fecha de nacimiento',
        'Profesión',
        'Empresa',
        'Ingresos mensuales',
        'Egresos mensuales',
        'Dirección laboral',
        'Ciudad',
        'Dirección residencia',
        'Teléfono residencia',
        'Celular',
        'Correo electronico',
        'Numero hijos',
        'Estado civil',
        'Nivel de estudios',
        'Observación gestión',
        'Usuario gestor',
        'Respues libre?',
        'Nacionalidad',
        'Nacionalidad otra',
        'Nacionalidad cual',
        'Pais residencia',
        'Obligaciones en otros paises',
        'Cuales paises',
        'Fecha de gestión'
    );
    fputcsv($fp, $head, ';');
    $sql = <<<SQL
    SELECT param_contact.type,
           param_contact.description,
           cli.document,
           con.documento,
           con.primerapellido,
           con.segundoapellido,
           con.nombres,
           IF( param_contact.id = '1',con.fechanacimiento,''),
           IF( param_contact.id = '1',param_profesion.description,''),
           IF( param_contact.id = '1',con.empresa,''),
           IF( param_contact.id = '1',param_ingresosmensuales.description,''),
           IF( param_contact.id = '1',param_egresosmensuales.description,''),
           IF( param_contact.id = '1',con.direccionlaboral,''),
           IF( param_contact.id = '1',param_ciudad.description,''),
           IF( param_contact.id = '1',con.direccionresidencia,''),
           IF( param_contact.id = '1',con.telefonoresidencia,''),
           IF( param_contact.id = '1',con.celular,''),
           IF( param_contact.id = '1',con.correoelectronico,''),
           IF( param_contact.id = '1',con.numerohijos,''),
           IF( param_contact.id = '1',param_estadocivil.description,''),
           IF( param_contact.id = '1',param_estudio.description,''),
           con.observacion,
           user.name,
           CASE con.respuesta_libre WHEN 1 THEN 'SI' WHEN 2 THEN 'NO' WHEN 3 THEN 'N/A' ELSE '' END,
           pa.description AS nacionalidad,
           CASE con.nacionalidad_otra WHEN 1 THEN 'SI' WHEN 2 THEN 'NO' WHEN 3 THEN 'N/A' ELSE '' END,
           nc.description AS nacionalidad_cual,
           pr.description AS pais_residencia,
           CASE con.obligaciones_otras WHEN 1 THEN 'SI' WHEN 2 THEN 'NO' WHEN 3 THEN 'N/A' ELSE '' END,
           con.obligaciones_paises,
           con.date_created
      FROM (SELECT c.id AS id_client, c.document 
              FROM client c
             INNER JOIN data_capi AS dc ON(dc.id_client = c.id)
             GROUP BY c.id
            ) AS cli
     INNER JOIN (SELECT dcc.id_client, 
                        dcc.id_contact, 
                        dcc.id_profesion, 
                        dcc.id_ingresos,
                        dcc.id_egresos,
                        dcc.id_ciudad,
                        dcc.estadocivil,
                        dcc.nivelestudios,
                        dcc.id_user,
                        dcc.nacionalidad,
                        dcc.nacionalidad_cual,
                        dcc.pais_residencia,
                        dcc.date_created,
                        dcc.status,
                        dcc.documento,
                        dcc.primerapellido,
                        dcc.segundoapellido,
                        dcc.nombres,
                        dcc.fechanacimiento,
                        dcc.empresa,
                        dcc.direccionlaboral,
                        dcc.direccionresidencia,
                        dcc.telefonoresidencia,
                        dcc.celular,
                        dcc.correoelectronico,
                        dcc.numerohijos,
                        dcc.observacion,
                        dcc.respuesta_libre,
                        dcc.nacionalidad_otra,
                        dcc.obligaciones_otras,
                        dcc.obligaciones_paises
                   FROM data_capi_confirm AS dcc
                  ORDER BY dcc.id_client, dcc.date_created DESC
                ) AS con ON (con.id_client = cli.id_client)
     INNER JOIN param_contact ON (param_contact.id = con.id_contact)
      LEFT JOIN param_profesion ON (param_profesion.id = con.id_profesion)
      LEFT JOIN param_ingresosmensuales ON (param_ingresosmensuales.id = con.id_ingresos)
      LEFT JOIN param_egresosmensuales ON (param_egresosmensuales.id = con.id_egresos)
      LEFT JOIN param_ciudad ON (param_ciudad.id = con.id_ciudad)
      LEFT JOIN param_estadocivil ON (param_estadocivil.id = con.estadocivil)
      LEFT JOIN param_estudio ON (param_estudio.id = con.nivelestudios)
      LEFT JOIN user ON (user.id = con.id_user)
      LEFT JOIN param_paises AS pa ON(pa.id = con.nacionalidad)
      LEFT JOIN param_paises AS nc ON(nc.id = con.nacionalidad_cual)
      LEFT JOIN param_paises AS pr ON(pr.id = con.pais_residencia)
     WHERE /*con.date_created <= '2017-08-16 23:59:59' 
       AND */con.status = '1'
     GROUP BY con.id_client
SQL;
    if($conn->consultar($sql)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('num')){
                $dat[21] = trim(preg_replace("/\s+/", " ", $dat[21]));
                fputcsv($fp, $dat, ';');
            }
        }
    }
}

function correccionFechaPublicacion(){
    $conn = new Conexion();
    $nu = '00';
    $temp = file('files/correccionFechaPublicacion/correccionFechaPublicacion_'.$nu.'.csv');
    $fp = fopen("files/correccionFechaPublicacion/correccionFechaPublicacion_salida_".$nu.".csv", "a");
    fputcsv($fp, array('PLANILLA', 'LOTE', 'DOCUMENTO', 'FECHA', 'PROCESO', 'ESTADO'), ';');
    //fwrite($fp, "ID;DOCUMENTO;TELEFONO;ESTADO".PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        $planilla = trim($datos_leer[0]);
        $lote = trim($datos_leer[1]);
        $documento = trim($datos_leer[2]);
        $fecha = date('Y-m-d', strtotime(str_replace('/', '-', trim($datos_leer[3]))));
        $proceso = trim($datos_leer[4]);
        if($proceso == 'SARLAFT'){
            $SQL = "SELECT f.id, 
                           f.date_created 
                      FROM form AS f 
                     INNER JOIN client AS c ON(c.id = f.id_client) 
                     WHERE c.document = :document 
                       AND f.log_lote = :log_lote
                       AND f.log_planilla = :log_planilla";
            if($conn->consultar($SQL, array(':document'=> $documento, ':log_lote'=> $lote, ':log_planilla'=> $planilla))){
                if($conn->getNumeroRegistros() == 1){
                    $dat = $conn->sacarRegistro('str');
                    $fP = explode(' ', $dat['date_created']);
                    $SQU = "UPDATE form SET date_created = REPLACE(date_created, :f_actual, :f_nueva) WHERE id = :id";
                    echo $SQU."<br>".json_encode(array(':f_actual'=> $fP[0], ':f_nueva'=> $fecha, ':id'=> $dat['id']))."<br><br>";
                    if($conn->ejecutar($SQU, array(':f_actual'=> $fP[0], ':f_nueva'=> $fecha, ':id'=> $dat['id'])))
                        fputcsv($fp, array($planilla, $lote, $documento, $fecha, $proceso, 'ACTUALIZADO'), ';');
                    else
                        fputcsv($fp, array($planilla, $lote, $documento, $fecha, $proceso, 'NO_ACTUALIZADO'), ';');
                }elseif($conn->getNumeroRegistros() > 1){
                    echo "MAS_DE_UNO<br><br>";
                    fputcsv($fp, array($planilla, $lote, $documento, $fecha, $proceso, 'MAS_DE_UNO'), ';');
                }else{
                    echo "CERO<br><br>";
                    fputcsv($fp, array($planilla, $lote, $documento, $fecha, $proceso, 'CERO'), ';');
                }
            }
        }
    }
}
function EliminarGestionesPorFechas2() {
    $conn = new Conexion();
    $temp = file('files/EliminarGestionesPorFechas/EliminarGestionesPorFechas2_8.csv');
    $n = count($temp);
    /*$fp = fopen("files/EliminarGestionesPorFechas/EliminarGestionesPorFechas_salida2_8.csv", "a");
    fwrite($fp, "ID;OLD_FECHA;NEW_FECHA;ESTADO" . PHP_EOL);*/
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        $proceso = trim($datos_leer[0]);
        $documento = trim($datos_leer[1]);
        $observacion = trim($datos_leer[2]);
        $fecha = date('Y-m-d H:i', strtotime(str_replace('/', '-', trim($datos_leer[3]))));

        $SQL = "SELECT id FROM client WHERE document = :document";
        if($conn->consultar($SQL, array(':document'=> $documento))){
            $cant = $conn->getNumeroRegistros();
            if($cant == 1){
                $resp = $conn->sacarRegistro('str');
                $id = $resp['id'];
                if($proceso == 'seguros'){
                    $SQU = "DELETE 
                              FROM data_confirm 
                             WHERE id_client = :id_client 
                               AND (date_created BETWEEN :date_1 AND :date_2)";
                    $dat = array(':id_client'=> $resp['id'], ':date_1'=> $fecha, ':date_2'=> $fecha.':59');
                    echo $SQU."<br>".json_encode($dat)."<br>";
                    if($conn->ejecutar($SQU, $dat))
                        echo $proceso.": REGISTRO ELIMINADO<br><br>";
                    else
                        echo $proceso.": REGISTRO NO ELIMINADO<br><br>";
                }elseif($proceso == 'capi'){
                    $SQU = "DELETE 
                              FROM data_capi_confirm 
                             WHERE id_client = :id_client 
                               AND (date_created BETWEEN :date_1 AND :date_2)";
                    $dat = array(':id_client'=> $resp['id'], ':date_1'=> $fecha, ':date_2'=> $fecha.':59');
                    echo $SQU."<br>".json_encode($dat)."<br><br>";
                    if($conn->ejecutar($SQU, $dat))
                        echo $proceso.": REGISTRO ELIMINADO<br><br>";
                    else
                        echo $proceso.": REGISTRO NO ELIMINADO<br><br>";
                }
            }elseif($cant > 1){
                echo "MAS DE UN REGISTRO<br>".json_encode($datos_leer)."<br><br>";
            }else{
                echo "CERO REGISTROS<br>".json_encode($datos_leer)."<br><br>";
            }
        }
    }
}
function obtenerTelefonosClientes() {
    $conn = new Conexion();
    $nu = '02';
    $temp = file('files/obtenerTelefonosClientes/obtenerTelefonosClientes_'.$nu.'.csv');
    $fp = fopen("files/obtenerTelefonosClientes/obtenerTelefonosClientes_salida_".$nu.".csv", "a");
    fputcsv($fp, array('DOCUMENTO', 'TELEFONO RESIDENCIA', 'TELEFONO LABORAL', 'CELULAR', 'TELEFONO OFICINA', 'FAX OFICINA', 'CELULAR OFICINA', 'TELEFONO SUCURSAL', 'FAX SUCURSAL', 'TELEFONO OFICINA PPAL', 'PROCESO'), ';');
    //fwrite($fp, "ID;DOCUMENTO;TELEFONO;ESTADO".PHP_EOL);
    $n = count($temp);
    $objetos = array();
    for ($i = 1; $i < $n; $i++) {
        $datos_leer = explode(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $SQL = "SELECT c.id, 
                       c.document,
                       IF(d.telefonoresidencia = '', '0', IF(d.telefonoresidencia IS NULL, '0', d.telefonoresidencia)) AS telefonoresidencia,
                       IF(d.telefonolaboral = '', '0', IF(d.telefonolaboral IS NULL, '0', d.telefonolaboral)) AS telefonolaboral,
                       IF(d.celular = '', '0', IF(d.celular IS NULL, '0', d.celular)) AS celular,
                       IF(d.telefonoficina = '', '0', IF(d.telefonoficina IS NULL, '0', d.telefonoficina)) AS telefonoficina,
                       IF(d.faxoficina = '', '0', IF(d.faxoficina IS NULL, '0', d.faxoficina)) AS faxoficina,
                       IF(d.celularoficina = '', '0', IF(d.celularoficina IS NULL, '0', d.celularoficina)) AS celularoficina,
                       IF(d.telefonosucursal = '', '0', IF(d.telefonosucursal IS NULL, '0', d.telefonosucursal)) AS telefonosucursal,
                       IF(d.faxsucursal = '', '0', IF(d.faxsucursal IS NULL, '0', d.faxsucursal)) AS faxsucursal,
                       IF(d.telefonoficinappal = '', '0', IF(d.telefonoficinappal IS NULL, '0', d.telefonoficinappal)) AS telefonoficinappal,
                       'SEGURO' AS tipo
                  FROM client AS c 
                 INNER JOIN form AS f ON(f.id_client = c.id)
                 INNER JOIN data AS d ON(d.id_form = f.id)
                 WHERE c.document = :document
                 UNION
                SELECT c.id, 
                       c.document,
                       IF(d.telefonoresidencia1 = '', '0', IF(d.telefonoresidencia1 IS NULL, '0', d.telefonoresidencia1)) AS telefonoresidencia,
                       IF(d.telefonolaboral = '', '0', IF(d.telefonolaboral IS NULL, '0', d.telefonolaboral)) AS telefonolaboral,
                       IF(d.celular = '', '0', IF(d.celular IS NULL, '0', d.celular)) AS celular,
                       IF(d.telefonoresidencia2 = '', '0', IF(d.telefonoresidencia2 IS NULL, '0', d.telefonoresidencia2)) AS telefonoficina,
                       '0' AS faxoficina,
                       '0' AS celularoficina,
                       '0' AS telefonosucursal,
                       '0' AS faxsucursal,
                       '0' AS telefonoficinappal,
                       'CAPI' AS tipo
                  FROM client AS c
                 INNER JOIN data_capi AS d ON(d.id_client = c.id)
                 WHERE c.document = :documento";
        if($conn->consultar($SQL, array(':document'=> $documento, ':documento'=> $documento))){
            if($conn->getNumeroRegistros() > 0){
            	while($dat = $conn->sacarRegistro('str')){
            		fputcsv($fp, array($dat['document'], $dat['telefonoresidencia'], $dat['telefonolaboral'], $dat['celular'], $dat['telefonoficina'], $dat['faxoficina'], $dat['celularoficina'], $dat['telefonosucursal'], $dat['faxsucursal'], $dat['telefonoficinappal'], $dat['tipo']), ';');
            	}
            }else{
                //echo "CERO<br><br>";
                fputcsv($fp, array($documento, '0', '0', '0', '0', '0', '0', '0', '0', '0', 'SIN TELEFONOS'), ';');
            }
        }
    }
    fclose($fp);
    echo "TERMINO...";
}
function confirmSinGrabacion(){
    $conn = new Conexion();
    $nu = '01';
    $fp = fopen("files/confirmSinGrabacion/confirmSinGrabacion_salida_".$nu.".csv", "a");
    fputcsv($fp, array('ID_CLIENTE', 'DOCUMENT', 'ID_DATA', 'ESTADO'), ';');
    $pathFiles = '/var/www/html/Aplicativos.Serverfin04/Colpatria/procesos/includes/files/confirmSinGrabacion';
    $SQL = "SELECT c.id, 
                   c.document,
                   d.id AS id_data_confirm
              FROM data_confirm AS d 
             INNER JOIN client AS c ON(c.id = d.id_client)
             WHERE (d.date_Created BETWEEN '2018-07-30' AND '2018-07-30 10:32:10') AND d.id_contact IN (1, 2, 3, 4, 6, 7, 11, 13)";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                if(file_exists($pathFiles.DS.$dat['document'].'.wav')){
                    $unique_name = md5(uniqid(rand(), true)); 
                    $finalname = $unique_name."_record.wav";
                    $file_destino =  "/var/www/html/records_colpatria/". $finalname;
                    if(copy($pathFiles.DS.$dat['document'].'.wav', $file_destino)){
                        rename($pathFiles.DS.$dat['document'].'.wav', $pathFiles.DS.$dat['document'].'_renombrado.wav');
                        $SQU = "INSERT INTO record
                                (
                                    id_data_confirm, directory, filename
                                ) 
                                VALUES
                                (
                                    :id_data_confirm, :directory, :filename
                                )";
                        if($conn->ejecutar($SQU, array(':id_data_confirm'=> $dat['id_data_confirm'], ':directory'=> 'records_colpatria', ':filename'=> $finalname)))
                            fputcsv($fp, array($dat['id'], $dat['document'], $dat['id_data_confirm'], 'GESTION_ARCHIVO_EXITOSO'), ';');
                        else
                            fputcsv($fp, array($dat['id'], $dat['document'], $dat['id_data_confirm'], 'NO_SE_PUDO_AGREGAR_GESTION'), ';');
                    }else
                        fputcsv($fp, array($dat['id'], $dat['document'], $dat['id_data_confirm'], 'NO_SE_PUDO_COPIAR_ARCHIVO'), ';');
                }else
                    fputcsv($fp, array($dat['id'], $dat['document'], $dat['id_data_confirm'], 'NO_EXISTE_ARCHIVO'), ';');
            }
        }else
            echo "NO HAY REGISTROS";
    }else
        echo "NO SE PUDO EJECUTAR LA CONSULTA";
    fclose($fp);
    echo "<br>TERMINO...";
}
function eliminarDuplicadosData(){
    $conn = new Conexion();
    $con2 = new Conexion();
    $nu = '01';
    $fp = fopen("files/eliminarDuplicadosData/eliminarDuplicadosData_salida_".$nu.".csv", "a");
    fputcsv($fp, array('CANTIDAD', 'IDFORM', 'LOTE', 'DATA', 'ESTADO'), '|');
    $SQL = "SELECT COUNT('x') AS cantidad, 
                   id_form, 
                   lote 
              FROM data 
             GROUP BY id_form, lote 
            HAVING COUNT('x') > 1";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                if($dat['cantidad'] == '2'){
                    $SQ2 = "SELECT * 
                              FROM data 
                             WHERE id_form = :id_form 
                               AND lote = :lote
                             ORDER BY id DESC
                             LIMIT 0, 1";
                    if($con2->consultar($SQ2, array(":id_form"=> $dat['id_form'], ":lote"=> $dat['lote']))){
                        if($con2->getNumeroRegistros() == 1){
                            $dat2 = $con2->sacarRegistro('str');
                            $SQD = "DELETE FROM data WHERE id = :id";
                            if($con2->ejecutar($SQD, array(":id"=> $dat2['id'])))
                                fputcsv($fp, array($dat['cantidad'], $dat['id_form'], $dat['lote'], json_encode($dat2), 'TIENE_DATOS_ELIMINADO'), '|');
                            else
                                fputcsv($fp, array($dat['cantidad'], $dat['id_form'], $dat['lote'], json_encode($dat2), 'TIENE_DATOS_NO_ELIMINADO'), '|');
                        }else
                            fputcsv($fp, array($dat['cantidad'], $dat['id_form'], $dat['lote'], '', 'MAS_DE_UN_RAGISTRO'), '|');
                    }else
                        fputcsv($fp, array($dat['cantidad'], $dat['id_form'], $dat['lote'], '', 'NO_SE_EJECUTRO SQ2'), '|');
                }else
                    fputcsv($fp, array($dat['cantidad'], $dat['id_form'], $dat['lote'], '', 'CANTIDAD_DIFERENTE_A 2'), '|');
            }
        }else
            echo "NO HAY REGISTROS";
    }else
        echo "NO SE PUDO EJECUTAR LA CONSULTA";
    $conn->desconectar();
    $con2->desconectar();
    fclose($fp);
    echo "<br>TERMINO...";
}
function inforImagenesCliente(){
    $pathTif = '/var/www/html/Aplicativos.Serverfin04/images_colpatria';
    $pathGra = '/home/storage';
    $pathGr2 = '/var/www/html/Almacenamiento.Serverfin';
    //$head = array('CLIENTE', 'TIPO ARCHIVO', 'DIRECTORIO', 'ARCHIVO', 'FECHA CARGUE', 'PESO KB', 'PESO MB', 'GESTOR', 'NOMBRE GESTOR', 'ESTADO');
    $head2 = array('CLIENTE', 'TIPO ARCHIVO', 'DIRECTORIO', 'ARCHIVO', 'FECHA CARGUE', 'LOTE', 'PESO KB', 'PESO MB', 'GESTOR', 'NOMBRE GESTOR', 'ESTADO');
    $fp = fopen("files/inforImagenesCliente/inforImagenesCliente_salida_".date('His').".csv", "a");
    fputcsv($fp, $head2, '|');
    /*$fpS = fopen("files/inforImagenesCliente/inforRecordsCliente_salida_".date('His').".csv", "a");
    fputcsv($fpS, $head, '|');
    $fpC = fopen("files/inforImagenesCliente/inforRecordsCapiCliente_salida_".date('His').".csv", "a");
    fputcsv($fpC, $head, '|');*/
    $conn = new Conexion();
    $ano = date('Y', strtotime('-6 years'));
    //IMAGENES
    $SQL = "SELECT c.document,
                   i.filename,
                   i.date_created,
                   it.name AS image_type,
                   u.username,
                   u.name,
                   i.original_file
              FROM image AS i
             INNER JOIN form AS f ON(f.id = i.id_forma)
              LEFT JOIN user AS u ON(u.id = f.id_user)
             INNER JOIN client AS c ON(c.id = f.id_client)
             INNER JOIN imagetype AS it ON(it.id = i.id_imagetype)
             WHERE DATE_FORMAT(i.date_created, '%Y') <= :ano
             ORDER BY 3 ASC";
    if($conn->consultar($SQL, ['ano'=> $ano])){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                if(file_exists($pathTif.DS.$dat['filename'])){
                    if($fileBytes = filesize($pathTif.DS.$dat['filename'])){
                        $fileKb = floatval($fileBytes) / 1024;
                        $fileMb = floatval($fileBytes) / pow(1024, 2);
                        fputcsv($fp, array($dat['document'], $dat['image_type'], $pathTif, $dat['filename'], $dat['date_created'], $dat['original_file'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", $dat['username'], $dat['name'], 'EXISTE'), '|');
                    }else
                        fputcsv($fp, array($dat['document'], $dat['image_type'], $pathTif, $dat['filename'], $dat['date_created'], $dat['original_file'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_PESO'), '|');
                }else
                    fputcsv($fp, array($dat['document'], $dat['image_type'], $pathTif, $dat['filename'], $dat['date_created'], $dat['original_file'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_EXISTE'), '|');
            }
        }
    }
    fclose($fp);/*
    //GRABACIONES SEGURO
    $SQL = "SELECT c.document,
                   r.filename,
                   r.date_created,
                   r.directory,
                   u.username,
                   u.name
              FROM record AS r
             INNER JOIN data_confirm AS d ON(d.id = r.id_data_confirm)
              LEFT JOIN user AS u ON(u.id = d.id_user)
             INNER JOIN client AS c ON(c.id = d.id_client)
             WHERE 1
             ORDER BY 3 ASC";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                $gPart = explode('.', $dat['filename']);
                $gMp3 = $gPart[0].".mp3";
                if(file_exists($pathGra.DS.$dat['directory'].DS.$dat['filename']) || file_exists($pathGra.DS.$dat['directory'].DS.$gMp3)){
                    if(file_exists($pathGra.DS.$dat['directory'].DS.$dat['filename'])){
                        if($fileBytes = filesize($pathGra.DS.$dat['directory'].DS.$dat['filename'])){
                            $fileKb = floatval($fileBytes) / 1024;
                            $fileMb = floatval($fileBytes) / pow(1024, 2);
                            fputcsv($fpS, array($dat['document'], 'GRABACION SEGURO', $pathGra.DS.$dat['directory'], $dat['filename'], $dat['date_created'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", $dat['username'], $dat['name'], 'EXISTE'), '|');
                        }else
                            fputcsv($fpS, array($dat['document'], 'GRABACION SEGURO', $pathGra.DS.$dat['directory'], $dat['filename'], $dat['date_created'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_PESO'), '|');

                    }elseif(file_exists($pathGra.DS.$dat['directory'].DS.$gMp3)){
                        if($fileBytes = filesize($pathGra.DS.$dat['directory'].DS.$gMp3)){
                            $fileKb = floatval($fileBytes) / 1024;
                            $fileMb = floatval($fileBytes) / pow(1024, 2);
                            fputcsv($fpS, array($dat['document'], 'GRABACION SEGURO', $pathGra.DS.$dat['directory'], $gMp3, $dat['date_created'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", $dat['username'], $dat['name'], 'EXISTE'), '|');
                        }else
                            fputcsv($fpS, array($dat['document'], 'GRABACION SEGURO', $pathGra.DS.$dat['directory'], $gMp3, $dat['date_created'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_PESO'), '|');
                    }

                }elseif(file_exists($pathGr2.DS.$dat['directory'].DS.$dat['filename']) || file_exists($pathGr2.DS.$dat['directory'].DS.$gMp3)){
                    if(file_exists($pathGr2.DS.$dat['directory'].DS.$dat['filename'])){
                        if($fileBytes = filesize($pathGr2.DS.$dat['directory'].DS.$dat['filename'])){
                            $fileKb = floatval($fileBytes) / 1024;
                            $fileMb = floatval($fileBytes) / pow(1024, 2);
                            fputcsv($fpS, array($dat['document'], 'GRABACION SEGURO', $pathGr2.DS.$dat['directory'], $dat['filename'], $dat['date_created'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", $dat['username'], $dat['name'], 'EXISTE'), '|');
                        }else
                            fputcsv($fpS, array($dat['document'], 'GRABACION SEGURO', $pathGr2.DS.$dat['directory'], $dat['filename'], $dat['date_created'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_PESO'), '|');

                    }elseif(file_exists($pathGr2.DS.$dat['directory'].DS.$gMp3)){
                        if($fileBytes = filesize($pathGr2.DS.$dat['directory'].DS.$gMp3)){
                            $fileKb = floatval($fileBytes) / 1024;
                            $fileMb = floatval($fileBytes) / pow(1024, 2);
                            fputcsv($fpS, array($dat['document'], 'GRABACION SEGURO', $pathGr2.DS.$dat['directory'], $gMp3, $dat['date_created'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", $dat['username'], $dat['name'], 'EXISTE'), '|');
                        }else
                            fputcsv($fpS, array($dat['document'], 'GRABACION SEGURO', $pathGr2.DS.$dat['directory'], $gMp3, $dat['date_created'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_PESO'), '|');
                    }

                }else
                    fputcsv($fpS, array($dat['document'], 'GRABACION SEGURO', $pathGra.DS.$dat['directory'], $dat['filename'], $dat['date_created'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_EXISTE'), '|');
            }
        }
    }
    fclose($fpS);
    //GRABACIONES CAPI
    $SQL = "SELECT c.document,
                   r.filename,
                   r.date_created,
                   r.directory,
                   u.username,
                   u.name
              FROM recordcapi AS r
             INNER JOIN data_capi_confirm AS d ON(d.id = r.id_data_confirm)
              LEFT JOIN user AS u ON(u.id = d.id_user)
             INNER JOIN client AS c ON(c.id = d.id_client)
             WHERE 1
             ORDER BY 3 ASC";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                $gPart = explode('.', $dat['filename']);
                $gMp3 = $gPart[0].".mp3";
                if(file_exists($pathGra.DS.$dat['directory'].DS.$dat['filename']) || file_exists($pathGra.DS.$dat['directory'].DS.$gMp3)){
                    if(file_exists($pathGra.DS.$dat['directory'].DS.$dat['filename'])){
                        if($fileBytes = filesize($pathGra.DS.$dat['directory'].DS.$dat['filename'])){
                            $fileKb = floatval($fileBytes) / 1024;
                            $fileMb = floatval($fileBytes) / pow(1024, 2);
                            fputcsv($fpC, array($dat['document'], 'GRABACION CAPI', $pathGra.DS.$dat['directory'], $dat['filename'], $dat['date_created'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", $dat['username'], $dat['name'], 'EXISTE'), '|');
                        }else
                            fputcsv($fpC, array($dat['document'], 'GRABACION CAPI', $pathGra.DS.$dat['directory'], $dat['filename'], $dat['date_created'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_PESO'), '|');

                    }elseif(file_exists($pathGra.DS.$dat['directory'].DS.$gMp3)){
                        if($fileBytes = filesize($pathGra.DS.$dat['directory'].DS.$gMp3)){
                            $fileKb = floatval($fileBytes) / 1024;
                            $fileMb = floatval($fileBytes) / pow(1024, 2);
                            fputcsv($fpC, array($dat['document'], 'GRABACION CAPI', $pathGra.DS.$dat['directory'], $dat['filename'], $dat['date_created'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", $dat['username'], $dat['name'], 'EXISTE'), '|');
                        }else
                            fputcsv($fpC, array($dat['document'], 'GRABACION CAPI', $pathGra.DS.$dat['directory'], $dat['filename'], $dat['date_created'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_PESO'), '|');
                    }

                }else
                    fputcsv($fpC, array($dat['document'], 'GRABACION CAPI', $pathGra.DS.$dat['directory'], $dat['filename'], $dat['date_created'], "0 Kb", "0 Mb", $dat['username'], $dat['name'], 'NO_EXISTE'), '|');
            }
        }
    }
    fclose($fpC);*/
    echo "TERMINO...";
}
function reporteCallCapiCompleto(){
    $fp = fopen("files/reporteCallCapiCompleto/reporteCallCapiCompleto_salida_01.csv", "a");
    $head = array(
        'TIPO GESTION',
        'GESTION',
        'DOCUMENTO',
        'DOCUMENTO ACTUALIZADO',
        'PRIMER APELLIDO',
        'SEGUNDO APELLIDO',
        'NOMBRES',
        'FECHA DE NACIMIENTO',
        'PROFESION',
        'EMPRESA',
        'INGRESOS MENSUALES',
        'EGRESOS MENSUALES',
        'DIRECCION LABORAL',
        'CIUDAD',
        'DIRECCION RESIDENCIA',
        'TELEFONO RESIDENCIA',
        'CELULAR',
        'CORREO ELECTRONICO',
        'NUMERO HIJOS',
        'ESTADO CIVIL',
        'NIVEL DE ESTUDIOS',
        'OBSERVACION GESTION',
        'USUARIOS GESTOR',
        'RESPUESTA LIBRE?',
        'NACIONALIDAD',
        'NACIONALIDAD OTRA',
        'NACIONALIDAD CUAL',
        'PAIS RESIDENCIA',
        'OBLIGACIONES EN OTROS PAISES',
        'CUALES PAISES',
        'FECHA DE GESTION'
    );
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    //IMAGENES
    $SQL = "SELECT param_contact.type,
                   param_contact.description,
                   cli.document,
                   con.documento,
                   con.primerapellido,
                   con.segundoapellido,
                   con.nombres,
                   IF( param_contact.id = '1',con.fechanacimiento,'') AS fechanacimiento,
                   IF( param_contact.id = '1',param_profesion.description,'') AS profesion,
                   IF( param_contact.id = '1',con.empresa,'') AS empresa,
                   IF( param_contact.id = '1',param_ingresosmensuales.description,'') AS ingresosmensuales,
                   IF( param_contact.id = '1',param_egresosmensuales.description,'') AS egresosmensuales,
                   IF( param_contact.id = '1',con.direccionlaboral,'') AS direccionlaboral,
                   IF( param_contact.id = '1',param_ciudad.description,'') AS ciudad,
                   IF( param_contact.id = '1',con.direccionresidencia,'') AS direccionresidencia,
                   IF( param_contact.id = '1',con.telefonoresidencia,'') AS telefonoresidencia,
                   IF( param_contact.id = '1',con.celular,'') AS celular,
                   IF( param_contact.id = '1',con.correoelectronico,'') AS correoelectronico,
                   IF( param_contact.id = '1',con.numerohijos,'') AS numerohijos,
                   IF( param_contact.id = '1',param_estadocivil.description,'') AS estadocivil,
                   IF( param_contact.id = '1',param_estudio.description,'') AS estudios,
                   con.observacion,
                   user.name,
                   CASE con.respuesta_libre WHEN 1 THEN 'SI' WHEN 2 THEN 'NO' WHEN 3 THEN 'N/A' ELSE '' END AS respuesta_libre,
                   pa.description AS nacionalidad,
                   CASE con.nacionalidad_otra WHEN 1 THEN 'SI' WHEN 2 THEN 'NO' WHEN 3 THEN 'N/A' ELSE '' END AS nacionalidad_otra,
                   nc.description AS nacionalidad_cual,
                   pr.description AS pais_residencia,
                   CASE con.obligaciones_otras WHEN 1 THEN 'SI' WHEN 2 THEN 'NO' WHEN 3 THEN 'N/A' ELSE '' END AS obligaciones_otras,
                   con.obligaciones_paises,
                   con.date_created
              FROM client cli 
             INNER JOIN data_capi ON (data_capi.id_client = cli.id)
             INNER JOIN (SELECT * 
                           FROM data_capi_confirm AS dcc 
                          WHERE dcc.status = '1'
                            AND dcc.date_created >= '2002-02-12'
                          ORDER BY dcc.id_client, dcc.date_created DESC
                        ) AS con ON (con.id_client = data_capi.id_client)
             INNER JOIN param_contact ON (param_contact.id = con.id_contact)
              LEFT JOIN param_profesion ON (param_profesion.id = con.id_profesion)
              LEFT JOIN param_ingresosmensuales ON (param_ingresosmensuales.id = con.id_ingresos)
              LEFT JOIN param_egresosmensuales ON (param_egresosmensuales.id = con.id_egresos)
              LEFT JOIN param_ciudad ON (param_ciudad.id = con.id_ciudad)
              LEFT JOIN param_estadocivil ON (param_estadocivil.id = con.estadocivil)
              LEFT JOIN param_estudio ON (param_estudio.id = con.nivelestudios)
              LEFT JOIN user ON (user.id = con.id_user)
              LEFT JOIN param_paises AS pa ON(pa.id = con.nacionalidad)
              LEFT JOIN param_paises AS nc ON(nc.id = con.nacionalidad_cual)
              LEFT JOIN param_paises AS pr ON(pr.id = con.pais_residencia)
             GROUP BY con.id_client";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                $dat['observacion'] = preg_replace("/\s+/", " ", $dat['observacion']);
                $dat['celular'] = preg_replace("/\s+/", " ", $dat['celular']);
                $dat['direccionlaboral'] = preg_replace("/\s+/", " ", $dat['direccionlaboral']);
                $dat['direccionresidencia'] = preg_replace("/\s+/", " ", $dat['direccionresidencia']);
                $dat['primerapellido'] = preg_replace("/\s+/", " ", $dat['primerapellido']);
                $dat['segundoapellido'] = preg_replace("/\s+/", " ", $dat['segundoapellido']);
                $dat['nombres'] = preg_replace("/\s+/", " ", $dat['nombres']);
                $dat['telefonoresidencia'] = preg_replace("/\s+/", " ", $dat['telefonoresidencia']);
                $dat['fechanacimiento'] = preg_replace("/\s+/", " ", $dat['fechanacimiento']);
                $dat['empresa'] = preg_replace("/\s+/", " ", $dat['empresa']);
                $dat['correoelectronico'] = preg_replace("/\s+/", " ", $dat['correoelectronico']);
                $dat['numerohijos'] = preg_replace("/\s+/", " ", $dat['numerohijos']);
                $dat['obligaciones_paises'] = preg_replace("/\s+/", " ", $dat['obligaciones_paises']);
                fputcsv($fp, $dat, '|');
            }
        }
    }
    fclose($fp);
    echo "TERMINO...";
}
function reporteDigitacionCompleto(){
    require_once PATH_CCLASS.DS.'client.class2.php';
    $fp = fopen("files/reporteDigitacionCompleto/reporteDigitacionCompleto_salida_03.csv", "a");
    $head = array(
        'TIPO PERSONA', 'DOCUMENTO CLIENTE', 'NOMBRE CLIENTE', 'TIPO DOCUMENTO CLIENTE', 'PLANILLA', 'LOTE',
        'FORMULARIO', 'FECHA RADICADO', 'FECHA ENVIO REAL', 'FECHA APROBACION', 'FECHA DILIGENCIAMIENTO', 'FECHA DE DIGITACION', 'CIUDAD', 'SUCURSAL', 'AREA', 'OFICIAL', 
        'TIPO SOLICITUD', 'CLASE VINCULACION', 'CUAL', 'PRIMER APELLIDO', 'SEGUNDO APELLIDOS', 'NOMBRES', 
        'GENERO', 'TIDO DE DOCUMENTO', 'NUMERO IDENTIFICACION', 'FECHA EXPEDICION', 'LUGAR EXPEDICION',
        'FECHA NACIMIENTO', 'LUGAR NACIMIENTO', 'NACIONALIDAD', 'NACIONALIDAD 2', 'NUMERO DE HIJOS', 'ESTADO CIVIL',
        'CORREO ELECTRONICO', 'TELEFONO CELULAR', 'TELEFONO FIJO', 'DIRECCION RESIDENCIA', 'CIUDAD/DEPARTAMENTO', 
        'EMPRESA DONDE TRABAJA', 'DIRECCION OFICINA', 'NOMENCLATURA', 'TELEFONO OFICINA', 'CIUDAD DE LA EMPRESA', 
        'CELULAR OFICINA', 'TIPO EMPRESA', 'OTRO', 'MANEJA RECURSOS PUBLICOS?', 'GRADO DE PODER PUBLICO?',
        'RECONOCIMIENTO PUBLICO?', 'INDIQUE', 'ES SERVIDOR PUBLICO?', 'CONOCIDO EXPUESTO POLITICO?',
        'CARGO', 'FECHA INICIO', 'FECHA FIN', 'VINCULO PERSONA PUBLICAMENTE EXPUESTA?', 'NOMBRE', 'CARGO',
        'REPRESENTANTE LEGAL INTERNACIONAL?', 'INDIQUE', 'OBLIGACIONES TRIBUTARIAS OTROS PAISES?', 'CUALES',
        'ACTIVIDAD ECONOMICA', 'CIIU(codigo)', 'OCUPACION/PROFESION', 'CARGO(asalariado)', 'OCUPACION', 'DETALLE',
        'ACTIVIDAD SECUNDARIA', 'CIIU', 'DIRECCION', 'NOMENCLATURA', 'TELEFONO', 'PRODUCTO O SERVICIO COMERCIALIZA',
        'INGRESOS MENSUALES', 'ACTIVOS', 'PASIVOS', 'EGRESOS MENSUALES', 'PATRIMONIO',
        'OTROS INGRESOS', 'CONCEPTO OTROS INGRESOS', 'NIVEL DE ESTUDIOS', 'TIPO DE VIVIENDA', 'ESTRATO',
        'NOMBRE/RAZON SOCIAL', 'NIT', 'DIV', 'TIPO EMPRESA',
        'OTRO', 'ACTIVIDAD ECONOMICA', 'DETALLE', 'CIIU(codigo)', 'DIRECCION OFICINA PPAL', 'CIUDAD/DEPARTAMENTO',
        'TELEFONO', 'FAX OFICINA', 'E-MAIL', 'CELULAR', 'DIRECCION SUCURSAL', 'CIUDAD SUCURSAL', 'NOMENCLATURA',
        'TELEFONO SUCURSAL', 'FAX SUCURSAL', 'INGRESOS MENSUALES', 'ACTIVOS', 'PASIVOS', 
        'EGRESOS MENSUALES', 'PATRIMONIO', 'OTROS INGRESOS', 'CONCEPTO OTROS INGRESOS', 
        'TIPO ID #1', 'NUMERO ID #1', 'NOMBRE/RAZON SOCIAL #1', '% PARTICIPACION #1',
        'MANEJA RECURSOS PUBLICOS? #1', 'RECONOCIMIENTO PUBLICO? #1', 
        'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #1', 'PAISES', 
        'TIPO ID #2', 'NUMERO ID #2', 'NOMBRE/RAZON SOCIAL #2', '% PARTICIPACION #2',
        'MANEJA RECURSOS PUBLICOS? #2', 'RECONOCIMIENTO PUBLICO? #2', 
        'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #2', 'PAISES', 
        'TIPO ID #3', 'NUMERO ID #3', 'NOMBRE/RAZON SOCIAL #3', '% PARTICIPACION #3',
        'MANEJA RECURSOS PUBLICOS? #3', 'RECONOCIMIENTO PUBLICO? #3', 
        'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #3', 'PAISES', 
        'TIPO ID #4', 'NUMERO ID #4', 'NOMBRE/RAZON SOCIAL #4', '% PARTICIPACION #4',
        'MANEJA RECURSOS PUBLICOS? #4', 'RECONOCIMIENTO PUBLICO? #4', 
        'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #4', 'PAISES', 
        'TIPO ID #5', 'NUMERO ID #5', 'NOMBRE/RAZON SOCIAL #5', '% PARTICIPACION #5',
        'MANEJA RECURSOS PUBLICOS? #5', 'RECONOCIMIENTO PUBLICO? #5', 
        'VINCULO PERSONA PUBLICAMENTE EXPUESTA? #5', 'PAISES', 
        'ORIGEN DE FONDOS', 'PAIS DE ORIGEN', 'OPERACIONES EN MONEDA EXTRANJERA?', 'CUAL?', 'OTRAS',
        'OTRAS OPERACIONES', 'PRODUCTOS FINANCIEROS EN EL EXTERIOR', 'CUENTAS EN MONEDA EXTRANJERA?',
        'TIPO DE PRODUCTO #1', 'IDENTIFICACION DEL PRODUCTO #1', 'ENTIDAD #1', 'MONTO #1', 
        'CIUDAD #1', 'PAIS #1', 'MONEDA #1',
        'TIPO DE PRODUCTO #2', 'IDENTIFICACION DEL PRODUCTO #2', 'ENTIDAD #2', 'MONTO #2', 
        'CIUDAD #2', 'PAIS #2', 'MONEDA #2',
        'TIPO DE PRODUCTO #3', 'IDENTIFICACION DEL PRODUCTO #3', 'ENTIDAD #3', 'MONTO #3', 
        'CIUDAD #3', 'PAIS #3', 'MONEDA #3', 'HA TENIDO RECLAMACIONES?',
        'AÑO #1', 'RAMO #1', 'COMPAÑIA #1', 'VALOR #1', 'RESULTADO #1',
        'AÑO #2', 'RAMO #2', 'COMPAÑIA #2', 'VALOR #2', 'RESULTADO #2',
        'ENVIO DE INFORMACIION POR E-MAIL?', 'ENVIO DE INFORMACION POR SMS?', 'FIRMA?', 'HUELLA?',
        'LUGAR ENTREVISTA', 'RESULTADO', 'FECHA ENTREVISTA', 'HORA ENTREVISTA', 'OBSERVACIONES',
        'INTERMEDIARIO/ASESOR/ENTREVISTADOR', 'CLAVE', 'FIRMA INTERMEDIARIO/ASESOR/ENTREVISTADOR',
        'CIUDAD', 'FECHA VERIFICACION', 'HORA VERIFICACION', 'NOMBRE CARGO VERIFICADOR', 'OBSERVACIONES', 
        'FIRMA', 'DIGITADOR', 'ESTADO'
    );
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    //IMAGENES
    $SQL = "SELECT IF(cl.persontype = '1', 'NATURAL','JURIDICO'),
                   cl.document, 
                   cl.firstname, 
                   IF(cl.persontype = '1', td.description, 'NIT') AS tipodocumento_cli,
                   fu.description AS formulario, 
                   fo.log_planilla, 
                   fo.log_lote, 
                   da.fecharadicado, 
                   da.fechasolicitud, 
                   CONCAT(c1.ciudad, ', ', c1.departamento) AS ciudad,
                   su.sucursal, 
                   ar.description AS area, 
                   da.id_official AS oficial, 
                   da.tipo_solicitud, 
                   cc.description AS clasecliente, 
                   da.cual_clasecliente, 
                   da.primerapellido, 
                   da.segundoapellido, 
                   da.nombres, 
                   da.sexo, 
                   td.description AS tipodocumento, 
                   da.documento, 
                   da.fechaexpedicion, 
                   IF(da.formulario = '15', le.ciudad, IF(cl.persontype = '1', lugar_exp.description, 'NA')) AS lugarexpedicion, 
                   da.fechanacimiento, 
                   IF(da.formulario = '15', ln.ciudad, IF(cl.persontype = '1', lugar_nac.description, 'NA')) AS lugarnacimiento, 
                   IF(da.formulario = '15', pn.description, IF(cl.persontype = '1', pp.description, 'NA')) AS paisnacimiento, 
                   pno.description AS nacionalidad_otra, 
                   IF(cl.persontype = '1', da.numerohijos, 'NA') AS numerohijos,
                   IF(cl.persontype = '1', pe.description, 'NA') AS estadocivil, 
                   da.correoelectronico, 
                   da.celular, 
                   da.telefonoresidencia, 
                   da.direccionresidencia, 
                   IF(da.formulario = '15', CONCAT(cr.ciudad, ', ', cr.departamento), IF(cl.persontype = '1', lugar_resi.description, '')) AS ciudadresidencia, 
                   da.nombreempresa, 
                   da.direccionempresa,
                   da.nomenclatura,
                   da.telefonolaboral, 
                   ce.ciudad AS ciudadempresa, 
                   da.celularoficinappal, 
                   IF(da.formulario = '15', te1.description, pac.description) AS tipoempresaemp, 
                   da.tipoempresaemp_cual, 
                   da.recursos_publicos,
                   da.poder_publico,
                   da.reconocimiento_publico,
                   da.reconocimiento_cual, 
                   da.servidor_publico,
                   da.expuesta_politica,
                   da.cargo_politica, 
                   da.cargo_politica_ini, 
                   da.cargo_politica_fin,
                   da.expuesta_publica,
                   da.publica_nombre, 
                   da.publica_cargo, 
                   da.repre_internacional,
                   da.internacional_indique, 
                   da.tributarias_otro_pais,
                   da.tributarias_paises, 
                   IF(da.formulario = '15', ac.description, IF(cl.persontype = '1', pta.description, 'NA')) AS tipoactividad, 
                   ci1.descripcion AS ciiu,
                   pf.description AS profesion, 
                   da.cargo, 
                   IF(cl.persontype = '1', poc.description, 'NA') AS ocupacion, 
                   da.detalleocupacion,
                   IF(da.formulario = '15', da.detalleactividadeconomicappal, pac.description) AS actividadeconomicaempresa, 
                   ci2.descripcion AS ciiu_otro, 
                   da.direccionoficinappal, 
                   da.nomenclatura_emp,
                   da.telefonoficinappal, 
                   da.detalletipoactividad, 
                   in1.description AS ingresosmensuales, 
                   da.totalactivos,
                   da.totalpasivos, 
                   eg1.description AS egresosmensuales, 
                   da.patrimonio,
                   IF(da.formulario = '15', in2.description, IF(cl.persontype = '1', poi.value, 'NA')) AS otrosingresos, 
                   da.conceptosotrosingresos, 
                   IF(cl.persontype = '1', pes.description, 'NA') AS nivelestudios, 
                   IF(cl.persontype = '1', ptv.description, 'NA') AS tipovivienda,
                   IF(cl.persontype = '1', da.estrato, 'NA') AS estrato,
                   da.razonsocial, 
                   da.nit, 
                   da.digitochequeo, 
                   te2.description AS tipoempresajur,
                   da.tipoempresajur_otra, 
                   IF(da.formulario = '15', da.detalleactividadeconomicappal, IF(da.actividadeconomicappal = '0', 'NA', pact.description)) AS actividadeconomica, 
                   IF(da.formulario = '15', 'NA', da.detalleactividadeconomicappal) AS detalleactividadeconomicappal,
                   ci1.descripcion AS ciiu, 
                   da.direccionoficinappal, 
                   IF(da.formulario = '15', co.ciudad, IF(cl.persontype = '1', 'NA', lugar_emp.description)) AS ciudadoficina, 
                   da.telefonoficina, 
                   da.faxoficina,
                   da.correoelectronico_otro, 
                   da.celularoficina, 
                   da.direccionsucursal, 
                   lugar_sucursal.description AS ciudadsucursal, 
                   da.nomenclatura_emp2,
                   da.telefonosucursal, 
                   da.faxsucursal,
                   IF(da.formulario = '15', in3.description, pine.value) AS ingresosmensualesemp, 
                   da.activosemp, 
                   da.pasivosemp, 
                   IF(da.formulario = '15', eg2.description, peme.value) AS egresosmensualesemp, 
                   da.patrimonio, 
                   in4.description AS otrosingresosemp,
                   da.concepto_otrosingresosemp, 
                   da.origen_fondos, 
                   da.procedencia_fondos, 
                   da.monedaextranjera,
                   tt.description AS tipotransacciones, 
                   da.tipotransacciones_cual, 
                   da.otras_operaciones, 
                   da.productos_exterior,
                   da.cuentas_monedaextranjera,
                   da.reclamaciones,
                   da.auto_correo,
                   da.auto_sms,
                   da.firma,
                   da.huella,
                   da.lugarentrevista, 
                   da.resultadoentrevista, 
                   da.fechaentrevista, 
                   CONCAT(da.horaentrevista, ' ', da.tipohoraentrevista) AS horaentrevista, 
                   da.observacionesentrevista, 
                   da.nombreintermediario, 
                   da.clave_inter,
                   da.firma_entrevista,
                   cv.ciudad AS verificacion_ciudad, 
                   da.verificacion_fecha, 
                   da.verificacion_hora, 
                   da.verificacion_nombre, 
                   da.verificacion_observacion, 
                   da.verificacion_firma,
                   ud.name AS usuario_digitador,
                   ra.fecha_envio,
                   ra.fecha_recibido, 
                   fo.date_created,
                   da.id AS idData,
                   cl.id AS clienteId,
                   da.formulario AS formularioId,
                   da.socio1,
                   da.socio2,
                   da.socio3,
                   cl.persontype
              FROM `data` AS da
             INNER JOIN form AS fo ON(fo.id = da.id_form)
             INNER JOIN client AS cl ON(cl.id = fo.id_client)
              LEFT JOIN radicados AS ra ON(ra.id = fo.log_lote)
              LEFT OUTER JOIN (SELECT id_radicados, documento 
                                 FROM radicados_items 
                                WHERE 1 
                                GROUP BY documento, id_radicados
                 ) AS ri ON(cl.document = ri.documento AND fo.log_lote = ri.id_radicados)
              LEFT JOIN `user` AS ur ON(ur.id = ra.id_usuarioenvia)
             INNER JOIN `user` AS ud ON(ud.id = fo.id_user)
              LEFT JOIN param_formulario AS fu ON(fu.id = da.formulario)
              LEFT JOIN param_ciudadesdane AS c1 ON(c1.cod_dane = da.ciudad)
              LEFT JOIN param_sucursales AS su ON(su.id = da.sucursal)
              LEFT JOIN param_area AS ar ON(ar.id = da.area)
              LEFT JOIN param_clasecliente AS cc ON(cc.id = da.clasecliente)
              LEFT JOIN param_tipodocumento AS td ON(td.id = da.tipodocumento)
              LEFT JOIN param_ciudadesdane AS le ON(le.cod_dane = da.lugarexpedicion)
              LEFT JOIN param_ciudad AS lugar_exp ON(lugar_exp.id = da.lugarexpedicion)
              LEFT JOIN param_ciudadesdane AS ln ON(ln.cod_dane = da.lugarnacimiento)
              LEFT JOIN param_ciudad AS lugar_nac ON(lugar_nac.id = da.lugarnacimiento)
              LEFT JOIN param_paises AS pn ON(pn.id = da.paisnacimiento)
              LEFT JOIN param_paises AS pno ON(pno.id = da.nacionalidad_otra)
              LEFT JOIN param_ciudadesdane AS cr ON(cr.cod_dane = da.ciudadresidencia)
              LEFT JOIN param_ciudad AS lugar_resi ON(lugar_resi.id = da.ciudadresidencia)
              LEFT JOIN param_ciudadesdane AS ce ON(ce.cod_dane = da.ciudadempresa)
              LEFT JOIN param_tipoempresa AS te1 ON(te1.id = da.tipoempresaemp)
              LEFT JOIN param_actividad AS ac ON(ac.id = da.tipoactividad)
              LEFT JOIN param_tipoactividad AS pta ON(pta.id = da.tipoactividad)
              LEFT JOIN param_ciiu AS ci1 ON(ci1.codigo = da.ciiu)
              LEFT JOIN param_profesion AS pf ON(pf.id = da.profesion)
              LEFT JOIN param_ciiu AS ci2 ON(ci2.codigo = da.ciiu_otro)
              LEFT JOIN param_ingresosmensuales AS in1 ON(in1.id = da.ingresosmensuales)
              LEFT JOIN param_egresosmensuales AS eg1 ON(eg1.id = da.egresosmensuales)
              LEFT JOIN param_ingresosmensuales AS in2 ON(in2.id = da.otrosingresos)
              LEFT JOIN param_otrosingresos AS poi ON(poi.id = da.otrosingresos)
              LEFT JOIN param_tipoempresa AS te2 ON(te2.id = da.tipoempresajur)
              LEFT JOIN param_ciudadesdane AS co ON(co.cod_dane = da.ciudadoficina)
              LEFT JOIN param_ciudad AS lugar_emp ON(lugar_emp.codigo = da.ciudadoficina)
              LEFT JOIN param_ingresosmensuales AS in3 ON(in3.id = da.ingresosmensualesemp)
              LEFT JOIN param_ingresosmensuales_emp AS pine ON(pine.id = da.ingresosmensualesemp)
              LEFT JOIN param_egresosmensuales AS eg2 ON(eg2.id = da.egresosmensualesemp)
              LEFT JOIN param_egresosmensuales_emp AS peme ON(peme.id = da.egresosmensualesemp)
              LEFT JOIN param_ingresosmensuales AS in4 ON(in4.id = da.otrosingresosemp)
              LEFT JOIN param_tipotransacciones AS tt ON(tt.id = da.tipotransacciones)
              LEFT JOIN param_ciudadesdane AS cv ON(cv.cod_dane = da.verificacion_ciudad)
              LEFT JOIN param_pais AS pp ON(pp.id = da.nacionalidad)
              LEFT JOIN param_estadocivil AS pe ON(pe.id = da.estadocivil)
              LEFT JOIN param_actividadecono AS pac ON(pac.id = da.actividadeconomicaempresa)
              LEFT JOIN param_ocupacion AS poc ON(poc.id = da.ocupacion)
              LEFT JOIN param_estudio AS pes ON(pes.id = da.nivelestudios)
              LEFT JOIN param_tipovivienda AS ptv ON(ptv.id = da.tipovivienda)
              LEFT JOIN param_ciudad AS lugar_sucursal ON(lugar_sucursal.id = da.ciudadsucursal)
              LEFT JOIN param_actividad AS pact ON(pact.id = da.actividadeconomicappal)
             WHERE (fo.date_created BETWEEN '2019-10-01 00:00:00' AND '2020-08-13 00:00:00') 
               AND fo.status = 1";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            $client = new Client();
            while($dat = $conn->sacarRegistro('num')){
                $idData = $dat[138];
                $acci = getAccionistas($idData);
                $recl = getReclamaciones($idData);
                $prod = getProductos($idData);
                $formularioId = $dat[140];
                $socio1 = "";
                $socio2 = "";
                $socio3 = "";
                if($formularioId != '15'){
                    $socio1 = $dat[141];
                    $socio2 = $dat[142];
                    $socio3 = $dat[143];
                }

                if(is_null($dat[135]) || empty($dat[135]) || $dat[135] == '0000-00-00')
                    $dat[135] = "2013-06-12";
                else
                    $dat[135] = $dat[135];

                if(is_null($dat[136]) || empty($dat[136]) || $dat[136] == '0000-00-00')
                    $dat[136] = "2013-06-12";
                else
                    $dat[136] = $dat[136];

                if($dat[137] == "")
                    $dat[137] = "SD";

                if($dat[87] == "")
                    $dat[87] = "NA";

                if($dat[65] == "")
                    $dat[65] = "NA";

                if($dat[70] == "")
                    $dat[70] = "NA";

                if($dat[35] == "")
                    $dat[35] = "NA";

                if($dat[37] == "")
                    $dat[37] = "NA";

                $dato45 = ($dat[45] == '-1') ? 'SI' : (($dat[45] == '0') ? 'NO' : 'SD');
                $dato52 = ($dat[52] == '-1') ? 'SI' : (($dat[52] == '0') ? 'NO' : 'SD');
                $dato47 = ($dat[47] == '-1') ? 'SI' : (($dat[47] == '0') ? 'NO' : 'SD');
                $ultimoestado = $client->getEstadoInformacion($dat[139]);
                $dato = array(
                    $dat[0], 
                    $dat[1], 
                    $dat[2], 
                    $dat[3], 
                    $dat[5], 
                    $dat[6], 
                    $dat[4], 
                    $dat[7], 
                    $dat[135], 
                    $dat[136], 
                    $dat[8], 
                    $dat[137], 
                    $dat[9], 
                    $dat[10], 
                    $dat[11], 
                    $dat[12], 
                    $dat[13], 
                    $dat[14], 
                    $dat[15], 
                    $dat[16], 
                    $dat[17], 
                    $dat[18], 
                    $dat[19], 
                    $dat[20], 
                    $dat[21], 
                    $dat[22], 
                    $dat[23], 
                    $dat[24], 
                    $dat[25], 
                    $dat[26], 
                    $dat[27], 
                    $dat[28], 
                    $dat[29], 
                    $dat[30], 
                    $dat[31], 
                    $dat[32], 
                    $dat[33], 
                    $dat[34], 
                    $dat[35], 
                    $dat[36], 
                    $dat[37], 
                    $dat[38], 
                    $dat[39], 
                    $dat[40], 
                    $dat[41], 
                    $dat[42], 
                    /*($dat[43] == '-1') ? 'SI' : (($dat[43] == '0') ? 'NO' : 'SD'), 
                    ($dat[44] == '-1') ? 'SI' : (($dat[44] == '0') ? 'NO' : 'SD'), 
                    ($dat[45] == '-1') ? 'SI' : (($dat[45] == '0') ? 'NO' : 'SD'), 
                    $dat[46], 
                    ($dat[47] == '-1') ? 'SI' : (($dat[47] == '0') ? 'NO' : 'SD'), 
                    ($dat[48] == '-1') ? 'SI' : (($dat[48] == '0') ? 'NO' : 'SD'), 
                    $dat[49], 
                    $dat[50], 
                    $dat[51], 
                    ($dat[52] == '-1') ? 'SI' : (($dat[52] == '0') ? 'NO' : 'SD'), 
                    $dat[53], 
                    $dat[54], 
                    ($dat[55] == '-1') ? 'SI' : (($dat[55] == '0') ? 'NO' : 'SD'), 
                    $dat[56], 
                    ($dat[57] == '-1') ? 'SI' : (($dat[57] == '0') ? 'NO' : 'SD'),*/ 
                   ($dat[43] == '-1') ? 'SI' : (($dat[43] == '0') ? 'NO' : 'SD'), 
                   ($dat[44] == '-1') ? 'SI' : (($dat[44] == '0') ? 'NO' : 'SD'), 
                   (($dat[140] == '15') ? $dato45 : $dato52), 
                   $dat[46], 
                   (($dat[140] == '15') ? $dato47 : 'SD'), 
                   ($dat[48] == '-1') ? 'SI' : (($dat[48] == '0') ? 'NO' : 'SD'), 
                   $dat[49], 
                   $dat[50], 
                   $dat[51], 
                   ($dat[140] == '15') ? $dato52 : (($dat[144] == '1') ? $dato47 : 'SD'),//
                   $dat[53], 
                   $dat[54], 
                   ($dat[55] == '-1') ? 'SI' : (($dat[55] == '0') ? 'NO' : 'SD'), 
                   $dat[56], 
                   ($dat[57] == '-1') ? 'SI' : (($dat[57] == '0') ? 'NO' : 'SD'),
                    $dat[58], 
                    $dat[59], 
                    $dat[60], 
                    $dat[61], 
                    $dat[62], 
                    $dat[63], 
                    $dat[64], 
                    $dat[65], 
                    $dat[66], 
                    $dat[67], 
                    $dat[68], 
                    $dat[69], 
                    $dat[70], 
                    $dat[71], 
                    $dat[72], 
                    $dat[73], 
                    $dat[74], 
                    $dat[75], 
                    $dat[76], 
                    $dat[77], 
                    $dat[78], 
                    $dat[79], 
                    $dat[80], 
                    $dat[81], 
                    $dat[82], 
                    $dat[83], 
                    $dat[84], 
                    $dat[85], 
                    $dat[86], 
                    $dat[87], 
                    $dat[88], 
                    $dat[89], 
                    $dat[90], 
                    $dat[91], 
                    $dat[92], 
                    $dat[93], 
                    $dat[94], 
                    $dat[95], 
                    $dat[96], 
                    $dat[97], 
                    $dat[98], 
                    $dat[99], 
                    $dat[100], 
                    $dat[101], 
                    $dat[102], 
                    $dat[103], 
                    $dat[104], 
                    $dat[105], 
                    $dat[106], 
                    ((isset($acci[0][1])) ? $acci[0][1] : ''), 
                    ((isset($acci[0][2])) ? $acci[0][2] : $socio1), 
                    ((isset($acci[0][3])) ? $acci[0][3] : ''), 
                    ((isset($acci[0][4])) ? $acci[0][4] : ''), 
                    ((isset($acci[0][5])) ? $acci[0][5] : ''), 
                    ((isset($acci[0][6])) ? $acci[0][6] : ''), 
                    ((isset($acci[0][7])) ? $acci[0][7] : ''), 
                    ((isset($acci[0][8])) ? $acci[0][8] : ''),  
                    ((isset($acci[1][1])) ? $acci[1][1] : ''), 
                    ((isset($acci[1][2])) ? $acci[1][2] : $socio2), 
                    ((isset($acci[1][3])) ? $acci[1][3] : ''), 
                    ((isset($acci[1][4])) ? $acci[1][4] : ''), 
                    ((isset($acci[1][5])) ? $acci[1][5] : ''), 
                    ((isset($acci[1][6])) ? $acci[1][6] : ''), 
                    ((isset($acci[1][7])) ? $acci[1][7] : ''), 
                    ((isset($acci[1][8])) ? $acci[1][8] : ''), 
                    ((isset($acci[2][1])) ? $acci[2][1] : ''), 
                    ((isset($acci[2][2])) ? $acci[2][2] : $socio3), 
                    ((isset($acci[2][3])) ? $acci[2][3] : ''), 
                    ((isset($acci[2][4])) ? $acci[2][4] : ''), 
                    ((isset($acci[2][5])) ? $acci[2][5] : ''), 
                    ((isset($acci[2][6])) ? $acci[2][6] : ''), 
                    ((isset($acci[2][7])) ? $acci[2][7] : ''), 
                    ((isset($acci[2][8])) ? $acci[2][8] : ''), 
                    ((isset($acci[3][1])) ? $acci[3][1] : ''), 
                    ((isset($acci[3][2])) ? $acci[3][2] : ''), 
                    ((isset($acci[3][3])) ? $acci[3][3] : ''), 
                    ((isset($acci[3][4])) ? $acci[3][4] : ''), 
                    ((isset($acci[3][5])) ? $acci[3][5] : ''), 
                    ((isset($acci[3][6])) ? $acci[3][6] : ''), 
                    ((isset($acci[3][7])) ? $acci[3][7] : ''), 
                    ((isset($acci[3][8])) ? $acci[3][8] : ''), 
                    ((isset($acci[4][1])) ? $acci[4][1] : ''), 
                    ((isset($acci[4][2])) ? $acci[4][2] : ''), 
                    ((isset($acci[4][3])) ? $acci[4][3] : ''), 
                    ((isset($acci[4][4])) ? $acci[4][4] : ''), 
                    ((isset($acci[4][5])) ? $acci[4][5] : ''), 
                    ((isset($acci[4][6])) ? $acci[4][6] : ''), 
                    ((isset($acci[4][7])) ? $acci[4][7] : ''), 
                    ((isset($acci[4][8])) ? $acci[4][8] : ''), 
                    $dat[107], 
                    $dat[108], 
                    ($dat[109] == '-1') ? 'SI' : (($dat[109] == '0') ? 'NO' : 'SD'), 
                    $dat[110], 
                    $dat[111], 
                    $dat[112], 
                    ($dat[113] == '-1') ? 'SI' : (($dat[113] == '0') ? 'NO' : 'SD'), 
                    ($dat[114] == '-1') ? 'SI' : (($dat[114] == '0') ? 'NO' : 'SD'), 
                    ((isset($prod[0][1])) ? $prod[0][1] : ''), 
                    ((isset($prod[0][2])) ? $prod[0][2] : ''), 
                    ((isset($prod[0][3])) ? $prod[0][3] : ''), 
                    ((isset($prod[0][4])) ? $prod[0][4] : ''), 
                    ((isset($prod[0][6])) ? $prod[0][6] : ''), 
                    ((isset($prod[0][5])) ? $prod[0][5] : ''), 
                    ((isset($prod[0][7])) ? $prod[0][7] : ''), 
                    ((isset($prod[1][1])) ? $prod[1][1] : ''), 
                    ((isset($prod[1][2])) ? $prod[1][2] : ''), 
                    ((isset($prod[1][3])) ? $prod[1][3] : ''), 
                    ((isset($prod[1][4])) ? $prod[1][4] : ''), 
                    ((isset($prod[1][6])) ? $prod[1][6] : ''), 
                    ((isset($prod[1][5])) ? $prod[1][5] : ''), 
                    ((isset($prod[1][7])) ? $prod[1][7] : ''), 
                    ((isset($prod[2][1])) ? $prod[2][1] : ''), 
                    ((isset($prod[2][2])) ? $prod[2][2] : ''), 
                    ((isset($prod[2][3])) ? $prod[2][3] : ''), 
                    ((isset($prod[2][4])) ? $prod[2][4] : ''), 
                    ((isset($prod[2][6])) ? $prod[2][6] : ''), 
                    ((isset($prod[2][5])) ? $prod[2][5] : ''), 
                    ((isset($prod[2][7])) ? $prod[2][7] : ''), 
                    ($dat[115] == '-1') ? 'SI' : (($dat[115] == '0') ? 'NO' : 'SD'), 
                    ((isset($recl[0][1])) ? $recl[0][1] : ''), 
                    ((isset($recl[0][2])) ? $recl[0][2] : ''), 
                    ((isset($recl[0][3])) ? $recl[0][3] : ''), 
                    ((isset($recl[0][4])) ? $recl[0][4] : ''), 
                    ((isset($recl[0][5])) ? $recl[0][5] : ''), 
                    ((isset($recl[0][1])) ? $recl[0][1] : ''), 
                    ((isset($recl[0][2])) ? $recl[0][2] : ''), 
                    ((isset($recl[0][3])) ? $recl[0][3] : ''), 
                    ((isset($recl[0][4])) ? $recl[0][4] : ''), 
                    ((isset($recl[0][5])) ? $recl[0][5] : ''), 
                    ($dat[116] == '-1') ? 'SI' : (($dat[116] == '0') ? 'NO' : 'SD'), 
                    ($dat[117] == '-1') ? 'SI' : (($dat[117] == '0') ? 'NO' : 'SD'), 
                    ($dat[118] == '-1') ? 'SI' : (($dat[118] == '0') ? 'NO' : 'SD'), 
                    ($dat[119] == '-1') ? 'SI' : (($dat[119] == '0') ? 'NO' : 'SD'), 
                    $dat[120], 
                    $dat[121], 
                    $dat[122], 
                    $dat[123], 
                    $dat[124], 
                    $dat[125], 
                    $dat[126], 
                    ($dat[127] == '-1') ? 'SI' : (($dat[127] == '0') ? 'NO' : 'SD'), 
                    $dat[128], 
                    $dat[129], 
                    $dat[130], 
                    $dat[131], 
                    trim(preg_replace("/\s+/", " ", $dat[132])), 
                    ($dat[133] == '-1') ? 'SI' : (($dat[133] == '0') ? 'NO' : 'SD'), 
                    $dat[134], 
                    $ultimoestado 
                );
                fputcsv($fp, $dato, '|');
                unset($dato);
            }
        }
    }
    fclose($fp);
    echo "TERMINO...";
}
function getAccionistas($idData){
    $conn = new Conexion();
    $data = array();
    $SQL = "SELECT da.id,
                   ptd.description AS tipo_id, 
                   da.identificacion,
                   da.nombre_accionista,
                   da.porcentaje,
                   CASE da.publico_recursos WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END,
                   CASE da.publico_reconocimiento WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END,
                   CASE da.publico_expuesta WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' ELSE 'SD' END,
                   da.declaracion_tributaria
              FROM data_socios AS da
             INNER JOIN param_tipodocumento AS ptd ON(ptd.id = da.tipo_id)
             WHERE data_id = '$idData'";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($consulta = $conn->sacarRegistro('num')){
                $data[] = $consulta;
            }
        }
    }
    return $data;
}
function getReclamaciones($idData){
    $conn = new Conexion();
    $data = array();
    $SQL = "SELECT id,
                   rec_ano,
                   rec_ramo,
                   rec_compania,
                   rec_valor,
                   rec_resultado
              FROM data_reclamaciones 
             WHERE data_id = '$idData'";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($consulta = $conn->sacarRegistro('num')){
                $data[] = $consulta;
            }
        }
    }
    return $data;
}
function getProductos($idData){
    $conn = new Conexion();
    $data = array();
    $SQL = "SELECT id, 
                   tipo, 
                   identificacion_producto, 
                   entidad, 
                   monto, 
                   pais, 
                   ciudad, 
                   moneda 
              FROM data_productos 
             WHERE data_id = '$idData'";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($consulta = $conn->sacarRegistro('num')){
                $data[] = $consulta;
            }
        }
    }
    return $data;
}
function jsonClients(){
    $fp1 = fopen("clientes_json_salida.csv", "a");
    $conn = new Conexion();
    $data = array();
    for($i = 0; $i < 1000; $i++){
        $num = rand(4, 1447303);
        $SQL = "SELECT id, 
                       document AS documento, 
                       firstname AS name
                  FROM client
                 WHERE id = :id
                   AND estado = :estado
                 GROUP BY documento";
        if($conn->consultar($SQL, array(':estado'=> '0', ':id'=> $num))){
            if($conn->getNumeroRegistros() == 1){
                while($consulta = $conn->sacarRegistro('str')){
                    $data[] = $consulta;
                    fputcsv($fp1, $consulta, '|');
                }
            }
        }
    }
    $SQL = "SELECT id,
                   username AS documento,
                   name
              FROM intra.jos_users
             GROUP BY 2";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($consulta = $conn->sacarRegistro('str')){
                $data[] = $consulta;
                fputcsv($fp1, $consulta, '|');
            }
        }
    }
    $fp = fopen('clients.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);
    fclose($fp1);
}
function ultimosContactos(){
    $fp = fopen("files/ultimosContactos/ultimosContactos_salida_01.csv", "a");
    $head = array('IDENTIFICACION', 'ULTIMA TIPIFICACION CAPI', 'FECHA ULTIMA TIPIFICACION CAPI', 'ULTIMA TIPIFICACIÓN SEGUROS', 'FECHA ULTIMA TIPIFICACIÓN SEGUROS', 'ESTADO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $temp = file('files/ultimosContactos/ultimosContactos_01.csv');
    $n = count($temp);
    for($i = 1; $i < $n; $i++){
        $datos_leer = explode(";", $temp[$i]);
        $documento = trim($datos_leer[0]);
        $SQL = "SELECT c.document,
                       cc.contacto AS contacto_capi,
                       cc.date_created AS fecha_contacto_capi,
                       sc.contacto AS contacto_seguro,
                       sc.date_created AS fecha_contacto_seguro
                  FROM client AS c
                  LEFT JOIN (SELECT dc.id,
                                    dc.id_client,
                                    dc.date_created,
                                    dc.id_contact,
                                    pc.description AS contacto
                               FROM data_confirm AS dc
                               LEFT JOIN param_contact AS pc ON(pc.id = dc.id_contact)
                              INNER JOIN client AS c ON(c.id = dc.id_client)
                              WHERE c.document = :document1
                              ORDER BY dc.id_client, dc.date_created DESC
                     ) AS sc ON(sc.id_client = c.id)
                  LEFT JOIN (SELECT dcc.id,
                                    dcc.id_client,
                                    dcc.date_created,
                                    dcc.id_contact,
                                    pc.description AS contacto
                               FROM data_capi_confirm AS dcc
                               LEFT JOIN param_contact AS pc ON(pc.id = dcc.id_contact)
                              INNER JOIN client AS c ON(c.id = dcc.id_client)
                              WHERE c.document = :document2
                              ORDER BY dcc.id_client, dcc.date_created DESC
                     ) AS cc ON(cc.id_client = c.id)
                 WHERE c.document = :document
                 GROUP BY c.id";
        if($conn->consultar($SQL, array(':document'=> $documento, ':document1'=> $documento, ':document2'=> $documento))){
            if($conn->getNumeroRegistros() == 1){
                while($consulta = $conn->sacarRegistro('str')){
                    //$data[] = $consulta;
                    $consulta['estado'] = 'EXISTE';
                    fputcsv($fp, $consulta, '|');
                }
            }else
                fputcsv($fp, array($documento, '', '', '', '', 'NO_EXISTE'), '|');
        }else
            fputcsv($fp, array($documento, '', '', '', '', 'NO_CONSULTA'), '|');
    }
    fclose($fp);
    echo "TERMINO...";
}
function ultimosContactosTotal(){
    $fp = fopen("files/ultimosContactosTotal/ultimosContactosTotal_salida_".date('His').".csv", "a");
    $head = array('IDENTIFICACION', 'NOMBRE COMPLETO/RAZON SOCIAL', 'ULTIMA TIPIFICACION CAPI', 'FECHA ULTIMA TIPIFICACION CAPI', 'ULTIMA TIPIFICACIÓN SEGUROS', 'FECHA ULTIMA TIPIFICACIÓN SEGUROS', 'ESTADO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $con2 = new Conexion();
    $SQL = "SELECT c.id,
                   c.document,
                   c.firstname
              FROM client AS c 
             INNER JOIN form AS f ON(f.id_client = c.id)
             WHERE f.status = 1
             GROUP BY 1
             ORDER BY 2";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                $SQ2 = "SELECT c.document,
                               c.firstname,
                               cc.contacto AS contacto_capi,
                               cc.date_created AS fecha_contacto_capi,
                               sc.contacto AS contacto_seguro,
                               sc.date_created AS fecha_contacto_seguro
                          FROM client AS c
                          LEFT JOIN (SELECT dc.id,
                                            dc.id_client,
                                            dc.date_created,
                                            dc.id_contact,
                                            pc.description AS contacto
                                       FROM data_confirm AS dc
                                       LEFT JOIN param_contact AS pc ON(pc.id = dc.id_contact)
                                      WHERE dc.id_client = :id1
                                      ORDER BY dc.id_client, dc.date_created DESC
                             ) AS sc ON(sc.id_client = c.id)
                          LEFT JOIN (SELECT dcc.id,
                                            dcc.id_client,
                                            dcc.date_created,
                                            dcc.id_contact,
                                            pc.description AS contacto
                                       FROM data_capi_confirm AS dcc
                                       LEFT JOIN param_contact AS pc ON(pc.id = dcc.id_contact)
                                      WHERE dcc.id_client = :id2
                                      ORDER BY dcc.id_client, dcc.date_created DESC
                             ) AS cc ON(cc.id_client = c.id)
                         WHERE c.id = :id
                         GROUP BY c.id";
                if($con2->consultar($SQ2, array(':id'=> $dat['id'], ':id1'=> $dat['id'], ':id2'=> $dat['id']))){
                    if($con2->getNumeroRegistros() == 1){
                        while($consulta = $con2->sacarRegistro('str')){
                            //$data[] = $consulta;
                            $dat['firstname'] = trim(preg_replace("/\s+/", " ", $dat['firstname']));
                            $consulta['estado'] = 'EXISTE';
                            fputcsv($fp, $consulta, '|');
                        }
                    }elseif($con2->getNumeroRegistros() > 1){
                        fputcsv($fp, array($dat['document'], $dat['firstname'], '', '', '', '', 'MAS_UN_REGISTRO'), '|');
                    }else
                        fputcsv($fp, array($dat['document'], $dat['firstname'], '', '', '', '', 'NO_EXISTE'), '|');
                }else
                    fputcsv($fp, array($dat['document'], $dat['firstname'], '', '', '', '', 'NO_CONSULTA'), '|');
            }
        }
    }
    fclose($fp);
    echo "TERMINO...";
}
function eliminarDuplicadosDevoluciones(){
    $fh = fopen('files/eliminarDuplicadosDevoluciones_01_'.date('Y-m-d').'.csv',"a");
    fputcsv($fh, array("DATA", "ESTADO"), '|');
    $conn = new Conexion();
    $con2 = new Conexion();
    $SQL = "SELECT documento, 
                   id_radicado, 
                   COUNT('x') AS cantidad 
              FROM workflow 
             WHERE id_radicado != 0 
             GROUP BY documento, id_radicado 
            HAVING COUNT('x') > 1 
             ORDER BY 3 DESC";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                $cant = intval($dat['cantidad']) - 1;
                $SQ2 = "SELECT * 
                          FROM workflow
                         WHERE documento = :documento
                           AND id_radicado = :id_radicado
                         ORDER BY date_created ASC
                         LIMIT 0, :cantidad";
                if($con2->consultar($SQ2, array(':documento'=> $dat['documento'], ':id_radicado'=> $dat['id_radicado'], ':cantidad'=> $cant))){
                    if($con2->getNumeroRegistros() > 0){
                        while($dat2 = $con2->sacarRegistro('str')){
                            $SQD = "DELETE FROM workflow WHERE id = :id";
                            if($con2->ejecutar($SQD, array(':id'=> $dat2['id'])))
                                fputcsv($fh, array(json_encode($dat2), "ELIMINADO"), '|');
                            else
                                fputcsv($fh, array(json_encode($dat2), "NO_ELIMINADO"), '|');
                        }
                    }
                }
            }
        }
    }
    $conn->desconectar();
    $con2->desconectar();
    fclose($fh);
    echo "TERMINO...";
}
function ordenesNoListasAprobar(){
    require_once PATH_CCLASS.DS.'ordenproduccion.class2.php';
    $fh = fopen('files/ordenesNoListasAprobar_salida_'.date('YmdHis').'.csv',"a");
    fputcsv($fh, array("INICIO", "PLANILLA", "LOTE", "CANTIDAD FORMULARIOS", "DEVOLUCIONES", "NO LLEGARON", "TOTAL FORMULARIOS", "FORMULARIOS DIGITADOS", "DEVOLUCIONES CREADAS", "MARCADOS NO LLEGARON", "ESTADO"), '|');
    $conn = new Conexion();
    $SQL = "SELECT orden.id, 
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
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($obj = $conn->sacarRegistro('str')){
                $obj['inicio'] = '';
                if($obj['estado_aprobacion'] == 'Sin aprobar'){
                    $obj['inicio'] = 'Sin aprobar';
                }
                $obj['form_digitado'] = Ordenproduccion::getCountForms2($obj['planilla'], $obj['lote']);
                $obj['form_devolucion'] = Ordenproduccion::getCount2($obj['lote'], "0"); 
                $obj['form_noLlegaron'] = Ordenproduccion::getNoLlegaronForms($obj['lote']);
                $obj['acciones'] = '';
                $procesados = intval($obj['form_digitado']) + intval($obj['form_devolucion']) + intval($obj['form_noLlegaron']);
                if ($obj['cantidad_formularios'] == $procesados && (intval($obj['form_digitado']) == $obj['total_formularios']) && (intval($obj['form_devolucion']) == $obj['devoluciones']) && (intval($obj['form_noLlegaron']) == $obj['no_llegaron'])){
                    if($obj['estado_aprobacion'] == 'Sin aprobar')
                        $obj['acciones'] = 'Listo para aprobar';
                    else
                        $obj['acciones'] = 'Aprobado';

                    fputcsv($fh, array($obj['inicio'], $obj['planilla'], $obj['lote'], $obj['cantidad_formularios'], $obj['devoluciones'], $obj['no_llegaron'], $obj['total_formularios'], $obj['form_digitado'], $obj['form_devolucion'], $obj['form_noLlegaron'], $obj['acciones']), '|');
                }else{
                    $obj['acciones'] = 'No esta lista para aprobación.';
                    if($obj['estado_aprobacion'] != 'Sin aprobar')
                        $obj['inicio'] = 'Error';

                    fputcsv($fh, array($obj['inicio'], $obj['planilla'], $obj['lote'], $obj['cantidad_formularios'], $obj['devoluciones'], $obj['no_llegaron'], $obj['total_formularios'], $obj['form_digitado'], $obj['form_devolucion'], $obj['form_noLlegaron'], $obj['acciones']), '|');
                }
            }
        }
    }
    $conn->desconectar();
    fclose($fh);
    echo "TERMINO...";
}
function documentosEspecialesNoEspeciales(){
    $fp = fopen("files/documentosEspecialesNoEspeciales/documentosEspecialesNoEspeciales_salida_02.csv", "a");
    $head = array('PLANILLA', 'LOTE', 'DATOS', 'ESTADO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $con1 = new Conexion();
    $temp = file('files/documentosEspecialesNoEspeciales/documentosEspecialesNoEspeciales_02.csv');
    $n = count($temp);
    for($i = 1; $i < $n; $i++){
        $datos_leer = explode(";", $temp[$i]);
        $planilla = trim($datos_leer[0]);
        $lote = trim($datos_leer[1]);
        $SQL = "SELECT * 
                  FROM radicados_items AS ri 
                 WHERE id_radicados = :id_radicados
                   AND documento_especial = :documento_especial
                   AND estado = :estado";
        if($conn->consultar($SQL, array(':id_radicados'=> $lote, ':documento_especial'=> '1', ':estado'=> '2'))){
            if($conn->getNumeroRegistros() > 0){
                $items = array();
                while($dat = $conn->sacarRegistro('str')){
                    $items[] = $dat;
                }
                $SQ2 = "SELECT COUNT('x') AS cantidad
                          FROM data_renovacion_autos AS dr
                         WHERE lote = :lote";
                if($con1->consultar($SQ2, array(':lote'=> $lote))){
                    if($conn->getNumeroRegistros() == 1){
                        $dat2 = $con1->sacarRegistro('str');
                        if($dat2['cantidad'] == '0'){
                            $SQU = "UPDATE radicados_items 
                                       SET documento_especial = :documento_especial1 
                                     WHERE id_radicados = :id_radicados
                                       AND documento_especial = :documento_especial
                                       AND estado = :estado";
                            if($conn->ejecutar($SQU, array(':documento_especial1'=> '0', ':id_radicados'=> $lote, ':documento_especial'=> '1', ':estado'=> '2'))){
                                fputcsv($fp, array($planilla, $lote, json_encode($items), 'ACTUALIZADO'), '|');
                            }else
                                fputcsv($fp, array($planilla, $lote, json_encode($items), 'NO_ACTUALIZADO'), '|');
                        }else{
                            fputcsv($fp, array($planilla, $lote, 'RADICADOS_ESPECIALES: '.count($items).';DATA_RENOVADOS: '.$dat2['cantidad'], 'SI_DIGITADOS_ESPECIALES'), '|');
                        }
                    }else
                        fputcsv($fp, array($planilla, $lote, json_encode($items), 'CANTIDAD_RENOVACION_NO_DADA'), '|');
                }else
                    fputcsv($fp, array($planilla, $lote, json_encode($items), 'ERROR_CONSULTA_2'), '|');
            }else
                fputcsv($fp, array($planilla, $lote, '', 'NO_ESPECIALES_RADICADOS'), '|');
        }else
            fputcsv($fp, array($planilla, $lote, '', 'ERROR_CONSULTA_1'), '|');
    }
    fclose($fp);
    echo "TERMINO...".$n;
}
function eliminarLotePlanillaOrdenDeProduccion(){
    $fp = fopen("files/eliminarLotePlanillaOrdenDeProduccion/eliminarLotePlanillaOrdenDeProduccion_salida_01.csv", "a");
    $head = array('PLANILLA', 'LOTE', 'DATOS', 'ESTADO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $con1 = new Conexion();
    $temp = file('files/eliminarLotePlanillaOrdenDeProduccion/eliminarLotePlanillaOrdenDeProduccion_01.csv');
    $n = count($temp);
    for($i = 1; $i < $n; $i++){
        $datos_leer = explode(";", $temp[$i]);
        $planilla = trim($datos_leer[0]);
        $lote = trim($datos_leer[1]);
        $SQL = "SELECT * 
                  FROM ordenproduccion AS o 
                 WHERE planilla = :planilla
                   AND lote = :lote
                   AND estado_aprobacion = :estado_aprobacion";
        if($conn->consultar($SQL, array(':planilla'=> $planilla, ':lote'=> $lote, ':estado_aprobacion'=> 'Sin aprobar'))){
            if($conn->getNumeroRegistros() == 1){
                $dat = $conn->sacarRegistro('str');
                $SQ2 = "DELETE FROM ordenproduccion WHERE id = :id";
                if($conn->ejecutar($SQ2, array(':id'=> $dat['id'])))
                    fputcsv($fp, array($planilla, $lote, json_encode($dat), 'ACTUALIZADO'), '|');
                else
                    fputcsv($fp, array($planilla, $lote, json_encode($dat), 'NO_ACTUALIZADO'), '|');
            }else
                fputcsv($fp, array($planilla, $lote, '', 'CANTIDAD DE REGISTROS DIFERENTE A 1'), '|');
        }else
            fputcsv($fp, array($planilla, $lote, '', 'CONSULTA NO REALIZADA'), '|');
    }
    fclose($fp);
    echo "TERMINO...";
}
function updateComplementariosRadicados(){
    $conn = new Conexion();
    $con1 = new Conexion();
    $SQL = "SELECT id_forma,
                   original_file
              FROM image
             WHERE id_imagetype = :id_imagetype";
    if($conn->consultar($SQL, array(':id_imagetype'=> '4'))){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                $pLote = explode('_', $dat['original_file']);
                $SQ1 = "SELECT c.document
                          FROM client AS c
                         INNER JOIN form AS f ON(f.id_client = c.id)
                         WHERE f.id = :id";
                if($con1->consultar($SQ1, array(':id'=> $dat['id_forma']))){
                    if($con1->getNumeroRegistros() == 1){
                        $da = $con1->sacarRegistro('str');
                        $SQU = "UPDATE radicados_items
                                   SET documento_especial = :documento_especial
                                 WHERE id_radicados = :id_radicados
                                   AND documento = :documento";
                        $con1->ejecutar($SQU, array(':documento_especial'=> '2', ':id_radicados'=> $pLote[1], ':documento'=> $da['document']));
                    }
                }
            }
        }
    }
    $conn->desconectar();
    $con1->desconectar();
    echo "TERMINO...";
}
function baseSegurosDatosAVerificar(){
    $fp = fopen("files/baseSegurosDatosAVerificar/baseSegurosDatosAVerificar_salida_".date('His').".csv", "a");
    //$head = array('DOCUMENTO', 'NOMBRE COMPLETO/RAZON SOCIAL', 'FECHA NACIMIENTO', 'GENERO');
    $head = array('DOCUMENTO CLIENTE', 'NOMBRE COMPLETO/RAZON SOCIAL', 'DOCUMENTO REPRESENTANTE', 'NOMBRE REPRESENTANTE', 'FECHA NACIMIENTO', 'GENERO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    /*$SQL = "SELECT c.document AS 'DOCUMENTO',
                   c.firstname AS 'NOMBRE COMPLETO/RAZON SOCIAL',
                   DATE(d.fechanacimiento) AS 'FECHA NACIMIENTO',
                   d.sexo AS 'GENERO'
              FROM data AS d
             INNER JOIN form AS f ON(f.id = d.id_form)
             INNER JOIN client AS c ON(c.id = f.id_client)
             WHERE f.status = 1
               AND c.persontype = 1
             GROUP BY 1, 2, 3, 4
             ORDER BY c.document, f.date_created DESC";*/
    $SQL = "SELECT c.document AS 'DOCUMENTO CLIENTE',
                   c.firstname AS 'NOMBRE COMPLETO/RAZON SOCIAL',
                   d.documento AS 'DOCUMENTO REPRESENTANTE',
                   CONCAT_WS(' ', d.nombres, d.primerapellido, d.segundoapellido) AS 'NOMBRE REPRESENTANTE',
                   DATE(d.fechanacimiento) AS 'FECHA NACIMIENTO',
                   d.sexo AS 'GENERO'
              FROM data AS d
             INNER JOIN form AS f ON(f.id = d.id_form)
             INNER JOIN client AS c ON(c.id = f.id_client)
             WHERE f.status = 1
               AND c.persontype = 2
               AND (d.documento != '' AND d.documento != ' ' AND d.documento != '0' AND d.documento IS NOT NULL)
             GROUP BY 1, 2, 3, 4, 5, 6
             ORDER BY d.documento, f.date_created DESC";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('num')){
                fputcsv($fp, array($dat[0], trim(preg_replace("/\s+/", " ", $dat[1])), $dat[2], trim(preg_replace("/\s+/", " ", $dat[3])), trim(preg_replace("/\s+/", " ", $dat[4])), trim(preg_replace("/\s+/", " ", $dat[5]))), '|');
            }
        }
    }
    fclose($fp);
    $conn->desconectar();
    echo "TERMINO...";
}
function corregirDataDocumento(){
    $fp = fopen("files/corregirDataDocumento/corregirDataDocumento_salida_".date('His').".csv", "a");
    $head = array('DOCUMENTO CLIENTE', 'DOCUMENTO DIGITADO', 'ESTADO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $con1 = new Conexion();
    $temp = file('files/corregirDataDocumento/corregirDataDocumento_01.csv');
    $n = count($temp);
    for($i = 1; $i < $n; $i++){
        $datos_leer = explode(";", $temp[$i]);
        $document = trim($datos_leer[1]);
        $SQL = "SELECT d.id,
                       d.documento
                  FROM data AS d
                 INNER JOIN form AS f ON(f.id = d.id_form)
                 INNER JOIN client AS c ON(c.id = f.id_client)
                 WHERE c.document = :document
                   AND c.persontype = :persontype";
        if($conn->consultar($SQL, array(':document'=> $document, ':persontype'=> '1'))){
            if($conn->getNumeroRegistros() > 0){
                while($dat = $conn->sacarRegistro('str')){
                    $SQU = "UPDATE data SET documento = :documento WHERE id = :id";
                    if($conn->ejecutar($SQU, array(':documento'=> $document, ':id'=> $dat['id'])))
                        fputcsv($fp, array($document, $dat['documento'], 'ACTUALIZADO'), '|');
                    else
                        fputcsv($fp, array($document, $dat['documento'], 'NO_ACTUALIZADO'), '|');
                }
            }else
                fputcsv($fp, array($document, '', 'NO_REGISTROS'), '|');
        }else
            fputcsv($fp, array($document, '', 'ERROR_CONSULTA'), '|');
    }
    fclose($fp);
    echo "TERMINO...";
}
function corregirDataGenero(){
    $fp = fopen("files/corregirDataGenero/corregirDataGenero_salida_".date('His').".csv", "a");
    $head = array('DOCUMENTO CLIENTE', 'ID DATA', 'GENERO DIGITADO', 'GENERO NUEVO', 'ESTADO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $temp = file('files/corregirDataGenero/corregirDataGenero_01.csv');
    $n = count($temp);
    for($i = 1; $i < $n; $i++){
        $datos_leer = explode(";", $temp[$i]);
        $document = trim($datos_leer[1]);
        $sexo = trim($datos_leer[3]);
        $genero = trim($datos_leer[5]);
        $SQL = "SELECT d.id
                  FROM data AS d
                 INNER JOIN form AS f ON(f.id = d.id_form)
                 INNER JOIN client AS c ON(c.id = f.id_client)
                 WHERE c.document = :document
                   AND (d.sexo = :sexo OR d.sexo = '' OR d.sexo = ' ' OR d.sexo IS NULL)";
        if($conn->consultar($SQL, array(':document'=> $document, ':sexo'=> $sexo))){
            if($conn->getNumeroRegistros() > 0){
                while($dat = $conn->sacarRegistro('str')){
                    $SQU = "UPDATE data SET sexo = :sexo WHERE id = :id";
                    if($conn->ejecutar($SQU, array(':sexo'=> $genero, ':id'=> $dat['id'])))
                        fputcsv($fp, array($document, $dat['id'], $sexo, $genero, 'ACTUALIZADO'), '|');
                    else
                        fputcsv($fp, array($document, $dat['id'], $sexo, $genero, 'NO_ACTUALIZADO'), '|');
                }
            }else
                fputcsv($fp, array($document, '', $sexo, $genero, 'NO_REGISTROS'), '|');
        }else
            fputcsv($fp, array($document, '', $sexo, $genero, 'ERROR_CONSULTA'), '|');
    }
    fclose($fp);
    echo "TERMINO...";
}
function corregirDataFechaNacimiento(){
    $fp = fopen("files/corregirDataFechaNacimiento/corregirDataFechaNacimiento_salida_".date('His').".csv", "a");
    $head = array('DOCUMENTO CLIENTE', 'ID DATA', 'FECHA DIGITADA', 'FECHA NUEVA', 'ESTADO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $temp = file('files/corregirDataFechaNacimiento/corregirDataFechaNacimiento_01.csv');
    $n = count($temp);
    for($i = 1; $i < $n; $i++){
        $datos_leer = explode(";", $temp[$i]);
        $document = trim($datos_leer[1]);
        $fechaDig = date('Y-m-d', strtotime(str_replace('/', '-', trim($datos_leer[3]))));
        $fechaDigNew = date('Y-m-d', strtotime(str_replace('/', '-', trim($datos_leer[5]))));
        $SQL = "SELECT d.id
                  FROM data AS d
                 INNER JOIN form AS f ON(f.id = d.id_form)
                 INNER JOIN client AS c ON(c.id = f.id_client)
                 WHERE c.document = :document
                   AND (DATE(d.fechanacimiento) = :fechanacimiento OR DATE(d.fechanacimiento) IS NULL)";
        if($conn->consultar($SQL, array(':document'=> $document, ':fechanacimiento'=> $fechaDig))){
            if($conn->getNumeroRegistros() > 0){
                while($dat = $conn->sacarRegistro('str')){
                    $SQU = "UPDATE data SET fechanacimiento = :fechanacimiento WHERE id = :id";
                    if($conn->ejecutar($SQU, array(':fechanacimiento'=> $fechaDigNew, ':id'=> $dat['id'])))
                        fputcsv($fp, array($document, $dat['id'], $fechaDig, $fechaDigNew, 'ACTUALIZADO'), '|');
                    else
                        fputcsv($fp, array($document, $dat['id'], $fechaDig, $fechaDigNew, 'NO_ACTUALIZADO'), '|');
                }
            }else
                fputcsv($fp, array($document, '', $fechaDig, $fechaDigNew, 'NO_REGISTROS'), '|');
        }else
            fputcsv($fp, array($document, '', $fechaDig, $fechaDigNew, 'ERROR_CONSULTA'), '|');
    }
    fclose($fp);
    echo "TERMINO...";
}
function actualizarDataSexoMasivo(){
    $fp = fopen("files/actualizarDataSexoMasivo_salida_".date('His').".csv", "a");
    $head = array('ID CLIENTE', 'ID DATA', 'DOCUMENTO', 'NOMBRE', 'ESTADO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $con1 = new Conexion();
    $SQL = "SELECT c.id AS id_client, 
                   d.id AS id_data,
                   c.document,
                   c.firstname,
                   d.ciiu
              FROM data AS d
             INNER JOIN form AS f ON ( f.id = d.id_form ) 
             INNER JOIN client AS c ON ( c.id = f.id_client ) 
             /*WHERE (d.sexo IS NULL OR d.sexo = '' OR d.sexo = ' ' OR d.sexo = 'SD')*/
             WHERE (d.ciiu IS NULL OR d.ciiu = '' OR d.ciiu = ' ' OR d.ciiu = 'SD' OR d.ciiu = '0')
               AND d.id_official = 'USUARIO WEBSERVICE'
               AND c.persontype = 1
             ORDER BY c.id";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                $SQ1 = "SELECT d.ciiu/*d.sexo */
                          FROM data AS d 
                         INNER JOIN form AS f ON(f.id = d.id_form)
                         INNER JOIN client AS c ON(c.id = f.id_client)
                         WHERE c.id = :id_client
                           /*AND (d.sexo IS NOT NULL AND d.sexo != '' AND d.sexo != ' ' AND d.sexo != 'SD' AND d.sexo != '0')*/
                           AND (d.ciiu IS NOT NULL AND d.ciiu != '' AND d.ciiu != ' ' AND d.ciiu != 'SD' AND d.ciiu != '0')
                         /*GROUP BY 1*/
                         ORDER BY f.date_created DESC
                         LIMIT 0, 1";
                if($con1->consultar($SQ1, array(':id_client'=> $dat['id_client']))){
                    if($con1->getNumeroRegistros() == 1){
                        $da1 = $con1->sacarRegistro('str');
                        //if($con1->ejecutar("UPDATE data SET sexo = :sexo WHERE id = :id_data", array(':sexo'=> $da1['sexo'], ':id_data'=> $dat['id_data'])))
                        if($con1->ejecutar("UPDATE data SET ciiu = :ciiu WHERE id = :id_data", array(':ciiu'=> $da1['ciiu'], ':id_data'=> $dat['id_data'])))
                            fputcsv($fp, array($dat['id_client'], $dat['id_data'], $dat['document'], $dat['firstname'], 'ACTUALIZADO'), '|');
                        else
                            fputcsv($fp, array($dat['id_client'], $dat['id_data'], $dat['document'], $dat['firstname'], 'NO_ACTUALIZADO'), '|');
                    }elseif($con1->getNumeroRegistros() > 1){
                        fputcsv($fp, array($dat['id_client'], $dat['id_data'], $dat['document'], $dat['firstname'], 'MAS_UN_REGISTRO'), '|');
                    }else{
                        fputcsv($fp, array($dat['id_client'], $dat['id_data'], $dat['document'], $dat['firstname'], 'SIN_REGISTROS'), '|');
                    }
                }
            }
        }
    }
    $conn->desconectar();
    $con1->desconectar();
    fclose($fp);
    echo "TERMINO...";
}
function datosContactoEstratos(){
    $fp = fopen("files/datosContactoEstratos_salida_".date('His').".csv", "a");
    $head = array('ID CLIENTE', 'DOCUMENTO', 'NOMBRE COMPLETO', 'CIUDAD', 'TELEFONO');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $con1 = new Conexion();
    $SQL = "SELECT c.id,
                   c.document,
                   c.firstname
              FROM data AS d 
             INNER JOIN form AS f ON(f.id = d.id_form)
             INNER JOIN client AS c ON(c.id = f.id_client)
             WHERE (d.estrato BETWEEN 4 AND 6)
               AND c.persontype = 1
             GROUP BY 1";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                $SQ1 = "SELECT c.id AS 'ID',
                               c.document AS 'DOCUMENTO',
                               c.firstname AS 'NOMBRE COMPLETO',
                               IF(cd.id IS NOT NULL, CONCAT_WS(', ', cd.departamento, cd.ciudad), IF(ci.id IS NULL, ci.description, '')) AS 'CIUDAD',
                               t.telefono AS 'TELEFONO'
                          FROM client AS c 
                         INNER JOIN telefono AS t ON(t.cliente_id = c.id)
                          LEFT JOIN param_ciudadesdane AS cd ON(cd.cod_dane = t.cod_ciudad)
                          LEFT JOIN param_ciudad AS ci ON(ci.id = t.cod_ciudad)
                         WHERE c.id = :id";
                if($con1->consultar($SQ1, array(':id'=> $dat['id']))){
                    if($con1->getNumeroRegistros() > 0){
                        while($da1 = $con1->sacarRegistro('str'))
                            fputcsv($fp, $da1, '|');
                    }else{
                        fputcsv($fp, array($dat['id'], $dat['document'], $dat['firstname'], '', ''), '|');
                    }
                }
            }
        }
    }
    $conn->desconectar();
    $con1->desconectar();
    fclose($fp);
    echo "TERMINO...";
}
function corregirNacionalidades(){
    $fp = fopen("files/corregirNacionalidades/corregirNacionalidades_salida_".date('His').".csv", "a");
    $head = array('DATA ID', 'FORMULARIO', 'OLD PAIS NACIMIENTO', 'NEW PAIS NACIMIENTO', 'OLD OTRA NACIONALIDAD', 'NEW OTRA NACIONALIDAD', 'ESTADO', 'DATA');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $temp = file('files/corregirNacionalidades/corregirNacionalidades_02.csv');
    $n = count($temp);
    for($i = 1; $i < $n; $i++){
        $datos_leer = explode(";", $temp[$i]);
        if((!empty(trim($datos_leer[7])) && strtoupper(trim($datos_leer[7])) != 'OK') || (!empty(trim($datos_leer[10])) && strtoupper(trim($datos_leer[10])) != 'OK')){
            $id_data = trim($datos_leer[0]);
            $SQL = "SELECT id,
                           formulario,
                           paisnacimiento,
                           nacionalidad
                      FROM data
                     WHERE id = :id_data";
            if($conn->consultar($SQL, array(':id_data'=> $id_data))){
                if($conn->getNumeroRegistros() == 1){
                    $dat = $conn->sacarRegistro('str');
                    $comp = "";
                    $data = array(':id_data'=> $id_data);
                    $paisnacimiento = '';
                    if(!empty(trim($datos_leer[7])) && strtoupper(trim($datos_leer[7])) != 'OK'){
                        $comp = "paisnacimiento = :paisnacimiento";
                        if($dat['formulario'] == '15'){
                            $data[':paisnacimiento'] = trim($datos_leer[8]);
                            $paisnacimiento = trim($datos_leer[8]);
                        }
                        else{
                            $data[':nacionalidad'] = trim($datos_leer[9]);
                            $comp = "nacionalidad = :nacionalidad";
                            $paisnacimiento = trim($datos_leer[9]);
                        }
                    }
                    if(!empty(trim($datos_leer[10])) && strtoupper(trim($datos_leer[10])) != 'OK'){
                        if(empty($comp))
                            $comp = "nacionalidad_otra = :nacionalidad_otra";
                        else
                            $comp .= ", nacionalidad_otra = :nacionalidad_otra";
                        $data[':nacionalidad_otra'] = trim($datos_leer[11]);
                    }


                    $SQU = "UPDATE data SET $comp WHERE id = :id_data";
                    //echo $SQU."<br>".json_encode($data)."<br><br>";
                    if($conn->ejecutar($SQU, $data))
                        fputcsv($fp, array(trim($datos_leer[0]), $dat['formulario'], trim($datos_leer[5]), $paisnacimiento, trim($datos_leer[7]), trim($datos_leer[11]), 'ACTUALIZADO', json_encode($datos_leer)), '|');
                    else
                        fputcsv($fp, array(trim($datos_leer[0]), $dat['formulario'], trim($datos_leer[5]), $paisnacimiento, trim($datos_leer[7]), trim($datos_leer[11]), 'NO_ACTUALIZADO', json_encode($datos_leer)), '|');
                    unset($data);
                }else{
                    fputcsv($fp, array(trim($datos_leer[0]), '', trim($datos_leer[5]), trim($datos_leer[8]).':::'.trim($datos_leer[9]), trim($datos_leer[7]), trim($datos_leer[11]), 'NO_REGISTROS', json_encode($datos_leer)), '|');
                }
            }else{
                fputcsv($fp, array(trim($datos_leer[0]), '', trim($datos_leer[5]), trim($datos_leer[8]).':::'.trim($datos_leer[9]), trim($datos_leer[7]), trim($datos_leer[11]), 'NO_SE_PUDO_CONSULTAR', json_encode($datos_leer)), '|');
            }
        }else{
            fputcsv($fp, array(trim($datos_leer[0]), '', trim($datos_leer[5]), '', trim($datos_leer[7]), '', 'SIN_DATOS_ACTUALIZAR', json_encode($datos_leer)), '|');
        }
    }
    fclose($fp);
    echo "TERMINO...";
}
function dataCompletaCapi(){
    $fp = fopen("files/dataCompletaCapi/dataCompletaCapi_salida_".date('His').".csv", "a");
    $head = array(
        'TIPO PERSONA',
        'DOCUMENTO',
        'NOMBRE COMPLETO',
        'SUCURSAL',
        'FECHA EXPEDICION',
        'TITULO',
        'DIGITO CHEQUEO',
        'CONSECUTIVO',
        'TIPO DOCUMENTO',
        'DOCUMENTO / NIT',
        'PRIMER APELLIDO',
        'SEGUNDO APELLIDO',
        'NOMBRE / RAZON SOCIAL',
        'FECHA NACIMIENTO',
        'LUGAR NACIMIENTO',
        'NUMERO DE HIJOS',
        'ESTADO CIVIL',
        'NIVEL DE ESTUDIOS',
        'INGRESOS',
        'EGRESOS',
        'ACTIVOS',
        'PASIVOS',
        'PROFESION',
        'EMPRESA',
        'CIUDAD LABORAL',
        'DIRECCION LABORAL',
        'TELEFONO LABORAL',
        'CIUDAD RESIDENCIA',
        'DIRECCION RESIDENCIA',
        'TELEFONO RESIDENCIA 1',
        'TELEFONO RESIDENCIA 2',
        'CELULAR',
        'CORREO ELECTRONICO'
    );
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $SQL = "SELECT c.document,
                   IF(c.persontype = '1', 'NATURAL', 'JURIDICO') AS persontype,
                   c.firstname,
                   dc.id_client,
                   dc.sucursal,
                   dc.fechaexpedicion,
                   dc.titulo,
                   dc.digitochequeo,
                   dc.consecutivo,
                   dc.tipodocumento,
                   IF(c.persontype = '1', dc.documento, dc.nit) AS doc_nit,
                   dc.primerapellido,
                   dc.segundoapellido,
                   IF(c.persontype = '1', dc.nombres, dc.razonsocial) AS nom_razon,
                   dc.fechanacimiento,
                   dc.lugarnacimiento,
                   dc.numerohijos,
                   pe.description AS estadocivil,
                   pes.description AS nivelestudios,
                   IF(c.persontype = '1', pim.value, IF(c.persontype = '2', pie.value, dc.ingresos)) AS ingresos,
                   dc.ingresos AS ingresos_val,
                   IF(c.persontype = '1', pem.value, IF(c.persontype = '2', peme.value, dc.egresos)) AS egresos,
                   dc.egresos AS egresos_val,
                   IF(c.persontype = '1', pima.value, IF(c.persontype = '2', piea.value, dc.activos)) AS activos,
                   dc.activos AS activos_val,
                   IF(c.persontype = '1', pimp.value, IF(c.persontype = '2', piep.value, dc.pasivos)) AS pasivos,
                   dc.pasivos AS pasivos_val,
                   ppr.description AS profesion,
                   dc.empresa,
                   dc.ingresosmensuales,
                   dc.egresosmensuales,
                   pci1.description AS ciudadlaboral,
                   dc.direccionlaboral,
                   dc.telefonolaboral,
                   pci.description AS ciudadresidencia,
                   dc.direccionresidencia,
                   dc.telefonoresidencia1,
                   dc.telefonoresidencia2,
                   dc.celular,
                   dc.correoelectronico,
                   dc.id_user,
                   dc.date_created
              FROM data_capi AS dc
             INNER JOIN client AS c ON(c.id = dc.id_client)
              LEFT JOIN param_estadocivil AS pe ON(pe.id = dc.estadocivil)
              LEFT JOIN param_estudio AS pes ON(pes.id = dc.nivelestudios)
              LEFT JOIN param_profesion AS ppr ON(ppr.id = dc.profesion)
              LEFT JOIN param_ciudad AS pci ON(pci.id = dc.ciudadresidencia)
              LEFT JOIN param_ciudad AS pci1 ON(pci1.id = dc.ciudadlaboral)
              LEFT JOIN param_ingresosmensuales AS pim ON(pim.id = dc.ingresos)
              LEFT JOIN param_ingresosmensuales_emp AS pie ON(pie.id = dc.ingresos)
              LEFT JOIN param_egresosmensuales AS pem ON(pem.id = dc.egresos)
              LEFT JOIN param_egresosmensuales_emp AS peme ON(peme.id = dc.egresos)
              LEFT JOIN param_ingresosmensuales AS pima ON(pima.id = dc.activos)
              LEFT JOIN param_ingresosmensuales_emp AS piea ON(piea.id = dc.activos)
              LEFT JOIN param_ingresosmensuales AS pimp ON(pimp.id = dc.pasivos)
              LEFT JOIN param_ingresosmensuales_emp AS piep ON(piep.id = dc.pasivos)";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($dat = $conn->sacarRegistro('str')){
                $row = array(
                    $dat['persontype'], 
                    $dat['document'], 
                    $dat['firstname'], 
                    $dat['sucursal'], 
                    $dat['fechaexpedicion'], 
                    $dat['titulo'], 
                    $dat['digitochequeo'], 
                    $dat['consecutivo'], 
                    $dat['tipodocumento'], 
                    $dat['doc_nit'], 
                    $dat['primerapellido'], 
                    $dat['segundoapellido'], 
                    $dat['nom_razon'], 
                    $dat['fechanacimiento'], 
                    $dat['lugarnacimiento'], 
                    $dat['numerohijos'], 
                    $dat['estadocivil'], 
                    $dat['nivelestudios'], 
                    (!empty($dat['ingresos']) && !is_null($dat['ingresos'])) ? $dat['ingresos'] : $dat['ingresos_val'], 
                    (!empty($dat['egresos']) && !is_null($dat['egresos'])) ? $dat['egresos'] : $dat['egresos_val'], 
                    (!empty($dat['activos']) && !is_null($dat['activos'])) ? $dat['activos'] : $dat['activos_val'], 
                    (!empty($dat['pasivos']) && !is_null($dat['pasivos'])) ? $dat['pasivos'] : $dat['pasivos_val'], 
                    $dat['profesion'], 
                    $dat['empresa'], 
                    $dat['ciudadlaboral'], 
                    $dat['direccionlaboral'], 
                    $dat['telefonolaboral'], 
                    $dat['ciudadresidencia'], 
                    $dat['direccionresidencia'], 
                    $dat['telefonoresidencia1'], 
                    $dat['telefonoresidencia2'], 
                    $dat['celular'], 
                    $dat['correoelectronico']
                );
                fputcsv($fp, $row, '|');
                unset($row);
            }
        }
    }
    $conn->desconectar();
    fclose($fp);
    echo "TERMINO...";
}
function corregirDatosPEPS(){
    $fp = fopen("files/corregirDatosPEPS/corregirDatosPEPS_salida_".date('His').".csv", "a");
    $head = array('DATA ID', 'OLD DATA', 'ESTADO', 'DATA');
    fputcsv($fp, $head, '|');
    $conn = new Conexion();
    $temp = file('files/corregirDatosPEPS/corregirDatosPEPS_01.csv');
    $n = count($temp);
    for($i = 1; $i < $n; $i++){
        $datos_leer = explode(";", $temp[$i]);
        //if((!empty(trim($datos_leer[14])) && strtoupper(trim($datos_leer[14])) != 'VERIFICADO')){
            $respH = respuestaEscogida($datos_leer[7]);//H
            $respI = respuestaEscogida($datos_leer[8]);//I
            $respJ = respuestaEscogida($datos_leer[9]);//J
            $respK = trim($datos_leer[10]);//K
            $respL = respuestaEscogida($datos_leer[11]);//L
            $respM = respuestaEscogida($datos_leer[12]);//M
            $respN = trim($datos_leer[13]);//N
            $respO = (trim($datos_leer[14]) != '' && trim($datos_leer[14]) != 'NO' && trim($datos_leer[14]) != 'SD') ? date('Y-m-d', strtotime(str_replace('/', '-', trim($datos_leer[14])))) : '0000-00-00';//O
            $respP = (trim($datos_leer[15]) != '' && trim($datos_leer[15]) != 'NO' && trim($datos_leer[15]) != 'SD') ? date('Y-m-d', strtotime(str_replace('/', '-', trim($datos_leer[15])))) : '0000-00-00';//P
            $respQ = respuestaEscogida($datos_leer[16]);//Q
            $respR = trim($datos_leer[17]);//R
            $respS = trim($datos_leer[18]);//S
            $respT = respuestaEscogida($datos_leer[19]);//T
            $respU = trim($datos_leer[20]);//U
            $respV = respuestaEscogida($datos_leer[21]);//V
            $respW = trim($datos_leer[22]);//W

            $respX = respuestaEscogida($datos_leer[23]);//X
            $respY = respuestaEscogida($datos_leer[24]);//Y
            $respZ = respuestaEscogida($datos_leer[25]);//Z
            $respAA = trim($datos_leer[26]);//AA
            $respAB = respuestaEscogida($datos_leer[27]);//AB
            $respAC = respuestaEscogida($datos_leer[28]);//AC
            $respAD = respuestaEscogida($datos_leer[29]);//AD
            $respAE = trim($datos_leer[30]);//AE
            $respAF = respuestaEscogida($datos_leer[31]);//AF
            $respAG = respuestaEscogida($datos_leer[32]);//AG
            $respAH = respuestaEscogida($datos_leer[33]);//AH
            $respAI = trim($datos_leer[34]);//AI
            $respAJ = respuestaEscogida($datos_leer[35]);//AJ
            $respAK = respuestaEscogida($datos_leer[36]);//AK
            $respAL = respuestaEscogida($datos_leer[37]);//AL
            $respAM = trim($datos_leer[38]);//AM
            $respAN = respuestaEscogida($datos_leer[39]);//AN
            $respAO = respuestaEscogida($datos_leer[40]);//AO
            $respAP = respuestaEscogida($datos_leer[41]);//AP
            $respAQ = trim($datos_leer[42]);//AQ


            $id_data = trim($datos_leer[43]);//AR

            //$ma_re_pu = (!empty(trim($datos_leer[0])) && trim($datos_leer[0]) == '')
            $SQL = "SELECT recursos_publicos,
                           poder_publico,
                           reconocimiento_publico,
                           reconocimiento_cual,
                           servidor_publico,
                           expuesta_politica,
                           cargo_politica,
                           cargo_politica_ini,
                           cargo_politica_fin,
                           expuesta_publica,
                           publica_nombre, 
                           publica_cargo,
                           repre_internacional,
                           internacional_indique,
                           tributarias_otro_pais,
                           tributarias_paises,
                           id
                      FROM data
                     WHERE id = :id_data";
            if($conn->consultar($SQL, array(':id_data'=> $id_data))){
                if($conn->getNumeroRegistros() == 1){
                    $row = $conn->sacarRegistro('str');
                    $SQU = "UPDATE data
                               SET recursos_publicos = :recursos_publicos,
                                   poder_publico = :poder_publico,
                                   reconocimiento_publico = :reconocimiento_publico,
                                   reconocimiento_cual = :reconocimiento_cual,
                                   servidor_publico = :servidor_publico,
                                   expuesta_politica = :expuesta_politica,
                                   cargo_politica = :cargo_politica,
                                   cargo_politica_ini = :cargo_politica_ini,
                                   cargo_politica_fin = :cargo_politica_fin,
                                   expuesta_publica = :expuesta_publica,
                                   publica_nombre = :publica_nombre,
                                   publica_cargo = :publica_cargo,
                                   repre_internacional = :repre_internacional,
                                   internacional_indique = :internacional_indique,
                                   tributarias_otro_pais = :tributarias_otro_pais,
                                   tributarias_paises = :tributarias_paises
                             WHERE id = :id_data";
                    $data = array(
                        ':recursos_publicos'=> $respH,
                        ':poder_publico'=> $respI,
                        ':reconocimiento_publico'=> $respJ,
                        ':reconocimiento_cual'=> $respK,
                        ':servidor_publico'=> $respL,
                        ':expuesta_politica'=> $respM,
                        ':cargo_politica'=> $respN,
                        ':cargo_politica_ini'=> $respO,
                        ':cargo_politica_fin'=> $respP,
                        ':expuesta_publica'=> $respQ,
                        ':publica_nombre'=> $respR,
                        ':publica_cargo'=> $respS,
                        ':repre_internacional'=> $respT,
                        ':internacional_indique'=> $respU,
                        ':tributarias_otro_pais'=> $respV,
                        ':tributarias_paises'=> $respW,
                        ':id_data'=> $id_data
                    );
                    if($conn->ejecutar($SQU, $data)){
                        fputcsv($fp, array($id_data, json_encode($row), 'ACTUALIZADO', json_encode($datos_leer)), '|');
                    }else{
                        fputcsv($fp, array($id_data, json_encode($row), 'NO_ACTUALIZADO', json_encode($datos_leer)), '|');
                    }
                }else{
                    fputcsv($fp, array($id_data, 'NO_DATOS', 'ACTUALIZADO', json_encode($datos_leer)), '|');
                }
            }else{
                fputcsv($fp, array($id_data, 'ERROR_CONSULTA', 'ACTUALIZADO', json_encode($datos_leer)), '|');
            }
        /*}else{
            fputcsv($fp, array(trim($datos_leer[0]), '', trim($datos_leer[5]), '', trim($datos_leer[7]), '', 'SIN_DATOS_ACTUALIZAR', json_encode($datos_leer)), '|');
        }*/
    }
    fclose($fp);
    echo "TERMINO...";
}
function respuestaEscogida($resp){
    if(trim($resp) != '' && strtoupper(trim($resp)) == 'SI')
        return '-1';
    else if(trim($resp) != '' && strtoupper(trim($resp)) == 'NO')
        return '0';
    else
        return '2';
}
function busquedaTelefonos(){
    $conn = new Conexion();
    $temp = file('files/busquedaTelefonos_24.csv');
    $fh = fopen('files/busquedaTelefonos_salida_'.date('YmdHis').'.csv',"a");
    fputcsv($fh, array("DOCUMENTO", "NOMBRE", "TELEFONO", "CIUDAD"), '|');
    $n=count($temp);
    for ($i = 1; $i < $n; $i++){
        $datos_leer = explode(";",$temp[$i]);
        $documento = trim($datos_leer[0]);
        $SQL = "SELECT c.document,
                       c.firstname AS nombre_completo,
                       t.telefono AS descripcion,
                       CONCAT_WS(', ', pd.departamento, pd.ciudad) AS ciudad
                  FROM client AS c
                 INNER JOIN telefono AS t ON(c.id = t.cliente_id)
                  LEFT JOIN param_ciudadesdane AS pd ON(pd.cod_dane = t.cod_ciudad)
                 WHERE c.document = :documento
                 UNION
                SELECT c.document,
                       c.firstname AS nombre_completo,
                       d.direccion AS descripcion,
                       CONCAT_WS(', ', pd.departamento, pd.ciudad) AS ciudad
                  FROM client AS c
                 INNER JOIN direccion AS d ON(c.id = d.cliente_id)
                  LEFT JOIN param_ciudadesdane AS pd ON(pd.cod_dane = d.cod_ciudad)
                 WHERE c.document = :documento1";
        if($conn->consultar($SQL, array(':documento'=> $documento, ':documento1'=> $documento))){
            if($conn->getNumeroRegistros() > 0){
                while($row = $conn->sacarRegistro('str')){
                    fputcsv($fh, array($row['document'], $row['nombre_completo'], $row['descripcion'], $row['ciudad']), '|');
                }
            }else{
                fputcsv($fh, array($documento, '', 'NO_TIENE'), '|');
            }
        }else{
            fputcsv($fh, array($documento, '', 'NO_CONSULTA'), '|');
        }
    }
    $conn->desconectar();
    fclose($fh);
    echo "TERMINO...";
}
function arreglarFechasConSlash(){
    $conn = new Conexion();
    $fh = fopen('files/arreglarFechasConSlash_salida_'.date('YmdHis').'.csv',"a");
    fputcsv($fh, array("ID_CLIENTE", "ID_FORM", "ID_DATA", "OLDDATE", "NEWDATE", "ESTADO"), '|');
    $SQL = "SELECT d.id, 
                   d.fechaexpedicion, 
                   f.id AS form_id, 
                   c.id AS client_id 
              FROM data AS d 
             INNER JOIN form AS f ON(f.id = d.id_form)
             INNER JOIN client AS c ON(c.id = f.id_client)
             WHERE c.persontype = 2
               AND DATE(fechaexpedicion) IS NULL
               AND fechaexpedicion LIKE '%/%'
               AND LENGTH(fechaexpedicion) = 10";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            while($row = $conn->sacarRegistro('str')){
                $newFecha = date('Y-m-d', strtotime(str_replace('/', '-', $row['fechaexpedicion'])));
                if($conn->ejecutar("UPDATE data SET fechaexpedicion = :fechaexpedicion WHERE id = :id", [':id'=> $row['id'], ':fechaexpedicion'=> $newFecha]))
                    fputcsv($fh, [$row['client_id'], $row['form_id'], $row['id'], $row['fechaexpedicion'], $newFecha, "ACTUALIZADO"], '|');
                else
                    fputcsv($fh, [$row['client_id'], $row['form_id'], $row['id'], $row['fechaexpedicion'], $newFecha, "NO_ACTUALIZADO"], '|');
            }
        }else{
            fputcsv($fh, ["", "", "", "", "", "NO_TIENE"], '|');
        }
    }else{
        fputcsv($fh, ["", "", "", "", "", "NO_CONSULTA"], '|');
    }
    $conn->desconectar();
    fclose($fh);
    echo "TERMINO...";
}
function arreglarFechasConGuion(){
    $conn = new Conexion();
    $fh = fopen('files/arreglarFechasConGuion_salida_'.date('YmdHis').'.csv',"a");
    fputcsv($fh, array("ID_CLIENTE", "CONSULTA"), '|');
    $SQL = "SELECT c.id 
              FROM data AS d 
             INNER JOIN form AS f ON(f.id = d.id_form)
             INNER JOIN client AS c ON(c.id = f.id_client)
             WHERE c.persontype = 1
               AND DATE(fechaexpedicion) IS NULL
               AND fechaexpedicion LIKE '%-%'
               AND LENGTH(fechaexpedicion) = 10
             GROUP BY c.id";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            $con1 = new Conexion();
            while($row = $conn->sacarRegistro('str')){
                $SQL2 = "SELECT CONCAT('SELECT * FROM data WHERE id IN (', GROUP_CONCAT(d.id SEPARATOR ', '), ')') AS ids, c.id
                          FROM data AS d 
                         INNER JOIN form AS f ON(f.id = d.id_form)
                         INNER JOIN client AS c ON(c.id = f.id_client)
                         WHERE c.id = :id
                         GROUP BY c.id";
                if($con1->consultar($SQL2, [':id'=> $row['id']])){
                    if($con1->getNumeroRegistros() > 0){
                        while($row2 = $con1->sacarRegistro('str'))
                            fputcsv($fh, [$row2['id'], $row2['ids']], '|');
                    }
                }
            }
        }else{
            fputcsv($fh, ["", "NO_TIENE"], '|');
        }
    }else{
        fputcsv($fh, ["", "NO_CONSULTA"], '|');
    }
    $con1->desconectar();
    $conn->desconectar();
    fclose($fh);
    echo "TERMINO...";
}
function busquedaCorreoElectronico(){
    $conn = new Conexion();
    $temp = file('files/busquedaCorreoElectronico_01.csv');
    $fh = fopen('files/busquedaCorreoElectronico_salida_'.date('YmdHis').'.csv',"a");
    fputcsv($fh, array("DOCUMENTO", "NOMBRE", "EMAIL", "EMAIL OTRO", "ESTADO"), '|');
    $n=count($temp);
    for ($i = 1; $i < $n; $i++){
        $datos_leer = explode(";",$temp[$i]);
        $documento = trim($datos_leer[0]);
        $SQL = "SELECT c.document,
                       c.firstname,
                       d.correoelectronico,
                       d.correoelectronico_otro
                  FROM client AS c
                 INNER JOIN form AS f ON(f.id_client = c.id)
                 INNER JOIN data AS d ON(d.id_form = f.id)
                 WHERE c.document = :document
                   AND f.status = 1
                 UNION
                SELECT c.document,
                       c.firstname,
                       d.correoelectronico,
                       '' AS correoelectronico_otro
                  FROM client AS c
                 INNER JOIN data_capi AS d ON(d.id_client = c.id)
                 WHERE c.document = :document1
                 UNION
                SELECT c.document,
                       c.firstname,
                       d.email AS correoelectronico,
                       '' AS correoelectronico_otro
                  FROM client AS c
                 INNER JOIN form AS f ON(f.id_client = c.id)
                 INNER JOIN data_renovacion_autos AS d ON(d.id_fomulario = f.id)
                 WHERE c.document = :document2
                   AND f.status = 1";
        if($conn->consultar($SQL, array(':document'=> $documento, ':document1'=> $documento, ':document2'=> $documento))){
            if($conn->getNumeroRegistros() > 0){
                while($row = $conn->sacarRegistro('str')){
                    fputcsv($fh, array($row['document'], $row['firstname'], $row['correoelectronico'], $row['correoelectronico_otro'], "EXISTE"), '|');
                }
            }else{
                fputcsv($fh, array($documento, '', '', '', 'NO_TIENE'), '|');
            }
        }else{
            fputcsv($fh, array($documento, '', '', '', 'NO_CONSULTA'), '|');
        }
    }
    $conn->desconectar();
    fclose($fh);
    echo "TERMINO...";
}
/*
SELECT IF(c.persontype = 2, 'JURIDICO', 'NATURAL') AS 'TIPO DE PERSONA',
       c.document AS '# DOCUMENTO',
       f.log_planilla AS '# PLANILLA',
       f.log_lote AS '# RADICADO',
       f.date_created AS 'FECHA DIGITACION'
  FROM `image` AS i
 INNER JOIN form AS f ON(f.id = i.id_forma)
 INNER JOIN client AS c ON(c.id = f.id_client)
 WHERE i.id_imagetype = 4 
   AND (DATE(i.date_created) BETWEEN '2017-01-01' AND '2017-12-31') 
 ORDER BY i.date_created DESC

SELECT u.id AS 'ID',
       g.name AS 'GRUPO', 
       u.username AS 'USUARIO', 
       u.identificacion AS 'IDENTIFICACION', 
       u.name AS 'NOMBRE COMPLETO', 
       u.correoelectronico AS 'CORREO ELECTRONICO',  
       'ACTIVO' AS 'ESTADO'
  FROM `user` AS u
 INNER JOIN  `group` AS g ON ( g.id = u.id_group ) 
 WHERE u.status =1
   AND u.id_group NOT IN ( 6, 4, 3, 7 ) 
 ORDER BY u.id_group*/
function informeDocumentosCarpetaVirtual(){
    $pathTif = '/var/www/html/Almacenamiento.Serverfin03/sdb1/data/ing';
    $pathGra = '/home/storage';
    $pathGr2 = '/var/www/html/Almacenamiento.Serverfin';
    $head2 = array('DOCUMENTO', 'LOTE', 'BP', 'NOMBRE', 'TIPO ARCHIVO', 'DIRECTORIO', 'ARCHIVO', 'FECHA CARGUE', 'PESO KB', 'PESO MB', 'ESTADO');
    $conta = 1;
    $fp = fopen("files/inforImagenesCliente/informeDocumentosCarpetaVirtual_01_".date('His').".csv", "a");
    fputcsv($fp, $head2, '|');
    $conn = new Conexion();
    $ano = date('Y', strtotime('-6 years'));
    //IMAGENES
    $SQL = "SELECT ca.id_archivo,
                   ca.archivo,
                   pac.nombre AS clase_str,
                   pac.codigo,
                   ca.fecha_creacion,
                   ca.dir, 
                   ci.documento,
                   ci.lote,
                   ci.bp,
                   ci.nombre
              FROM finleco_ing.call_archivos AS ca
             INNER JOIN finleco_ing.call_cliente AS ci ON(ci.id_cliente = ca.id_cliente)
             INNER JOIN finleco_ing.param_archivo_clase AS pac ON(pac.id_archivo_clase = ca.id_archivo_clase)
             WHERE ca.archivo NOT LIKE '%arreglados%'";
    if($conn->consultar($SQL)){
        if($conn->getNumeroRegistros() > 0){
            $cont = 0;
            while($dat = $conn->sacarRegistro('str')){
                $cont++;
                if($cont > 1000000){
                    $cont = 0;
                    fclose($fp);
                    $conta++;
                    $fp = fopen("files/inforImagenesCliente/informeDocumentosCarpetaVirtual_0".$conta."_".date('His').".csv", "a");
                    fputcsv($fp, $head2, '|');
                }
                if(file_exists($pathTif.DS.$dat['dir'].DS.$dat['archivo'])){
                    if($fileBytes = filesize($pathTif.DS.$dat['dir'].DS.$dat['archivo'])){
                        $fileKb = floatval($fileBytes) / 1024;
                        $fileMb = floatval($fileBytes) / pow(1024, 2);
                        fputcsv($fp, array($dat['documento'], $dat['nombre'], $dat['lote'], $dat['bp'], $dat['clase_str'], $pathTif.DS.$dat['dir'], $dat['archivo'], $dat['fecha_creacion'], str_replace(".", "," , strval(round($fileKb, 2)))." Kb", str_replace(".", "," , strval(round($fileMb, 2)))." Mb", 'EXISTE'), '|');
                    }else
                        fputcsv($fp, array($dat['documento'], $dat['nombre'], $dat['lote'], $dat['bp'], $dat['clase_str'], $pathTif.DS.$dat['dir'], $dat['archivo'], $dat['fecha_creacion'], "0 Kb", "0 Mb", 'NO_PESO'), '|');
                }else
                    fputcsv($fp, array($dat['documento'], $dat['nombre'], $dat['lote'], $dat['bp'], $dat['clase_str'], $pathTif.DS.$dat['dir'], $dat['archivo'], $dat['fecha_creacion'], "0 Kb", "0 Mb", 'NO_EXISTE'), '|');
            }
        }
    }
    fclose($fp);
    echo "TERMINO...";
}
/*
SELECT c.document, 
       c.firstname AS razon_social,
       d.socio1, 
       d.socio2, 
       d.socio3,
       f.date_created
  FROM `client` AS c 
 INNER JOIN form AS f ON(f.id_client = c.id)
 INNER JOIN data AS d ON(d.id_form = f.id)
 WHERE c.persontype != 1
   AND f.status = 1
   AND ((d.socio1 IS NOT NULL AND d.socio1 != '' AND d.socio1 != '0' AND d.socio1 != '*')
   AND (d.socio2 IS NOT NULL AND d.socio2 != '' AND d.socio2 != '0' AND d.socio2 != '*')
   AND (d.socio3 IS NOT NULL AND d.socio3 != '' AND d.socio3 != '0' AND d.socio3 != '*'))
 ORDER BY c.document, f.date_created DESC


SELECT c.document, 
       c.firstname AS razon_social,
       pt.description AS tipo_documento,
       ds.identificacion,
       ds.nombre_accionista,
       ds.porcentaje,
       CASE ds.publico_recursos WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS publico_recursos,
       CASE ds.publico_reconocimiento WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS publico_reconocimiento,
       CASE ds.publico_expuesta WHEN -1 THEN 'SI' WHEN 0 THEN 'NO' WHEN 2 THEN 'SD' ELSE 'SD' END AS publico_expuesto,
       ds.declaracion_tributaria
  FROM data_socios AS ds 
  LEFT JOIN param_tipodocumento AS pt ON(pt.id = ds.tipo_id)
 INNER JOIN data AS d ON(d.id = ds.data_id)
 INNER JOIN form AS f ON(f.id = d.id_form)
 INNER JOIN client AS c ON(c.id = f.id_client)

SELECT c.id,
       c.document, 
       c.firstname,
       SUM(ds.cantidad) AS cantidad
  FROM client AS c
 INNER JOIN (SELECT id_client, 
                    log_planilla, 
                    log_lote, 
                    MAX(id) AS id
               FROM form
              WHERE status = 1
                AND date_created >= '2021-09-01 00:00:00'
              GROUP BY id_client, log_planilla, log_lote) AS f ON(f.id_client = c.id)
 INNER JOIN data AS d ON(d.id_form = f.id)
 INNER JOIN (SELECT data_id, 
                    COUNT('x') AS cantidad
               FROM data_socios
              GROUP BY data_id
       ) AS ds ON(ds.data_id = d.id)
 GROUP BY 1
 ORDER BY 1
 */
?>