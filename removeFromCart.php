<?php
	$username = 'root';
	mysql_connect('localhost', $username); 
	mysql_select_db('eShop_db');
	$product_id = $_GET['product_id'];
	$remove_query = "DELETE FROM `cart` WHERE product_id='$product_id';";
	mysql_query($remove_query) or die(mysql_error());
	mysql_close(); 
	
?>