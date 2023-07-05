<?php
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'official.class.php';
require_once PATH_CCLASS . DS . 'form.class.php';
require_once PATH_CCLASS . DS . 'formulario.php';
$form = new Form();
$dataform = mysqli_fetch_array($form->getFormInfo($_GET['id_form']));
$type_person = $_GET['type'];
$fecharadicado = explode("-",$dataform['fecharadicado']);
?>
<html>
<head>
    <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/calendar.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery.qtip-1.0.0-rc3.min.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/lib/js/tools_2.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/lib/js/cal.js"></script>
</head>
<body>
<?php
require_once in_array($dataform['formulario'], [15, 19, 20])
    ? "editForm_" . $dataform['formulario'] . ".php"
    : 'editFormNo_15.php';
?>
</body>
</html>