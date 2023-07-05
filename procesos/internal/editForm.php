<?php
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'official.class.php';
$general = new General();
$sucursales = $general->getSucursales();
$actividades = $general->getActividades();
$clasecliente = $general->getClaseCliente();
$egresos_mensuales = $general->getEgresosMensuales();
$egresos_mensuales_emp = $general->getEgresosMensualesEmp();
$estados_civiles = $general->getEstadosCiviles();
$estudios = $general->getEstudios();
$ingresos_mensuales = $general->getIngresosMensuales();
$ingresos_mensuales_emp = $general->getIngresosMensualesEmp();
$ocupaciones = $general->getOcupaciones();
$otros_ingresos = $general->getOtrosIngresos();
$profesiones = $general->getProfesiones();
$sexo = $general->getSexo();
$tipo_documento = $general->getTipoDocumento();
$tipo_documento_conyuge = $general->getTipoDocumento();
$tipo_empresa = $general->getTipoEmpresa();
$tipo_empresa_emp = $general->getTipoEmpresa();
$tipo_persona = $general->getTipoPersona();
$tipo_transacciones = $general->getTipoTransacciones();
$tipo_vivienda = $general->getTipoVivienda();
$tipo_actividad = $general->getTiposActividad();
$ciiu = $general->getCiiu();
$ciiu_emp = $general->getCiiu();
$ciudades = $general->getCiudades();
$ciudades_empresa = $general->getCiudades();
$ciudades_oficina = $general->getCiudades();
$ciudades_sucursal = $general->getCiudades();
$ciudades_moneda = $general->getCiudades();
$paises = $general->getPais();
$actividad_econo = $general->getActividadEcono();
$lugar_expedicion = $general->getCiudades();
$lugar_nacimiento = $general->getCiudades();
$areas = $general->getAreas();
$formularios = $general->getFormularios();

$ciudad_beneficiario = $general->getCiudades();

$official = new Official();
$officials = $official->getOfficials();

$type_person = $_GET['type'];
?>
<table>
    <tr>
        <td colspan="4" align="center"><input type="submit" value="Crear formulario" /></td>
    </tr>
</table>
