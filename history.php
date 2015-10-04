<!DOCTYPE html>
<html>
<head>
	<title>History</title>
</head>
<body>

	<?php 
			require('header.php');

	$username = 'root';
	mysql_connect('localhost', $username); 
	mysql_select_db('eShop_db');
	// session_start();
	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
		$query = "SELECT `user_id` FROM `users` WHERE `username` = '$user_id'";
		$result = mysql_query($query) or die(mysql_error());
			while ($user = mysql_fetch_assoc($result)) {
				$user_id = $user['user_id'];
			}
		$query = "SELECT a.id, a.name, a.price FROM Products a, purchases b WHERE a.id = b.product_id and b.user_id='$user_id'";
		$result = mysql_query($query) or die(mysql_error());
		$numRows = mysql_num_rows($result);
		if ($numRows > 0) {
		echo "<div class='products-list col-md-12'>";
	

			while ($product = mysql_fetch_assoc($result)) 
				{ 
		    	$query = "SELECT * FROM Product_Images WHERE product_id={$product['id']}";
 				$result2 = mysql_query($query) or die(mysql_error());
 				$numRows = mysql_num_rows($result2); 
 				if ($numRows > 0) {
		        echo "<div class ='product-container col-md-3'>
						<div class = 'product-img '>
							<img src='getProductImage.php?id={$product['id']}' />
						</div>
						<div class = 'product-properties'>
							<div class ='product-name'>{$product['name']}</div>";
		    	} else {
		    	echo "<div class = 'product-properties'>
						<div class='product-name'>{$product['name']} </div>";
		    	}
		    	echo "</div>";

		    echo "<div class='product-price'>&#36;{$product['price']}</div> </div></div>";
				} 
			echo "</div>";


		} else {
			echo "<h3> You didn't purchase any products yet</h3>";
		}
	}
	?>
	<!-- <a href="/eShop/"> Back to HomePage</a> -->
</body>
</html>