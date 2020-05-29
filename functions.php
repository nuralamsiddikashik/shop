<?php include_once "admin/connection.php";

function get_product( $type = '', $limit = 5, $catID = '', $productID = '' ) {

    global $connection;
    $productSQL = "SELECT * FROM product WHERE status=1";

    if ( $catID != '' ) {
        $productSQL .= " AND categories_id='{$catID}'";
    }

    if ( $productID != '' ) {
        $productSQL .= " AND id='{$productID}'";
    }

    if ( $type == 'latest' ) {
        $productSQL .= " ORDER BY id DESC";
    }

    if ( $limit != '' ) {
        $productSQL .= " LIMIT {$limit}";
    }
    $productResult = mysqli_query( $connection, $productSQL );
    $data          = array();
    if ( $productResult ) {
        while ( $row = mysqli_fetch_assoc( $productResult ) ) {
            $data[] = $row;
        }
    } else {
        var_dump( mysqli_error( $connection ) );
    }
    return $data;

}