<html>
<head>
	<title>Cart</title>
</head>
<body>
<?php
	require('header.php');
	$username = 'root';
	$password = '';
	mysql_connect('localhost', $username, $password);
	mysql_select_db('eShop_db');
    $username = $_SESSION['user_id'];
	$query = "SELECT * FROM `users` WHERE username='$username';";
	$result = mysql_query($query) or die(mysql_error());
	$user = mysql_fetch_assoc($result);
	$user_id = $user['user_id'];
	$query = "SELECT * FROM `cart` WHERE user_id='$user_id'";
	$result = mysql_query($query) or die(mysql_error());
	$numRows = mysql_num_rows($result);
		if($_POST) {
		while ($cart_products = mysql_fetch_assoc($result)) {
				$product_id = $cart_products['product_id'];
				 $remove_query = "DELETE FROM `cart` WHERE product_id='$product_id';";
				   mysql_query($remove_query) or die(mysql_error());
				   $query = "INSERT INTO `purchases`(`product_id`, `user_id`) VALUES ('$product_id', '$user_id')";
				   mysql_query($query) or die(mysql_error('update failed'));
				
			}
		$_SESSION['checkout'] = '1';
		header("Location: /eShop/index.php");
		die();
		}
		if ($numRows > 0) {
			$total_price = 0;
			$total_items = 0;
			while ($cart_products = mysql_fetch_assoc($result)) {
				$product_id = $cart_products['product_id'];
				$query = "SELECT * FROM `products` WHERE id='$product_id';";
				$result2 = mysql_query($query) or die(mysql_error());
				$product = mysql_fetch_assoc($result2);
				$total_price = $total_price + $product['price'];
				$total_items = $total_items + 1;
				echo "<div class='checkout-prods'>
						<div class = 'checkout-prod' >
							<div class='remove-cart'>
								<a href='#' onclick=removeFromCart($product_id)><span class='glyphicon glyphicon-remove'></span></a>
							</div>
							<div class ='checkout-prod-img'>
								<img src='getProductImage.php?id={$product['id']}' />
							</div>
							<div class='checkout-prod-properties'>
								<div class='checkout-prod-name'>{$product['name']}</div>
								<div class='checkout-prod-price'>&#36;{$product['price']}</div>
							</div>
						</div>
					  </div>";
			}
			echo "<div class = 'total'>
					<div class = 'total-items'>
						<div class='items-title'>Total item(s)</div>
						<div class='items-number'>$total_items</div>
					</div>
					<div class = 'total-price'>
						<div class ='price-title'>Subtotal</div>
						<div class ='items-price'>&#36;$total_price</div>
					</div>
				</div>";
			echo "<div class ='checkout'>
					<form method='post' action='viewCart.php'>
						<input type='hidden' name='checkout' id='checkout' value='checkout'>
					<input class = 'checkout-btn' type='submit' value='Checkout'>
					</form>
				</div>";
			
		}
		
		else {
			echo '<p>No products.</p>';
		}
	mysql_close();
?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
 function removeFromCart(product_id) {
 	  $.ajax({
            url : 'removeFromCart.php', // give complete url here
            type : 'GET',
            data : 'product_id='+product_id,
            success : function() {
			    window.location.reload(true);
			}
        });
 	  console.log(product_id);
}
</script>