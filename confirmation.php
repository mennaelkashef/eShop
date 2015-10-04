<!DOCTYPE html>
<html>
<head>
	<title> Confirmation </title>
</head>
<body>
	<?php
	require('header.php');  
	$username = 'root';
	mysql_connect('localhost', $username); 
	mysql_select_db('eShop_db');

	if ($_GET) {

		if (!isset($_SESSION['user_id'])) {
			echo "You need to Login or Register To buy Products ";
			$_SESSION['product_id_unauthenticated'] = $_GET['product_id'];
			echo $_SESSION['product_id_unauthenticated'];
			require('login.php');

		} else {
		$id = $_GET['product_id'];
		$query = "SELECT * FROM `Products` WHERE `id` = $id;";
		$result = mysql_query($query) or die(mysql_error());
		while ($product = mysql_fetch_assoc($result)) {
			echo "<div class='checkout-prods'>
						<div class = 'checkout-prod' >
							<div class ='checkout-prod-img'>
								<img src='getProductImage.php?id={$product['id']}' />
							</div>
							<div class='checkout-prod-properties'>
								<div class='checkout-prod-name'>{$product['name']}</div>
								<div class='checkout-prod-price'>&#36;{$product['price']}</div>
							</div>
						</div>
					  </div> 
			<div class='checkout'> <form method='post' action='confirmation.php'>
					<input type='hidden' id='product_id' name='product_id' value='{$product['id']}'>
					<input class = 'checkout-btn' type='submit' value='Confirm'>
					</form> </div>"; }
		}
	}
	else if ($_POST) {
		$product_id = $_POST['product_id'];
		$user = $_SESSION['user_id'];
		$query = "SELECT `user_id` FROM `users` WHERE `username` = '$user'";
		$result = mysql_query($query) or die(mysql_error());
			while ($user = mysql_fetch_assoc($result)) {
				$user_id = $user['user_id'];
			}
		$query = "INSERT INTO `purchases` (product_id, user_id) VALUES ('$product_id', '$user_id')";
	    mysql_query($query) or die(mysql_error());
	    $query = "UPDATE `Products` SET `stock` = `stock` - 1 WHERE (`id` = $product_id);";
	    mysql_query($query) or die(mysql_error());
		$_SESSION['product_id'] = $product_id;

	mysql_close();
	header("Location: /eShop/index.php");
	}

	?>


</body>
</html>
