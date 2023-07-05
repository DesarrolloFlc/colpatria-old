<?php
require_once '../../includes.php';
require_once PATH_CLASS.DS.'_conexion.php';
class ClientesNuevoRegimen{
	private $creador_id;
	private $regimen_str;
	private $tipo_persona_str;
	private $tipo_producto;
	private $tipodocumento_str;
	private $numero_documento;
	private $nombre_completo;
	private $fecha_expedicion;
	private $regimen_id;
	private $tipodocumento_id;
	private $fecha;
	private $estado;
	private $fecha_creacion;
	private $conn;

	public function __construct(){
		$this->conn = new Conexion();
	}
	public function __destruct(){
		$this->conn->desconectar();
	}

	public function getcreador_id(){
		return $this->creador_id;
	}
	public function getregimen_str(){
		return $this->regimen_str;
	}
	public function gettipo_persona_str(){
		return $this->tipo_persona_str;
	}
	public function gettipo_producto(){
		return $this->tipo_producto;
	}
	public function gettipodocumento_str(){
		return $this->tipodocumento_str;
	}
	public function getnumero_documento(){
		return $this->numero_documento;
	}
	public function getnombre_completo(){
		return $this->nombre_completo;
	}
	public function getfecha_expedicion(){
		return $this->fecha_expedicion;
	}
	public function getregimen_id(){
		return $this->regimen_id;
	}
	public function gettipodocumento_id(){
		return $this->tipodocumento_id;
	}
	public function getfecha(){
		return $this->fecha;
	}
	public function getestado(){
		return $this->estado;
	}
	public function getfecha_creacion(){
		return $this->fecha_creacion;
	}

	public function setcreador_id($creador_id){
		$this->creador_id = $creador_id;
	}
	public function setregimen_str($regimen_str){
		$this->regimen_str = $regimen_str;
	}
	public function settipo_persona_str($tipo_persona_str){
		$this->tipo_persona_str = $tipo_persona_str;
	}
	public function settipo_producto($tipo_producto){
		$this->tipo_producto = $tipo_producto;
	}
	public function settipodocumento_str($tipodocumento_str){
		$this->tipodocumento_str = $tipodocumento_str;
	}
	public function setnumero_documento($numero_documento){
		$this->numero_documento = $numero_documento;
	}
	public function setnombre_completo($nombre_completo){
		$this->nombre_completo = $nombre_completo;
	}
	public function setfecha_expedicion($fecha_expedicion){
		$this->fecha_expedicion = $fecha_expedicion;
	}
	public function setregimen_id($regimen_id){
		$this->regimen_id = $regimen_id;
	}
	public function settipodocumento_id($tipodocumento_id){
		$this->tipodocumento_id = $tipodocumento_id;
	}
	public function setfecha($fecha){
		$this->fecha = $fecha;
	}
	public function setestado($estado){
		$this->estado = $estado;
	}
	public function setfecha_creacion($fecha_creacion){
		$this->fecha_creacion = $fecha_creacion;
	}

	public function setAtributos($atributos, $tipe = ''){
		if($tipe == 'num'){
		}else{
			if (is_array($atributos)){
				$this->setcreador_id($atributos['creador_id']);
				$this->setregimen_str((isset($atributos['regimen_str']) && !empty($atributos['regimen_str'])) ? $atributos['regimen_str'] : "NULL");
				$this->settipo_persona_str((isset($atributos['tipo_persona_str']) && !empty($atributos['tipo_persona_str'])) ? $atributos['tipo_persona_str'] : "NULL");
				$this->settipo_producto((isset($atributos['tipo_producto']) && !empty($atributos['tipo_producto'])) ? $atributos['tipo_producto'] : "NULL");
				$this->settipodocumento_str((isset($atributos['tipodocumento_str']) && !empty($atributos['tipodocumento_str'])) ? $atributos['tipodocumento_str'] : "NULL");
				$this->setnumero_documento((isset($atributos['numero_documento']) && !empty($atributos['numero_documento'])) ? $atributos['numero_documento'] : "NULL");
				$this->setnombre_completo((isset($atributos['nombre_completo']) && !empty($atributos['nombre_completo'])) ? $atributos['nombre_completo'] : "NULL");
				$this->setfecha_expedicion((isset($atributos['fecha_expedicion']) && !empty($atributos['fecha_expedicion']) && $atributos['fecha_expedicion'] != '0000-00-00') ? $atributos['fecha_expedicion'] : "NULL");
				$this->setregimen_id((isset($atributos['regimen_id']) && $atributos['regimen_id'] != '') ? $atributos['regimen_id'] : "0");
				$this->settipodocumento_id((isset($atributos['tipodocumento_id']) && !empty($atributos['tipodocumento_id'])) ? $atributos['tipodocumento_id'] : "NULL");
				$this->setfecha((isset($atributos['fecha']) && !empty($atributos['fecha'])) ? $atributos['fecha'] : date('Y-m-d'));
				$this->setestado((isset($atributos["estado"]) ? $atributos["estado"] : "0"));
				$this->setfecha_creacion((isset($atributos['fecha_creacion']) && !empty($atributos['fecha_creacion'])) ? $atributos['fecha_creacion'] : date('Y-m-d H:i:s'));
			}
		}
	}
	public function registrar(){
		$SQL = "INSERT INTO clientes_nuevo_regimen 
				(
					creador_id, regimen_str, tipo_persona_str, tipo_producto, tipodocumento_str, numero_documento, nombre_completo, fecha_expedicion, regimen_id, tipodocumento_id, fecha
				) 
				VALUES 
				(
					:creador_id, :regimen_str, :tipo_persona_str, :tipo_producto, :tipodocumento_str, :numero_documento, :nombre_completo, :fecha_expedicion, :regimen_id, :tipodocumento_id, :fecha
				)";
		$data = array(
			':creador_id'=> $this->getcreador_id(),
			':regimen_str'=> $this->getregimen_str(),
			':tipo_persona_str'=> $this->gettipo_persona_str(),
			':tipo_producto'=> $this->gettipo_producto(),
			':tipodocumento_str'=> $this->gettipodocumento_str(),
			':numero_documento'=> $this->getnumero_documento(),
			':nombre_completo'=> $this->getnombre_completo(),
			':fecha_expedicion'=> $this->getfecha_expedicion(),
			':regimen_id'=> $this->getregimen_id(),
			':tipodocumento_id'=> $this->gettipodocumento_id(),
			':fecha'=> $this->getfecha()
		);
		try{
			if($this->conn->ejecutar($SQL, $data)){
				if($this->getObjeto()){
					unset($data);
					return array("exito"=> "Se inserto y se creo el objeto usuarios");
				}else
					return array("error"=> "No se pudo crear el objeto radicado.");
			}else
				return array("error"=>"No se pudo crear el objeto radicado.");
		}catch(\Exception $e){
			if((int)$e->getCode() != 23000)
				throw new \PDOException($e->getMessage(), (int)$e->getCode());
			else
				throw new \Exception($e->getMessage(), (int)$e->getCode());
		}
	}
	public function getObjeto(){
		$SQL = "SELECT * 
				  FROM clientes_nuevo_regimen
				 WHERE numero_documento = :numero_documento
				   AND regimen_id = :regimen_id
				   AND fecha = :fecha";
		$this->conn->consultar($SQL, array(':numero_documento'=> $this->getnumero_documento(), ':regimen_id'=> $this->getregimen_id(), ':fecha'=> $this->getfecha()));
		if($this->conn->getNumeroRegistros() == 1){
			$row = $this->conn->sacarRegistro('str');
			$this->setAtributos($row);
			return true;
		}else
			return false;
	}
	public function actualizar(){
		$SQL = "UPDATE clientes_nuevo_regimen
				   SET regimen_str = :regimen_str,
					   tipo_persona_str = :tipo_persona_str,
					   tipo_producto = :tipo_producto,
					   tipodocumento_str = :tipodocumento_str,
					   nombre_completo = :nombre_completo,
					   fecha_expedicion = :fecha_expedicion,
					   tipodocumento_id = :tipodocumento_id,
				 WHERE numero_documento = :numero_documento
				   AND regimen_id = :regimen_id
				   AND fecha = :fecha";
		$data = array(
			':regimen_str'=> $this->getregimen_str(),
			':tipo_persona_str'=> $this->gettipo_persona_str(),
			':tipo_producto'=> $this->gettipo_producto(),
			':tipodocumento_str'=> $this->gettipodocumento_str(),
			':nombre_completo'=> $this->getnombre_completo(),
			':fecha_expedicion'=> $this->getfecha_expedicion(),
			':tipodocumento_id'=> $this->gettipodocumento_id(),
			':numero_documento'=> $this->getnumero_documento(),
			':regimen_id'=> $this->getregimen_id(),
			':fecha'=> $this->getfecha()
		);
		if($this->conn->ejecutar($SQL, $data)){
			return true;
		}else
			return false;
	}
}
