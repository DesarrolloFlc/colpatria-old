<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'user.class.php';

$user = new User();
$users = $user->getUsersByRol(3); //Traer usuarios con perfil de Digitador
?>
<!-- Page Head -->
<h2>Transferencia de im&aacute;genes</h2>
<p id="page-intro">Reasignar im&aacute;genes de un usuario digitador a otro.</p>

<div class="clear"></div> <!-- End .clear -->
<form method="POST" action="" name="showIndexacion" id="showIndexacion">
<table>
    <tbody>
        <tr>
            <td>Usuario:</td>
            <td>
                <select name="id_user" id="id_user">
                    <option>-- Seleccione un usuario --</option>
                    <?php while ($user_digitador = mysqli_fetch_array($users)): ?>
                        <option value="<?=$user_digitador['id'] . utf8_encode(ucwords(strtolower($user_digitador['name'])))?></option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>
    <tr>
            <td>Usuario:</td>
            <td>
                <select name="id_user" id="id_user">
                    <option>-- Seleccione un usuario --</option>
                    <?php while ($user_digitador = mysqli_fetch_array($users)): ?>
                        <option value="<?=$user_digitador['id'] . utf8_encode(ucwords(strtolower($user_digitador['name'])))?></option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>
</tbody>
</table>
</form>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
