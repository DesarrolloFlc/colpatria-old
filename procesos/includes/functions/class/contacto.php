<?php
require_once PATH_CLASS.DS.'conexion.php';

class Contacto{
	var $id;
	var $usuario_id;
	var $gestion_id;
	var $observacion;

	public function getId(){
		return $this->id;
	}
	public function getUsuario_id(){
		return $this->usuario_id;
	}
	public function getGestion_id(){
		return $this->gestion_id;
	}
	public function getObservacion(){
		return $this->observacion;
	}

	public function setId($id){
		$this->id = $id;
	}
	public function setUsuario_id($usuario_id){
		$this->usuario_id = $usuario_id;
	}
	public function setGestion_id($gestion_id){
		$this->gestion_id = $gestion_id;
	}
	public function setObservacion($observacion){
		$this->observacion = $observacion;
	}

	public function setAtributos($atributos){
		if (is_array($atributos)){
			$this->setId((isset($atributos["id"]) ? $atributos["id"] : "NULL"));
			$this->setUsuario_id($atributos["usuario_id"]);
			$this->setGestion_id($atributos["gestion_id"]);
			$this->setObservacion($atributos["observacion"]);
		}
	}

	public function registrar(){
		$conexion = new Conexion();
		$SQL = "INSERT INTO contacto (id, usuario_id, gestion_id, observacion ) VALUES (".
		$this->getId().",".$this->getUsuario_id().",".
		$this->getGestion_id().",'".$this->getObservacion()."')";
		/*echo $SQL;
		exit();*/
		if($conexion->ejecutar($SQL)){
			$this->setId($conexion->ultimaId());
			$conexion->desconectar();
			return true;
		}else{
			$conexion->desconectar();
			return false;
		}
	}
}
?>