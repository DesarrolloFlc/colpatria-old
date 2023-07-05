<?php
$parts = explode(DS, PATH_BASE);

//Defines.
define('PATH_ROOT',			implode(DS, $parts));
//variables definidas para uso de los PATHs
define('PATH_SITE',				PATH_ROOT);
define('SITE_ROOT',             DS . 'colpatria-old');
//PATH LIBRERIAS
define('PATH_LIBRERIAS',		PATH_SITE.DS.'librerias');
define('PATH_LCALENDARIO',		PATH_LIBRERIAS.DS.'calendario');
define('PATH_LJS',				PATH_LIBRERIAS.DS.'js');
define('PATH_LLIB',				PATH_SITE.DS.'lib');
define('PATH_LPHP',				PATH_LIBRERIAS.DS.'php');
//PATH INCLUDES
define('PATH_INCLUDES',			PATH_SITE.DS.'procesos'.DS.'includes');
define('PATH_FILES',			PATH_INCLUDES.DS.'files');
define('PATH_CONTROLLERS', 		PATH_INCLUDES);
define('PATH_CLASS', 			PATH_INCLUDES.DS.'functions'.DS.'class');
define('PATH_CCLASS', 			PATH_LLIB.DS.'class');
define('PATH_MAILER', 			PATH_LLIB.DS.'phpmailer');
define('PATH_MAILER2', 			PATH_LLIB.DS.'PHPMailer_');
define('PATH_PHPEXCEL',			PATH_LLIB.DS.'PHPExcel');
define('PATH_PHPSHEET',			PATH_LLIB.DS.'PhpSpreadsheet');
define('PATH_LOGS',				PATH_LLIB.DS.'logs');
define('PATH_COMPOSER',			PATH_LLIB.DS.'composer');
define('VIRTUALES_DOC',			PATH_SITE.DS.'virtuales_doc');
define('VIRTUALES',				VIRTUALES_DOC.DS.'virtuales');
define('VIRTUALES_ACEPTADOS',	VIRTUALES_DOC.DS.'virtuales_aceptados');
define('PATH_EVIDENCIAS',	    PATH_SITE . DS . 'files' . DS . 'evidencias');
define('PATH_EVIDENCIAS_PATH',	SITE_ROOT . DS . 'files' . DS . 'evidencias');

define('PATH_MATRIZ',			PATH_SITE.DS.'procesos'.DS.'ajuste_db');
define('PATH_INTERNAL',			PATH_SITE.DS.'procesos'.DS.'internal');
define('PATH_MESACONTROL',		PATH_SITE.DS.'procesos'.DS.'mesacontrol');
define('PATH_SARLAFT',			PATH_SITE.DS.'procesos'.DS.'sarlaft');

//variables definidas para uso de la base de datos
define('DB_TYPE',				'mysql');
define('DB_HOST',				'localhost');
define('DB_NAME',				'colpatria_sgd');
define('DB_USER',				'colpatria_sgd');
define('DB_PASS',				'colpatria_sgd');
define('DB_CHARSET',			'utf8');
//variables definidas para el uso de envio de correos
//envio de emails
define('MAIL_USER', 			'operacioncolpatria@finlecobpo.com');
define('MAIL_SUBJECT', 			'Operacion Colpatria Doc Finder');
define('MAIL_PASS', 			'Colpa.17');
define('MAIL_HOST', 			'smtp.gmail.com');
define('MAIL_PORT', 			'465');
