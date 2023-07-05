<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'conexion.class.php';
require_once PATH_CCLASS . DS . 'supermercado.class.php';
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['action']))$action = $_POST['action'];

if(isset($_POST['tipe_file']) && $_POST['tipe_file'] == 'subida')$_POST['FILE'] = $_FILES;

call_user_func($action, $_POST);

function carguesegurosSupermercado($request){
	//print_r($request);
	if($request['persontype'] == ''){
		echo "<script>
				parent.alert('Seleccione por favor el tipo de cliente');
			  </script>";
		exit();
	}
	$typefile = $request['FILE']['file_seg_sup']['type'];
	if($typefile != 'application/vnd.ms-excel'){
		echo "<script>
				parent.alert('No es el tipo de archivo necesario');
			  </script>";
		exit();
	}
	$filename = $request['FILE']['file_seg_sup']['tmp_name'];
	$temp = file($filename);
	$n = count($temp);
	$c_ingresado = 0;//Contador de ingresados
	$c_errores = 0;//Contador de errores
	$str_numeroColumnas = '';//String de errores numero de columnas
	$conexion = new Conexion();
	for ($i = 0; $i < $n; $i++) { 
		if (trim($temp[$i]) != '') {
			$datos_leer = explode(';', $temp[$i]);
			//echo count($datos_leer);
			if(count($datos_leer) != 34){				
				if($str_numeroColumnas == '')
					$str_numeroColumnas = $i;
				else
					$str_numeroColumnas = ", ".$i;

				$c_errores++;				
				continue;
			}else{
				if($i > 0){
					$Compania = trim($datos_leer[0]);//A
					$PrimerNombre = trim($datos_leer[1]);//B
					$SegundoNombre = trim($datos_leer[2]);//C
					$PrimerApellido = trim($datos_leer[3]);//D
					$SegundoApellido = trim($datos_leer[4]);//E
					$TipoDocumento = trim($datos_leer[5]);//F
					$NumeroDocumento = trim($datos_leer[6]);//G

					$FechadeCompraP1 = explode(' ', trim($datos_leer[7]));//H
					$FechadeCompra = $FechadeCompraP1[0];

					$FechaEmisionP1 = explode(' ', trim($datos_leer[8]));//I
					$FechaEmision = $FechaEmisionP1[0];

					$NoProducto = trim($datos_leer[9]);//J
					$ProductoComprado = trim($datos_leer[10]);//K
					$DireccionResidencia = trim($datos_leer[11]);//L
					$TelefonoResidencia = trim($datos_leer[12]);//M
					$LugarNacimiento = trim($datos_leer[13]);//N

					$FechaNacimientoP = explode('/', trim($datos_leer[14]));//O
					$FechaNacimiento = $FechaNacimientoP[2]."-".$FechaNacimientoP[1]."-".$FechaNacimientoP[0];

					$Genero = trim($datos_leer[15]);//P
					$EstadoCivil = trim($datos_leer[16]);//Q
					$CiudadResidencia = trim($datos_leer[17]);//R
					$DepartamentoResidencia = trim($datos_leer[18]);//S
					$NivelEstudios = trim($datos_leer[19]);//T
					$Ocupacion = trim($datos_leer[20]);//U
					$ActividadEconomica = trim($datos_leer[21]);//V
					$Profesion = trim($datos_leer[22]);//W
					$NumeroHijos = trim($datos_leer[23]);//X
					$EmpresaTrabajo = trim($datos_leer[24]);//Y
					$DireccionTrabajo = trim($datos_leer[25]);//Z
					$TelefonoTrabajo = trim($datos_leer[26]);//AA

					$IngresosMensuales = trim($datos_leer[27]);//AB
					$EgresosMensuales = trim($datos_leer[28]);//AC

					$OtrosIngresos = trim($datos_leer[29]);//AD
					$TotalActivos = trim($datos_leer[30]);//AE
					$TotalPasivos = trim($datos_leer[31]);//AF
					$TransacMonedaExtran = trim($datos_leer[32]);//AG
					$TipoTransaccion = trim($datos_leer[33]);//AH
					$Sucursal = 'Online Colpatria';
					//$Sucursal = trim($datos_leer[34]);//AI

					$SQL =  "SELECT * FROM sup_client WHERE document = '$NumeroDocumento' AND persontype = '1'";
					$conexion->consultar($SQL);
					if($conexion->getNumeroRegistros() > 0){
						$consulta = $conexion->sacarRegistro();
						$id_cliente = $consulta['id'];
						$conexion2 = new Conexion();
						$SQL2 = "SELECT * FROM sup_data_capi WHERE id_client = $id_cliente";
						//echo $SQL2."<br>";
						$conexion2->consultar($SQL2);
						if($conexion2->getNumeroRegistros() == 0){
							$SQLI = "INSERT INTO sup_data 
								(
									id_client,compania,primernombre,segundonombre,primerapellidos,segundoapellido,
									tipodocumento,documento,fechacompra,fechaemision,numeroproducto,
									productocomprado,direccionresidencia,teltfonoresidencia,lugarnacimiento,
									fechanacimiento,genero,estadocivil,ciudadresidencia,departamentoresidencia,
									nivelestudios,ocupacion,actividadeconomica,profesion,numerohijos,
									empresatrabajo,direcciontrabajo,telefonotrabajo,ingresosmensuales,
									egresosmensuales,otrosingresos,totalactivos,totalpasivos,monedaextranjera,
									tipotransacciones,sucursal,flag
								)
								VALUES
								(
									$id_cliente, '$Compania', '$PrimerNombre', '$SegundoNombre', '$PrimerApellido','$SegundoApellido',
									'$TipoDocumento','$NumeroDocumento','$FechadeCompra','$FechaEmision','$NoProducto',
									'$ProductoComprado','$DireccionResidencia','$TelefonoResidencia','$LugarNacimiento',
									'$FechaNacimiento','$Genero','$EstadoCivil','$CiudadResidencia','$DepartamentoResidencia',
									'$NivelEstudios','$Ocupacion','$ActividadEconomica','$Profesion','$NumeroHijos',
									'$EmpresaTrabajo','$DireccionTrabajo','$TelefonoTrabajo','$IngresosMensuales',
									'$EgresosMensuales','$OtrosIngresos','$TotalActivos','$TotalPasivos','$TransacMonedaExtran',
									'$TipoTransaccion','$Sucursal','CARGUECAPIMERCADOPREDICTIVO_".date('Ymd')."'
								)";
							//echo $SQLI."<br><br>";
							if($conexion2->ejecutar($SQLI)){
								//echo "DATOS INSERTADOS<br>";
								//echo $SQLI."<br><br>";
								//fwrite($fp, "$id_cliente;$documento;$telefonolaboral;INGRESADODATA_CLIENTEINICIAL".PHP_EOL);
							}else{
								//echo $SQLI."<br>";
								//echo "ERROR<br><br>";
								//fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOINGRESADODATA_CLIENTEINICIAL".PHP_EOL);
							}
						}
					}else{
						$SQLC = "INSERT INTO sup_client 
						(
							document, persontype, firstname, type, capi, date_updated, status_migracion, status_form, 
							last_updater, date_updated_document, campania
						)
						VALUES
						(
							'$NumeroDocumento',1,'$PrimerNombre $SegundoNombre $PrimerApellido $SegundoApellido',
							'SGV','No','0000-00-00','Activo','Activo',
							0,'0000-00-00 00:00:00', 2
						)";
						$lastID = 0;
						if($conexion->ejecutar($SQLC)){
							//echo "$SQLC<br>";
							//echo "INSERTADO CLIENTE CON CEDULA $cedula<br>";
							//fwrite($fp, "$lastID;$documento;$telefonolaboral;INSERTADOCLIENTE".PHP_EOL);
							$lastID = $conexion->ultimaId();
							$SQLI = "INSERT INTO sup_data 
								(
									id_client,compania,primernombre,segundonombre,primerapellidos,segundoapellido,
									tipodocumento,documento,fechacompra,fechaemision,numeroproducto,
									productocomprado,direccionresidencia,teltfonoresidencia,lugarnacimiento,
									fechanacimiento,genero,estadocivil,ciudadresidencia,departamentoresidencia,
									nivelestudios,ocupacion,actividadeconomica,profesion,numerohijos,
									empresatrabajo,direcciontrabajo,telefonotrabajo,ingresosmensuales,
									egresosmensuales,otrosingresos,totalactivos,totalpasivos,monedaextranjera,
									tipotransacciones,sucursal,flag
								)
								VALUES
								(
									$lastID, '$Compania', '$PrimerNombre', '$SegundoNombre', '$PrimerApellido','$SegundoApellido',
									'$TipoDocumento','$NumeroDocumento','$FechadeCompra','$FechaEmision','$NoProducto',
									'$ProductoComprado','$DireccionResidencia','$TelefonoResidencia','$LugarNacimiento',
									'$FechaNacimiento','$Genero','$EstadoCivil','$CiudadResidencia','$DepartamentoResidencia',
									'$NivelEstudios','$Ocupacion','$ActividadEconomica','$Profesion','$NumeroHijos',
									'$EmpresaTrabajo','$DireccionTrabajo','$TelefonoTrabajo','$IngresosMensuales',
									'$EgresosMensuales','$OtrosIngresos','$TotalActivos','$TotalPasivos','$TransacMonedaExtran',
									'$TipoTransaccion','$Sucursal','CARGUECAPIMERCADOPREDICTIVO_".date('Ymd')."'
								)";
							echo $SQLI."<br><br>";
							if($conexion->ejecutar($SQLI)){
								//echo "$SQLI<br>";
								//echo "INSERTADoS DATOS DE CLIENTE CON CEDULA $cedula<br>";
								//fwrite($fp, "$lastID;$documento;$telefonolaboral;INGRESADODATA_SINCLIENTEINICIAL".PHP_EOL);
							}else{
								//echo "$SQLI<br>";
								//echo "NOINSERTADoS DATOS DE CLIENTE CON CEDULA $cedula<br>";
								//fwrite($fp, "$lastID;$documento;$telefonolaboral;NOINGRESADODATA_SINCLIENTEINICIAL".PHP_EOL);
							}
						}else{
							echo "aca";
							//echo "$SQLC<br>";
							//echo "NOINSERTADO CLIENTE CON CEDULA $cedula<br>";
							//fwrite($fp, "$lastID;$documento;$telefonolaboral;NOINSERTADOCLIENTE".PHP_EOL);
						}
					}

				}
			}
		}
	}
	echo "<script>
			parent.alert('La base fue cargada satisfactoriamente');
		</script>";
}
function carguecapiSupermercado($request){
	/*$fp = fopen("files/carguecapiSupermercado_salida_".date('Ymd:His').".csv","a");
	fwrite($fp, "ID;DOCUMENTO;TELEFONO;ESTADO".PHP_EOL);*/
	//print_r($request);
	$typefile = $request['FILE']['file_cap_sup']['type'];
	if($typefile != 'application/vnd.ms-excel'){
		echo "<script>
				parent.alert('No es el tipo de archivo necesario');
			  </script>";
		exit();
	}
	$filename = $request['FILE']['file_cap_sup']['tmp_name'];
	$temp = file($filename);
	$n = count($temp);
	$c_ingresado = 0;//Contador de ingresados
	$c_errores = 0;//Contador de errores
	$str_numeroColumnas = '';//String de errores numero de columnas
	$conexion = new Conexion();
	for ($i = 0; $i < $n; $i++) { 
		if (trim($temp[$i]) != '') {
			$datos_leer = explode(';', $temp[$i]);
			if(count($datos_leer) != 56){				
				if($str_numeroColumnas == '')
					$str_numeroColumnas = $i;
				else
					$str_numeroColumnas = ", ".$i;

				$c_errores++;				
				continue;
			}else{
				if($i > 0){
					$fechaexpedicionP = explode('/', trim($datos_leer[0]));//A
					//echo $fechaexpedicionP;
					$fechaexpedicion = $fechaexpedicionP[2]."-".$fechaexpedicionP[1]."-".$fechaexpedicionP[0];
					$titulo = trim($datos_leer[1]);//B
					$digitochequeo = trim($datos_leer[2]);//C
					$consecutivo = trim($datos_leer[3]);//D
					$tipodocumento = getTipoDocumento(trim($datos_leer[4]));//E
					$documento = trim($datos_leer[5]);//F
					$lastname1 = trim($datos_leer[6]);//G
					$lastname2 = trim($datos_leer[7]);//H
					$firstname = trim($datos_leer[8]);//I
					$ingresos = trim($datos_leer[9]);//J
					$egresos = trim($datos_leer[10]);//K
					$activos = trim($datos_leer[11]);//L
					$pasivos = trim($datos_leer[12]);//M
					$profesion = trim($datos_leer[23]);//X
					$estadocivil = getEstadoCivil(trim($datos_leer[26]));//AA
					$numerohijos = trim($datos_leer[30]);//AE
					$direccionlaboral = trim($datos_leer[32]);//AG
					$telefonolaboral = trim($datos_leer[33]);//AH
					$cuidadlaboral = trim($datos_leer[36]);//AK FUNCION DE CIUDADES
					$direccionresidencia = trim($datos_leer[37]);//AL
					$telefonoresidencia1 = trim($datos_leer[38]);//AM
					$telefonoresidencia2 = trim($datos_leer[39]);//AN
					$ciudadresidencia = trim($datos_leer[40]);//AO
					$correoelectronico = trim($datos_leer[41]);//AP
					$sucursal = trim($datos_leer[42]);//AQ
					$fechanacimientoP = explode('/', trim($datos_leer[43]));//AR
					$fechanacimiento = $fechanacimientoP[2]."-".$fechanacimientoP[1]."-".$fechanacimientoP[0];
					$lugarnacimiento = trim($datos_leer[44]);//AS
					$empresa = trim($datos_leer[45]);//AT

					$SQL =  "SELECT * FROM sup_client WHERE document = '$documento' AND persontype = '1'";
					$conexion->consultar($SQL);
					if($conexion->getNumeroRegistros() > 0){
						$consulta = $conexion->sacarRegistro();
						$id_cliente = $consulta['id'];

						$SQLUC = "UPDATE sup_client SET capi = 'Si' WHERE id = $id_cliente";
						$conexionUC = new Conexion();
						$conexionUC->ejecutar($SQLUC);
						$conexion2 = new Conexion();
						$SQL2 = "SELECT * FROM sup_data_capi WHERE id_client = $id_cliente";
						//echo $SQL2."<br>";
						$conexion2->consultar($SQL2);
						if($conexion2->getNumeroRegistros() == 0){
							$SQLI = "INSERT INTO sup_data_capi 
								(
									id_client, sucursal, fechaexpedicion, titulo, digitochequeo, consecutivo, tipodocumento, documento, primerapellido, 
									segundoapellido, nombres, fechanacimiento, lugarnacimiento, numerohijos, estadocivil, ingresos, egresos, activos, pasivos, profesion, empresa, 
									ciudadlaboral, direccionlaboral, telefonolaboral, ciudadresidencia, direccionresidencia, telefonoresidencia1, 
									telefonoresidencia2, correoelectronico, id_user, flag
								)
								VALUES
								(
									$id_cliente, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento', '$lastname1', 
									'$lastname2', '$firstname', '$fechanacimiento', '$lugarnacimiento', '$numerohijos', '$estadocivil', '$ingresos', '$egresos', '$activos', '$pasivos', '$profesion', '$empresa', 
									'$cuidadlaboral', '$direccionlaboral', '$telefonolaboral', '$cuidadlaboral', '$direccionresidencia', '$telefonoresidencia1', 
									'$telefonoresidencia2', '$correoelectronico', 1, 'CARGUECAPIMERCADOPREDICTIVO_".date('Ymd')."'
								)";
							//echo $SQLI."<br><br>";
							if($conexion2->ejecutar($SQLI)){
								//echo "DATOS INSERTADOS<br>";
								//echo $SQLI."<br><br>";
								//fwrite($fp, "$id_cliente;$documento;$telefonolaboral;INGRESADODATA_CLIENTEINICIAL".PHP_EOL);
							}else{
								//echo $SQLI."<br>";
								//echo "ERROR<br><br>";
								//fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOINGRESADODATA_CLIENTEINICIAL".PHP_EOL);
							}
						}else{
							//echo "TIENE DATOS<br><br>";
							//fwrite($fp, "$id_cliente;$documento;$telefonolaboral;TIENEDATOSDATA".PHP_EOL);
						//}

							$SQLU = "UPDATE sup_data_capi
									SET sucursal = '$sucursal', fechaexpedicion = '$fechaexpedicion', titulo = '$titulo', digitochequeo = $digitochequeo, 
										consecutivo = $consecutivo, primerapellido = '$lastname1', segundoapellido = '$lastname2', nombres = '$firstname', 
										fechanacimiento = '$fechanacimiento', lugarnacimiento = '$lugarnacimiento', numerohijos = '$numerohijos', estadocivil= '$estadocivil', ingresos = '$ingresos', egresos = '$egresos', 
										activos = '$activos', pasivos = '$pasivos', profesion = '$profesion', empresa = '$empresa', 
										ciudadlaboral = '$cuidadlaboral', direccionlaboral = '$direccionlaboral', telefonolaboral = '$telefonolaboral', 
										ciudadresidencia = '$cuidadlaboral', direccionresidencia = '$direccionresidencia', telefonoresidencia1 = '$telefonoresidencia1', 
										telefonoresidencia2 = '$telefonoresidencia2', correoelectronico = '$correoelectronico'
									WHERE id_client = $id_cliente";
							//echo "$SQLU<br>";
							if($conexion->ejecutar($SQLU)){
								//echo "_ACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
								//fwrite($fp, "$id_cliente;$documento;$telefonolaboral;ACTUALIZADO".PHP_EOL);
							}else{
								//echo "NOACTUALIZADO CLIENTE CON CEDULA $cedula<br><br>";
								//fwrite($fp, "$id_cliente;$documento;$telefonolaboral;NOACTUALIZADO".PHP_EOL);
							}
						}
					}else{
						$SQLC = "INSERT INTO sup_client 
						(
							document, persontype, firstname, type, capi, date_updated, status_migracion, status_form, 
							last_updater, date_updated_document, campania
						)
						VALUES
						(
							'$documento',1,'$firstname $lastname1 $lastname2','SGV','Si','0000-00-00','Activo','Activo',
							0,'0000-00-00 00:00:00', 1
						)";
						//echo $SQLC."<br>";
						$lastID = 0;
						if($conexion->ejecutar($SQLC)){
							$lastID = $conexion->ultimaId();
							//echo "$SQLC<br>";
							//echo "INSERTADO CLIENTE CON CEDULA $cedula<br>";
							//fwrite($fp, "$lastID;$documento;$telefonolaboral;INSERTADOCLIENTE".PHP_EOL);
							$lastID = $conexion->ultimaId();			
							/*$SQLI = "INSERT INTO data_capi 
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
										'$cuidadlaboral', '$direccionlaboral', '$telefonolaboral', '$cuidadlaboral', '$direccionresidencia', '$telefonoresidencia1', 
										'$telefonoresidencia2', '$correoelectronico', 1, 'CARGUECAPIMERCADOPREDICTIVO_20130605'
									)";*/
							$SQLI = "INSERT INTO sup_data_capi 
								(
									id_client, sucursal, fechaexpedicion, titulo, digitochequeo, consecutivo, tipodocumento, documento, primerapellido, 
									segundoapellido, nombres, fechanacimiento, lugarnacimiento, numerohijos, estadocivil, ingresos, egresos, activos, pasivos, profesion, empresa, 
									ciudadlaboral, direccionlaboral, telefonolaboral, ciudadresidencia, direccionresidencia, telefonoresidencia1, 
									telefonoresidencia2, correoelectronico, id_user, flag
								)
								VALUES
								(
									$lastID, '$sucursal', '$fechaexpedicion', '$titulo', $digitochequeo, $consecutivo, '$tipodocumento', '$documento', '$lastname1', 
									'$lastname2', '$firstname', '$fechanacimiento', '$lugarnacimiento', '$numerohijos', '$estadocivil', '$ingresos', '$egresos', '$activos', '$pasivos', '$profesion', '$empresa', 
									'$cuidadlaboral', '$direccionlaboral', '$telefonolaboral', '$cuidadlaboral', '$direccionresidencia', '$telefonoresidencia1', 
									'$telefonoresidencia2', '$correoelectronico', 1, 'CARGUECAPIMERCADOPREDICTIVO_".date('Ymd')."'
								)";
							//echo $SQLI."<br><br>";
							if($conexion->consultar($SQLI)){
								//echo "$SQLI<br>";
								//echo "INSERTADoS DATOS DE CLIENTE CON CEDULA $cedula<br>";
								//fwrite($fp, "$lastID;$documento;$telefonolaboral;INGRESADODATA_SINCLIENTEINICIAL".PHP_EOL);
							}else{
								//echo "$SQLI<br>";
								//echo "NOINSERTADoS DATOS DE CLIENTE CON CEDULA $cedula<br>";
								//fwrite($fp, "$lastID;$documento;$telefonolaboral;NOINGRESADODATA_SINCLIENTEINICIAL".PHP_EOL);
							}
						}else{
							//echo "$SQLC<br>";
							//echo "NOINSERTADO CLIENTE CON CEDULA $cedula<br>";
							//fwrite($fp, "$lastID;$documento;$telefonolaboral;NOINSERTADOCLIENTE".PHP_EOL);
						}
					}
				}
			}
		}
	}
	echo "<script>
			parent.alert('La base fue cargada satisfactoriamente');
		</script>";
}
function getTipoDocumento($tipoin){
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
		
		default:
			$return = 'Cedula Ciudadania';
			break;
	}
	return $return;
}
function getEstadoCivil($tipoin){
	$return = 7;
	switch ($tipoin) {
		case 'CASADO'://Casado
			$return = 2;
			break;
		case 'DIVORCIADO'://Divorciado
			$return = 6;
			break;
		case 'SEPARADO':
			$return = 3;
			break;
		case 'UNION LIBRE':
			$return = 5;
			break;
		case 'SOLTERO':
			$return = 1;
			break;
		case 'VIUDO':
			$return = 4;
			break;
		
		default:
			$return = 1;
			break;
	}
	return $return;
}
function editardocumento($request){
	if($resp = Supermercado::verificarCliente($request['nuevodocumento'])){
		if(isset($resp['error']))
			echo $resp['error'];
		else{
			if($resp2 = Supermercado::updateClientDocument($request)){
				if(isset($resp2['error']))
					echo $resp2['error'];
				else
					echo "Actualizacion exitosa.";
			}else
				echo "La consulta no se pudo realizar, contacte al administrador...";
		}
	}else
		echo "La consulta no se pudo realizar, contacte al administrador.";
}
?>