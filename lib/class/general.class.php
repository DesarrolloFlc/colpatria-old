<?php

require_once PATH_SITE . DS . "config/globalParameters.php";

class General 
{
    function getActividades() {
        $sql = "SELECT * FROM param_actividad WHERE estado = 0 AND tipo IN ('0', '1')";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getClaseCliente() {
        $sql = "SELECT * FROM param_clasecliente WHERE tipo IN (0, 1)";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getEgresosMensuales() {
        $sql = "SELECT * FROM param_egresosmensuales WHERE estado = 0";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getEgresosMensualesEmp() {
        $sql = "SELECT * FROM param_egresosmensuales_emp WHERE estado = 0";
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
        $sql = "SELECT * FROM param_ingresosmensuales WHERE estado = 0";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getIngresosMensualesEmp() {
        $sql = "SELECT * FROM param_ingresosmensuales_emp WHERE estado = 0";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getOcupaciones() {
        $sql = "SELECT * FROM param_ocupacion WHERE estado = 0";
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
        $sql = "SELECT * FROM param_profesion WHERE estado = 0";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getSexo() {
        $sql = "SELECT * FROM param_sexo WHERE estado = 0";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTipoDocumento() {
        $sql = "SELECT * FROM param_tipodocumento WHERE estado = 0";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTipoEmpresa() {
        $sql = "SELECT * FROM param_tipoempresa WHERE estado = 0 AND tipo IN ('0', '1')";
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
        $sql = "SELECT * FROM param_sucursales WHERE estado = 0 ORDER BY sucursal";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getTiposActividad() {
        $sql = "SELECT * FROM param_tipoactividad WHERE estado = 0";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getCiiu() {
        $sql = "SELECT * FROM param_ciiu";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getCiudades() {
        $sql = "SELECT * FROM param_ciudad WHERE estado = '0' ORDER BY  description ASC";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getPais() {
        $sql = "SELECT id,description FROM param_pais WHERE estado = 0";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getActividadEcono() {
        $sql = "SELECT id,description FROM param_actividadecono WHERE estado = 0";
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
        $sql = "SELECT * FROM param_formulario WHERE tipo IN (0, 1) AND estado = 0";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getDigitadores() {
        $sql = "SELECT * FROM user WHERE id_group = '3' ";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getPlanillasSucursal($sucursal, $fec_ini, $fec_fin) {
        $extra = '';
        if ($fec_ini != '' && $fec_fin != '') {
            $extra = "AND t2.date_created BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59'";
        } else {
            if ($fec_ini != '') {
                $extra = "AND t2.date_created >= '$fec_ini 00:00:00'";
            }
            if ($fec_fin != '') {
                $extra = "AND t2.date_created <= '$fec_fin 23:59:59'";
            }
        }
        $sql = "SELECT DISTINCT(t2.log_planilla) AS planilla
                FROM data AS t1, form AS t2 
                WHERE t1.sucursal = $sucursal
                AND t1.id_form = t2.id $extra";
        //echo $sql;
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getLoteSucursal($sucursal, $planilla, $fec_ini, $fec_fin) {
        $extra = '';
        if ($fec_ini != '' && $fec_fin != '') {
            $extra = "AND t2.date_created BETWEEN '$fec_ini 00:00:00' AND '$fec_fin 23:59:59'";
        } else {
            if ($fec_ini != '') {
                $extra = "AND t2.date_created >= '$fec_ini 00:00:00'";
            }
            if ($fec_fin != '') {
                $extra = "AND t2.date_created <= '$fec_fin 23:59:59'";
            }
        }
        $sql = "SELECT DISTINCT(t2.log_lote) AS lote
                FROM data AS t1, form AS t2 
                WHERE t1.sucursal = $sucursal
                AND t1.id_form = t2.id
                AND t2.log_planilla = $planilla $extra";
        //echo $sql;
        return mysqli_query($GLOBALS['link'], $sql);
    }
    function getPaises(){
        $objetos = array();
        $sql = "SELECT codigo AS id, description 
                FROM param_paises 
                WHERE estado = '0' 
                ORDER BY description";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    function getMonedas(){
        $objetos = array();
        $sql = "SELECT id, CONCAT(pais, ', ', moneda) AS description 
                FROM param_monedas 
                WHERE estado = '0' 
                ORDER BY pais";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    function getTipoDocumentos(){
        $objetos = array();
        $sql = "SELECT id, description 
                FROM param_tipodocumento 
                WHERE estado = '0'";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getCiudadesDanes(){
        $objetos = array();
        $sql = "SELECT cod_dane AS id, CONCAT(ciudad, ', ', departamento) AS ciudad 
                  FROM param_ciudadesdane 
                 ORDER BY 2";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getSucursalesLista(){
        $sql = "SELECT id, sucursal 
                  FROM param_sucursales 
                 WHERE estado = '0' 
                 ORDER BY sucursal";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getclaseVinculacion($tipo = '2'){
        $sql = "SELECT id, description 
                  FROM param_clasecliente 
                 WHERE tipo IN ('0', $tipo)
                 ORDER BY 2";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getTipoDocumentoID($tipo = '2'){
        $sql = "SELECT id, description 
                  FROM param_tipodocumento 
                 WHERE tipo IN ('0', $tipo)
                 ORDER BY 2";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getTipoEmpresaID($tipo = '2'){
        $sql = "SELECT id, description 
                  FROM param_tipoempresa 
                 WHERE tipo IN ('0', $tipo)
                   AND estado = '0'
                 ORDER BY 2";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getActividadesEconomicas($tipo = '2'){
        $sql = "SELECT id, description 
                  FROM param_actividad 
                 WHERE tipo IN ('0', $tipo)
                   AND estado = '0'
                 ORDER BY 2";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getCiiuId(){
        $sql = "SELECT codigo, descripcion 
                  FROM param_ciiu 
                 WHERE 1";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getProfesionesID(){
        $sql = "SELECT id, description 
                  FROM param_profesion 
                 WHERE estado = '0'";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getIngresosMensualesID(){
        $sql = "SELECT id, description, min 
                  FROM param_ingresosmensuales 
                 WHERE estado = '0'
                   AND tipo IN ('0', '2')
                 ORDER BY 3";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getEgresosMensualesID(){
        $sql = "SELECT id, description, min 
                  FROM param_egresosmensuales 
                 WHERE estado = '0'
                   AND tipo IN ('0', '2')
                 ORDER BY 3";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getTipoTransaccionesID(){
        $sql = "SELECT id, description 
                  FROM param_tipotransacciones 
                 WHERE estado = '0'
                   AND tipo IN ('0', '1', '2')
                 ORDER BY 2";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getPaisesID(){
        $objetos = array();
        $sql = "SELECT id, description 
                FROM param_paises 
                WHERE estado = '0' 
                ORDER BY description";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getAreasID(){
        $objetos = array();
        $sql = "SELECT id, description 
                  FROM param_area 
                 WHERE status = '1' 
                 ORDER BY description";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getOfficials(){
        $objetos = array();
        $sql = "SELECT id, name 
                  FROM official 
                 WHERE status = '0' 
                 ORDER BY name ASC";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
    public static function getTipoPersonaId(){
        $objetos = array();
        $sql = "SELECT * FROM param_tipopersona";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        while($dato = mysqli_fetch_array($resp))
            $objetos[] = $dato;
        return $objetos;
    }
}
