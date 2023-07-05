<?php
session_start();

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportCallSpecial.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'client.class.php';

extract($_POST);

if (!empty($hora)) {
    $hora = $hora + 1;
    $complemento = " WHERE (formu.date_created >= '$fecha_inicio $hora:00:00' AND formu.date_created  <= '$fecha_fin $hora:59:59') AND formu.status = 1 ";
} else {
    $complemento = " WHERE (formu.date_created >= '$fecha_inicio 00:00:00' AND formu.date_created <= '$fecha_fin 23:59:59')  AND formu.status = 1 ";
}

if (!empty($area)) {
    $complemento.= " AND data.area = '$area' ";
}

if (!empty($sucursal)) {
    $complemento.= " AND data.sucursal = '$sucursal' ";
}


$sql = "SELECT IF(cli.persontype = '1', 'NATURAL','JURIDICO'),
               sucursal.sucursal,
               param_area.description,
               data.id_official,
               formu.log_planilla,
               formu.log_lote,
               formu.marca,
               param_clasecliente.description, 
               IF( cli.persontype = '1',param_tipodocumento.description,'NIT'),
               IF( cli.persontype = '1', CONCAT(data.primerapellido,' ',data.segundoapellido,' ',data.nombres), data.razonsocial ),
               cli.document,
               IF( cli.persontype = '1',data.documento,data.nit),
               IF( cli.persontype = '1','NA',data.digitochequeo),
               IF(t1.fecha_creacion IS NULL, '2013-06-05', DATE(t1.fecha_creacion)),
               data.fechasolicitud,
               data.fecharadicado,
               formu.date_created,
               data.fecharadicado,
               /*IF(param_actividadecono.description = '','NA',param_actividadecono.description),*/
               IF(cli.persontype = '2','NA',param_actividadecono.description),
               IF(data.actividadeconomicappal = '0','NA',param_actividad.description),
               IF( cli.persontype = '1', 'NA', data.detalleactividadeconomicappal),
               IF( cli.persontype = '1','NA',param_tipoempresa.description),
               IF( cli.persontype = '1',param_profesion.description,'NA'),
               IF( cli.persontype = '1',param_ocupacion.description,'NA'),
               IF( cli.persontype = '1',data.numerohijos,'NA'),
               IF( cli.persontype = '1',data.sexo,'NA'),
               IF( cli.persontype = '1',data.estrato,'NA'),
               IF( cli.persontype = '1',param_estadocivil.description,'NA'),
               IF( cli.persontype = '1',param_estudio.description,'NA'),
               IF( cli.persontype = '1',data.cargo,'NA'),
               IF( cli.persontype = '1',param_tipoactividad.description,'NA'),/*tipoactividad*/
               IF( cli.persontype = '1',data.fechanacimiento,'NA'),
               IF( cli.persontype = '1',lugar_nac.description,'NA'),
               IF( cli.persontype = '--','NA',data.fechaexpedicion),
               IF( cli.persontype = '1',lugar_exp.description,'NA'),
               IF( cli.persontype = '1',param_pais.description, 'NA'),
               IF( cli.persontype = '1',lugar_resi.description,lugar_emp.description),
               IF( cli.persontype = '1',data.direccionresidencia,data.direccionoficinappal),
               data.nomenclatura,
               IF( data.telefonoresidencia = '', '0',data.telefonoresidencia),
               IF( cli.persontype = '1',data.telefonolaboral, data.telefonoficina),
               data.celular,
               IF( cli.persontype = '2',data.faxoficina,'NA'),
               CONCAT('observaciones',''),
               IF(data.correoelectronico='','SD',data.correoelectronico),
               IF( cli.persontype = '1',data.nombreempresa,'NA'),
               IF(data.ciiu = 0, 'SD', param_ciiu.codigo),
               IF( cli.persontype = '1','NA',lugar_oficina.description),
               IF( cli.persontype = '1','NA',param_tipoempresa.description),
               IF( cli.persontype = '1',param_tipovivienda.description,'NA'),
               IF( cli.persontype = '1',param_estadocivil.description, 'NA'),
               IF( cli.persontype = '1',param_ingresosmensuales.value,param_ingresosmensuales_emp.value),
               IF( cli.persontype = '1',param_egresosmensuales.value,param_egresosmensuales_emp.value),
               IF( cli.persontype = '1',param_otrosingresos.value,'NA'),
               IF(cli.persontype = '1',data.conceptosotrosingresos,'NA'),
               IF(cli.persontype = '1',data.totalactivos, data.activosemp),
               IF(cli.persontype = '1',data.totalpasivos, data.pasivosemp),
               data.monedaextranjera,
               IF(cli.persontype = '1','NA',param_tipotransacciones.description),
               data.huella,
               data.firma,
               CONCAT('SI',''),
               data.lugarentrevista,
               data.fechaentrevista,
               CONCAT(data.horaentrevista,' ',data.tipohoraentrevista),
               data.resultadoentrevista,
               data.nombreintermediario,
               user.name,
               CONCAT(data.primerapellido,' ',data.segundoapellido,' ',data.nombres),
               param_tipodocumento.description,
               data.documento,
               data.detalleocupacion,
               t2.fecha_envio,
               t2.fecha_recibido,
               data.detalletipoactividad,
               data.celularoficina,
               cli.id, 
               IF(data.socio1 = '', '0', data.socio1) AS socio1, 
               IF(data.socio2 = '', '0', data.socio2) AS socio2, 
               IF(data.socio3 = '', '0', data.socio3) AS socio3,
               t5.description AS formulario,
               data.sucursal AS centro_costo
          FROM client cli 
         INNER JOIN form formu ON formu.id_client = cli.id 
         INNER JOIN data ON formu.id = data.id_form
         INNER JOIN (SELECT MAX(id) AS id FROM data GROUP BY id_form) AS mx ON data.id = mx.id
          LEFT JOIN  param_sucursales sucursal ON sucursal.id = data.sucursal
          LEFT JOIN param_area ON param_area.id = data.area  
          LEFT JOIN param_formulario AS t5 ON(t5.id = data.formulario)
          LEFT JOIN  param_clasecliente ON  param_clasecliente.id = data.clasecliente 
          LEFT JOIN param_tipodocumento ON param_tipodocumento.id = data.tipodocumento 
          LEFT JOIN param_ciudad lugar_exp ON lugar_exp.id = data.lugarexpedicion 
          LEFT JOIN param_ciudad lugar_nac ON lugar_nac.id = data.lugarnacimiento
          LEFT JOIN param_pais ON param_pais.id = data.nacionalidad
          LEFT JOIN param_estadocivil ON param_estadocivil.id = data.estadocivil
          LEFT JOIN param_ciudad lugar_resi ON lugar_resi.id = data.ciudadresidencia
          LEFT JOIN param_ciudad lugar_emp ON lugar_emp.id = data.ciudadoficina
          LEFT JOIN param_actividadecono ON param_actividadecono.id = data.actividadeconomicaempresa
          LEFT JOIN param_profesion ON param_profesion.id = data.profesion
          LEFT JOIN param_ocupacion ON param_ocupacion.id = data.ocupacion
          LEFT JOIN param_ciiu ON param_ciiu.codigo = data.ciiu 
          LEFT JOIN param_ingresosmensuales ON param_ingresosmensuales.id = data.ingresosmensuales
          LEFT JOIN param_otrosingresos ON param_otrosingresos.id = data.otrosingresos 
          LEFT JOIN param_egresosmensuales ON param_egresosmensuales.id = data.egresosmensuales 
          LEFT JOIN param_tipoactividad ON param_tipoactividad.id = data.tipoactividad
          LEFT JOIN param_estudio ON param_estudio.id = data.nivelestudios
          LEFT JOIN param_tipovivienda ON param_tipovivienda.id = data.tipovivienda
          LEFT JOIN param_ciudad lugar_oficina ON lugar_oficina.id = data.ciudadoficina
          LEFT JOIN param_ciudad lugar_sucursal ON lugar_sucursal.id = data.ciudadsucursal
          LEFT JOIN param_actividad ON param_actividad.id = data.actividadeconomicappal
          LEFT JOIN param_tipoempresa ON param_tipoempresa.id = data.tipoempresaemp
          LEFT JOIN param_ingresosmensuales_emp ON param_ingresosmensuales_emp.id = data.ingresosmensualesemp
          LEFT JOIN param_egresosmensuales_emp ON param_egresosmensuales_emp.id = data.egresosmensualesemp
          LEFT JOIN param_tipotransacciones ON param_tipotransacciones.id = data.tipotransacciones
         INNER JOIN user ON user.id = formu.id_user   
          LEFT OUTER JOIN radicados AS t2 ON(formu.log_lote = t2.id)
          LEFT OUTER JOIN radicados_items AS t1 ON(cli.document = t1.documento AND formu.log_lote = t1.id_radicados)
          $complemento";
$client = new Client();
$ultimoestado = "";

/* bgcolor="#EB8F00" */
$result = mysqli_query($GLOBALS['link'], $sql);
if ($_SESSION['id'] == 1 || $_SESSION['id'] == 23 || $_SESSION['id'] == 2090 || $_SESSION['id'] == 2995 || $_SESSION['id'] == 3129) {
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Description: File Transfer");
    header("Content-Encoding: UTF-8");
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=reportCallSpecial" . date('his') . ".csv");
    header("Expires: 0");
    header("Pragma: public");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $fh = fopen('php://output', 'w');
    //fputcsv($fh, array('ID', 'NOMBRE_COMPLETO', 'NOMBRE', 'DOCUMENTO', 'TIPO_PERSONA'), ';');
    fputcsv($fh, ['Tipo de persona', 'Sucursal', 'Area', 'Funcionario', 'Planilla', 'Lote Colpatria', /*'Marca',*/ 'Tipo Formulario', 'Tipo de Cliente',
        'Tipo Identificación', 'Nombre y/o Razón Social', 'Documento', 'Nro. ID', 'Digito de Chequeo', 'Fecha de Radicacion Colpatria',
        'Fecha Envio Real Colpatria', 'Fecha de Aprobacion', 'Fecha Solicitud FCC', 'Fecha de Digitacion F',
        'Tipo de Actividad Persona Juridica', 'Detalle Actividad Economica', 'Tipo de Empresa Jurídica', 'Profesion', 'Ocupacion',
        'Detalle Ocupacion', 'No de hijos', 'Genero', 'Estrato', 'Estado Civil', 'Nivel Estudios', 'Cargo',
        'Tipo de Actividad Persona Natural', 'Detalle Tipo de Actividad Persona Natural', 'Fecha Nacimiento',
        'Lugar Nacimiento', 'Fecha Expedicion', 'Lugar Expedicion', 'Nacionalidad', 'Ciudad Residencia',
        'Direccion residencia y/o persona jurídica', 'Nomenclatura', 'Telefono Residencia y/o PJ', 'Telefono Laboral',
        'Celular', 'Celular Oficina', 'Fax', 'Correo electronico', 'Empresa donde labora', 'Ciiu', 'Ciudad Laboral',
        'Tipo Empresa Juridica', 'Tipo Vivienda', 'Ingresos Mensuales', 'Egresos mensuales', 'Otros ingresos',
        'Concepto Otros Ingresos', 'Activos', 'Pasivos', 'Transacciones en Moneda Extranjera', 'Tipo de Transacciones',
        'Nombre Representante Legal', 'Tipo de Documento Representante Legal', 'Documento Representante Legal', 'Socio 1', 'Socio 2', 'Socio 3',
        'Huella Verificada con documento de identificación', 'Firma', 'Entrevista', 'Lugar Entrevista', 'Fecha Entrevista',
        'Hora de Entrevista', 'Resultado Entrevista', 'Intermediario Entrevista', 'Usuario', 'Estado', 'Centro de costo'], ';');
    while ($registro = mysqli_fetch_array($result, MYSQLI_NUM)) {

        if (is_null($registro[72]) || empty($registro[72]) || $registro[72] == '0000-00-00') {
            $registro72 = "2013-06-12";
        } else {
            $registro72 = $registro[72];
        }
        if (is_null($registro[73]) || empty($registro[73]) || $registro[73] == '0000-00-00') {
            $registro73 = "2013-06-12";
        } else {
            $registro73 = $registro[73];
        }
        if ($registro[16] == "") {
            $registro16 = "SD";
        } else {
            $registro16 = $registro[16];
        }
        if ($registro[20] == "") {
            $registro20 = "NA";
        } else {
            $registro20 = $registro[20];
        }
        if ($registro[71] == "") {
            $registro71 = "NA";
        } else {
            $registro71 = $registro[71];
        }
        if ($registro[74] == "") {
            $registro74 = "NA";
        } else {
            $registro74 = $registro[74];
        }
        if ($registro[36] == "") {
            $registro36 = "NA";
        } else {
            $registro36 = $registro[36];
        }
        if ($registro[38] == "") {
            $registro38 = "NA";
        } else {
            $registro38 = $registro[38];
        }
        if ($registro[0] == 'NATURAL') {
            $registro68 = "NA";
        } else {
            $registro68 = $registro[68];
        }
        if ($registro[0] == 'NATURAL') {
            $registro69 = "NA";
        } else {
            $registro69 = $registro[69];
        }
        if ($registro[0] == 'NATURAL') {
            $registro70 = "NA";
        } else {
            $registro70 = $registro[70];
        }

        $ultimoestado = $client->getEstadoInformacion($registro[76]);
        fputcsv($fh, [$registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], /*$registro[6],*/ $registro[80],
            $registro[7], $registro[8], ($registro[9]), $registro[10], $registro[11], $registro[12], $registro[13], $registro72,
            $registro73, $registro[14], $registro16, $registro[19], $registro20, $registro[21], $registro[22], $registro[23], $registro71,
            $registro[24], $registro[25], $registro[26], $registro[27], $registro[28], $registro[29], $registro[30], $registro74,
            $registro[31], $registro[32], $registro[33], $registro[34], $registro[35], $registro36, $registro[37], $registro38,
            $registro[39], $registro[40], $registro[41], $registro[75], $registro[42], $registro[44], $registro[45], $registro[46],
            $registro[47], $registro[48], $registro[49], $registro[51], $registro[52], $registro[53], $registro[54], $registro[55],
            $registro[56], $registro[57], $registro[58], $registro68, $registro69, $registro70, $registro[77], $registro[78], $registro[79], $registro[59], $registro[60],
            $registro[61], $registro[62], $registro[63], $registro[64], $registro[65], $registro[66], $registro[67], $ultimoestado, $registro[81]], ';');
    }
    fclose($fh);
    exit;
} else {
?>
    <table>
        <tr>
            <td height="20" style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo de persona</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Sucursal</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Area</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Funcionario</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Planilla</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Lote Colpatria</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Marca</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo Formulario</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo de Cliente</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo Identificaci&oacute;n</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Nombre y/o Raz&oacute;n Social</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Documento</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Nro. ID</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Digito de Chequeo</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha de Radicacion Colpatria</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha Envio Real Colpatria</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha de Aprobacion</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha Solicitud FCC</td>
            <!--<td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha  de Envio Colpatria</td>-->
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha de Digitacion F</td>
            <!--<td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha  de Envio Colpatria</td>-->
            <!--<td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo de Empresa Persona Natural</td>-->
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo de Actividad Persona Juridica</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Detalle Actividad Economica</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo de Empresa Jur&iacute;dica</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Profesion</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Ocupacion</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Detalle Ocupacion</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">No de hijos</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Genero</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Estrato</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Estado Civil</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Nivel Estudios</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Cargo</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo de Actividad Persona Natural</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Detalle Tipo de Actividad Persona Natural</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha Nacimiento</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Lugar Nacimiento</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha Expedicion</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Lugar Expedicion</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Nacionalidad</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Ciudad Residencia</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Direccion residencia y/o persona jur&iacute;dica</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Nomenclatura</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Telefono Residencia y/o PJ</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Telefono Laboral</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Celular</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Celular Oficina</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fax</td>
            <!--<td>Observaciones Telefonos</td>-->
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Correo electronico</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Empresa donde labora</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Ciiu</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Ciudad Laboral</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo Empresa Juridica</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo Vivienda</td>
            <!--<td>Estado Civil</td>-->
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Ingresos Mensuales</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Egresos mensuales</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Otros ingresos</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Concepto Otros Ingresos</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Activos</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Pasivos</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Transacciones en Moneda Extranjera</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo de Transacciones</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Nombre Representante Legal</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Tipo de Documento Representante Legal</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Socio 1</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Socio 2</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Socio 3</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Documento Representante Legal</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Huella Verificada con documento de identificaci&oacute;n</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Firma</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Entrevista</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Lugar Entrevista</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Fecha Entrevista</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Hora de Entrevista</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Resultado Entrevista</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Intermediario Entrevista</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Usuario</td>
            <td style="border:dotted; border-width:1px; color: #FFF;" bgcolor="#EB8F00">Estado</td>
        </tr>
<?php
    while ($registro = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $ultimoestado = $client->getEstadoInformacion($registro[76]);
?>
        <tr>
            <td style="border:dotted; border-width:1px;"><?=$registro[0]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[1]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[2]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[3]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[4]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[5]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[6]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[80]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[7]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[8]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[9]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[10]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[11]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[12]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[13]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[72] == '0000-00-00' ? '2013-06-12' : $registro[72];?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[73] == '0000-00-00' ? '2013-06-12' : $registro[73];?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[14]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[16] == "" ? "SD" : $registro[16];?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[19]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[20] == "" ? "NA" : $registro[20];?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[21]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[22]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[23]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[71] == "" ? "NA" : $registro[71];?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[24]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[25]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[26]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[27]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[28]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[29]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[30]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[74] == "" ? "NA" : $registro[74];?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[31]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[32]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[33]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[34]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[35]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[36]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[37]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[38]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[39]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[40]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[41]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[75]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[42]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[44]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[45]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[46]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[47]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[48]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[49]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[51]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[52]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[53]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[54]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[55]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[56]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[57]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[58]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[0] == 'NATURAL' ? "NA" : $registro[68];?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[0] == 'NATURAL' ? "NA" : $registro[69];?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[77]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[78]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[79]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[0] == 'NATURAL' ? "NA" : $registro[70];?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[59]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[60]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[61]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[62]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[63]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[64]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[65]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[66]?></td>
            <td style="border:dotted; border-width:1px;"><?=$registro[67]?></td>
            <td style="border:dotted; border-width:1px;"><?=$ultimoestado; ?></td>
        </tr>
<?php
    }
?>
    </table>
<?php
}
