<?php include_once "header.php";

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

                header( "Location: checkout.php" );
                return $insertDatabaseReg;
            }
        }

    }

    // Table:  Orders

    // id
    // user_id
    // address_line_1
    // address_line_2
    // city
    // state
    // zip
    // country
    // payment_method
    // order_total
    // payment_status
    // order_status
    // date_added
    // date_modified

    if ( isset( $_POST['place_order'] ) ) {

        $error = array();

        // Orders table info
        $address_line_1 = $_POST['address_line_1'];
        $address_line_2 = $_POST['address_line_2'];
        $city           = $_POST['city'];
        $state          = $_POST['state'];
        $zip            = $_POST['zip'];
        $country        = $_POST['country'];
        $order_total    = (float) $_POST['order_total'];
        $payment_method = $_POST['payment_method'];
        $payment_status = 'pending';
        $order_status   = '1';

        // Users table info
        $name  = $_POST['name'];
        $phone = $_POST['phone'];

        if ( empty( $name ) ) {
            $error['name'] = " Name can't be empty";
        }

        if ( empty( $address_line_1 ) ) {
            $error['address_line_1'] = "Address line 1 can't be empty";
        }
        if ( empty( $city ) ) {
            $error['city'] = "City can't be empty";
        }
        if ( empty( $state ) ) {
            $error['state'] = "State can't be empty";
        }
        if ( empty( $zip ) ) {
            $error['zip'] = "Zip can't be empty";
        }
        if ( empty( $country ) ) {
            $error['country'] = "Country can't be empty";
        }

        if ( $_POST['payment_method'] == null ) {
            $error['payment_method'] = "Please select a payment method";
        }

        if ( count( $error ) == 0 ) {
            $userID     = get_user_id_by_email( $_SESSION['FRONTEND_USER'] );
            $productSQL = "INSERT INTO orders(user_id,address_line_1,address_line_2,city,state,zip,country,order_total,payment_method,payment_status,order_status) VALUES('{$userID}','{$address_line_1}','{$address_line_2}','{$city}','{$state}','{$zip}','{$country}','{$order_total}','{$payment_method}','{$payment_status}','{$order_status}')";

            $productEntry = mysqli_query( $connection, $productSQL );

            $order_id = mysqli_insert_id($connection);
            
            foreach ( $_SESSION['cart'] as $id => $value ){

                $product      = get_product( '', '', '', $id );
                $sellingPrice = $product[0]['product_price'];
                $totalPrice = $sellingPrice * $value['quantity'];
                $product_qty = $value['quantity'];

                $productIDSQL = "INSERT INTO order_details(order_id,product_id,product_price,product_qty,total_price) VALUES('{$order_id}','{$id}','{$sellingPrice}','{$product_qty}','{$totalPrice}')";
                
                $productID = mysqli_query( $connection, $productIDSQL );
            }

                unset( $_SESSION['cart'] );
                header( "Location: thank_you.php" );
            if ( !$productEntry ) {
                var_dump( mysqli_error( $connection ) );
            }

        } else {

        }
    }

?>

        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                <?php if ( !isset( $_SESSION["FRONTEND_USER"] ) ): ?>
                                    <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form action="#">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" id="user-email">
                                                            </div>
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" id="user-pass">
                                                            </div>
                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                                <a href="#">LogIn</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form action="checkout.php" method="POST">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <label>Name</label>
                                                                <input type="text" name="name">
                                                            </div>
															<div class="single-input">
                                                                <label>Email Address</label>
                                                                <input type="text" name="email">
                                                            </div>

                                                            <div class="single-input">
                                                                <label>Phone</label>
                                                                <input type="text" id="phone" name="phone">
                                                            </div>

                                                            <div class="single-input">
                                                                <label>Password</label>
                                                                <input type="password" name="password">
                                                            </div>
                                                            <div class="dark-btn">
                                                              <input class="button-color" type="submit" name="reg_dashboard" value="Registration">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>
                                  <form action="#" method="POST">
                                    <div class="accordion__title">
                                        Address Information
                                    </div>

                                    <div class="accordion__body">
                                        <div class="bilinfo">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="name" placeholder="First name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address_line_1" placeholder="Street Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address_line_2" placeholder="Street Address">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City/State">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="zip" placeholder="Zip">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="country" placeholder="Country">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="state" placeholder="State">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="phone" placeholder="Phone number">
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                    <div class="accordion__title">
                                        payment information
                                    </div>
                                    <div class="accordion__body">
                                    <div class="paymentinfo">
                                        <span class="text-danger"></span>
                                        <div class="form-group">
                                            <label for="cod">
                                                <input type="radio" name="payment_method" value="cod" id="cod"> COD
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="bKash">
                                                <input type="radio" name="payment_method" value="bKash" id="bKash"> bKash
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="place_order" value="Place Order" class="btn btn-info btn-lg">
                                        </div>
                                    </div>
                                    </div>
                                    <?php
                                        foreach ( $_SESSION['cart'] as $id => $value ):
                                            $product      = get_product( '', '', '', $id );
                                            $sellingPrice = $product[0]['product_price'];

                                            $totalPrice = $sellingPrice * $value['quantity'];

                                    endforeach;?>


                                       <input type="hidden" name="order_total" value="<?php echo $totalPrice; ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">

                            <?php
                                $cartTotal = 0;
                                foreach ( $_SESSION['cart'] as $id => $value ):
                                    $product      = get_product( '', '', '', $id );
                                    $productName  = $product[0]['product_name'];
                                    $sellingPrice = $product[0]['product_price'];
                                    $productImage = $product[0]['product_image'];
                                    $cartTotal    = $cartTotal + ( $sellingPrice * $value['quantity'] );

                                    // $totalPrice = $sellingPrice * $value['quantity'];
                                ?>
	                                <div class="single-item">
	                                    <div class="single-item__thumb">
	                                        <img src="admin/upload/<?php echo $productImage; ?>" alt="ordered item">
	                                    </div>
	                                    <div class="single-item__content">
	                                        <a href="#"><?php echo $productName; ?></a>
	                                        <span class="price">$<?php echo $sellingPrice; ?></span>
	                                    </div>
	                                    <div class="single-item__remove">
	                                        <td class="product-remove"><a href="javascript:void(0)" onclick="manageCart(<?php echo $id; ?>, 'remove')"><i class="icon-trash icons"></i></a></td>
	                                    </div>
	                                </div>
	                            <?php endforeach;?>

                            </div>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price">$<?php echo $cartTotal; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once "footer.php";?>