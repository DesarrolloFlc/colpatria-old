<?php
require_once PATH_CLASS.DS.'conexion.php';
/**
* 
*/
class Gestion
{
	
	var $id;
	var $nombre;

	public function getId(){
		return $this->id;
	}
	public function getNombre(){
		return $this->nombre;
	}

	public function setId($id){
		$this->id = $id;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function setAtributos($atributos){
		if (is_array($atributos)){
			$this->setId((isset($atributos["id"]) ? $atributos["id"] : "NULL"));
			$this->setNombre($atributos["nombre"]);
		}
	}

	public static function todas(){
		$conexion = new Conexion();
		$SQL = "SELECT * FROM gestion WHERE 1";
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$array = array();
			while($consulta = $conexion->sacarRegistro()){
				$ges = new Gestion();
				$ges->setAtributos($consulta);
				$array[] = $ges;				
			}
			$conexion->desconectar();
			return $array;
		}else{
			$conexion->desconectar();
			return false;			
		}
	}
}
?>