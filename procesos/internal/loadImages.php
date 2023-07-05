<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'file.class.php';
$usuario = $_SESSION['id'];
$file = new File();
$images = $file->getImages();

$exitoso = $file->getImagesToInsert($images, $usuario);

echo "<br /><br />";
echo "<b>La cantidad de imágenes indexadas fueron: ".$exitoso."</b>";