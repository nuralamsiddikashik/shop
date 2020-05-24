<?php
ob_start();
session_start();
include_once "connection.php";

// function pr( $arr ) {
//     echo "<pre>";
//     print_r( $arr );
// }

// function prx( $arr ) {
//     echo "<pre>";
//     print_r( $arr );
//     die();
// }

// function get_safe_value( $connection, $str ) {
//     if ( $str != '' ) {
//         return mysqli_real_escape_string( $connection, $str );
//     }
// }

function addCategory() {
    global $connection;
    $msg             = "";
    $fieldErrMessage = "";
    if ( isset( $_POST['submit_category'] ) ) {
        $category_name = $_POST['category_name'];

        if ( empty( $category_name ) ) {
            $fieldErrMessage = "Field Can Not Be Empty";
        } else {

            $checkCategoryName  = "SELECT * FROM categories WHERE category_name='{$category_name}'";
            $checkCategoryQuery = mysqli_query( $connection, $checkCategoryName );

            if ( mysqli_num_rows( $checkCategoryQuery ) > 0 ) {
                $msg = "Category Name Already Exixst";
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
    }
    return array(
        'msg'             => $msg,
        'fieldErrMessage' => $fieldErrMessage,
    );
}