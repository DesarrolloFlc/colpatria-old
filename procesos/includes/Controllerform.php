<?php
if (!isset($_SESSION)) session_start();

require_once PATH_CCLASS . DS . 'formulario.php';
function formularioDigitarAction($request){
	switch ($request['type']) {
		case '1':
		case '6':
		case '7':
		case '9':
			$tipoPersona = Formulario::getTipoPersona();
			break;
		case '4':
			$tipoDocumento = Formulario::getTipoDocumento();
			$ciudades = Formulario::getCiudades();
			$ocupaciones = Formulario::getOcupaciones();
			$acteconomicas = Formulario::getActividades();
			break;
		
		default:
			# code...
			break;
	}
	require_once PATH_INTERNAL . DS . $request['action'] . '_' . $request['type'] . '_' . 'View.php';
}
function formularioNuevoTipoAction($request){
	$lote = (isset($request['lote']) && $request['lote'] != '' && strlen($request['lote']) > 5) ? substr($request['lote'], 5, strlen($request['lote'])) : 'NULL';
	$radInfo = [];
	if($lote != 'NULL')
		$radInfo = Formulario::obtenerInformacionRadicado($lote);

	$daneCiudades = Formulario::getCiudadesDanes();
	$sucursales = Formulario::getSucursalesLista();
	$clasesVinculacion = Formulario::getclaseVinculacion();
	$tipoDocumentos = Formulario::getTipoDocumentoID();
	$tipoempresas = Formulario::getTipoEmpresaID();
	$actEconomicas = Formulario::getActividadesEconomicas();
	$ciius = Formulario::getCiiuId();
	$profesiones = Formulario::getProfesionesID();
	$ingresos = Formulario::getIngresosMensualesID();
	$egresos = Formulario::getEgresosMensualesID();
	$transacciones = Formulario::getTipoTransaccionesID();
	$paises = Formulario::getPaisesID();
	$areas = Formulario::getAreasID();
	$funcionarios = Formulario::getOfficials();
	$tipo_persona = Formulario::getTipoPersona();
	require_once PATH_INTERNAL.DS.$request['action'].'View.php';
}
function formularioAntiguoTipoAction($request){
	$lote = (isset($request['lote']) && $request['lote'] != '' && strlen($request['lote']) > 5) ? substr($request['lote'], 5, strlen($request['lote'])) : 'NULL';
	$radInfo = [];
	if($lote != 'NULL')
		$radInfo = Formulario::obtenerInformacionRadicado($lote);

	$sucursales = Formulario::getSucursalesLista();
	$actividades = Formulario::getActividades();
	$claseclientes = Formulario::getClaseCliente();
	$egresos_mensuales = Formulario::getEgresosMensuales();
	$egresos_mensuales_emp = Formulario::getEgresosMensualesEmp();
	$estados_civiles = Formulario::getEstadosCiviles();
	$estudios = Formulario::getEstudios();
	$ingresos_mensuales = Formulario::getIngresosMensuales();
	$ingresos_mensuales_emp = Formulario::getIngresosMensualesEmp();
	$ocupaciones = Formulario::getOcupaciones();
	$otros_ingresos = Formulario::getOtrosIngresos();
	$profesiones = Formulario::getProfesionesID();
	$sexo = Formulario::getSexo();
	$tipo_documentos = Formulario::getTipoDocumento();
	$tipo_empresa = Formulario::getTipoEmpresaID('1');
	$tipo_persona = Formulario::getTipoPersona();
	$tipo_transacciones = Formulario::getTipoTransacciones();
	$tipo_viviendas = Formulario::getTipoVivienda();
	$tipo_actividades = Formulario::getTiposActividad();
	$ciius = Formulario::getCiiuId();
	$ciudades = Formulario::getCiudades();
	$paises = Formulario::getPais();
	$actividades_econo = Formulario::getActividadEcono();
	$areas = Formulario::getAreasID();
	$formularios = Formulario::getFormularios();
	$officials = Formulario::getOfficials();
	require_once PATH_INTERNAL.DS.$request['action'].'View.php';
}
function formularioNuevoTipoCe02720Action($request){
	$lote = (isset($request['lote']) && $request['lote'] != '' && strlen($request['lote']) > 5) 
		? substr($request['lote'], 5, strlen($request['lote'])) 
		: 'NULL';
	$radInfo = [];
	if ($lote != 'NULL') $radInfo = Formulario::obtenerInformacionRadicado($lote);
	$daneCiudades = Formulario::getCiudadesDanes();
	$sucursales = Formulario::getSucursalesLista();
	$clasesVinculacion = Formulario::getclaseVinculacion();
	$tipoDocumentos = Formulario::getTipoDocumentoID();
	$tipoempresas = Formulario::getTipoEmpresaID();
	$actEconomicas = Formulario::getActividadesEconomicas();
	$ciius = Formulario::getCiiuId();
	$profesiones = Formulario::getProfesionesID();
	$ingresos = Formulario::getIngresosMensualesID();
	$egresos = Formulario::getEgresosMensualesID();
	$transacciones = Formulario::getTipoTransaccionesID();
	$paises = Formulario::getPaisesID();
	$areas = Formulario::getAreasID();
	$funcionarios = Formulario::getOfficials();
	$tipo_persona = Formulario::getTipoPersona();
	require_once PATH_INTERNAL . DS . $request['action'] . '_View.php';
}
function formularioSectorAseguradoAction($request){
	$lote = (isset($request['lote']) && $request['lote'] != '' && strlen($request['lote']) > 5) ? substr($request['lote'], 5, strlen($request['lote'])) : 'NULL';
	$radInfo = [];
	if($lote != 'NULL')
		$radInfo = Formulario::obtenerInformacionRadicado($lote);
	$daneCiudades = Formulario::getCiudadesDanes();
	$sucursales = Formulario::getSucursalesLista();
	$clasesVinculacion = Formulario::getclaseVinculacion();
	$tipoDocumentos = Formulario::getTipoDocumentoID();
	$tipoempresas = Formulario::getTipoEmpresaID();
	$actEconomicas = Formulario::getActividadesEconomicas();
	$ciius = Formulario::getCiiuId();
	$profesiones = Formulario::getProfesionesID();
	$ingresos = Formulario::getIngresosMensualesID();
	$egresos = Formulario::getEgresosMensualesID();
	$transacciones = Formulario::getTipoTransaccionesID();
	$paises = Formulario::getPaisesID();
	$areas = Formulario::getAreasID();
	$funcionarios = Formulario::getOfficials();
	$tipo_persona = Formulario::getTipoPersona();
	require_once PATH_INTERNAL.DS.$request['action'].'_View.php';
}
function _formularioAntiguoTipoAction2($request){
	$daneCiudades = Formulario::getCiudadesDanes();
	$sucursales = Formulario::getSucursalesLista();
	$clasesVinculacion = Formulario::getclaseVinculacion();
	$tipoDocumentos = Formulario::getTipoDocumentoID();
	$tipoempresas = Formulario::getTipoEmpresaID();
	$actEconomicas = Formulario::getActividadesEconomicas();
	$ciius = Formulario::getCiiuId();
	$profesiones = Formulario::getProfesionesID();
	$ingresos = Formulario::getIngresosMensualesID();
	$egresos = Formulario::getEgresosMensualesID();
	$transacciones = Formulario::getTipoTransaccionesID();
	$paises = Formulario::getPaisesID();
	$areas = Formulario::getAreasID();
	$funcionarios = Formulario::getOfficials();
	require_once PATH_INTERNAL.DS.$request['action'].'View.php';
}
function guardarFormularioNuevoAction($request){
	$request['fecharadicado'] = '0000-00-00';
	$request['fechasolicitud'] = '0000-00-00';
	$request['fechaexpedicion'] = '0000-00-00';
	$request['fechanacimiento'] = '0000-00-00';
	$request['cargo_politica_ini'] = '0000-00-00';
	$request['cargo_politica_fin'] = '0000-00-00';
	$request['fechaentrevista'] = '0000-00-00';
	$request['verificacion_fecha'] = '0000-00-00';
	$request['horaentrevista'] = '00:00:00';
	$request['verificacion_hora'] = '00:00:00';
	if((isset($request['f_rad_a']) && !empty($request['f_rad_a'])) && (isset($request['f_rad_m']) && !empty($request['f_rad_m'])) && (isset($request['f_rad_d']) && !empty($request['f_rad_d']))){
		if(date('Y-m-d', strtotime($request['f_rad_a'].'-'.$request['f_rad_m'].'-'.$request['f_rad_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de radicado no puede ser errada."));
			exit;
		}else
			$request['fecharadicado'] = date('Y-m-d', strtotime($request['f_rad_a'].'-'.$request['f_rad_m'].'-'.$request['f_rad_d']));
	}else{
		echo json_encode(array("error"=> "La fecha de radicado no puede ser vacia."));
		exit;
	}
	if((isset($request['f_dil_a']) && !empty($request['f_dil_a'])) && (isset($request['f_dil_m']) && !empty($request['f_dil_m'])) && (isset($request['f_dil_d']) && !empty($request['f_dil_d']))){
		if(date('Y-m-d', strtotime($request['f_dil_a'].'-'.$request['f_dil_m'].'-'.$request['f_dil_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser errada."));
			exit;
		}else
			$request['fechasolicitud'] = date('Y-m-d', strtotime($request['f_dil_a'].'-'.$request['f_dil_m'].'-'.$request['f_dil_d']));
	}else{
		echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser vacia."));
		exit;
	}
	if((isset($request['f_exp_a']) && !empty($request['f_exp_a'])) && (isset($request['f_exp_m']) && !empty($request['f_exp_m'])) && (isset($request['f_exp_d']) && !empty($request['f_exp_d']))){
		if(date('Y-m-d', strtotime($request['f_exp_a'].'-'.$request['f_exp_m'].'-'.$request['f_exp_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de expedicion no puede ser errada."));
			exit;
		}else
			$request['fechaexpedicion'] = date('Y-m-d', strtotime($request['f_exp_a'].'-'.$request['f_exp_m'].'-'.$request['f_exp_d']));
	}
	if((isset($request['f_nac_a']) && !empty($request['f_nac_a'])) && (isset($request['f_nac_m']) && !empty($request['f_nac_m'])) && (isset($request['f_nac_d']) && !empty($request['f_nac_d']))){
		if(date('Y-m-d', strtotime($request['f_nac_a'].'-'.$request['f_nac_m'].'-'.$request['f_nac_d'])) == '1969-12-31' && ($request['f_nac_a'] != '1969' || $request['f_nac_m'] != '12' || $request['f_nac_d'] != '31')){
			echo json_encode(array("error"=> "La fecha de nacimento no puede ser errada."));
			exit;
		}else
			$request['fechanacimiento'] = date('Y-m-d', strtotime($request['f_nac_a'].'-'.$request['f_nac_m'].'-'.$request['f_nac_d']));
	}
	if($request['expuesta_politica'] == '-1'){
		if((isset($request['f_ini_a']) && !empty($request['f_ini_a'])) && (isset($request['f_ini_m']) && !empty($request['f_ini_m'])) && (isset($request['f_ini_d']) && !empty($request['f_ini_d']))){
			if(date('Y-m-d', strtotime($request['f_ini_a'].'-'.$request['f_ini_m'].'-'.$request['f_ini_d'])) == '1969-12-31'){
				echo json_encode(array("error"=> "La fecha inicial no puede ser errada."));
				exit;
			}else
				$request['cargo_politica_ini'] = date('Y-m-d', strtotime($request['f_ini_a'].'-'.$request['f_ini_m'].'-'.$request['f_ini_d']));
		}
		if((isset($request['f_fin_a']) && !empty($request['f_fin_a'])) && (isset($request['f_fin_m']) && !empty($request['f_fin_m'])) && (isset($request['f_fin_d']) && !empty($request['f_fin_d']))){
			if(date('Y-m-d', strtotime($request['f_fin_a'].'-'.$request['f_fin_m'].'-'.$request['f_fin_d'])) == '1969-12-31'){
				echo json_encode(array("error"=> "La fecha final no puede ser errada."));
				exit;
			}else
				$request['cargo_politica_fin'] = date('Y-m-d', strtotime($request['f_fin_a'].'-'.$request['f_fin_m'].'-'.$request['f_fin_d']));
		}
	}elseif($request['expuesta_politica'] == '2'){
		$request['cargo_politica_ini'] = '0000-00-00';
		$request['cargo_politica_fin'] = '0000-00-00';
	}
	if((isset($request['f_ent_a']) && !empty($request['f_ent_a'])) && (isset($request['f_ent_m']) && !empty($request['f_ent_m'])) && (isset($request['f_ent_d']) && !empty($request['f_ent_d']))){
		if(date('Y-m-d', strtotime($request['f_ent_a'].'-'.$request['f_ent_m'].'-'.$request['f_ent_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de entrevista no puede ser errada."));
			exit;
		}else
			$request['fechaentrevista'] = date('Y-m-d', strtotime($request['f_ent_a'].'-'.$request['f_ent_m'].'-'.$request['f_ent_d']));
	}
	if((isset($request['f_ver_a']) && !empty($request['f_ver_a'])) && (isset($request['f_ver_m']) && !empty($request['f_ver_m'])) && (isset($request['f_ver_d']) && !empty($request['f_ver_d']))){
		if(date('Y-m-d', strtotime($request['f_ver_a'].'-'.$request['f_ver_m'].'-'.$request['f_ver_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de verificacion no puede ser errada."));
			exit;
		}else
			$request['verificacion_fecha'] = date('Y-m-d', strtotime($request['f_ver_a'].'-'.$request['f_ver_m'].'-'.$request['f_ver_d']));
	}
	if((isset($request['h_ent_h']) && !empty($request['h_ent_h'])) && (isset($request['h_ent_m']) && !empty($request['h_ent_m']))){
		$request['horaentrevista'] = $request['h_ent_h'].':'.$request['h_ent_m'];
	}
	$request['tipohoraentrevista'] = $request['h_ent_z'];
	if((isset($request['h_ver_h']) && !empty($request['h_ver_h'])) && (isset($request['h_ver_m']) && !empty($request['h_ver_m'])) && (isset($request['h_ver_z']) && !empty($request['h_ver_z']))){
		$request['verificacion_hora'] = date('H:i', strtotime($request['h_ver_h'].':'.$request['h_ver_m'].' '.$request['h_ver_z']));
	}
	if($request['clasecliente'] != '10')
		$request['cual_clasecliente'] = 'SD';
	if($request['tipoempresaemp'] != '5')
		$request['tipoempresaemp_cual'] = 'SD';
	if($request['reconocimiento_publico'] == '0' || $request['reconocimiento_publico'] == '2')
		$request['reconocimiento_cual'] = 'SD';

	if($request['expuesta_politica'] == '0' || $request['expuesta_politica'] == '2')
		$request['cargo_politica'] = 'SD';

	if($request['expuesta_publica'] == '0' || $request['expuesta_publica'] == '2'){
		$request['publica_nombre'] = 'SD';
		$request['publica_cargo'] = 'SD';
	}
	if($request['repre_internacional'] == '0' || $request['repre_internacional'] == '2')
		$request['internacional_indique'] = 'SD';
	if($request['tributarias_otro_pais'] == '0' || $request['tributarias_otro_pais'] == '2')
		$request['tributarias_paises'] = 'SD';
	if(isset($request['tipoempresajur']) && $request['tipoempresajur'] != '5')
		$request['tipoempresajur_otra'] = 'SD';
	if(($request['monedaextranjera'] == '0' || $request['monedaextranjera'] == '2') && !isset($request['tipotransacciones'])){
		$request['tipotransacciones'] = '8';
		$request['tipotransacciones_cual'] = 'SD';
	}elseif($request['monedaextranjera'] == '0' && $request['tipotransacciones'] != '7'){
		$request['tipotransacciones_cual'] = 'SD';
	}
	if($request['tipopersona'] == '2'){
		$request['tipoactividad'] = '900';
		$request['profesion'] = '900';
		$request['cargo'] = 'SD';
		$request['actividadeconomicaempresa'] = '4';
		$request['ciiu_otro'] = '0';
		$request['telefonoficinappal'] = '*';
		$request['detalletipoactividad'] = 'SD';
		$request['ingresosmensuales'] = '13';
		$request['totalactivos'] = '*';
		$request['totalpasivos'] = '*';
		$request['egresosmensuales'] = '13';
		$request['otrosingresos'] = '13';
		$request['conceptosotrosingresos'] = 'SD';
	}elseif($request['tipopersona'] == '1'){
		$request['razonsocial'] = 'SD';
		$request['nit'] = '*';
		$request['digitochequeo'] = '0';
		$request['tipoempresajur'] = '4';
		$request['tipoempresajur_otra'] = 'SD';
		$request['detalleactividadeconomicappal'] = 'SD';
		$request['ciudadoficina'] = '99999';
		$request['telefonoficina'] = '*';
		$request['correoelectronico_otro'] = 'SD';
		$request['celularoficina'] = '*';
		$request['direccionsucursal'] = 'SD';
		$request['ingresosmensualesemp'] = '7';
		$request['activosemp'] = '*';
		$request['pasivosemp'] = '*';
		$request['egresosmensualesemp'] = '7';
		$request['otrosingresosemp'] = '7';
		$request['concepto_otrosingresosemp'] = 'SD';
	}
	if(!isset($request['actividadeconomicaempresa']))
		$request['actividadeconomicaempresa'] = '4';
	if(!isset($request['tipotransacciones']))
		$request['tipotransacciones'] = '8';
	if(!isset($request['tipotransacciones_cual']))
		$request['tipotransacciones_cual'] = 'SD';

	if(!isset($request['telefonoresidencia']) || empty($request['telefonoresidencia']))
		$request['telefonoresidencia'] = '*';
	if(!isset($request['celular']) || empty($request['celular']))
		$request['celular'] = '*';
	if(!isset($request['telefonolaboral']) || empty($request['telefonolaboral']))
		$request['telefonolaboral'] = '*';
	if(!isset($request['celularoficinappal']) || empty($request['celularoficinappal']))
		$request['celularoficinappal'] = '*';
	if(!isset($request['telefonoficinappal']) || empty($request['telefonoficinappal']))
		$request['telefonoficinappal'] = '*';
	if(!isset($request['telefonoficina']) || empty($request['telefonoficina']))
		$request['telefonoficina'] = '*';
	if(!isset($request['celularoficina']) || empty($request['celularoficina']))
		$request['celularoficina'] = '*';

	////error_log(json_encode($request), 0);
	if((!empty($request['documento']) || !empty($request['nit']) ) && !empty($request['tipopersona'])){
		//error_log(json_encode(array($request['documento'], $request['nit'], $request['tipopersona'])), 0);
		//error_log("message: entro aqui!", 0);
		if(!empty($request['nit']) && $request['tipopersona'] == "2")
			$cliente_id = Formulario::obtenerIdCliente($request['nit'], $request['tipopersona']);

		if(!empty($request['documento']) && $request['tipopersona'] == "1")
			$cliente_id = Formulario::obtenerIdCliente($request['documento'], $request['tipopersona']);

		if(isset($cliente_id) && !empty($cliente_id) && $cliente_id !== false){
			//error_log("message: ".$cliente_id, 0);
			Formulario::activeCliente($cliente_id);
			//$lastData = Formulario::obtenerUltimoFormData($cliente_id);
			$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
			if(isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])){
				echo json_encode(array("error"=> "1. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => ".$exForm['id'].", por favor contacte con el administrador."));
				exit;
			}
			if($form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca'])){
				if(isset($form_id) && !empty($form_id) && $form_id !== false){
					try{
						if($idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id)){
							//CUENTAS EN MONEDA EXTRANJERA
							if(isset($request['cuentas_monedaextranjera']) && $request['cuentas_monedaextranjera'] == '-1'){
								for ($i = 0; $i < 3; $i++) { 
									if(!empty($request['producto_tipo'][$i]) || !empty($request['producto_identificacion'][$i]) || !empty($request['producto_entidad'][$i]) || !empty($request['producto_monto'][$i]) || !empty($request['
										producto_ciudad'][$i]) || !empty($request['producto_pais'][$i]) || !empty($request['producto_moneda'][$i])){
										Formulario::insertCuentas($idData, $request['producto_tipo'][$i], $request['producto_identificacion'][$i], $request['producto_entidad'][$i], $request['producto_monto'][$i], $request['producto_ciudad'][$i], $request['producto_pais'][$i], $request['producto_moneda'][$i]);
									}
								}
							}
							//RECLAMACIONES
							if(isset($request['reclamaciones']) && $request['reclamaciones'] == '-1'){
								for ($j = 0; $j < 2; $j++) {
									if(!empty($request['rec_ano'][$j]) || !empty($request['rec_ramo'][$j]) || !empty($request['rec_compania'][$j]) || !empty($request['rec_valor'][$j]) || !empty($request['rec_resultado'][$j])){
										Formulario::insertReclamaciones($idData, $request['rec_ano'][$j], $request['rec_ramo'][$j], $request['rec_compania'][$j], $request['rec_valor'][$j], $request['rec_resultado'][$j]);
									}
								}
							}
							if($request['tipopersona'] == '2'){
								for($k = 0; $k < 5; $k++){
									if (!empty($request['identificacion'][$k]) && $request['identificacion'][$k] != 'SD' && $request['identificacion'][$k] != 'NA' && $request['identificacion'][$k] != 'N/A' && $request['identificacion'][$k] != '*') {
										Formulario::insertAccionistas($idData, $request['tipo_id'][$k], $request['identificacion'][$k], $request['nombre_accionista'][$k], $request['porcentaje'][$k], $request['publico_recursos'][$k], $request['publico_reconocimiento'][$k], $request['publico_expuesta'][$k], $request['declaracion_tributaria'][$k]);
									}
								}
							}
							$err_img = '';
							//error_log("antes dde: ".$request['id_imagen_tmp'], 0);
							if($imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp'])){
								//error_log(json_encode(array($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp'])), 0);
								$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']);
							}else
								$err_img = 'No se encontro la imagen con el identificador: '.$request['id_imagen_tmp'];

							//error_log("message: ".$err_img, 0);

							if($request['tipopersona'] == '1')
								$documentVerf = $request['documento'];
							else
								$documentVerf = $request['nit'];
							Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);

							Formulario::guardarPlanillaLote($request['planilla_lote'], $request['lote'], $_SESSION['id']);
							
							Formulario::addIndexacion($form_id, $_SESSION['id']);

							$mensaje = 'Se agrego la nueva digitacion';
							if(!empty($err_img))
								$mensaje .= ', con el siguiente problema: '.$err_img;
							echo json_encode(array('exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id));

						}else{
							echo json_encode(array('error'=> 'Ocurrio un error al momento de crear la data del formulario, por favor contacte con el administrador.'));
							exit;
						}
					}catch(Exception $e){
						var_dump($e);
						echo json_encode(array('error'=> $e->getMessage()));
					}
				}else{
					echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador...'));
					exit;
				}
			}else{
				echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador.'));
				exit;
			}
		}else{
			if(!empty($request['nit']) && $request['tipopersona'] == "2")
				$cliente_id = Formulario::crearNuevoCliente($request['nit'], $request['tipopersona'], $request['razonsocial']);
			elseif(!empty($request['documento']) && $request['tipopersona'] == "1")
				$cliente_id = Formulario::crearNuevoCliente($request['documento'], $request['tipopersona'], $request['primerapellido'] . " " . $request['segundoapellido'] . " " . $request['nombres']);

			if(isset($cliente_id) && !empty($cliente_id) && $cliente_id !== false){
				//Formulario::activeCliente($cliente_id);
				//$lastData = Formulario::obtenerUltimoFormData($cliente_id);
				$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
				if(isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])){
					echo json_encode(array("error"=> "2. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => ".$exForm['id'].", por favor contacte con el administrador."));
					exit;
				}
				if($form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca'])){
					if(isset($form_id) && !empty($form_id) && $form_id !== false){
						try{
							if($idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id)){
								//CUENTAS EN MONEDA EXTRANJERA
								if(isset($request['cuentas_monedaextranjera']) && $request['cuentas_monedaextranjera'] == '-1'){
									for ($i = 0; $i < 3; $i++) { 
										if(!empty($request['producto_tipo'][$i]) || !empty($request['producto_identificacion'][$i]) || !empty($request['producto_entidad'][$i]) || !empty($request['producto_monto'][$i]) || !empty($request['
											producto_ciudad'][$i]) || !empty($request['producto_pais'][$i]) || !empty($request['producto_moneda'][$i])){
											Formulario::insertCuentas($idData, $request['producto_tipo'][$i], $request['producto_identificacion'][$i], $request['producto_entidad'][$i], $request['producto_monto'][$i], $request['producto_ciudad'][$i], $request['producto_pais'][$i], $request['producto_moneda'][$i]);
										}
									}
								}
								//RECLAMACIONES
								if(isset($request['reclamaciones']) && $request['reclamaciones'] == '-1'){
									for ($j = 0; $j < 2; $j++) {
										if(!empty($request['rec_ano'][$j]) || !empty($request['rec_ramo'][$j]) || !empty($request['rec_compania'][$j]) || !empty($request['rec_valor'][$j]) || !empty($request['rec_resultado'][$j])){
											Formulario::insertReclamaciones($idData, $request['rec_ano'][$j], $request['rec_ramo'][$j], $request['rec_compania'][$j], $request['rec_valor'][$j], $request['rec_resultado'][$j]);
										}
									}
								}
								if($request['tipopersona'] == '2'){
									for($k = 0; $k < 5; $k++){
										if (!empty($request['identificacion'][$k]) && $request['identificacion'][$k] != 'SD' && $request['identificacion'][$k] != 'NA' && $request['identificacion'][$k] != 'N/A' && $request['identificacion'][$k] != '*') {
											Formulario::insertAccionistas($idData, $request['tipo_id'][$k], $request['identificacion'][$k], $request['nombre_accionista'][$k], $request['porcentaje'][$k], $request['publico_recursos'][$k], $request['publico_reconocimiento'][$k], $request['publico_expuesta'][$k], $request['declaracion_tributaria'][$k]);
										}
									}
								}
								$err_img = '';
								if($imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp'])){
									$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']);
								}else
									$err_img = 'No se encontro la imagen con el identificador: '.$request['id_imagen_tmp'];

								if($request['tipopersona'] == '1')
									$documentVerf = $request['documento'];
								else
									$documentVerf = $request['nit'];
								Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);

								Formulario::guardarPlanillaLote($request['planilla_lote'], $request['lote'], $_SESSION['id']);
							
								Formulario::addIndexacion($form_id, $_SESSION['id']);

								$mensaje = 'Se agrego la nueva digitacion';
								if(!empty($err_img))
									$mensaje .= ', con el siguiente problema: '.$err_img;
								echo json_encode(array('exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id));

							}else{
								echo json_encode(array('error'=> 'Ocurrio un error al momento de crear la data del formulario, por favor contacte con el administrador.'));
								exit;
							}
						}catch(Exception $e){
							echo json_encode(array('error'=> $e->getMessage()));
						}
					}else{
						echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador...'));
						exit;
					}
				}else{
					echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador.'));
					exit;
				}
			}else{
				echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el cliente, por favor contacte con el administrador.'));
				exit;
			}
		}
	}else{
		echo json_encode(array('error'=> 'El numero de documento del cliente no puede estar vacion, por favor verifiquelo.'));
		exit;
	}
}
function guardarFormularioAntiguoAction($request){
	$request['fechasolicitud'] = '0000-00-00';
	$request['fechaexpedicion'] = '0000-00-00';
	$request['fechanacimiento'] = '0000-00-00';
	$request['fechaentrevista'] = '0000-00-00';
	$request['fecharadicado'] = '0000-00-00';

	if((isset($request['fechasolicitud_a']) && !empty($request['fechasolicitud_a']) && $request['fechasolicitud_a'] != '0000') && (isset($request['fechasolicitud_m']) && !empty($request['fechasolicitud_m']) && $request['fechasolicitud_m'] != '00') && (isset($request['fechasolicitud_d']) && !empty($request['fechasolicitud_d']) && $request['fechasolicitud_d'] != '00')){
		if(date('Y-m-d', strtotime($request['fechasolicitud_a'].'-'.$request['fechasolicitud_m'].'-'.$request['fechasolicitud_d'])) == '1969-12-31'){
			echo json_encode(array('error'=> 'La fecha de solicitud debe ser una fecha valida.'));
			exit;
		}else
			$request['fechasolicitud'] = date('Y-m-d', strtotime($request['fechasolicitud_a'].'-'.$request['fechasolicitud_m'].'-'.$request['fechasolicitud_d']));
	}else{
		echo json_encode(array('error'=> 'La fecha de solicitud no puede ser vacia.'));
		exit;
	}

	if((isset($request['fechaexpedicion_a']) && !empty($request['fechaexpedicion_a']) && $request['fechaexpedicion_a'] != '0000') && (isset($request['fechaexpedicion_m']) && !empty($request['fechaexpedicion_m']) && $request['fechaexpedicion_m'] != '00') && (isset($request['fechaexpedicion_d']) && !empty($request['fechaexpedicion_d']) && $request['fechaexpedicion_d'] != '00')){
	    if(date('Y-m-d', strtotime($request['fechaexpedicion_a']."-".$request['fechaexpedicion_m']."-".$request['fechaexpedicion_d'])) == '1969-12-31'){
	        echo json_encode(array('error'=> 'La fecha de expedicion debe ser una fecha valida.'));
	        exit;
	    }else
	    	$request['fechaexpedicion'] = date('Y-m-d', strtotime($request['fechaexpedicion_a']."-".$request['fechaexpedicion_m']."-".$request['fechaexpedicion_d']));
	}else{
	    echo json_encode(array('error'=> 'La fecha de expedicion no puede ser vacia.'));
	    exit;
	}
	if($request['tipopersona'] == "1"){
	    if((isset($request['fechanacimiento_a']) && !empty($request['fechanacimiento_a']) && $request['fechanacimiento_a'] != '0000') && (isset($request['fechanacimiento_m']) && !empty($request['fechanacimiento_m']) && $request['fechanacimiento_m'] != '00') && (isset($request['fechanacimiento_d']) && !empty($request['fechanacimiento_d']) && $request['fechanacimiento_d'] != '00')){
	        if(date('Y-m-d', strtotime($request['fechanacimiento_a']."-".$request['fechanacimiento_m']."-".$request['fechanacimiento_d'])) == '1969-12-31' && $request['fechanacimiento_a']."-".$request['fechanacimiento_m']."-".$request['fechanacimiento_d'] != '1969-12-31'){
	            echo json_encode(array('error'=> 'La fecha de nacimiento debe ser una fecha valida.'));
	            exit;
	        }else
	        	$request['fechanacimiento'] = date('Y-m-d', strtotime($request['fechanacimiento_a']."-".$request['fechanacimiento_m']."-".$request['fechanacimiento_d']));
	    }else{
	        echo json_encode(array('error'=> 'La fecha de nacimiento no puede ser vacia.'));
	        exit;
	    }
	}
	$request['fechaentrevista'] = date('Y-m-d', strtotime($request['fechaentrevista_a'] . "-" . $request['fechaentrevista_m'] . "-" . $request['fechaentrevista_d']));

	$request['fecharadicado'] = date('Y-m-d', strtotime($request['fecharadicado_a'] . "-" . $request['fecharadicado_m'] . "-" . $request['fecharadicado_d']));

	if((!empty($request['documento']) || !empty($request['nit']) ) && !empty($request['tipopersona'])){
		
		if(!empty($request['nit']) && $request['tipopersona'] == "2")
			$cliente_id = Formulario::obtenerIdCliente($request['nit'], $request['tipopersona']);

		if(!empty($request['documento']) && $request['tipopersona'] == "1")
			$cliente_id = Formulario::obtenerIdCliente($request['documento'], $request['tipopersona']);


		if(!empty($request['tipoactividad']) && $request['tipoactividad'] != "8")
			$request['detalletipoactividad'] = "SD";

		if(!isset($request['telefonoresidencia']) || trim($request['telefonoresidencia']) == '')
			$request['telefonoresidencia'] = '*';

		if(!isset($request['telefonolaboral']) || trim($request['telefonolaboral']) == '')
			$request['telefonolaboral'] = '*';

		if(!isset($request['telefonoficina']) || trim($request['telefonoficina']) == '')
			$request['telefonoficina'] = '*';

		if(!isset($request['telefonosucursal']) || trim($request['telefonosucursal']) == '')
			$request['telefonosucursal'] = '*';

		if(!isset($request['faxoficina']) || trim($request['faxoficina']) == '')
			$request['faxoficina'] = '*';

		if(!isset($request['celularoficina']) || trim($request['celularoficina']) == '')
			$request['celularoficina'] = '*';

		if(!isset($request['faxsucursal']) || trim($request['faxsucursal']) == '')
			$request['faxsucursal'] = '*';

		if(!isset($request['celular']) || trim($request['celular']) == '')
			$request['celular'] = '*';

		//SKRV
		if(!isset($request['telefonoresidencia']) || empty($request['telefonoresidencia']))
			$request['telefonoresidencia'] = "*";

		if(!isset($request['telefonolaboral']) || empty($request['telefonolaboral']))
			$request['telefonolaboral'] = "*";

		if(!isset($request['telefonoficina']) || empty($request['telefonoficina']))
			$request['telefonoficina'] = "*";

		if(!isset($request['telefonosucursal']) || empty($request['telefonosucursal']))
			$request['telefonosucursal'] = "*";

		if(!isset($request['direccionresidencia']) || empty($request['direccionresidencia']))
			$request['direccionresidencia'] = "SD";

		if(!isset($request['direccionoficinappal']) || empty($request['direccionoficinappal']))
			$request['direccionoficinappal'] = "SD";

		if(!isset($request['direccionempresa']) || empty($request['direccionempresa']))
			$request['direccionempresa'] = "SD";

		if(!isset($request['direccionsucursal']) || empty($request['direccionsucursal']))
			$request['direccionsucursal'] = "SD";

		if(!isset($request['razonsocial']) || empty($request['razonsocial']))
			$request['razonsocial'] = "SD";

		if(!isset($request['nombres']) || empty($request['nombres']))
			$request['nombres'] = "SD";

		if(!isset($request['primerapellido']) || empty($request['primerapellido']))
			$request['primerapellido'] = "SD";

		if(!isset($request['segundoapellido']) || empty($request['segundoapellido']))
			$request['segundoapellido'] = "SD";

		if(!isset($request['socio1']) || empty($request['socio1']))
			$request['socio1'] = '*';

		if(!isset($request['socio2']) || empty($request['socio2']))
			$request['socio2'] = '*';

		if(!isset($request['socio3']) || empty($request['socio3']))
			$request['socio3'] = '*';
		//SKRV

	    if(isset($cliente_id) && !empty($cliente_id) && $cliente_id !== false){
	        Formulario::activeCliente($cliente_id);

	        if($request['fechaexpedicion'] === '--'){
	            echo json_encode(array('error'=> 'La fecha de expedicion no puede ser -- 1.'));
	            exit;
	            echo json_encode($_POST);
	        }
			$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
			if(isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])){
				echo json_encode(array("error"=> "3. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => ".$exForm['id'].", por favor contacte con el administrador."));
				exit;
			}
	        //Sinthia Rodriguez Alertas fin
	        if($form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca'])){
	        	if(isset($form_id) && !empty($form_id) && $form_id !== false){
		            //Insertar información principal
		            try{
			            if($idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id)){


							$err_img = '';
							if($imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp'])){
								$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']);
							}else
								$err_img = 'No se encontro la imagen con el identificador: '.$request['id_imagen_tmp'];

							if($request['tipopersona'] == '1')
								$documentVerf = $request['documento'];
							else
								$documentVerf = $request['nit'];
							Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);

							Formulario::guardarPlanillaLote($request['planilla_lote'], $request['lote'], $_SESSION['id']);

							Formulario::addIndexacion($form_id, $_SESSION['id']);

							$mensaje = 'Se agrego la nueva digitacion';
							if(!empty($err_img))
								$mensaje .= ', con el siguiente problema: '.$err_img;
							echo json_encode(array('exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id));

			            }else{
							echo json_encode(array('error'=> 'Ocurrio un error al momento de crear la data del formulario(cliente existente), por favor contacte con el administrador.'));
							exit;
						}
					}catch(Exception $e){
						echo json_encode(array('error'=> $e->getMessage()));
					}
				}else{
					echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario(cliente existente), por favor contacte con el administrador...'));
					exit;
				}
	        }else{
				echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario(cliente existente), por favor contacte con el administrador.'));
				exit;
			}
	    }else{
			if(!empty($request['nit']) && $request['tipopersona'] == "2")
				$cliente_id = Formulario::crearNuevoCliente($request['nit'], $request['tipopersona'], $request['razonsocial']);
			elseif(!empty($request['documento']) && $request['tipopersona'] == "1")
				$cliente_id = Formulario::crearNuevoCliente($request['documento'], $request['tipopersona'], $request['primerapellido'] . " " . $request['segundoapellido'] . " " . $request['nombres']);

			if(isset($cliente_id) && !empty($cliente_id) && $cliente_id !== false){
	        //Creación del cliente ya que no existe en la base de datos
	            //$form = new Formulario();
	            if($request['fechaexpedicion'] === '--'){
	                echo json_encode(array('error'=> 'La fecha de expedicion no puede ser -- 2.'));
	                exit;
	                echo json_encode($_POST);
	            }
				$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
				if(isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])){
					echo json_encode(array("error"=> "4. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => ".$exForm['id'].", por favor contacte con el administrador."));
					exit;
				}
	        	if($form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca'])){
	        		if(isset($form_id) && !empty($form_id) && $form_id !== false){
	        			try{
			            	if($idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id)){
				                //Insertar información principal
				                
								$err_img = '';
								if($imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp'])){
									$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']);
								}else
									$err_img = 'No se encontro la imagen con el identificador: '.$request['id_imagen_tmp'];

								if($request['tipopersona'] == '1')
									$documentVerf = $request['documento'];
								else
									$documentVerf = $request['nit'];
								Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);

								Formulario::guardarPlanillaLote($request['planilla_lote'], $request['lote'], $_SESSION['id']);

								Formulario::addIndexacion($form_id, $_SESSION['id']);

								$mensaje = 'Se agrego la nueva digitacion';
								if(!empty($err_img))
									$mensaje .= ', con el siguiente problema: '.$err_img;
								echo json_encode(array('exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id));
								
							}else{
								echo json_encode(array('error'=> 'Ocurrio un error al momento de crear la data del formulario(cliente nuevo), por favor contacte con el administrador.'));
								exit;
							}
						}catch(Exception $e){
							echo json_encode(array('error'=> $e->getMessage()));
						}
					}else{
						echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario(cliente nuevo), por favor contacte con el administrador...'));
						exit;
					}
	            }else{
					echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario(cliente nuevo), por favor contacte con el administrador.'));
					exit;
				}
	        }else{
				echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el cliente(cliente nuevo), por favor contacte con el administrador.'));
				exit;
			}
	    }
	/*
	    //Sinthia Rodriguez Alertas inicio
	    $u = new EmailAlert();
	    if($ingresosmensualesemp == ""){
	        $u->generateAlert($id_cliente['id'], 1, $ingresosmensuales, array("cambioact" => $cambioact, "tactividad" => $tipoactividad));
	    }else{
	        $u->generateAlert($id_cliente['id'], 2, $ingresosmensualesemp, array("cambioact" => $cambioact, "tactividad" => $tipoactividad));
	    }

	    $u->alertDirecciones(array("id" => $id_cliente['id'], "documento" => $documento, "tipo" => $tipopersona), array("direccion_residencia" => $direccionresidencia, "direccion_oficina" => $direccionoficinappal, "direccion_empresa" => $direccionempresa, "direccion_sucursal" => $direccionsucursal));
	    $u->alertTelefonos(array("id" => $id_cliente['id'], "documento" => $documento, "tipo" => $tipopersona), array("telefono_residencia" => $telefonoresidencia, "telefono_laboral" => $telefonolaboral, "telefono_oficina" => $telefonoficina, "telefono_sucursal" => $telefonosucursal));
	    
	    $u->alertNombres(array("id" => $id_cliente['id'], "documento" => $documento, "nombre" => $nombres, "papellido" => $primerapellido, "sapellido" => $segundoapellido, "razonsocial" => $razonsocial));
	    //Sinthia Rodriguez Alertas fin
	    */
	}else
	    echo "<h1>Por favor diligencie todos los campos.</h1>";
}
function guardarFormularioAntiguoAction2($request){
	$request['fecharadicado'] = NULL;
	$request['fechasolicitud'] = NULL;
	$request['fechaexpedicion'] = NULL;
	$request['fechanacimiento'] = NULL;
	$request['cargo_politica_ini'] = NULL;
	$request['cargo_politica_fin'] = NULL;
	$request['fechaentrevista'] = NULL;
	$request['verificacion_fecha'] = NULL;
	$request['horaentrevista'] = NULL;
	$request['verificacion_hora'] = NULL;
	if((isset($request['f_rad_a']) && !empty($request['f_rad_a'])) && (isset($request['f_rad_m']) && !empty($request['f_rad_m'])) && (isset($request['f_rad_d']) && !empty($request['f_rad_d']))){
		if(date('Y-m-d', strtotime($request['f_rad_a'].'-'.$request['f_rad_m'].'-'.$request['f_rad_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de radicado no puede ser errada."));
			exit;
		}else
			$request['fecharadicado'] = date('Y-m-d', strtotime($request['f_rad_a'].'-'.$request['f_rad_m'].'-'.$request['f_rad_d']));
	}else{
		echo json_encode(array("error"=> "La fecha de radicado no puede ser vacia."));
		exit;
	}
	if((isset($request['f_dil_a']) && !empty($request['f_dil_a'])) && (isset($request['f_dil_m']) && !empty($request['f_dil_m'])) && (isset($request['f_dil_d']) && !empty($request['f_dil_d']))){
		if(date('Y-m-d', strtotime($request['f_dil_a'].'-'.$request['f_dil_m'].'-'.$request['f_dil_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser errada."));
			exit;
		}else
			$request['fechasolicitud'] = date('Y-m-d', strtotime($request['f_dil_a'].'-'.$request['f_dil_m'].'-'.$request['f_dil_d']));
	}else{
		echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser vacia."));
		exit;
	}
	if((isset($request['f_exp_a']) && !empty($request['f_exp_a'])) && (isset($request['f_exp_m']) && !empty($request['f_exp_m'])) && (isset($request['f_exp_d']) && !empty($request['f_exp_d']))){
		if(date('Y-m-d', strtotime($request['f_exp_a'].'-'.$request['f_exp_m'].'-'.$request['f_exp_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de expedicion no puede ser errada."));
			exit;
		}else
			$request['fechaexpedicion'] = date('Y-m-d', strtotime($request['f_exp_a'].'-'.$request['f_exp_m'].'-'.$request['f_exp_d']));
	}
	if((isset($request['f_nac_a']) && !empty($request['f_nac_a'])) && (isset($request['f_nac_m']) && !empty($request['f_nac_m'])) && (isset($request['f_nac_d']) && !empty($request['f_nac_d']))){
		if(date('Y-m-d', strtotime($request['f_nac_a'].'-'.$request['f_nac_m'].'-'.$request['f_nac_d'])) == '1969-12-31' && ($request['f_nac_a'] != '1969' || $request['f_nac_m'] != '12' || $request['f_nac_d'] != '31')){
			echo json_encode(array("error"=> "La fecha de nacimento no puede ser errada."));
			exit;
		}else
			$request['fechanacimiento'] = date('Y-m-d', strtotime($request['f_nac_a'].'-'.$request['f_nac_m'].'-'.$request['f_nac_d']));
	}
	if((isset($request['f_ini_a']) && !empty($request['f_ini_a'])) && (isset($request['f_ini_m']) && !empty($request['f_ini_m'])) && (isset($request['f_ini_d']) && !empty($request['f_ini_d']))){
		if(date('Y-m-d', strtotime($request['f_ini_a'].'-'.$request['f_ini_m'].'-'.$request['f_ini_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha inicial no puede ser errada."));
			exit;
		}else
			$request['cargo_politica_ini'] = date('Y-m-d', strtotime($request['f_ini_a'].'-'.$request['f_ini_m'].'-'.$request['f_ini_d']));
	}
	if((isset($request['f_fin_a']) && !empty($request['f_fin_a'])) && (isset($request['f_fin_m']) && !empty($request['f_fin_m'])) && (isset($request['f_fin_d']) && !empty($request['f_fin_d']))){
		if(date('Y-m-d', strtotime($request['f_fin_a'].'-'.$request['f_fin_m'].'-'.$request['f_fin_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha final no puede ser errada."));
			exit;
		}else
			$request['cargo_politica_fin'] = date('Y-m-d', strtotime($request['f_fin_a'].'-'.$request['f_fin_m'].'-'.$request['f_fin_d']));
	}
	if((isset($request['f_ent_a']) && !empty($request['f_ent_a'])) && (isset($request['f_ent_m']) && !empty($request['f_ent_m'])) && (isset($request['f_ent_d']) && !empty($request['f_ent_d']))){
		if(date('Y-m-d', strtotime($request['f_ent_a'].'-'.$request['f_ent_m'].'-'.$request['f_ent_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de entrevista no puede ser errada."));
			exit;
		}else
			$request['fechaentrevista'] = date('Y-m-d', strtotime($request['f_ent_a'].'-'.$request['f_ent_m'].'-'.$request['f_ent_d']));
	}
	if((isset($request['f_ver_a']) && !empty($request['f_ver_a'])) && (isset($request['f_ver_m']) && !empty($request['f_ver_m'])) && (isset($request['f_ver_d']) && !empty($request['f_ver_d']))){
		if(date('Y-m-d', strtotime($request['f_ver_a'].'-'.$request['f_ver_m'].'-'.$request['f_ver_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de verificacion no puede ser errada."));
			exit;
		}else
			$request['verificacion_fecha'] = date('Y-m-d', strtotime($request['f_ver_a'].'-'.$request['f_ver_m'].'-'.$request['f_ver_d']));
	}
	if((isset($request['h_ent_h']) && !empty($request['h_ent_h'])) && (isset($request['h_ent_m']) && !empty($request['h_ent_m']))){
		$request['horaentrevista'] = $request['h_ent_h'].':'.$request['h_ent_m'];
	}
	$request['tipohoraentrevista'] = $request['h_ent_z'];
	if((isset($request['h_ver_h']) && !empty($request['h_ver_h'])) && (isset($request['h_ver_m']) && !empty($request['h_ver_m'])) && (isset($request['h_ver_z']) && !empty($request['h_ver_z']))){
		$request['verificacion_hora'] = date('H:i', strtotime($request['h_ver_h'].':'.$request['h_ver_m'].' '.$request['h_ver_z']));
	}
	if($request['clasecliente'] != '10')
		$request['cual_clasecliente'] = NULL;
	if($request['tipoempresaemp'] != '5')
		$request['tipoempresaemp_cual'] = NULL;
	if($request['reconocimiento_publico'] == '0')
		$request['reconocimiento_cual'] = NULL;
	if($request['expuesta_politica'] == '0')
		$request['cargo_politica'] = NULL;
	if($request['expuesta_publica'] == '0'){
		$request['publica_nombre'] = NULL;
		$request['publica_cargo'] = NULL;
	}
	if($request['repre_internacional'] == '0')
		$request['internacional_indique'] = NULL;
	if($request['tributarias_otro_pais'] == '0')
		$request['tributarias_paises'] = NULL;
	if(isset($request['tipoempresajur']) && $request['tipoempresajur'] != '5')
		$request['tipoempresajur_otra'] = NULL;
	if($request['monedaextranjera'] == '0' && !isset($request['tipotransacciones'])){
		$request['tipotransacciones'] = NULL;
		$request['tipotransacciones_cual'] = NULL;
	}elseif($request['monedaextranjera'] == '0' && $request['tipotransacciones'] != '7'){
		$request['tipotransacciones_cual'] = NULL;
	}
	if($request['tipopersona'] == '2'){
		$request['tipoactividad'] = NULL;
		$request['profesion'] = NULL;
		$request['cargo'] = NULL;
		$request['actividadeconomicaempresa'] = NULL;
		$request['ciiu_otro'] = NULL;
		$request['telefonoficinappal'] = '0';
		$request['detalletipoactividad'] = NULL;
		$request['ingresosmensuales'] = NULL;
		$request['totalactivos'] = NULL;
		$request['totalpasivos'] = NULL;
		$request['egresosmensuales'] = NULL;
		$request['otrosingresos'] = NULL;
		$request['conceptosotrosingresos'] = NULL;
	}elseif($request['tipopersona'] == '1'){
		$request['razonsocial'] = NULL;
		$request['nit'] = NULL;
		$request['digitochequeo'] = NULL;
		$request['tipoempresajur'] = NULL;
		$request['tipoempresajur_otra'] = NULL;
		$request['detalleactividadeconomicappal'] = NULL;
		$request['ciudadoficina'] = NULL;
		$request['telefonoficina'] = '0';
		$request['correoelectronico_otro'] = NULL;
		$request['celularoficina'] = '0';
		$request['direccionsucursal'] = NULL;
		$request['ingresosmensualesemp'] = '7';
		$request['activosemp'] = NULL;
		$request['pasivosemp'] = NULL;
		$request['egresosmensualesemp'] = '7';
		$request['otrosingresosemp'] = '7';
		$request['concepto_otrosingresosemp'] = 'SD';
	}
	if(!isset($request['actividadeconomicaempresa']))
		$request['actividadeconomicaempresa'] = '4';
	if(!isset($request['tipotransacciones']))
		$request['tipotransacciones'] = '8';
	if(!isset($request['tipotransacciones_cual']))
		$request['tipotransacciones_cual'] = 'SD';

	if(!isset($request['telefonoresidencia']) || empty($request['telefonoresidencia']))
		$request['telefonoresidencia'] = '0';
	if(!isset($request['celular']) || empty($request['celular']))
		$request['celular'] = '0';
	if(!isset($request['telefonolaboral']) || empty($request['telefonolaboral']))
		$request['telefonolaboral'] = '0';
	if(!isset($request['celularoficinappal']) || empty($request['celularoficinappal']))
		$request['celularoficinappal'] = '0';
	if(!isset($request['telefonoficinappal']) || empty($request['telefonoficinappal']))
		$request['telefonoficinappal'] = '0';
	if(!isset($request['telefonoficina']) || empty($request['telefonoficina']))
		$request['telefonoficina'] = '0';
	if(!isset($request['celularoficina']) || empty($request['celularoficina']))
		$request['celularoficina'] = '0';


	if((!empty($request['documento']) || !empty($request['nit']) ) && !empty($request['tipopersona'])){
		if(!empty($request['nit']) && $request['tipopersona'] == "2")
			$cliente_id = Formulario::obtenerIdCliente($request['nit'], $request['tipopersona']);

		if(!empty($request['documento']) && $request['tipopersona'] == "1")
			$cliente_id = Formulario::obtenerIdCliente($request['documento'], $request['tipopersona']);


		echo json_encode(array('cliente_id'=> $cliente_id, 'data'=> $request));
		exit;
		if(isset($cliente_id) && !empty($cliente_id) && $cliente_id !== false){
			Formulario::activeCliente($cliente_id);
			$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
			if(isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])){
				echo json_encode(array("error"=> "5. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => ".$exForm['id'].", por favor contacte con el administrador."));
				exit;
			}
			//$lastData = Formulario::obtenerUltimoFormData($cliente_id);
			if($form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca'])){
				if(isset($form_id) && !empty($form_id) && $form_id !== false){
					if($idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id)){
						//CUENTAS EN MONEDA EXTRANJERA
						if(isset($request['cuentas_monedaextranjera']) && $request['cuentas_monedaextranjera'] == '-1'){
							for ($i = 0; $i < 3; $i++) { 
								if(!empty($request['producto_tipo'][$i]) || !empty($request['producto_identificacion'][$i]) || !empty($request['producto_entidad'][$i]) || !empty($request['producto_monto'][$i]) || !empty($request['
									producto_ciudad'][$i]) || !empty($request['producto_pais'][$i]) || !empty($request['producto_moneda'][$i])){
									Formulario::insertCuentas($idData, $request['producto_tipo'][$i], $request['producto_identificacion'][$i], $request['producto_entidad'][$i], $request['producto_monto'][$i], $request['producto_ciudad'][$i], $request['producto_pais'][$i], $request['producto_moneda'][$i]);
								}
							}
						}
						//RECLAMACIONES
						if(isset($request['reclamaciones']) && $request['reclamaciones'] == '-1'){
							for ($j = 0; $j < 2; $j++) {
								if(!empty($request['rec_ano'][$j]) || !empty($request['rec_ramo'][$j]) || !empty($request['rec_compania'][$j]) || !empty($request['rec_valor'][$j]) || !empty($request['rec_resultado'][$j])){
									Formulario::insertReclamaciones($idData, $request['rec_ano'][$j], $request['rec_ramo'][$j], $request['rec_compania'][$j], $request['rec_valor'][$j], $request['rec_resultado'][$j]);
								}
							}
						}
						if($request['tipopersona'] == '2'){
							for($k = 0; $k < 5; $k++){
								if (!empty($request['identificacion'][$k]) && $request['identificacion'][$k] != 'SD' && $request['identificacion'][$k] != 'NA' && $request['identificacion'][$k] != 'N/A' && $request['identificacion'][$k] != '*') {
									Formulario::insertAccionistas($idData, $request['tipo_id'][$k], $request['identificacion'][$k], $request['nombre_accionista'][$k], $request['porcentaje'][$k], $request['publico_recursos'][$k], $request['publico_reconocimiento'][$k], $request['publico_expuesta'][$k], $request['declaracion_tributaria'][$k]);
								}
							}
						}
						$err_img = '';
						if($imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp'])){
							$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']);
						}else
							$err_img = 'No se encontro la imagen con el identificador: '.$request['id_imagen_tmp'];

						if($request['tipopersona'] == '1')
							$documentVerf = $request['documento'];
						else
							$documentVerf = $request['nit'];
						Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);
						Formulario::addIndexacion($form_id, $_SESSION['id']);

						$mensaje = 'Se agrego la nueva digitacion';
						if(!empty($err_img))
							$mensaje .= ', con el siguiente problema: '.$err_img;
						echo json_encode(array('exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id));

					}else{
						echo json_encode(array('error'=> 'Ocurrio un error al momento de crear la data del formulario, por favor contacte con el administrador.'));
						exit;
					}
				}else{
					echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador...'));
					exit;
				}
			}else{
				echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador.'));
				exit;
			}
		}else{
			if(!empty($request['nit']) && $request['tipopersona'] == "2")
				$cliente_id = Formulario::crearNuevoCliente($request['nit'], $request['tipopersona'], $request['razonsocial']);
			elseif(!empty($request['documento']) && $request['tipopersona'] == "1")
				$cliente_id = Formulario::crearNuevoCliente($request['documento'], $request['tipopersona'], $request['primerapellido'] . " " . $request['segundoapellido'] . " " . $request['nombres']);

			if(isset($cliente_id) && !empty($cliente_id) && $cliente_id !== false){
				//Formulario::activeCliente($cliente_id);
				//$lastData = Formulario::obtenerUltimoFormData($cliente_id);
				$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
				if(isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])){
					echo json_encode(array("error"=> "6. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => ".$exForm['id'].", por favor contacte con el administrador."));
					exit;
				}
				if($form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca'])){
					if(isset($form_id) && !empty($form_id) && $form_id !== false){
						if($idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id)){
							//CUENTAS EN MONEDA EXTRANJERA
							if(isset($request['cuentas_monedaextranjera']) && $request['cuentas_monedaextranjera'] == '-1'){
								for ($i = 0; $i < 3; $i++) { 
									if(!empty($request['producto_tipo'][$i]) || !empty($request['producto_identificacion'][$i]) || !empty($request['producto_entidad'][$i]) || !empty($request['producto_monto'][$i]) || !empty($request['
										producto_ciudad'][$i]) || !empty($request['producto_pais'][$i]) || !empty($request['producto_moneda'][$i])){
										Formulario::insertCuentas($idData, $request['producto_tipo'][$i], $request['producto_identificacion'][$i], $request['producto_entidad'][$i], $request['producto_monto'][$i], $request['producto_ciudad'][$i], $request['producto_pais'][$i], $request['producto_moneda'][$i]);
									}
								}
							}
							//RECLAMACIONES
							if(isset($request['reclamaciones']) && $request['reclamaciones'] == '-1'){
								for ($j = 0; $j < 2; $j++) {
									if(!empty($request['rec_ano'][$j]) || !empty($request['rec_ramo'][$j]) || !empty($request['rec_compania'][$j]) || !empty($request['rec_valor'][$j]) || !empty($request['rec_resultado'][$j])){
										Formulario::insertReclamaciones($idData, $request['rec_ano'][$j], $request['rec_ramo'][$j], $request['rec_compania'][$j], $request['rec_valor'][$j], $request['rec_resultado'][$j]);
									}
								}
							}
							if($request['tipopersona'] == '2'){
								for($k = 0; $k < 5; $k++){
									if (!empty($request['identificacion'][$k]) && $request['identificacion'][$k] != 'SD' && $request['identificacion'][$k] != 'NA' && $request['identificacion'][$k] != 'N/A' && $request['identificacion'][$k] != '*') {
										Formulario::insertAccionistas($idData, $request['tipo_id'][$k], $request['identificacion'][$k], $request['nombre_accionista'][$k], $request['porcentaje'][$k], $request['publico_recursos'][$k], $request['publico_reconocimiento'][$k], $request['publico_expuesta'][$k], $request['declaracion_tributaria'][$k]);
									}
								}
							}
							$err_img = '';
							if($imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp'])){
								$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']);
							}else
								$err_img = 'No se encontro la imagen con el identificador: '.$request['id_imagen_tmp'];

							if($request['tipopersona'] == '1')
								$documentVerf = $request['documento'];
							else
								$documentVerf = $request['nit'];
							Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);
							Formulario::addIndexacion($form_id, $_SESSION['id']);

							$mensaje = 'Se agrego la nueva digitacion';
							if(!empty($err_img))
								$mensaje .= ', con el siguiente problema: '.$err_img;
							echo json_encode(array('exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id));

						}else{
							echo json_encode(array('error'=> 'Ocurrio un error al momento de crear la data del formulario, por favor contacte con el administrador.'));
							exit;
						}
					}else{
						echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador...'));
						exit;
					}
				}else{
					echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador.'));
					exit;
				}
			}else{
				echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el cliente, por favor contacte con el administrador.'));
				exit;
			}
		}
	}else{
		echo json_encode(array('error'=> 'El numero de documento del cliente no puede estar vacion, por favor verifiquelo.'));
		exit;
	}
}
function guardarFormularioRenovacionAutosAction($request){
	if((isset($request['age']) && !empty($request['age'])) && (isset($request['mes_']) && !empty($request['mes_'])) && (isset($request['dia']) && !empty($request['dia']))){
		if(date('Y-m-d', strtotime($request['age'].'-'.$request['mes_'].'-'.$request['dia'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser errada."));
			exit;
		}else
			$request['fechasolicitud'] = date('Y-m-d', strtotime($request['age'].'-'.$request['mes_'].'-'.$request['dia']));
	}else{
		echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser vacia."));
		exit;
	}

	if(!isset($request['detalle']))
		$request['detalle'] = 'SD';

	if(isset($request['grupodoc']) && $request['grupodoc'] == '7'){
		$cliente_id = Formulario::obtenerIdCliente($request['numero'], 2);
	}else if(isset($request['grupodoc']) && !empty($request['grupodoc'])){
		$cliente_id = Formulario::obtenerIdCliente($request['numero'], 1);
	}else{
		echo json_encode(array('error'=> 'Ocurrio un error al momento de verificar el tipo de documento, por favor contacte con el administrador.'));
		exit;
	}
	$form_id = Formulario::obtenerUltimoIdFormulario($cliente_id);

	if($rIns = Formulario::insertarFormAutos($request, $form_id)){
		if(isset($rIns['exito'])){
			Formulario::actualizarData($request, $form_id);
			$err_img = '';
			if($imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp'])){
				$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, '5', $_SESSION['id'], $request['id_imagen_tmp']);
			}else
				$err_img = 'No se encontro la imagen con el identificador: '.$request['id_imagen_tmp'];

			Formulario::addIndexacion($form_id, $_SESSION['id']);

			$mensaje = 'Se agrego la nueva digitacion';
			if(!empty($err_img))
				$mensaje .= ', con el siguiente problema: '.$err_img;
			echo json_encode(array('exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id));
		}else{
			echo json_encode($rIns);
			exit;
		}
	}else{
		echo json_encode(array('error'=> 'Ocurrio un error al momento de insertar la data de renovacion, contacte con el administrador...'));
		exit;
	}
}
function guardarDocComplementariaAction($request){
	Formulario::actualizarItemRadicadoComplementaria($request['numero'], $request['lote'], '2');
	if($cliente_id = Formulario::obtenerIdCliente($request['numero'], $request['tipo_cliente'])){
		$form_id = Formulario::obtenerUltimoIdFormulario($cliente_id);

		$err_img = '';
		if($imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp'])){
			$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, '4', $_SESSION['id'], $request['id_imagen_tmp']);
		}else
			$err_img = 'No se encontro la imagen con el identificador: '.$request['id_imagen_tmp'];

		Formulario::addIndexacion($form_id, $_SESSION['id']);

		$mensaje = 'Se agrego la nueva digitacion';
		if(!empty($err_img))
			$mensaje .= ', con el siguiente problema: '.$err_img;
		echo json_encode(array('exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id));
	}else{
		echo json_encode(array('error'=> 'El cliente con este numero de documento no existe, no se puede guardar la informacion como documentacion complementaria.'));
	}
}
function guardarDocComplementarioPorRegimenAction($request){
	$cliente_id = Formulario::obtenerIdCliente($request['document'], $request['persontype']/*, 2*/);

	if ($cliente_id === 0) {
		$cliente_id = Formulario::crearNuevoCliente($request['document'], $request['persontype'], $request['firstname'], $request['tipo_norma_id'], $request['regimen_id']/*, 2*/);
		$form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca']/*, 2*/);
	} else {
		Formulario::activeCliente($cliente_id);
		$form_id = Formulario::obtenerUltimoIdFormulario($cliente_id/*, 2*/);
		if ($form_id === false) {
			$form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca']/*, 2*/);
		}
	}
	if ($form_id === false) {
		echo json_encode(['error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador.']);
		exit;
	}

	$err_img = 'No se encontro la imagen con el identificador: ' . $request['id_imagen_tmp'];
	$imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp']);
	if ($imagen !== false) {
		$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']/*, 2*/);
	}

	Formulario::addIndexacion($form_id, $_SESSION['id']);

	$mensaje = 'Se agrego la nueva digitacion';
	if (!empty($err_img)) {
		$mensaje .= ', con el siguiente problema: '.$err_img;
	}
	echo json_encode(['exito'=> $mensaje, 'url'=> 'fingering2.php?id_form=' . $form_id . '&id_cliente=' . $cliente_id]);
}
function desactivarPlanillasAction($request){
	$resp = Formulario::desactivarPlanillas($request['id_user']);
	echo json_encode($resp);
}
function saveEditNewAction($request){
	$dat = [];
	$telDir = false;
	foreach ($request as $key => $value) {
		if (is_array($request[$key])) continue;

		$dat[$key] = $value;
	}
	if (empty($dat) || count($dat) <= 7) {
		echo json_encode(['error'=> 'No se encontraron datos del cliente para actualizar...']);
		exit;
	}
	try {
		$us = Formulario::editarDataFormulario($dat);
		echo json_encode($us);
	} catch (Exception $e) {
		echo json_encode(['error'=> 'Ocurrio un error al momento de la actualizacion; contacte con el administrador.<br>ERROR: ' . $e->getMessage() . ': ' . $dat['fechanacimiento']]);
	}
}
function guardarFormularioNuevoCe02720Action($request){
	$request['defaul_date'] = date('Y-m-d', strtotime("daniel"));
    $request['fecharadicado'] = '0000-00-00';
	$request['fechasolicitud'] = '0000-00-00';
	$request['fechaexpedicion'] = '0000-00-00';
	$request['fechanacimiento'] = '0000-00-00';


	if((isset($request['f_rad_a']) && !empty($request['f_rad_a'])) && (isset($request['f_rad_m']) && !empty($request['f_rad_m'])) && (isset($request['f_rad_d']) && !empty($request['f_rad_d']))){
		if(date('Y-m-d', strtotime($request['f_rad_a'].'-'.$request['f_rad_m'].'-'.$request['f_rad_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de radicado no puede ser errada."));
			exit;
		}else
			$request['fecharadicado'] = date('Y-m-d', strtotime($request['f_rad_a'].'-'.$request['f_rad_m'].'-'.$request['f_rad_d']));
	}else{
		echo json_encode(array("error"=> "La fecha de radicado no puede ser vacia."));
		exit;
	}
	if((isset($request['f_dil_a']) && !empty($request['f_dil_a'])) && (isset($request['f_dil_m']) && !empty($request['f_dil_m'])) && (isset($request['f_dil_d']) && !empty($request['f_dil_d']))){
		if(date('Y-m-d', strtotime($request['f_dil_a'].'-'.$request['f_dil_m'].'-'.$request['f_dil_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser errada."));
			exit;
		}else
			$request['fechasolicitud'] = date('Y-m-d', strtotime($request['f_dil_a'].'-'.$request['f_dil_m'].'-'.$request['f_dil_d']));
	}else{
		echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser vacia."));
		exit;
	}
	if($request['tipopersona'] == '1'){
		if((isset($request['f_exp_a']) && !empty($request['f_exp_a'])) && (isset($request['f_exp_m']) && !empty($request['f_exp_m'])) && (isset($request['f_exp_d']) && !empty($request['f_exp_d']))){
			if(date('Y-m-d', strtotime($request['f_exp_a'].'-'.$request['f_exp_m'].'-'.$request['f_exp_d'])) == '1969-12-31'){
				echo json_encode(array("error"=> "La fecha de expedicion no puede ser errada."));
				exit;
			}else
				$request['fechaexpedicion'] = date('Y-m-d', strtotime($request['f_exp_a'].'-'.$request['f_exp_m'].'-'.$request['f_exp_d']));
		}
		if((isset($request['f_nac_a']) && !empty($request['f_nac_a'])) && (isset($request['f_nac_m']) && !empty($request['f_nac_m'])) && (isset($request['f_nac_d']) && !empty($request['f_nac_d']))){
			if(date('Y-m-d', strtotime($request['f_nac_a'].'-'.$request['f_nac_m'].'-'.$request['f_nac_d'])) == '1969-12-31' && ($request['f_nac_a'] != '1969' || $request['f_nac_m'] != '12' || $request['f_nac_d'] != '31')){
				echo json_encode(array("error"=> "La fecha de nacimento no puede ser errada."));
				exit;
			}else
				$request['fechanacimiento'] = date('Y-m-d', strtotime($request['f_nac_a'].'-'.$request['f_nac_m'].'-'.$request['f_nac_d']));
		}
	}
	if($request['clasecliente'] != '10')
		$request['cual_clasecliente'] = 'SD';
	if($request['tipoempresaemp'] != '5')
		$request['tipoempresaemp_cual'] = 'SD';
	if(isset($request['reconocimiento_publico']) && ($request['reconocimiento_publico'] == '0' || $request['reconocimiento_publico'] == '2'))
		$request['reconocimiento_cual'] = 'SD';

	if(isset($request['expuesta_politica']) && ($request['expuesta_politica'] == '0' || $request['expuesta_politica'] == '2'))
		$request['cargo_politica'] = 'SD';

	if(isset($request['expuesta_publica']) && ($request['expuesta_publica'] == '0' || $request['expuesta_publica'] == '2')){
		$request['publica_nombre'] = 'SD';
		$request['publica_cargo'] = 'SD';
	}
	if($request['repre_internacional'] == '0' || $request['repre_internacional'] == '2')
		$request['internacional_indique'] = 'SD';
	if($request['tributarias_otro_pais'] == '0' || $request['tributarias_otro_pais'] == '2')
		$request['tributarias_paises'] = 'SD';
	if(isset($request['tipoempresajur']) && $request['tipoempresajur'] != '5')
		$request['tipoempresajur_otra'] = 'SD';
	if(($request['monedaextranjera'] == '0' || $request['monedaextranjera'] == '2') && !isset($request['tipotransacciones'])){
		$request['tipotransacciones'] = '8';
		$request['tipotransacciones_cual'] = 'SD';
	}elseif($request['monedaextranjera'] == '0' && $request['tipotransacciones'] != '7'){
		$request['tipotransacciones_cual'] = 'SD';
	}
	$patrimonio = 0;
	if ($request['tipopersona'] == '2') {
		$request['tipoactividad'] = '900';
		$request['profesion'] = '900';
		$request['cargo'] = 'SD';
		$request['actividadeconomicaempresa'] = '4';
		$request['ciiu_otro'] = '0';
		$request['telefonoficinappal'] = '*';
		$request['ingresosmensuales'] = '13';
		$request['totalactivos'] = '*';
		$request['totalpasivos'] = '*';
		$request['egresosmensuales'] = '13';
		$request['otrosingresos'] = '13';
		$request['conceptosotrosingresos'] = 'SD';
		$patrimonio = intval($request['activosemp']) - intval($request['pasivosemp']);
	} else if ($request['tipopersona'] == '1') {
		$request['razonsocial'] = 'SD';
		$request['nit'] = '*';
		$request['digitochequeo'] = '0';
		$request['tipoempresajur'] = '4';
		$request['tipoempresajur_otra'] = 'SD';
		$request['detalleactividadeconomicappal'] = 'SD';
		$request['ciudadoficina'] = '99999';
		$request['telefonoficina'] = '*';
		$request['correoelectronico_otro'] = 'SD';
		$request['celularoficina'] = '*';
		$request['direccionsucursal'] = 'SD';
		$request['ingresosmensualesemp'] = '7';
		$request['activosemp'] = '*';
		$request['pasivosemp'] = '*';
		$request['egresosmensualesemp'] = '7';
		$request['otrosingresosemp'] = '7';
		$request['concepto_otrosingresosemp'] = 'SD';
		$patrimonio = intval($request['totalactivos']) - intval($request['totalpasivos']);
	}
	$request['patrimonio'] = $patrimonio <= 0 ? '0' : $patrimonio;
	if(!isset($request['actividadeconomicaempresa']))
		$request['actividadeconomicaempresa'] = '4';
	if(!isset($request['tipotransacciones']))
		$request['tipotransacciones'] = '8';
	if(!isset($request['tipotransacciones_cual']))
		$request['tipotransacciones_cual'] = 'SD';

	if(!isset($request['telefonoresidencia']) || empty($request['telefonoresidencia']))
		$request['telefonoresidencia'] = '*';
	if(!isset($request['celular']) || empty($request['celular']))
		$request['celular'] = '*';
	if(!isset($request['telefonolaboral']) || empty($request['telefonolaboral']))
		$request['telefonolaboral'] = '*';
	if(!isset($request['celularoficinappal']) || empty($request['celularoficinappal']))
		$request['celularoficinappal'] = '*';
	if(!isset($request['telefonoficinappal']) || empty($request['telefonoficinappal']))
		$request['telefonoficinappal'] = '*';
	if(!isset($request['telefonoficina']) || empty($request['telefonoficina']))
		$request['telefonoficina'] = '*';
	if(!isset($request['celularoficina']) || empty($request['celularoficina']))
		$request['celularoficina'] = '*';


	if ((empty($request['documento']) || empty($request['nit']) ) && empty($request['tipopersona'])) {
		echo json_encode(['error'=> 'El numero de documento del cliente no puede estar vacion, por favor verifiquelo.']);
		exit;
	}
	if ($_SESSION['id'] == '1') {
		error_log(json_encode($request), 0);
		exit;
	}
	if (!empty($request['nit']) && $request['tipopersona'] == "2") {
		$cliente_id = Formulario::obtenerIdCliente($request['nit'], $request['tipopersona']/*, 2*/);
	} else if (!empty($request['documento']) && $request['tipopersona'] == "1") {
		$cliente_id = Formulario::obtenerIdCliente($request['documento'], $request['tipopersona']/*, 2*/);
	}

	if (isset($cliente_id) && !empty($cliente_id) && $cliente_id !== false) {
		//Formulario::activeCliente($cliente_id);
		Formulario::actualizarRegimen($cliente_id, 2/*, 2*/);
		$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
		if (isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])) {
			echo json_encode(["error"=> "1. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => " . $exForm['id'] . ", por favor contacte con el administrador."]);
			exit;
		}
		$form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca']/*, 2*/);
		if ($form_id === false || $form_id === 0) {
			echo json_encode(['error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador.']);
			exit;
		}
		try{
			$conn = new Conexion();
			$idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id, $conn/*, 2*/);
			if ($idData === false || $idData === 0) {
				echo json_encode(['error'=> 'Ocurrio un error al momento de crear la data del formulario, por favor contacte con el administrador.']);
				exit;
			}
			if($request['tipopersona'] == "2"){
				//JUNTA DIRECTIVA
				if(isset($request['si_junta_directiva']) && $request['si_junta_directiva'] == '-1'){
					for ($i = 0; $i < 3; $i++) { 
						if(verificarDatoNoDefault($request['ju_identificacion'][$i]) || verificarDatoNoDefault($request['ju_nombre_completo'][$i])){
							Formulario::insertMiembroJunta($idData, $request['ju_nombre_completo'][$i], $request['ju_tipodocumento_id'][$i], $request['ju_identificacion'][$i], $request['ju_expuesto_politico'][$i], $conn);
						}
					}
				}
				if(isset($request['si_accionistas_nat']) && $request['si_accionistas_nat'] == '-1'){
					for($k = 0; $k < 3; $k++){
						if (verificarDatoNoDefault($request['be_identificacion'][$k]) || verificarDatoNoDefault($request['be_nombre_completo'][$k])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$k], "NULL", "NULL", $request['be_nombre_completo'][$k], $request['be_tipodocumento_id'][$k], $request['be_identificacion'][$k], $request['be_fecha_expedicion'][$k], $request['be_expuesto_politico'][$k], $request['be_poliza_seguro'][$k], $conn);
						}
					}
				}else
					$k = 0;
				if(isset($request['si_accionistas_jur']) && $request['si_accionistas_jur'] == '-1'){
					for($l = $k; $l < ($k + 3); $l++){
						if (verificarDatoNoDefault($request['be_nit'][$l]) || verificarDatoNoDefault($request['be_razon_social'][$l])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$l], $request['be_razon_social'][$l], $request['be_nit'][$l], $request['be_nombre_completo'][$l], $request['be_tipodocumento_id'][$l], $request['be_identificacion'][$l], "NULL", $request['be_expuesto_politico'][$l], "NULL", $conn);
						}
					}
				}else
					$l = $k;
				if(isset($request['si_beneficiarios_nat']) && $request['si_beneficiarios_nat'] == '-1'){
					for($m = $l; $m < ($l + 4); $m++){
						if (verificarDatoNoDefault($request['be_identificacion'][$m]) || verificarDatoNoDefault($request['be_nombre_completo'][$m])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$m], "NULL", "NULL", $request['be_nombre_completo'][$m], $request['be_tipodocumento_id'][$m], $request['be_identificacion'][$m], $request['be_fecha_expedicion'][$m], $request['be_expuesto_politico'][$m], $request['be_poliza_seguro'][$m], $conn);
						}
					}
				}else
					$m = $l;
				if(isset($request['si_beneficiarios_jur']) && $request['si_beneficiarios_jur'] == '-1'){
					$ni = 0;
					for($n = $m; $n < ($m + 4); $n++){
						if (verificarDatoNoDefault($request['be_nit'][$ni]) || verificarDatoNoDefault($request['be_razon_social'][$ni])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$n], $request['be_razon_social'][$ni], $request['be_nit'][$ni], $request['be_nombre_completo'][$n], $request['be_tipodocumento_id'][$n], $request['be_identificacion'][$n], "NULL", "NULL", $request['be_poliza_seguro'][$n], $conn);
						}
						$ni++;
					}
				}else
					$n = $m;
			}else if($request['tipopersona'] == "1"){
				if(isset($request['si_beneficiarios_nat']) && $request['si_beneficiarios_nat'] == '-1'){
					for($m = 0; $m < 4; $m++){
						if (verificarDatoNoDefault($request['be_identificacion'][$m]) || verificarDatoNoDefault($request['be_nombre_completo'][$m])) {
							$fecha = crearFechaDePartes($request['f_expbe_a'][$m] ?? '', $request['f_expbe_m'][$m] ?? '', $request['f_expbe_d'][$m] ?? '', '');
							$fecha = is_array($fecha) ? 'NULL' : $fecha;
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$m], "NULL", "NULL", $request['be_nombre_completo'][$m], $request['be_tipodocumento_id'][$m], $request['be_identificacion'][$m], $fecha, $request['be_expuesto_politico'][$m], $request['be_poliza_seguro'][$m], $conn);
						}
					}
				}else
					$m = 0;
				if(isset($request['si_beneficiarios_jur']) && $request['si_beneficiarios_jur'] == '-1'){
					$ni = 0;
					for($n = $m; $n < ($m + 4); $n++){
						if (verificarDatoNoDefault($request['be_nit'][$ni]) || verificarDatoNoDefault($request['be_razon_social'][$ni])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$n], $request['be_razon_social'][$ni], $request['be_nit'][$ni], $request['be_nombre_completo'][$n], $request['be_tipodocumento_id'][$n], $request['be_identificacion'][$n], "NULL", "NULL", $request['be_poliza_seguro'][$n], $conn);
						}
						$ni++;
					}
				}else
					$n = $m;
			}
			$conn->desconectar();
			$err_img = '';
			$imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp']);
			if ($imagen === false) {
				$err_img = 'No se encontro la imagen con el identificador: ' . $request['id_imagen_tmp'];
			} else {
				$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']/*, 2*/);
			}

			$documentVerf = $request['tipopersona'] == '1' ? $request['documento'] : $request['nit']
			;
			Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);

			Formulario::guardarPlanillaLote($request['planilla_lote'], $request['lote'], $_SESSION['id']);
			
			Formulario::addIndexacion($form_id, $_SESSION['id']);

			$mensaje = 'Se agrego la nueva digitacion';
			if (!empty($err_img)) $mensaje .= ', con el siguiente problema: ' . $err_img;

			echo json_encode(['exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id]);

		} catch (Exception $e) {
			var_dump($e);
			echo json_encode(['error'=> $e->getMessage()]);
		}
	}else{
		if (!empty($request['nit']) && $request['tipopersona'] == "2") {
			$cliente_id = Formulario::crearNuevoCliente($request['nit'], $request['tipopersona'], $request['razonsocial'], 2, 2/*, 2*/);
		} else if (!empty($request['documento']) && $request['tipopersona'] == "1") {
			$cliente_id = Formulario::crearNuevoCliente($request['documento'], $request['tipopersona'], $request['primerapellido'] . " " . $request['segundoapellido'] . " " . $request['nombres'], 2, 2/*, 2*/);
		}

		if (!isset($cliente_id) || empty($cliente_id) || $cliente_id === false) {
			echo json_encode(['error'=> 'Ocurrio un error al momento de crear el cliente, por favor contacte con el administrador.']);
			exit;
		}
		$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
		if (isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])) {
			echo json_encode(["error"=> "2. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => ".$exForm['id'].", por favor contacte con el administrador."]);
			exit;
		}
	$form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca']/*, 2*/);
		if ($form_id === false || $form_id === 0) {
			echo json_encode(['error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador.']);
			exit;
		}
		try{
			$conn = new Conexion();
			$idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id, $conn/*, 2*/);
			if ($idData === false || $idData === 0) {
				echo json_encode(['error'=> 'Ocurrio un error al momento de crear la data del formulario, por favor contacte con el administrador.']);
				exit;
			}
			if ($request['tipopersona'] == "2") {
				//JUNTA DIRECTIVA
				if(isset($request['si_junta_directiva']) && $request['si_junta_directiva'] == '-1'){
					for ($i = 0; $i < 3; $i++) { 
						if(verificarDatoNoDefault($request['ju_identificacion'][$i]) || verificarDatoNoDefault($request['ju_nombre_completo'][$i])){
							Formulario::insertMiembroJunta($idData, $request['ju_nombre_completo'][$i], $request['ju_tipodocumento_id'][$i], $request['ju_identificacion'][$i], $request['ju_expuesto_politico'][$i], $conn);
						}
					}
				}
				if(isset($request['si_accionistas_nat']) && $request['si_accionistas_nat'] == '-1'){
					for($k = 0; $k < 3; $k++){
						if (verificarDatoNoDefault($request['be_identificacion'][$k]) || verificarDatoNoDefault($request['be_nombre_completo'][$k])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$k], "NULL", "NULL", $request['be_nombre_completo'][$k], $request['be_tipodocumento_id'][$k], $request['be_identificacion'][$k], $request['be_fecha_expedicion'][$k], $request['be_expuesto_politico'][$k], $request['be_poliza_seguro'][$k], $conn);
						}
					}
				}else
					$k = 0;
				if(isset($request['si_accionistas_jur']) && $request['si_accionistas_jur'] == '-1'){
					for($l = $k; $l < ($k + 3); $l++){
						if (verificarDatoNoDefault($request['be_nit'][$l]) || verificarDatoNoDefault($request['be_razon_social'][$l])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$l], $request['be_razon_social'][$l], $request['be_nit'][$l], $request['be_nombre_completo'][$l], $request['be_tipodocumento_id'][$l], $request['be_identificacion'][$l], "NULL", $request['be_expuesto_politico'][$l], "NULL", $conn);
						}
					}
				}else
					$l = $k;
				if(isset($request['si_beneficiarios_nat']) && $request['si_beneficiarios_nat'] == '-1'){
					for($m = $l; $m < ($l + 4); $m++){
						if (verificarDatoNoDefault($request['be_identificacion'][$m]) || verificarDatoNoDefault($request['be_nombre_completo'][$m])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$m], "NULL", "NULL", $request['be_nombre_completo'][$m], $request['be_tipodocumento_id'][$m], $request['be_identificacion'][$m], $request['be_fecha_expedicion'][$m], $request['be_expuesto_politico'][$m], $request['be_poliza_seguro'][$m], $conn);
						}
					}
				}else
					$m = $l;
				if(isset($request['si_beneficiarios_jur']) && $request['si_beneficiarios_jur'] == '-1'){
					$ni = 0;
					for($n = $m; $n < ($m + 4); $n++){
						if (verificarDatoNoDefault($request['be_nit'][$ni]) || verificarDatoNoDefault($request['be_razon_social'][$ni])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$n], $request['be_razon_social'][$ni], $request['be_nit'][$ni], $request['be_nombre_completo'][$n], $request['be_tipodocumento_id'][$n], $request['be_identificacion'][$n], "NULL", "NULL", $request['be_poliza_seguro'][$n], $conn);
						}
						$ni++;
					}
				}else
					$n = $m;
			}else if($request['tipopersona'] == "1"){
				if(isset($request['si_beneficiarios_nat']) && $request['si_beneficiarios_nat'] == '-1'){
					for($m = 0; $m < 4; $m++){
						if (verificarDatoNoDefault($request['be_identificacion'][$m]) || verificarDatoNoDefault($request['be_nombre_completo'][$m])) {
							$fecha = crearFechaDePartes($request['f_expbe_a'][$m] ?? '', $request['f_expbe_m'][$m] ?? '', $request['f_expbe_d'][$m] ?? '', '');
							$fecha = is_array($fecha) ? 'NULL' : $fecha;
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$m], "NULL", "NULL", $request['be_nombre_completo'][$m], $request['be_tipodocumento_id'][$m], $request['be_identificacion'][$m], $fecha, $request['be_expuesto_politico'][$m], $request['be_poliza_seguro'][$m], $conn);
						}
					}
				}else
					$m = 0;
				if(isset($request['si_beneficiarios_jur']) && $request['si_beneficiarios_jur'] == '-1'){
					$ni = 0;
					for($n = $m; $n < ($m + 4); $n++){
						if (verificarDatoNoDefault($request['be_nit'][$ni]) || verificarDatoNoDefault($request['be_razon_social'][$ni])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$n], $request['be_razon_social'][$ni], $request['be_nit'][$ni], $request['be_nombre_completo'][$n], $request['be_tipodocumento_id'][$n], $request['be_identificacion'][$n], "NULL", "NULL", $request['be_poliza_seguro'][$n], $conn);
						}
						$ni++;
					}
				}else
					$n = $m;
			}
			$conn->desconectar();
			$err_img = 'No se encontro la imagen con el identificador: ' . $request['id_imagen_tmp'];
			$imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp']);
			if ($imagen !== false) {
				$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']/*, 2*/);
			}
			$documentVerf = $request['tipopersona'] == '1' ? $request['documento'] : $request['nit'];
			Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);

			Formulario::guardarPlanillaLote($request['planilla_lote'], $request['lote'], $_SESSION['id']);
		
			Formulario::addIndexacion($form_id, $_SESSION['id']);

			$mensaje = 'Se agrego la nueva digitacion';
			if (!empty($err_img)) $mensaje .= ', con el siguiente problema: ' . $err_img;

			echo json_encode(array('exito'=> $mensaje, 'url'=> 'fingering2.php?id_form='.$form_id.'&id_cliente='.$cliente_id));

		}catch(Exception $e){
			echo json_encode(array('error'=> $e->getMessage()));
		}
	}
}
function guardarFormularioSectorAseguradoAction($request){
    $request['fecharadicado'] = '0000-00-00';
	$request['fechasolicitud'] = '0000-00-00';
	$request['fechaexpedicion'] = '0000-00-00';
	$request['fechanacimiento'] = '0000-00-00';
	$request['verificacion_fecha'] = '0000-00-00';
	$request['verificacion_hora'] = '00:00:00';


	if((isset($request['f_rad_a']) && !empty($request['f_rad_a'])) && (isset($request['f_rad_m']) && !empty($request['f_rad_m'])) && (isset($request['f_rad_d']) && !empty($request['f_rad_d']))){
		if(date('Y-m-d', strtotime($request['f_rad_a'].'-'.$request['f_rad_m'].'-'.$request['f_rad_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de radicado no puede ser errada."));
			exit;
		}else
			$request['fecharadicado'] = date('Y-m-d', strtotime($request['f_rad_a'].'-'.$request['f_rad_m'].'-'.$request['f_rad_d']));
	}else{
		echo json_encode(array("error"=> "La fecha de radicado no puede ser vacia."));
		exit;
	}
	if((isset($request['f_dil_a']) && !empty($request['f_dil_a'])) && (isset($request['f_dil_m']) && !empty($request['f_dil_m'])) && (isset($request['f_dil_d']) && !empty($request['f_dil_d']))){
		if(date('Y-m-d', strtotime($request['f_dil_a'].'-'.$request['f_dil_m'].'-'.$request['f_dil_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser errada."));
			exit;
		}else
			$request['fechasolicitud'] = date('Y-m-d', strtotime($request['f_dil_a'].'-'.$request['f_dil_m'].'-'.$request['f_dil_d']));
	}else{
		echo json_encode(array("error"=> "La fecha de diligenciamiento no puede ser vacia."));
		exit;
	}
	if((isset($request['f_exp_a']) && !empty($request['f_exp_a'])) && (isset($request['f_exp_m']) && !empty($request['f_exp_m'])) && (isset($request['f_exp_d']) && !empty($request['f_exp_d']))){
		if(date('Y-m-d', strtotime($request['f_exp_a'].'-'.$request['f_exp_m'].'-'.$request['f_exp_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de expedicion no puede ser errada."));
			exit;
		}else
			$request['fechaexpedicion'] = date('Y-m-d', strtotime($request['f_exp_a'].'-'.$request['f_exp_m'].'-'.$request['f_exp_d']));
	}
	if((isset($request['f_nac_a']) && !empty($request['f_nac_a'])) && (isset($request['f_nac_m']) && !empty($request['f_nac_m'])) && (isset($request['f_nac_d']) && !empty($request['f_nac_d']))){
		if(date('Y-m-d', strtotime($request['f_nac_a'].'-'.$request['f_nac_m'].'-'.$request['f_nac_d'])) == '1969-12-31' && ($request['f_nac_a'] != '1969' || $request['f_nac_m'] != '12' || $request['f_nac_d'] != '31')){
			echo json_encode(array("error"=> "La fecha de nacimento no puede ser errada."));
			exit;
		}else
			$request['fechanacimiento'] = date('Y-m-d', strtotime($request['f_nac_a'].'-'.$request['f_nac_m'].'-'.$request['f_nac_d']));
	}
	if((isset($request['f_ver_a']) && !empty($request['f_ver_a'])) && (isset($request['f_ver_m']) && !empty($request['f_ver_m'])) && (isset($request['f_ver_d']) && !empty($request['f_ver_d']))){
		if(date('Y-m-d', strtotime($request['f_ver_a'].'-'.$request['f_ver_m'].'-'.$request['f_ver_d'])) == '1969-12-31'){
			echo json_encode(array("error"=> "La fecha de verificacion no puede ser errada."));
			exit;
		}else
			$request['verificacion_fecha'] = date('Y-m-d', strtotime($request['f_ver_a'].'-'.$request['f_ver_m'].'-'.$request['f_ver_d']));
	}
	$request['tipohoraentrevista'] = $request['h_ent_z'] ?? 'SD';
	if((isset($request['h_ver_h']) && !empty($request['h_ver_h'])) && (isset($request['h_ver_m']) && !empty($request['h_ver_m'])) && (isset($request['h_ver_z']) && !empty($request['h_ver_z']))){
		$request['verificacion_hora'] = date('H:i', strtotime($request['h_ver_h'].':'.$request['h_ver_m'].' '.$request['h_ver_z']));
	}
	if($request['clasecliente'] != '10')
		$request['cual_clasecliente'] = 'SD';
	if(isset($request['tipoempresaemp']) && $request['tipoempresaemp'] != '5')
		$request['tipoempresaemp_cual'] = 'SD';
	if(isset($request['reconocimiento_publico']) && ($request['reconocimiento_publico'] == '0' || $request['reconocimiento_publico'] == '2'))
		$request['reconocimiento_cual'] = 'SD';

	if($request['expuesta_politica'] == '0' || $request['expuesta_politica'] == '2')
		$request['cargo_politica'] = 'SD';

	if($request['expuesta_publica'] == '0' || $request['expuesta_publica'] == '2'){
		$request['publica_nombre'] = 'SD';
		$request['publica_cargo'] = 'SD';
	}
	if(isset($request['repre_internacional']) && ($request['repre_internacional'] == '0' || $request['repre_internacional'] == '2'))
		$request['internacional_indique'] = 'SD';
	if($request['tributarias_otro_pais'] == '0' || $request['tributarias_otro_pais'] == '2')
		$request['tributarias_paises'] = 'SD';
	if(isset($request['tipoempresajur']) && $request['tipoempresajur'] != '5')
		$request['tipoempresajur_otra'] = 'SD';
	if(($request['monedaextranjera'] == '0' || $request['monedaextranjera'] == '2') && !isset($request['tipotransacciones'])){
		$request['tipotransacciones'] = '8';
		$request['tipotransacciones_cual'] = 'SD';
	}elseif($request['monedaextranjera'] == '0' && $request['tipotransacciones'] != '7'){
		$request['tipotransacciones_cual'] = 'SD';
	}
	$patrimonio = 0;
	if ($request['tipopersona'] == '2') {
		$request['tipoactividad'] = '900';
		$request['profesion'] = '900';
		$request['cargo'] = 'SD';
		$request['actividadeconomicaempresa'] = '4';
		$request['ciiu_otro'] = '0';
		$request['telefonoficinappal'] = '*';
		$request['ingresosmensuales'] = '13';
		$request['totalactivos'] = '*';
		$request['totalpasivos'] = '*';
		$request['egresosmensuales'] = '13';
		$request['otrosingresos'] = '13';
		$request['conceptosotrosingresos'] = 'SD';
		$patrimonio = intval($request['activosemp']) - intval($request['pasivosemp']);
	} else if ($request['tipopersona'] == '1') {
		$request['razonsocial'] = 'SD';
		$request['nit'] = '*';
		$request['digitochequeo'] = '0';
		$request['tipoempresajur'] = '4';
		$request['tipoempresajur_otra'] = 'SD';
		$request['detalleactividadeconomicappal'] = 'SD';
		$request['ciudadoficina'] = '99999';
		$request['telefonoficina'] = '*';
		$request['correoelectronico_otro'] = 'SD';
		$request['celularoficina'] = '*';
		$request['direccionsucursal'] = 'SD';
		$request['ingresosmensualesemp'] = '7';
		$request['activosemp'] = '*';
		$request['pasivosemp'] = '*';
		$request['egresosmensualesemp'] = '7';
		$request['otrosingresosemp'] = '7';
		$request['concepto_otrosingresosemp'] = 'SD';
		$patrimonio = intval($request['totalactivos']) - intval($request['totalpasivos']);
	}
	$request['patrimonio'] = $patrimonio <= 0 ? '0' : $patrimonio;
	if(!isset($request['actividadeconomicaempresa']))
		$request['actividadeconomicaempresa'] = '4';
	if(!isset($request['tipotransacciones']))
		$request['tipotransacciones'] = '8';
	if(!isset($request['tipotransacciones_cual']))
		$request['tipotransacciones_cual'] = 'SD';

	if(!isset($request['telefonoresidencia']) || empty($request['telefonoresidencia']))
		$request['telefonoresidencia'] = '*';
	if(!isset($request['celular']) || empty($request['celular']))
		$request['celular'] = '*';
	if(!isset($request['telefonolaboral']) || empty($request['telefonolaboral']))
		$request['telefonolaboral'] = '*';
	if(!isset($request['celularoficinappal']) || empty($request['celularoficinappal']))
		$request['celularoficinappal'] = '*';
	if(!isset($request['telefonoficinappal']) || empty($request['telefonoficinappal']))
		$request['telefonoficinappal'] = '*';
	if(!isset($request['telefonoficina']) || empty($request['telefonoficina']))
		$request['telefonoficina'] = '*';
	if(!isset($request['celularoficina']) || empty($request['celularoficina']))
		$request['celularoficina'] = '*';

	if(!isset($request['resultadoentrevista']))
		$request['resultadoentrevista'] = 'APROBADO';
	if(!isset($request['observacionesentrevista']))
		$request['observacionesentrevista'] = $request['verificacion_observacion'];
	
	if((empty($request['documento']) || empty($request['nit']) ) && empty($request['tipopersona'])){
		echo json_encode(array('error'=> 'El numero de documento del cliente no puede estar vacion, por favor verifiquelo.'));
		exit;
	}
	if (!empty($request['nit']) && $request['tipopersona'] == "2") {
		$cliente_id = Formulario::obtenerIdCliente($request['nit'], $request['tipopersona']/*, 2*/);
	} else if (!empty($request['documento']) && $request['tipopersona'] == "1") {
		$cliente_id = Formulario::obtenerIdCliente($request['documento'], $request['tipopersona']/*, 2*/);
	}

	if(isset($cliente_id) && !empty($cliente_id) && $cliente_id !== false){
		Formulario::activeCliente($cliente_id);
		Formulario::actualizarRegimen($cliente_id, 2/*, 2*/);
		$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
		if(isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])){
			echo json_encode(array("error"=> "1. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => ".$exForm['id'].", por favor contacte con el administrador."));
			exit;
		}
		$form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca']/*, 2*/);
		if ($form_id === false || $form_id === 0) {
			echo json_encode(['error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador.']);
			exit;
		}
		try {
			$conn = new Conexion();
			$idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id, $conn/*, 2*/);
			if ($idData === false || $idData === 0) {
				echo json_encode(['error'=> 'Ocurrio un error al momento de crear la data del formulario, por favor contacte con el administrador.']);
				exit;
			}
			if ($request['tipopersona'] == "2") {
				if (isset($request['si_accionistas_nat']) && $request['si_accionistas_nat'] == '-1') {
					for ($i = 0; $i < 5; $i++) { 
						if (verificarDatoNoDefault($request['identificacion'][$i]) || verificarDatoNoDefault($request['nombre_accionista'][$i])) {
							Formulario::insertAccionistas($idData, $request['tipo_id'][$i], $request['identificacion'][$i], $request['nombre_accionista'][$i], $request['porcentaje'][$i], "NULL", $request['publico_reconocimiento'][$i], $request['publico_expuesta'][$i], "NULL");
						}
					}
				}
				//JUNTA DIRECTIVA
				if (isset($request['si_junta_directiva']) && $request['si_junta_directiva'] == '-1') {
					for ($i = 0; $i < 5; $i++) {
						if (verificarDatoNoDefault($request['ju_identificacion'][$i]) || verificarDatoNoDefault($request['ju_nombre_completo'][$i])) {
							Formulario::insertMiembroJunta($idData, $request['ju_nombre_completo'][$i], $request['ju_tipodocumento_id'][$i], $request['ju_identificacion'][$i], $request['ju_expuesto_politico'][$i], $conn);
						}
					}
				}
				if (isset($request['si_beneficiarios_nat']) && $request['si_beneficiarios_nat'] == '-1') {
					for ($m = 0; $m < 4; $m++) {
						if (verificarDatoNoDefault($request['be_identificacion'][$m]) || verificarDatoNoDefault($request['be_nombre_completo'][$m])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$m], "NULL", "NULL", $request['be_nombre_completo'][$m], $request['be_tipodocumento_id'][$m], $request['be_identificacion'][$m], "NULL", $request['be_expuesto_politico'][$m], $request['be_poliza_seguro'][$m], $conn);
						}
					}
				}
			} else if ($request['tipopersona'] == "1") {
				if (isset($request['si_beneficiarios_nat']) && $request['si_beneficiarios_nat'] == '-1') {
					for ($m = 0; $m < 4; $m++) {
						if (verificarDatoNoDefault($request['be_identificacion'][$m]) || verificarDatoNoDefault($request['be_nombre_completo'][$m])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$m], "NULL", "NULL", $request['be_nombre_completo'][$m], $request['be_tipodocumento_id'][$m], $request['be_identificacion'][$m], "NULL", $request['be_expuesto_politico'][$m], $request['be_poliza_seguro'][$m], $conn);
						}
					}
				}
			}
			if (isset($request['si_peps_nat']) && $request['si_peps_nat'] == "-1") {
				for ($k = 0; $k < 5; $k++) {
					if (verificarDatoNoDefault($request['pep_identificacion'][$k]) || verificarDatoNoDefault($request['pep_nombre_razon'][$k])) {
						Formulario::insertNuevoPep($idData, $request['pep_vinculo_relacion'][$k], $request['pep_tipo_pep'][$k], $request['pep_nombre_razon'][$k], $request['pep_tipodocumento_id'][$k], $request['pep_identificacion'][$k], $request['pep_nacionalidad_id'][$k], $request['pep_entidad'][$k], $request['pep_cargo'][$k], $request['pep_fecha_vinculacion'][$k], $request['pep_fecha_desvinculacion'][$k], $request['pep_cuentas_otros_paises'][$k], $conn);
					}
				}
			} else
				$k = 0;
			if (isset($request['si_peps_vinculados']) && $request['si_peps_vinculados'] == "-1") {
				for ($l = $k; $l < ($k + 5); $l++) {
					if (verificarDatoNoDefault($request['pep_identificacion'][$l]) || verificarDatoNoDefault($request['pep_nombre_razon'][$l])) {
						Formulario::insertNuevoPep($idData, $request['pep_vinculo_relacion'][$l], "NULL", $request['pep_nombre_razon'][$l], $request['pep_tipodocumento_id'][$l], $request['pep_identificacion'][$l], $request['pep_nacionalidad_id'][$l], "NULL", "NULL", "NULL", "NULL", "NULL", $conn);
					}
				}
			} else
				$l = $k;
			$conn->desconectar();
			$err_img = 'No se encontro la imagen con el identificador: ' . $request['id_imagen_tmp'];
			$imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp']);
			if ($imagen !== false) {
				$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']/*, 2*/);
			}
			$documentVerf = $request['tipopersona'] == '1' ? $request['documento'] : $request['nit'];
			Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);

			Formulario::guardarPlanillaLote($request['planilla_lote'], $request['lote'], $_SESSION['id']);
			
			Formulario::addIndexacion($form_id, $_SESSION['id']);
			$mensaje = 'Se agrego la nueva digitacion';
			if (!empty($err_img)) $mensaje .= ', con el siguiente problema: ' . $err_img;

			echo json_encode(['exito'=> $mensaje, 'url'=> 'fingering2.php?id_form=' . $form_id . '&id_cliente=' . $cliente_id]);
		} catch (Exception $e) {
			var_dump($e);
			echo json_encode(['error'=> $e->getMessage()]);
		}
	}else{
		if (!empty($request['nit']) && $request['tipopersona'] == "2") {
			$cliente_id = Formulario::crearNuevoCliente($request['nit'], $request['tipopersona'], $request['razonsocial'], 2, 2/*, 2*/);
		} else if (!empty($request['documento']) && $request['tipopersona'] == "1") {
			$cliente_id = Formulario::crearNuevoCliente($request['documento'], $request['tipopersona'], $request['primerapellido'] . " " . $request['segundoapellido'] . " " . $request['nombres'], 2, 2/*, 2*/);
		}

		if (!isset($cliente_id) || empty($cliente_id) || $cliente_id === false) {
			echo json_encode(array('error'=> 'Ocurrio un error al momento de crear el cliente, por favor contacte con el administrador.'));
			exit;
		}
		$exForm = Formulario::verificarFormulario($cliente_id, $request['lote'], $request['planilla1'], $_SESSION['id']);
		if(isset($exForm) && is_array($exForm) && !empty($exForm) && isset($exForm['id']) && !empty($exForm['id'])){
			echo json_encode(array("error"=> "2. El formulario que esta intentando registrar, ya se encuentra registrado bajo el id => ".$exForm['id'].", por favor contacte con el administrador."));
			exit;
		}
		$form_id = Formulario::agregarNuevoFormulario($cliente_id, 'FORMULARIO', $request['lote'], $request['planilla1'], $_SESSION['id'], '1', $request['marca']/*, 2*/);
		if ($form_id === false || $form_id === 0) {
			echo json_encode(['error'=> 'Ocurrio un error al momento de crear el formulario, por favor contacte con el administrador.']);
			exit;
		}
		try {
			$conn = new Conexion();
			$idData = Formulario::insertPrimaryDataNew($form_id, $request, $cliente_id, $conn/*, 2*/);
			if ($idData === false || $idData === 0) {
				echo json_encode(['error'=> 'Ocurrio un error al momento de crear la data del formulario, por favor contacte con el administrador.']);
				exit;
			}
			if ($request['tipopersona'] == "2") {
				if (isset($request['si_accionistas_nat']) && $request['si_accionistas_nat'] == '-1') {
					for ($i = 0; $i < 5; $i++) { 
						if (verificarDatoNoDefault($request['identificacion'][$i]) || verificarDatoNoDefault($request['nombre_accionista'][$i])) {
							Formulario::insertAccionistas($idData, $request['tipo_id'][$i], $request['identificacion'][$i], $request['nombre_accionista'][$i], $request['porcentaje'][$i], "NULL", $request['publico_reconocimiento'][$i], $request['publico_expuesta'][$i], "NULL");
						}
					}
				}
				//JUNTA DIRECTIVA
				if (isset($request['si_junta_directiva']) && $request['si_junta_directiva'] == '-1') {
					for ($i = 0; $i < 5; $i++) {
						if (verificarDatoNoDefault($request['ju_identificacion'][$i]) || verificarDatoNoDefault($request['ju_nombre_completo'][$i])) {
							Formulario::insertMiembroJunta($idData, $request['ju_nombre_completo'][$i], $request['ju_tipodocumento_id'][$i], $request['ju_identificacion'][$i], $request['ju_expuesto_politico'][$i], $conn);
						}
					}
				}
				if (isset($request['si_beneficiarios_nat']) && $request['si_beneficiarios_nat'] == '-1') {
					for ($m = 0; $m < 4; $m++) {
						if (verificarDatoNoDefault($request['be_identificacion'][$m]) || verificarDatoNoDefault($request['be_nombre_completo'][$m])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$m], "NULL", "NULL", $request['be_nombre_completo'][$m], $request['be_tipodocumento_id'][$m], $request['be_identificacion'][$m], "NULL", $request['be_expuesto_politico'][$m], $request['be_poliza_seguro'][$m], $conn);
						}
					}
				}
			} else if ($request['tipopersona'] == "1") {
				if (isset($request['si_beneficiarios_nat']) && $request['si_beneficiarios_nat'] == '-1') {
					for ($m = 0; $m < 4; $m++) {
						if (verificarDatoNoDefault($request['be_identificacion'][$m]) || verificarDatoNoDefault($request['be_nombre_completo'][$m])) {
							Formulario::insertNuevoAccionista($idData, $request['be_tipo'][$m], "NULL", "NULL", $request['be_nombre_completo'][$m], $request['be_tipodocumento_id'][$m], $request['be_identificacion'][$m], "NULL", $request['be_expuesto_politico'][$m], $request['be_poliza_seguro'][$m], $conn);
						}
					}
				}
			}
			if (isset($request['si_peps_nat']) && $request['si_peps_nat'] == "-1") {
				for ($k = 0; $k < 5; $k++) {
					if (verificarDatoNoDefault($request['pep_identificacion'][$k]) || verificarDatoNoDefault($request['pep_nombre_razon'][$k])) {
						Formulario::insertNuevoPep($idData, $request['pep_vinculo_relacion'][$k], $request['pep_tipo_pep'][$k], $request['pep_nombre_razon'][$k], $request['pep_tipodocumento_id'][$k], $request['pep_identificacion'][$k], $request['pep_nacionalidad_id'][$k], $request['pep_entidad'][$k], $request['pep_cargo'][$k], $request['pep_fecha_vinculacion'][$k], $request['pep_fecha_desvinculacion'][$k], $request['pep_cuentas_otros_paises'][$k], $conn);
					}
				}
			} else
				$k = 0;
			if (isset($request['si_peps_vinculados']) && $request['si_peps_vinculados'] == "-1") {
				for ($l = $k; $l < ($k + 5); $l++) {
					if (verificarDatoNoDefault($request['pep_identificacion'][$l]) || verificarDatoNoDefault($request['pep_nombre_razon'][$l])) {
						Formulario::insertNuevoPep($idData, $request['pep_vinculo_relacion'][$l], "NULL", $request['pep_nombre_razon'][$l], $request['pep_tipodocumento_id'][$l], $request['pep_identificacion'][$l], $request['pep_nacionalidad_id'][$l], "NULL", "NULL", "NULL", "NULL", "NULL", $conn);
					}
				}
			} else
				$l = $k;

			$conn->desconectar();
			$err_img = 'No se encontro la imagen con el identificador: ' . $request['id_imagen_tmp'];
			$imagen = Formulario::obtenerImagenTemporal($request['id_imagen_tmp']);
			if ($imagen !== false) {
				$err_img = Formulario::guardarImagenDigitada($imagen['filename'], $form_id, $request['type'], $_SESSION['id'], $request['id_imagen_tmp']/*, 2*/);
			}
			$documentVerf = $request['tipopersona'] == '1' ? $request['documento'] : $request['nit'];
			Formulario::cambiarEstadoDevolucion($documentVerf, $request['tipopersona']);

			Formulario::guardarPlanillaLote($request['planilla_lote'], $request['lote'], $_SESSION['id']);
		
			Formulario::addIndexacion($form_id, $_SESSION['id']);

			$mensaje = 'Se agrego la nueva digitacion';
			if (!empty($err_img)) $mensaje .= ', con el siguiente problema: ' . $err_img;

			echo json_encode(['exito'=> $mensaje, 'url'=> 'fingering2.php?id_form=' . $form_id . '&id_cliente=' . $cliente_id]);
		} catch (Exception $e) {
			echo json_encode(['error'=> $e->getMessage()]);
		}
	}
}
function verificarDatoNoDefault($dato){
	return (!empty($dato) && $dato != 'SD' && $dato != 'NA' && $dato != 'N/A' && $dato != '*');
}
function crearFechaDePartes($anio, $mes, $dia, $fechaNombre)
{
	$fec = implode('-', [$anio, $mes, $dia]);
	if(date('Y-m-d', strtotime($fec)) == '1969-12-31' && date('Y-m-d', strtotime($fec)) != $fec){
		return ['error'=> 'La fecha de ' . $fechaNombre . ' esta errada, por favor verifiquela.'];
	}
	return date('Y-m-d', strtotime($fec));
}
