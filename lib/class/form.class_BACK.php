<?php

require_once PATH_SITE . DS . 'config/globalParameters.php';

class Form {

    function getLastId($id_client) {
        $sql = "SELECT * FROM form WHERE id_client = '$id_client' ORDER BY date_created DESC LIMIT 1 ";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function add($id_client, $type) {
        $sql = "INSERT INTO form(id_client,type) VALUES($id_client,'$type')";
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return -1;
    }

    function insertPrimaryData($id_form, $fechasolicitud, $sucursal, $clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo, $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ocupacion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $monedaextranjera, $tipotransacciones, $nacionalidad, $area, $lote, $formulario, $digitochequeo, $id_official) {
        $sql = "INSERT INTO data(id_form,
        fechasolicitud,
sucursal,
clasecliente,
primerapellido,
segundoapellido,
nombres,
tipodocumento,
documento,
fechaexpedicion,
lugarexpedicion,
fechanacimiento,
lugarnacimiento,
sexo,
numerohijos,
estadocivil,
direccionresidencia,
ciudadresidencia,
telefonoresidencia,
nombreempresa,
ciudadempresa,
direccionempresa,
nomenclatura,
telefonolaboral,
celular,
correoelectronico,
cargo,
actividadeconomicaempresa,
profesion,
ocupacion,
ciiu,
ingresosmensuales,
otrosingresos,
egresosmensuales,
conceptosotrosingresos,
tipoactividad,
nivelestudios,
tipovivienda,
estrato,
totalactivos,
totalpasivos,
razonsocial,
nit,
ciudadoficina,
direccionoficinappal,
nomenclatura_emp,
telefonoficina,
faxoficina,
ciudadsucursal,
direccionsucursal,
nomenclatura_emp2,
telefonosucursal,
faxsucursal,
actividadeconomicappal,
tipoempresaemp,
activosemp,
pasivosemp,
ingresosmensualesemp,
egresosmensualesemp,
monedaextranjera,
tipotransacciones,
nacionalidad,
area, 
lote,
formulario,
digitochequeo,
id_official 
) 
            VALUES('$id_form',
            '$fechasolicitud',
'$sucursal',
'$clasecliente',
'$primerapellido',
'$segundoapellido',
'$nombres',
'$tipodocumento',
'$documento',
'$fechaexpedicion',
'$lugarexpedicion',
'$fechanacimiento',
'$lugarnacimiento',
'$sexo',
'$numerohijos',
'$estadocivil',
'$direccionresidencia',
'$ciudadresidencia',
'$telefonoresidencia',
'$nombreempresa',
'$ciudadempresa',
'$direccionempresa',
'$nomenclatura',
'$telefonolaboral',
'$celular',
'$correoelectronico',
'$cargo',
'$actividadeconomicaempresa',
'$profesion',
'$ocupacion',
'$ciiu',
'$ingresosmensuales',
'$otrosingresos',
'$egresosmensuales',
'$conceptosotrosingresos',
'$tipoactividad',
'$nivelestudios',
'$tipovivienda',
'$estrato',
'$totalactivos',
'$totalpasivos',
'$razonsocial',
'$nit',
'$ciudadoficina',
'$direccionoficinappal',
'$nomenclatura_emp',
'$telefonoficina',
'$faxoficina',
'$ciudadsucursal',
'$direccionsucursal',
'$nomenclatura_emp2',
'$telefonosucursal',
'$faxsucursal',
'$actividadeconomicappal',
'$tipoempresaemp',
'$activosemp',
'$pasivosemp',
'$ingresosmensualesemp',
'$egresosmensualesemp',
'$monedaextranjera',
'$tipotransacciones',
'$nacionalidad',
'$area',
'$lote',
'$formulario',
'$digitochequeo',
'$id_official'
)";
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return -1;
    }

    function insertSecondData($id_form, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario) {
        $sql = "UPDATE data SET 
firma='$firma',
huella='$huella',
lugarentrevista='$lugarentrevista',
fechaentrevista='$fechaentrevista',
horaentrevista='$horaentrevista',
tipohoraentrevista='$tipohoraentrevista',
resultadoentrevista='$resultadoentrevista',
observacionesentrevista='$observacionesentrevista',
nombreintermediario='$nombreintermediario' 
                WHERE id_form = '$id_form'";
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return -1;
    }

    function getForms($id_client) {
        $sql = "SELECT * FROM form WHERE id_client = '$id_client'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getFormInfo($id_form) {
        $sql = "SELECT * FROM data WHERE id_form = '$id_form'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

}
