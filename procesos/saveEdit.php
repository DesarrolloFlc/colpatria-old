<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'form.class.php';
extract($_POST);

if (!isset($id_form)) {
    $id_form = "";
} if (!isset($fecharadicado)) {
    $fecharadicado = "";
} if (!isset($fechasolicitud)) {
    $fechasolicitud = "";
} if (!isset($sucursal)) {
    $sucursal = "";
} if (!isset($area)) {
    $area = "";
} if (!isset($id_official)) {
    $id_official = "";
} if (!isset($formulario)) {
    $formulario = "";
} if (!isset($clasecliente)) {
    $clasecliente = "";
} if (!isset($primerapellido)) {
    $primerapellido = "";
} if (!isset($segundoapellido)) {
    $segundoapellido = "";
} if (!isset($nombres)) {
    $nombres = "";
} if (!isset($tipodocumento)) {
    $tipodocumento = "";
} if (!isset($documento)) {
    $documento = "";
} if (!isset($fechaexpedicion)) {
    $fechaexpedicion = "";
} if (!isset($lugarexpedicion)) {
    $lugarexpedicion = "";
} if (!isset($fechanacimiento)) {
    $fechanacimiento = "";
} if (!isset($lugarnacimiento)) {
    $lugarnacimiento = "";
} if (!isset($sexo)) {
    $sexo = "";
} if (!isset($nacionalidad)) {
    $nacionalidad = "";
} if (!isset($numerohijos)) {
    $numerohijos = "";
} if (!isset($estadocivil)) {
    $estadocivil = "";
} if (!isset($direccionresidencia)) {
    $direccionresidencia = "";
} if (!isset($ciudadresidencia)) {
    $ciudadresidencia = "";
} if (!isset($telefonoresidencia)) {
    $telefonoresidencia = "";
} if (!isset($nombreempresa)) {
    $nombreempresa = "";
} if (!isset($ciudadempresa)) {
    $ciudadempresa = "";
} if (!isset($direccionempresa)) {
    $direccionempresa = "";
} if (!isset($nomenclatura)) {
    $nomenclatura = "";
} if (!isset($telefonolaboral)) {
    $telefonolaboral = "";
} if (!isset($celular)) {
    $celular = "";
} if (!isset($correoelectronico)) {
    $correoelectronico = "";
} if (!isset($cargo)) {
    $cargo = "";
} if (!isset($actividadeconomicaempresa)) {
    $actividadeconomicaempresa = "";
} if (!isset($profesion)) {
    $profesion = "";
} if (!isset($ocupacion)) {
    $ocupacion = "";
} if (!isset($detalleocupacion)) {
    $detalleocupacion = "";
} if (!isset($ciiu)) {
    $ciiu = "";
} if (!isset($ingresosmensuales)) {
    $ingresosmensuales = "";
} if (!isset($otrosingresos)) {
    $otrosingresos = "";
} if (!isset($egresosmensuales)) {
    $egresosmensuales = "";
} if (!isset($conceptosotrosingresos)) {
    $conceptosotrosingresos = "";
} if (!isset($tipoactividad)) {
    $tipoactividad = "";
} if (!isset($nivelestudios)) {
    $nivelestudios = "";
} if (!isset($tipovivienda)) {
    $tipovivienda = "";
} if (!isset($estrato)) {
    $estrato = "";
} if (!isset($totalactivos)) {
    $totalactivos = "";
} if (!isset($totalpasivos)) {
    $totalpasivos = "";
} if (!isset($razonsocial)) {
    $razonsocial = "";
} if (!isset($nit)) {
    $nit = "";
} if (!isset($digitochequeo)) {
    $digitochequeo = "";
} if (!isset($ciiu)) {
    $ciiu = "";
} if (!isset($ciudadoficina)) {
    $ciudadoficina = "";
} if (!isset($direccionoficinappal)) {
    $direccionoficinappal = "";
} if (!isset($nomenclatura_emp)) {
    $nomenclatura_emp = "";
} if (!isset($telefonoficina)) {
    $telefonoficina = "";
} if (!isset($faxoficina)) {
    $faxoficina = "";
} if (!isset($ciudadsucursal)) {
    $ciudadsucursal = "";
} if (!isset($direccionsucursal)) {
    $direccionsucursal = "";
} if (!isset($nomenclatura_emp2)) {
    $nomenclatura_emp2 = "";
} if (!isset($telefonosucursal)) {
    $telefonosucursal = "";
} if (!isset($faxsucursal)) {
    $faxsucursal = "";
} if (!isset($actividadeconomicappal)) {
    $actividadeconomicappal = "";
} if (!isset($detalleactividadeconomicappal)) {
    $detalleactividadeconomicappal = "";
} if (!isset($tipoempresaemp)) {
    $tipoempresaemp = "";
} if (!isset($activosemp)) {
    $activosemp = "";
} if (!isset($pasivosemp)) {
    $pasivosemp = "";
} if (!isset($ingresosmensualesemp)) {
    $ingresosmensualesemp = "";
} if (!isset($egresosmensualesemp)) {
    $egresosmensualesemp = "";
} if (!isset($socio1)) {
    $socio1 = "";
} if (!isset($socio2)) {
    $socio2 = "";
} if (!isset($socio3)) {
    $socio3 = "";
} if (!isset($monedaextranjera)) {
    $monedaextranjera = "";
} if (!isset($tipotransacciones)) {
    $tipotransacciones = "";
} if (!isset($firma)) {
    $firma = "";
} if (!isset($huella)) {
    $huella = "";
} if (!isset($lugarentrevista)) {
    $lugarentrevista = "";
} if (!isset($fechaentrevista)) {
    $fechaentrevista = "";
} if (!isset($horaentrevista)) {
    $horaentrevista = "";
} if (!isset($tipohoraentrevista)) {
    $tipohoraentrevista = "";
} if (!isset($resultadoentrevista)) {
    $resultadoentrevista = "";
} if (!isset($observacionesentrevista)) {
    $observacionesentrevista = "";
} if (!isset($nombreintermediario)) {
    $nombreintermediario = "";
}


$forma = new Form();
/*
  if($persontype = '1'){
  if( $forma->updateNatural($id_form,$fecharadicado,$fechasolicitud,$sucursal,$area,$id_official,$formulario,$clasecliente,$primerapellido,$segundoapellido,$nombres,$tipodocumento,$documento,$fechaexpedicion,$lugarexpedicion,$fechanacimiento,$lugarnacimiento,$sexo,$nacionalidad,$numerohijos,$estadocivil,$direccionresidencia,$ciudadresidencia,$telefonoresidencia,$nombreempresa,$ciudadempresa,$direccionempresa,$nomenclatura,$telefonolaboral,$celular,$correoelectronico,$cargo,$actividadeconomicaempresa,$profesion,$ocupacion,$ciiu,$ingresosmensuales,$otrosingresos,$egresosmensuales,$conceptosotrosingresos,$tipoactividad,$nivelestudios,$tipovivienda,$estrato,$totalactivos,$totalpasivos,$ciiu,$monedaextranjera,$tipotransacciones,$firma,$huella,$lugarentrevista,$fechaentrevista,$horaentrevista,$tipohoraentrevista,$resultadoentrevista,$observacionesentrevista,$nombreintermediario, $_SESSION['id']) == 0){
  echo "Actualizaci�n OK";
  }else{
  echo "Error realizando la actualizaci�n.";
  }
  }
  if($persontype = '2'){
  if( $forma->updateJuridico($id_form,$fecharadicado,$fechasolicitud,$sucursal,$area,$id_official,$formulario,$clasecliente,$primerapellido,$segundoapellido,$nombres,$tipodocumento,$documento,$fechaexpedicion,$lugarexpedicion,$ciiu,$razonsocial,$nit,$digitochequeo,$ciiu,$ciudadoficina,$direccionoficinappal,$nomenclatura_emp,$telefonoficina,$faxoficina,$ciudadsucursal,$direccionsucursal,$nomenclatura_emp2,$telefonosucursal,$faxsucursal,$actividadeconomicappal,$detalleactividadeconomicappal,$tipoempresaemp,$activosemp,$pasivosemp,$ingresosmensualesemp,$egresosmensualesemp,$monedaextranjera,$tipotransacciones,$firma,$huella,$lugarentrevista,$fechaentrevista,$horaentrevista,$tipohoraentrevista,$resultadoentrevista,$observacionesentrevista,$nombreintermediario, $_SESSION['id']) == 0){
  echo "Actualizaci�n OK";
  }else{
  echo "Error realizando la actualizaci�n.";
  }
  }
 */
if ($forma->update($id_form, $fecharadicado, $fechasolicitud, $sucursal, $area, $id_official, $formulario, $clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo, $nacionalidad, $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ocupacion, $detalleocupacion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $digitochequeo, $ciiu, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $detalleactividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $socio1, $socio2, $socio3, $monedaextranjera, $tipotransacciones, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario, $_SESSION['id']) == 0) {
    echo "Actualizaci�n OK";
} else {
    echo "Error realizando la actualizaci�n.";
}
?>