<?php

    include_once "header.php";
    include_once "functions.php";
    $catID      = $_GET['id'];
    $getProduct = get_product( 'latest', '', $catID );

?>

<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">
        <?php if ( count( $getProduct ) > 0 ) { ?>
        <div class="col-lg-12 order-lg-12 order-1">
            <?php
            foreach ( $getProduct as $product ) {?>
                    <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                        <div class="category">
                            <div class="ht__cat__thumb">
                                <a href="singleProduct.php?id=<?php echo $product['id']; ?>">
                                    <img src="admin/upload/<?php echo $product['product_image']; ?>" alt="product images">
                                </a>
                            </div>
                            <div class="fr__product__inner">
                                <h4><a href="singleProduct.php?id=<?php echo $product['id']; ?>"><?php echo $product['product_name']; ?></a></h4>
                                <ul class="fr__pro__prize">
                                    <li class="old__prize">$<?php echo $product['product_mrp']; ?></li>
                                    <li>$<?php echo $product['product_price']; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php }?>
             </div>
        </div>
        <?php } else {
                echo "No Products Found";
        }?>
    </div>
</section>


<?php include_once "footer.php";?>