<?php
session_start();
if (!empty($_SESSION['id'])) {    
    $_SESSION = array();
    session_unset();
    session_destroy();
    Header ("Location: ../../index.php"); 
}
?>
