<form method="post" action="" enctype="multipart/form-data">
	Name: <input name='name' type="text" id="name"> <br />
	Price: <input name='price' type="number" id="price"> <br />
	Stock: <input name='stock' type="number" id="stock"> <br />
	Select Image:
	<input type="file" name="image" id="image">
	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">


	<input type='submit' value="Submit">
</form>

<a href="/eShop/index.php"> Back to HomePage</a>
<?php if ($_POST ) {
$username = 'root';
mysql_connect('localhost', $username); 
mysql_select_db('eShop_db');

$name = $_POST['name'];
$stock = $_POST['stock'];
$price = $_POST['price'];


$query = "INSERT INTO `Products`(`name`, `price`, `stock`) VALUES ('$name' , '$price', '$stock')";
mysql_query($query);

echo "<h2>Product Added Successfully</h2>";

if ($_FILES['image']['size'] > 0) {
	$fileName = $_FILES['image']['name'];
	$tmpName  = $_FILES['image']['tmp_name'];
	$fileSize = $_FILES['image']['size'];
	$fileType = $_FILES['image']['type'];

	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);

	if(!get_magic_quotes_gpc())
	{
	    $fileName = addslashes($fileName);
	}

	$product_id = mysql_insert_id();

	$query = "INSERT INTO Product_Images (name, size, type, content, product_id ) 
	VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$product_id' )";

	$target_dir = "/Applications/XAMPP/xamppfiles/htdocs/eShop/uploads/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	// $new_file_name = strtolower($_FILES['image']['tmp_name']); //rename file

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	mysql_query($query) or die('Error, query failed'); 
}
mysql_close();

header("Location: /eShop/index.php");
die();
}
?>