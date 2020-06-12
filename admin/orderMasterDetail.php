<?php include_once "includes/header.php"; ?> 

<?php

 	$id = (int) $_GET['id'];

    $orderDetailsQuery = "SELECT * FROM order_details WHERE order_id='{$id}'"; 
    $orderDetailsResult = mysqli_query($connection, $orderDetailsQuery);
    $orderDetailData = array(); 
    while ($row = mysqli_fetch_assoc($orderDetailsResult)) {
        $orderDetailData[] = $row; 
    }
    
    if(isset($_POST['update_order_status'])){
        $update_order_status = $_POST['update_order_status']; 
        mysqli_query($connection,"UPDATE orders SET order_status='{$update_order_status}' WHERE id='{$id}'"); 
    }

?>


<div class="content-wrapper">
	<section class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

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
                    echo $image != '' ? "<td><img height='50' src='upload/{$image}'></td>" : "<td>No image available</td>";
                    echo "<td> {$product_info['product_name']} </td>";
                    echo "<td> {$order_detail['product_qty']} </td>";
                    echo "<td> {$order_detail['total_price']} </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <div>
        <form method="POST">
            <select name="update_order_status" class="form-control">
                <option>Select Status</option>
                <?php 
                    $orderQuery = "SELECT * FROM order_status"; 
                    $query = mysqli_query($connection,$orderQuery); 
                    while($row = mysqli_fetch_assoc($query)){
                        if($row['id'] == $categories_id){
                            echo "<option selected value=".$row['id'].">".$row['name']."</option>"; 
                        }else{
                            echo "<option value=".$row['id'].">".$row['name']."</option>"; 
                        }
                    }
                ?>
            </select>
            <input type="submit" class="form-control">
        </form>
    </div>
</div>
</div>
</section>
</div>
</div>
</div>


<?php include_once "includes/footer.php";?>