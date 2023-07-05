<?php
class Reporte{
	public static function informacionClientesRadicados($fecha_ini, $fecha_fin){
		setlocale(LC_MONETARY, 'es_CO');
		$conn = new Conexion();
		$SQL = "SELECT COUNT('x') AS cantidad,
					   SUM(IF(ri.estado = '0', 1, 0)) AS no_a_llegado,
					   SUM(IF(ri.estado = '1', 1, 0)) AS no_llego,
					   SUM(IF(ri.estado = '2', 1, 0)) AS recibido,
					   SUM(IF(ri.estado = '3', 1, 0)) AS devuelto,
					   SUM(IF(ri.estado = '4', 1, 0)) AS cancelado,
					   r.tipo
				  FROM radicados AS r 
				 INNER JOIN radicados_items AS ri ON(ri.id_radicados = r.id)
				 WHERE DATE(r.fecha_creacion) BETWEEN :fecha_ini AND :fecha_fin
				 GROUP BY r.tipo
				 ORDER BY r.tipo ASC";
		if($conn->consultar($SQL, array(':fecha_ini'=> date('Y-m-d', strtotime($fecha_ini)), ':fecha_fin'=> date('Y-m-d', strtotime($fecha_fin))))){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($row = $conn->sacarRegistro('str'))
					$objs[] = $row;

				$conn->desconectar();
				return array('exito'=> 'Datos generados con exito', 'items'=> $objs);
			}else{
				$conn->desconectar();
				return array('error'=> 'No se generaron datos.');
			}
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al momento de generar los datos.');
		}
	}
	public static function informacionClientesDigitalizados($fecha_ini, $fecha_fin){
		setlocale(LC_MONETARY, 'es_CO');
		$conn = new Conexion();
		$SQL = "SELECT COUNT('x') AS cantidad,
					   r.tipo
				  FROM image_tmp AS it
				 INNER JOIN radicados AS r ON(r.id = substring_index(substring_index(it.filename, '_', 2), '_', -1))
				 WHERE it.filename LIKE 'LOTE_%'
				   AND (DATE(it.date_uploaded) BETWEEN :fecha_ini AND :fecha_fin)
				 GROUP BY r.tipo
				 ORDER BY r.tipo ASC";
		if($conn->consultar($SQL, array(':fecha_ini'=> date('Y-m-d', strtotime($fecha_ini)), ':fecha_fin'=> date('Y-m-d', strtotime($fecha_fin))))){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($row = $conn->sacarRegistro('str'))
					$objs[] = $row;

				$conn->desconectar();
				return array('exito'=> 'Datos generados con exito', 'items'=> $objs);
			}else{
				$conn->desconectar();
				return array('error'=> 'No se generaron datos.');
			}
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al momento de generar los datos.');
		}
	}
	public static function informacionClientesDocumentacionComplementaria($fecha_ini, $fecha_fin){
		setlocale(LC_MONETARY, 'es_CO');
		$conn = new Conexion();
		$SQL = "SELECT COUNT('x') AS cantidad,
					   r.tipo
				  FROM radicados AS r 
				 INNER JOIN radicados_items AS ri ON(ri.id_radicados = r.id)
				 WHERE DATE(r.fecha_creacion) BETWEEN :fecha_ini AND :fecha_fin
				   AND ri.documento_especial = 1
				 GROUP BY r.tipo
				 ORDER BY r.tipo ASC";
		if($conn->consultar($SQL, array(':fecha_ini'=> date('Y-m-d', strtotime($fecha_ini)), ':fecha_fin'=> date('Y-m-d', strtotime($fecha_fin))))){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($row = $conn->sacarRegistro('str'))
					$objs[] = $row;

				$conn->desconectar();
				return array('exito'=> 'Datos generados con exito', 'items'=> $objs);
			}else{
				$conn->desconectar();
				return array('error'=> 'No se generaron datos.');
			}
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al momento de generar los datos.');
		}
	}
	public static function informacionClientesParaDigitar($fecha_ini, $fecha_fin){
		setlocale(LC_MONETARY, 'es_CO');
		$conn = new Conexion();
		$SQL = "SELECT COUNT('x') AS cantidad,
					   r.tipo
				  FROM radicados AS r 
				 INNER JOIN radicados_items AS ri ON(ri.id_radicados = r.id)
				 WHERE DATE(r.fecha_creacion) BETWEEN :fecha_ini AND :fecha_fin
				   AND r.estado = '2'
				   AND ri.documento_especial = '0'
				 GROUP BY r.tipo
				 ORDER BY r.tipo ASC";
		if($conn->consultar($SQL, array(':fecha_ini'=> date('Y-m-d', strtotime($fecha_ini)), ':fecha_fin'=> date('Y-m-d', strtotime($fecha_fin))))){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($row = $conn->sacarRegistro('str'))
					$objs[] = $row;

				$conn->desconectar();
				return array('exito'=> 'Datos generados con exito', 'items'=> $objs);
			}else{
				$conn->desconectar();
				return array('error'=> 'No se generaron datos.');
			}
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al momento de generar los datos.');
		}
	}
	public static function informacionClientesDigitados($fecha_ini, $fecha_fin){
		setlocale(LC_MONETARY, 'es_CO');
		$conn = new Conexion();
		$SQL = "SELECT COUNT('x') AS cantidad, 
					   t.tipo 
				  FROM (SELECT f.id_client, 
							   f.log_planilla, 
							   f.log_lote,
							   r.tipo
						  FROM form AS f
						 INNER JOIN radicados AS r ON(r.id = f.log_lote)
						 WHERE DATE(f.date_created) BETWEEN :fecha_ini AND :fecha_fin
						   AND f.status = '1'
						 GROUP BY f.id_client, f.log_planilla, f.log_lote
					   ) AS t 
				 GROUP BY t.tipo
				 ORDER BY t.tipo ASC";
		if($conn->consultar($SQL, array(':fecha_ini'=> date('Y-m-d', strtotime($fecha_ini)), ':fecha_fin'=> date('Y-m-d', strtotime($fecha_fin))))){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($row = $conn->sacarRegistro('str'))
					$objs[] = $row;

				$conn->desconectar();
				return array('exito'=> 'Datos generados con exito', 'items'=> $objs);
			}else{
				$conn->desconectar();
				return array('error'=> 'No se generaron datos.');
			}
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al momento de generar los datos.');
		}
	}
	public static function informacionGestionesTelefonicas($fecha_ini, $fecha_fin){
		setlocale(LC_MONETARY, 'es_CO');
		$conn = new Conexion();
		$SQL = "SELECT COUNT('x') AS cantidad,
					   SUM(IF(c.id_contact IN (1, 2, 3, 4, 6, 11), 1, 0)) AS efectivas,
					   SUM(IF(c.id_contact = '1', 1, 0)) AS confirmadas,
					   '1' AS tipo
				  FROM data_confirm AS c 
				 WHERE DATE(c.date_created) BETWEEN :fecha_ini AND :fecha_fin
				 /*GROUP BY r.tipo
				 ORDER BY r.tipo ASC*/";
		if($conn->consultar($SQL, array(':fecha_ini'=> date('Y-m-d', strtotime($fecha_ini)), ':fecha_fin'=> date('Y-m-d', strtotime($fecha_fin))))){
			if($conn->getNumeroRegistros() > 0){
				$objs = array();
				while($row = $conn->sacarRegistro('str'))
					$objs[] = $row;

				$conn->desconectar();
				return array('exito'=> 'Datos generados con exito', 'items'=> $objs);
			}else{
				$conn->desconectar();
				return array('error'=> 'No se generaron datos.');
			}
		}else{
			$conn->desconectar();
			return array('error'=> 'Ocurrio un error al momento de generar los datos.');
		}
	}
}
?>