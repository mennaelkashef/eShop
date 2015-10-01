<html>
<body>
<?php 
session_start();
$username = 'root';
$password = '';
mysql_connect('localhost', $username, $password);
mysql_select_db('eShop_db');

$product_id = $_GET['product_id'];

$username = $_SESSION['user_id'];
$query = "SELECT * FROM `users` WHERE username='$username';";
$result = mysql_query($query) or die(mysql_error());
$user = mysql_fetch_assoc($result);
$user_id = $user['user_id'];
$query = "INSERT INTO `cart`(`product_id`, `user_id`) VALUES ('$product_id', '$user_id')";
mysql_query($query);




echo $product_id;
echo $user_id;
mysql_close();
?>
</body>
</html>