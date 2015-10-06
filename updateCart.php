<?php
	$username = 'root';
	mysql_connect('localhost', $username); 
	mysql_select_db('eShop_db');
	$quantity = $_GET['quantity'];
	$product_id = $_GET['product_id'];

	$query = "UPDATE `CART` SET `quantity` = '$quantity' WHERE (`product_id` = '$product_id');";
	mysql_query($query) or die(mysql_error());
	echo mysql_errno();
	mysql_close(); 
	
?>