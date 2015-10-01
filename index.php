<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
</head>
<body>
<h1>Products</h1>
<?php
$username = 'root';
mysql_connect('localhost', $username); 
mysql_select_db('eShop_db');
$query = "SELECT * FROM `Products`;";
$result = mysql_query($query) or die(mysql_error());
$numRows = mysql_num_rows($result); 

if ($numRows > 0) {

echo "<table>";

    echo "<tr>";
        echo "<th class='textAlignLeft'>Product Name</th>";
        echo "<th>Price (USD)</th>";
        echo "<th>Available (USD)</th>";
    echo "</tr>";

while ($product = mysql_fetch_assoc($result)) 
	{ 
	    echo "<tr>";
		    echo "<td>";
		    	$query = "SELECT * FROM Product_Images WHERE product_id={$product['id']}";
 				$result2 = mysql_query("$query");
 				$numRows = mysql_num_rows($result2); 
 				if ($numRows > 0) {
		        echo "<div>{$product['name']} <img src='getProductImage.php?id={$product['id']}' width='175' height='200'/></div>";
		    	} else {
		    	echo "<div>{$product['name']} </div>";

		    	}
		    echo "</td>";
		    echo "<td>&#36;{$product['price']}</td>";
		    $stock = $product['stock'];
		    if ( $stock == 0) {
		    	echo "<td> OUT OF STOCK </td>";
			}
			else {
				echo"<td> <form method='get' action='confirmation.php'>
				<input type='hidden' id='product_id' name='product_id' value='{$product['id']}'>
				<input type='submit' value='Buy Now'>
				</form> </td>" ;
			}

		echo "</tr>";
	} 
}
else {
echo '<p>No Products.</p>';
}
echo "</table>";
	session_start();


if (isset($_SESSION['product_id']) and ($_SESSION['product_id'] != 0)) {
	$product_id = $_SESSION['product_id'];
	$query = "SELECT * FROM `Products` WHERE `id` = $product_id;";
	$result = mysql_query($query) or die(mysql_error());
	while($product = mysql_fetch_assoc($result)) {
		echo"<script>
		alert('You have successfully purchased {$product['name']}');
		</script>";
	}

	$_SESSION['product_id'] = 0;
}
mysql_close(); ?>

<a href="/eShop/add.php"> Add Product </a> </br>
<?php
if ( !isset($_SESSION['user_id'])) {

	echo "<a href='/eShop/login.php'> Log in </button> </br>
	  	  <a href='/eShop/register.php'> Sign up </button>";
}
else {
	echo "<a href='/eShop/edit-profile.php'> Edit your profile </a> </br>" ;
	echo "<a href='/eShop/history.php'> View your history </a> </br>" ;
	echo "<a href=''> Log out </a>";
}
?>
</body>
</html>
   