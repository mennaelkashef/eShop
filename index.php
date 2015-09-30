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
		        echo "<div>{$product['name']}</div>";
		    echo "</td>";
		    echo "<td>&#36;{$product['price']}</td>";
		    $stock = $product['stock'];
		    if ( $stock == 0) {
		    	echo "<td> OUT OF STOCK </td>";
			}
			else {
				echo"<td> <form method='get' action='buy.php'>
				<input type='hidden' value='{$product['id']}'
				<input type='submit' value='Buy Now'>
				</form>";
				echo "<a href='/eShop/buy.php'> Buy Now </a></td>" ;
			}
		echo "</tr>";
	} 
}
else {
echo '<p>No Products.</p>';
}
echo "</table>";
mysql_close(); ?>

<a href="/eShop/add.php"> Add Product </button>
</body>
</html>
   