<?php 

    include_once "includes/header.php";

    // $categoryIDFromDatabase = "SELECT id, categories FROM category_name ORDER BY category_name DESC";
    $categoryIDFromDatabase = "SELECT * FROM `categories` ORDER BY `category_name` DESC";
    $categoryQuery          = mysqli_query( $connection, $categoryIDFromDatabase );
    // var_dump($categoryQuery);
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
                               <select class="form-control" id="categories_id">
                                    <option value="">Select Category</option>
                                    <?php
                                    while ( $row = mysqli_fetch_assoc( $categoryQuery ) ) {?>

                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                                        
                                    <?php }?>
                               </select>
                               <?php //var_dump($row); ?>
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
