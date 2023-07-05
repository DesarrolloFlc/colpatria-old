<?php
require_once PATH_CLASS.DS.'conexion.php';

class Radicados {
	var $id;
	var $tipo;
	var $id_sucursal;
	/*var $fecha_envio;
	var $funcionario;*/
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
	//Analizadoras
	public function getId(){
		return $this->id;
	}
	public function getTipo(){
		return $this->tipo;
	}
	public function getId_sucursal(){
		return $this->id_sucursal;
	}
	/*public function getFecha_envio($text = ''){
		if($text == 'date'){
			$fec = explode("/",$this->fecha_envio);
			return $fec[2]."-".$fec[1]."-".$fec[0];
		}else
			if($text == 'formato'){
				$fec = explode("-",$this->fecha_envio);
				return $fec[2]."/".$fec[1]."/".$fec[0];
			}else
				return $this->fecha_envio;
	}*/
	public function getUtc(){
		return $this->utc;
	}
	public function getTelefono(){
		return $this->telefono;
	}
	public function getExtension(){
		return $this->extension;
	}
	public function getId_usuarioenvia(){
		return $this->id_usuarioenvia;
	}
	public function getLote(){
		return $this->lote;
	}
	public function getFecha_recibido($text = ''){
		if($text == 'date'){
			$fec = explode("/",$this->fecha_recibido);
			return $fec[2]."-".$fec[1]."-".$fec[0];
		}else
			if($text == 'formato'){
				$fec = explode("-",$this->fecha_recibido);
				return $fec[2]."/".$fec[1]."/".$fec[0];
			}else
				return $this->fecha_recibido;
	}
	public function getEstado(){
		return $this->estado;
	}
	public function getId_usuariorecibido(){
		return $this->id_usuariorecibido;
	}
	public function getFecha_envio($text = ''){
		if($text == 'date'){
			$fec = explode("/",$this->fecha_envio);
			return $fec[2]."-".$fec[1]."-".$fec[0];
		}else
			if($text == 'formato'){
				$fec = explode("-",$this->fecha_envio);
				return $fec[2]."/".$fec[1]."/".$fec[0];
			}else
				return $this->fecha_envio;
	}
	public function getFecha_creacion($text = ''){
		if($text == 'date'){
			$fec = explode("/",$this->fecha_creacion);
			return $fec[2]."-".$fec[1]."-".$fec[0];
		}else
			if($text == 'formato'){
				$fec = explode("-",$this->fecha_creacion);
				return $fec[2]."/".$fec[1]."/".$fec[0];
			}else
				return $this->fecha_creacion;
	}
	//Modificadoras
	public function setId($id){
		$this->id = trim($id);
	}
	public function setTipo($tipo){
		$this->tipo = trim($tipo);
	}
	public function setId_sucursal($id_sucursal){
		$this->id_sucursal = trim($id_sucursal);
	}
	/*public function setFecha_envio($fecha_envio){
		$this->fecha_envio = $fecha_envio;
	}
	public function setFuncionario($funcionario){
		$this->funcionario = $funcionario;
	}*/
	public function setUtc($utc){
		$this->utc = trim($utc);
	}
	public function setTelefono($telefono){
		$this->telefono = trim($telefono);
	}
	public function setExtension($extension){
		$this->extension = trim($extension);
	}
	public function setId_usuarioenvia($id_usuarioenvia){
		$this->id_usuarioenvia = trim($id_usuarioenvia);
	}
	public function setLote($lote){
		$this->lote = trim($lote);
	}
	public function setFecha_recibido($fecha_recibido){
		$this->fecha_recibido = trim($fecha_recibido);
	}
	public function setEstado($estado){
		$this->estado = trim($estado);
	}
	public function setId_usuariorecibido($id_usuariorecibido){
		$this->id_usuariorecibido = trim($id_usuariorecibido);
	}
	public function setFecha_envio($fecha_envio){
		$this->fecha_envio = trim($fecha_envio);
	}
	public function setFecha_creacion($fecha_creacion){
		$this->fecha_creacion = trim($fecha_creacion);
	}

	public function setAtributos($atributos){
		if (is_array($atributos)){
			$this->setId((isset($atributos["id"]) ? $atributos["id"] : "NULL"));
			$this->setTipo((isset($atributos["tipo"]) ? $atributos["tipo"] : "0"));
			$this->setId_sucursal($atributos["id_sucursal"]);
			/*$this->setFecha_envio($atributos["fecha_envio"]);
			$this->setFuncionario($atributos["funcionario"]);*/
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
	public function registrar(){
		$conexion = new Conexion();
		$SQL = "INSERT INTO radicados 
				(
					tipo, id_sucursal, utc, telefono, extension, id_usuarioenvia
				)
				VALUES
				(
					".$this->getTipo().", ".$this->getId_sucursal().", ".$this->getUtc().", '".$this->getTelefono()."', 
					'".$this->getExtension()."', ".$this->getId_usuarioenvia().")";
		if($conexion->ejecutar($SQL)){
			$this->setId($conexion->ultimaId());
			$this->getRadicado();
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public function aprobarRadicado(){
		$conexion = new Conexion();
		$SQL = "INSERT INTO radicados 
				(
					lote, fecha_recibido, estado, id_usuariorecibido
				)
				VALUES
				(
					".$this->getLote().", '".$this->getFecha_recibido()."', ".$this->getEstado().", 
					".$this->getId_usuariorecibido()."
				)";
		if($conexion->ejecutar($SQL)){
			$this->setId($conexion->ultimaId());
			$this->getRadicado();
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public function agregarItems($nom, $ced){
		$conexion = new Conexion();
		$SQL = "INSERT INTO radicados_items
				(
					documento, descripcion, id_radicados
				)
				VALUES
				(
					'".$ced."', '".strtoupper($nom)."', ".$this->getId()."
				)
				";
		if($conexion->ejecutar($SQL)){
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public function getRadicado(){
		$conexion = new Conexion();
		$SQL = "SELECT * 
				FROM radicados 
				WHERE id = ".$this->getId();
		//echo $SQL;exit();
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$consulta = $conexion->sacarRegistro();
			//echo json_encode($consulta);
			$this->setAtributos($consulta);						
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;			
		}
	}
	public function getItemsDeRadicado(){
		$conexion = new Conexion();
		$SQL = "SELECT @rownum:=@rownum+1 AS rownum, id, descripcion, documento, estado, fecha_creacion 
				FROM (SELECT @rownum:=0) r, radicados_items 
				WHERE id_radicados = ".$this->getId()."
				ORDER BY estado ASC";
		//echo $SQL;exit();
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$array = array();
			while(($consulta = $conexion->sacarRegistro())){
				$array[] = $consulta;
			}						
			$conexion->desconectar();
			return $array;
		}else{
			$conexion->desconectar();
			return false;			
		}
	}
	public function getSucursal(){
		$conexion = new Conexion();
		$SQL = "SELECT t2.sucursal 
				FROM radicados AS t1
				INNER JOIN param_sucursales AS t2 ON(t1.id_sucursal = t2.id)
				WHERE t1.id = ".$this->getId();
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$consulta = $conexion->sacarRegistro();						
			$conexion->desconectar();
			return $consulta[0];
		}else{
			$conexion->desconectar();
			return false;			
		}
	}
	public function aprobarOrden(){
		$conexion = new Conexion();
		$SQL = "UPDATE radicados
				SET lote = ".$this->getId().", fecha_recibido = '".date('Y-m-d')."', 
				id_usuariorecibido = ".$this->getId_usuariorecibido().", estado = 2, 
				fecha_envio = '".$this->getFecha_envio()."'
				WHERE id = ".$this->getId();
		//echo $SQL;exit();
		if($conexion->ejecutar($SQL)){
			$this->getRadicado();
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public function aprobarCliente($id_cliente, $estado){
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_items
				SET estado = $estado
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
	public function getFuncionario(){
		$conexion = new Conexion();
		$SQL = "SELECT t2.name
				FROM radicados AS t1 
				INNER JOIN user AS t2 ON(t1.id_usuarioenvia = t2.id)
				WHERE t1.id = ".$this->getId();
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() == 1){
			$consulta = $conexion->sacarRegistro();						
			$conexion->desconectar();
			return $consulta[0];
		}else{
			$conexion->desconectar();
			return false;			
		}
	}
	public static function getJustFuncionario(){
		$conexion = new Conexion();
		$SQL = "SELECT name
				FROM user
				WHERE id = ".$_SESSION['id'];
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() == 1){
			$consulta = $conexion->sacarRegistro();						
			$conexion->desconectar();
			return $consulta[0];
		}else{
			$conexion->desconectar();
			return false;			
		}
	}
	public function getOficial(){
		$conexion = new Conexion();
		$SQL = "SELECT t2.*
				FROM radicados AS t1 
				INNER JOIN official AS t2 ON(t1.id_usuarioenvia = t2.id)
				WHERE t1.id = ".$this->getId()."
				AND t1.id_usuarioenvia = ".$this->getId_usuarioenvia();
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() == 1){
			$consulta = $conexion->sacarRegistro();						
			$conexion->desconectar();
			return $consulta;
		}else{
			$conexion->desconectar();
			return false;			
		}
	}
	public static function radicadosNoAprobados(){
		$conexion = new Conexion();
		$fecha = date('Y-m-d');
		$SQL = "SELECT id, id_usuarioenvia, DATEDIFF('$fecha', fecha_creacion) AS diferencia
				FROM radicados
				WHERE tipo = 0 AND estado = 0";
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$array = array();
			while(($consulta = $conexion->sacarRegistro())){
				if($consulta['diferencia'] > 3){
					$objeto = new Radicados();
					$objeto->setId($consulta['id']);
					$objeto->setId_usuarioenvia($consulta['id_usuarioenvia']);
					$oficial = $objeto->getOficial();
					$oficial['dias_atrazo'] = $consulta['diferencia'];
					$oficial['id_radicado'] = $consulta['id'];
					$array[] = $oficial;
				}
			}
			$conexion->desconectar();
			return $array;
		}else{
			$conexion->desconectar();
			return false;
		}
	}	
	public static function verificarNotificacionDia(){
		$conexion = new Conexion();
		$fecha = date('Y-m-d');
		$SQL = "SELECT * FROM radicados_recordatorio 
				WHERE fecha = '$fecha'";
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){			
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public static function insertarNotificacionDia(){
		$conexion = new Conexion();
		$fecha = date('Y-m-d');
		$SQL = "INSERT INTO radicados_recordatorio (fecha) VALUES ('$fecha')";
		if($conexion->ejecutar($SQL)){
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public function insertarDevolucion($cliente, $causal, $observation, $persontype){
		$conexion = new Conexion();
		$id_user = $_SESSION['id'];		
		$SQL = "INSERT INTO workflow
				(
					id_user, causal, id_official, observation, status, persontype, documento, nombre, id_radicado, id_sucursal, id_area, lote
				)
				VALUES
				(
					$id_user, '$causal', ".$this->getId_usuarioenvia().", '$observation', 1, $persontype, '".$cliente['documento']."', 
					'".$cliente['descripcion']."', ".$this->getId().", ".$this->getId_sucursal().", ".$this->getId_sucursal().", ".$this->getId()."
				)";
		if($conexion->ejecutar($SQL)){
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public function getDevolucion($documento){
		$conexion = new Conexion();
		$SQL = "SELECT * FROM workflow
				WHERE documento = '$documento'
				AND id_radicado = ".$this->getId()."
				ORDER BY date_created DESC
				LIMIT 1";
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() == 1){
			$consulta = $conexion->sacarRegistro();
			$conexion->desconectar();
			return $consulta;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public static function getClienteItem($id_cliente){
		$conexion = new Conexion();
		$SQL = "SELECT * FROM radicados_items WHERE id = ".$id_cliente;
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() == 1){
			$consulta = $conexion->sacarRegistro();
			$conexion->desconectar();
			return $consulta;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public static function inserFileRadicado($nombre, $documento){
		$conexion = new Conexion();
		$SQL = "INSERT INTO radicados_files
				(
					nombre, documento 
				)
				VALUES
				(
					'$nombre', '$documento'
				)";
		if($conexion->ejecutar($SQL)){
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public function updateFilesRadicado($documento){
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_files SET estado = 1, id_radicado = ".$this->getId()."
				WHERE documento = '$documento'";
		//echo "$SQL";
		if($conexion->ejecutar($SQL)){
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public function updateFilesRadicadoNombre($documento, $pos_cli){
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_files SET nombre = 'LOTE_".$this->getId()."_".$pos_cli.".tiff'
				WHERE documento = '$documento'";
		//echo "$SQL";
		if($conexion->ejecutar($SQL)){
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public static function clientesDelOficial($fec_ini, $fec_fin){
		$id_usuarioenvia = $_SESSION['id'];
		$conexion = new Conexion();
		$SQL = "SELECT t1.*, t3.name FROM radicados_items AS t1
				INNER JOIN radicados AS t2 ON(t1.id_radicados = t2.id) 
				INNER JOIN official AS t3 ON(t2.id_usuarioenvia = t3.id)
				WHERE t2.fecha_creacion BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59'
				AND t2.id_usuarioenvia = $id_usuarioenvia
				ORDER BY t2.id";
		//echo $SQL;
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$array = array();
			while(($consulta = $conexion->sacarRegistro())){
				$array[] = $consulta;
			}
			$conexion->desconectar();
			return $array;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public static function clientesDelOficialSucursal($fec_ini, $fec_fin, $sucursal){
		$comp = ' AND t2.id_sucursal = '.$sucursal;
		if ($sucursal == 'T') 
			$comp = '';
		$conexion = new Conexion();
		$SQL = "SELECT t1.id_radicados, t2.tipo, t4.sucursal, t3.name AS oficial, t1.documento, t1.descripcion,
				t1.fecha_creacion, t2.fecha_envio, t2.fecha_recibido, t1.estado 
				FROM radicados_items AS t1
				INNER JOIN radicados AS t2 ON(t1.id_radicados = t2.id) 
				INNER JOIN official AS t3 ON(t2.id_usuarioenvia = t3.id)
				INNER JOIN param_sucursales AS t4 ON(t2.id_sucursal = t4.id)
				WHERE t2.fecha_creacion BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59'$comp				
				ORDER BY t2.id";
		//echo $SQL;exit();
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$array = array();
			while(($consulta = $conexion->sacarRegistro('str'))){
				$array[] = $consulta;
			}
			$conexion->desconectar();
			return $array;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public static function clientesDelOficialOficial($fec_ini, $fec_fin, $oficial){
		$comp = ' AND t2.id_usuarioenvia = '.$oficial;
		if ($oficial == 'T') 
			$comp = '';
		$conexion = new Conexion();
		$SQL = "SELECT t1.id_radicados, t2.tipo, t4.sucursal, t3.name AS oficial, t1.documento, t1.descripcion,
				t1.fecha_creacion, t2.fecha_envio, t2.fecha_recibido, t1.estado 
				FROM radicados_items AS t1
				INNER JOIN radicados AS t2 ON(t1.id_radicados = t2.id) 
				INNER JOIN official AS t3 ON(t2.id_usuarioenvia = t3.id)
				INNER JOIN param_sucursales AS t4 ON(t2.id_sucursal = t4.id)
				WHERE t2.fecha_creacion BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59'$comp				
				ORDER BY t2.id";
		//echo $SQL;exit();
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$array = array();
			while(($consulta = $conexion->sacarRegistro())){
				$array[] = $consulta;
			}
			$conexion->desconectar();
			return $array;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public static function getRadicadosDia($fecha){
		$conexion = new Conexion();
		/*$SQL = "SELECT t1.id, t1.fecha_recibido, t2.sucursal, t2.sucursal, t1.utc, t3.name, t3.name, 
				 COUNT(t4.id), IF(t1.tipo = 0, 'Fisico', 'Virtual'), t1.fecha_creacion
				FROM radicados AS t1
				 INNER JOIN param_sucursales AS t2 ON(t1.id_sucursal = t2.id)
				 INNER JOIN official AS t3 ON(t1.id_usuarioenvia = t3.id)
				 INNER JOIN radicados_items AS t4 ON(t1.id = t4.id_radicados)
				WHERE t1.estado = 2
				 AND t1.fecha_recibido = '$fecha'";*/
		$SQL = "SELECT t1.id, t1.fecha_recibido, t2.sucursal, t2.sucursal, t1.utc, t3.name, t3.name, 
				  COUNT(t4.id), IF(t1.tipo = 0, 'Fisico', 'Virtual'), t1.fecha_creacion
				FROM radicados AS t1
					INNER JOIN param_sucursales AS t2 ON(t1.id_sucursal = t2.id)
					INNER JOIN official AS t3 ON(t1.id_usuarioenvia = t3.id)
					INNER JOIN radicados_items AS t4 ON(t1.id = t4.id_radicados AND t4.estado = 2)
				WHERE t1.estado = 2
					AND t1.fecha_recibido = '$fecha'
					GROUP BY t1.id";
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$array = array();
			while(($consulta = $conexion->sacarRegistro())){
				$array[] = $consulta;
			}
			$conexion->desconectar();
			return $array;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public static function cancelRadicado($id_radicado){
		$conexion = new Conexion();
		$hoy = date('Y-m-d');
		$SQL = "UPDATE radicados 
				SET estado = 4, fecha_recibido = '$hoy'
				WHERE id = $id_radicado
				AND estado = 0";
		if ($conexion->ejecutar($SQL)) {
			if (Radicados::cancelItemsRadicado($id_radicado)) {
				$conexion->desconectar();
				return true;
			}else{
				$conexion->desconectar();
				return false;
			}			
		}else{
			$conexion->desconectar();
			return false;
		}
	}
	public static function cancelItemsRadicado($id_radicado){
		$conexion = new Conexion();
		$SQL = "UPDATE radicados_items 
				SET estado = 4
				WHERE id_radicados = $id_radicado";
		if ($conexion->ejecutar($SQL))
			return true;
		else
			return false;
	}
}
?>