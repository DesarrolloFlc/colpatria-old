<?php
date_default_timezone_set('America/Bogota');
require_once PATH_CCLASS.DS.'festivos.class.php';
class Radicados {

	var $id;
	var $tipo;
	var $id_sucursal;
	var $utc;
	var $telefono;
	var $extension;
	var $id_usuarioenvia;
	var $lote;
	var $fecha_recibido;
	var $estado;
	var $id_usuariorecibido;
	var $fecha_envio;
	var $fecha_creacion;
	var $conn;
	var $error = array('codigo'=>'0', 'mensaje'=>'');

	public function __construct(){
		//$conexion = new Conexion();
		$this->conn = new Conexion();
	}
	public function __destruct(){
		$this->conn->desconectar();
	}

	//Analizadoras
	public function getId() {
		return $this->id;
	}

	public function getTipo() {
		return $this->tipo;
	}

	public function getId_sucursal() {
		return $this->id_sucursal;
	}

	public function getUtc() {
		return $this->utc;
	}

	public function getTelefono() {
		return $this->telefono;
	}

	public function getExtension() {
		return $this->extension;
	}

	public function getId_usuarioenvia() {
		return $this->id_usuarioenvia;
	}

	public function getLote() {
		return $this->lote;
	}

	function isBisiesto($anno) {
		return (($anno % 4 == 0) && (($anno % 100 != 0) || ($anno % 400 == 0))) ? true : false;
	}

	public function getFecha_recibido($text = '') {
		if ($text == 'date') {
			$fec = explode("/", $this->fecha_recibido);
			return $fec[2] . "-" . $fec[1] . "-" . $fec[0];
		} else
		if ($text == 'formato') {
			$fec = explode("-", $this->fecha_recibido);
			return $fec[2] . "/" . $fec[1] . "/" . $fec[0];
		} else
			return $this->fecha_recibido;
	}

	public function getEstado() {
		return $this->estado;
	}

	public function getId_usuariorecibido() {
		return $this->id_usuariorecibido;
	}

	public function getFecha_envio($text = '') {
		if ($text == 'date') {
			$fec = explode("/", $this->fecha_envio);
			return $fec[2] . "-" . $fec[1] . "-" . $fec[0];
		} else
		if ($text == 'formato') {
			$fec = explode("-", $this->fecha_envio);
			return $fec[2] . "/" . $fec[1] . "/" . $fec[0];
		} else
			return $this->fecha_envio;
	}

	public function getFecha_creacion($text = '') {
		if ($text == 'date') {
			$fec = explode("/", $this->fecha_creacion);
			return $fec[2] . "-" . $fec[1] . "-" . $fec[0];
		} else
		if ($text == 'formato') {
			$fec = explode("-", $this->fecha_creacion);
			return $fec[2] . "/" . $fec[1] . "/" . $fec[0];
		} else
			return $this->fecha_creacion;
	}
	public function getError(){
		return $this->error;
	}

	//Modificadoras
	public function setId($id) {
		$this->id = trim($id);
	}

	public function setTipo($tipo) {
		$this->tipo = trim($tipo);
	}

	public function setId_sucursal($id_sucursal) {
		$this->id_sucursal = trim($id_sucursal);
	}

	public function setUtc($utc) {
		$this->utc = trim($utc);
	}

	public function setTelefono($telefono) {
		$this->telefono = trim($telefono);
	}

	public function setExtension($extension) {
		$this->extension = trim($extension);
	}

	public function setId_usuarioenvia($id_usuarioenvia) {
		$this->id_usuarioenvia = trim($id_usuarioenvia);
	}

	public function setLote($lote) {
		$this->lote = trim($lote);
	}

	public function setFecha_recibido($fecha_recibido) {
		$this->fecha_recibido = trim($fecha_recibido);
	}

	public function setEstado($estado) {
		$this->estado = trim($estado);
	}

	public function setId_usuariorecibido($id_usuariorecibido) {
		$this->id_usuariorecibido = trim($id_usuariorecibido);
	}

	public function setFecha_envio($fecha_envio) {
		$this->fecha_envio = trim($fecha_envio);
	}

	public function setFecha_creacion($fecha_creacion) {
		$this->fecha_creacion = trim($fecha_creacion);
	}

	public function setAtributos($atributos) {
		if (is_array($atributos)) {
			$this->setId((isset($atributos["id"]) ? $atributos["id"] : "NULL"));
			$this->setTipo((isset($atributos["tipo"]) ? $atributos["tipo"] : "0"));
			$this->setId_sucursal($atributos["id_sucursal"]);
			$this->setUtc((isset($atributos["utc"]) ? $atributos["utc"] : "NULL"));
			$this->setTelefono($atributos["telefono"]);
			$this->setExtension((isset($atributos["extension"]) ? $atributos["extension"] : "NULL"));
			$this->setId_usuarioenvia($atributos["id_usuarioenvia"]);
			$this->setLote((isset($atributos["lote"]) ? $atributos["lote"] : "NULL"));
			$this->setFecha_recibido((isset($atributos["fecha_recibido"]) ? $atributos["fecha_recibido"] : "NULL"));
			$this->setEstado((isset($atributos["estado"]) ? $atributos["estado"] : "NULL"));
			$this->setId_usuariorecibido((isset($atributos["id_usuariorecibido"]) ? $atributos["id_usuariorecibido"] : "NULL"));
			$this->setFecha_envio((isset($atributos["fecha_envio"]) ? $atributos["fecha_envio"] : "0000-00-00"));
			$this->setFecha_creacion((isset($atributos["fecha_creacion"]) ? $atributos["fecha_creacion"] : "NULL"));
		}
	}

	public function commitConn(){
		$this->conn->commitTrans();
		$this->conn->desconectar();
	}

	public function rollbackConn(){
		//$this->conn->rollbackTrans();
		$this->conn->desconectar();
	}

	public function getUltimaId(){
		return $this->conn->ultimaId();
	}

	public function registrar() {
		$SQL = "INSERT INTO radicados 
				(
					tipo, id_sucursal, utc, telefono, extension, id_usuarioenvia, lote, 
					fecha_recibido, id_usuariorecibido, estado, fecha_envio
				)
				VALUES
				(
					:tipo, :id_sucursal, :utc, :telefono, :extension, :id_usuarioenvia, :lote, 
					:fecha_recibido, :id_usuariorecibido, :estado, :fecha_envio
				)";
		$datos = array(':tipo' => $this->getTipo(), ':id_sucursal' => $this->getId_sucursal(), 
					':utc' => $this->getUtc(), ':telefono' => $this->getTelefono(), 
					':extension' => $this->getExtension(), ':id_usuarioenvia' => $this->getId_usuarioenvia(), 
					':lote' => $this->getLote(), ':fecha_recibido' => $this->getFecha_recibido(), 
					':id_usuariorecibido' => $this->getId_usuariorecibido(), ':estado' => $this->getEstado(), 
					':fecha_envio' => $this->getFecha_envio());
		if ($this->conn->ejecutar($SQL, $datos)) {
			$this->setId($this->conn->ultimaId());
			$this->getRadicado();
			//$this->conn->desconectar();
			return true;
		} else {
			$this->error['mensaje'] = $this->conn->error['errorMesage'];
			$this->error['codigo'] = $this->conn->error['errorCode'];
			//$this->conn->rollbackTrans();
			$this->conn->desconectar();
			return false;
		}
	}

	public function agregarItems($item_datos) {
		$SQL = "INSERT INTO radicados_items
				(
					documento, descripcion, id_radicados, estado
				)
				VALUES
				(
					:documento, :descripcion, :id_radicados, :estado
				)";
		//error_log(json_encode($item_datos), 0);
		if ($this->conn->ejecutar($SQL, $item_datos)) {
			//$this->conn->desconectar();
			return true;
		} else {
			error_log($this->conn->error['errorMesage'], 0);
			$this->error['mensaje'] = $this->conn->error['errorMesage'];
			$this->error['codigo'] = $this->conn->error['errorCode'];
			//$this->conn->rollbackTrans();
			$this->conn->desconectar();
			return false;
		}
	}

	public function insertarImagen($img_datos){
		$SQL = "INSERT INTO image
				(
					id_forma, id_imagetype, directory, filename, original_file
				)
				VALUES
				(
					:id_forma, :id_imagetype, :directory, :filename, :original_file
				)";
		if ($this->conn->ejecutar($SQL, $img_datos)) {
			//$this->conn->desconectar();
			return true;
		} else {
			$this->error['mensaje'] = $this->conn->error['errorMesage'];
			$this->error['codigo'] = $this->conn->error['errorCode'];
			//$this->conn->rollbackTrans();
			$this->conn->desconectar();
			return false;
		}
	}

	public function inserFileRadicado($file_datos) {
		$SQL = "INSERT INTO radicados_files
				(
					id_radicado, nombre, documento
				)
				VALUES
				(
					:id_radicado, :nombre, :documento
				)";
		if ($this->conn->ejecutar($SQL, $file_datos)) {
			//$this->conn->desconectar();
			return true;
		} else {
			$this->error['mensaje'] = $this->conn->error['errorMesage'];
			$this->error['codigo'] = $this->conn->error['errorCode'];
			//$this->conn->rollbackTrans();
			$this->conn->desconectar();
			return false;
		}
	}

	public function agregarCliente($cliente_datos){
		if($id_client = $this->velidarCliente($cliente_datos[':document'])){
			return $id_client['id'];
		}else{
			$SQL = "INSERT INTO client
					(
						document, persontype, firstname, lastname
					)
					VALUES
					(
						:document, :persontype, :firstname, :lastname
					)";
			if ($this->conn->ejecutar($SQL, $cliente_datos)) {
				//$this->conn->desconectar();
				return $this->getUltimaId();
			}else{
				$this->error['mensaje'] = $this->conn->error['errorMesage'];
				$this->error['codigo'] = $this->conn->error['errorCode'];
				//$this->conn->rollbackTrans();
				$this->conn->desconectar();
				return false;
			}
		}
	}
	public function velidarCliente($cedula){
		$SQL = "SELECT * 
				  FROM client 
				 WHERE document = :document
				 ORDER BY date_created DESC
				 LIMIT 1";
		if($this->conn->consultar($SQL, array(':document'=> $cedula))){
			if($this->conn->getNumeroRegistros() > 0){
				return $this->conn->sacarRegistro('str');
			}else
				return false;
		}else
			return false;
	}

	public function agregarForm($form_datos){
		$SQL = "INSERT INTO form
				(
					id_client, type, lote,planilla, id_user, log_planilla, log_lote, num_images, marca
				)
				VALUES
				(
					:id_client, :type, :lote, :planilla, :id_user, :log_planilla, :log_lote, :num_images, :marca
				)";
		//error_log(json_encode($form_datos), 0);
		if ($this->conn->ejecutar($SQL, $form_datos)) {
			//$this->conn->desconectar();
			return true;
		}else{
			error_log($this->conn->error['errorMesage'], 0);
			$this->error['mensaje'] = $this->conn->error['errorMesage'];
			$this->error['codigo'] = $this->conn->error['errorCode'];
			//$this->conn->rollbackTrans();
			$this->conn->desconectar();
			return false;
		}
	}

	public function agregarData($data_datos){
		$SQL = "INSERT INTO data
				(
					id_form, fecharadicado, fechasolicitud, sucursal, area, lote, formulario, id_official, clasecliente, 
					primerapellido, segundoapellido, nombres, tipodocumento, documento, fechaexpedicion, fechanacimiento, 
					lugarnacimiento, nacionalidad_otra, nacionalidad, direccionresidencia, ciudadresidencia, 
					telefonoresidencia, nombreempresa, celular, correoelectronico, actividadeconomicappal, profesion, 
					ocupacion, ciiu, ingresosmensuales, egresosmensuales, totalactivos, totalpasivos, razonsocial, nit, digitochequeo/*,
					consecutivo, cuotaspagas, cuotasvencidas, descripcionplan, enviocorrespondencia, debitoautomatico, 
					estadotitulo, fechavencimientocontraactual, fechavencimientocomercial, nombreciudadcomercial, 
					nombreciudadresidencia, plan, titulo, totalegresos, totalingresos*/
				)
				VALUES
				(
					:id_form, :fecharadicado, :fechasolicitud, :sucursal, :area, :lote, :formulario, :id_official, :clasecliente, 
					:primerapellido, :segundoapellido, :nombres, :tipodocumento, :documento, :fechaexpedicion, :fechanacimiento, 
					:lugarnacimiento, :nacionalidad_otra, :nacionalidad, :direccionresidencia, :ciudadresidencia, 
					:telefonoresidencia, :nombreempresa, :celular, :correoelectronico, :actividadeconomicappal, :profesion, 
					:ocupacion, :ciiu, :ingresosmensuales, :egresosmensuales, :totalactivos, :totalpasivos, :razonsocial, :nit, :digitochequeo/*,
					:consecutivo, :cuotaspagas, :cuotasvencidas, :descripcionplan, :enviocorrespondencia, :debitoautomatico, 
					:estadotitulo, :fechavencimientocontraactual, :fechavencimientocomercial, :nombreciudadcomercial, 
					:nombreciudadresidencia, :plan, :titulo, :totalegresos, :totalingresos*/
				)";
		if ($this->conn->ejecutar($SQL, $data_datos)) {
			//$this->conn->desconectar();
			return true;
		}else{
			$this->error['mensaje'] = $this->conn->error['errorMesage'];
			$this->error['codigo'] = $this->conn->error['errorCode'];
			//$this->conn->rollbackTrans();
			$this->conn->desconectar();
			return false;
		}
	}

	public function agregarData2($data_datos){
		$SQL = "INSERT INTO data
				(
					id_form, fecharadicado, fechasolicitud, sucursal, area, lote, formulario, id_official, clasecliente, 
					primerapellido, segundoapellido, nombres, documento, tipodocumento, fechanacimiento, lugarnacimiento, 
					fechaexpedicion, nacionalidad_otra, nacionalidad, direccionresidencia, ciudadresidencia, telefonoresidencia, 
					telefonolaboral, nombreempresa, celular, correoelectronico, actividadeconomicappal, 
					detalleactividadeconomicappal, profesion, ocupacion, ciiu, ingresosmensuales, egresosmensuales, 
					totalactivos, totalpasivos, razonsocial, nit, digitochequeo, celularoficina,
					lugarexpedicion, paisnacimiento, nacionalidad_cual, sexo, numerohijos, estadocivil, ciudadempresa, 
					direccionempresa, nomenclatura, cargo, actividadeconomicaempresa, detalleocupacion, otrosingresos, 
					conceptosotrosingresos, tipoactividad, detalletipoactividad, nivelestudios, tipovivienda, estrato, 
					ciudadoficina, direccionoficinappal, nomenclatura_emp, telefonoficina, faxoficina, ciudadsucursal, 
					direccionsucursal, nomenclatura_emp2, telefonosucursal, faxsucursal, tipoempresaemp, activosemp, pasivosemp, 
					ingresosmensualesemp, egresosmensualesemp, otrosingresosemp, concepto_otrosingresosemp, obligaciones_otropais, 
					obligaciones_pais, monedaextranjera, tipotransacciones, productos_exterior, cuentas_monedaextranjera, firma, 
					huella, lugarentrevista, fechaentrevista, horaentrevista, tipohoraentrevista, resultadoentrevista, 
					observacionesentrevista, nombreintermediario,
					ciudad, tipo_solicitud, cual_clasecliente, celularoficinappal,tipoempresaemp_cual, recursos_publicos, 
					poder_publico, reconocimiento_publico, reconocimiento_cual, servidor_publico, expuesta_politica, 
					cargo_politica, cargo_politica_ini, cargo_politica_fin, expuesta_publica, publica_nombre, 
					publica_cargo, repre_internacional, internacional_indique, tributarias_otro_pais, 
					tributarias_paises, ciiu_otro, telefonoficinappal, patrimonio, tipoempresajur, tipoempresajur_otra, 
					correoelectronico_otro, origen_fondos, procedencia_fondos, tipotransacciones_cual, 
					otras_operaciones, reclamaciones, clave_inter, firma_entrevista, verificacion_ciudad, 
					verificacion_fecha, verificacion_hora, verificacion_nombre, verificacion_observacion, 
					verificacion_firma, auto_correo, auto_sms
				)
				VALUES
				(
					:id_form, :fecharadicado, :fechasolicitud, :sucursal, :area, :lote, :formulario, :id_official, :clasecliente, 
					:primerapellido, :segundoapellido, :nombres, :documento, :tipodocumento, :fechanacimiento, :lugarnacimiento, 
					:fechaexpedicion, :nacionalidad_otra, :nacionalidad, :direccionresidencia, :ciudadresidencia, :telefonoresidencia, 
					:telefonolaboral, :nombreempresa, :celular, :correoelectronico, :actividadeconomicappal, 
					:detalleactividadeconomicappal, :profesion, :ocupacion, :ciiu, :ingresosmensuales, :egresosmensuales, 
					:totalactivos, :totalpasivos, :razonsocial, :nit, :digitochequeo, :celularoficina,
					:lugarexpedicion, :paisnacimiento, :nacionalidad_cual, :sexo, :numerohijos, :estadocivil, :ciudadempresa, 
					:direccionempresa, :nomenclatura, :cargo, :actividadeconomicaempresa, :detalleocupacion, :otrosingresos, 
					:conceptosotrosingresos, :tipoactividad, :detalletipoactividad, :nivelestudios, :tipovivienda, :estrato, 
					:ciudadoficina, :direccionoficinappal, :nomenclatura_emp, :telefonoficina, :faxoficina, :ciudadsucursal, 
					:direccionsucursal, :nomenclatura_emp2, :telefonosucursal, :faxsucursal, :tipoempresaemp, :activosemp, :pasivosemp, 
					:ingresosmensualesemp, :egresosmensualesemp, :otrosingresosemp, :concepto_otrosingresosemp, :obligaciones_otropais, 
					:obligaciones_pais, :monedaextranjera, :tipotransacciones, :productos_exterior, :cuentas_monedaextranjera, :firma, 
					:huella, :lugarentrevista, :fechaentrevista, :horaentrevista, :tipohoraentrevista, :resultadoentrevista, 
					:observacionesentrevista, :nombreintermediario,
					:ciudad, :tipo_solicitud, :cual_clasecliente, :celularoficinappal,:tipoempresaemp_cual, :recursos_publicos, 
					:poder_publico, :reconocimiento_publico, :reconocimiento_cual, :servidor_publico, :expuesta_politica, 
					:cargo_politica, :cargo_politica_ini, :cargo_politica_fin, :expuesta_publica, :publica_nombre, 
					:publica_cargo, :repre_internacional, :internacional_indique, :tributarias_otro_pais, 
					:tributarias_paises, :ciiu_otro, :telefonoficinappal, :patrimonio, :tipoempresajur, :tipoempresajur_otra, 
					:correoelectronico_otro, :origen_fondos, :procedencia_fondos, :tipotransacciones_cual, 
					:otras_operaciones, :reclamaciones, :clave_inter, :firma_entrevista, :verificacion_ciudad, 
					:verificacion_fecha, :verificacion_hora, :verificacion_nombre, :verificacion_observacion, 
					:verificacion_firma, :auto_correo, :auto_sms
				)";
		if ($this->conn->ejecutar($SQL, $data_datos)) {
			//$this->conn->desconectar();
			return true;
		}else{
			//echo $this->conn->error['errorMesage']."<br>".$data_datos[':documento'];
			error_log($this->conn->error['errorMesage'], 0);
			$this->error['mensaje'] = $this->conn->error['errorMesage'];
			$this->error['codigo'] = $this->conn->error['errorCode'];
			//$this->conn->rollbackTrans();
			$this->conn->desconectar();
			return false;
		}
	}

	public function agregarFinancialData($data){
		$SQL = "INSERT INTO financialData
				(
					id_radicado, actividadeconomicaempresa, celular, ciudadComercial, ciudadResidencia, 
					codigoCIIUActividadEconomica, consecutivo, cuotasPagas, cuotasVencidas, 
					descripcionPlan, digitoChequeo, direccionResidencia, egresosMensualesPersonaNatural, 
					email, empresaTrabajoPersonaNatural, envioCorrespondencia, esDebitoAutomatico, 
					estadoTitulo, fechaExpedicionOriginal, fechaNacimiento, fechaVencimientoContractual, 
					fechaVenciminetoComercial, identificacion, ingresoMensualPersonaNatural, 
					lugarNacimiento, nacionalidad, nombre, nombreCiudadComercial, nombreCiudadResidencia, 
					nombrePaisNacionalidad, nombrePaisOtraNacionalidad, ocupacion, otraNacionaliadad, 
					paisOtraNacionalidad, plan, primerApellido, profesion, segundoApellido, 
					telefonoComercial1, telefonoComercial2, tipoIdentificacion, titulo, 
					totalActivosPersonaJuridica, totalEgresosPersonaJuridica, totalIngresosPersonaJuridica, 
					totalPasivosPersonaJuridica, valorUltimaCuota, tipoCliente, tipoFormulario, sucursal, area
				)
				VALUES
				(
					:id_radicado, :actividadeconomicaempresa, :celular, :ciudadComercial, :ciudadResidencia, 
					:codigoCIIUActividadEconomica, :consecutivo, :cuotasPagas, :cuotasVencidas, 
					:descripcionPlan, :digitoChequeo, :direccionResidencia, :egresosMensualesPersonaNatural, 
					:email, :empresaTrabajoPersonaNatural, :envioCorrespondencia, :esDebitoAutomatico, 
					:estadoTitulo, :fechaExpedicionOriginal, :fechaNacimiento, :fechaVencimientoContractual, 
					:fechaVenciminetoComercial, :identificacion, :ingresoMensualPersonaNatural, 
					:lugarNacimiento, :nacionalidad, :nombre, :nombreCiudadComercial, :nombreCiudadResidencia, 
					:nombrePaisNacionalidad, :nombrePaisOtraNacionalidad, :ocupacion, :otraNacionaliadad, 
					:paisOtraNacionalidad, :plan, :primerApellido, :profesion, :segundoApellido, 
					:telefonoComercial1, :telefonoComercial2, :tipoIdentificacion, :titulo, 
					:totalActivosPersonaJuridica, :totalEgresosPersonaJuridica, :totalIngresosPersonaJuridica, 
					:totalPasivosPersonaJuridica, :valorUltimaCuota, :tipoCliente, :tipoFormulario, :sucursal, :area
				)";
		if($this->conn->ejecutar($SQL, $data)){
			return true;
		}else{
			$this->error['mensaje'] = $this->conn->error['errorMesage'];
			$this->error['codigo'] = $this->conn->error['errorCode'];
			//$this->conn->rollbackTrans();
			$this->conn->desconectar();
			return false;
		}
	}

	public function getRadicado() {
		$conexion = new Conexion();
		$SQL = "SELECT * 
				  FROM radicados 
				 WHERE id = " . $this->getId();
		//echo $SQL;exit();
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$consulta = $conexion->sacarRegistro();
			//echo json_encode($consulta);
			$this->setAtributos($consulta);
			$conexion->desconectar();
			return true;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function getItemsDeRadicado() {
		$conexion = new Conexion();
		$SQL = "SELECT @rownum:=@rownum+1 AS rownum, 
					   id, 
					   descripcion, 
					   documento, 
					   estado, 
					   fecha_creacion, 
					   documento_especial
				  FROM (SELECT @rownum:=0) r, radicados_items 
				 WHERE id_radicados = " . $this->getId() . "
				 ORDER BY estado ASC";
		//echo $SQL;exit();
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$array = array();
			while (($consulta = $conexion->sacarRegistro())) {
				$array[] = $consulta;
			}
			$conexion->desconectar();
			return $array;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function getSucursal() {
		$conexion = new Conexion();
		$SQL = "SELECT t2.sucursal 
				  FROM radicados AS t1
				 INNER JOIN param_sucursales AS t2 ON(t1.id_sucursal = t2.id)
				 WHERE t1.id = " . $this->getId();
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$consulta = $conexion->sacarRegistro();
			$conexion->desconectar();
			return $consulta[0];
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function aprobarOrden() {
		$conexion = new Conexion();
		$SQL = "UPDATE radicados
				   SET lote = " . $this->getId() . ", 
					   fecha_recibido = '" . date('Y-m-d') . "', 
					   id_usuariorecibido = " . $this->getId_usuariorecibido() . ", 
					   estado = 2, 
					   fecha_envio = '" . $this->getFecha_envio() . "'
				 WHERE id = " . $this->getId();
		//echo $SQL;exit();
		if ($conexion->ejecutar($SQL)) {
			$this->getRadicado();
			$conexion->desconectar();
			return true;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function aprobarCliente($id_cliente, $estado) {
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_items
				   SET estado = '$estado'
				 WHERE id = $id_cliente
				   AND id_radicados = ".$this->getId();
		//echo $SQL;exit();
		if($conexion->ejecutar($SQL)){
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}

	public function getFuncionario() {
		$conexion = new Conexion();
		$SQL = "SELECT t2.name
				  FROM radicados AS t1 
				 INNER JOIN user AS t2 ON(t1.id_usuarioenvia = t2.id)
				 WHERE t1.id = " . $this->getId();
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() == 1) {
			$consulta = $conexion->sacarRegistro();
			$conexion->desconectar();
			return $consulta[0];
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function getJustFuncionario() {
		$conexion = new Conexion();
		$SQL = "SELECT name
				  FROM user
				 WHERE id = " . $_SESSION['id'];
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() == 1) {
			$consulta = $conexion->sacarRegistro();
			$conexion->desconectar();
			return $consulta[0];
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function getOficial() {
		$conexion = new Conexion();
		$SQL = "SELECT t2.* 
				  FROM radicados AS t1 
				 INNER JOIN official AS t2 ON(t1.id_usuarioenvia = t2.id)
				 WHERE t1.id = " . $this->getId() . "
				   AND t1.id_usuarioenvia = " . $this->getId_usuarioenvia();
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() == 1) {
			$consulta = $conexion->sacarRegistro();
			$conexion->desconectar();
			return $consulta;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function validaFestivos($id) {
		$sql = "SELECT fecha_creacion 
				  FROM radicados 
				 WHERE tipo = '0' 
				   AND estado = '0' 
				   AND id = " . $id;
		$conexion = new Conexion();
		$conexion->consultar($sql);
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

		if ($conexion->getNumeroRegistros() > 0) {
			while (($consulta = $conexion->sacarRegistro())) {
//				echo "<br>" . $consulta["fecha_creacion"];
				$dcreacion = array(
					"dia" => date('d', strtotime($consulta["fecha_creacion"])),
					"mes" => date('m', strtotime($consulta["fecha_creacion"])),
					"anio" => date('Y', strtotime($consulta["fecha_creacion"])),
					"stdia" => date("N", strtotime($consulta["fecha_creacion"]))
				);
				if ($dactual["anio"] == $dcreacion["anio"]) {
					
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
			$conexion->desconectar();
		} else {
			$conexion->desconectar();
		}

		return $count;
	}

	public static function radicadosNoAprobados() {
		$conexion = new Conexion();
		$fecha = date('Y-m-d');
		$SQL = "SELECT id, 
					   id_usuarioenvia, 
					   DATEDIFF('$fecha', fecha_creacion) AS diferencia
				  FROM radicados
				 WHERE tipo = '0' 
				   AND estado = '0'";
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$array = array();
			while (($consulta = $conexion->sacarRegistro())) {
				$diferencia = $consulta['diferencia'] - self::validaFestivos($consulta['id']);
				if ($consulta['diferencia'] > 3) {
//				if ($diferencia > 3) {
					$objeto = new Radicados();
					$objeto->setId($consulta['id']);
					$objeto->setId_usuarioenvia($consulta['id_usuarioenvia']);
					$oficial = $objeto->getOficial();
//					$oficial['dias_atrazo'] = $consulta['diferencia'];
					$oficial['dias_atrazo'] = $diferencia;
					$oficial['id_radicado'] = $consulta['id'];
					$array[] = $oficial;
				}
			}
			$conexion->desconectar();
			return $array;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function verificarNotificacionDia() {
		$conexion = new Conexion();
		$fecha = date('Y-m-d');
		$SQL = "SELECT * 
				  FROM radicados_recordatorio 
				 WHERE fecha = '$fecha'";
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$conexion->desconectar();
			return true;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function insertarNotificacionDia() {
		$conexion = new Conexion();
		$fecha = date('Y-m-d');
		$SQL = "INSERT INTO radicados_recordatorio (fecha) VALUES ('$fecha')";
		if ($conexion->ejecutar($SQL)) {
			$conexion->desconectar();
			return true;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function insertarDevolucion($cliente, $causal, $observation, $persontype) {
		$conexion = new Conexion();
		$id_user = $_SESSION['id'];
		$SQL = "INSERT INTO workflow
				(
					id_user, causal, id_official, observation, status, persontype, documento, nombre, id_radicado, id_sucursal, id_area, lote
				)
				VALUES
				(
					$id_user, '$causal', " . $this->getId_usuarioenvia() . ", '$observation', 1, $persontype, '" . $cliente['documento'] . "', 
					'".str_replace("'", "´", $cliente['descripcion']). "', " . $this->getId() . ", " . $this->getId_sucursal() . ", " . $this->getId_sucursal() . ", " . $this->getId() . "
				)";
		if ($conexion->ejecutar($SQL)) {
			$conexion->desconectar();
			return true;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function getDevolucion($documento) {
		$conexion = new Conexion();
		$SQL = "SELECT * 
				  FROM workflow
				 WHERE documento = '$documento'
				   AND id_radicado = " . $this->getId() . "
				 ORDER BY date_created DESC
				 LIMIT 1";
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() == 1) {
			$consulta = $conexion->sacarRegistro();
			$conexion->desconectar();
			return $consulta;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function getClienteItem($id_cliente) {
		$conexion = new Conexion();
		$SQL = "SELECT * 
				  FROM radicados_items 
				 WHERE id = " . $id_cliente;
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() == 1) {
			$consulta = $conexion->sacarRegistro();
			$conexion->desconectar();
			return $consulta;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function updateFilesRadicado($documento) {
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_files 
				   SET estado = '1', 
					   id_radicado = " . $this->getId() . "
				 WHERE documento = '$documento'";
		//echo "$SQL";
		if ($conexion->ejecutar($SQL)) {
			$conexion->desconectar();
			return true;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function updateFilesRadicadoNombre($documento, $pos_cli) {
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_files 
				   SET nombre = 'LOTE_" . $this->getId() . "_" . $pos_cli . ".tiff'
				 WHERE documento = '$documento'";
		//echo "$SQL";
		if ($conexion->ejecutar($SQL)) {
			$conexion->desconectar();
			return true;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function clientesDelOficial($fec_ini, $fec_fin) {
		$id_usuarioenvia = $_SESSION['id'];
		$conexion = new Conexion();
		$SQL = "SELECT t1.*, 
					   t3.name 
				  FROM radicados_items AS t1
				 INNER JOIN radicados AS t2 ON(t1.id_radicados = t2.id) 
				  LEFT JOIN official AS t3 ON(t2.id_usuarioenvia = t3.id)
				 WHERE (t2.fecha_creacion BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59')
				   AND t2.id_usuarioenvia = $id_usuarioenvia
				ORDER BY t2.id";
		//echo $SQL;
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$array = array();
			while (($consulta = $conexion->sacarRegistro())) {
				$array[] = $consulta;
			}
			$conexion->desconectar();
			return $array;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function clientesDelOficialSucursal($fec_ini, $fec_fin, $sucursal) {
		$comp = ' AND t2.id_sucursal = ' . $sucursal;
		if ($sucursal == 'T')
			$comp = '';
		$conexion = new Conexion();
		$SQL = "SELECT t1.id_radicados, 
					   t2.tipo, 
					   t4.sucursal, 
					   t3.name AS oficial, 
					   t1.documento, 
					   t1.descripcion,
					   t1.fecha_creacion, 
					   t2.fecha_envio, 
					   t2.fecha_recibido, 
					   t1.estado 
				  FROM radicados_items AS t1
				 INNER JOIN radicados AS t2 ON(t1.id_radicados = t2.id) 
				 INNER JOIN official AS t3 ON(t2.id_usuarioenvia = t3.id)
				 INNER JOIN param_sucursales AS t4 ON(t2.id_sucursal = t4.id)
				 WHERE (t2.fecha_creacion BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59')$comp				
				 ORDER BY t2.id";
		//echo $SQL;exit();
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$array = array();
			while (($consulta = $conexion->sacarRegistro('str'))) {
				$array[] = $consulta;
			}
			$conexion->desconectar();
			return $array;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function clientesDelOficialOficial($fec_ini, $fec_fin, $oficial) {
		$comp = ' AND t2.id_usuarioenvia = ' . $oficial;
		if ($oficial == 'T')
			$comp = '';
		$conexion = new Conexion();
		$SQL = "SELECT t1.id_radicados, 
					   t2.tipo, 
					   t4.sucursal, 
					   t3.name AS oficial, 
					   t1.documento, 
					   t1.descripcion,
					   t1.fecha_creacion, 
					   t2.fecha_envio, 
					   t2.fecha_recibido, 
					   t1.estado 
				  FROM radicados_items AS t1
				 INNER JOIN radicados AS t2 ON(t1.id_radicados = t2.id) 
				 INNER JOIN official AS t3 ON(t2.id_usuarioenvia = t3.id)
				 INNER JOIN param_sucursales AS t4 ON(t2.id_sucursal = t4.id)
				 WHERE (t2.fecha_creacion BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59')$comp				
				 ORDER BY t2.id";
		//echo $SQL;exit();
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$array = array();
			while (($consulta = $conexion->sacarRegistro())) {
				$array[] = $consulta;
			}
			$conexion->desconectar();
			return $array;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function getRadicadosDia($fecha) {
		$conexion = new Conexion();
		/* $SQL = "SELECT t1.id, t1.fecha_recibido, t2.sucursal, t2.sucursal, t1.utc, t3.name, t3.name, 
		  COUNT(t4.id), IF(t1.tipo = 0, 'Fisico', 'Virtual'), t1.fecha_creacion
		  FROM radicados AS t1
		  INNER JOIN param_sucursales AS t2 ON(t1.id_sucursal = t2.id)
		  INNER JOIN official AS t3 ON(t1.id_usuarioenvia = t3.id)
		  INNER JOIN radicados_items AS t4 ON(t1.id = t4.id_radicados)
		  WHERE t1.estado = 2
		  AND t1.fecha_recibido = '$fecha'"; */
		$SQL = "SELECT t1.id, 
					   t1.fecha_recibido, 
					   t2.sucursal, 
					   t2.sucursal, 
					   t1.utc, 
					   t3.name, 
					   t3.name, 
					   COUNT(t4.id), 
					   IF(t1.tipo = 0, 'Fisico', 'Virtual'), 
					   t1.fecha_creacion
				  FROM radicados AS t1
				 INNER JOIN param_sucursales AS t2 ON(t1.id_sucursal = t2.id)
				 INNER JOIN official AS t3 ON(t1.id_usuarioenvia = t3.id)
				 INNER JOIN radicados_items AS t4 ON(t1.id = t4.id_radicados AND t4.estado = 2)
				 WHERE t1.estado = 2
				   AND t1.fecha_recibido = '$fecha'
				 GROUP BY t1.id";
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$array = array();
			while (($consulta = $conexion->sacarRegistro())) {
				$array[] = $consulta;
			}
			$conexion->desconectar();
			return $array;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function cancelRadicado($id_radicado) {
		$conexion = new Conexion();
		$hoy = date('Y-m-d');
		$SQL = "UPDATE radicados 
				   SET estado = '4', 
					   fecha_recibido = '$hoy'
				 WHERE id = $id_radicado
				   AND estado = '0'";
		if ($conexion->ejecutar($SQL)) {
			if (Radicados::cancelItemsRadicado($id_radicado)) {
				$conexion->desconectar();
				return true;
			} else {
				$conexion->desconectar();
				return false;
			}
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public static function cancelItemsRadicado($id_radicado) {
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_items 
				   SET estado = '4'
				 WHERE id_radicados = $id_radicado";
		if ($conexion->ejecutar($SQL))
			return true;
		else
			return false;
	}

	public static function getValidaCliente($cliente) {
		//creado por sinthia rodriguez
		$conexion = new Conexion();
		$SQL = "SELECT form.id as cformularios 
				  FROM colpatria_sgd.form 
				 INNER JOIN colpatria_sgd.`client` ON(form.id_client = `client`.id) 
				 WHERE `client`.document = " . $cliente;
		$conexion->consultar($SQL);
		if ($conexion->getNumeroRegistros() > 0) {
			$conexion->desconectar();
			return true;
		} else {
			$conexion->desconectar();
			return false;
		}
	}

	public function updateRadicadoNombCliente($Ndocumento, $estado, $id_radicado, $item) {
		//creado por sinthia rodriguez
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_items 
				   SET documento = '" . $Ndocumento . "'
				 WHERE radicados_items.estado =" . $estado . " 
				   AND radicados_items.id_radicados =" . $id_radicado . " 
				   AND radicados_items.id =" . $item;
		if ($conexion->ejecutar($SQL)) {
			$conexion->desconectar();
			return true;
		} else {
			$conexion->desconectar();
			return false;
		}
	}
	public static function verificarCambioEstadoRadicado($documento, $id_radicado){
		$conexion = new Conexion();
		$SQL = "SELECT r.tipo, 
					   r.id_sucursal, 
					   r.utc, 
					   r.telefono, 
					   r.extension, 
					   r.id_usuarioenvia,
					   ri.id AS radicado_item_id, 
					   ri.documento, 
					   ri.descripcion, 
					   ri.id_radicados, 
					   ri.documento_especial, 
					   ri.estado
				  FROM radicados_items ri
				 INNER JOIN radicados r ON(r.id = ri.id_radicados)
				 WHERE ri.documento = $documento
				   AND ri.id_radicados = $id_radicado
				   AND r.estado = '2'
				   AND ri.estado IN ('0', '1', '2', '3')";
		if($conexion->consultar($SQL)){
			if($conexion->getNumeroRegistros() > 0){
				$consulta = $conexion->sacarRegistro();
				$conexion->desconectar();
				return $consulta;
			}else{
				$conexion->desconectar();
				return "No se encontraron resultados con los datos suministrados, por favor verifique.";
			}
		}else{
			$conexion->desconectar();
			return false;
		}
	}

	public static function cambiarEstadoItemRadicado($id, $estado) {
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_items 
				   SET estado = '$estado'
				 WHERE id = $id";
		if ($conexion->ejecutar($SQL))
			return true;
		else
			return false;
	}
	public function obtenerPais($texto){
		$SQL = "SELECT id 
				  FROM param_paises 
				 WHERE description = :description
				   AND estado = :estado
				 ORDER BY fecha_creacion DESC";
		if($this->conn->consultar($SQL, array(':description'=> $texto, ':estado'=> $texto))){
			if($this->conn->getNumeroRegistros() > 0){
				$dat = $this->conn->sacarRegistro('str');
				return $dat['id'];
			}else
				return '249';
		}else
			return '249';
	}
}