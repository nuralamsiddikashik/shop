<?php
    include_once "includes/header.php";

    if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
        $id             = $_GET['id'];
        $idDisplayQuery = "SELECT * FROM categories WHERE id='{$id}'";
        $idQuery        = mysqli_query( $connection, $idDisplayQuery );
        $check          = mysqli_num_rows( $idQuery );
        if ( $check > 0 ) {
            $row          = mysqli_fetch_assoc( $idQuery );
            $categoriesID = $row['id'];
            $categories   = $row['category_name'];
        } else {
            header( "Location: category.php" );
        }

    }

    if ( isset( $_POST['submit_category'] ) ) {
        $catID              = $_POST['id'];
        $updateCategoryName = $_POST['category_name'];

        if ( empty( $updateCategoryName ) ) {
            echo "Please Update Category Name";
        } else {
            $updateCategorySQL = "UPDATE categories SET category_name='{$updateCategoryName}'
            WHERE id='{$catID}'";
            $updateResult = mysqli_query( $connection, $updateCategorySQL );

            if ( $updateResult ) {
                header( "Location: category.php" );
            } else {
                echo "Something Went Wrong";
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
                        <p>Update Category</p>
                        <form action="" method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" name="category_name" value="<?php echo $categories; ?>">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $categoriesID; ?>">
                            <input class="btn btn-primary" type="submit" name="submit_category" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include_once "includes/footer.php"; ?>