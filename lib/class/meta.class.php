<?php
class Meta{
	private $id;
	private $creador_id;
	private $tarea_id;
	private $gestor_id;
	private $fecha;
	private $meta_diaria;
	private $horas_gestion_dia;
	private $estado;
	private $fecha_creacion;

	public function getid(){
		return $this->id;
	}
	public function getcreador_id(){
		return $this->creador_id;
	}
	public function gettarea_id(){
		return $this->tarea_id;
	}
	public function getgestor_id(){
		return $this->gestor_id;
	}
	public function getfecha(){
		return $this->fecha;
	}
	public function getmeta_diaria(){
		return $this->meta_diaria;
	}
	public function gethoras_gestion_dia(){
		return $this->horas_gestion_dia;
	}
	public function getestado(){
		return $this->estado;
	}
	public function getfecha_creacion(){
		return $this->fecha_creacion;
	}

	public function setid($id){
		$this->id = $id;
	}
	public function setcreador_id($creador_id){
		$this->creador_id = $creador_id;
	}
	public function settarea_id($tarea_id){
		$this->tarea_id = $tarea_id;
	}
	public function setgestor_id($gestor_id){
		$this->gestor_id = $gestor_id;
	}
	public function setfecha($fecha){
		$this->fecha = $fecha;
	}
	public function setmeta_diaria($meta_diaria){
		$this->meta_diaria = $meta_diaria;
	}
	public function sethoras_gestion_dia($horas_gestion_dia){
		$this->horas_gestion_dia = $horas_gestion_dia;
	}
	public function setestado($estado){
		$this->estado = $estado;
	}
	public function setfecha_creacion($fecha_creacion){
		$this->fecha_creacion = $fecha_creacion;
	}
	public function setAtributos($atributos, $tipe = ''){
		if($tipe == 'num'){
			if (is_array($atributos)){
				$this->setid((isset($atributos[0]) ? $atributos[0] : "NULL"));
				$this->setcreador_id($atributos[1]);
				$this->settarea_id($atributos[2]);
				$this->setgestor_id($atributos[3]);
				$this->setfecha($atributos[4]);
				$this->setmeta_diaria($atributos[5]);
				$this->sethoras_gestion_dia($atributos[6]);
				$this->setestado((isset($atributos[7]) ? $atributos[7] : "0"));
				$this->setfecha_creacion((isset($atributos[8]) && !empty($atributos[8])) ? $atributos[8] : date('Y-m-d H:i:s'));
			}
		}else{
			if (is_array($atributos)){
				$this->setid((isset($atributos['id']) && !empty($atributos['id'])) ? $atributos['id'] : "NULL");
				$this->setcreador_id($atributos['creador_id']);
				$this->settarea_id($atributos['tarea_id']);
				$this->setgestor_id($atributos['gestor_id']);
				$this->setfecha($atributos['fecha']);
				$this->setmeta_diaria($atributos['meta_diaria']);
				$this->sethoras_gestion_dia($atributos['horas_gestion_dia']);
				$this->setestado((isset($atributos['fecha_creacion']) && !empty($atributos['fecha_creacion'])) ? $atributos['estado'] : "0");
				$this->setfecha_creacion((isset($atributos['fecha_creacion']) && !empty($atributos['fecha_creacion'])) ? $atributos['fecha_creacion'] : date('Y-m-d H:i:s'));
			}
		}
	}
	public function registrar(){
		$conn = new Conexion();
		$SQL = "INSERT INTO meta 
				(
					creador_id, tarea_id, gestor_id, fecha, meta_diaria, horas_gestion_dia
				) 
				VALUES 
				(
					:creador_id, :tarea_id, :gestor_id, :fecha, :meta_diaria, :horas_gestion_dia
				)";
		$data = array(
			':creador_id'=> $this->getcreador_id(), 
			':tarea_id'=> $this->gettarea_id(),
			':gestor_id'=> $this->getgestor_id(), 
			':fecha'=> $this->getfecha(), 
			':meta_diaria'=> $this->getmeta_diaria(), 
			':horas_gestion_dia'=> $this->gethoras_gestion_dia()
		);
		try{
			if($conn->ejecutar($SQL, $data)){
				$this->setId($conn->ultimaId());
				if($this->getObjeto()){
					$conn->desconectar();
					return array("exito"=> "Se inserto y se creo el objeto meta.");
				}else{
					$conn->desconectar();
					return array("error"=> "No se pudo crear el objeto meta.");
				}
			}else{
				$conn->desconectar();
				return array("error"=>"No se pudo crear el objeto meta...");
			}
		}catch(PDOException $Exception){
			if((int)$Exception->getCode() == 23000 && strpos($Exception->getMessage(), 'unq_fecha_tarea_gestor') !== false){
				$SQU = "UPDATE meta
						   SET meta_diaria = :meta_diaria,
						   	   horas_gestion_dia = :horas_gestion_dia
						 WHERE tarea_id = :tarea_id
						   AND fecha = :fecha 
						   AND gestor_id = :gestor_id";
				$datu = array(
					':tarea_id'=> $this->gettarea_id(),
					':fecha'=> $this->getfecha(), 
					':meta_diaria'=> $this->getmeta_diaria(), 
					':gestor_id'=> $this->getgestor_id(), 
					':horas_gestion_dia'=> $this->gethoras_gestion_dia()
				);
				if($conn->ejecutar($SQU, $datu)){
					$conn->desconectar();
					return array("exito"=> "Se modifico y actualizo el objeto meta.");
				}else{
					$conn->desconectar();
					return array("error"=> "No se pudo actualizar el objeto meta.");
				}
			}else
				throw new PDOException($Exception->getMessage(), (int)$Exception->getCode());
		}catch(Exception $Exce){
			throw new Exception($Exce->getMessage(), (int)$Exce->getCode());
		}
	}
	public function getObjeto(){
		$conn = new Conexion();
		$SQL = "SELECT * 
				  FROM meta
				 WHERE id = :id";
		$conn->consultar($SQL, array(':id'=> $this->getId()));
		if($conn->getNumeroRegistros() == 1){
			$consulta = $conn->sacarRegistro();
			$this->setAtributos($consulta);
			$conn->desconectar();
			return true;
		}else{
			$conn->desconectar();
			return false;
		}
	}
	public static function reporteProductivivdadDiaria($fecha){
		$conn = new Conexion();
		$SQL = "SELECT '1' AS tipo, 
					   u.id AS gestor_id,
					   u.name AS gestor_nombre,
					   u.username AS gestor_usuario,
					   COUNT('x') AS cantidad,
					   IFNULL(m.meta_diaria, 0) AS meta_diaria,
					   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
					   'Aprobación' AS actividad
				  FROM radicados AS r
				 INNER JOIN radicados_items AS ri ON(ri.id_radicados = r.id)
				 INNER JOIN user AS u ON(u.id = r.id_usuariorecibido)
				  LEFT JOIN meta AS m ON(m.tarea_id = 1 AND m.gestor_id = u.id AND m.fecha = r.fecha_recibido)
				 WHERE r.estado = 2
				   AND ri.estado IN (1, 2, 3)
				   AND r.fecha_recibido = :fecha1
				   AND u.id != 3691
				 GROUP BY u.id
				 UNION
				SELECT '2' AS tipo, 
					   u.id AS gestor_id,
					   u.name AS gestor_nombre,
					   u.username AS gestor_usuario,
					   COUNT('x') AS cantidad,
					   IFNULL(m.meta_diaria, 0) AS meta_diaria,
					   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
					   'Digitación' AS actividad
				  FROM form AS f
				 INNER JOIN user AS u ON(u.id = f.id_user)
				  LEFT JOIN meta AS m ON(m.tarea_id = 2 AND m.gestor_id = u.id AND m.fecha = DATE(f.date_created))
				 WHERE f.status = 1
				   AND DATE(f.date_created) = :fecha2
				   AND u.id != 3691
				 GROUP BY u.id
				 UNION
				SELECT '3' AS tipo, 
					   u.id AS gestor_id,
					   u.name AS gestor_nombre,
					   u.username AS gestor_usuario,
					   COUNT('x') AS cantidad,
					   IFNULL(m.meta_diaria, 0) AS meta_diaria,
					   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
					   'Call seguro' AS actividad
				  FROM data_confirm AS dc
				 INNER JOIN user AS u ON(u.id = dc.id_user)
				  LEFT JOIN meta AS m ON(m.tarea_id = 3 AND m.gestor_id = u.id AND m.fecha = DATE(dc.date_created))
				 WHERE DATE(dc.date_created) = :fecha3
				   AND dc.id_contact IN (1, 2, 3, 4, 6, 11)
				 GROUP BY u.id
				 UNION
				SELECT '4' AS tipo, 
					   u.id AS gestor_id,
					   u.name AS gestor_nombre,
					   u.username AS gestor_usuario,
					   COUNT('x') AS cantidad,
					   IFNULL(m.meta_diaria, 0) AS meta_diaria,
					   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
					   'Call CAPI' AS actividad
				  FROM data_capi_confirm AS dc
				 INNER JOIN user AS u ON(u.id = dc.id_user)
				  LEFT JOIN meta AS m ON(m.tarea_id = 3 AND m.gestor_id = u.id AND m.fecha = DATE(dc.date_created))
				 WHERE DATE(dc.date_created) = :fecha4
				   AND dc.id_contact IN (1, 2, 3, 4, 6, 11)
				 GROUP BY u.id";
		$data = array(
			':fecha1'=> date('Y-m-d', strtotime($fecha)),
			':fecha2'=> date('Y-m-d', strtotime($fecha)),
			':fecha3'=> date('Y-m-d', strtotime($fecha)),
			':fecha4'=> date('Y-m-d', strtotime($fecha))
		);
		if($conn->consultar($SQL, $data)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str'))
					$objs[] = $dat;
				$conn->desconectar();
				return array('exito'=> 'Se realizo la consulta satisfactoriamente.', 'items'=> $objs);
			}else{
				$conn->desconectar();
				return array('exito'=> 'Se realizo la consulta satisfactoriamente, no se encontraron datos.');
			}
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al realizar la consulta, contacte con el administrador.');
		}
	}
	public static function reporteProductividadRango($fecha_ini, $fecha_fin, $gestor_id, $tarea_id){
		$conn = new Conexion();
		$SQL = "";
		switch ($tarea_id) {
			case '1':
				$SQL = "SELECT '1' AS tipo, 
							   u.id AS gestor_id,
							   u.name AS gestor_nombre,
							   u.username AS gestor_usuario,
							   COUNT('x') AS cantidad,
							   IFNULL(m.meta_diaria, 0) AS meta_diaria,
							   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
							   r.fecha_recibido AS fecha,
							   'Aprobación' AS actividad
						  FROM radicados AS r
						 INNER JOIN radicados_items AS ri ON(ri.id_radicados = r.id)
						 INNER JOIN user AS u ON(u.id = r.id_usuariorecibido)
						  LEFT JOIN meta AS m ON(m.tarea_id = 1 AND m.gestor_id = u.id AND m.fecha = r.fecha_recibido)
						 WHERE r.estado = 2
						   AND ri.estado IN (1, 2, 3)
						   AND (r.fecha_recibido BETWEEN :fecha_ini AND :fecha_fin)
						   AND u.id = :gestor_id
						 GROUP BY u.id, r.fecha_recibido";
				break;
			case '2':
				$SQL = "SELECT '2' AS tipo, 
							   u.id AS gestor_id,
							   u.name AS gestor_nombre,
							   u.username AS gestor_usuario,
							   COUNT('x') AS cantidad,
							   IFNULL(m.meta_diaria, 0) AS meta_diaria,
							   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
							   DATE(f.date_created) AS fecha,
							   'Digitación' AS actividad
						  FROM form AS f
						 INNER JOIN user AS u ON(u.id = f.id_user)
						  LEFT JOIN meta AS m ON(m.tarea_id = 2 AND m.gestor_id = u.id AND m.fecha = DATE(f.date_created))
						 WHERE f.status = 1
						   AND (DATE(f.date_created) BETWEEN :fecha_ini AND :fecha_fin)
						   AND u.id = :gestor_id
						 GROUP BY u.id, DATE(f.date_created)";
						break;
			case '3':
				$SQL = "SELECT '3' AS tipo, 
							   u.id AS gestor_id,
							   u.name AS gestor_nombre,
							   u.username AS gestor_usuario,
							   COUNT('x') AS cantidad,
							   IFNULL(m.meta_diaria, 0) AS meta_diaria,
							   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
							   DATE(dc.date_created) AS fecha,
							   'Call seguro' AS actividad
						  FROM data_confirm AS dc
						 INNER JOIN user AS u ON(u.id = dc.id_user)
						  LEFT JOIN meta AS m ON(m.tarea_id = 3 AND m.gestor_id = u.id AND m.fecha = DATE(dc.date_created))
						 WHERE (DATE(dc.date_created) BETWEEN :fecha_ini AND :fecha_fin)
						   AND dc.id_contact IN (1, 2, 3, 4, 6, 11)
						   AND u.id = :gestor_id
						 GROUP BY u.id, DATE(dc.date_created)";
				break;
			case '4':
				$SQL = "SELECT '4' AS tipo, 
							   u.id AS gestor_id,
							   u.name AS gestor_nombre,
							   u.username AS gestor_usuario,
							   COUNT('x') AS cantidad,
							   IFNULL(m.meta_diaria, 0) AS meta_diaria,
							   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
							   DATE(dc.date_created) AS fecha,
							   'Call CAPI' AS actividad
						  FROM data_capi_confirm AS dc
						 INNER JOIN user AS u ON(u.id = dc.id_user)
						  LEFT JOIN meta AS m ON(m.tarea_id = 3 AND m.gestor_id = u.id AND m.fecha = DATE(dc.date_created))
						 WHERE (DATE(dc.date_created) BETWEEN :fecha_ini AND :fecha_fin)
						   AND dc.id_contact IN (1, 2, 3, 4, 6, 11)
						   AND u.id = :gestor_id
						 GROUP BY u.id, DATE(dc.date_created)";
				break;
		}
		$data = array(
			':fecha_ini'=> date('Y-m-d', strtotime($fecha_ini)),
			':fecha_fin'=> date('Y-m-d', strtotime($fecha_fin)),
			':gestor_id'=> $gestor_id
		);
		if($conn->consultar($SQL, $data)){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($dat = $conn->sacarRegistro('str')){
					$dat['dia_mes'] = date('m/d', strtotime($dat['fecha']));
					$objs[] = $dat;
				}
				$conn->desconectar();
				return array('exito'=> 'Se realizo la consulta satisfactoriamente.', 'items'=> $objs);
			}else{
				$conn->desconectar();
				return array('exito'=> 'Se realizo la consulta satisfactoriamente, no se encontraron datos.');
			}
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al realizar la consulta, contacte con el administrador.');
		}
	}
	public static function reporteProductividadTarea($fecha_ini, $fecha_fin, $tarea_id){
		$objs = array(
			'terea'=> null,
			'terea_id'=> $tarea_id,
			'usuarios'=> array()
		);
		$conn = new Conexion();
		$SQL = "";
		switch ($tarea_id) {
			case '1':
				$objs['terea'] = "Aprobación";
				$SQL = "SELECT '1' AS tipo, 
							   u.id AS gestor_id,
							   u.name AS gestor_nombre,
							   u.username AS gestor_usuario,
							   COUNT('x') AS cantidad,
							   IFNULL(m.meta_diaria, 0) AS meta_diaria,
							   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
							   r.fecha_recibido AS fecha,
							   'Aprobación' AS actividad
						  FROM radicados AS r
						 INNER JOIN radicados_items AS ri ON(ri.id_radicados = r.id)
						 INNER JOIN user AS u ON(u.id = r.id_usuariorecibido)
						  LEFT JOIN meta AS m ON(m.tarea_id = 1 AND m.gestor_id = u.id AND m.fecha = r.fecha_recibido)
						 WHERE r.estado = 2
						   AND ri.estado IN (1, 2, 3)
						   AND (r.fecha_recibido BETWEEN :fecha_ini AND :fecha_fin)
						   AND u.id != 3691
						 GROUP BY u.id, r.fecha_recibido
						 ORDER BY u.id, r.fecha_recibido ASC";
				break;
			case '2':
				$objs['terea'] = "Digitación";
				$SQL = "SELECT '2' AS tipo, 
							   u.id AS gestor_id,
							   u.name AS gestor_nombre,
							   u.username AS gestor_usuario,
							   COUNT('x') AS cantidad,
							   IFNULL(m.meta_diaria, 0) AS meta_diaria,
							   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
							   DATE(f.date_created) AS fecha,
							   'Digitación' AS actividad
						  FROM form AS f
						 INNER JOIN user AS u ON(u.id = f.id_user)
						  LEFT JOIN meta AS m ON(m.tarea_id = 2 AND m.gestor_id = u.id AND m.fecha = DATE(f.date_created))
						 WHERE f.status = 1
						   AND (DATE(f.date_created) BETWEEN :fecha_ini AND :fecha_fin)
						   AND u.id != 3691
						 GROUP BY u.id, DATE(f.date_created)
						 ORDER BY u.id, DATE(f.date_created) ASC";
						break;
			case '3':
				$objs['terea'] = "Call seguro";
				$SQL = "SELECT '3' AS tipo, 
							   u.id AS gestor_id,
							   u.name AS gestor_nombre,
							   u.username AS gestor_usuario,
							   COUNT('x') AS cantidad,
							   IFNULL(m.meta_diaria, 0) AS meta_diaria,
							   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
							   DATE(dc.date_created) AS fecha,
							   'Call seguro' AS actividad
						  FROM data_confirm AS dc
						 INNER JOIN user AS u ON(u.id = dc.id_user)
						  LEFT JOIN meta AS m ON(m.tarea_id = 3 AND m.gestor_id = u.id AND m.fecha = DATE(dc.date_created))
						 WHERE (DATE(dc.date_created) BETWEEN :fecha_ini AND :fecha_fin)
						   AND dc.id_contact IN (1, 2, 3, 4, 6, 11)
						 GROUP BY u.id, DATE(dc.date_created)
						 ORDER BY u.id, DATE(dc.date_created) ASC";
				break;
			case '4':
				$objs['terea'] = "Call CAPI";
				$SQL = "SELECT '4' AS tipo, 
							   u.id AS gestor_id,
							   u.name AS gestor_nombre,
							   u.username AS gestor_usuario,
							   COUNT('x') AS cantidad,
							   IFNULL(m.meta_diaria, 0) AS meta_diaria,
							   IFNULL(m.horas_gestion_dia, 0) AS horas_gestion_dia,
							   DATE(dc.date_created) AS fecha,
							   'Call CAPI' AS actividad
						  FROM data_capi_confirm AS dc
						 INNER JOIN user AS u ON(u.id = dc.id_user)
						  LEFT JOIN meta AS m ON(m.tarea_id = 3 AND m.gestor_id = u.id AND m.fecha = DATE(dc.date_created))
						 WHERE (DATE(dc.date_created) BETWEEN :fecha_ini AND :fecha_fin)
						   AND dc.id_contact IN (1, 2, 3, 4, 6, 11)
						 GROUP BY u.id, DATE(dc.date_created)
						 ORDER BY u.id, DATE(dc.date_created) ASC";
				break;
		}
		$data = array(
			':fecha_ini'=> date('Y-m-d', strtotime($fecha_ini)),
			':fecha_fin'=> date('Y-m-d', strtotime($fecha_fin))
		);
		if($conn->consultar($SQL, $data)){
			if($conn->getNumeroRegistros() > 0){
				//$objs = array();
				while($dat = $conn->sacarRegistro('str')){
					$dat['dia_mes'] = date('m/d', strtotime($dat['fecha']));
					if(!isset($objs['usuarios'][$dat['gestor_usuario']])){
						//$objs['usuarios']['gestor_nombre'] = $dat['gestor_nombre'];
						$objs['usuarios'][$dat['gestor_usuario']] = array();
						$objs['usuarios'][$dat['gestor_usuario']][] = $dat;
					}else
						$objs['usuarios'][$dat['gestor_usuario']][] = $dat;
				}
				$conn->desconectar();
				return array('exito'=> 'Se realizo la consulta satisfactoriamente.', 'items'=> $objs);
			}else{
				$conn->desconectar();
				return array('exito'=> 'Se realizo la consulta satisfactoriamente, no se encontraron datos.');
			}
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al realizar la consulta, contacte con el administrador.');
		}
	}
}
?>