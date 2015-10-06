<html>
<body>
<?php 
session_start();
$username = 'root';
$password = '';
mysql_connect('localhost', $username, $password);
mysql_select_db('eShop_db');

$product_id = $_GET['product_id'];

		if (!isset($_SESSION['user_id'])) {
			echo "You need to Login or Register To buy Products ";
			$_SESSION['product_id_cart_unauthenticated'] = $_GET['product_id'];
			require('login.php');

		} else {
			$username = $_SESSION['user_id'];
			$query = "SELECT * FROM `users` WHERE username='$username';";
			$result = mysql_query($query) or die(mysql_error());
			$user = mysql_fetch_assoc($result);
			$user_id = $user['user_id'];
			$query = "INSERT INTO `cart`(`product_id`, `user_id`,`quantity` ) VALUES ('$product_id', '$user_id', 1)";
			mysql_query($query);
		}

if (isset($_SESSION['product_id_cart_unauthenticated']) and isset($_SESSION['user_id'])) {
	unset($_SESSION['product_id_cart_unauthenticated']);
	header("Location: /eShop/viewCart.php");
}


mysql_close();
?>
</body>
</html>