<?php
    include_once "admin/connection.php";

    $msg      = '';
    $loginMsg = '';
    if ( isset( $_POST['reg_dashboard'] ) ) {

        $name     = $_POST['name'];
        $email    = $_POST['email'];
        $phone    = $_POST['phone'];
        $password = $_POST['password'];

        if ( empty( $name ) ) {
            $msg = "Name Can Not Be empty";
        } else if ( empty( $email ) ) {
            $msg = "Email Can Not Be empty";
        } else if ( empty( $phone ) ) {
            $msg = "Phone Can Not Be empty";
        } else if ( empty( $password ) ) {
            $msg = "Phone Can Not Be empty";

        } else {

            // $password = md5( $password );

            $checkUserEmailID    = "SELECT * FROM user_frontend WHERE email='{$email}'";
            $checkUserEmailQuery = mysqli_query( $connection, $checkUserEmailID );

            if ( mysqli_num_rows( $checkUserEmailQuery ) > 0 ) {
                echo "Email already exist";
            } else {
                $insertToDatabaseUserReg = "INSERT INTO user_frontend (name,email,phone,password) VALUES('{$name}','{$email}','{$phone}','{$password}')";

                $insertDatabaseReg = mysqli_query( $connection, $insertToDatabaseUserReg );
                header( "Location: login.php" );
                return $insertDatabaseReg;
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
                    <h1>Reg Login</h1>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                </div>
            </div>

            <div class="row">
                <div class="column column-60 column-offset-20">
                   <form action="register.php" method="POST">
                        <label>Name</label>
                        <input type="text" name="name" id="name">

                        <label>Email</label>
                        <input type="text" name="email" id="email">

                        <label>Phone</label>
                        <input type="text" name="phone" id="phone">

                        <label>Password</label>
                        <input type="password" name="password" id="password">

                        <input class="button-color" type="submit" name="reg_dashboard" value="Registration">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
