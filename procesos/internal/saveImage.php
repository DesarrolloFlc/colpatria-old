<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'client.class.php';
require_once PATH_CCLASS . DS . 'form.class.php';
require_once PATH_CCLASS . DS . 'image.class.php';
require_once PATH_CCLASS . DS . 'log.class.php';
require_once PATH_CCLASS . DS . 'workflow.class.php';
require_once PATH_CCLASS . DS . 'alert.class.php';
extract($_POST);

if (!isset($type) || trim($type) == '') $type = 1;

$cambioact = false;
if($type == "1"){

    $fechasolicitud = '0000-00-00';
    $fechaexpedicion = '0000-00-00';
    $fechanacimiento = '0000-00-00';
    $fechaentrevista = '0000-00-00';
    $fecharadicado = '0000-00-00';

    if((isset($fechasolicitud_a) && !empty($fechasolicitud_a) && $fechasolicitud_a != '0000') && (isset($fechasolicitud_m) && !empty($fechasolicitud_m) && $fechasolicitud_m != '00') && (isset($fechasolicitud_d) && !empty($fechasolicitud_d) && $fechasolicitud_d != '00')){
        $fechasolicitud = $fechasolicitud_a."-".$fechasolicitud_m."-".$fechasolicitud_d;
        if($fechasolicitud != date('Y-m-d', strtotime($fechasolicitud))){
            echo "<script>alert('La fecha de solicitud debe ser una fecha valida.');</script>";
            exit();
        }
    }else{
        echo "<script>alert('La fecha de solicitud no puede ser vacia.');</script>";
        exit();
    }

    if((isset($fechaexpedicion_a) && !empty($fechaexpedicion_a) && $fechaexpedicion_a != '0000') && (isset($fechaexpedicion_m) && !empty($fechaexpedicion_m) && $fechaexpedicion_m != '00') && (isset($fechaexpedicion_d) && !empty($fechaexpedicion_d) && $fechaexpedicion_d != '00')){
        $fechaexpedicion = $fechaexpedicion_a."-".$fechaexpedicion_m."-".$fechaexpedicion_d;
        if($fechaexpedicion != date('Y-m-d', strtotime($fechaexpedicion))){
            echo "<script>alert('La fecha de expedicion debe ser una fecha valida.');</script>";
            exit();
        }
    }else{
        echo "<script>alert('La fecha de expedicion no puede ser vacia.');</script>";
        exit();
    }
    if($tipopersona == "1"){
        if((isset($fechanacimiento_a) && !empty($fechanacimiento_a) && $fechanacimiento_a != '0000') && (isset($fechanacimiento_m) && !empty($fechanacimiento_m) && $fechanacimiento_m != '00') && (isset($fechanacimiento_d) && !empty($fechanacimiento_d) && $fechanacimiento_d != '00')){
            $fechanacimiento = $fechanacimiento_a."-".$fechanacimiento_m."-".$fechanacimiento_d;
            if($fechanacimiento != date('Y-m-d', strtotime($fechanacimiento))){
                echo "<script>alert('La fecha de nacimiento debe ser una fecha valida.');</script>";
                exit();
            }
        }else{
            echo "<script>alert('La fecha de nacimiento no puede ser vacia.');</script>";
            exit();
        }
    }

    /*if((isset() && !empty()) && (isset() && !empty()) && (isset() && !empty()))
    else{
        echo "<script>alert('La fecha de nacimiento no puede ser vacia.');</script>";
        exit();
    }
    if((isset() && !empty()) && (isset() && !empty()) && (isset() && !empty()))
    else{
        echo "<script>alert('La fecha de nacimiento no puede ser vacia.');</script>";
        exit();
    }*/
    $fechaentrevista = $fechaentrevista_a . "-" . $fechaentrevista_m . "-" . $fechaentrevista_d;

    $fecharadicado = $fecharadicado_a . "-" . $fecharadicado_m . "-" . $fecharadicado_d;

    if((!empty($documento) || !empty($nit) ) && !empty($tipopersona)){
        $cliente = new Client();
        if(!empty($nit) && $tipopersona == "2")
            $id_cliente = $cliente->getId($nit, $tipopersona);

        if(!empty($documento) && $tipopersona == "1")
            $id_cliente = $cliente->getId($documento, $tipopersona);

        if(!empty($tipoactividad) && $tipoactividad != "8")
            $detalletipoactividad = "";

        if(!isset($telefonoresidencia))
            $telefonoresidencia = 0;
        elseif(trim($telefonoresidencia) == '')
            $telefonoresidencia = 0;

        if(!isset($telefonolaboral))
            $telefonolaboral = 0;
        elseif(trim($telefonolaboral) == '')
            $telefonolaboral = 0;

        if(!isset($telefonoficina))
            $telefonoficina = 0;
        elseif(trim($telefonoficina) == '')
            $telefonoficina = 0;

        if(!isset($telefonosucursal))
            $telefonosucursal = 0;
        elseif(trim($telefonosucursal) == '')
            $telefonosucursal = 0;

        if(!isset($faxoficina))
            $faxoficina = 0;
        elseif(trim($faxoficina) == '')
            $faxoficina = 0;

        if(!isset($celularoficina))
            $celularoficina = 0;
        elseif(trim($celularoficina) == '')
            $celularoficina = 0;

        if(!isset($faxsucursal))
            $faxsucursal = 0;
        elseif(trim($faxsucursal) == '')
            $faxsucursal = 0;

        if(!isset($celular))
            $celular = 0;
        elseif(trim($celular) == '')
            $celular = 0;

        //SKRV
        if(!isset($telefonoresidencia))
            $telefonoresidencia = "";

        if(!isset($telefonolaboral))
            $telefonolaboral = "";

        if(!isset($telefonoficina))
            $telefonoficina = "";

        if(!isset($telefonosucursal))
            $telefonosucursal = "";

        if(!isset($direccionresidencia))
            $direccionresidencia = "";

        if(!isset($direccionoficinappal))
            $direccionoficinappal = "";

        if(!isset($direccionempresa))
            $direccionempresa = "";

        if(!isset($direccionsucursal))
            $direccionsucursal = "";

        if(!isset($razonsocial))
            $razonsocial = "";

        if(!isset($nombres))
            $nombres = "";

        if(!isset($primerapellido))
            $primerapellido = "";

        if(!isset($segundoapellido))
            $segundoapellido = "";

        if(!isset($socio1))
            $socio1 = '0';

        if(!isset($socio2))
            $socio2 = '0';

        if(!isset($socio3))
            $socio3 = '0';
        //SKRV

        $fsdgsdrfgsdrg = array("direccion_residencia" => $direccionresidencia, "direccion_oficina" => $direccionoficinappal, "direccion_empresa" => $direccionempresa, "direccion_sucursal" => $direccionsucursal);

        $id_cliente = mysqli_fetch_array($id_cliente);
        if($id_cliente['id'] > 0){
            $cliente->activeCliente($id_cliente['id']);
            $form = new Form();
            //Sinthia Rodriguez Alertas inicio
            $lastForm = mysqli_fetch_array($form->getLastId($id_cliente['id']));
            $lastData = mysqli_fetch_array($form->getFormInfo($lastForm['id']));

            if($lastData['tipoactividad'] != $tipoactividad)
                $cambioact = true;

            if($fechaexpedicion === '--'){
                echo "<script>alert('La fecha de expedicion no puede ser -- 1.');</script>";
                exit();
                echo json_encode($_POST);
            }
            //Sinthia Rodriguez Alertas fin
            if($form->add($id_cliente['id'], 'FORMULARIO', $lote, $planilla1, $_SESSION['id'], 1, $marca) == 0){//$num_images,$marca) == 0){
                $lastForm = $form->getLastId($id_cliente['id']);
                $lastForm = mysqli_fetch_array($lastForm);
                //Insertar información principal
                if($form->insertPrimaryData($lastForm['id'], $fechasolicitud, $sucursal, $clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo, $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ocupacion, $detalleocupacion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $detalletipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $celularoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $monedaextranjera, $tipotransacciones, $nacionalidad, $area, $lote, $formulario, $digitochequeo, $id_official, $socio1, $socio2, $socio3, $fecharadicado, $detalleactividadeconomicappal, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario, $id_cliente['id']) == 0){
                    //EmailAlert::generateFormAlerts($lastForm['id']);
                    $image = new Image();
                    $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
                    if($image->save($filename['filename'], $lastForm['id'], $type, $_SESSION['id']) == 0){
                        if($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0){//Imagen desactivada correcstameante
                            //Se verifica si tiene devolucion y se cambia el estado en caso de que si tenga devolucion
                            if($tipopersona == '1')
                                $documentVerf = $documento;
                            else
                                $documentVerf = $nit;

                            if(Workflow::verificarCliente($documentVerf, $tipopersona))
                                Workflow::cambiarEstado($documentVerf, $tipopersona);

                            Image::guardarPlanillaLote($planilla_lote, $lote, $_SESSION['id']);

                            $log = new Log();
                            if($log->addIndexacion($lastForm['id'], $_SESSION['id']) == 0)//FIX USER
                                header("Location: fingering.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
                        }else
                            echo "<h1>No se pudo desactivar la imagen</h1>";
                    }
                }else
                    echo "<h1>Error insertando formulario 6 </h1>";
            }else
                echo "<h1>Error creando formulario1.</h1>";
        }else{
            if(!empty($nit) && $tipopersona == "2"){
                $documento_crear = $nit;
                $nombre_crear = $razonsocial;
                $result_crear = $cliente->add($documento_crear, $tipopersona, $nombre_crear, "");
            }
            if(!empty($documento) && $tipopersona == "1"){
                $documento_crear = $documento;
                $nombre_crear = $primerapellido . " " . $segundoapellido . " " . $nombres;
                $result_crear = $cliente->add($documento_crear, $tipopersona, $nombre_crear, "");
            }


            //Creación del cliente ya que no existe en la base de datos
            if($result_crear == 0){
                $id_cliente = $cliente->getId($documento_crear, $tipopersona);
                $id_cliente = mysqli_fetch_array($id_cliente);
                $form = new Form();
                if($fechaexpedicion === '--'){
                    echo "<script>alert('La fecha de expedicion no puede ser -- 2.');</script>";
                    exit();
                    echo json_encode($_POST);
                }
                if($form->add($id_cliente['id'], 'FORMULARIO', $lote, $planilla1, $_SESSION['id'], $num_images, $marca) == 0){
                    $lastForm = $form->getLastId($id_cliente['id']);
                    $lastForm = mysqli_fetch_array($lastForm);
                    //Insertar información principal
                    if($form->insertPrimaryData($lastForm['id'], $fechasolicitud, $sucursal, $clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo, $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ocupacion, $detalleocupacion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $detalletipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $celularoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $monedaextranjera, $tipotransacciones, $nacionalidad, $area, $lote, $formulario, $digitochequeo, $id_official, $socio1, $socio2, $socio3, $fecharadicado, $detalleactividadeconomicappal, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario, $id_cliente['id']) == 0){
                        $image = new Image();
                        //Copiar imagen a otra carpeta
                        $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
                        if($image->save($filename['filename'], $lastForm['id'], $type, $_SESSION['id']) == 0){
                            if($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0){
                                //Se verifica si tiene devolucion y se cambia el estado en caso de que si tenga devolucion
                                if($tipopersona == '1')
                                    $documentVerf = $documento;
                                else
                                    $documentVerf = $nit;

                                if(Workflow::verificarCliente($documentVerf, $tipopersona))
                                    Workflow::cambiarEstado($documentVerf, $tipopersona);

                                $log = new Log();
                                if($log->addIndexacion($lastForm['id'], $_SESSION['id']) == 0)//FIX USER
                                    header("Location: fingering.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
                            }else
                                echo "<h1>No se pudo desactivar la imagen</h1>";
                        }
                    }else
                        echo "<h1>Error insertando formulario 12 </h1>";
                }else
                    echo "<h1>Error creando formulario2.</h1>";
            }else
                echo "<h1>Cliente creado sin éxito... RESULTADO_CREAR: ".$result_crear."</h1>";
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

}elseif($type == "2"){
    $fechaentrevista = $fechaentrevista_a . "-" . $fechaentrevista_m . "-" . $fechaentrevista_d;
    if(!empty($id_form)){
        $form = new Form();
        if($form->insertSecondData($id_form, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario) == 0){
            $image = new Image();
            $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
            if($image->save($filename['filename'], $id_form, $type, $_SESSION['id']) == 0){
                if($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0){
                    $log = new Log();
                    if($log->addIndexacion($id_form, $_SESSION['id']) == 0)//FIX USER
                        header("Location: fingering.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
                }
            }
        }else
            echo "<br><h1>Error actualizando información de formulario</h1>";
    }else
        echo "<h1>Ocurrio un problema con la indexación de la imagen 2</h1>";
}elseif($type == "3"){
    if(!empty($id_form)){
        $form = new Form();
        $image = new Image();
        $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
        if($image->save($filename['filename'], $id_form, $type, $_SESSION['id']) == 0){
            if($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0){
                $log = new Log();
                if($log->addIndexacion($id_form, $_SESSION['id']) == 0)//FIX USER
                    header("Location: fingering.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
            }
        }
    }
}elseif($type == "4"){
    $cliente = new Client();
    $fecha = $age . "-" . $mes_ . "-" . $dia;
    $form = new Form();
    if(!isset($detalle))$detalle = 'NULL';
    if($grupodoc == 7){
        $id_cliente = mysqli_fetch_array($cliente->getId($numero, 2));
        $id_form = mysqli_fetch_array($form->getLastId($id_cliente['id']));

        if($form->insertformautos(strtoupper($razonsocial), $grupodoc, $numero, $actecono, strtoupper($detalle), $ciudad, strtoupper($direccion), $telefono, strtoupper($email), $fecha, $npoliza, '', '', '', $numero_, $lote, $planilla1, $_SESSION['id'], $id_form["id"]) == 0){
            if($form->insertThreeData('', '', '', $grupodoc, $numero, strtoupper($direccion), $ciudad, $telefono, $actecono, $detalle, $numero_, $razonsocial, $id_form["id"])){
                $image = new Image();
                $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));

                if($image->save($filename['filename'], $id_form['id'], '5', $_SESSION['id']) == 0){
                    if($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0){
                        $log = new Log();
                        if($log->addIndexacion($id_form['id'], $_SESSION['id']) == 0)//FIX USER
                            header("Location: fingering.php?id_form={$id_form['id']}&id_cliente={$id_cliente['id']}");
                    }
                }
            }else
                echo "<br><h1>Error actualizando información de formulario.</h1>";
        }else
            echo "<br><h1>Error ingresando la información de formulariooooooooo.</h1>";
        //        echo $form->insertThreeData('', '', '', $grupodoc, $numero, strtoupper($direccion), $ciudad, $telefono, $actecono, $numero_, $razonsocial, $id_form);
    }else{
        $id_cliente = mysqli_fetch_array($cliente->getId($numero, 1));
        $id_form = mysqli_fetch_array($form->getLastId($id_cliente['id']));

        if($form->insertformautos('', $grupodoc, $numero, $ocupacti, strtoupper($detalle), $ciudad, strtoupper($direccion), $telefono, strtoupper($email), $fecha, $npoliza, strtoupper($txtnombres), strtoupper($txtpapellido), strtoupper($txtsapellido), '', $lote, $planilla1, $_SESSION['id'], $id_form["id"]) == 0){
            if($form->insertThreeData(strtoupper($txtpapellido), strtoupper($txtsapellido), strtoupper($txtnombres), $grupodoc, $numero, strtoupper($direccion), $ciudad, $telefono, $ocupacti, $detalle, '', '', $id_form["id"])){
                $image = new Image();
                $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));

                if($image->save($filename['filename'], $id_form['id'], '5', $_SESSION['id']) == 0){
                    if($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0){
                        $log = new Log();
                        if($log->addIndexacion($id_form['id'], $_SESSION['id']) == 0) //FIX USER
                            header("Location: fingering.php?id_form={$id_form['id']}&id_cliente={$id_cliente['id']}");
                    }
                }
            }else
                echo "<br><h1>Error actualizando información de formulario.</h1>";
        }else
            echo "<br><h1>Error ingresando la información de formulario.</h1>";
    }
}elseif($type == "5"){
    if($_SESSION['id'] == 1){
        print_r($_POST);
    }
    $cliente = new Client();
    Client::actualizarItemRadicadoComplementaria($numero, $lote, '2');
    $form = new Form();

    $id_cliente = mysqli_fetch_array($cliente->getId($numero, $tipo_cliente));
    $id_form = mysqli_fetch_array($form->getLastId($id_cliente['id']));

    $image = new Image();
    $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
//    echo $image->save($filename['filename'], $id_form, $type, $_SESSION['id']);163010
    if($image->save($filename['filename'], $id_form["id"], 4, $_SESSION['id']) == 0){
        if($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0){
            $log = new Log();
            if($log->addIndexacion($id_form["id"], $_SESSION['id']) == 0) //FIX USER
                header("Location: fingering.php?id_form={$id_form['id']}&id_cliente={$id_cliente['id']}");
            else
                echo '3';
        }else
            echo '2';
    }else
        echo '1';
}elseif($type == "6"){
    //echo json_encode($_POST);
    //exit();
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
    if((isset($_POST['f_rad_a']) && !empty($_POST['f_rad_a'])) && (isset($_POST['f_rad_m']) && !empty($_POST['f_rad_m'])) && (isset($_POST['f_rad_d']) && !empty($_POST['f_rad_d']))){
        if(date('Y-m-d', strtotime($_POST['f_rad_a'].'-'.$_POST['f_rad_m'].'-'.$_POST['f_rad_d'])) == '1969-12-31'){
            echo "<script>alert('La fecha de radicado no puede ser errada.');</script>";
            exit();
        }else
            $fecharadicado = date('Y-m-d', strtotime($_POST['f_rad_a'].'-'.$_POST['f_rad_m'].'-'.$_POST['f_rad_d']));
    }else{
        echo "<script>alert('La fecha de radicado no puede ser vacia.');</script>";
        exit();
    }
    if((isset($_POST['f_dil_a']) && !empty($_POST['f_dil_a'])) && (isset($_POST['f_dil_m']) && !empty($_POST['f_dil_m'])) && (isset($_POST['f_dil_d']) && !empty($_POST['f_dil_d']))){
        if(date('Y-m-d', strtotime($_POST['f_dil_a'].'-'.$_POST['f_dil_m'].'-'.$_POST['f_dil_d'])) == '1969-12-31'){
            echo "<script>alert('La fecha de diligenciamiento no puede ser errada.');</script>";
            exit();
        }else
            $fechasolicitud = date('Y-m-d', strtotime($_POST['f_dil_a'].'-'.$_POST['f_dil_m'].'-'.$_POST['f_dil_d']));
    }else{
        echo "<script>alert('La fecha de diligenciamiento no puede ser vacia.');</script>";
        exit();
    }
    if((isset($_POST['f_exp_a']) && !empty($_POST['f_exp_a'])) && (isset($_POST['f_exp_m']) && !empty($_POST['f_exp_m'])) && (isset($_POST['f_exp_d']) && !empty($_POST['f_exp_d']))){
        if(date('Y-m-d', strtotime($_POST['f_exp_a'].'-'.$_POST['f_exp_m'].'-'.$_POST['f_exp_d'])) == '1969-12-31'){
            echo "<script>alert('La fecha de expedicion no puede ser errada.');</script>";
            exit();
        }else
            $fechaexpedicion = date('Y-m-d', strtotime($_POST['f_exp_a'].'-'.$_POST['f_exp_m'].'-'.$_POST['f_exp_d']));

    }
    if((isset($_POST['f_nac_a']) && !empty($_POST['f_nac_a'])) && (isset($_POST['f_nac_m']) && !empty($_POST['f_nac_m'])) && (isset($_POST['f_nac_d']) && !empty($_POST['f_nac_d']))){
        if(date('Y-m-d', strtotime($_POST['f_nac_a'].'-'.$_POST['f_nac_m'].'-'.$_POST['f_nac_d'])) == '1969-12-31' && ($_POST['f_nac_a'] != '1969' || $_POST['f_nac_m'] != '12' || $_POST['f_nac_d'] != '31')){
            echo "<script>alert('La fecha de nacimento no puede ser errada.');</script>";
            exit();
        }else
            $fechanacimiento = date('Y-m-d', strtotime($_POST['f_nac_a'].'-'.$_POST['f_nac_m'].'-'.$_POST['f_nac_d']));

    }
    if((isset($_POST['f_ini_a']) && !empty($_POST['f_ini_a'])) && (isset($_POST['f_ini_m']) && !empty($_POST['f_ini_m'])) && (isset($_POST['f_ini_d']) && !empty($_POST['f_ini_d']))){
        if(date('Y-m-d', strtotime($_POST['f_ini_a'].'-'.$_POST['f_ini_m'].'-'.$_POST['f_ini_d'])) == '1969-12-31'){
            echo "<script>alert('La fecha inicial no puede ser errada.');</script>";
            exit();
        }else
            $cargo_politica_ini = date('Y-m-d', strtotime($_POST['f_ini_a'].'-'.$_POST['f_ini_m'].'-'.$_POST['f_ini_d']));

    }
    if((isset($_POST['f_fin_a']) && !empty($_POST['f_fin_a'])) && (isset($_POST['f_fin_m']) && !empty($_POST['f_fin_m'])) && (isset($_POST['f_fin_d']) && !empty($_POST['f_fin_d']))){
        if(date('Y-m-d', strtotime($_POST['f_fin_a'].'-'.$_POST['f_fin_m'].'-'.$_POST['f_fin_d'])) == '1969-12-31'){
            echo "<script>alert('La fecha final no puede ser errada.');</script>";
            exit();
        }else
            $cargo_politica_fin = date('Y-m-d', strtotime($_POST['f_fin_a'].'-'.$_POST['f_fin_m'].'-'.$_POST['f_fin_d']));

    }
    if((isset($_POST['f_ent_a']) && !empty($_POST['f_ent_a'])) && (isset($_POST['f_ent_m']) && !empty($_POST['f_ent_m'])) && (isset($_POST['f_ent_d']) && !empty($_POST['f_ent_d']))){
        if(date('Y-m-d', strtotime($_POST['f_ent_a'].'-'.$_POST['f_ent_m'].'-'.$_POST['f_ent_d'])) == '1969-12-31'){
            echo "<script>alert('La fecha de entrevista no puede ser errada.');</script>";
            exit();
        }else
            $fechaentrevista = date('Y-m-d', strtotime($_POST['f_ent_a'].'-'.$_POST['f_ent_m'].'-'.$_POST['f_ent_d']));
    }
    if((isset($_POST['f_ver_a']) && !empty($_POST['f_ver_a'])) && (isset($_POST['f_ver_m']) && !empty($_POST['f_ver_m'])) && (isset($_POST['f_ver_d']) && !empty($_POST['f_ver_d']))){
        if(date('Y-m-d', strtotime($_POST['f_ver_a'].'-'.$_POST['f_ver_m'].'-'.$_POST['f_ver_d'])) == '1969-12-31'){
            echo "<script>alert('La fecha de verificacion no puede ser errada.');</script>";
            exit();
        }else
            $verificacion_fecha = date('Y-m-d', strtotime($_POST['f_ver_a'].'-'.$_POST['f_ver_m'].'-'.$_POST['f_ver_d']));
    }
    if((isset($_POST['h_ent_h']) && !empty($_POST['h_ent_h'])) && (isset($_POST['h_ent_m']) && !empty($_POST['h_ent_m']))){
        $horaentrevista = $_POST['h_ent_h'].':'.$_POST['h_ent_m'];
    }
    $tipohoraentrevista = $_POST['h_ent_z'];
    if((isset($_POST['h_ver_h']) && !empty($_POST['h_ver_h'])) && (isset($_POST['h_ver_m']) && !empty($_POST['h_ver_m'])) && (isset($_POST['h_ver_z']) && !empty($_POST['h_ver_z']))){
        $verificacion_hora = date('H:i', strtotime($_POST['h_ver_h'].':'.$_POST['h_ver_m'].' '.$_POST['h_ver_z']));
    }
    if($clasecliente != '10')
        $cual_clasecliente = NULL;
    if($tipoempresaemp != '5')
        $tipoempresaemp_cual = NULL;
    if($reconocimiento_publico == '0')
        $reconocimiento_cual = NULL;
    if($expuesta_politica == '0')
        $cargo_politica = NULL;
    if($expuesta_publica == '0'){
        $publica_nombre = NULL;
        $publica_cargo = NULL;
    }
    if($repre_internacional == '0')
        $internacional_indique = NULL;
    if($tributarias_otro_pais == '0')
        $tributarias_paises = NULL;
    if(isset($tipoempresajur) && $tipoempresajur != '5')
        $tipoempresajur_otra = NULL;
    if($monedaextranjera == '0' && !isset($tipotransacciones)){
        $tipotransacciones = NULL;
        $tipotransacciones_cual = NULL;
    }elseif($monedaextranjera == '0' && $tipotransacciones != '7'){
        $tipotransacciones_cual = NULL;
    }
    if($tipopersona == '2'){
        $tipoactividad = NULL;
        $profesion = NULL;
        $cargo = NULL;
        $actividadeconomicaempresa = NULL;
        $ciiu_otro = NULL;
        $telefonoficinappal = '0';
        $detalletipoactividad = NULL;
        $ingresosmensuales = NULL;
        $totalactivos = NULL;
        $totalpasivos = NULL;
        $egresosmensuales = NULL;
        $otrosingresos = NULL;
        $conceptosotrosingresos = NULL;
    }elseif($tipopersona == '1'){
        $razonsocial = NULL;
        $nit = NULL;
        $digitochequeo = NULL;
        $tipoempresajur = NULL;
        $tipoempresajur_otra = NULL;
        $detalleactividadeconomicappal = NULL;
        $ciudadoficina = NULL;
        $telefonoficina = '0';
        $correoelectronico_otro = NULL;
        $celularoficina = '0';
        $direccionsucursal = NULL;
        $ingresosmensualesemp = NULL;
        $activosemp = NULL;
        $pasivosemp = NULL;
        $egresosmensualesemp = NULL;
        $otrosingresosemp = NULL;
        $concepto_otrosingresosemp = NULL;
    }


    if((!empty($documento) || !empty($nit) ) && !empty($tipopersona)){
        $cliente = new Client();
        if(!empty($nit) && $tipopersona == "2")
            $id_cliente = $cliente->getId($nit, $tipopersona);

        if(!empty($documento) && $tipopersona == "1")
            $id_cliente = $cliente->getId($documento, $tipopersona);

        if(!isset($_POST['telefonoresidencia']) || empty($_POST['telefonoresidencia']))
            $telefonoresidencia = '0';
        if(!isset($_POST['celular']) || empty($_POST['celular']))
            $celular = '0';
        if(!isset($_POST['telefonolaboral']) || empty($_POST['telefonolaboral']))
            $telefonolaboral = '0';
        if(!isset($_POST['celularoficinappal']) || empty($_POST['celularoficinappal']))
            $celularoficinappal = '0';
        if(!isset($_POST['telefonoficinappal']) || empty($_POST['telefonoficinappal']))
            $telefonoficinappal = '0';
        if(!isset($_POST['telefonoficina']) || empty($_POST['telefonoficina']))
            $telefonoficina = '0';
        if(!isset($_POST['celularoficina']) || empty($_POST['celularoficina']))
            $celularoficina = '0';

        $id_cliente = mysqli_fetch_array($id_cliente);
        if($id_cliente['id'] > 0){
            $cliente->activeCliente($id_cliente['id']);
            $form = new Form();
            //Sinthia Rodriguez Alertas inicio
            $lastForm = mysqli_fetch_array($form->getLastId($id_cliente['id']));
            $lastData = mysqli_fetch_array($form->getFormInfo($lastForm['id']));

            if($lastData['tipoactividad'] != $tipoactividad)
                $cambioact = true;

            if($fechaexpedicion === '--'){
                echo "<script>alert('La fecha de expedicion no puede ser -- 1.');</script>";
                exit();
                echo json_encode($_POST);
            }
            /*if($_SESSION['id'] == '1'){
                echo json_encode(array("existe"=> array('id_form'=> 'id_form', 'fecharadicado'=> $fecharadicado, 'fechasolicitud'=> $fechasolicitud, 'sucursal'=> $sucursal, 'area'=> $area, 'lote'=> $lote, 'formulario'=> $formulario, 'id_official'=> $id_official, 'clasecliente'=> $clasecliente, 'primerapellido'=> $primerapellido, 'segundoapellido'=> $segundoapellido, 'nombres'=> $nombres, 'sexo'=> $sexo, 'tipodocumento'=> $tipodocumento, 'documento'=> $documento, 'fechaexpedicion'=> $fechaexpedicion, 'lugarexpedicion'=> $lugarexpedicion, 'fechanacimiento'=> $fechanacimiento, 'paisnacimiento'=> $paisnacimiento, 'lugarnacimiento'=> $lugarnacimiento, 'nacionalidad_otra'=> $nacionalidad_otra, 'direccionresidencia'=> $direccionresidencia, 'ciudadresidencia'=> $ciudadresidencia, 'telefonoresidencia'=> $telefonoresidencia, 'nombreempresa'=> $nombreempresa, 'ciudadempresa'=> $ciudadempresa, 'direccionempresa'=> $direccionempresa, 'telefonolaboral'=> $telefonolaboral, 'celular'=> $celular, 'correoelectronico'=> $correoelectronico, 'cargo'=> $cargo, 'actividadeconomicaempresa'=> $actividadeconomicaempresa, 'profesion'=> $profesion, 'ciiu'=> $ciiu, 'ingresosmensuales'=> $ingresosmensuales, 'otrosingresos'=> $otrosingresos, 'egresosmensuales'=> $egresosmensuales, 'conceptosotrosingresos'=> $conceptosotrosingresos, 'tipoactividad'=> $tipoactividad, 'detalletipoactividad'=> $detalletipoactividad, 'totalactivos'=> $totalactivos, 'totalpasivos'=> $totalpasivos, 'razonsocial'=> $razonsocial, 'nit'=> $nit, 'digitochequeo'=> $digitochequeo, 'ciudadoficina'=> $ciudadoficina, 'direccionoficinappal'=> $direccionoficinappal, 'telefonoficina'=> $telefonoficina, 'celularoficina'=> $celularoficina, 'direccionsucursal'=> $direccionsucursal, 'detalleactividadeconomicappal'=> $detalleactividadeconomicappal, 'tipoempresaemp'=> $tipoempresaemp, 'activosemp'=> $activosemp, 'pasivosemp'=> $pasivosemp, 'ingresosmensualesemp'=> $ingresosmensualesemp, 'egresosmensualesemp'=> $egresosmensualesemp, 'otrosingresosemp'=> $otrosingresosemp, 'concepto_otrosingresosemp'=> $concepto_otrosingresosemp, 'monedaextranjera'=> $monedaextranjera, 'tipotransacciones'=> $tipotransacciones, 'productos_exterior'=> $productos_exterior, 'cuentas_monedaextranjera'=> $cuentas_monedaextranjera, 'firma'=> $firma, 'huella'=> $huella, 'lugarentrevista'=> $lugarentrevista, 'fechaentrevista'=> $fechaentrevista, 'horaentrevista'=> $horaentrevista, 'tipohoraentrevista'=> $tipohoraentrevista, 'resultadoentrevista'=> $resultadoentrevista, 'observacionesentrevista'=> $observacionesentrevista, 'nombreintermediario'=> $nombreintermediario, 'ciudad'=> $ciudad, 'tipo_solicitud'=> $tipo_solicitud, 'cual_clasecliente'=> $cual_clasecliente, 'celularoficinappal'=> $celularoficinappal, 'tipoempresaemp_cual'=> $tipoempresaemp_cual, 'recursos_publicos'=> $recursos_publicos, 'poder_publico'=> $poder_publico, 'reconocimiento_publico'=> $reconocimiento_publico, 'reconocimiento_cual'=> $reconocimiento_cual, 'servidor_publico'=> $servidor_publico, 'expuesta_politica'=> $expuesta_politica, 'cargo_politica'=> $cargo_politica, 'cargo_politica_ini'=> $cargo_politica_ini, 'cargo_politica_fin'=> $cargo_politica_fin, 'expuesta_publica'=> $expuesta_publica, 'publica_nombre'=> $publica_nombre, 'publica_cargo'=> $publica_cargo, 'repre_internacional'=> $repre_internacional, 'internacional_indique'=> $internacional_indique, 'tributarias_otro_pais'=> $tributarias_otro_pais, 'tributarias_paises'=> $tributarias_paises, 'ciiu_otro'=> $ciiu_otro, 'telefonoficinappal'=> $telefonoficinappal, 'patrimonio'=> $patrimonio, 'tipoempresajur'=> $tipoempresajur, 'tipoempresajur_otra'=> $tipoempresajur_otra, 'correoelectronico_otro'=> $correoelectronico_otro, 'origen_fondos'=> $origen_fondos, 'procedencia_fondos'=> $procedencia_fondos, 'tipotransacciones_cual'=> $tipotransacciones_cual, 'otras_operaciones'=> $otras_operaciones, 'reclamaciones'=> $reclamaciones, 'clave_inter'=> $clave_inter, 'firma_entrevista'=> $firma_entrevista, 'verificacion_ciudad'=> $verificacion_ciudad, 'verificacion_fecha'=> $verificacion_fecha, 'verificacion_hora'=> $verificacion_hora, 'verificacion_nombre'=> $verificacion_nombre, 'verificacion_observacion'=> $verificacion_observacion, 'verificacion_firma'=> $verificacion_firma, 'auto_correo'=> $auto_correo, 'auto_sms'=> $auto_sms, 'id_cliente'=> $id_cliente['id'])));
                exit();
            }*/
            //Sinthia Rodriguez Alertas fin
            if($form->add($id_cliente['id'], 'FORMULARIO', $lote, $planilla1, $_SESSION['id'], 1, $marca) == 0){//$num_images,$marca) == 0){
                $lastForm = $form->getLastId($id_cliente['id']);
                $lastForm = mysqli_fetch_array($lastForm);
                //Insertar información principal
                if(!isset($actividadeconomicaempresa))
                    $actividadeconomicaempresa = '';
                if(!isset($tipotransacciones))
                    $tipotransacciones = '';
                if(!isset($tipotransacciones_cual))
                    $tipotransacciones_cual = '';
                if($form->insertPrimaryDataNew($lastForm['id'], $fecharadicado, $fechasolicitud, $sucursal, $area, $lote, $formulario, $id_official, $clasecliente, $primerapellido, $segundoapellido, $nombres, $sexo, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $paisnacimiento, $lugarnacimiento, $nacionalidad_otra, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $detalletipoactividad, $totalactivos, $totalpasivos, $razonsocial, $nit, $digitochequeo, $ciudadoficina, $direccionoficinappal, $telefonoficina, $celularoficina, $direccionsucursal, $detalleactividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $otrosingresosemp, $concepto_otrosingresosemp, $monedaextranjera, $tipotransacciones, $productos_exterior, $cuentas_monedaextranjera, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario, $ciudad, $tipo_solicitud, $cual_clasecliente, $celularoficinappal, $tipoempresaemp_cual, $recursos_publicos, $poder_publico, $reconocimiento_publico, $reconocimiento_cual, $servidor_publico, $expuesta_politica, $cargo_politica, $cargo_politica_ini, $cargo_politica_fin, $expuesta_publica, $publica_nombre, $publica_cargo, $repre_internacional, $internacional_indique, $tributarias_otro_pais, $tributarias_paises, $ciiu_otro, $telefonoficinappal, $patrimonio, $tipoempresajur, $tipoempresajur_otra, $correoelectronico_otro, $origen_fondos, $procedencia_fondos, $tipotransacciones_cual, $otras_operaciones, $reclamaciones, $clave_inter, $firma_entrevista, $verificacion_ciudad, $verificacion_fecha, $verificacion_hora, $verificacion_nombre, $verificacion_observacion, $verificacion_firma, $auto_correo, $auto_sms, $id_cliente['id']) == 0){
                    //exit();
                    //EmailAlert::generateFormAlerts($lastForm['id']);
                    $idData = Form::getLastDataInsert($lastForm['id']);
                    //CUENTAS EN MONEDA EXTRANJERA
                    if($cuentas_monedaextranjera == '-1'){
                        for ($i = 0; $i < 3; $i++) { 
                            if(!empty($_POST['producto_tipo'][$i]) || !empty($_POST['producto_identificacion'][$i]) || !empty($_POST['producto_entidad'][$i]) || !empty($_POST['producto_monto'][$i]) || !empty($_POST['producto_ciudad'][$i]) || !empty($_POST['producto_pais'][$i]) || !empty($_POST['producto_moneda'][$i])){

                                Form::insertCuentas($idData['id'], $_POST['producto_tipo'][$i], $_POST['producto_identificacion'][$i], $_POST['producto_entidad'][$i], $_POST['producto_monto'][$i], $_POST['producto_ciudad'][$i], $_POST['producto_pais'][$i], $_POST['producto_moneda'][$i]);
                            }
                        }
                    }
                    //RECLAMACIONES
                    if($reclamaciones == '-1'){
                        for ($j = 0; $j < 2; $j++) { 
                            if(!empty($_POST['rec_ano'][$j]) || !empty($_POST['rec_ramo'][$j]) || !empty($_POST['rec_compania'][$j]) || !empty($_POST['rec_valor'][$j]) || !empty($_POST['rec_resultado'][$j])){
                                Form::insertReclamaciones($idData['id'], $_POST['rec_ano'][$j], $_POST['rec_ramo'][$j], $_POST['rec_compania'][$j], $_POST['rec_valor'][$j], $_POST['rec_resultado'][$j]);
                            }
                        }
                    }
                    if($tipopersona == '2'){
                        for($k = 0; $k < 5; $k++){
                            if (!empty($_POST['identificacion'][$k])) {
                                Form::insertAccionistas($idData['id'], $_POST['tipo_id'][$k], $_POST['identificacion'][$k], $_POST['nombre_accionista'][$k], $_POST['porcentaje'][$k], $_POST['publico_recursos'][$k], $_POST['publico_reconocimiento'][$k], $_POST['publico_expuesta'][$k], $_POST['declaracion_tributaria'][$k]);
                            }
                        }
                    }

                    $image = new Image();
                    $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
                    if($image->save($filename['filename'], $lastForm['id'], $type, $_SESSION['id']) == 0){
                        if($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0){//Imagen desactivada correcstameante
                            //Se verifica si tiene devolucion y se cambia el estado en caso de que si tenga devolucion
                            if($tipopersona == '1')
                                $documentVerf = $documento;
                            else
                                $documentVerf = $nit;

                            if(Workflow::verificarCliente($documentVerf, $tipopersona))
                                Workflow::cambiarEstado($documentVerf, $tipopersona);

                            Image::guardarPlanillaLote($planilla_lote, $lote, $_SESSION['id']);

                            $log = new Log();
                            if($log->addIndexacion($lastForm['id'], $_SESSION['id']) == 0)//FIX USER
                                header("Location: fingering.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
                        }else
                            echo "<h1>No se pudo desactivar la imagen</h1>";
                    }
                }else
                    echo "<h1>Error insertando formulario 6... </h1>";
            }else
                echo "<h1>Error creando formulario1.</h1>";
        }else{
            if(!empty($nit) && $tipopersona == "2"){
                $documento_crear = $nit;
                $nombre_crear = $razonsocial;
                $result_crear = $cliente->add($documento_crear, $tipopersona, $nombre_crear, "");
            }
            if(!empty($documento) && $tipopersona == "1"){
                $documento_crear = $documento;
                $nombre_crear = $primerapellido . " " . $segundoapellido . " " . $nombres;
                $result_crear = $cliente->add($documento_crear, $tipopersona, $nombre_crear, "");
            }


            //Creación del cliente ya que no existe en la base de datos
            if($result_crear == 0){
                $id_cliente = $cliente->getId($documento_crear, $tipopersona);
                $id_cliente = mysqli_fetch_array($id_cliente);
                $form = new Form();
                if($fechaexpedicion === '--'){
                    echo "<script>alert('La fecha de expedicion no puede ser -- 2.');</script>";
                    exit();
                    echo json_encode($_POST);
                }
            /*if($_SESSION['id'] == '1'){
                echo json_encode(array("no_existe"=> array('id_form'=> 'id_form', 'fecharadicado'=> $fecharadicado, 'fechasolicitud'=> $fechasolicitud, 'sucursal'=> $sucursal, 'area'=> $area, 'lote'=> $lote, 'formulario'=> $formulario, 'id_official'=> $id_official, 'clasecliente'=> $clasecliente, 'primerapellido'=> $primerapellido, 'segundoapellido'=> $segundoapellido, 'nombres'=> $nombres, 'sexo'=> $sexo, 'tipodocumento'=> $tipodocumento, 'documento'=> $documento, 'fechaexpedicion'=> $fechaexpedicion, 'lugarexpedicion'=> $lugarexpedicion, 'fechanacimiento'=> $fechanacimiento, 'paisnacimiento'=> $paisnacimiento, 'lugarnacimiento'=> $lugarnacimiento, 'nacionalidad_otra'=> $nacionalidad_otra, 'direccionresidencia'=> $direccionresidencia, 'ciudadresidencia'=> $ciudadresidencia, 'telefonoresidencia'=> $telefonoresidencia, 'nombreempresa'=> $nombreempresa, 'ciudadempresa'=> $ciudadempresa, 'direccionempresa'=> $direccionempresa, 'telefonolaboral'=> $telefonolaboral, 'celular'=> $celular, 'correoelectronico'=> $correoelectronico, 'cargo'=> $cargo, 'actividadeconomicaempresa'=> $actividadeconomicaempresa, 'profesion'=> $profesion, 'ciiu'=> $ciiu, 'ingresosmensuales'=> $ingresosmensuales, 'otrosingresos'=> $otrosingresos, 'egresosmensuales'=> $egresosmensuales, 'conceptosotrosingresos'=> $conceptosotrosingresos, 'tipoactividad'=> $tipoactividad, 'detalletipoactividad'=> $detalletipoactividad, 'totalactivos'=> $totalactivos, 'totalpasivos'=> $totalpasivos, 'razonsocial'=> $razonsocial, 'nit'=> $nit, 'digitochequeo'=> $digitochequeo, 'ciudadoficina'=> $ciudadoficina, 'direccionoficinappal'=> $direccionoficinappal, 'telefonoficina'=> $telefonoficina, 'celularoficina'=> $celularoficina, 'direccionsucursal'=> $direccionsucursal, 'detalleactividadeconomicappal'=> $detalleactividadeconomicappal, 'tipoempresaemp'=> $tipoempresaemp, 'activosemp'=> $activosemp, 'pasivosemp'=> $pasivosemp, 'ingresosmensualesemp'=> $ingresosmensualesemp, 'egresosmensualesemp'=> $egresosmensualesemp, 'otrosingresosemp'=> $otrosingresosemp, 'concepto_otrosingresosemp'=> $concepto_otrosingresosemp, 'monedaextranjera'=> $monedaextranjera, 'tipotransacciones'=> $tipotransacciones, 'productos_exterior'=> $productos_exterior, 'cuentas_monedaextranjera'=> $cuentas_monedaextranjera, 'firma'=> $firma, 'huella'=> $huella, 'lugarentrevista'=> $lugarentrevista, 'fechaentrevista'=> $fechaentrevista, 'horaentrevista'=> $horaentrevista, 'tipohoraentrevista'=> $tipohoraentrevista, 'resultadoentrevista'=> $resultadoentrevista, 'observacionesentrevista'=> $observacionesentrevista, 'nombreintermediario'=> $nombreintermediario, 'ciudad'=> $ciudad, 'tipo_solicitud'=> $tipo_solicitud, 'cual_clasecliente'=> $cual_clasecliente, 'celularoficinappal'=> $celularoficinappal, 'tipoempresaemp_cual'=> $tipoempresaemp_cual, 'recursos_publicos'=> $recursos_publicos, 'poder_publico'=> $poder_publico, 'reconocimiento_publico'=> $reconocimiento_publico, 'reconocimiento_cual'=> $reconocimiento_cual, 'servidor_publico'=> $servidor_publico, 'expuesta_politica'=> $expuesta_politica, 'cargo_politica'=> $cargo_politica, 'cargo_politica_ini'=> $cargo_politica_ini, 'cargo_politica_fin'=> $cargo_politica_fin, 'expuesta_publica'=> $expuesta_publica, 'publica_nombre'=> $publica_nombre, 'publica_cargo'=> $publica_cargo, 'repre_internacional'=> $repre_internacional, 'internacional_indique'=> $internacional_indique, 'tributarias_otro_pais'=> $tributarias_otro_pais, 'tributarias_paises'=> $tributarias_paises, 'ciiu_otro'=> $ciiu_otro, 'telefonoficinappal'=> $telefonoficinappal, 'patrimonio'=> $patrimonio, 'tipoempresajur'=> $tipoempresajur, 'tipoempresajur_otra'=> $tipoempresajur_otra, 'correoelectronico_otro'=> $correoelectronico_otro, 'origen_fondos'=> $origen_fondos, 'procedencia_fondos'=> $procedencia_fondos, 'tipotransacciones_cual'=> $tipotransacciones_cual, 'otras_operaciones'=> $otras_operaciones, 'reclamaciones'=> $reclamaciones, 'clave_inter'=> $clave_inter, 'firma_entrevista'=> $firma_entrevista, 'verificacion_ciudad'=> $verificacion_ciudad, 'verificacion_fecha'=> $verificacion_fecha, 'verificacion_hora'=> $verificacion_hora, 'verificacion_nombre'=> $verificacion_nombre, 'verificacion_observacion'=> $verificacion_observacion, 'verificacion_firma'=> $verificacion_firma, 'auto_correo'=> $auto_correo, 'auto_sms'=> $auto_sms, 'id_cliente'=> $id_cliente['id'])));
                exit();
            }*/
                if($form->add($id_cliente['id'], 'FORMULARIO', $lote, $planilla1, $_SESSION['id'], $num_images, $marca) == 0){
                    $lastForm = $form->getLastId($id_cliente['id']);
                    $lastForm = mysqli_fetch_array($lastForm);
                    //Insertar información principal
                    if(!isset($actividadeconomicaempresa))
                        $actividadeconomicaempresa = '';
                    if(!isset($tipotransacciones))
                        $tipotransacciones = '';
                    if(!isset($tipotransacciones_cual))
                        $tipotransacciones_cual = '';
                    if($form->insertPrimaryDataNew($lastForm['id'], $fecharadicado, $fechasolicitud, $sucursal, $area, $lote, $formulario, $id_official, $clasecliente, $primerapellido, $segundoapellido, $nombres, $sexo, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $paisnacimiento, $lugarnacimiento, $nacionalidad_otra, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $detalletipoactividad, $totalactivos, $totalpasivos, $razonsocial, $nit, $digitochequeo, $ciudadoficina, $direccionoficinappal, $telefonoficina, $celularoficina, $direccionsucursal, $detalleactividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $otrosingresosemp, $concepto_otrosingresosemp, $monedaextranjera, $tipotransacciones, $productos_exterior, $cuentas_monedaextranjera, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario, $ciudad, $tipo_solicitud, $cual_clasecliente, $celularoficinappal, $tipoempresaemp_cual, $recursos_publicos, $poder_publico, $reconocimiento_publico, $reconocimiento_cual, $servidor_publico, $expuesta_politica, $cargo_politica, $cargo_politica_ini, $cargo_politica_fin, $expuesta_publica, $publica_nombre, $publica_cargo, $repre_internacional, $internacional_indique, $tributarias_otro_pais, $tributarias_paises, $ciiu_otro, $telefonoficinappal, $patrimonio, $tipoempresajur, $tipoempresajur_otra, $correoelectronico_otro, $origen_fondos, $procedencia_fondos, $tipotransacciones_cual, $otras_operaciones, $reclamaciones, $clave_inter, $firma_entrevista, $verificacion_ciudad, $verificacion_fecha, $verificacion_hora, $verificacion_nombre, $verificacion_observacion, $verificacion_firma, $auto_correo, $auto_sms, $id_cliente['id']) == 0){
                        //exit();
                        $idData = Form::getLastDataInsert($lastForm['id']);
                        //CUENTAS EN MONEDA EXTRANJERA
                        if($cuentas_monedaextranjera == '-1'){
                            for ($i = 0; $i < 3; $i++) { 
                                if(!empty($_POST['producto_tipo'][$i]) || !empty($_POST['producto_identificacion'][$i]) || !empty($_POST['producto_entidad'][$i]) || !empty($_POST['producto_monto'][$i]) || !empty($_POST['producto_ciudad'][$i]) || !empty($_POST['producto_pais'][$i]) || !empty($_POST['producto_moneda'][$i])){

                                    Form::insertCuentas($idData['id'], $_POST['producto_tipo'][$i], $_POST['producto_identificacion'][$i], $_POST['producto_entidad'][$i], $_POST['producto_monto'][$i], $_POST['producto_ciudad'][$i], $_POST['producto_pais'][$i], $_POST['producto_moneda'][$i]);
                                }
                            }
                        }
                        //RECLAMACIONES
                        if($reclamaciones == '-1'){
                            for ($j = 0; $j < 2; $j++) { 
                                if(!empty($_POST['rec_ano'][$j]) || !empty($_POST['rec_ramo'][$j]) || !empty($_POST['rec_compania'][$j]) || !empty($_POST['rec_valor'][$j]) || !empty($_POST['rec_resultado'][$j])){
                                    Form::insertReclamaciones($idData['id'], $_POST['rec_ano'][$j], $_POST['rec_ramo'][$j], $_POST['rec_compania'][$j], $_POST['rec_valor'][$j], $_POST['rec_resultado'][$j]);
                                }
                            }
                        }
                        if($tipopersona == '2'){
                            for($k = 0; $k < 5; $k++){
                                if (!empty($_POST['identificacion'][$k])) {
                                    Form::insertAccionistas($idData['id'], $_POST['tipo_id'][$k], $_POST['identificacion'][$k], $_POST['nombre_accionista'][$k], $_POST['porcentaje'][$k], $_POST['publico_recursos'][$k], $_POST['publico_reconocimiento'][$k], $_POST['publico_expuesta'][$k], $_POST['declaracion_tributaria'][$k]);
                                }
                            }
                        }
                    
                        $image = new Image();
                        //Copiar imagen a otra carpeta
                        $filename = mysqli_fetch_array($image->getName($id_imagen_tmp));
                        if($image->save($filename['filename'], $lastForm['id'], $type, $_SESSION['id']) == 0){
                            if($image->changeStatusImgTemp($id_imagen_tmp, 2) == 0){
                                //Se verifica si tiene devolucion y se cambia el estado en caso de que si tenga devolucion
                                if($tipopersona == '1')
                                    $documentVerf = $documento;
                                else
                                    $documentVerf = $nit;

                                if(Workflow::verificarCliente($documentVerf, $tipopersona))
                                    Workflow::cambiarEstado($documentVerf, $tipopersona);

                                Image::guardarPlanillaLote($planilla_lote, $lote, $_SESSION['id']);

                                $log = new Log();
                                if($log->addIndexacion($lastForm['id'], $_SESSION['id']) == 0)//FIX USER
                                    header("Location: fingering.php?id_form={$lastForm['id']}&id_cliente={$id_cliente['id']}");
                            }else
                                echo "<h1>No se pudo desactivar la imagen</h1>";
                        }
                    }else
                        echo "<h1>Error insertando formulario 12... </h1>";
                }else
                    echo "<h1>Error creando formulario2.</h1>";
            }else
                echo "<h1>Cliente creado sin éxito2. RESULTADO_CREAR: ".$result_crear."</h1>";
        }
    }
}



