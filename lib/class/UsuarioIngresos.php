<?php
require_once '../../includes.php';
require_once PATH_CLASS.DS.'_conexion.php';
class UsuarioIngresos{
	private $usuario_id;
	private $primer_ingreso;
	private $primer_gestion;
	private $fecha;
	private $enviado;
	private $estado;
	private $fecha_creacion;
	private $conn;

	public function __construct(){
		$this->conn = new Conexion();
	}
	public function __destruct(){
		$this->conn->desconectar();
	}

	public function getusuario_id(){
		return $this->usuario_id;
	}
	public function getprimer_ingreso(){
		return $this->primer_ingreso;
	}
	public function getprimer_gestion(){
		return $this->primer_gestion;
	}
	public function getfecha(){
		return $this->fecha;
	}
	public function getenviado(){
		return $this->enviado;
	}
	public function getestado(){
		return $this->estado;
	}
	public function getfecha_creacion(){
		return $this->fecha_creacion;
	}

	public function setusuario_id($usuario_id){
		$this->usuario_id = $usuario_id;
	}
	public function setprimer_ingreso($primer_ingreso){
		$this->primer_ingreso = $primer_ingreso;
	}
	public function setprimer_gestion($primer_gestion){
		$this->primer_gestion = $primer_gestion;
	}
	public function setfecha($fecha){
		$this->fecha = $fecha;
	}
	public function setenviado($enviado){
		$this->enviado = $enviado;
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
				$this->setusuario_id($atributos['usuario_id']);
				$this->setprimer_ingreso((isset($atributos['primer_ingreso']) && !empty($atributos['primer_ingreso'])) ? $atributos['primer_ingreso'] : date('Y-m-d H:i:s'));
				$this->setprimer_gestion((isset($atributos['primer_gestion']) && !empty($atributos['primer_gestion'])) ? $atributos['primer_gestion'] : "NULL");
				$this->setfecha((isset($atributos['fecha']) && !empty($atributos['fecha'])) ? $atributos['fecha'] : date('Y-m-d'));
				$this->setenviado((isset($atributos["enviado"]) ? $atributos["enviado"] : "0"));
				$this->setestado((isset($atributos["estado"]) ? $atributos["estado"] : "0"));
				$this->setfecha_creacion((isset($atributos['fecha_creacion']) && !empty($atributos['fecha_creacion'])) ? $atributos['fecha_creacion'] : date('Y-m-d H:i:s'));
			}
		}
	}
	public function registrar(){
		$SQL = "INSERT INTO usuario_ingresos 
				(
					usuario_id, primer_ingreso, primer_gestion, fecha
				) 
				VALUES 
				(
					:usuario_id, :primer_ingreso, :primer_gestion, :fecha
				)";
		$data = array(
			':usuario_id'=> $this->getusuario_id(), 
			':primer_ingreso'=> $this->getprimer_ingreso(), 
			':primer_gestion'=> $this->getprimer_gestion(), 
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
		}catch(Exception $e){
			if((int)$e->getCode() != 23000)
				throw new PDOException($e->getMessage(), (int)$e->getCode());
			else
				throw new Exception($e->getMessage(), (int)$e->getCode());
		}
	}
	public function getObjeto(){
		$SQL = "SELECT * 
				  FROM usuario_ingresos
				 WHERE usuario_id = :usuario_id
				   AND fecha = :fecha";
		$this->conn->consultar($SQL, array(':usuario_id'=> $this->getusuario_id(), ':fecha'=> $this->getfecha()));
		if($this->conn->getNumeroRegistros() == 1){
			$row = $this->conn->sacarRegistro('str');
			$this->setAtributos($row);
			return true;
		}else
			return false;
	}
	public static function actualizarPrimeraGestion($primer_gestion, $fecha, $conn){
		$SQL = "UPDATE usuario_ingresos
				   SET primer_gestion = :primer_gestion
				 WHERE usuario_id = :usuario_id
				   AND fecha = :fecha";
		$data = array(
			':primer_gestion'=> $primer_gestion,
			':usuario_id'=> $_SESSION['id_user'],
			':fecha'=> $fecha
		);
		if($conn->ejecutar($SQL, $data)){
			$_SESSION['primer_gestion'] = $primer_gestion;
			return true;
		}else
			return false;
	}
}