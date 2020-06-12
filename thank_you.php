<?php include_once "header.php"; 
    if ( !isset( $_SESSION["FRONTEND_USER"] ) ) {
        header( "Location: login.php" );
    }
 ?> 

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<p class="btn btn-success">Your order has been place <a href="index.php">Back to Home</a></p>
		</div>
	</div>
</div>



<?php include_once "footer.php"; ?>
