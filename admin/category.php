<?php
session_start();
if ( !isset( $_SESSION["ADMIN_USER"] ) ) {
    header( "Location: login.php" );
}

include "header.php";?>


<?php echo "Category Page"; ?>


<?php include "footer.php";?>