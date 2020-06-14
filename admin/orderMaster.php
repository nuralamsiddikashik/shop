<?php include_once "includes/header.php";?>

<?php

    // $userID = get_user_id_by_email($_SESSION['FRONTEND_USER']);
    // $orderQuery = "SELECT * FROM orders WHERE user_id='{$userID}'";

    // $order_id = (int) $_GET['order-id'];

    $orderQuery = "SELECT orders.*,order_status.name as order_status FROM orders,order_status WHERE order_status.id=order_status";

    $orderResult = mysqli_query( $connection, $orderQuery );
    $orderData   = array();
    while ( $row = mysqli_fetch_assoc( $orderResult ) ) {
        $orderData[] = $row;
    }
?>


<div class="content-wrapper">
	<section class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
						<h3>User Order Manage</h3>
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

						    <?php foreach ( $orderData as $order_info ) {

                                ?>
							    <tr>
							    	<td><?php echo $order_info['id']; ?></td>
							    	<td><?php echo $order_info['payment_method']; ?></td>
							    	<td><?php echo $order_info['payment_status']; ?></td>
							    	<td><?php echo $order_info['order_status']; ?></td>
							    	<td><?php echo $order_info['order_total']; ?></td>
							    	<td><a class="btn btn-outline-info" href="orderMasterDetail.php?id=<?php echo $order_info['id']; ?>">Details</a></td>
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