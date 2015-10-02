<!DOCTYPE html>
<html>
<head>
	<title> Confirmation </title>
</head>
<body>

<h1> Confirmation </h1>

	<?php  
	$username = 'root';
	mysql_connect('localhost', $username); 
	mysql_select_db('eShop_db');
	session_start();

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
			echo "<div style= 'float:left'>{$product['name']} <span>{$product['price']}&#36</span></div> <br>";
			echo"<td> <form method='post' action='confirmation.php'>
					<input type='hidden' id='product_id' name='product_id' value='{$product['id']}'>
					<input type='submit' value='Checkout'>
					</form> </td>"; }
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
