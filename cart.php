<?php include_once "header.php";
    // echo "<pre>";

    // var_dump( $_SESSION['cart'] );

    // echo "</pre>";
?>


<div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ( $_SESSION['cart'] as $id => $value ):
                                                $product      = get_product( '', '', '', $id );
                                                $productName  = $product[0]['product_name'];
                                                $productPrice = $product[0]['product_mrp'];
                                                $sellingPrice = $product[0]['product_price'];
                                                $productImage = $product[0]['product_image'];

                                                $totalPrice = $sellingPrice * $value['quantity'];
                                            ?>
		                                        <tr>
		                                            <td class="product-thumbnail"><a href="#"><img src="admin/upload/<?php echo $productImage; ?>" alt="product img"></a></td>
		                                            <td class="product-name"><a href="#"><?php echo $productName; ?></a>
		                                                <ul class="pro__prize">
		                                                    <li class="old__prize">$<?php echo $productPrice; ?></li>
		                                                    <li>$<?php echo $sellingPrice; ?></li>
		                                                </ul>
		                                            </td>
		                                            <td class="product-price"><span class="amount">$<?php echo $sellingPrice; ?></span></td>
		                                            <td class="product-quantity"><input id="quantity-<?php echo $id; ?>" type="number" value="<?php echo $value['quantity']; ?>"></td>
		                                            <td class="product-subtotal">$<?php echo $totalPrice; ?></td>
		                                            <td class="product-remove"><a href="javascript:void(0)" onclick="manageCart(<?php echo $id; ?>, 'remove')"><i class="icon-trash icons"></i></a></td>
		                                        </tr>
		                                        <?php endforeach;?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="#">Continue Shopping</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="#">update</a>
                                            <a href="#">checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="ht__coupon__code">
                                        <span>enter your discount code</span>
                                        <div class="coupon__box">
                                            <input type="text" placeholder="">
                                            <div class="ht__cp__btn">
                                                <a href="#">enter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 smt-40 xmt-40">
                                    <div class="htc__cart__total">
                                        <h6>cart total</h6>
                                        <div class="cart__desk__list">
                                            <ul class="cart__desc">
                                                <li>cart total</li>
                                                <li>tax</li>
                                                <li>shipping</li>
                                            </ul>
                                            <ul class="cart__price">
                                                <li>$909.00</li>
                                                <li>$9.00</li>
                                                <li>0</li>
                                            </ul>
                                        </div>
                                        <div class="cart__total">
                                            <span>order total</span>
                                            <span>$918.00</span>
                                        </div>
                                        <ul class="payment__btn">
                                            <li class="active"><a href="#">payment</a></li>
                                            <li><a href="#">continue shopping</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php include_once "footer.php";?>