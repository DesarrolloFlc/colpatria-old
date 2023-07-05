<?php
session_start();
ini_set("log_errors", 1);
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exception

$body = "<p>DANIEL, usted ha creado un nuevo radicado en Doc Finder, a continuaci&oacute;n se presentan los detalles del caso.</p><br>
<p>Tipo: Radicado.</p>
<p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>";
try {
    //Server settings
    $mail->SMTPDebug = 2;												// Enable verbose debug output
    $mail->isSMTP();													// Set mailer to use SMTP
    $mail->Host = MAIL_HOST;											// Specify main and backup SMTP servers
    $mail->SMTPAuth = true;												// Enable SMTP authentication
    $mail->Username = MAIL_USER;										// SMTP username
    $mail->Password = MAIL_PASS;										// SMTP password
    $mail->SMTPSecure = 'ssl';											// Enable TLS encryption, `ssl` also accepted
    $mail->Port = MAIL_PORT;											// TCP port to connect to

    //Recipients
    $mail->setFrom(MAIL_USER, MAIL_SUBJECT);
    $mail->addAddress("daniel.chico@finlecobpo.com", "Daniel chico");	// Add a recipient
    $mail->addCC("german.avendano@finlecobpo.com");

    //Content
    $mail->isHTML(true);												// Set email format to HTML
    $mail->Subject = 'Usted tiene un nuevo radicado en Doc Finder #1.';
    $mail->Body    = $body;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

/*$mail = new PHPMailer();
$body = "<p>DANIEL, usted ha creado un nuevo radicado en Doc Finder, a continuaci&oacute;n se presentan los detalles del caso.</p><br>
<p>Tipo: Radicado.</p>
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
$mail->Subject = "Usted tiene un nuevo radicado en Doc Finder #1.";

$mail->MsgHTML($body);
$mail->CharSet = 'UTF-8';
$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel chico");

$mail->AddCC("german.avendano@finlecobpo.com");

if (!$mail->Send()) {
    echo "Mailer Error: ".$mail->ErrorInfo;
} else {
    echo "ok";
}*/
?>