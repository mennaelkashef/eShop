<html>
<head>
<title>Edit Profile</title>
</head>

<body>
<h2>Edit Profile</h2>
<?php 
	$username = 'root';
	mysql_connect('localhost', $username); 
	mysql_select_db('eShop_db');
	session_start();
	if (isset($_SESSION['user_id'])) {
		$user_id_session = $_SESSION['user_id'];
		$query = "SELECT * FROM `users` WHERE username='$user_id_session'";
		$result = mysql_query($query) or die(mysql_error());
		$user = mysql_fetch_assoc($result);
		$user_id = $user['user_id'];

	}

	if (isset($_SESSION['message']) && $_SESSION['message'] !='') {
		$message = $_SESSION['message'];
		 echo "<script> alert('$message'); </script>";
		 $_SESSION['message'] = '';
	}

	if ($_POST){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$query = "SELECT * FROM `users` WHERE username='$username'";
		$result = mysql_query($query) or die(mysql_error());
		$numRows = mysql_num_rows($result);
		if ($numRows >= 1 and $username != $user_id_session ) {
			$_SESSION['message'] = "Email already exists"; 
			header("Location: /eShop/edit-profile.php");

		}
		else {
	    $query = "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `username` = '$username' WHERE (`user_id` = $user_id)";

	    mysql_query($query) or die(mysql_error());	
	    $_SESSION['user_id'] = $username;
	    	if ($_FILES) {
				if ($_FILES['image']['size'] > 0) {
					echo "Hi";
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


					// $query = "INSERT INTO User_Images (name, size, type, content, user_id ) 
					// VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$user_id' )";
					$query = "DELETE FROM `User_Images` WHERE user_id = '$user_id'";
					mysql_query($query) or die(mysql_error()); 
					$query = "
					INSERT INTO User_Images (name, size, type, content, user_id ) 
					VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$user_id' )";

					$target_dir = "/Applications/XAMPP/xamppfiles/htdocs/eShop/uploads/";
					$target_file = $target_dir . basename($_FILES["image"]["name"]);
					// $new_file_name = strtolower($_FILES['image']['tmp_name']); //rename file

					if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
					        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
					    } else {
					        echo "Sorry, there was an error uploading your file.";
					   }
					mysql_query($query) or die(mysql_error()); 
				}
			}
		header("Location: /eShop/index.php");
		}
		mysql_close();
	}



 ?>
<form action="" method="post" enctype="multipart/form-data">
<fieldset>
<p>
<label for="firstname">First Name</label>
<input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']?>" maxlength="20" />
</p>
<p>
<label for="lastname">Last Name</label>
<input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']?>" maxlength="20" />
</p>
<p>
<label for="username">Email</label>
<input type="text" id="username" name="username" value="<?php echo $user['username']?>" maxlength="20" />
</p>
<p>

<h4 for="image">Profile Picture</h4>
   <?php $query = "SELECT * FROM User_Images WHERE user_id=$user_id";
			$result2 = mysql_query("$query");
			$numRows = mysql_num_rows($result2); 
			if ($numRows > 0) {
			echo "<h4 for='image'>Current Profile Picture</h4>";
        	echo "<img src='getUserImage.php?id=$user_id' width='175' height='200'/>";
        	echo "<br> <label for='image'>Edit Profile Picture: </label>";

    	} else {
    		echo "<h4> No Profile Image Chosen </h4>";        	
    		echo "<br> <label for='image'>Choose Profile Picture: </label>";
   		}
    	?>

	<input type="file" name="image" id="image">
</p>
<p>
<input type="submit" value="&rarr; Submit" />
<a href="/eShop/index.php"> Back to HomePage</a>

</p>
</fieldset>
</form>
</body>
</html>