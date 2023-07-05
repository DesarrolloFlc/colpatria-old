<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CLASS . DS . '_conexion.php';
cargarDatosDirTelDataSeguros();
function cargarDatosDirTelDataSeguros(){
	echo "La carga inicio a las ".date('Y-m-d H:i:s');
	$conn = new Conexion();
	$SQL = "SELECT d.direccionresidencia,
				   d.ciudadresidencia,
				   d.telefonoresidencia,
				   d.ciudadempresa, 
				   d.direccionempresa, 
				   d.telefonolaboral,
				   d.celular, 
				   d.correoelectronico,
				   d.ciudadoficina, 
				   d.direccionoficinappal,
				   d.telefonoficina,
				   d.faxoficina,
				   d.celularoficina,
				   d.ciudadsucursal,
				   d.direccionsucursal,
				   d.telefonosucursal,
				   d.faxsucursal,
				   d.celularoficinappal,
				   d.telefonoficinappal,
				   d.correoelectronico_otro,
				   f.id_client
			  FROM data AS d
			 INNER JOIN form AS f ON(f.id = d.id_form)
			 WHERE 1
			 ORDER BY f.id_client";
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			while($dat = $conn->sacarRegistro('str')){
				$ct = array(
					'cliente_id'=> $dat['id_client'],
					'telefono'=> '',
					'cod_ciudad'=> "NULL",
					'ciudad'=> "NULL",
					'tipo_demografico_id'=> 1,
					'origen_id'=> 4
				);
				if(isset($dat['telefonoresidencia']) && !empty(trim($dat['telefonoresidencia']))){
					$ct['telefono'] = $dat['telefonoresidencia'];
					$ct['cod_ciudad'] = (isset($dat['ciudadresidencia']) && !empty(trim($dat['ciudadresidencia']))) ? trim($dat['ciudadresidencia']) : "NULL";
					$telId = verificarTelefono($ct);
				}
				if(isset($dat['telefonolaboral']) && !empty(trim($dat['telefonolaboral']))){
					$ct['telefono'] = $dat['telefonolaboral'];
					$ct['cod_ciudad'] = (isset($dat['ciudadempresa']) && !empty(trim($dat['ciudadempresa']))) ? trim($dat['ciudadempresa']) : "NULL";
					$telId = verificarTelefono($ct);
				}
				if(isset($dat['celular']) && !empty(trim($dat['celular']))){
					$ct['telefono'] = $dat['celular'];
					$ct['cod_ciudad'] = "NULL";
					$ct['tipo_demografico_id'] = "5";
					$telId = verificarTelefono($ct);
				}
				if(isset($dat['telefonoficina']) && !empty(trim($dat['telefonoficina']))){
					$ct['telefono'] = $dat['telefonoficina'];
					$ct['cod_ciudad'] = (isset($dat['ciudadoficina']) && !empty(trim($dat['ciudadoficina']))) ? trim($dat['ciudadoficina']) : "NULL";
					$telId = verificarTelefono($ct);
				}
				if(isset($dat['celularoficina']) && !empty(trim($dat['celularoficina']))){
					$ct['telefono'] = $dat['celularoficina'];
					$ct['cod_ciudad'] = "NULL";
					$ct['tipo_demografico_id'] = "5";
					$telId = verificarTelefono($ct);
				}
				if(isset($dat['celularoficinappal']) && !empty(trim($dat['celularoficinappal']))){
					$ct['telefono'] = $dat['celularoficinappal'];
					$ct['cod_ciudad'] = "NULL";
					$ct['tipo_demografico_id'] = "5";
					$telId = verificarTelefono($ct);
				}
				if(isset($dat['telefonoficinappal']) && !empty(trim($dat['telefonoficinappal']))){
					$ct['telefono'] = $dat['telefonoficinappal'];
					$ct['cod_ciudad'] = (isset($dat['ciudadoficina']) && !empty(trim($dat['ciudadoficina']))) ? trim($dat['ciudadoficina']) : "NULL";
					$telId = verificarTelefono($ct);
				}
				$cd = array(
					'cliente_id'=> $dat['id_client'],
					'direccion'=> '',
					'cod_ciudad'=> "NULL",
					'ciudad'=> "NULL",
					'tipo_demografico_id'=> 2,
					'origen_id'=> 4
				);
		        if(isset($dat['direccionresidencia']) && !empty($dat['direccionresidencia']) && strlen($dat['direccionresidencia']) > 1 && $dat['direccionresidencia'] != 'SD' && $dat['direccionresidencia'] != 'NA' && $dat['direccionresidencia'] != 'N/A'){
		        	$cd['direccion'] = $dat['direccionresidencia'];
					$cd['cod_ciudad'] = (isset($dat['ciudadresidencia']) && !empty(trim($dat['ciudadresidencia']))) ? trim($dat['ciudadresidencia']) : "NULL";
					$ciuId = verificarDireccion($cd);
		        }
		        if(isset($dat['direccionempresa']) && !empty($dat['direccionempresa']) && strlen($dat['direccionempresa']) > 1 && $dat['direccionempresa'] != 'SD' && $dat['direccionempresa'] != 'NA' && $dat['direccionempresa'] != 'N/A'){
		        	$cd['direccion'] = $dat['direccionempresa'];
					$cd['cod_ciudad'] = (isset($dat['ciudadempresa']) && !empty(trim($dat['ciudadempresa']))) ? trim($dat['ciudadempresa']) : "NULL";
					$ciuId = verificarDireccion($cd);
		        }
		        if(isset($dat['direccionoficinappal']) && !empty($dat['direccionoficinappal']) && strlen($dat['direccionoficinappal']) > 1 && $dat['direccionoficinappal'] != 'SD' && $dat['direccionoficinappal'] != 'NA' && $dat['direccionoficinappal'] != 'N/A'){
		        	$cd['direccion'] = $dat['direccionoficinappal'];
					$cd['cod_ciudad'] = (isset($dat['ciudadoficina']) && !empty(trim($dat['ciudadoficina']))) ? trim($dat['ciudadoficina']) : "NULL";
					$ciuId = verificarDireccion($cd);
		        }
		        if(isset($dat['direccionsucursal']) && !empty($dat['direccionsucursal']) && strlen($dat['direccionsucursal']) > 1 && $dat['direccionsucursal'] != 'SD' && $dat['direccionsucursal'] != 'NA' && $dat['direccionsucursal'] != 'N/A'){
		        	$cd['direccion'] = $dat['direccionsucursal'];
					$cd['cod_ciudad'] = "NULL";
					$ciuId = verificarDireccion($cd);
		        }
				if(isset($dat['correoelectronico']) && !empty(trim($dat['correoelectronico'])) && trim($dat['correoelectronico']) != 'NULL' && $dat['correoelectronico'] != 'SD' && $dat['correoelectronico'] != 'NA' && $dat['correoelectronico'] != 'N/A'){
					$cd['direccion'] = $dat['correoelectronico'];
					$cd['ciudad'] = "NULL";
					$cd['tipo_demografico_id'] = "5";
					$ciuId = verificarDireccion($cd);
				}
				if(isset($dat['correoelectronico_otro']) && !empty(trim($dat['correoelectronico_otro'])) && trim($dat['correoelectronico_otro']) != 'NULL' && $dat['correoelectronico_otro'] != 'SD' && $dat['correoelectronico_otro'] != 'NA' && $dat['correoelectronico_otro'] != 'N/A'){
					$cd['direccion'] = $dat['correoelectronico_otro'];
					$cd['ciudad'] = "NULL";
					$cd['tipo_demografico_id'] = "5";
					$ciuId = verificarDireccion($cd);
				}
			}
			echo " :: La carga termino a las ".date('Y-m-d H:i:s');
		}
	}
}
function verificarTelefono($dato){
	$conn = new Conexion();
	$SQL = "SELECT id 
			  FROM telefono 
			 WHERE cliente_id = :cliente_id
			   AND telefono = :telefono";
	if($conn->consultar($SQL, array(':cliente_id'=> $dato['cliente_id'], ':telefono'=> trim($dato['telefono'])))){
		$cantReg = $conn->getNumeroRegistros();
		if($cantReg >= 1){
			$da = $conn->sacarRegistro('str');
			$conn->desconectar();
			return $da['id'];
		}else{
			$SQU = "INSERT INTO telefono 
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
					$conn->desconectar();
					return $ultimaId;
				}else{
					$conn->desconectar();
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
function verificarDireccion($dato){
	$conn = new Conexion();
	$SQL = "SELECT id 
			  FROM direccion 
			 WHERE cliente_id = :cliente_id
			   AND direccion = :direccion";
	if($conn->consultar($SQL, array(':cliente_id'=> $dato['cliente_id'], ':direccion'=> trim($dato['direccion'])))){
		$cantReg = $conn->getNumeroRegistros();
		if($cantReg >= 1){
			$da = $conn->sacarRegistro('str');
			$conn->desconectar();
			return $da['id'];
		}else{
			$SQU = "INSERT INTO direccion 
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
					$conn->desconectar();
					return $ultimaId;
				}else{
					$conn->desconectar();
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
?>