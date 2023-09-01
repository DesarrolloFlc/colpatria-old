<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'form.class.php';
extract($_POST);
$fecharadicado = NULL;
$fechasolicitud = NULL;
$fechaexpedicion = NULL;
$fechanacimiento = NULL;
$cargo_politica_ini = NULL;
$cargo_politica_fin = NULL;
$fechaentrevista = NULL;
$verificacion_fecha = NULL;
$horaentrevista = NULL;
$verificacion_hora = NULL;

if ((!isset($_POST['f_rad_a']) || empty($_POST['f_rad_a'])) || (!isset($_POST['f_rad_m']) || empty($_POST['f_rad_m'])) || (!isset($_POST['f_rad_d']) || empty($_POST['f_rad_d']))) {
	echo "<script>alert('La fecha de radicado no puede ser vacia.');</script>";
	exit;
}
if (date('Y-m-d', strtotime($_POST['f_rad_a'] . '-' . $_POST['f_rad_m'] . '-' . $_POST['f_rad_d'])) === '1969-12-31') {
	echo "<script>alert('La fecha de radicado no puede ser errada.');</script>";
	exit;
}
$fecharadicado = date('Y-m-d', strtotime($_POST['f_rad_a'] . '-' . $_POST['f_rad_m'] . '-' . $_POST['f_rad_d']));

if ((!isset($_POST['f_dil_a']) || empty($_POST['f_dil_a'])) || (!isset($_POST['f_dil_m']) || empty($_POST['f_dil_m'])) || (!isset($_POST['f_dil_d']) || empty($_POST['f_dil_d']))) {
	echo "<script>alert('La fecha de diligenciamiento no puede ser vacia. ".$_POST['f_dil_a'].'-'.$_POST['f_dil_m'].'-'.$_POST['f_dil_d']."');</script>";
	exit;
}
if (date('Y-m-d', strtotime($_POST['f_dil_a'] . '-' . $_POST['f_dil_m'] . '-' . $_POST['f_dil_d'])) === '1969-12-31') {
	echo "<script>alert('La fecha de diligenciamiento no puede ser errada..');</script>";
	exit;
}
$fechasolicitud = date('Y-m-d', strtotime($_POST['f_dil_a'].'-'.$_POST['f_dil_m'].'-'.$_POST['f_dil_d']));

if ((isset($_POST['f_exp_a']) && !empty($_POST['f_exp_a'])) && (isset($_POST['f_exp_m']) && !empty($_POST['f_exp_m'])) && (isset($_POST['f_exp_d']) && !empty($_POST['f_exp_d']))) {
	if (date('Y-m-d', strtotime($_POST['f_exp_a'] . '-' . $_POST['f_exp_m'] . '-' . $_POST['f_exp_d'])) === '1969-12-31') {
		echo "<script>alert('La fecha de expedicion no puede ser errada.');</script>";
		exit;
	}
	$fechaexpedicion = date('Y-m-d', strtotime($_POST['f_exp_a'] . '-' . $_POST['f_exp_m'] . '-' . $_POST['f_exp_d']));
}
if ((isset($_POST['f_nac_a']) && !empty($_POST['f_nac_a'])) && (isset($_POST['f_nac_m']) && !empty($_POST['f_nac_m'])) && (isset($_POST['f_nac_d']) && !empty($_POST['f_nac_d']))) {
	if(date('Y-m-d', strtotime($_POST['f_nac_a'] . '-' . $_POST['f_nac_m'] . '-' . $_POST['f_nac_d'])) === '1969-12-31'){
		echo "<script>alert('La fecha de nacimento no puede ser errada.');</script>";
		exit;
	}
	$fechanacimiento = date('Y-m-d', strtotime($_POST['f_nac_a'] . '-' . $_POST['f_nac_m'] . '-' . $_POST['f_nac_d']));
}
if ((isset($_POST['f_ini_a']) && !empty($_POST['f_ini_a'])) && (isset($_POST['f_ini_m']) && !empty($_POST['f_ini_m'])) && (isset($_POST['f_ini_d']) && !empty($_POST['f_ini_d']))) {
	if(date('Y-m-d', strtotime($_POST['f_ini_a'] . '-' . $_POST['f_ini_m'] . '-' . $_POST['f_ini_d'])) === '1969-12-31'){
		echo "<script>alert('La fecha inicial no puede ser errada.');</script>";
		exit;
	}
	$cargo_politica_ini = date('Y-m-d', strtotime($_POST['f_ini_a'] . '-' . $_POST['f_ini_m'] . '-' . $_POST['f_ini_d']));
}
if ((isset($_POST['f_fin_a']) && !empty($_POST['f_fin_a'])) && (isset($_POST['f_fin_m']) && !empty($_POST['f_fin_m'])) && (isset($_POST['f_fin_d']) && !empty($_POST['f_fin_d']))) {
	if(date('Y-m-d', strtotime($_POST['f_fin_a'] . '-' . $_POST['f_fin_m'] . '-' . $_POST['f_fin_d'])) === '1969-12-31'){
		echo "<script>alert('La fecha final no puede ser errada.');</script>";
		exit;
	}
	$cargo_politica_fin = date('Y-m-d', strtotime($_POST['f_fin_a'] . '-' . $_POST['f_fin_m'] . '-' . $_POST['f_fin_d']));
}
if ((isset($_POST['f_ent_a']) && !empty($_POST['f_ent_a'])) && (isset($_POST['f_ent_m']) && !empty($_POST['f_ent_m'])) && (isset($_POST['f_ent_d']) && !empty($_POST['f_ent_d']))) {
	if(date('Y-m-d', strtotime($_POST['f_ent_a'] . '-' . $_POST['f_ent_m'] . '-' . $_POST['f_ent_d'])) === '1969-12-31'){
		echo "<script>alert('La fecha de entrevista no puede ser errada.');</script>";
		exit;
	}
	$fechaentrevista = date('Y-m-d', strtotime($_POST['f_ent_a'] . '-' . $_POST['f_ent_m'] . '-' . $_POST['f_ent_d']));
}
if ((isset($_POST['f_ver_a']) && !empty($_POST['f_ver_a'])) && (isset($_POST['f_ver_m']) && !empty($_POST['f_ver_m'])) && (isset($_POST['f_ver_d']) && !empty($_POST['f_ver_d']))) {
	if(date('Y-m-d', strtotime($_POST['f_ver_a'] . '-' . $_POST['f_ver_m'] . '-' . $_POST['f_ver_d'])) === '1969-12-31'){
		echo "<script>alert('La fecha de verificacion no puede ser errada.');</script>";
		exit;
	}
	$verificacion_fecha = date('Y-m-d', strtotime($_POST['f_ver_a'] . '-' . $_POST['f_ver_m'] . '-' . $_POST['f_ver_d']));
}
if((isset($_POST['h_ent_h']) && !empty($_POST['h_ent_h'])) && (isset($_POST['h_ent_m']) && !empty($_POST['h_ent_m']))){
	$horaentrevista = $_POST['h_ent_h'] . ':' . $_POST['h_ent_m'];
}
$tipohoraentrevista = $_POST['h_ent_z'];

if((isset($_POST['h_ver_h']) && !empty($_POST['h_ver_h'])) && (isset($_POST['h_ver_m']) && !empty($_POST['h_ver_m'])) && (isset($_POST['h_ver_z']) && !empty($_POST['h_ver_z']))){
	$verificacion_hora = date('H:i', strtotime($_POST['h_ver_h'] . ':' . $_POST['h_ver_m'] . ' ' . $_POST['h_ver_z']));
}
if ($clasecliente != '10') $cual_clasecliente = NULL;
if ($tipoempresaemp != '5') $tipoempresaemp_cual = NULL;
if ($reconocimiento_publico == '0') $reconocimiento_cual = NULL;
if ($expuesta_politica == '0') $cargo_politica = NULL;
if ($expuesta_publica == '0') {
	$publica_nombre = NULL;
	$publica_cargo = NULL;
}
if ($repre_internacional == '0') $internacional_indique = NULL;
if ($tributarias_otro_pais == '0') $tributarias_paises = NULL;
if ($tipoempresajur != '5') $tipoempresajur_otra = NULL;
if ($monedaextranjera == '0' && !isset($tipotransacciones)) {
	$tipotransacciones = NULL;
	$tipotransacciones_cual = NULL;
} else if ($monedaextranjera == '0' && $tipotransacciones != '7') {
	$tipotransacciones_cual = NULL;
}

if (!isset($_POST['telefonoresidencia']) || empty($_POST['telefonoresidencia'])) $telefonoresidencia = '0';
if (!isset($_POST['celular']) || empty($_POST['celular'])) $celular = '0';
if (!isset($_POST['telefonolaboral']) || empty($_POST['telefonolaboral'])) $telefonolaboral = '0';
if (!isset($_POST['celularoficinappal']) || empty($_POST['celularoficinappal'])) $celularoficinappal = '0';
if (!isset($_POST['telefonoficinappal']) || empty($_POST['telefonoficinappal'])) $telefonoficinappal = '0';
if (!isset($_POST['telefonoficina']) || empty($_POST['telefonoficina'])) $telefonoficina = '0';
if (!isset($_POST['celularoficina']) || empty($_POST['celularoficina'])) $celularoficina = '0';

if ($type_person == '1') {
	if (Form::updateNewNatural($id_data, $id_form, $fecharadicado, $fechasolicitud, $ciudad, $sucursal, $area, $id_official, $tipo_solicitud, $clasecliente, $cual_clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $paisnacimiento, $nacionalidad_otra, $direccionresidencia, $ciudadresidencia, $correoelectronico, $telefonoresidencia, $celular, $nombreempresa, $direccionempresa, $telefonolaboral, $ciudadempresa, $celularoficinappal, $tipoempresaemp, $tipoempresaemp_cual, $recursos_publicos, $poder_publico, $reconocimiento_publico, $reconocimiento_cual, $servidor_publico, $expuesta_politica, $cargo_politica, $cargo_politica_ini, $cargo_politica_fin, $expuesta_publica, $publica_nombre, $publica_cargo, $repre_internacional, $internacional_indique, $tributarias_otro_pais, $tributarias_paises, $tipoactividad, $ciiu, $profesion, $cargo, $actividadeconomicaempresa, $ciiu_otro, $direccionoficinappal, $telefonoficinappal, $detalletipoactividad, $ingresosmensuales, $totalactivos, $totalpasivos, $egresosmensuales, $patrimonio, $otrosingresos, $conceptosotrosingresos, $origen_fondos, $procedencia_fondos, $monedaextranjera, $tipotransacciones, $tipotransacciones_cual, $otras_operaciones, $productos_exterior, $cuentas_monedaextranjera, $reclamaciones, $firma, $huella, $lugarentrevista, $resultadoentrevista, $fechaentrevista, $horaentrevista, $observacionesentrevista, $nombreintermediario, $clave_inter, $firma_entrevista, $verificacion_ciudad, $verificacion_fecha, $verificacion_hora, $verificacion_nombre, $verificacion_nombre, $verificacion_observacion, $verificacion_firma, $verificacion_observacion, $verificacion_firma, $_SESSION['id']) === 0) {
    	echo "<script>parent.console.log('" . json_encode($_POST) . "');alert('Actualización OK...');</script>";
	} else {
    	echo "<script>parent.console.log('" . json_encode($_POST) . "');alert('Error realizando la actualización...');</script>";
	}
} else if ($type_person == '2') {
	if (Form::updateNewJuridico($id_data, $id_form, $fecharadicado, $fechasolicitud, $ciudad, $sucursal, $area, $id_official, $tipo_solicitud, $clasecliente, $cual_clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $paisnacimiento, $nacionalidad_otra, $direccionresidencia, $ciudadresidencia, $correoelectronico, $telefonoresidencia, $celular, $nombreempresa, $direccionempresa, $telefonolaboral, $ciudadempresa, $celularoficinappal, $tipoempresaemp, $tipoempresaemp_cual, $recursos_publicos, $poder_publico, $reconocimiento_publico, $reconocimiento_cual, $servidor_publico, $expuesta_politica, $cargo_politica, $cargo_politica_ini, $cargo_politica_fin, $expuesta_publica, $publica_nombre, $publica_cargo, $repre_internacional, $internacional_indique, $tributarias_otro_pais, $tributarias_paises, $razonsocial, $digitochequeo, $tipoempresajur, $tipoempresajur_otra, $detalleactividadeconomicappal, $ciiu, $direccionoficinappal, $ciudadoficina, $telefonoficina, $correoelectronico_otro, $celularoficina, $direccionsucursal, $ingresosmensualesemp, $activosemp, $pasivosemp, $egresosmensualesemp, $patrimonio, $otrosingresosemp, $concepto_otrosingresosemp, $origen_fondos, $procedencia_fondos, $monedaextranjera, $tipotransacciones, $tipotransacciones_cual, $otras_operaciones, $productos_exterior, $cuentas_monedaextranjera, $reclamaciones, $firma, $huella, $lugarentrevista, $resultadoentrevista, $fechaentrevista, $horaentrevista, $observacionesentrevista, $nombreintermediario, $clave_inter, $firma_entrevista, $verificacion_ciudad, $verificacion_fecha, $verificacion_hora, $verificacion_nombre, $verificacion_nombre, $verificacion_observacion, $verificacion_firma, $verificacion_observacion, $verificacion_firma, $_SESSION['id']) == 0) {
    	echo "<script>parent.console.log('" . json_encode($_POST) . "');alert('Actualización OK.');</script>";
	} else {
    	echo "<script>parent.console.log('" . json_encode($_POST) . "');alert('Error realizando la actualización.');</script>";
	}
}
