<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(0);
ini_set("log_errors", 1);
require_once PATH_CCLASS . DS . 'radicados.class.php';
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';

use PHPMailer\PHPMailer\PHPMailer;


function validarCliente2Action($request){
    if(Radicados::getValidaCliente($request['cliente']))
        echo json_encode(['exito'=> 'El cliente si tiene formularios en DocFinder.']);
    else
        echo json_encode(['error'=> 'Este cliente no se puede radicar con documento especial porque <strong>no cuenta con Formulario de Conocimiento del Cliente de Vinculación Inicial</strong>.']);
}
function cargarArchivoAction($request){
    $sucursal = str_replace(' ', '_', trim($request['sucursal_sub']));

    $documentoCliente = trim($request['documento_cli']);
    $pathSucursal = VIRTUALES . DS . $sucursal;
    $pathUpload = $pathSucursal . DS . $documentoCliente;
    $error_fi = "";
    $sonPdfs = true;
    $pdfFiles = [];

    foreach($request['FILES']['archivos_cliente']['tmp_name'] as $key => $value){
        if (!file_exists($pathSucursal)) {
            if(!mkdir($pathSucursal)){
                echo json_encode(['error'=> 'Ocurrio un error al momento de intentar el directorio para la sucursal de los documentos que intenta cargar, por favor contacte con el administrador.']);
                exit;
            }
            chown($pathSucursal, 'apache');
        }
        if (!file_exists($pathUpload)) {
            if (!mkdir($pathUpload)) {
                echo json_encode(['error'=> 'Ocurrio un error al momento de intentar el directorio del cliente para los documentos que intenta cargar, por favor contacte con el administrador.']);
                exit;
            }
            chown($pathUpload, 'apache');
        }

        if(mime_content_type($value) !== 'application/pdf'){
            $error_fi .= "El archivo con nombre ".$request['FILES']['load_file']['name'][$key]." no es un archivo con formato PDF, y por tal razon no se cargo.<br>";
            continue;
        }

        $pos = ($key + 1) > 9 ? ($key + 1) : '0' . ($key + 1);

        $newFile = $pathUpload . DS . strtolower($sucursal) . "_" . $documentoCliente . "_" . $pos . ".pdf";
        if (file_exists($newFile)) {
            unlink($newFile);
        }
        if (!move_uploaded_file($value, $newFile)) {
            $error_fi .= "No se pudo crear el archivo ".$request['FILES']['load_file']['name'][$key]." por favor verifique<br>";
            continue;
        }
        $pdfFiles[] = $newFile;
    }
    $mensaje = "";
    if(!empty($error_fi)){
        if(empty($mensaje))
            $mensaje .= "Ocurrieron los siguentes errores:<br>";
        $mensaje .= $error_fi;
    }
    if(!empty($mensaje)){
        echo json_encode(['error'=> $mensaje]);
        exit;
    }

    $pathConvertir = $pathUpload.DS.'*';
    $pdfFileOut = strtoupper($sucursal)."_".$documentoCliente."_TODO.pdf";
    if (empty($pdfFiles)) {
        echo json_encode(['error'=> 'No se encontraron archivos PDF para unificar, por favor verifique o contacte con el administrador.']);
        exit;
    }
    if(count($pdfFiles) > 1){
        $pdfStr = implode(' ', $pdfFiles);

        $strSalida2 = exec('/usr/bin/gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile='.$pathUpload.DS.$pdfFileOut.' '.$pdfStr.' 2>&1', $resultExec2, $intExec2);

        if(($intExec2 == 0) && (strpos(strtolower($strSalida2), 'error') === false && strpos(strtolower(json_encode($resultExec2)), 'error') === false)){
            foreach ($pdfFiles as $pdfFile) {
                unlink($pdfFile);
            }
            $pathConvertir = $pathUpload.DS.$pdfFileOut;
        }else{
            $fh2 = fopen(PATH_LOGS.DS.'errores_conversionPDF_salida.log', "a");
            fputcsv($fh2, array('Error_conversion', date('Y-m-d H:i:s'), $pdfFileOut, json_encode(scandir($pathUpload)), json_encode($resultExec2), $strSalida2), '|');
            fclose($fh2);
        }
    }else if(count($pdfFiles) == 1){
        if(!rename($pdfFiles[0], $pathUpload.DS.$pdfFileOut)){
            $fh2 = fopen(PATH_LOGS.DS.'errores_conversionPDF_salida.log', "a");
            fputcsv($fh2, array('Error_renombre', date('Y-m-d H:i:s'), $pdfFileOut, json_encode(scandir($pathUpload)), '{}'), '|');
            fclose($fh2);
        }
    }
    try{
        Radicados::inserFileRadicado("", $documentoCliente, $pdfFileOut, $pathUpload);
        echo json_encode(['exito'=> 'Se agrego el cliente y se cargaron todos los archivos satisfactoriamenteeeeeeee.', 'item'=> ['documento'=> $documentoCliente, 'nombre'=> trim($request['nombre_cli']), 'file'=> $pdfFileOut, 'sucursal'=> $sucursal]]);
    }catch(Exception $e){
        $fh2 = fopen(PATH_LOGS.DS.'errores_conversionPDF_salida.log', "a");
        fputcsv($fh2, array('Error_registroArchivo', date('Y-m-d H:i:s'), $pdfFileOut, json_encode(scandir($pathUpload)), $e->getMessage(), $e->getCode()), '|');
        fclose($fh2);
        echo json_encode(['error'=> 'Ocurrio un error al momento de registrar los archivos cargados, contacte con el administrador.']);
    }
}
function creaciondeRadicadoAction($request){
    if (!isset($_SESSION['id']) || empty($_SESSION['id']) || $_SESSION['id'] === '') {
        echo json_encode(array('error' => 'Su sesi&oacute;n a expirado, para no perder la informaci&oacute;n que hasta el momento a procesado, por favor abra una nueva pestaña en el navegador sin cerrar esta y en &eacute;sta nueva pestaña inicie sesion, luego regrese a esta pestaña e intente crear el radicado, en caso de que no se cree el nuevo radicado, contacte con el administrador.'));
        exit;
    }
    $request['id_usuarioenvia'] = $_SESSION['id'];
    $radicado = new Radicados();
    $radicado->setAtributos($request);
    if (!$radicado->registrar()) {
        echo json_encode(['error' => 'Ocurrio un error al momento de insertar el radicado']);
        exit;
    }
    $clientes = explode('||', $request['clientes']);
    $errorCliente = '';
    foreach ($clientes as $key => $value) {
        $cliente = explode('|', $value);

        if (count($cliente) !== 4) {
            if (empty($errorCliente)) $errorCliente = '<br>Ocurrieron el/los siguiente/s error/es:<br>';
            $errorCliente .= 'No se pudo agregar el cliente con datos: {' . $value . '}<br>';
            continue;
        }

        if (!$radicado->agregarItems($cliente[0], $cliente[1], $cliente[2])) {
            if (empty($errorCliente)) $errorCliente = '<br>Ocurrieron el/los siguientes errores:<br>';
            $errorCliente .= 'No se pudo agregar el cliente con numero de documento: ' . $cliente[1] . '<br>';
            continue;
        }
        $radicado->updateFilesRadicado($cliente[1]);
        unset($cliente);
    }
    $email = enviarMailSeguimiento($radicado);
    $errormail = $email != "ok" ? '<br>pero ocurrio el siguiente error: ' . $email : '';
    echo json_encode(['exito' => 'Radicado ingresado exitosamente con sus clientes...' . $errormail . $errorCliente, 'radicado' => $radicado]);
}
function creaciondeRadicadoFisicoAction($request){
    if (!isset($_SESSION['id']) || empty($_SESSION['id']) || $_SESSION['id'] === '') {
        echo json_encode(array('error' => 'Su sesi&oacute;n a expirado, para no perder la informaci&oacute;n que hasta el momento a procesado, por favor abra una nueva pestaña en el navegador sin cerrar esta y en &eacute;sta nueva pestaña inicie sesion, luego regrese a esta pestaña e intente crear el radicado, en caso de que no se cree el nuevo radicado, contacte con el administrador.'));
        exit;
    }
    $request['id_usuarioenvia'] = $_SESSION['id'];
    $radicado = new Radicados();
    $radicado->setAtributos($request);
    if (!$radicado->registrar()) {
        echo json_encode(['error' => 'Ocurrio un error al momento de insertar el radicado']);
        exit;
    }
    $clientes = explode('||', $request['clientes']);
    $errorCliente = '';
    foreach ($clientes as $key => $value) {
        $cliente = explode('|', $value);
        if (count($cliente) !== 3) {
            if (empty($errorCliente)) $errorCliente = '<br>Ocurrieron el/los siguiente/s error/es:<br>';
            $errorCliente .= 'No se pudo agregar el cliente con datos: {'.$value.'}<br>';
            continue;
        }
        if (!$radicado->agregarItems($cliente[0], $cliente[1], $cliente[2])) {
            if (empty($errorCliente)) $errorCliente = '<br>Ocurrieron el/los siguientes errores:<br>';
            $errorCliente .= 'No se pudo agregar el cliente con numero de documento: ' . $cliente[1] . '<br>';
        }
        unset($cliente);
    }
    $email = "";
    $email = enviarMailSeguimiento($radicado);
    $errormail = $email != "ok" ? '<br>pero ocurrio el siguiente error: ' . $email : '';
    echo json_encode(['exito' => 'Radicado ingresado exitosamente con sus clientes...' . $errormail . $errorCliente, 'radicado' => $radicado]);
}
function busquedadeRadicadoAction($request){
    $radicado = new Radicados();
    $radicado->setId($request['id']);
    if ($radicado->getRadicado()) {
        $sucursal = $radicado->getSucursal();
        $funcionario = $radicado->getFuncionario();
        $estado = getEstados2($radicado->getEstado(), $radicado->getTipo());
        if($items = $radicado->getItemsDeRadicado(str_replace(" ", "_", $sucursal))){
            echo json_encode(array('exito' => 'Radicado encontrado', 'radicado' => $radicado, 'sucursal' => $sucursal, 'funcionario' => $funcionario, 'estado'=> $estado, 'items' => $items));
        } else
            echo json_encode(array('exito' => 'Radicado encontrado', 'radicado' => $radicado, 'sucursal' => $sucursal, 'funcionario' => $funcionario, 'estado'=> $estado, 'erroritems' => 'no se encontraron items'));
    } else
        echo json_encode(array('error' => 'El numero de radicado que intenta buscar no ha sido encontrado.'));
}
function radicadosyClientesxoficialAction($request) {
    if ($clientes = Radicados::clientesDelOficial($request['fecha_inicio'], $request['fecha_fin'])) {
        echo json_encode(array('exito' => 'Se encontraron los clientes satisfactoriamente.', 'items' => $clientes));
    }else
        echo json_encode(array('error' => 'No se encontraron clientes radicados en el rango de fechas especificado.'));
}
function cargueRadicadoMasivoAction($request){
    echo json_encode($request);
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

    $mail->IsSMTP();
    //permite modo debug para ver mensajes de las cosas que van ocurriendo
    //$mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = MAIL_HOST;
    $mail->Port = MAIL_PORT;
    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASS;

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

    if (isset($oficial['email_father']) && !empty($oficial['email_father'])) {
        $mail->AddCC($oficial['email_father']);
    }
    return !$mail->Send() ? "Mailer Error: " . $mail->ErrorInfo : "ok";
}
function tipoCSV($tipo)
{
    return in_array($tipo, ['text/comma-separated-values', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
}
function getEstados2(int $estado, int $tipo = 0): string
{
    $estados = ['Radicado', null, 'Aprobado', 'Devuelto', 'Cancelado'];
    return $estado !== 1 
        ? ($estados[$estado] ?? 'Radicado') 
        : (in_array($tipo, [1, 5]) ? 'No se adjunto documento' : 'No llego fisico');
}
function buscarCausalesAction(array $request)
{
    $resp = Radicados::obtenerCausales($request['tipo_persona']);
    echo json_encode($resp);
}

function buscarObservacionesCausalAction(array $request)
{
    $resp = Radicados::obtenerObservacionCausales(intval($request['causal_id']));
    echo json_encode($resp);
}
/*
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
Then you can simply do your condition like

if ($_FILES['file']['size'] < 5*MB)
*/