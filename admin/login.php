<?php

    include_once "functions.php";

    if ( isset( $_SESSION['ADMIN_USER'] ) == true ) {
        header( "Location: index.php" );
    }

    if ( isset( $_POST['login_dashboard'] ) ) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ( empty( $username ) ) {
            echo "<div class='Field-error'>User name can not be empty</div>";

        } else if ( empty( $password ) ) {
            echo "<div class='field-error'>Password can not be empty</div>";

        } else {
            //$password         = md5( $password );
            $loginQuery       = "SELECT * FROM `admin_user` WHERE username='{$username}' AND password='{$password}'";
            $successfulyLogin = mysqli_query( $connection, $loginQuery );
            $userNameRowCount = mysqli_num_rows( $successfulyLogin );

            if ( $userNameRowCount > 0 ) {
                $_SESSION['ADMIN_USER'] = $username;
                $_SESSION['login']      = true;
                header( "Location: index.php" );
            } else {
                echo "Something Worng";
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
                    <h1>eShop Login</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                </div>
            </div>

            <div class="row">
                <div class="column column-60 column-offset-20">
                    <!--                                                                                                                                                                         <?php if ( isset( $msg ) ) {echo $msg;}?> -->
                    <form action="login.php" method="post">
                        <label>User Name</label>
                        <input type="text" name="username" id="username">

                        <label>Password</label>
                        <input type="password" name="password" id="password">

                        <input class="button-color" type="submit" name="login_dashboard" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>