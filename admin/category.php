<?php
    session_start();
    if ( !isset( $_SESSION["ADMIN_USER"] ) ) {
        header( "Location: login.php" );
    }

    require_once "connection.php";

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
    include "header.php";

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
                                <td>
                                    <?php
                                        if ( $row['status'] == 1 ) {
                                            echo "<a href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a>";
                                        } else {
                                            echo "<a href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a>";
                                        }
                                            echo "<a href='editCategory.php?id=" . $row['id'] . "'>Edit</a>";
                                            echo "<a href='?type=delete&id=" . $row['id'] . "'>Delete</a>";

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



<?php include "footer.php";?>