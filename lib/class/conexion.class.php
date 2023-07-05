<?php
class Conexion{
	private $nombreBD = DB_NAME;
	private $enlaceBD;
	private $numeroRegistros = 0;
	private $error;
	private $resultado;
	private $host = DB_HOST;
	private $usuario = DB_USER;
	private $contrasena = DB_PASS;
	
	//Analizadores
	public function getNumeroRegistros(){
		return $this->numeroRegistros;
	}
	public function getEnlaceBD(){
		return $this->enlaceBD;
	}
	public function getError($cual = "array"){
		if($cual === "numero" || $cual === 0 || $cual === "texto" || $cual === 1) return $this->error[$cual];
		else return $this->error;
	}
	
	private function setNumeroRegistros($numeroRegistros){
		$this->numeroRegistros = $numeroRegistros;
	}
	
	private function setError($error = ""){
		if($error == ""){
			$this->error = array(mysqli_errno($this->enlaceBD), mysqli_error($this->enlaceBD));
			$this->error["numero"] = $this->error[0];
			$this->error["texto"] = $this->error[1];
		}elseif(is_array($error)){
			$this->error = $error;
		}elseif($error == 0){
			$this->error = array(0, "", "numero" => 0, "texto" => "");
		}
	}
	
	public function Conexion($nom = ''){
		if ($nom != '') $this->nombreBD = $nom;
		$error = "";
		$this->enlaceBD = mysqli_connect($this->host, $this->usuario, $this->contrasena, $this->nombreBD);
		if($this->enlaceBD == false){
			$this->setError(array(mysqli_error($this->enlaceBD)));
			exit();
		}/*
		if (!mysql_select_db($this->nombreBD,$this->enlaceBD)){
      		$this->setError(array("", "Error seleccionando la base de datos."));
		    exit();
   		}*/
   		mysqli_query($this->enlaceBD, "SET NAMES 'utf8'");
	}
	
	public function consultar($SQL){
		$this->resultado = @mysqli_query($GLOBALS['link'], $SQL,$this->enlaceBD);
		if($this->resultado){
			$this->setNumeroRegistros(@mysqli_num_rows($this->resultado));
			$this->setError(0);
			return true;
		}else{
			$this->setNumeroRegistros(0);
			if($this->enlaceBD != false) $this->setError();
			return false;
		}
	}
	
	public function sacarRegistro($text = ''){
		if ($text == 'str') {
			return @mysqli_fetch_array($this->resultado, MYSQLI_ASSOC);
		}elseif($text == 'num'){
			return @mysqli_fetch_array($this->resultado, MYSQLI_NUM);
		}else
			return @mysqli_fetch_array($this->resultado);
	}
	public function ultimaId(){
		return @mysqli_insert_id($this->enlaceBD);
	}
	
	public function ejecutar($SQL){
		$this->resultado = @mysqli_query($GLOBALS['link'], $SQL,$this->enlaceBD);
		if($this->resultado){
			$this->setNumeroRegistros(@mysqli_affected_rows($this->enlaceBD));
			$this->setError(0);
			return true;
		}else{
			$this->setNumeroRegistros(0);
			if($this->enlaceBD != false) $this->setError();
			return false;
		}
	}
	
	public function desconectar(){
		if(is_resource($this->enlaceBD))
			mysqli_close($this->enlaceBD);
	}
}
?>