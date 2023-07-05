<?php
/**
* 
*/
class Connect
{
	private $host = DB_HOST;
	private $username = DB_USER;
	private $password = DB_PASS;
	private $database = DB_NAME;
	private $charset = DB_CHARSET;
	private $result;
	private $resulteject;
	private $numrows = 0;

	private $link = null;
	
	function __construct(){
		switch (DB_TYPE) {
			case 'mysql':
				try{
					$this->link = new PDO("mysql:host=".$this->host.";dbname=".$this->database.";charset=".$this->charset, $this->username, $this->password);
					if (!$this->link) {
						echo "No se pudo conectar a la base de datos";
					}
					$this->link->exec("set names ".$this->charset);
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			break;
			default:
				try{
					$this->link = new PDO("mysql:host=".$this->host.";dbname=".$this->database.";charset=".$this->charset, $this->username, $this->password);
					if (!$this->link) {
						echo "No se pudo conectar a la base de datos";
					}
					$this->link->exec("set names ".$this->charset);
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			break;
		}		
	}
	public function setNumeroRegistros($numrows){
		$this->numrows = $numrows;
	}
	public function getNumeroRegistros(){
		return $this->numrows;
	}
	public function consultar($SQL){
		$this->result = $this->link->query($SQL);
		if ($this->result) {
			$this->setNumeroRegistros($this->result->rowCount());
			return true;
		}else{
			$this->setNumeroRegistros(0);
			return false;
		}
	}
	public function ejecutar($SQL){
		$this->resulteject = $this->link->exec($SQL);
		if ($this->resulteject === false) {
			$this->setNumeroRegistros(0);
			return false;
		}else{
			$this->setNumeroRegistros($this->resulteject);
			return true;
		}
	}
	public function sacarRegistros(){
		return $this->result->fetch(PDO::FETCH_BOTH);
	}
	public function ultimaId(){
		return $this->link->lastInsertId();
	}
	public function desconectar(){
		$this->link = null;
	}
}
?>