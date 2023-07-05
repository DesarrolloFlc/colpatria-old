<?php
class Formulario
{
	const MIME_WORD = [
		'application/msword',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'application/vnd.ms-fontobject',
		'application/epub+zip'
	];
	const MIME_EXCEL = [
		'text/plain', 
		'application/vnd.ms-excel', 
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
	];
	public static function getTipoPersona(){
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM param_tipopersona
				 WHERE 1";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getTipoDocumento(){
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM param_tipodocumento 
				 WHERE estado = 0";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getCiudades(){
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM param_ciudad 
				 WHERE estado = '0' 
				 ORDER BY description ASC";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getOcupaciones(){
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM param_ocupacion 
				 WHERE estado = 0";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getOtrosIngresos(){
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM param_otrosingresos";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getActividades(){
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM param_actividad 
				 WHERE estado = 0 
				   AND tipo IN ('0', '1')";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getCiudadesDanes(){
		$conn = new Conexion();
		$SQL = "SELECT cod_dane AS id, 
					   CONCAT(ciudad, ', ', departamento) AS ciudad 
				  FROM param_ciudadesdane 
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getSucursalesLista(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   sucursal 
				  FROM param_sucursales 
				 WHERE estado = '0' 
				 ORDER BY sucursal";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getclaseVinculacion($tipo = '2'){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_clasecliente 
				 WHERE tipo IN ('0', $tipo)
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getClaseCliente(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_clasecliente 
				 WHERE tipo IN ('0', '1')
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getTipoDocumentoID($tipo = '2'){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_tipodocumento 
				 WHERE tipo IN ('0', $tipo)
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getTipoEmpresaID($tipo = '2'){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_tipoempresa 
				 WHERE tipo IN ('0', $tipo)
				   AND estado = '0'
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getActividadesEconomicas($tipo = '2'){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_actividad 
				 WHERE tipo IN ('0', $tipo)
				   AND estado = '0'
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getCiiuId(){
		$conn = new Conexion();
		$SQL = "SELECT codigo, 
					   CONCAT_WS(' - ', codigo, descripcion) AS descripcion 
				  FROM param_ciiu_new 
				 WHERE estado = '0'";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				//$objs[] = ['codigo'=> "0", 'descripcion'=> "SD - SD"];
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getCiiuId2(){
		$conn = new Conexion();
		$SQL = "SELECT codigo, 
					   descripcion 
				  FROM param_ciiu 
				 WHERE 1";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getProfesionesID(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_profesion 
				 WHERE estado = '0'";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getSexo(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_sexo 
				 WHERE estado = '0'";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getIngresosMensualesID(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description, 
					   min 
				  FROM param_ingresosmensuales 
				 WHERE estado = '0'
				   AND tipo IN ('0', '2')
				 ORDER BY 3";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getIngresosMensuales(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description
				  FROM param_ingresosmensuales 
				 WHERE estado = '0'";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getIngresosMensualesEmp(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description
				  FROM param_ingresosmensuales_emp 
				 WHERE estado = '0'";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getEgresosMensualesID(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description, 
					   min 
				  FROM param_egresosmensuales 
				 WHERE estado = '0'
				   AND tipo IN ('0', '2')
				 ORDER BY 3";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getEgresosMensuales(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description, 
					   min 
				  FROM param_egresosmensuales 
				 WHERE estado = '0'";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getEgresosMensualesEmp(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description
				  FROM param_egresosmensuales_emp 
				 WHERE estado = '0'";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getEstadosCiviles(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description
				  FROM param_estadocivil";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getEstudios(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description
				  FROM param_estudio";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getTipoTransaccionesID(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_tipotransacciones 
				 WHERE estado = '0'
				   AND tipo IN ('0', '2')
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getTipoTransacciones(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_tipotransacciones 
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getTipoVivienda(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_tipovivienda 
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getTiposActividad(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_tipoactividad 
				  WHERE estado = '0'
				 ORDER BY 2";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getPaisesID(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_paises 
				 WHERE estado = '0' 
				 ORDER BY description";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getPais(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_pais 
				 WHERE estado = '0' 
				 ORDER BY description";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getActividadEcono(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_actividadecono 
				 WHERE estado = '0' 
				 ORDER BY description";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getAreasID(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_area 
				 WHERE status = '1' 
				 ORDER BY description";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getFormularios(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   description 
				  FROM param_formulario 
				 WHERE tipo IN ('0', '1') 
				   AND estado = '0'
				 ORDER BY description";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function getOfficials(){
		$conn = new Conexion();
		$SQL = "SELECT id, 
					   name 
				  FROM official 
				 WHERE status = '0' 
				 ORDER BY name ASC";
		if($conn->consultar($SQL)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				
				$conn->desconectar();
				return $objs;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function obtenerIdCliente($documento, $tipoCliente, $tipo = 1){
		$conn = new Conexion();
		$tabla = "client";
		if($tipo == 2)
			$tabla = "client_";

		$SQL = "SELECT id 
				  FROM $tabla 
				 WHERE document = :document 
				   AND persontype = :persontype";
		if($conn->consultar($SQL, array(':document'=> $documento, ':persontype'=> $tipoCliente))){
			if($conn->getNumeroRegistros() > 0){
				$dat = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $dat['id'];
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function activeCliente($cliente_id, $tipo = 1) {
		$conn = new Conexion();
		$tabla = "client";
		if($tipo == 2)
			$tabla = "client_";

		$SQL = "UPDATE $tabla 
				   SET estado = :estado, 
				   	   type = :type, 
				   	   vigente = :vigente, 
				   	   date_updated = :date_updated, 
				   	   flag = :flag 
				 WHERE id = :id";
		if($conn->ejecutar($SQL, array(':estado'=> "0", ':type'=> "SGV", ':vigente'=> "0", ':date_updated'=> date('Y-m-d'), ':flag'=> "NULL", ':id'=> $cliente_id))){
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function actualizarRegimen($cliente_id, $regimen_id, $tipo = 1) {
		self::activeCliente($cliente_id, $tipo);

		$comple = "";
		if($regimen_id == 2)
			$comple = "AND regimen_id NOT IN (3)";
		if($regimen_id == 1)
			$comple = "AND regimen_id NOT IN (2)";
		

		$tabla = "client";
		if($tipo == 2)
			$tabla = "client_";

		$conn = new Conexion();
		$SQL = "UPDATE $tabla 
				   SET regimen_id = :regimen_id 
				 WHERE id = :id
				   $comple";
		if($conn->ejecutar($SQL, array(':regimen_id'=> $regimen_id, ':id'=> $cliente_id))){
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function obtenerUltimoFormData($cliente_id){
		$conn = new Conexion();
		$SQL = "SELECT d.*,
					   c.persontype, 
					   c.document,
					   c.firstname
				  FROM form AS f
				 INNER JOIN client AS c ON(c.id = f.id_client)
				 INNER JOIN data AS d ON(d.id_form = f.id)
				 WHERE f.id_client = :cliente_id
				   AND f.status = :status
				   AND f.id_user NOT IN (:id_user)
				 ORDER BY f.date_created DESC
				 LIMIT 0, 1";
		if($conn->consultar($SQL, array(':cliente_id'=> $cliente_id, ':status'=> '1', ':id_user'=> 3691))){
			if($conn->getNumeroRegistros() > 0){
				$dat = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $dat;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function obtenerUltimoIdFormulario($cliente_id, $tipo = 1){
		$tabla = "form";
		if($tipo == 2)
			$tabla = "form_";
		$conn = new Conexion();
		$SQL = "SELECT f.id
				  FROM $tabla AS f
				 WHERE f.id_client = :cliente_id
				   AND f.status = :status
				   AND f.id_user NOT IN (:id_user)
				 ORDER BY f.date_created DESC
				 LIMIT 0, 1";
		if($conn->consultar($SQL, array(':cliente_id'=> $cliente_id, ':status'=> '1', ':id_user'=> 3691))){
			if($conn->getNumeroRegistros() > 0){
				$dat = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $dat['id'];
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function verificarFormulario($id_client, $lote, $planilla, $id_user){
		$conn = new Conexion();
		$SQL = "SELECT f.* 
				  FROM form AS f
				 INNER JOIN data AS d ON(d.id_form = f.id)
				 WHERE f.id_client = :id_client
				   AND f.id_user = :id_user
				   AND f.log_planilla = :log_planilla
				   AND f.log_lote = :log_lote
				   AND f.status = :status
				 ORDER BY f.date_created DESC";
		$data = array(
			':id_client'=> $id_client,  
			':id_user'=> $id_user, 
			':log_planilla'=> ($planilla != '0') ? explode('.', substr($planilla, 8, strlen($planilla)))[0] : "0", 
			':log_lote'=> substr($lote, 5, strlen($lote)), 
			':status'=> '1'
		);
		if($conn->consultar($SQL, $data)){
			if($conn->getNumeroRegistros() > 0){
				$row = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $row;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function agregarNuevoFormulario($id_client, $type, $lote, $planilla, $id_user, $num_images, $marca, $tipo = 1){
		$conn = new Conexion();
		$tabla = "form";
		if($tipo == 2)
			$tabla = "form_";
		$SQL = "INSERT INTO $tabla
				(
					id_client, type, lote,planilla, id_user, log_planilla, log_lote, num_images, marca
				)
				VALUES
				(
					:id_client, :type, :lote, :planilla, :id_user, :log_planilla, :log_lote, :num_images, :marca
				)";
		$data = array(
			':id_client'=> $id_client, 
			':type'=> $type, 
			':lote'=> $lote, 
			':planilla'=> ($planilla != '0') ? $planilla : 'PLANILLA', 
			':id_user'=> $id_user, 
			':log_planilla'=> ($planilla != '0') ? explode('.', substr($planilla, 8, strlen($planilla)))[0] : "0", 
			':log_lote'=> substr($lote, 5, strlen($lote)), 
			':num_images'=> $num_images, 
			':marca'=> $marca
		);
		if($conn->ejecutar($SQL, $data)){
			$lastId = $conn->ultimaId();
			$conn->desconectar();
			return $lastId;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function insertarCuenta($data_id, $producto_tipo, $producto_identificacion, $producto_entidad, $producto_monto, $producto_ciudad, $producto_pais, $producto_moneda){
		$conn = new Conexion();
		$SQL = "INSERT INTO data_productos 
				(
					data_id, tipo, identificacion_producto, entidad, monto, pais, ciudad, moneda
				) 
				VALUES 
				(
					:data_id, :producto_tipo, :producto_identificacion, :producto_entidad, :producto_monto, :producto_ciudad, :producto_pais, :producto_moneda
				)";
		$data = array(
			':data_id'=> $data_id, 
			':producto_tipo'=> $producto_tipo, 
			':producto_identificacion'=> $producto_identificacion, 
			':producto_entidad'=> $producto_entidad, 
			':producto_monto'=> $producto_monto, 
			':producto_ciudad'=> $producto_ciudad, 
			':producto_pais'=> $producto_pais, 
			':producto_moneda'=> $producto_moneda
		);
		if($conn->ejecutar($SQL, $data)){
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function insertarReclamacion($data_id, $rec_ano, $rec_ramo, $rec_compania, $rec_valor, $rec_resultado){
		$conn = new Conexion();
		$SQL = "INSERT INTO data_reclamaciones 
				(
					data_id, rec_ano, rec_ramo, rec_compania, rec_valor, rec_resultado
				) 
				VALUES 
				(
					:data_id, :rec_ano, :rec_ramo, :rec_compania, :rec_valor, :rec_resultado
				)";
		$data = array(
			':data_id'=> $data_id, 
			':rec_ano'=> $rec_ano, 
			':rec_ramo'=> $rec_ramo, 
			':rec_compania'=> $rec_compania, 
			':rec_valor'=> $rec_valor, 
			':rec_resultado'=> $rec_resultado
		);
		if($conn->ejecutar($SQL, $data)){
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function insertarAccionista($data_id, $tipo_id, $identificacion, $nombre_accionista, $porcentaje, $publico_recursos, $publico_reconocimiento, $publico_expuesta, $declaracion_tributaria){
		$conn = new Conexion();
		$SQL = "INSERT INTO data_socios 
				(
					data_id, tipo_id, identificacion, nombre_accionista, porcentaje, publico_recursos, publico_reconocimiento, publico_expuesta, declaracion_tributaria
				) 
				VALUES 
				(
					:data_id, :tipo_id, :identificacion, :nombre_accionista, :porcentaje, :publico_recursos, :publico_reconocimiento, :publico_expuesta, :declaracion_tributaria
				)";
		$data = array(
			':data_id'=> $data_id, 
			':tipo_id'=> $tipo_id, 
			':identificacion'=> $identificacion, 
			':nombre_accionista'=> $nombre_accionista, 
			':porcentaje'=> $porcentaje, 
			':publico_recursos'=> $publico_recursos, 
			':publico_reconocimiento'=> $publico_reconocimiento, 
			':publico_expuesta'=> $publico_expuesta, 
			':declaracion_tributaria'=> $declaracion_tributaria
		);
		if($conn->ejecutar($SQL, $data)){
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function obtenerImagenTemporal($id_imagen_tmp){
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM image_tmp 
				 WHERE id = :id";
		if($conn->consultar($SQL, array(':id'=> $id_imagen_tmp))){
			if($conn->getNumeroRegistros() == 1){
				$dat = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $dat;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function obtenerInformacionRadicado($id){
		$conn = new Conexion();
		$SQL = "SELECT r.*,
					   o.name AS oficial_nombre
				  FROM radicados AS r 
				  LEFT JOIN official AS o ON(o.id = r.id_usuarioenvia )
				 WHERE r.id = :id";
		/*echo $SQL;
		echo json_encode(array(':id'=> $id));*/
		if($conn->consultar($SQL, array(':id'=> $id))){
			if($conn->getNumeroRegistros() == 1){
				$dat = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $dat;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function guardarImagenDigitada($file, $id_form, $id_imagetype, $id_user, $id_imagen_tmp, $tipo = 1){
		$conn = new Conexion();
		$tabla = "image";
		if($tipo == 2)
			$tabla = "image_";
		$conn = new Conexion();
		$error_file = '';
		$file_origen = "/var/www/html/Aplicativos.Serverfin04/Colpatria/tmp_images/".$id_user."/".$file;
		$onlyname = explode(".", $file);
		$unique_name = md5(uniqid(rand(), true));
		$finalname = $unique_name."_".$id_imagetype.".".$onlyname[count($onlyname) - 1];

		$file_destino = "/var/www/html/Aplicativos.Serverfin04/images_colpatria/".$finalname;
		if(file_exists($file_origen)){
			if(!copy($file_origen, $file_destino))
				$error_file = 'No se pudo copiar la imagen original a su destino; Origen: '.$file_origen.', Destino: '.$file_destino;
		}else
			$error_file = 'La imagen no existe, contacte con el administrador: '.$file_origen;
		
		$SQI = "INSERT INTO $tabla
				(
					id_forma, id_imagetype, directory, filename, original_file
				)
				VALUES
				(
					:id_forma, :id_imagetype, :directory, :filename, :original_file
				)";
		$conn->ejecutar($SQI, array(':id_forma'=> $id_form, ':id_imagetype'=> $id_imagetype, ':directory'=> 'images_colpatria', ':filename'=> $finalname, ':original_file'=> $file));
		$SQU = "UPDATE image_tmp 
				   SET status = :status 
				 WHERE id = :id
				   AND directory != '1'";
		$conn->ejecutar($SQU, array(':id'=> $id_imagen_tmp, ':status'=> '2'));
		return $error_file;
	}
	public static function crearNuevoCliente($document, $persontype, $firstname, $tipo_norma_id = 1, $regimen_id = 2, $tipo = 1){
		$conn = new Conexion();
		$tabla = "client";
		if($tipo == 2)
			$tabla = "client_";

		$SQL = "INSERT INTO $tabla
				(
					document, persontype, firstname, tipo_norma_id, regimen_id
				)
				VALUES
				(
					:document, :persontype, :firstname, :tipo_norma_id, :regimen_id
				)";
		$data = array(
			':document'=> $document, 
			':persontype'=> $persontype, 
			':firstname'=> $firstname,
			':tipo_norma_id'=> $tipo_norma_id, 
			':regimen_id'=> $regimen_id
		);
		if($conn->ejecutar($SQL, $data)){
			$lastId = $conn->ultimaId();
			$conn->desconectar();
			return $lastId;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function insertPrimaryDataNew($form_id, $da, $cliente_id, $conn = null, $tipo = 1){
		if($conn === null)
			$conn = new Conexion();
		$tabla = "data";
		if($tipo == 2)
			$tabla = "data_";
		$SQL = "INSERT INTO $tabla
				(
					id_form, fecharadicado, fechasolicitud, sucursal, area, lote, formulario, id_official, clasecliente, primerapellido, segundoapellido, 
					nombres, tipodocumento, documento, fechaexpedicion, lugarexpedicion, fechanacimiento, paisnacimiento, lugarnacimiento, nacionalidad_otra, 
					nacionalidad_cual, sexo, nacionalidad, numerohijos, estadocivil, direccionresidencia, ciudadresidencia, telefonoresidencia, nombreempresa, 
					ciudadempresa, direccionempresa, nomenclatura, telefonolaboral, celular, correoelectronico, cargo, actividadeconomicaempresa, profesion, 
					ocupacion, detalleocupacion, ciiu, ingresosmensuales, otrosingresos, egresosmensuales, conceptosotrosingresos, tipoactividad, 
					detalletipoactividad, nivelestudios, tipovivienda, estrato, totalactivos, totalpasivos, razonsocial, nit, digitochequeo, ciudadoficina, 
					direccionoficinappal, nomenclatura_emp, telefonoficina, faxoficina, celularoficina, ciudadsucursal, direccionsucursal, nomenclatura_emp2, 
					telefonosucursal, faxsucursal, actividadeconomicappal, detalleactividadeconomicappal, tipoempresaemp, activosemp, pasivosemp, 
					ingresosmensualesemp, egresosmensualesemp, otrosingresosemp, concepto_otrosingresosemp, 
					monedaextranjera, tipotransacciones, productos_exterior, cuentas_monedaextranjera, firma, huella, lugarentrevista, fechaentrevista, 
					horaentrevista, tipohoraentrevista, resultadoentrevista, observacionesentrevista, nombreintermediario, socio1, socio2, socio3, 
					ciudad, tipo_solicitud, cual_clasecliente, celularoficinappal, tipoempresaemp_cual, 
					recursos_publicos, poder_publico, reconocimiento_publico, reconocimiento_cual, servidor_publico, expuesta_politica, cargo_politica, 
					cargo_politica_ini, cargo_politica_fin, expuesta_publica, publica_nombre, publica_cargo, repre_internacional, internacional_indique, 
					tributarias_otro_pais, tributarias_paises, ciiu_otro, telefonoficinappal, patrimonio, tipoempresajur, tipoempresajur_otra, 
					correoelectronico_otro, origen_fondos, procedencia_fondos, tipotransacciones_cual, otras_operaciones, reclamaciones, clave_inter, 
					firma_entrevista, verificacion_ciudad, verificacion_fecha, verificacion_hora, verificacion_nombre, verificacion_observacion, 
					verificacion_firma, auto_correo, auto_sms, producto_seguro, pep_expuesto, expuesta_extrangero, expuesta_internacional, conyuge_expuesto,
					asociado_expuesto, pep_familiar, pep_familia_nombre, pep_familia_cargo, accionista_beneficios, cotiza_rnve, beneficiarios_diferentes, beneficiarios_naturales, beneficiarios_jur,
					verificacion_cargo, verificacion_documento, responsable_rut, codigo_rut, tipo_norma_id, regimen_id
				)
				VALUES
				(
					:id_form, :fecharadicado, :fechasolicitud, :sucursal, :area, :lote, :formulario, :id_official, :clasecliente, :primerapellido, :segundoapellido, 
					:nombres, :tipodocumento, :documento, :fechaexpedicion, :lugarexpedicion, :fechanacimiento, :paisnacimiento, :lugarnacimiento, :nacionalidad_otra, 
					:nacionalidad_cual, :sexo, :nacionalidad, :numerohijos, :estadocivil, :direccionresidencia, :ciudadresidencia, :telefonoresidencia, :nombreempresa, 
					:ciudadempresa, :direccionempresa, :nomenclatura, :telefonolaboral, :celular, :correoelectronico, :cargo, :actividadeconomicaempresa, :profesion, 
					:ocupacion, :detalleocupacion, :ciiu, :ingresosmensuales, :otrosingresos, :egresosmensuales, :conceptosotrosingresos, :tipoactividad, 
					:detalletipoactividad, :nivelestudios, :tipovivienda, :estrato, :totalactivos, :totalpasivos, :razonsocial, :nit, :digitochequeo, :ciudadoficina, 
					:direccionoficinappal, :nomenclatura_emp, :telefonoficina, :faxoficina, :celularoficina, :ciudadsucursal, :direccionsucursal, :nomenclatura_emp2, 
					:telefonosucursal, :faxsucursal, :actividadeconomicappal, :detalleactividadeconomicappal, :tipoempresaemp, :activosemp, :pasivosemp, 
					:ingresosmensualesemp, :egresosmensualesemp, :otrosingresosemp, :concepto_otrosingresosemp,  
					:monedaextranjera, :tipotransacciones, :productos_exterior, :cuentas_monedaextranjera, :firma, :huella, :lugarentrevista, :fechaentrevista, 
					:horaentrevista, :tipohoraentrevista, :resultadoentrevista, :observacionesentrevista, :nombreintermediario, :socio1, :socio2, :socio3, 
					:ciudad, :tipo_solicitud, :cual_clasecliente, :celularoficinappal, :tipoempresaemp_cual, 
					:recursos_publicos, :poder_publico, :reconocimiento_publico, :reconocimiento_cual, :servidor_publico, :expuesta_politica, :cargo_politica, 
					:cargo_politica_ini, :cargo_politica_fin, :expuesta_publica, :publica_nombre, :publica_cargo, :repre_internacional, :internacional_indique, 
					:tributarias_otro_pais, :tributarias_paises, :ciiu_otro, :telefonoficinappal, :patrimonio, :tipoempresajur, :tipoempresajur_otra, 
					:correoelectronico_otro, :origen_fondos, :procedencia_fondos, :tipotransacciones_cual, :otras_operaciones, :reclamaciones, :clave_inter, 
					:firma_entrevista, :verificacion_ciudad, :verificacion_fecha, :verificacion_hora, :verificacion_nombre, :verificacion_observacion, 
					:verificacion_firma, :auto_correo, :auto_sms, :producto_seguro, :pep_expuesto, :expuesta_extrangero, :expuesta_internacional, :conyuge_expuesto,
					:asociado_expuesto, :pep_familiar, :pep_familia_nombre, :pep_familia_cargo, :accionista_beneficios, :cotiza_rnve, :beneficiarios_diferentes, :beneficiarios_naturales, :beneficiarios_jur,
					:verificacion_cargo, :verificacion_documento, :responsable_rut, :codigo_rut, :tipo_norma_id, :regimen_id
				)";
		$sdCiudad = (in_array(intval($da['formulario']), [15, 19, 20])) ? '99999' : '2000';
		$data = array(
			':id_form'=> $form_id, 
			':fecharadicado'=> $da['fecharadicado'], 
			':fechasolicitud'=> $da['fechasolicitud'], 
			':sucursal'=> $da['sucursal'], 
			':area'=> $da['area'], 
			':lote'=> $da['lote'], 
			':formulario'=> $da['formulario'], 
			':id_official'=> $da['id_official'], 
			':clasecliente'=> $da['clasecliente'], 
			':primerapellido'=> $da['primerapellido'], 
			':segundoapellido'=> $da['segundoapellido'], 
			':nombres'=> $da['nombres'], 
			':tipodocumento'=> $da['tipodocumento'], 
			':documento'=> $da['documento'], 
			':fechaexpedicion'=> $da['fechaexpedicion'], 
			':lugarexpedicion'=> (isset($da['lugarexpedicion']) && !empty($da['lugarexpedicion'])) ? $da['lugarexpedicion'] : '99999', 
			':fechanacimiento'=> $da['fechanacimiento'], 
			':paisnacimiento'=> (isset($da['paisnacimiento']) && !empty($da['paisnacimiento'])) ? $da['paisnacimiento'] : '249', 
			':lugarnacimiento'=> (isset($da['lugarnacimiento']) && !empty($da['lugarnacimiento'])) ? $da['lugarnacimiento'] : $sdCiudad, 
			':nacionalidad_otra'=> (isset($da['nacionalidad_otra']) && !empty($da['nacionalidad_otra'])) ? $da['nacionalidad_otra'] : '249', 
			':nacionalidad_cual'=> (isset($da['nacionalidad_cual']) && !empty($da['nacionalidad_cual'])) ? $da['nacionalidad_cual'] : 'SD', 
			':sexo'=> (isset($da['sexo']) && !empty($da['sexo'])) ? $da['sexo'] : 'SD', 
			':nacionalidad'=> (isset($da['nacionalidad']) && !empty($da['nacionalidad'])) ? $da['nacionalidad'] : '249', 
			':numerohijos'=> (isset($da['numerohijos']) && !empty($da['numerohijos'])) ? $da['numerohijos'] : '*', 
			':estadocivil'=> (isset($da['estadocivil']) && !empty($da['estadocivil'])) ? $da['estadocivil'] : '7', 
			':direccionresidencia'=> (isset($da['direccionresidencia']) && !empty($da['direccionresidencia'])) ? $da['direccionresidencia'] : 'SD', 
			':ciudadresidencia'=> (isset($da['ciudadresidencia']) && !empty($da['ciudadresidencia'])) ? $da['ciudadresidencia'] : $sdCiudad, 
			':telefonoresidencia'=> (isset($da['telefonoresidencia']) && !empty($da['telefonoresidencia'])) ? $da['telefonoresidencia'] : '*', 
			':nombreempresa'=> (isset($da['nombreempresa']) && !empty($da['nombreempresa'])) ? $da['nombreempresa'] : 'SD', 
			':ciudadempresa'=> (isset($da['ciudadempresa']) && !empty($da['ciudadempresa'])) ? $da['ciudadempresa'] : $sdCiudad, 
			':direccionempresa'=> (isset($da['direccionempresa']) && !empty($da['direccionempresa'])) ? $da['direccionempresa'] : 'SD', 
			':nomenclatura'=> (isset($da['nomenclatura']) && !empty($da['nomenclatura'])) ? $da['nomenclatura'] : 'SD', 
			':telefonolaboral'=> (isset($da['telefonolaboral']) && !empty($da['telefonolaboral'])) ? $da['telefonolaboral'] : '*', 
			':celular'=> (isset($da['celular']) && !empty($da['celular'])) ? $da['celular'] : '*', 
			':correoelectronico'=> (isset($da['correoelectronico']) && !empty($da['correoelectronico'])) ? $da['correoelectronico'] : 'SD', 
			':cargo'=> (isset($da['cargo']) && !empty($da['cargo'])) ? $da['cargo'] : 'SD', 
			':actividadeconomicaempresa'=> (isset($da['actividadeconomicaempresa']) && !empty($da['actividadeconomicaempresa'])) ? $da['actividadeconomicaempresa'] : '4', 
			':profesion'=> (isset($da['profesion']) && !empty($da['profesion'])) ? $da['profesion'] : '900', 
			':ocupacion'=> (isset($da['ocupacion']) && !empty($da['ocupacion'])) ? $da['ocupacion'] : '900', 
			':detalleocupacion'=> (isset($da['detalleocupacion']) && !empty($da['detalleocupacion'])) ? $da['detalleocupacion'] : 'SD', 
			':ciiu'=> $da['ciiu'], 
			':ingresosmensuales'=> (isset($da['ingresosmensuales']) && !empty($da['ingresosmensuales'])) ? $da['ingresosmensuales'] : '13', 
			':otrosingresos'=> (isset($da['otrosingresos']) && !empty($da['otrosingresos'])) ? $da['otrosingresos'] : '13', 
			':egresosmensuales'=> (isset($da['egresosmensuales']) && !empty($da['egresosmensuales'])) ? $da['egresosmensuales'] : '13', 
			':conceptosotrosingresos'=> (isset($da['conceptosotrosingresos']) && !empty($da['conceptosotrosingresos'])) ? $da['conceptosotrosingresos'] : 'SD', 
			':tipoactividad'=> (isset($da['tipoactividad']) && !empty($da['tipoactividad'])) ? $da['tipoactividad'] : '900', 
			':detalletipoactividad'=> (isset($da['detalletipoactividad']) && !empty($da['detalletipoactividad'])) ? $da['detalletipoactividad'] : 'SD', 
			':nivelestudios'=> (isset($da['nivelestudios']) && !empty($da['nivelestudios'])) ? $da['nivelestudios'] : '6', 
			':tipovivienda'=> (isset($da['tipovivienda']) && !empty($da['tipovivienda'])) ? $da['tipovivienda'] : '5', 
			':estrato'=> (isset($da['estrato']) && !empty($da['estrato'])) ? $da['estrato'] : 'SD', 
			':totalactivos'=> (isset($da['totalactivos']) && !empty($da['totalactivos'])) ? $da['totalactivos'] : '*', 
			':totalpasivos'=> (isset($da['totalpasivos']) && !empty($da['totalpasivos'])) ? $da['totalpasivos'] : '*', 
			':razonsocial'=> (isset($da['razonsocial']) && !empty($da['razonsocial'])) ? $da['razonsocial'] : 'SD', 
			':nit'=> (isset($da['nit']) && !empty($da['nit'])) ? $da['nit'] : '*', 
			':digitochequeo'=> (isset($da['digitochequeo']) && !empty($da['digitochequeo']) && $da['digitochequeo'] != '*') ? $da['digitochequeo'] : '0', 
			':ciudadoficina'=> (isset($da['ciudadoficina']) && !empty($da['ciudadoficina'])) ? $da['ciudadoficina'] : '99999', 
			':direccionoficinappal'=> (isset($da['direccionoficinappal']) && !empty($da['direccionoficinappal'])) ? $da['direccionoficinappal'] : 'SD', 
			':nomenclatura_emp'=> (isset($da['nomenclatura_emp']) && !empty($da['nomenclatura_emp'])) ? $da['nomenclatura_emp'] : 'SD', 
			':telefonoficina'=> (isset($da['telefonoficina']) && !empty($da['telefonoficina'])) ? $da['telefonoficina'] : '*', 
			':faxoficina'=> (isset($da['faxoficina']) && !empty($da['faxoficina'])) ? $da['faxoficina'] : '*', 
			':celularoficina'=> (isset($da['celularoficina']) && !empty($da['celularoficina'])) ? $da['celularoficina'] : '*', 
			':ciudadsucursal'=> (isset($da['ciudadsucursal']) && !empty($da['ciudadsucursal'])) ? $da['ciudadsucursal'] : $sdCiudad, 
			':direccionsucursal'=> (isset($da['direccionsucursal']) && !empty($da['direccionsucursal'])) ? $da['direccionsucursal'] : 'SD', 
			':nomenclatura_emp2'=> (isset($da['nomenclatura_emp2']) && !empty($da['nomenclatura_emp2'])) ? $da['nomenclatura_emp2'] : 'SD', 
			':telefonosucursal'=> (isset($da['telefonosucursal']) && !empty($da['telefonosucursal'])) ? $da['telefonosucursal'] : '*', 
			':faxsucursal'=> (isset($da['faxsucursal']) && !empty($da['faxsucursal'])) ? $da['faxsucursal'] : '*', 
			':actividadeconomicappal'=> (isset($da['actividadeconomicappal']) && !empty($da['actividadeconomicappal'])) ? $da['actividadeconomicappal'] : '900', 
			':detalleactividadeconomicappal'=> (isset($da['detalleactividadeconomicappal']) && !empty($da['detalleactividadeconomicappal'])) ? $da['detalleactividadeconomicappal'] : 'SD', 
			':tipoempresaemp'=> (isset($da['tipoempresaemp']) && !empty($da['tipoempresaemp'])) ? $da['tipoempresaemp'] : '4', 
			':activosemp'=> (isset($da['activosemp']) && !empty($da['activosemp'])) ? $da['activosemp'] : '*', 
			':pasivosemp'=> (isset($da['pasivosemp']) && !empty($da['pasivosemp'])) ? $da['pasivosemp'] : '*', 
			':ingresosmensualesemp'=> (isset($da['ingresosmensualesemp']) && !empty($da['ingresosmensualesemp'])) ? $da['ingresosmensualesemp'] : '7', 
			':egresosmensualesemp'=> (isset($da['egresosmensualesemp']) && !empty($da['egresosmensualesemp'])) ? $da['egresosmensualesemp'] : '7', 
			':otrosingresosemp'=> (isset($da['otrosingresosemp']) && !empty($da['otrosingresosemp'])) ? $da['otrosingresosemp'] : '13', 
			':concepto_otrosingresosemp'=> (isset($da['concepto_otrosingresosemp']) && !empty($da['concepto_otrosingresosemp'])) ? $da['concepto_otrosingresosemp'] : 'SD', 
			':monedaextranjera'=> $da['monedaextranjera'], 
			':tipotransacciones'=> $da['tipotransacciones'], 
			':productos_exterior'=> (isset($da['productos_exterior']) && $da['productos_exterior'] != '') ? $da['productos_exterior'] : '2', 
			':cuentas_monedaextranjera'=> (isset($da['cuentas_monedaextranjera']) && $da['cuentas_monedaextranjera'] != '') ? $da['cuentas_monedaextranjera'] : '2', 
			':firma'=> $da['firma'], 
			':huella'=> $da['huella'], 
			':lugarentrevista'=> $da['lugarentrevista'], 
			':fechaentrevista'=> (isset($da['fechaentrevista']) && $da['fechaentrevista'] != '') ? $da['fechaentrevista'] : '0000-00-00', 
			':horaentrevista'=> (isset($da['horaentrevista']) && $da['horaentrevista'] != '') ? $da['horaentrevista'] : '00:00:00', 
			':tipohoraentrevista'=> (isset($da['tipohoraentrevista']) && $da['tipohoraentrevista'] != '') ? $da['tipohoraentrevista'] : 'SD', 
			':resultadoentrevista'=> $da['resultadoentrevista'], 
			':observacionesentrevista'=> $da['observacionesentrevista'], 
			':nombreintermediario'=> $da['nombreintermediario'], 
			':socio1'=> (isset($da['socio1']) && !empty($da['socio1'])) ? $da['socio1'] : '*', 
			':socio2'=> (isset($da['socio2']) && !empty($da['socio2'])) ? $da['socio2'] : '*', 
			':socio3'=> (isset($da['socio3']) && !empty($da['socio3'])) ? $da['socio3'] : '*', 
			':ciudad'=> (isset($da['ciudad']) && !empty($da['ciudad'])) ? $da['ciudad'] : '99999', 
			':tipo_solicitud'=> (isset($da['tipo_solicitud']) && !empty($da['tipo_solicitud'])) ? $da['tipo_solicitud'] : 'SD', 
			':cual_clasecliente'=> (isset($da['cual_clasecliente']) && !empty($da['cual_clasecliente'])) ? $da['cual_clasecliente'] : 'SD', 
			':celularoficinappal'=> (isset($da['celularoficinappal']) && !empty($da['celularoficinappal'])) ? $da['celularoficinappal'] : '*', 
			':tipoempresaemp_cual'=> (isset($da['tipoempresaemp_cual']) && !empty($da['tipoempresaemp_cual'])) ? $da['tipoempresaemp_cual'] : 'SD', 
			':recursos_publicos'=> (isset($da['recursos_publicos']) && $da['recursos_publicos'] != '') ? $da['recursos_publicos'] : '2', 
			':poder_publico'=> (isset($da['poder_publico']) && $da['poder_publico'] != '') ? $da['poder_publico'] : '2', 
			':reconocimiento_publico'=> (isset($da['reconocimiento_publico']) && $da['reconocimiento_publico'] != '') ? $da['reconocimiento_publico'] : '2', 
			':reconocimiento_cual'=> (isset($da['reconocimiento_cual']) && !empty($da['reconocimiento_cual'])) ? $da['reconocimiento_cual'] : 'SD', 
			':servidor_publico'=> (isset($da['servidor_publico']) && $da['servidor_publico'] != '') ? $da['servidor_publico'] : '2', 
			':expuesta_politica'=> (isset($da['expuesta_politica']) && $da['expuesta_politica'] != '') ? $da['expuesta_politica'] : '2', 
			':cargo_politica'=> (isset($da['cargo_politica']) && !empty($da['cargo_politica'])) ? $da['cargo_politica'] : 'SD', 
			':cargo_politica_ini'=> (isset($da['cargo_politica_ini']) && !empty($da['cargo_politica_ini'])) ? $da['cargo_politica_ini'] : '0000-00-00', 
			':cargo_politica_fin'=> (isset($da['cargo_politica_fin']) && !empty($da['cargo_politica_fin'])) ? $da['cargo_politica_fin'] : '0000-00-00', 
			':expuesta_publica'=> (isset($da['expuesta_publica']) && $da['expuesta_publica'] != '') ? $da['expuesta_publica'] : '2', 
			':publica_nombre'=> (isset($da['publica_nombre']) && !empty($da['publica_nombre'])) ? $da['publica_nombre'] : 'SD', 
			':publica_cargo'=> (isset($da['publica_cargo']) && !empty($da['publica_cargo'])) ? $da['publica_cargo'] : 'SD', 
			':repre_internacional'=> (isset($da['repre_internacional']) && $da['repre_internacional'] != '') ? $da['repre_internacional'] : '2', 
			':internacional_indique'=> (isset($da['internacional_indique']) && !empty($da['internacional_indique'])) ? $da['internacional_indique'] : 'SD', 
			':tributarias_otro_pais'=> (isset($da['tributarias_otro_pais']) && $da['tributarias_otro_pais'] != '') ? $da['tributarias_otro_pais'] : '2', 
			':tributarias_paises'=> (isset($da['tributarias_paises']) && !empty($da['tributarias_paises'])) ? $da['tributarias_paises'] : 'SD', 
			':ciiu_otro'=> (isset($da['ciiu_otro']) && !empty($da['ciiu_otro'])) ? $da['ciiu_otro'] : '0', 
			':telefonoficinappal'=> (isset($da['telefonoficinappal']) && !empty($da['telefonoficinappal'])) ? $da['telefonoficinappal'] : '*', 
			':patrimonio'=> (isset($da['patrimonio']) && $da['patrimonio'] != '' && $da['patrimonio'] != '*' && $da['patrimonio'] != 'SD') ? $da['patrimonio'] : '0', 
			':tipoempresajur'=> (isset($da['tipoempresajur']) && !empty($da['tipoempresajur'])) ? $da['tipoempresajur'] : '4', 
			':tipoempresajur_otra'=> (isset($da['tipoempresajur_otra']) && !empty($da['tipoempresajur_otra'])) ? $da['tipoempresajur_otra'] : 'SD', 
			':correoelectronico_otro'=> (isset($da['correoelectronico_otro']) && !empty($da['correoelectronico_otro'])) ? $da['correoelectronico_otro'] : 'SD', 
			':origen_fondos'=> (isset($da['origen_fondos']) && !empty($da['origen_fondos'])) ? $da['origen_fondos'] : 'SD', 
			':procedencia_fondos'=> (isset($da['procedencia_fondos']) && !empty($da['procedencia_fondos'])) ? $da['procedencia_fondos'] : 'SD', 
			':tipotransacciones_cual'=> (isset($da['tipotransacciones_cual']) && !empty($da['tipotransacciones_cual'])) ? $da['tipotransacciones_cual'] : 'SD', 
			':otras_operaciones'=> (isset($da['otras_operaciones']) && !empty($da['otras_operaciones'])) ? $da['otras_operaciones'] : 'SD', 
			':reclamaciones'=> (isset($da['reclamaciones']) && $da['reclamaciones'] != '') ? $da['reclamaciones'] : '2', 
			':clave_inter'=> (isset($da['clave_inter']) && !empty($da['clave_inter'])) ? $da['clave_inter'] : '*', 
			':firma_entrevista'=> (isset($da['firma_entrevista']) && $da['firma_entrevista'] != '') ? $da['firma_entrevista'] : '2', 
			':verificacion_ciudad'=> (isset($da['verificacion_ciudad']) && !empty($da['verificacion_ciudad'])) ? $da['verificacion_ciudad'] : '99999', 
			':verificacion_fecha'=> (isset($da['verificacion_fecha']) && !empty($da['verificacion_fecha'])) ? $da['verificacion_fecha'] : '0000-00-00', 
			':verificacion_hora'=> (isset($da['verificacion_hora']) && !empty($da['verificacion_hora'])) ? $da['verificacion_hora'] : '00:00:00', 
			':verificacion_nombre'=> (isset($da['verificacion_nombre']) && !empty($da['verificacion_nombre'])) ? $da['verificacion_nombre'] : 'SD', 
			':verificacion_observacion'=> (isset($da['verificacion_observacion']) && !empty($da['verificacion_observacion'])) ? $da['verificacion_observacion'] : 'SD', 
			':verificacion_firma'=> (isset($da['verificacion_firma']) && $da['verificacion_firma'] != '') ? $da['verificacion_firma'] : '2',
			':auto_correo'=> (isset($da['auto_correo']) && $da['auto_correo'] != '') ? $da['auto_correo'] : '2', 
			':auto_sms'=> (isset($da['auto_sms']) && $da['auto_sms'] != '') ? $da['auto_sms'] : '2',
			':producto_seguro'=> (isset($da['producto_seguro']) && !empty($da['producto_seguro'])) ? $da['producto_seguro'] : 'SD', 
			':pep_expuesto'=> (isset($da['pep_expuesto']) && !empty($da['pep_expuesto'])) ? $da['pep_expuesto'] : '2', 
			':expuesta_extrangero'=> (isset($da['expuesta_extrangero']) && $da['expuesta_extrangero'] != '') ? $da['expuesta_extrangero'] : '2', 
			':expuesta_internacional'=> (isset($da['expuesta_internacional']) && $da['expuesta_internacional'] != '') ? $da['expuesta_internacional'] : '2', 
			':conyuge_expuesto'=> (isset($da['conyuge_expuesto']) && $da['conyuge_expuesto'] != '') ? $da['conyuge_expuesto'] : '2',
			':asociado_expuesto'=> (isset($da['asociado_expuesto']) && $da['asociado_expuesto'] != '') ? $da['asociado_expuesto'] : '2', 
			':pep_familiar'=> (isset($da['pep_familiar']) && $da['pep_familiar'] != '') ? $da['pep_familiar'] : '2',
			':pep_familia_nombre'=> (isset($da['pep_familia_nombre']) && $da['pep_familia_nombre'] != '') ? $da['pep_familia_nombre'] : 'SD',
			':pep_familia_cargo'=> (isset($da['pep_familia_cargo']) && $da['pep_familia_cargo'] != '') ? $da['pep_familia_cargo'] : 'SD',
			':accionista_beneficios'=> (isset($da['accionista_beneficios']) && $da['accionista_beneficios'] != '') ? $da['accionista_beneficios'] : '2', 
			':cotiza_rnve'=> (isset($da['cotiza_rnve']) && $da['cotiza_rnve'] != '') ? $da['cotiza_rnve'] : '2', 
			':beneficiarios_diferentes'=> (isset($da['beneficiarios_diferentes']) && $da['beneficiarios_diferentes'] != '') ? $da['beneficiarios_diferentes'] : '2', 
			':beneficiarios_naturales'=> (isset($da['beneficiarios_naturales']) && $da['beneficiarios_naturales'] != '') ? $da['beneficiarios_naturales'] : '2', 
			':beneficiarios_jur'=> (isset($da['beneficiarios_jur']) && $da['beneficiarios_jur'] != '') ? $da['beneficiarios_jur'] : '2',
			':verificacion_cargo'=> (isset($da['verificacion_cargo']) && !empty($da['verificacion_cargo'])) ? $da['verificacion_cargo'] : 'SD', 
			':verificacion_documento'=> (isset($da['verificacion_documento']) && $da['verificacion_documento'] != '') ? $da['verificacion_documento'] : '0',
			':responsable_rut'=> (isset($da['responsable_rut']) && $da['responsable_rut'] != '') ? $da['responsable_rut'] : '2', 
			':codigo_rut'=> (isset($da['codigo_rut']) && $da['codigo_rut'] != '') ? $da['codigo_rut'] : 'SD',
			':tipo_norma_id'=> (isset($da['tipo_norma_id']) && $da['tipo_norma_id'] != '') ? $da['tipo_norma_id'] : '1', 
			':regimen_id'=> (isset($da['regimen_id']) && $da['regimen_id'] != '') ? $da['regimen_id'] : '2'
		);
		try{
			if($conn->ejecutar($SQL, $data)){
				$lastId = $conn->ultimaId();
				if($tipo != 2){
					$ct = array(
						'cliente_id'=> $cliente_id,
						'telefono'=> '',
						'cod_ciudad'=> "NULL",
						'ciudad'=> "NULL",
						'tipo_demografico_id'=> 1,
						'origen_id'=> 4
					);
					if(isset($data[':telefonoresidencia']) && !empty(trim($data[':telefonoresidencia'])) && trim($data[':telefonoresidencia']) != '*'){
						$ct['telefono'] = $data[':telefonoresidencia'];
						$ct['cod_ciudad'] = (isset($data[':ciudadresidencia']) && !empty(trim($data[':ciudadresidencia']))) ? trim($data[':ciudadresidencia']) : "NULL";
						$telId = self::verificarTelefono($ct);
					}
					if(isset($data[':telefonolaboral']) && !empty(trim($data[':telefonolaboral'])) && trim($data[':telefonolaboral']) != '*'){
						$ct['telefono'] = $data[':telefonolaboral'];
						$ct['cod_ciudad'] = (isset($data[':ciudadempresa']) && !empty(trim($data[':ciudadempresa']))) ? trim($data[':ciudadempresa']) : "NULL";
						$telId = self::verificarTelefono($ct);
					}
					if(isset($data[':celular']) && !empty(trim($data[':celular'])) && trim($data[':celular']) != '*'){
						$ct['telefono'] = $data[':celular'];
						$ct['cod_ciudad'] = "NULL";
						$ct['tipo_demografico_id'] = "5";
						$telId = self::verificarTelefono($ct);
					}
					if(isset($data[':telefonoficina']) && !empty(trim($data[':telefonoficina'])) && trim($data[':telefonoficina']) != '*'){
						$ct['telefono'] = $data[':telefonoficina'];
						$ct['cod_ciudad'] = (isset($data[':ciudadoficina']) && !empty(trim($data[':ciudadoficina']))) ? trim($data[':ciudadoficina']) : "NULL";
						$telId = self::verificarTelefono($ct);
					}
					if(isset($data[':celularoficina']) && !empty(trim($data[':celularoficina'])) && trim($data[':celularoficina']) != '*'){
						$ct['telefono'] = $data[':celularoficina'];
						$ct['cod_ciudad'] = "NULL";
						$ct['tipo_demografico_id'] = "5";
						$telId = self::verificarTelefono($ct);
					}
					if(isset($data[':celularoficinappal']) && !empty(trim($data[':celularoficinappal'])) && trim($data[':celularoficinappal']) != '*'){
						$ct['telefono'] = $data[':celularoficinappal'];
						$ct['cod_ciudad'] = "NULL";
						$ct['tipo_demografico_id'] = "5";
						$telId = self::verificarTelefono($ct);
					}
					if(isset($data[':telefonoficinappal']) && !empty(trim($data[':telefonoficinappal'])) && trim($data[':telefonoficinappal']) != '*'){
						$ct['telefono'] = $data[':telefonoficinappal'];
						$ct['cod_ciudad'] = (isset($data[':ciudadoficina']) && !empty(trim($data[':ciudadoficina']))) ? trim($data[':ciudadoficina']) : "NULL";
						$telId = self::verificarTelefono($ct);
					}
					$cd = array(
						'cliente_id'=> $cliente_id,
						'direccion'=> '',
						'cod_ciudad'=> "NULL",
						'ciudad'=> "NULL",
						'tipo_demografico_id'=> 2,
						'origen_id'=> 4
					);
					if(isset($data[':direccionresidencia']) && !empty($data[':direccionresidencia']) && strlen($data[':direccionresidencia']) > 1 && strtoupper(trim($data[':direccionresidencia'])) != 'SD' && strtoupper(trim($data[':direccionresidencia'])) != 'NA' && strtoupper(trim($data[':direccionresidencia'])) != 'N/A'){
						$cd['direccion'] = $data[':direccionresidencia'];
						$cd['cod_ciudad'] = (isset($data[':ciudadresidencia']) && !empty(trim($data[':ciudadresidencia']))) ? trim($data[':ciudadresidencia']) : "NULL";
						$ciuId = self::verificarDireccion($cd);
					}
					if(isset($data[':direccionempresa']) && !empty($data[':direccionempresa']) && strlen($data[':direccionempresa']) > 1 && strtoupper(trim($data[':direccionempresa'])) != 'SD' && strtoupper(trim($data[':direccionempresa'])) != 'NA' && strtoupper(trim($data[':direccionempresa'])) != 'N/A'){
						$cd['direccion'] = $data[':direccionempresa'];
						$cd['cod_ciudad'] = (isset($data[':ciudadempresa']) && !empty(trim($data[':ciudadempresa']))) ? trim($data[':ciudadempresa']) : "NULL";
						$ciuId = self::verificarDireccion($cd);
					}
					if(isset($data[':direccionoficinappal']) && !empty($data[':direccionoficinappal']) && strlen($data[':direccionoficinappal']) > 1 && strtoupper(trim($data[':direccionoficinappal'])) != 'SD' && strtoupper(trim($data[':direccionoficinappal'])) != 'NA' && strtoupper(trim($data[':direccionoficinappal'])) != 'N/A'){
						$cd['direccion'] = $data[':direccionoficinappal'];
						$cd['cod_ciudad'] = (isset($data[':ciudadoficina']) && !empty(trim($data[':ciudadoficina']))) ? trim($data[':ciudadoficina']) : "NULL";
						$ciuId = self::verificarDireccion($cd);
					}
					if(isset($data[':direccionsucursal']) && !empty($data[':direccionsucursal']) && strlen($data[':direccionsucursal']) > 1 && strtoupper(trim($data[':direccionsucursal'])) != 'SD' && strtoupper(trim($data[':direccionsucursal'])) != 'NA' && strtoupper(trim($data[':direccionsucursal'])) != 'N/A'){
						$cd['direccion'] = $data[':direccionsucursal'];
						$cd['cod_ciudad'] = "NULL";
						$ciuId = self::verificarDireccion($cd);
					}
					if(isset($data[':correoelectronico']) && !empty(trim($data[':correoelectronico'])) && trim($data[':correoelectronico']) != 'NULL' && strtoupper(trim($data[':correoelectronico'])) != 'SD' && strtoupper(trim($data[':correoelectronico'])) != 'NA' && strtoupper(trim($data[':correoelectronico'])) != 'N/A'){
						$cd['direccion'] = $data[':correoelectronico'];
						$cd['ciudad'] = "NULL";
						$cd['tipo_demografico_id'] = "5";
						$ciuId = self::verificarDireccion($cd);
					}
					if(isset($data[':correoelectronico_otro']) && !empty(trim($data[':correoelectronico_otro'])) && trim($data[':correoelectronico_otro']) != 'NULL' && strtoupper(trim($data[':correoelectronico_otro'])) != 'SD' && strtoupper(trim($data[':correoelectronico_otro'])) != 'NA' && strtoupper(trim($data[':correoelectronico_otro'])) != 'N/A'){
						$cd['direccion'] = $data[':correoelectronico_otro'];
						$cd['ciudad'] = "NULL";
						$cd['tipo_demografico_id'] = "5";
						$ciuId = self::verificarDireccion($cd);
					}
				}
				return $lastId;
			}else{
				return false;
			}
		}catch(\Exception $e){
			throw new \Exception("Ocurrio un error(Exception):".$e->getMessage(), (int)$e->getCode());
		}
	}
	public static function cambiarEstadoDevolucion($documento, $persontype){
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM workflow 
				 WHERE documento = :documento 
				   AND persontype = :persontype";
		if($conn->consultar($SQL, array(':documento'=> $documento, ':persontype'=> $persontype))){
			if($conn->getNumeroRegistros() > 0){
				$conn->ejecutar("UPDATE workflow SET estado = :estado WHERE documento = :documento AND persontype = :persontype", array(':estado'=> '1', ':documento'=> $documento, ':persontype'=> $persontype));
				$conn->desconectar();
				return true;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function addIndexacion($id_form, $id_user){
		$conn = new Conexion();
		$SQL = "INSERT INTO indexacion_log
				(
					id_form, id_user
				) 
				VALUES
				(
					:id_form, :id_user
				)";
		if($conn->ejecutar($SQL, array(':id_form'=> $id_form, ':id_user'=> $id_user))){
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function verificarTelefono($dato, $tipo = 1, $conn = null){
		if($conn === null)
			$conn = new Conexion();
		$tabla = "telefono";
		if($tipo == 2)
			$tabla = "telefono_";
		$SQL = "SELECT id 
				  FROM $tabla 
				 WHERE cliente_id = :cliente_id
				   AND telefono = :telefono";
		if($conn->consultar($SQL, array(':cliente_id'=> $dato['cliente_id'], ':telefono'=> trim($dato['telefono'])))){
			$cantReg = $conn->getNumeroRegistros();
			if($cantReg >= 1){
				$da = $conn->sacarRegistro('str');
				return $da['id'];
			}else{
				$SQU = "INSERT INTO $tabla 
						(
							cliente_id, telefono, cod_ciudad, ciudad, tipo_demografico_id, origen_id
						) 
						VALUES 
						(
							:cliente_id, :telefono, :cod_ciudad, :ciudad, :tipo_demografico_id, :origen_id
						)";
				$data = array(
					':cliente_id'=> $dato['cliente_id'],
					':telefono'=> trim($dato['telefono']),
					':cod_ciudad'=> trim($dato['cod_ciudad']),
					':ciudad'=> trim($dato['ciudad']),
					':tipo_demografico_id'=> $dato['tipo_demografico_id'],
					':origen_id'=> $dato['origen_id']
				);
				try{
					if($conn->ejecutar($SQU, $data)){
						$ultimaId = $conn->ultimaId();
						return $ultimaId;
					}else{
						return false;
					}
				}catch(PDOException $Exception){
					$SQU = "INSERT INTO telefono_excepcion(excepcion, error, codigo, datos) VALUES (:excepcion, :error, :codigo, :datos)";
					$conn->ejecutar($SQU, array(':excepcion'=> 'PDOException', ':error'=> $Exception->getMessage(), ':codigo'=> $Exception->getCode(), ':datos'=> json_encode($data)));
					//throw new PDOException($Exception->getMessage(), (int)$Exception->getCode());
				}catch(Exception $e){
					$SQU = "INSERT INTO telefono_excepcion(excepcion, error, codigo, datos) VALUES (:excepcion, :error, :codigo, :datos)";
					$conn->ejecutar($SQU, array(':excepcion'=> 'Exception', ':error'=> $e->getMessage(), ':codigo'=> $e->getCode(), ':datos'=> json_encode($data)));
					//throw new Exception($e->getMessage(), (int)$e->getCode());
				}
			}
		}
	}
	public static function verificarDireccion($dato, $tipo = 1, $conn = null){
		if($conn === null)
			$conn = new Conexion();
		$tabla = "direccion";
		if($tipo == 2)
			$tabla = "direccion_";
		$SQL = "SELECT id 
				  FROM $tabla 
				 WHERE cliente_id = :cliente_id
				   AND direccion = :direccion";
		if($conn->consultar($SQL, array(':cliente_id'=> $dato['cliente_id'], ':direccion'=> trim($dato['direccion'])))){
			$cantReg = $conn->getNumeroRegistros();
			if($cantReg >= 1){
				$da = $conn->sacarRegistro('str');
				return $da['id'];
			}else{
				$SQU = "INSERT INTO $tabla 
						(
							cliente_id, direccion, cod_ciudad, ciudad, tipo_demografico_id, origen_id
						) 
						VALUES 
						(
							:cliente_id, :direccion, :cod_ciudad, :ciudad, :tipo_demografico_id, :origen_id
						)";
				$data = array(
					':cliente_id'=> $dato['cliente_id'],
					':direccion'=> trim($dato['direccion']),
					':cod_ciudad'=> trim($dato['cod_ciudad']),
					':ciudad'=> trim($dato['ciudad']),
					':tipo_demografico_id'=> $dato['tipo_demografico_id'],
					':origen_id'=> $dato['origen_id']
				);
				try{
					if($conn->ejecutar($SQU, $data)){
						$ultimaId = $conn->ultimaId();
						return $ultimaId;
					}else{
						return false;
					}
				}catch(PDOException $Exception){
					$SQU = "INSERT INTO direccion_exception(excepcion, error, codigo, datos) VALUES (:excepcion, :error, :codigo, :datos)";
					$conn->ejecutar($SQU, array(':excepcion'=> 'PDOException', ':error'=> $Exception->getMessage(), ':codigo'=> $Exception->getCode(), ':datos'=> json_encode($data)));
					//throw new PDOException($Exception->getMessage(), (int)$Exception->getCode());
				}catch(Exception $e){
					$SQU = "INSERT INTO direccion_exception(excepcion, error, codigo, datos) VALUES (:excepcion, :error, :codigo, :datos)";
					$conn->ejecutar($SQU, array(':excepcion'=> 'Exception', ':error'=> $e->getMessage(), ':codigo'=> $e->getCode(), ':datos'=> json_encode($data)));
					//throw new Exception($e->getMessage(), (int)$e->getCode());
				}
			}
		}
	}
	public static function insertarFormAutos($dat, $form_id){
		$conn = new Conexion();
		$SQL = "INSERT INTO data_renovacion_autos
				(
					razon_social, tipo_doc, documento, ocupacion, ocupacion_detalle, ciudad, 
					direccion, telefono, email, fecha_diligenciamiento, numero_poliza, nombres, 
					p_apellido, s_apellido, ndicativo_doc, lote, planilla, id_usuario, id_fomulario
				) 
				VALUES 
				(
					:razon_social, :tipo_doc, :documento, :ocupacion, :ocupacion_detalle, :ciudad, 
					:direccion, :telefono, :email, :fecha_diligenciamiento, :numero_poliza, :nombres, 
					:p_apellido, :s_apellido, :ndicativo_doc, :lote, :planilla, :id_usuario, :id_fomulario
				)";
		$data = array(
			':razon_social'=> (isset($dat['razonsocial']) && !empty($dat['razonsocial'])) ? strtoupper($dat['razonsocial']) : 'NULL',
			':tipo_doc'=> $dat['grupodoc'],
			':documento'=> $dat['numero'],
			':ocupacion'=> ($dat['grupodoc'] == '7') ? $dat['actecono'] : $dat['ocupacti'],
			':ocupacion_detalle'=> strtoupper($dat['detalle']),
			':ciudad'=> $dat['ciudad'],
			':direccion'=> strtoupper($dat['direccion']),
			':telefono'=> $dat['telefono'],
			':email'=> strtoupper($dat['email']),
			':fecha_diligenciamiento'=> $dat['fechasolicitud'],
			':numero_poliza'=> $dat['npoliza'],
			':nombres'=> (isset($dat['txtnombres']) && !empty($dat['txtnombres'])) ? strtoupper($dat['txtnombres']) : 'NULL',
			':p_apellido'=> (isset($dat['txtpapellido']) && !empty($dat['txtpapellido'])) ? strtoupper($dat['txtpapellido']) : 'NULL',
			':s_apellido'=> (isset($dat['txtsapellido']) && !empty($dat['txtsapellido'])) ? strtoupper($dat['txtsapellido']) : 'NULL',
			':ndicativo_doc'=> (isset($dat['numero_']) && !empty($dat['numero_'])) ? $dat['numero_'] : 'NULL',
			':lote'=> substr($dat['lote'], 5, strlen($dat['lote'])),
			':planilla'=> substr($dat['planilla'], 8, strlen($dat['planilla'])),
			':id_usuario'=> $_SESSION['id'],
			':id_fomulario'=> $form_id
		);
		if($conn->ejecutar($SQL, $data)){
			$lastId = $conn->ultimaId();
			$conn->desconectar();
			return array('exito'=> 'La insercion de la data de renovacion fue satisfactoria.', 'id_data_renovacion'=> $lastId);
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al momento de insertar la data de renovacion, contacte con el administrador.');
		}
	}
	public static function actualizarData($dat, $form_id){
		$conn = new Conexion();
		$data = array(
			':direccionresidencia'=> strtoupper($dat['direccion']), 
			':ciudadresidencia'=> $dat['ciudad'], 
			':telefonoresidencia'=> $dat['telefono'], 
			':estado_autos'=> 3, 
			':id_form'=> $form_id
		);
		if($dat['grupodoc'] == '7'){
			$SQL = "UPDATE data 
					   SET direccionresidencia = :direccionresidencia, 
					   	   ciudadresidencia = :ciudadresidencia, 
					   	   telefonoresidencia = :telefonoresidencia, 
					   	   actividadeconomicappal = :actividadeconomicappal, 
					   	   detalleactividadeconomicappal = :detalleactividadeconomicappal, 
					   	   razonsocial = :razonsocial, 
					   	   nit = :nit, 
					   	   digitochequeo = :digitochequeo, 
					   	   estado_autos = :estado_autos
					 WHERE id_form = :id_form";
			$data[':actividadeconomicappal'] = $dat['actecono'];
			$data[':detalleactividadeconomicappal'] = strtoupper($dat['detalle']);
			$data[':razonsocial'] = $dat['razonsocial'];
			$data[':nit'] = $dat['numero'];
			$data[':digitochequeo'] = $dat['numero_'];
		}else{
			$SQL = "UPDATE data 
					   SET primerapellido = :primerapellido, 
					   	   segundoapellido = :segundoapellido, 
					   	   nombres = :nombres, 
					   	   tipodocumento = :tipodocumento, 
					   	   documento = :documento, 
					   	   direccionresidencia = :direccionresidencia, 
					   	   ciudadresidencia = :ciudadresidencia, 
					   	   telefonoresidencia = :telefonoresidencia, 
					   	   ocupacion = :ocupacion, 
					   	   detalleocupacion = :detalleocupacion, 
					   	   estado_autos = :estado_autos 
					 WHERE id_form = :id_form";
			$data[':primerapellido'] = $dat['txtpapellido'];
			$data[':segundoapellido'] = $dat['txtsapellido'];
			$data[':nombres'] = $dat['txtnombres'];
			$data[':tipodocumento'] = $dat['grupodoc'];
			$data[':documento'] = $dat['numero'];
			$data[':ocupacion'] = $dat['ocupacti'];
			$data[':detalleocupacion'] = strtoupper($dat['detalle']);
		}
		if($conn->ejecutar($SQL, $data)){
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function actualizarItemRadicadoComplementaria($documento, $lote, $especial){
		$conn = new Conexion();
		$SQL = "UPDATE radicados_items
				   SET documento_especial = :documento_especial
				 WHERE documento = :documento
				   AND id_radicados = :id_radicados";
		if($conn->ejecutar($SQL, array(':documento_especial'=> $especial, ':documento'=> $documento, ':id_radicados'=> substr($lote, 5, strlen($lote))))){
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function guardarPlanillaLote($planillaLote, $logLote, $userId){
		$conn = new Conexion();
		$plPart = explode('_', $planillaLote);
		$planilla = 0;
		if(count($plPart) >= 3)
			$planilla = substr($plPart[0], 8);
		$lote = substr($logLote, 5);

		$SQL = "SELECT COUNT('x') AS cantidad
				  FROM planilla 
				 WHERE planilla = :planilla 
				   AND lote = :lote
				   AND description = :description";
		if($conn->consultar($SQL, array(':planilla'=> $planilla, ':lote'=> $lote, ':description'=> 'PLANILLA_LOTE'))){
			$cantReg = $conn->getNumeroRegistros();
			if($cantReg == 1){
				$da = $conn->sacarRegistro('str');
				if(intval($da['cantidad']) == 0){
					$SQU = "INSERT INTO planilla 
							(
								planilla, lote, directory, filename, description
							) 
							VALUES
							(
								:planilla, :lote, :directory, :filename, :description
							)";
					$datu = array(
						':planilla'=> $planilla, 
						':lote'=> $lote, 
						':directory'=> 'planillas', 
						':filename'=> $planillaLote, 
						':description'=> 'PLANILLA_LOTE'
					);
					if($conn->ejecutar($SQU, $datu)){
						$pathUser = '/var/www/html/Aplicativos.Serverfin04/Colpatria/tmp_images';
						$pathPlanillas = '/var/www/html/Aplicativos.Serverfin04/planillas_colpatria';
						if(!file_exists($pathPlanillas.'/'.$planillaLote))
							copy($pathUser.'/'.$userId.'/'.$planillaLote, $pathPlanillas.'/'.$planillaLote);
					}
				}
			}
		}
    }
	public static function insertCuentas($data_id, $producto_tipo, $producto_identificacion, $producto_entidad, $producto_monto, $producto_ciudad, $producto_pais, $producto_moneda){
		$conn = new Conexion();
		$SQL = "INSERT INTO data_productos
				(
					data_id, tipo, identificacion_producto, entidad, monto, pais, ciudad, moneda
				) 
				VALUES 
				(
					:data_id, :producto_tipo, :producto_identificacion, :producto_entidad, :producto_monto, :producto_ciudad, :producto_pais, :producto_moneda
				)";
		$data = array(
			':data_id'=> $data_id,
			':producto_tipo'=> $producto_tipo,
			':producto_identificacion'=> $producto_identificacion,
			':producto_entidad'=> $producto_entidad,
			':producto_monto'=> ((isset($producto_monto) && $producto_monto != '' && $producto_monto != '*') ? $producto_monto : "NULL"),
			':producto_ciudad'=> $producto_ciudad,
			':producto_pais'=> $producto_pais,
			':producto_moneda'=> $producto_moneda
		);
		if($conn->ejecutar($SQL, $data)){
			$lastId = $conn->ultimaId();
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function insertReclamaciones($data_id, $rec_ano, $rec_ramo, $rec_compania, $rec_valor, $rec_resultado){
		$conn = new Conexion();
		$SQL = "INSERT INTO data_reclamaciones 
				(
					data_id, rec_ano, rec_ramo, rec_compania, rec_valor, rec_resultado
				) 
				VALUES 
				(
					:data_id, :rec_ano, :rec_ramo, :rec_compania, :rec_valor, :rec_resultado
				)";
		$data = array(
			':data_id'=> $data_id,
			':rec_ano'=> $rec_ano,
			':rec_ramo'=> $rec_ramo,
			':rec_compania'=> $rec_compania,
			':rec_valor'=> self::revisarCampoNoDato($rec_valor, 'num'),
			':rec_resultado'=> $rec_resultado
		);
		if($conn->ejecutar($SQL, $data)){
			$lastId = $conn->ultimaId();
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function insertAccionistas($data_id, $tipo_id, $identificacion, $nombre_accionista, $porcentaje, $publico_recursos, $publico_reconocimiento, $publico_expuesta, $declaracion_tributaria){
		$conn = new Conexion();
		$SQL = "INSERT INTO data_socios 
				(
					data_id, tipo_id, identificacion, nombre_accionista, porcentaje, 
					publico_recursos, publico_reconocimiento, publico_expuesta, declaracion_tributaria
				) 
				VALUES 
				(
					:data_id, :tipo_id, :identificacion, :nombre_accionista, :porcentaje, 
					:publico_recursos, :publico_reconocimiento, :publico_expuesta, :declaracion_tributaria
				)";
		$data = array(
			':data_id'=> $data_id,
			':tipo_id'=> $tipo_id,
			':identificacion'=> $identificacion,
			':nombre_accionista'=> $nombre_accionista,
			':porcentaje'=> ($porcentaje != '' && $porcentaje != '*') ? $porcentaje : 0,
			':publico_recursos'=> $publico_recursos,
			':publico_reconocimiento'=> $publico_reconocimiento,
			':publico_expuesta'=> $publico_expuesta,
			':declaracion_tributaria'=> $declaracion_tributaria
		);
		if($conn->ejecutar($SQL, $data)){
			//$lastId = $conn->ultimaId();
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function insertMiembroJunta($data_id, $ju_nombre_completo, $ju_tipodocumento_id, $ju_identificacion, $ju_expuesto_politico, $conn){
		$SQL = "INSERT INTO data_junta_directiva 
				(
					data_id, ju_nombre_completo, ju_tipodocumento_id, ju_identificacion, ju_expuesto_politico
				) 
				VALUES 
				(
					:data_id, :ju_nombre_completo, :ju_tipodocumento_id, :ju_identificacion, :ju_expuesto_politico
				)";
		$data = array(
			':data_id'=> $data_id, 
			':ju_nombre_completo'=> $ju_nombre_completo, 
			':ju_tipodocumento_id'=> $ju_tipodocumento_id, 
			':ju_identificacion'=> $ju_identificacion, 
			':ju_expuesto_politico'=> $ju_expuesto_politico
		);
		if($conn->ejecutar($SQL, $data)){
			$lastId = $conn->ultimaId();
			return true;
		}else{
			return false;
		}
	}
	public static function insertNuevoAccionista($data_id, $be_tipo, $be_razon_social, $be_nit, $be_nombre_completo, $be_tipodocumento_id, $be_identificacion, $be_fecha_expedicion, $be_expuesto_politico, $be_poliza_seguro, $conn){
		$SQL = "INSERT INTO data_beneficiarios 
				(
					data_id, be_tipo, be_razon_social, be_nit, be_nombre_completo, be_tipodocumento_id, 
					be_identificacion, be_fecha_expedicion, be_expuesto_politico, be_poliza_seguro
				) 
				VALUES 
				(
					:data_id, :be_tipo, :be_razon_social, :be_nit, :be_nombre_completo, :be_tipodocumento_id, 
					:be_identificacion, :be_fecha_expedicion, :be_expuesto_politico, :be_poliza_seguro
				)";
		$data = array(
			':data_id'=> $data_id, 
			':be_tipo'=> $be_tipo, 
			':be_razon_social'=> $be_razon_social, 
			':be_nit'=> $be_nit, 
			':be_nombre_completo'=> $be_nombre_completo, 
			':be_tipodocumento_id'=> $be_tipodocumento_id, 
			':be_identificacion'=> $be_identificacion, 
			':be_fecha_expedicion'=> $be_fecha_expedicion, 
			':be_expuesto_politico'=> $be_expuesto_politico, 
			':be_poliza_seguro'=> $be_poliza_seguro
		);
		if($conn->ejecutar($SQL, $data)){
			$lastId = $conn->ultimaId();
			return true;
		}else{
			return false;
		}
	}
	public static function insertNuevoPep($data_id, $pep_vinculo_relacion, $pep_tipo_pep, $pep_nombre_razon, $pep_tipodocumento_id, $pep_identificacion, $pep_nacionalidad_id, $pep_entidad, $pep_cargo, $pep_fecha_vinculacion, $pep_fecha_desvinculacion, $pep_cuentas_otros_paises, $conn){
		$SQL = "INSERT INTO data_peps
				(
					data_id, pep_vinculo_relacion, pep_tipo_pep, pep_nombre_razon, pep_tipodocumento_id, 
					pep_identificacion, pep_nacionalidad_id, pep_entidad, pep_cargo, pep_fecha_vinculacion, 
					pep_fecha_desvinculacion, pep_cuentas_otros_paises
				)
				VALUES
				(
					:data_id, :pep_vinculo_relacion, :pep_tipo_pep, :pep_nombre_razon, :pep_tipodocumento_id, 
					:pep_identificacion, :pep_nacionalidad_id, :pep_entidad, :pep_cargo, :pep_fecha_vinculacion, 
					:pep_fecha_desvinculacion, :pep_cuentas_otros_paises
				)";
		$data = array(
			':data_id'=> $data_id, 
			':pep_vinculo_relacion'=> $pep_vinculo_relacion, 
			':pep_tipo_pep'=> $pep_tipo_pep, 
			':pep_nombre_razon'=> $pep_nombre_razon, 
			':pep_tipodocumento_id'=> $pep_tipodocumento_id, 
			':pep_identificacion'=> $pep_identificacion, 
			':pep_nacionalidad_id'=> $pep_nacionalidad_id, 
			':pep_entidad'=> $pep_entidad, 
			':pep_cargo'=> $pep_cargo, 
			':pep_fecha_vinculacion'=> $pep_fecha_vinculacion, 
			':pep_fecha_desvinculacion'=> $pep_fecha_desvinculacion, 
			':pep_cuentas_otros_paises'=> $pep_cuentas_otros_paises
		);
		if($conn->ejecutar($SQL, $data)){
			$lastId = $conn->ultimaId();
			return true;
		}else{
			return false;
		}
	}
	public static function desactivarPlanillas($usuario_id){
		$conn = new Conexion();
		$SQL = "UPDATE image_tmp 
				   SET status = :status 
				 WHERE directory = :directory
				   AND filename LIKE :filename";
		if($conn->ejecutar($SQL, array(':status'=> '2', ':directory'=> $usuario_id, ':filename'=> 'PLANILLA%'))){
			$conn->desconectar();
			return array('exito'=> 'La planilla se desactivo correctamente, se archivo la planilla.');
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al momento de desactivar la planilla, contacte con el administrador.');
		}
	}
	public static function numeroPlanillasActivas(){
		$conn = new Conexion();
		$SQL = "SELECT COUNT('x') as total 
				  FROM image_tmp 
				 WHERE filename LIKE :filename 
				   AND directory = :directory
				   AND status = :status";
		if($conn->consultar($SQL, array(':filename'=> 'PLANILLA%', ':directory'=> $_SESSION['id'], ':status'=> 1))){
			if($conn->getNumeroRegistros() == 1){
				$dat = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $dat;
			}else{
				$conn->desconectar();
				return false;
			}
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function revisarCampoNoDato($dato, $tipo){
		if($tipo == 'str'){
			if($dato == 'ND')
				return 'NULL';
			else
				return $dato;
		}elseif($tipo == 'num'){
			if($dato == '*')
				return 'NULL';
			else
				return $dato;
		}else
			return $dato;
	}
	public static function editarDataFormulario($dat){
		$conn = new Conexion();
		$i = 0;
		$upd = "";
		$daArray = array();
		foreach($dat as $key => $value){
			if($key != 'domain' && $key != 'action' && $key != 'meth' && $key != 'respOut' && $key != 'id_form' && $key != 'type_person' && $key != 'id_data'){
				if($i == 0){
					$upd = $key." = :".$key;
					$daArray[':'.$key] = (trim($value) != '') ? strtoupper(trim($value)) : 'NULL';
				}else{
					$upd .= ", ".$key." = :".$key;
					$daArray[':'.$key] = (trim($value) != '') ? strtoupper(trim($value)) : 'NULL';
				}
				$i++;
			}
		}
		if(!empty($daArray) && (isset($dat['id_data']) && !empty($dat['id_data'])))
			$daArray[':id_data'] = $dat['id_data'];

		if(!empty($daArray)){
			$SQL = "UPDATE data
					   SET $upd
					 WHERE id = :id_data";
			try{
				if($conn->ejecutar($SQL, $daArray)){
					$conn->desconectar();
					return array("exito"=> "La data del cliente fue actualizado con exito.");
				}else{
					$conn->desconectar();
					return array("error"=>"No se pudo actualizar la data.");
				}
			}catch(Exception $e){
				throw new Exception("Ocurrio un error(Exception):".$e->getMessage(), (int)$e->getCode());
			}
		}else{
			$conn->desconectar();
			return array("error"=>"No se encontraron datos para actualizar la data del cliente.");
		}
	}
	public static function agregarEvidenciaItemRadicado($item_id, $resultado, $documento, $file)
	{
		$conn = new Conexion();
		$SQL = "INSERT INTO `radicado_item_evidencias` 
				(
					`radicado_item_id`, `resultado`, `archivo`, `directorio`
				) 
				VALUES 
				(
					:radicado_item_id, :resultado, :archivo, :directorio
				)";
		$resp = $conn->ejecutar($SQL, [':radicado_item_id'=> $item_id, ':resultado'=> $resultado, ':archivo'=> $file, ':directorio'=> "/evidencias/" . $documento]);
		$conn->desconectar();
		return $resp;
	}
	/*public static function updateNewNatural($id_data, $da){
		$conn = new Conexion();
		$SQL = "UPDATE data 
				   SET fecharadicado = :fecharadicado
					   fechasolicitud = :fechasolicitud
					   ciudad = :ciudad
					   sucursal = :sucursal
					   area = :area
					   id_official = :id_official
					   tipo_solicitud = :tipo_solicitud
					   clasecliente = :clasecliente
					   cual_clasecliente = :cual_clasecliente
					   primerapellido = :primerapellido
					   segundoapellido = :segundoapellido
					   nombres = :nombres
					   tipodocumento = :tipodocumento
					   fechaexpedicion = :fechaexpedicion
					   lugarexpedicion = :lugarexpedicion
					   fechanacimiento = :fechanacimiento
					   lugarnacimiento = :lugarnacimiento
					   paisnacimiento = :paisnacimiento
					   nacionalidad_otra = :nacionalidad_otra
					   direccionresidencia = :direccionresidencia
					   ciudadresidencia = :ciudadresidencia
					   correoelectronico = :correoelectronico
					   telefonoresidencia = :telefonoresidencia
					   celular = :celular
					   nombreempresa = :nombreempresa
					   direccionempresa = :direccionempresa
					   telefonolaboral = :telefonolaboral
					   ciudadempresa = :ciudadempresa
					   celularoficinappal = :celularoficinappal
					   tipoempresaemp = :tipoempresaemp
					   tipoempresaemp_cual = :tipoempresaemp_cual
					   recursos_publicos = :recursos_publicos
					   poder_publico = :poder_publico
					   reconocimiento_publico = :reconocimiento_publico
					   reconocimiento_cual = :reconocimiento_cual
					   servidor_publico = :servidor_publico
					   expuesta_politica = :expuesta_politica
					   cargo_politica = :cargo_politica
					   cargo_politica_ini = :cargo_politica_ini
					   cargo_politica_fin = :cargo_politica_fin
					   expuesta_publica = :expuesta_publica
					   publica_nombre = :publica_nombre
					   publica_cargo = :publica_cargo
					   repre_internacional = :repre_internacional
					   internacional_indique = :internacional_indique
					   tributarias_otro_pais = :tributarias_otro_pais
					   tributarias_paises = :tributarias_paises
					   tipoactividad = :tipoactividad
					   ciiu = :ciiu
					   profesion = :profesion
					   cargo = :cargo
					   actividadeconomicaempresa = :actividadeconomicaempresa
					   ciiu_otro = :ciiu_otro
					   direccionoficinappal = :direccionoficinappal
					   telefonoficinappal = :telefonoficinappal
					   detalletipoactividad = :detalletipoactividad
					   ingresosmensuales = :ingresosmensuales
					   totalactivos = :totalactivos
					   totalpasivos = :totalpasivos
					   egresosmensuales = :egresosmensuales
					   patrimonio = :patrimonio
					   otrosingresos = :otrosingresos
					   conceptosotrosingresos = :conceptosotrosingresos
					   origen_fondos = :origen_fondos
					   procedencia_fondos = :procedencia_fondos
					   monedaextranjera = :monedaextranjera
					   tipotransacciones = :tipotransacciones
					   tipotransacciones_cual = :tipotransacciones_cual
					   otras_operaciones = :otras_operaciones
					   productos_exterior = :productos_exterior
					   cuentas_monedaextranjera = :cuentas_monedaextranjera
					   reclamaciones = :reclamaciones
					   firma = :firma
					   huella = :huella
					   lugarentrevista = :lugarentrevista
					   resultadoentrevista = :resultadoentrevista
					   fechaentrevista = :fechaentrevista
					   horaentrevista = :horaentrevista
					   observacionesentrevista = :observacionesentrevista
					   nombreintermediario = :nombreintermediario
					   clave_inter = :clave_inter
					   firma_entrevista = :firma_entrevista
					   verificacion_ciudad = :verificacion_ciudad
					   verificacion_fecha = :verificacion_fecha
					   verificacion_hora = :verificacion_hora
					   verificacion_nombre = :verificacion_nombre
					   verificacion_nombre = :verificacion_nombre
					   verificacion_observacion = :verificacion_observacion
					   verificacion_firma = :verificacion_firma
					   verificacion_observacion = :verificacion_observacion
					   verificacion_firma = :verificacion_firma
				 WHERE id = :id_data";
		$data = array(
			':fecharadicado'=> ,
			':fechasolicitud'=> ,
			':ciudad'=> ,
			':sucursal'=> ,
			':area'=> ,
			':id_official'=> ,
			':tipo_solicitud'=> ,
			':clasecliente'=> ,
			':cual_clasecliente'=> ,
			':primerapellido'=> ,
			':segundoapellido'=> ,
			':nombres'=> ,
			':tipodocumento'=> ,
			':fechaexpedicion'=> ,
			':lugarexpedicion'=> ,
			':fechanacimiento'=> ,
			':lugarnacimiento'=> ,
			':paisnacimiento'=> ,
			':nacionalidad_otra'=> ,
			':direccionresidencia'=> ,
			':ciudadresidencia'=> ,
			':correoelectronico'=> ,
			':telefonoresidencia'=> ,
			':celular'=> ,
			':nombreempresa'=> ,
			':direccionempresa'=> ,
			':telefonolaboral'=> ,
			':ciudadempresa'=> ,
			':celularoficinappal'=> ,
			':tipoempresaemp'=> ,
			':tipoempresaemp_cual'=> ,
			':recursos_publicos'=> ,
			':poder_publico'=> ,
			':reconocimiento_publico'=> ,
			':reconocimiento_cual'=> ,
			':servidor_publico'=> ,
			':expuesta_politica'=> ,
			':cargo_politica'=> ,
			':cargo_politica_ini'=> ,
			':cargo_politica_fin'=> ,
			':expuesta_publica'=> ,
			':publica_nombre'=> ,
			':publica_cargo'=> ,
			':repre_internacional'=> ,
			':internacional_indique'=> ,
			':tributarias_otro_pais'=> ,
			':tributarias_paises'=> ,
			':tipoactividad'=> ,
			':ciiu'=> ,
			':profesion'=> ,
			':cargo'=> ,
			':actividadeconomicaempresa'=> ,
			':ciiu_otro'=> ,
			':direccionoficinappal'=> ,
			':telefonoficinappal'=> ,
			':detalletipoactividad'=> ,
			':ingresosmensuales'=> ,
			':totalactivos'=> ,
			':totalpasivos'=> ,
			':egresosmensuales'=> ,
			':patrimonio'=> ,
			':otrosingresos'=> ,
			':conceptosotrosingresos'=> ,
			':origen_fondos'=> ,
			':procedencia_fondos'=> ,
			':monedaextranjera'=> ,
			':tipotransacciones'=> ,
			':tipotransacciones_cual'=> ,
			':otras_operaciones'=> ,
			':productos_exterior'=> ,
			':cuentas_monedaextranjera'=> ,
			':reclamaciones'=> ,
			':firma'=> ,
			':huella'=> ,
			':lugarentrevista'=> ,
			':resultadoentrevista'=> ,
			':fechaentrevista'=> ,
			':horaentrevista'=> ,
			':observacionesentrevista'=> ,
			':nombreintermediario'=> ,
			':clave_inter'=> ,
			':firma_entrevista'=> ,
			':verificacion_ciudad'=> ,
			':verificacion_fecha'=> ,
			':verificacion_hora'=> ,
			':verificacion_nombre'=> ,
			':verificacion_nombre'=> ,
			':verificacion_observacion'=> ,
			':verificacion_firma'=> ,
			':verificacion_observacion'=> ,
			':verificacion_firma'=> ,
			':id_data'=> $id_data
		);
		if($conn->ejecutar($SQL, array(':status'=> '2', ':directory'=> $usuario_id, ':filename'=> 'PLANILLA%'))){
			$conn->desconectar();
			return array('exito'=> 'La planilla se desactivo correctamente, se archivo la planilla.');
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al momento de desactivar la planilla, contacte con el administrador.');
		}
	}*/
}
?>