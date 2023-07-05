<?php
session_start();
require_once '../../lib/phpmailer/class.phpmailer.php';
require_once '../../lib/class/case.class.php';
require_once '../../lib/class/official.class.php';
extract($_POST);
?>
<?php
$scase = new Cases();
$offici = new Official();
$data_official = mysqli_fetch_array($offici->getOfficial($official));
//print_r($data_official);


$texto = "";
foreach ($observation as $c)
		$texto.= $c."<br>";


if ($scase->insertCase($_SESSION['id'], $official, $causaldevolucion, $texto, $sucursal, $area, $nombre, $persontype, $documento, $lote)) {
    $mail = new PHPMailer();
    $body = "
    <p>Tienes una nueva devolución en Doc Finder, a continuación se presentan los detalles del caso.</p> <br />
    <p>Tipo: Devolución.</p>
    <p>Causal: " . $causaldevolucion . "</p>
    <p>Cliente: ".$documento."</p>";
    if(isset($observation)){
       $body .= "<p>Observación: " . utf8_encode($observation) . "</p>";
	   foreach ($observation as $t)
	       $body.="<br>".$t;
    }
    $body.= "<p>Caso creado por: " . $_SESSION['name'] . "</p>
    <p>Fecha de creación: " . date("Y-m-d h:m:s") . "</p>  <br />  
    <p>Recuerda que puedes responder al caso accediendo al aplicativo Doc Finder.</p>
    ";

    //$mail->IsSendmail();
    //indico a la clase que use SMTP
    $mail->IsSMTP();
    //permite modo debug para ver mensajes de las cosas que van ocurriendo
    //$mail->SMTPDebug = 2;
    //Debo de hacer autenticación SMTP
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    //indico el servidor de Gmail para SMTP
    $mail->Host = "smtp.gmail.com";
    //indico el puerto que usa Gmail
    $mail->Port = 465;
    //indico un usuario / clave de un usuario de gmail
    $mail->Username = "operacioncolpatria@finlecobpo.com";
    $mail->Password = "Colpa.17";
    //indico creador del mensaje

    $mail->SetFrom('operacioncolpatria@finlecobpo.com', 'App Doc Finder');
    $mail->Subject = "Tienes un nuevo caso en Doc Finder.";

    $mail->MsgHTML($body);
    $mail->CharSet = 'UTF-8';
    $address = $data_official['email'];    
    $mail->AddAddress($address, $data_official['name']);
    $mail->AddAddress("jackeline.gutierrez@ui.colpatria.com", "Jackeline Gutierrez");
    //$mail->AddAddress("candres@finleco.com", "Camilo Rodríguez");
    $mail->AddAddress("operacioncolpatria@finlecobpo.com", "App Doc Finder");
    //$mail->AddAddress("daniel.chico@finlecobpo.com", "Camilo Rodríguez");
    
    if( $data_official['email_father'] != "" )
        $mail->AddCC($data_official['email_father']);

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        //echo "aca";
        ?>
<script >
	alert("Mensaje: Caso enviado.");
	location.href="../index.php";
</script>
<?php
    }
} else {
    echo "<h1>Error enviando caso.</h1>";
}
?>
