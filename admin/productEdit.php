<?php include_once "includes/header.php";?>

<?php

    $categoryIDFromDatabase = "SELECT * FROM `categories` ORDER BY `category_name` DESC";
    $categoryQuery          = mysqli_query( $connection, $categoryIDFromDatabase );

    if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
        $id                  = $_GET['id'];
        $array               = array();
        $productDisplayQuery = "SELECT * FROM product WHERE id='{$id}'";
        $productQuery        = mysqli_query( $connection, $productDisplayQuery );

        if ( mysqli_num_rows( $productQuery ) > 0 ) {
            while ( $row = mysqli_fetch_assoc( $productQuery ) ) {
                $array = $row;
            }

        }
    }

    if ( isset( $_POST['updatePost'] ) ) {
        $product_categories        = $_POST['categories_id'];
        $product_name              = $_POST['product_name'];
        $product_mrp               = $_POST['product_mrp'];
        $product_price             = $_POST['product_price'];
        $product_qty               = $_POST['product_qty'];
        $product_description       = $_POST['product_description'];
        $product_meta_title        = $_POST['product_meta_title'];
        $product_meta_description  = $_POST['product_meta_description'];
        $product_short_description = $_POST['product_short_description'];
        $product_meta_keyword      = $_POST['product_meta_keyword'];
        $file_name                 = $_FILES['product_image']['name'];
        if ( $_FILES['product_image']['error'] != 4 ) {

            $file_size   = $_FILES['product_image']['size'];
            $file_tmp    = $_FILES['product_image']['tmp_name'];
            $file_type   = $_FILES['product_image']['type'];
            $file_ext    = explode( '.', $file_name );
            $ext         = end( $file_ext );
            $extentions  = array( "jpeg", "jpg", "png" );
            $newFileName = time() . rand( 123456789, 987456123 ) . '.' . $ext;

            if ( in_array( $ext, $extentions ) === false ) {
                $errors[] = "This extentios file not support";
            }

            if ( $file_size > 2097152 ) {
                $errors[] = "File size must be 2mb size";
            }

            if ( empty( $errors ) == true ) {
                move_uploaded_file( $file_tmp, "upload/" . $newFileName );
            } else {
                print_r( $errors );

            }

            $updateSQL = "UPDATE product SET
                categories_id='{$product_categories}',
                product_name='{$product_name}',
                product_mrp='{$product_mrp}',
                product_image='{$newFileName}',
                product_price='{$product_price}',
                product_qty='{$product_qty}',
                product_description='{$product_description}',
                product_meta_title='{$product_meta_title}',
                product_meta_description='{$product_meta_description}',
                product_short_description='{$product_short_description}',
                product_meta_keyword='{$product_meta_keyword}' WHERE id='{$id}'";
        } else {
                $updateSQL = "UPDATE product SET
                categories_id='{$product_categories}',
                product_name='{$product_name}',
                product_mrp='{$product_mrp}',
                product_price='{$product_price}',
                product_qty='{$product_qty}',
                product_description='{$product_description}',
                product_meta_title='{$product_meta_title}',
                product_meta_description='{$product_meta_description}',
                product_short_description='{$product_short_description}',
                product_meta_keyword='{$product_meta_keyword}' WHERE id='{$id}'";

        }

        $updatePostQuery = mysqli_query( $connection, $updateSQL );

        if ( $updatePostQuery ) {
            header( "Location: productManage.php" );
        } else {
            echo "Something Went Wrong";
        }
    }
?>

<div class="content-wrapper">
	<section class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-form">
						<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                               <label>Select category Name</label>
                                 <select class="form-control" name="categories_id">
                                    <option value="">Select Category</option>
                                    <?php
                                        while ( $row = mysqli_fetch_assoc( $categoryQuery ) ) {

                                            if ( $array['categories_id'] == $row['id'] ) {
                                                $selected = "selected='selected'";
                                            } else {
                                                $selected = '';
                                            }
                                            var_dump( $row );

                                        ?>

                                        <option value="<?php echo $row['id']; ?>"<?php echo $selected; ?>><?php echo $row['category_name']; ?></option>

                                    <?php }?>
                               </select>
                            </div>
                            <div class="form-group">
                                <label>Add Product Name</label>
                                <input class="form-control" type="text" name="product_name" value="<?php echo $array['product_name']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Add Product MRP</label>
                                <input class="form-control" type="text" name="product_mrp" value="<?php echo $array['product_mrp']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Add Product MRP</label>
                                <input class="form-control" type="text" name="product_price" value="<?php echo $array['product_price']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Product QTA</label>
                                <input class="form-control" type="text" name="product_qty" value="<?php echo $array['product_qty']; ?>">
                            </div>

                            <div class="form-group">
                                <?php
                                    if ( $array['product_image'] != '' && $array['product_image'] != null ) {
                                        echo "<img height='50px' src='upload/" . $array['product_image'] . "' >";
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Product Image</label>
                                <input class="form-control" type="file" name="product_image">
                            </div>

                            <div class="form-group">
                                <label>Product Description</label>
                                <input class="form-control" type="text" name="product_description" value="<?php echo $array['product_description']; ?>">
                            </div>


                            <div class="form-group">
                                <label>Product meta title</label>
                                <input class="form-control" type="text" name="product_meta_title" value="<?php echo $array['product_meta_title']; ?>">
                            </div>


                            <div class="form-group">
                                <label>Product meta desc</label>
                                <input class="form-control" type="text" name="product_meta_description" value="<?php echo $array['product_meta_description']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Product meta short</label>
                                <input class="form-control" type="text" name="product_short_description" value="<?php echo $array['product_short_description']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Product meta keyword</label>
                                <input class="form-control" type="text" name="product_meta_keyword" value="<?php echo $array['product_meta_keyword']; ?>">
                            </div>

                            <input class="btn btn-primary" type="submit" name="updatePost" value="Update Product">
                        </form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


 <?php include_once "includes/footer.php";?>