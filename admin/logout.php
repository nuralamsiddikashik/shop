<?php

session_start();
unset( $_SESSION['ADMIN_USER'] );
$_SESSION['login'] = false;
session_destroy();
header( "Location: login.php" );

?>