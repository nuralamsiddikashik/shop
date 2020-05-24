<?php

    include_once "includes/header.php";

    // $categoryIDFromDatabase = "SELECT id, categories FROM category_name ORDER BY category_name DESC";
    $categoryIDFromDatabase = "SELECT * FROM `categories` ORDER BY `category_name` DESC";
    $categoryQuery          = mysqli_query( $connection, $categoryIDFromDatabase );
    // var_dump($categoryQuery);

    if ( isset( $_POST['addProduct'] ) ) {

        $categories_id             = $_POST['categories_id'];
        $product_name              = $_POST['product_name'];
        $product_mrp               = $_POST['product_mrp'];
        $product_price             = $_POST['product_price'];
        $product_qty               = $_POST['product_qty'];
        $product_image             = $_POST['product_image'];
        $product_description       = $_POST['product_description'];
        $product_meta_title        = $_POST['product_meta_title'];
        $product_meta_description  = $_POST['product_meta_description'];
        $product_meta_keyword      = $_POST['product_meta_keyword'];
        $product_short_description = $_POST['product_short_description'];

        if ( empty( $categories_id ) ) {
            echo 'Field Can Not Be empty';
        } else if ( empty( $product_name ) ) {
            echo 'Field Can Not Be empty';
        } else if ( empty( $product_mrp ) ) {
            echo 'Field Can Not Be empty';
        } else if ( empty( $product_price ) ) {
            echo 'Field Can Not Be empty';
        } else if ( empty( $product_qty ) ) {
            echo 'Field Can Not Be empty';
        } else {
            $addProductDatabase = "INSERT INTO product(categories_id,product_name,product_mrp,product_price,product_qty,product_image,product_description,product_meta_title,product_meta_description,product_short_description,product_meta_keyword,status) VALUES('{$categories_id}','{$product_name}','{$product_mrp}','{$product_price}','{$product_qty}','{$product_image}','{$product_description}','{$product_meta_title}','{$product_meta_description}','{$product_short_description}','{$product_meta_keyword}','1')";

            $resultAddProduct = mysqli_query( $connection, $addProductDatabase );
            if ( $resultAddProduct ) {
                var_dump( $resultAddProduct );
                //header( "Location: productManage.php" );
            } else {
                var_dump( mysqli_error( $connection ) );
            }
        }

    }

?>

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-form">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                               <label>Select category Name</label>
                               <select class="form-control" name="categories_id">
                                    <option value="">Select Category</option>
                                    <?php
                                    while ( $row = mysqli_fetch_assoc( $categoryQuery ) ) {?>

                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>

                                    <?php }?>
                               </select>
                            </div>
                            <div class="form-group">
                                <label>Add Product Name</label>
                                <input class="form-control" type="text" name="product_name" id="product_name">
                            </div>

                            <div class="form-group">
                                <label>Add Product MRP</label>
                                <input class="form-control" type="text" name="product_mrp" id="product_mrp">
                            </div>

                            <div class="form-group">
                                <label>Add Product MRP</label>
                                <input class="form-control" type="text" name="product_price" id="product_price">
                            </div>

                            <div class="form-group">
                                <label>Product QTA</label>
                                <input class="form-control" type="text" name="product_qty" id="product_qty">
                            </div>

                            <div class="form-group">
                                <label>Product Image</label>
                                <input class="form-control" type="file" name="product_image" id="product_image">
                            </div>

                            <div class="form-group">
                                <label>Product Description</label>
                                <input class="form-control" type="text" name="product_description" id="product_description">
                            </div>


                            <div class="form-group">
                                <label>Product meta title</label>
                                <input class="form-control" type="text" name="product_meta_title" id="product_meta_title">
                            </div>


                            <div class="form-group">
                                <label>Product meta desc</label>
                                <input class="form-control" type="text" name="product_meta_description" id="product_meta_description">
                            </div>

                            <div class="form-group">
                                <label>Product meta short</label>
                                <input class="form-control" type="text" name="product_short_description" id="product_short_description">
                            </div>

                            <div class="form-group">
                                <label>Product meta keyword</label>
                                <input class="form-control" type="text" name="product_meta_keyword" id="product_meta_keyword">
                            </div>

                            <input class="btn btn-primary" type="submit" name="addProduct" value="Add Product">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include_once "includes/footer.php";?>
