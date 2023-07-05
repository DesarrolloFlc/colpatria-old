<?php
header("Content-Type: application/json; charset=UTF-8");
ini_set('memory_limit', '-1');
set_time_limit(0);

//setup request to send json via POST
$data = array(
	'UserName' => 'Solidaria_finleco',
	'PassWord' => 'Solidaria2019***'
);
$payload = json_encode($data);

$url = 'http://www.solitest.com.co:8085/WAPIPDP/Api/Authenticate_user/Credentials';
$cURL = curl_init();
curl_setopt($cURL, CURLOPT_URL, $url);
curl_setopt($cURL, CURLOPT_POST, true);
curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Accept: application/json',
));
//attach encoded JSON string to the POST fields
curl_setopt($cURL, CURLOPT_POSTFIELDS, $payload);
//NGRtMW4xc3RyNGQwcjpmaW5sZWNvQCQyMDE5
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($cURL);
curl_close($cURL);
echo $result;
?>