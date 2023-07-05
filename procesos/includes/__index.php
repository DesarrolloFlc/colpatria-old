<?php
require_once('../../includes.php');
require_once PATH_CLASS.DS.'PHPExcel.php';
require_once PATH_CLASS.DS.'_conexion.php';
//insertGestionNoContacto();
//insertGestionNoContactoJuridico();
obtenerRepetidosForm();
function insertGestionNoContacto(){
	$conexion = new Conexion();
	$temp = file('insertGestionNoContacto/insertGestionNoContacto4.csv');
	$n=count($temp);
	$objetos = array();
	$fp = fopen("insertGestionNoContacto/insertGestionNoContacto_salida4.csv","a");
	fwrite($fp, "ID;DOCUMENTO;FECHA;ACCION".PHP_EOL);
	for ($i = 1; $i < $n; $i++){
		$datos_leer = split(";",$temp[$i]);

		
		$id = trim($datos_leer[0]);
		$ced = trim($datos_leer[1]);

		$fecp = trim($datos_leer[3]);
		$fecpart = explode('/', $fecp);
		$hor = rand(0,23);
		$min = rand(0,59);
		$seg = rand(0,59);
		$fecha = $fecpart[2]."-03-".$fecpart[0]." $hor:$min:$seg";

		$SQL =  "SELECT * FROM data_capi WHERE id_client = $id";
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$consulta = $conexion->sacarRegistro();
			$id_cliente = $consulta['id_client'];
			$documento = $consulta['documento'];
			$primerapellido = $consulta['primerapellido'];
			$segundoapellido = $consulta['segundoapellido'];
			$nombres = $consulta['nombres'];
			$fechanacimiento = $consulta['fechanacimiento'];
			$profesion = $consulta['profesion'];
			$empresa = $consulta['empresa'];
			$direccionlaboral = $consulta['direccionlaboral'];
			$direccionresidencia = $consulta['direccionresidencia'];
			$telefonoresidencia1 = $consulta['telefonoresidencia1'];
			$observacion = 	$telefonoresidencia1." NO CONTESTAN";
			$SQLU = "INSERT INTO data_capi_confirm
					(
						id_client, id_user, id_contact, documento, primerapellido, segundoapellido, nombres, fechanacimiento, id_profesion, 
						id_ingresos, id_egresos, activos, pasivos, direccionlaboral, id_ciudad, direccionresidencia, 
						telefonoresidencia, observacion, date_created, status
					)
					VALUES
					(
						$id_cliente, 2060, '8', '$documento', '$primerapellido', '$segundoapellido', '$nombres', '$fechanacimiento', '0',
						'0', '0', '0', '0', '$direccionlaboral', 0, '$direccionresidencia',
						'$telefonoresidencia1', '$observacion', '$fecha', 1
					)";
			echo $SQLU."<br>";
			//exit();
			if($conexion->consultar($SQLU)){
					//echo "$SQLU<br>";
				echo "CLIENTE INSERTADO CON ID $id_cliente<br><br>";
				fwrite($fp, "$id_cliente;$ced;$fecha;INSERTADO".PHP_EOL);
			}else{
				echo "ERROR<br><br>";
				fwrite($fp, "$id_cliente;$ced;$fecha;NOINSERTADO".PHP_EOL);
			}
		}
	}
	fclose($fp);
	echo "Terminado...";
}
function insertGestionNoContactoJuridico(){
	$conexion = new Conexion();
	$temp = file('insertGestionNoContacto/insertGestionNoContacto4.csv');
	$n=count($temp);
	$objetos = array();
	$fp = fopen("insertGestionNoContacto/insertGestionNoContacto_salida4.csv","a");
	fwrite($fp, "ID;DOCUMENTO;FECHA;ACCION".PHP_EOL);
	for ($i = 1; $i < $n; $i++){
		$datos_leer = split(";",$temp[$i]);

		
		$id = trim($datos_leer[0]);
		$ced = trim($datos_leer[1]);

		$fecp = trim($datos_leer[3]);
		$fecpart = explode('/', $fecp);
		$hor = rand(8,23);
		$min = rand(0,59);
		$seg = rand(0,59);
		$fecha = $fecpart[2]."-03-".$fecpart[0]." $hor:$min:$seg";

		$SQL =  "SELECT * FROM data_capi WHERE id_client = $id";
		echo $SQL."<br>";
		$conexion->consultar($SQL);
		if($conexion->getNumeroRegistros() > 0){
			$consulta = $conexion->sacarRegistro();
			$id_client = $consulta['id_client'];
			$documento = $consulta['documento'];
			$codigochequeo = $consulta['codigochequeo'];
			$nombres = $consulta['nombres'];
			$id_ciudad = $consulta['id_ciudad'];
			$direccionlaboral = $consulta['direccionlaboral'];
			$telefonoresidencia = $consulta['telefonoresidencia'];
			$id_actividadeconomicappal = $consulta['id_actividadeconomicappal'];
			$activos = $consulta['activos'];
			$pasivos = $consulta['pasivos'];
			$id_ingresos = $consulta['id_ingresos'];
			$id_egresos = $consulta['id_egresos'];
			$correoelectronico = $consulta['correoelectronico'];
			$observacion = 	$telefonoresidencia1." NO CONTESTAN";


			$fechanacimiento = $consulta['fechanacimiento'];
			$telefonoresidencia1 = $consulta['telefonoresidencia1'];
			$SQLU = "INSERT INTO data_capi_confirm
					(
						id_client, id_user, id_contact, nombres, documento, codigochequeo, id_ciudad, direccionlaboral, telefonoresidencia,
						id_actividadeconomicappal, activos, pasivos, id_ingresos, id_egresos, correoelectronico, observacion,
						date_created, status
        			) 
					VALUES
					(
						$id_client, 2060, '8', '$nombres', '$documento', '$codigochequeo', '$id_ciudad', '$direccionlaboral', '$telefonoresidencia',
						'$id_actividadeconomicappal', '$activos', '$pasivos', '$id_ingresos', '$id_egresos', '$correoelectronico', '$observacion',
						'$fecha', 1
					)";
			echo $SQLU."<br>";
			//exit();
			if($conexion->consultar($SQLU)){
					//echo "$SQLU<br>";
				echo "CLIENTE INSERTADO CON ID $id_cliente<br><br>";
				fwrite($fp, "$id_cliente;$ced;$fecha;INSERTADO".PHP_EOL);
			}else{
				echo "ERROR<br><br>";
				fwrite($fp, "$id_cliente;$ced;$fecha;NOINSERTADO".PHP_EOL);
			}
		}
	}
	fclose($fp);
	echo "Terminado...";
}
function obtenerRepetidosForm(){
	$conn = new Conexion();
	$SQ1 = "SELECT COUNT('x') AS cantidad,
			       f.id_client,
			       f.log_lote,
			       f.log_planilla
			  FROM form AS f
			 INNER JOIN client AS c ON(c.id = f.id_client)
			 WHERE (DATE(f.date_created) BETWEEN '2016-01-01' AND '2021-09-23')
			   AND c.persontype = 1
			 GROUP BY 2, 3, 4
			 HAVING COUNT('x') > 1
			 ORDER BY 1 DESC";
	$conn->consultar($SQ1);
	if($conn->getNumeroRegistros() > 0){
		$fp = fopen("dataObtenerRepetidosForm_salida".date('His').".csv", "a");
	    fputcsv($fp, ['id', 'id_client', 'type', 'lote', 'planilla', 'date_created', 'id_user', 'log_lote', 'log_planilla', 'status', 'num_images', 'marca', 'id_user_disabled', 'eliminar?'], '|');
	    $fpi = fopen("dataObtenerRepetidosImages_salida".date('His').".csv", "a");
	    fputcsv($fpi, ['id', 'id_forma', 'id_imagetype', 'directory', 'filename', 'date_created', 'original_file', 'status', 'eliminar?', 'existe?'], '|');
	    $fpd = fopen("dataObtenerRepetidosData_salida".date('His').".csv", "a");
	    fputcsv($fpd, ['id_form', 'id_data', 'eliminar?', 'data'], '|');
			$fpi2 = fopen("dataObtenerRepetidosImages_salida2".date('His').".csv", "a");
	    	fputcsv($fpi2, ['id', 'id_form', 'siguiente?', 'existe?', 'ORIGINAL', 'eliminar?'], '|');
		$con2 = new Conexion();
		while($row = $conn->sacarRegistro('str')){
			$SQ2 = "SELECT * 
					  FROM form 
					 WHERE id_client = :id_client
					   AND log_lote = :log_lote
					   AND log_planilla = :log_planilla
					   AND status IN (0, 1)
					 ORDER BY status DESC, date_created DESC";
			$con2->consultar($SQ2, [':id_client'=> $row['id_client'], ':log_lote'=> $row['log_lote'], ':log_planilla'=> $row['log_planilla']]);
			$i = 0;
			$cond = new Conexion();
			$coni = new Conexion();
			$imgs = [];
			while($row2 = $con2->sacarRegistro('str')){
				fputcsv($fp, [$row2['id'], $row2['id_client'], $row2['type'], $row2['lote'], $row2['planilla'], $row2['date_created'], $row2['id_user'], $row2['log_lote'], $row2['log_planilla'], $row2['status'], $row2['num_images'], $row2['marca'], $row2['id_user_disabled'], (($i == 0) ? 'NO' : 'SI')], '|');
				//if($i > 0){
					$SQi = "SELECT * FROM image WHERE id_forma = :id_forma";
					$coni->consultar($SQi, [':id_forma'=> $row2['id']]);
					if($coni->getNumeroRegistros() > 0){
						while($rowi = $coni->sacarRegistro('str')){
							$existe = 'NO';
							if(file_exists('/var/www/html/Aplicativos.Serverfin04/images_colpatria/'.$rowi['filename']))
								$existe = 'SI';

							fputcsv($fpi, [$rowi['id'], $rowi['id_forma'], $rowi['id_imagetype'], $rowi['directory'], $rowi['filename'], $rowi['date_created'], $rowi['original_file'], $rowi['status'], (($i == 0) ? 'NO' : 'SI'), $existe], '|');

							$imgs[] = [$rowi['id'], $rowi['id_forma'], (($i == 0) ? 'NO' : 'SI'), $existe, $rowi['original_file']];
						}
					}else{
						fputcsv($fpi, ['', $row2['id'], '', '', '', '', '', '', 'SI', 'NO'], '|');
					}



					$SQd = "SELECT * FROM data WHERE id_form = :id_form";
					$cond->consultar($SQd, [':id_form'=> $row2['id']]);
					if($cond->getNumeroRegistros() > 0){
						while($rowd = $cond->sacarRegistro('str')){

							fputcsv($fpd, [$rowd['id'], $row2['id'], (($i == 0) ? 'NO' : 'SI'), json_encode($rowd)], '|');
						}
					}else{
						fputcsv($fpd, ['', $row2['id'], '', ''], '|');
					}
				//}
				$i++;
			}
			fputcsv($fpi, [], '|');
			fputcsv($fpd, [], '|');
			$el = true;
			foreach ($imgs as $key => $value) {
				if($el === false && ($value[2] == 'NO' && $value[3] == 'SI')){
					$el = true;
					$imgs[$key][] = 'NO';
					$value[] = 'NO';
				}else if($el === true && ($value[2] == 'NO' && $value[3] == 'NO')){
					$el = false;
					$imgs[$key][] = 'NO';
					$value[] = 'NO';
				}else if($el === true && ($value[2] == 'NO' && $value[3] == 'SI')){
					$imgs[$key][] = 'NO';
					$value[] = 'NO';
				}else if($el === true && ($value[2] == 'SI')){
					$imgs[$key][] = 'SI';
					$value[] = 'SI';
				}else if($el === false && ($value[2] == 'SI')){
					$imgs[$key][] = 'NO';
					$value[] = 'NO';
				}
				fputcsv($fpi2, $value, '|');
			}
		}
		fclose($fp);
		fclose($fpi);
		fclose($fpi2);
		fclose($fpd);
		echo "Terminado...";
	}
}
?>