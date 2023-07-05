<?php
require_once PATH_CLASS.DS.'conexion.php';

class Usuario
{
	var $id;
	var $nombre;
	var $user;
	var $pass;

	public function getId(){
		return $this->id;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function getUser(){
		return $this->user;
	}
	public function getPass(){
		return $this->pass;
	}

	public function setId($id){
		$this->id = $id;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function setUser($user){
		$this->user = $user;
	}
	public function setPass($pass){
		$this->pass = $pass;
	}

	public function setAtributos($atributos){
		if (is_array($atributos)){
			$this->setId((isset($atributos["id"]) ? $atributos["id"] : "NULL"));
			$this->setNombre($atributos["nombre"]);
			$this->setUser($atributos["user"]);
			$this->setPass($atributos["pass"]);
		}
	}

	public static function existeUsuario($user, $pass){
		$conexion = new Conexion();
		$SQL = "SELECT id FROM usuario WHERE user = '".$user."' AND pass = '".$pass."'";
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$consulta = $conexion->sacarRegistro();
			$conexion->desconectar();
			return $consulta['id'];
		}else{
			$conexion->desconectar();
			return false;			
		}
	}
}
?>