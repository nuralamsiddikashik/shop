<?php

session_start();
unset( $_SESSION['ADMIN_USER'] );
$_SESSION['login'] = false;
header( "Location: login.php" );

?>