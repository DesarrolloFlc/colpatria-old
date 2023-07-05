<?php
require_once 'conexion.class.php';
/**
* 
*/
class Supermercado
{
	
	/*function __construct(argument)
	{
		# code...
	}*/
	public static function getFulldataSeguros($id_data){
		$conn = new Conexion();
		$SQL = "SELECT * FROM sup_data WHERE id = $id_data";
		if($conn->consultar($SQL)){
			if ($conn->getNumeroRegistros() == 1) {
				$consulta = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $consulta;
			}else{
				$conn->desconectar();
				return array("error"=>"la cantidad de registros no es unica");
			}
		}else{
			$conn->desconectar();
			return array("error"=>"la consulta no se pudo realizar");
		}
	}
	public static function getFulldataCapi($id_data){
		$conn = new Conexion();
		$SQL = "SELECT t1.*, t2.ciudad AS ciudadlaborall, t3.ciudad AS ciudadresidenciaa 
				FROM sup_data_capi AS t1
				INNER JOIN param_ciudadesdane AS t2 ON(t1.ciudadlaboral = t2.cod_dane)
				INNER JOIN param_ciudadesdane AS t3 ON(t1.ciudadresidencia = t3.cod_dane)
				WHERE t1.id = $id_data";
		//echo "$SQL";
		if($conn->consultar($SQL)){
			if ($conn->getNumeroRegistros() == 1) {
				$consulta = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $consulta;
			}else{
				$conn->desconectar();
				return array("error"=>"la cantidad de registros no es unica");
			}
		}else{
			$conn->desconectar();
			return array("error"=>"la consulta no se pudo realizar");
		}
	}
	public static function getDataSeguros($id_client){
		$conn = new Conexion();
		$SQL = "SELECT * FROM sup_data WHERE id_client = $id_client";
		if($conn->consultar($SQL)){
			if ($conn->getNumeroRegistros() == 1) {
				$consulta = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $consulta;
			}else{
				$conn->desconectar();
				return array("error"=>"la cantidad de registros no es unica");
			}
		}else{
			$conn->desconectar();
			return array("error"=>"la consulta no se pudo realizar");
		}
	}
	public static function getDataCapi($id_client) {
		$conn = new Conexion();
		$SQL = "SELECT t1.*, t2.ciudad AS ciudadlaborall, t3.ciudad AS ciudadresidenciaa FROM sup_data_capi AS t1
				INNER JOIN param_ciudadesdane AS t2 ON(t1.ciudadlaboral = t2.cod_dane)
				INNER JOIN param_ciudadesdane AS t3 ON(t1.ciudadresidencia = t3.cod_dane)
				WHERE t1.id = $id_client";
		if($conn->consultar($SQL)){
			if ($conn->getNumeroRegistros() == 1) {
				$consulta = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $consulta;
			}else{
				$conn->desconectar();
				return array("error"=>"la cantidad de registros no es unica");
			}
		}else{
			$conn->desconectar();
			return array("error"=>"la consulta no se pudo realizar");
		}
	}
	public static function getCiudades() {
		$SQL = "SELECT * FROM param_ciudad WHERE estado = '0' ORDER BY description ASC";
		return Supermercado::consultasGenerales($SQL);
    }
	public static function getContacts() {
		$SQL = "SELECT * FROM param_contact WHERE status = '1' ORDER BY description ASC";
		return Supermercado::consultasGenerales($SQL);
    }
	public static function getProfesiones(){
		$SQL = "SELECT * FROM param_profesion WHERE estado = 0";
		return Supermercado::consultasGenerales($SQL);
    }
    public static function getIngresosMensuales() {
        $SQL = "SELECT * FROM param_ingresosmensuales WHERE estado = 0";
        return Supermercado::consultasGenerales($SQL);
    }
    public static function getEgresosMensuales() {
    	$SQL = "SELECT * FROM param_egresosmensuales WHERE estado = 0";
    	return Supermercado::consultasGenerales($SQL);
    }
    public static function getEstadosCiviles() {
    	$SQL = "SELECT * FROM param_estadocivil";
    	return Supermercado::consultasGenerales($SQL);
    }
    public static function getEstudios() {
    	$SQL = "SELECT * FROM param_estudio";
    	return Supermercado::consultasGenerales($SQL);
    }
	public static function getActividades() {
		$SQL = "SELECT * FROM param_actividad WHERE estado = 0";
		return Supermercado::consultasGenerales($SQL);
	}
	public static function getIngresosMensualesEmp() {
		$SQL = "SELECT * FROM param_ingresosmensuales_emp WHERE estado = 0";
		return Supermercado::consultasGenerales($SQL);
	}
	public static function getEgresosMensualesEmp() {
		$SQL = "SELECT * FROM param_egresosmensuales_emp WHERE estado = 0";
		return Supermercado::consultasGenerales($SQL);
	}
    public static function consultasGenerales($SQL){
    	$conn = new Conexion();
    	if($conn->consultar($SQL)){
			if ($conn->getNumeroRegistros() > 0) {
				$objetos = array();
				while ($consulta = $conn->sacarRegistro('str')) {
					$objetos[] = $consulta;
				}
				$conn->desconectar();
				return $objetos;
			}else{
				$conn->desconectar();
				return array("error"=>"la cantidad de registros no es unica");
			}
		}else{
			$conn->desconectar();
			return array("error"=>"la consulta no se pudo realizar");
		}
    }
    public static function getLastConfirmSeg($id_client){
    	$conn = new Conexion();
		$SQL = "SELECT date_created 
				FROM sup_data_confirm 
				WHERE (id_contact BETWEEN '1' AND '4') 
				AND id_client='$id_client' 
				ORDER BY date_created DESC 
				LIMIT 1";
		if($conn->consultar($SQL)){
			if ($conn->getNumeroRegistros() == 1) {
				$consulta = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $consulta;
			}else{
				$conn->desconectar();
				return array("error"=>"la cantidad de registros no es unica");
			}
		}else{
			$conn->desconectar();
			return array("error"=>"la consulta no se pudo realizar");
		}
	}
	public static function getLastConfirmCapi($id_client){
		$conn = new Conexion();
		$SQL = "SELECT date_created 
				FROM sup_data_capi_confirm 
				WHERE (id_contact BETWEEN '1' AND '4') 
				AND id_client='$id_client' 
				ORDER BY date_created DESC 
				LIMIT 1";
		if($conn->consultar($SQL)){
			if ($conn->getNumeroRegistros() == 1) {
				$consulta = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $consulta;
			}else{
				$conn->desconectar();
				return array("error"=>"la cantidad de registros no es unica");
			}
		}else{
			$conn->desconectar();
			return array("error"=>"la consulta no se pudo realizar");
		}
	}
	public static function addConfirmCapi($data){
		$conn = new Conexion();
		$SQL = "INSERT INTO sup_data_capi_confirm
				(
					id_client, id_user, id_contact, documento, primerapellido, segundoapellido,
					nombres, fechanacimiento, id_profesion, empresa, id_ingresos, id_egresos,
					activos, pasivos, direccionlaboral, id_ciudad, direccionresidencia,
					telefonoresidencia, celular, correoelectronico, numerohijos, estadocivil,
					nivelestudios, observacion
				)
				VALUES
				(
					".trim($data['id_client']).", ".$_SESSION['id'].", ".trim($data['id_contact']).", '".trim($data['documento'])."', 
					'".trim($data['primerapellido'])."', '".trim($data['segundoapellido'])."', '".trim($data['nombres'])."', 
					'".trim($data['fechanacimiento'])."', ".trim($data['id_profesion']).", '".trim($data['empresa'])."', 
					".trim($data['id_ingresos']).", ".trim($data['id_egresos']).", '".trim($data['activos'])."', 
					'".trim($data['pasivos'])."', '".trim($data['direccionlaboral'])."', ".trim($data['id_ciudad']).", 
					'".trim($data['direccionresidencia'])."', '".trim($data['telefonoresidencia'])."', '".trim($data['celular'])."', 
					'".trim($data['correoelectronico'])."', ".trim($data['numerohijos']).", ".trim($data['estadocivil']).", 
					".trim($data['nivelestudios']).", '".trim($data['observacion'])."'
				)";
		//echo $SQL;
		if($conn->ejecutar($SQL)){
			$objectoRest = array();
			$objectoRest['lastid'] = $conn->ultimaId();
			$conn->desconectar();
			return $objectoRest;
		}else{
			$conn->desconectar();
			return array("error"=>"la insersion no se pudo realizar");
		}
	}
	public static function addRecordCapi($lastid,$file){
		$file_origen = $file['grabacion']['tmp_name'];
		$onlyname = explode(".", $file['grabacion']['name']);
		$unique_name = md5(uniqid(rand(), true));

		$finalname = $unique_name."_record.".$onlyname[count($onlyname)-1];

		$file_destino = "/var/www/html/recordssup/records_colpatria_capi/".$finalname;
		if(move_uploaded_file($file_origen, $file_destino)){
			$conn = new Conexion();
			$SQL = "INSERT INTO sup_recordcapi
					(
						id_data_capi_confirm, directory, filename
					)
					VALUES
					(
						$lastid, 'recordssup/records_colpatria_capi', '$finalname'
					)";
			if($conn->ejecutar($SQL)){
				$conn->desconectar();
				return true;
			}else{
				$conn->desconectar();
				return array("error"=>"la insersion no se pudo realizar");
			}
		}else
			return array("error"=>"No se puede subir el archivo");
	}
	public static function addConfirmSegu($data){
		$conn = new Conexion();
		$SQL = "INSERT INTO sup_data_confirm
				(
					id_client, id_contact, id_user, documento, primerapellidos, segundoapellido, primernombre, segundonombre,
					fechanacimiento, numerohijos, estadocivil, nivelestudios, id_profesion, id_ciudad, direccionresidencia,
					telefonoresidencia, empresatrabajo, direcciontrabajo, id_ingresos, id_egresos, totalactivos,
					totalpasivos, celular, correoelectronico, observacion
				)
				VALUES
				(
					".trim($data['id_client']).", ".trim($data['id_contact']).", ".$_SESSION['id'].", 
					'".trim($data['documento'])."', '".trim($data['primerapellidos'])."', '".trim($data['segundoapellido'])."', 
					'".trim($data['primernombre'])."', '".trim($data['segundonombre'])."','".trim($data['fechanacimiento'])."', 
					".trim($data['numerohijos']).", ".trim($data['estadocivil']).", ".trim($data['nivelestudios']).", 
					".trim($data['id_profesion']).", ".trim($data['id_ciudad']).", '".trim($data['direccionresidencia'])."',
					'".trim($data['telefonoresidencia'])."', '".trim($data['empresatrabajo'])."', '".trim($data['direcciontrabajo'])."', 
					".trim($data['id_ingresos']).", ".trim($data['id_egresos']).", '".trim($data['totalactivos'])."',
					'".trim($data['totalpasivos'])."', '".trim($data['celular'])."', '".trim($data['correoelectronico'])."', 
					'".trim($data['observacion'])."'
				)";
		//echo $SQL;
		if($conn->ejecutar($SQL)){
			$objectoRest = array();
			$objectoRest['lastid'] = $conn->ultimaId();
			$conn->desconectar();
			return $objectoRest;
		}else{
			$conn->desconectar();
			return array("error"=>"la insersion no se pudo realizar");
		}
	}
	public static function addRecordSegu($lastid,$file){
		$file_origen = $file['grabacion']['tmp_name'];
		$onlyname = explode(".", $file['grabacion']['name']);
		$unique_name = md5(uniqid(rand(), true));

		$finalname = $unique_name."_record.".$onlyname[count($onlyname)-1];

		$file_destino = "/var/www/html/recordssup/records_colpatria_seguro/".$finalname;
		if(move_uploaded_file($file_origen, $file_destino)){
			$conn = new Conexion();
			$SQL = "INSERT INTO sup_record
					(
						id_data_capi_confirm, directory, filename
					)
					VALUES
					(
						$lastid, 'recordssup/records_colpatria_seguro', '$finalname'
					)";
			if($conn->ejecutar($SQL)){
				$conn->desconectar();
				return true;
			}else{
				$conn->desconectar();
				return array("error"=>"la insersion no se pudo realizar");
			}
		}else
			return array("error"=>"No se puede subir el archivo");
	}
	public static function getContactTelfCapi($id_client) {
		$SQL = "SELECT confirm.observacion, confirm.date_created, us.name, param_contact.type, param_contact.description, 
					CONCAT(recorde.directory,'/',recorde.filename) AS filename
				FROM sup_client cli 
				INNER JOIN sup_data_capi_confirm confirm ON(cli.id = confirm.id_client)
				INNER JOIN param_contact ON(param_contact.id = confirm.id_contact)
				INNER JOIN user us ON(us.id = confirm.id_user)
				LEFT JOIN sup_recordcapi AS recorde ON(recorde.id_data_capi_confirm = confirm.id)
				WHERE confirm.id_client = $id_client 
				ORDER BY confirm.date_created DESC";
		return Supermercado::consultasGenerales($SQL);
	}
	public static function getContactTelfSeg($id_client) {
		$SQL = "SELECT confirm.observacion, confirm.date_created, us.name, param_contact.type, param_contact.description, 
					CONCAT(recorde.directory,'/',recorde.filename) AS filename
				FROM sup_client cli 
				INNER JOIN sup_data_confirm confirm ON(cli.id = confirm.id_client)
				INNER JOIN param_contact ON(param_contact.id = confirm.id_contact)
				INNER JOIN user us ON(us.id = confirm.id_user)
				LEFT JOIN sup_record AS recorde ON(recorde.id_data_confirm = confirm.id)
				WHERE confirm.id_client = $id_client 
				ORDER BY confirm.date_created DESC";
		return Supermercado::consultasGenerales($SQL);
	}
	public static function verificarCliente($documento){
		$conn = new Conexion();
		$SQL = "SELECT COUNT(*) FROM sup_client WHERE document = $documento";		
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$conn->desconectar();
				return true;
			}else{
				$conn->desconectar();
				return array("error"=>"Ya existe un cliente con este numero de documento, contacte por favor al administrador");
			}
		}else{
			$conn->desconectar();
			return array("error"=>"la consulta no se pudo realizar, contacte al administrador");
		}
	}
	public static function updateClientDocument($datos){
		$conn = new Conexion();
		$user = $_SESSION['id'];
		$fecha = date('y-m-d h:m:s');
		$id_client = $datos['id_client'];
		$nuevodocumento = $datos['nuevodocumento'];
		$SQL = "UPDATE sup_client 
				SET document = '$nuevodocumento', last_updater = '$user', date_updated_document = '$fecha' 
				WHERE id = '$id_client'";
		if($conn->ejecutar($SQL)){
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return array("error"=>"la actualizacion no se pudo realizar, contacte al administrador");
		}
	}
}
?>