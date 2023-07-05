<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(0);
ini_set("log_errors", 1);

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'radicados.class.php';
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$action = $_POST['action'];
if ($action == 'cargarArchivo' || $action == 'creaciondeRadicadoMasivo') {
    $_POST['FILE'] = $_FILES;
}
call_user_func($action, $_POST);

function creaciondeRadicado($request) {
    if(!isset($_SESSION['id']) || empty($_SESSION['id']) || $_SESSION['id'] === ''){
        echo json_encode(array('errorr' => 'Su sesi&oacute;n a expirado, para no perder la informaci&oacute;n que hasta el momento a procesado, por favor abra una nueva pestaña en el navegador sin cerrar esta y en &eacute;sta nueva pestaña inicie sesion, luego regrese a esta pestaña e intente crear el radicado, en caso de que no se cree el nuevo radicado, contacte con el administrador.'));
        exit();
    }
    $request['id_usuarioenvia'] = $_SESSION['id'];
    $radicado = new Radicados();
    $radicado->setAtributos($request);
    if ($radicado->registrar()) {
        $clientes = explode('|', $request['clientes']);
        $tam = count($clientes) / 3; //2
        $j = 0;
        $i = 0;
        $pas = true;
        while ($i < $tam && $pas == true) {
            if ($radicado->agregarItems($clientes[$j], $clientes[($j + 1)], $clientes[($j + 2)])) {
                $radicado->updateFilesRadicado($clientes[($j + 1)]);
                $i++;
                $j = $j + 3; //2
                $pas = true;
            } else
                $pas = false;
        }
        $email = "";
        $email = enviarMailSeguimiento($radicado); //SKRV
        $errormail = '';
        if ($email != "ok") {
            $errormail = ' pero ocurrio el siguiente error: '.$email;
        }
        if ($pas == true) {
            echo json_encode(array('exito' => 'Radicado ingresado exitosamente con sus clientes...'.$errormail, 'radicado' => $radicado));
        } else
            echo json_encode(array('errorr' => 'Ocurrio un error al momento de insertar clientes'));
    }else
        echo json_encode(array('errorr' => 'Ocurrio un error al momento de insertar el radicado'));
}

function enviarMailSeguimiento($radicado) {
    setlocale(LC_ALL,"es_CO");
    $oficial = $radicado->getOficial();
    $mail = new PHPMailer();
    $tipo = $radicado->getTipoRadicado();
    $body = "
    <p>".$oficial['name'].", usted ha creado un nuevo radicado en Doc Finder, a continuaci&oacute;n se presentan los detalles del caso.</p><br>
    <p>Tipo: Radicado.</p>
    <p>Tipo de radicado: $tipo.</p>
    <p>Numero de radicado: ".$radicado->getId()."</p>
    <p>Sucursal: ".$radicado->getSucursal()."</p>
    <p>Telefono: ".$radicado->getTelefono()."</p>";
    if ($radicado->getUtc() != 0)
        $body .= "<p>Utc: ".$radicado->getUtc()."</p>";
    $body .= "<p>Radicado creado por: ".$oficial['name']."</p>
    <p>Fecha de creaci&oacute;n: ".strftime("%A %d de %B de %Y a las %l:%M %P", strtotime($radicado->getFecha_creacion()))."</p><br>
    <p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";

    //$mail->IsSendmail();
    //indico a la clase que use SMTP
    $mail->IsSMTP();
    //permite modo debug para ver mensajes de las cosas que van ocurriendo
    //$mail->SMTPDebug = 2;
    //Debo de hacer autenticación SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    //indico el servidor de Gmail para SMTP
    $mail->Host = MAIL_HOST;
    //indico el puerto que usa Gmail
    $mail->Port = MAIL_PORT;
    //indico un usuario / clave de un usuario de gmail
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;
    //indico creador del mensaje

    $mail->SetFrom(MAIL_USER, MAIL_SUBJECT);
    $mail->Subject = "Usted tiene un nuevo radicado en Doc Finder #".$radicado->getId().".";

    $mail->MsgHTML($body);
    $mail->CharSet = 'UTF-8';
    if (isset($oficial['email']) && !empty($oficial['email'])) {
        $address = $oficial['email'];
        $mail->AddAddress($address, $oficial['name']);
    }
    //$mail->AddAddress("yeisson.munoz@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("monica.murcia@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("karol.guevara@axacolpatria.co", "Karol Yiset Guevara");
    //$mail->AddAddress("yuly.camargo@axacolpatria.co", "Yuly Carolina Camargo Duitama");
    $mail->AddAddress("leidy.vanegas@axacolpatria.co", "Leidy Yeandry VANEGAS REYES");
    //$mail->AddAddress("jenny.cardona@axacolpatria.co", "Jenny Viviana Cardona Rivera");
    $mail->AddAddress(MAIL_USER, MAIL_SUBJECT);

    if (isset($oficial['email_father']) && !empty($oficial['email_father']))
        $mail->AddCC($oficial['email_father']);

    if (!$mail->Send()) {
        return "Mailer Error: ".$mail->ErrorInfo;
    } else {
        return "ok";
    }
}

function busquedadeRadicado($request) {
    $radicado = new Radicados();
    $radicado->setId($request['id']);
    if (!$radicado->getRadicado()) {
        echo json_encode(['errorr' => 'El numero de radicado que intenta buscar no ha sido aun creado']);
    }
    $sucursal = $radicado->getSucursal();
    $funcionario = $radicado->getFuncionario();
    if ($items = $radicado->getItemsDeRadicado(str_replace(" ", "_", $sucursal))) {
        echo json_encode(['exito' => 'Radicado encontrado', 'radicado' => $radicado, 'sucursal' => $sucursal, 'funcionario' => $funcionario, 'items' => $items]);
    } else {
        echo json_encode(['exito' => 'Radicado encontrado', 'radicado' => $radicado, 'sucursal' => $sucursal, 'funcionario' => $funcionario, 'erroritems' => 'no se encontraron items']);
    }
}

function aprobarClientes($request) 
{
    $rep = true;
    $virt = false;
    $strCli = '';
    $pos_cli = '';
    $radicado = new Radicados();
    $radicado->setId($request['id_radicado']);
    //$radicado->setLote($request['lote']);
    $radicado->setId_usuariorecibido($_SESSION['id']);
    if (!isset($request['fecha_envio']) || trim($request['fecha_envio']) === '') {
        echo json_encode(['errorr' => 'La fecha de envio no fue digitada, por favor verificar o comunicarse con el administrador.']);
        exit;
    }
    if (isset($request['tipo_radicadoR']) && ($request['tipo_radicadoR'] == '1' || $request['tipo_radicadoR'] == '5')) {
        $part = explode(' ', $request['fecha_creacionR']);
        $fecha_creR = $part[0];
        $radicado->setFecha_envio($fecha_creR);
    } else if ($request['tipo_radicadoR'] != '1' && $request['tipo_radicadoR'] != '5') {
        $radicado->setFecha_envio($request['fecha_envio']);
    }

    if( isset($request['observacion']) && !empty($request['observacion'])) {
        $radicado->setObservacion(trim(preg_replace("/\s+/", " ", $request['observacion'])));
    }

    if ($radicado->aprobarOrden()) {
        echo json_encode(['errorr' => 'Ocurrio un error en el momento de aprobacion del radicado\\n comuniquese con el administrador del sistema para solucionarlo']);
        exit;
    }
    if (!isset($request['cliente'])) {
        echo json_encode(['exito' => 'El radicado fue aprovado, pero sin clientes anexos']);
        exit;
    }
    $i = 1;
    if (in_array($radicado->getTipo(), [1, 5, 6])) {
        $virt = true;
        $sucu_ = str_replace(" ", "_", $radicado->getSucursal());
        $id_ = $radicado->getId();
    }
    foreach ($request['cliente'] as $cliente) {
        $cliitem = explode('|', $cliente);
        $estado = $cliitem[1];
        if ($virt && $cliitem[1] == '2') {
            $imas = $i;

            $pos_cli = strlen($imas) > 1 ? $i : "0" . $i;

            $error_fo = "";
            $cli_fil = Radicados::getClienteItem($cliitem[0]);
            if ($radicado->updateFilesRadicadoNombre($cli_fil['documento'], $pos_cli)) {
                $upload_folder = '/var/www/html/Aplicativos.Serverfin04/Colpatria/virtuales_doc/virtuales';
                $upload_folder_ = '/var/www/html/Aplicativos.Serverfin04/Colpatria/virtuales_doc/virtuales_aceptados';
                if (!file_exists($upload_folder_ . "/" . $sucu_)) {
                    if (!mkdir($upload_folder_ . "/" . $sucu_))
                        $error_fo .= "No se creo carpeta " . $cli_fil['documento'];
                    else
                        chown($upload_folder_ . "/" . $sucu_, 'apache');
                } else {
                    chown($upload_folder_ . "/" . $sucu_, 'apache');
                }
                $pathSucDoc = $upload_folder . "/" . $sucu_ . "/" . $cli_fil['documento'] . "/" . $sucu_ . "_" . $cli_fil['documento'];
                if (file_exists($pathSucDoc . "_TODO.pdf")) {
                    rename($pathSucDoc . "_TODO.pdf", $upload_folder_ . "/" . $sucu_ . "/LOTE_" . $id_ . "_" . $pos_cli . ".pdf");
                } else if (file_exists($pathSucDoc . "_MULTI.tiff")) {
                    rename($pathSucDoc . "_MULTI.tiff", $upload_folder_."/" . $sucu_ . "/LOTE_" . $id_ . "_" . $pos_cli . ".tiff");
                } else {
                    $estado = '1';
                }
            }
        }

        if (!$radicado->aprobarCliente($cliitem[0], $estado)) {
            $rep = false;
            $strCli .= $cliitem[0].", ";
        }
        $i++;
    }
    $email = enviarMailAprobacion($radicado);
    echo $rep 
        ? json_encode(['exito' => 'Los clientes fueron aprobados exitosamente...'])
        : json_encode(array('errorr' => 'Los clientes con cedula '.$strCli.'no pudieron ser aprovados,\\n comuniquese con el administrador del sistema'));
    exit;
}

function enviarMailAprobacion($radicado) {
    setlocale(LC_ALL,"es_CO");
    $oficial = $radicado->getOficial();
    $mail = new PHPMailer();
    $tipo = $radicado->getTipoRadicado();
    $body = "
    <p>".$oficial['name'].", el radicado que creo el ".strftime("%A %d de %B de %Y a las %l:%M %P", strtotime($radicado->getFecha_creacion())).", fue recibido, a continuacion los detalles.</p><br>
    <p>_________________________________________________________</p>
    <p>|                                                        |</p>
    <p>|     SUJETO A VERIFICACION PARA LOS FORMULARIOS DE      |
    <p>|     ACUTALIZACION DE DATOS Y RENOVACION DE AUTOS.      |</P>
    <P>|							                            |</P>
    <P>__________________________________________________________</P>
    <p>Tipo: Radicado.</p>
    <p>Tipo de radicado: $tipo.</p>
    <p>Numero de radicado: ".$radicado->getId()."</p>
    <p>Sucursal: ".$radicado->getSucursal()."</p>
    <p>Telefono: ".$radicado->getTelefono()."</p>";
    if ($radicado->getUtc() != 0)
        $body .= "<p>Utc: ".$radicado->getUtc()."</p>";
    $body .= "<p>Radicado creado por: ".$oficial['name']."</p>
    <p>Fecha de creaci&oacute;n: ".strftime("%A %d de %B de %Y a las %l:%M %P", strtotime($radicado->getFecha_creacion()))."</p>";
    if ($items = $radicado->getItemsDeRadicado()) {
        $body .= "<p>Detalle de estados para los clientes enviados en este radicado:</p><br>";
        foreach ($items as $cliente) {
            $body .= "<p>".$cliente['rownum'].": ".$cliente['descripcion']." con documento # ".$cliente['documento'];
            if ($cliente['estado'] == 3) {
                $body .= ", <strong>".getEstados2($cliente['estado'], $radicado->getTipo())." por las siguientes razones:</strong></p>";
                if ($devolucion = $radicado->getDevolucion($cliente['documento'])) {
                    $body .= "<ul type='disk'><li>".$devolucion['causal'].": ".str_replace('<br>', ', ', $devolucion['observation'])."</li></ul>";
                }
            } else {
                $body .= ", <strong>".getEstados2($cliente['estado'], $radicado->getTipo())."</strong>";
            }
            $body .= "</p>";
        }
    }
    $body .= "<br>";
    if(!is_null($radicado->getObservacion()) && !empty($radicado->getObservacion())){
         $body .= "<p>Observacion del radicado: ".$radicado->getObservacion()."</p><br>";
    }
    $body .= "<p>En el caso de existir devoluciones, <strong>recuerde que el hecho de no legalizar las devoluciones por parte suya implicara que la sucursal obtenga una mala calificación en la nota del convenio contratado con la Unidad de Negocio y adicionalmente, esta gestión se presentará en los comités respectivos.</strong></p>
    <p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";

    //$mail->IsSendmail();
    //indico a la clase que use SMTP
    $mail->IsSMTP();
    //permite modo debug para ver mensajes de las cosas que van ocurriendo
    //$mail->SMTPDebug = 2;
    //Debo de hacer autenticación SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    //indico el servidor de Gmail para SMTP
    $mail->Host = MAIL_HOST;
    //indico el puerto que usa Gmail
    $mail->Port = MAIL_PORT;
    //indico un usuario / clave de un usuario de gmail
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;
    //indico creador del mensaje

    $mail->SetFrom(MAIL_USER, MAIL_SUBJECT);
    $mail->Subject = "Resultado de su radicado en Doc Finder #".$radicado->getId().".";

    $mail->MsgHTML($body);
    $mail->CharSet = 'UTF-8';
    if (isset($oficial['email']) && !empty($oficial['email'])) {
        $address = $oficial['email'];
        $mail->AddAddress($address, $oficial['name']);
    }
    //$mail->AddAddress("yeisson.munoz@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("monica.murcia@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("karol.guevara@axacolpatria.co", "Karol Yiset Guevara");
    //$mail->AddAddress("yuly.camargo@axacolpatria.co", "Yuly Carolina Camargo Duitama");
    $mail->AddAddress("leidy.vanegas@axacolpatria.co", "Leidy Yeandry VANEGAS REYES");
    //$mail->AddAddress("jenny.cardona@axacolpatria.co", "Jenny Viviana Cardona Rivera");
    $mail->AddAddress(MAIL_USER, MAIL_SUBJECT);


    if (isset($oficial['email_father']) && !empty($oficial['email_father']) && filter_var($oficial['email_father'], FILTER_VALIDATE_EMAIL))
        $mail->AddCC($oficial['email_father']);

    if (!$mail->Send()) {
        return "Mailer Error: ".$mail->ErrorInfo;
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
                $observacion .= "<br>".$observation;
            $cont++;
        }
        $cliente = Radicados::getClienteItem($request['clienteid_dev']);
        if ($radicado->insertarDevolucion($cliente, $request['causaldevolucion'], $observacion, $request['persontype'])){
            $emailResp = enviarMailDevuelto($radicado, $cliente);
            echo json_encode(array('exito' => 'Devolucion guardada satisfactoriamente.'));
        }
        else
            echo json_encode(array('errorr' => 'No se pudo guardar la devolucion.'));
    } else
        echo json_encode(array('errorr' => 'No se pudo cargar la informacion del radicado.'));
    //print_r($request);
}

function enviarMailDevuelto($radicado, $cliente) {
    setlocale(LC_ALL,"es_CO");
    $oficial = $radicado->getOficial();
    $tipo = $radicado->getTipoRadicado();
    $body = "
    <p>".$oficial['name'].", el radicado que creo el ".strftime("%A %d de %B de %Y a las %l:%M %P", strtotime($radicado->getFecha_creacion())).", tuvo un cambio de estado, en el cliente con numero de documento ".$cliente['documento'].", a continuacion los detalles.</p><br>
    <p>_________________________________________________________</p>
    <p>|                                                        |</p>
    <p>|     SUJETO A VERIFICACION PARA LOS FORMULARIOS DE      |
    <p>|     ACUTALIZACION DE DATOS Y RENOVACION DE AUTOS.      |</P>
    <P>|                                                        |</P>
    <P>__________________________________________________________</P>
    <p>Tipo: Radicado.</p>
    <p>Tipo de radicado: $tipo.</p>
    <p>Numero de radicado: ".$radicado->getId()."</p>
    <p>Sucursal: ".$radicado->getSucursal()."</p>
    <p>Telefono: ".$radicado->getTelefono()."</p>";
    if ($radicado->getUtc() != 0)
        $body .= "<p>Utc: ".$radicado->getUtc()."</p>";
    $body .= "<p>Radicado creado por: ".$oficial['name']."</p>
    <p>Fecha de creaci&oacute;n: ".strftime("%A %d de %B de %Y a las %l:%M %P", strtotime($radicado->getFecha_creacion()))."</p>";
    $body .= "<p>Detalle del cambio de estado:</p><br>";
    $body .= "<p>".$cliente['descripcion']." con documento # ".$cliente['documento'];
    $body .= ", <strong>".getEstados2('3', $radicado->getTipo())." por las siguientes razones:</strong></p>";
    if($devolucion = $radicado->getDevolucion($cliente['documento'])){
        $body .= "<ul type='disk'><li>".$devolucion['causal'].": ".str_replace('<br>', ', ', $devolucion['observation'])."</li></ul>";
    }
    $body .= "</p>";
    $body .= "<br>
    <p>En el caso de existir devoluciones, <strong>recuerde que el hecho de no legalizar las devoluciones por parte suya implicara que la sucursal obtenga una mala calificación en la nota del convenio contratado con la Unidad de Negocio y adicionalmente, esta gestión se presentará en los comités respectivos.</strong></p>
    <p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";


    $mail = new PHPMailer();

    //$mail->IsSendmail();
    //indico a la clase que use SMTP
    $mail->IsSMTP();
    //permite modo debug para ver mensajes de las cosas que van ocurriendo
    //$mail->SMTPDebug = 2;
    //Debo de hacer autenticación SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    //indico el servidor de Gmail para SMTP
    $mail->Host = MAIL_HOST;
    //indico el puerto que usa Gmail
    $mail->Port = MAIL_PORT;
    //indico un usuario / clave de un usuario de gmail
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;
    //indico creador del mensaje

    $mail->SetFrom(MAIL_USER, MAIL_SUBJECT);
    $mail->Subject = "Radicado #".$radicado->getId()." cambio de estado, aplicativo Doc Finder.";

    $mail->MsgHTML($body);
    $mail->CharSet = 'UTF-8';
    if (isset($oficial['email']) && !empty($oficial['email'])) {
        $address = $oficial['email'];
        $mail->AddAddress($address, $oficial['name']);
    }
    //$mail->AddAddress("yeisson.munoz@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("monica.murcia@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("karol.guevara@axacolpatria.co", "Karol Yiset Guevara");
    //$mail->AddAddress("yuly.camargo@axacolpatria.co", "Yuly Carolina Camargo Duitama");
    $mail->AddAddress("leidy.vanegas@axacolpatria.co", "Leidy Yeandry VANEGAS REYES");
    ////$mail->AddAddress("jenny.cardona@axacolpatria.co", "Jenny Viviana Cardona Rivera");
    $mail->AddAddress(MAIL_USER, MAIL_SUBJECT);
    //$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel Chico P.");

    if (isset($oficial['email_father']) && !empty($oficial['email_father']) && filter_var($oficial['email_father'], FILTER_VALIDATE_EMAIL))
        $mail->AddCC($oficial['email_father']);

    if (!$mail->Send()) {
        return "Mailer Error: ".$mail->ErrorInfo;
    } else {
        return "ok";
    }
}

function enviarMailRecordatorio($request) {
    if (!Radicados::verificarNotificacionDia()) {
        if ($oficiales = Radicados::radicadosNoAprobados()) {
            foreach ($oficiales as $oficial) {
                if ($oficial['dias_atrazo'] < 13) {
                    $resp = enviarMailOficial($oficial); //SKRV
                }else {
                    if (Radicados::cancelRadicado($oficial['id_radicado'])) {
                        $resp = enviarMailCancelado($oficial); //SKRV
                    }
                }
            }
            Radicados::insertarNotificacionDia();
        }
    }
}

function enviarMailOficial($oficial) {
    setlocale(LC_ALL,"es_CO");
    $mail = new PHPMailer();
    $body = "
    <p>".$oficial['name'].", usted tiene el radicado #".$oficial['id_radicado']." con ".$oficial['dias_atrazo']." dia(s) de retraso.</p><br>
    <p>Los documentos físicos de los clientes de esta radicación aun no han llegado a FinlecoBPO, por lo tanto no se tendrán en cuenta para efectos de gestión</p>
    <p>Verifique con servicios de información de Colpatria el motivo de este retraso, para no seguir recibiendo esta notificación.</p><br><br>
    <p>Se envio una copia de este correo a las personas lideres de este proceso con Fecha de creación: ".strftime("%A %d de %B de %Y a las %l:%M %P", strtotime(date("Y-m-d h:m:s a")))."</p><br>    
    <p><strong>Apreciado Usuario le informamos que a la fecha no se han recibido los soportes del radicado ".$oficial['id_radicado'].". Recuerde que el plazo máximo para la recepción de documentos es de 13 días y solo quedan ".(13 - intval($oficial['dias_atrazo']))." para normalizar los soportes.  Vencido este plazo, el sistema automáticamente cancelara el trámite y  deberá efectuar nuevamente el proceso de radicación.</strong></p>
    <p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";

    //$mail->IsSendmail();
    //indico a la clase que use SMTP
    $mail->IsSMTP();
    //permite modo debug para ver mensajes de las cosas que van ocurriendo
    //$mail->SMTPDebug = 2;
    //Debo de hacer autenticación SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    //indico el servidor de Gmail para SMTP
    $mail->Host = MAIL_HOST;
    //indico el puerto que usa Gmail
    $mail->Port = MAIL_PORT;
    //indico un usuario / clave de un usuario de gmail
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;
    //indico creador del mensaje

    $mail->SetFrom(MAIL_USER, MAIL_SUBJECT);
    $mail->Subject = "Recordatorio documentos no enviados a FinlecoBPO del radicado #".$oficial['id_radicado'].".";

    $mail->MsgHTML($body);
    $mail->CharSet = 'UTF-8';
    if (isset($oficial['email']) && !empty($oficial['email'])) {
        $address = $oficial['email'];
        $mail->AddAddress($address, $oficial['name']);
    }
    //$mail->AddAddress("yeisson.munoz@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("monica.murcia@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("karol.guevara@axacolpatria.co", "Karol Yiset Guevara");
    //$mail->AddAddress("yuly.camargo@axacolpatria.co", "Yuly Carolina Camargo Duitama");
    $mail->AddAddress("leidy.vanegas@axacolpatria.co", "Leidy Yeandry VANEGAS REYES");
    ////$mail->AddAddress("jenny.cardona@axacolpatria.co", "Jenny Viviana Cardona Rivera");
    $mail->AddAddress(MAIL_USER, MAIL_SUBJECT);
    //$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel Chico P.");

    if (isset($oficial['email_father']) && !empty($oficial['email_father']) && filter_var($oficial['email_father'], FILTER_VALIDATE_EMAIL))
        $mail->AddCC($oficial['email_father']);

    if (!$mail->Send()) {
        return "Mailer Error: ".$mail->ErrorInfo;
    } else {
        return "ok";
    }
}

function enviarMailCancelado($oficial) {
    setlocale(LC_ALL,"es_CO");
    $mail = new PHPMailer();
    $body = "
	<p>".$oficial['name'].", su radicado #".$oficial['id_radicado']." se cancelo, teniendo en cuenta que han pasado 13 días desde su fecha de radicación y aun no han llegado los documentos físicos para este radicado.</p>
	<p><strong>Le informamos que para hacer el envió de los físicos de estos clientes se hace necesario que efectué un nuevo radicado.</strong></p>
	<p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";

    //$mail->IsSendmail();
    //indico a la clase que use SMTP
    $mail->IsSMTP();
    //permite modo debug para ver mensajes de las cosas que van ocurriendo
    //$mail->SMTPDebug = 2;
    //Debo de hacer autenticación SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    //indico el servidor de Gmail para SMTP
    $mail->Host = MAIL_HOST;
    //indico el puerto que usa Gmail
    $mail->Port = MAIL_PORT;
    //indico un usuario / clave de un usuario de gmail
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;
    //indico creador del mensaje

    $mail->SetFrom(MAIL_USER, MAIL_SUBJECT);
    $mail->Subject = "Radicado #".$oficial['id_radicado']." cancelado, aplicativo Doc Finder.";

    $mail->MsgHTML($body);
    $mail->CharSet = 'UTF-8';
    if (isset($oficial['email']) && !empty($oficial['email'])) {
        $address = $oficial['email'];
        $mail->AddAddress($address, $oficial['name']);
    }
    //$mail->AddAddress("yeisson.munoz@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("monica.murcia@axacolpatria.co", "Yeison Alexander Munoz");
    //$mail->AddAddress("karol.guevara@axacolpatria.co", "Karol Yiset Guevara");
    //$mail->AddAddress("yuly.camargo@axacolpatria.co", "Yuly Carolina Camargo Duitama");
    $mail->AddAddress("leidy.vanegas@axacolpatria.co", "Leidy Yeandry VANEGAS REYES");
    //$mail->AddAddress("jenny.cardona@axacolpatria.co", "Jenny Viviana Cardona Rivera");
    $mail->AddAddress(MAIL_USER, MAIL_SUBJECT);
    //$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel Chico P.");

    if (isset($oficial['email_father']) && !empty($oficial['email_father']) && filter_var($oficial['email_father'], FILTER_VALIDATE_EMAIL))
        $mail->AddCC($oficial['email_father']);

    if (!$mail->Send()) {
        return "Mailer Error: ".$mail->ErrorInfo;
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
    //error_log("DATOS: ".json_encode($request), 0);
    $tamano = '500x500';
    $dir_suc = trim($request['sucursal_sub']);
    $sucursal = str_replace(' ', '_', trim($dir_suc));
    $doc = $request['documento_sub'];
    $docMulti = $sucursal."_".$doc."_MULTI.tiff";
    $upload_folder = DS.'var'.DS.'www'.DS.'html'.DS.'Aplicativos.Serverfin04'.DS.'Colpatria'.DS.'virtuales_doc'.DS.'virtuales'.DS;

    if($doc == '1128266841' || $doc == '1023891255')
        $tamano = '400x400';

    $pathupload = $upload_folder.$sucursal.DS.$doc;
    //exec("convert ".$upload_folder.$sucursal."/*.pdf ".$upload_folder.$sucursal."/".$docMulti);
    //exit();
    $tam = count($request['FILE']['load_file']['name']);
    /* echo "<script>parent.alert($tam);</script>";
      exit(); */
    $objeto = array();
    $sizes = array();
    $objeto['cantidad'] = $tam;
    $error_fo = "";
    $error_fi = "";
    $pdfFiles = array();
    $sonPdfs = true;
    for ($i = 0; $i < $tam; $i++) {
        # code...
        $sizes[] = $request['FILE']['load_file']['size'][$i];
        $namepart = explode('.', $request['FILE']['load_file']['name'][$i]);
        $tmp_archivo = $request['FILE']['load_file']['tmp_name'][$i];
        if (!file_exists($upload_folder.$sucursal)) {
            if (!mkdir($upload_folder.$sucursal)) {
                $error_fo .= "No se creo carpeta $sucursal {1} $upload_folder$sucursal";
            } else {
                chown($upload_folder.$sucursal, 'apache');
                if (!file_exists($pathupload)) {
                    if (!mkdir($pathupload))
                        $error_fo .= "No se creo carpeta $doc {2}";
                    chown($pathupload, 'apache');
                }
            }
        }else {
            if (!file_exists($pathupload)) {
                if (!mkdir($pathupload))
                    $error_fo .= "No se creo carpeta $doc {3}";
                chown($pathupload, 'apache');
            }
        }
        $new_file = $pathupload.DS.strtolower($sucursal)."_".$doc."_0".(1 + $i).".".strtolower($namepart[(count($namepart) - 1)]);
        //echo $tmp_archivo.":::::::".$new_file."<br>";
        if (file_exists($new_file))
            unlink($new_file);
        if (!move_uploaded_file($tmp_archivo, $new_file)) {
            //echo json_encode(array('ok' => FALSE, 'msg' => "Ocurrio un error al subir el archivo. No pudo guardarse.", 'status' => 'error'));
            //exit();
            $error_fi .= "No se creo subio file: ".$request['FILE']['load_file']['name'][$i];
        }else{
            if(mime_content_type($new_file) == 'application/pdf')
                $pdfFiles[] = $new_file;
            else
                $sonPdfs = false;
        }
        //echo json_encode(array('ok' => TRUE));
    }
    if($sonPdfs === false){
        if ($error_fo != "")
            $objeto['er_folder'] = $error_fo;
        $objeto['er_file'] = "Uno de los archivos que esta intentando cargar no es un archivo con formato PDF, por favor verifique la carga.";
        $resp = json_encode($objeto);
        echo "<script>
                resp = $resp;
                parent.$.fn.archivosSubidos(resp);
             </script>";
             exit;
    }
    $pathConvertir = $pathupload.DS.'*';
    $pdfFileOut = strtoupper($sucursal)."_".$doc."_TODO.pdf";
    if(!empty($pdfFiles)){
        $pdfStr = implode(' ', $pdfFiles);

        $strSalida2 = exec('/usr/bin/gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile='.$pathupload.DS.$pdfFileOut.' '.$pdfStr.' 2>&1', $resultExec2, $intExec2);

        if(($intExec2 == 0) && (strpos(strtolower($strSalida2), 'error') === false && strpos(strtolower(json_encode($resultExec2)), 'error') === false)){
            foreach ($pdfFiles as $pdfFile) {
                unlink($pdfFile);
            }
            $pathConvertir = $pathupload.DS.$pdfFileOut;
        }else{
            $fh2 = fopen(DS.'var'.DS.'www'.DS.'html'.DS.'Aplicativos.Serverfin04'.DS.'Colpatria'.DS.'lib'.DS.'errores_conversionPDF_salida.log', "a");
            fputcsv($fh2, array('Error_conversion', date('Y-m-d H:i:s'), $pdfFileOut, json_encode(scandir($pathupload)), json_encode($resultExec2), $strSalida2), '|');
            fclose($fh2);
        }
    }
    $pasaPeso = false;
    foreach($sizes as $key => $value){
        if($value > 921600)
            $pasaPeso = true;
    }
    if($pasaPeso === true)
        $tamano = '400x400';

    if ($error_fo != "")
        $objeto['er_folder'] = $error_fo;
    if ($error_fi != "")
        $objeto['er_file'] = $error_fi;
    if ($error_fo == "" && $error_fi == "") {
        $objeto['exito'] = "se subieron todos los archivos satisfactoriamente.";
        if (file_exists($pathupload.DS.$docMulti))
            unlink($pathupload.DS.$docMulti);

        //exec("convert ".$pathupload.DS."* -compress LZW ".$pathupload.DS.$docMulti);
        $arraySalida = array();
        //$errorSalida = exec('convert -density 110 '.$pathupload.DS.'* -compress LZW '.$pathupload.DS.$docMulti, $arraySalida);
        //$errorSalida = exec('/usr/bin/gs -SDEVICE=tiffg4 -r500x500 -sPAPERSIZE=a4 -sOutputFile='.$pathupload.DS.$docMulti.' -dNOPAUSE -dBATCH '.$pathupload.DS.'*', $arraySalida);
        //$errorSalida = exec('/usr/bin/gs -SDEVICE=tiffg4 -r'.$tamano.' -sPAPERSIZE=a4 -sOutputFile='.$pathupload.DS.$docMulti.' -dNOPAUSE -dBATCH '.$pathupload.DS.'*', $arraySalida);
        //$errorSalida = exec('/usr/bin/gs -SDEVICE=tiffg4 -r600x600 -sPAPERSIZE=a4 -sOutputFile='.$pathupload.DS.$docMulti.' -dNOPAUSE -dBATCH '.$pathConvertir, $arraySalida);

        if(!empty($arraySalida)){
            $fh = fopen(DS.'var'.DS.'www'.DS.'html'.DS.'Aplicativos.Serverfin04'.DS.'Colpatria'.DS.'lib'.DS.'errores_conversion_salida.log', "a");
            fputcsv($fh, array('Error_conversion', date('Y-m-d H:i:s'), $docMulti, json_encode(scandir($pathupload)), json_encode($arraySalida)), '|');
            fclose($fh);
            //unset($arraySalida);
        }
        //exec("convert -compress ".$pathupload.DS."* ".$pathupload.DS.$docMulti);
        //eliminarFileFromFolder($pathupload.DS);
        if (Radicados::inserFileRadicado($docMulti, $doc, $pdfFileOut, $pathupload))
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
function verificarCambioEstadoRadicado($request){
    //echo json_encode($request);exit;
    if($item = Radicados::verificarCambioEstadoRadicado($request['documento'], $request['id'])){
		if(is_array($item)){
			echo json_encode(array('exito'=>'Se encontraron los datos', 'item'=>$item));
		}else{
			echo json_encode(array('exito'=>$item));
		}
    }else{
        echo json_encode(array('error'=>'Ocurrio un error por favor contacte con el administrador.'));
    }
}
function cambioEstadoRadicadoCliente($request){
    if(Radicados::cambiarEstadoItemRadicado($request['id'], $request['estado'])){
        echo json_encode(array('exito'=>'El estado del cliente fue cambiado exitosamente.'));
    }else{
        echo json_encode(array('error'=>'Ocurrio un error por favor contacte con el administrador.'));
    }
}

function eliminarFileFromFolder($path) {
    // Abrimos la carpeta que nos pasan como parámetro
    $dir = opendir($path);
    // Leo todos los ficheros de la carpeta
    while ($elemento = readdir($dir)) {
        // Tratamos los elementos.y .. que tienen todas las carpetas
        if ($elemento != "." && $elemento != "..") {
            // Si es una carpeta
            if (!is_dir($path.$elemento)) {
                // Muestro la carpeta
                $elemp = explode('.', $elemento);
                if ($elemp[1] != 'tiff')
                    exec("rm -rf ".$path.$elemento);
                // Si es un fichero
            }
        }
    }
}

function getEstados($id, $tipo = 0) {
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
function getEstados2($id, $tipo = 0) {
    switch ($id) {
        case '0':
            return 'Radicado';
            break;
        case '1':
            if($tipo == 0)
                return 'No llego fisico';
            elseif($tipo == 1 || $tipo == 5)
                return 'No se adjunto documento';
            else
                return 'No llego fisico';
            break;
        case '2':
            return 'Aprobado';
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

function validarCliente($id, $tipo = 0) {
    //creado por sinthia rodriguez
    $radicado = new Radicados();
    if($radicado->getValidaCliente($id['cliente'])){
        if($tipo == 0)
            echo 'Si';
        else
            return 'Si';
    }else{
        if($tipo == 0)
            echo 'No';
        else
            return 'No';
    }
}
function validarCliente2Action($request, $tipo = 0){
    echo json_encode($request);
    exit();
    if(Radicados::getValidaCliente($request['cliente'])){
        if($tipo == 0)
            echo json_encode(['exito'=> 'El cliente si tiene formularios en DocFinder.']);
        else
            return 'Si';
    }else{
        if($tipo == 0)
            echo json_encode(['error'=> 'No se puede radicar el cliente porque no tiene Formulario de Conocimiento del Cliente de Vinculación Inicial.']);
        else
            return 'No';
    }
}

function actualizaCliente($cliente) {
    //creado por sinthia rodriguez
    $radicado = new Radicados();
    $exito = false;
    $mensaje = "";
    if ($cliente["docespecial"] == 1) {
        if ($radicado->getValidaCliente($cliente["idncliente"])) {
            if ($radicado->updateRadicadoNombCliente($cliente["idncliente"], $cliente["estado"], $cliente["idradicado"], $cliente["iditem"])) {
                $exito = true;
            } else {
                $mensaje = 'Error al actualizar el cliente.';
            }
        } else {
            $mensaje = 'El cliente ingresado no tiene formato Sarlaft.';
        }
    } else {
        if ($radicado->updateRadicadoNombCliente($cliente["idncliente"], $cliente["estado"], $cliente["idradicado"], $cliente["iditem"])) {
            $exito = true;
        } else {
            $mensaje = 'Error al actualizar el cliente.';
        }
    }

    echo json_encode(array('exito' => $exito, 'error' => $mensaje));
}
function creaciondeRadicadoMasivo($request){
    //echo json_encode($request);
    //echo json_encode(array('exito'=> 'Si entro por aca'));
    //exit();
    if(!isset($_SESSION['id']) || empty($_SESSION['id']) || $_SESSION['id'] === ''){
        echo "<script>parent.alert('Su sesión a expirado, para no perder la información que hasta el momento a procesado, por favor abra una nueva pestaña en el navegador sin cerrar esta y en ésta nueva pestaña inicie sesion, luego regrese a esta pestaña e intente crear el radicado, en caso de que no se cree el nuevo radicado, contacte con el administrador.');</script>";
        exit();
    }
    if(isset($request['FILE'])){//
        if(isset($request['FILE']['file_masivo']['size']) && $request['FILE']['file_masivo']['size'] >= '1173107'){
            echo "<script>parent.alert('El archivo adjunto no debe ser mayo a 1MB');</script>";
            exit();
        }
        if(isset($request['FILE']['file_masivo']['type']) && !tipoCSV($request['FILE']['file_masivo']['type'])){
            echo "<script>parent.alert('Esta intentando adjuntar un archivo con un formato diferente al requerido');</script>";
            exit();
        }
        $tmpNamep = explode('/', $request['FILE']['file_masivo']['tmp_name']);
        $nameTmp = $tmpNamep[(count($tmpNamep) - 1)];
        $tmpName = $request['FILE']['file_masivo']['tmp_name'];

        $spreadsheet = new Spreadsheet();

        $inputFileType = 'Xlsx';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);

        //$worksheetData = $reader->listWorksheetInfo($tmpName);
        //$reader->setLoadSheetsOnly($worksheetData[0]['worksheetName']);
        $spreadsheet = $reader->load($tmpName);

        $worksheet = $spreadsheet->getActiveSheet();
        $datos = $worksheet->toArray();
        $i = 0;
        $radicado = new Radicados();
        $pas = true;
        foreach($datos as $item){
            if($i > 0){
                if(count($item) >= 4){
                    $nombre = trim(str_replace('"', '', $item[2]));
                    $cedula = trim(str_replace('"', '', $item[1]));
                    $nombre = trim(str_replace("'", "", $nombre));
                    $cedula = trim(str_replace("'", "", $cedula));
                    $especial = '0';

                    if((!empty($cedula) && strlen($cedula) > 3)){
                        if(trim(str_replace('"', '', $item[3])) == 'E'){
                            $especial = '0';
                        }elseif(trim(str_replace('"', '', $item[3])) == 'R' || trim(str_replace('"', '', $item[3])) == 'P'){
                            $especial = '1';
                            if(validarCliente(array('cliente'=> $cedula), 1) == "No")
                                $pas = false;
                        }

                        if($pas === true){
                            if($radicado->agregarItems($nombre, $cedula, $especial)){
                                $radicado->updateFilesRadicado($cedula);
                                $pas = true;
                            }else
                                $pas = false;
                        }
                        $radicado->insertarMasivo($cedula, strtolower($nombre), $especial, trim(str_replace('"', '', $item[3])), $pas);
                    }
                }
            }else{
                if(strtolower(trim(str_replace('"', '', $item[0]))) !== 'tipo documento' || strtolower(trim(str_replace('"', '', $item[1]))) !== 'documento' || strtolower(trim(str_replace('"', '', $item[2]))) !== 'nombre cliente' || strtolower(trim(str_replace('"', '', $item[3]))) !== 'tipo endoso')
                    $resp = true;


                if($resp === true){
                    echo "<script>parent.alert('La estructura del archivo no es consistente');</script>";
                    exit();
                }

                $request['id_usuarioenvia'] = $_SESSION['id'];
                $radicado->setAtributos($request);
                if(!$radicado->registrar()){
                    echo "<script>parent.alert('Ocurrio un error al momento de insertar el radicado.')</script>";
                    exit();
                }
            }
            unset($item);
            $i++;
            $pas = true;
        }
        unset($datos);
        $email = "";
        $email = enviarMailSeguimiento($radicado); //SKRV
        $errormail = '';
        if($email != "ok"){
            $errormail = ' pero ocurrio el siguiente error: '.$email;
        }
        if($pas == true){
            echo "<script>parent.alert('Radicado ingresado exitosamente con sus clientes...".$errormail."')
                        parent.$('form#creaciondeRadicadoMasivo #imgloading').hide();
                        parent.$('form#creaciondeRadicadoMasivo #botoncrearRadicado').removeAttr('disabled');
                        parent.$('form#creaciondeRadicadoMasivo').reset();
                        parent.window.location.href = '../radicado/generarReportePDF.php?idradicado=".$radicado->getId()."';
                </script>";
            exit();
        }else{
            echo "<script>parent.alert('Ocurrio un error al momento de insertar clientes')</script>";
            exit();
        }
    }else{
        echo "<script>parent.alert('No adjunto ningun archivo para la creacion de la base para marcador predictivo');</script>";
        exit();
    }
}
function creaciondeRadicadoMasivo2($request){
    //echo json_encode($request);
    //echo json_encode(array('exito'=> 'Si entro por aca'));
    //exit();
    if(!isset($_SESSION['id']) || empty($_SESSION['id']) || $_SESSION['id'] === ''){
        echo "<script>parent.alert('Su sesión a expirado, para no perder la información que hasta el momento a procesado, por favor abra una nueva pestaña en el navegador sin cerrar esta y en ésta nueva pestaña inicie sesion, luego regrese a esta pestaña e intente crear el radicado, en caso de que no se cree el nuevo radicado, contacte con el administrador.');</script>";
        exit();
    }
    if(isset($request['FILE'])){//
        if(isset($request['FILE']['file_masivo']['size']) && $request['FILE']['file_masivo']['size'] >= '1173107'){
            echo "<script>parent.alert('El archivo adjunto no debe ser mayo a 1MB');</script>";
            exit();
        }
        if(isset($request['FILE']['file_masivo']['type']) && !tipoCSV($request['FILE']['file_masivo']['type'])){
            echo "<script>parent.alert('Esta intentando adjuntar un archivo con un formato diferente al requerido');</script>";
            exit();
        }
        $tmpNamep = explode('/', $request['FILE']['file_masivo']['tmp_name']);
        $nameTmp = $tmpNamep[(count($tmpNamep) - 1)];
        $tmpName = $request['FILE']['file_masivo']['tmp_name'];
        $tmpSalida = "/var/www/html/Aplicativos.Serverfin04/Colpatria/lib/ApachePOIImplements/".$nameTmp.".csv";
        $lib = "/var/www/html/Aplicativos.Serverfin04/Colpatria/lib/ApachePOIImplements/ApachePOIImplements.jar";
        $eject = exec('java -jar '.$lib.' '.$tmpName.' 4 '.$tmpSalida.' "|" 2>&1', $resultExec, $intExec);
        //$eject = exec('java -jar '.$lib.' 2>&1', $resultExec, $intExec);
        if(empty($resultExec)){
            //echo "esta vacio";
            //echo json_encode($request);
            //exit();
            $handle = fopen($tmpSalida, "r");
            if($handle){
                $radicado = new Radicados();
                $i = 0;
                $objetos = array();
                $pas = true;
                while(!feof($handle)){
                    if($i > 0){
                        $buffer = fgets($handle, 4096);
                        $datos_leer = explode("|",$buffer);

                        if(count($datos_leer) == 4){
                            $nombre = trim(str_replace('"', '', $datos_leer[2]));
                            $cedula = trim(str_replace('"', '', $datos_leer[1]));
                            $nombre = trim(str_replace("'", "", $nombre));
                            $cedula = trim(str_replace("'", "", $cedula));
                            $especial = '0';

                            if((!empty($cedula) && strlen($cedula) > 3)){
                                if(trim(str_replace('"', '', $datos_leer[3])) == 'E'){
                                    $especial = '0';
                                }elseif(trim(str_replace('"', '', $datos_leer[3])) == 'R' || trim(str_replace('"', '', $datos_leer[3])) == 'P'){
                                    $especial = '1';
                                    if(validarCliente(array('cliente'=> $cedula), 1) == "No")
                                        $pas = false;
                                }

                                if($pas === true){
                                    if($radicado->agregarItems($nombre, $cedula, $especial)){
                                        $radicado->updateFilesRadicado($cedula);
                                        $pas = true;
                                    }else
                                        $pas = false;
                                }
                                $radicado->insertarMasivo($cedula, strtolower($nombre), $especial, trim(str_replace('"', '', $datos_leer[3])), $pas);
                            }
                        }
                    }else{
                        $buffer = fgets($handle, 4096);
                        $datos_leer = explode("|",$buffer);
                        $resp = false;

                        if(strtolower(trim(str_replace('"', '', $datos_leer[0]))) !== 'tipo documento' || strtolower(trim(str_replace('"', '', $datos_leer[1]))) !== 'documento' || strtolower(trim(str_replace('"', '', $datos_leer[2]))) !== 'nombre cliente' || strtolower(trim(str_replace('"', '', $datos_leer[3]))) !== 'tipo endoso')
                            $resp = true;


                        if($resp === true){
                            echo "<script>parent.alert('La estructura del archivo no es consistente');</script>";
                            exit();
                        }

                        $request['id_usuarioenvia'] = $_SESSION['id'];
                        $radicado->setAtributos($request);
                        if(!$radicado->registrar()){
                            echo "<script>parent.alert('Ocurrio un error al momento de insertar el radicado.')</script>";
                            exit();
                        }
                    }
                    unset($datos_leer);
                    $i++;
                    $pas = true;
                }
                $email = "";
                $email = enviarMailSeguimiento($radicado); //SKRV
                $errormail = '';
                if($email != "ok"){
                    $errormail = ' pero ocurrio el siguiente error: '.$email;
                }
                if($pas == true){
                    echo "<script>parent.alert('Radicado ingresado exitosamente con sus clientes...".$errormail."')
                                parent.$('form#creaciondeRadicadoMasivo #imgloading').hide();
                                parent.$('form#creaciondeRadicadoMasivo #botoncrearRadicado').removeAttr('disabled');
                                parent.$('form#creaciondeRadicadoMasivo').reset();
                                parent.window.location.href = '../radicado/generarReportePDF.php?idradicado=".$radicado->getId()."';
                        </script>";
                    exit();
                }else{
                    echo "<script>parent.alert('Ocurrio un error al momento de insertar clientes')</script>";
                    exit();
                }
            }else{
                echo "<script>parent.alert('No se pudo abrir el archivo');</script>";
                exit();
            }
        }else{
            echo "<script>parent.alert('Ocurrio un error: ".$resultExec[2]."');</script>";
            print_r($resultExec);
        }
    }else{
        echo "<script>parent.alert('No adjunto ningun archivo para la creacion de la base para marcador predictivo');</script>";
        exit();
    }
}
function tipoCSV($tipo){
    switch ($tipo) {
        case 'text/comma-separated-values':
            return true;
            break;
        case 'text/csv':
            return true;
            break;
        case 'application/csv':
            return true;
            break;
        case 'application/excel':
            return true;
            break;
        case 'application/vnd.ms-excel':
            return true;
            break;
        case 'application/vnd.msexcel':
            return true;
            break;
        case 'text/anytext':
            return true;
            break;
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            return true;
            break;
        
        default:
            return false;
            break;
    }
    return false;
}
/*
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
Then you can simply do your condition like

if ($_FILES['file']['size'] < 5*MB)
*/