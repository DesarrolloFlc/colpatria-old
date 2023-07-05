<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'includes.php';
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';
//enviarMailCreacion();
echo htmlentities("JOSE YOVANI D' ALEMAN URIBE");
echo "<br>";
echo htmlspecialchars("JOSE YOVANI D' ALEMAN URIBE");
echo "<br>";
echo preg_replace("/\s+/", " ", "JOSE YOVANI D' ALEMAN URIBE");
echo "<br>";
echo str_replace("'", "\'", "JOSE YOVANI D' ALEMAN URIBE");
echo "<br>";
echo str_replace("'", " ", "JOSE YOVANI D' ALEMAN URIBE");
function enviarMailCreacion(){
	$mail = new PHPMailer();
	$mail->IsHTML(true);
    /*$body = '
<style type="text/css">
.container {
	width: 767px; 
	margin-right: auto; 
	margin-left: auto; 
	margin-top: 2%;
}
.head-img {
	width: 703px; 
	height: 92px; 
	margin-right: auto; 
	margin-left: auto;
}
.body-img {
	width: 767px; 
	height: 430px; 
	margin-right: auto; 
	margin-left: auto; 
	margin-top: 20px;
}
.text-body {
	width: 703px; 
	margin-right: auto; 
	margin-left: auto; 
	margin-top: 20px; 
	text-align: center; 
	font-family: monospace; 
	font-size: 2em;
}
</style>
<div class="container">
	<div class="head-img">
		<img src="head.png" width="703" height="92" id="head" usemap="#m_head" alt="">
		<map name="m_head" id="m_head">
			<area shape="rect" coords="485,50,568,72" href="https://www.instagram.com/eurooou/" alt="Instagram" target="_blank">
			<area shape="rect" coords="486,26,639,41" href="https://www.facebook.com/eurooou" alt="Facebook" target="_blank">
		</map>
	</div>
	<div class="text-body">
		Hola Andr&eacute;s haz salido privilegiado para<br>ver la final de la Champion League el<br>proximo S&aacute;bado 3 de Junio del 2017.
	</div>
	<div class="body-img">
		<a href="https://www.facebook.com/pages/BBC-Bogot%C3%A1-Beer-Company/164624140390425" target="_blank">
			<img src="body.png">
		</a>
	</div>
</div>';*/
$body = "Daniel chico";

    //$mail->IsSendmail();
    //indico a la clase que use SMTP
    $mail->IsSMTP();
    //permite modo debug para ver mensajes de las cosas que van ocurriendo
    //$mail->SMTPDebug = 2;
    //Debo de hacer autenticación SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    //indico el servidor de Gmail para SMTP
    $mail->Host = 'smtp.gmail.com';
    //indico el puerto que usa Gmail
    $mail->Port = '465';
    //indico un usuario / clave de un usuario de gmail
    $mail->Username = 'daniel.chico@finlecobpo.com';
    $mail->Password = 'FlcBpo@$2016';
    //indico creador del mensaje
    $mail->SetFrom('e.meza.co@gmail.com', "Edwar Meza");
    $mail->Subject = "Vamos a la Final de LA CHAMPIONS LEAGUE";

    $mail->MsgHTML($body);
    $mail->CharSet = 'UTF-8';
    $mail->AddAddress('e.meza.co@gmail.com', "Edwar Meza");
    $mail->AddAddress("pipook@gmail.com", "Daniel Chico");
    //$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel Chico P.");

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "ok";
    }
}
?>