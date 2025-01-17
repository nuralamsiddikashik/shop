<?php
    include_once "includes/header.php";

    if ( isset( $_GET['type'] ) && $_GET['type'] != '' ) {
        $type = $_GET['type'];

        if ( $type == 'status' ) {
            $operation = $_GET['operation'];
            $id        = $_GET['id'];

            if ( $operation == 'active' ) {
                $status = "1";
            } else {
                $status = "0";
            }

            $update_status = "UPDATE product SET status='{$status}' WHERE id='{$id}'";
            mysqli_query( $connection, $update_status );
        }

        if ( $type == 'delete' ) {
            $id         = $_GET['id'];
            $delete_sql = "DELETE FROM product WHERE id='{$id}'";
            mysqli_query( $connection, $delete_sql );
        }
    }

    // $productSQL   = "SELECT * FROM product ORDER BY id DESC";

    $productSQL = "SELECT product.*,categories.category_name FROM product,categories WHERE product.categories_id=categories.id ORDER BY product.id DESC";

    $productQuery = mysqli_query( $connection, $productSQL );

?>


<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table cat-table table-bordered">
                        <thead class="bg-info">
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product MRP</th>
                                <th>Product Price</th>
                                <th>Product Qta</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ( $row = mysqli_fetch_assoc( $productQuery ) ) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><img src="upload/<?php echo $row['product_image']; ?>"></td>
                                <td><?php echo $row['product_mrp']; ?></td>
                                <td><?php echo $row['product_price']; ?></td>
                                <td><?php echo $row['product_qty']; ?></td>
                                <td class="right-side">
                                    <?php
                                        if ( $row['status'] == 1 ) {
                                            echo "<span class='badge badge-active'><a class='delete' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a></span>";
                                        } else {
                                            echo "<span class='badge badge-active'><a class='delete' href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a></span>";
                                        }
                                            echo "<span class='badge badge-edit'><a class='delete' href='productEdit.php?id=" . $row['id'] . "'>Edit</a></span>";
                                            echo "<span class='badge badge-delete'><a class='delete' href='?type=delete&id=" . $row['id'] . "'>Delete</a></span>";

                                        ?>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>



<?php include_once "includes/footer.php";?>