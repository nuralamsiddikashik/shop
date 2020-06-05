<?php

    $email = $_SESSION['FRONTEND_USER'];
    if ( isset( $_POST['update_password'] ) ) {
        $password        = $_POST['password'];
        $retype_password = $_POST['retype_password'];

        if ( empty( $password ) ) {
            echo "Password Can not be empty";
        } else {
            if ( $password != $retype_password ) {
                echo "Password did not password";
            } else {
                $updatePassword = "UPDATE user_frontend SET password='{$password}' WHERE email='{$email}'";
                $updateQuery    = mysqli_query( $connection, $updatePassword );

                if ( $updateQuery ) {
                    header( "Location: profile.php?tab=change-password" );
                } else {
                    echo "Something Wrong";
                }
            }
        }
    }

?>


<div class="card">
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label>New Password</label>
                <input type="text" name="password" id="password">
            </div>

            <div class="form-group">
                <label>Retype Password</label>
                <input type="text" name="retype_password" id="retype_password">
            </div>

            <input clsss="btn btn-primary" type="submit" name="update_password" value="Update Password">

        </form>
    </div>
</div>
