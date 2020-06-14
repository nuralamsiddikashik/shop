<?php 
	
	$userID = get_user_id_by_email($_SESSION['FRONTEND_USER']); 	
	// $orderQuery = "SELECT * FROM orders WHERE user_id='{$userID}'"; 
	$orderQuery = "SELECT orders.*,order_status.name as order_status FROM orders,order_status WHERE orders.user_id='{$userID}' AND order_status.id=order_status"; 
	
	$orderResult = mysqli_query($connection, $orderQuery);
	$orderData = array(); 
	while ($row = mysqli_fetch_assoc($orderResult)) {
		$orderData[] = $row; 
	}
?>


<h3>My orders</h3>
<div class="divider"></div>
<table class="table table-bordered cat-table">
    <thead class="bg-info">
        <tr>
            <th>Order ID</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Order Status</th>
            <th>Total Price</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
    
    <?php foreach($orderData as $order_info) { 
    
    	?> 
	    <tr>
	    	<td><?php echo $order_info['id']; ?></td>    
	    	<td><?php echo $order_info['payment_method']; ?></td>    
	    	<td><?php echo $order_info['payment_status']; ?></td>    
	    	<td><?php echo $order_info['order_status']; ?></td>    
	    	<td><?php echo $order_info['order_total']; ?></td>        
	    	<td><a href="profile.php?tab=order-details&order-id=<?php echo $order_info['id']; ?>">Details</a></td>            
	   </tr>

	<?php } ?>	


    </tbody>
</table>