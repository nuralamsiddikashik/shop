<?php
    include_once "admin/connection.php";

    $email               = $_SESSION['FRONTEND_USER'];
    $profileDisplayQuery = "SELECT * FROM user_frontend WHERE email='{$email}'";
    $array               = array();
    $userProfileQuery    = mysqli_query( $connection, $profileDisplayQuery );

    if ( mysqli_num_rows( $userProfileQuery ) > 0 ) {
        while ( $row = mysqli_fetch_assoc( $userProfileQuery ) ) {
            $array = $row;

        }
    }

    if ( isset( $_POST['update'] ) ) {

        $id    = $_POST['id'];
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $updateUserQuery = "UPDATE user_frontend SET name='{$name}',email='{$email}',phone='$phone' WHERE id='{$id}'";

        $updateSQL = mysqli_query( $connection, $updateUserQuery );

        if ( $updateSQL ) {
            header( "Location: profile.php?tab=dashboard" );
        } else {
            echo "Update Problem";
        }
    }

?>



<div class="card">
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label>Your Name</label>
                <input type="text" name="name" id="name" value="<?php echo $array['name']; ?>">
            </div>

            <div class="form-group">
                <label>Your Email</label>
                <input type="text" name="email" id="email" value="<?php echo $array['email']; ?>">
            </div>

            <div class="form-group">
                <label>Your Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo $array['phone']; ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $array['id']; ?>">
            <input clsss="btn btn-primary" type="submit" name="update" value="Update Profile">

        </form>
    </div>
</div>
