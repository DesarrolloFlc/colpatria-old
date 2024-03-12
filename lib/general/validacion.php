<?php
/**
 * /lib/general/validacion.php
 * Validación del acceso al aplicativo LOGIN
 * /var/html/www
 */
require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes.php";
session_start();
require_once PATH_CLASS . DS . '_conexion.php';
require_once PATH_CCLASS . DS . 'user.class.php';
require_once PATH_CCLASS . DS . 'UsuarioIngresos.php';
extract($_GET);
//Validar que las variables de user y pass vengan con información.
/*if (empty($username) || empty($password)) {
    echo "<h1>Por favor diligencie los campos de usuario y contrasena.</h1>";
    exit;
}
$user = new User();
$user_result = $user->validateUser($username, $password);
if ($user_result <= 0) {
    echo "102";
    exit;
}
$user_data = mysqli_fetch_array($user->getData($user_result));
$_SESSION['id'] = $user_data['id'];
$_SESSION['name'] = $user_data['name'];
$_SESSION['group'] = $user_data['id_group'];
$_SESSION['cargo'] = $user_data['cargo'];
$_SESSION['test'] = 1;
$_SESSION['change_password'] = $user_data['change_password'];
$_SESSION['fecha_ingreso'] = $user_data['fecha'];
$_SESSION['primer_ingreso'] = $user_data['primer_ingreso'];
$_SESSION['primer_gestion'] = $user_data['primer_gestion'];
$_SESSION['username'] = $user_data['username'];*/

if (empty($username) || empty($password)) {
    echo json_encode(['error'=> 'Por favor diligencie los campos de usuario y contrasena.']);
    exit;
}

$userData = User::validateUser(new Conexion(), $username, $password);
if (isset($userData['error'])) {
    echo json_encode($userData);
    exit;
}

['user'=> $user] = $userData;


$_SESSION['id'] = $user['id'];
$_SESSION['name'] = $user['name'];
$_SESSION['group'] = $user['id_group'];
$_SESSION['cargo'] = $user['cargo'];
$_SESSION['test'] = 1;
$_SESSION['change_password'] = $user['change_password'];
$_SESSION['fecha_ingreso'] = $user['fecha'];
$_SESSION['primer_ingreso'] = $user['primer_ingreso'];
$_SESSION['primer_gestion'] = $user['primer_gestion'];
$_SESSION['username'] = $user['username'];

if((!isset($user['fecha']) || is_null($user['fecha']) || empty($user['fecha'])) && ($user['id_group'] == '3' || $user['id_group'] == '7')){
    $ui = new UsuarioIngresos();
    $ui->setAtributos(['usuario_id'=> $user['id']]);
    try {
        $ui->registrar();
        $_SESSION['fecha_ingreso'] = $ui->getfecha();
        $_SESSION['primer_ingreso'] = $ui->getprimer_ingreso();
        $_SESSION['primer_gestion'] = $ui->getprimer_gestion();
    } catch (Exception $ex) {

    }
}
echo json_encode($userData);
exit;
header('Location: ../../procesos/index.php');
