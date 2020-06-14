<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Dhaka');
include_once "admin/connection.php";
include_once "includes/add_to_cart.php";

$cart = new Add_to_cart();

function get_product( $type = '', $limit = 5, $catID = '', $productID = '') {

    global $connection;
    $productSQL = "SELECT * FROM product WHERE status=1";

    if ( $catID != '' ) {
        $productSQL .= " AND categories_id='{$catID}'";
    }

    if ( $productID != '' ) {
        $productSQL .= " AND id='{$productID}'";
    }

    // if ( $is_best_seller != '' ) {
    //     $productSQL .= " AND product.best_seller=1";
    // }

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

function get_single_product_total_price( $sp, $price, $qty ) {
   
    if ( $sp == '' || $sp == null || $sp == 0 ) {
        return $price * $qty;
    } else {
        return $sp * $qty;
    }
}

function get_user_id_by_email($email) {
    global $connection;
    $output = '';

    $sql = "SELECT id FROM user_frontend WHERE email='{$email}' LIMIT 1";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $output = $row['id'];
    } else {
        $output = mysqli_error($connection);
    }
    return $output;
}

function best_seller_product(){

    global $connection; 

    $dateToMinus = 20;
    $todayDate = date('Y-m-d h:i:s');
    $minusDate = date( "Y-m-d 23:59:59", strtotime( $todayDate . "-{$dateToMinus} day"));

    $sql = "SELECT product_id, SUM(product_qty) AS TotalQuantity FROM order_details WHERE created_at BETWEEN '$minusDate' AND '$todayDate' GROUP BY product_id ORDER BY SUM(product_qty) DESC LIMIT 4";


    $runGalibBahiQuery = mysqli_query($connection, $sql); 
  
    $blankArray = array(); 
    while($row = mysqli_fetch_assoc($runGalibBahiQuery)){
        $blankArray[] = $row['product_id']; 
    }
    
    $products = array(); 
    foreach ($blankArray as $value) {
        $product = get_product('','','',$value); 
        $products[] = $product[0];
    }

    return $products; 

}