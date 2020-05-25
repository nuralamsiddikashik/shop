<?php

    include_once "includes/header.php";

    // $categoryIDFromDatabase = "SELECT id, categories FROM category_name ORDER BY category_name DESC";
    $categoryIDFromDatabase = "SELECT * FROM `categories` ORDER BY `category_name` DESC";
    $categoryQuery          = mysqli_query( $connection, $categoryIDFromDatabase );
    // var_dump($categoryQuery);
    $errors = array();
    if ( isset( $_POST['addProduct'] ) ) {

        $categories_id             = $_POST['categories_id'];
        $product_name              = $_POST['product_name'];
        $product_mrp               = $_POST['product_mrp'];
        $product_price             = $_POST['product_price'];
        $product_qty               = $_POST['product_qty'];
        $product_description       = $_POST['product_description'];
        $product_meta_title        = $_POST['product_meta_title'];
        $product_meta_description  = $_POST['product_meta_description'];
        $product_meta_keyword      = $_POST['product_meta_keyword'];
        $product_short_description = $_POST['product_short_description'];
        //$product_image             = $_POST['product_image'];
        // $product_image = addslashes( file_get_contents( $_FILES['product_image']['tmp_name'] ) );

        $file_name  = $_FILES['product_image']['name'];
        $file_size  = $_FILES['product_image']['size'];
        $file_tmp   = $_FILES['product_image']['tmp_name'];
        $file_type  = $_FILES['product_image']['type'];
        $file_ext   = explode( '.', $file_name );
        $ext        = end( $file_ext );
        $extentions = array( "jpeg", "jpg", "png" );

        if ( in_array( $ext, $extentions ) === false ) {
            $errors[] = "This extentios file not support";
        }

        if ( $file_size > 2097152 ) {
            $errors[] = "File size must be 2mb size";
        }

        if ( empty( $errors ) == true ) {
            move_uploaded_file( $file_tmp, "upload/" . $file_name );
        } else {
            print_r( $errors );
            die();
        }

        if ( empty( $categories_id ) ) {
            echo 'Category Can Not Be empty';
        } else if ( empty( $product_name ) ) {
            echo 'Product Can Not Be empty';
        } else if ( empty( $product_mrp ) ) {
            echo 'MRP Can Not Be empty';
        } else if ( empty( $product_price ) ) {
            echo 'Price Can Not Be empty';
        } else if ( empty( $product_qty ) ) {
            echo 'QTY Can Not Be empty';
        } else if ( empty( $product_description ) ) {
            echo 'Product Description Can Not Be empty';
        } else if ( empty( $product_meta_title ) ) {
            echo 'Product Meta title Can Not Be empty';
        } else if ( empty( $product_meta_description ) ) {
            echo 'Product Meta Description Can Not Be empty';
        } else if ( empty( $product_meta_keyword ) ) {
            echo 'Product Meta Keyword Can Not Be empty';
        } else if ( empty( $product_short_description ) ) {
            echo 'Product Short Description Can Not Be empty';
        } else {
            $addProductDatabase = "INSERT INTO product(categories_id,product_name,product_mrp,product_price,product_qty,product_image,product_description,product_meta_title,product_meta_description,product_short_description,product_meta_keyword,status) VALUES('{$categories_id}','{$product_name}','{$product_mrp}','{$product_price}','{$product_qty}','{$file_name}','{$product_description}','{$product_meta_title}','{$product_meta_description}','{$product_short_description}','{$product_meta_keyword}','1');";

            $resultAddProduct = mysqli_query( $connection, $addProductDatabase );

            if ( $resultAddProduct ) {
                var_dump( $resultAddProduct );
                //header( "Location: productManage.php" );
            } else {
                var_dump( mysqli_error( $connection ) );
                //echo "Something Wrong";
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
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
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
