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

            $update_status = "UPDATE categories SET status='{$status}' WHERE id='{$id}'";
            mysqli_query( $connection, $update_status );
        }

        if ( $type == 'delete' ) {
            $id         = $_GET['id'];
            $delete_sql = "DELETE FROM categories WHERE id='{$id}'";
            mysqli_query( $connection, $delete_sql );
        }
    }

    $sql    = "SELECT * FROM categories ORDER BY category_name ASC";
    $result = mysqli_query( $connection, $sql );

?>


<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table cat-table">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ( $row = mysqli_fetch_assoc( $result ) ) {?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td class="right-side">
                                    <?php
                                        if ( $row['status'] == 1 ) {
                                            echo "<span class='badge badge-active'><a class='delete' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a></span>";
                                        } else {
                                            echo "<span class='badge badge-active'><a class='delete' href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a></span>";
                                        }
                                            echo "<span class='badge badge-edit'><a class='delete' href='editCategory.php?id=" . $row['id'] . "'>Edit</a></span>";
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



<?php include_once "includes/footer.php"; ?>