<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
</head>
<body>
<h1>Products</h1>
<?php
session_start();
if(isset( $_SESSION['checkout'] ) && $_SESSION['checkout']==='1')
{
    $_SESSION['checkout']='0';
    echo "<script>alert('your purchase was successful')</script>";
}
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
        echo "<th>Action </th>";
    echo "</tr>";

while ($product = mysql_fetch_assoc($result)) 
	{ 
	    echo "<tr>";
		    echo "<td>";
		    	$query = "SELECT * FROM Product_Images WHERE product_id={$product['id']}";
 				$result2 = mysql_query($query) or die(mysql_error());
 				$numRows = mysql_num_rows($result2); 
 				if ($numRows > 0) {
		        echo "<div>{$product['name']} <img src='getProductImage.php?id={$product['id']}' width='175' height='100'/></div>";
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
				if (isset($_SESSION['user_id'])) {
					$user = $_SESSION['user_id'];
					$query2 = "SELECT * FROM `users` WHERE username='$user';";
					$result2 = mysql_query($query2) or die(mysql_error());
					$user = mysql_fetch_assoc($result2);
					$user_id = $user['user_id'];
					$product_id = $product['id'];
					$query3 = "SELECT * FROM `cart` WHERE product_id='$product_id' AND user_id=$user_id;";
					$result3 = mysql_query($query3) or die(mysql_error());
					$product = mysql_fetch_assoc($result3);
					$numRows = mysql_num_rows($result3); 
					echo "<td>";
					if ($numRows > 0) {
						$user_id = 1;
						echo"<button class ='remove' onclick=removeFromCart($product_id)>Remove from cart</button>";
					}
					else {
						echo "<button class ='add' onclick=addToCart($product_id)>Add to cart</button>";
					}
				}
				else {
						// $product_id = $product['id'];
						// $user_id = 0;
						// echo "<button class='add' onclick=addToCart($product_id)>Add to cart</button>";
						echo"<td> <form method='get' action='addToCart.php'>
						<input type='hidden' id='product_id' name='product_id' value='{$product['id']}'>
						<input type='submit' value='Add to Cart'>
						</form> </td>" ;
				}
				echo "</td>";

			}

		echo "</tr>";
	} 
}
else {
echo '<p>No Products.</p>';
}

echo "</table>";


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

if(isset( $_SESSION['password_changed'] ) && $_SESSION['password_changed']=== 1)
{
    $_SESSION['password_changed']= 0;
    echo "<script>alert('Password Changed Successfully')</script>";
}
mysql_close(); ?>

<a href="/eShop/add.php"> Add Product </a> </br>
<?php
if ( !isset($_SESSION['user_id'])) {

	echo "<a href='/eShop/login.php'> Log in </a> </br>
	  	  <a href='/eShop/register.php'> Sign up </a>";
}
else {
	echo "<a href='/eShop/viewCart.php'> View Cart </a> </br>";
	echo "<a href='/eShop/edit-profile.php'> Edit your profile </a> </br>" ;
	echo "<a href='/eShop/change-password.php'> Change Password </a> </br>" ;
	echo "<a href='/eShop/history.php'> View your history </a> </br>" ;
	echo "<a href='/eShop/logout.php'> Log out </a>";
}
?>


</body>
</html>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">

	 
 function addToCart(product_id) {
 	  $.ajax({
            url : 'addToCart.php', // give complete url here
            type : 'GET',
            data : 'product_id='+product_id,
            success : function(){
                alert('This item has been added to your cart');
                window.location.reload(true);
            }
        });
}

function removeFromCart(product_id) {
 	  $.ajax({
            url : 'removeFromCart.php', // give complete url here
            type : 'GET',
            data : 'product_id='+product_id,
            success : function(){
                alert('This item has been removed from your cart');
                window.location.reload(true);
            }
        });
}


</script>