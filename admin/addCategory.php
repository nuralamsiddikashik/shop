<?php
    include_once "includes/header.php";
    $data = addCategory();

?>

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-form">
                    <?php echo $data['msg']; ?>
                    <?php echo $data['fieldErrMessage']; ?>
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

<?php include_once "includes/footer.php"; ?>