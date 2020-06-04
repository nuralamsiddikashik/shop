<?php
    include_once "functions.php";
    include_once "admin/connection.php";
   
     // Login Code

    if ( isset( $_POST['login_user'] ) ) {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if ( empty( $email ) ) {
            echo "<div class='Field-error'>Email can not be empty</div>";

        } else if ( empty( $password ) ) {
            echo "<div class='field-error'>Password can not be empty</div>";

        } else {

            $loginQuery       = "SELECT * FROM `user_frontend` WHERE email='{$email}' AND password='{$password}'";
            $successfulyLogin = mysqli_query( $connection, $loginQuery );
            $userNameRowCount = mysqli_num_rows( $successfulyLogin );

            if ( $userNameRowCount > 0 ) {
                $_SESSION['FRONTEND_USER'] = $email;
                $_SESSION['login']         = true;

                header( "Location: profile.php" );
            } else {
                var_dump( mysqli_error( $connection ) );
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>eShop Login</title>
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css">

  <style>

      body{
          margin-top: 30px;
      }
      .login-form {
          background: #fff;
          padding: 70px;
          box-shadow: 45px 63px 73px 64px #ddd;
      }
      input.button-color {
        background-color: #000;
        border-color: #000;
    }
  </style>

</head>
<body>
    <div class="container">
        <div class="login-form">

            <div class="row">
                <div class="column column-60 column-offset-20">
                    <h1>User Login</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                </div>
            </div>

            <div class="row">
                <div class="column column-60 column-offset-20">
                    <form action="" method="POST">
                        <label>Email</label>
                        <input type="text" name="email" id="email">

                        <label>Password</label>
                        <input type="password" name="password" id="password">
                        <input class="button-color" type="submit" name="login_user" value="Login">
                    </form>
                  <p>Are you register<a href="register.php">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>