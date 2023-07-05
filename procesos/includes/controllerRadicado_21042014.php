<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'radicados.class.php';
require_once PATH_MAILER . DS . 'class.phpmailer.php';
$action = $_POST['action'];
if ($action == 'cargarArchivo') {
    $_POST['FILE'] = $_FILES;
}
call_user_func($action, $_POST);

function creaciondeRadicado($request) {
    $request['id_usuarioenvia'] = $_SESSION['id'];
    $radicado = new Radicados();
    $radicado->setAtributos($request);
    if ($radicado->registrar()) {
        $clientes = explode('|', $request['clientes']);
        $tam = count($clientes) / 2;
        $j = 0;
        $i = 0;
        $pas = true;
        while ($i < $tam && $pas == true) {
            //print_r($clientes);
            if ($radicado->agregarItems($clientes[$j], $clientes[($j + 1)])) {
                $radicado->updateFilesRadicado($clientes[($j + 1)]);
                $i++;
                $j = $j + 2;
                $pas = true;
            } else
                $pas = false;
        }
        //$email = enviarMailSeguimiento($radicado); //SKRV
        $email = enviarMailSeguimiento($radicado);
        $errormail = '';
        if ($email != "ok")
            $errormail = ' pero ocurrio el siguiente error: ' . $email;
        if ($pas == true) {
            echo json_encode(array('exito' => 'Radicado ingresado exitosamente con sus clientes...' . $errormail, 'radicado' => $radicado));
        } else
            echo json_encode(array('errorr' => 'Ocurrio un error al momento de insertar clientes'));
    }else {
        echo json_encode(array('errorr' => 'Ocurrio un error al momento de insertar el redicado'));
    }
}

function enviarMailSeguimiento($radicado) {
    $oficial = $radicado->getOficial();
    $mail = new PHPMailer();
    $tipo = 'Fisico';
    if ($radicado->getTipo() == 1)
        $tipo = 'Virtual';
    $body = "
    <p>" . $oficial['name'] . ", usted a creado un nuevo radicado en Doc Finder, a continuaci&oacute;n se presentan los detalles del caso.</p><br>
    <p>Tipo: Radicado.</p>
    <p>Tipo de radicado: $tipo.</p>
    <p>Numero de radicado: " . $radicado->getId() . "</p>
    <p>Sucursal: " . $radicado->getSucursal() . "</p>
    <p>Telefono: " . $radicado->getTelefono() . "</p>";
    if ($radicado->getUtc() != 0)
        $body .= "<p>Utc: " . $radicado->getUtc() . "</p>";
    $body .= "<p>Radicado creado por: " . $oficial['name'] . "</p>
    <p>Fecha de creaci&oacute;n: " . $radicado->getFecha_creacion() . "</p><br>
    <p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";

    $mail->IsSendmail();

    $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
    $mail->Subject = "Usted tiene un nuevo radicado en Doc Finder.";

    $mail->MsgHTML($body);
    if (isset($oficial['email'])) {
        $address = $oficial['email'];
        $mail->AddAddress($address, $oficial['name']);
    }
    //$mail->AddAddress("jackeline.gutierrez@ui.colpatria.com", "Jackeline Gutierrez");
    $mail->AddAddress("operacioncolpatria@finlecobpo.com", "Operacion Colpatria Doc Finder");

    if (isset($oficial['email_father']) && $oficial['email_father'] != "")
        $mail->AddCC($oficial['email_father']);

    if (!$mail->Send()) {
        return "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return "ok";
    }
}

function busquedadeRadicado($request) {
    $radicado = new Radicados();
    $radicado->setId($request['id']);
    if ($radicado->getRadicado()) {
        $sucursal = $radicado->getSucursal();
        $funcionario = $radicado->getFuncionario();
        if ($items = $radicado->getItemsDeRadicado()) {
            echo json_encode(array('exito' => 'Radicado encontrado', 'radicado' => $radicado, 'sucursal' => $sucursal, 'funcionario' => $funcionario, 'items' => $items));
        } else
            echo json_encode(array('exito' => 'Radicado encontrado', 'radicado' => $radicado, 'sucursal' => $sucursal, 'funcionario' => $funcionario, 'erroritems' => 'no se encontraron items'));
    } else
        echo json_encode(array('errorr' => 'El numero de radicado que intenta buscar no ha sido aun creado'));
}

function aprobarClientes($request) {
    //print_r($request);
    //exit();
    $rep = true;
    $virt = false;
    $strCli = '';
    $pos_cli = '';
    $radicado = new Radicados();
    $radicado->setId($request['id_radicado']);
    //$radicado->setLote($request['lote']);
    $radicado->setId_usuariorecibido($_SESSION['id']);
    if (!isset($request['fecha_envio'])) {
        echo json_encode(array('errorr' => 'La fecha de envio no fue digitada, por favor verificar o comunicarse con el administrador'));
        exit();
    } elseif (trim($request['fecha_envio']) == '') {
        echo json_encode(array('errorr' => 'La fecha de envio no fue digitada, por favor verificar o comunicarse con el administrador'));
        exit();
    }
    if (isset($request['tipo_radicadoR']) && $request['tipo_radicadoR'] == '1') {
        $part = explode(' ', $request['fecha_creacionR']);
        $fecha_creR = $part[0];
        $radicado->setFecha_envio($fecha_creR);
    } elseif ($request['tipo_radicadoR'] == '0')
        $radicado->setFecha_envio($request['fecha_envio']);

    if ($radicado->aprobarOrden()) {
        if (isset($request['cliente'])) {
            $clientes = $request['cliente'];
            $i = 1;
            if ($radicado->getTipo() == 1) {
                $virt = true;
                $sucu_ = str_replace(" ", "_", $radicado->getSucursal());
                $id_ = $radicado->getId();
            }
            foreach ($clientes as $cliente) {
                $cliitem = explode('|', $cliente);
                if ($virt && $cliitem[1] == '2') {
                    $imas = $i;
                    if (strlen("$imas") > 1)
                        $pos_cli = $i;
                    else
                        $pos_cli = "0" . $i;

                    $cli_fil = Radicados::getClienteItem($cliitem[0]);
                    $error_fo = "";
                    if ($radicado->updateFilesRadicadoNombre($cli_fil['documento'], $pos_cli)) {
                        $upload_folder = '/var/www/html/Colpatria/virtuales_doc/virtuales';
                        $upload_folder_ = '/var/www/html/Colpatria/virtuales_doc/vurtuales_aceptados';
                        if (!file_exists($upload_folder_ . "/" . $sucu_)) {
                            if (!mkdir($upload_folder_ . "/" . $sucu_))
                                $error_fo .= "No se creo carpeta {$cli_fil['documento']}";
                        }
                        rename($upload_folder . "/" . $sucu_ . "/" . $cli_fil['documento'] . "/" . $sucu_ . "_" . $cli_fil['documento'] . "_MULTI.tiff", $upload_folder_ . "/" . $sucu_ . "/LOTE_" . $id_ . "_" . $pos_cli . ".tiff");
                    }
                }

                if (!$radicado->aprobarCliente($cliitem[0], $cliitem[1])) {
                    $rep = false;
                    $strCli .= $cliitem[0] . ", ";
                }
                $i++;
            }
            $email = enviarMailAprobacion($radicado);
            if ($rep) {
                echo json_encode(array('exito' => 'Los clientes fueron aprobados exitosamente...'));
                exit();
            } else {
                echo json_encode(array('errorr' => 'Los clientes con cedula ' . $strCli . 'no pudieron ser aprovados,\\n comuniquese con el administrador del sistema'));
                exit();
            }
        }
        echo json_encode(array('exito' => 'El radicado fue aprovado, pero sin clientes anexos'));
    } else
        echo json_encode(array('errorr' => 'Ocurrio un error en el momento de aprobacion del radicado\\n comuniquese con el administrador del sistema para solucionarlo'));
}

function enviarMailAprobacion($radicado) {
    $oficial = $radicado->getOficial();
    $mail = new PHPMailer();
    $tipo = 'Fisico';
    if ($radicado->getTipo() == 1)
        $tipo = 'Virtual';
    $body = "
    <p>" . $oficial['name'] . ", el radicado que creo con fecha " . $radicado->getFecha_creacion() . " ya fue aprobado, a continuacion los detalles.</p><br>
    <p>Tipo: Radicado.</p>
    <p>Tipo de radicado: $tipo.</p>
    <p>Numero de radicado: " . $radicado->getId() . "</p>
    <p>Sucursal: " . $radicado->getSucursal() . "</p>
    <p>Telefono: " . $radicado->getTelefono() . "</p>";
    if ($radicado->getUtc() != 0)
        $body .= "<p>Utc: " . $radicado->getUtc() . "</p>";
    $body .= "<p>Radicado creado por: " . $oficial['name'] . "</p>
    <p>Fecha de creaci&oacute;n: " . $radicado->getFecha_creacion() . "</p>";
    if ($items = $radicado->getItemsDeRadicado()) {
        $body .= "<p>Detalle de estados para los clientes enviados en este radicado:</p><br>";
        foreach ($items as $cliente) {
            $body .= "<p>" . $cliente['rownum'] . ": " . $cliente['descripcion'] . " con documento # " . $cliente['documento'];
            if ($cliente['estado'] == 3) {
                $body .= ", <strong>" . getEstados($cliente['estado']) . " por las siguientes razones:</strong></p>";
                if ($devolucion = $radicado->getDevolucion($cliente['documento'])) {
                    $body .= "<ul type='disk'><li>" . $devolucion['causal'] . ": " . str_replace('<br>', ', ', $devolucion['observation']) . "</li></ul>";
                }
            } else {
                $body .= ", <strong>" . getEstados($cliente['estado']) . "</strong>";
            }
            $body .= "</p>";
        }
    }
    $body .= "<br>
    <p>En el caso de existir devoluciones, <strong>recuerde que el hecho de no legalizar las devoluciones por parte suya implicara que la sucursal obtenga una mala calificación en la nota del convenio contratado con la Unidad de Negocio y adicionalmente, esta gestión se presentará en los comités respectivos.</strong></p>
    <p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";

    $mail->IsSendmail();

    $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
    $mail->Subject = "Resultado de su radicado en Doc Finder.";

    $mail->MsgHTML($body);
    if (isset($oficial['email'])) {
        $address = $oficial['email'];
        $mail->AddAddress($address, $oficial['name']);
    }
    $mail->AddAddress("jackeline.gutierrez@ui.colpatria.com", "Jackeline Gutierrez");
    $mail->AddAddress("operacioncolpatria@finlecobpo.com", "Operacion Colpatria Doc Finder");

    if (isset($oficial['email_father']) && $oficial['email_father'] != "")
        $mail->AddCC($oficial['email_father']);

    if (!$mail->Send()) {
        return "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return "ok";
    }
}

function devolverRadicadoForm($request) {
    $radicado = new Radicados();
    $radicado->setId($request['radicado_id']);
    if ($radicado->getRadicado()) {
        $observacion = '';
        $cont = 0;
        foreach ($request['observation'] as $observation) {
            if ($cont == 0)
                $observacion .= $observation;
            else
                $observacion .= "<br>" . $observation;
            $cont++;
        }
        $cliente = Radicados::getClienteItem($request['clienteid_dev']);
        if ($radicado->insertarDevolucion($cliente, $request['causaldevolucion'], $observacion, $request['persontype']))
            echo json_encode(array('exito' => 'Devolucion guardada satisfactoriamente.'));
        else
            echo json_encode(array('errorr' => 'No se pudo guardar la devolucion.'));
    } else
        echo json_encode(array('errorr' => 'No se pudo cargar la informacion del radicado.'));
    //print_r($request);
}

function enviarMailRecordatorio($request) {
    if (!Radicados::verificarNotificacionDia()) {
        if ($oficiales = Radicados::radicadosNoAprobados()) {
            foreach ($oficiales as $oficial) {
                if ($oficial['dias_atrazo'] < 13)
                    $resp = enviarMailOficial($oficial);
                else {
                    if (Radicados::cancelRadicado($oficial['id_radicado'])) {
                        $resp = enviarMailCancelado($oficial);
                    }
                }
            }
            Radicados::insertarNotificacionDia();
        }
    }
}

function enviarMailOficial($oficial) {
    $mail = new PHPMailer();
    $body = "
    <p>" . $oficial['name'] . ", usted tiene el radicado #" . $oficial['id_radicado'] . " con " . $oficial['dias_atrazo'] . " dia(s) de retrazo.</p><br>
    <p>Los documentos físicos de los clientes de esta radicación aun no han llegado a FinlecoBPO, por lo tanto no se tendrán en cuenta para efectos de gestión</p>
    <p>Verifique con servicios de información de Colpatria el motivo de este retraso, para no seguir recibiendo esta notificación.</p><br><br>
    <p>Se envio una copia de este correo a las personas lideres de este proceso con Fecha de creación: " . date("Y-m-d h:m:s a") . "</p><br>    
    <p><strong>Le informamos que el radicado generado para estos clientes quedará en estado no enviado después de 10 días de su radicación, por lo tanto deberá efectuar el proceso de radicación de esto documentos nuevamente.</strong></p>
    <p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";

    $mail->IsSendmail();

    $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
    $mail->Subject = "Recordatorio documentos no enviados a FinlecoBPO.";

    $mail->MsgHTML($body);
    if (isset($oficial['email'])) {
        $address = $oficial['email'];
        $mail->AddAddress($address, $oficial['name']);
    }
    $mail->AddAddress("jackeline.gutierrez@ui.colpatria.com", "Jackeline Gutierrez");
    $mail->AddAddress("operacioncolpatria@finlecobpo.com", "Operacion Colpatria Doc Finder");
    //$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel Chico P.");

    if (isset($oficial['email_father']) && $oficial['email_father'] != "")
        $mail->AddCC($oficial['email_father']);

    if (!$mail->Send()) {
        return "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return "ok";
    }
}

function enviarMailCancelado($oficial) {
    $mail = new PHPMailer();
    $body = "
	<p>" . $oficial['name'] . ", su radicado #" . $oficial['id_radicado'] . " se cancelo, teniendo en cuenta que han pasado 13 días desde su fecha de radicación y aun no han llegado los documentos físicos para este radicado.</p>
	<p><strong>Le informamos que para hacer el envió de los físicos de estos clientes se hace necesario que efectué un nuevo radicado.</strong></p>
	<p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";

    $mail->IsSendmail();

    $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'Operacion Colpatria Doc Finder');
    $mail->Subject = "Radicado cancelado, aplicativo Doc Finder.";

    $mail->MsgHTML($body);
    if (isset($oficial['email'])) {
        $address = $oficial['email'];
        $mail->AddAddress($address, $oficial['name']);
    }
    $mail->AddAddress("jackeline.gutierrez@ui.colpatria.com", "Jackeline Gutierrez");
    $mail->AddAddress("operacioncolpatria@finlecobpo.com", "Operacion Colpatria Doc Finder");
    //$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel Chico P.");

    if (isset($oficial['email_father']) && $oficial['email_father'] != "")
        $mail->AddCC($oficial['email_father']);

    if (!$mail->Send()) {
        return "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return "ok";
    }
}

function cargarArchivo($request) {
    //echo $request['FILE']['load_file']['name'][3];
    /* $sal = json_encode($_FILES);
      echo "<script>parent.alert('$sal');</script>";
      exit(); */
    //echo $request['FILE']['archivo']['tmp_name'];
    //echo "<script>parent.$.fn.pruebaTag();</script>";
    //exit();
    $dir_suc = trim($request['sucursal_sub']);
    $sucursal = str_replace(' ', '_', trim($dir_suc));
    $doc = $request['documento_sub'];
    $docMulti = $sucursal . "_" . $doc . "_MULTI.tiff";
    $upload_folder = DS . 'var' . DS . 'www' . DS . 'html' . DS . 'Colpatria' . DS . 'virtuales_doc' . DS . 'virtuales' . DS;
    $pathupload = $upload_folder . $sucursal . DS . $doc;
    //exec("convert ".$upload_folder.$sucursal."/*.pdf ".$upload_folder.$sucursal."/".$docMulti);
    //exit();
    $tam = count($request['FILE']['load_file']['name']);
    /* echo "<script>parent.alert($tam);</script>";
      exit(); */
    $objeto = array();
    $objeto['cantidad'] = $tam;
    $error_fo = "";
    $error_fi = "";
    for ($i = 0; $i < $tam; $i++) {
        # code...
        $namepart = explode('.', $request['FILE']['load_file']['name'][$i]);
        $tmp_archivo = $request['FILE']['load_file']['tmp_name'][$i];
        if (!file_exists($upload_folder . $sucursal)) {
            if (!mkdir($upload_folder . $sucursal)) {
                $error_fo .= "No se creo carpeta $sucursal";
            } else {
                if (!file_exists($pathupload)) {
                    if (!mkdir($pathupload))
                        $error_fo .= "No se creo carpeta $doc";
                }
            }
        }else {
            if (!file_exists($pathupload)) {
                if (!mkdir($pathupload))
                    $error_fo .= "No se creo carpeta $doc";
            }
        }
        $new_file = $pathupload . DS . strtolower($sucursal) . "_" . $doc . "_0" . (1 + $i) . "." . strtolower($namepart[1]);
        //echo $tmp_archivo.":::::::".$new_file."<br>";
        if (file_exists($new_file))
            unlink($new_file);
        if (!move_uploaded_file($tmp_archivo, $new_file)) {
            //echo json_encode(array('ok' => FALSE, 'msg' => "Ocurrio un error al subir el archivo. No pudo guardarse.", 'status' => 'error'));
            //exit();
            $error_fi .= "No se creo subio file " . $namepart[0];
        }
        //echo json_encode(array('ok' => TRUE));
    }
    if ($error_fo != "")
        $objeto['er_folder'] = $error_fo;
    if ($error_fi != "")
        $objeto['er_file'] = $error_fi;
    if ($error_fo == "" && $error_fi == "") {
        $objeto['exito'] = "se subieron todos los archivos satisfactoriamente.";
        if (file_exists($pathupload . DS . $docMulti))
            unlink($pathupload . DS . $docMulti);

        //exec("convert ".$pathupload.DS."* -compress LZW ".$pathupload.DS.$docMulti);
        exec('convert -density 110 ' . $pathupload . DS . '* -compress LZW ' . $pathupload . DS . $docMulti);
        //exec("convert -compress ".$pathupload.DS."* ".$pathupload.DS.$docMulti);
        eliminarFileFromFolder($pathupload . DS);
        if (Radicados::inserFileRadicado($docMulti, $doc))
            $objeto['fileinserts'] = "archivos insertados en la base de datos";
    }

    $resp = json_encode($objeto);
    echo "<script>
			resp = $resp;
			parent.$.fn.archivosSubidos(resp);
		 </script>";
}

function reporteLotesPlanillas($request) {
    $fecha = $request['fecha_inicio'];
    if ($planillas = Radicados::getRadicadosDia($fecha)) {
        # code...
    }
}

function eliminarFileFromFolder($path) {
    // Abrimos la carpeta que nos pasan como parámetro
    $dir = opendir($path);
    // Leo todos los ficheros de la carpeta
    while ($elemento = readdir($dir)) {
        // Tratamos los elementos . y .. que tienen todas las carpetas
        if ($elemento != "." && $elemento != "..") {
            // Si es una carpeta
            if (!is_dir($path . $elemento)) {
                // Muestro la carpeta
                $elemp = explode('.', $elemento);
                if ($elemp[1] != 'tiff')
                    exec("rm -rf " . $path . $elemento);
                // Si es un fichero
            }
        }
    }
}

function getEstados($id) {
    switch ($id) {
        case '0':
            return 'Radicado';
            break;
        case '1':
            return 'No fue enviado';
            break;
        case '2':
            return 'Recibido';
            break;
        case '3':
            return 'Devuelto';
            break;
        case '4':
            return 'Cancelado';
            break;
    }
}

function radicadosyClientesxoficial($request) {
    //print_r($request);
    if ($clientes = Radicados::clientesDelOficial($request['fecha_inicio'], $request['fecha_fin'])) {
        echo json_encode(array('exito' => 'Devolucion guardada satisfactoriamente.', 'items' => $clientes));
    } else
        echo json_encode(array('errorr' => 'No se pudo guardar la devolucion.'));
}

function radicadosyClientesxSucursal($request) {
    if ($clientes = Radicados::clientesDelOficialSucursal($request['fecha_inicio'], $request['fecha_fin'], $request['sucursales'])) {//
        echo json_encode(array('exito' => 'Devolucion guardada satisfactoriamente.', 'items' => $clientes));
    } else
        echo json_encode(array('errorr' => 'No se pudo guardar la devolucion.'));
}

function radicadosyClientesxOfficial($request) {
    if ($clientes = Radicados::clientesDelOficialOficial($request['fecha_inicio'], $request['fecha_fin'], $request['oficiales'])) {//
        echo json_encode(array('exito' => 'Devolucion guardada satisfactoriamente.', 'items' => $clientes));
    } else
        echo json_encode(array('errorr' => 'No se pudo guardar la devolucion.'));
}

?>