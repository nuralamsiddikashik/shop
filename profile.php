<?php

    include_once "header.php";

    if ( !isset( $_SESSION["FRONTEND_USER"] ) ) {
        header( "Location: login.php" );
    }

    if ( isset( $_GET['tab'] ) ) {
        $tab = $_GET['tab'];
    } else {
        $tab = '';
    }
?>

<div class="profile-page-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            <div class="side-menu">
                <ul class="nav nav-pills nav-stacked">
                    <li class="bg-info"><a href="profile.php?tab=dashboard">Dashboard</a></li>
                    <li class="bg-info"><a href="profile.php?tab=change-password">Password</a></li>
                    <li class="bg-info"><a href="profile.php?tab=orders">Orders</a></li>
                </ul>
            </div>
            </div>
            <div class="col-md-9">
                <?php
                    switch ( $tab ) {
                    case 'dashboard':
                        include_once "profile/dashboard.php";
                        break;

                    case 'change-password':
                        include_once "profile/change-password.php";
                        break;
                    case 'orders':
                        include_once "profile/orders.php";
                        break;

                    default:
                        include_once "profile/dashboard.php";
                        break;
                    }
                ?>
            </div>
        </div>
    </div>
</div>


<?php include_once "footer.php";?>



