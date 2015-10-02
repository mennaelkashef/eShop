<?php
	session_start();
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
			while ($cart_products = mysql_fetch_assoc($result)) {
				$product_id = $cart_products['product_id'];
	
				$query = "SELECT * FROM `products` WHERE id='$product_id';";
				$result2 = mysql_query($query) or die(mysql_error());
				$product = mysql_fetch_assoc($result2);
				echo "<table>";
				echo "<tr>";
				echo"<td>{$product['name']}</td><td>{$product['price']}</td>";
				echo "<td><button onclick=removeFromCart($product_id)>remove</button></td>";
				echo"</tr>";
				echo "</table>";
				
			
			}
			echo "<form method='post' action='viewCart.php'>
					<input type='hidden' name='checkout' id='checkout' value='checkout'>
				<input type='submit' value='Checkout'>
				</form>";
			
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