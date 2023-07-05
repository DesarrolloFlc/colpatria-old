<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], [1, 6])) {
    echo "<h1>No tiene autorizaci�n para este m�dulo</h1>";
    exit;
}

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'user.class.php';

extract($_POST);
$user = new User();
$result_search = $user->search($criterio, $texto);
$count_results = mysqli_num_rows($result_search);

if ($count_results <= 0) {
    echo "-1";
    exit;
}
while ($user_enabled = mysqli_fetch_array($result_search)) {
?>
    <tr>
        <td><?php echo $user_enabled['identificacion']; ?></td>
        <td><?php echo utf8_encode($user_enabled['name']); ?></td>
        <td><?php echo $user_enabled['username']; ?></td>
        <td><?php echo $user_enabled['date_created']; ?></td>
        <td>
            <!-- Icons -->
            <a href="editUser.php?id_user=<?php echo $user_enabled['id'] ?>" title="Edit"><img src="../../resources/images/icons/pencil.png" alt="Edit" /></a>
            <a href="#" title="Delete"><img src="../../resources/images/icons/cross.png" alt="Delete" /></a> 

        </td>
    </tr>
<?php
    $contador++;
}
