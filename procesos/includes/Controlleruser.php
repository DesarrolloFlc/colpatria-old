<?php

if (!isset($_SESSION)) {
	session_start();
}
require_once PATH_CCLASS . DS . 'user.class.php';

function cambiarPasswordAction(array $request): void
{
    if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
        echo json_encode(['error'=> 'Debe iniciar sesion nuevamente, al parecer su sesion caduco.']);
        exit;
    }

    if (!isset($request['nuevo_password']) || empty($request['nuevo_password']) || strlen($request['nuevo_password']) < 6) {
        echo json_encode(['error'=> 'La nueva contraseña no puede ser vacia o tener menos de 6 caracteres.']);
        exit;
    }

    $resp = User::actualizarPasswordPorId(new Conexion(), $_SESSION['id'], $request['anterior_password'], $request['nuevo_password']);
    echo json_encode($resp);
}
function agregarUsuarioAction(array $request): void
{
    $resp = User::add2(new Conexion(), $request);
    echo json_encode($resp);
}
