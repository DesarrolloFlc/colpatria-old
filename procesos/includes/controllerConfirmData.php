<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';
require_once PATH_CCLASS . DS . 'radicados.class.php';
require_once PATH_CCLASS . DS . 'form.class.php';

$action = $_POST['action'];

call_user_func($action, $_POST);

function updateFormatoUg($formatoesp) {
    $auto = new Form();
    if ($auto->updateformautos($formatoesp)) {
        echo 'SI';
    }  else {
        echo 'NO';
    }
}
