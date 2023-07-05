<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'client.class.php';
require_once PATH_CCLASS . DS . 'form.class.php';
require_once PATH_CCLASS . DS . 'image.class.php';
require_once PATH_CCLASS . DS . 'log.class.php';
extract($_POST);


if ($type == "1") {

    /*$fechasolicitud = $fechasolicitud_a . "-" . $fechasolicitud_m . "-" . $fechasolicitud_d;
    $fechaexpedicion = $fechaexpedicion_a . "-" . $fechaexpedicion_m . "-" . $fechaexpedicion_d;
    $fechanacimiento = $fechanacimiento_a . "-" . $fechanacimiento_m . "-" . $fechanacimiento_d;
    $fechaentrevista = $fechaentrevista_a."-".$fechaentrevista_m."-".$fechaentrevista_d;
    
    $fecharadicado = $fecharadicado_a . "-" . $fecharadicado_m . "-" . $fecharadicado_d;*/


    $fechasolicitud = '0000-00-00';
    $fechaexpedicion = '0000-00-00';
    $fechanacimiento = '0000-00-00';
    $fechaentrevista = '0000-00-00';
    $fecharadicado = '0000-00-00';

    $fechasolicitud = $fechasolicitud_a . "-" . $fechasolicitud_m . "-" . $fechasolicitud_d;
    $fechaexpedicion = $fechaexpedicion_a . "-" . $fechaexpedicion_m . "-" . $fechaexpedicion_d;

    if(isset($fechanacimiento_a) && isset($fechanacimiento_m) && isset($fechanacimiento_d))
        $fechanacimiento = $fechanacimiento_a . "-" . $fechanacimiento_m . "-" . $fechanacimiento_d;

    $fechaentrevista = $fechaentrevista_a."-".$fechaentrevista_m."-".$fechaentrevista_d;
    $fecharadicado = $fecharadicado_a . "-" . $fecharadicado_m . "-" . $fecharadicado_d;

    if ((!empty($documento) || !empty($nit) ) && !empty($tipopersona)) {
        /*$cliente = new Client();
        if (!empty($nit) && $tipopersona == "2")
            $id_cliente = $cliente->getId($nit, $tipopersona);
        if (!empty($documento) && $tipopersona == "1")
            $id_cliente = $cliente->getId($documento, $tipopersona);

        $id_cliente = mysqli_fetch_array($id_cliente);*/
        $cliente = new Client();
        if (!empty($nit) && $tipopersona == "2")
            $id_cliente = $cliente->getId($nit, $tipopersona);
        if (!empty($documento) && $tipopersona == "1")
            $id_cliente = $cliente->getId($documento, $tipopersona);
        if (!empty($tipoactividad) && $tipoactividad != "8") {
            $detalletipoactividad = "";
        }
        if(!isset($telefonoresidencia))$telefonoresidencia = 0;
        elseif(trim($telefonoresidencia) == '')$telefonoresidencia = 0;

        if(!isset($telefonolaboral))$telefonolaboral = 0;
        elseif(trim($telefonolaboral) == '')$telefonolaboral = 0;

        if(!isset($telefonoficina))$telefonoficina = 0;
        elseif(trim($telefonoficina) == '')$telefonoficina = 0;

        if(!isset($telefonosucursal))$telefonosucursal = 0;
        elseif(trim($telefonosucursal) == '')$telefonosucursal = 0;

        if(!isset($faxoficina))$faxoficina = 0;
        elseif(trim($faxoficina) == '')$faxoficina = 0;

        if(!isset($celularoficina))$celularoficina = 0;
        elseif(trim($celularoficina) == '')$celularoficina = 0;

        if(!isset($faxsucursal))$faxsucursal = 0;
        elseif(trim($faxsucursal) == '')$faxsucursal = 0;

        if(!isset($celular))$celular = 0;
        elseif(trim($celular) == '')$celular = 0;

        $id_cliente = mysqli_fetch_array($cliente->get($id_client));
        if ($id_cliente['id'] > 0) {
            if($cliente->updatePersonType($id_cliente['id'], $tipopersona)){
                $form = new Form();
                if ($form->add($id_cliente['id'],'FORMULARIO_MIGRACION', $lote,$planilla1,$_SESSION['id'], $num_images,'MIGRACION') == 0) {
                    $lastForm = $form->getLastId($id_cliente['id']);
                    $lastForm = mysqli_fetch_array($lastForm);
                    //Insertar información principal
                    if (@$form->insertPrimaryData(
                               $lastForm['id'], $fechasolicitud, $sucursal, $clasecliente,  $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo,  $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ocupacion, $detalleocupacion,$ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $detalletipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $celularoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $monedaextranjera, $tipotransacciones,$nacionalidad,$area,$lote,$formulario,$digitochequeo,$id_official,$socio1,$socio2,$socio3,$fecharadicado,$detalleactividadeconomicappal,$firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario
                        ) == 0) {
                        /*$form->insertPrimaryData(
                                   $lastForm['id'], $fechasolicitud, $sucursal, $clasecliente,  $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo,  $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ocupacion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $monedaextranjera, $tipotransacciones,$nacionalidad,$area,$lote,$formulario,$digitochequeo,$id_official,$socio1,$socio2,$socio3,$fecharadicado,$detalleactividadeconomicappal,$firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario
                            )*/

                        $image = new Image();
                        $filename = mysqli_fetch_array($image->getNameMG($id_imagen_tmp));
                        if ($image->saveMG($filename['filename'], $lastForm['id'], $type, $_SESSION['id'], $document_client) == 0) {
                            if ($image->changeStatusImgTempMG($id_cliente['id'], 2) == 0) {//Imagen desactivada correcstameante
                                $log = new Log();
                                if ($log->addIndexacion($lastForm['id'], $_SESSION['id']) == 0) //FIX USER
                                    header("Location: fingering_migracion.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
                            } else {
                                echo "<h1>No se pudo desactivar la imagen</h1>";
                            }
                        }
                    } else {
                        echo "<h1>Error insertando formulario 6 </h1>";
                    }
                } else {
                    echo "<h1>Error creando formulario.</h1>";
                }
            }else{
                 echo "<h1>Error actualizando tipo de persona.</h1>";
            }
        } else {

            if (!empty($nit) && $tipopersona == "2") {
                $documento_crear = $nit;
                $nombre_crear = $razonsocial;
                $result_crear = $cliente->add($documento_crear, $tipopersona, $nombre_crear, "");
            }
            if (!empty($documento) && $tipopersona == "1") {
                $documento_crear = $documento;
                $nombre_crear = $primerapellido . " " . $segundoapellido . " " . $nombres;
                $result_crear = $cliente->add($documento_crear, $tipopersona, $nombre_crear, "");
            }


            //Creación del cliente ya que no existe en la base de datos
            if ($result_crear == 0) {
                $id_cliente = $cliente->getId($documento_crear, $tipopersona);
                $id_cliente = mysqli_fetch_array($id_cliente);
                $form = new Form();
                if ($form->add($id_cliente['id'],'FORMULARIO', $lote,$planilla1,$_SESSION['id'],$num_images,$marca) == 0) {
                    $lastForm = $form->getLastId($id_cliente['id']);
                    $lastForm = mysqli_fetch_array($lastForm);
                    //Insertar información principal
                    if (@$form->insertPrimaryData(
                               $lastForm['id'], $fechasolicitud, $sucursal, $clasecliente,  $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo,  $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ocupacion, $detalleocupacion,$ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $detalletipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $celularoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $monedaextranjera, $tipotransacciones,$nacionalidad,$area,$lote,$formulario,$digitochequeo,$id_official,$socio1,$socio2,$socio3,$fecharadicado,$detalleactividadeconomicappal,$firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario
                        ) == 0) {
                        /*$form->insertPrimaryData(
                                    $lastForm['id'], $fechasolicitud, $sucursal,  $clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo,  $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa,  $profesion, $ocupacion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $monedaextranjera, $tipotransacciones,$nacionalidad,$area,$lote,$formulario,$digitochequeo,$id_official,$socio1,$socio2,$socio3,$fecharadicado,$detalleactividadeconomicappal,$firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario
                            )*/
                        $image = new Image();
                        //Copiar imagen a otra carpeta
                        $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
                        if ($image->save($filename['filename'], $lastForm['id'], $type, $_SESSION['id']) == 0) {
                            if ($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0) {
                                $log = new Log();
                                if ($log->addIndexacion($lastForm['id'], $_SESSION['id']) == 0) //FIX USER
                                    header("Location: fingering.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
                            } else {
                                echo "<h1>No se pudo desactivar la imagen</h1>";
                            }
                        }
                    } else {
                        echo "<h1>Error insertando formulario 12 </h1>";
                    }
                } else {
                    echo "<h1>Error creando formulario.</h1>";
                }
            } else {
                echo "<h1>Cliente creado sin éxito.</h1>";
            }
        }
    } else {
        echo "<h1>Por favor diligencie todos los campos.</h1>";
    }
} else if ($type == "2") {
    $fechaentrevista = $fechaentrevista_a."-".$fechaentrevista_m."-".$fechaentrevista_d;
    if (!empty($id_form)) {
        $form = new Form();
        if ($form->insertSecondData($id_form,  $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario
                ) == 0) {
            $image = new Image();
            $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
            if ($image->save($filename['filename'], $id_form, $type,$_SESSION['id']) == 0) {
                if ($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0) {
                    $log = new Log();
                    if ($log->addIndexacion($id_form, $_SESSION['id']) == 0) //FIX USER
                        header("Location: fingering.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
                }
            }
        } else {
            echo "<br><h1>Error actualizando información de formulario</h1>";
        }
    } else {
        echo "<h1>Ocurrio un problema con la indexación de la imagen 2<h1>";
    }
} else if ($type == "3") {
    if (!empty($id_form)) {
        $form = new Form();
        $image = new Image();
        $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
        if ($image->save($filename['filename'], $id_form, $type, $_SESSION['id']) == 0) {
            if ($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0) {
                $log = new Log();
                if ($log->addIndexacion($id_form, $_SESSION['id']) == 0) //FIX USER
                    header("Location: fingering.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
            }
        }
    }
}