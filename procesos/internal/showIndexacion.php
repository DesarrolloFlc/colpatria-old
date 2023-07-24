<?php
session_start();

require_once dirname(dirname(dirname(__FILE__))) . "/template/general/header.php";
require_once PATH_CCLASS . DS . 'user.class.php';

$user = new User();
$users = $user->getUsersByRol(3); //Traer usuarios con perfil de Digitador
?>

<!-- Page Head -->
<h2>Control de im&aacute;genes en proceso</h2>
<p id="page-intro">Eliminar, re asignar im&aacute;genes del sistema.</p>

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
                        <option value="<?=$user_digitador['id']?>"><?=utf8_encode(ucwords(strtolower($user_digitador['name'])))?></option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Traer im&aacute;genes: </td>
            <td>
                <select name="type_indexacion" id="type_indexacion">
                    <option value="1">Im&aacute;genes ya indexadas</option>
                    <option value="2">Im&aacute;genes activas</option>        
                </select>
            </td>
        </tr>
        <tr align="center">
            <td colspan="2"><input type="submit" value="Buscar >>" class="button"/></td>
        </tr>
    </tbody>
</table>
</form>
<br />
<div id="user_images"></div>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
