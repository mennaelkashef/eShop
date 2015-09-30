<form method="post" action="">
	Name: <input name='name' type="text" id="name"> <br />
	Price: <input name='price' type="number" id="price"> <br />
	Stock: <input name='stock' type="number" id="stock"> <br />

	<input type='submit' value="Submit">
</form>

<a href="/eShop/index.php"> Back to HomePage</a>
<?php if ($_POST) {
$username = 'root';
mysql_connect('localhost', $username); 
mysql_select_db('eShop_db');

$name = $_POST['name'];
$stock = $_POST['stock'];
$price = $_POST['price'];

echo $name;
echo $stock;
echo $price;
$query = "INSERT INTO `Products`(`name`, `price`, `stock`) VALUES ('$name' , '$price', '$stock')";
mysql_query($query);

echo "<h2>Product Added Successfully</h2>";
mysql_close();

header("Location: /eShop/index.php");
die();
}
?>