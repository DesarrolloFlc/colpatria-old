<?php
class Conexion
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
	private $prepare = null;
	
	public function __construct()
	{
		switch (DB_TYPE) {
			case 'mysql':
				try{
					$this->link = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=" . $this->charset, $this->username, $this->password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $this->charset]);
					if (!$this->link) {
						echo "No se pudo conectar a la base de datos";
					}
					$this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				}catch(PDOException $e){
					echo "1. " . $e->getMessage();
				}
			break;
			default:
				try{
					$this->link = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=" . $this->charset, $this->username, $this->password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $this->charset]);
					if (!$this->link) {
						echo "No se pudo conectar a la base de datos";
					}
					$this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				}catch(PDOException $e){
					echo "2. " . $e->getMessage();
				}
			break;
		}		
	}
	public function setNumeroRegistros($numrows)
	{
		$this->numrows = $numrows;
	}
	public function getNumeroRegistros()
	{
		return $this->numrows;
	}
	public function consultar($SQL, $datos = null)
	{
		$this->result = $datos === null ? $this->link->query($SQL) : $this->link->prepare($SQL);
		if($datos !== null){
			$this->result->execute($datos);
		}
		$this->setNumeroRegistros($this->result === false ? 0 : $this->result->rowCount());
		return $this->result === false ? false : true;
	}
	public function ejecutar($SQL, $datos = null)
	{
		$this->resulteject = $datos === null ? $this->link->exec($SQL) : $this->link->prepare($SQL);
		$rowCount = gettype($this->resulteject) === 'object' ? 0 : (int) $this->resulteject;
		if($datos !== null){
			foreach ($datos as $key => $value) {
				if($value == 'NULL')
					$this->resulteject->bindValue($key, null, PDO::PARAM_NULL);
				else
					$this->resulteject->bindValue($key, $value);
			}
			$this->resulteject->execute();
			$rowCount = $this->resulteject->rowCount();
		}
		$this->setNumeroRegistros($this->resulteject === false ? 0 : $rowCount);
		return $this->resulteject === false ? false : true;
	}
	public function sacarRegistro($fetch_style = '')
	{
		if ($fetch_style == 'str') {
			return $this->result->fetch(PDO::FETCH_ASSOC);
		} else if ($fetch_style == 'num') {
			return $this->result->fetch(PDO::FETCH_NUM);
		} else {
			return $this->result->fetch(PDO::FETCH_BOTH);
		}
	}
	public function ultimaId()
	{
		return $this->link->lastInsertId();
	}
	public function desconectar()
	{
		$this->link = null;
	}
}
