<?php
    session_start();
    if ( !isset( $_SESSION["ADMIN_USER"] ) ) {
        header( "Location: login.php" );
    }
    require_once "connection.php";

    if ( isset( $_POST['submit_category'] ) ) {
        $category_name = $_POST['category_name'];

        if ( empty( $category_name ) ) {
            echo "Field Can Not Be Empty";
        } else {
            $categoryInsertDatabase = "INSERT INTO categories(category_name,status) VALUES('$category_name','1')";
            $resultCategory         = mysqli_query( $connection, $categoryInsertDatabase );

            if ( $resultCategory ) {
                header( "Location: category.php" );
            } else {
                echo "Something Wrong";
            }
        }
    }

    include "header.php";

?>

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-form">
                        <p>Add New Category</p>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" name="category_name">
                            </div>
                            <input class="btn btn-primary" type="submit" name="submit_category" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include "footer.php";?>