<?php

session_start();
unset( $_SESSION['FRONTEND_USER'] );
$_SESSION['login'] = false;
session_destroy();
header( "Location: login.php" );

?>