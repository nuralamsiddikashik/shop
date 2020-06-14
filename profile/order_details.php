<?php
    if(!isset($_GET['order-id'])) {
        header("Location: profile.php?tab=orders");
    } else {
        $order_id = (int) $_GET['order-id'];
    }

    $orderDetailsQuery = "SELECT * FROM order_details WHERE order_id='{$order_id}'"; 
    $orderDetailsResult = mysqli_query($connection, $orderDetailsQuery);
    $orderDetailData = array(); 
    while ($row = mysqli_fetch_assoc($orderDetailsResult)) {
        $orderDetailData[] = $row; 
    }
    
?>

<h3>My orders</h3>
<div class="divider"></div>
<div class="order-details-wrap">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Order Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($orderDetailData as $order_detail) {

                    $product_id = $order_detail['product_id'];
                    
                    $product = get_product( '', '', '', $product_id );
                    
                    $product_info = $product[0]; 

                    if(count($product_info) == 0) {
                        $product_info['name'] = 'Unknown product';
                    }


                    
                    $image = $product_info['product_image'];
                    // dd($product_info);
                    echo "<tr>";
                    echo $image != '' ? "<td><img height='50' src='admin/upload/{$image}'></td>" : "<td>No image available</td>";
                    echo "<td> {$product_info['product_name']} </td>";
                    echo "<td> {$order_detail['product_qty']} </td>";
                    echo "<td> {$order_detail['total_price']} </td>";
                     echo "<td> {$order_detail['created_at']} </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>