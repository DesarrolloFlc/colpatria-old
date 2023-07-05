<?php
session_start();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reportGeneral.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'alert.class.php';
extract($_POST);

$form = new Alert();

if ($id_alert == 2) {
    $infoalert = $form->getInfoAlert2();
}

if ($id_alert == 3) {
    $infoalert = $form->getInfoAlert3();
}

if ($id_alert == 5) {
    $infoalert = $form->getInfoAlert5();
}

if ($id_alert == 7) {
    $infoalert = $form->getInfoAlert7();
}

if ($id_alert == 12) {
    $infoalert = $form->getInfoAlert12();
}

if ($id_alert == 14) {
    $infoalert = $form->getInfoAlert14();
}

if ($id_alert == 15) {
    $infoalert = $form->getInfoAlert15();
}

?>
<table>
    <tr>
        <th>Nombre</th>
        <th>Cédula</th>
    <tr>
<?php
while ($thumb = mysqli_fetch_array($infoalert)) {
?>
    <tr>
        <td><?=$thumb['nombre']?></td>
        <td><?=$thumb['documento']?></td>
    </tr>
<?php
}
?>
</table>
