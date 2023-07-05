<?php

include '../../config/globalParameters.php';

class General {

    function getActividades() {
        $sql = "SELECT * FROM param_actividad";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getClaseCliente() {
        $sql = "SELECT * FROM param_clasecliente";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getEgresosMensuales() {
        $sql = "SELECT * FROM param_egresosmensuales";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getEgresosMensualesEmp() {
        $sql = "SELECT * FROM param_egresosmensuales_emp";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getEstadosCiviles() {
        $sql = "SELECT * FROM param_estadocivil";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getEstudios() {
        $sql = "SELECT * FROM param_estudio";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getIngresosMensuales() {
        $sql = "SELECT * FROM param_ingresosmensuales";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getIngresosMensualesEmp() {
        $sql = "SELECT * FROM param_ingresosmensuales_emp";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getOcupaciones() {
        $sql = "SELECT * FROM param_ocupacion";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getOtrosIngresos() {
        $sql = "SELECT * FROM param_otrosingresos";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getProductos() {
        $sql = "SELECT * FROM param_producto";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getProfesiones() {
        $sql = "SELECT * FROM param_profesion";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getSexo() {
        $sql = "SELECT * FROM param_sexo";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTipoDocumento() {
        $sql = "SELECT * FROM param_tipodocumento";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTipoEmpresa() {
        $sql = "SELECT * FROM param_tipoempresa";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTipoPersona() {
        $sql = "SELECT * FROM param_tipopersona";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTipoTransacciones() {
        $sql = "SELECT * FROM param_tipotransacciones";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTipoVivienda() {
        $sql = "SELECT * FROM param_tipovivienda";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getSucursales() {
        $sql = "SELECT * FROM param_sucursales";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTiposActividad() {
        $sql = "SELECT * FROM param_tipoactividad";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getCiiu() {
        $sql = "SELECT * FROM param_ciiu";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getCiudades() {
        $sql = "SELECT * FROM param_ciudad WHERE estado = '0' ORDER BY description ASC";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getPais() {
        $sql = "SELECT id,description FROM param_pais";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getActividadEcono() {
        $sql = "SELECT id,description FROM param_actividadecono";
        return mysqli_query($GLOBALS['link'], $sql);
    }
    
    
    function getContacts() {
        $sql = "SELECT * FROM param_contact WHERE status = '1' ORDER BY description ASC";
        return mysqli_query($GLOBALS['link'], $sql);
    }

  
    function getAreas() {
        $sql = "SELECT * FROM param_area WHERE status = '1' ORDER BY description ASC";
        return mysqli_query($GLOBALS['link'], $sql);
    }

	function getFormularios() {
		$sql ="SELECT * FROM param_formulario ";
        return mysqli_query($GLOBALS['link'], $sql);
	}


    function getDigitadores() {
        $sql = "SELECT * FROM user WHERE id_group = '3' ";
        return mysqli_query($GLOBALS['link'], $sql);
    }


}
?>
