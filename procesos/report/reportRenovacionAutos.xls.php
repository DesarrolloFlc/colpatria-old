<?php
require_once('../../includes.php');
require_once PATH_SITE.DS.'lib/class/client.class.php';
require_once PATH_CLASS.DS.'_conexion.php';
//print_r($_POST);
if(!isset($_POST['fecha_inicio']) || !isset($_POST['fecha_fin']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_fin'])){
	echo "<script>parent.alert('Error, La fecha de inicio o fecha de fin no pueden ser vacias.');</script>";
	exit();
}
$comp = '';

if($datos = generarDataReporte($_POST['fecha_inicio'], $_POST['fecha_fin'], $comp)){
	//echo json_encode($datos);
	//exit();
	$ultimoestado = "";
	if(is_array($datos) && !empty($datos)){
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Content-Description: File Transfer");
	    header("Content-Encoding: UTF-8");
	    header("Content-Type: text/csv; charset=UTF-8");
	    header("Content-Disposition: attachment; filename=reportRenovacionAutos_" . date('his') . ".csv");
	    header("Expires: 0");
	    header("Pragma: public");
	    echo "\xEF\xBB\xBF"; // UTF-8 BOM

	    $fh = fopen('php://output', 'w');
	    fputcsv($fh, array('Tipo de persona', 'Sucursal', 'Funcionario', 'Planilla', 'Lote Colpatria', 
	    	'Tipo Formulario', 'Tipo de Cliente', 'Tipo Identificación', 'Nombre y/o Razón Social', 
	    	'Documento', 'Nro. ID', 'Digito de Chequeo', 'Fecha de Radicación Colpatria', 
	    	'Fecha Envío Real Colpatria', 'Fecha de Aprobación', 'Fecha Solicitud FCC', 
	    	'Fecha de Digitación', 'Tipo de Actividad Persona Jurídica', 'Detalle Actividad Económica', 
	    	'Ocupación', 'Ciudad Residencia', 'Dirección' , 'Teléfono' , 'Email', 'No. Póliza', 
	    	'Usuario', 'Estado', 'Centro de costo'), ';');
			
		foreach($datos as $dato){
			$client = new Client();
			$tipo_actividad = '';
			$ocupacion = '';
			$ocupacion_detalle = '';
			if($dato['tipo_persona'] == '7'){
				$tipo_actividad = $dato['tipo_actividad'];
				$ocupacion_detalle = $dato['ocupacion_detalle'];
			}else{
				$ocupacion = $dato['ocupacion'];
			}
			$i_a = array($dato['tipo_persona'], $dato['sucursal'], $dato['funcionario'], $dato['planilla'], 
						$dato['lote_colpatria'], $dato['tipo_formulario'], $dato['tipo_cliente'], $dato['tipo_doc_desc'], 
						$dato['nombre_completo'], $dato['documento'], $dato['nro_id'], $dato['digito_chequeo'], 
						$dato['fecha_radicacion'], $dato['fecha_envio_real'], $dato['fecha_aprobacion'], 
						$dato['fecha_solicitud'], $dato['fecha_digitacion'], 
						$tipo_actividad, $ocupacion_detalle, 
						$ocupacion, $dato['ciudad_desc'], $dato['direccion'], $dato['telefono'], 
						$dato['email'], $dato['numero_poliza'], $dato['username'], 'Estado', $dato['centro_costo']);//INFORMACION ARRAY
			
			fputcsv($fh, $i_a, ';');
		}

	}else{
		echo "<script>parent.alert('No se encontraron registros para la busqueda con los parametros especificados.');</script>";
		exit();
	}
}else{
	echo "<script>parent.alert('Ocurrio un error al momento de generar los datos del reporte, por favor contacte con el administrador.');</script>";
	exit();
}
function generarDataReporte($fecha_ini, $fecha_fin, $comp){
	$conn = new Conexion();
	$SQL = "SELECT IF(dra.tipo_doc = '7', 'Juridico', 'Natural') AS tipo_persona, t6.sucursal AS sucursal, t7.name AS funcionario, 
			dra.planilla, dra.lote AS lote_colpatria, 'Renovacion Autos' AS tipo_formulario, IF(dra.tipo_doc = '7', 'Juridico', 'Natural') AS tipo_cliente, 
			t1.description AS tipo_doc_desc, 
			IF(dra.tipo_doc = '7', dra.razon_social, CONCAT(dra.nombres, ' ', dra.p_apellido, ' ', dra.s_apellido)) AS nombre_completo, 
			dra.documento, '' AS nro_id, dra.indicativo_doc AS digito_chequeo, t5.fecha_creacion AS fecha_radicacion, t5.fecha_envio AS fecha_envio_real, 
			t5.fecha_recibido AS fecha_aprobacion, dra.fecha_diligenciamiento AS fecha_solicitud, dra.fecha_creacion AS fecha_digitacion,
			t4.description AS tipo_actividad, dra.ocupacion_detalle, t3.description AS ocupacion, t2.description AS ciudad_desc,
			dra.direccion, dra.telefono, dra.email, dra.numero_poliza, dra.iddata_renovacion_autos, dra.tipo_doc, t8.username, t6.id AS centro_costo
			FROM data_renovacion_autos dra
			INNER JOIN param_tipodocumento t1 ON(t1.id = dra.tipo_doc)
			INNER JOIN param_ciudad t2 ON (t2.id = dra.ciudad)
			LEFT JOIN param_ocupacion t3 ON(t3.id = dra.ocupacion)
			LEFT JOIN param_actividad t4 ON(t4.id = dra.ocupacion)
			LEFT JOIN radicados t5 ON(t5.id = dra.lote)
			LEFT JOIN param_sucursales t6 ON(t6.id = t5.id_sucursal)
			LEFT JOIN user t7 ON(t7.id = t5.id_usuarioenvia)
			LEFT JOIN user t8 ON(t8.id = dra.id_usuario)";
	//echo $SQL;
	//exit();
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			$objetos = array();
			while($consulta = $conn->sacarRegistro('str'))
				$objetos[] = $consulta;
			
			$conn->desconectar();
			return $objetos;
		}else{
			$conn->desconectar();
			return false;
		}
	}else{
		$conn->desconectar();
		return false;
	}
}
?>