<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
set_time_limit(0);
header("Content-Type: text/html;charset=utf-8");
require "includes.php";
require_once PATH_CLASS.DS.'_conexion.php';
mejoraInicial();
function mejoraInicial(){
	$conn = new Conexion();
	if(!$conn->ejecutar("TRUNCATE TABLE data_matriz2"))
		exit();
	$fh = fopen(PATH_MATRIZ.DS.'salida_hoy_'.date('YmdHis').'.log',"a");
	$SQL = "SELECT c.id,
				   c.date_created
			  FROM client_ AS c
			 INNER JOIN form_ AS f ON(f.id_client = c.id)
			 WHERE c.vigente = '0'
			   AND f.status = '1'
			   /*AND c.document IN (SELECT document FROM client_temp)
			   AND c.id > 341654*/
			 GROUP BY c.id
			 ORDER BY c.id";
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			$con2 = new Conexion();
			while($dat = $conn->sacarRegistro('str')){
				$primero = array();
				$nuevo = array();
				$nuevo[':fuente'] = 'Digitacion finleco';
				$i = 0;
				$j = 1;
				$cont = 0;

				$SQ1 = "SELECT d.*
						  FROM form_ AS f
						 INNER JOIN data_ AS d ON(d.id_form = f.id)
						 WHERE f.status = '1'
						   AND f.id_client = :id_client
						   AND d.formulario IN (16, 18)
						 ORDER BY f.date_created DESC";
				if($con2->consultar($SQ1, array(':id_client'=> $dat['id']))){
					if($con2->getNumeroRegistros() > 0){
						$fuente = '';
						while($dato1 = $con2->sacarRegistro('str')){
							if($i === 0){
								$primero = $dato1;
								foreach($primero as $key => $value)
									$nuevo[':'.$key] = ($value === 0) ? "0" : $value;

								if($dato1['formulario'] == '18')
									$fuente = 'Gestor de ventas';
								elseif($dato1['formulario'] == '16')
									$fuente = 'Actualizacion masiva';
							}else{
								foreach ($primero as $key => $value){
									//$nuevo[':'.$key] = $value;
									if( (empty(trim($primero[$key])) && !empty(trim($dato1[$key]))) ){
										$nuevo[':'.$key] = ($dato1[$key] === 0) ? "0" : $dato1[$key];
										$primero[$key] = $dato1[$key];
									}elseif( (!empty(trim($primero[$key])) && !empty(trim($dato1[$key]))) ){
										if(  (strtoupper(trim($primero[$key])) == 'SD' || strtoupper(trim($primero[$key])) == 'NA' || strtoupper(trim($primero[$key])) == 'N/A') && (strtoupper(trim($dato1[$key])) != 'SD' && strtoupper(trim($dato1[$key])) != 'NA' && strtoupper(trim($dato1[$key])) != 'N/A') ){
											$nuevo[':'.$key] = ($dato1[$key] === 0) ? "0" : $dato1[$key];
											$primero[$key] = $dato1[$key];
										}
									}
								}
							}

							$i++;
							$cont++;
						}
						if($fuente != '')
							$nuevo[':fuente'] = $fuente;
						else
							$nuevo[':fuente'] = 'Actualizacion masiva';
					}
				}
				$i = 0;

				$SQ2 = "SELECT d.*
						  FROM form_ AS f
						 INNER JOIN data_ AS d ON(d.id_form = f.id)
						 WHERE f.status = '1'
						   AND f.id_client = :id_client
						   AND d.formulario NOT IN (16, 18)
						 ORDER BY f.date_created DESC";
				if($con2->consultar($SQ2, array(':id_client'=> $dat['id']))){
					if($con2->getNumeroRegistros() > 0){
						while($dato2 = $con2->sacarRegistro('str')){
							if($i === 0 && empty($primero)){
								$primero = $dato2;
								foreach($primero as $key => $value)
									$nuevo[':'.$key] = ($value === 0) ? "0" : $value;

								if($nuevo[':fuente'] == 'Digitacion finleco' && $dato2['estado_autos'] != '0')
									$nuevo[':fuente'] == 'Llamada telefonica';

							}else{
								foreach ($primero as $key => $value){
									//$nuevo[':'.$key] = $value;
									if( (empty(trim($primero[$key])) && !empty(trim($dato2[$key]))) ){
										$nuevo[':'.$key] = ($dato2[$key] === 0) ? "0" : $dato2[$key];
										$primero[$key] = $dato2[$key];
									}elseif( (!empty(trim($primero[$key])) && !empty(trim($dato2[$key]))) ){
										if(  (strtoupper(trim($primero[$key])) == 'SD' || strtoupper(trim($primero[$key])) == 'NA' || strtoupper(trim($primero[$key])) == 'N/A') && (strtoupper(trim($dato2[$key])) != 'SD' && strtoupper(trim($dato2[$key])) != 'NA' && strtoupper(trim($dato2[$key])) != 'N/A') ){
											$nuevo[':'.$key] = ($dato2[$key] === 0) ? "0" : $dato2[$key];
											$primero[$key] = $dato2[$key];
										}
									}
								}
							}
							$i++;
							$cont++;
						}
					}
				}
				if(!empty($nuevo) && count($nuevo) > 1){
					unset($nuevo[':id']);
					unset($nuevo[':id_form']);
					unset($nuevo[':socio1']);
					unset($nuevo[':socio2']);
					unset($nuevo[':socio3']);
					unset($nuevo[':estado_autos']);
					unset($nuevo[':formato_paisn']);
					unset($nuevo[':formato_nacio']);
					unset($nuevo[':formato_oblip']);
					$nuevo[':fecha_creacion'] = date('Y-m-d H:i:s');
					$nuevo[':cantidad_registros'] = $cont;
					$nuevo[':id_client'] = $dat['id'];
					$nuevo[':creacion_cliente'] = $dat['date_created'];
					$nuevo[':formulario'] = '17';

					$nuevo[':activosemp'] = ($nuevo[':activosemp'] != '' && $nuevo[':activosemp'] != '*' && strtoupper($nuevo[':activosemp']) != 'SD') ? $nuevo[':activosemp'] : 'NULL';
					$nuevo[':pasivosemp'] = ($nuevo[':pasivosemp'] != '' && $nuevo[':pasivosemp'] != '*' && strtoupper($nuevo[':pasivosemp']) != 'SD') ? $nuevo[':pasivosemp'] : 'NULL';
					$nuevo[':fechanacimiento'] = ($nuevo[':fechanacimiento'] != '' && $nuevo[':fechanacimiento'] != '--') ? $nuevo[':fechanacimiento'] : 'NULL';
					$nuevo[':fechaexpedicion'] = ($nuevo[':fechaexpedicion'] != '' && $nuevo[':fechaexpedicion'] != '--' && $nuevo[':fechaexpedicion'] != '0000-00-00') ? date('Y-m-d', strtotime($nuevo[':fechaexpedicion'])) : ($nuevo[':fechaexpedicion'] == '0000-00-00') ? $nuevo[':fechaexpedicion'] : 'NULL';
					$nuevo[':fechaentrevista'] = ($nuevo[':fechaentrevista'] != '' && $nuevo[':fechaentrevista'] != '--') ? $nuevo[':fechaentrevista'] : 'NULL';
					$nuevo[':totalactivos'] = ($nuevo[':totalactivos'] != '' && $nuevo[':totalactivos'] != '*' && strtoupper($nuevo[':totalactivos']) != 'SD') ? $nuevo[':totalactivos'] : 'NULL';
					$nuevo[':totalpasivos'] = ($nuevo[':totalpasivos'] != '' && $nuevo[':totalpasivos'] != '*' && strtoupper($nuevo[':totalpasivos']) != 'SD') ? $nuevo[':totalpasivos'] : 'NULL';
					
					
					/*foreach ($nuevo as $key => $value) {
						$nuevo[$key] = ($nuevo[$key] === 0) ? "0" : $nuevo[$key];
					}*/
					//$nuevo[':ciiu'] = ($nuevo[':ciiu'] === 0) ? "0" : $nuevo[':ciiu'];
					//$nuevo[':digitochequeo'] = ($nuevo[':digitochequeo'] === 0) ? "0" : $nuevo[':digitochequeo'];
					//echo json_encode($nuevo);
					//exit();
					//INSERTAR REGISTRO
					$SQI = "INSERT INTO data_matriz2 
	(id_client, fecharadicado, fechasolicitud, sucursal, area, lote, formulario, id_official, clasecliente, primerapellido, segundoapellido, nombres, tipodocumento, documento, fechaexpedicion, lugarexpedicion, fechanacimiento, paisnacimiento, lugarnacimiento, nacionalidad_otra, nacionalidad_cual, sexo, nacionalidad, numerohijos, estadocivil, direccionresidencia, ciudadresidencia, telefonoresidencia, nombreempresa, ciudadempresa, direccionempresa, nomenclatura, telefonolaboral, celular, correoelectronico, cargo, actividadeconomicaempresa, profesion, ocupacion, detalleocupacion, ciiu, ingresosmensuales, otrosingresos, egresosmensuales, conceptosotrosingresos, tipoactividad, detalletipoactividad, nivelestudios, tipovivienda, estrato, totalactivos, totalpasivos, razonsocial, nit, digitochequeo, ciudadoficina, direccionoficinappal, nomenclatura_emp, telefonoficina, faxoficina, celularoficina, ciudadsucursal, direccionsucursal, nomenclatura_emp2, telefonosucursal, faxsucursal, actividadeconomicappal, detalleactividadeconomicappal, tipoempresaemp, activosemp, pasivosemp, ingresosmensualesemp, egresosmensualesemp, otrosingresosemp, concepto_otrosingresosemp, obligaciones_otropais, obligaciones_pais, monedaextranjera, tipotransacciones, productos_exterior, cuentas_monedaextranjera, firma, huella, lugarentrevista, fechaentrevista, horaentrevista, tipohoraentrevista, resultadoentrevista, observacionesentrevista, nombreintermediario, ciudad, tipo_solicitud, cual_clasecliente, celularoficinappal, tipoempresaemp_cual, recursos_publicos, poder_publico, reconocimiento_publico, reconocimiento_cual, servidor_publico, expuesta_politica, cargo_politica, cargo_politica_ini, cargo_politica_fin, expuesta_publica, publica_nombre, publica_cargo, repre_internacional, internacional_indique, tributarias_otro_pais, tributarias_paises, ciiu_otro, telefonoficinappal, patrimonio, tipoempresajur, tipoempresajur_otra, correoelectronico_otro, origen_fondos, procedencia_fondos, tipotransacciones_cual, otras_operaciones, reclamaciones, clave_inter, firma_entrevista, verificacion_ciudad, verificacion_fecha, verificacion_hora, verificacion_nombre, verificacion_observacion, verificacion_firma, auto_correo, auto_sms, ppe_es, ppe_vinculo, ppe_admin_recursos_publicos, ppe_tributarias_otros_paises, ppe_paises, fecha_creacion, cantidad_registros, creacion_cliente, fuente)
	VALUES
	(:id_client, :fecharadicado, :fechasolicitud, :sucursal, :area, :lote, :formulario, :id_official, :clasecliente, :primerapellido, :segundoapellido, :nombres, :tipodocumento, :documento, :fechaexpedicion, :lugarexpedicion, :fechanacimiento, :paisnacimiento, :lugarnacimiento, :nacionalidad_otra, :nacionalidad_cual, :sexo, :nacionalidad, :numerohijos, :estadocivil, :direccionresidencia, :ciudadresidencia, :telefonoresidencia, :nombreempresa, :ciudadempresa, :direccionempresa, :nomenclatura, :telefonolaboral, :celular, :correoelectronico, :cargo, :actividadeconomicaempresa, :profesion, :ocupacion, :detalleocupacion, :ciiu, :ingresosmensuales, :otrosingresos, :egresosmensuales, :conceptosotrosingresos, :tipoactividad, :detalletipoactividad, :nivelestudios, :tipovivienda, :estrato, :totalactivos, :totalpasivos, :razonsocial, :nit, :digitochequeo, :ciudadoficina, :direccionoficinappal, :nomenclatura_emp, :telefonoficina, :faxoficina, :celularoficina, :ciudadsucursal, :direccionsucursal, :nomenclatura_emp2, :telefonosucursal, :faxsucursal, :actividadeconomicappal, :detalleactividadeconomicappal, :tipoempresaemp, :activosemp, :pasivosemp, :ingresosmensualesemp, :egresosmensualesemp, :otrosingresosemp, :concepto_otrosingresosemp, :obligaciones_otropais, :obligaciones_pais, :monedaextranjera, :tipotransacciones, :productos_exterior, :cuentas_monedaextranjera, :firma, :huella, :lugarentrevista, :fechaentrevista, :horaentrevista, :tipohoraentrevista, :resultadoentrevista, :observacionesentrevista, :nombreintermediario, :ciudad, :tipo_solicitud, :cual_clasecliente, :celularoficinappal, :tipoempresaemp_cual, :recursos_publicos, :poder_publico, :reconocimiento_publico, :reconocimiento_cual, :servidor_publico, :expuesta_politica, :cargo_politica, :cargo_politica_ini, :cargo_politica_fin, :expuesta_publica, :publica_nombre, :publica_cargo, :repre_internacional, :internacional_indique, :tributarias_otro_pais, :tributarias_paises, :ciiu_otro, :telefonoficinappal, :patrimonio, :tipoempresajur, :tipoempresajur_otra, :correoelectronico_otro, :origen_fondos, :procedencia_fondos, :tipotransacciones_cual, :otras_operaciones, :reclamaciones, :clave_inter, :firma_entrevista, :verificacion_ciudad, :verificacion_fecha, :verificacion_hora, :verificacion_nombre, :verificacion_observacion, :verificacion_firma, :auto_correo, :auto_sms, :ppe_es, :ppe_vinculo, :ppe_admin_recursos_publicos, :ppe_tributarias_otros_paises, :ppe_paises, :fecha_creacion, :cantidad_registros, :creacion_cliente, :fuente)";
					try{
						$conn->ejecutar($SQI, $nuevo);
					}catch(Exception $e){
						//echo json_encode();
						fputcsv($fh, [$e->getMessage(), $e->getCode(), json_encode($nuevo), 'Registro#'.$j], '|');
						//throw new Exception($e->getMessage(), $e->getCode());
						//exit();
					}
					unset($primero);
					unset($nuevo);
				}
				$j++;
			}
		}
	}
}
/*function verificarCero($value){
	if($)
}*/
?>