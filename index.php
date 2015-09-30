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
        echo "<th>Stock (USD)</th>";
    echo "</tr>";

while ($product = mysql_fetch_assoc($result)) 
	{ 
	    echo "<tr>";
		    echo "<td>";
		        echo "<div>{$product['name']}</div>";
		    echo "</td>";
		    echo "<td>&#36;{$product['price']}</td>";
		    echo "<td> {$product['stock']} </td>";
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
   