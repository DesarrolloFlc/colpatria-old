<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'user.class.php';
extract($_POST);

$user = new User();
if($user->validatePass($_SESSION['id'], $pass1) == "0"){
    if($user->changePassword($_SESSION['id'], $pass2) == "0"){
        header('Location: index.php?msg=1');
    }
}else{
?>
<script type="text/javascript">
alert("La contrasena actual no es correcta.");
<?php
    if($accion_pass != "1"){
?>
    location.href="change_password.php";
<?php
    }else{
?>
    location.href="change_password_internal.php";
<?php
    }
?>
</script>
<?php
}
?>