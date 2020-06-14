<?php

session_start();
unset( $_SESSION['FRONTEND_USER'] );
$_SESSION['user_login'] = false;
header( "Location: login.php" );

?>