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
    echo "<script>alert('your purchase was successful;')</script>";
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
        echo "<th>Available (USD)</th>";
    echo "</tr>";

while ($product = mysql_fetch_assoc($result)) 
	{ 
	    echo "<tr>";
		    echo "<td>";
		        echo "<div>{$product['name']}</div>";
		    echo "</td>";
		    echo "<td>&#36;{$product['price']}</td>";
		    $stock = $product['stock'];
		    if ( $stock == 0) {
		    	echo "<td> OUT OF STOCK </td>";
			}
			else {
				echo"<td> <form method='get' action='buy.php'>
				<input type='hidden' value='{$product['id']}'>
				<input type='submit' value='Buy Now'>
				</form></td>";
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
					echo"<button class ='remove' onclick=removeFromCart($product_id)>remove from cart</button>";
				}
				else {
					echo "<button class ='add' onclick=addToCart($product_id)>add to cart</button>";
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
mysql_close(); 
?>

<a href="/eShop/add.php"> Add Product </a>
<a href="/eShop/viewCart.php"> view Cart </a>
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
                alert('this item has been added to your cart');
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
                alert('this item has been removed from your cart');
                window.location.reload(true);
            }
        });
}


</script>