<?php
    include_once "header.php";
    include_once "functions.php";
    $productID  = $_GET['id'];
    $getProduct = get_product( '', '', '', $productID );

    // echo "<pre>";
    // var_dump( $getProduct );
    // echo "</pre>";

?>

<section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="htc__product__details__tab__content">
                                <img src="admin/upload/<?php echo $getProduct['0']['product_image']; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <h2><?php echo $getProduct['0']['product_name']; ?></h2>
                                <h6>Model: <span>MNG001</span></h6>
                                <ul class="rating">
                                    <li><i class="icon-star icons"></i></li>
                                    <li><i class="icon-star icons"></i></li>
                                    <li><i class="icon-star icons"></i></li>
                                    <li class="old"><i class="icon-star icons"></i></li>
                                    <li class="old"><i class="icon-star icons"></i></li>
                                </ul>
                                <ul class="pro__prize">
                                    <li class="old__prize">$<?php echo $getProduct['0']['product_mrp']; ?></li>
                                    <li>$<?php echo $getProduct['0']['product_price']; ?></li>
                                </ul>
                                <p class="pro__info"><?php echo $getProduct['0']['product_description']; ?></p>
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <p><span>Availability:</span> In Stock</p>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>color:</span></p>
                                        <ul class="pro__color">
                                            <li class="red"><a href="#">red</a></li>
                                            <li class="green"><a href="#">green</a></li>
                                            <li class="balck"><a href="#">balck</a></li>
                                        </ul>
                                        <div class="pro__more__btn">
                                            <a href="#">more</a>
                                        </div>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>size</span></p>
                                        <select class="select__size">
                                            <option>s</option>
                                            <option>l</option>
                                            <option>xs</option>
                                            <option>xl</option>
                                            <option>m</option>
                                            <option>s</option>
                                        </select>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#">Fashion,</a></li>
                                            <li><a href="#">Accessories,</a></li>
                                            <li><a href="#">Women,</a></li>
                                            <li><a href="#">Men,</a></li>
                                            <li><a href="#">Kid,</a></li>
                                            <li><a href="#">Mobile,</a></li>
                                            <li><a href="#">Computer,</a></li>
                                            <li><a href="#">Hair,</a></li>
                                            <li><a href="#">Clothing,</a></li>
                                        </ul>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>Product tags:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#">Fashion,</a></li>
                                            <li><a href="#">Accessories,</a></li>
                                            <li><a href="#">Women,</a></li>
                                            <li><a href="#">Men,</a></li>
                                            <li><a href="#">Kid,</a></li>
                                        </ul>
                                    </div>

                                    <div class="sin__desc product__share__link">
                                        <p><span>Share this:</span></p>
                                        <ul class="pro__share">
                                            <li><a href="#" target="_blank"><i class="icon-social-twitter icons"></i></a></li>

                                            <li><a href="#" target="_blank"><i class="icon-social-instagram icons"></i></a></li>

                                            <li><a href="https://www.facebook.com/Furny/?ref=bookmarks" target="_blank"><i class="icon-social-facebook icons"></i></a></li>

                                            <li><a href="#" target="_blank"><i class="icon-social-google icons"></i></a></li>

                                            <li><a href="#" target="_blank"><i class="icon-social-linkedin icons"></i></a></li>

                                            <li><a href="#" target="_blank"><i class="icon-social-pinterest icons"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>



<?php include_once "footer.php";?>