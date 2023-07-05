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
			$this->error = array(mysql_errno($this->enlaceBD), mysql_error($this->enlaceBD));
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
		$this->enlaceBD = mysql_connect($this->host,$this->usuario,$this->contrasena);
		if($this->enlaceBD == false){
			$this->setError(array("", mysql_error($this->enlaceBD)));
			exit();
		}
		if (!mysql_select_db($this->nombreBD,$this->enlaceBD)){
      		$this->setError(array("", "Error seleccionando la base de datos."));
		    exit();
   		}
   		mysqli_query("SET NAMES 'utf8'");
	}
	
	public function consultar($SQL){
		$this->resultado = @mysqli_query($SQL,$this->enlaceBD);
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
	
	public function sacarRegistro($meth = ''){
		if($meth == 'num')
			return mysql_fetch_row($this->resultado);
		elseif($meth == 'str')
			return mysql_fetch_assoc($this->resultado);
		else
			return mysqli_fetch_array($this->resultado);
		
	}
	public function ultimaId(){
		return @mysql_insert_id($this->enlaceBD);
	}
	
	public function ejecutar($SQL){
		$this->resultado = @mysqli_query($SQL,$this->enlaceBD);
		if($this->resultado){
			$this->setNumeroRegistros(@mysql_affected_rows($this->enlaceBD));
			$this->setError(0);
			return true;
		}else{
			$this->setNumeroRegistros(0);
			if($this->enlaceBD != false) $this->setError();
			return false;
		}
	}
	public function liberar(){
		return mysql_free_result($this->resultado);
	}
	
	public function desconectar(){
		if(is_resource($this->enlaceBD))
			mysql_close($this->enlaceBD);
	}
}
?>