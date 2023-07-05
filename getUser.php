<?php
require_once 'lib/class/user.class.php';
extract($_POST);

$user = new User();
$username_user = $user->getUsername( $documento );
$miuser = mysqli_fetch_array( $username_user);
if( $miuser != "" ){
	echo $miuser['username'];
} else {
	echo "-1";
}

?>