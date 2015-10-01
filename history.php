<!DOCTYPE html>
<html>
<head>
	<title>History</title>
</head>
<body>
	<h1>History</h1>
	<?php 
	$username = 'root';
	mysql_connect('localhost', $username); 
	mysql_select_db('eShop_db');
	session_start();
	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
		$query = "SELECT a.name, a.price FROM Products a, CART b WHERE a.id = b.product_id and b.bought = 1 and b.user_id=1";
		$result = mysql_query($query) or die(mysql_error());
		$numRows = mysql_num_rows($result);
		if ($numRows > 0) {
			echo "<table>";

			    echo "<tr>";
			        echo "<th class='textAlignLeft'>Product Name</th>";
			        echo "<th>Price (USD)</th>";
			    echo "</tr>";

			while ($product = mysql_fetch_assoc($result)) 
				{ 
				    echo "<tr>";
					    echo "<td>";
					        echo "<div>{$product['name']}</div>";
					    echo "</td>";
					    echo "<td>&#36;{$product['price']}</td>";
					echo "</tr>";
				} 

		} else {
			echo "<h3> You didn't purchase any products yet</h3>";
		}
	}
	?>
	<a href="/eShop/"> Back to HomePage</a>
</body>
</html>