<?php
require_once PATH_SITE . DS . "config/globalParameters.php";
require_once PATH_CCLASS . DS . "official.class.php";
class User
{
	function validateUser2($username, $password) {
		//Escapar caracteres
		$username = mysqli_real_escape_string($GLOBALS['link'], htmlspecialchars($username));
		$password = mysqli_real_escape_string($GLOBALS['link'], htmlspecialchars($password));
		$sql_username = "SELECT COUNT(*) AS total,id FROM user WHERE username = '$username' AND status = '1'";
		$result_username = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql_username));
		if( $result_username['total'] > 0 ) {
			$sql_password = "SELECT COUNT(*) AS total 
							   FROM user 
							  WHERE id='{$result_username['id']}' 
							    AND password = '$password'";
			$result_password = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql_password));
			if($result_password['total'] > 0 ) {
				return $result_username['id'];//Datos correctos
			} else {
				return -2; //Contraseña incorrecta
			}
		} else 
			return -1; //Usuario no existe
	}
	static function validateUser(Conexion $conn, string $username, string $password): array 
	{
		$SQL = "SELECT u.id,
					   u.name,
					   u.id_group,
					   u.cargo,
					   u.change_password,
					   u.password,
					   ui.fecha,
					   ui.primer_ingreso,
					   ui.primer_gestion,
					   u.username 
				  FROM user AS u 
				  LEFT JOIN usuario_ingresos AS ui ON(ui.usuario_id = u.id AND ui.fecha = :fecha)
				 WHERE username = :username 
				   AND status = :status";
		$conn->consultar($SQL, [':username'=> $username, ':status'=> '1', ':fecha'=> date('Y-m-d')]);
		if ($conn->getNumeroRegistros() !== 1) return ['error'=> 'El usuario no existe o esta creado mas de una vez.'];

		$row = $conn->sacarRegistro('str');

		if (!password_verify($password, $row['password'])) {
			return ['error'=> 'La contraseña del usuario no puede ser vacia, o no coincide.'];
		}
		unset($row['password']);
		return ['exito'=> 'Sesion iniciada con exito.', 'user'=> $row];
	}
	function getData($id) {
		$fecha = date('Y-m-d');
		$sql = "SELECT u.*,
					   ui.usuario_id,
					   ui.primer_ingreso, 
					   ui.primer_gestion,
					   ui.fecha 
				  FROM user AS u
				  LEFT JOIN usuario_ingresos AS ui ON(ui.usuario_id = u.id AND ui.fecha = '$fecha')
				 WHERE u.id = '$id'";
		return mysqli_query($GLOBALS['link'], $sql);
	}
	function getGroups() {
		$sql = "SELECT * FROM `group`";
		return mysqli_query($GLOBALS['link'], $sql);
	}
	function getUsersByRol($group) {
		$sql= "SELECT * FROM user WHERE status = '1' AND (id_group = '6' OR id_group = '3') ORDER BY name DESC";
		return mysqli_query($GLOBALS['link'], $sql);
	}
	function getUsers() {
		$sql = "SELECT * FROM user WHERE status = '1' ORDER BY date_created DESC LIMIT 20";
		return mysqli_query($GLOBALS['link'], $sql);
	}
	function add($id_group, $username, $password, $identificacion, $name, $sucursal, $correoelectronico, $cargo, $oficial = '', $correojefe='') {
		$username = mysqli_real_escape_string($GLOBALS['link'],  $username);
		$password = mysqli_real_escape_string($GLOBALS['link'],  $password);
		$sucursal = mysqli_real_escape_string($GLOBALS['link'],  $sucursal);
		$correoelectronico= mysqli_real_escape_string($GLOBALS['link'],  $correoelectronico);
		$cargo = strtolower(mysqli_real_escape_string($GLOBALS['link'],  $cargo ));
		$identificacion = mysqli_real_escape_string($GLOBALS['link'],  $identificacion);
		$name = mysqli_real_escape_string($GLOBALS['link'], $name);
		$sql = "INSERT INTO user
				(
					id_group, username, password, identificacion, name, sucursal, correoelectronico, cargo
				) 
				VALUES
				(
					'$id_group', '$username', '$password', '$identificacion', '$name', '$sucursal', '$correoelectronico', '$cargo'
				)";
		if (!mysqli_query($GLOBALS['link'],  $sql )) return -1;

		if ($oficial != '') {
			$ultimId = @mysqli_insert_id($GLOBALS['link']);
			Official::addOficial($ultimId, $identificacion, $name, $correoelectronico, $correojefe);
		}
		return 0;
	}
	static function add2(Conexion $conn, array $data): array
	{
		$SQL = "INSERT INTO user
				(id_group, username, password, identificacion, name, sucursal, correoelectronico, cargo) 
				VALUES 
				(:id_group, :username, :password, :identificacion, :name, :sucursal, :correoelectronico, :cargo)";
		try {
			$resp = $conn->ejecutar($SQL, [
				':id_group'=> $data['id_group'], 
				':username'=> $data['username'], 
				':password'=> password_hash($data['password'], PASSWORD_DEFAULT), 
				':identificacion'=> $data['identificacion'], 
				':name'=> $data['name'], 
				':sucursal'=> $data['sucursal'], 
				':correoelectronico'=> $data['correoelectronico'], 
				':cargo'=> $data['cargo']
			]);
		} catch (Exception $e) {
			return ['error'=> 'Ocurrio una excpcion al momento de crear el usuario, contacte con el administrador.<br>Codigo: ' . $e->getCode() . '<br>Error: ' .$e->getMessage()];
		}
		if (!$resp) {
			return ['error'=> 'Ocurrio un error al momento de crear el usuario, contacte con el administrador.'];
		}
		$mensajeOficial = '';
		if (!empty($data['correojefe']) && filter_var($data['correojefe'], FILTER_VALIDATE_EMAIL)) {
			$user_id = $conn->ultimaId();
			if (!Official::addOficial2($conn, $user_id, $data['identificacion'], $data['name'], $data['correoelectronico'], $data['correojefe'])) {
				$mensajeOficial = '<br>Pero no se pudo crear el jefe del usuario.';
			}
		}
		return ['exito'=> 'El usuario fue creado exitosamente.' . $mensajeOficial];
	}
	function search($type,$text) {
		$sql = "SELECT * FROM user WHERE 1 ";
		if( $type == 1 ) {
			$sql.= "AND username LIKE '%".$text."%'";
		} else if( $type == 2) {
			$sql.= "AND name LIKE '%".$text."%'";
		} else if( $type == 3 ) {
			$sql.= "AND identificacion LIKE '%".$text."%'";
		}
		return mysqli_query($GLOBALS['link'], $sql);
	}
	function validatePass($id_user, $password) {
		$password = mysqli_real_escape_string($GLOBALS['link'], htmlspecialchars($password));/* CAMBIO 2011-08-25 */
		$sql = "SELECT COUNT(*) AS total FROM user WHERE id = '$id_user' AND password = '$password'";
		$result = mysqli_fetch_array( mysqli_query($GLOBALS['link'], $sql) );
		if( $result['total'] > 0 ) {
			return 0;
		} else {
			return 1;
		}
	}
	function changePassword($id_user, $newpass ) {
		$newpass = mysqli_real_escape_string($GLOBALS['link'], htmlspecialchars($newpass));
		$sql = "UPDATE user SET password = '$newpass', change_password = '1' WHERE id = '$id_user'";
		if( mysqli_query($GLOBALS['link'],  $sql ))
			return 0;
		else 
			return -1;
	}
	function getUsername( $identificacion) {
		$identificacion = mysqli_real_escape_string($GLOBALS['link'], htmlspecialchars($identificacion));
		$sql = "SELECT username FROM user WHERE identificacion = '$identificacion'";
		return mysqli_query($GLOBALS['link'], $sql);
	}
	function disableUser($id_user) {
		$sql = "UPDATE user SET status = '0' WHERE id = '$id_user'";
		if( mysqli_query($GLOBALS['link'],  $sql ))
			return 1;
		else 
			return 2;
	}
	function getName($id_user) {
		$sql = "SELECT name FROM user WHERE id = '$id_user'";
		$result = mysqli_fetch_array( mysqli_query($GLOBALS['link'], $sql));
		return $result['name'];
	}
	static function obtenerTareas(){
		$objs = array();
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM param_tarea 
				 WHERE estado = :estado";
		if($conn->consultar($SQL, array(':estado'=> "0"))){
			if($conn->getNumeroRegistros() > 0){
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
			}
		}
		return $objs;
	}
	static function obtenerUsuariosOperacion(){
		$objs = array();
		$conn = new Conexion();
		$SQL = "SELECT id,
					   CONCAT_WS(' - ', username, name) AS name,
					   username
				  FROM user 
				 WHERE status = '1' 
				   AND id_group IN (3, 6) 
				   AND username LIKE 'ICOL%'
				 ORDER BY name ASC";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
			}
		}
		return $objs;
	}
	static function actualizarPasswordPorId(Conexion $conn, int $id, string $password, string $nuevoPassword): array
	{
		$SQL = "SELECT id, password FROM user WHERE id = :id";
		$conn->consultar($SQL, [':id'=> $id]);
		if ($conn->getNumeroRegistros() !== 1) { 
			return ['error'=> 'El usuario consultado no existe.'];
		}

		$row = $conn->sacarRegistro('str');

		if (!password_verify($password, $row['password'])) { 
			return ['error'=> 'Los datos del usuario con concuerda, probablemente esa no sea su contraseña actual.'];
		}

		$resp = $conn->ejecutar("UPDATE user SET password = :password, change_password = 1 WHERE id = :id", [':id'=> $row['id'], ':password'=> password_hash($nuevoPassword, PASSWORD_DEFAULT)]);

		if ($resp) $_SESSION['change_password'] = 1;

		return $resp
			? ['exito'=> 'Se realizo la actualizacion de la contraseña satisfactoriamente.']
			: ['error'=> 'Ocurrio un error al momento de actualizar la contraseña, contacte con el administrador.'];
	}
}
